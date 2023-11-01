@extends('layouts.cetak')

@section('content')
<div class="card">
    <div class="container">
        <div class="row m-10 m-sm-5">
            <div class="col-12 mb-5">
                <div class="card my-10 my-sm-5" style="background: #c02425; border-radius:100px;">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-around align-items-center">
                                <img src="{{ asset('assets/media/illustrations/sigma-1/tsyaa.png') }}"
                                    style="max-width: 15%" alt="">
                                <img src="{{ asset('assets/media/logos/logo.png') }}" style="max-width: 25%"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12" style="background: #212121">
                <div class="judul">
                    <h1 class="text-center fw-bold p-5" style="color: white">TRAVELSYA WISATA INDONESIA</h1>
                </div>
            </div>
            <div class="col-12 mb-10">
                {{-- background: rgb(192,36,37); background: linear-gradient(103deg, rgba(192,36,37,1) 15%, rgba(255,255,255,1) 30%); --}}
                <div class="row">
                    <div class="col-12 col-lg-5"
                        style="background: rgb(192,36,37); background: linear-gradient(120deg, rgba(192,36,37,1) 60%, rgba(255,255,255,1) 60%);">
                        <div class="offset-lg-3 col-9">
                            <div class="fw-bold fs-1" style="color: white">Hostel e-Booking</div>
                            <div class="fs-3" style="color: white">Itenerary/Receipt</div>
                        </div>
                        <div class="col-12">
                            <div class="offset-lg-3 col-9">
                                <img class="img-fluid"
                                    src="{{ asset('assets/media/illustrations/sigma-1/nunjuk.png') }}"
                                    alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 offset-lg-1 col-lg-6">
                        <div class="bintang mt-5">
                            @for ($i = 0; $i < $data->hostel->star; $i++)
                                <span class="fa fa-star fs-1" style="color: orange;"></span>
                            @endfor
                        </div>
                        <div class="fs-2 fw-bold ">{{ $data->hostel->name }}</div>
                        <div class="fs-6 mt-5">{{ $data->hostel->address }}
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6  mt-5">
                                <div class="fs-4 fw-bold" style="color: #c02425">
                                    Check IN
                                </div>
                                <div class="fs-6" style="color: #c02425">
                                    {{ \Carbon\Carbon::parse($data->reservation_start)->translatedFormat('d F Y') }}
                                    <br>
                                    {{ $data->hostel->checkin }}
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 mt-5">
                                <div class="fs-4 fw-bold" style="color: #c02425">
                                    Check Out
                                </div>
                                <div class="fs-6" style="color: #c02425">
                                    {{ \Carbon\Carbon::parse($data->reservation_end)->translatedFormat('d F Y') }}
                                    <br>
                                    {{ $data->hostel->checkout }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-10">

                {{-- Informasi Booking --}}
                <div class="card border border-1 mb-5">
                    <div class="fs-4 fw-bold m-5 mb-0">
                        Informasi Booking
                    </div>
                    <div class="m-5">
                        <div class="d-flex mb-1 justify-content-between">
                            <div class="">Kode Booking</div>
                            <div class=" fw-bold">{{ $data->booking_id }}</div>
                        </div>
                        <div class="d-flex mb-1 justify-content-between">
                            <div class="">Booking Dilakukan Pada</div>
                            <div class=" fw-bold">
                                {{ \Carbon\Carbon::parse($data->reservation_start)->translatedFormat('d F Y') }}
                            </div>
                        </div>
                        <div class="d-flex mb-1 justify-content-between">
                            @php
                                $tglAkhir = \Carbon\Carbon::parse($data->reservation_end);
                                $today = \Carbon\Carbon::now();

                                $selisihBulan = $today->diffInMonths($tglAkhir);
                                $today->addMonths($selisihBulan); // Add elapsed months to the current date

                                $selisihHari = $today->diffInDays($tglAkhir);
                                $today->addDays($selisihHari); // Add elapsed days to the current date

                                $selisihJam = $today->diffInHours($tglAkhir);

                                $sisaHari = $selisihHari % 30; // Calculate remaining days
                                $sisaJam = $selisihJam % 24; // Calculate remaining hours (not exceeding 24)

                            @endphp

                            <div class="">Durasi</div>
                            <div class=" fw-bold">{{ $selisihBulan }} Bulan {{ $selisihHari }} Hari
                                {{ $sisaJam }} Jam</div>
                        </div>
                    </div>
                </div>

                {{-- Informasi Ruangan --}}
                <div class="card border border-1 mb-5">
                    <div class="fs-4 fw-bold m-5 mb-0">
                        Informasi Ruangan
                    </div>
                    <div class="m-5">
                        <div class="d-flex mb-1 justify-content-between">
                            <div class="">Tipe Kamar</div>
                            <div class=" fw-bold">{{ $data->hostelRoom->name }}</div>
                        </div>
                        <div class="d-flex mb-1 justify-content-between">
                            <div class="">Jumlah Kamar</div>
                            <div class=" fw-bold">{{ $data->room ?? '-' }} Kamar</div>
                        </div>
                        <div class="d-flex mb-1 justify-content-between">
                            <div class="">Kapasitas Kamar</div>
                            <div class=" fw-bold">{{ $data->hostelRoom->roomsize }} Tamu</div>
                        </div>
                        <div class="d-flex mb-1 justify-content-between">
                            <div class="">Fasilitas Kamar</div>
                            @foreach ($data->hostel->hostelFacilities as $facilityItem)
                                <li>{{ $facilityItem->facility->name }}</li>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Informasi Tamu --}}
                <div class="card border border-1 mb-5">
                    <div class="fs-4 fw-bold m-5 mb-0">
                        Informasi Tamu
                    </div>
                    <div class="m-5">
                        <div class="d-flex mb-1 justify-content-between">
                            <div class="">Kepala Tamu</div>
                            <div class=" fw-bold">{{ $data->guest_name ?? '-' }}</div>
                        </div>
                        <div class="d-flex mb-1 justify-content-between">
                            <div class="">Total Tamu</div>
                            <div class=" fw-bold">{{ $data->guest }} Tamu</div>
                        </div>
                        <div class="d-flex mb-1 justify-content-between">
                            <div class="">Nomor Telepon</div>
                            <div class=" fw-bold">{{ $data->guest_handphone ?? '-' }}</div>
                        </div>
                        <div class="d-flex mb-1 justify-content-between">
                            <div class="">Alamat Email</div>
                            <div class=" fw-bold">{{ $data->guest_email ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                {{-- Rincian Pembaayaran --}}
                <div class="card border border-1 mb-5">
                    <div class="fs-4 fw-bold m-5 mb-0">
                        Rincian Pembayaran
                    </div>
                    <div class="m-5">
                        <div class="d-flex mb-1 justify-content-between">
                            <div class="">Status Transaksi</div>
                            <div class=" fw-bold text-danger">{{ $data->transaction->status }}</div>
                        </div>
                        <div class="d-flex mb-1 justify-content-between">
                            <div class="">Tanggal Transaksi</div>
                            <div class=" fw-bold">
                                {{ \Carbon\Carbon::parse($data->transaction->created_at)->translatedFormat('d F Y H:m') }}
                            </div>
                        </div>
                        <div class="d-flex mb-1 justify-content-between">
                            <div class="">Metode Pembayaran</div>
                            <div class=" fw-bold">{{ $data->transaction->payment_method ?? '-' }}</div>
                        </div>
                        <div class="d-flex mb-1 justify-content-between">
                            <div class="">Biaya Hotel</div>
                            <div class=" fw-bold">Rp. {{ number_format($data->transaction->total, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-12 mb-10">
                <div class="catatan-penting">
                    <h3 style="color: #c02425">Catatan Penting</h3>
                    <ul style="list-style-type:disc">
                        <li>Sewaktu check-in diperlukan tanda pengenal dengan foto yang resmi dikeluarkan oleh
                            pemerintah dan kartu kredit atau deposit tunai untuk
                            menutup biaya tidak terduga pemenuhan permintaan khusus bergantung pada ketersediaan
                            sewaktu check-in dan mungkin menimbulkan biaya
                            tambahan, permintaan khusus tidak dijamin akan terpenuhi.</li>
                        <li>Biaya penambahan orang dapat berlaku dan berbeda-beda menurut kebijakan akomodasi</li>
                        <li>Biaya tambahan seperti parkir, deposito, telepon, layanan kamar ditangani langsung
                            antara anda dan akomodasi</li>
                        <li>Pemesanan kamar hotel tidak dapat dibatalkan & biaya pemesanan tidak dapat dikembalikan
                        </li>
                        <li>Jika anda check-in awal/terlambat diluar jam yang telah ditentukan, sebaiknya hubungi
                            akomodasi terlebih dahulu demi kelancaran</li>
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <div class="card" style="border-radius: 150px;background: #c02425">
                    <div class="row m-5">
                        <div class="col-12 col-sm-4 col-lg-4" style="color: white">
                            <div class="d-flex justify-content-center align-items-center">
                                <i class="fa-brands fa-whatsapp text-white fs-1"
                                    style="margin-right: 8px; color:white;"></i>
                                <div class="text-white" style="color: white">085247213909</div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4 col-lg-4" style="color: white">
                            <div class="d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-envelope text-white fs-1" style="margin-right: 8px;"></i>
                                <div class="text-white">travelsyawisataindonesia@gmail.com</div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4 col-lg-4" style="color: white">
                            <div class="d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-globe text-white fs-1"
                                    style="margin-right: 8px; color:white"></i>
                                <div class="text-white" style="color: white">www.travelsya.com</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection