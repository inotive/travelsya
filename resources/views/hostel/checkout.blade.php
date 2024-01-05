@extends('layouts.web')

@section('title', 'Ruangan Pribadi')

@section('content-web')
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">

        <!--begin::Post-->
        <div class="content flex-row-fluid mb-10" id="kt_content">
            <form action="{{ route('hostel.request', $hostelRoom->id) }}" class="d-flex flex-column" method="post">
                @csrf
                <div class="row justify-content-between">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body d-flex flex-column">
                                @auth
                                    <div class="">
                                        <label class="form-label fw-bold fs-6">Nama Lengkap</label>
                                        <input type="name" class="form-control" value="{{ Auth()->user()->name }}"
                                            name="nama_lengkap">
                                    </div>
                                    <div class="mt-10">
                                        <label class="form-label fw-bold fs-6">Email Address</label>
                                        <input type="email" class="form-control" value="{{ Auth()->user()->email }}"
                                            name="email">
                                    </div>
                                    <div class="mt-10">
                                        <label class="form-label fw-bold fs-6">Nomor Telepon</label>
                                        <input type="phone" class="form-control" value="{{ Auth()->user()->phone }}"
                                            name="no_telfon">
                                    </div>
                                @endauth

                                @guest
                                    <div class="align-self-center">
                                        <a href="{{ route('login') }}">Login First</a>
                                    </div>
                                @endguest
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-gray-900">{{ $hostelRoom->hostel->name }}</h4>
                                <p class="card-text mt-1 text-gray-500">{{ $hostelRoom->hostel->address }}</p>
                                <div>
                                    @for ($j = 1; $j < $hostelRoom->hostel->star; $j++)
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                    @endfor
                                </div>

                                @php
                                    $checkin = \Carbon\Carbon::parse($params['start']);
                                    $duration = $params['category'] == 'yearly' ? $params['duration'] / 12 : $params['duration'];
                                    $checkout = $checkin->copy()->addMonths($duration);

                                    if ($params['category'] == 'monthly') {
                                        $sellingprice = $hostelRoom->sellingrentprice_monthly;
                                    }

                                    if ($params['category'] == 'yearly') {
                                        $sellingprice = $hostelRoom->sellingrentprice_yearly;
                                    }
                                @endphp

                                <p class="card-text mt-4 text-gray-500"><span class="fa fa-calendar me-3"></span>
                                    {{ date('d-m-Y', strtotime($params['start'])) }} - {{ $checkout->format('d-m-Y') }}
                                    ({{ $duration }} {{ $params['category'] == 'yearly' ? 'Tahun' : 'Bulan' }})</p>
                                <p class="card-text mt-1 text-gray-500">Room : {{ $hostelRoom->name }} (Maks
                                    {{ $hostelRoom->max_guest }} Tamu)</p>

                                {{-- @if ($params['guest'] > $hostelRoom->guest)
                                <p class="card-text mt-1 text-gray-500">Ekstrabed :
                                    {{ (int) $params['guest'] - (int) $hostelRoom->guest }} Bed</p>
                                @endif --}}

                                {{-- <p class="card-text mt-1 text-gray-500">Anda memesan {{ $params['room'] }} Ruangan</p> --}}

                                <hr>

                                <table width="100%">
                                    <tr>
                                        <td>Room Price{{ $params['category'] == 'yearly' ? '/Year' : '/Month' }}
                                            ({{ $duration }} {{ $params['category'] == 'yearly' ? 'Year' : 'Month' }})
                                        </td>
                                        <td>:</td>
                                        <td class="text-end">{{ General::rp($sellingprice) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Duration ({{ $params['category'] == 'yearly' ? 'Tahun' : 'Bulan' }})</td>
                                        <td>:</td>
                                        <td class="text-end">{{ $duration }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td>Extrabed</td>
                                        <td>:</td>
                                        <td class="text-end">{{ General::rp($duration * (int)
                                    $hostelRoom->extrabedprice) }}</td>
                                    </tr> --}}
                                    <tr>
                                        <td>Fee Admin</td>
                                        <td>:</td>
                                        <td class="text-end">{{ General::rp($feeAdmin) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kode Unik</td>
                                        <td>:</td>
                                        <td class="text-end">{{ General::rp($uniqueCode) }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="fw-light-grey-900">Pakai Point
                                                <span>{{ auth()->user()->point }}</span>
                                            </p>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <div
                                                class="form-check form-switch form-check-custom form-check-solid float-end">
                                                <input class="form-check-input pakai-point" type="checkbox"
                                                    id="flexSwitchChecked" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="grand-total-1">
                                        <td>Grand Total</td>
                                        <td>:</td>
                                        <td class="text-end">
                                            {{ General::rp($duration * $sellingprice + $feeAdmin + $uniqueCode - auth()->user()->point) }}
                                        </td>
                                    </tr>
                                    <tr class="grand-total-2">
                                        <td>Grand Total</td>
                                        <td>:</td>
                                        <td class="text-end">
                                            {{ General::rp($duration * $sellingprice + $feeAdmin + $uniqueCode) }}</td>
                                    </tr>
                                </table>
                                <div class="mt-10">

                                    <input type="hidden" name="service" value="hostel">
                                    <input type="hidden" name="payment_method" value="xendit">
                                    <input type="hidden" name="hostel_room_id" value="{{ $hostelRoom->id }}">
                                    <input type="hidden" name="start"
                                        value="{{ date('d-m-Y', strtotime($params['start'])) }}">
                                    <input type="hidden" name="pointCheked" value="{{ auth()->user()->point }}"
                                        id="pointInput" disabled>
                                    <input type="hidden" name="end" value="{{ $checkout->format('d-m-Y') }}">
                                    <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                                    <input type="hidden" name="duration" value="{{ $duration }}">
                                    <input type="hidden" name="grand_total" id="grand-total-1"
                                        value="{{ $duration * $sellingprice + $feeAdmin + $uniqueCode }}">
                                    <input type="hidden" name="grand_total" id="grand-total-2"
                                        value="{{ $duration * $sellingprice + $feeAdmin + $uniqueCode - auth()->user()->point }}">
                                    <input type="hidden" name="point" value="{{ $point }}">
                                    <input type="hidden" name="category" value="{{ $params['category'] }}">
                                    <input type="hidden" name="uniqueCode" value="{{ $uniqueCode }}">
                                    <button type="submit" class="btn btn-danger flex-fill">
                                        Lanjut ke pembayaran
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--end::Post-->
    </div>
    <!--end::Container-->
@endsection
@push('add-style')
    <style>
        body {
            background-size: 100% 80px !important;
        }

        .card-hostel:hover {
            border: 1px solid #D9214E;
            cursor: pointer;
        }
    </style>
@endpush
@push('add-script')
    <script>
        $(document).ready(function() {
            $(".grand-total-1").addClass("d-none");
            $(".grand-total-2").removeClass("d-none");
            $("#grand-total-1").prop("disabled", false);
            $("#grand-total-2").prop("disabled", true);

            // Handle the change event of the checkbox
            $("#flexSwitchChecked").change(function() {
                // Check if the checkbox is checked
                if ($(this).is(":checked")) {
                    // If checked, remove d-none from Grand Total 1 and add d-none to Grand Total 2
                    $(".grand-total-1").removeClass("d-none");
                    $(".grand-total-2").addClass("d-none");
                    $("#grand-total-1").prop("disabled", false);
                    $("#grand-total-2").prop("disabled", true);
                    $("#pointInput").prop("disabled", false);
                } else {
                    // If not checked, remove d-none from Grand Total 2 and add d-none to Grand Total 1
                    $(".grand-total-1").addClass("d-none");
                    $(".grand-total-2").removeClass("d-none");
                    $("#grand-total-1").prop("disabled", true);
                    $("#grand-total-2").prop("disabled", false);
                    $("#pointInput").prop("disabled", true);
                    $("#pointInput").remove();
                }
            });
        });
    </script>
@endpush
