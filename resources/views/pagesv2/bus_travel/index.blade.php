@extends('layouts.app_v2')

@section('content')
    @include('pagesv2.bus_travel.partials._second_nav')
    @include('pagesv2.bus_travel.partials._hero')
    @include('pagesv2.bus_travel.partials._how_to')
    @include('pagesv2.bus_travel.partials._populer_route')
    @include('pagesv2.bus_travel.partials._shuttle_route')
    @include('pagesv2.bus_travel.partials._bus_populer')
@endsection

@push('js')
<script>
    // Initialize Bootstrap tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                boundary: 'window',
                placement: 'top',
                trigger: 'hover'
            });
        });
    });
</script>
@endpush

@push('add-style')
<style>
    /* Ensure text truncation works properly */
    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endpush
