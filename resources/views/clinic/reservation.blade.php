@extends('layouts.web')

@section('content-web')
    <!--begin::Container-->
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->
        <div class="content flex-row-fluid mb-10" id="kt_content">
            <form action="" class="d-flex flex-column" method="post">
                @csrf
                <div class="row w-75 me-auto ms-auto mt-10">
                    <div class="col-7">
                        <div class="card">

                            <div class="card-header">
                                <h2 class="card-title fw-bold">Detail Pesanan</h2>
                            </div>
                            <div class="card-body">
                             
                                
                                    <div class="">
                                        <label class="form-label fw-bold fs-6">Nama Lengkap</label>
                                        <input type="name" class="form-control" value="Jihan Apriliani"
                                            name="nama_lengkap">
                                    </div>
                                    <div class="mt-10">
                                        <label class="form-label fw-bold fs-6">Email Address</label>
                                        <input type="email" class="form-control" value="jihan@gmail.com"
                                            name="email">
                                    </div>
                                    <div class="mt-10">
                                        <label class="form-label fw-bold fs-6">Nomor Telepon</label>
                                        <input type="phone" class="form-control" value="089876543456"
                                            name="no_telfon">
                                    </div>
                               
                              
                            </div>

                        </div>
                    </div>
                    <div class="col-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <h3 class="fw-bold card-title">Calm Spa & Leisure Place</h3>
                                    </div>
                                    <div class="col-12">
                                        <span class="">Jl. Komplek Balikpapan Super Blok, Ruko Blok C No. 19-25, Jl. Jendral Sudirman, Damai, Kec. Balikpapan Kota, Kota Balikpapan, Kalimantan Timur 76114</span>
                                        @for ($j = 0; $j < 5; $j++)
                                            <span class="card-text fa fa-star mt-3" style="color: orange;">
                                            </span>
                                        @endfor
                                    </div>
                                   
                                    
                                    <div class="col-12">
                                        <span>Paket : </span>
                                        <span class="fw-bold mt-2">Paket Spa 1</span>
                                    </div>
                                    <div class="col-12">
                                        <div class="badge badge-success rounded-2 mt-3 p-4">
                                            Anda Memesan Paket Spa 1
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row gy-3">
                                    <div class="col-12 d-flex justify-content-between">
                                        <p>Biaya </p>
                                        <h5>
                                          Rp 140.000
                                        </h5>
                                       
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <p>Fee Admin</p>
                                        <h5>
                                            Rp 14.000
                                        </h5>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <p>Kode Unik</p>
                                        <h5>
                                             TRX017987654567
                                        </h5>
                                    </div>
                                   
                                  
                                    <div class="col-12 d-flex justify-content-between grand-total-2">
                                        <p>Grand Total</p>
                                        <h4>
                                            Rp 154.000
                                        </h4>
                                    </div>
                                  
                                    <div class="col-12">

                                        {{-- <input type="hidden" name="service" value="hotel">
                                        <input type="hidden" name="payment_method" value="xendit">
                                        <input type="hidden" name="hotel_id" value="{{ $hotelRoom->hotel->id }}">
                                        <input type="hidden" name="hostel_room_id" value="{{ $hotelRoom->id }}">
                                        <input type="hidden" name="point" value="{{ auth()->user()->point }}"
                                            id="pointInput" disabled>
                                      

                                        <input type="hidden" name="start" value="{{ $params['start'] }}">
                                        <input type="hidden" name="end" value="{{ $checkout->format('d-m-Y') }}">
                                        <input type="hidden" name="name" value="{{ Auth()->user()->name }}">
                                        <input type="hidden" name="pointFee" value="{{ $point }}">
                                        <input type="hidden" name="room" value="{{ $params['room'] }}">
                                        <input type="hidden" name="total_guest" value="{{ $params['guest'] }}">
                                        <input type="hidden" name="uniqueCode" value="{{ $uniqueCode }}"> --}}
                                        <button class="btn btn-lg w-100 text-white" style="background-color: #c02425">
                                            Lanjut Pembayaran
                                        </button>

                                    </div>
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
