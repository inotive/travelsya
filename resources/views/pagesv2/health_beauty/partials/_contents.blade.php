@push('add-style')
<style>
    .btn-gray-carousel {
        background-color: lightgray !important;
        color: black !important;
    }

    .btn-gray-carousel:hover {
        background-color: pink !important;
        color: red !important;
    }

    .object-fit-contain {
        object-fit: contain !important;
    }

    .card-img-top-rounded {
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
    }

    .carousel-tab {
        background-color: rgba(0, 0, 0, 0.50);
        border-radius: 10px;
        padding: 10px 20px;
    }
</style>
@endpush

<div class="container mb-5">
    <section class="special-deals" style="margin-bottom: 100px;">
        @include('pagesv2.components.section_title', [
        'section_title' => 'Specials Deals',
        'section_subtitle' => 'Jelajahi kategori-kategori kami untuk kebahagiaan maksimal',
        ])
        @include('pagesv2.components._special_deals', [
        'section_title' => 'Specials Deals',
        'section_subtitle' => 'Jelajahi kategori-kategori kami untuk kebahagiaan maksimal',
        'chunked_special_deals' => $chunked_special_deals
        ])
    </section>

    <section class="categories" style="margin-bottom: 100px;">
        @include('pagesv2.components._categories', [
        'section_title' => 'Kebutuhan Kesehatan dan Kecantikan',
        'section_subtitle' => 'Jelajahi kategori-kategori kami untuk kebahagian maksimal',
        'chunked_categories' => $chunked_categories,
        ])
    </section>

    <section class="partners" style="margin-bottom: 100px;">
        @include('pagesv2.components._partners', [
        'section_title' => 'Kesehatan dan Kecantikan Terbaik!',
        'section_subtitle' => 'Saatnya segerkan penampilan kamu dengan mitra-mitra terbaik kami',
        'chunked_partners' => $chunked_partners,
        ])
    </section>
</div>

@push('js')
@endpush