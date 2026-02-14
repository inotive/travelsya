<div id="kt_content_container" class="container-xl mb-30">
    <div class="row">
        <h2 class="fw-bold mb-3 mt-4">Jelajahi Sudut Kota</h2>
        <div class="col-md-6">
            <p class="fs-4 text-gray-700 mb-10">Ada berbagai pilihan destinasi liburan dengan harga spesial lho, jangan sampai kelewatan</p>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ url('/') }}/hotels?start={{ date('d-m-Y') }}&duration=1&room=1&guest=1" class="text-danger fs-4 fw-bold">Lihat Semua</a>
        </div>
    </div>
    <div class="row justify-content-between">
        @foreach ($hotelByCity as $cityHotel)
            <div class="col-md-3 mb-5">
                <a href="{{ url('hotels') }}?location={{ $cityHotel->city_name }}&start={{ date('d-m-Y') }}&duration=1&room=1&guest=3" class="card">
                    <div class="card-img-top h-200px d-flex align-items-center justify-content-center rounded" style="background: url('{{ asset('storage/media/kota/' . $cityHotel->image) }}'); background-size: cover; height: 200px;">
                        <h1 class="text-white m-0">{{ $cityHotel->city_name }}</h1>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
