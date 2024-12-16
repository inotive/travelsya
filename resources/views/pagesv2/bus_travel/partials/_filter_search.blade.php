<div class="container mb-50">
    <div class="row justify-content-between">
        <div class="col-md-8">
            <div class="card d-flex flex-row">
                <div class="d-flex align-items-center">
                    <span class="fs-5">Berdasarkan Agen</span>
                </div>
                <div class="ms-4">
                    <form action="{{ route('bus_travel.search') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kota_awal" value="{{ $kota_awal }}">
                        <input type="hidden" name="kota_tujuan" value="{{ $kota_tujuan }}">
                        <input type="hidden" name="date_pergi" value="{{ $date_pergi }}">
                        <input type="hidden" name="jumlah_penumpang" value="{{ $jumlah_penumpang }}">
                        <input type="hidden" name="is_pulang_pergi" value="{{ $is_pulang_pergi }}">
                        <button type="submit"
                            class="badge badge-pills badge-outline {{ $selected_agent ==  null ? 'badge-danger' : 'badge-secondary' }} round fs-6 p-3">Semua
                            Agent</button>
                    </form>
                </div>
                @foreach ($agent->slice(0,3) as $a)
                <div class="ms-4">
                    <form action="{{ route('bus_travel.search') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kota_awal" value="{{ $kota_awal }}">
                        <input type="hidden" name="kota_tujuan" value="{{ $kota_tujuan }}">
                        <input type="hidden" name="date_pergi" value="{{ $date_pergi }}">
                        <input type="hidden" name="jumlah_penumpang" value="{{ $jumlah_penumpang }}">
                        <input type="hidden" name="is_pulang_pergi" value="{{ $is_pulang_pergi }}">
                        <input type="hidden" name="agent" value="{{ $a['business_name'] }}">
                        <button type="submit"
                            class="badge badge-pills badge-outline {{ $selected_agent ==  $a['business_name'] ? 'badge-danger' : 'badge-secondary' }} fs-6 round p-3">{{
                            $a['business_name'] }}</button>
                    </form>
                </div>
                @endforeach
                <div class="ms-4">
                    <a href="javascript:"
                        class="badge badge-pills badge-outline badge-secondary bg-secondary round fs-6 p-3">+ 8
                        Lainnya</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card d-flex flex-row justify-content-end">
                <div class="ms-4">
                    <a href="javascript:" class="badge badge-pills badge-outline badge-secondary round fs-6 p-3">
                        <i class="fa-solid fa-filter me-2"></i>
                        Filter
                    </a>
                </div>
                <div class="ms-4">
                    <a href="javascript:" class="badge badge-pills badge-outline badge-secondary round fs-6 p-3">
                        <i class="fa-solid fa-money-bill me-2"></i>
                        Harga
                    </a>
                </div>
                <div class="ms-4">
                    <a href="javascript:" class="badge badge-pills badge-outline badge-secondary round fs-6 p-3">
                        <i class="fa-solid fa-arrow-up-wide-short me-2"></i>
                        Urutkan
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-between" style="margin-top: 30px;">
        <div class="col-md-4 d-flex align-items-center">
            <span class="fs-5">Pilih mau naik dan turun dimana?</span>
        </div>
        <div class="col-md-8">
            <div class="card d-flex flex-row">
                <div class="input-group max-w-200">
                    <span class="input-group-text border-none bg-light-danger">
                        <i class="fa-solid fa-bus text-danger"></i>
                    </span>
                    <select class="form-select border-none text-danger bg-light-danger" name="naik">
                        <option value="">Naik dari mana?</option>
                        @foreach ($city as $c)
                            <option value="{{ $c }}">{{ $c }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group max-w-200">
                    <span class="input-group-text border-none bg-light-danger">
                        <i class="fa-solid fa-location-dot text-danger"></i>
                    </span>
                    <select class="form-select border-none text-danger bg-light-danger" name="turun">
                        <option value="">Turun dimana?</option>
                        @foreach ($city as $c)
                            <option value="{{ $c }}">{{ $c }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
