<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable=['question','category_id'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function options()
    {
        return $this->hasMany('App\Models\Option');
    }
}
