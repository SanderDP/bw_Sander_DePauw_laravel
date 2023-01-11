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
                <div class="card-header">Home</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <h1 class="card-title">Welcome to the home menu of Bakkerij_Laravel_Project</h1>
                    <p class="card-text">
                        In this website you can check products, place orders, check out the latest news, scroll through the different user profiles, edit your own profile, look at the frequently asked questions and contact us through the contact us form.
                    </p>
                    <p class="card-text">
                        Some features like granting users admin priviliges, looking at all the placed orders, adding news posts, editing the FAQs and checking out the submitted contact forms are only available to admins.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
