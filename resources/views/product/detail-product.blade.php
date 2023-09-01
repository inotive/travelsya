@extends('layouts.web')

@section('content-web')
    <div class="container-xl">
        {{--        <div class="card"> --}}
        {{--            <div class="card-body"> --}}
        {{--                <div class="row g-4"> --}}
        {{--                    <div class="col-6"> --}}
        {{--                        <h6>Nomor Telfon</h6> --}}
        {{--                        <input type="text" class="form-control form-control-lg" value="08125329031" disabled> --}}
        {{--                    </div> --}}
        {{--                    <div class="col-6"> --}}
        {{--                        <h6>Pulsa</h6> --}}
        {{--                        <input type="text" class="form-control form-control-lg" value="{{number_format(50000,0,',','.')}}" disabled> --}}
        {{--                    </div> --}}
        {{--                    <div class="col-12"> --}}
        {{--                        <h6>Biaya Admin</h6> --}}
        {{--                        <input type="text" class="form-control form-control-lg" value="{{number_format(2500,0,',','.')}}" disabled> --}}
        {{--                    </div> --}}
        {{--                    <div class="col-12"> --}}
        {{--                        <button class="btn btn-danger w-100">Lanjut ke Pembayaran</button> --}}
        {{--                        <button class="btn btn-outline-light text-dark w-100 mt-3">Kembali</button> --}}
        {{--                    </div> --}}
        {{--                </div> --}}
        {{--            </div> --}}
        {{--        </div> --}}
        <div class="card">
            <div class="card-body">
                <div class="row g-5">
                    <div class="col-6">
                        <h6>Nomor Telfon</h6>
                        <input type="text" class="form-control form-control-lg" value="08125329031" disabled>
                    </div>
                    <div class="col-6">
                        <h6>Kategori</h6>
                        <input type="text" class="form-control form-control-lg" value="Pulsa" disabled>
                    </div>
                    <div class="col-6">
                        <h6>Nominal</h6>
                        <input type="text" class="form-control form-control-lg"
                            value="{{ number_format(50000, 0, ',', '.') }}" disabled>
                    </div>
                    <div class="col-6">
                        <h6>Biaya Admin</h6>
                        <input type="text" class="form-control form-control-lg"
                            value="{{ number_format(2500, 0, ',', '.') }}" disabled>
                    </div>
                    <div class="col-12">
                        <h6>Grand Total</h6>
                        <h3 class="fw-bold text-success">{{ number_format(50000 + 2500, 0, ',', '.') }}</h3>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-danger w-100">Lanjut ke Pembayaran</button>
                        <button class="btn btn-outline-light text-dark w-100 mt-3">Kembali</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
