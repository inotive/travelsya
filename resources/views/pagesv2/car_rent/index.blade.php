@extends('layouts.app_v2')

@section('content')
@include('pagesv2.car_rent.partials._second_nav')
@include('pagesv2.car_rent.partials._hero')
@include('pagesv2.car_rent.partials._contents', [
'special_deals' => $special_deals,
'favorites_car' => $favorites_car,
'near_location' => $near_location,
])
@endsection