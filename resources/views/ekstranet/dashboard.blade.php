@extends('ekstranet.layout',['title' => 'Dashboard',"url" => "#"])

@section('content-admin')

<!--begin::Row-->
<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-3 ">
        <div class="card  card-xl-stretch mb-xl-8">
            <!--begin::Body-->
            <div class="card-body my-3">
                <h3 class="card-title fw-bold text-success fs-5  d-block">Jumlah Tamu</h3>
                <span class=" fw-bold text-dark fs-8  d-block">Seminggu Terakhir</span>

                <div class="py-1">
                    <span class="text-dark fs-1 fw-bold me-2">{{ $guest }} Orang</span>
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
        <div class="card  card-xl-stretch mb-xl-8">
            <!--begin::Body-->
            <div class="card-body my-3">
                <h3 class="card-title fw-bold text-success fs-5  d-block">Pendapatan</h3>
                <span class=" fw-bold text-dark fs-8  d-block">Seminggu Terakhir</span>

                <div class="py-1">
                    <span class="text-dark fs-1 fw-bold me-2">{{General::rp($revenueWeek)}}</span>
                    {{-- <span class="text-dark fs-1 fw-bold me-2">150000</span> --}}
                </div>
            </div>
            <!--end:: Body-->
        </div>
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-3 ">
        <div class="card card-xl-stretch mb-xl-8">
            <!--begin::Body-->
            <div class="card-body my-3">
                <h3 class="card-title fw-bold text-success fs-5  d-block">Pendapatan</h3>
                <span class=" fw-bold text-dark fs-8  d-block">Sebulan Terakhir</span>

                <div class="py-1">
                    <span class="text-dark fs-1 fw-bold me-2">{{General::rp($revenueMonth)}}</span>
                    {{-- <span class="text-dark fs-1 fw-bold me-2">123</span> --}}
                    {{-- <span class="text-dark fs-1 fw-bold me-2">{{General::rp($card['revenueMonth'])}}</span>--}}

                </div>
            </div>
            <!--end:: Body-->
        </div>
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-3 ">
        <div class="card card-xl-stretch mb-xl-8">
            <!--begin::Body-->
            <div class="card-body my-3">
                <h3 class="card-title fw-bold text-success fs-5  d-block">Kamar Terjual</h3>
                <span class=" fw-bold text-dark fs-8  d-block">Bulan Ini</span>

                <div class="py-1">
                    <span class="text-dark fs-1 fw-bold me-2">  {{$notready}} Kamar</span>
                    {{-- <span class="text-dark fs-1 fw-bold me-2">123</span> --}}
                    {{-- <span class="text-dark fs-1 fw-bold me-2">{{General::rp($card['revenueMonth'])}}</span>--}}

                </div>
            </div>
            <!--end:: Body-->
        </div>
    </div>
    <!--end::Col-->

</div>
<!--end::Row-->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Riwayat Booking Bulan Ini</h5>
            </div>
            <div class="card-body">
                <form action="">
                <div class="row mb-2">
                        <div class="col-4">
                            <input class="form-control" placeholder="Tanggal Mulai" name="start_date" id="kt_datepicker_1" value="{{ old('start_date', $start_date) }}"/>
                        
                        </div>
                        <div class="col-4">
                            <input class="form-control" placeholder="Tanggal Akhir" name="end_date" id="kt_datepicker_2" value="{{ old('end_date', $end_date) }}"/>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table id="kt_datatable_dom_positioning" class="table table-bordered">
                        <thead>
                            <tr class="fw-bold fs-6 text-gray-800">
                                <th>Tanggal</th>
                                <th>Tanggal Expired</th>
                                <th>Invoice</th>
                                <th>Code Booking</th>
                                <th>Customer</th>
                                <th>Check IN</th>
                                <th>Check Out</th>
                                <th>Grand Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaction_hotels as $hotel)
                                @php
                                    $startdate = \Carbon\Carbon::parse($hotel->reservation_start);
                                      $enddate = \Carbon\Carbon::parse($hotel->reservation_end);
                                      $startdates = $startdate->Format('d F Y');
                                      $enddates = $enddate->Format('d F Y');
                                      $diffInDays = $startdate->diffInDays($enddate);
                                      $now = \Carbon\Carbon::now();
                                      $remainingDays = $now->diffInDays($enddate);
                                @endphp
                            <tr>
                                {{-- <h1>{{ dd($hotel) }}</h1> --}}
                                <td>{{ \Carbon\Carbon::parse($hotel->created_at)->format('d M Y') }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($hotel->created_at)->addDay()->format('d M Y') }}
                                </td>
                                <td>{{$hotel->no_inv ?? ''}}</td>
                                <td>{{$hotel->req_id ?? ''}}</td>
                                <td>{{$hotel->transaction->user->name  ?? ''}}</td>
                                <td>{{date('d M Y',strtotime($hotel->reservation_start))}}</td>
                                <td>{{date('d M Y',strtotime($hotel->reservation_end))}}</td>
                                {{-- <td>{{ General::rp($hotel->rent_price + $hotel->fee_admin) }}</td> --}}
                                <td>{{ General::rp($hotel->rent_price * $diffInDays ) }}</td>
                                <td>
                                    <span class="badge {{$hotel->status == "PAID" ? "badge-success"
                                        : "badge-warning" }}">{{$hotel->status == "PAID" ? "Sukses"
                                        : "Menunggu Pembayaran" }}</span>
                                </td>
                            </tr>
                            @endforeach
                            @foreach($transaction_hostels as $hostel)
                            <tr>
                                <td>{{\Carbon\Carbon::parse($hostel->created_at)->format('d M Y')}}</td>
                                <td>{{\Carbon\Carbon::parse($hostel->created_at)->addDay()->format('d M Y')}}</td>
                                <td>{{$hostel->no_inv}}</td>
                                <td>{{$hostel->req_id}}</td>
                                <td>{{$hostel->transaction->user->name ?? ''}}</td>
                                <td>{{date('d M Y',strtotime($hostel->reservation_start))}}</td>
                                <td>{{date('d M Y',strtotime($hostel->reservation_end))}}</td>
                                {{-- <td>{{ General::rp($hostel->rent_price + $hostel->fee_admin) }}</td> --}}
                                <td>{{ General::rp($hostel->rent_price ) }}</td>
                                <td>
                                    <span class="badge {{$hostel->status == "SUCCESS" ? "badge-success"
                                        : "badge-warning" }}">{{$hostel->status == "SUCCESS" ? "Sukses"
                                        : "Menunggu Pembayaran" }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('add-script')
<script>
    $("#kt_datepicker_1").flatpickr();
    $("#kt_datepicker_2").flatpickr();
    $("#kt_datatable_dom_positioning").DataTable({
            "language": {
                "lengthMenu": "Show _MENU_",
            },
            "dom": "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">"
        });
</script>
@endpush
