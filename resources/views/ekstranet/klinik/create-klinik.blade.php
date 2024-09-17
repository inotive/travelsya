@extends('ekstranet.layout', ['title' => 'Tambah Jasa Klinik', 'url' => ''])

@section('content-admin')
<div class="container">

    <div class="card">
        
        <div class="card-body">
            <form id="clinic-form" action="{{ route('clinics.store') }}" method="POST">
                @csrf
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3">Create Jasa Kecantikan</h1>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <!--begin::Input group-->
                <div class="row g-9 mb-8">
                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Nama</label>
                        <input class="form-control form-control-lg" placeholder="Masukan nama klinik" name="name" required />
                        @error('name')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


    
                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Spesialis</label>
                        <select class="form-control" name="specialist_id" required>
                            @foreach ($spesialis as $specialist)
                                <option value="{{ $specialist->id }}">{{ $specialist->name }}</option>
                            @endforeach
                        </select>
                        
                        @error('specialist_id')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
    
                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Kategori</label>
                        <select class="form-control" name="categories_services_id" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('categories_services_id')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
    
                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Klinik</label>
                        <select class="form-control" name="clinic_id" required>
                            <option value="">Pilih Klinik</option>
                            @foreach ($clinics as $clinic)
                                <option value="{{ $clinic->id }}">{{ $clinic->clinic_name }}</option>
                            @endforeach
                        </select>
                        @error('clinic_id')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    

                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Peraturan</label>
                        <input class="form-control form-control-lg" placeholder="Masukan peraturan" name="rules" required />
                        @error('rules')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    
                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Durasi</label>
                        <input class="form-control form-control-lg" placeholder="Masukan durasi" name="duration" required />
                        @error('duration')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Unit Harga</label>
                        <input class="form-control form-control-lg" placeholder="Masukan unit harga" name="unit_price" required />
                        @error('unit_price')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Tanggal Kadaluarsa</label>
                        <input type="date" class="form-control" name="expiry_date" required />
                        @error('expiry_date')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="col-12">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" cols="30" rows="5" class="form-control" required></textarea>
                    </div>
    
                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Harga</label>
                        <input class="form-control form-control-lg" placeholder="Masukan harga" name="price" required />
                        @error('price')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    
                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Status Aktif</label>
                        <select class="form-control" name="is_active" required>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                        @error('is_active')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                </div>
                <!--end::Input group-->
                <!--begin::Actions-->
                <div class="text-center">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('clinics.index') }}" class="btn btn-light me-3">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label">Simpan</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <!--end::Actions-->
            </form>
        </div>
    </div>
</div>

        
@endsection