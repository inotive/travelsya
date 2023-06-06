@extends('admin.layout',['title' => 'Daftar Hotel',"url" => "#"])

@section('content-admin')
    <!--begin::Row-->
    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-sm-12">
            <div class="card  card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <div class="row">
                        <div class="col-9">
                            <label class="form-label">Nama Hotel</label>
                                <input type="text" class="form-control" placeholder="name@example.com">
                        </div>
                        <div class="col-3">
                            <label class="form-label">Bintang</label>
                            <select name="" id="" class="form-control form-control-lg">
                                <option value="">Bintang 1</option>
                                <option value="">Bintang 2</option>
                                <option value="">Bintang 3</option>
                                <option value="">Bintang 4</option>
                                <option value="">Bintang 5</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Alamat</label>
                        </div>
                    </div>
                </div>
                <!--end:: Body-->
            </div>
        </div>
        <!--end::Col-->
    </div>
@endsection
