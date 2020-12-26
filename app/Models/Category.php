<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    protected $fillable=['name','image','status','slug'];

    protected $hidden=['created_at','updated_at'];

    public function votes()
    {
        return $this->hasMany('App\Models\Vote');
    }
    public function articles()
    {
    return $this->belongsToMany('App\Models\Article','article_category','category_id','article_id');
    }
    public function user()
    {
       return $this->belongsTo(User::class);
    }
    public function users()
    {
    return $this->belongsToMany('App\Models\User','user_category','category_id','user_id');
    }
    public function ScopeActive($q)
    {
     return  $q->where('status','active');
    }
    public function ScopeInActive($q)
    {
      return  $q->where('status','inactive');
    }
    public function getstatus()
    {
      return  $this->status=="active"?'مفعل':'مغلق';
    }
    // public function setSlugAttribute()
    // {
    //   return $this->slug=slug($this->name);
    // }
    // public function getSlugAttribute()
    // {
    //   return $this->slug;
    // }

}
