@extends('ekstranet.layout', ['title' => 'Tambah Jasa Klinik', 'url' => ''])

@section('content-admin')
    <div class="container">
        <!-- Tampilkan error validasi -->
        @if($errors->any())
            <div class="alert alert-danger">
                <h4>Terjadi Kesalahan:</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form id="clinic-form" action="{{ route('clinics.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <div class="col-md-12">
                            <label class="required fs-6 fw-semibold mb-2">Klinik</label>
                            <select class="form-control" name="clinic_id" id="clinic_id" required>
                                <option value="">Pilih Klinik</option>
                                @php
                                    $userClinics = \App\Models\Clinic::where('user_id', Auth::id())->get();
                                @endphp
                                @foreach ($userClinics as $clinic)
                                    <option value="{{ $clinic->id }}" 
                                        {{ old('clinic_id') == $clinic->id ? 'selected' : '' }}>
                                        {{ $clinic->clinic_name }}
                                    </option>
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
                            <input class="form-control form-control-lg" placeholder="Masukan nama jasa" name="name"
                                value="{{ old('name') }}" required />
                            @error('name')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Kategori</label>
                            <select class="form-control" name="categories_services_id" id="categories_services_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('categories_services_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
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
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input id="harga" class="form-control form-control-lg" placeholder="Masukan biaya"
                                    name="price" value="{{ old('price') }}" required />
                            </div>
                            @error('price')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="required fs-6 fw-semibold mb-2">Durasi</label>
                            <input type="number" class="form-control form-control-lg" placeholder="Masukan durasi" 
                                name="duration" value="{{ old('duration') }}" min="1" required />
                            @error('duration')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="required fs-6 fw-semibold mb-2">Tipe Durasi</label>
                            <select class="form-control form-control-lg" name="duration_type" required>
                                <option value="menit" {{ old('duration_type', 'menit') == 'menit' ? 'selected' : '' }}>Menit</option>
                                <option value="jam" {{ old('duration_type') == 'jam' ? 'selected' : '' }}>Jam</option>
                            </select>
                            @error('duration_type')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Masa Berlaku (hari)</label>
                            <input type="number" class="form-control" name="expiry_date" 
                                value="{{ old('expiry_date', 30) }}" min="1" required />
                            @error('expiry_date')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Spesialis</label>
                            <select class="form-control" name="specialist_id" id="specialist_id" required>
                                <option value="">Pilih Spesialis</option>
                                @foreach ($spesialis as $specialist)
                                    <option value="{{ $specialist->id }}"
                                        {{ old('specialist_id', 1) == $specialist->id ? 'selected' : '' }}>
                                        {{ $specialist->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('specialist_id')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Gambar (Multiple)</label>
                            <input type="file" class="form-control form-control-lg" name="images[]" 
                                multiple accept="image/*" id="images" required />
                            <small class="form-text text-muted">Anda dapat memilih beberapa gambar sekaligus (maks. 5MB per gambar)</small>
                            
                            <div id="image-preview" class="mt-2"></div>
                            
                            @if($errors->has('images'))
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $errors->first('images') }}</strong>
                                </span>
                            @endif
                            
                            @if($errors->has('images.*'))
                                <span class="text-danger mt-1" role="alert">
                                    <strong>Terjadi kesalahan dengan salah satu gambar</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-12">
                            <label for="description" class="required form-label">Deskripsi</label>
                            <textarea name="description" cols="30" rows="3" class="form-control" 
                                required>{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="required fs-6 fw-semibold mb-2">Peraturan</label>
                            <textarea name="rules" cols="30" rows="2" class="form-control" 
                                required>{{ old('rules') }}</textarea>
                            @error('rules')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Status</label>
                            <select class="form-control" name="is_active" required>
                                <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('is_active')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

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
            angka = angka.toString().replace(/[^\d]/g, '');
            const number = parseInt(angka);
            
            if (isNaN(number)) return '';
            
            return 'Rp ' + number.toLocaleString('id-ID');
        }

        function parseRupiah(rupiah) {
            return parseInt(rupiah.replace(/[^\d]/g, ''));
        }

        // Format harga saat input
        $('#harga').on('input', function() {
            let input = $(this).val();
            let formatted = formatRupiah(input);
            $(this).val(formatted);
        });

        // Format harga saat halaman dimuat jika ada nilai old
        @if(old('price'))
            $('#harga').val(formatRupiah('{{ old('price') }}'));
        @endif

        $(document).ready(function() {
            // Inisialisasi Select2 untuk kategori
            $('#categories_services_id').select2({
                placeholder: "Pilih atau ketik kategori baru...",
                tags: true,
                allowClear: true
            });
            
            // Inisialisasi Select2 untuk klinik
            $('#clinic_id').select2({
                placeholder: "Pilih klinik...",
                allowClear: true
            });

            // Inisialisasi Select2 untuk spesialis
            $('#specialist_id').select2({
                placeholder: "Pilih spesialis...",
                allowClear: true
            });
            
            // Preview gambar
            $('#images').on('change', function() {
                $('#image-preview').empty();
                var files = this.files;
                
                for (var i = 0; i < files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image-preview').append(
                            '<div class="image-preview-item d-inline-block m-1">' +
                            '<img src="' + e.target.result + '" class="img-thumbnail" width="100">' +
                            '</div>'
                        );
                    }
                    reader.readAsDataURL(files[i]);
                }
            });

            // Validasi form sebelum submit
            $('#clinic-form').on('submit', function() {
                // Parse harga sebelum submit
                let harga = parseRupiah($('#harga').val());
                $('#harga').val(harga);
            });
        });
    </script>
@endpush