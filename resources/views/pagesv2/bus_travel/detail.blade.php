@extends('layouts.app_v2')

@section('content')
@include('pagesv2.bus_travel.partials._second_nav')

<div class="container my-5 mb-50">
    <div class="btn-group w-100 mb-35px" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">

        <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#health_tab">Health</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#beauty_tab">Beauty</a>
            </li>
        </ul>

    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <img src="" class="" style="object-fit: contain; max-width: 100%;" alt="..."
                        onerror="this.src='https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg'">
                </div>
                <div class="col-8">
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection