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
                        <div class="card-header">{{$category->name}}</div>
                        <div class="card-body">
                            @foreach ($category->questions as $question)
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <h3 class="card-title">{{$question->question}}</h3>
                                        <p class="card-text">{{$question->answer}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection