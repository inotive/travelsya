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
            <!-- Tab health menampilkan teks dan card -->
            <div id="health_categories_section">
                <div class="section-title" style="margin-bottom: 25px;">
                    <div style="display: flex; align-items: center;">
                        <h2 class="text-dark" style="position: relative; top: 3px;">Kebutuhan Kesehatan dan Kecantikan</h2>
                    </div>
                    <div class="subtitle text-capitalize mt-2">Jelajahi kategori-kategori kami untuk kebahagian maksimal</div>
                </div>
                
                <!-- Card-container -->
                <div class="card-container" style="display: flex; gap: 20px; margin-top: 20px;">
                    <!-- Card Clinic -->
                    <a href="{{ route('health_beauty.category', ['id' => 1, 'context' => 'health']) }}" class="text-decoration-none">
                        <div class="card shadow rounded-4 d-flex flex-row align-items-center" style="width: 18rem; position: relative; overflow: hidden; height: 150px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); cursor: pointer;">
                            <img src="{{ asset('images/erik-mclean.jpg') }}" class="card-img-top" style="height: 150px; object-fit: cover; width: 100%;" alt="Clinic">
                            <div class="d-flex flex-column w-100 align-items-center justify-content-center" style="z-index: 1; position: absolute; top: 0; left: 0; right: 0; bottom: 0;">
                                <div class="carousel-tab d-flex align-items-center justify-content-center" style="height: 100%;">
                                    <h3 class="text-light fw-bold text-center">Clinic</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                    
                    <!-- Card Service -->
                    <a href="{{ route('health_beauty.category', ['id' => 2, 'context' => 'health']) }}" class="text-decoration-none">
                        <div class="card shadow rounded-4 d-flex flex-row align-items-center" style="width: 18rem; position: relative; overflow: hidden; height: 150px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); cursor: pointer;">
                            <img src="{{ asset('images/Threadlift.jpg') }}" class="card-img-top" style="height: 150px; object-fit: cover; width: 100%;" alt="Service">
                            <div class="d-flex flex-column w-100 align-items-center justify-content-center" style="z-index: 1; position: absolute; top: 0; left: 0; right: 0; bottom: 0;">
                                <div class="carousel-tab d-flex align-items-center justify-content-center" style="height: 100%;">
                                    <h3 class="text-light fw-bold text-center">Service</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                    
                    <!-- Card Product -->
                    <a href="{{ route('health_beauty.category', ['id' => 3, 'context' => 'health']) }}" class="text-decoration-none">
                        <div class="card shadow rounded-4 d-flex flex-row align-items-center" style="width: 18rem; position: relative; overflow: hidden; height: 150px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); cursor: pointer;">
                            <img src="{{ asset('images/content-pixie.jpg') }}" class="card-img-top" style="height: 150px; object-fit: cover; width: 100%;" alt="Product">
                            <div class="d-flex flex-column w-100 align-items-center justify-content-center" style="z-index: 1; position: absolute; top: 0; left: 0; right: 0; bottom: 0;">
                                <div class="carousel-tab d-flex align-items-center justify-content-center" style="height: 100%;">
                                    <h3 class="text-light fw-bold text-center">Product</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- Tab beauty menampilkan teks dan card -->
            <div id="beauty_categories_section" style="display: none;">
                <div class="section-title" style="margin-bottom: 25px;">
                    <div style="display: flex; align-items: center;">
                        <h2 class="text-dark" style="position: relative; top: 3px;">Kebutuhan Kesehatan dan Kecantikan</h2>
                    </div>
                    <div class="subtitle text-capitalize mt-2">Jelajahi kategori-kategori kami untuk kebahagian maksimal</div>
                </div>
                
                <!-- Card-container -->
                <div class="card-container" style="display: flex; gap: 20px; margin-top: 20px;">
                    <!-- Card Clinic -->
                    <div class="card shadow rounded-4 d-flex flex-row align-items-center" style="width: 18rem; position: relative; overflow: hidden; height: 150px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/erik-mclean.jpg') }}" class="card-img-top" style="height: 150px; object-fit: cover; width: 100%;" alt="Clinic">
                        <div class="d-flex flex-column w-100 align-items-center justify-content-center" style="z-index: 1; position: absolute; top: 0; left: 0; right: 0; bottom: 0;">
                            <div class="carousel-tab d-flex align-items-center justify-content-center" style="height: 100%;">
                                <h3 class="text-light fw-bold text-center">Clinic</h3>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Service -->

                    
                    <div class="card shadow rounded-4 d-flex flex-row align-items-center" style="width: 18rem; position: relative; overflow: hidden; height: 150px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/Threadlift.jpg') }}" class="card-img-top" style="height: 150px; object-fit: cover; width: 100%;" alt="Service">
                        <div class="d-flex flex-column w-100 align-items-center justify-content-center" style="z-index: 1; position: absolute; top: 0; left: 0; right: 0; bottom: 0;">
                            <div class="carousel-tab d-flex align-items-center justify-content-center" style="height: 100%;">
                                <h3 class="text-light fw-bold text-center">Service</h3>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Product -->
                    <div class="card shadow rounded-4 d-flex flex-row align-items-center" style="width: 18rem; position: relative; overflow: hidden; height: 150px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/content-pixie.jpg') }}" class="card-img-top" style="height: 150px; object-fit: cover; width: 100%;" alt="Product">
                        <div class="d-flex flex-column w-100 align-items-center justify-content-center" style="z-index: 1; position: absolute; top: 0; left: 0; right: 0; bottom: 0;">
                            <div class="carousel-tab d-flex align-items-center justify-content-center" style="height: 100%;">
                                <h3 class="text-light fw-bold text-center">Product</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tab spa & beauty menampilkan card tanpa teks -->
            <div id="spa_beauty_categories_section" style="display: none;">
                <!-- Card-container -->
                <div class="card-container" style="display: flex; gap: 20px; margin-top: 20px;">
                    <!-- Card Clinic -->
                    <div class="card shadow rounded-4 d-flex flex-row align-items-center" style="width: 18rem; position: relative; overflow: hidden; height: 150px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/Threadlift.jpg') }}" class="card-img-top" style="height: 150px; object-fit: cover; width: 100%;" alt="Clinic">
                        <div class="d-flex flex-column w-100 align-items-center justify-content-center" style="z-index: 1; position: absolute; top: 0; left: 0; right: 0; bottom: 0;">
                            <div class="carousel-tab d-flex align-items-center justify-content-center" style="height: 100%;">
                                <h3 class="text-light fw-bold text-center">Clinic</h3>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Service -->
                    <div class="card shadow rounded-4 d-flex flex-row align-items-center" style="width: 18rem; position: relative; overflow: hidden; height: 150px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/erik-mclean.jpg') }}" class="card-img-top" style="height: 150px; object-fit: cover; width: 100%;" alt="Service">
                        <div class="d-flex flex-column w-100 align-items-center justify-content-center" style="z-index: 1; position: absolute; top: 0; left: 0; right: 0; bottom: 0;">
                            <div class="carousel-tab d-flex align-items-center justify-content-center" style="height: 100%;">
                                <h3 class="text-light fw-bold text-center">Service</h3>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Product -->
                    <div class="card shadow rounded-4 d-flex flex-row align-items-center" style="width: 18rem; position: relative; overflow: hidden; height: 150px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/content-pixie.jpg') }}" class="card-img-top" style="height: 150px; object-fit: cover; width: 100%;" alt="Product">
                        <div class="d-flex flex-column w-100 align-items-center justify-content-center" style="z-index: 1; position: absolute; top: 0; left: 0; right: 0; bottom: 0;">
                            <div class="carousel-tab d-flex align-items-center justify-content-center" style="height: 100%;">
                                <h3 class="text-light fw-bold text-center">Product</h3>
                            </div>
                        </div>
                    </div>
                </div>
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
            document.getElementById('spa_beauty_categories_section').style.display = 'none';
        });

        document.getElementById('beauty_tab').addEventListener('shown.bs.tab', function() {
            document.getElementById('health_categories_section').style.display = 'none';
            document.getElementById('beauty_categories_section').style.display = 'block';
            document.getElementById('spa_beauty_categories_section').style.display = 'none';
        });

        document.getElementById('spa_beauty_tab').addEventListener('shown.bs.tab', function() {
            document.getElementById('health_categories_section').style.display = 'none';
            document.getElementById('beauty_categories_section').style.display = 'none';
            document.getElementById('spa_beauty_categories_section').style.display = 'block';
        });
    });
</script>
@endpush

@endsection
