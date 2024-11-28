<div class="row" style="padding-top: 50px;">
    <div class="col-8">

        <div class="section-title" style="margin-bottom: 25px;">
            <div style="display: flex; align-items: center;">
                <h2 class="text-dark" style="position: relative; top: 3px;">Detail Pemesanan</h2>
            </div>
            <div class="subtitle text-capitalize mt-2">Isi formulir dengan benar karena e-tiket akan dikirim ke alamat
                email
                sesuai dengan pemesanan</div>
        </div>

        <div class="mb-35px">
            <div class="card rounded-4 border-1 shadow">
                <div class="card-body">
                    <div class="d-flex flex-row align-items-center mb-3">
                        <input type="radio" name="sapa_pengunjung" id="radio_tuan" value="tuan">
                        <span class="ms-3">Tuan</span>
                        <input type="radio" name="sapa_pengunjung" class="ms-5" id="radio_tuan" value="nyonya">
                        <span class="ms-3">Nyonya</span>
                        <input type="radio" name="sapa_pengunjung" class="ms-5" id="radio_nona" value="nona">
                        <span class="ms-3">Nona</span>
                    </div>
                    <div class="mb-3">
                        <label for="nama_pengunjung" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama_pengunjung" placeholder="John Doe">
                    </div>
                    <div class="mb-3">
                        <label for="nope_pengunjung" class="form-label">Nomor Ponsel</label>
                        <input type="text" class="form-control" id="nope_pengunjung" placeholder="081213141516">
                    </div>
                    <div class="mb-3">
                        <label for="email_pengunjung" class="form-label">Alamat Email</label>
                        <input type="email" class="form-control" id="email_pengunjung" placeholder="081213141516">
                    </div>
                </div>
            </div>
        </div>

        <div class="section-title" style="margin-bottom: 25px;">
            <div style="display: flex; align-items: center;">
                <h2 class="text-dark" style="position: relative; top: 3px;">Detail Pengunjung</h2>
            </div>
            <div class="subtitle text-capitalize mt-2">Pastikan mengisi detail pengunjung dengan benar untuk kelancaran
                acara
            </div>
        </div>

        <div class="mb-35px">
            <div class="card rounded-4 border-1 shadow">
                <div class="card-body">
                    <div class="d-flex flex-row align-items-center mb-3">
                        <input type="radio" name="sapa_pengunjung" id="radio_tuan" value="tuan">
                        <span class="ms-3">Tuan</span>
                        <input type="radio" name="sapa_pengunjung" class="ms-5" id="radio_tuan" value="nyonya">
                        <span class="ms-3">Nyonya</span>
                        <input type="radio" name="sapa_pengunjung" class="ms-5" id="radio_nona" value="nona">
                        <span class="ms-3">Nona</span>
                    </div>
                    <div class="mb-3">
                        <label for="nama_pengunjung" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama_pengunjung" placeholder="John Doe">
                    </div>
                    <div class="mb-3">
                        <label for="nope_pengunjung" class="form-label">Nomor Ponsel</label>
                        <input type="text" class="form-control" id="nope_pengunjung" placeholder="081213141516">
                    </div>
                    <div class="mb-3">
                        <label for="email_pengunjung" class="form-label">Alamat Email</label>
                        <input type="email" class="form-control" id="email_pengunjung" placeholder="081213141516">
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-35px">
            <div class="card rounded-4 border-1 shadow">
                <div class="card-header d-flex flex-row align-items-center">
                    <h2 class="fw-bold">Total Pembayaran</h2>
                    <h2 class="fw-bold">IDR 230.000</h2>
                </div>
                <div class="card-body d-flex flex-row align-items-center">
                    <span class="fa-solid fa-gem fs-3 text-danger"></span>
                    <span>Kamu akan mendapatkan 1000 poin</span>
                    <button class="btn btn-danger ms-sm-auto">Lanjutkan Pemesanan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card rounded-4 border-1 shadow fs-5">
            <div class="card-body p-5">
                <div class="d-flex flex-row">
                    <img src="" alt="" width="50" height="50">
                    <span class="fw-bold ms-3 text-wrap">Klinik</span>
                    <span class="text-danger ms-sm-auto">Detail Paket</span>
                </div>
                <hr class="opacity-25 my-5">
                <div class="d-flex flex-column">
                    <span>perawatan Kulit</span>
                    <span>1 tiket <span class="custom-dot-before">1 Pax</span></span>
                </div>
                <hr class="opacity-25 my-5">
                <div class="d-flex flex-column">
                    <span>Masa Berlaku</span>
                    <span>sen, 22 November 2024 - sel, 30 November 2024</span>
                </div>
                <hr class="opacity-25 my-5">
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row">
                        <span class="fa-solid fs-3 mb-3 fa-money-bill"></span>
                        <span class="ms-3">Tidak bisa refund</span>
                    </div>
                    <div class="d-flex flex-row">
                        <span class="fa-solid fs-3 mb-3 fa-clock"></span>
                        <span class="ms-3">Berlaku hingga 14 hari sejak dibeli</span>
                    </div>
                    <div class="d-flex flex-row">
                        <span class="fa-solid fs-3 mb-3 fa-clock"></span>
                        <span class="ms-3">Reservasi paling lambat 1 hari sebelumnya</span>
                    </div>
                </div>
                <hr class="opacity-25 my-5">
                <div class="d-flex flex-row align-items-center">
                    <span>Total pembayaran</span>
                    <span class="fs-3 ms-sm-auto">IDR 230.000</span>
                </div>
            </div>
        </div>
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
