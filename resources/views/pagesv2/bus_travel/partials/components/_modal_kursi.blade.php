@push('css')
<style>
    .acquired {
        background-color: #D3D4D4 !important;
    }

    .choosed {
        background-color: #FFF4F4 !important;
        border: 2px solid var(--bs-danger) !important;
    }

</style>
@endpush
<div class="modal fade" id="modal_kursi" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header flex-column" style="align-items: unset;">
                <div class="d-flex flex-row align-items-center mb-2">
                    <span class="fw-bold fs-5">Pilih Penyedia Rental</span>
                    <button class="btn btn-outline-light close ms-sm-auto p-0" id="close_modal" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true" class="fs-1">&times;</span>
                    </button>
                </div>
                <span class="fw-bold title">{{ $departure->busTravel->name }}</span>
                <small class="mb-20px">{{ $departure->busTravel->class }}</small>
                <span class="mb-20px">{{ \App\Helpers\General::getDayDateShortMonth($date_pergi) }} -
                    {{ date('h:i', strtotime($departure->departure_time)) }} -
                    {{ $departure->duration }} Jam</span>

                <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6" id="list_penumpang">
                    @for ($i = 1; $i <= $jumlah_penumpang; $i++)
                    <div class="col p-3">
                        <div class="card border-dark-2" data-penumpang="{{ $i }}">
                            <div class="card-body d-flex flex-column">
                                <span class="fw-bold text-dark" id="nama_penumpang_{{ $i }}">Penumpang {{ $i }}</span>
                                <span class="text-dark" id="kursi_baris_{{ $i }}"></span>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
            <div class="modal-body bg-snow-pink min-h-350">
                <div class="row border-bottom border-secondary pb-5">
                    <div class="col-12 d-flex flex-row justify-content-center align-items-center">
                        <div style="width: 25px; height: 25px; border: 2px solid var(--bs-dark); border-radius: 3px;">
                        </div>
                        <span class="ms-3 fs-3 text-dark opacity-75">Tersedia</span>
                        <div class="ms-5"
                            style="width: 25px; height: 25px; border: 2px solid var(--bs-danger); border-radius: 3px;">
                        </div>
                        <span class="ms-3 fs-3 text-dark opacity-75">Dipilih</span>
                        <div class="ms-5" style="width: 25px; height: 25px; border-radius: 3px; background-color: #D3D4D4;">
                        </div>
                        <span class="ms-3 fs-3 text-dark opacity-75">Tidak Tersedia</span>
                    </div>
                </div>
                <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6 d-flex flex-row align-items-center justify-content-center p-3"
                    id="row-1">
                    <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;">
                    </div>
                    <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;">
                        <h5>A</h5>
                    </div>
                    <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;">
                        <h5>B</h5>
                    </div>
                    <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"></div>
                    <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;">
                        <h5>C</h5>
                    </div>
                    <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;">
                        <h5>D</h5>
                    </div>
                </div>
                <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6 d-flex flex-row align-items-center justify-content-center p-3"
                    id="row-0">
                    <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"></div>
                    <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"></div>
                    <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"></div>
                    <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"></div>
                    <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"></div>
                    <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px; padding: unset;"><img
                            src="/assets/img/steer.svg" width="25" height="25" alt=""></div>
                </div>
                <div id="baris_kursi_penumpang">
                    @php
                    $row = 1;
                    $total_seats = $departure->busTravel->number_seats;
                    @endphp
                    @for ($i = 1; $i <= $total_seats; $i++)
                        @php
                        $position = ($i - 1) % 4 + 1; // 1, 2, 3, or 4
                        $column = ['A', 'B', 'C', 'D'][$position - 1];
                        $seat_name = $column . $row;
                        $is_acquired = $choosedChairs->contains('kursi_pergi', $seat_name);
                        @endphp

                        @if ($position == 1)
                        {{-- Start new row --}}
                        <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6 d-flex flex-row align-items-center justify-content-center p-3" id="row-{{ $row }}">
                            {{-- Row number --}}
                            <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;">
                                <h5>{{ $row }}</h5>
                            </div>
                        @endif

                        {{-- Seat A or B --}}
                        @if ($position == 1 || $position == 2)
                        <div @if (!$is_acquired) type="button" @endif
                            class="col mx-5 border-dark-2 @if ($is_acquired) acquired @endif"
                            style="width: 25px; height: 25px; border-radius: 3px;"
                            @if (!$is_acquired) onclick="setChair('{{ $seat_name }}')" @endif
                            id="pilih_kursi_{{ $seat_name }}" nomor="{{ $seat_name }}"></div>
                        @endif

                        {{-- Gap between B and C --}}
                        @if ($position == 2)
                        <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"></div>
                        @endif

                        {{-- Seat C or D --}}
                        @if ($position == 3 || $position == 4)
                        <div @if (!$is_acquired) type="button" @endif
                            class="col mx-5 border-dark-2 @if ($is_acquired) acquired @endif"
                            style="width: 25px; height: 25px; border-radius: 3px;"
                            @if (!$is_acquired) onclick="setChair('{{ $seat_name }}')" @endif
                            id="pilih_kursi_{{ $seat_name }}" nomor="{{ $seat_name }}"></div>
                        @endif

                        @if ($position == 4 || $i == $total_seats)
                            {{-- Fill empty seats if last row is incomplete --}}
                            @if ($i == $total_seats && $position < 4)
                                @for ($j = $position + 1; $j <= 4; $j++)
                                    @if ($j == 3)
                                    {{-- Gap between B and C --}}
                                    <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"></div>
                                    @endif
                                    {{-- Empty placeholder --}}
                                    <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"></div>
                                @endfor
                            @endif
                            {{-- Close row --}}
                        </div>
                        @php
                        $row++;
                        @endphp
                        @endif
                    @endfor
                </div>

                {{-- Button section inside modal-body --}}
                {{-- Button section inside modal-body --}}
        @php
            $is_first_leg_round_trip = ($is_pulang_pergi == 1 && !isset($ticket_pergi_id));
            $is_second_leg_round_trip = ($is_pulang_pergi == 1 && isset($ticket_pergi_id));

            $form_action = route('bus_travel.order');
            if ($is_first_leg_round_trip) {
                $form_action = route('bus_travel.search');
            }
        @endphp

        <div class="p-5 bg-snow-pink">
            <form action="{{ $form_action }}" method="post" class="w-100">
                @csrf
                <input type="hidden" name="is_pulang_pergi" value="{{ $is_pulang_pergi }}">
                <input type="hidden" name="jumlah_penumpang" value="{{ $jumlah_penumpang }}">

                @if ($is_first_leg_round_trip)
                    {{-- First leg of round trip: POST to search route for the return leg. --}}
                    <input type="hidden" name="kota_awal" value="{{ $kota_tujuan }}"> {{-- Swapped --}}
                    <input type="hidden" name="kota_tujuan" value="{{ $kota_awal }}"> {{-- Swapped --}}
                    <input type="hidden" name="date_pergi" value="{{ $date_pulang }}"> {{-- New search uses original return date --}}
                    <input type="hidden" name="date_pulang" value=""> {{-- Not needed for the return search itself --}}

                    {{-- Carry over original search params and selection from this leg --}}
                    <input type="hidden" name="ticket_pergi_id" value="{{ $departure->id }}">
                    <input type="hidden" name="original_date_pergi" value="{{ $date_pergi }}">
                    <input type="hidden" name="original_date_pulang" value="{{ $date_pulang }}">
                    @for ($i = 1; $i <= $jumlah_penumpang; $i++)
                        <input type="hidden" name="kursi_pergi_{{ $i }}" id="kursi_pilihan_penumpang_{{ $i }}">
                    @endfor
                    <button type="submit" class="btn btn-danger w-100">Lanjut Pilih Kepulangan</button>

                @elseif ($is_second_leg_round_trip)
                    {{-- Second leg of round trip: POST to order route. --}}
                    {{-- First leg data (from the passed variables) --}}
                    <input type="hidden" name="departure_id" value="{{ $ticket_pergi_id }}">
                    <input type="hidden" name="kota_awal" value="{{ $kota_awal }}">
                    <input type="hidden" name="kota_tujuan" value="{{ $kota_tujuan }}">
                    <input type="hidden" name="date_pergi" value="{{ $original_date_pergi }}">
                    @for ($i = 1; $i <= $jumlah_penumpang; $i++)
                        @if(isset(${'kursi_pergi_' . $i}))
                            <input type="hidden" name="kursi_pergi_{{ $i }}" value="{{ ${'kursi_pergi_' . $i} }}">
                        @endif
                    @endfor

                    {{-- Second leg data (current selection) --}}
                    <input type="hidden" name="ticket_pulang_id" value="{{ $departure->id }}">
                    <input type="hidden" name="date_pulang" value="{{ $original_date_pulang }}">
                    @for ($i = 1; $i <= $jumlah_penumpang; $i++)
                        <input type="hidden" name="kursi_pulang_{{ $i }}" id="kursi_pilihan_penumpang_{{ $i }}">
                    @endfor
                    <button type="submit" class="btn btn-danger w-100">Lanjut Ke Form Pemesanan</button>

                @else
                    {{-- Standard one-way trip --}}
                    <input type="hidden" name="departure_id" value="{{ $departure_id }}">
                    <input type="hidden" name="kota_awal" value="{{ $kota_awal }}">
                    <input type="hidden" name="kota_tujuan" value="{{ $kota_tujuan }}">
                    <input type="hidden" name="date_pergi" value="{{ $date_pergi }}">
                    <input type="hidden" name="date_pulang" value="{{ $date_pulang }}">
                    @for ($i = 1; $i <= $jumlah_penumpang; $i++)
                        <input type="hidden" name="kursi_penumpang_{{ $i }}" id="kursi_pilihan_penumpang_{{ $i }}">
                    @endfor
                    @if (isset($is_order))
                        <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Lanjutan Order</button>
                    @else
                        <button type="submit" class="btn btn-danger w-100">Lanjut Ke Form Pemesanan</button>
                    @endif
                @endif
            </form>
        </div>
        </div>
    </div>
</div>

@push('js')
<script>
    var id_penumpang;
    var is_order;

    $(document).ready(function() {
        let chairs = $("#baris_kursi_penumpang").find(`[id^="pilih_kursi_"]`);

        $("#list_penumpang").on("click", ".card", function() {
            let clickedCard = $(this);
            let penumpang = clickedCard.data('penumpang');
            id_penumpang = penumpang;

            clickedCard.removeClass('border-dark-2').addClass(['bg-snow-pink', 'border-danger-2']);
            $("#nama_penumpang_" + penumpang).removeClass('text-dark').addClass('text-danger');
            $("#baris__" + penumpang).removeClass('text-dark').addClass('text-danger');

            let otherCards = $("#list_penumpang").find(".card").not(clickedCard);
            otherCards.each(function(index, other) {
                let other_penumpang = $(other).data('penumpang');
                $(other).addClass('border-dark-2').removeClass(['bg-snow-pink', 'border-danger-2']);
                $("#nama_penumpang_" + other_penumpang).addClass('text-dark').removeClass('text-danger');
                $("#baris__" + other_penumpang).addClass('text-dark').removeClass('text-danger');
            })
        });
    });

    function setChair(chair) {
        if (id_penumpang == '' || id_penumpang == null) {
            alert('Pilih Penumpang terlebih dahulu');
            return;
        }

        let previousChoice = $(`[id^="kursi_pilihan_penumpang_"]`);
        let alreadyChosen = false;

        previousChoice.each(function(index, choice) {
            if (chair == $(choice).val()) {
                alert("Kursi Ini telah anda pilih");
                alreadyChosen = true;
                return false;
            }
        });

        if (alreadyChosen) return;

        choosedByPenumpang = $("#kursi_pilihan_penumpang_" + id_penumpang).val();

        $("#baris_kursi_penumpang #pilih_kursi_" + choosedByPenumpang).removeClass(['border-danger-2', 'bg-snow-pink']).addClass(['border-dark-2']);

        $(`#pilih_kursi_${chair}`).removeClass(['border-dark-2']).addClass(['border-danger-2', 'bg-snow-pink']);
        $(`#kursi_pilihan_penumpang_${id_penumpang}`).val(chair);

        if(is_order == true){
            $("#kursi_penumpang_"+id_penumpang).val(chair);
            $("#baris_kursi_penumpang_"+id_penumpang).text('Kursi '+chair);
        }
        $("#kursi_baris_" + id_penumpang).text(chair);
    }

    function setChairForOrder() {
        let costumerChairs = $(`[id^="kursi_pilihan_penumpang_"]`);
        costumerChairs.each(function(index, value) {
            let baris = index + 1;
            let chair = $(value).val();
            $("#pilih_kursi_" + chair).removeClass(['border-dark-2']).addClass(['border-danger-2', 'bg-snow-pink']);
            $("#list_penumpang #kursi_baris_" + baris).text(chair);
        })
        is_order = true;
        $("#modal_kursi").modal("show");
    }
</script>
@endpush
