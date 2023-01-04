@extends('layouts.app')

@section('content')
@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('users.update', $user->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required>
                </div>
                <div class="form-group">
                    <label for="about_me">About me:</label>
                    <textarea class="form-control" id="about_me" name="about_me" rows="3" required>{{$user->about_me}}</textarea>
                </div>
                <div class="mb-3 row">
                    <label for="birthday" class="col-md-4 col-form-label text-md-end">Birthday:</label>
                    <div class="col-md-6">
                        <input type="datetime-local" class="form-control" name="birthday" value="{{$user->birthday}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="file">Avatar:</label>
                    <input type="file" class="form-control" id="file" name="file">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("input[type=datetime-local]");
</script>
@endpush
@endsection