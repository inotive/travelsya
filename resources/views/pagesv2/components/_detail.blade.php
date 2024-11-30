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
    <div class="row">
        <div class="col-9">
            <div id="ringkasan" class="mb-35px">
                <div class="section-title mb-4">
                    <div class="w-100 title text-capitalize" style="font-size: calc(1rem + 1.35vw)">
                        Klinik
                    </div>
                </div>
                <div class="rating d-flex align-items-center mb-25px">
                    <span class="bintang text-warning fs-1 fa fa-star checked me-2"></span>
                    <span class="rating-number fs-3 fw-bold">4.8 / <small class="fs-6">5</small> <a href="#"
                            class="text-decoration-none text-dark opacity-50 text-capitalize">(Lihat xxx Ulasan)</a>
                    </span>
                    <span class="rating-number fs-3 custom-dot-before">2500 terjual</span>
                </div>
                <div class="lokasi d-flex align-items-center mb-25px">
                    <span class="fa-solid fa-location-dot fs-1 me-2 text-dark opacity-50"></span>
                    <span class="fs-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, magnam.
                        Voluptatum
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
        </div>
        <div class="col-3">
            <div class="card d-flex flex-column align-items-center p-3 border boreder-dark">
                <span class="d-flex justify-content-space-between gap-2 align-items-center">
                    Mulai Dari <span class="text-danger fs-2 fw-bold">
                        IDR 230.000
                    </span>
                </span>
            </div>
        </div>
    </div>
    <hr>
</div>

@include($package)

@include('pagesv2.components._review')

<div class="px-3 mb-35px d-flex flex-column" id="lokasi">
    <div class="section-title mb-4">
        <div class="w-100 title text-capitalize" style="font-size: calc(1rem + 0.85vw)">
            Lokasi
        </div>
    </div>
    <div class="card rounded-4 border">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1413.9929019501262!2d100.36971342405258!3d-0.30524640058500946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd538bd1ff164a7%3A0xcea33881870dc19!2sJam%20Gadang%20Bukittinggi!5e0!3m2!1sen!2sid!4v1732690647336!5m2!1sen!2sid"
            width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" class="card-img-top-rounded"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
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

@if ($facility)
<div class="px-3 mb-35px d-flex flex-column fs-4" id="deskripsi">
    <div class="section-title mb-4">
        <div class="w-100 title text-capitalize" style="font-size: calc(1rem + 0.85vw)">
            Fasilitas
        </div>
    </div>
    <div id="description" class="d-flex flex-row align-items-center">
        <span class="fa-solid fa-store"></span>
        <span class="ms-2">Roko Suvenir</span>
        <span class="fa-solid fa-camera ms-5"></span>
        <span class="ms-2">Spot Foto</span>
        <span class="fa-solid fa-utensils ms-5"></span>
        <span class="ms-2">Restoran/Food Court</span>
    </div>
</div>
@endif

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