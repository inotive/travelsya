@extends('layouts.app_v2')

@section('content')
    @include('pagesv2.bus_travel.partials._second_nav')

    <div class="container my-5 mb-50">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('bus_travel.search') }}" method="POST">
                    @csrf
                    <div class="row justify-content-between">
                        <div class="col-12 col-md-10">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-none">
                                    <i class="fa-solid fa-search"></i>
                                </span>
                                <select name="kota_awal" class="form-control border-none max-w-120 py-0"
                                    placeholder="Kota Awal">
                                    <option value="">Kota Awal</option>
                                    @foreach ($city as $c)
                                        <option value="{{ $c }}" {{ $kota_awal == $c ? 'selected' : '' }}>
                                            {{ $c }}</option>
                                    @endforeach
                                </select>
                                <span class="input-group-text border-none bg-light">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </span>
                                <select name="kota_tujuan" class="form-control border-none border-right-2 max-w-120 py-0"
                                    placeholder="Kota Tujuan">
                                    <option value="">Kota Tujuan</option>
                                    @foreach ($city as $c)
                                        <option value="{{ $c }}" value="{{ $c }}"
                                            {{ $kota_tujuan == $c ? 'selected' : '' }}>{{ $c }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="date_pergi" onfocus="(this.type='date')"
                                    class="form-control border-none max-w-150 py-0 border-right-2"
                                    placeholder="Tgl Berangkat" value="{{ $date_pergi }}" />
                                <input type="number" name="jumlah_penumpang" min="1"
                                    class="form-control border-none py-0 max-w-50 pe-0" placeholder="Jumlah Tiket"
                                    value="{{ $jumlah_penumpang }}" />
                                <div class="d-flex align-items-center">Kursi</div>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 d-flex align-items-center justify-content-end">
                            <button type="submit" class="btn btn-sm btn-light-danger">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('pagesv2.bus_travel.partials._filter_search')

    @include('pagesv2.bus_travel.partials._bus_list')
@endsection
