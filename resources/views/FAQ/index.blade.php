@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Frequently Asked Questions</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @foreach($categories as $category)
                    <div class="card mb-3">
                        <div class="card-header"><h2>{{$category->name}}</h2>
                            @auth
                                @if (Auth::user()->is_admin)
                                    <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Options</button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <form method="POST" action="{{route('FAQCategories.destroy', $category->id)}}">
                                                @csrf
                                                @method("delete")
                                                <button onclick="location.href='{{route('FAQ.createWithID', $category->id)}}'" type="button" class="btn btn-success">Add New Question</button>
                                                <button onclick="location.href='{{route('FAQCategories.edit', $category->id)}}'" type="button" class="btn btn-primary">Edit Category</button>
                                                <input type="submit" value="Delete Category" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">
                                            </form>
                                        </li>
                                    </ul>
                                @endif
                            @endauth
                        </div>
                        <div class="card-body">
                            @foreach ($category->questions as $question)
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <h3 class="card-title">{{$question->question}}</h3>
                                        <p class="card-text">{{$question->answer}}</p>
                                    </div>
                                    @auth
                                        @if (Auth::user()->is_admin)
                                            <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Options</button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <form method="POST" action="{{route('FAQ.destroy', $question->id)}}">
                                                        @csrf
                                                        @method("delete")
                                                        <button onclick="location.href='{{route('FAQ.edit', $question->id)}}'" type="button" class="btn btn-primary">Edit Question</button>
                                                        <input type="submit" value="Delete Question" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this question?');">
                                                    </form>
                                                </li>
                                            </ul>
                                        @endif
                                    @endauth
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    @auth
                        @if (Auth::user()->is_admin)
                            <button onclick="location.href='{{route('FAQCategories.create')}}'" type="button" class="btn btn-success">Add New Category</button>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection