<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

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

    public function show($id){
        try {
            //code...
            $category = Category::findOrFail($id);
            return ResponseFormatter::success(
                $category,
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

