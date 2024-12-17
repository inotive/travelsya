@extends('layouts.app_v2')

@push('add-style')
<style>
    .accent-danger {
        accent-color: var(--bs-danger);
    }
</style>
@endpush

@section('content')
<div class="container mb-5">
    <section class="special-deals mt-5">

        <div class="row" style="padding-top: 50px;">
            <div class="col-8">

                <div class="section-title" style="margin-bottom: 25px;">
                    <div style="display: flex; align-items: center;">
                        <h2 class="text-dark" style="position: relative; top: 3px;">Lokasi Jemput</h2>
                    </div>
                    <div class="opacity-50 fs-5 mt-2">Isi dengan lokasi jemput pada hari sewa pertamamu. (1)
                        Biaya jemput serta penggunaan mobil berlaku untuk lokasi di luar area 0 (Paket Reguler) atau
                        area
                        2 (Paket All-in). (2) Biaya jemput hanya untuk hari pertama, biaya hari selanjutnya harus
                        dibayarkan langsung ke vendor</div>
                </div>
                <div class="accordion" id="accord_jemput">
                    <div class="card shadow mb-35px">
                        <div class="card-header d-flex flex-row align-items-center" id="header_jemput">
                            <button class="btn btn-link btn-block text-danger fw-bold" type="button"
                                data-toggle="collapse" data-target="#collapse_jemput" aria-expanded="true"
                                aria-controls="collapse_jemput">Pilih Lokasi</button>
                            <span class="fa-solid fa-chevron-right ms-sm-auto"></span>
                        </div>
                        <div class="collapse" id="collapse_jemput" aria-labelledby="header_jemput"
                            data-parent="#accord_jemput">
                            <div class="card-body">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-title" style="margin-bottom: 25px;">
                    <div style="display: flex; align-items: center;">
                        <h2 class="text-dark" style="position: relative; top: 3px;">Lokasi Drop-off</h2>
                    </div>
                    <div class="opacity-50 fs-5 mt-2">isi dengan lokasi drop-off pada hari sewa terakhirmu. (1) Biaya
                        drop-pgg
                        serta penggunaan mobil berlaku untuk lokasi luat araa 0 (paket Reguler) atau area 2 (Paket
                        All-in). (2) Biaya drop-off hanya untuk hari terakhor. Biaya hari sebelumnya haru si</div>
                </div>
                <div class="card shadow mb-35px">
                    <div class="card-body d-flex flex-column">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                                checked>
                            <label class="form-check-label" for="flexSwitchCheckChecked">Sama dengan lokasi
                                jemput</label>
                        </div>
                        <hr>
                        <div class="d-flex flex-row align-items-center">
                            <span class="text-danger fw-bold">Pilih Lokasi</span>.
                            <span class="fa-solid fa-chevron-right ms-sm-auto"></span>
                        </div>
                    </div>
                </div>
                <div class="section-title" style="margin-bottom: 25px;">
                    <div style="display: flex; align-items: center;">
                        <h2 class="text-dark" style="position: relative; top: 3px;">Fasilitas Ekstra</h2>
                    </div>
                </div>
                <div class="card shadow mb-3">
                    <div class="card-body d-flex flex-row align-items-center">
                        <div class="d-flex flex-column">
                            <h5>Paket All-In</h5>
                            <span>Tinggal duduk manis, sewa mobil anti ribet pakai paket ini .</span>
                        </div>
                        <span class="fa-solid fa-plus-square text-danger fs-2 ms-sm-auto"></span>
                    </div>
                </div>
                <div class="card shadow mb-35px">
                    <div class="card-body d-flex flex-row align-items-center">
                        <div class="d-flex flex-column">
                            <h5>Permintaan Khusus</h5>
                            <span>tulis kebutuhan kamu biar sewa mobil bersasa punya mobil sendiri</span>
                        </div>
                        <span class="fa-solid fa-plus-square text-danger fs-2 ms-sm-auto"></span>
                    </div>
                </div>
                <div class="section-title" style="margin-bottom: 25px;">
                    <div style="display: flex; align-items: center;">
                        <h2 class="text-dark" style="position: relative; top: 3px;">Detail Pemesanan</h2>
                    </div>
                    <div class="opacity-50 fs-5 mt-2">Detail kontak ini akan dugunakan untuk pengiriman e-tiket dan
                        keperluan
                        reschedule</div>
                </div>
                <form action="{{ route('car_rent.request_transaction') }}" method="POST">
                    @csrf
                    <div class="mb-35px">
                        <div class="card rounded-4 border-1 shadow">
                            <div class="card-body">
                                <div class="d-flex flex-row align-items-center mb-3">
                                    <input type="radio" name="customer_call" required class="accent-danger"
                                        id="radio_tuan" value="tuan" checked>
                                    <span class="ms-3">Tuan</span>
                                    <input type="radio" name="customer_call" required class="ms-5 accent-danger"
                                        id="radio_nyonya" value="nyonya">
                                    <span class="ms-3">Nyonya</span>
                                    <input type="radio" name="customer_call" required class="ms-5 accent-danger"
                                        id="radio_nona" value="nona">
                                    <span class="ms-3">Nona</span>
                                </div>
                                <div class="mb-3">
                                    <label for="customer_nama" class="form-label">Nama</label>
                                    <input type="text" name="customer_name" id="customer_nama" class="form-control"
                                        value="{{ $user->name }}" placeholder="Masukan nama">
                                </div>
                                <div class="mb-3">
                                    <label for="customer_phone" class="form-label">Nomor Ponsel</label>
                                    <input type="text" name="customer_phone" id="customer_phone" class="form-control"
                                        value="{{ $user->phone }}" placeholder="Masukan nomor Handphone" required>
                                </div>
                                <div class="mb-3">
                                    <label for="customer_email" class="form-label">Alamat Email</label>
                                    <input type="email" name="customer_email" id="customer_email" class="form-control"
                                        value="{{ $user->email }}" placeholder="Masukan Email">
                                </div>
                                {{-- <input type="hidden" name="total_ticket" value="{{ $qty }}"> --}}
                                <input type="hidden" name="service" value="car-rent">
                                <input type="hidden" name="payment" value="xendit">
                                <input type="hidden" name="date" value="{{ $date }}">
                                <input type="hidden" name="duration" value="{{ $duration }}">
                                <input type="hidden" name="package_id" value="{{ $car['id'] }}">
                                <input type="hidden" name="point" value="0">
                                <input type="hidden" name="location" value="jakarta">
                            </div>
                        </div>
                    </div>

                    <div class="mb-35px">
                        <input type="checkbox" name="setuju_syarat" id="setuju_syarat" class="accent-danger">
                        <span>saya menyetujui <span class="text-danger fw-bold">Syarat & Kententuan</span> di
                            Travelsya</span>
                    </div>

                    <div class="mb-35px">
                        <div class="card rounded-4 border-1 shadow">
                            <div class="card-header d-flex flex-row align-items-center">
                                <h2 class="fw-bold">Total Pembayaran</h2>
                                <h2 class="fw-bold">IDR {{ number_format($car->rental_price_per_day * $duration) }}
                                </h2>
                            </div>
                            <div class="card-body d-flex flex-row align-items-center">
                                <span class="fa-solid fa-gem fs-3 text-danger"></span>
                                <span class="ms-3">Kamu akan mendapatkan
                                    {{ \App\Helpers\General::countPoint($car->rental_price_per_day * $duration,
                                    $service_id) }}
                                    poin</span>
                                <button class="text-light btn btn-danger ms-sm-auto" id="lanjut_pesan_button"
                                    disabled>Lanjutkan
                                    Pemesanan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-4">
                <div class="card rounded-4 border-1 shadow fs-5 mb-35px">
                    <div class="card-body p-5">
                        <div class="row">
                            <div class="col-6 d-flex flex-column">
                                <span class="fs-7">Tanggal Penjemputan</span>
                                <span class="fs-4 f5-bold">{{ \App\Helpers\General::getDayDateShortMonth($date)
                                    }}</span>
                                <span class="fs-4">{{ date('H:i', strtotime($date)) }}</span>
                            </div>
                            <div class="col-6 d-flex flex-column ms-sm-auto">
                                <span class="fs-7">Tanggal Drop-off</span>
                                @php
                                $end = \App\Helpers\General::addingDays($date,$duration - 1 )
                                @endphp
                                <span class="fs-4 f5-bold">{{ \App\Helpers\General::getDayDateShortMonth($end) }}</span>
                                <span class="fs-4">
                                    @if (date('H:i', strtotime('+' . $duration * 12 . ' hours', strtotime($date)))
                                    < '23:59' ) {{ date('H:i', strtotime('+' . $duration * 12 . ' hours' ,
                                        strtotime($date))) }} @else 23.59 @endif </span>
                            </div>
                        </div>

                        <hr class="opacity-25 my-5">
                        <div class="d-flex flex-row align-items-center">
                            <img src="" onerror="this.src=`{{ asset('images/not_found.jpg') }}`" alt="" width="50"
                                height="50" class="rounded-1">
                            <div class="d-flex flex-column ms-3">
                                <span class="fs-7">
                                    @if ($category == 'supir')
                                    Dengan Supir
                                    @else
                                    Lepas Kunci
                                    @endif
                                </span>
                                <span class="fs-6 fw-bold">{{ $car->brand->name }}</span>
                                <span class="fs-7 text-danger">{{ $car->carRental->business_name }}</span>
                            </div>
                            <span class="text-danger ms-sm-auto">Detail Paket</span>
                        </div>
                        <hr class="opacity-25 my-5">
                        <div class="d-flex flex-row align-items-center">
                            <span class="text-success fs-7">Bisa refund, reschedule, dan overtime</span>
                            <span class="fa-solid fa-chevron-right ms-sm-auto"></span>
                        </div>
                        <hr class="opacity-25 my-5">
                        <div class="d-flex flex-row align-items-center">
                            <span>Total pembayaran</span>
                            <span class="fs-3 ms-sm-auto">IDR {{ number_format($duration * $car->rental_price_per_day)
                                }}</span>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection

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
            });

            function syncField() {
                if ($("#toggle_pengunjung").is(":checked")) {
                    hidePengunjung();

                    let sapa_pemesan = $("input[name='sapa_pemesan']:checked").val();

                    if (sapa_pemesan) {
                        $("input[name='sapa_pengunjung']").prop('checked', false)
                            .filter(`[value='${sapa_pemesan}']`).prop('checked', true);
                        $("input[name='sapa_disabled_pengunjung']").prop('checked', false)
                            .filter(`[value='${sapa_pemesan}']`).prop('checked', true);
                    }

                    $("#nama_pengunjung").val($("#nama_pemesan").val());
                    $("#phone_pengunjung").val($("#phone_pemesan").val());
                    $("#email_pengunjung").val($("#email_pemesan").val());

                    $("#nama_disabled_pengunjung").val($("#nama_pemesan").val());
                    $("#phone_disabled_pengunjung").val($("#phone_pemesan").val());
                    $("#email_disabled_pengunjung").val($("#email_pemesan").val());
                } else {
                    showPengunjung();
                }
            }

            function showPengunjung() {
                $("#data_pengunjung").css("display", "block");
                $("#data_disabled_pengunjung").css("display", "none");
            }

            function hidePengunjung() {
                $("#data_pengunjung").css("display", "none");
                $("#data_disabled_pengunjung").css("display", "block");
            }

            $("#toggle_pengunjung").on("click", syncField);

            $("input[name='sapa_pemesan']").on("click", syncField);

            $("#nama_pemesan, #phone_pemesan, #email_pemesan").on("keyup", syncField);
        });

        $('#setuju_syarat').on('change', function (e) {
            if($(this).is(':checked')){
                $("#lanjut_pesan_button").prop('disabled', false);
            }else{
                $("#lanjut_pesan_button").prop('disabled', true);
            }
        })
    
    document.addEventListener("DOMContentLoaded", function(){
        let map;
        const defaultLocation = [-6.175392, 106.827153];

        // inisiasi peta
        function initMap(lat, long){
            map = L.map('map').setView([lat, long], 13);

            // tambahkan tile layer pada openStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            // tambahkan marker pada lokasi saat ini
            const marker = L.marker([lat, long], {dragggable:true}).addTo(map);
            marker.bindPopup("lokasi anda").openPopup();
        }

        // cek browser mendukung geolocation
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(
                function(position){
                    const lat = position.coords.latitude;
                    const long = position.coords.longitude;

                    //inisiasi  peta dengan lokasi pengguna
                    initMap(lat, long);
                },
                function (error){
                    // jika pengguna tidak mengizinkan lokasi
                    alert("Lokasi tidak diaktifkan. menampilkan lokasi default Jakarta Pusat.");
                    initMap(defaultLocation[0], defaultLocation[1]);
                }
            );
        }else{
            // jika browser tidak mengizinkan deolokasi
            alert("browser tidak mendukung geolokasi");
            initMap(defaultLocation[0], defaultLocation[1]);
        }
    })
</script>
@endpush