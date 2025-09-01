<div class="container-fluid p-4" style="background: #f8f9fa;">
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- Header with Logo -->
            <div class="card mb-3" style="background: linear-gradient(135deg, #c02425 0%, #e74c3c 100%); border-radius: 15px;">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="/assets/media/logos/logo.png" style="max-height: 40px;" alt="Logo" class="me-3">
                            <div class="text-white">
                                <h5 class="mb-0 fw-bold">TRAVELSYA</h5>
                                <small>Bus Travel e-Ticket</small>
                            </div>
                        </div>
                        <div class="text-white text-end">
                            <div class="fs-6 fw-bold">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
                            <small>Invoice #{{ $data->booking_id }}</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bus Travel Info -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="fw-bold text-primary mb-2">{{ $data->busTravel->business_name ?? 'Bus Travel' }}</h4>
                            <p class="text-muted mb-2">{{ $data->busTravel->address ?? '' }}</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <small class="text-muted">Keberangkatan</small>
                                        <div class="fw-bold text-primary">
                                            {{ \Carbon\Carbon::parse($data->departure_time)->translatedFormat('d F Y H:i') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <small class="text-muted">Durasi</small>
                                        <div class="fw-bold text-primary">{{ $data->duration ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="bg-light rounded p-3">
                                <div class="fs-4 fw-bold text-success">
                                    Rp {{ number_format($data->price + $data->fee_admin, 0, ',', '.') }}
                                </div>
                                <small class="text-muted">Total Pembayaran</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Information -->
            <div class="card mb-3">
                <div class="card-header bg-light">
                    <h6 class="mb-0 fw-bold">Informasi Booking</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <small class="text-muted">Kode Booking</small>
                            <div class="fw-bold">{{ $data->booking_id }}</div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Tanggal Booking</small>
                            <div class="fw-bold">
                                {{ \Carbon\Carbon::parse($data->transaction->created_at)->translatedFormat('d F Y H:i') }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Rute</small>
                            <div class="fw-bold">{{ $data->from ?? '-' }} → {{ $data->to ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bus Information -->
            <div class="card mb-3">
                <div class="card-header bg-light">
                    <h6 class="mb-0 fw-bold">Informasi Bus</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <small class="text-muted">Nama Bus</small>
                            <div class="fw-bold">{{ $data->busTravelHasBus->name ?? '-' }}</div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Kelas</small>
                            <div class="fw-bold">{{ $data->busTravelHasBus->class ?? '-' }}</div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Kapasitas</small>
                            <div class="fw-bold">{{ $data->busTravelHasBus->number_seats ?? '-' }} Kursi</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Passenger Information -->
            <div class="card mb-3">
                <div class="card-header bg-light">
                    <h6 class="mb-0 fw-bold">Informasi Penumpang</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <small class="text-muted">Nama</small>
                            <div class="fw-bold">{{ $data->customer_name ?? $data->transaction->user->name ?? '-' }}</div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Telepon</small>
                            <div class="fw-bold">{{ $data->customer_phone ?? $data->transaction->user->phone ?? '-' }}</div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Email</small>
                            <div class="fw-bold">{{ $data->customer_email ?? $data->transaction->user->email ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Details -->
            <div class="card mb-3">
                <div class="card-header bg-light">
                    <h6 class="mb-0 fw-bold">Rincian Pembayaran</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Biaya Tiket:</span>
                                <span>Rp {{ number_format($data->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Biaya Admin:</span>
                                <span>Rp {{ number_format($data->fee_admin, 0, ',', '.') }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold fs-5">
                                <span>Total:</span>
                                <span class="text-success">Rp {{ number_format($data->price + $data->fee_admin, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-light rounded p-3">
                                <small class="text-muted">Status</small>
                                <div class="fw-bold text-success">{{ $data->transaction->status }}</div>
                                <small class="text-muted mt-2 d-block">Metode Pembayaran</small>
                                <div class="fw-bold">{{ $data->transaction->payment_method }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Important Notes -->
            <div class="card">
                <div class="card-header" style="background: #fff3cd;">
                    <h6 class="mb-0 fw-bold text-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>Catatan Penting
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-1"><i class="fas fa-clock text-primary me-2"></i>Harap datang 30 menit sebelum keberangkatan</li>
                                <li class="mb-1"><i class="fas fa-id-card text-primary me-2"></i>Bawa identitas diri (KTP/SIM) yang masih berlaku</li>
                                <li class="mb-1"><i class="fas fa-ban text-primary me-2"></i>Tiket tidak dapat dikembalikan atau ditukar</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-1"><i class="fas fa-heart text-primary me-2"></i>Pastikan kondisi kesehatan fit untuk perjalanan</li>
                                <li class="mb-1"><i class="fas fa-suitcase text-primary me-2"></i>Barang bawaan menjadi tanggung jawab penumpang</li>
                                <li class="mb-1"><i class="fas fa-shield-alt text-primary me-2"></i>Patuhi protokol kesehatan selama perjalanan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="text-center mt-4 p-3" style="background: linear-gradient(135deg, #c02425 0%, #e74c3c 100%); border-radius: 15px;">
                <div class="row text-white">
                    <div class="col-md-4">
                        <i class="fab fa-whatsapp fs-4 mb-2"></i>
                        <div>085247213909</div>
                    </div>
                    <div class="col-md-4">
                        <i class="fas fa-envelope fs-4 mb-2"></i>
                        <div>travelsyawisataindonesia@gmail.com</div>
                    </div>
                    <div class="col-md-4">
                        <i class="fas fa-globe fs-4 mb-2"></i>
                        <div>www.travelsya.com</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
