<div class="container mb-5">
    <section class="special-deals" style="margin-bottom: 100px;">
        @include('pagesv2.components.section_title', [
        'section_title' => 'Specials Deals',
        'section_subtitle' => 'Jelajahi kategori-kategori kami untuk kebahagiaan maksimal',
        ])
        @include('pagesv2.components._special_deals', [
        'section_title' => 'Specials Deals',
        'section_subtitle' => 'Jelajahi kategori-kategori kami untuk kebahagiaan maksimal',
        'special_deals' => $special_deals,
        ])
    </section>

    <section class="with_cheuffeur" style="margin-bottom: 100px;">
        <div class="section-title" style="margin-bottom: 25px;">
            <div style="display: flex; align-items: center;">
                <h2 class="text-dark" style="position: relative; top: 3px;">Rental Mobil Dengan Supir</h2>
            </div>
        </div>
        <p class="w-100">
            bepergian berssama keluarga atau kerabat semakin asyik juka anda menggunakan sarana transpotrasi yang tepat.
            sewa mobil atau carter mobil dapat menjadi pilihan terbaik untuk memudahkan mobilitas anda. untuk semakin
            mendukung fleksibilitas anda saat bepergian, travelsya kini telah menjadi aplikasi sewa mobil yang
            terpercaya. aplikasi rental mobil travelsya membuat anda dapat menikmati kenyamanan ini dengan memesan
            langsung layanan rental mobil yang anda butuhkan . temukan berbagai pilihan mobil terbaik lengkap dengan
            tarif mobil yang dibutuhkan. cek harga sewa mobil harian untuk segera kepeluan anda.
        </p>
        <p class="w-100">
            dapatkan durasi rental 24jan dengan memesan layanan sewa mobil lepas kunci di travelsya. jadikan perjalanan
            keluarga atau bisnis anda lebih hemat dan efisien
        </p>

    </section>

    <section class="with_cheuffeur" style="margin-bottom: 100px;">
        <div class="section-title" style="margin-bottom: 25px;">
            <div style="display: flex; align-items: center;">
                <h2 class="text-dark" style="position: relative; top: 3px;">Rental Mobil Lepas Kunci</h2>
            </div>
        </div>
        <p class="w-100">
            memilih kendaraan yang tepat saat ingin bepergian adalah hal wajib. jika anda berencana berkeliling kota
            dengan keluarga atau rombongan, persewaan mobil atau carter mobil di luar kota menjasi pilihan terbaik.
            kini, perkambangan teknologi memudahkan anda untuk persewaan mobil dimanapun hanya dengan travelsya. anda
            dapat menemukan pilihan mobil terbaik, rental mobil terdekat dari lokasi anda yang kebutuhan. kemudahan ini
            akan menjadikan perjalanan anda lebih nyaman hemat waktu
        </p>

    </section>

    <section class="without_cheuffeur" style="margin-bottom: 100px;">
        <div class="section-title" style="margin-bottom: 25px;">
            <div style="display: flex; align-items: center;">
                <h2 class="text-dark" style="position: relative; top: 3px;">Rental Mobil Lepas Kunci</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card border border-dark">
                    <div class="card-body">
                        <span class="title">Syarat Sewa Mobil Dengan Supir</span>
                        <hr>
                        <span>Sudah Termasuk</span>
                        <ul>
                            <li>Penggunan Dalam Kota</li>
                            <li>Penggunaan sampai dengan 12 jam atau hinggan 23:59 di setiap hari rental.</li>
                        </ul>
                        <span>Tidak Termasuk</span>
                        <ul>
                            <li>Bensin, parkir, tol, uang makan supir dan tips</li>
                            <li>Biaya akomodasi supir selama bepergian keluar kota</li>
                            <li>Penggunaan diluar kota (biaya tambahan berlaku)</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card border border-dark">
                    <div class="card-body">
                        <span class="title">Syarat Sewa Mobil Lepas Kunci</span>
                        <hr>
                        <span>Sudah Termasuk</span>
                        <ul>
                            <li>Asuransi untuk mobil dan penumpang</li>
                            <li>Penggunaan hingga 24 jam per hari</li>
                        </ul>
                        <span>Tidak Termasuk</span><br>
                        <span>Bensin, pengambilan/pengembalian di luar kota, dan klaim asuransi</span>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="favorite_car" style="margin-bottom: 100px;">
        <div class="section-title" style="margin-bottom: 25px;">
            <div style="display: flex; align-items: center;">
                <h2 class="text-dark" style="position: relative; top: 3px;">Rental Mobil Lepas Kunci</h2>
            </div>
        </div>
        <div class="d-flex flex-row gap-2">
            @foreach ($favorites_car as $car)
            <div class="card border border-dark rounded-4">
                <img src="{{ $car->img != '' ? $car->img : 'https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg' }}"
                    class="card-img-top-rounded" alt="...">
                <div class="card-body">
                    <div class="card-content">
                        <div class="lokasi d-flex justify-content-center">
                            <span class="fw-bold">{{ $car->name }}</span>
                        </div>

                        <div class="price mt-7 d-flex flex-row align-items-center justify-content-center">
                            <span class="fa-solid fa-suitcase"></span>
                            <span class="ms-1">{{ $car->lugage }}</span>
                            <span class="fa-solid fa-user ms-5"></span>
                            <span class="ms-1">{{ $car->passage }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <section class="favorite_car" style="margin-bottom: 100px;">
        <div class="section-title" style="margin-bottom: 25px;">
            <div style="display: flex; align-items: center;">
                <h2 class="text-dark" style="position: relative; top: 3px;">Rental Mobil Terdekata di Kota Lainnya</h2>
            </div>
        </div>
        <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6">
            @foreach ($near_location as $loaction)
            <div class="col p-3">
                <div class="card border border-dark rounded-4">
                    <img src="{{ $loaction->img != '' ? $loaction->img : 'https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg' }}"
                        class="card-img-top-rounded card-img-bottom-rounded" alt="...">

                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>

@push('js')
@endpush