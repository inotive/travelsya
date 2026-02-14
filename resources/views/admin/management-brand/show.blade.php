@extends('admin.layout', ['title' => 'Detail Tipe', 'url' => ''])

@section('content-admin')
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Detail Tipe</span>
                <span class="text-muted mt-1 fw-semibold fs-7">Informasi lengkap tipe {{ $brand->name }}</span>
            </h3>
            <div class="card-toolbar">
                <a href="{{ route('admin.brand.index') }}" class="btn btn-sm btn-light-primary">
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
                        <label class="form-label fw-bold">Gambar Tipe</label>
                        <div class="mt-2">
                            @if($brand->image)
                                <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}"
                                     style="width: 200px; height: 200px; object-fit: cover;" class="rounded">
                            @else
                                <div class="symbol symbol-200px">
                                    <div class="symbol-label bg-light-primary text-primary fs-1 fw-bold">
                                        {{ substr($brand->name, 0, 1) }}
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
                                <label class="form-label fw-bold">Nama Tipe</label>
                                <div class="form-control form-control-solid">{{ $brand->name }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-10">
                                <label class="form-label fw-bold">Jumlah Merek</label>
                                <div class="form-control form-control-solid">
                                    <span class="badge badge-light-info fs-6">{{ $brand->carModels->count() }} Merek</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-10">
                                <label class="form-label fw-bold">Tanggal Dibuat</label>
                                <div class="form-control form-control-solid">{{ $brand->created_at->format('d M Y H:i') }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-10">
                                <label class="form-label fw-bold">Terakhir Diupdate</label>
                                <div class="form-control form-control-solid">{{ $brand->updated_at->format('d M Y H:i') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($brand->carModels->count() > 0)
                <div class="separator separator-dashed my-10"></div>
                <div class="mb-10">
                    <h4 class="fw-bold mb-5">Daftar Merek Kendaraan</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Gambar</th>
                                    <th class="text-center">Nama Merek</th>
                                    <th class="text-center">Tanggal Dibuat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($brand->carModels as $carModel)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            @if($carModel->image)
                                                <img src="{{ asset('storage/' . $carModel->image) }}" alt="{{ $carModel->name }}"
                                                     style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                            @else
                                                <div class="symbol symbol-50px">
                                                    <div class="symbol-label bg-light-info text-info fs-6 fw-bold">
                                                        {{ substr($carModel->name, 0, 1) }}
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $carModel->name }}</td>
                                        <td class="text-center">{{ $carModel->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
        <!--end::Body-->
    </div>
@endsection
