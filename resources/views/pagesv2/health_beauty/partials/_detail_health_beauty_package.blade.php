<div class="px-3 mb-35px fs-2" id="paket">
    <div class="section-title mb-4">
        <div class="w-100 title text-capitalize" style="font-size: calc(1rem + 0.85vw)">
            Paket
        </div>
    </div>
    <div class="card bg-danger bg-opacity-25 p-3">
        @foreach ($clinic['packages'] as $p)
        <form action="{{ route('health_beauty.order') }}"
            method="post">
            <input type="hidden" name="service" value="health-beauty">
            <input type="hidden" name="payment" value="xendit">
            @csrf
            <div class="accordion" id="list_paket">
                <div class="card accordion-item mb-3">
                    <div class="card-header p-0">
                        <div class="accordion-header w-100">
                            <h2 class="w-100" id="paket-{{ $p['id'] }}">
                                <button class="accordion-button collapsed bg-opacity-0 align-items->start" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#paket-collapse-{{ $p['id'] }}"
                                    aria-expanded="false" aria-controls="paket-collapse-{{ $p['id'] }}">
                                    <div class="d-flex flex-column">
                                        <h3>{{ $p['name'] }}</h3>
                                        @if (count($p['facilities']) > 0)
                                        <div class="d-flex flex-row align-items-center text-dark">
                                            <small>
                                                @foreach ($p['facilities'] as $f)
                                                <span class="fa-solid fa-money-bill me-1"></span>
                                                <span class="me-3">{{ $f['facility']['name'] ?? 'Invalid facility'
                                                    }}</span>
                                                @endforeach
                                            </small>
                                        </div>
                                        @else
                                        <div class="d-flex flex-row align-items-center text-dark">
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
                                        @endif
                                    </div>
                                </button>
                            </h2>

                        </div>
                    </div>
                    <div class="card-body accordion-collapse collapse" id="paket-collapse-{{ $p['id'] }}"
                        aria-labelledby="paket-{{ $p['id'] }}">
                        <div class="mb-2">
                            Masa Berlaku: {{ \App\Helpers\General::getDateShortMonth(now()) }} -
                            {{
                            \App\Helpers\General::getDateShortMonth(\Carbon\Carbon::now()->addDays($p['expiry_date']))
                            }}
                        </div>
                        <div class="mb-2 fw-bold">
                            Jumlah tiket
                        </div>
                        <div class="mb-3 card border p-0">
                            <div class="card-body d-flex flex-row align-items-center">
                                <span>QTY</span>
                                <span style="margin-left: auto;">
                                    <span class="text-danger fw-bold">IDR {{ number_format($p['price']) }}</span>/pax
                                    <span class="ms-3">
                                        <span class="fa-solid fa-minus-circle text-danger fs-2" id="decrease_paket"
                                            id_paket="1"></span>
                                        <input type="hidden" name="total_ticket" id="val_paket_1" value="1">
                                        <span class="fs-2 mx-2" id="dummy_paket_1">1</span>
                                        <span class="fa-solid fa-plus-circle text-danger fs-2" id="increase_paket"
                                            id_paket="1"></span>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="package_id" value="{{ $p['id'] }}">
                    <div class="card-footer">
                        <div class="d-flex flex-row align-items-center">
                            <span class="text-danger fw-bold">IDR {{ number_format($p['price']) }}</span>
                            <button type="submit" class="btn btn-danger" style="margin-left: auto;"
                                id="button_paket_{{ $p['id'] }}">Pesan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @endforeach
    </div>
</div>
