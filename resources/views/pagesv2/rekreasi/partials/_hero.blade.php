<section class="hero-wrapper position-relative" style="margin-bottom: 75px;">
    <img src="{{ asset('images/rekreasi.jpeg') }}" alt="travelsya rekreasi" class="hero-img" height="100%" width="100%">
    <div class="hero-item-wrapper row position-absolute w-100 mx-auto">
        <div class="col-12 banner-title col-md-6">
            <span class="badge badge-custom-hero">Rekreasi</span>
            <h1 class="banner-text-title mt-5 text-white fw-bold">Waktu Santai Bersama Keluarga</h1>
        </div>
        <div class="col-12 col-md-6 banner-search">
            <div class="search-banner-wrapper w-500px">
                <div class="card card-body">

                    <form
                        action="{{ route('rekreasi.show', ['date' => \Carbon\Carbon::now()->addDays()->format('Y-m-d')]) }}"
                        method="post">
                        @csrf
                        <div class="input-group mb-5">
                            @php
                                $cities = \App\Models\Recreation::pluck('city')->toArray(); // Ubah ke array
                                $cityList = \App\Models\City::whereIn('city_id', $cities)->get(); // Query data sesuai ID
                            @endphp
                            <select name="lokasi" id="location" class="form-select select" data-control="select2"
                                    data-placeholder="Pilih Lokasi" autocomplete="on">
                                @foreach($cityList as $city)
                                    <option value="{{ $city->city_name }}">{{ $city->city_name }}</option>
                                @endforeach
                            </select>

                            {{--                            <input type="text" class="form-control" name="lokasi" placeholder="Mau rekreasi dimana?" />--}}

                        </div>
                        <div class="input-group mb-5">
                            <span class="input-group-text bg-transparent">
                                <i class="fa-solid fa-calendar-days"></i>
                            </span>
                            <input type="text" name="date" onfocus="(this.type='date')" class="form-control"
                                placeholder="Tanggal reservasi" aria-label="Username" aria-describedby="basic-addon1" />
                        </div>
                        <button type="submit" class="btn btn-danger w-100 fw-semibold bg-main">Cari Sekarang</button>
                        {{-- <a href="{{ route('register') }}" class="btn btn-danger w-100 fw-semibold bg-main">Cari
                            Sekarang</a> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
