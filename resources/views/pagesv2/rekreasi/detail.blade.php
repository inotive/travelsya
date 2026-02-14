@extends('layouts.app_v2')

@section('content')
    @include('pagesv2.rekreasi.partials._second_nav')
    @include('pagesv2.rekreasi.partials._content_detail', [
        'type' => 'recreation',
        'is_weekend' => $is_weekend,
        'weektype' => $weektype,
    ])
@endsection
