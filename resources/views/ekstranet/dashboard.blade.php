@extends('ekstranet.layout',['title' => 'Dashboard',"url" => "#"])

@section('content-admin')
<!--begin::Row-->
<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-3 ">
        <div class="card bg-light-success card-xl-stretch mb-xl-8">
            <!--begin::Body-->
            <div class="card-body my-3">
                <h3 class="card-title fw-bold text-success fs-5  d-block">Jumlah Tamu</h3>
                <span class=" fw-bold text-dark fs-8  d-block">Seminggu Terakhir</span>

                <div class="py-1">
                    <span class="text-dark fs-1 fw-bold me-2">10 Orang</span>
                    {{-- <span class="text-dark fs-1 fw-bold me-2">{{$card['guest']}}</span>--}}

                    <span class="fw-semibold text-muted fs-7">Orang</span>
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
                <h3 class="card-title fw-bold text-success fs-5  d-block">Pendapatan</h3>
                <span class=" fw-bold text-dark fs-8  d-block">Seminggu Terakhir</span>

                <div class="py-1">
                    {{-- <span class="text-dark fs-1 fw-bold me-2">{{General::rp($card['revenueWeek'])}}</span>--}}
                    <span class="text-dark fs-1 fw-bold me-2">150000</span>
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
                <h3 class="card-title fw-bold text-success fs-5  d-block">Pendapatan</h3>
                <span class=" fw-bold text-dark fs-8  d-block">Sebulan Terakhir</span>

                <div class="py-1">
                    {{-- <span class="text-dark fs-1 fw-bold me-2">{{General::rp($card['revenueMonth'])}}</span>--}}
                    <span class="text-dark fs-1 fw-bold me-2">123</span>
                    {{-- <span class="text-dark fs-1 fw-bold me-2">{{General::rp($card['revenueMonth'])}}</span>--}}

                </div>
            </div>
            <!--end:: Body-->
        </div>
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-3 ">

        <div class="card card-xxl-stretch mb-5 mb-xl-8">
            <!--begin::Body-->
            <div class="card-body d-flex flex-column">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column mb-7">
                    <!--begin::Title-->
                    <a href="#" class="text-dark text-hover-primary fw-bold fs-3">Summary</a>
                    <!--end::Title-->
                </div>
                <!--end::Wrapper-->

                <!--begin::Row-->
                <div class="row g-0">
                    <!--begin::Col-->
                    <div class="col-6">
                        <div class="d-flex align-items-center mb-9 me-2">

                            <!--begin::Title-->
                            <div>
                                <div class="fs-7 text-success fw-bold">Ready </div>
                                {{-- <div class="fs-5 text-dark fw-bold lh-1">{{$card['ready']}} Rooms</div>--}}
                                <div class="fs-5 text-dark fw-bold lh-1">123 Rooms</div>
                            </div>
                            <!--end::Title-->
                        </div>
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-6">
                        <div class="d-flex align-items-center mb-9 ms-2">

                            <!--begin::Title-->
                            <div>
                                <div class="fs-7 text-danger fw-bold">Not Ready</div>
                                {{-- <div class="fs-5 text-dark fw-bold lh-1">{{$card['notready']}} Rooms</div>--}}
                                <div class="fs-5 text-dark fw-bold lh-1">123 Rooms</div>
                                {{-- <div class="fs-5 text-dark fw-bold lh-1">{{$card['notready']}} Rooms</div>--}}

                            </div>
                            <!--end::Title-->
                        </div>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
        </div>
    </div>
    <!--end::Col-->

</div>
<!--end::Row-->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Riwayat Booking Terakhir</h5>
            </div>
            <div class="card-body">
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

                            {{-- @foreach($transactions as $transaction)--}}
                            {{-- <tr>--}}
                                {{-- <td>{{date('d M y',strtotime($transaction->created_at))}}</td>--}}
                                {{-- <td>{{$transaction->no_inv}}</td>--}}
                                {{-- <td>{{$transaction->req_id}}</td>--}}
                                {{-- <td>{{$transaction->user->name}}</td>--}}
                                {{-- <td>{{date('d M y',strtotime($transaction->bookDate[0]->start))}}</td>--}}
                                {{-- <td>{{date('d M y',strtotime($transaction->bookDate[0]->end))}}</td>--}}
                                {{-- <td>{{$transaction->payment }}</td>--}}
                                {{-- <td>{{ General::rp($transaction->detailTransaction[0]->price) }}</td>--}}
                                {{-- <td><span class="badge {{$transaction->status == " SUCCESS" ? "badge-success"
                                        : "badge-danger" }}">{{$transaction->status }}</span></td>--}}
                                {{-- </tr>--}}
                            {{-- @endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection