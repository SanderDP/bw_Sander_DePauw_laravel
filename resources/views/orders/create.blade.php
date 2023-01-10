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
                    <div class="alert alert-danger" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Products</h5>
                            <form action="{{route('orders.store')}}" method="POST">
                            @csrf
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
                                        @foreach ($products as $product)
                                            <tr>
                                                <th scope="row"><img src="{{asset("storage/products/$product->img_file_path")}}" width="100" height="100" class="img-responsive"/>&emsp;{{$product->name}}</th>
                                                <td>€{{$product->price}}</td>
                                                <td><input type="number" name="amount_{{$product->id}}" id="amount_{{$product->id}}" value="0" step="1" min="0" required
                                                    onchange="document.getElementById('subtotal_{{$product->id}}').innerHTML = '€' + this.value * Math.round('{{$product->price}}' * 100) / 100;
                                                    var total = 0;
                                                    var subtotals = document.getElementsByClassName('subtotal');
                                                    for (var i = 0; i < subtotals.length; i++) { total += Math.round(subtotals[i].innerHTML.substring(1) * 100) / 100};
                                                    document.getElementById('total').innerHTML = '€' + total;"></td>
                                                <td class= subtotal id="subtotal_{{$product->id}}">€0</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><button type="submit" class="btn btn-primary">Place order</button></td>
                                            <td colspan="2" class="hidden-xs"></td>
                                            <td class="visible-xs">
                                                <strong id="total">€0</strong></td>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection