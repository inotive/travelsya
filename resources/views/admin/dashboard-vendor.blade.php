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
                    <h3 class="fw-semibold text-gray-800 lh-1 ls-n2">Jumlah Tamu</h3>
                    <p class="fw-semibold text-gray-800">Dalam seminggu terakhir</p>
                </div>
                <!--end::Icon-->
                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <h4 class="text-gray-800">{{$card['guest']}} Tamu</h4>
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
                    <h3 class="fw-semibold text-gray-800 lh-1 ls-n2">Pendapatan</h3>
                    <p class="fw-semibold text-gray-800">Dalam seminggu terakhir</p>
                </div>
                <!--end::Icon-->
                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <h4 class="text-gray-800">{{General::rp($card['revenueWeek'])}}</h4>
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
                    <h3 class="fw-semibold text-gray-800 lh-1 ls-n2">Pendapatan</h3>
                    <p class="fw-semibold text-gray-800">Dalam sebulan terakhir</p>
                </div>
                <!--end::Icon-->
                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <h4 class=" text-gray-800">{{General::rp($card['revenueMonth'])}}</h4>
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
                    <h3 class="fw-semibold text-gray-800 lh-1 ls-n2">Rooms</h3>
                </div>
                <!--end::Icon-->
                <table>
                    <thead>
                        <tr>
                            <th class="min-w-50px">Ready</th>
                            <th class="w-50">Not Ready</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-green">{{$card['ready']}} Rooms</td>
                            <td class="text-danger">{{$card['notready']}} Rooms</td>
                        </tr>
                    </tbody>
                </table>
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
             <!--begin::Tables Widget 11-->
        <div class="card mb-5 mb-xl-8">
            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="min-w-75px rounded-start">Date</th>
                                <th class="min-w-125px">No Invoice</th>
                                <th class="min-w-125px">Booking Code</th>
                                <th class="min-w-125px">Customer</th>
                                <th class="min-w-125px">Checkin</th>
                                <th class="min-w-125px">Checkout</th>
                                <th class="min-w-125px">Payment</th>
                                <th class="min-w-125px">Total</th>
                                <th class="min-w-125px">Status</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @foreach($transactions as $transaction)
                            <tr>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{date('d M y',strtotime($transaction->created_at))}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$transaction->no_inv}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$transaction->req_id}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{$transaction->user->name}}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{date('d M y',strtotime($transaction->bookDate[0]->start))}}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{date('d M y',strtotime($transaction->bookDate[0]->end))}}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">
                                        {{$transaction->payment }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">
                                        {{ General::rp($transaction->detailTransaction[0]->price) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">
                                        {{$transaction->status }}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--begin::Body-->
        </div>
        <!--end::Tables Widget 11-->
        </div>
        <!--end::List widget 10-->
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->
@endsection
