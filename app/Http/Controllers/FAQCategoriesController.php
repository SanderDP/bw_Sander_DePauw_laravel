<?php

namespace App\Http\Controllers;

use App\Models\FAQCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FAQCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('FAQ.categories.create');
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
            abort(403, 'Only admins can add new categories.');
        }

        $validated = $request->validate([
            'name' => 'required|min:3',
        ]);

        $category = new FAQCategories;
        $category->name = $validated['name'];
        $category->save();

        return redirect()->route('FAQ.index')->with('status', 'Category added');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = FAQCategories::where('id', '=', $id)->firstOrFail();

        if(!Auth::user()->is_admin){
            abort(403, 'Only admins can edit categories.');
        }
        return view('FAQ.categories.edit', compact('category'));
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
        $category = FAQCategories::where('id', '=', $id)->firstOrFail();

        if(!Auth::user()->is_admin){
            abort(403, 'Only admins can edit categories.');
        }

        $validated = $request->validate([
            'name' => 'required|min:3',
        ]);

        $category->name = $validated['name'];
        $category->save();

        return redirect()->route('FAQ.index')->with('status', 'Category info updated');
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
