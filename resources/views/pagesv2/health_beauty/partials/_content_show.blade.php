<div class="container mb-5">
    <section class="special-deals mt-5">
        @include('pagesv2.components._show', [
            'section_title' => $type,
            'clinics' => $clinics,
            'route' => 'health_beauty.detail',
        ])
    </section>
</div>
