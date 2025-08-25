<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>Travelsya</title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <link rel="canonical" href="" />

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="{{ url('https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700') }}" />
    <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->


</head>
<div class="container">
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
                    <div class="row">
                        <div class="col-12 col-lg-5"
                            style="background: rgb(192,36,37); background: linear-gradient(120deg, rgba(192,36,37,1) 60%, rgba(255,255,255,1) 60%);">
                            <div class="offset-lg-3 col-9">
                                <div class="fw-bold fs-1" style="color: white">Car Rental e-Booking</div>
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
                            <div class="fs-2 fw-bold mt-5">{{ $data->car->brand->name ?? '' }} {{ $data->car->carModel->name ?? '' }}</div>
                            <div class="fs-6 mt-5">{{ $data->carRental->address ?? '' }}
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6  mt-5">
                                    <div class="fs-4 fw-bold" style="color: #c02425">
                                        Waktu Rental
                                    </div>
                                    <div class="fs-6" style="color: #c02425">
                                        {{ \Carbon\Carbon::parse($data->start)->translatedFormat('d F Y H:i') }}
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-lg-6 mt-5">
                                    <div class="fs-4 fw-bold" style="color: #c02425">
                                        Waktu Kembali
                                    </div>
                                    <div class="fs-6" style="color: #c02425">
                                        {{ \Carbon\Carbon::parse($data->end)->translatedFormat('d F Y H:i') }}
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
                                    {{ \Carbon\Carbon::parse($data->transaction->created_at)->translatedFormat('d F Y H:i') }}
                                </div>
                            </div>
                            <div class="d-flex mb-1 justify-content-between">
                                <div class="">Durasi Rental</div>
                                <div class=" fw-bold">{{ $data->duration }} Hari</div>
                            </div>
                        </div>
                    </div>

                    {{-- Informasi Kendaraan --}}
                    <div class="card border border-1 mb-5">
                        <div class="fs-4 fw-bold m-5 mb-0">
                            Informasi Kendaraan
                        </div>
                        <div class="m-5">
                            <div class="d-flex mb-1 justify-content-between">
                                <div class="">Jenis Mobil</div>
                                <div class=" fw-bold">{{ $data->car->brand->name ?? '' }} {{ $data->car->carModel->name ?? '' }}</div>
                            </div>
                            <div class="d-flex mb-1 justify-content-between">
                                <div class="">Tahun Mobil</div>
                                <div class=" fw-bold">{{ $data->car->year ?? '-' }}</div>
                            </div>
                            <div class="d-flex mb-1 justify-content-between">
                                <div class="">Nomor Polisi</div>
                                <div class=" fw-bold">{{ $data->car->license_plate ?? '-' }}</div>
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
                                <div class="">Nama Penyewa</div>
                                <div class=" fw-bold">{{ $data->customer_name ?? '-' }}</div>
                            </div>
                            <div class="d-flex mb-1 justify-content-between">
                                <div class="">Nomor Telepon</div>
                                <div class=" fw-bold">{{ $data->customer_phone ?? '-' }}</div>
                            </div>
                            <div class="d-flex mb-1 justify-content-between">
                                <div class="">Alamat Email</div>
                                <div class=" fw-bold">{{ $data->transaction->user->email ?? '-' }}</div>
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
                                <div class=" fw-bold">{{ $data->transaction->payment_method }}</div>
                            </div>
                            <div class="d-flex mb-1 justify-content-between">
                                <div class="">Biaya Rental</div>
                                <div class=" fw-bold">Rp. {{ number_format($data->rent_price, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="d-flex mb-1 justify-content-between">
                                <div class="">Biaya Admin</div>
                                <div class=" fw-bold">Rp. {{ number_format($data->fee_admin, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="d-flex mb-1 justify-content-between">
                                <div class="">Total Pembayaran</div>
                                <div class=" fw-bold">Rp. {{ number_format($data->rent_price + $data->fee_admin, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-10">
                    <div class="catatan-penting">
                        <h3 style="color: #c02425">Catatan Penting</h3>
                        <ul style="list-style-type:disc">
                            <li>Pastikan membawa SIM dan KTP yang masih berlaku saat pengambilan kendaraan.</li>
                            <li>Periksa kondisi kendaraan sebelum dan sesudah rental. Laporkan segera jika ada kerusakan.</li>
                            <li>Keterlambatan pengembalian kendaraan akan dikenakan denda sesuai ketentuan yang berlaku.</li>
                            <li>Bahan bakar saat pengembalian harus sama dengan saat pengambilan.</li>
                            <li>Pembatalan sewa dapat dikenakan biaya pembatalan.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card" style="border-radius: 150px;background: #c02425">
                        <div class="row m-5">
                            <div class="col-12 col-lg-4" style="color: white">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-brands fa-whatsapp text-white fs-1"
                                        style="margin-right: 8px; color:white;"></i>
                                    <div class="text-white" style="color: white">085247213909</div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4" style="color: white">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-envelope text-white fs-1" style="margin-right: 8px;"></i>
                                    <div class="text-white">travelsyawisataindonesia@gmail.com</div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4" style="color: white">
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
</div>
</body>

<!--end::Body-->

</html>