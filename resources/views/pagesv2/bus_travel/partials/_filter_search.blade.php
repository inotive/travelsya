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
                @if($agent->isNotEmpty())
                    @foreach ($agent->take(3) as $a)
                        <div class="ms-4">
                            <form action="{{ route('bus_travel.search') }}" method="POST">
                                @csrf
                                <input type="hidden" name="kota_awal" value="{{ $kota_awal }}">
                                <input type="hidden" name="kota_tujuan" value="{{ $kota_tujuan }}">
                                <input type="hidden" name="date_pergi" value="{{ $date_pergi }}">
                                <input type="hidden" name="jumlah_penumpang" value="{{ $jumlah_penumpang }}">
                                <input type="hidden" name="is_pulang_pergi" value="{{ $is_pulang_pergi }}">
                                <input type="hidden" name="agent" value="{{ $a->business_name }}">
                                <button type="submit"
                                    class="badge badge-pills badge-outline {{ $selected_agent == $a->business_name ? 'badge-danger' : 'badge-secondary' }} fs-6 round p-3">
                                    {{ $a->business_name }}
                                </button>
                            </form>
                        </div>
                    @endforeach
                @else
                    <div class="ms-4 text-muted">Tidak ada agen untuk rute ini</div>
                @endif

                {{-- <div class="ms-4">
                    <a href="javascript:"
                        class="badge badge-pills badge-outline badge-secondary bg-secondary round fs-6 p-3">+ 8
                        Lainnya</a>
                </div> --}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="card d-flex flex-row justify-content-end">
                {{-- <div class="ms-4">
                    <a href="javascript:" class="badge badge-pills badge-outline badge-secondary round fs-6 p-3">
                        <i class="fa-solid fa-filter me-2"></i>
                        Filter
                    </a>
                </div> --}}
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
                    <select id="naikSelect" class="form-select border-none text-danger bg-light-danger" name="naik">
                        <option value="">Naik dari mana?</option>
                        @foreach ($city as $c)
                            <option value="{{ $c }}"
                                {{ (request('kota_awal') ?? request('naik') ?? $kota_awal) == $c ? 'selected' : '' }}>
                                {{ $c }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group max-w-200 ms-2">
                    <span class="input-group-text border-none bg-light-danger">
                        <i class="fa-solid fa-location-dot text-danger"></i>
                    </span>
                    <select id="turunSelect" class="form-select border-none text-danger bg-light-danger" name="turun">
                        <option value="">Turun dimana?</option>
                        @foreach ($city as $c)
                            <option value="{{ $c }}"
                                {{ (request('kota_tujuan') ?? request('turun') ?? $kota_tujuan) == $c ? 'selected' : '' }}>
                                {{ $c }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const mainForm = document.getElementById('mainSearchForm');
    const naik = document.getElementById('naikSelect');
    const turun = document.getElementById('turunSelect');

    if (!naik || !turun) return;

    function submitWithSync() {
        if (mainForm) {
            // find the existing inputs inside main form and set their values
            const inputKotaAwal = mainForm.querySelector('[name="kota_awal"]');
            const inputKotaTujuan = mainForm.querySelector('[name="kota_tujuan"]');

            if (inputKotaAwal) inputKotaAwal.value = naik.value;
            else {
                // if not present, create a hidden input
                const h = document.createElement('input');
                h.type = 'hidden';
                h.name = 'kota_awal';
                h.value = naik.value;
                mainForm.appendChild(h);
            }

            if (inputKotaTujuan) inputKotaTujuan.value = turun.value;
            else {
                const h2 = document.createElement('input');
                h2.type = 'hidden';
                h2.name = 'kota_tujuan';
                h2.value = turun.value;
                mainForm.appendChild(h2);
            }

            mainForm.submit();
            return;
        }

        // fallback: redirect with query (only used if mainForm is missing)
        const params = new URLSearchParams();
        if (naik.value) params.set('kota_awal', naik.value);
        if (turun.value) params.set('kota_tujuan', turun.value);
        const url = @json(route('bus_travel.search')) + '?' + params.toString();
        window.location.href = url;
    }

    naik.addEventListener('change', submitWithSync);
    turun.addEventListener('change', submitWithSync);
});
</script>


