<div class="modal fade" id="providers-{{ $car->id }}-{{ $type_transmission ?? 'semua' }}" tabindex="-1" aria-labelledby="" aria-hidden="true">
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
                <div class="d-flex flex-row justify-content-between">
                    <div class="d-flex flex-column">
                        <span class="fw-bold mb-3">{{ $car->brand->name }}</span>
                        <div class="d-flex flex-row align-items-center">
                            <span class="fa-solid fa-user-group ms-5 opacity-25"></span>
                            <span class="ms-2 opacity-25" id="passage_number">{{ $car->number_seats }} Penumpang</span>
                            <span class="fa-solid fa-gears ms-5 opacity-25"></span>
                            <span class="ms-2 opacity-25" id="passage_number">{{ $car->category }}</span>
                            @if (strtolower($car->category_rent) == 'dengan driver')
                            <span class="fa-solid fa-user ms-5 opacity-25"></span>
                            @else
                            <span class="fa-solid fa-user-slash ms-5 opacity-25"></span>
                            @endif
                            <span class="ms-2 opacity-25" id="passage_number">{{ $car->category_rent }}</span>
                        </div>
                    </div>
                    <div class="card-img-container" style="width: 150px; height: 100px; overflow: hidden;">
                        <img src="{{ asset($car->brand->image ?? null) }}" 
                             class="card-img-aspect card-img-top"
                             alt="{{ $car->brand->name ?? 'Car Brand' }}"
                             onerror="this.src='https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg'">
                    </div>
                </div>
            </div>
            <div class="modal-body">
                @forelse ($car->vendor as $v)
                <div class="card shadow-sm mb-5" id="rental_{{ $v['car_id'] ?? $v->id ?? 'unknown' }}">
                    <div class="card-body d-flex flex-row">
                        <div class="d-flex flex-column">
                            <span class="fw-bold mb-5">{{ $v['business_name'] ?? $v->carRental->business_name ?? 'Unknown Vendor' }}</span>
                            <div class="rating d-flex align-items-center mb-1">
                                <span class="bintang text-warning fa fa-star checked me-2"></span>
                                <span class="rating-number fw-bold">{{
                                    \App\Helpers\General::getCarRentalRate($v['car_id'] ?? $v->id ?? 0) }}
                                    / <small>5</small> <a href="#"
                                        class="text-decoration-none text-dark opacity-50 text-capitalize">(Lihat {{
                                        number_format($v['reviews'] ?? 0) }}
                                        Ulasan)</a>
                                </span>
                                <span class="rating-number custom-dot-before">{{ number_format($car->booked()->count())
                                    }} order</span>
                            </div>
                            <div class="rating d-flex align-items-center mb-1">
                                <span class="bintang fa-solid fa-location-dot checked me-2"></span>
                                <span class="rating-number">{{ $v['location'] ?? ($v->carRental->kota->city_name ?? 'Lokasi tidak diketahui') }}</span>
                            </div>
                        </div>
                        <div class="d-flex flex-column ms-sm-auto align-items-end justify-content-end">
                            <span class="mb-2"><span class="text-danger fw-bold">IDR
                                    {{ number_format($v['price'] ?? $v->rental_price_per_day ?? 0, '0', ',', '.') }}</span> /
                                hari</span>
                            @php
                                // Menentukan lokasi dengan berbagai fallback - memastikan selalu ada nilai
                                $lokasi = 'jakarta'; // Default value
                                
                                // Coba dapatkan dari array
                                if (isset($v['location']) && !empty($v['location'])) {
                                    $lokasi = $v['location'];
                                } 
                                // Coba dapatkan dari object relationship
                                elseif (isset($v->carRental) && isset($v->carRental->kota) && isset($v->carRental->kota->city_name) && !empty($v->carRental->kota->city_name)) {
                                    $lokasi = $v->carRental->kota->city_name;
                                } 
                                // Coba dapatkan dari variable location
                                elseif (isset($location) && !empty($location)) {
                                    $lokasi = $location;
                                }
                                         
                                // Menentukan provider dengan berbagai fallback
                                $provider = 'default_provider'; // Default value
                                if (!empty($v['car_id'])) {
                                    $provider = $v['car_id'];
                                } elseif (!empty($v->id)) {
                                    $provider = $v->id;
                                }
                                           
                                // Menentukan tanggal dengan format yang benar
                                $tanggal = urlencode(trim(($date ?? date('Y-m-d')) . ' ' . ($time ?? '08:00')));
                            @endphp
                            <a href="{{ route('car_rent.detail', [
                                'category' => $category ?? 'dengan driver',
                                'lokasi' => $lokasi,
                                'model' => $model ?? $car->car_model_id,
                                'provider' => $provider,
                                'date' => $tanggal,
                                'duration'=> $duration ?? 1
                            ]) }}">

                            {{-- <input type="hidden" name="category" id="order_{{ $v['car_id'] }}_category"
                                    value="{{ $category ? $category : 'supir' }}">
                                <input type="hidden" name="lokasi" id="order_{{ $v['car_id'] }}_lokasi"
                                    value="{{ $v['location'] }}">
                                <input type="hidden" name="brand" id="order_{{ $v['car_id'] }}_brand"
                                    value="{{ $v['brand_id'] }}">
                                <input type="hidden" name="date" id="order_{{ $v['car_id'] }}_date"
                                    value="{{ $date && $time ? $date . ' ' . $time : date('Y-m-d H:i:s', strtotime(now())) }}">
                                <input type="hidden" name="model" id="order_{{ $v['car_id'] }}_model"
                                    value="{{ $model ? $model : $v['car_model_id'] }}">
                                <input type="hidden" name="duration" id="order_{{ $v['car_id'] }}_duration"
                                    value="{{ $duration ? $duration : 1 }}">
                                <input type="hidden" name="provider" id="order_{{ $v['car_id'] }}_provider"
                                    value="{{ $v['car_id'] }}">
                                <input type="hidden" name="car_id" id="order_{{ $v['car_id'] }}_provider"
                                    value="{{ $v['car_id'] }}"> --}}
                                <button class="btn btn-danger" {{-- id="submit_{{ $car['car_id'] }}_order" --}}>Pilih
                                    penyedia</button>
                            </a>
                            <span class="text-sm text-danger"></span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="alert alert-info text-center">
                    <h4>Tidak ada penyedia rental untuk mobil ini</h4>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>


@push('js')
<script>
    $(document).ready(function() {

        });
</script>
@endpush
