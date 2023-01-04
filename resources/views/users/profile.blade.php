@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile of {{$user->name}}
                    @if ($user->is_admin)
                        <span class="badge rounded-pill bg-warning text-dark">Admin</span>
                    @endif
                </div>
                <div class="card-body">
                    <img src={{asset("storage/users/$user->avatar")}} class="rounded-circle" style="width: 150px; height: 150px;" alt="Avatar"/>
                    <h5 class="card-title">{{$user->name}}</h5>
                    <p class="card-text"><small class="text-muted">Birthday: {{$user->birthday}}</small></p>
                    <p class="card-text">{{$user->about_me}}</p>
                    @auth
                        @if (Auth::user() == $user)
                            <button onclick="location.href='{{route('users.edit', $user->id)}}'" type="button" class="btn btn-primary">Edit</button>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection