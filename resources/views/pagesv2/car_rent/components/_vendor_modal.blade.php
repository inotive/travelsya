<div class="modal fade" id="providers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="d-flex flex-column border border-bottom" style="padding: 1.75rem;">
                <div class="d-flex flex-row align-items-center mb-2">
                    <span class="title fw-bold fs-5">Pilih Penyedia Rental</span>
                    <button class="btn btn-outline-light close ms-sm-auto p-0" id="close_modal" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true" class="fs-1">&times;</span>
                    </button>
                </div>
                <div class="d-flex flex-row">
                    <div class="d-flex flex-column">
                        <span class="fw-bold mb-3" id="brand_name">Toyota New Brand</span>
                        <div class="d-flex flex-row align-items-center">
                            <span class="fa-solid fa-suitcase opacity-25"></span>
                            <span class="ms-2 opacity-25" id="luggage_number"></span>
                            <span class="fa-solid fa-user ms-5 opacity-25"></span>
                            <span class="ms-2 opacity-25" id="passage_number"></span>
                        </div>
                    </div>
                    <img src="https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg"
                        class="ms-sm-auto" width="150px" height="100px" alt="...">
                </div>
            </div>
            <div class="modal-body" id="modal_body_rental">
                @foreach ($city->has_cars as $car)
                <div class="card shadow-sm mb-5 d-none" id="rental_{{ $car->brand_id }}">
                    <div class="card-body d-flex flex-row">
                        <div class="d-flex flex-column">
                            <span class="fw-bold mb-5">{{ $car->carRental->business_name }}</span>
                            <div class="rating d-flex align-items-center mb-1">
                                <span class="bintang text-warning fa fa-star checked me-2"></span>
                                <span class="rating-number fw-bold">{{
                                    \App\Helpers\General::getCarRentalRate($car->id) }} / <small>5</small> <a href="#"
                                        class="text-decoration-none text-dark opacity-50 text-capitalize">(Lihat xxx
                                        Ulasan)</a>
                                </span>
                                <span class="rating-number custom-dot-before">2500 order</span>
                            </div>
                            <div class="rating d-flex align-items-center mb-1">
                                <span class="bintang fa-solid fa-suitcase checked me-2"></span>
                                <span class="rating-number">Air Mineral</span>
                            </div>
                            <div class="rating d-flex align-items-center mb-1">
                                <span class="bintang fa-solid fa-user checked me-2"></span>
                                <span class="rating-number">Supir bisa bahasa inggris</span>
                            </div>
                        </div>
                        <div class="d-flex flex-column ms-sm-auto align-items-end justify-content-end">
                            <span class="mb-2"><span class="text-danger fw-bold">IDR {{
                                    number_format($car->rentail_price_per_day, '0', ',', '.') }}</span> /
                                hari</span>
                            <form action="{{ route('car_rent.order') }}" method="post">
                                @csrf
                                <input type="hidden" name="lokasi" value="{{ $city->city_id }}">
                                <input type="hidden" name="brand" value="{{ $car->brand_id }}">
                                <input type="hidden" name="date" value="{{ $date }}">
                                <input type="hidden" name="time" value="{{ $time }}">
                                <input type="hidden" name="duration" value="{{ $duration }}">
                                <input type="hidden" name="provider" value="{{ $car->car_rental_id }}">
                                <button type="submit" class="btn btn-danger">Pilih penyedia</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


@push('js')
<script>
    $(document).ready(function () {
        $('#providers').on('shown.bs.modal', function() {
            $('#car_brands #provider_button').trigger('focus')
        });

        $('#car_brands #provider_button').click(function() {
            let brand_data = $(this).attr('brand').split(',');
            console.log(brand_data);
            
            $("#brand_name").text(brand_data[0]); // brand name
            $("#luggage_number").text(brand_data[1] + ' Koper'); // luggage number
            $("#passage_number").text(brand_data[2] + ' Penumpang'); // passage number

            $("#rental_"+brand_data[3]).each(function(){
                $(this).removeClass('d-none');
            })
            
            // $.ajax({
            //     type: "GET",
            //     url: "/car_rent/get_cars_vendor/"+brand_data[3]+"/"+brand_data[4], // brand_id, has_car id
            //     dataType: "json",
            //     success: function (response) {
            //         console.log(response);
                    
            //     }
            // });
            
            $('#providers').modal('show');
        });

        $('#close_modal').click(function() {
            $('#providers').modal('hide');
        });
    });
</script>
@endpush