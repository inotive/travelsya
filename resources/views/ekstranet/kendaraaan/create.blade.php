@extends('ekstranet.layout', ['title' => 'Daftar Kendaraan Create Data', 'url' => '#'])

@section('content-admin')
    {{-- FORM CREATE --}}
    <div class="card ">
        <div class="card-header">
            <h1 class="card-title fw-bold">
               Tambah Mobil
            </h1>
        </div>
        <div class="card-body">
            <!--begin:Form-->
            <form action="{{ route('partner.kendaraan.create') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Merk</label>
                        <select class="form-control" id="brand_id" name="brand_id">
                            <option value="">Pilih Merk</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                        <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="hidden" value="1">
                    </div>

                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Model</label>
                        <select class="form-control" id="car_model_id" name="car_model_id">
                            <option value="">Pilih Model</option>
                            @foreach ($car_models as $car_model)
                                <option value="{{ $car_model->id }}">{{ $car_model->name }}</option>
                            @endforeach
                        </select>
                        @error('car_model_id')
                        <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="hidden" value="1">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Tipe</label>
                        <select class="form-control" id="category" name="category">
                            <option value="">Pilih Tipe</option>
                            <option value="manual">Manual</option>
                            <option value="automatic">Matic</option>
                        </select>
                        @error('category')
                        <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="hidden" value="1">
                    </div>

                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Kategori Rental</label>
                        <select class="form-control" id="category_rent" name="category_rent">
                            <option value="">Pilih Kategori Rental</option>
                            <option value="Dengan Driver">Dengan Driver</option>
                            <option value="Tidak Dengan Driver">Tidak Dengan Driver</option>
                        </select>
                        @error('category_rent')
                        <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="hidden" value="1">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Biaya Sewa</label>
                        <input class="form-control form-control-lg" id="rental_price_per_day"
                               placeholder="Masukkan Biaya Sewa" name="rental_price_per_day" required />

                        @error('rental_price_per_day')
                        <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Durasi</label>
                        <input class="form-control form-control-lg" id="duration"
                               placeholder="Berapa Lama Durasi" name="duration" required />

                        @error('duration')
                        <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Tahun</label>
                        <select class="form-control" id="years" name="years">
                                <?php
                                $result_arr_['years'] = "2019";
                                if($result_arr_['years'] == true){
                                    $selected_year = "selected";
                                }else{
                                    $selected_year = " ";
                                }

                            for ($years = (int)date('Y'); 1900 <= $years; $years--): ?>
                            <option value="<?=$years;?>" <?php echo $selected_year;?>><?=$years;?></option>
                            <?php endfor; ?>
                        </select>
                        @error('policy_id')
                        <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="hidden" value="1">
                    </div>

                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Jumlah Kursi</label>
                        <input class="form-control form-control-lg" id="number_seats"
                               placeholder="Masukkan Jumlah Kursi" name="number_seats" required />

                        @error('number_seats')
                        <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="">Pilih Status Rental</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>

                        @error('status')
                        <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="hidden" value="1">
                    </div>

                    <div class="form-group">
                        <label class="fs-6 fw-semibold mb-2">Gambar</label>
                        <input type="file" class="form-control" id="image" name="image_url">

                        @error('image')
                        <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="hidden" value="1">
                    </div>
                </div>

                <div class="col-12">
                    <label for="" class="form-label">Peraturan</label>
                    <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                </div>

                <div class="button-group">
                    <button type="reset" class="btn btn-secondary">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<style>


    .active {
        background: #007bff;
        color: white;
    }

    .breadcrumb {
        margin-bottom: 20px;
    }

    .form-container {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 20px;
    }

    .form-row {
        display: flex;
        margin-bottom: 15px;
    }

    .form-group {
        flex: 1;
        margin-right: 15px;
    }

    .form-group:last-child {
        margin-right: 0;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    select,
    input,
    textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    textarea {
        height: 100px;
    }

    .button-group {
        text-align: right;
        margin-top: 20px;
    }

    button {
        padding: 10px 20px;
        margin-left: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .primary {
        background: #007bff;
        color: white;
    }
</style>
