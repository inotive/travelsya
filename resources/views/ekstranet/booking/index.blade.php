@extends('ekstranet.layout', ['title' => 'Riwayat Booking', 'url' => '#'])

@section('content-admin')
    <div class="card mb-2">
        <div class="card-body">
            <form action="#" method="get">
                <div class="row">
                    <div class="col-3">
                        <select class="form-select" name="year">
                            <option value="" disabled selected>Pilih Tahun</option>
                            @php
                                $currentYear = date('Y');
                                $startYear = 2020; // Tahun awal yang diinginkan
                            @endphp
                            @for ($i = $currentYear; $i >= $startYear; $i--)
                                <option value="{{ $i }}" {{ isset($_GET['year']) && $_GET['year'] == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-3">
                        <input type="date" class="form-control" name="start" placeholder="Tanggal Mulai" value="{{ isset($_GET['start']) ? $_GET['start'] : '' }}">
                    </div>
                    <div class="col-3">
                        <input type="date" class="form-control" name="end" placeholder="Tanggal Selesai" value="{{ isset($_GET['end']) ? $_GET['end'] : '' }}">
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary w-100">Cari Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">

                    <table class="table table-striped gy-7 gs-7 table-bordered table align-middle"
                        id="kt_datatable_zero_configuration">
                        <thead>
                            <tr class="fw-bold fs-6 text-gray-800 ">
                                <th class="text-center">Customer</th>
                                <th class="text-center">Code Booking</th>
                                <th class="text-center">Check In</th>
                                <th class="text-center">Check Out</th>
                                <th class="text-center">Tipe Kamar</th>
                                <th class="text-center">Jumlah Ruangan & Menginap</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hotelbookdates as $booking)
                                @php
                                    $startdate = \Carbon\Carbon::parse($booking->start);
                                    $enddate = \Carbon\Carbon::parse($booking->end);
                                    $startdates = $startdate->Format('d F Y');
                                    $enddates = $enddate->Format('d F Y');
                                    
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $booking->transaction->user->name }} -
                                        {{ $booking->transaction->user->phone }}</td>
                                    <td class="text-center">CTH123</td>
                                    <td class="text-center">{{ $startdates }}
                                    </td>
                                    <td class="text-center">{{ $enddates }}</td>
                                    <td class="text-center">{{ $booking->hotelroom->name }}</td>
                                    <td class="text-center">1 Kamar | 8 Malam</td>



                                    <td class="text-center">
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true" style="">

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="javascript:void(0)" class="menu-link px-3 text-warning"
                                                    id="" data-id="" data-bs-toggle="modal">
                                                    Cetak
                                                </a>
                                            </div>

                                            <div class="menu-item px-3">
                                                <a href="{{ route('partner.riwayat-booking.detailhotel', $booking->id) }}" class="menu-link px-3 text-warning"
                                                    id="" data-id="">
                                                    Detail Booking
                                                </a>
                                            </div>

                                            {{-- <div class="menu-item px-3">
                                                <a href="{{ route('partner.management.room.detailroomhostel', $room->id) }}" class="menu-link px-3" data-kt-customer-table-filter="delete_row">
                                                    Detail Ruangan
                                                </a>
                                            </div> --}}
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->

                                            <!--end::Menu item-->
                                        </div>
                                        <!--begin::Menu-->
                                        <a href="#"
                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                        </a>
                                        <!--end::Menu-->
                                    </td>
                                </tr>

                                </td>
                                </tr>
                            @endforeach

                            @foreach ($hostelbookdates as $booking)
                                @php
                                    $startdate = \Carbon\Carbon::parse($booking->start);
                                    $enddate = \Carbon\Carbon::parse($booking->end);
                                    $startdates = $startdate->Format('d F Y');
                                    $enddates = $enddate->Format('d F Y');
                                    
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $booking->transaction->user->name }} -
                                        {{ $booking->transaction->user->phone }}</td>
                                    <td class="text-center">CTH123</td>
                                    <td class="text-center">{{ $startdates }}
                                    </td>
                                    <td class="text-center">{{ $enddates }}</td>
                                    <td class="text-center">{{ $booking->hostelroom->name }}</td>
                                    <td class="text-center">1 Kamar | 8 Malam</td>



                                    <td class="text-center">
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true" style="">

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{ route('partner.riwayat-booking.detailhostel', $booking->id) }}" class="menu-link px-3 text-warning"
                                                    id="" data-id="">
                                                    Detail Booking
                                                </a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="javascript:void(0)" class="menu-link px-3 text-warning"
                                                    id="" data-id="" data-bs-toggle="modal">
                                                    Cetak
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->

                                            <!--end::Menu item-->
                                        </div>
                                        <!--begin::Menu-->
                                        <a href="#"
                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                        </a>
                                        <!--end::Menu-->
                                    </td>
                                </tr>

                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
@endsection
@push('add-script')
    <script>
        $(document).ready( function () {
            $('#kt_datatable_zero_configuration').DataTable({
                "scrollY": "500px",
                "scrollCollapse": true,
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom":
                    "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">"
            });
        } );
    </script>

@endpush