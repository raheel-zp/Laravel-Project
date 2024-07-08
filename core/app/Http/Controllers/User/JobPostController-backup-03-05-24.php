<?php

namespace App\Http\Controllers\User;

use PDO;
use Exception;
use App\Models\JobPost;
use App\Models\Category;
use App\Models\FileType;
use App\Models\JobProve;
use App\Constants\Status;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;
use App\Models\AdminNotification;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Referral;
use App\Models\User;
use Carbon\Carbon;

class JobPostController extends Controller
{
    public function create()
    {
        $pageTitle  = "Create Job";
        $categories = Category::active()->orderBy('name')->with('subcategory', function ($query) {
            $query->active()->get();
        })->get();
        $files      = FileType::active()->get();
        return view($this->activeTemplate . 'user.job.create', compact('pageTitle', 'files', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'    => 'required',
            'subcategory_id' => 'nullable|integer|exists:sub_categories,id',
            'job_proof'      => 'required|in:1,2',
            'file_name'      => 'required_if:job_proof,2|array',
            'quantity'       => 'required|integer|gt:0',
            'rate'           => 'required|numeric|gt:0',
            'title'          => 'required|string|max:255',
            'description'    => 'required',


        ], );

        $purifier = new \HTMLPurifier();

        $filename  = '';
        $user      = auth()->user();
        $jobAmount = $request->quantity * $request->rate;

        if ($request->job_proof == Status::JOB_PROVE_REQUIRED) {
            $file = FileType::active()->whereIn('name', $request->file_name)->count();

            if ($file != count($request->file_name)) {
                $notify[] = ['error', 'Job proof file name is wrong'];
                return back()->withNotify($notify)->withInput();
            }

            $filename = implode(',', $request->file_name);
        }

        if ($user->balance < $jobAmount) {
            $notify[] = ['error', 'You have no sufficient balance.'];
            return back()->withNotify($notify)->withInput();
        }

        $postBalance   = $user->balance - $jobAmount;
        $user->balance = $postBalance;
        $user->save();

        $job = new JobPost();

        if ($request->hasFile('attachment')) {
            try {
                $old             = $job->attachment;
                $imageSize = getimagesize($request->attachment);

                if($imageSize[0]!="267" && $imageSize[1]!="178"){
                    $notify[] = ['error', 'Please upload image of size 267px width and 178 px height.'];
                    return back()->withNotify($notify);
                }
                $job->attachment = fileUploader($request->attachment, getFilePath('jobPoster'), getFileSize('jobPoster'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        elseif (isset($request->uploadImageByUrl) && !empty($request->uploadImageByUrl)) {
            //imagepath below
            $image_name = time().".jpg";
            $basePath = str_replace("/core","",base_path());



            $path = $basePath.'/assets/images/job/'.$image_name;

            //echo $path = assets()."images/job/".$image_name;
            $context = stream_context_create(
                        array(
                            "http" => array(
                                "header" => "User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36"
                            )
                        )
                    );
            $url = $request->uploadImageByUrl;

            $image = file_get_contents($url, false, $context);

            if(file_put_contents($path, $image)){
                $job->attachment = $image_name;
            }

            $imageSize = getimagesize($path);
            if($imageSize[0]!="267" && $imageSize[1]!="178"){
                unlink($path);
                $notify[] = ['error', 'Please provide url of image with size 267px width and 178 px height.'];
                return back()->withNotify($notify);
            }
            //File::put($path , $data);
        }


        $job->user_id           = $user->id;
        $job->category_id       = $request->category_id;
        $job->subcategory_id    = $request->subcategory_id ?? 0;
        $job->job_proof         = $request->job_proof;
        $job->file_name         = $filename;
        $job->quantity          = $request->quantity;
        $job->vacancy_available = $request->quantity;
        $job->rate              = $request->rate;
        $job->total             = $jobAmount;
        $job->amount            = $jobAmount;
        $job->title             = $request->title;
        $job->description       = $purifier->purify($request->description);
        $job->status            = gs()->approve_job;
        $job->job_code          = getTrx();
        $job->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->amount       = $jobAmount;
        $transaction->post_balance = $user->balance;
        $transaction->trx_type     = '-';
        $transaction->details      = __("Job title") . ' ' . $job->title;
        $transaction->trx          = $job->job_code;
        $transaction->remark       = 'job_post';
        $transaction->save();

        $adminNotification            = new AdminNotification();
        $adminNotification->user_id   = $user->id;
        $adminNotification->title     = 'Money has been deducted for job posting';
        $adminNotification->click_url = urlPath('admin.jobs.index');
        $adminNotification->save();

        notify($user, 'JOB_POST_SUCCESSFULLY', [
            'quantity' => $request->quantity,
            'amount'   => showAmount($job->rate),
            'charge'   => showAmount($job->amount),
            'job_code' => $job->job_code,
        ]);

        $notify[] = ['success', 'Job created successfully'];
        return redirect()->route('user.job.history')->withNotify($notify);
    }

    public function edit($id)
    {
        $pageTitle  = 'Edit Job';
        $job        = JobPost::where('user_id', auth()->id())->findOrFail($id);
        $categories = Category::active()->orderBy('name')->with('subcategory')->get();
        $files      = FileType::active()->get();
        return view($this->activeTemplate . 'user.job.edit', compact('pageTitle', 'job', 'categories', 'files'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id'    => 'required',
            'subcategory_id' => 'nullable|integer|exists:sub_categories,id',
            'job_proof'      => 'required|in:1,2',
            'file_name'      => 'required_if:job_proof,2',
            'quantity'       => 'required|integer|gt:0',
            'rate'           => 'required|numeric|gt:0',
            'title'          => 'required|string|max:255',
            'description'    => 'required',
            'attachment'     => ['image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
        ]);

        $purifier = new \HTMLPurifier();
        $user     = auth()->user();
        $job      = JobPost::where('id', $id)->where('user_id', $user->id)->first();

        if ($job->status == Status::JOB_COMPLETED || $job->status == Status::JOB_REJECTED) {
            $notify[] = ['error', 'Sorry! your job will not editable'];
            return back()->withNotify($notify)->withInput();
        }

        $filename = '';

        if ($request->job_proof == Status::JOB_PROVE_REQUIRED) {

            $file = FileType::active()->whereIn('name', $request->file_name)->count();

            if ($file != count($request->file_name)) {
                $notify[] = ['error', 'Job proof file name is wrong'];
                return back()->withNotify($notify)->withInput();
            }

            $filename = implode(',', $request->file_name);
        }

        if ($request->hasFile('attachment')) {
            try {
                $old             = $job->attachment;
                $job->attachment = fileUploader($request->attachment, getFilePath('jobPoster'), getFileSize('jobPoster'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $newAmount  = null;
        $subBalance = null;

        if (!($job->quantity == $request->quantity && $job->rate == $request->rate)) {

            $oldPostBalance = $job->amount;
            $newAmount      = $request->rate * $request->quantity;

            if ($oldPostBalance > $newAmount) {
                $addBalance  = $oldPostBalance - $newAmount;
                $userBalance = $user->balance + $addBalance;
            }

            if ($oldPostBalance < $newAmount) {
                $subBalance  = $newAmount - $oldPostBalance;
                $userBalance = $user->balance - $subBalance;
            }

            if (@$subBalance && ($subBalance > $user->balance)) {
                $notify[] = ['error', 'You have no sufficient balance in your account'];
                return back()->withNotify($notify)->withInput();
            }

            $user->balance = $userBalance;
            $user->save();

            $job->quantity = $request->quantity;
            $job->rate     = $request->rate;
            $job->total    = $newAmount;
            $job->amount   = $newAmount;
        } else {
            $oldAmount = $job->amount;
        }

        $job->category_id       = $request->category_id;
        $job->subcategory_id    = $request->subcategory_id;
        $job->job_proof         = $request->job_proof;
        $job->file_name         = $filename;
        $job->quantity          = $request->quantity;
        $job->vacancy_available = $request->quantity;
        $job->rate              = $request->rate;
        $job->total             = $newAmount ?? $oldAmount;
        $job->amount            = $newAmount ?? $oldAmount;
        $job->title             = $request->title;
        $job->status            = gs()->approve_job;
        $job->description       = $purifier->purify($request->description);
        $job->save();

        if ($newAmount) {
            $transaction               = new Transaction();
            $transaction->user_id      = $user->id;
            $transaction->amount       = $addBalance ?? $subBalance;
            $transaction->post_balance = $user->balance;
            $transaction->trx_type     = $subBalance ? '-' : '+';
            $transaction->details      = __("Updated job") . ' ' . $job->title;
            $transaction->trx          = $job->job_code;
            $transaction->remark       = 'job_post';
            $transaction->save();
        }

        $adminNotification            = new AdminNotification();
        $adminNotification->user_id   = $user->id;
        $adminNotification->title     = 'User job updated';
        $adminNotification->click_url = urlPath('admin.jobs.index');
        $adminNotification->save();

        notify($user, 'JOB_UPDATE_SUCCESSFULLY', [
            'quantity' => showAmount($request->quantity),
            'amount'   => showAmount($job->rate),
            'charge'   => showAmount($job->amount),
            'job_code' => $job->job_code,
            'name'     => $user->name,
        ]);

        $notify[] = ['success', 'Job updated successfully'];
        return redirect()->route('user.job.history')->withNotify($notify);
    }

    public function prove(Request $request, $id)
    {

        $request->validate([
            'detail' => 'required',
            'attachment' => 'required_if:job_proof,2'
        ]);

        $user       = auth()->user();
        $job        = JobPost::approved()->where('user_id', '!=', $user->id)->where('id', $id)->firstOrFail();
        $existProve = JobProve::where('job_post_id', $job->id)->where('user_id', $user->id)->exists();

        if ($existProve) {
            $notify[] = ['error', 'You\'ve already submitted'];
            return back()->withNotify($notify)->withInput();
        }

        if ($job->vacancy_available <= 0) {
            $notify[] = ['error', 'Job already finished'];
            return back()->withNotify($notify);
        }

        $attachment = '';

        if ($job->job_proof == Status::JOB_PROVE_REQUIRED && ($request->attachment != null)) {
            $extension = $request->attachment->getClientOriginalExtension();
            $filename  = explode(',', $job->file_name);
            $result    = in_array($extension, $filename);

            if (!$result) {
                $notify[] = ['error', __('Job proof attachment will be') .' '. implode(",", $filename)];
                return back()->withNotify($notify)->withInput();
            }

            if ($request->hasFile('attachment')) {
                try {

                    $attachment = fileUploader($request->attachment, getFilePath('jobProve'));
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Couldn\'t upload your image'];
                    return back()->withNotify($notify);
                }
            }
        }

        $prove              = new JobProve();
        $prove->user_id     = $user->id;
        $prove->job_post_id = $job->id;
        $prove->detail      = $request->detail;
        $prove->attachment  = $attachment;
        $prove->save();

        $job_completed_by = route('profile.details', [$user->id, slug($user->username)]);

        $job->decrement('vacancy_available', 1);
        $job->save();

        notify($job->user, 'JOB_COMPLETED', [
            'job_completed_by'     => $job_completed_by,
            'job_code' => $job->job_code,
        ]);

        if ($job->vacancy_available == 0) {
            $job->status = Status::JOB_COMPLETED;
            $job->save();

            notify($user, 'JOB_PROOF_SUBMITTED', [
            'job_rate' => showAmount($job->rate),
            'job_code' => $job->job_code,
            ]);

            $notify[] = ['success', 'Your job proof request has been taken.'];
            return redirect()->route('job.list')->withNotify($notify);

        }
        else{
            notify($user, 'JOB_PROOF_SUBMITTED', [
            'job_rate' => showAmount($job->rate),
            'job_code' => $job->job_code,
            ]);

            $notify[] = ['success', 'Your job proof request has been taken.'];
            return back()->withNotify($notify);
        }


    }

    public function attachment($id)
    {
        $pageTitle = "Job Details";

        try {
            $id = decrypt($id);
        } catch (Exception $e) {
            $notify[] = ['error', 'Invalid URL.'];
            return back()->withNotify($notify);
        }
        $prove     = JobProve::where('id', $id)->WhereHas('job', function ($query) {
            $query->where('user_id', auth()->id());
        })->with(['job', 'user'])->firstOrFail();
        $prove->notification = Status::YES;
        $prove->save();

        return view($this->activeTemplate . 'user.job.attachment', compact('pageTitle', 'prove'));
    }


    public function rating($id)
    {
        $pageTitle = "User Job Rating";

        try {
            $id = decrypt($id);
        } catch (Exception $e) {
            $notify[] = ['error', 'Invalid URL.'];
            return back()->withNotify($notify);
        }

        $prove     = JobProve::where('id', $id)->with(['job', 'user'])->firstOrFail();

        return view($this->activeTemplate . 'user.job.rating', compact('pageTitle', 'prove'));
    }


    public function downloadAttachment($id)
    {
        try {
            $id = decrypt($id);
        } catch (Exception $e) {
            $notify[] = ['error', 'Invalid URL.'];
            return back()->withNotify($notify);
        }

        $attachment = JobProve::WhereHas('job', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($id);
        $path = getFilePath('jobProve') . '/' . $attachment->attachment;
        return response()->download($path);
    }

    public function approve($id)
    {
        try {
            $id = decrypt($id);
        } catch (Exception $e) {
            $notify[] = ['error', 'Invalid URL.'];
            return back()->withNotify($notify);
        }

        $jobProve = JobProve::where('id', $id)->WhereHas('job', function ($query) {
            $query->where('user_id', auth()->id());
        })->with('job', 'user')->pending()->firstOrFail();


        // if ($jobProve->job->vacancy_available <= 0) {
        //     $notify[] = ['error', 'Job vacancy already finished'];
        //     return back()->withNotify($notify);
        // }


        $job    = $jobProve->job;
        $amount = $job->rate;

        if ($job->amount < $amount) {
            $notify[] = ['error', 'You have no sufficient job amount.'];
            return back()->withNotify($notify);
        }

        $job->decrement('amount', $amount);
        $job->save();

        $settings = GeneralSetting::where("id",1)->first();
        $job_percentage = $settings->job_percentage;
        $percentageAmount = (($amount/100)*$job_percentage);

        if ($job->vacancy_available == 0) {
            $job->status = Status::JOB_COMPLETED;
            $job->save();

            $freelancer = $jobProve->user;
            $freelancer->balance += $amount;
            $freelancer->save();
            $referrer = "";
            $ref = Referral::where("user_id",$freelancer->id)->first();
            $referrer = $ref->referrer_id;
            if(!empty($referrer)){
                $refUser = User::where("id",$referrer)->first();
                $refUser->balance += $percentageAmount;
                $refUser->save();


                $transaction               = new Transaction();
                $transaction->user_id      = $refUser->id;
                $transaction->amount       = $percentageAmount;
                $transaction->post_balance = $refUser->balance;
                $transaction->charge       = 0;
                $transaction->trx_type     = '+';
                $transaction->remark       = "payment_receive";
                $transaction->details      = __('Payment By Job Post Completed by Referral');
                $transaction->trx          = $jobProve->job->job_code;
                $transaction->save();


                //contest points logic below
                // Jobs completed by the Referred user
                // $jobProve = JobProve::where('user_id', $freelancer->id)->where('status', 1)->where(MONTH('updated_at'), MONTH(CURRENT_DATE()))->where(YEAR('updated_at'), YEAR(CURRENT_DATE()))->get()->toArray();
                // echo "<pre>";
                // print_r($jobProve);
                // exit;

            }


            $transaction               = new Transaction();
            $transaction->user_id      = $freelancer->id;
            $transaction->amount       = $jobProve->job->rate;
            $transaction->post_balance = $freelancer->balance;
            $transaction->charge       = 0;
            $transaction->trx_type     = '+';
            $transaction->remark       = "payment_receive";
            $transaction->details      = __('Payment By') . auth()->user()->username;
            $transaction->trx          = $jobProve->job->job_code;
            $transaction->save();

            $jobProve->status = Status::JOB_PROVE_APPROVE;
            $jobProve->save();

            notify($freelancer, 'JOB_APPROVE_SUCCESSFULLY', [
                'payment_by'   => auth()->user()->username,
                'job_code'     => $jobProve->job->job_code,
                'amount'       => showAmount($job->rate),
                'post_balance' => showAmount($freelancer->balance),
            ]);

            // $job_completed_by = route('profile.details', [$freelancer->id, slug($freelancer->username)]);

            // notify(auth()->user(), 'JOB_COMPLETED', [
            //     'job_completed_by'     => $job_completed_by,
            //     'job_code'     => $jobProve->job->job_code,
            // ]);

            $notify[] = ['success', 'Job request approved successfully'];
             return redirect()->route('job.list')->withNotify($notify);
        }
        else{


            $freelancer = $jobProve->user;

            // $jobProve = JobProve::where('user_id', $freelancer->id)->where('status', 1)->whereBetween('updated_at',
            // [
            //     Carbon::now()->startOfMonth(),
            //     Carbon::now()->endOfMonth()
            // ])->get()->toArray();
            // echo "<pre>";
            // print_r($jobProve);
            // exit;

            $freelancer->balance += $amount;
            $freelancer->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $freelancer->id;
            $transaction->amount       = $jobProve->job->rate;
            $transaction->post_balance = $freelancer->balance;
            $transaction->charge       = 0;
            $transaction->trx_type     = '+';
            $transaction->remark       = "payment_receive";
            $transaction->details      = __('Payment By').' '. auth()->user()->username;
            $transaction->trx          = $jobProve->job->job_code;
            $transaction->save();

            $referrer = "";
            $ref = Referral::where("user_id",$freelancer->id)->first();
            $referrer = $ref->referrer_id;
            if(!empty($referrer)){
                $refUser = User::where("id",$referrer)->first();
                $refUser->balance += $percentageAmount;
                $refUser->save();


                $transaction               = new Transaction();
                $transaction->user_id      = $refUser->id;
                $transaction->amount       = $percentageAmount;
                $transaction->post_balance = $refUser->balance;
                $transaction->charge       = 0;
                $transaction->trx_type     = '+';
                $transaction->remark       = "payment_receive";
                $transaction->details      = __('Payment By Job Post Completed by Referral');
                $transaction->trx          = $jobProve->job->job_code;
                $transaction->save();
            }

            $jobProve->status = Status::JOB_PROVE_APPROVE;
            $jobProve->save();

            notify($freelancer, 'JOB_APPROVE_SUCCESSFULLY', [
                'payment_by'   => auth()->user()->username,
                'job_code'     => $jobProve->job->job_code,
                'amount'       => showAmount($job->rate),
                'post_balance' => showAmount($freelancer->balance),
            ]);

            // $job_completed_by = route('profile.details', [$freelancer->id, slug($freelancer->username)]);

            // notify(auth()->user(), 'JOB_COMPLETED', [
            //     'job_completed_by'     => $job_completed_by,
            //     'job_code'     => $jobProve->job->job_code,
            // ]);

            $notify[] = ['success', 'Job request approved successfully'];
            return redirect()->route('user.job.details', $job->id)->withNotify($notify);
        }


    }

    public function rejected($id)
    {
        try {
            $id = decrypt($id);
        } catch (Exception $e) {
            $notify[] = ['error', 'Invalid URL.'];
            return back()->withNotify($notify);
        }
        $jobProve = JobProve::where('id', $id)->WhereHas('job', function ($query) {
            $query->where('user_id', auth()->id());
        })->with('job', 'user')->firstOrFail();
        $job = $jobProve->job;

        if (!$job) {
            $notify[] = ['error', 'Job not found!'];
            return back()->withNotify($notify);
        }

        $jobProve->status = Status::JOB_PROVE_REJECT;
        $jobProve->save();

        $job->vacancy_available+=1;
        if($job->status==Status::JOB_COMPLETED){
            $job->status=Status::JOB_APPROVED;
        }
        $job->save();

        notify($jobProve->user, 'JOB_PROVE_REJECTED', [
            'rejected_by' => auth()->user()->username,
            'amount'    => showAmount($job->rate),
            'job_code'  => $job->job_code,
        ]);

        $notify[] = ['success', 'Job rejected successfully'];
        return back()->withNotify($notify);
    }

    public function finished()
    {
        $pageTitle = "Complete Job History";
        $jobs = $this->jobProve('approve');
        return view($this->activeTemplate . 'user.job.finished', compact('pageTitle', 'jobs'));
    }

    public function apply()
    {
        $pageTitle = "Apply Jobs";
        $jobs = $this->jobProve();
        return view($this->activeTemplate . 'user.job.finished', compact('pageTitle', 'jobs'));
    }

    public function history(Request $request)
    {
        $pageTitle = "Jobs History";
        $jobs      = JobPost::searchable(['job_code', 'title'])->where('user_id', auth()->id())->with('proves')->latest()->paginate(getPaginate());
        return view($this->activeTemplate . 'user.job.history', compact('pageTitle', 'jobs'));
    }

    protected function jobProve($scope = null)
    {

        if ($scope) {
            $jobProves = JobProve::$scope()->where('user_id', auth()->id());
        } else {
            $jobProves = JobProve::where('user_id', auth()->id());
        }
        return $jobProves->with(['job', 'job.user'])->orderBy('id', 'desc')->paginate(getPaginate());
    }

    public function status($id)
    {
        $job = JobPost::where('user_id', auth()->id())->where('id', $id)->firstOrFail();

        if ($job->status == Status::JOB_COMPLETED || $job->status == Status::JOB_REJECTED || $job->status == Status::JOB_PENDING) {
            $notify[] = ['success', 'Job status wrong'];
            return back()->withNotify($notify);
        }

        $job->status = $job->status == Status::JOB_APPROVED ? Status::JOB_PAUSE : Status::JOB_APPROVED;
        $job->save();
        $notify[] = ['success', 'Job status updated successfully'];
        return back()->withNotify($notify);
    }

    public function details($id)
    {
        $pageTitle = "Job Request Details";
        $job       = JobPost::where('id', $id)->where('user_id', auth()->id())->with('proves.user')->firstOrFail();
        return view($this->activeTemplate . 'user.job.details', compact('pageTitle', 'job'));
    }

    public function reviewStore(Request $request, $id){


        $request->validate([
            'user_rating' => 'required|integer',
            'review'  => 'required|string',
        ], [
            'user_rating.required' => 'Rating field is required',
            'review.required'  => 'Enter your review as your feedback value us alot.',
        ]);

        $user = auth()->user();

        $user_rating = $request->user_rating;
        $review  = $request->review;


        $prove     = JobProve::where('id', $id)->with(['job', 'user'])->firstOrFail();

        $rating = $prove->job->rating([
            'title' => 'Feedback by user:'. auth()->id(),
            'body' => $review,
            'customer_service_rating' => $user_rating,
            'quality_rating' => $user_rating,
            'friendly_rating' => $user_rating,
            'pricing_rating' => $user_rating,
            'rating' => $user_rating,
            'recommend' => 'Yes',
            'approved' => true, // This is optional and defaults to false
            'reviewrateable_id' => $id
        ], $user);

        $notify[] = ['success', 'Your review has been submitted Successfully'];
        return back()->withNotify($notify);
    }
}
