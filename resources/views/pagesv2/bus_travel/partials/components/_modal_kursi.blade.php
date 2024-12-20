<div class="modal fade" id="modal_kursi" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header flex-column" style="align-items: unset;">
                <div class="d-flex flex-row align-items-center mb-2">
                    <span class="fw-bold fs-5">Pilih Penyedia Rental</span>
                    <button class="btn btn-outline-light close ms-sm-auto p-0" id="close_modal" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true" class="fs-1">&times;</span>
                    </button>
                </div>
                <span class="fw-bold title">Citirans</span>
                <small class="mb-20px">Shuttle Toyota Hiace</small>
                <span class="mb-20px">Rab, 16 okt - 08:00 - 11:05 - 2j</span>
                <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6" id="list_penumpang">
                    <div class="col p-3">
                        <div class="card bg-snow-pink" style="border:1px solid var(--bs-danger);" data-penumpang="1">
                            <div class="card-body d-flex flex-column">
                                <span class="fw-bold text-danger">Penumpang 1</span>
                                <span class="text-danger" id="kursi_penumpang_1"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col p-3">
                        <div class="card bg-snow-pink" style="border:1px solid var(--bs-danger);" data-penumpang="2">
                            <div class="card-body d-flex flex-column">
                                <span class="fw-bold text-danger">Penumpang 2</span>
                                <span class="text-danger" id="kursi_penumpang_2"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body bg-snow-pink min-h-350">
                <div class="row border-bottom border-secondary pb-5">
                    <div class="col-12 d-flex flex-row justify-content-center align-items-center">
                        <div style="width: 25px; height: 25px; border: 2px solid var(--bs-dark); border-radius: 3px;">
                        </div>
                        <span class="ms-3 fs-3 text-dark opacity-75">Tersedia</span>
                        <div class="ms-5"
                            style="width: 25px; height: 25px; border: 2px solid var(--bs-danger); border-radius: 3px;">
                        </div>
                        <span class="ms-3 fs-3 text-dark opacity-75">Dipilih</span>
                        <div class="ms-5"
                            style="width: 25px; height: 25px; border-radius: 3px; background-color: #D3D4D4;">
                        </div>
                        <span class="ms-3 fs-3 text-dark opacity-75">Tidak Tersedia</span>
                    </div>
                </div>
                <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6 d-flex flex-row align-items-center justify-content-center p-3"
                    id="row-1">
                    <div type="button" class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"
                        id="pilih_kuris_11" nomor="11"></div>
                    <div type="button" class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"
                        id="pilih_kuris_12" nomor="12"></div>
                    <div type="button" class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"
                        id="pilih_kuris_13" nomor="13"></div>
                    <div type="button" class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"
                        id="pilih_kuris_14" nomor="14"></div>
                    <div type="button" class="col mx-5 border-dark-2"
                        style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kuris_15" nomor="15"></div>
                </div>
                <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6 d-flex flex-row align-items-center justify-content-center p-3"
                    id="row-2">
                    <div type="button" class="col mx-5"
                        style="width: 25px; height: 25px; border-radius: 3px;"id="pilih_kuris_21" nomor="21"></div>
                    <div type="button" class="col mx-5 border-dark-2"
                        style="width: 25px; height: 25px; border-radius: 3px;"id="pilih_kuris_22" nomor="22"></div>
                    <div type="button" class="col mx-5"
                        style="width: 25px; height: 25px; border-radius: 3px;"id="pilih_kuris_23" nomor="23"></div>
                    <div type="button" class="col mx-5"
                        style="width: 25px; height: 25px; border-radius: 3px;"id="pilih_kuris_24" nomor="24"></div>
                    <div type="button" class="col mx-5"
                        style="width: 25px; height: 25px; border-radius: 3px;"id="pilih_kuris_25" nomor="25"></div>
                </div>
                <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6 d-flex flex-row align-items-center justify-content-center p-3"
                    id="row-3">
                    <div type="button" class="col mx-5"
                        style="width: 25px; height: 25px; border-radius: 3px;"id="pilih_kuris_31" nomor="31">
                    </div>
                    <div type="button" class="col mx-5"
                        style="width: 25px; height: 25px; border-radius: 3px;"id="pilih_kuris_32" nomor="32">
                    </div>
                    <div type="button" class="col mx-5"
                        style="width: 25px; height: 25px; border-radius: 3px;"id="pilih_kuris_33" nomor="33">
                    </div>
                    <div type="button" class="col mx-5 border-dark-2"
                        style="width: 25px; height: 25px; border-radius: 3px;"id="pilih_kuris_34" nomor="34">
                    </div>
                    <div type="button" class="col mx-5 border-dark-2"
                        style="width: 25px; height: 25px; border-radius: 3px;"id="pilih_kuris_35" nomor="35">
                    </div>
                </div>
                <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6 d-flex flex-row align-items-center justify-content-center p-3"
                    id="row-4">
                    <div type="button" class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"
                        id="pilih_kuris_41" nomor="41">
                    </div>
                    <div type="button" class="col mx-5 border-dark-2"
                        style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kuris_42" nomor="42">
                    </div>
                    <div type="button" class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"
                        id="pilih_kuris_43" nomor="43">
                    </div>
                    <div type="button" class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"
                        id="pilih_kuris_44" nomor="44">
                    </div>
                    <div type="button" class="col mx-5 border-dark-2"
                        style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kuris_45" nomor="45">
                    </div>
                </div>
                <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6 d-flex flex-row align-items-center justify-content-center p-3"
                    id="row-5">
                    <div type="button" class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"
                        id="pilih_kuris_51" nomor="51">
                    </div>
                    <div type="button" class="col mx-5 border-dark-2"
                        style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kuris_52" nomor="52">
                    </div>
                    <div type="button" class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"
                        id="pilih_kuris_53" nomor="53">
                    </div>
                    <div type="button" class="col mx-5 border-dark-2"
                        style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kuris_54" nomor="54">
                    </div>
                    <div type="button" class="col mx-5 border-dark-2"
                        style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kuris_55" nomor="55">
                    </div>
                </div>
            </div>
            <div class="modal-bpdy p-5">
                <form action="{{ route('bus_travel.order') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">Lanjut Ke Form Pemesanan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $("#list_penumpang").on("click", ".card", function() {
            let penumpang = $(this).data('penumpang');
            $("#list_penumpang .card").removeClass('border-danger');
            $(this).addClass('border-danger');
            $("#modal_kursi").modal('show');
        });
    </script>
@endpush
