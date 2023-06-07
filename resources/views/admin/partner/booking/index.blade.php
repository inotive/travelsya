@extends('admin.layout',['title' => 'Riwayat Booking',"url" => "#"])

@section('content-admin')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-3">

                    <select name="hotel" id="" class="form-control" onchange="alert('refresh browser')">
                        @for($i =0; $i<10; $i++)
                            <option value="">Hotel {{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-3">
                    <div class="input-group" id="kt_td_picker_date_only" data-td-target-input="nearest" data-td-target-toggle="nearest">
                        <input id="kt_td_picker_date_only_input" type="text" class="form-control" data-td-target="#kt_td_picker_date_only"/>
                        <span class="input-group-text" data-td-target="#kt_td_picker_date_only" data-td-toggle="datetimepicker">
        <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
    </span>
                    </div>
                </div>
                <div class="col-3">
                    <div class="input-group" id="kt_td_picker_date_only" data-td-target-input="nearest" data-td-target-toggle="nearest">
                        <input id="kt_td_picker_date_only_input" type="text" class="form-control" data-td-target="#kt_td_picker_date_only"/>
                        <span class="input-group-text" data-td-target="#kt_td_picker_date_only" data-td-toggle="datetimepicker">
        <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
    </span>
                    </div>
                </div>

                <div class="col-3">
                    <button class="btn btn-primary w-100">Cari Data</button>
                </div>
            </div>
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
                                <th>Room</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Grand Total</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @for($i; $i< 9; $i++)
                                <tr>
                                    <th>{{$i}}</th>
                                    <th>INV - {{$i}}</th>
                                    <th>ACS{{$i}}</th>
                                    <th>{{$i}} Mei 2023</th>
                                    <th>Customer {{$i}}</th>
                                    <th>0812 5329 666{{$i}}</th>
                                    <th>Superior</th>
                                    <th>Room 1</th>
                                    <th>20 Mei 2023 14:00</th>
                                    <th>20 Mei 2023 17:50</th>
                                    <th>Rp. 321.000</th>
                                    <th><button class="btn btn-warning btn-sm p-4">Edit</button></th>
                                </tr>
                            @endfor


                            </tbody>
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
