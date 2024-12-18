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
                <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6">
                    <div class="col p-3">
                        <div class="card bg-snow-pink" style="border:1px solid var(--bs-danger);">
                            <div class="card-body d-flex flex-column">
                                <span class="fw-bold text-danger">Penumpang 1</span>
                                <span class="text-danger">Kursi 6</span>
                            </div>
                        </div>
                    </div>
                    <div class="col p-3">
                        <div class="card bg-snow-pink" style="border:1px solid var(--bs-danger);">
                            <div class="card-body d-flex flex-column">
                                <span class="fw-bold text-danger">Penumpang 1</span>
                                <span class="text-danger">Kursi 6</span>
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
                <div class="row">

                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

@push('js')
    <script></script>
@endpush
