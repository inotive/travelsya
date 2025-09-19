<div class="container mb-5">
    <section class="special-deals mt-5">

        <h3 class="mb-35px">Detail Kendaraan dan Vendor</h3>

        <div class="card shadow mb-35px">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-3">
                        <!-- Gambar Utama -->
                        <div class="position-relative">
                            <div class="card-img-container" style="overflow: hidden;">
                                <img id="main-car-image"
                                    src="{{ asset($car->brand->image) }}"
                                    onerror="this.src='https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg'"
                                    class="card-img-aspect img-fluid rounded shadow" alt="{{ $car->brand->name }}">
                            </div>

                            <!-- Tombol untuk membuka modal gambar, jika ada lebih dari 1 gambar -->
                            @if(isset($car->images) && $car->images->count() > 1)
                            <button type="button" class="btn btn-sm btn-outline-light position-absolute bottom-0 end-0 m-2"
                                data-bs-toggle="modal" data-bs-target="#carImagesModal">
                                <i class="fas fa-images"></i> Lihat Semua Gambar
                            </button>
                            @endif
                        </div>
                    </div>
                    <div class="col-9 d-flex flex-column">
                        <h5 class="mb-3">{{ $car->brand->name }}</h5>
                        <span class="text-danger mb-3">{{ $car->carRental->business_name }}</span>
                        <table class="table borderless">
                            <tr style="border-top: 2px dashed black; vertical-align: top;">
                                <td>
                                    <span class="fa-solid fa-key"></span>
                                    <span class="ms-2"><strong>Titik Pengambilan</strong><br>
                                    {{ $car->pickup_location ?? 'Sama dengan alamat agent.' }}</span>
                                </td>
                                <td>
                                    <span class="fa-solid fa-map-location-dot"></span>
                                    <span class="ms-2"><strong>Alamat Agent</strong><br>
                                    {{ $car->carRental->address ?? 'Alamat detail tidak tersedia.' }}</span>
                                </td>
                            </tr>
                            <tr style="border-top: 2px dashed black;">
                                <td>
                                    <span class="fa-solid fa-user-group"></span>
                                    <span class="ms-2">1 - {{ $car->number_seats }} Penumpang</span>
                                </td>
                                <td>
                                    <span class="fa-solid fa-gears"></span>
                                    <span class="ms-2">{{ $car->category }}</span>
                                </td>
                            </tr>
                            <tr style="border-top: 2px dashed black;">
                                <td>
                                    <span class="fa-solid fa-building"></span>
                                    <span class="ms-2">{{ $car->carRental->kota->city_name ?? 'Lokasi Tidak Diketahui' }}</span>
                                </td>
                                <td>
                                    <span class="fa-solid fa-user"></span>
                                    <span class="ms-2">{{ ucwords($car->category_rent) }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Semua Gambar Mobil -->
        @if(isset($car->images) && $car->images->count() > 0)
        <div class="modal fade" id="carImagesModal" tabindex="-1" aria-labelledby="carImagesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="carImagesModalLabel">Semua Gambar {{ $car->brand->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Carousel untuk Gambar -->
                        <div id="carImagesCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($car->images as $index => $image)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <div style="display: flex; justify-content: center; align-items: center; height: 70vh;">
                                            <img src="{{ asset($image->url ?? $image) }}"
                                                 class="d-block mw-100 mh-100"
                                                 style="object-fit: contain; max-height: 70vh;"
                                                 alt="Gambar {{ $car->brand->name }} {{ $index + 1 }}"
                                                 onerror="this.src='https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg'">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carImagesCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carImagesCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                        <!-- Thumbnail Scrollable -->
                        <div class="d-flex overflow-auto mt-3 py-2" style="gap: 10px;">
                            @foreach ($car->images as $index => $image)
                                <div class="flex-shrink-0">
                                    <img src="{{ asset($image->url ?? $image) }}"
                                         class="img-thumbnail"
                                         style="width: 100px; height: 75px; object-fit: cover; cursor: pointer;"
                                         alt="Thumbnail {{ $car->brand->name }} {{ $index + 1 }}"
                                         data-bs-target="#carImagesCarousel"
                                         data-bs-slide-to="{{ $index }}"
                                         onerror="this.src='https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg'">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="card bg-danger bg-opacity-25 mb-35px">
            <div class="card-body d-flex flex-column">
                <h3 class="mb-3">Kebijakan Rental</h3>
                <div class="d-flex flex-row">
                    <div>
                        {!! $car->policy?->description ?? 'Kebijakan tidak tersedia.' !!}
                    </div>
                </div>
            </div>
        </div>

        @include('pagesv2.car_rent.components._review')

        <h3 class="mb-35px">Waktu Sewa</h3>

        <div class="card shadow mb-35px">
            <div class="card-body">
                <div class="row pb-3 mb-3" style="border-bottom:2px dashed black;">
                    <div class="col-6 d-flex flex-column">
                        <span>Tanggal Penjemputan</span>
                        <span class="fs-3 title fw-bold">{{ \App\Helpers\General::getDayDateShortMonth($date) }}</span>
                        <span class="fs-4">{{ \Carbon\Carbon::parse($date)->format('H:i') }}</span>
                    </div>
                    <div class="col-6 d-flex flex-column">
                        <span>Tanggal Drop-off</span>
                        <span
                            class="fs-3 title fw-bold">{{ \App\Helpers\General::getDayDateShortMonth(\App\Helpers\General::addingDays($date, $duration)) }}</span>
                        <span
                            class="fs-4">{{ date('H:i', strtotime(\App\Helpers\General::addingDays($date, $duration))) }}</span>
                    </div>
                </div>
                <span class="text-success">Bisa refund, reschedule, dan overtime</span>
                <span class="fa-solid fa-chevron-right"></span>
            </div>
        </div>

        {{-- <h3 class="mb-35px">Tentang Paket Reguler</h3>

        <div class="row mb-35px">
            <div class="col-6">
                <div class="card border" style="min-height: 250px;">
                    <div class="card-body">
                        <h5>Sudah Termasuk</h5>
                        <ul>
                            <li>Penggunaan mobil di Area 0 selama 12 jam atau hingga 23:59 jika mulai sewa di atas puku;
                                12:00</li>
                            <li>Gratis antar jemput di Area 0</li>
                            <li>Biaya jasa sopir</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card border" style=" min-height: 250px;">
                    <div class="card-body">
                        <h5>Sudah Termasuk</h5>
                        <ul>
                            <li>Biaya bensin minimal IDR 50.000 atau mengikuti bar awal</li>
                            <li>Biaya makana sopir sejumlah IDR 75.000, bensin, tol, dan parkir</li>
                            <li>antar jemput dan penggunaan mobil di luar di area 0. <span class="text-success">*kamu
                                    bisa tambah area dihalaman selanjutnya.</span></li>
                            <li>Penggunaan Overtime, dan penginapan sopir (jika menginap diliuat Area )
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="card border">
            <div class="card-body">
                <div class="d-flex flex-row align-items-center border-bottom-dashed py-5">
                    <span class="title fw-bold">Total Pembayaran</span>
                    <h6 class="fw-bold ms-sm-auto">IDR
                        {{ number_format($car->rental_price_per_day * $duration, 0, ',', '.') }}
                    </h6>
                </div>
                <div class="d-flex flex-row align-items-center py-5">
                    <span>Kamu akan mendapatkan {{ \App\Helpers\General::countPoint($car->rental_price_per_day * $duration, $service_id) }} Poin</span>
                    <form action="{{ route('car_rent.order') }}" method="post" class="ms-sm-auto">
                        @csrf
                        <input type="hidden" name="provider" value="{{ $provider }}">
                        <input type="hidden" name="car_id" value="{{ $car->id }}">
                        <input type="hidden" name="duration" value="{{ $duration }}">
                        <input type="hidden" name="lokasi" value="{{ $lokasi }}">
                        <input type="hidden" name="model" value="{{ $model }}">
                        <input type="hidden" name="date" value="{{ $date }}">
                        <input type="hidden" name="category" value="{{ $category }}">
                        <button type="submit" class="btn btn-danger" style="margin-left: auto;"
                            id="button_paket_1">Lanjut Ke Form Pemesanan</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- @if ($facility)
        <div class="px-3 mb-35px d-flex flex-column fs-4" id="deskripsi">
            <div class="section-title mb-4">
                <div class="w-100 title text-capitalize" style="font-size: calc(1rem + 0.85vw)">
                    Fasilitas
                </div>
            </div>
            <div id="description" class="d-flex flex-row align-items-center">
                <span class="fa-solid fa-store"></span>
                <span class="ms-2">Toko Suvenir</span>
                <span class="fa-solid fa-camera ms-5"></span>
                <span class="ms-2">Spot Foto</span>
                <span class="fa-solid fa-utensils ms-5"></span>
                <span class="ms-2">Restoran/Food Court</span>
            </div>
        </div>
        @endif --}}

        @push('js')
            <script>
                $(document).ready(function() {
                    $("#list_paket").on("click", "#decrease_paket", function() {
                        let id = $(this).attr("id_paket");
                        let val_paket = parseInt($("#val_paket_" + id).val());
                        let decrease_val = val_paket;
                        if (val_paket - 1 >= 0) {
                            decrease_val = val_paket - 1;
                        }
                        $("#val_paket_" + id).val(decrease_val);
                        $("#dummy_paket_" + id).text(decrease_val);
                    })


                    $("#list_paket").on("click", "#increase_paket", function() {
                        let id = $(this).attr("id_paket");
                        let val_paket = parseInt($("#val_paket_" + id).val());
                        let increase_val = val_paket + 1;
                        console.log(increase_val);

                        $("#val_paket_" + id).val(increase_val);
                        $("#dummy_paket_" + id).text(increase_val);
                    })
                });
            </script>
        @endpush
    </section>
</div>
