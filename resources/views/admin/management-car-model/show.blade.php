@extends('admin.layout', ['title' => 'Detail Merek Kendaraan', 'url' => ''])

@section('content-admin')
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Detail Merek Kendaraan</span>
                <span class="text-muted mt-1 fw-semibold fs-7">Informasi lengkap merek kendaraan {{ $carModel->name }}</span>
            </h3>
            <div class="card-toolbar">
                <a href="{{ route('admin.car-model.index') }}" class="btn btn-sm btn-light-primary">
                    <i class="ki-duotone ki-arrow-left fs-2"></i>Kembali
                </a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-10">
                        <label class="form-label fw-bold">Gambar Merek</label>
                        <div class="mt-2">
                            @if($carModel->image)
                                <img src="{{ asset('storage/' . $carModel->image) }}" alt="{{ $carModel->name }}"
                                     style="width: 200px; height: 200px; object-fit: cover;" class="rounded">
                            @else
                                <div class="symbol symbol-200px">
                                    <div class="symbol-label bg-light-info text-info fs-1 fw-bold">
                                        {{ substr($carModel->name, 0, 1) }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-10">
                                <label class="form-label fw-bold">Nama Merek</label>
                                <div class="form-control form-control-solid">{{ $carModel->name }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-10">
                                <label class="form-label fw-bold">Tipe</label>
                                <div class="form-control form-control-solid">
                                    <span class="badge badge-light-primary fs-6">{{ $carModel->brand->name }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-10">
                                <label class="form-label fw-bold">Tanggal Dibuat</label>
                                <div class="form-control form-control-solid">{{ $carModel->created_at->format('d M Y H:i') }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-10">
                                <label class="form-label fw-bold">Terakhir Diupdate</label>
                                <div class="form-control form-control-solid">{{ $carModel->updated_at->format('d M Y H:i') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($carModel->vendor->count() > 0)
                <div class="separator separator-dashed my-10"></div>
                <div class="mb-10">
                    <h4 class="fw-bold mb-5">Digunakan dalam {{ $carModel->vendor->count() }} Kendaraan Rental</h4>
                    <div class="alert alert-info">
                        <i class="ki-duotone ki-information-5 fs-2x text-info me-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        <div class="d-flex flex-column">
                            <h4 class="mb-1 text-info">Informasi</h4>
                            <span>Merek kendaraan ini sedang digunakan dalam {{ $carModel->vendor->count() }} kendaraan rental.
                                  Data tidak dapat dihapus selama masih digunakan.</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <!--end::Body-->
    </div>
@endsection
