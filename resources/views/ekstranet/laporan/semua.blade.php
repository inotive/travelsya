@extends('ekstranet.layout',['title' => 'Laporan Transaksi',"url" => "#"])

@section('content-admin')
    <div class="card">
        <div class="card-body">
            <form action="#" method="get">
                <div class="row">
                    <div class="col-3">

{{--                        <select name="hotel" id="" class="form-control">--}}
{{--                            @foreach($hostels as $hostel)--}}
{{--                                <option value="{{$hostel->id}}" {{(isset($_GET['hotel']) && $_GET['hotel'] == $hostel->id) ? 'selected' : ''}}>{{$hostel->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
                    </div>
                    <div class="col-3">
{{--                        <input type="date" class="form-control" data-placeholder="Tanggal Awal" name="start" value="{{isset($_GET['start']) ? $_GET['start'] : ''}}">--}}
                    </div>
                    <div class="col-3">
{{--                        <input type="date" class="form-control" data-placeholder="Tanggal Awal" name="end" value="{{isset($_GET['end']) ? $_GET['end'] : ''}}">--}}
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
                                <th>Tanggal Transaksi</th>
                                <th>Customer</th>
                                <th>Contact</th>
                                <th>Metode & Channel Pembayaran</th>
                                <th>Deskripsi Pesanan</th>
                                <th>Grand Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>INV-123-HOTEL</td>
                                <td>20 Okt 2023 10:11</td>
                                <td>Customer A</td>
                                <9td>0812-5123-4123</9td>
                                <td>Bank Transfer - BCA</td>
                                <td>Hotel A - 2 Room Superior - 2 Malam </td>
                                <td>Rp. 100.000</td>
                            </tr>
                            @php
                                @endphp
{{--                            @foreach($transactions as $transaction)--}}
{{--                                <tr>--}}
{{--                                    <th>{{$loop->iteration}}</th>--}}
{{--                                    <th>{{$transaction->no_inv}}</th>--}}
{{--                                    <th>{{$transaction->req_id}}</th>--}}
{{--                                    <th>{{$transaction->created_at}}</th>--}}
{{--                                    <th>{{$transaction->user->name}}</th>--}}
{{--                                    <th>{{$transaction->user->phone}}</th>--}}
{{--                                    <th>{{$transaction->detailTransaction[0]->hostelRoom->name}}</th>--}}
{{--                                    <th>{{$transaction->bookDate[0]->start}}</th>--}}
{{--                                    <th>{{$transaction->bookDate[0]->end}}</th>--}}
{{--                                    <th>{{$transaction->total}}</th>--}}
{{--                                    <th><a href="{{route('admin.transaction.detail',$transaction->id)}}" class="btn btn-warning btn-sm p-4">Edit</a></th>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}


                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="12">
{{--                                    {{$transactions->appends(request()->input())->links('vendor.pagination.bootstrap-5')}}--}}
                                </td>
                            </tr>
                            </tfoot>
                        </table>
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
