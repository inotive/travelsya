@extends('layouts.app_v2')

@section('content')
@include('pagesv2.car_rent.partials._second_nav')
@include('pagesv2.car_rent.partials._content_show', [
'type' => 'Health',
'providers' => $providers,
'route' => 'car_rent.detail'
])
@endsection