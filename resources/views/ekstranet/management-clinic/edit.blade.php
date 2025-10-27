@extends('ekstranet.layout', ['title' => 'Edit Profil Health & Beauty', 'url' => route('partner.management.clinic')])

@section('content-admin')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('partner.management.clinic.update', $clinic->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-9 mb-8">
                        <div class="col-md-12">
                            <label class="required fs-6 fw-semibold mb-2">Nama Klinik</label>
                            <input type="text" class="form-control form-control-lg" id="clinic_name" name="clinic_name" value="{{ old('clinic_name', $clinic->clinic_name) }}" required />
                            @error('clinic_name')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Nomor Telepon</label>
                            <input type="text" class="form-control form-control-lg" id="phone" name="phone" value="{{ old('phone', $clinic->phone) }}" required />
                            @error('phone')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Status Aktif</label>
                            <select class="form-select form-select-solid" name="is_active" id="is_active" required>
                                <option value="1" {{ old('is_active', $clinic->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('is_active', $clinic->is_active) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('is_active')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="required fs-6 fw-semibold mb-2">Kota</label>
                            <select class="js-example-basic-single form-control form-control-lg" name="city" id="city" required>
                                @foreach($cities ?? [] as $city)
                                    <option value="{{ $city->city_id }}" {{ old('city', $clinic->city) == $city->city_id ? 'selected' : '' }}>
                                        {{ $city->city_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('city')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="required fs-6 fw-semibold mb-2">Kategori</label>
                            <div class="btn-group w-100" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                                @foreach (App\Models\Clinic::CATEGORY as $key => $value)
                                    <label class="btn btn-outline btn-danger {{ (old('category', $clinic->category) == $key) ? 'active' : '' }}" data-kt-button="true">
                                        <input class="btn-check" type="radio" name="category" value="{{ $key }}" {{ (old('category', $clinic->category) == $key) ? 'checked' : '' }} required />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>
                            @error('category')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="address" class="required form-label">Alamat</label>
                            <textarea id="address" name="address" cols="30" rows="5" class="form-control" required>{{ old('address', $clinic->address) }}</textarea>
                            @error('address')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Jam Buka</label>
                            <input type="time" class="form-control form-control-lg" id="open_time" name="open" value="{{ old('open', $clinic->open) }}" required />
                            @error('open')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Jam Tutup</label>
                            <input type="time" class="form-control form-control-lg" id="close_time" name="close" value="{{ old('close', $clinic->close) }}" required />
                            @error('close')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="description" class="required form-label">Deskripsi</label>
                            <textarea id="description" name="description" cols="30" rows="5" class="form-control" required>{{ old('description', $clinic->description) }}</textarea>
                            @error('description')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="highlight" class="required form-label">Highlight</label>
                            <textarea id="highlight" name="highlight" cols="30" rows="3" class="form-control">{{ old('highlight', $clinic->highlight) }}</textarea>
                            @error('highlight')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Latitude</label>
                            <input type="text" class="form-control form-control-lg" id="lat" name="lat" placeholder="Masukan latitude (contoh: -6.200000)" 
                                   pattern="^-?([1-8]?[0-9](\.[0-9]+)?|90(\.0+)?)$" title="Masukkan latitude yang valid (-90 sampai 90)" value="{{ old('lat', $clinic->lat) }}" required />
                            @error('lat')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Longitude</label>
                            <input type="text" class="form-control form-control-lg" id="ltd" name="ltd" placeholder="Masukan longitude (contoh: 106.816666)" 
                                   pattern="^-?((1[0-7][0-9])|([1-9]?[0-9]))(\.[0-9]+)?$" title="Masukkan longitude yang valid (-180 sampai 180)" value="{{ old('ltd', $clinic->ltd) }}" required />
                            @error('ltd')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <a href="{{ route('partner.management.clinic') }}" class="btn btn-light w-100 me-3">
                                    <span class="indicator-label">Batal</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary w-100">
                                    <span class="indicator-label">Simpan</span>
                                    <span class="indicator-progress">Mohon tunggu...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('add-script')
    <script>
        // Initialize select2 for city selection if available
        $(document).ready(function() {
            if ($('.js-example-basic-single').length) {
                $('.js-example-basic-single').select2();
            }
        });
    </script>
@endpush