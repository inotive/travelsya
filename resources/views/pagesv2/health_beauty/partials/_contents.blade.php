@push('add_style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
@endpush

<div class="container">
    <section class="special-deals mt-5">
        @include('pagesv2.components._special_deals', [
            'section_title' => 'Specials Deals',
            'section_subtitle' => 'Jelajahi kategori-kategori kami untuk kebahagiaan maksimal',
        ])
    </section>

    <section class="categories mt-5">
        @include('pagesv2.components._categories', [
            'section_title' => 'Kebutuhan Kesehatan dan Kecantikan',
            'section_subtitle' => 'Jelajahi kategori-kategori kami untuk kebahagian maksimal',
        ])
    </section>

    <section class="partners mt-5">
        @include('pagesv2.components._partners', [
            'section_title' => 'Kesehatan dan Kecantikan Terbaik!',
            'section_subtitle' => 'Saatnya segerkan penampilan kamu dengan mitra-mitra terbaik kami',
        ])
    </section>
</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
@endpush
