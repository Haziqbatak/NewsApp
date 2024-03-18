<?php

namespace App\Http\Controllers\frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;

class FrontEndController extends Controller
{
    //

    public function index(){


        $category = Category::latest()->get();

        $slidebar = News::latest()->limit(3)->get();
        
        return view('frontend.news.index', compact('category', 'slidebar'));
    }
}
