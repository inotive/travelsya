@extends('layouts.app_ekstranet')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Edit Jadwal Keberangkatan</h1>
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('partner.dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('partner.bus.departures') }}" class="text-muted text-hover-primary">Jadwal Keberangkatan</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-dark">Edit Jadwal</li>
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
                            <span class="card-label fw-bolder fs-3 mb-1">Form Edit Jadwal Keberangkatan</span>
                            <span class="text-muted mt-1 fw-bold fs-7">Perbarui data jadwal keberangkatan dengan benar</span>
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
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ route('partner.bus.departures.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $departure->id }}">
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Bus</label>
                            <div class="col-lg-8 fv-row">
                                <select name="bus_travel_has_bus_id" class="form-select form-select-solid form-select-lg" required>
                                    <option value="">Pilih Bus</option>
                                    @foreach($buses as $id => $name)
                                        <option value="{{ $id }}" {{ old('bus_travel_has_bus_id', $departure->bus_travel_has_bus_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Kota Keberangkatan</label>
                            <div class="col-lg-8 fv-row">
                                <select name="from_city_id" class="form-select form-select-solid form-select-lg" required>
                                    <option value="">Pilih Kota Keberangkatan</option>
                                    @foreach($cities as $id => $name)
                                        <option value="{{ $id }}" {{ old('from_city_id', $departure->from_city_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Kota Tujuan</label>
                            <div class="col-lg-8 fv-row">
                                <select name="to_city_id" class="form-select form-select-solid form-select-lg" required>
                                    <option value="">Pilih Kota Tujuan</option>
                                    @foreach($cities as $id => $name)
                                        <option value="{{ $id }}" {{ old('to_city_id', $departure->to_city_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Titik Naik</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="titik_naik" class="form-control form-control-lg form-control-solid" placeholder="Masukkan titik naik" value="{{ old('titik_naik', $departure->titik_naik) }}" required />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Titik Turun</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="titik_turun" class="form-control form-control-lg form-control-solid" placeholder="Masukkan titik turun" value="{{ old('titik_turun', $departure->titik_turun) }}" required />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Tanggal Keberangkatan</label>
                            <div class="col-lg-8 fv-row">
                                <input type="date" name="departure_date" class="form-control form-control-lg form-control-solid" value="{{ old('departure_date', \Carbon\Carbon::parse($departure->departure_time)->format('Y-m-d')) }}" required />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Waktu Keberangkatan</label>
                            <div class="col-lg-8 fv-row">
                                <input type="time" name="departure_time" class="form-control form-control-lg form-control-solid" value="{{ old('departure_time', \Carbon\Carbon::parse($departure->departure_time)->format('H:i')) }}" required />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Durasi Perjalanan (Jam)</label>
                            <div class="col-lg-8 fv-row">
                                <input type="number" name="duration" class="form-control form-control-lg form-control-solid" placeholder="Masukkan durasi perjalanan dalam jam" value="{{ old('duration', $departure->duration) }}" min="1" required />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Harga Tiket (Rp)</label>
                            <div class="col-lg-8 fv-row">
                                <input type="number" name="price" class="form-control form-control-lg form-control-solid" placeholder="Masukkan harga tiket" value="{{ old('price', $departure->price) }}" min="1000" required />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Hari Operasional</label>
                            <div class="col-lg-8 fv-row">
                                <div class="d-flex flex-wrap">
                                    @php $departureDays = explode(',', $departure->days); @endphp
                                    <div class="form-check form-check-custom form-check-solid me-5 mb-2">
                                        <input class="form-check-input" type="checkbox" name="days[]" value="0" id="day0" {{ in_array('0', $departureDays) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="day0">Minggu</label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid me-5 mb-2">
                                        <input class="form-check-input" type="checkbox" name="days[]" value="1" id="day1" {{ in_array('1', $departureDays) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="day1">Senin</label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid me-5 mb-2">
                                        <input class="form-check-input" type="checkbox" name="days[]" value="2" id="day2" {{ in_array('2', $departureDays) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="day2">Selasa</label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid me-5 mb-2">
                                        <input class="form-check-input" type="checkbox" name="days[]" value="3" id="day3" {{ in_array('3', $departureDays) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="day3">Rabu</label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid me-5 mb-2">
                                        <input class="form-check-input" type="checkbox" name="days[]" value="4" id="day4" {{ in_array('4', $departureDays) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="day4">Kamis</label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid me-5 mb-2">
                                        <input class="form-check-input" type="checkbox" name="days[]" value="5" id="day5" {{ in_array('5', $departureDays) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="day5">Jumat</label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid me-5 mb-2">
                                        <input class="form-check-input" type="checkbox" name="days[]" value="6" id="day6" {{ in_array('6', $departureDays) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="day6">Sabtu</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-6">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-8">
                                <button type="submit" class="btn btn-primary">Perbarui</button>
                                <a href="{{ route('partner.bus.departures') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
