@extends('layouts.app_v2')

@section('content')
    @include('pagesv2.health_beauty.partials._second_nav')
    @include('pagesv2.health_beauty.partials._hero')
    @include('pagesv2.health_beauty.partials._contents', [
        'special_deals' => $special_deals,
        'categorises' => $categorises,
        'partners' => $partners,
    ])
@endsection
