@push('add-style')
<style>
    .minh-350 {
        min-height: 350px !important;
    }

    .extra-content {
        display: none;
        margin-top: 16px;
        color: #555;
        max-height: 0;
        /* Sembunyikan konten yang terpotong */
        transition: max-height 0.75s ease-in-out;
        /* Animasi smooth */
        padding: 0;
        /* Awalnya padding diset ke 0 */
    }

    .extra-content.show {
        display: block;
        max-height: 2000px;
        /* Atur sesuai dengan tinggi maksimal konten */
    }

    .toggle-button {
        background: none;
        border: none;
        color: #007bff;
        cursor: pointer;
        font-size: 14px;
    }
</style>
@endpush
<div class="container mb-5">
    <section style="margin-bottom: 60px">
        <div class="row">
            <div class="col-4">
                <div class="card shadow-sm rounded-4 overflow-hidden">
                    <div class="rounded-circle bg-danger position-absolute opacity-25"
                        style="width:100px; height:100px; top: -50px; right: -40px;">
                    </div>
                    <div class="rounded-circle bg-danger position-absolute"
                        style="width:25px; height:25px; top: 35px; right: -10px;">
                    </div>
                    <div class="card-body d-flex flex-column justify-content-start" style="z-index: 10;">
                        <div class="bg-danger text-light rounded-circle d-flex justify-content-center align-items-center"
                            style="width: 25px; height: 25px; right:0;">
                            <span class="fa-solid fa-car"></span>
                        </div>
                        <span class="card-title fw-bold my-2">Cara Menyewa Mobil</span>
                        <span>Cari tau mudahnya cara memesan Sewa mobil di Travelsya</span>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card shadow-sm rounded-4 overflow-hidden">
                    <div class="rounded-circle bg-danger position-absolute opacity-25"
                        style="width:100px; height:100px; top: -50px; right: -40px;">
                    </div>
                    <div class="rounded-circle bg-danger position-absolute"
                        style="width:25px; height:25px; top: 35px; right: -10px;">
                    </div>
                    <div class="card-body d-flex flex-column justify-content-start">
                        <div class="bg-danger text-light rounded-circle d-flex justify-content-center align-items-center"
                            style="width: 25px; height: 25px;">
                            <span class="fa-solid fa-file"></span>
                        </div>
                        <span class="card-title fw-bold my-2">Syarat Sewa Mobil</span>
                        <span>Baca apa saja yang perlu kamu tahu dan siapkan sebelum menyewa</span>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card shadow-sm rounded-4 overflow-hidden">
                    <div class="rounded-circle bg-danger position-absolute opacity-25"
                        style="width:100px; height:100px; top: -50px; right: -40px;">
                    </div>
                    <div class="rounded-circle bg-danger position-absolute"
                        style="width:25px; height:25px; top: 35px; right: -10px;">
                    </div>
                    <div class="card-body d-flex flex-column justify-content-start">
                        <div class="bg-danger text-light rounded-circle d-flex justify-content-center align-items-center"
                            style="width: 25px; height: 25px;">
                            <span class="fa-solid fa-shield"></span>
                        </div>
                        <span class="card-title fw-bold my-2">Persyaratan Perjalanan</span>
                        <span>Cek protokol dan syarat selama pandemi</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="with_cheuffeur" style="margin-bottom: 60px;">
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

    <section class="with_cheuffeur" style="margin-bottom: 60px;">
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

    <section class="without_cheuffeur" style="margin-bottom: 60px;">
        <div class="section-title" style="margin-bottom: 25px;">
            <div style="display: flex; align-items: center;">
                <h2 class="text-dark" style="position: relative; top: 3px;">Rental Mobil Lepas Kunci</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card border border-dark minh-350">
                    <div class="card-body d-flex flex-column align-items-start">
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
                        <div class="extra-content">
                            <p>Detail tambahan yang di-hidden sebelumnya bisa ditambahkan di sini.</p>
                        </div>
                        <button class="btn btn-link text-danger mt-sm-auto toggle-button">Baca Lebih Banyak <span
                                class="fa-solid fa-chevron-down fw-bold" id="rotatable_icon"></span></button>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card border border-dark minh-350">
                    <div class="card-body d-flex flex-column align-items-start">
                        <span class="title">Syarat Sewa Mobil Lepas Kunci</span>
                        <hr>
                        <span>Sudah Termasuk</span>
                        <ul>
                            <li>Asuransi untuk mobil dan penumpang</li>
                            <li>Penggunaan hingga 24 jam per hari</li>
                        </ul>
                        <span>Tidak Termasuk</span><br>
                        <span>Bensin, pengambilan/pengembalian di luar kota, dan klaim asuransi</span>
                        <button class="btn btn-link text-danger mt-sm-auto">Baca Lebih Banyak <span
                                class="fa-solid fa-chevron-down fw-bold" id="rotatable_icon"></span></button>
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
        <div class="row row-cols-6 row-cols-lg-6 g-6 g-lg-6 justify-content-center">
            @foreach ($car_models as $model)
            <div class="col p-3">
                <a href="javascript:" class="text-decoration-none text-dark" id="provider_button" data-toogle="modal"
                    data-target="#providers">
                    <div class="card border border-dark rounded-4">
                        <img src="{{ $model->img != '' ? $model->img : 'https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg' }}"
                            class="card-img-top-rounded" alt="...">
                        <div class="card-body">
                            <div class="card-content">
                                <div class="lokasi d-flex justify-content-center">
                                    <span class="fw-bold">{{ $model->name }}</span>
                                </div>

                                <div class="price mt-7 d-flex flex-row align-items-center justify-content-center">
                                    <span class="fa-solid fa-suitcase"></span>
                                    <span class="ms-1">{{ $model->lugage }}</span>
                                    <span class="fa-solid fa-user ms-5"></span>
                                    <span class="ms-1">{{ $model->passage }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
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
            @foreach ($near_location as $location)
            <div class="col p-3">
                <div class="card border border-dark rounded-4 position-relative">
                    <img src="{{ $location->img != '' ? $location->img : 'https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg' }}"
                        class="card-img-top-rounded card-img-bottom-rounded img-fluid" style="filter: brightness(0.5)"
                        alt="...">
                    <h3 class="position-absolute translate-middle fw-bold text-light fs-2 shadow"
                        style="top: 50%; left: 50%;">
                        {{
                        $location->name }}
                    </h3>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>

@include('pagesv2.car_rent.components._vendor_modal')

@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleButton = document.querySelector(".toggle-button");
        const extraContent = document.querySelector(".extra-content");

        toggleButton.addEventListener("click", function () {
            if (extraContent.classList.contains("show")) {
            extraContent.classList.remove("show");
            toggleButton.textContent = "Baca lebih banyak";
            } else {
            extraContent.classList.add("show");
            toggleButton.textContent = "Baca lebih sedikit";
            }
        });
    });

</script>
@endpush