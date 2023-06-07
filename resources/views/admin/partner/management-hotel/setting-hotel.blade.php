@extends('admin.layout',['title' => 'Setting Hotel - Hotel A' ,"url" => "#"])

@section('content-admin')
    <!--begin::Row-->
    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-sm-12">
            <div class="card  card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <div class="row gy-3">
                        <div class="col-8">
                            <label class="form-label">Nama Hotel</label>
                                <input type="text" name="hotelname" class="form-control" placeholder="Masukan Nama Hotel">
                        </div>
                        <div class="col-4">
                            <label class="form-label">Bintang</label>
                            <select name="rating" id="" class="form-control form-control-lg">
                                <option value="1">Bintang 1</option>
                                <option value="2">Bintang 2</option>
                                <option value="3">Bintang 3</option>
                                <option value="4">Bintang 4</option>
                                <option value="5">Bintang 5</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Nomor Telfon</label>
                            <input type="number" name="no_telp" class="form-control" placeholder="Masukan nomor telfon">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Email</label>
                            <input type="number" name="email" class="form-control" placeholder="Masukan Email">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" cols="2" rows="3" placeholder="Masukan Alamat"></textarea>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Check In</label>
                            <input type="time" name="check_in" id="check_in" class="form-control">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Check Out</label>
                            <input type="time" name="check_out" id="check_in" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Website</label>
                            <input type="text" name="website" id="check_in" class="form-control" placeholder="Masukan Alamat Website Berupa URL">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Status</label>
                            <select name="state" id="" class="form-control">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!--end:: Body-->
                <div class="card-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary w-50">Simpan Data</button>
                    <button type="button" class="btn btn-outline btn-outline btn-outline-secondary me-3 text-dark btn-active-light-secondary w-50">Back</button>
                </div>
            </div>
        </div>
        <!--end::Col-->
    </div>
@endsection
