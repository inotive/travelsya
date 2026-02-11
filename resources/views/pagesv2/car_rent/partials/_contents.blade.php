@push('add-style')
    <style>
        .extra-content {
            display: none;
            margin-top: 16px;
            color: #555;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-in-out, opacity 0.3s ease-in-out;
            opacity: 0;
            padding: 0 15px;
        }

        .extra-content.show {
            display: block;
            max-height: 1000px;
            opacity: 1;
        }

        .toggle-button {
            background: none;
            border: none;
            color: #007bff;
            cursor: pointer;
            font-size: 14px;
            padding: 5px 0;
            margin-top: auto;
        }

        /* Definisi class d-none yang lebih kuat */
        .d-none {
            display: none !important;
            visibility: hidden !important;
        }

        .min-h-350 {
            min-height: 350px;
        }

        .card-body {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card-body > *:not(.extra-content):not(.toggle-button) {
            flex-shrink: 0;
        }

        .extra-content {
            flex-shrink: 0;
        }

        /* CSS for 3:2 aspect ratio images */
        .card-img-container {
            position: relative;
            width: 100%;
            padding-top: 66.67%; /* 3:2 aspect ratio (2/3 = 0.6667) */
            overflow: hidden;
        }

        .card-img-aspect {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
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
                <h2 class="text-dark" style="position: relative; top: 3px;">Syarat Rental Mobil</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card border border-dark min-h-350">
                    <div class="card-body d-flex flex-column">
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
                            {{-- jika ingin menambah extra content taruh di dalam sini --}}
                        </div>
                        <button class="btn btn-link text-danger mt-auto toggle-button d-none">Baca Lebih Banyak <span
                                class="fa-solid fa-chevron-down fw-bold"></span></button>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card border border-dark min-h-350">
                    <div class="card-body d-flex flex-column">
                        <span class="title">Syarat Sewa Mobil Lepas Kunci</span>
                        <hr>
                        <span>Sudah Termasuk</span>
                        <ul>
                            <li>Asuransi untuk mobil dan penumpang</li>
                            <li>Penggunaan hingga 24 jam per hari</li>
                        </ul>
                        <span>Tidak Termasuk</span><br>
                        <span>Bensin, pengambilan/pengembalian di luar kota, dan klaim asuransi</span>
                        <div class="extra-content">
                            {{-- jika ingin menambah extra content taruh di dalam sini --}}
                        </div>
                        <button class="btn btn-link text-danger mt-auto toggle-button d-none">Baca Lebih Banyak <span
                                class="fa-solid fa-chevron-down fw-bold"></span></button>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="favorite_car" id="favorite_car" style="margin-bottom: 100px;">
        <div class="section-title" style="margin-bottom: 25px;">
            <div style="display: flex; align-items: center;">
                <h2 class="text-dark" style="position: relative; top: 3px;">Kendaraan Favorit Rental Mobil di Travelsya
                </h2>
            </div>
        </div>
        <div class="row justify-content-center">
            @if(isset($popular_brands) && $popular_brands->isNotEmpty())
                @foreach ($popular_brands as $brand)
                    <div class="col-12 col-md-4 col-xl-3 mb-4">
                        <form action="{{ route('car_rent.show') }}" method="post"
                            id="form_favorite_brand{{ $brand->id }}">
                            @csrf
                            <input type="hidden" name="brand_id" value="{{ $brand->id }}">
                            <input type="hidden" name="category" value="">
                            <input type="hidden" name="location" value="">
                            <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
                            <input type="hidden" name="time" value="08:00">
                            <input type="hidden" name="duration" value="1">
                            <div class="col p-3">
                                <a href="javascript:" class="text-decoration-none text-dark"
                                    id="provider_button_brand{{ $brand->id }}" onclick="submit_brand({{ $brand->id }})">
                                    <div class="card border border-dark rounded-4 h-100">
                                        <div class="card-img-container" style="overflow: hidden;">
                                            <img src="{{ $brand->image ? Storage::url($brand->image) : 'https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg' }}"
                                                 class="card-img-top card-img-aspect"
                                                 alt="{{ $brand->name ?? 'Car Brand' }}"
                                                 onerror="this.src='https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg'">
                                        </div>
                                        <div class="card-body d-flex flex-column">
                                            <div class="card-content flex-grow-1">
                                                <div class="lokasi d-flex justify-content-center">
                                                    <span class="fw-bold">{{ $brand->name ?? 'Invalid Brand' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </form>
                    </div>
                @endforeach
            @else
                @foreach ($car_models->take(4) as $model)
                    <div class="col-12 col-md-4 col-xl-3 mb-4">
                        @php
                            // Prepare parameters for the detail route, with sensible defaults
                            $lokasi = optional($model->carRental)->kota->city_name ?? 'jakarta';
                            $tanggal = date('Y-m-d') . ' ' . '08:00';
                        @endphp
                        <a href="{{ route('car_rent.detail', [
                            'category' => 'dengan-driver', // Default category
                            'lokasi' => $lokasi,
                            'model' => $model->car_model_id,
                            'provider' => $model->id,
                            'date' => $tanggal,
                            'duration' => 1 // Default duration
                        ]) }}" class="text-decoration-none text-dark">
                            <div class="card border border-dark rounded-4 h-100">
                                <div class="card-img-container" style="overflow: hidden;">
                                    <img src="{{ optional($model->carModel)->image ? Storage::url(optional($model->carModel)->image) : 'https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg' }}"
                                         class="card-img-top card-img-aspect"
                                         alt="{{ optional($model->carModel)->name ?? 'Car Model' }}"
                                         onerror="this.src='https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg'">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="card-content flex-grow-1">
                                        <div class="lokasi d-flex justify-content-center">
                                            <span class="fw-bold">{{ optional($model->carModel)->name ?? 'Invalid Model' }}</span>
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
                @endforeach
            @endif
        </div>
    </section>

    <section class="near_location" style="margin-bottom: 100px;">
        <div class="section-title" style="margin-bottom: 25px;">
            <div style="display: flex; align-items: center;">
                <h2 class="text-dark" style="position: relative; top: 3px;">Rental Mobil Terdekat Di Kota Lainnya
                </h2>
            </div>
        </div>
        <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6">
            @foreach ($near_location as $key => $location)
                @if($key)
                    <div class="col p-3">
                        <form action="{{ route('car_rent.show') }}" method="post"
                            id="form_location{{ \App\Helpers\General::getSlug($location) }}">
                            @csrf
                            <input type="hidden" name="location" value="{{ $location }}">
                            <input type="hidden" name="category" value="">
                            <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
                            <input type="hidden" name="time" value="08:00">
                            <input type="hidden" name="duration" value="1">
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
                @endif
            @endforeach
        </div>
    </section>
</div>

@push('js')
    <script>
        // Fungsi untuk mengatur visibilitas tombol berdasarkan jumlah konten
        function checkContentHeight() {
            const cardSections = document.querySelectorAll('.without_cheuffeur .col-6');

            cardSections.forEach((section, index) => {
                const extraContent = section.querySelector('.extra-content');
                const toggleButton = section.querySelector('.toggle-button');

                if (extraContent && toggleButton) {
                    // Hitung jumlah karakter dalam konten tambahan
                    const contentText = extraContent.textContent || extraContent.innerText;
                    const contentLength = contentText.length;

                    // Tampilkan tombol jika konten melebihi batas karakter
                    if (contentLength > 200) {
                        toggleButton.classList.remove('d-none');
                    } else {
                        toggleButton.classList.add('d-none');
                    }
                }
            });
        }

        // Fungsi untuk memastikan fungsi checkContentHeight() dipanggil beberapa kali
        function ensureCheckContentHeight() {
            // Panggil fungsi dengan beberapa delay berbeda
            setTimeout(checkContentHeight, 100);
            setTimeout(checkContentHeight, 500);
            setTimeout(checkContentHeight, 1000);
            setTimeout(checkContentHeight, 2000);
        }

        document.addEventListener("DOMContentLoaded", function() {
            ensureCheckContentHeight();

            // Tambahkan event listener untuk tombol toggle
            const toggleButtons = document.querySelectorAll(".toggle-button");

            toggleButtons.forEach((button) => {
                button.addEventListener("click", function() {
                    const extraContent = this.closest('.card-body').querySelector(".extra-content");

                    if (extraContent.classList.contains("show")) {
                        extraContent.classList.remove("show");
                        button.innerHTML = 'Baca Lebih Banyak <span class="fa-solid fa-chevron-down fw-bold"></span>';
                    } else {
                        extraContent.classList.add("show");
                        button.innerHTML = 'Baca Lebih Sedikit <span class="fa-solid fa-chevron-up fw-bold"></span>';
                    }
                });
            });
        });

        // Panggil fungsi setelah window load untuk memastikan layout sudah stabil
        window.addEventListener('load', function() {
            ensureCheckContentHeight();
        });

        // Panggil fungsi saat window resized
        window.addEventListener('resize', function() {
            setTimeout(checkContentHeight, 100);
        });
    </script>
    <script>
        function submit(val) {
            // Tambahkan logging untuk debugging
            console.log('Submitting favorite car form:', val);
            $("form#form_favorite_car" + val).submit();
            return false;
        };

        function submit_brand(val) {
            // Tambahkan logging untuk debugging
            console.log('Submitting favorite brand form:', val);
            $("form#form_favorite_brand" + val).submit();
            return false;
        };

        function submit_location(val) {
            // Tambahkan logging untuk debugging
            console.log('Submitting location form:', val);
            $("form#form_location" + val).submit();
            return false;
        };
    </script>
@endpush
