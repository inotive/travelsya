<div class="container mb-50">
    <div class="row justify-content-between">
        <!-- Agent Filter Section -->
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
                                class="badge badge-pills badge-outline {{ $selected_agent == null ? 'badge-danger' : 'badge-secondary' }} round fs-6 p-3 text-nowrap">
                                Semua Agent
                            </button>
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

        <!-- Filter & Sort Section -->
        <div class="col-md-4">
            <div class="card d-flex flex-row justify-content-end">
                <!-- Filter Dropdown -->
                <div class="ms-4 position-relative" style="display: inline-block;">
                    <button class="badge badge-pills badge-outline badge-secondary round fs-6 p-3 btn-filter-toggle" type="button">
                        <i class="fa-solid fa-filter me-2"></i>
                        Filter
                    </button>
                    <div id="filterDropdownMenu" class="dropdown-menu-custom" style="display: none; position: absolute; top: 100%; right: 0; margin-top: 5px; z-index: 1000; min-width: 200px; background: white; border: 1px solid #ddd; border-radius: 0.375rem; box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);">
                        <!-- Kategori Filter -->
                        <div class="dropdown-section p-3">
                            <div class="fw-bold mb-2 fs-6">Kategori</div>
                            <div class="form-check mb-2">
                                <input class="form-check-input filter-kategori" type="checkbox" id="busFilter" value="bus">
                                <label class="form-check-label fs-7" for="busFilter">Bus</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input filter-kategori" type="checkbox" id="travelFilter" value="travel">
                                <label class="form-check-label fs-7" for="travelFilter">Travel</label>
                            </div>
                        </div>

                        <!-- Apply/Reset Buttons -->
                        <div class="dropdown-section p-3 border-top d-flex justify-content-between">
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="resetFilters">Reset</button>
                            <button type="button" class="btn btn-sm btn-danger" id="applyFilters">Terapkan</button>
                        </div>
                    </div>
                </div>

                <!-- Price Sort Dropdown -->
                <div class="ms-4 position-relative" style="display: inline-block;">
                    <button class="badge badge-pills badge-outline badge-secondary round fs-6 p-3 btn-price-toggle" type="button">
                        <i class="fa-solid fa-money-bill me-2"></i>
                        Harga
                    </button>
                    <div id="priceDropdownMenu" class="dropdown-menu-custom" style="display: none; position: absolute; top: 100%; right: 0; margin-top: 5px; z-index: 1000; min-width: 200px; background: white; border: 1px solid #ddd; border-radius: 0.375rem; box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);">
                        <a class="dropdown-item fs-6 p-3 harga-sort" href="javascript:void(0)" data-sort="asc" style="cursor: pointer; display: block; text-decoration: none; color: inherit; border-bottom: 1px solid #f0f0f0;">
                            <i class="fa-solid fa-arrow-up me-2"></i>Harga Terendah
                        </a>
                        <a class="dropdown-item fs-6 p-3 harga-sort" href="javascript:void(0)" data-sort="desc" style="cursor: pointer; display: block; text-decoration: none; color: inherit;">
                            <i class="fa-solid fa-arrow-down me-2"></i>Harga Tertinggi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function initBusFilter() {
    // State management - initialize from current page form inputs
    let currentFilters = {
        kategori: [],
        sort: null
    };

    // Initialize from current page form data
    const kategoriInput = document.querySelector('input[name="kategori"]');
    const sortInput = document.querySelector('input[name="sort"]');
    
    // Set initial values from form inputs
    if (kategoriInput && kategoriInput.value) {
        currentFilters.kategori = kategoriInput.value.split(',').map(item => item.trim());
    }
    
    if (sortInput && sortInput.value) {
        currentFilters.sort = sortInput.value;
    }

    // Get all necessary elements
    const filterToggle = document.querySelector('.btn-filter-toggle');
    const priceToggle = document.querySelector('.btn-price-toggle');
    const filterMenu = document.getElementById('filterDropdownMenu');
    const priceMenu = document.getElementById('priceDropdownMenu');

    const kategoriCheckboxes = document.querySelectorAll('.filter-kategori');
    const sortLinks = document.querySelectorAll('.harga-sort');

    const applyBtn = document.getElementById('applyFilters');
    const resetBtn = document.getElementById('resetFilters');

    // Initialize active states based on current filters
    function updateActiveStates() {
        // Update filter toggle active state based on selected kategori
        const hasActiveKategori = currentFilters.kategori.length > 0;
        if (filterToggle) {
            filterToggle.classList.toggle('active', hasActiveKategori);
        }

        // Update price toggle active state based on sort selection
        const hasActiveSort = currentFilters.sort !== null;
        if (priceToggle) {
            priceToggle.classList.toggle('active', hasActiveSort);
        }

        // Update active states for kategori checkboxes
        kategoriCheckboxes.forEach(checkbox => {
            const isChecked = currentFilters.kategori.includes(checkbox.value);
            checkbox.checked = isChecked;

            // Update label styling
            const label = document.querySelector(`label[for="${checkbox.id}"]`);
            if (label) {
                label.classList.toggle('active', isChecked);
            }
        });

        // Update active states for sort options
        sortLinks.forEach(link => {
            const sortValue = link.getAttribute('data-sort');
            const isActive = currentFilters.sort === sortValue;
            link.classList.toggle('active', isActive);
        });
    }

    // Toggle dropdowns
    if (filterToggle && filterMenu) {
        filterToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (priceMenu) priceMenu.style.display = 'none';
            filterMenu.style.display = filterMenu.style.display === 'block' ? 'none' : 'block';
        });
    }

    if (priceToggle && priceMenu) {
        priceToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (filterMenu) filterMenu.style.display = 'none';
            priceMenu.style.display = priceMenu.style.display === 'block' ? 'none' : 'block';
        });
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (filterMenu && !filterMenu.contains(e.target) && !filterToggle.contains(e.target)) {
            filterMenu.style.display = 'none';
        }
        if (priceMenu && !priceMenu.contains(e.target) && !priceToggle.contains(e.target)) {
            priceMenu.style.display = 'none';
        }
    });

    // Prevent dropdown from closing when clicking inside
    if (filterMenu) {
        filterMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }

    if (priceMenu) {
        priceMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }

    // Apply filters button
    if (applyBtn) {
        applyBtn.addEventListener('click', function() {
            currentFilters.kategori = Array.from(kategoriCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            filterMenu.style.display = 'none';
            updateActiveStates();
            submitSearch();
        });
    }

    // Add event listener for individual kategori checkbox changes
    kategoriCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Update the currentFilters.kategori array based on checked checkboxes
            currentFilters.kategori = Array.from(kategoriCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            // Update active states to reflect current selections
            updateActiveStates();
        });
    });

    // Reset filters button
    if (resetBtn) {
        resetBtn.addEventListener('click', function() {
            kategoriCheckboxes.forEach(cb => cb.checked = false);
            currentFilters.kategori = [];
            currentFilters.sort = null;
            updateActiveStates();
            submitSearch();
        });
    }

    // Price sort links
    sortLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            currentFilters.sort = this.getAttribute('data-sort');
            priceMenu.style.display = 'none';
            updateActiveStates();
            submitSearch();
        });
    });

    // Submit search function using form POST
    function submitSearch() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            console.error('CSRF token not found');
            return;
        }

        // Get search parameters
        const kotaAwal = document.querySelector('input[name="kota_awal"]');
        const kotaTujuan = document.querySelector('input[name="kota_tujuan"]');
        const datePergi = document.querySelector('input[name="date_pergi"]');
        const jumlahPenumpang = document.querySelector('input[name="jumlah_penumpang"]');
        const isPulangPergi = document.querySelector('input[name="is_pulang_pergi"]');
        const agentInput = document.querySelector('input[name="agent"]');

        // Create form dynamically
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = window.location.pathname; // Use current path

        // Add CSRF token
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = csrfToken.getAttribute('content');
        form.appendChild(csrfInput);

        // Add search parameters
        if (kotaAwal) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'kota_awal';
            input.value = kotaAwal.value;
            form.appendChild(input);
        }

        if (kotaTujuan) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'kota_tujuan';
            input.value = kotaTujuan.value;
            form.appendChild(input);
        }

        if (datePergi) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'date_pergi';
            input.value = datePergi.value;
            form.appendChild(input);
        }

        if (jumlahPenumpang) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'jumlah_penumpang';
            input.value = jumlahPenumpang.value;
            form.appendChild(input);
        }

        if (isPulangPergi) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'is_pulang_pergi';
            input.value = isPulangPergi.value;
            form.appendChild(input);
        }

        // Add agent if selected
        if (agentInput && agentInput.value) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'agent';
            input.value = agentInput.value;
            form.appendChild(input);
        }

        // Add kategori filters
        if (currentFilters.kategori.length > 0) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'kategori';
            input.value = currentFilters.kategori.join(',');
            form.appendChild(input);
        }

        // Add sort
        if (currentFilters.sort) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'sort';
            input.value = currentFilters.sort;
            form.appendChild(input);
        }

        // Submit form
        document.body.appendChild(form);
        form.submit();
    }

    const initialKategori = document.querySelector('input[name="kategori"]');
    const initialSort = document.querySelector('input[name="sort"]');

    if (initialKategori && initialKategori.value) {
        currentFilters.kategori = initialKategori.value.split(',');
    }
    if (initialSort && initialSort.value) {
        currentFilters.sort = initialSort.value;
    }

    // Initialize active states based on any existing filter values from the page
    setTimeout(updateActiveStates, 100); // Slight delay to ensure DOM is ready
}

// Initialize only once
if (!window.busFilterInitialized) {
    window.busFilterInitialized = true;

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initBusFilter);
    } else {
        initBusFilter();
    }
}
</script>

<style>
/* Hover effects for dropdown items */
.dropdown-item:hover {
    background-color: #f8f9fa;
}

.harga-sort:hover {
    background-color: #f8f9fa;
}

/* Checkbox styling */
.form-check-input:checked {
    background-color: #dc3545;
    border-color: #dc3545;
}

/* Buttons general hover */
.btn-filter-toggle:hover,
.btn-price-toggle:hover {
    opacity: 0.9;
    transform: scale(1.02);
}

/* Scrollbar for dropdowns */
.dropdown-menu-custom {
    max-height: 500px;
    overflow-y: auto;
}

.dropdown-menu-custom::-webkit-scrollbar {
    width: 6px;
}
.dropdown-menu-custom::-webkit-scrollbar-track {
    background: #f1f1f1;
}
.dropdown-menu-custom::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}
.dropdown-menu-custom::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* Active Filter/Harga Button Styles */
.btn-filter-toggle,
.btn-price-toggle {
    cursor: pointer;
    transition: all 0.25s ease-in-out;
}

.btn-filter-toggle.active,
.btn-price-toggle.active {
    background-color: #dc3545 !important;
    color: #fff !important;
    border-color: #dc3545 !important;
    box-shadow: 0 0 10px rgba(220, 53, 69, 0.4);
}

.btn-filter-toggle.active i,
.btn-price-toggle.active i {
    color: #fff !important;
}

/* Highlight active filter labels */
.form-check-input:checked + .form-check-label,
.form-check-label.active {
    color: #dc3545;
    font-weight: 600;
    transition: color 0.2s;
}

/* Active sort option */
.harga-sort.active {
    background-color: #dc3545 !important;
    color: #fff !important;
    font-weight: 600;
}

/* Improve look of agent badges */
.badge {
    cursor: pointer;
    transition: all 0.2s ease-in-out;
}

.badge:hover {
    transform: translateY(-1px);
}

/* Make the red badge (active agent) more consistent */
.badge-danger {
    background-color: #dc3545 !important;
    color: #fff !important;
    border-color: #dc3545 !important;
}

</style>
