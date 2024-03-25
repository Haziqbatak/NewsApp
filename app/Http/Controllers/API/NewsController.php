<?php

namespace App\Http\Controllers\API;

use App\Models\News;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    //
    public function index(){
        try {
            $news = News::latest()->get();
            return ResponseFormatter::success(
                $news,
                'Data List of News'
            );
        } catch(\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function show($id){
        try {
            //code...
            $news = News::findOrFail($id);
            return ResponseFormatter::success(
                $news,
                'Data berrhasil terlist'
            );
        } catch(\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
}
