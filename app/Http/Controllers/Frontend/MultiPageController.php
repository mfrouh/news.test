<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class MultiPageController extends Controller
{
    public function tag($name)
    {
        return Article::whereHas('tags',function($q) use($name){
          $q->where('name',$name);
        })->publish()->orderD()->paginate(9);
    }

    public function search($search)
    {
     return
     $articles=Article::ORwhere('title',"like",'%'.$search.'%')
      ->ORwhereDate('publish_time',$search)
      ->ORwhereHas('tags',function($q) use($search)
      {
         $q->where('name',"like",'%'.$search.'%');
      })
      ->ORwhereHas('categories',function($u) use($search)
      {
        $u->where('name','like','%'.$search.'%');
      })
      ->publish()->orderD()->paginate(9);
    }

    public function writer($name)
    {
          return Article::whereHas('user',function($q) use($name){
            $q->where('name',$name);
          })->publish()->orderD()->paginate(9);
    }

    public function date($name)
    {
        return $articles=Article::whereDate('publish_time',$name)->publish()->orderD()->paginate(9);
    }

}
