@extends('ekstranet.layout', ['title' => 'Laporan Transaksi', 'url' => '#'])

@section('content-admin')
    <div class="card">
        <div class="card-body">
            <form action="" method="get">
                <div class="row">
                    <div class="col-3">
                        <select class="form-select" name="year">
                            <option value="" disabled selected>Pilih Tahun</option>
                            @php
                                $currentYear = date('Y');
                                $startYear = 2020; // Tahun awal yang diinginkan
                            @endphp
                            @for ($i = $currentYear; $i >= $startYear; $i--)
                                <option value="{{ $i }}"
                                    {{ isset($_GET['year']) && $_GET['year'] == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-3">
                        <input type="date" class="form-control" data-placeholder="Tanggal Awal" name="start"
                            value="{{ isset($_GET['start']) ? $_GET['start'] : '' }}">
                    </div>
                    <div class="col-3">
                        <input type="date" class="form-control" data-placeholder="Tanggal Awal" name="end"
                            value="{{ isset($_GET['end']) ? $_GET['end'] : '' }}">
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
                                    <th>Tanggal & Waktu</th>
                                    <th>Customer</th>
                                    <th>Contact</th>
                                    <th>Metode & Channel Pembayaran</th>
                                    <th>Deskripsi Pesanan</th>
                                    <th>Grand Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp

                                {{-- @foreach ($transcation_id as $ucup)
                                    <p>{{$ucup->id}}</p>
                                @endforeach --}}
                                @foreach ($transaction_hotels as $hotel)
                                    @php
                                        $transaction_id = $hotel->transaction_id;

                                        $detail_pemesanan = DB::table('detail_transaction_hotel')
                                            ->join('transactions', 'transactions.id', '=', 'detail_transaction_hotel.transaction_id')
                                            ->where('transaction_id', $transaction_id)
                                            ->value('detail_transaction_hotel.id');
                                    @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $hotel->transaction->no_inv }}</td>
                                        <td>{{  \Carbon\Carbon::parse($hotel->created_at)->format('d M Y H:i:s')
                                        }}</td>
                                        <td>{{ $hotel->transaction->user->name }}</td>
                                        <td>{{ $hotel->transaction->user->phone }}</td>
                                        <td>
                                            {{ $hotel->transaction->payment_method }} -
                                            {{ $hotel->transaction->payment_channel }}
                                        </td>
                                        <td>
                                            {{ $hotel->hotel->name }} - {{ $hotel->room . ' ' . $hotel->hotelRoom->name }}

                                            @php
                                                $startDate = new DateTime($hotel->reservation_start);
                                                $endDate = new DateTime($hotel->reservation_end);
                                                $interval = $startDate->diff($endDate);
                                                echo $interval->format('%a Malam');
                                            @endphp
                                        </td>
                                        <td>{{ General::rp($hotel->rent_price + $hotel->fee_admin) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('partner.riwayat-booking.detailhotel', ['id' => $detail_pemesanan]) }}"
                                               class="btn btn-sm btn-outline btn-outline-primary text-dark btn-active-light-secondary w-100" data-kt-customer-table-filter="delete_row">
                                                Detail Pesanan
                                            </a>

                                        </td>
                                    </tr>
                                    @php
                                        $no++;
                                    @endphp
                                @endforeach


                                @foreach ($transaction_hostels as $hostel)
                                    @php
                                        $transaction_id = $hostel->transaction->id;

                                        $detail_pemesanan = DB::table('detail_transaction_hostel')
                                            ->join('transactions', 'transactions.id', '=', 'detail_transaction_hostel.transaction_id')
                                            ->where('transaction_id', $transaction_id)
                                            ->value('detail_transaction_hostel.id');

                                            // dd($transaction_id, $detail_pemesanan);
                                    @endphp

                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $hostel->transaction->no_inv }}</td>
                                        <td>{{  \Carbon\Carbon::parse($hostel->updated_at)->format('d M Y H:i:s') }}
                                        </td>
                                        <td>{{ $hostel->transaction->user->name }}</td>
                                        <td>{{ $hostel->transaction->user->phone }}</td>
                                        <td>
                                            {{ $hostel->transaction->payment_method }} -
                                            {{ $hostel->transaction->payment_channel }}
                                        </td>
                                        <td>
                                            {{ $hostel->hostel->name }} -
                                            {{ $hostel->room . ' ' . $hostel->hostelRoom->name }} -
                                            {{ $hostel->type_rent == 'tahunan' ? 'Tahunan' : 'Bulanan' }}
                                        </td>
                                        <td>{{ General::rp($hostel->rent_price + $hostel->fee_admin) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('partner.riwayat-booking.detailhostel', ['id' => $detail_pemesanan]) }}"
                                               class="btn btn-sm btn-outline btn-outline-primary text-dark btn-active-light-secondary w-100" data-kt-customer-table-filter="delete_row">
                                                Detail Pesanan
                                            </a>
                                        </td>
                                    </tr>
                                    @php
                                        $no++;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="12">
                                        {{--
                                    {{$transactions->appends(request()->input())->links('vendor.pagination.bootstrap-5')}} --}}
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
