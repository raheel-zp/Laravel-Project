<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\Searchable;
use App\Traits\Referrable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    use HasApiTokens, Searchable, Referrable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'ver_code',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'address'           => 'object',
        'ver_code_send_at'  => 'datetime',
        'kyc_data'          => 'object',

    ];


    public function loginLogs()
    {
        return $this->hasMany(UserLogin::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class)->orderBy('id', 'desc');
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class)->where('status', '!=', Status::PAYMENT_INITIATE);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class)->where('status', '!=', Status::PAYMENT_INITIATE);
    }

    public function fullname(): Attribute
    {
        return new Attribute(
            get: fn () => $this->firstname . ' ' . $this->lastname,
        );
    }

    // SCOPES
    public function scopeActive($query)
    {
        return $query->where('status', Status::USER_ACTIVE)->where('ev', Status::VERIFIED)->where('sv', Status::VERIFIED);
    }

    public function scopeBanned($query)
    {
        return $query->where('status', Status::USER_BAN);
    }

    public function scopeBlocked($query)
    {
        return $query->where('block_status', Status::USER_BLOCK);
    }

    public function scopeExecutionBlocked($query)
    {
        return $query->where('block_execution_status', 1);
    }


    public function scopeEmailUnverified($query)
    {
        return $query->where('ev', Status::NO);
    }

    public function scopeMobileUnverified($query)
    {
        return $query->where('sv', Status::NO);
    }



    public function scopeEmailVerified($query)
    {
        return $query->where('ev', Status::VERIFIED);
    }

    public function scopeMobileVerified($query)
    {
        return $query->where('sv', Status::VERIFIED);
    }

    public function scopeWithBalance($query)
    {
        return $query->where('balance', '>', 0);
    }

    public function jobs()
    {
        return $this->hasMany(JobPost::class);
    }


    public function pending()
    {
        return $this->hasMany(JobPost::class)->where('status', Status::JOB_PENDING);
    }

    public function approved()
    {
        return $this->hasMany(JobPost::class)->where('status', Status::JOB_APPROVED);
    }

    public function completed()
    {
        return $this->hasMany(JobPost::class)->where('status', Status::JOB_COMPLETED);
    }

    public function pause()
    {
        return $this->hasMany(JobPost::class)->where('status', Status::JOB_PAUSE);
    }

    public function rejected()
    {
        return $this->hasMany(JobPost::class)->where('status', Status::JOB_REJECTED);
    }

    public function calculateRating($userId)
    {
        $averageRating = DB::table('users')
            ->selectRaw('(SELECT AVG(r.rating) 
                            FROM job_posts jpo
                            JOIN job_proves jpr ON jpo.id = jpr.job_post_id
                            JOIN reviews r ON jpr.id = r.reviewrateable_id AND jpo.id = r.job_post_id
                            WHERE jpo.user_id = ? AND r.author_id != ?) AS job_post_reviews_rating,
                        (SELECT AVG(r.rating) 
                          FROM job_posts jpo
                          JOIN job_proves jpr ON jpo.id = jpr.job_post_id
                          JOIN reviews r ON jpr.id = r.reviewrateable_id AND jpo.id = r.job_post_id
                          WHERE jpr.user_id = ? AND r.author_id != ?) AS job_completed_reviews_rating', [$userId, $userId, $userId, $userId])
            ->first();

        if ( $averageRating->job_post_reviews_rating > 0 && $averageRating->job_completed_reviews_rating > 0)
            return (($averageRating->job_post_reviews_rating + $averageRating->job_completed_reviews_rating)/2);
        else if ( $averageRating->job_post_reviews_rating > 0 && $averageRating->job_completed_reviews_rating <= 0)
            return $averageRating->job_post_reviews_rating;
        else if ( $averageRating->job_post_reviews_rating <= 0 && $averageRating->job_completed_reviews_rating > 0)
            return $averageRating->job_completed_reviews_rating;

        return 0;
    }


    public function getUserJobsWithRating($user_id, $rating_filter, $reviews_filter) {

        $JobIds = array();

        $rating_check = "";
        $review_check = "(job_posts.user_id = :user_id_1 OR job_proves.user_id = :user_id_2)";

        $filter_array = ['user_id_1' => $user_id, 'user_id_2' => $user_id];

        if ( $rating_filter != "" && $rating_filter > 0 )
        {
            $rating_check = "AND reviews.rating  = :rating";
            $filter_array = ['user_id_1' => $user_id, 'user_id_2' => $user_id, 'rating' => $rating_filter];
        }

        if ( $reviews_filter != "" && $reviews_filter > 0 )
        {
            if ( $rating_check != "") {

                if ($reviews_filter == 1)
                {
                    $review_check = "(job_proves.user_id = :user_id_2)";
                    $filter_array = ['user_id_2' => $user_id, 'rating' => $rating_filter];
                }
                else  if ($reviews_filter == 2)
                {
                    $review_check = "(job_posts.user_id = :user_id_1)";
                    $filter_array = ['user_id_1' => $user_id, 'rating' => $rating_filter];
                }
            }
            else {

                if ($reviews_filter == 1)
                {
                    $review_check = "(job_proves.user_id = :user_id_2)";
                    $filter_array = ['user_id_2' => $user_id];
                }
                else  if ($reviews_filter == 2)
                {
                    $review_check = "(job_posts.user_id = :user_id_1)";
                    $filter_array = ['user_id_1' => $user_id];
                }

            }
           
        }

        $query = "
            SELECT job_posts.*
            FROM job_posts
            INNER JOIN job_proves ON job_posts.id = job_proves.job_post_id
            INNER JOIN reviews ON job_proves.id = reviews.reviewrateable_id AND job_posts.id = reviews.job_post_id
            WHERE $review_check $rating_check
            ORDER BY job_posts.created_at DESC
        ";

        $userJobs = DB::select(DB::raw($query), $filter_array);

        // Print the query to the logs
        //\Log::info("Query: $query, Bindings: " . json_encode($filter_array));

        // Print the query to the browser
       // echo "Query: $query, Bindings: " . json_encode($filter_array);

        $JobIds = collect($userJobs)->pluck('id');

        return $JobIds;

        //dd($userJobs);
    }
}
