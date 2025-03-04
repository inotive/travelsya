<div class="container mb-5">
    <section class="cars mt-5">
        <div class="card border mb-5">
            <form action="{{ route('car_rent.show') }}" method="post">
                @csrf
                @if ($model)
                    <input type="hidden" value="{{ $model }}">
                @endif
                <div class="card-body d-flex flex-row align-items-center">
                    <div class="input-group d-flex flex-row align-items-center border-0" style="width: 75%;">
                        <span class="input-group-text border-none bg-light">
                            <i class="fa-solid fa-search"></i>
                        </span>
                        <select name="category" id="category"
                            class="form-control border-none border-right-2 max-w-120 py-0">
                            <option @if ($category == 'supir') selected @endif value="supir">Dengan Supir
                            </option>
                            <option @if ($category == 'lepas') selected @endif value="tidak dengan driver">Lepas
                                Kunci
                            </option>
                        </select>
                        <input type="text" name="location" class="form-control border-none max-w-150" id="location"
                            value="{{ $location }}" placeholder="lokasi anda">
                        <input type="text" name="date" id="date" onfocus="(this.type='date')"
                            class="form-control border-none border-left-2  max-w-200 py-0"
                            value="{{ $date != '' ? $date : date('d/m/Y', strtotime(now())) }}"
                            placeholder="tanggal sewa">
                        <span class="input-group-text border-none bg-light">
                            <i class="fa-solid fa-dot-circle fs-8"></i>
                        </span>
                        <input type="time" name="time" id="time"
                            class="form-control border-none border-right-2 max-w-150 py-0"
                            value="{{ $time != '' ? $time : date('H:i', strtotime(now())) }}">
                        <input type="number" name="duration" class="form-control border-none py-0 max-w-50 pe-0"
                            id="duration" value="{{ $duration ? $duration : 1 }}" size="5" placeholder="durasi">
                        <div class="d-flex align-items-center">Hari</div>
                    </div>
                    <button type="submit"
                        class="bg-danger bg-opacity-25 text-danger btn btn-outline-danger ms-sm-auto">Cari</button>
                </div>
            </form>
        </div>

        <div class="p-5 mb-25px d-flex flex-row align-items-center">
            <button class="btn btn-sm rounded-pill bg-danger bg-opacity-25 text-danger">Paket Reguler</button>
            <button class="btn btn-sm rounded-pill">Paket All-In</button>
        </div>

        <div class="card shadow-sm rounded-4 overflow-hidden"
            style="background: linear-gradient(to right, rgba(255, 150, 150, 0.5), white)">
            <div class="rounded-circle bg-danger position-absolute opacity-25"
                style="width:100px; height:100px; top: -50px; right: -40px;">
            </div>
            <div class="rounded-circle bg-danger position-absolute"
                style="width:25px; height:25px; top: 35px; right: -10px;">
            </div>
            <div class="card-body d-flex flex-column justify-content-start" style="z-index: 10;">
                <span class="card-title fw-bold my-2">Paket Ruguler</span>
                <span>Cari tau mudahnya cara memesan Sewa mobil di Travelsya</span>
            </div>
        </div>

        <div class="p-5 my-3">
            <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6" id="car_brands">
                {{-- @foreach ($city->has_cars as $car) --}}
                @foreach ($cars as $car)
                    <div class="card shadow mb-1 w-100">
                        <div class="card-body d-flex flex-row">
                            <img src="{{ asset($car->carModel->image ?? null) }}" class="" width="150px"
                                height="100px" alt="..."
                                onerror="this.src='https://images.unsplash.com/photo-1588440983028-d53e24fa96cc?q=80&w=3870&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'">
                            <div class="d-flex flex-column ms-5">
                                <span class="fw-bold mb-3">{{ $car->brand->name }}</span>
                                <div class="d-flex flex-row align-items-center">
                                    <span class="fa-solid fa-suitcase"></span>
                                    <span class="ms-2">{{ $car->koper }} Koper</span>
                                    <span class="fa-solid fa-user ms-5"></span>
                                    <span class="ms-2">{{ $car->number_seats }} Penumpang</span>
                                </div>
                            </div>
                            <div class="d-flex flex-column align-items-end ms-sm-auto">
                                <span class="mb-3">Mulai dari</span>
                                <span class="mb-2"><span class="text-danger fs-5 fw-bold">IDR
                                        {{ number_format($car->rental_price_per_day, 0, ',', '.') }}</span> /
                                    hari</span>
                                <!-- name, luggage, seats, id_brand, id_city -->
                                <button class="btn btn-danger py-1" id="provider_button-{{ $car->id }}"
                                    data-bs-toggle="modal" data-bs-target="#providers-{{ $car->id }}">Pilih
                                    Mobil</button>
                            </div>
                        </div>
                    </div>
                    @include('pagesv2.car_rent.components._vendor_modal')
                @endforeach
            </div>
        </div>
    </section>



</div>
