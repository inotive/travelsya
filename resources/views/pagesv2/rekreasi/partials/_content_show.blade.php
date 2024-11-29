<div class="container mb-5">
    <section class="special-deals mt-5">
        @include('pagesv2.components._show', [
            'section_title' => 'Rekreasi',
            'clinics' => $clinics,
            'route' => 'rekreasi.detail',
        ])
    </section>
</div>
