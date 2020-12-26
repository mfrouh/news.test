<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
   public function mainpage()
   {
    return ["mainarticles"=>$this->mainarticles(),"lastarticles"=>$this->lastarticles(),"mostreadarticles"=>$this->mostreadarticles()];
   }
   public static function mainarticles()
   {
    return Article::with(['views','tags','categories'])->publish()->orderD()->take(5)->get();
   }

   public static function lastarticles()
   {
    return  Article::with(['tags','categories'])->publish()->orderD()->take(5)->get();
   }

   public static function mostreadarticles()
   {
    return Article::with(['tags','categories'])->publish()->orderD()->take(5)->get();
   }
}
