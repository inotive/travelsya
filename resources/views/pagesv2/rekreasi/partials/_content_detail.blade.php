<div class="container mb-5">
    <section class="special-deals mt-5">

        @include('pagesv2.components._detail_header');
        @include('pagesv2.components._detail', [
        'section_title' => $type,
        'route' => 'rekreasi.order',
        'package' => 'pagesv2.components._detail_recreation_package'
        ])
    </section>
</div>