@php
    // SAFEGUARD: Ensure departure object exists before proceeding.
    if (!isset($departure) || !$departure) {
        // In a real app, you might abort(404, 'Departure not found');
    } else {
        $departureDateTime = \Carbon\Carbon::parse($date_pergi . ' ' . $departure->departure_time);
        $arrivalDateTime = $departureDateTime->copy()->addHours($departure->duration);
    }

    // FOR ROUND TRIP
    if(isset($pulang) && $pulang) {
        $pulangDateTime = \Carbon\Carbon::parse($date_pulang . ' ' . $pulang->departure_time);
        $pulangArrivalDateTime = $pulangDateTime->copy()->addHours($pulang->duration);
    }

    // CALCULATE TOTAL PRICE
    $totalPrice = (isset($departure) ? $departure->price : 0) * $jumlah_penumpang;
    if (isset($pulang)) {
        $totalPrice += $pulang->price * $jumlah_penumpang;
    }
@endphp

@extends('layouts.app_v2')

@section('content')
<div class="container mb-5">
    <section class="special-deals mt-5">

        {{-- ERROR HANDLING BLOCK --}}
        @if (!isset($departure) || !$departure)
            <div class="row" style="padding-top: 50px;">
                <div class="col-12">
                    <div class="alert alert-danger text-center">
                        <h4 class="alert-heading">Error Memuat Halaman</h4>
                        <p>Data keberangkatan tidak dapat ditemukan. Ini mungkin terjadi karena ID tiket tidak valid atau ada masalah saat mengambil data.</p>
                        <p>Silakan coba lagi dari halaman pencarian.</p>
                        <a href="{{ route('bus_travel.index') }}" class="btn btn-danger mt-3">Kembali ke Pencarian</a>
                    </div>
                </div>
            </div>
        @else
        {{-- MAIN CONTENT --}}
        <div class="row" style="padding-top: 50px;">
            <div class="col-8">
                <div class="alert alert-soft-coral mb-25px" role="alert">
                    <i class="fa-solid fa-triangle-exclamation"></i> <span class="text-dark"><strong> Refund dan
                            Reschedule tidak
                            tersedia</strong>
                        Lihat Informasi selengkapnya <a href="javascript:"
                            class="text-warning fw-bold">Disini</a></span>
                </div>

                <div class="section-title mb-25px">
                    <div style="display: flex; align-items: center;">
                        <h2 class="text-dark" style="position: relative; top: 3px;">Detail Pemesanan</h2>
                    </div>
                    <div class="subtitle text-capitalize mt-2">detail kontak ini akan digunakan untuk pengiriman e-tiket
                        dan keperluan reschedule</div>
                </div>
                <form action="{{ route('bus_travel.request_transaction') }}" method="POST">
                    @csrf
                    <div class="mb-35px">
                        <div class="card rounded-4 border-1 shadow">
                            <div class="card-body">
                                <div class="d-flex flex-row align-items-center mb-3">
                                    <input type="radio" name="sapa_pemesan" class="accent-danger" id="radio_tuan"
                                        value="tuan" checked>
                                    <span class="ms-3">Tuan</span>
                                    <input type="radio" name="sapa_pemesan" class="accent-danger ms-5" id="radio_nyonya"
                                        value="nyonya">
                                    <span class="ms-3">Nyonya</span>
                                    <input type="radio" name="sapa_pemesan" class="accent-danger ms-5" id="radio_nona"
                                        value="nona">
                                    <span class="ms-3">Nona</span>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_pemesan" class="form-label">Nama</label>
                                    <input type="text" name="nama_pemesan" id="nama_pemesan" class="form-control"
                                        value="{{ $user->name }}" placeholder="Masukan nama">
                                </div>
                                <div class="mb-3">
                                    <label for="phone_pemesan" class="form-label">Nomor Ponsel</label>
                                    <input type="number" name="phone_pemesan" id="phone_pemesan" class="form-control"
                                        value="{{ $user->phone }}" placeholder="Masukan nomor Handphone" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email_pemesan" class="form-label">Alamat Email</label>
                                    <input type="email" name="email_pemesan" id="email_pemesan" class="form-control"
                                        value="{{ $user->email }}" placeholder="Masukan Email">
                                </div>
                                
                                {{-- Hidden inputs for transaction --}}
                                <input type="hidden" name="jumlah_penumpang" value="{{ $jumlah_penumpang }}">
                                <input type="hidden" name="service" value="bus-travel">
                                <input type="hidden" name="payment" value="xendit">
                                <input type="hidden" name="point" value="0">
                                <input type="hidden" name="is_pulang_pergi" value="{{ $is_pulang_pergi }}">
                                
                                <input type="hidden" name="ticket_pergi_id" value="{{ $departure->id }}">
                                <input type="hidden" name="date_pergi" value="{{ $date_pergi }}">

                                @if($is_pulang_pergi == 1 && isset($pulang))
                                    <input type="hidden" name="ticket_pulang_id" value="{{ $pulang->id }}">
                                    <input type="hidden" name="date_pulang" value="{{ $date_pulang }}">
                                    @for ($i = 1; $i <= $jumlah_penumpang; $i++)
                                        <input type="hidden" name="kursi_pergi_{{ $i }}" value="{{ ${'kursi_pergi_' . $i} }}">
                                        <input type="hidden" name="kursi_pulang_{{ $i }}" value="{{ ${'kursi_pulang_' . $i} }}">
                                    @endfor
                                @else
                                    <input type="hidden" name="date_pulang" value="{{ $date_pulang }}">
                                    @for ($i = 1; $i <= $jumlah_penumpang; $i++)
                                        <input type="hidden" name="kursi_pergi_{{ $i }}" value="{{ ${'kursi_pergi_' . $i} }}">
                                    @endfor
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="section-title" style="margin-bottom: 25px;">
                        <div style="display: flex; align-items: center;">
                            <h2 class="text-dark" style="position: relative; top: 3px;">Detail Penumpang</h2>
                        </div>
                        <div class="subtitle text-capitalize mt-2">Pastikan mengisi detail pengunjung dengan benar agar
                            penjelasan lancar
                        </div>
                    </div>

                    @for ($i = 1; $i <= $jumlah_penumpang; $i++)
                    <div class="mb-35px">
                        <div class="card rounded-4 border-1 shadow">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <h2 class="text-danger">Penumpang {{ $i }}</h2>
                                    </div>
                                    @if ($i === 1)
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input type="hidden" name="is_same" id="is_same_value" value="0">
                                        <input name="is_same_check" class="form-check-input h-20px w-30px"
                                            type="checkbox" id="toggle_pengunjung" />
                                        <label class="form-check-label" for="flexSwitchChecked">
                                            Sama dengan pemesan
                                        </label>
                                    </div>
                                    @endif
                                </div>
                                
                                {{-- Seat Info Pergi --}}
                                <div class="mb-3 bg-snow-pink text-dark p-2 rounded d-flex flex-row align-items-center px-5">
                                    <img src="{{ asset('images/icon/chair.png') }}" width="25px" height="25px" alt="">
                                    <div class="d-flex flex-column ms-5">
                                        <Span>{{ $departure->busTravel->busTravel->business_name }} (Pergi)</Span>
                                        <Span id="baris_kursi_penumpang_{{ $i }}">Kursi {{ ${'kursi_pergi_' . $i} }}</Span>
                                    </div>
                                </div>

                                {{-- Seat Info Pulang (for round trip) --}}
                                @if ($is_pulang_pergi == 1 && isset($pulang))
                                <div class="mb-3 bg-light-success-alpha text-dark p-2 rounded d-flex flex-row align-items-center px-5">
                                    <img src="{{ asset('images/icon/chair.png') }}" width="25px" height="25px" alt="">
                                    <div class="d-flex flex-column ms-5">
                                        <Span>{{ $pulang->busTravel->busTravel->business_name }} (Pulang)</Span>
                                        <Span>Kursi {{ ${'kursi_pulang_' . $i} }}</Span>
                                    </div>
                                </div>
                                @endif

                                <div id="data_pengunjung_{{ $i }}">
                                    <div class="d-flex flex-row align-items-center mb-3">
                                        <input type="radio" name="customer_call_{{ $i }}" class=" accent-danger"
                                            id="radio_tuan_{{ $i }}" value="tuan" checked required>
                                        <span class="ms-3">Tuan</span>
                                        <input type="radio" name="customer_call_{{ $i }}" class="ms-5 accent-danger"
                                            id="radio_nyonya_{{ $i }}" value="nyonya" required>
                                        <span class="ms-3">Nyonya</span>
                                        <input type="radio" name="customer_call_{{ $i }}" class="ms-5 accent-danger"
                                            id="radio_nona_{{ $i }}" value="nona" required>
                                        <span class="ms-3">Nona</span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="customer_name_{{ $i }}" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="customer_name_{{ $i }}"
                                            name="customer_name_{{ $i }}" placeholder="Masukan nama pengunjung"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="customer_phone_{{ $i }}" class="form-label">Nomor
                                            Ponsel</label>
                                        <input type="number" class="form-control" id="customer_phone_{{ $i }}"
                                            name="customer_phone_{{ $i }}" placeholder="Masukan nomor handphone"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="customer_email_{{ $i }}" class="form-label">Alamat
                                            Email</label>
                                        <input type="email" class="form-control" id="customer_email_{{ $i }}"
                                            name="customer_email_{{ $i }}" placeholder="Masukan Email" required>
                                    </div>
                                </div>
                                @if ($i === 1)
                                <div id="data_disabled_pengunjung" style="display: none;">
                                    <div class="d-flex flex-row align-items-center mb-3">
                                        <input type="radio" name="sapa_disabled_pengunjung" id="radio_tuan_disabled" value="tuan"
                                            disabled>
                                        <span class="ms-3">Tuan</span>
                                        <input type="radio" name="sapa_disabled_pengunjung" class="ms-5" id="radio_nyonya_disabled"
                                            value="nyonya" disabled>
                                        <span class="ms-3">Nyonya</span>
                                        <input type="radio" name="sapa_disabled_pengunjung" class="ms-5" id="radio_nona_disabled"
                                            value="nona" disabled>
                                        <span class="ms-3">Nona</span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_disabled_pengunjung" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama_disabled_pengunjung"
                                            placeholder="Masukan nama pengunjung" disabled readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone_disabled_pengunjung" class="form-label">Nomor
                                            Ponsel</label>
                                        <input type="number" class="form-control" id="phone_disabled_pengunjung"
                                            placeholder="Masukan nomor handphone" disabled readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email_disabled_pengunjung" class="form-label">Alamat
                                            Email</label>
                                        <input type="email" class="form-control" id="email_disabled_pengunjung"
                                            placeholder="Masukan Email" disabled readonly>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endfor

                    <div class="mb-35px">
                        <input type="checkbox" name="setuju_syarat" id="setuju_syarat" class="accent-danger">
                        <span>saya menyetujui <span class="text-danger fw-bold">Syarat & Kententuan</span> di
                            Travelsya</span>
                    </div>

                    <div class="mb-35px">
                        <div class="card rounded-4 border-1 shadow">
                            <div class="card-header d-flex flex-row align-items-center">
                                <h2 class="fw-bold">Total Pembayaran</h2>
                                <h2 class="fw-bold text-danger ms-sm-auto">IDR {{ number_format($totalPrice) }}
                                </h2>
                            </div>
                            <div class="card-body d-flex flex-row align-items-center">
                                <span class="fa-solid fa-gem fs-3 text-danger"></span>
                                <span class="ms-3">Kamu akan mendapatkan
                                    {{ \App\Helpers\General::countPoint($totalPrice, $service_id) }}
                                    poin</span>
                                <button class="text-light btn btn-danger ms-sm-auto" id="lanjut_pesan_button" disabled>Lanjutkan
                                    Pemesanan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-4">
                {{-- Departure Ticket --}}
                <div class="card rounded-4 border-1 shadow fs-5 mb-35px">
                    <div class="card-body p-5">
                        <div class="d-flex flex-row align-items-center">
                            <span class="fw-bold p-2 rounded-1 text-wrap bg-snow-pink text-danger">Pergi</span>
                            <span class="ms-2">{{ $departureDateTime->format('D, d M Y') }} . {{ $departureDateTime->format('H:i') }} <strong>({{ $departure->duration }} jam)</strong></span>
                        </div>
                        <hr class="opacity-25 my-5">
                        <div class="d-flex flex-column gap-2">
                            <div class="row g-2 align-items-start">
                                <div class="col">
                                    <div class="fw-semibold text-wrap">{{ $departure->from->city_name ?? 'Invalid from' }}</div>
                                    <div class="text-wrap">{{ $departure->titik_naik ?? 'Invalid from' }}</div>
                                    <div class="text-muted">{{ $departureDateTime->format('H:m') }}</div>
                                </div>
                                <div class="col-auto text-center" style="min-width:30px;"><i class="fa-solid fa-arrow-right"></i></div>
                                <div class="col">
                                    <div class="fw-semibold text-wrap">{{ $departure->to->city_name ?? 'Invalid To' }}</div>
                                    <div class="text-wrap">{{ $departure->titik_turun ?? 'Invalid To' }}</div>
                                    <div class="text-muted">{{ $arrivalDateTime->format('H:m') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Return Ticket (if applicable) --}}
                @if ($is_pulang_pergi == 1 && isset($pulang))
                <div class="card rounded-4 border-1 shadow fs-5 mb-35px">
                    <div class="card-body p-5">
                        <div class="d-flex flex-row align-items-center">
                            <span class="fw-bold p-2 rounded-1 text-wrap bg-light-success text-success">Pulang</span>
                            <span class="ms-2">{{ $pulangDateTime->format('D, d M Y') }} . {{ $pulangDateTime->format('H:i') }} <strong>({{ $pulang->duration }} jam)</strong></span>
                        </div>
                        <hr class="opacity-25 my-5">
                        <div class="d-flex flex-column gap-2">
                            <div class="row g-2 align-items-start">
                                <div class="col">
                                    <div class="fw-semibold text-wrap">{{ $pulang->from->city_name ?? 'Invalid from' }}</div>
                                    <div class="text-wrap">{{ $pulang->titik_naik ?? 'Invalid from' }}</div>
                                    <div class="text-muted">{{ $pulangDateTime->format('H:m') }}</div>
                                </div>
                                <div class="col-auto text-center" style="min-width:30px;"><i class="fa-solid fa-arrow-right"></i></div>
                                <div class="col">
                                    <div class="fw-semibold text-wrap">{{ $pulang->to->city_name ?? 'Invalid To' }}</div>
                                    <div class="text-wrap">{{ $pulang->titik_turun ?? 'Invalid To' }}</div>
                                    <div class="text-muted">{{ $pulangArrivalDateTime->format('H:m') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Total Price --}}
                <div class="card rounded-4 border-1 shadow fs-5">
                    <div class="card-body p-5">
                        <div class="d-flex flex-row align-items-center">
                            <span>Total pembayaran</span>
                            <span class="fs-3 ms-sm-auto fw-bold text-danger">
                                IDR {{ number_format($totalPrice) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </section>
</div>

@push('js')
<script>
    $(document).ready(function() {
                function syncField() {
                    if ($("#toggle_pengunjung").is(":checked")) {
                        $("#is_same_value").val(1);
                        
                        $('#data_pengunjung_1').hide();
                        $('#data_disabled_pengunjung').show();

                        let sapa_pemesan = $("input[name='sapa_pemesan']:checked").val();

                        $("input[name='sapa_disabled_pengunjung']").prop('checked', false)
                            .filter(`[value='${sapa_pemesan}']`).prop('checked', true);
                        
                        $("#customer_name_1").val($("#nama_pemesan").val());
                        $("#customer_phone_1").val($("#phone_pemesan").val());
                        $("#customer_email_1").val($("#email_pemesan").val());

                        $("#nama_disabled_pengunjung").val($("#nama_pemesan").val());
                        $("#phone_disabled_pengunjung").val($("#phone_pemesan").val());
                        $("#email_disabled_pengunjung").val($("#email_pemesan").val());
                    } else {
                        $("#is_same_value").val(0);
                        $('#data_pengunjung_1').show();
                        $('#data_disabled_pengunjung').hide();
                    }
                }

                $("#toggle_pengunjung").on("click", syncField);
                $("input[name='sapa_pemesan']").on("click", syncField);
                $("#nama_pemesan, #phone_pemesan, #email_pemesan").on("keyup", syncField);

                $('#setuju_syarat').on('change', function(e) {
                    if ($(this).is(':checked')) {
                        $("#lanjut_pesan_button").prop('disabled', false);
                    } else {
                        $("#lanjut_pesan_button").prop('disabled', true);
                    }
                })

                syncField();
            });
</script>
@endpush
@endsection