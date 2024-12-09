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
                        <span class="fw-bold mb-3">Toyota New Brand</span>
                        <div class="d-flex flex-row align-items-center">
                            <span class="fa-solid fa-suitcase opacity-25"></span>
                            {{-- <span class="ms-2 opacity-25">{{ $provider->lugage }} Koper</span> --}}
                            <span class="fa-solid fa-user ms-5 opacity-25"></span>
                            {{-- <span class="ms-2 opacity-25">{{ $provider->passage }} Penumpang</span> --}}
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
                            <a href="{{ route('car_rent.detail', ['lokasi' => 'jakarta', 'model' => 1, 'provider' => '1', 'duration' => 1]) }}"
                                class="text-decoration-none">
                                <button class="btn btn-danger">Pilih penyedia</button>
                            </a>
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

@push('js')
    <script>
        $('#providers').on('shown.bs.modal', function() {
            $('#provider_button').trigger('focus')
        });

        $('#provider_button').click(function() {
            $('#providers').modal('show');
        });

        $('#close_modal').click(function() {
            $('#providers').modal('hide');
        });
    </script>
@endpush
