@extends('layouts.app_v2')

@section('content')
@include('pagesv2.car_rent.partials._second_nav')
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@include('pagesv2.car_rent.partials._content_show', [
'type' => 'Health',
])
@endsection