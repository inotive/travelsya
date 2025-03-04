<div class="section-title mb-35px">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none subtitle text-capitalize">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none subtitle text-capitalize">Indonesia</a>
            </li>
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none subtitle text-capitalize">Provinsi</a>
            </li>
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none subtitle text-capitalize">Kota</a>
            </li>
            <li class="breadcrumb-item active text-danger subtitle text-capitalize" aria-current="page">Klinik</li>
        </ol>
    </nav>
</div>

<div class="p-3 mb-35px">
    <div class="row g-3">
        <div class="col-md-6">
            @if (isset($clinic->image))
                <img src="{{ asset('storage/' . $clinic->image->image) }}" onerror="this.src='https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&fm=jpg'"
                    class="img-fluid rounded shadow" style="object-fit: contain;" alt="{{ $clinic->clinic_name }}">
            @else
                <img src="'https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&fm=jpg'"
                    class="img-fluid rounded shadow" style="object-fit: contain;" alt="{{ $clinic->clinic_name }}">
            @endif
        </div>
        @if (isset($clinic->images))
        <div class="col-md-6">
            <div class="row g-2">
                @foreach ($clinic->images as $k => $i)
                <div class="col-6">
                    <img src="{{ asset('storage/'. $i->image) }}" onerror="this.src='https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg&w=400&fit=max'"
                        class="img-fluid rounded shadow" alt="{{ $clinic->clinic_image }}">
                </div>
                    @if ($k == 3)
                        @php
                            break;
                        @endphp
                    @endif
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
