<div class="container mb-5">
    <section class="special-deals mt-5">
        <div class="row" style="padding-top: 50px;">
            <div class="col-8">

                <div class="section-title" style="margin-bottom: 25px;">
                    <div style="display: flex; align-items: center;">
                        <h2 class="text-dark" style="position: relative; top: 3px;">Detail Pemesanan</h2>
                    </div>
                    <div class="subtitle text-capitalize mt-2">Isi formulir dengan benar karena e-tiket akan dikirim ke
                        alamat
                        email
                        sesuai dengan pemesanan</div>
                </div>
                <form action="{{ route('health_beauty.request_transaction') }}" method="POST">
                    @csrf
                    <div class="mb-35px">
                        <div class="card rounded-4 border-1 shadow">
                            <div class="card-body">
                                <div class="d-flex flex-row align-items-center mb-3">
                                    <input type="radio" name="sapa_pemesan" id="radio_tuan" value="tuan" required>
                                    <span class="ms-3">Tuan</span>
                                    <input type="radio" name="sapa_pemesan" class="ms-5" id="radio_nyonya"
                                        value="nyonya" required>
                                    <span class="ms-3">Nyonya</span>
                                    <input type="radio" name="sapa_pemesan" class="ms-5" id="radio_nona"
                                        value="nona" required>
                                    <span class="ms-3">Nona</span>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_pemesan" class="form-label">Nama</label>
                                    <input type="text" name="nama_pemesan" class="form-control"
                                        value="{{ $user->name }}" placeholder="Masukan nama">
                                </div>
                                <div class="mb-3">
                                    <label for="nope_pemesan" class="form-label">Nomor Ponsel</label>
                                    <input type="text" name="phone_pemesan" class="form-control"
                                        value="{{ $user->phone }}" placeholder="Masukan nomor Handphone">
                                </div>
                                <div class="mb-3">
                                    <label for="email_pemesan" class="form-label">Alamat Email</label>
                                    <input type="email" name="email_pemesan" class="form-control"
                                        value="{{ $user->email }}" placeholder="Masukan Email">
                                </div>
                                <input type="hidden" name="total_ticket" value="{{ $qty }}">
                                <input type="hidden" name="service" value="{{ $service }}">
                                <input type="hidden" name="payment" value="{{ $payment }}">
                                <input type="hidden" name="package_id" value="{{ $paket['id'] }}">
                                <input type="hidden" name="point" value="0">
                            </div>
                        </div>
                    </div>

                    {{-- @if (strToLower($section_title) !== 'health')
                <!-- Additional Safety -->
                <div class="section-title" style="margin-bottom: 25px;">
                    <div style="display: flex; align-items: center;">
                        <h2 class="text-dark" style="position: relative; top: 3px;">Tambah Perlindungan Extra</h2>
                    </div>
                    <div class="subtitle text-capitalize mt-2">Pilih satu opsi untuk melanjutkan pemesanan</div>
                </div>

                <div class="mb-25px">
                    <div class="card rounded-4 border-1 shadow">
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="alert alert-primary" role="alert">
                                    Lindungi liburanmu dari yang gak pasti
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="card rounded-4 border border-dark">
                                    <div class="card-body d-flex flex-row align-items-center">
                                        <span class="fa-solid fa-money-bill text-success"></span>
                                        <div class="d-flex flex-column ms-3">
                                            <span class="fw-bold">
                                                100% Refund
                                                <span class="fa-solid fa-exclamation-circle text-primary"></span>
                                            </span>
                                            <span>berubah pikiran di H-1 sebelum kunjuangan? Dapatkan uangmu kembali
                                                100%!</span>
                                        </div>
                                        <input type="radio" class="ms-sm-auto" name="safety" id="safety_100" value="100"
                                            checked>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="card rounded-4 border border-dark">
                                    <div class="card-body d-flex flex-row align-items-center">
                                        <span class="fa-solid fa-money-bill text-success"></span>
                                        <div class="d-flex flex-column ms-3">
                                            <span class="fw-bold">
                                                85% Refund
                                                <span class="fa-solid fa-exclamation-circle text-primary opacity-50"></span>
                                            </span>
                                            <span>Menjamin refund hingga 85% harga tiket untuk pembatalan dengan alasan apa
                                                pun</span>
                                        </div>
                                        <input type="radio" class="ms-sm-auto" name="safety" id="safety_85" value="85">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="card rounded-4 border border-dark">
                                    <div class="card-body d-flex flex-row align-items-center">
                                        <span class="fa-solid fa-xmark text-dark"></span>
                                        <span class="ms-3">lanjut tanpa perlindungan</span>
                                        <input type="radio" class="ms-sm-auto" name="safety" id="safety_85" value="85">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-title" style="margin-bottom: 35px;">
                    <div class="subtitle text-capitalize mt-2">Dengan memilih asuransi, kamu telah menyetujui <span
                            class="text-danger">Sarat dan Ketentuan</span> yang berlaku. Biaya tambahan terkait asuaransi
                        tertera di detail harga</div>
                </div>
                @endif --}}
                    <!-- End Detail Pengunjung -->

                    <!-- Additional Safety -->
                    <div class="section-title" style="margin-bottom: 25px;">
                        <div style="display: flex; align-items: center;">
                            <h2 class="text-dark" style="position: relative; top: 3px;">Detail Pengunjung</h2>
                        </div>
                        <div class="subtitle text-capitalize mt-2">Pastikan mengisi detail pengunjung dengan benar untuk
                            kelancaran
                            acara
                        </div>
                    </div>

                    <div class="mb-35px">
                        <div class="card rounded-4 border-1 shadow">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h2 class="text-dark">Tiket {{ number_format($qty) }} pax</h2>
                                    </div>
                                    {{-- <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                    <label class="custom-control-label" for="customSwitch1">Toggle this switch element</label>
                                </div> --}}
                                </div>
                                <div class="d-flex flex-row align-items-center mb-3">
                                    <input type="radio" name="sapa_pengunjung" id="radio_tuan" value="tuan">
                                    <span class="ms-3">Tuan</span>
                                    <input type="radio" name="sapa_pengunjung" class="ms-5" id="radio_tuan"
                                        value="nyonya">
                                    <span class="ms-3">Nyonya</span>
                                    <input type="radio" name="sapa_pengunjung" class="ms-5" id="radio_nona"
                                        value="nona">
                                    <span class="ms-3">Nona</span>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_pengunjung" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama_pengunjung"
                                        placeholder="Masukan nama pengunjung">
                                </div>
                                <div class="mb-3">
                                    <label for="nope_pengunjung" class="form-label">Nomor Ponsel</label>
                                    <input type="text" class="form-control" id="nope_pengunjung"
                                        placeholder="Masukan nomor handphone">
                                </div>
                                <div class="mb-3">
                                    <label for="email_pengunjung" class="form-label">Alamat Email</label>
                                    <input type="email" class="form-control" id="email_pengunjung"
                                        placeholder="Masukan Email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Detail Pengunjung -->

                    <div class="mb-35px">
                        <div class="card rounded-4 border-1 shadow">
                            <div class="card-header d-flex flex-row align-items-center">
                                <h2 class="fw-bold">Total Pembayaran</h2>
                                <h2 class="fw-bold">IDR {{ number_format($paket['price'] * $qty) }}</h2>
                            </div>
                            <div class="card-body d-flex flex-row align-items-center">
                                <span class="fa-solid fa-gem fs-3 text-danger"></span>
                                <span class="ms-3">Kamu akan mendapatkan
                                    {{ \App\Helpers\General::countPoint($paket['price'] * $qty, $service_id) }}
                                    poin</span>
                                <button class="text-light btn btn-danger ms-sm-auto">Lanjutkan Pemesanan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-4">
                <div class="card rounded-4 border-1 shadow fs-5 mb-35px">
                    <div class="card-body p-5">
                        <div class="d-flex flex-row align-items-center">
                            <img src="{{ asset('storage/' . $paket->image->image) }}"
                                onerror="this.src=`{{ asset('images/not_found.jpg') }}`" alt=""
                                width="50" height="50" class="rounded-1">
                            <span
                                class="fw-bold ms-3 text-wrap">{{ $paket['clinic']['clinic_name'] ?? 'Invalid clinic' }}</span>
                            <span class="text-danger ms-sm-auto">Detail Paket</span>
                        </div>
                        <hr class="opacity-25 my-5">
                        <div class="d-flex flex-column">
                            <span>{{ $paket['name'] }}</span>
                            <span>{{ $qty }} tiket <span class="custom-dot-before">{{ $qty }}
                                    Pax</span></span>
                        </div>
                        <hr class="opacity-25 my-5">
                        <div class="d-flex flex-column">
                            <span>Masa Berlaku</span>
                            <span>{{ \App\Helpers\General::getDateShortMonth(now()) }} -
                                {{ \App\Helpers\General::getDateShortMonth(\Carbon\Carbon::now()->addDays($paket['expiry_date'])) }}</span>
                        </div>
                        <hr class="opacity-25 my-5">
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row">
                                <span class="fa-solid fs-3 mb-3 fa-money-bill"></span>
                                <span class="ms-3">Tidak bisa refund</span>
                            </div>
                            <div class="d-flex flex-row">
                                <span class="fa-solid fs-3 mb-3 fa-clock"></span>
                                <span class="ms-3">Berlaku hingga {{ $paket['expiry_date'] }} hari sejak
                                    dibeli</span>
                            </div>
                            <div class="d-flex flex-row">
                                <span class="fa-solid fs-3 mb-3 fa-clock"></span>
                                <span class="ms-3">Reservasi paling lambat 1 hari sebelumnya</span>
                            </div>
                        </div>
                        <hr class="opacity-25 my-5">
                        <div class="d-flex flex-row align-items-center">
                            <span>Total pembayaran</span>
                            <span class="fs-3 ms-sm-auto">IDR {{ number_format($qty * $paket['price']) }}</span>
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

    </section>
</div>
