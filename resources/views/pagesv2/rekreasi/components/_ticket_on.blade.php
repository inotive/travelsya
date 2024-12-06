<form action="{{ route('rekreasi.order', ['id' => $package->id]) }}" method="post">
    <input type="hidden" name="price" id="package_price_{{ $package->id }}" value="{{ $package->price }}">
    @csrf
    <div class="accordion">
        <div class="card accordion-item mb-3">
            <div class="card-header p-0 border-bottom-dashed">
                <div class="accordion-header w-100">
                    <div class="w-100" id="paket-1">
                        <button class="accordion-button collapsed bg-opacity-0 align-items-start" type="button"
                            data-bs-toggle="collapse" data-bs-target="#paket-collapse-1" aria-expanded="true"
                            aria-controls="paket-collapse-1">
                            <div class="d-flex flex-column">
                                <h2 class="mb-25px">{{ $package->description }} ({{ $weektype }})</h2>
                                <div class="d-flex flex-column mb-25px">
                                    @if ($package->is_refundable == 1)
                                    <div class="d-flex flex-row align-items-center mb-2 fs-3">
                                        <span class="fa-solid fa-money-bill text-success"></span>
                                        <span class="ms-3 text-dark">Bisa 100% refund dengan auransi
                                            (Asuransi
                                            tersedia dengan biaya tambahan)</span>
                                    </div>
                                    @else
                                    <div class="d-flex flex-row align-items-center mb-2 fs-3">
                                        <span class="fa-solid fa-money-bill text-secondary"></span>
                                        <span class="ms-3 text-dark">Tidak dapat di refund</span>
                                    </div>
                                    @endif

                                    @if ($package->is_reschedule == 1)
                                    <div class="d-flex flex-row align-items-center mb-2 fs-3">
                                        <span class="fa-solid fa-calendar text-primary"></span>
                                        <span class="ms-3 text-dark">Bisa di re-schedule</span>
                                    </div>
                                    @else
                                    <div class="d-flex flex-row align-items-center mb-2 fs-3">
                                        <span class="fa-solid fa-calendar text-secondary"></span>
                                        <span class="ms-3 text-dark">Tidak dapat di re-schedule</span>
                                    </div>
                                    @endif

                                    <div class="d-flex flex-row align-items-center mb-2 fs-3">
                                        <span class="fa-solid fa-clock text-dark"></span>
                                        <span class="ms-3 text-dark">
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
            <div class="card-body accordion-collapse collapse show" id="paket-collapse-1" aria-labelledby="paket-1">
                <div class="d-flex flex-row p-1 rounded-1 align-items-center mb-3 justify-content-between gap-1">
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
                        \App\Helpers\General::getDateShortMonth($date) }} -
                        {{ \App\Helpers\General::getDateShortMonth(date('Y-m-d H:i:s', strtotime('+30
                        days', strtotime($date)))) }}</span>
                </div>
                <div class="mb-2 fw-bold">
                    Jumlah tiket
                </div>
                <div class="mb-25px card border p-0">
                    <div class="card-body d-flex flex-row align-items-center">
                        <div class="d-flex flex-column">
                            <span class="fs-1 fw-bold"></span>
                        </div>
                        <div class="d-flex flex-row align-items-center ms-sm-auto">
                            <span class="text-danger fw-bold">IDR
                                {{ number_format($package->price, 0, ',', '.') }}</span> / Pax
                            <div class="ms-3 input-group w-auto">
                                <button type="button" class="btn btn-light border-0 text-danger rounded-circle p-1"
                                    onclick="decreaseTicket({{ $package->id }})">
                                    <span class="fa-solid fa-minus-circle fs-2"></span>
                                </button>
                                <input type="text" class="bg-none ms-3 border-0 outline-none text-center" name="qty"
                                    id="qty_{{ $package->id }}" min="1" style="width: 32px;" value="1" readonly>
                                <button type="button" class="btn btn-light border-0 text-danger rounded-circle p-1 ms-3"
                                    onclick="increaseTicket({{ $package->id }})">
                                    <span class="fa-solid fa-plus-circle fs-2"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex flex-row align-items-center">
                    <div class="d-flex flex-column">

                        <span>Total (<span id="qty_total_{{ $package->id }}">1</span> pax)</span>
                        <span class="text-danger fw-bold fs-1">
                            IDR <span id="total_price_{{ $package->id }}">
                                {{ number_format($package->price, 0, ',', '.') }}
                            </span>
                        </span>
                    </div>
                    <input type="hidden" name="package_id" value="{{ $package->id }}">
                    <input type="hidden" name="service" value="recreation">
                    <input type="hidden" name="payment" value="xendit">
                    <input type="hidden" name="point" value="0">
                    <input type="hidden" name="book_date" value="{{ $date }}">
                    <button type="submit" class="btn btn-danger" style="margin-left: auto;"
                        id="button_paket_1">Pesan</button>
                </div>
            </div>
        </div>
    </div>
</form>
