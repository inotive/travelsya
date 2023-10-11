@extends('admin.layout', ['title' => 'Dashboard', 'url' => '#'])

@section('content-admin')
    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-sm-6 col-xl-3 ">
            <div class="card bg-light-success card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <h3 class="card-title fw-bold text-success fs-5  d-block">Jumlah Partner</h3>
                    <div class="py-1">
                        <span class=" fw-bold text-dark fs-8  d-block">Keseluruhan</span>
                        <div class="py-1">
                            {{-- <span class="text-dark fs-1 fw-bold me-2">10 Partner</span> --}}
                            <span class="text-dark fs-1 fw-bold me-2">{{ $card['partner'] }}</span>

                            {{--                        <span class="text-dark fs-1 fw-bold me-2">{{$card['guest']}}</span> --}}

                            <span class="fw-semibold text-muted fs-7">Partner</span>
                        </div>
                        {{--                        <span class="text-dark fs-1 fw-bold me-2">{{$card['partner']}}</span> --}}
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
                    <h3 class="card-title fw-bold text-success fs-5  d-block">Jumlah Transaksi</h3>
                    <span class=" fw-bold text-dark fs-8  d-block">Hari Ini</span>

                    <div class="py-1">
                        {{-- <span class="text-dark fs-1 fw-bold me-2">103123</span> --}}

                        <span class="text-dark fs-1 fw-bold me-2">{{ $card['transactionToday'] }}</span>

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
                    <h3 class="card-title fw-bold text-success fs-5  d-block">Pendapatan Transaksi</h3>
                    <span class=" fw-bold text-dark fs-8  d-block">Hari Ini</span>

                    <div class="py-1">
                        {{-- <span class="text-dark fs-1 fw-bold me-2">103123</span> --}}
                        <span class="text-dark fs-2 fw-bold me-2">{{ $card['sumDayTransaction'] }}</span>

                        {{--                        <span class="text-dark fs-1 fw-bold me-2">{{$card['transactionToday']}}</span> --}}

                        {{--                        <span class="text-dark fs-5 fw-bold me-2">{{General::rp((int)$card['sumDayTransaction'])}}</span> --}}
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
                    <h3 class="card-title fw-bold text-success fs-5  d-block">Pendapatan Transaksi</h3>
                    <span class=" fw-bold text-dark fs-8  d-block">Bulan Ini</span>

                    <div class="py-1">
                        <span class="text-dark fs-2 fw-bold me-2">{{ $card['sumMonthTransaction'] }}</span>

                        {{--                        <span class="text-dark fs-1 fw-bold me-2">{{$card['transactionToday']}}</span> --}}
                        {{--                        <span class="text-dark fs-5 fw-bold me-2">{{General::rp((int)$card['sumMonthTransaction'])}}</span> --}}
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
                            <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_all">Semua Transaksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_penginapan">Penginapan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_ppob">PPOB</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_pulsa">Pulsa & Data</a>
                        </li>
                        {{--                        @foreach ($services as $key => $service) --}}
                        {{--                        <li class="nav-item"> --}}
                        {{--                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_{{$key}}">{{ucfirst($service->name)}}</a> --}}
                        {{--                        </li> --}}
                        {{--                        @endforeach --}}
                    </ul>
                </div>
                <div class="card-body">

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_tab_pane_all" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-gray-800">
                                            <th>Tanggal</th>
                                            <th>Invoice</th>
                                            <th>Produk</th>
                                            <th>Customer</th>
                                            <th>Deskripsi</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Grand Total</th>
                                            <th>Fee Admin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($transactions as $key => $transaction) --}}
                                        @foreach ($detailTransactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction['created_at'] }}</td>
                                                <td>{{ $transaction['no_inv'] }}</td>
                                                <td>
                                                    <span class="badge badge-rounded badge-primary">
                                                        {{ strtoupper($transaction['service_name']) }}
                                                    </span>
                                                </td>
                                                <td>{{ $transaction['user'] }}</td>
                                                <td>{{ $transaction['transaction_name'] }} -
                                                    {{ $transaction['transaction_desc'] }}</td>
                                                <td>{!! $transaction['payment_method'] ? str_replace('_', ' ', $transaction['payment_method']) : '-' !!}</td>
                                                <td>@currency($transaction['transaction_price'])</td>
                                                <td>@currency($transaction['fee'])</td>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{--                        @foreach ($services as $key => $service) --}}
                        {{--                        @php --}}
                        {{--                        $catId = $service->id; --}}
                        {{--                        $filterTransactions = array_filter($transactions->toArray(),function($val) use ($catId){ --}}
                        {{--                        return ($val['service_id'] == $catId); --}}
                        {{--                    }); --}}
                        {{--                        @endphp --}}
                        {{--                        <div class="tab-pane fade" id="kt_tab_pane_{{$key}}" role="tabpanel"> --}}
                        {{--                            <div class="table-responsive"> --}}
                        {{--                                <table class="table table-bordered"> --}}
                        {{--                                    <thead> --}}
                        {{--                                    <tr class="fw-bold fs-6 text-gray-800"> --}}
                        {{--                                        <th>Tanggal</th> --}}
                        {{--                                        <th>Invoice</th> --}}
                        {{--                                        <th>Code Booking</th> --}}
                        {{--                                        <th>Customer</th> --}}
                        {{--                                        <th>Check IN</th> --}}
                        {{--                                        <th>Check Out</th> --}}
                        {{--                                        <th>Metode Pembayaran</th> --}}
                        {{--                                        <th>Grand Total</th> --}}
                        {{--                                        <th>Status</th> --}}
                        {{--                                    </tr> --}}
                        {{--                                    </thead> --}}
                        {{--                                    <tbody> --}}

                        {{--                                    @forelse($filterTransactions as $key2 => $transaction) --}}
                        {{--                                        <tr> --}}
                        {{--                                            <td>{{date('d/m/y',strtotime($transaction["created_at"]))}}</td> --}}
                        {{--                                            <td>{{$transaction['no_inv']}}</td> --}}
                        {{--                                            <td>{{$transaction['req_id']}}</td> --}}
                        {{--                                            <td>{{$transaction['user']['name']}}</td> --}}
                        {{--                                            @if (isset($transaction['book_date']) && count($transaction['book_date']) != 0) --}}
                        {{--                                            <td>{{$transaction['book_date'][0]['start']}}</td> --}}
                        {{--                                            <td>{{$transaction['book_date'][0]['end']}}</td> --}}
                        {{--                                            @else --}}
                        {{--                                            <td></td> --}}
                        {{--                                            <td></td> --}}
                        {{--                                            @endif --}}
                        {{--                                            <td>{{$transaction['payment_channel']}}</td> --}}
                        {{--                                            <td>{{$transaction['total']}}</td> --}}
                        {{--                                            <td><span class="badge {{($transaction['status'] == 'SUCCESS') ? 'badge-success' : 'badge-danger'}} ">{{($transaction['status'] == "SUCCESS" ? "Lunas" : $transaction['status'])}}</span></td> --}}
                        {{--                                        </tr> --}}
                        {{--                                    @php --}}
                        {{--                                    if($key2 == 4) break; --}}
                        {{--                                    @endphp --}}
                        {{--                                    @empty --}}
                        {{--                                        <tr> --}}
                        {{--                                            <td colspan="8" class="text-center">Not found</td> --}}
                        {{--                                        </tr> --}}
                        {{--                                    @endforelse --}}
                        {{--                                    </tbody> --}}
                        {{--                                </table> --}}
                        {{--                            </div> --}}
                        {{--                        </div> --}}
                        {{--                        @endforeach --}}
                        {{--                        <div class="tab-pane fade" id="kt_tab_pane_6" role="tabpanel"> --}}
                        {{--                            <div class="table-responsive"> --}}
                        {{--                                <table class="table table-bordered"> --}}
                        {{--                                    <thead> --}}
                        {{--                                    <tr class="fw-bold fs-6 text-gray-800"> --}}
                        {{--                                        <th>Tanggal</th> --}}
                        {{--                                        <th>Invoice</th> --}}
                        {{--                                        <th>Code Booking</th> --}}
                        {{--                                        <th>Customer</th> --}}
                        {{--                                        <th>Check IN</th> --}}
                        {{--                                        <th>Check Out</th> --}}
                        {{--                                        <th>Metode Pembayaran</th> --}}
                        {{--                                        <th>Grand Total</th> --}}
                        {{--                                        <th>Status</th> --}}
                        {{--                                    </tr> --}}
                        {{--                                    </thead> --}}
                        {{--                                    <tbody> --}}

                        {{--                                    @for ($i = 0; $i < 10; $i++) --}}
                        {{--                                        <tr> --}}
                        {{--                                            <td>20 Mei 2023</td> --}}
                        {{--                                            <td>INV-001</td> --}}
                        {{--                                            <td>CTB1</td> --}}
                        {{--                                            <td>Customer {{$i}}</td> --}}
                        {{--                                            <td>23 Mei 2023 12:00</td> --}}
                        {{--                                            <td>25 Mei 2023 14:00</td> --}}
                        {{--                                            <td>BCA</td> --}}
                        {{--                                            <td>Rp. 1.500.000</td> --}}
                        {{--                                            <td><span class="badge badge-success">Lunas</span></td> --}}
                        {{--                                        </tr> --}}
                        {{--                                    @endfor --}}
                        {{--                                    </tbody> --}}
                        {{--                                </table> --}}
                        {{--                            </div> --}}
                        {{--                        </div> --}}
                        {{--                        <div class="tab-pane fade" id="kt_tab_pane_7" role="tabpanel"> --}}
                        {{--                            <div class="table-responsive"> --}}
                        {{--                                <table class="table table-bordered"> --}}
                        {{--                                    <thead> --}}
                        {{--                                    <tr class="fw-bold fs-6 text-gray-800"> --}}
                        {{--                                        <th>Tanggal Transaksi</th> --}}
                        {{--                                        <th>Invoice</th> --}}
                        {{--                                        <th>Produk</th> --}}
                        {{--                                        <th>Metode Pembayaran</th> --}}
                        {{--                                        <th>Status</th> --}}
                        {{--                                        <th>Aksi</th> --}}
                        {{--                                    </tr> --}}
                        {{--                                    </thead> --}}
                        {{--                                    <tbody> --}}

                        {{--                                    @for ($i = 0; $i < 10; $i++) --}}
                        {{--                                        <tr> --}}
                        {{--                                            <td>20 Mei 2023</td> --}}
                        {{--                                            <td>INV-001</td> --}}
                        {{--                                            <td>Pulsa XL - {{random_int(5000,100000)}}</td> --}}
                        {{--                                            <td>BCA</td> --}}
                        {{--                                            <td>Rp. 10.000</td> --}}
                        {{--                                            <td><span class="badge badge-success">Berhasil</span></td> --}}
                        {{--                                            <td><button class="btn btn-outline btn-sm btn-outline btn-outline-primary btn-active-primary-secondary w-100">Lihat Transaksi</button></td> --}}
                        {{--                                        </tr> --}}
                        {{--                                    @endfor --}}
                        {{--                                    </tbody> --}}
                        {{--                                </table> --}}
                        {{--                            </div> --}}
                        {{--                        </div> --}}
                        {{--                        <div class="tab-pane fade" id="kt_tab_pane_8" role="tabpanel"> --}}
                        {{--                            <div class="table-responsive"> --}}
                        {{--                                <table class="table table-bordered"> --}}
                        {{--                                    <thead> --}}
                        {{--                                    <tr class="fw-bold fs-6 text-gray-800"> --}}
                        {{--                                        <th>Tanggal Transaksi</th> --}}
                        {{--                                        <th>Invoice</th> --}}
                        {{--                                        <th>Produk</th> --}}
                        {{--                                        <th>Metode Pembayaran</th> --}}
                        {{--                                        <th>Status</th> --}}
                        {{--                                        <th>Aksi</th> --}}
                        {{--                                    </tr> --}}
                        {{--                                    </thead> --}}
                        {{--                                    <tbody> --}}

                        {{--                                    @for ($i = 0; $i < 10; $i++) --}}
                        {{--                                        <tr> --}}
                        {{--                                            <td>20 Mei 2023</td> --}}
                        {{--                                            <td>INV-001</td> --}}
                        {{--                                            <td>Pulsa XL - {{random_int(5000,100000)}}</td> --}}
                        {{--                                            <td>BCA</td> --}}
                        {{--                                            <td>Rp. 10.000</td> --}}
                        {{--                                            <td><span class="badge badge-success">Berhasil</span></td> --}}
                        {{--                                            <td><button class="btn btn-outline btn-sm btn-outline btn-outline-primary btn-active-primary-secondary w-100">Lihat Transaksi</button></td> --}}
                        {{--                                        </tr> --}}
                        {{--                                    @endfor --}}
                        {{--                                    </tbody> --}}
                        {{--                                </table> --}}
                        {{--                            </div> --}}
                        {{--                        </div> --}}
                        {{--                        <div class="tab-pane fade" id="kt_tab_pane_9" role="tabpanel"> --}}
                        {{--                            <div class="table-responsive"> --}}
                        {{--                                <table class="table table-bordered"> --}}
                        {{--                                    <thead> --}}
                        {{--                                    <tr class="fw-bold fs-6 text-gray-800"> --}}
                        {{--                                        <th>Tanggal Transaksi</th> --}}
                        {{--                                        <th>Invoice</th> --}}
                        {{--                                        <th>Produk</th> --}}
                        {{--                                        <th>Metode Pembayaran</th> --}}
                        {{--                                        <th>Status</th> --}}
                        {{--                                        <th>Aksi</th> --}}
                        {{--                                    </tr> --}}
                        {{--                                    </thead> --}}
                        {{--                                    <tbody> --}}

                        {{--                                    @for ($i = 0; $i < 10; $i++) --}}
                        {{--                                        <tr> --}}
                        {{--                                            <td>20 Mei 2023</td> --}}
                        {{--                                            <td>INV-001</td> --}}
                        {{--                                            <td>Pulsa XL - {{random_int(5000,100000)}}</td> --}}
                        {{--                                            <td>BCA</td> --}}
                        {{--                                            <td>Rp. 10.000</td> --}}
                        {{--                                            <td><span class="badge badge-success">Berhasil</span></td> --}}
                        {{--                                            <td><button class="btn btn-outline btn-sm btn-outline btn-outline-primary btn-active-primary-secondary w-100">Lihat Transaksi</button></td> --}}
                        {{--                                        </tr> --}}
                        {{--                                    @endfor --}}
                        {{--                                    </tbody> --}}
                        {{--                                </table> --}}
                        {{--                            </div> --}}
                        {{--                        </div> --}}
                        {{--                        <div class="tab-pane fade" id="kt_tab_pane_10" role="tabpanel"> --}}
                        {{--                            <div class="table-responsive"> --}}
                        {{--                                <table class="table table-bordered"> --}}
                        {{--                                    <thead> --}}
                        {{--                                    <tr class="fw-bold fs-6 text-gray-800"> --}}
                        {{--                                        <th>Tanggal Transaksi</th> --}}
                        {{--                                        <th>Invoice</th> --}}
                        {{--                                        <th>Produk</th> --}}
                        {{--                                        <th>Metode Pembayaran</th> --}}
                        {{--                                        <th>Status</th> --}}
                        {{--                                        <th>Aksi</th> --}}
                        {{--                                    </tr> --}}
                        {{--                                    </thead> --}}
                        {{--                                    <tbody> --}}

                        {{--                                    @for ($i = 0; $i < 10; $i++) --}}
                        {{--                                        <tr> --}}
                        {{--                                            <td>20 Mei 2023</td> --}}
                        {{--                                            <td>INV-001</td> --}}
                        {{--                                            <td>Pulsa XL - {{random_int(5000,100000)}}</td> --}}
                        {{--                                            <td>BCA</td> --}}
                        {{--                                            <td>Rp. 10.000</td> --}}
                        {{--                                            <td><span class="badge badge-success">Berhasil</span></td> --}}
                        {{--                                            <td><button class="btn btn-outline btn-sm btn-outline btn-outline-primary btn-active-primary-secondary w-100">Lihat Transaksi</button></td> --}}
                        {{--                                        </tr> --}}
                        {{--                                    @endfor --}}
                        {{--                                    </tbody> --}}
                        {{--                                </table> --}}
                        {{--                            </div> --}}
                        {{--                        </div> --}}
                        {{--                        <div class="tab-pane fade" id="kt_tab_pane_11" role="tabpanel"> --}}
                        {{--                            <div class="table-responsive"> --}}
                        {{--                                <table class="table table-bordered"> --}}
                        {{--                                    <thead> --}}
                        {{--                                    <tr class="fw-bold fs-6 text-gray-800"> --}}
                        {{--                                        <th>Tanggal Transaksi</th> --}}
                        {{--                                        <th>Invoice</th> --}}
                        {{--                                        <th>Produk</th> --}}
                        {{--                                        <th>Metode Pembayaran</th> --}}
                        {{--                                        <th>Status</th> --}}
                        {{--                                        <th>Aksi</th> --}}
                        {{--                                    </tr> --}}
                        {{--                                    </thead> --}}
                        {{--                                    <tbody> --}}

                        {{--                                    @for ($i = 0; $i < 10; $i++) --}}
                        {{--                                        <tr> --}}
                        {{--                                            <td>20 Mei 2023</td> --}}
                        {{--                                            <td>INV-001</td> --}}
                        {{--                                            <td>Pulsa XL - {{random_int(5000,100000)}}</td> --}}
                        {{--                                            <td>BCA</td> --}}
                        {{--                                            <td>Rp. 10.000</td> --}}
                        {{--                                            <td><span class="badge badge-success">Berhasil</span></td> --}}
                        {{--                                            <td><button class="btn btn-outline btn-sm btn-outline btn-outline-primary btn-active-primary-secondary w-100">Lihat Transaksi</button></td> --}}
                        {{--                                        </tr> --}}
                        {{--                                    @endfor --}}
                        {{--                                    </tbody> --}}
                        {{--                                </table> --}}
                        {{--                            </div> --}}
                        {{--                        </div> --}}
                        {{--                    </div> --}}

                    </div>


                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="kt_tab_pane_penginapan" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-gray-800">
                                            <th>Tanggal</th>
                                            <th>Invoice</th>
                                            <th>Produk</th>
                                            <th>Customer</th>
                                            <th>Deskripsi</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Grand Total</th>
                                            <th>Fee Admin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($transactions as $key => $transaction) --}}
                                        @foreach ($detailTransactionHotel as $transaction)
                                            <tr>
                                                <td>{{ $transaction['created_at'] }}</td>
                                                <td>{{ $transaction['no_inv'] }}</td>
                                                <td>
                                                    <span class="badge badge-rounded badge-primary">
                                                        {{ strtoupper($transaction['service_name']) }}
                                                    </span>
                                                </td>
                                                <td>{{ $transaction['user'] }}</td>
                                                <td>{{ $transaction['transaction_name'] }} -
                                                    {{ $transaction['transaction_desc'] }}</td>
                                                <td>{!! $transaction['payment_method'] ? str_replace('_', ' ', $transaction['payment_method']) : '-' !!}</td>
                                                <td>@currency($transaction['transaction_price'])</td>
                                                <td>@currency($transaction['fee'])</td>
                                        @endforeach

                                        @foreach ($detailTransactionHostel as $transaction)
                                            <tr>
                                                <td>{{ $transaction['created_at'] }}</td>
                                                <td>{{ $transaction['no_inv'] }}</td>
                                                <td>
                                                    <span class="badge badge-rounded badge-primary">
                                                        {{ strtoupper($transaction['service_name']) }}
                                                    </span>
                                                </td>
                                                <td>{{ $transaction['user'] }}</td>
                                                <td>{{ $transaction['transaction_name'] }} -
                                                    {{ $transaction['transaction_desc'] }}</td>
                                                <td>{!! $transaction['payment_method'] ? str_replace('_', ' ', $transaction['payment_method']) : '-' !!}</td>
                                                <td>@currency($transaction['transaction_price'])</td>
                                                <td>@currency($transaction['fee'])</td>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="kt_tab_pane_ppob" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-gray-800">
                                            <th>Tanggal</th>
                                            <th>Invoice</th>
                                            <th>Produk</th>
                                            <th>Customer</th>
                                            <th>Deskripsi</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Grand Total</th>
                                            <th>Fee Admin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($transactions as $key => $transaction) --}}
                                        @foreach ($detailTransactionPPOB as $transaction)
                                            <tr>
                                                <td>{{ $transaction['created_at'] }}</td>
                                                <td>{{ $transaction['no_inv'] }}</td>
                                                <td>
                                                    <span class="badge badge-rounded badge-primary">
                                                        {{ strtoupper($transaction['service_name']) }}
                                                    </span>
                                                </td>
                                                <td>{{ $transaction['user'] }}</td>
                                                <td>{{ $transaction['transaction_name'] }} -
                                                    {{ $transaction['transaction_desc'] }}</td>
                                                <td>{!! $transaction['payment_method'] ? str_replace('_', ' ', $transaction['payment_method']) : '-' !!}</td>
                                                <td>@currency($transaction['transaction_price'])</td>
                                                <td>@currency($transaction['fee'])</td>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="kt_tab_pane_pulsa" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-gray-800">
                                            <th>Tanggal</th>
                                            <th>Invoice</th>
                                            <th>Produk</th>
                                            <th>Customer</th>
                                            <th>Deskripsi</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Grand Total</th>
                                            <th>Fee Admin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($transactions as $key => $transaction) --}}
                                        @foreach ($detailTransactionPulsa as $transaction)
                                            <tr>
                                                <td>{{ $transaction['created_at'] }}</td>
                                                <td>{{ $transaction['no_inv'] }}</td>
                                                <td>
                                                    <span class="badge badge-rounded badge-primary">
                                                        {{ strtoupper($transaction['service_name']) }}
                                                    </span>
                                                </td>
                                                <td>{{ $transaction['user'] }}</td>
                                                <td>{{ $transaction['transaction_name'] }} -
                                                    {{ $transaction['transaction_desc'] }}</td>
                                                <td>{!! $transaction['payment_method'] ? str_replace('_', ' ', $transaction['payment_method']) : '-' !!}</td>
                                                <td>@currency($transaction['transaction_price'])</td>
                                                <td>@currency($transaction['fee'])</td>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    @endsection
