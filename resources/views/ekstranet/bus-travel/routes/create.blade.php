@extends('layouts.app_ekstranet')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Tambah Rute Bus</h1>
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('partner.dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('partner.bus.routes') }}" class="text-muted text-hover-primary">Daftar Rute Bus</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-dark">Tambah Rute Bus</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">Form Tambah Rute Bus</span>
                            <span class="text-muted mt-1 fw-bold fs-7">Isi data rute bus dengan benar</span>
                        </h3>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('partner.bus.routes.store') }}" method="POST">
                        @csrf
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Nama Kota</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name" class="form-control form-control-lg form-control-solid" placeholder="Masukkan nama kota" value="{{ old('name') }}" required />
                                <div class="form-text">Nama kota akan diubah menjadi huruf kapital secara otomatis.</div>
                            </div>
                        </div>
                        <div class="row mt-6">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-8">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('partner.bus.routes') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
