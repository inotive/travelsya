<div class="container mb-5">
    <section class="special-deals mt-5">
        <div class="section-title" style="margin-bottom:25px;">
            <div class="subtitle text-capitalize mt-2">Menampilkan <span class="text-dark">{{ $providers->count()
                    }}</span> hasil
                pencarian
            </div>
        </div>

        <div class="p-5 my-3">
            <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6">
                @foreach ($providers as $provider)
                <div class="card shadow mb-1 w-100">
                    <div class="card-body d-flex flex-row">
                        <img src="{{ $provider->img != '' ? $provider->img : 'https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg' }}"
                            class="" width="150px" height="100px" alt="...">
                        <div class="d-flex flex-column ms-5">
                            <span class="fw-bold mb-3">{{ $provider->name }}</span>
                            <div class="d-flex flex-row align-items-center">
                                <span class="fa-solid fa-suitcase"></span>
                                <span class="ms-2">{{ $provider->lugage }} Koper</span>
                                <span class="fa-solid fa-user ms-5"></span>
                                <span class="ms-2">{{ $provider->passage }} Penumpang</span>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-end ms-sm-auto">
                            <span class="mb-3">Mulai dari</span>
                            <span class="mb-2"><span class="text-danger fs-5 fw-bold">IDR 230.000</span> / hari</span>
                            <button class="btn btn-danger py-1" id="provider_button" data-toogle="modal"
                                data-target="#providers">Pilih
                                Mobil</button>
                        </div>
                    </div>
                </div>
                {{-- <div class="col p-3">
                    <a href="{{ route($route, ['lokasi' => $provider->lokasi, 'provider' => $provider->name, 'duration' => 1]) }}"
                        class="text-decoration-none text-dark   ">
                        <div class="card" style="box-shadow: 0 10px 15px gray">
                            <img src="https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg&w=400&fit=max"
                                class="card-img-top" alt="...">
                            <div class="card-body">
                                <div class="card-content">
                                    <div class="w-100 d-flex flex-row align-items-center">
                                        <span class="fa-solid fa-location-dot me-2"></span>
                                        <span>{{ ucwords($provider->lokasi) }}</span>
                                        <span style="margin-left:auto;" class="fa-regular fa-bookmark"></span>
                                    </div>

                                    <h3 class="mt-3 text-dark">{{ ucwords($provider->name) }}</h3>

                                    <div class="rating d-flex align-items-center">
                                        <span class="bintang text-warning fs-2 fa fa-star checked me-2"></span>
                                        <span class="rating-number" style="position: relative; top: 1px;">{{
                                            str_replace(',',
                                            '.', $provider->rate) }}
                                            (2rb
                                            ulasan)
                                        </span>
                                    </div>

                                    <div class="price mt-7">
                                        <span class="coret text-decoration-line-through">IDR
                                            {{ number_format($provider->origin_price, 0, ',', '.') }}</span>
                                        <span style="font-size: 1.5rem;" class="text-danger text-bold">IDR
                                            {{ number_format($provider->cut_price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div> --}}
                @endforeach
            </div>
        </div>
    </section>

    <div class="modal fade" id="providers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="d-flex flex-column border border-bottom" style="padding: 1.75rem;">
                    <div class="d-flex flex-row align-items-center mb-2">
                        <span class="title fw-bold fs-5">Pilih Penyedia Rental</span>
                        <button class="btn btn-outline-light close ms-sm-auto p-0" id="close_modal" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true" class="fs-1">&times;</span>
                        </button>
                    </div>
                    <div class="d-flex flex-row">
                        <div class="d-flex flex-column">
                            <span class="fw-bold">Toyota New Brand</span>
                            <div class="d-flex flex-row align-items-center">
                                <span class="fa-solid fa-suitcase opacity-25"></span>
                                <span class="ms-2 opacity-25">{{ $provider->lugage }} Koper</span>
                                <span class="fa-solid fa-user ms-5 opacity-25"></span>
                                <span class="ms-2 opacity-25">{{ $provider->passage }} Penumpang</span>
                            </div>
                        </div>
                        <img src="https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg"
                            class="ms-sm-auto" width="150px" height="100px" alt="...">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="card shadow-sm mb-5">
                        <div class="card-body d-flex flex-row">
                            <div class="d-flex flex-column">
                                <span class="fw-bold mb-5">SMJ RENT</span>
                                <div class="rating d-flex align-items-center mb-1">
                                    <span class="bintang text-warning fa fa-star checked me-2"></span>
                                    <span class="rating-number fw-bold">4.8 / <small>5</small> <a href="#"
                                            class="text-decoration-none text-dark opacity-50 text-capitalize">(Lihat xxx
                                            Ulasan)</a>
                                    </span>
                                    <span class="rating-number custom-dot-before">2500 order</span>
                                </div>
                                <div class="rating d-flex align-items-center mb-1">
                                    <span class="bintang fa-solid fa-suitcase checked me-2"></span>
                                    <span class="rating-number">Air Mineral</span>
                                </div>
                                <div class="rating d-flex align-items-center mb-1">
                                    <span class="bintang fa-solid fa-user checked me-2"></span>
                                    <span class="rating-number">Supir bisa bahasa inggris</span>
                                </div>
                            </div>
                            <div class="d-flex flex-column ms-sm-auto align-items-end justify-content-end">
                                <span class="mb-2"><span class="text-danger fw-bold">IDR 230.000</span> /
                                    hari</span>
                                <button class="btn btn-danger py-1" id="provider_button" data-toogle="modal"
                                    data-target="#providers">Pilih penyedia</button>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-sm mb-5">
                        <div class="card-body d-flex flex-row">
                            <div class="d-flex flex-column">
                                <span class="fw-bold mb-5">SMJ RENT</span>
                                <div class="rating d-flex align-items-center mb-1">
                                    <span class="bintang text-warning fa fa-star checked me-2"></span>
                                    <span class="rating-number fw-bold">4.8 / <small>5</small> <a href="#"
                                            class="text-decoration-none text-dark opacity-50 text-capitalize">(Lihat xxx
                                            Ulasan)</a>
                                    </span>
                                    <span class="rating-number custom-dot-before">2500 order</span>
                                </div>
                                <div class="rating d-flex align-items-center mb-1">
                                    <span class="bintang fa-solid fa-suitcase checked me-2"></span>
                                    <span class="rating-number">Air Mineral</span>
                                </div>
                                <div class="rating d-flex align-items-center mb-1">
                                    <span class="bintang fa-solid fa-user checked me-2"></span>
                                    <span class="rating-number">Supir bisa bahasa inggris</span>
                                </div>
                            </div>
                            <div class="d-flex flex-column ms-sm-auto align-items-end justify-content-end">
                                <span class="mb-2"><span class="text-danger fw-bold">IDR 230.000</span> /
                                    hari</span>
                                <button class="btn btn-danger py-1" id="provider_button" data-toogle="modal"
                                    data-target="#providers">Pilih penyedia</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@push('js')
<script>
    $('#providers').on('shown.bs.modal', function () {
        $('#provider_button').trigger('focus')
    });

    $('#provider_button').click(function(){
        $('#providers').modal('show');
    });

    $('#close_modal').click(function(){
        $('#providers').modal('hide');
    });
</script>
@endpush