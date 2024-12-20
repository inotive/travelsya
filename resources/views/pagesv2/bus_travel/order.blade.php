@extends('layouts.app_v2')

@section('content')
    <div class="container mb-5">
        <section class="special-deals mt-5">

            <div class="row" style="padding-top: 50px;">
                <div class="col-8">
                    <div class="alert alert-warning mb-25px" role="alert">
                        <i class="fa-solid fa-triangle-exclamation"></i> <span><strong> Refund dan Reschedule tidak
                                tersedia</strong>
                            Lihat Informasi selengkapnya <a href="javascript:" class="text-warning fw-bold">Disini</a></span>
                    </div>

                    <div class="section-title mb-25px">
                        <div style="display: flex; align-items: center;">
                            <h2 class="text-dark" style="position: relative; top: 3px;">Detail Pemesanan</h2>
                        </div>
                        <div class="subtitle text-capitalize mt-2">detail kontak ini akan digunakan untuk pengiriman e-tiket
                            dan keperluan reschedule</div>
                    </div>
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-35px">
                            <div class="card rounded-4 border-1 shadow">
                                <div class="card-body">
                                    <div class="d-flex flex-row align-items-center mb-3">
                                        <input type="radio" name="sapa_pemesan" id="radio_tuan" value="tuan">
                                        <span class="ms-3">Tuan</span>
                                        <input type="radio" name="sapa_pemesan" class="ms-5" id="radio_nyonya"
                                            value="nyonya">
                                        <span class="ms-3">Nyonya</span>
                                        <input type="radio" name="sapa_pemesan" class="ms-5" id="radio_nona"
                                            value="nona">
                                        <span class="ms-3">Nona</span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_pemesan" class="form-label">Nama</label>
                                        <input type="text" name="nama_pemesan" id="nama_pemesan" class="form-control"
                                            value="#" placeholder="Masukan nama">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone_pemesan" class="form-label">Nomor Ponsel</label>
                                        <input type="text" name="phone_pemesan" id="phone_pemesan" class="form-control"
                                            value="#" placeholder="Masukan nomor Handphone" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email_pemesan" class="form-label">Alamat Email</label>
                                        <input type="email" name="email_pemesan" id="email_pemesan" class="form-control"
                                            value="#" placeholder="Masukan Email">
                                    </div>
                                    <input type="hidden" name="total_ticket" value="#">
                                    <input type="hidden" name="service" value="health-beauty">
                                    <input type="hidden" name="payment" value="xendit">
                                    <input type="hidden" name="package_id" value="#">
                                    <input type="hidden" name="point" value="0">
                                </div>
                            </div>
                        </div>

                        <!-- Additional Safety -->
                        <div class="section-title" style="margin-bottom: 25px;">
                            <div style="display: flex; align-items: center;">
                                <h2 class="text-dark" style="position: relative; top: 3px;">Detail Penumpang</h2>
                            </div>
                            <div class="subtitle text-capitalize mt-2">Pastikan mengisi detail pengunjung dengan benar agar
                                penjelasan lancar
                            </div>
                        </div>

                        <div class="mb-35px">
                            <div class="card rounded-4 border-1 shadow">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <h2 class="text-danger">Penumpang 1</h2>
                                        </div>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input h-20px w-30px" type="checkbox" value=""
                                                id="toggle_pengunjung" />
                                            <label class="form-check-label" for="flexSwitchChecked">
                                                Sama dengan pemesan
                                            </label>
                                        </div>
                                    </div>
                                    <div
                                        class="mb-3 bg-snow-pink text-dark p-2 rounded d-flex flex-row align-items-center px-5">
                                        <img src="{{ asset('images/icon/chair.png') }}" width="25px" height="25px"
                                            alt="">
                                        <div class="d-flex flex-column ms-5">
                                            <Span>Cititrans</Span>
                                            <Span>Kursi 6</Span>
                                        </div>
                                        <span class="text-danger fw-bold ms-sm-auto">Ubah Kursi</span>
                                    </div>
                                    <div id="data_pengunjung">
                                        <div class="d-flex flex-row align-items-center mb-3">
                                            <input type="radio" name="sapa_pengunjung" class=" accent-danger"
                                                id="radio_tuan" value="tuan" checked required>
                                            <span class="ms-3">Tuan</span>
                                            <input type="radio" name="sapa_pengunjung" class="ms-5 accent-danger"
                                                id="radio_tuan" value="nyonya" required>
                                            <span class="ms-3">Nyonya</span>
                                            <input type="radio" name="sapa_pengunjung" class="ms-5 accent-danger"
                                                id="radio_nona" value="nona" required>
                                            <span class="ms-3">Nona</span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama_pengunjung" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="nama_pengunjung"
                                                name="nama_pengunjung" placeholder="Masukan nama pengunjung" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone_pengunjung" class="form-label">Nomor Ponsel</label>
                                            <input type="text" class="form-control" id="phone_pengunjung"
                                                name="phone_pengunjung" placeholder="Masukan nomor handphone" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email_pengunjung" class="form-label">Alamat Email</label>
                                            <input type="email" class="form-control" id="email_pengunjung"
                                                name="email_pengunjung" placeholder="Masukan Email">
                                        </div>
                                    </div>
                                    <div id="data_disabled_pengunjung" style="display: none;">
                                        <div class="d-flex flex-row align-items-center mb-3">
                                            <input type="radio" name="sapa_disabled_pengunjung" id="radio_tuan"
                                                value="tuan" disabled>
                                            <span class="ms-3">Tuan</span>
                                            <input type="radio" name="sapa_disabled_pengunjung" class="ms-5"
                                                id="radio_tuan" value="nyonya" disabled>
                                            <span class="ms-3">Nyonya</span>
                                            <input type="radio" name="sapa_disabled_pengunjung" class="ms-5"
                                                id="radio_nona" value="nona" disabled>
                                            <span class="ms-3">Nona</span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama_disabled_pengunjung" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="nama_disabled_pengunjung"
                                                placeholder="Masukan nama pengunjung" disabled readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone_disabled_pengunjung" class="form-label">Nomor Ponsel</label>
                                            <input type="text" class="form-control" id="phone_disabled_pengunjung"
                                                placeholder="Masukan nomor handphone" disabled readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email_disabled_pengunjung" class="form-label">Alamat Email</label>
                                            <input type="email" class="form-control" id="email_disabled_pengunjung"
                                                placeholder="Masukan Email" disabled readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Detail Pengunjung -->

                        <div class="mb-35px">
                            <input type="checkbox" name="setuju_syarat" id="setuju_syarat" class="accent-danger">
                            <span>saya menyetujui <span class="text-danger fw-bold">Syarat & Kententuan</span> di
                                Travelsya</span>
                        </div>

                        <div class="mb-35px">
                            <div class="card rounded-4 border-1 shadow">
                                <div class="card-header d-flex flex-row align-items-center">
                                    <h2 class="fw-bold">Total Pembayaran</h2>
                                    <h2 class="fw-bold">IDR 3</h2>
                                </div>
                                <div class="card-body d-flex flex-row align-items-center">
                                    <span class="fa-solid fa-gem fs-3 text-danger"></span>
                                    <span class="ms-3">Kamu akan mendapatkan #
                                        poin</span>
                                    <button class="text-light btn btn-danger ms-sm-auto">Lanjutkan Pemesanan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-4">
                    <div class="card rounded-4 border-1 shadow fs-5 mb-35px">
                        <div class="card-body p-5">
                            <div class="d-flex flex-row align-items-center">
                                <span class="fw-bold p-2 rouded-1 text-wrap bg-snow-pink text-danger">Pergi</span>
                                <span class="ms-2">Sel, 15 Okt 2024 . 09:54</span>
                                <span class="text-danger ms-sm-auto">Detail Paket</span>
                            </div>
                            <hr class="opacity-25 my-5">
                            <div class="d-flex flex-column">
                                <div class="d-flex flex-row align-items-center">
                                    <span class="">Bandung</span>
                                    <i class="fa-solid fa-arrow-right ms-3"></i>
                                    <span class="ms-3">Jakarta</span>
                                </div>
                                <div class="d-flex flex-row align-items-center">
                                    <span class="">Cititrans</span>
                                    <span class="fa-solid mx-3 fa-circle"></span>
                                    <span>Shuffle Toyota Hiace</span>
                                </div>
                            </div>
                            <hr class="opacity-25 my-5">
                            <div class="d-flex flex-row align-items-center">
                                <span>Total pembayaran</span>
                                <span class="fs-3 ms-sm-auto">IDR #</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>



    @push('js')
        <script>
            $(document).ready(function() {
                $("#list_paket").on("click", "#decrease_paket", function() {
                    let id = $(this).attr("id_paket");
                    let val_paket = parseInt($("#val_paket_" + id).val());
                    let decrease_val = val_paket;
                    if (val_paket - 1 >= 0) {
                        decrease_val = val_paket - 1;
                    }
                    $("#val_paket_" + id).val(decrease_val);
                    $("#dummy_paket_" + id).text(decrease_val);
                })


                $("#list_paket").on("click", "#increase_paket", function() {
                    let id = $(this).attr("id_paket");
                    let val_paket = parseInt($("#val_paket_" + id).val());
                    let increase_val = val_paket + 1;
                    console.log(increase_val);

                    $("#val_paket_" + id).val(increase_val);
                    $("#dummy_paket_" + id).text(increase_val);
                });

                function syncField() {
                    if ($("#toggle_pengunjung").is(":checked")) {
                        hidePengunjung();

                        let sapa_pemesan = $("input[name='sapa_pemesan']:checked").val();

                        if (sapa_pemesan) {
                            $("input[name='sapa_pengunjung']").prop('checked', false)
                                .filter(`[value='${sapa_pemesan}']`).prop('checked', true);
                            $("input[name='sapa_disabled_pengunjung']").prop('checked', false)
                                .filter(`[value='${sapa_pemesan}']`).prop('checked', true);
                        }

                        $("#nama_pengunjung").val($("#nama_pemesan").val());
                        $("#phone_pengunjung").val($("#phone_pemesan").val());
                        $("#email_pengunjung").val($("#email_pemesan").val());

                        $("#nama_disabled_pengunjung").val($("#nama_pemesan").val());
                        $("#phone_disabled_pengunjung").val($("#phone_pemesan").val());
                        $("#email_disabled_pengunjung").val($("#email_pemesan").val());
                    } else {
                        showPengunjung();
                    }
                }

                function showPengunjung() {
                    $("#data_pengunjung").css("display", "block");
                    $("#data_disabled_pengunjung").css("display", "none");
                }

                function hidePengunjung() {
                    $("#data_pengunjung").css("display", "none");
                    $("#data_disabled_pengunjung").css("display", "block");
                }

                $("#toggle_pengunjung").on("click", syncField);

                $("input[name='sapa_pemesan']").on("click", syncField);

                $("#nama_pemesan, #phone_pemesan, #email_pemesan").on("keyup", syncField);
            });
        </script>
    @endpush
@endsection
