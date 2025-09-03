<div class="container">
    @foreach ($pergi as $p)
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            {{-- <form action="" method="POST">
                @csrf --}}
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="d-flex">
                            <div class="title-card">
                                <div class="title-how text-capitalize fs-4 fw-bold mb-2">
                                    {{ $p['business_name'] ?? 'Invalid business' }}
                                </div>
                                <div class="subtitle-how text-secondary-strong">
                                    {{ $p['name'] }}
                                </div>
                            </div>
                            <div class="label ms-4">
                                <span class="badge round p-3 badge-light-danger fs-5">
                                    <i class="fa-solid fa-thumbs-up me-2 text-danger"></i>
                                    Paling banyak diminati
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 text-end">
                        <div>
                            <i class="fa-solid fa-star me-2 text-warning"></i>
                            <strong>{{ $p['avgRating'] }}/</strong>
                            <small>5</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="d-flex mt-3">
                            <div class="d-flex flex-column">
                                <strong>{{ $p['departure_time'] }}</strong>
                                <div class="text-secondary-strong my-3">
                                    {{ $p['duration'] }} Jam
                                </div>
                                <strong>{{ $p['arrival_time'] }}</strong>
                            </div>
                            <div class="d-flex ms-3 flex-column justify-content-between">
                                <i class="fa-solid fa-circle-dot text-danger mt-1"></i>
                                <div class="lined"></div>
                                <i class="fa-solid fa-circle mb-1"></i>
                            </div>
                            <div class="d-flex ms-3 flex-column justify-content-between">
                                <strong>{{ $p['departure_point'] }}</strong>
                                <strong>{{ $p['arrival_point'] }}</strong>
                            </div>
                        </div>
                        <div class="d-flex text-secondary-strong mt-3">
                            <span>
                                <img src="{{ asset('images/icon/ac.png') }}" height="15px" alt="">
                                <span>Full AC</span>
                            </span>
                            <span class="ms-3">
                                <img src="{{ asset('images/icon/chair.png') }}" height="15px" alt="">
                                <span>Kursi Recliner</span>
                            </span>
                            <span class="ms-3">
                                <img src="{{ asset('images/icon/usb.png') }}" height="15px" alt="">
                                <span>Colokan USB</span>
                            </span>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 d-flex flex-column justify-content-end align-items-end">
                        <div class="text-secondary-strong mt-auto">
                            Mulai dari
                        </div>
                        <div class="price text-start">
                            <strong class="text-danger text-bold fs-3">IDR {{ number_format($p['price']) }}</strong>
                            {{-- <span class="text-secondary-strong">/ hari</span> --}}
                        </div>
                        {{-- <form action="{{ route('bus_travel.detail') }}" method="post">
                            @csrf
                            <input type="hidden" name="departure_id" value="{{ $p['id'] }}">
                            <input type="hidden" name="kota_awal" value="{{ $p['id'] }}">
                            <input type="hidden" name="kota_tujuan" value="{{ $p['id'] }}">
                            <input type="hidden" name="is_pulang_pergi" value="{{ $p['id'] }}">
                            <input type="hidden" name="jumlah_penumpang" value="{{ $p['id'] }}">
                            <input type="hidden" name="date_pergi" value="{{ $date_pergi }}">
                            <input type="hidden" name="date_pulang" value="{{ $date_pulang }}"> --}}
                            <a
                                href="{{ route('bus_travel.detail', ['departure_id' => $p['id'], 'kota_awal' => $p['departure_point'], 'kota_tujuan' => $p['arrival_point'], 'is_pulang_pergi' => $is_pulang_pergi, 'jumlah_penumpang' => $jumlah_penumpang, 'date_pergi' => $date_pergi ?? date('d-m-Y', strtotime(now())), 'date_pulang' => $date_pulang]) }}">
                                <button class="btn btn-danger mt-2 bg-main" style="margin-left: auto;">Pilih
                                    Mobil</button>
                            </a>
                            {{--
                        </form> --}}
                    </div>
                </div>
                {{--
            </form> --}}
        </div>
    </div>
    @endforeach

</div>