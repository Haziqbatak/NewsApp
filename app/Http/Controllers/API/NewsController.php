<?php

namespace App\Http\Controllers\API;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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

    public function store(Request $request){
        try {
            $this->validate($request, [
                'title' => 'required',
                'category_id' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1000000',
                'content' => 'required'
            ]);

            $image = $request->file('image');
            $image->storeAs('public/news', $image->hashName());

            $news = News::create([
                'title' => $request->category_id,
                'slug' => Str::slug($request->title),
                'category_id' => $request->category_id,
                'content' => $request->content,
                'image' => $image->hashName()
            ]);
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something Went Wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function destroy($id)
    {
        try {
            //get data by id
            $news = News::find($id);

            // delete image
            Storage::disk('local')->delete('public/news/' . basename($news->image));

            // delete data by id
            $news->delete();
            
            return ResponseFormatter::success(null, 'Deleting news success');
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }

    public function update(Request $request, $id){
        try {
            $this->validate($request,[
                'title' => 'required',
                'category_id' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png|max:5120',
                'content' => 'required'
            ]);

            $news = News::findOrFail($id);

            if ($request->file('image') == '') {
                $news->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->title),
                    'category_id'=> $request->category_id,
                    'content' => $request->content
                ]);
            } else {
                

            Storage::disk('local')->delete('public/news/' . basename($news->image));
            
            $image = $request->file('image');

            $image->storeAs('public/news', $image->hashName());

            // upload img baru


            //upload data 
            $news->update([
                'title' =>$request->title,
                'slug' =>str::slug($request->title),
                'category_id' => $request->category_id,
                'image' =>$image->hashName(),
                'content' =>$request->content
            ]);
        }

            return ResponseFormatter::success(
                $news,
                'Data berhasil di update'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'something went wrong',
                'error' => $error,
            ], 'Aunthenticitaed ', 500);
        }
    }

    
}
