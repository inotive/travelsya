<div class="accordion">
    <div class="card accordion-item mb-3">
        <div class="card-header p-0 border-bottom-dashed">
            <div class="accordion-header w-100">
                <div class="w-100" id="paket-2">
                    <button class="accordion-button bg-opacity-0 align-items-start" type="button"
                        data-bs-toggle="collapse" data-bs-target="#paket-collapse-2" aria-expanded="true"
                        aria-controls="paket-collapse-2">
                        <div class="d-flex flex-column">
                            <h2 class="mb-25px text-secondary">{{ $package->name }} @if ($weektype != 'weekend')
                                    (Weekend)
                                @endif
                            </h2>
                            <div class="d-flex flex-column mb-25px">
                                @if ($package->is_refundable == 1)
                                    <div class="d-flex flex-row align-items-center mb-2 fs-3">
                                        <span class="fa-solid fa-money-bill text-secondary"></span>
                                        <span class="ms-3 text-secondary">Bisa 100% refund dengan auransi
                                            (Asuransi
                                            tersedia dengan biaya tambahan)</span>
                                    </div>
                                @else
                                    <div class="d-flex flex-row align-items-center mb-2 fs-3">
                                        <span class="fa-solid fa-money-bill text-secondary"></span>
                                        <span class="ms-3 text-secondary">Tidak dapat di refund</span>
                                    </div>
                                @endif

                                @if ($package->is_reschedule == 1)
                                    <div class="d-flex flex-row align-items-center mb-2 fs-3">
                                        <span class="fa-solid fa-calendar text-secondary"></span>
                                        <span class="ms-3 text-secondary">Bisa di re-schedule</span>
                                    </div>
                                @else
                                    <div class="d-flex flex-row align-items-center mb-2 fs-3">
                                        <span class="fa-solid fa-calendar text-secondary"></span>
                                        <span class="ms-3 text-secondary">Tidak dapat di re-schedule</span>
                                    </div>
                                @endif
                                <span class="text-2 text-secondary fw-bold fs-2">Detail</span>
                            </div>
                        </div>
                    </button>
                </div>

            </div>
        </div>
        <div class="card-footer d-flex flex-column">
            <div class="d-flex flex-row align-items-center">
                <div class="d-flex flex-column">

                    <span class="text-secondary fw-bold fs-1">IDR {{ number_format($today_price, 0, ',', '.') }}
                    </span>
                </div>
                <button type="submit" class="btn btn-secondary" style="margin-left: auto;"
                    id="button_paket_1">Pesan</button>
            </div>
        </div>
        <div class="w-100 bg-dark bg-opacity-25 text-light position-relative fs-5 fixed-bottom card-img-bottom-rounded p-2"
            role="alert">
            Tidak tersedia di tanggal yang dipilih
        </div>
    </div>
</div>
