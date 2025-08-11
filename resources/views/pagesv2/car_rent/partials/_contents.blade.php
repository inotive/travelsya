@push('add-style')
    <style>
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
            @foreach ($rule as $r)
                <div class="col-4">
                    <div class="card shadow-sm rounded-4 overflow-hidden">
                        <div class="rounded-circle position-absolute"
                            style="background-color: #FFEEF1; width:100px; height:100px; top: -50px; right: -40px;">
                        </div>
                        <div class="rounded-circle position-absolute"
                            style="background-color: #FFBDBE; width:25px; height:25px; top: 35px; right: -10px;">
                        </div>
                        <div class="card-body d-flex flex-column justify-content-start" style="z-index: 10;">
                            <div class="bg-danger text-light rounded-circle d-flex justify-content-center align-items-center"
                                style="width: 25px; height: 25px; right:0;">
                                <span class="{{ $r['icon'] }}"></span>
                            </div>
                            <span class="card-title fw-bold my-2 text-capitalize">{{ $r['title'] }}</span>
                            <span>{{ $r['content'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="with_cheuffeur" style="margin-bottom: 60px;">
        <div class="section-title" style="margin-bottom: 25px;">
            <div style="display: flex; align-items: center;">
                <h2 class="text-dark" style="position: relative; top: 3px;">Rental Mobil Dengan Supir</h2>
            </div>
        </div>
        <p class="w-100">
            Bepergian berssama keluarga atau kerabat semakin asyik juka anda menggunakan sarana transpotrasi yang tepat.
            sewa mobil atau carter mobil dapat menjadi pilihan terbaik untuk memudahkan mobilitas anda. untuk semakin
            mendukung fleksibilitas anda saat bepergian, travelsya kini telah menjadi aplikasi sewa mobil yang
            terpercaya. aplikasi rental mobil travelsya membuat anda dapat menikmati kenyamanan ini dengan memesan
            langsung layanan rental mobil yang anda butuhkan . temukan berbagai pilihan mobil terbaik lengkap dengan
            tarif mobil yang dibutuhkan. cek harga sewa mobil harian untuk segera kepeluan anda.
        </p>
        <p class="w-100">
            Dapatkan durasi rental 24jan dengan memesan layanan sewa mobil lepas kunci di travelsya. jadikan perjalanan
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
                <div class="card border border-dark min-h-350">
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
                <div class="card border border-dark min-h-350">
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

    <section class="favorite_car" id="favorite_car" style="margin-bottom: 100px;">
        <div class="section-title" style="margin-bottom: 25px;">
            <div style="display: flex; align-items: center;">
                <h2 class="text-dark" style="position: relative; top: 3px;">Kendaraan Favorite Rental Mobil di Travelsya
                </h2>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach ($car_models as $model)
            {{-- {{ dd($model) }} --}}
                <div class="col-12 col-md-4 col-xl-3">
                    <form action="{{ route('car_rent.show') }}" method="post"
                        id="form_favorite_car{{ $model->id }}">
                        @csrf
                        <input type="hidden" name="model_id" value="{{ $model->car_model_id }}">
                        <div class="col p-3">
                            <a href="javascript:" class="text-decoration-none text-dark"
                                id="provider_button{{ $model->id }}" onclick="submit({{ $model->id }})">
                                <div class="card border border-dark rounded-4">
                                    <img src="{{ asset($model->carModel->image) }}" class="card-img-top-rounded"
                                        alt="..."
                                        onerror="this.src='https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg'">
                                    <div class="card-body">
                                        <div class="card-content">
                                            <div class="lokasi d-flex justify-content-center">
                                                <span class="fw-bold">{{ $model->carModel->name ?? 'Invalid Model' }}
                                                    {{ $model->brand->name ?? 'Invalid Brand' }}</span>
                                            </div>

                                            <div
                                                class="price mt-7 d-flex flex-row align-items-center justify-content-center">
                                                <span class="fa-solid fa-suitcase"></span>
                                                <span class="ms-1">{{ $model->koper }}</span>
                                                <span class="fa-solid fa-user ms-5"></span>
                                                <span class="ms-1">{{ $model->number_seats }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </section>

    <section class="near_location" style="margin-bottom: 100px;">
        <div class="section-title" style="margin-bottom: 25px;">
            <div style="display: flex; align-items: center;">
                <h2 class="text-dark" style="position: relative; top: 3px;">Rental Mobil Terdekata di Kota Lainnya
                </h2>
            </div>
        </div>
        <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6">
            @foreach ($near_location as $location)
                <div class="col p-3">
                    <form action="{{ route('car_rent.show') }}" method="post"
                        id="form_location{{ \App\Helpers\General::getSlug($location) }}">
                        @csrf
                        <input type="hidden" name="location" value="{{ $location }}">
                        <a href="javascript:" class="text-decoration-none text-dark"
                            id="location_button{{ \App\Helpers\General::getSlug($location) }}"
                            onclick="submit_location('{{ \App\Helpers\General::getSlug($location) }}')">
                            <div class="card border border-dark rounded-4 position-relative">
                                <img src="{{ $location }}"
                                    onerror="this.src='https://images.unsplash.com/photo-1718729362445-51d2da1ee7a7?q=80&w=3871&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'"
                                    class="card-img-top-rounded card-img-bottom-rounded img-fluid"
                                    style="filter: brightness(0.5)" alt="...">
                                <h3 class="position-absolute translate-middle fw-bold text-center text-light fs-2 shadow"
                                    style="top: 50%; left: 50%;">
                                    {{ $location }}
                                </h3>
                            </div>
                        </a>
                    </form>
                </div>
            @endforeach
        </div>
    </section>
</div>

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleButton = document.querySelector(".toggle-button");
            const extraContent = document.querySelector(".extra-content");

            toggleButton.addEventListener("click", function() {
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
    <script>
        function submit(val) {
            $("form#form_favorite_car" + val).submit();
            e.preventDefault();
            return false;
        };

        function submit_location(val) {
            $("form#form_location" + val).submit();
            e.preventDefault();
            return false;
        };
    </script>
@endpush
