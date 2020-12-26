<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable=['title','slug','image','status','content','user_id'];

    protected $hidden=['created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class,'article_category','article_id','category_id');
    }
    public function views()
    {
      return $this->hasMany(ArticleView::class);
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
    public function ScopeOrderD($q)
    {
        return  $q->orderby('publish_time','desc');
    }
    public function ScopeOrderA($q)
    {
        return  $q->orderby('publish_time','asc');
    }
    public function getstatus()
    {
      return  $this->status=="publish"?'نشر':'لم ينشر';
    }
}
