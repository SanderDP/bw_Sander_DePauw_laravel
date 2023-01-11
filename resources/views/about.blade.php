<?php $layout = 'layouts.app' ?>
@auth
    @if (Auth::user()->is_admin)
        <?php $layout = 'layouts.admin' ?>
    @endif
@endauth

@extends($layout)

@section('content')
<div class="container">
    <p class="card-text">
        In this website you can check products, place orders, check out the latest news, scroll through the different user profiles, edit your own profile, look at the frequently asked questions and contact us through the contact us form.
    </p>
    <p class="card-text">
        Some features like granting users admin priviliges, looking at all the placed orders, adding news posts, editing the FAQs and checking out the submitted contact forms are only available to admins.
    </p>
    <p class="card-text">In this page the resources I used during development of this website are available.</p>
    <ul>
        <li><a href="https://laravel.com/docs/9.x/installation#your-first-laravel-project">Laravel installation</a></li>
        <li><a href="https://github.com/SanderDP/bw_Sander_DePauw_laravel">My Github location</a></li>
        <li><a href="https://ehb.instructuremedia.com/embed/edeb8a9e-3e8f-4af3-85f9-8be5ae754e7d">Teacher video guestbook</a></li>
        <li><a href="https://techvblogs.com/blog/how-to-install-bootstrap-5-in-laravel-9-with-vite">Laravel install bootstrap with vite</a></li>
        <li><a href="https://laravel.com/docs/4.2/migrations#database-seeding">Laravel seeding</a></li>
        <li><a href="https://www.codewall.co.uk/upload-image-to-database-using-laravel-tutorial-with-example/">Storing images</a></li>
        <li><a href="https://stackoverflow.com/questions/50997652/laravel-retrieve-images-from-storage-to-view">Accessing assets stored in storage</a></li>
        <li><a href="https://getbootstrap.com/docs/4.0/components/buttons/">Bootstrap buttons</a></li>
        <li><a href="https://getbootstrap.com/docs/4.0/components/forms/">Bootstrap forms</a></li>
        <li><a href="https://mdbootstrap.com/docs/standard/extended/avatar/">Bootstrap avatar</a></li>
        <li><a href="https://getbootstrap.com/docs/5.0/components/badge/">Bootstrap badges</a></li>
        <li><a href="https://larainfo.com/blogs/how-to-use-datepicker-in-laravel-9-with-bootstrap-5">Datepicker</a></li>
        <li><a href="https://laravel.com/docs/9.x/eloquent-relationships#has-many-through">Bootstrap Eloquent relationships</a></li>
        <li><a href="https://laraveldaily.com/post/pivot-tables-and-many-to-many-relationships">Using pivot tables</a></li>
    </ul>
</div>
@endsection