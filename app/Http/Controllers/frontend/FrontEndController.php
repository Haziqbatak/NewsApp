<?php

namespace App\Http\Controllers\frontend;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontEndController extends Controller
{
    //

    public function index(){


        $category = Category::latest()->get();

        $slidebar = News::latest()->limit(3)->get();
        
        return view('frontend.news.index', compact('category', 'slidebar'));
    }

    public function detailNews($slug){
        $category = Category::latest()->get();

        $news = News::where('slug', $slug)->first();

        return view('frontend.news.detail', compact('category', 'news'));
    }

    public function detailCategory($slug){
        $category = Category::latest()->get();

        $detailCategory = News::where('slug', $slug)->first();

        $news = News::where('category_id', $detailCategory)->latest()->get();

        return view('frontend.news.detailCategory', compact('category', 'news', 'detailCategory'));
    }
}
