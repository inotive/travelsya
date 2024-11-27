<div class="section-title">
    <div class="title text-capitalize d-flex align-items-center">
        <div class="icon-wrapper bg-danger d-flex me-3">
            <img src="{{ asset('images/icon/bunga.png') }}" height="100%" width="100%" alt="">
        </div>
        {{ $section_title }}
    </div>
    <div class="subtitle text-capitalize mt-2">{{ $section_subtitle }}</div>



    <div style="display: flex; gap: 10px; padding: 5px; border-radius: 10px;" class="mb-3">
        <button class="panah btn btn-outline-primary" onclick="document.querySelector('.card-grid').scrollLeft -= 300;">
            <span class="chevron fa-solid fa-chevron-left"></span>
        </button>
        <button class="panah btn btn-outline-primary" onclick="document.querySelector('.card-grid').scrollLeft += 300;">
            <span class="chevron fa-solid fa-chevron-right"></span>
        </button>
    </div>

    <div class="card-grid">
        @foreach ($clinics as $clinic)
        @foreach ($clinic->clinicPackages as $package)
        <!-- Repeat this card 5 times -->

        <div class="card">
            <div class="discount-tag-container">
                <span class="discount-tag">Big Deals</span>
            </div>
            <img class="gambar-treat" style="filter: brightness(0.7);"
                src="{{ asset('storage/clinichaspackages/' . $package->image) }}" alt="{{ $package->name }}">
            <div class="card-content">
                <div class="lokasi d-flex align-items-center">
                    <span class="fa-solid fa-location-dot me-2"></span>
                    <span style="position: relative; left: 240px;" class="fa-regular fa-bookmark"></span>
                    <span>{{ $clinic->city }}</span>
                </div>

                <h3 class="mt-3 text-dark">{{ $package->name }}</h3>

                <div class="rating d-flex align-items-center">
                    <span class="bintang fa fa-star checked me-2"></span>
                    <span class="rating-number" style="position: relative; top: 1px;">4,8 (2rb ulasan)</span>
                </div>

                <div class="price mt-7">
                    <span class="coret text-decoration-line-through">{{ 'Rp '.number_format($package->price) }}</span>
                    <span>{{ 'Rp '.number_format($package->price) }}</span>
                </div>
            </div>
        </div>

        <!-- Repeat 4 more times -->
        @endforeach
        @endforeach
    </div>
</div>