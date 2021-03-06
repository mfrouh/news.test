<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVoted extends Model
{
    use HasFactory;

    public function vote()
    {
        return $this->belongsTo('App\Models\Vote');
    }
}
