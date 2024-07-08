<?php

namespace App\Models;

use App\Contracts\ReviewRateable;
use App\Traits\ReviewRateable as ReviewRateableTrait;
use App\Constants\Status;
use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model implements ReviewRateable
{
    use GlobalStatus, Searchable, ReviewRateableTrait;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function proves()
    {
        return $this->hasMany(JobProve::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', Status::JOB_PENDING);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', Status::JOB_APPROVED);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', Status::JOB_COMPLETED);
    }

    public function scopePause($query)
    {
        return $query->where('status', Status::JOB_PAUSE);
    }

    public function scopeRejected($query)
    {
        return $query->where('status', Status::JOB_REJECTED);
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }

    public function statusJob(): Attribute
    {
        return new Attribute(function () {
            $html = '';
            if ($this->job_block_status == 1) {
                $html = '<span class="badge badge--danger">' . trans('Blocked') . '</span>';
            }
            else if ($this->status == Status::JOB_PENDING) {
                $html = '<span class="badge badge--warning">' . trans('Pending') . '</span>';
            } elseif ($this->status == Status::JOB_APPROVED) {
                $html = '<span class="badge badge--primary">' . trans('Approved') . '</span>';
            } elseif ($this->status == Status::JOB_COMPLETED) {
                $html = '<span class="badge badge--success">' . trans('Completed') . '</span>';
            } elseif ($this->status == Status::JOB_PAUSE) {
                $html = '<span class="badge badge--dark">' . trans('Paused') . '</span>';
            } else {
                $html =  '<span class="badge badge--danger">' . trans('Rejected') . '</span>';
            }
            return $html;
        });
    }


    public function hiddenJob(): Attribute
    {
        return new Attribute(function () {
            $html = '';
            if ($this->is_hidden == Status::YES) {
                $html = '<span class="badge badge--warning">' . trans('Hide') . '</span>';
            } else {
                $html =  '<span class="badge badge--success">' . trans('Show') . '</span>';
            }
            return $html;
        });
    }
}
