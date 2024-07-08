<?php

namespace App\Http\Controllers;
use App\Models\Dispute;
use App\Models\DisputeDetail;
use App\Models\User;
use App\Models\JobProve;
use App\Models\JobPost;
use App\Models\GeneralSetting;
use App\Models\Referral;
use App\Models\Transaction;
use App\Constants\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class DisputeController extends Controller
{

    public function index($prove_id)
    {
        $pageTitle = "Dispute Page";
        $user = auth()->user();
        $user_id = $user->id;

        $dispute = Dispute::where('job_prove_id', $prove_id)->get()->toArray();
        if(!empty($dispute)){
            $dispute_id    = $dispute[0]["id"];
            return redirect()->route('dispute.disputeDetails', $dispute_id);
        }

        $jobprove = JobProve::where('id', $prove_id)->get()->toArray();
        $prove_user_id = $jobprove[0]["user_id"];
        if($user_id!=$prove_user_id){
            $notify[] = ['error', 'You are not authorize to dispute this work review.'];
            return back()->withNotify($notify);
        }

        return view($this->activeTemplate . 'dispute.index', compact('pageTitle', 'prove_id'));

    }

    public function create(Request $request)
    {
        $user      = auth()->user();
        $user_id = $user->id;

        $jobprove  = JobProve::where('id', $request->job_prove_id)->get()->toArray();
        $job_id = $jobprove[0]["job_post_id"];

        $job = JobPost::where('id', $job_id)->first();


        $dispute           = new Dispute();
        $dispute->job_prove_id     = $request->job_prove_id;
        $dispute->disputer_id     = $user_id;
        $dispute->job_poster_id     = $job->user_id;
        $dispute->state    = 1;
        $dispute->save();
        $dispute_id = $dispute->id;

        $disputeDetail           = new DisputeDetail();
        $disputeDetail->dispute_id     = $dispute_id;
        $disputeDetail->from_user    = $user_id;
        $disputeDetail->message    = $request->message;

        if ($request->hasFile('attachment')) {
            try {
                $old="";
                $disputeDetail->attachment = fileUploader($request->attachment, getFilePath('jobPoster'), getFileSize('jobPoster'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your file'];
                return back()->withNotify($notify);
            }
        }

        $disputeDetail->save();

        //$dispute_created_by = route('profile.details', [$user->id, slug($user->username)]);
        $dispute_detail_url = route('dispute.disputeDetails', $dispute_id);
        // notify($job->user, 'DISPUTE_CREATED', [
        //     'dispute_created_by'     => $user->username,
        //     'dispute_detail_url' => $dispute_detail_url,
        // ]);

        $notify[] = ['success', 'Dispute created successfully!'];
        return redirect()->route('dispute.disputeDetails', $dispute_id)->withNotify($notify);

    }

    public function addMessage(Request $request)
    {
        $user      = auth()->user();
        $user_id = $user->id;

        $dispute           = Dispute::where('id', $request->dispute_id)->get()->toArray();
        if(!empty($dispute)){
            $job_prove_id    = $dispute[0]["job_prove_id"];
            $disputer_id    = $dispute[0]["disputer_id"];
            $job_poster_id    = $dispute[0]["job_poster_id"];
        }


        $jobproves  = JobProve::where('id', $job_prove_id)->first();

        $jobprove  = JobProve::where('id', $job_prove_id)->get()->toArray();
        $job_id = $jobprove[0]["job_post_id"];

        $job = JobPost::where('id', $job_id)->get()->toArray();

        $jobs = JobPost::where('id', $job_id)->first();

        if($user_id == $job[0]["user_id"]){
            $dispute_detail_url = route('dispute.disputeDetails', $request->dispute_id);
            // notify($jobproves->user, 'DISPUTE_CHAT', [
            //     'message_sent_by'     => $user->username,
            //     'dispute_detail_url' => $dispute_detail_url,
            // ]);
        }
        else{
            $dispute_detail_url = route('dispute.disputeDetails', $request->dispute_id);
            // notify($jobs->user, 'DISPUTE_CHAT', [
            //     'message_sent_by'     => $user->username,
            //     'dispute_detail_url' => $dispute_detail_url,
            // ]);
        }


        $disputeDetail           = new DisputeDetail();
        $disputeDetail->dispute_id     = $request->dispute_id;
        $disputeDetail->from_user    = $user_id;
        $disputeDetail->message    = $request->message;

        if ($request->hasFile('attachment')) {
            try {
                $old="";
                $disputeDetail->attachment = fileUploader($request->attachment, getFilePath('jobPoster'), getFileSize('jobPoster'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your file'];
                return back()->withNotify($notify);
            }
        }

        $disputeDetail->save();



        $notify[] = ['success', 'Message sent successfully!'];
        return redirect()->route('dispute.disputeDetails', $request->dispute_id)->withNotify($notify);

    }

    public function resolveDispute(Request $request)
    {
        $user      = auth()->user();
        $user_id = $user->id;

        $disputeDetail = Dispute::where('id', $request->dispute_id)->firstOrFail();
        $disputeDetail->state     = 2;
        $disputeDetail->resolved_by     = $user_id;
        $disputeDetail->save();

        $notify[] = ['success', 'Dispute Resolved successfully!'];
        return redirect()->route('dispute.disputeApprove', $request->job_prove_id)->withNotify($notify);

    }

    public function adminHelp(Request $request)
    {
        $user      = auth()->user();
        $user_id = $user->id;

        $disputeDetail = Dispute::where('id', $request->dispute_id)->firstOrFail();
        $disputeDetail->admin_help     = 1;
        $disputeDetail->save();

        $notify[] = ['success', 'Your Request to Resolve Dispute is send to Admin!'];
        return redirect()->route('user.job.apply', $request->job_prove_id)->withNotify($notify);

    }

    public function disputeDetails($id){

        $dispute_id = $id;
        $user      = auth()->user();
        $user_id = $user->id;

        $pageTitle                         = "Dispute Detail";
        $dispute  = Dispute::where('id', $id)->get()->toArray();
        $job_prove_id = $dispute[0]["job_prove_id"];
        $disputer_id = $dispute[0]["disputer_id"];

        $jobprove  = JobProve::where('id', $job_prove_id)->get()->toArray();
        $job_id = $jobprove[0]["job_post_id"];

        $prove = JobPost::where('id', $job_id)->get()->toArray();

        $disputeDetails   = DisputeDetail::where('dispute_id', $id)->orderBy("id","DESC")->get()->toArray();
        return view($this->activeTemplate . 'dispute.view', compact('pageTitle', 'disputeDetails','prove','dispute_id','user_id','disputer_id','job_prove_id'));
    }

    public function disputeApprove($id) {

        $jobProve = JobProve::where('id', $id)->WhereHas('job', function ($query) {
            $query->where('user_id', auth()->id());
        })->with('job', 'user')->firstOrFail();

        $job    = $jobProve->job;
        $amount = $job->rate;

        if ($job->amount < $amount) {
            $notify[] = ['error', 'You have no sufficient job amount.'];
            return back()->withNotify($notify);
        }

        $job->decrement('amount', $amount);
        $job->decrement('vacancy_available', 1);
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
            if ($ref) {
                $referrer = $ref->referrer_id;
            }
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
            if ($ref) {
                $referrer = $ref->referrer_id;
            }
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
}
