@push('css')
    <style>
        .acquired {
            background-color: var(--bs-secondary) !important;
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
                    {{ $departure->duration }}j</span>

                <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6" id="list_penumpang">
                    @for ($i = 1; $i <= $jumlah_penumpang; $i++)
                        <div class="col p-3">
                            <div class="card border-dark-2" data-penumpang="{{ $i }}">
                                <div class="card-body d-flex flex-column">
                                    <span class="fw-bold text-dark" id="nama_penumpang_{{ $i }}">Penumpang
                                        {{ $i }}</span>
                                    <span class="text-dark" id="baris__{{ $i }}"></span>
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
                        <div class="ms-5"
                            style="width: 25px; height: 25px; border-radius: 3px; background-color: #D3D4D4;">
                        </div>
                        <span class="ms-3 fs-3 text-dark opacity-75">Tidak Tersedia</span>
                    </div>
                </div>
                <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6 d-flex flex-row align-items-center justify-content-center p-3"
                    id="row-1">
                    <div type="button" class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"></div>
                    <div type="button" class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"></div>
                    <div type="button" class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"></div>
                    <div type="button" class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"></div>
                    <div type="button" class="col mx-5 border-dark-2"
                        style="width: 25px; height: 25px; border-radius: 3px;"></div>
                </div>
                <div id="baris_kursi_penumpang">
                    @php
                        $row = 2;
                        $total_row = floor($departure->busTravel->number_seats / 4) + 1;
                    @endphp
                    @for ($i = 1; $i <= $departure->busTravel->number_seats; $i++)
                        @if ($i % 4 == 1)
                            <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6 d-flex flex-row align-items-center justify-content-center p-3"
                                id="row-{{ $row }}">
                                <div type="button" class="col mx-5 border-dark-2"
                                    style="width: 25px; height: 25px; border-radius: 3px;"
                                    onclick="setChair({{ $i }})" id="pilih_kursi_{{ $i }}"
                                    nomor="{{ $i }}"></div>
                            @elseif($i % 4 == 2)
                                <div type="button" class="col mx-5 border-dark-2"
                                    style="width: 25px; height: 25px; border-radius: 3px;"
                                    onclick="setChair({{ $i }})" id="pilih_kursi_{{ $i }}"
                                    nomor="{{ $i }}"></div>

                                <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"></div>
                            @elseif($i % 4 == 0)
                                <div type="button" class="col mx-5 border-dark-2"
                                    style="width: 25px; height: 25px; border-radius: 3px;"
                                    onclick="setChair({{ $i }})" id="pilih_kursi_{{ $i }}"
                                    nomor="{{ $i }}"></div>
                            </div>
                        @else
                            <div type="button" class="col mx-5 border-dark-2"
                                style="width: 25px; height: 25px; border-radius: 3px;"
                                onclick="setChair({{ $i }})" id="pilih_kursi_{{ $i }}"
                                nomor="{{ $i }}"></div>
                        @endif
                    @endfor
                    {{-- <div
                        class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6 d-flex flex-row align-items-center justify-content-center p-3"
                        id="row-2">
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_21" nomor="21">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_22" nomor="22">
                        </div>
                        <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_23"
                            nomor="23">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_24" nomor="24">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_25" nomor="25">
                        </div>
                    </div>
                    <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6 d-flex flex-row align-items-center justify-content-center p-3"
                        id="row-3">
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_31" nomor="31">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_32" nomor="32">
                        </div>
                        <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_33"
                            nomor="33">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_34" nomor="34">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_35" nomor="35">
                        </div>
                    </div>
                    <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6 d-flex flex-row align-items-center justify-content-center p-3"
                        id="row-4">
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_41" nomor="41">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_42" nomor="42">
                        </div>
                        <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_43"
                            nomor="43">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_44" nomor="44">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_45" nomor="45">
                        </div>
                    </div>
                    <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6 d-flex flex-row align-items-center justify-content-center p-3"
                        id="row-5">
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_51" nomor="51">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_52" nomor="52">
                        </div>
                        <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_53"
                            nomor="53">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_54" nomor="54">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_55" nomor="55">
                        </div>
                    </div>
                    <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6 d-flex flex-row align-items-center justify-content-center p-3"
                        id="row-6">
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_61" nomor="61">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_62" nomor="62">
                        </div>
                        <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_63"
                            nomor="63">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_64" nomor="64">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_65" nomor="65">
                        </div>
                    </div>
                    <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6 d-flex flex-row align-items-center justify-content-center p-3"
                        id="row-7">
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_71" nomor="71">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_72" nomor="72">
                        </div>
                        <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_73"
                            nomor="73">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_74" nomor="74">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_75" nomor="75">
                        </div>
                    </div>
                    <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6 d-flex flex-row align-items-center justify-content-center p-3"
                        id="row-8">
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_81" nomor="81">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_82" nomor="82">
                        </div>
                        <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_83"
                            nomor="83">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_84" nomor="84">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_85" nomor="85">
                        </div>
                    </div>
                    <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6 d-flex flex-row align-items-center justify-content-center p-3"
                        id="row-9">
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_91" nomor="91">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_92" nomor="92">
                        </div>
                        <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_93"
                            nomor="93">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_94" nomor="94">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_95" nomor="95">
                        </div>
                    </div>
                    <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6 d-flex flex-row align-items-center justify-content-center p-3"
                        id="row-10">
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_101" nomor="101">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_102" nomor="102">
                        </div>
                        <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"
                            id="pilih_kursi_103" nomor="103">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_104" nomor="104">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_105" nomor="105">
                        </div>
                    </div>
                    <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6 d-flex flex-row align-items-center justify-content-center p-3"
                        id="row-11">
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_111" nomor="111">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_112" nomor="112">
                        </div>
                        <div class="col mx-5" style="width: 25px; height: 25px; border-radius: 3px;"
                            id="pilih_kursi_113" nomor="113">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_114" nomor="114">
                        </div>
                        <div type="button" class="col mx-5 border-dark-2"
                            style="width: 25px; height: 25px; border-radius: 3px;" id="pilih_kursi_115" nomor="115">
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="modal-bpdy p-5">
                <form action="{{ route('bus_travel.order') }}" method="post">
                    @csrf
                    <input type="hidden" name="is_pulang_pergi" value="{{ $is_pulang_pergi }}">
                    <input type="hidden" name="departure_id" value="{{ $departure_id }}">
                    <input type="hidden" name="kota_awal" value="{{ $kota_awal }}">
                    <input type="hidden" name="kota_tujuan" value="{{ $kota_tujuan }}">
                    <input type="hidden" name="jumlah_penumpang" value="{{ $jumlah_penumpang }}">
                    <input type="hidden" name="date_pergi" value="{{ $date_pergi }}">
                    <input type="hidden" name="date_pulang" value="{{ $date_pulang }}">
                    @for ($i = 1; $i <= $jumlah_penumpang; $i++)
                        <input type="hidden" name="kursi_penumpang_{{ $i }}"
                            id="kursi_pilihan_penumpang_{{ $i }}">
                    @endfor
                    <button type="submit" class="btn btn-danger w-100">Lanjut Ke Form Pemesanan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        // $("#list_penumpang").on("click", ".card", function() {
        //         let penumpang = $(this).data('penumpang');
        //         $(this).removeClass('border-dark-2').addClass(['bg-snow-pink', 'border-danger-2']);
        //         $("#nama_penumpang_" + penumpang).removeClass('text-dark').addClass('text-danger');
        //         $("#baris__" + penumpang).removeClass('text-dark').addClass('text-danger');
        //         $("#list_penumpang .card").removeClass('border-danger');
        //         console.log(penumpang);
        //         $(this).addClass('border-danger');
        //         $("#modal_kursi").modal('show');
        //     });

        var id_penumpang;
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
                    $(other).addClass('border-dark-2').removeClass(['bg-snow-pink',
                        'border-danger-2'
                    ]);
                    $("#nama_penumpang_" + other_penumpang).addClass('text-dark').removeClass(
                        'text-danger');
                    $("#baris__" + other_penumpang).addClass('text-dark').removeClass(
                    'text-danger');
                })

            });
        });

        function setChair(chair) {
            if (id_penumpang == '' || id_penumpang == null) {
                alert('Pilih Penumpang terlebih dahulu');
                return;
            }

            let previousChoice = $(`[id^="kursi_pilihan_penumpang_"]`);

            previousChoice.each(function(index, choice) {
                if (chair == $(choice).val()) {
                    alert("Kursi Ini telah anda pilih");
                    return;
                }
            });

            choosedByPenumpang = $("#kursi_pilihan_penumpang_" + id_penumpang).val();

            $("#baris_kursi_penumpang #pilih_kursi_" + choosedByPenumpang).removeClass(['border-danger-2', 'bg-snow-pink'])
                .addClass(['border-dark-2']);

            // let acquiredChairs = $(`#baris_kursi_penumpang [class*="acquired"]`);
            // let choosedID = $(`[id^="kursi_pilihan_penumpang_"]`);
            // let otherChairs = $(`#baris_kursi_penumpang [id^="pilih_kursi_"]`).not(acquiredChairs, choosedChairs);

            $(`#pilih_kursi_${chair}`).removeClass(['border-dark-2']).addClass(['border-danger-2', 'bg-snow-pink']);
            $(`#kursi_pilihan_penumpang_${id_penumpang}`).val(chair);

        }
    </script>
@endpush
