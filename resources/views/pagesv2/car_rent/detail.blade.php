@extends('layouts.app_v2')

@section('content')
@include('pagesv2.car_rent.partials._second_nav')
@include('pagesv2.car_rent.partials._content_detail', [
'type' => 'Health',
])
@endsection