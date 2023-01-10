<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
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
        $products = Products::latest()->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:5',
            'price' => 'required|numeric',
            'file' => 'mimes:png,jpg',
        ]);
        
        $validated['file']->store('products', 'public');

        $product = new Products();
        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->img_file_path = $validated['file']->hashName();
        $product->price = $validated['price'];
        $product->save();

        return redirect()->route('products.index')->with('status', 'Product added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::findOrFail($id);

        if(!Auth::user()->is_admin){
            abort(403, 'Only admins can edit products.');
        }
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Products::findOrFail($id);

        if(!Auth::user()->is_admin){
            abort(403, 'Only admins can edit products.');
        }

        $validated = $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:5',
            'price' => 'required|numeric',
        ]);

        if($request->hasFile('file')){
            
            $request->validate([
                'file' => 'mimes:png,jpg'
            ]);

            $request->file->store('products', 'public');
            $image_path = public_path('products'). '/' . $product->img_file_path;
            // unlink($image_path);                                                     should delete old image from storage/app/public/products but throws notFoundException

            $product->img_file_path = $request->file->hashName();
        }
        
        
        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->save();

        return redirect()->route('products.index')->with('status', 'Product edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::findOrFail($id);

        if(!Auth::user()->is_admin){
            abort(403, 'Only admins can delete products.');
        }

        $image_path = public_path('news'). '/' . $product->img_file_path;
        // unlink($image_path);                                                     should delete old image from storage/app/public/products but throws notFoundException

        $product->orders()->detach();
        $product->delete();

        return redirect()->route('products.index')->with('status', 'Product deleted');
    }
}
