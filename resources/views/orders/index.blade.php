<?php $layout = 'layouts.app' ?>
@auth
    @if (Auth::user()->is_admin)
        <?php $layout = 'layouts.admin' ?>
    @endif
@endauth

@extends($layout)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Orders</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @foreach($orders as $order)
                    <?php $total = 0 ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Customer: {{$order->user->name}}</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->products as $product)
                                        <tr>
                                            <th scope="row"><img src="{{asset("storage/products/$product->img_file_path")}}" width="100" height="100" class="img-responsive"/>&emsp;{{$product->name}}</th>
                                            <td>€{{$product->price}}</td>
                                            <td>{{$product->pivot->amount}}</td>
                                            <td>€{{number_format($product->price * $product->pivot->amount, 2, '.', '')}}</td>
                                            <?php $total += $product->price * $product->pivot->amount ?>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="visible-xs"><small>{{$order->created_at->format('d M Y H:i:s')}}</small></td>
                                        <td colspan="2" class="hidden-xs"></td>
                                        <td class="visible-xs">
                                            <strong>Total: €{{ number_format($total, 2, '.', '') }}</strong></td>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            @auth
                                @if (Auth::user()->is_admin)
                                    <form method="POST" action="{{route('orders.destroy', $order->id)}}">
                                        @csrf
                                        @method("delete")
                                        <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?');">
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection