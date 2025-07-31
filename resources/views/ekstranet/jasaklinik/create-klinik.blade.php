@extends('ekstranet.layout', ['title' => 'Tambah Jasa Klinik', 'url' => ''])

@section('content-admin')
    <div class="container">

        <div class="card">

            <div class="card-body">
                <form id="clinic-form" action="{{ route('clinics.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <div class="col-md-12">
                            <label class="required fs-6 fw-semibold mb-2">Klinik</label>
                            <select class="form-control" name="clinic_id" required>
                                @php
                                    $userClinics = \App\Models\Clinic::where('user_id', Auth::id())->get();
                                @endphp
                                @foreach ($userClinics as $clinic)
                                    <option value="{{ $clinic->id }}" {{ old('clinic_id') === $clinic->id ? 'selected' : '' }} >{{ $clinic->clinic_name }}</option>
                                @endforeach
                            </select>
                            @error('clinic_id')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Nama Jasa</label>
                            <input class="form-control form-control-lg" placeholder="Masukan nama jasa" name="name" value="{{ old('name') }}"
                                required />
                            @error('name')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Kategori</label>
                            <select class="form-control" name="categories_services_id" id="categories_services_id" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('categories_services_id') === $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('categories_services_id')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>





                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Biaya</label>
                            <input id="harga" class="form-control form-control-lg" placeholder="Masukan biaya" name="price" value="{{ old('price') }}"
                                required />
                            @error('price')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="required fs-6 fw-semibold mb-2">Durasi</label>
                            <input class="form-control form-control-lg" placeholder="Masukan durasi" name="duration" value="{{ old('duration') }}"
                                required />
                            @error('duration')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="required fs-6 fw-semibold mb-2">Tipe Durasi</label>
                            <select class="form-control form-control-lg" name="duration_type" required>
                                <option value="menit" {{ old('duration_type') === 'menit' ? 'selected' : '' }}>Menit</option>
                                <option value="jam" {{ old('duration_type') === 'jam' ? 'selected' : '' }}>Jam</option>
                            </select>
                            @error('duration_type')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Masa Berlaku (hari)</label>
                            <input type="number" class="form-control" name="expiry_date" value="{{ old('expiry_date') }}" required />
                            @error('expiry_date')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <input type="hidden" name="specialist_id" value="1">


                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Gambar (Multiple)</label>
                            <input type="file" class="form-control form-control-lg" name="images[]" value="{{ old('images') }}" multiple accept="image/*" />
                            <small class="form-text text-muted">Anda dapat memilih beberapa gambar sekaligus</small>
                            <div class="mt-1">
                                @error('images')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>


                        <div class="col-12">
                            <label for="description" class="required form-label">Deskripsi</label>
                            <textarea name="description" cols="30" rows="3" class="form-control" required>{{ old('description') }}</textarea>
                        </div>

                        <div class="col-12">
                            <label class="required fs-6 fw-semibold mb-2">Peraturan</label>
                            <textarea name="rules" cols="30" rows="2" class="form-control" required>{{ old('rules') }}</textarea>
                        </div>

                        <input type="hidden" name="is_active" value="1">

                        <!-- Clinic ID is now selected from dropdown -->

                        <input type="hidden" name="unit_price" value="unit_price">
                    </div>
                    <!--end::Input group-->

                    <!--begin::Actions-->
                    <div class="text-center">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <a href="{{ route('clinics.list') }}" class="btn btn-light w-100 me-3">
                                    <span class="indicator-label">Batal</span>
                                </a>
                                {{-- <button type="reset" class="btn btn-light w-100" onclick="history.back()">Batal</button> --}}
                            </div>
                            <div class="col-6">
                                <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary w-100">
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

@push('add-script')
    <script>
        function formatRupiah(angka, prefix) {
            angka = angka.toString().replace(/[^,\d]/g, '');
            const split = angka.split(',');
            const sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            const ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                const separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix !== undefined ? prefix + rupiah : rupiah;
        }


        $('#harga').on('input', function () {
            let input = $(this).val();
            let formatted = formatRupiah(input, 'Rp. ');
            $(this).val(formatted);
        });

        $(document).ready(function() {
            $('#categories_services_id').select2({
                tags: true
            });
        });
    </script>
@endpush
