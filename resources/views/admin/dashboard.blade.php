@extends('admin.layout',['title' => 'Dashboard',"url" => "#"])

@section('content-admin')
<!--begin::Row-->
<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-3 mb-xl-10">
        <!--begin::Card widget 2-->
        <div class="card">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                <!--begin::Icon-->
                <div class="m-0">
                    <h3 class="fw-semibold text-gray-800 lh-1 ls-n2">Total Partner</h3>
                </div>
                <!--end::Icon-->
                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <h4 class="text-gray-800 lh-1 ls-n2">3 Partner</h4>
                    <!--end::Number-->
                </div>
                <!--end::Section-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-3 mb-xl-10">
        <!--begin::Card widget 2-->
        <div class="card">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                <!--begin::Icon-->
                <div class="m-0">
                    <h3 class="fw-semibold text-gray-800 lh-1 ls-n2">Jumlah Transaksi Hari Ini</h3>
                </div>
                <!--end::Icon-->
                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <h4 class="text-gray-800 lh-1 ls-n2">3 Transaksi</h4>
                    <!--end::Number-->
                </div>
                <!--end::Section-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-3 mb-xl-10">
        <!--begin::Card widget 2-->
        <div class="card">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                <!--begin::Icon-->
                <div class="m-0">
                    <h3 class="fw-semibold  text-gray-800 lh-1 ls-n2">Pendapatan Transaksi Hari Ini</h3>
                </div>
                <!--end::Icon-->
                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <h4 class=" text-gray-800 lh-1 ls-n2">Rp. 12.123.123</h4>
                    <!--end::Number-->
                </div>
                <!--end::Section-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-3 mb-xl-10">
        <!--begin::Card widget 2-->
        <div class="card">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                <!--begin::Icon-->
                <div class="m-0">
                    <h3 class="fw-semibold text-gray-800 lh-1 ls-n2">Pendapatan Bulan Ini</h3>
                </div>
                <!--end::Icon-->
                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <h4 class="text-gray-800 lh-1 ls-n2">Rp. 1.111.234</h4>
                    <!--end::Number-->
                </div>
                <!--end::Section-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>
    <!--end::Col-->
</div>
<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-12 mb-xl-10">
        <!--begin::List widget 10-->
        <div class="card card-flush h-lg-100">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Nav-->
                <ul class="nav nav-pills nav-pills-custom row position-relative mx-0 mb-9">
                    <!--begin::Item-->
                    <li class="nav-item col-1 mx-0 p-0">
                        <!--begin::Link-->
                        <a class="nav-link active d-flex justify-content-center w-100 border-0 h-100"
                            data-bs-toggle="pill" href="#semua">
                            <!--begin::Subtitle-->
                            <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">Semua</span>
                            <!--end::Subtitle-->
                            <!--begin::Bullet-->
                            <span
                                class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                            <!--end::Bullet-->
                        </a>
                        <!--end::Link-->
                    </li>
                    <!--end::Item-->
                    @foreach($services as $key => $service)
                    <!--begin::Item-->
                    <li class="nav-item col-1 mx-0 p-0">
                        <!--begin::Link-->
                        <a class="nav-link d-flex justify-content-center w-100 border-0 h-100"
                            data-bs-toggle="pill" href="#{{$key}}">
                            <!--begin::Subtitle-->
                            <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">{{$service->name}}</span>
                            <!--end::Subtitle-->
                            <!--begin::Bullet-->
                            <span
                                class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                            <!--end::Bullet-->
                        </a>
                        <!--end::Link-->
                    </li>
                    <!--end::Item-->
                    @endforeach
                </ul>
                <!--end::Nav-->
                <!--begin::Tab Content-->
                <div class="tab-content">
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade show active" id="semua">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        <th class="min-w-75px ps-4 rounded-start">No</th>
                                        <th class="min-w-125px">Tanggal Transaksi</th>
                                        <th class="min-w-125px">Invoice</th>
                                        <th class="min-w-125px">Produk</th>
                                        <th class="min-w-125px">Metode</th>
                                        <th class="min-w-125px">Total Pembayaran</th>
                                        <th class="min-w-125px">Status</th>
                                        <th class="min-w-150px text-end rounded-end">Aksi</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    @foreach($transactions as $key => $transaction)
                                    <tr>
                                        <td>
                                            <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                {{$loop->iteration}}</div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{date('d/m/y',strtotime($transaction->created_at))}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$transaction->no_inv}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">
                                                {{($transaction->detailTransaction[0]->hostelRoom == null) ? $transaction->detailTransaction[0]->product->name : $transaction->detailTransaction[0]->hostelRoom->hostel->name}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$transaction->payment}}|{{$transaction->payment_channel != null ? $transaction->payment_channel : 'None'}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$transaction->detailTransaction[0]->price}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$transaction->detailTransaction[0]->status}}
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <a href="{{route('admin.transaction.detail',$transaction->id)}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit"
                                                data-id="{{$transaction->id}}">
                                                <i class="ki-duotone ki-pencil fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                    @php
                                    if($key == 4) break;
                                    @endphp
                                    @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--end::Tap pane-->
                    @foreach($services as $key => $service)
                        @php
                        $catId = $service->id;
                        $filterTransactions = array_filter($transactions->toArray(),function($val) use ($catId){
                        return ($val['service_id'] == $catId);
                        });
                        // dd(collect($filterTransactions));
                        @endphp


                    <!--begin::Tap pane-->
                    <div class="tab-pane fade" id="{{$key}}">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        <th class="min-w-75px ps-4 rounded-start">No</th>
                                        <th class="min-w-125px">Tanggal Transaksi</th>
                                        <th class="min-w-125px">Invoice</th>
                                        <th class="min-w-125px">Produk</th>
                                        <th class="min-w-125px">Metode</th>
                                        <th class="min-w-125px">Total Pembayaran</th>
                                        <th class="min-w-125px">Status</th>
                                        <th class="min-w-150px text-end rounded-end">Aksi</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                    @forelse($filterTransactions as $key2 => $transaction)
                                    <tr>
                                        <td>
                                            <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                {{$loop->iteration}}</div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{date('d/m/y',strtotime($transaction['created_at']))}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$transaction['no_inv']}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">
                                                {{($transaction['detail_transaction'][0]['hostel_room'] == null) ? $transaction['detail_transaction'][0]['product']['name'] : $transaction['detail_transaction'][0]['hostel_room']['hostel']['name']}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$transaction['payment']}}|{{$transaction['payment_channel'] != null ? $transaction['payment_channel'] : 'None'}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$transaction['detail_transaction'][0]['price']}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$transaction['detail_transaction'][0]['status']}}
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <a href="{{route('admin.transaction.detail',$transaction['id'])}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit"
                                                data-id="{{$transaction['id']}}">
                                                <i class="ki-duotone ki-pencil fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                    @php
                                    if($key2 == 4) break;
                                    @endphp
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Not found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--end::Tap pane-->
                    @endforeach

                </div>
                <!--end::Tab Content-->
            </div>
            <!--end: Card Body-->
        </div>
        <!--end::List widget 10-->
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->
@endsection
