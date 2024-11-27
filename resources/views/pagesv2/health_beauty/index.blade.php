@extends('layouts.app_v2')

@section('content')
@include('pagesv2.health_beauty.partials._second_nav')
@include('pagesv2.health_beauty.partials._hero')
@include('pagesv2.health_beauty.partials._contents', ['chunked_special_deals' => $chunked_special_deals,
'chunked_categories' => $chunked_categories, 'chunked_partners' => $chunked_partners])
@endsection