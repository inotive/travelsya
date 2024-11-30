<div class="px-3 mb-35px fs-2" id="paket">
    <div class="section-title mb-4">
        <div class="w-100 title text-capitalize" style="font-size: calc(1rem + 0.85vw)">
            Paket
        </div>
    </div>
    <div class="card bg-danger bg-opacity-25 p-3">
        <form action="{{ route($route, ['clinic' => 1]) }}" method="post">
            @csrf
            <div class="accordion" id="list_paket">
                <div class="card accordion-item mb-3">
                    <div class="card-header p-0">
                        <div class="accordion-header w-100">
                            <h2 class="w-100" id="paket-1">
                                <button class="accordion-button collapsed bg-opacity-0 " type="button"
                                    data-bs-toggle="collapse" data-bs-target="#paket-collapse-1" aria-expanded="true"
                                    aria-controls="paket-collapse-1">
                                    <div class="d-flex flex-column">
                                        <h3>Accordion Item #2</h3>
                                        <div class="d-flex flex-row align-items-center">
                                            <small>
                                                <span class="fa-solid fa-money-bill me-1"></span>
                                                <span class="me-3">Tidak bisa refund</span>
                                                <span class="fa-solid fa-calendar me-1"></span>
                                                <span class="me-3">Pesan tiket untuk hari ini</span>
                                                <span class="fa-solid fa-clock me-1"></span>
                                                <span class="me-3">Berlaku 30 hari sejak dibeli</span>
                                                <span class="fa-solid fa-clock me-1"></span>
                                                <span class="me-3">Reservasi paling 1 hari sebelumnya</span>
                                            </small>
                                        </div>
                                    </div>
                                </button>
                            </h2>

                        </div>
                    </div>
                    <div class="card-body accordion-collapse collapse show" id="paket-collapse-1"
                        aria-labelledby="paket-1">
                        <div class="mb-2">
                            Masa Berlaku: {{ \App\Helpers\General::getDateShortMonth(now()) }} -
                            {{ \App\Helpers\General::getDateShortMonth(date('Y-m-d H:i:s', strtotime('+30 days',
                            strtotime(now())))) }}
                        </div>
                        <div class="mb-2 fw-bold">
                            Jumlah tiket
                        </div>
                        <div class="mb-3 card border p-0">
                            <div class="card-body d-flex flex-row align-items-center">
                                <span>Adult</span>
                                <span style="margin-left: auto;">
                                    <span class="text-danger fw-bold">IDR 230.000</span>/pax
                                    <span class="ms-3">
                                        <span class="fa-solid fa-minus-circle text-danger fs-2" id="decrease_paket"
                                            id_paket="1"></span>
                                        <input type="hidden" name="val_paket_1" id="val_paket_1" value="1">
                                        <span class="fs-2 mx-2" id="dummy_paket_1">1</span>
                                        <span class="fa-solid fa-plus-circle text-danger fs-2" id="increase_paket"
                                            id_paket="1"></span>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex flex-row align-items-center">
                            <span class="text-danger fw-bold">IDR 230.000</span>
                            <button type="submit" class="btn btn-danger" style="margin-left: auto;"
                                id="button_paket_1">Pesan</button>
                        </div>
                    </div>
                </div>
                <div class="card accordion-item mb-3">
                    <div class="card-header p-0">
                        <div class="accordion-header w-100">
                            <h2 class="w-100" id="paket-2">
                                <button class="accordion-button collapsed bg-opacity-0 " type="button"
                                    data-bs-toggle="collapse" data-bs-target="#paket-collapse-2" aria-expanded="true"
                                    aria-controls="paket-collapse-2">
                                    <div class="d-flex flex-column">
                                        <h3>Accordion Item #2</h3>
                                        <div class="d-flex flex-row align-items-center">
                                            <small>
                                                <span class="fa-solid fa-money-bill me-1"></span>
                                                <span class="me-3">Tidak bisa refund</span>
                                                <span class="fa-solid fa-calendar me-1"></span>
                                                <span class="me-3">Pesan tiket untuk hari ini</span>
                                                <span class="fa-solid fa-clock me-1"></span>
                                                <span class="me-3">Berlaku 30 hari sejak dibeli</span>
                                                <span class="fa-solid fa-clock me-1"></span>
                                                <span class="me-3">Reservasi paling 1 hari sebelumnya</span>
                                            </small>
                                        </div>
                                    </div>
                                </button>
                            </h2>

                        </div>
                    </div>
                    <div class="card-body accordion-collapse collapse" id="paket-collapse-2" aria-labelledby="paket-2">
                        <div class="mb-2">
                            Masa Berlaku: {{ \App\Helpers\General::getDateShortMonth(now()) }} -
                            {{ \App\Helpers\General::getDateShortMonth(date('Y-m-d H:i:s', strtotime('+30 days',
                            strtotime(now())))) }}
                        </div>
                        <div class="mb-2 fw-bold">
                            Jumlah tiket
                        </div>
                        <div class="mb-3 card border p-0">
                            <div class="card-body d-flex flex-row align-items-center">
                                <span>Adult</span>
                                <span style="margin-left: auto;">
                                    <span class="text-danger fw-bold">IDR 230.000</span>/pax
                                    <span class="ms-3">
                                        <span class="fa-solid fa-minus-circle text-danger fs-2" id="decrease_paket"
                                            id_paket="2"></span>
                                        <input type="hidden" name="val_paket_2" id="val_paket_2" value="0">
                                        <span class="fs-2 ms-2" id="dummy_paket_2">0</span>
                                        <span class="fa-solid fa-plus-circle text-danger fs-2 ms-3" id="increase_paket"
                                            id_paket="2"></span>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex flex-row align-items-center">
                            <span class="text-danger fw-bold">IDR 230.000</span>
                            <button type="submit" class="btn btn-danger" style="margin-left: auto;"
                                id="button_paket_2">Pilih
                                Paket</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>