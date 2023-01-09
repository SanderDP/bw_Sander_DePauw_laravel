@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Contact forms</div>

                <div class="card-body">

                    @foreach($contactforms as $form)
                    <div class="card mb-3">
                        <div class="card-body">
                            <p class="card-text">{{$form->message}}</p>
                            <p class="card-text"><small class="text-muted">Posted by {{$form->name}}, {{$form->mail}}</small></p>
                            
                            @auth
                                @if (Auth::user()->is_admin)
                                    <form method="POST" action="{{route('contact.destroy', $form->id)}}">
                                        @csrf
                                        @method("delete")
                                        <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this form?');">
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