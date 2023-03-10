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
                <div class="card-header">News</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @auth
                        @if (Auth::user()->is_admin)
                            <button onclick="location.href='{{route('news.create')}}'" type="button" class="btn btn-primary">Add New Post</button>
                        @endif
                    @endauth

                    @foreach($news as $post)
                    <div class="card mb-3">
                        <img class="card-img-top" src={{asset("storage/news/$post->img_file_path")}} alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$post->title}}</h5>
                            <p class="card-text">{{$post->content}}</p>
                            <p class="card-text"><small class="text-muted">Posted by {{$post->user->name}} {{$post->created_at->diffForHumans()}} </small></p>
                            @auth
                                @if (Auth::user()->is_admin)
                                    <form method="POST" action="{{route('news.destroy', $post->id)}}">
                                        @csrf
                                        @method("delete")
                                        <button onclick="location.href='{{route('news.edit', $post->id)}}'" type="button" class="btn btn-primary">Edit</button>
                                        <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?');">
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