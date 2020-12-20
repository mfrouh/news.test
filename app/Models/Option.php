<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable=['vote_id','name'];

    public function vote()
    {
        return $this->belongsTo('App\Models\Vote');
    }
}
