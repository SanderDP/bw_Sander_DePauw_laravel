<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
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
        if(!Auth::user()->is_admin){
            abort(403, 'Only admins can look at the orders.');
        }

        $orders = Orders::oldest()->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Products::all();
        return view('orders.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Orders();
        $totalamount = 0;
        foreach(Products::all() as $product){
            $request->validate([
                'amount_' . $product->id => 'required|min:0'
            ]);
            
            $totalamount += $request['amount_' . $product->id];
        }

        if ($totalamount == 0){
            return redirect()->route('orders.create') -> with('status', 'You have to add at least one product to your purchase.');
        }

        $order->user_id = Auth::user()->id;
        $order->save();

        foreach($request->request as $key => $amount){
            if ($key != '_token'){
                if ($amount > 0)
                    $order->products()->attach(substr($key, -1), ['amount' => $amount]);
            }
        }

        return redirect()->route('products.index')->with('status', 'Order placed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Orders::findOrFail($id);

        if(!Auth::user()->is_admin){
            abort(403, 'Only admins can delete orders.');
        }

        $order->products()->detach();
        $order->delete();

        return redirect()->route('orders.index')->with('status', 'Order deleted');
    }
}
