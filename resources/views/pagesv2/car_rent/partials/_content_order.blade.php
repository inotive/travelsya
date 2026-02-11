<div class="container mb-5">
    <section class="order-details mt-5">

        <div class="row" style="padding-top: 50px;">
            <div class="col-lg-8 col-md-12">

                <div class="section-title mb-4">
                    <h2 class="text-dark">Detail Pemesanan</h2>
                    <div class="subtitle text-capitalize mt-2">Isi formulir dengan benar karena detail pemesanan akan dikirim ke alamat email Anda.</div>
                </div>

                <form action="{{ route('car_rent.request_transaction') }}" method="POST">
                    @csrf
                    <div class="card rounded-4 border-1 shadow mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Detail Kontak Pemesan</h5>
                            <div class="d-flex flex-row align-items-center mb-3">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="customer_call" id="radio_tuan" value="Tuan" required>
                                    <label class="form-check-label" for="radio_tuan">Tuan</label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="customer_call" id="radio_nyonya" value="Nyonya" required>
                                    <label class="form-check-label" for="radio_nyonya">Nyonya</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="customer_call" id="radio_nona" value="Nona" required>
                                    <label class="form-check-label" for="radio_nona">Nona</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Nama Lengkap</label>
                                <input type="text" name="customer_name" class="form-control" value="{{ $user->name }}" placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div class="mb-3">
                                <label for="customer_phone" class="form-label">Nomor Ponsel</label>
                                <input type="text" name="customer_phone" class="form-control" value="{{ $user->phone }}" placeholder="Masukkan nomor ponsel" required>
                            </div>
                            <div class="mb-3">
                                <label for="customer_email" class="form-label">Alamat Email</label>
                                <input type="email" name="customer_email" class="form-control" value="{{ $user->email }}" placeholder="Masukkan alamat email" required>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden fields for transaction -->
                    <input type="hidden" name="package_id" value="{{ $car->id }}">
                    <input type="hidden" name="duration" value="{{ $duration }}">
                    <input type="hidden" name="date" value="{{ $date }}">
                    <input type="hidden" name="service" value="car-rent">
                    <input type="hidden" name="payment" value="xendit">
                    <input type="hidden" name="point" value="0">

                    <div class="card rounded-4 border-1 shadow">
                        <div class="card-header bg-transparent">
                            <h4 class="fw-bold">Total Pembayaran</h4>
                        </div>
                        <div class="card-body d-flex flex-row align-items-center">
                            <div class="d-flex flex-column">
                                <span class="fw-bold fs-4 text-danger">IDR {{ number_format($car->rental_price_per_day * $duration, 0, ',', '.') }}</span>
                                <span class="text-muted">Sudah termasuk pajak</span>
                            </div>
                            <button type="submit" class="btn btn-danger ms-auto">Lanjutkan Pembayaran</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="card rounded-4 border-1 shadow fs-5">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-4">Detail Sewa Mobil</h5>
                        <div class="d-flex flex-row align-items-center mb-3">
                            <img src="{{ $car->image_url ? Storage::url($car->image_url) : 'https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg' }}" 
                                 onerror="this.src='https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg'" 
                                 alt="{{ $car->brand->name }}" 
                                 width="80" height="80" class="rounded-3 me-3 object-fit-cover">
                            <div class="d-flex flex-column">
                                <span class="fw-bold">{{ $car->brand->name }} {{ $car->carModel->name }}</span>
                                <span class="text-muted fs-6">{{ $car->carRental->business_name }}</span>
                            </div>
                        </div>
                        <hr class="opacity-25 my-3">
                        <div class="d-flex flex-column mb-3">
                            <span class="text-muted">Tanggal & Waktu Mulai</span>
                            <span class="fw-bold">{{ \Carbon\Carbon::parse($date)->translatedFormat('l, d F Y, H:i') }}</span>
                        </div>
                        <div class="d-flex flex-column mb-3">
                            <span class="text-muted">Durasi Sewa</span>
                            <span class="fw-bold">{{ $duration }} hari</span>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="text-muted">Kategori</span>
                            <span class="fw-bold">{{ $category }}</span>
                        </div>
                        <hr class="opacity-25 my-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Total Pembayaran</span>
                            <span class="fs-5 text-danger fw-bold">IDR {{ number_format($car->rental_price_per_day * $duration, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>