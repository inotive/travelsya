@extends('layouts.app_v2')

@section('content')
    @include('pagesv2.health_beauty.partials._second_nav')
    @include('pagesv2.health_beauty.partials._hero')
    <div class="container">
        <section class="special-deals" style="margin-bottom: 100px;">
            @include('pagesv2.components.section_title', [
                'section_title' => 'Specials Deals',
                'section_subtitle' => 'Jelajahi kategori-kategori kami untuk kebahagiaan maksimal',
            ])
            @include('pagesv2.health_beauty.partials._special_deals', [
                'section_title' => 'Specials Deals',
                'section_subtitle' => 'Jelajahi kategori-kategori kami untuk kebahagiaan maksimal',
                'special_deals' => $special_deals,
            ])
        </section>

        <section class="categories" style="margin-bottom: 100px;">
            @include('pagesv2.health_beauty.partials._categories', [
                'section_title' => 'Kebutuhan Kesehatan dan Kecantikan',
                'section_subtitle' => 'Jelajahi kategori-kategori kami untuk kebahagian maksimal',
                'categorises' => $categorises,
            ])
        </section>

        <section class="partners" style="margin-bottom: 100px;">
            @include('pagesv2.health_beauty.partials._partners', [
                'section_title' => 'Kesehatan dan Kecantikan Terbaik!',
                'section_subtitle' => 'Saatnya segerkan penampilan kamu dengan mitra-mitra terbaik kami',
                'partners' => $partners,
            ])
        </section>
    </div>
@endsection
