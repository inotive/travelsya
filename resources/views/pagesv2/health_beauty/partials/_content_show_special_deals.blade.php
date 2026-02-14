<div class="container mb-5">
    <section class="special-deals mt-5">
        @include('pagesv2.components._show_special_deals', [
        'section_title' => 'Special Deals',
        'special_deals' => $special_deals,
        'route' => 'rekreasi.detail',
        ])
    </section>
</div>