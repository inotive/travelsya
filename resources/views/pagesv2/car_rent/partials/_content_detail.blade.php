<div class="container mb-5">
    <section class="special-deals mt-5">

        <h3 class="mb-35px">Detail Kendaraan dan Vendor</h3>

        <div class="card shadow mb-35px">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-3">
                        <img src="{{ asset('/storage/' . $car->image_url) }}"
                            onerror="this.src='https://images.unsplash.com/photo-1588440983028-d53e24fa96cc?q=80&w=3870&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'"
                            class="img-fluid rounded shadow w-100" style="object-fit: contain;" alt="...">
                    </div>
                    <div class="col-9 d-flex flex-column">
                        <h5 class="mb-3">{{ $car->brand->name }}</h5>
                        <span class="text-danger mb-3">{{ $car->carRental->business_name }}</span>
                        <table class="table borderless">
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
                                    <span class="fa-solid fa-suitcase"></span>
                                    <span class="ms-2">Air Mineral</span>
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

        <div class="card bg-danger bg-opacity-25 mb-35px">
            <div class="card-body d-flex flex-column">
                <h3 class="mb-3">Kebijakan Rental</h3>
                <div class="d-flex flex-row">
                    <div>
                        {!! $car->policy->description !!}
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
                        <span class="fs-3 title fw-bold">{{
                            \App\Helpers\General::getDayDateShortMonth(\App\Helpers\General::addingDays($date,
                            $duration)) }}</span>
                        <span class="fs-4">{{ date('H:i', strtotime(\App\Helpers\General::addingDays($date, $duration)))
                            }}</span>
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
                    <h6 class="fw-bold ms-sm-auto">IDR {{ number_format($car->rental_price_per_day * $duration, 0, ',',
                        '.') }}</h6>
                </div>
                <div class="d-flex flex-row align-items-center py-5">
                    <span>Kamu akan mendapatkan XXXX Poin</span>
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