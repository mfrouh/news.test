<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable=['title','slug','image','status','content','user_id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class,'article_category','article_id','category_id');
    }
    public function gallery()
    {
        return $this->morphMany(Image::class, 'imageable')->pluck('url');
    }
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
    public function ScopePublish($q)
    {
        return   $q->where('status','publish');
    }
    public function ScopeUnpublish($q)
    {
        return  $q->where('status','unpublish');
    }
    public function getstatus()
    {
      return  $this->status=="publish"?'نشر':'لم ينشر';
    }
}
