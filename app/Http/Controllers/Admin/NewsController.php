<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::latest()->paginate('5');
        $category = Category::all();
        //
        $title = 'Index News';
        return view('home.news.index', compact('title', 'news', 'category'));
        //compact berfungsi mengirim data ke view

        //get data terbaru
        // yang diambil dari variabel diatas

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'create';
        $category = Category::all();
        return view('home.news.create', compact('title', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:5120',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        $image = $request->file('image');
        //fungsi hash untuk menjadi memberikan nama acak 
        $image->storeAs('public/news', $image->hashName());

        //create data
        News::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'image' => $image->hashName(),
            'content' => $request->content,
        ]);

        return redirect()->route('news.index')->with(['succes' => 'berhasil']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $title = 'show';
        // get data by id
        $news = News::findOrFail($id);
        // fungsi find or fail untuk menemukan data(bila tak ada = not found)
        return view('home.news.show', compact('title', 'news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get data by id
        $news = News::FindOrFail($id);
        $category = Category::all();
        $title = 'title';
        return view('home.news.edit', compact('title', 'news', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png|max:5120'
        ]);

        $news = News::FindOrFail($id);

        if ($request->file('image')) {
            $news->update([
                'title' => 'required|max:255',
                'slug' =>Str::slug($request->title) ,
                'category_id' => 'required',
                'content' => 'required',
            ]);
        }else{
            $news = News::FindOrFail($id);
            Storage::disk('local')->delete('public/news/'. basename($news->image));

            $image = $request->file('image');
            $image->storeAs('public/news', $image->hashName());

            $news->update([
                'title' => 'required|max:255',
                'slug' =>Str::slug($request->title) ,
                'category_id' => 'required',
                'image' => $image->hashName(),
                'content' => 'required'
            ]);
        };

        return redirect()->route('news.index')->with('succes', 'News berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
