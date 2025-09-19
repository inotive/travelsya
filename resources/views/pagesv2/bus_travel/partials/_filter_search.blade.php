<div class="container mb-50">
    <div class="row justify-content-between">
        <div class="col-md-8">
            <div class="card d-flex flex-row align-items-center">
                <div>
                    <span class="fs-5">Berdasarkan Agen</span>
                </div>
                <div class="d-flex flex-nowrap ms-4" style="overflow-x: auto;">
                    <div class="me-2">
                        <form action="{{ route('bus_travel.search') }}" method="POST">
                            @csrf
                            <input type="hidden" name="kota_awal" value="{{ $kota_awal }}">
                            <input type="hidden" name="kota_tujuan" value="{{ $kota_tujuan }}">
                            <input type="hidden" name="date_pergi" value="{{ $date_pergi }}">
                            <input type="hidden" name="jumlah_penumpang" value="{{ $jumlah_penumpang }}">
                            <input type="hidden" name="is_pulang_pergi" value="{{ $is_pulang_pergi }}">
                            <button type="submit"
                                class="badge badge-pills badge-outline {{ $selected_agent == null ? 'badge-danger' : 'badge-secondary' }} round fs-6 p-3 text-nowrap">Semua
                                Agent</button>
                        </form>
                    </div>
                    @if ($agent->isNotEmpty())
                        @foreach ($agent as $a)
                            <div class="me-2">
                                <form action="{{ route('bus_travel.search') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="kota_awal" value="{{ $kota_awal }}">
                                    <input type="hidden" name="kota_tujuan" value="{{ $kota_tujuan }}">
                                    <input type="hidden" name="date_pergi" value="{{ $date_pergi }}">
                                    <input type="hidden" name="jumlah_penumpang" value="{{ $jumlah_penumpang }}">
                                    <input type="hidden" name="is_pulang_pergi" value="{{ $is_pulang_pergi }}">
                                    <input type="hidden" name="agent" value="{{ $a->business_name }}">
                                    <button type="submit"
                                        class="badge badge-pills badge-outline {{ $selected_agent == $a->business_name ? 'badge-danger' : 'badge-secondary' }} fs-6 round p-3 text-nowrap">
                                        {{ $a->business_name }}
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    @else
                        <div class="ms-4 text-muted">Tidak ada agen untuk rute ini</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card d-flex flex-row justify-content-end">
                {{-- <div class="ms-4">
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
                </div> --}}
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
function initBusFilter() {
    console.log('Filter script loaded');

    const naik = document.getElementById('naikSelect');
    const turun = document.getElementById('turunSelect');

    // Get references to the main form and its elements
    const mainForm = document.getElementById('mainSearchForm');
    const mainFormKotaAwal = document.getElementById('kota_awal');
    const mainFormKotaTujuan = document.getElementById('kota_tujuan');
    const mainFormDatePergi = document.querySelector('input[name="date_pergi"]');
    const mainFormJumlahPenumpang = document.querySelector('input[name="jumlah_penumpang"]');

    console.log('Elements found:', {
        naik: !!naik,
        turun: !!turun,
        mainForm: !!mainForm,
        mainFormKotaAwal: !!mainFormKotaAwal,
        mainFormKotaTujuan: !!mainFormKotaTujuan
    });

    if (!naik || !turun) {
        console.log('Filter select elements not found');
        return;
    }

    // Function to submit using fetch
    function submitWithFetch() {
        console.log('Submitting with fetch');

        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            console.log('CSRF token not found');
            return;
        }

        // Prepare form data
        const formData = new FormData();
        formData.append('_token', csrfToken.getAttribute('content'));
        formData.append('kota_awal', naik.value);
        formData.append('kota_tujuan', turun.value);

        // Copy other required fields from main form if they exist
        if (mainFormDatePergi) {
            formData.append('date_pergi', mainFormDatePergi.value);
        }

        if (mainFormJumlahPenumpang) {
            formData.append('jumlah_penumpang', mainFormJumlahPenumpang.value);
        }

        // Add other required fields with default values if needed
        formData.append('is_pulang_pergi', '0'); // Default value

        // Submit using fetch
        fetch("{{ route('bus_travel.search') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            console.log('Fetch response:', response);
            if (response.redirected) {
                window.location.href = response.url;
            } else {
                return response.text();
            }
        })
        .then(data => {
            if (data) {
                // If we got HTML content, we need to replace the current page
                document.open();
                document.write(data);
                document.close();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Add event listeners
    naik.addEventListener('change', function() {
        console.log('Naik select changed to:', naik.value);
        submitWithFetch();
    });

    turun.addEventListener('change', function() {
        console.log('Turun select changed to:', turun.value);
        submitWithFetch();
    });

    // Set initial values if main form elements exist
    if (mainFormKotaAwal && mainFormKotaTujuan) {
        naik.value = mainFormKotaAwal.value;
        turun.value = mainFormKotaTujuan.value;

        console.log('Initial values set:', {
            naik: naik.value,
            turun: turun.value
        });
    }

    console.log('Event listeners attached');
}

// Try to run immediately, and also on DOMContentLoaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initBusFilter);
} else {
    initBusFilter();
}
</script>