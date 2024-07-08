<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use Searchable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
