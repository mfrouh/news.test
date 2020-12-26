<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class CategoryPageController extends Controller
{
    public function category($name)
    {
        return Article::whereHas('categories',function($q) use($name){
            $q->where('name',$name);
          })->publish()->orderD()->paginate(9);
    }
}
