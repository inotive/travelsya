<div id="kt_content_container" class="container-xl mb-30">
    <div class="row">
        <h2 class="fw-bold mb-3 mt-4">Yang Paling Populer</h2>
        <div class="col-md-6">
            <p class="fs-4 text-gray-700 mb-10">Hotel yang paling sering dikunjungi saat liburan</p>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ url('/') }}/hotels?location=&start={{ date('d-m-Y') }}&duration=1&room=1&guest=1"
                class="text-danger fs-4 fw-bold">Lihat Semua</a>
        </div>
    </div>

    <div class="row justify-content-between">
        @foreach($hotel_favorite as $hotel)
        @php
        $imageHotel = $hotel->hotelImage->where('main',1)->first()->image ?? null;
        $sellingPriceHotel = $hotel->hotelRoom->first()->sellingprice ?? 0;
        @endphp
        <div class="col-md-3 mb-5">
            <a href="{{ route('hotels.room', ['id_hotel' => $hotel->id]) }}?location={{ $hotel->city }}&start={{ date('d-m-Y') }}&duration=1&room=1&guest=1"
                class="card">
                <img class="card-img-top h-200px" src="{{asset($imageHotel)}}">
                <div class="card-body p-5">
                    <span
                        class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">{{$hotel->name}}</span>
                    <span class="text-gray-400 fw-semibold d-block fs-6 mt-1">{{$hotel->city}}</span>
                    <span class="text-danger text-end fw-bold fs-1 mt-2">Rp.
                        {{number_format($sellingPriceHotel,0,',','.')}}</span>
                    <span class="text-gray-600 cursor-pointer d-block  mt-5 text-align-center">
                        <span class="fa fa-star fs-4" style="color: red;"></span>
                        <span x-html="data.rate">{{ $hotel_detail[$hotel->id]['star_rating'] }}</span>
                        <span class="text-gray-400" x-html="data.totalRate">({{
                            $hotel_detail[$hotel->id]['total_rating'] }} Rating)</span>
                    </span>
                </div>
            </a>
        </div>
        @endforeach

        {{-- @foreach($hostel_favorite as $hostel)
        @php
        $imageHostel = $hostel->hostelImage->where('main',1)->first()->image ?? null;
        $sellingPriceHostel = $hostel->hostelRoom->first()->sellingrentprice_monthly ?? 0;
        @endphp
        <div class="col-md-3 mb-5">
            <a href="{{ route('hostel.room', $hostel->id) . '?location=' . $hostel->city . '&start=' . date('d-m-Y') . '&duration=1&property=&category=monthly&roomtype=&furnish=' }}"
                class="card">
                <img class="card-img-top h-200px" src="{{asset('storage/media/hostel/' .$imageHostel)}}">
                <div class="card-body p-5">
                    <span
                        class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">{{$hostel->name}}</span>
                    <span class="text-gray-400 fw-semibold d-block fs-6 mt-1">{{$hostel->city}}</span>
                    <span class="text-danger text-end fw-bold fs-1 mt-2">Rp.
                        {{number_format($sellingPriceHostel,0,',','.')}}</span>
                    <span class="text-gray-600 cursor-pointer d-block  mt-5 text-align-center">
                        <span class="fa fa-star fs-4" style="color: red;"></span>
                        <span x-html="data.rate">{{ floor($hostel->rating_avg) }}</span>
                        <span class="text-gray-400" x-html="data.totalRate">({{ $hostel->rating_count }} Rating)</span>
                    </span>
                </div>
            </a>
        </div>
        @endforeach --}}
    </div>

    {{-- <div class="row justify-content-between" x-data>
        <template x-for="data in $store.favoritehotel.data">
            <div class="col-md-3">
                <div class="card">
                    <img class="card-img-top h-200px" x-bind:src="data.image" x-bind:alt="data.label">
                    <div class="card-body p-5">
                        <span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1"
                            x-html="data.label"></span>
                        <span class="text-gray-400 fw-semibold d-block fs-6 mt-1" x-html="data.city"></span>
                        <span class="text-gray-400 fw-semibold d-block mt-5">Mulai dari <s
                                x-html="data.realPrice"></s></span>
                        <span class="text-danger text-end fw-bold fs-1 mt-2">Rp. <span
                                x-html="data.price"></span></span>
                        <span class="text-gray-600 cursor-pointer d-block  mt-5 text-align-center">
                            <span class="fa fa-star fs-4" style="color: red;"></span>
                            <span x-html="data.rate"></span>
                            <span class="text-gray-400" x-html="data.totalRate"></span>
                        </span>
                    </div>
                </div>
            </div>
        </template>
    </div> --}}

</div>