<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    //
    public function index()
    {
        try {
            //code...
            $category = Category::latest()->get();
            return ResponseFormatter::error(
                $category,
                'Data berhasil terlist'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function show($id)
    {
        try {
            //code...
            $category = Category::findOrFail($id);
            return ResponseFormatter::success(
                $category,
                'Data berrhasil terlist'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|unique:categories',
                'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $image = $request->file('image');
            $image->storeAs('/public/category', $image->hashName());


            $category = Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'image' => $image->hashName()
            ]);

            return ResponseFormatter::success(
                $category,
                'date berhasil berhasil ditambahkan'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'image' => 'mimes:jpeg,jpg,png|max:2048'
            ]);

            $category = Category::findOrFail($id);

            if ($request->file('image') == '') {
                $category->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name)
                ]);
            } else {
                Storage::disk('local')->delete('public/category/' . basename($category->image));

                $image = $request->file('image');

                $image->storeAs('public/category', $image->hashName());


                // upload img baru


                //upload data 
                $category->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'image' => $image->hashName()
                ]);;
            }

            return ResponseFormatter::success(
                $category,
                'date berhasil berhasil ditambahkan'
            );

        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'something went wrong',
                'error' => $error,
            ], 'Aunthenticitaed ', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrfail($id);
            
            Storage::disk('local')->delete('public/category/' . basename($category->image));

            $category->delete();

            return ResponseFormatter::success([
                $category,
                'data berhasil di delete'
            ]);
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'something went wrong',
                'error' => $error,
            ], 'Aunthenticitaed ', 500);
        }
    }
}
