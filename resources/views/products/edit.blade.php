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
            <form action="{{ route('products.update', $product->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required>{{$product->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" class="form-control" id="price" name="price" min="0" step="any" value="{{$product->price}}" required>
                </div>
                <div class="form-group">
                    <label for="file">Image:</label>
                    <input type="file" class="form-control" id="file" name="file">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection