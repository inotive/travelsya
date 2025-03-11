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
                    <img src="{{ asset($car->brand->image ?? null) }}" class="" width="150px" height="100px"
                        alt="..."
                        onerror="this.src='https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg'">
                </div>
            </div>
            <div class="modal-body">
                @foreach ($car->vendor as $v)
                {{-- {{ dd($v) }} --}}
                <div class="card shadow-sm mb-5" id="rental_{{ $v['car_id'] }}">
                    <div class="card-body d-flex flex-row">
                        <div class="d-flex flex-column">
                            <span class="fw-bold mb-5">{{ $v['business_name'] }}</span>
                            <div class="rating d-flex align-items-center mb-1">
                                <span class="bintang text-warning fa fa-star checked me-2"></span>
                                <span class="rating-number fw-bold">{{
                                    \App\Helpers\General::getCarRentalRate($v['car_id']) }}
                                    / <small>5</small> <a href="#"
                                        class="text-decoration-none text-dark opacity-50 text-capitalize">(Lihat {{
                                        number_format($v['reviews']) }}
                                        Ulasan)</a>
                                </span>
                                <span class="rating-number custom-dot-before">{{ number_format($car->booked()->count())
                                    }} order</span>
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
                            <span class="mb-2"><span class="text-danger fw-bold">IDR
                                    {{ number_format($v['price'], '0', ',', '.') }}</span> /
                                hari</span>

                            <a href="{{ route('car_rent.detail', [
                                'category' => $category ?? 'dengan driver',
                                'lokasi' => $v['location'] ?? 'jakarta',
                                'model' => $model ?? $car->car_model_id,
                                'provider' => $v['car_id'],
                                'date' => $date . ' ' . $time,
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
                @endforeach
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
