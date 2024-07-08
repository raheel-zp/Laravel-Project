<?php

namespace App\Http\Controllers\Admin;

use PDO;
use Exception;
use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\JobProve;
use App\Models\JobPost;
use App\Models\Referral;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Category;
use App\Models\Dispute;
use App\Models\DisputeDetail;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use App\Models\AdminNotification;



class ManageDisputesController extends Controller
{
	public function index()
	{
		$pageTitle = "All Active Disputes";
        $disputes      = $this->disputeData();
        //$disputes = Dispute::where('admin_help', 1)->get();
        //dd($disputes);
		return view('admin.disputes.index', compact('pageTitle', 'disputes'));
	}

    protected function disputeData($scope = null)
    {
        if ($scope) {
            $users = Dispute::$scope();
        } else {
            $users = Dispute::where('admin_help', 1);
        }
        return $users->orderBy('id', 'desc')->paginate(getPaginate());
    }

	public function details($id)
	{
		$dispute_id = $id;
        $pageTitle                         = "Dispute Detail";
        $dispute  = Dispute::where('id', $id)->get()->toArray();
        $job_prove_id = $dispute[0]["job_prove_id"];

        $jobprove  = JobProve::where('id', $job_prove_id)->get()->toArray();
        $job_id = $jobprove[0]["job_post_id"];

        $prove = JobPost::where('id', $job_id)->get()->toArray();

        $disputeDetails   = DisputeDetail::where('dispute_id', $id)->orderBy("id","DESC")->get()->toArray();
        return view('admin.disputes.details', compact('pageTitle', 'disputeDetails','prove','dispute_id','job_prove_id'));
	}

    public function resolve(Request $request)
    {

        $dispute = Dispute::where('id', $request->dispute_id)->firstOrFail();
        $dispute->state     = 2;
        $dispute->resolved_by     = 0;
        $dispute->admin_help     = 0;
        $dispute->save();

        $notify[] = ['success', 'Dispute Resolved successfully!'];
        return redirect()->route('admin.disputes.disputeApprove', $request->job_prove_id)->withNotify($notify);

    }

    public function disputeMessage(Request $request)
    {

        $disputeDetail           = new DisputeDetail();
        $disputeDetail->dispute_id     = $request->dispute_id;
        $disputeDetail->from_user    = 0;
        $disputeDetail->message    = $request->message;
        $disputeDetail->save();

        $notify[] = ['success', 'Message sent successfully!'];
        return redirect()->route('admin.disputes.details', $request->dispute_id)->withNotify($notify);

    }

    public function disputeApprove($id) {

        $jobProve = JobProve::where('id', $id)->firstOrFail();
        $job_id = $jobProve->job_post_id;
        $job = JobPost::where('id', $job_id)->firstOrFail();

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
            }


            $transaction               = new Transaction();
            $transaction->user_id      = $freelancer->id;
            $transaction->amount       = $jobProve->job->rate;
            $transaction->post_balance = $freelancer->balance;
            $transaction->charge       = 0;
            $transaction->trx_type     = '+';
            $transaction->remark       = "payment_receive";
            $transaction->details      = __('Dispute Approve by Admin');
            $transaction->trx          = $jobProve->job->job_code;
            $transaction->save();

            $jobProve->status = Status::JOB_PROVE_APPROVE;
            $jobProve->save();

            notify($freelancer, 'JOB_APPROVE_SUCCESSFULLY', [
                'payment_by'   => "admin approved dispute",
                'job_code'     => $jobProve->job->job_code,
                'amount'       => showAmount($job->rate),
                'post_balance' => showAmount($freelancer->balance),
            ]);

            $notify[] = ['success', 'Dispute approved successfully'];
             return redirect()->route('admin.disputes.index')->withNotify($notify);
        }
        else{
            $freelancer = $jobProve->user;
            $freelancer->balance += $amount;
            $freelancer->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $freelancer->id;
            $transaction->amount       = $jobProve->job->rate;
            $transaction->post_balance = $freelancer->balance;
            $transaction->charge       = 0;
            $transaction->trx_type     = '+';
            $transaction->remark       = "payment_receive";
            $transaction->details      = __('Dispute Approve by Admin');
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
                'payment_by'   => "Admin approved dispute",
                'job_code'     => $jobProve->job->job_code,
                'amount'       => showAmount($job->rate),
                'post_balance' => showAmount($freelancer->balance),
            ]);

            $notify[] = ['success', 'Dispute approved successfully'];
            return redirect()->route('admin.disputes.index')->withNotify($notify);
        }


    }

}
