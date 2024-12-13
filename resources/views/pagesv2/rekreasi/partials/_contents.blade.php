<div class="container mb-5">
    <section class="special-deals" style="margin-bottom: 100px;">
        @include('pagesv2.components.section_title', [
        'section_title' => 'Specials Deals',
        'section_subtitle' => 'Jelajahi kategori-kategori kami untuk kebahagiaan maksimal',
        ])
        @include('pagesv2.rekreasi.components._special_deals', [
        'special_deals' => $special_deals,
        ])
    </section>

    <section class="categories" style="margin-bottom: 100px;">
        @include('pagesv2.rekreasi.components._categories', [
        'section_title' => 'Kategori Rekreasi',
        'section_subtitle' => 'Jelajahi kategori-kategori kami untuk kebahagian maksimal',
        'categorises' => $categorises,
        ])
    </section>

    <section class="partners" style="margin-bottom: 100px;">
        @include('pagesv2.rekreasi.components._partners', [
        'section_title' => 'Tempat bermain terbaik di Jakrta!',
        'section_subtitle' => 'Menghabiskan waktu luang bersama keluarga jadi semakin seru',
        'partners' => $partners,
        ])
    </section>
</div>