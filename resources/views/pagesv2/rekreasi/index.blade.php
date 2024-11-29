@extends('layouts.app_v2')
@section('content')
    @include('pagesv2.rekreasi.partials._second_nav')
    @include('pagesv2.rekreasi.partials._hero')
    @include('pagesv2.rekreasi.partials._contents', [
        'special_deals' => $special_deals,
        'categorises' => $categorises,
        'partners' => $partners,
    ])
@endsection
