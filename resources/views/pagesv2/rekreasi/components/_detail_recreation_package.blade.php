<div class="px-3 mb-35px fs-2" id="paket">
    <div class="section-title mb-4">
        <div class="w-100 title text-capitalize" style="font-size: calc(1rem + 0.85vw)">
            Paket
        </div>
        <div class="w- text-capitalize opacity-25" style="font-size: calc(1rem + 0.25vw)">
            Cek ketersediaan paket
        </div>
        <div class="w-100 title text-capitalize d-flex flex-row align-items-center">
            <button type="button" class="btn btn-outline-secondary border rounded-pill ms-2">Besok</button>
            <button type="button" class="btn btn-outline-secondary border rounded-pill ms-2">{{
                \App\Helpers\General::getDateShortDayMonth(date('Y-m-d h:i:s', strtotime('+2 days', strtotime(now()))))
                }}</button>
            <button type="button" class="btn btn-outline-secondary border rounded-pill ms-2">{{
                \App\Helpers\General::getDateShortDayMonth(date('Y-m-d h:i:s', strtotime('+3 days', strtotime(now()))))
                }}</button>
            <button type="button" class="btn btn-outline-secondary border rounded-pill ms-2">{{
                \App\Helpers\General::getDateShortDayMonth(date('Y-m-d h:i:s', strtotime('+4 days', strtotime(now()))))
                }}</button>
            <button type="button"
                class="btn btn-outline-danger border bg-danger bg-opacity-25 text-danger rounded-pill ms-2"><span
                    class="fa-solid fa-calendar"> 15 Dec</span></button>
            <a href="Reset" class="text-decoration-none text-danger fw-bold fs-3 ms-3">Reset</a>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            @foreach ($detail->recreationPackages as $package)
            {{-- {{ dd($package) }} --}}
            <div class="card bg-danger bg-opacity-25 p-3 mb-35px">
                <span class="title fw-bold mb-3">{{ $package->name }}</span>
                <form action="{{ route('rekreasi.order', ['id' => $package->id]) }}" method="post">
                    @csrf
                    <div class="accordion" id="list_paket">
                        <div class="card accordion-item mb-3">
                            <div class="card-header p-0 border-bottom-dashed">
                                <div class="accordion-header w-100">
                                    <div class="w-100" id="paket-1">
                                        <button class="accordion-button collapsed bg-opacity-0 align-items-start"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#paket-collapse-1"
                                            aria-expanded="true" aria-controls="paket-collapse-1">
                                            <div class="d-flex flex-column">
                                                <h2 class="mb-25px">{{ $package->description }}</h2>
                                                <div class="d-flex flex-column mb-25px">
                                                    @if ($package->is_refundable == 1)
                                                    <div class="d-flex flex-row align-items-center mb-2 fs-3">
                                                        <span class="fa-solid fa-money-bill text-success"></span>
                                                        <span class="ms-3">Bisa 100% refund dengan auransi
                                                            (Asuransi
                                                            tersedia dengan biaya tambahan)</span>
                                                    </div>
                                                    @else
                                                    <div class="d-flex flex-row align-items-center mb-2 fs-3">
                                                        <span class="fa-solid fa-money-bill text-secondary"></span>
                                                        <span class="ms-3">Tidak dapat di refund</span>
                                                    </div>
                                                    @endif

                                                    @if ($package->is_reschedule == 1)
                                                    <div class="d-flex flex-row align-items-center mb-2 fs-3">
                                                        <span class="fa-solid fa-calendar text-primary"></span>
                                                        <span class="ms-3">Bisa di re-schedule</span>
                                                    </div>
                                                    @else
                                                    <div class="d-flex flex-row align-items-center mb-2 fs-3">
                                                        <span class="fa-solid fa-calendar text-secondary"></span>
                                                        <span class="ms-3">Tidak dapat di re-schedule</span>
                                                    </div>
                                                    @endif

                                                    <div class="d-flex flex-row align-items-center mb-2 fs-3">
                                                        <span class="fa-solid fa-clock text-dark"></span>
                                                        <span class="ms-3">
                                                            Berlaku
                                                            {{ $package->expiry_date . ' ' . $package->expiry_type }}
                                                            sejak tanggal
                                                            terpilih
                                                        </span>
                                                    </div>
                                                    <span class="text-2 text-danger fw-bold fs-2">Detail</span>
                                                </div>
                                            </div>
                                        </button>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body accordion-collapse collapse show" id="paket-collapse-1"
                                aria-labelledby="paket-1">
                                <div
                                    class="d-flex flex-row p-1 rounded-1 align-items-center mb-3 justify-content-between gap-1">
                                    @php
                                    $days = \App\Helpers\General::getNextWeekdays(now());
                                    @endphp
                                    @foreach ($days as $key => $day)
                                    <card class="border rounded-2 d-flex flex-column align-items-center p-3">
                                        <span class="fs-3 mb-3 d-flex flex-column align-items-center">{{ $key == 0 ?
                                            'Besok' : date('D', strtotime($day)) }}</span>
                                        <span class="fs-3 d-flex flex-column align-items-center">{{ date('d M',
                                            strtotime($day)) }}</span>
                                    </card>
                                    @endforeach
                                </div>
                                <div class="mb-35px">
                                    Masa Berlaku: <span class="fs-3 fw-bold">{{
                                        \App\Helpers\General::getDateShortMonth(now()) }} -
                                        {{ \App\Helpers\General::getDateShortMonth(
                                        date(
                                        'Y-m-d H:i:s',
                                        strtotime(
                                        '+30
                                        days',
                                        strtotime(now()),
                                        ),
                                        ),
                                        ) }}</span>
                                </div>
                                <div class="mb-2 fw-bold">
                                    Jumlah tiket
                                </div>
                                <div class="mb-25px card border p-0">
                                    <div class="card-body d-flex flex-row align-items-center">
                                        <div class="d-flex flex-column">
                                            <span class="fs-1 fw-bold"></span>
                                        </div>
                                        <span style="margin-left: auto;">
                                            <span class="text-danger fw-bold">IDR
                                                {{ number_format($package->price, 0, ',', '.') }}</span> / Pax
                                            <span class="ms-3">
                                                <span class="fa-solid fa-minus-circle text-danger fs-2"
                                                    id="decrease_paket" id_paket="1"></span>
                                                <input type="hidden" name="val_paket_1" id="val_paket_1" value="1">
                                                <span class="fs-2 mx-2" id="dummy_paket_1">1</span>
                                                <span class="fa-solid fa-plus-circle text-danger fs-2"
                                                    id="increase_paket" id_paket="1"></span>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="d-flex flex-column">

                                        <span>Total (2pax)</span>
                                        <span class="text-danger fw-bold fs-1">IDR 460.000</span>
                                    </div>
                                    <button type="submit" class="btn btn-danger" style="margin-left: auto;"
                                        id="button_paket_1">Pesan</button>
                                </div>
                            </div>
                        </div>

                        <div class="card accordion-item mb-3">
                            <div class="card-header p-0 border-bottom-dashed">
                                <div class="accordion-header w-100">
                                    <div class="w-100" id="paket-2">
                                        <button class="accordion-button collapsed bg-opacity-0 " type="button"
                                            data-bs-toggle="collapse" data-bs-target="#paket-collapse-2"
                                            aria-expanded="true" aria-controls="paket-collapse-2">
                                            <div class="d-flex flex-column">
                                                <h2 class="mb-25px text-secondary">Tiket Reguler Weekday</h2>
                                                <div class="d-flex flex-column mb-25px">
                                                    <div class="d-flex flex-row align-items-center mb-25px fs-3">
                                                        <span class="fa-solid fa-money-bill text-secondary"></span>
                                                        <span class="ms-3 text-secondary">Bisa 100% refund dengan
                                                            auransi (Asuransi
                                                            tersedia dengan biaya tambahan)</span>
                                                    </div>
                                                    <div class="d-flex flex-row align-items-center mb-25px fs-3">
                                                        <span class="fa-solid fa-clock text-secondary"></span>
                                                        <span class="ms-3 text-secondary">
                                                            Berlaku 7 hari sejak tanggal terpilih
                                                        </span>
                                                    </div>
                                                    <span class="text-2 text-danger fw-bold fs-2">Detail</span>
                                                </div>
                                            </div>
                                        </button>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body accordion-collapse collapse" id="paket-collapse-2"
                                aria-labelledby="paket-2">
                                <div
                                    class="d-flex flex-row p-1 rounded-1 align-items-center mb-3 justify-content-between">
                                    @php
                                    $days = \App\Helpers\General::getNextWeekdays(now());
                                    @endphp
                                    @foreach ($days as $key => $day)
                                    <card class="border rounded-2 d-flex flex-column align-items-center p-3">
                                        <span class="fs-3 mb-3">{{ $key == 0 ? 'Besok' : date('D', strtotime($day))
                                            }}</span>
                                        <span class="fs-3">{{ date('d M', strtotime($day)) }}</span>
                                    </card>
                                    @endforeach
                                </div>
                                <div class="mb-35px">
                                    Masa Berlaku: <span class="fs-3 fw-bold">{{
                                        \App\Helpers\General::getDateShortMonth(now()) }}
                                        -
                                        {{ \App\Helpers\General::getDateShortMonth(
                                        date(
                                        'Y-m-d H:i:s',
                                        strtotime(
                                        '+30
                                        days',
                                        strtotime(now()),
                                        ),
                                        ),
                                        ) }}</span>
                                </div>
                                <div class="mb-2 fw-bold">
                                    Jumlah tiket
                                </div>
                                <div class="mb-25px card border p-0">
                                    <div class="card-body d-flex flex-row align-items-center">
                                        <div class="d-flex flex-column">
                                            <span class="fs-1 fw-bold">Adult</span>
                                            <span>Tinggi badan diatas 120cm</span>
                                        </div>
                                        <span style="margin-left: auto;">
                                            <span class="text-danger fw-bold">IDR 230.000</span>/pax
                                            <span class="ms-3">
                                                <span class="fa-solid fa-minus-circle text-danger fs-2"
                                                    id="decrease_paket" id_paket="1"></span>
                                                <input type="hidden" name="val_paket_1" id="val_paket_1" value="1">
                                                <span class="fs-2 mx-2" id="dummy_paket_1">1</span>
                                                <span class="fa-solid fa-plus-circle text-danger fs-2"
                                                    id="increase_paket" id_paket="1"></span>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="mb-25px card border p-0">
                                    <div class="card-body d-flex flex-row align-items-center">
                                        <div class="d-flex flex-column">
                                            <span class="fs-1 fw-bold">Child</span>
                                            <span>Gratis untuk anak dibawah 2 tahun/span>
                                        </div>
                                        <span style="margin-left: auto;">
                                            <span class="text-danger fw-bold">IDR 230.000</span>/pax
                                            <span class="ms-3">
                                                <span class="fa-solid fa-minus-circle text-danger fs-2"
                                                    id="decrease_paket" id_paket="1"></span>
                                                <input type="hidden" name="val_paket_1" id="val_paket_1" value="1">
                                                <span class="fs-2 mx-2" id="dummy_paket_1">1</span>
                                                <span class="fa-solid fa-plus-circle text-danger fs-2"
                                                    id="increase_paket" id_paket="1"></span>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex flex-column">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="d-flex flex-column">

                                        <span class="text-secondary fw-bold fs-1">IDR 460.000</span>
                                    </div>
                                    <button type="submit" class="btn btn-danger" style="margin-left: auto;"
                                        id="button_paket_1">Pesan</button>
                                </div>
                            </div>
                            <div class="w-100 bg-dark bg-opacity-25 text-light position-relative fs-5 fixed-bottom card-img-bottom-rounded p-2"
                                role="alert">
                                Tidak tersedia di tanggal yang dipilih
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @endforeach
        </div>
        <div class="col-4">
            <div class="card bg-danger bg-opacity-25 p-3">
                <div class="card d-flex flex-column p-3">
                    <div class="d-flex flex-row align-items-center">
                        <span class="fa-solid fa-cirlce-dot"></span>
                        <span class="text-danger fw-bold ms-3">
                            Tiket Reguler
                        </span>
                        <span class="ms-sm-auto">1 tersedia</span>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <span></span>
                        <span class="ms-3">
                            Tiket Premium
                        </span>
                        <span class="ms-sm-auto">1 tersedia</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>