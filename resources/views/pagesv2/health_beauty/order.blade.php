@extends('layouts.app_v2')

@section('content')
@include('pagesv2.health_beauty.partials._content_order', [
'type' => 'Health',
])
@endsection