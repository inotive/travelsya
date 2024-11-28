<div class="section-title mb-35px">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none subtitle text-capitalize">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#"
                    class="text-decoration-none subtitle text-capitalize">Indonesia</a>
            </li>
            <li class="breadcrumb-item"><a href="#"
                    class="text-decoration-none subtitle text-capitalize">Provinsi</a>
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
            <img src="https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&fm=jpg"
                class="img-fluid rounded shadow" style="object-fit: contain;" alt="...">
        </div>
        <div class="col-md-6">
            <div class="row g-2">
                <div class="col-6">
                    <img src="https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg&w=400&fit=max"
                        class="img-fluid rounded shadow" alt="...">
                </div>
                <div class="col-6">
                    <img src="https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg&w=400&fit=max"
                        class="img-fluid rounded shadow" alt="...">
                </div>
                <div class="col-6">
                    <img src="https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg&w=400&fit=max"
                        class="img-fluid rounded shadow" alt="...">
                </div>
                <div class="col-6">
                    <img src="https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg&w=400&fit=max"
                        class="img-fluid rounded shadow" alt="...">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="px-3 mb-5">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#ringkasan">Ringkasan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#highlight">Highlight</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#paket">Paket</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#review">Review</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#lokasi">Lokasi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#deskripsi">Deskripsi</a>
        </li>
    </ul>
    <hr>
</div>

<div class="px-3 mb-35px">
    <div id="ringkasan" class="mb-35px">
        <div class="section-title mb-4">
            <div class="w-100 title text-capitalize" style="font-size: calc(1rem + 1.35vw)">
                Klinik
            </div>
        </div>
        <div class="rating d-flex align-items-center mb-25px">
            <span class="bintang text-warning fs-1 fa fa-star checked me-2"></span>
            <span class="rating-number fs-3 fw-bold">4.8 / <small class="fs-6">5</small> <a href="#"
                    class="text-decoration-none text-dark opacity-50 text-capitalize">(Lihat xxx Ulasan)</a> </span>
            <span class="rating-number fs-3 custom-dot-before">2500 terjual</span>
        </div>
        <div class="lokasi d-flex align-items-center mb-25px">
            <span class="fa-solid fa-location-dot fs-1 me-2 text-dark opacity-50"></span>
            <span class="fs-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, magnam. Voluptatum
                veritatis beatae
                quibusdam, excepturi quam ipsam soluta commodi quae.</span>
        </div>
        <div class="lokasi d-flex align-items-center mb-25px">
            <span class="fa-solid fa-clock fs-2 me-2 text-dark opacity-50"></span>
            <span class="fs-3 me-2">Buka: Hari ini 09.00 - 20.00</span>
            <a href="#" class="text-danger text-decoration-none fs-3 fw-bold">Lihat</a>
        </div>
    </div>
    <div class="card bg-danger bg-opacity-25 rounded-4 pd-3 mb-35px">
        <div class="card-body">
            <div id="highlight" class="mb-3">
                <h2>Highlight</h2>
                <ul class="fs-3">
                    <li>perawatan lengkap tersedian untuk rambut, alis, bulu matara, kuku, dan tubuh</li>
                    <li>kami menggunakan produk berkualitas tinggi seperti Davines dan Olaplex</li>
                </ul>
                <a href="#" class="text-danger text-decoration-none fs-3">Lihat Selengkapnya</a>
            </div>
        </div>
    </div>
    <hr>
</div>

<div class="px-3 mb-35px fs-2" id="paket">
    <div class="section-title mb-4">
        <div class="w-100 title text-capitalize" style="font-size: calc(1rem + 0.85vw)">
            Paket
        </div>
    </div>
    <div class="card bg-danger bg-opacity-25 p-3">
        <form action="{{ route('health_beauty.order', ['clinic' => 1]) }}" method="post">
            @csrf
            <div class="accordion" id="list_paket">
                <div class="card accordion-item mb-3">
                    <div class="card-header p-0">
                        <div class="accordion-header w-100">
                            <h2 class="w-100" id="paket-1">
                                <button class="accordion-button collapsed bg-opacity-0 " type="button"
                                    data-bs-toggle="collapse" data-bs-target="#paket-collapse-1" aria-expanded="true"
                                    aria-controls="paket-collapse-1">
                                    <div class="d-flex flex-column">
                                        <h3>Accordion Item #2</h3>
                                        <div class="d-flex flex-row align-items-center">
                                            <small>
                                                <span class="fa-solid fa-money-bill me-1"></span>
                                                <span class="me-3">Tidak bisa refund</span>
                                                <span class="fa-solid fa-calendar me-1"></span>
                                                <span class="me-3">Pesan tiket untuk hari ini</span>
                                                <span class="fa-solid fa-clock me-1"></span>
                                                <span class="me-3">Berlaku 30 hari sejak dibeli</span>
                                                <span class="fa-solid fa-clock me-1"></span>
                                                <span class="me-3">Reservasi paling 1 hari sebelumnya</span>
                                            </small>
                                        </div>
                                    </div>
                                </button>
                            </h2>

                        </div>
                    </div>
                    <div class="card-body accordion-collapse collapse show" id="paket-collapse-1"
                        aria-labelledby="paket-1">
                        <div class="mb-2">
                            Masa Berlaku: {{ \App\Helpers\General::getDateShortMonth(now()) }} -
                            {{ \App\Helpers\General::getDateShortMonth(date('Y-m-d H:i:s', strtotime('+30 days', strtotime(now())))) }}
                        </div>
                        <div class="mb-2 fw-bold">
                            Jumlah tiket
                        </div>
                        <div class="mb-3 card border p-0">
                            <div class="card-body d-flex flex-row align-items-center">
                                <span>Adult</span>
                                <span style="margin-left: auto;">
                                    <span class="text-danger fw-bold">IDR 230.000</span>/pax
                                    <span class="ms-3">
                                        <span class="fa-solid fa-minus-circle text-danger fs-2" id="decrease_paket"
                                            id_paket="1"></span>
                                        <input type="hidden" name="val_paket_1" id="val_paket_1" value="1">
                                        <span class="fs-2 mx-2" id="dummy_paket_1">1</span>
                                        <span class="fa-solid fa-plus-circle text-danger fs-2" id="increase_paket"
                                            id_paket="1"></span>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex flex-row align-items-center">
                            <span class="text-danger fw-bold">IDR 230.000</span>
                            <button type="submit" class="btn btn-danger" style="margin-left: auto;"
                                id="button_paket_1">Pesan</button>
                        </div>
                    </div>
                </div>
                <div class="card accordion-item mb-3">
                    <div class="card-header p-0">
                        <div class="accordion-header w-100">
                            <h2 class="w-100" id="paket-2">
                                <button class="accordion-button collapsed bg-opacity-0 " type="button"
                                    data-bs-toggle="collapse" data-bs-target="#paket-collapse-2" aria-expanded="true"
                                    aria-controls="paket-collapse-2">
                                    <div class="d-flex flex-column">
                                        <h3>Accordion Item #2</h3>
                                        <div class="d-flex flex-row align-items-center">
                                            <small>
                                                <span class="fa-solid fa-money-bill me-1"></span>
                                                <span class="me-3">Tidak bisa refund</span>
                                                <span class="fa-solid fa-calendar me-1"></span>
                                                <span class="me-3">Pesan tiket untuk hari ini</span>
                                                <span class="fa-solid fa-clock me-1"></span>
                                                <span class="me-3">Berlaku 30 hari sejak dibeli</span>
                                                <span class="fa-solid fa-clock me-1"></span>
                                                <span class="me-3">Reservasi paling 1 hari sebelumnya</span>
                                            </small>
                                        </div>
                                    </div>
                                </button>
                            </h2>

                        </div>
                    </div>
                    <div class="card-body accordion-collapse collapse" id="paket-collapse-2"
                        aria-labelledby="paket-2">
                        <div class="mb-2">
                            Masa Berlaku: {{ \App\Helpers\General::getDateShortMonth(now()) }} -
                            {{ \App\Helpers\General::getDateShortMonth(date('Y-m-d H:i:s', strtotime('+30 days', strtotime(now())))) }}
                        </div>
                        <div class="mb-2 fw-bold">
                            Jumlah tiket
                        </div>
                        <div class="mb-3 card border p-0">
                            <div class="card-body d-flex flex-row align-items-center">
                                <span>Adult</span>
                                <span style="margin-left: auto;">
                                    <span class="text-danger fw-bold">IDR 230.000</span>/pax
                                    <span class="ms-3">
                                        <span class="fa-solid fa-minus-circle text-danger fs-2" id="decrease_paket"
                                            id_paket="2"></span>
                                        <input type="hidden" name="val_paket_2" id="val_paket_2" value="0">
                                        <span class="fs-2 ms-2" id="dummy_paket_2">0</span>
                                        <span class="fa-solid fa-plus-circle text-danger fs-2 ms-3"
                                            id="increase_paket" id_paket="2"></span>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex flex-row align-items-center">
                            <span class="text-danger fw-bold">IDR 230.000</span>
                            <button type="submit" class="btn btn-danger" style="margin-left: auto;"
                                id="button_paket_2">Pilih
                                Paket</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="px-3 mb-3 d-flex flex-column mb-35px" id="review">
    <div class="section-title mb-4">
        <div class="w-100 title text-capitalize" style="font-size: calc(1rem + 0.85vw)">
            Review
        </div>
    </div>
    <div class="d-flex align-items-center flex-row mb-3">
        <span class="text-warning fs-2 bintang fa fa-star checked me-2"></span>
        <span class="rating-number fw-bold text-dark opacity-50"
            style="font-size: calc(1rem + 1.35vw)">4.8/<small>5</small></span>
        <div class="d-flex flex-column ms-5 fs-5">
            <h3>Bagus</h3>
            <span class="opacity-75">Dari 2800 review</span>
        </div>
    </div>
    <div class="d-flex
            flex-row gap-2 p-1 rounded-1 align-items-center mb-3">
        <button class="btn btn-gray-carousel btn-sm rounded-circle fs-2"
            data-bs-target="#specialdealsCarouselControls" data-bs-slide="prev">
            <span class="chevron fa-solid fa-chevron-left"></span>
        </button>
        <button class="btn btn-gray-carousel btn-sm rounded-circle fs-2"
            data-bs-target="#specialdealsCarouselControls" data-bs-slide="next">
            <span class="chevron fa-solid fa-chevron-right"></span>
        </button>
        <a href="#spesial_deals" class="text-danger ms-auto fw-bold fs-2">Lihat
            Semua</a>
    </div>
    <div id="specialdealsCarouselControls" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="card-wrapper container-md d-flex justify-content-around gap-2">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex flex-row align-items-center mb-3">
                                <div class="card-title d-flex align-items-center fs-2">5.0/<small
                                        class="opacity-75">5</small>
                                </div>
                                <span
                                    class="opacity-75 ms-sm-auto">{{ \App\Helpers\General::getDateShortMonth('2023-01-23') }}</span>
                            </div>
                            <div class="card-subtitle fs-5 opacity-75 fw-bold mb-1">Hayati Nur</div>
                            <span class="fs-5 opacity-75">Pelayanan nyaman banget... Next bakalan balek lg buat
                                treatment
                                disana</span>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex flex-row align-items-center mb-3">
                                <div class="card-title d-flex align-items-center fs-2">5.0/<small
                                        class="opacity-75">5</small>
                                </div>
                                <span
                                    class="opacity-75 ms-sm-auto">{{ \App\Helpers\General::getDateShortMonth('2023-01-23') }}</span>
                            </div>
                            <div class="card-subtitle fs-5 opacity-75 fw-bold mb-1">Hayati Nur</div>
                            <span class="fs-5 opacity-75">Pelayanan nyaman banget... Next bakalan balek lg buat
                                treatment
                                disana</span>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex flex-row align-items-center mb-3">
                                <div class="card-title d-flex align-items-center fs-2">5.0/<small
                                        class="opacity-75">5</small>
                                </div>
                                <span
                                    class="opacity-75 ms-sm-auto">{{ \App\Helpers\General::getDateShortMonth('2023-01-23') }}</span>
                            </div>
                            <div class="card-subtitle fs-5 opacity-75 fw-bold mb-1">Hayati Nur</div>
                            <span class="fs-5 opacity-75">Pelayanan nyaman banget... Next bakalan balek lg buat
                                treatment
                                disana</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="card-wrapper container-md d-flex justify-content-around gap-2">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-center">5.0/<small>5</small></div>
                            <div class="card-subtitle">Hayati Nur</div>
                            <span>Pelayanan nyaman banget... Next bakalan balek lg buat treatment disana</span>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-center">5.0/<small>5</small></div>
                            <div class="card-subtitle">Hayati Nur</div>
                            <span>Pelayanan nyaman banget... Next bakalan balek lg buat treatment disana</span>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-center">5.0/<small>5</small></div>
                            <div class="card-subtitle">Hayati Nur</div>
                            <span>Pelayanan nyaman banget... Next bakalan balek lg buat treatment disana</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="px-3 mb-35px d-flex flex-column" id="lokasi">
    <div class="section-title mb-4">
        <div class="w-100 title text-capitalize" style="font-size: calc(1rem + 0.85vw)">
            Lokasi
        </div>
    </div>
    <div class="card rounded-4">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1413.9929019501262!2d100.36971342405258!3d-0.30524640058500946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd538bd1ff164a7%3A0xcea33881870dc19!2sJam%20Gadang%20Bukittinggi!5e0!3m2!1sen!2sid!4v1732690647336!5m2!1sen!2sid"
            width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
            class="card-img-top-rounded" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <div class="card-body d-flex flex-row aligh-items-center">
            <div class="d-flex flex-row align-items-center">
                <span class="fa-solid fa-location-dot fs-1 me-2 text-dark opacity-50 me-5"></span>
                <span class="fs-3 ms-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, magnam.
                    Voluptatum</span>
            </div>
            <div class="d-flex flex-column align-items-center ms-sm-auto me-5">
                <button class="bg-danger bg-opacity-25 rounded-circle border-0 p-4"><span
                        class="fa-solid fa-location-arrow fs-1 me-2 text-danger fw-bold"></span></button>
                <span class="fs-3 text-danger fw-bold">Lihat Peta</span>
            </div>
            <div class="d-flex flex-column align-items-center mx-5  ">
                <button class="bg-danger bg-opacity-25 rounded-circle border-0 p-4"><span
                        class="fa-solid fa-location-arrow fs-1 me-2 text-danger fw-bold"></span></button>
                <span class="fs-3 text-danger fw-bold">Lihat Peta</span>
            </div>
        </div>
    </div>
</div>

<div class="px-3 mb-35px d-flex flex-column fs-4" id="deskripsi">
    <div class="section-title mb-4">
        <div class="w-100 title text-capitalize" style="font-size: calc(1rem + 0.85vw)">
            Deskripsi
        </div>
    </div>
    <div id="description" class="opacity-75">
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta officia repellat vero, libero aspernatur
            fugiat
            iste consequatur fugit impedit at nisi esse dolorem distinctio aliquid, deleniti quam molestiae earum
            blanditiis
            quis nostrum. Eum error impedit obcaecati minus temporibus voluptas fugit amet ducimus illo animi, officia
            sed
            excepturi nemo voluptatem unde officiis beatae magni delectus? Quaerat ducimus ea alias rem est iure
            praesentium
            veritatis cupiditate eos cum illum, quas dolore, molestiae in laboriosam. Recusandae accusantium
            consequuntur
            suscipit sapiente ratione explicabo ducimus omnis expedita natus esse, eum optio quos repellendus! Hic quas
            nobis tenetur excepturi inventore illo obcaecati culpa enim, soluta vel omnis modi, dolore commodi ipsa quod
            eum! Recusandae cum fugiat deserunt hic et, doloribus, eveniet, eos placeat iure atque vitae consectetur
            cupiditate nostrum. Officia, incidunt.
        </p>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque corporis fuga quod, libero impedit sint
            soluta
            facere nam adipisci! Atque maxime incidunt sunt excepturi minus sit ducimus ullam maiores doloremque dolore,
            quasi quos libero optio nam voluptatibus aliquam amet! Deserunt doloremque veritatis dignissimos. Nemo,
            alias
            ea. Quia quam deleniti odit.
        </p>
        <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Minima corporis exercitationem esse sit, eos
            officiis
            quas culpa alias odit quos, quidem impedit saepe asperiores dolorem.
        </p>
        <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Minima corporis exercitationem esse sit, eos
            officiis
            quas culpa alias odit quos, quidem impedit saepe asperiores dolorem.
        </p>

    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() {
            $("#list_paket").on("click", "#decrease_paket", function() {
                let id = $(this).attr("id_paket");
                let val_paket = parseInt($("#val_paket_" + id).val());
                let decrease_val = val_paket;
                if (val_paket - 1 >= 0) {
                    decrease_val = val_paket - 1;
                }
                $("#val_paket_" + id).val(decrease_val);
                $("#dummy_paket_" + id).text(decrease_val);
            })


            $("#list_paket").on("click", "#increase_paket", function() {
                let id = $(this).attr("id_paket");
                let val_paket = parseInt($("#val_paket_" + id).val());
                let increase_val = val_paket + 1;
                console.log(increase_val);

                $("#val_paket_" + id).val(increase_val);
                $("#dummy_paket_" + id).text(increase_val);
            })
        });
    </script>
@endpush
