<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::latest()->get();
        return view('news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->is_admin){
            abort(403, 'Only admins can add posts.');
        }
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->is_admin){
            abort(403, 'Only admins can add posts.');
        }

        $validated = $request->validate([
            'title' => 'required|min:5',
            'content' => 'required|min:5',
            'file' => 'mimes:png,jpg',
        ]);
        
        $validated['file']->store('news', 'public');

        $newsPost = new News;
        $newsPost->title = $validated['title'];
        $newsPost->content = $validated['content'];
        $newsPost->img_file_path = $validated['file']->hashName();
        $newsPost->user_id = Auth::user()->id;
        $newsPost->save();

        return redirect()->route('index')->with('status', 'Newspost added');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = News::findOrFail($id);

        if(!Auth::user()->is_admin){
            abort(403, 'Only admins can edit posts.');
        }
        return view('news.edit', compact('post'));
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
        $post = News::findOrFail($id);

        if(!Auth::user()->is_admin){
            abort(403, 'Only admins can edit posts.');
        }

        $validated = $request->validate([
            'title' => 'required|min:5',
            'content' => 'required|min:5',
        ]);

        if($request->hasFile('file')){
            
            $request->validate([
                'file' => 'mimes:png,jpg'
            ]);

            $request->file->store('news', 'public');
            $image_path = public_path('news'). '/' . $post->img_file_path;
            // unlink($image_path);                                                     should delete old image from storage/app/public/news but throws notFoundException

            $post->img_file_path = $request->file->hashName();
        }
        
        
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect()->route('index')->with('status', 'Newspost edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = News::findOrFail($id);

        if(!Auth::user()->is_admin){
            abort(403, 'Only admins can delete posts.');
        }

        $image_path = public_path('news'). '/' . $post->img_file_path;
        // unlink($image_path);                                                     should delete old image from storage/app/public/news but throws notFoundException

        $post->delete();

        return redirect()->route('index')->with('status', 'Newspost deleted');
    }
}
