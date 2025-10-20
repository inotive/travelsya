@extends('layouts.app_v2_no_main_header')

@section('content')
    @include('pagesv2.health_beauty.partials._second_nav')
    @include('pagesv2.health_beauty.partials._hero')
    <div class="container">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="health_tab" role="tabpanel">
                <section class="special-deals" style="margin-bottom: 50px;">
                    @include('pagesv2.components.section_title', [
                        'section_title' => 'Specials Deals Kesehatan',
                        'section_subtitle' => 'Jelajahi kategori-kategori kami untuk kebahagiaan maksimal',
                    ])
                    @include('pagesv2.health_beauty.partials._special_deals', [
                        'data' => $special_deals,
                        'category' => 'health',
                    ])
                </section>

            </div>
            <div class="tab-pane fade" id="beauty_tab" role="tabpanel">
                <section class="special-deals" style="margin-bottom: 50px;">
                    @include('pagesv2.components.section_title', [
                        'section_title' => 'Specials Deals Kecantikan',
                        'section_subtitle' => 'Jelajahi kategori-kategori kami untuk kebahagiaan maksimal',
                    ])
                    @include('pagesv2.health_beauty.partials._special_deals', [
                        'data' => $special_deals_beauty,
                        'category' => 'beauty',
                    ])
                </section>

            </div>
            <div class="tab-pane fade" id="spa_beauty_tab" role="tabpanel">
                <section class="special-deals" style="margin-bottom: 50px;">
                    @include('pagesv2.components.section_title', [
                        'section_title' => 'Specials Deals Spa dan Kecantikan',
                        'section_subtitle' => 'Jelajahi kategori-kategori kami untuk kebahagiaan maksimal',
                    ])
                    @include('pagesv2.health_beauty.partials._special_deals', [
                        'data' => $special_deals_spa_beauty,
                        'category' => 'spa_beauty',
                    ])
                </section>
            </div>
        </div>
        <section class="categories" style="margin-bottom: 50px;">
            <!-- Tab health menampilkan semua kategori -->
            <div id="health_categories_section">
                @include('pagesv2.health_beauty.partials._categories', [
                    'section_title' => 'Kebutuhan Kesehatan dan Kecantikan',
                    'section_subtitle' => 'Jelajahi kategori-kategori kami untuk kebahagian maksimal',
                    'categorises' => $categorises,
                ])
            </div>
            <!-- Tab beauty menampilkan kategori terpisah untuk service dan product -->
            <div id="beauty_categories_section" style="display: none;">
                @include('pagesv2.health_beauty.partials._categories_beauty', [
                    'section_title' => 'Kebutuhan Kesehatan dan Kecantikan',
                    'section_subtitle' => 'Jelajahi kategori-kategori kami untuk kebahagian maksimal',
                    'service_categories' => $service_categories,
                    'product_categories' => $product_categories,
                ])
            </div>
        </section>

        <section class="partners" style="margin-bottom: 50px;">
            @include('pagesv2.health_beauty.partials._partners', [
                'section_title' => 'Kesehatan dan Kecantikan Terbaik!',
                'section_subtitle' => 'Saatnya segerkan penampilan kamu dengan mitra-mitra terbaik kami',
                'partners' => $partners,
            ])
        </section>
    </div>
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Event listener untuk tab change
        document.getElementById('health_tab').addEventListener('shown.bs.tab', function() {
            document.getElementById('health_categories_section').style.display = 'block';
            document.getElementById('beauty_categories_section').style.display = 'none';
        });
        
        document.getElementById('beauty_tab').addEventListener('shown.bs.tab', function() {
            document.getElementById('health_categories_section').style.display = 'none';
            document.getElementById('beauty_categories_section').style.display = 'block';
        });
        
        document.getElementById('spa_beauty_tab').addEventListener('shown.bs.tab', function() {
            document.getElementById('health_categories_section').style.display = 'none';
            document.getElementById('beauty_categories_section').style.display = 'none';
        });
    });
</script>
@endpush

@endsection
