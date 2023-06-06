@extends('admin.layout',['title' => 'Dashboard',"url" => "#"])

@section('content-admin')
    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-sm-6 col-xl-3 ">
            <div class="card bg-light-success card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <h3  class="card-title fw-bold text-success fs-5  d-block">Jumlah Partner</h3>
                    <div class="py-1">
                        <span  class=" fw-bold text-dark fs-8  d-block">Keseluruhan</span>
                        <span class="text-dark fs-1 fw-bold me-2">250</span>
                        <span class="fw-semibold text-muted fs-7">Partner</span>
                    </div>
                </div>
                <!--end:: Body-->
            </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-sm-6 col-xl-3 ">
            <div class="card bg-light-success card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <h3  class="card-title fw-bold text-success fs-5  d-block">Jumlah Transaksi</h3>
                    <span  class=" fw-bold text-dark fs-8  d-block">Hari Ini</span>

                    <div class="py-1">
                        <span class="text-dark fs-1 fw-bold me-2">3</span>

                        <span class="fw-semibold text-muted fs-7">Transaksi</span>
                    </div>
                </div>
                <!--end:: Body-->
            </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-sm-6 col-xl-3 ">
            <div class="card bg-light-success card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <h3  class="card-title fw-bold text-success fs-5  d-block">Pendapatan Transaksi</h3>
                    <span  class=" fw-bold text-dark fs-8  d-block">Hari Ini</span>

                    <div class="py-1">
                        <span class="text-dark fs-5 fw-bold me-2">Rp. 561.000</span>
                    </div>
                </div>
                <!--end:: Body-->
            </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-sm-6 col-xl-3 ">
            <div class="card bg-light-success card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <h3  class="card-title fw-bold text-success fs-5  d-block">Pendapatan Transaksi</h3>
                    <span  class=" fw-bold text-dark fs-8  d-block">Bulan Ini</span>

                    <div class="py-1">
                        <span class="text-dark fs-5 fw-bold me-2">Rp. 10.000.000</span>
                    </div>
                </div>
                <!--end:: Body-->
            </div>
        </div>
        <!--end::Col-->

    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x my-5 fs-6 fw-bold text-dark">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_4">Semua Transaksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_5">Hotel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_6">Hostel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_7">Pulsa & Data</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_8">PLN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_9">PDAM</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_10">TV Berbayar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_11">Pajak</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">


                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_tab_pane_4" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <th>Tanggal</th>
                                        <th>Invoice</th>
                                        <th>Code Booking</th>
                                        <th>Customer</th>
                                        <th>Check IN</th>
                                        <th>Check Out</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Grand Total</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @for($i = 0; $i < 10; $i++)
                                        <tr>
                                            <td>20 Mei 2023</td>
                                            <td>INV-001</td>
                                            <td>CTB1</td>
                                            <td>Customer {{$i}}</td>
                                            <td>23 Mei 2023 12:00</td>
                                            <td>25 Mei 2023 14:00</td>
                                            <td>BCA</td>
                                            <td>Rp. 1.500.000</td>
                                            <td><span class="badge badge-success">Lunas</span></td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <th>Tanggal</th>
                                        <th>Invoice</th>
                                        <th>Code Booking</th>
                                        <th>Customer</th>
                                        <th>Check IN</th>
                                        <th>Check Out</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Grand Total</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @for($i = 0; $i < 10; $i++)
                                        <tr>
                                            <td>20 Mei 2023</td>
                                            <td>INV-001</td>
                                            <td>CTB1</td>
                                            <td>Customer {{$i}}</td>
                                            <td>23 Mei 2023 12:00</td>
                                            <td>25 Mei 2023 14:00</td>
                                            <td>BCA</td>
                                            <td>Rp. 1.500.000</td>
                                            <td><span class="badge badge-success">Lunas</span></td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_6" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <th>Tanggal</th>
                                        <th>Invoice</th>
                                        <th>Code Booking</th>
                                        <th>Customer</th>
                                        <th>Check IN</th>
                                        <th>Check Out</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Grand Total</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @for($i = 0; $i < 10; $i++)
                                        <tr>
                                            <td>20 Mei 2023</td>
                                            <td>INV-001</td>
                                            <td>CTB1</td>
                                            <td>Customer {{$i}}</td>
                                            <td>23 Mei 2023 12:00</td>
                                            <td>25 Mei 2023 14:00</td>
                                            <td>BCA</td>
                                            <td>Rp. 1.500.000</td>
                                            <td><span class="badge badge-success">Lunas</span></td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_7" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <th>Tanggal Transaksi</th>
                                        <th>Invoice</th>
                                        <th>Produk</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @for($i = 0; $i < 10; $i++)
                                        <tr>
                                            <td>20 Mei 2023</td>
                                            <td>INV-001</td>
                                            <td>Pulsa XL - {{random_int(5000,100000)}}</td>
                                            <td>BCA</td>
                                            <td>Rp. 10.000</td>
                                            <td><span class="badge badge-success">Berhasil</span></td>
                                            <td><button class="btn btn-outline btn-sm btn-outline btn-outline-primary btn-active-primary-secondary w-100">Lihat Transaksi</button></td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_8" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <th>Tanggal Transaksi</th>
                                        <th>Invoice</th>
                                        <th>Produk</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @for($i = 0; $i < 10; $i++)
                                        <tr>
                                            <td>20 Mei 2023</td>
                                            <td>INV-001</td>
                                            <td>Pulsa XL - {{random_int(5000,100000)}}</td>
                                            <td>BCA</td>
                                            <td>Rp. 10.000</td>
                                            <td><span class="badge badge-success">Berhasil</span></td>
                                            <td><button class="btn btn-outline btn-sm btn-outline btn-outline-primary btn-active-primary-secondary w-100">Lihat Transaksi</button></td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_9" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <th>Tanggal Transaksi</th>
                                        <th>Invoice</th>
                                        <th>Produk</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @for($i = 0; $i < 10; $i++)
                                        <tr>
                                            <td>20 Mei 2023</td>
                                            <td>INV-001</td>
                                            <td>Pulsa XL - {{random_int(5000,100000)}}</td>
                                            <td>BCA</td>
                                            <td>Rp. 10.000</td>
                                            <td><span class="badge badge-success">Berhasil</span></td>
                                            <td><button class="btn btn-outline btn-sm btn-outline btn-outline-primary btn-active-primary-secondary w-100">Lihat Transaksi</button></td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_10" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <th>Tanggal Transaksi</th>
                                        <th>Invoice</th>
                                        <th>Produk</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @for($i = 0; $i < 10; $i++)
                                        <tr>
                                            <td>20 Mei 2023</td>
                                            <td>INV-001</td>
                                            <td>Pulsa XL - {{random_int(5000,100000)}}</td>
                                            <td>BCA</td>
                                            <td>Rp. 10.000</td>
                                            <td><span class="badge badge-success">Berhasil</span></td>
                                            <td><button class="btn btn-outline btn-sm btn-outline btn-outline-primary btn-active-primary-secondary w-100">Lihat Transaksi</button></td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_11" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <th>Tanggal Transaksi</th>
                                        <th>Invoice</th>
                                        <th>Produk</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @for($i = 0; $i < 10; $i++)
                                        <tr>
                                            <td>20 Mei 2023</td>
                                            <td>INV-001</td>
                                            <td>Pulsa XL - {{random_int(5000,100000)}}</td>
                                            <td>BCA</td>
                                            <td>Rp. 10.000</td>
                                            <td><span class="badge badge-success">Berhasil</span></td>
                                            <td><button class="btn btn-outline btn-sm btn-outline btn-outline-primary btn-active-primary-secondary w-100">Lihat Transaksi</button></td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
