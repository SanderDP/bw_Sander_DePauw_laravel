@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">News</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @auth
                    <button onclick="location.href='{{route('news.create')}}'" type="button" class="btn btn-primary">Add New Post</button>
                    @endauth

                    @foreach($news as $post)
                    <div class="card mb-3">
                        <img class="card-img-top" src={{asset("storage/news/$post->img_file_path")}} alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$post->title}}</h5>
                            <p class="card-text">{{$post->content}}</p>
                            <p class="card-text"><small class="text-muted">Posted by {{$post->user->name}} {{$post->created_at->diffForHumans()}} </small></p>
                            <button type="button" class="btn btn-primary">Edit</button>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection