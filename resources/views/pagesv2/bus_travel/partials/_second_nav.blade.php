<div class="second-nav border-top border-bottom border-3">
    <div class="container d-flex flex-row align-items-center">
        <div class="d-flex w-100">
            <div class="d-flex align-items-center">
                <a href="javascript:" onclick="history.back()" class="back-btn text-danger fs-16 text-decoration-none">
                    <h4 class="text-danger">
                        <i class="fa-solid fa-arrow-left me-2 text-danger"></i>
                        <span class="fw-bold my-auto">
                            Kembali
                        </span>
                    </h4>
                </a>
            </div>
            <div class="ms-sm-auto position-relative">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-left-round border-right-none" id="basic-addon1">
                        <i class="fa-solid fa-search"></i>
                    </span>
                    <input type="text" onkeyup="findData()" id="find" class="form-control search-input"
                        placeholder="Pencarian . . ." />
                </div>
                <div class="card d-none mt-2 rounded shadow-sm position-absolute w-100" id="card_result" style="z-index: 9999">
                    <div class="card-body" id="search-wrapper" style="max-height: 50vh; overflow-y : scroll">
                        <div class="mx-auto fw-bold text-center" style="color : var(--bs-gray-500)">
                            <small class="text-muted">• Pencarian......</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Enhanced search functionality
    const searchInput = document.querySelector('input[id="find"]');
    let searchTimeout;

    searchInput.addEventListener("focus", (event) => {
        $('#card_result').removeClass('d-none');
        showSearchExamples();
    });

    searchInput.addEventListener("blur", (event) => {
        $("#card_result").delay(500).queue(function() {
            $('#card_result').addClass('d-none');
            showSearchExamples();
        });
    });

    function showSearchExamples() {
        $('#search-wrapper').empty();
        $('#search-wrapper').append(`
            <div class="mx-auto fw-bold text-center" style="color : var(--bs-gray-500)">
                <small class="text-muted">cari bus, rute awal, harga tiket, jam dan fasilitas</small>
            </div>
        `);
    }

    function detectSearchType(input) {
        const cleanInput = input.trim().toLowerCase();

        // Time patterns
        const timePatterns = [
            /^(jam\s*)?([0-2]?[0-9])$/i,          // "jam 3", "3", "03"
            /^([0-2]?[0-9]):([0-5][0-9])$/,       // "3:00", "15:30"
            /^([0-2]?[0-9])\.([0-5][0-9])$/,      // "3.00", "15.30"
        ];

        // Price patterns
        const pricePattern = /^[0-9]+[kK]?$/;

        // Facility keywords
        const facilityKeywords = [
            'ac', 'air conditioner', 'full ac', 'ac full',
            'recliner', 'kursi recliner', 'seat recliner',
            'colokan', 'charger', 'usb', 'power',
            'wifi', 'wi-fi', 'internet',
            'toilet', 'wc', 'kamar mandi',
            'tv', 'entertainment', 'hiburan',
            'bantal', 'pillow', 'selimut', 'snack'
        ];

        // Check search type
        for (let pattern of timePatterns) {
            if (pattern.test(cleanInput)) {
                return 'time';
            }
        }

        if (pricePattern.test(cleanInput.replace(/[.,]/g, ''))) {
            return 'price';
        }

        for (let keyword of facilityKeywords) {
            if (cleanInput.includes(keyword)) {
                return 'facility';
            }
        }

        return 'general'; // Business name or route
    }

    function getSearchHint(input, type) {
        switch(type) {
            case 'time':
                return '<small class="text-info"><i class="fa-solid fa-clock me-1 text-info"></i>Mencari berdasarkan waktu keberangkatan</small>';
            case 'price':
                return '<small class="text-success"><i class="fa-solid fa-money-bill me-1 text-success"></i>Mencari berdasarkan harga</small>';
            case 'facility':
                return '<small class="text-warning"><i class="fa-solid fa-star me-1 text-warning"></i>Mencari berdasarkan fasilitas</small>';
            default:
                return '<small class="text-primary"><i class="fa-solid fa-bus me-1 text-primary"></i>Mencari bus atau rute</small>';
        }
    }

    function findData() {
        var val = $('#find').val();

        // Clear previous timeout
        if (searchTimeout) {
            clearTimeout(searchTimeout);
        }

        if (val.length > 1) {
            // Detect search type and show hint
            const searchType = detectSearchType(val);
            const hint = getSearchHint(val, searchType);

            $('#search-wrapper').empty();
            $('#search-wrapper').append('<div class="text-center mb-2">' + hint + '</div>');
            $('#search-wrapper').append('<div class="text-center"><i class="fa-solid fa-spinner fa-spin"></i> Mencari...</div>');

            // Debounce search
            searchTimeout = setTimeout(function() {
                $.ajax({
                    url: "{{ route('search_travel') }}",
                    type: "POST",
                    data: {
                        name: val,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function($res) {
                        $('#search-wrapper').empty();
                        $('#search-wrapper').append('<div class="text-center mb-2">' + hint + '</div>');

                        if ($res && $res.trim() !== '') {
                            $('#search-wrapper').append($res);
                        } else {
                            $('#search-wrapper').append('<div class="mx-auto fw-bold text-center" style="color : var(--bs-gray-500)">Tidak ada data ditemukan</div>');
                        }
                    },
                    error: function() {
                        $('#search-wrapper').empty();
                        $('#search-wrapper').append('<div class="mx-auto fw-bold text-center text-danger">Terjadi kesalahan saat mencari</div>');
                    }
                });
            }, 300); // 300ms delay
        } else {
            showSearchExamples();
        }
    }

    // Enhanced search with filters
    function searchWithFilters(filters = {}) {
        const searchData = {
            name: $('#find').val(),
            _token: "{{ csrf_token() }}",
            ...filters
        };

        $.ajax({
            url: "{{ route('search_travel') }}",
            type: "POST",
            data: searchData,
            success: function($res) {
                $('#search-wrapper').empty();
                if ($res && $res.trim() !== '') {
                    $('#search-wrapper').append($res);
                } else {
                    $('#search-wrapper').append('<div class="mx-auto fw-bold text-center" style="color : var(--bs-gray-500)">Tidak ada data ditemukan</div>');
                }
            },
            error: function() {
                $('#search-wrapper').empty();
                $('#search-wrapper').append('<div class="mx-auto fw-bold text-center text-danger">Terjadi kesalahan saat mencari</div>');
            }
        });
    }
</script>

<style>
    .search-input:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
    }

    #card_result {
        max-width: 400px;
        right: 0;
    }

    mark.bg-warning {
        background-color: #fff3cd !important;
        padding: 1px 2px;
        border-radius: 2px;
    }

    .search-hint {
        font-size: 0.75rem;
        opacity: 0.8;
    }

    @media (max-width: 768px) {
        #card_result {
            max-width: 95vw;
            left: 2.5vw;
        }
    }
</style>
