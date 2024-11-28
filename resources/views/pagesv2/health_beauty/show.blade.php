@extends('layouts.app_v2')

@section('content')
    @include('pagesv2.health_beauty.partials._second_nav')
    @include('pagesv2.health_beauty.partials._content_show', [
        'type' => 'Health',
        'clinics' => $clinics,
    ])
@endsection
