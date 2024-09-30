@extends('ekstranet.layout', ['title' => 'Tambah Jasa Klinik', 'url' => ''])

@section('content-admin')
<div class="container">

    <div class="card">
        
        <div class="card-body">
            <form id="clinic-form" action="{{ route('clinics.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label class="required fs-6 fw-semibold mb-2">Nama Jasa</label>
                        <input class="form-control form-control-lg" placeholder="Masukan nama jasa" name="name" required />
                        @error('name')
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
    
                
                    
                    <input type="hidden" name="clinid_id" value="0">

                    
                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Biaya</label>
                        <input class="form-control form-control-lg" placeholder="Masukan biaya" name="price" required />
                        @error('price')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="col-md-3">
                        <label class="required fs-6 fw-semibold mb-2">Durasi</label>
                        <input class="form-control form-control-lg" placeholder="Masukan durasi" name="duration" required />
                        @error('duration')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="required fs-6 fw-semibold mb-2">Tipe Durasi</label>
                        <select class="form-control form-control-lg" name="unit_price" required>
                            <option value="menit">Menit</option>
                            <option value="jam">Jam</option>
                        </select>
                        @error('unit_price')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    

                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Masa Berlaku (hari)</label>
                        <input type="number" class="form-control" name="expiry_date" required />
                        @error('expiry_date')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    
                    <input type="hidden" name="specialist_id" value="1">


                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Gambar</label>
                        <input type="file" class="form-control form-control-lg" name="image" required />
                    </div>


                    <div class="col-12">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" cols="30" rows="3" class="form-control" required></textarea>
                    </div>
    

                    <div class="col-12">
                        <label class="required fs-6 fw-semibold mb-2">Peraturan</label>
                        <textarea name="rules" cols="30" rows="2" class="form-control" required></textarea>
                    </div>


                    <input type="hidden" name="is_active" value="1">

                    <input type="hidden" name="clinic_id" value="1">
                    
                </div>
                <!--end::Input group-->
                <!--begin::Actions-->
                <div class="text-center">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('clinics.list') }}" class="btn btn-light me-3">Cancel</a>
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