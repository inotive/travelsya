@extends('ekstranet.layout',['title' => 'Riwayat Booking',"url" => "#"])

@section('content-admin')
    <div class="card">
        <div class="card-body">
        <form action="#" method="get">
            <div class="row">
                <div class="col-3">

                    <select name="hotel" id="" class="form-control">
                        @foreach($hostels as $hostel)
                            <option value="{{$hostel->id}}" {{(isset($_GET['hotel']) && $_GET['hotel'] == $hostel->id) ? 'selected' : ''}}>{{$hostel->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <input type="date" class="form-control" data-placeholder="Tanggal Awal" name="start" value="{{isset($_GET['start']) ? $_GET['start'] : ''}}">
                </div>
                <div class="col-3">
                    <input type="date" class="form-control" data-placeholder="Tanggal Awal" name="end" value="{{isset($_GET['end']) ? $_GET['end'] : ''}}">
                </div>

                <div class="col-3">
                    <button type="submit" class="btn btn-primary w-100">Cari Data</button>
                </div>
            </div>
        </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered fw-normal">
                            <thead class="fw-bold">
                            <tr>
                                <th>No.</th>
                                <th>Invoice No.</th>
                                <th>Booking</th>
                                <th>Tanggal Transaksi</th>
                                <th>Customer</th>
                                <th>Contact</th>
                                <th>Name Room</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Grand Total</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                            @endphp
                            @foreach($transactions as $transaction)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <th>{{$transaction->no_inv}}</th>
                                    <th>{{$transaction->req_id}}</th>
                                    <th>{{$transaction->created_at}}</th>
                                    <th>{{$transaction->user->name}}</th>
                                    <th>{{$transaction->user->phone}}</th>
                                    <th>{{$transaction->detailTransaction[0]->hostelRoom->name}}</th>
                                    <th>{{$transaction->bookDate[0]->start}}</th>
                                    <th>{{$transaction->bookDate[0]->end}}</th>
                                    <th>{{number_format($transaction->total,0,',','.')}}</th>
                                    <th><a href="{{route('admin.transaction.detail',$transaction->id)}}" class="btn btn-warning btn-sm p-4">Edit</a></th>
                                </tr>
                            @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="12">
                                      {{$transactions->appends(request()->input())->links('vendor.pagination.bootstrap-5')}}
                                  </td>
                                </tr>
                              </tfoot>
                        </table>
                        {{--                <!--begin::Table-->--}}
                        {{--                <table class="table align-middle gs-0 gy-4">--}}
                        {{--                    <!--begin::Table head-->--}}
                        {{--                    <thead>--}}
                        {{--                        <tr class="fw-bold text-muted bg-light">--}}
                        {{--                            <th class="min-w-75px ps-4 rounded-start">Category</th>--}}
                        {{--                            <th class="min-w-125px">Name</th>--}}
                        {{--                            <th class="min-w-125px">Value</th>--}}
                        {{--                            <th class="min-w-125px">Percent</th>--}}
                        {{--                            <th class="min-w-150px text-end rounded-end"></th>--}}
                        {{--                        </tr>--}}
                        {{--                    </thead>--}}
                        {{--                    <!--end::Table head-->--}}
                        {{--                    <!--begin::Table body-->--}}
                        {{--                    <tbody>--}}
                        {{--                        @foreach($points as $point)--}}
                        {{--                        <tr>--}}
                        {{--                            <td>--}}
                        {{--                                <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$point->category}}</div>--}}
                        {{--                            </td>--}}
                        {{--                            <td>--}}
                        {{--                                <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$point->name}}</div>--}}
                        {{--                            </td>--}}
                        {{--                            <td>--}}
                        {{--                                <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$point->value}}</div>--}}
                        {{--                            </td>--}}
                        {{--                            <td>--}}
                        {{--                                <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{($point->is_percent) ? "Yes" : "No"}}--}}
                        {{--                                </div>--}}
                        {{--                            </td>--}}
                        {{--                            <td class="text-end">--}}
                        {{--                                <a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit"--}}
                        {{--                                    data-id="{{$point->id}}" data-category="{{$point->category}}" data-name="{{$point->name}}" data-value="{{$point->value}}" data-is_percent="{{$point->is_percent}}" data-bs-toggle="modal" data-bs-target="#edit">--}}
                        {{--                                    <i class="ki-duotone ki-pencil fs-2">--}}
                        {{--                                        <span class="path1"></span>--}}
                        {{--                                        <span class="path2"></span>--}}
                        {{--                                    </i>--}}
                        {{--                                </a>--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}
                        {{--                        @endforeach--}}
                        {{--                    </tbody>--}}
                        {{--                    <tfoot>--}}
                        {{--                        <tr>--}}
                        {{--                            <td>--}}
                        {{--                                {{$points->appends(request()->input())->links('vendor.pagination.bootstrap-5')}}--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}
                        {{--                        </tfoot>--}}
                        {{--                    <!--end::Table body-->--}}
                        {{--                </table>--}}
                        {{--                <!--end::Table-->--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('add-script')
    <script>
        // $(document).ready(function() {
        //     $("#kt_datatable_vertical_scroll").DataTable({
        //         search: {
        //             return: true,
        //         },
        //     });
        // } );
        new tempusDominus.TempusDominus(document.getElementById("kt_td_picker_date_only"), {
            display: {
                viewMode: "calendar",
                components: {
                    decades: true,
                    year: true,
                    month: true,
                    date: true,
                    hours: false,
                    minutes: false,
                    seconds: false
                }
            }
        });
    </script>
@endpush
