@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Profiles</div>

                <div class="list-group">
                    @foreach($users as $profile)
                    <div class="list-group">
                        <a href=" {{route('users.show', $profile->id)}} " class="list-group-item list-group-item-action">
                            <h5>
                            <img src={{asset("storage/users/$profile->avatar")}} class="rounded-circle" style="width: 50px; height: 50px;" alt="Avatar"/>
                            {{$profile->name}}
                            @if ($profile->is_admin)
                                <span class="badge rounded-pill bg-warning text-dark">Admin</span>
                            @endif
                            </h5>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection