<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Contest;
use App\Models\ContestDetails;
use App\Models\JobProve;
use App\Models\JobPost;
use Carbon\Carbon;

class ContestController extends Controller
{

    public function home()
    {
        $pageTitle  = "Referral Contest";
        $user      = auth()->user();
        $user_id = $user->id;
        $contest_users = [];
        $leaderBoard = [];
        $contestHistory = [];
        $userPosition = 0;
        $contestHistoryDB   = Contest::where('contest_state', 0)->where('contest_type', 1)->where('winner_id','!=', 0)->get()->toArray();

        $activeContest   = Contest::where('contest_state', 1)->where('contest_type', 1)->get()->toArray();

        if(!empty($activeContest)){
            foreach($activeContest as $contest){
                $activeContestId = $contest["id"];
            }


            $contestDetails   = ContestDetails::where('contest_id', $activeContestId)->orderBy("points_earned","desc")->get()->toArray();
            foreach($contestDetails as $k => $contestDetail){
                $leaderBoard[$contestDetail["user_id"]] = array(
                    "user_id" => $contestDetail["user_id"],
                    "PointsEarned" => $contestDetail["points_earned"],
                    "Position" => $k+1);
                $contest_users[] = $contestDetail["user_id"];
            }

            if(in_array($user_id,$contest_users)){

            }
            else{
                $count = count($leaderBoard);
                if($count > 0){
                    $leaderBoard[$user_id] = array(
                        "user_id" => $user_id,
                        "PointsEarned" => 0,
                        "Position" => $count+1);
                }
            }

            if(isset($leaderBoard[$user_id])){
                $userPosition =  $leaderBoard[$user_id]["Position"];
            }
            else{
                $userPosition = 0;
            }
        }

        foreach($contestHistoryDB as $contest){
            $contestHistory[] = array(
                "Month" => $contest["contest_month"],
                "user_id" => $contest["winner_id"],
                "Prize" => $contest["contest_prize"]);
        }
        return view($this->activeTemplate . 'contest.home', compact('pageTitle','leaderBoard','contestHistory',"userPosition","activeContest"));

    }

    public function makingJobs()
    {
        $pageTitle  = "Making Jobs Contest";
        $user      = auth()->user();
        $user_id = $user->id;
        $contest_users = [];
        $leaderBoard = [];
        $contestHistory = [];
        $userPosition = 0;
        $contestHistoryDB   = Contest::where('contest_state', 0)->where('contest_type', 3)->where('winner_id','!=', 0)->get()->toArray();

        $activeContest   = Contest::where('contest_state', 1)->where('contest_type', 3)->get()->toArray();

        if(!empty($activeContest)){


            $jobsDetails = DB::table('job_proves')
                 ->select('user_id', DB::raw('count(*) as totalJobs'))
                 ->where('status',1)
                 ->whereBetween('created_at',
                [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
                ])
                 ->groupBy('user_id')
                 ->orderBy('totalJobs','desc')
                 ->get();

            foreach($jobsDetails as $k => $jobs){
                if($k < 5){
                    $leaderBoard[$jobs->user_id] = array(
                        "user_id" => $jobs->user_id,
                        "jobsDone" => $jobs->totalJobs,
                        "Position" => $k+1);
                    $contest_users[] = $jobs->user_id;
                }
            }


            foreach($jobsDetails as $k => $jobs){
                $globalBoard[$jobs->user_id] = array(
                    "user_id" => $jobs->user_id,
                    "jobsDone" => $jobs->totalJobs,
                    "Position" => $k+1);
            }

            if(isset($globalBoard[$user_id])){
                $userPosition =  $globalBoard[$user_id]["Position"];
            }
            else{
                $userPosition = 0;
            }
        }

        foreach($contestHistoryDB as $contest){
            $contestHistory[] = array(
                "Month" => $contest["contest_month"],
                "user_id" => $contest["winner_id"],
                "Prize" => $contest["contest_prize"]);
        }
        return view($this->activeTemplate . 'contest.makingJobs', compact('pageTitle','leaderBoard','contestHistory',"userPosition","activeContest"));

    }

    public function addingJobs()
    {
        $pageTitle  = "Adding Jobs Contest";
        $user      = auth()->user();
        $user_id = $user->id;
        $contest_users = [];
        $leaderBoard = [];
        $contestHistory = [];
        $usersArr = [];
        $userPosition = 0;
        $contestHistoryDB   = Contest::where('contest_state', 0)->where('contest_type', 2)->where('winner_id','!=', 0)->get()->toArray();

        $activeContest   = Contest::where('contest_state', 1)->where('contest_type', 2)->get()->toArray();

        if(!empty($activeContest)){

            $jobsDetails = DB::table('job_posts')
                 ->select('user_id','id as job_post_id')
                 ->where('job_block_status',0)
                 ->whereBetween('created_at',
                [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
                ])
                 ->get();


            foreach($jobsDetails as $k => $jobs){
                $usersArr[$jobs->user_id][] = $jobs->job_post_id;
            }
            $count = 0;
            foreach($usersArr as $job_user_id => $jobusers){
                //dd($jobusers);
                $jobsProves = DB::table('job_proves')
                 ->select(DB::raw('count(*) as completedJobs'))
                 ->where('status',1)
                 ->whereIn('job_post_id',$jobusers)
                 ->whereBetween('created_at',
                [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
                ])
                 ->get();
                foreach($jobsProves as $jobProve){
                    if($jobProve->completedJobs > 9){
                        $leaderBoard[] = array(
                            "user_id" => $job_user_id,
                            "jobs_added" => count($jobusers),
                            "completed_jobs" => $jobProve->completedJobs,
                        );
                        $contest_users[] = $job_user_id;
                    }
                }
            }

            $leaderBoard = collect($leaderBoard)->sortBy('completed_jobs')->reverse()->toArray();

            //dd($leaderBoard);

            if(in_array($user_id,$contest_users)){
                foreach($leaderBoard as $k => $leaderData){
                    if($leaderData["user_id"] == $user_id){
                        $userPosition =  $k+1;
                    }
                }
            }
            else{
                $userPosition =  0;
            }

        }

        foreach($contestHistoryDB as $contest){
            $contestHistory[] = array(
                "Month" => $contest["contest_month"],
                "user_id" => $contest["winner_id"],
                "Prize" => $contest["contest_prize"]);
        }
        return view($this->activeTemplate . 'contest.addingJobs', compact('pageTitle','leaderBoard','contestHistory',"userPosition","activeContest"));

    }

    Public function contestWinner(){

        $winner_id = 0;
        $winner_id2 = 0;
        $winner_id3 = 0;

        $activeContest   = Contest::where('contest_state', 1)->where('contest_type', 1)->get()->toArray();

        if(!empty($activeContest)){

            $jobsDetails = DB::table('job_proves')
                 ->select('user_id', DB::raw('count(*) as totalJobs'))
                 ->where('status',1)
                 ->whereBetween('created_at',
                [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
                ])
                 ->groupBy('user_id')
                 ->orderBy('totalJobs','desc')
                 ->get();

            foreach($jobsDetails as $k => $jobs){
                if($k == 0){
                    $winner_id2 = $jobs->user_id;
                }
            }

            $activeContest2   = Contest::where('contest_state', 1)->where('contest_type', 2)->firstOrFail();
            $activeContest2->winner_id = $winner_id2;
            $activeContest2->contest_state = 0;
            $activeContest2->save();

            $newContest2 = new Contest();
            $newContest2->contest_name = $activeContest2->contest_name;
            $newContest2->contest_month = $activeContest2->contest_month;
            $newContest2->contest_prize = $activeContest2->contest_prize;
            $newContest2->friend_task_added = $activeContest2->friend_task_added;
            $newContest2->friend_task_completed = $activeContest2->friend_task_completed;
            $newContest2->winner_id = 0;
            $newContest2->contest_state = 1;
            $newContest2->contest_type = 2;
            $newContest2->save();





            $jobsDetails = DB::table('job_posts')
                 ->select('user_id','id as job_post_id')
                 ->where('job_block_status',0)
                 ->whereBetween('created_at',
                [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
                ])
                 ->get();


            foreach($jobsDetails as $k => $jobs){
                $usersArr[$jobs->user_id][] = $jobs->job_post_id;
            }

            foreach($usersArr as $job_user_id => $jobusers){
                //dd($jobusers);
                $jobsProves = DB::table('job_proves')
                 ->select(DB::raw('count(*) as completedJobs'))
                 ->where('status',1)
                 ->whereIn('job_post_id',$jobusers)
                 ->whereBetween('created_at',
                [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
                ])
                 ->get();
                foreach($jobsProves as $jobProve){
                    if($jobProve->completedJobs > 9){
                        $leaderBoard[] = array(
                            "user_id" => $job_user_id,
                            "jobs_added" => count($jobusers),
                            "completed_jobs" => $jobProve->completedJobs,
                        );
                        $contest_users[] = $job_user_id;
                    }
                }
            }

            $leaderBoard = collect($leaderBoard)->sortBy('completed_jobs')->reverse()->toArray();
            foreach($leaderBoard as $k => $leaderData){
                if($k=0){
                    $winner_id3 = $leaderData["user_id"];
                }
            }

            $activeContest3   = Contest::where('contest_state', 1)->where('contest_type', 3)->firstOrFail();
            $activeContest3->winner_id = $winner_id3;
            $activeContest3->contest_state = 0;
            $activeContest3->save();

            $newContest3 = new Contest();
            $newContest3->contest_name = $activeContest3->contest_name;
            $newContest3->contest_month = $activeContest3->contest_month;
            $newContest3->contest_prize = $activeContest3->contest_prize;
            $newContest3->friend_task_added = $activeContest3->friend_task_added;
            $newContest3->friend_task_completed = $activeContest3->friend_task_completed;
            $newContest3->winner_id = 0;
            $newContest3->contest_state = 1;
            $newContest3->contest_type = 3;
            $newContest3->save();



            foreach($activeContest as $contest){
                $activeContestId = $contest["id"];
                $activeContestName = $contest["contest_name"];
                $activeContestMonth = $contest["contest_month"];
                $activeContestState = $contest["contest_state"];
                $activeContestType = $contest["contest_type"];
                $activeContestPrize = $contest["contest_prize"];
                $activeContestTaskAdded = $contest["friend_task_added"];
                $activeContestTaskCompleted = $contest["friend_task_completed"];
            }


            $contestDetails   = ContestDetails::where('contest_id', $activeContestId)->orderBy("points_earned","desc")->get()->toArray();
            foreach($contestDetails as $k => $contestDetail){
                if($k == 0){
                    $winner_id = $contestDetail["user_id"];
                }
            }


            $activeContest   = Contest::where('contest_state', 1)->where('contest_type', 1)->firstOrFail();
            $activeContest->winner_id = $winner_id;
            $activeContest->contest_state = 0;
            $activeContest->save();

            $newContest = new Contest();
            $newContest->contest_name = $activeContestName;
            $newContest->contest_month = $activeContestMonth;
            $newContest->contest_prize = $activeContestPrize;
            $newContest->friend_task_added = $activeContestTaskAdded;
            $newContest->friend_task_completed = $activeContestTaskCompleted;
            $newContest->winner_id = 0;
            $newContest->contest_state = 1;
            $newContest->contest_type = 1;
            $newContest->save();

        }

    }
}
