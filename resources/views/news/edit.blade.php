@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('news.update', $post->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}" required>
                </div>
                <div class="form-group">
                    <label for="content">Text:</label>
                    <textarea class="form-control" id="content" name="content" rows="3" required>{{$post->content}}</textarea>
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