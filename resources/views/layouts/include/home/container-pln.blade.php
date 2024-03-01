<div class="row gx-5 gx-xl-8 mb-xl-8 mb-5">
    <!--begin::Col-->
    <div class="col-xl-12">

        <!--begin::Tiles Widget 2-->
        <form action="{{ route('product.payment.pln') }}" method="GET"
            class="card bgi-no-repeat bgi-size-contain card-xl-stretch mb-xl-8 container-xxl mb-5">
            <!--begin::Body-->
            <div class="card-body d-flex flex-column justify-content-between">
                <!--begin::Title-->
                <h2 class="fw-bold mb-5">PLN</h2>
                <!--end::Title-->
                <div class="row mb-5 gy-4">
                    <div class="col-6" id="product">
                        <label class="fs-5 fw-semibold mb-2">
                            <span>Produk</span>
                        </label>

                        <select name="categoryPLN" id="categoryPLN" class="form-select form-select-lg">
                            <option value="pembayaran" selected>Pembayaran</option>
                            <option value="token">Token Listrik</option>
                        </select>
                    </div>
                    <div class="col-6 d-none" id="nominal">
                        <label class="fs-5 fw-semibold mb-2">
                            <span>Nominal</span>
                        </label>

                        <select name="productPLN" id="productPLN" class="form-select form-select-lg" disabled></select>
                    </div>
                    <div class="col-6" id="nomor-pelanggan">
                        <label class="fs-5 fw-semibold mb-2">
                            <span class="required">Nomor Pelanggan</span>
                        </label>

                        <input type="text" id="noPelangganPLN" class="form-control form-control-lg"
                            name="noPelangganPLN" placeholder="Masukan nomor pelanggan" value="" />
                        <small class="text-danger" id="textAlert">No. Pelanggan harus
                            terisi</small>

                        <input type="hidden" name="namaPelanggan" id="inputNamaPelangganPLN">
                        <input type="hidden" name="totalTagihan" id="inputTotalTagihanPLN">
                        <input type="hidden" name="biayaAdmin" id="inputBiayaAdminPLN">
                        <input type="hidden" name="totalBayar" id="inputTotalBayarPLN">
                    </div>
                    @auth
                        <div class="col-12 d-flex justify-content-between d-none" id="plnPointItem">
                            <p class="fw-light-grey-900">Anda Memiliki Point <b>{{ auth()->user()->point }}</b>. Pakai Point
                            </p>
                            <h4>
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input pakai-point" type="checkbox" name=""
                                        {{ auth()->user()->point == 0 ? 'disabled' : '' }} id="pln" />
                                </div>
                            </h4>
                        </div>
                        <input type="hidden" name="point" value="{{ auth()->user()->point }}" id="plnPoint" disabled>
                    @endauth
                    <div class="col-12">
                        <button type="button" class="btn btn-danger w-100" id="btnPeriksaPLN">Periksa</button>
                        @auth
                            <button type="submit" class="btn btn-danger mt-4 w-100 d-none"
                                    id="btnBayar">Bayar</button>
                        @endauth
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-danger mt-4 w-100 d-none" id="btnLogin">Login
                                Dulu</a>
                        @endguest
{{--                        <button type="button" class="btn btn-danger mx-4 w-100" id="btnPeriksaPLN">Periksa</button>--}}
                    </div>

                    <div class="row mt-4" id="detailPLN">
                        <div class="col-12">
                            <label class="fs-5 fw-semibold my-3">
                                <span>Detail Pelanggan</span>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr class="py-5">
                                            <td class="bg-light fw-bold fs-6 text-gray-800 mb-4">Nama Pelanggan</td>
                                            <td class="text-right" colspan="3"><span id="namaPelangganPLN"></span>
                                            </td>
                                        </tr>
                                        <tr class="py-5">
                                            <td class="bg-light fw-bold fs-6 text-gray-800">Total Tagihan</td>
                                            <td>Rp. <span id="totalTagihanPLN"></span></td>
                                        </tr>
                                        <tr class="py-5">
                                            <td class="bg-light fw-bold fs-6 text-gray-800">Biaya Admin</td>
                                            <td>Rp. <span id="biayaAdminPLN"></span></td>
                                        </tr>
                                        <tr class="py-5">
                                            <td class="bg-light fw-bold fs-6 text-gray-800">Total Bayar</td>
                                            <td colspan="2">Rp. <span id="totalBayarPLN"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
{{--                        <div class="col-12">--}}
{{--                            @auth--}}
{{--                                <button type="submit" class="btn btn-danger mt-4 w-100 d-none"--}}
{{--                                    id="btnBayar">Bayar</button>--}}
{{--                            @endauth--}}

{{--                        </div>--}}
                    </div>

                    <div class="row mt-5">
                        <div class="col-xl-12">
                            <div id="alertPLN"></div>
                        </div>
                        <div class="col-12">
                            @auth
                                <button type="submit" class="btn btn-danger mt-8 w-100 d-none"
                                    id="btnBayar2">Bayar</button>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Body-->
        </form>
        <!--end::Tiles Widget 2-->

    </div>
    <!--end::Col-->
</div>

@push('add-style')
    {{-- <script src="{{ asset('assets/js/custom/noTelp.js') }}"></script> --}}
@endpush

@push('add-script')
    <script>
        $(document).ready(function() {
            $('#noPelangganPLN').on('keyup', function() {
                $('#textAlert').hide();
            });
            var userLogin = {{isset(Auth::user()->name) ? "true" : "false"}}
            $('#categoryPLN').on('change', function() {
                if ($(this).val() == 'token') {
                    $('#plnPointItem').removeClass('d-none');
                    $.ajax({
                        type: "GET",
                        url: "/product/product-pln",
                        success: function(response) {
                            $('#productPLN').empty();
                            $('#nominal').removeClass('d-none');

                            $.each(response, function(key, value) {
                                $('#productPLN').append($('<option>', {
                                    value: value.id,
                                    text: value.description + ' - Rp. ' +
                                        value.price
                                }));
                            });

                            $('#productPLN').removeAttr('disabled');
                            // $('#btnPeriksaPLN').attr('type', 'submit');

                            $('#nomor-pelanggan').removeClass('col-6');
                            $('#nomor-pelanggan').addClass('col-12');
                            $('#product').removeClass('col-12');
                            $('#product').addClass('col-6');


                            $('#btnPeriksaPLN').addClass('d-none');
                            $('#btnBayar').removeClass('d-none');
                            $('#btnLogin').removeClass('d-none');
                        }
                    });

                }

                if ($(this).val() == 'pembayaran') {

                    $('#productPLN').empty();
                    $('#productPLN').attr('disabled', true);
                    // $('#btnPeriksaPLN').text('Periksa');
                    $('#nominal').addClass('d-none');

                    $('#plnPointItem').removeClass('d-none');
                    $('#nomor-pelanggan').removeClass('col-6');
                    $('#nomor-pelanggan').addClass('col-12');
                    $('#product').removeClass('col-6');
                    $('#product').addClass('col-12');

                    $('#btnPeriksaPLN').removeClass('d-none');
                    $('#btnBayar').addClass('d-none');
                    $('#btnLogin').addClass('d-none');

                }
            });

            $('#detailPLN').hide();

            $('#btnPeriksaPLN').on('click', function() {
                var noPelangganPLN = $('#noPelangganPLN').val();

                if (noPelangganPLN == '') {
                    $('#textAlert').show();
                    return false;
                }

                $('#alertPLN').empty()
                $('#detailPLN').hide();
                $('#btnPeriksaPLN').attr('disabled', true);
                $('#btnPeriksaPLN').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                );
                $('#btnBayar2').addClass('d-none');
                $.ajax({
                    type: "POST",
                    url: "{{ route('product.pln') }}",
                    data: {
                        'no_pelanggan': noPelangganPLN,
                        'nom': 'CEKPLN',
                    },
                    success: function(response) {
                        var simulateFeePLN = parseInt(response.data.fee);

                        var simulateAmountPLN = parseInt(response.data.tagihan);
                        var simulateTotalPLN = simulateAmountPLN + simulateFeePLN;

                        $('#namaPelangganPLN').text(response.data.nama_pelanggan);
                        $('#totalTagihanPLN').text(new Intl.NumberFormat('id-ID').format(
                            simulateAmountPLN));
                        $('#biayaAdminPLN').text(new Intl.NumberFormat('id-ID').format(
                            simulateFeePLN));
                        $('#totalBayarPLN').text(new Intl.NumberFormat('id-ID').format(
                            simulateTotalPLN));



                        $('#inputNamaPelangganPLN').val(response.data.no_pelanggan);
                        $('#inputTotalTagihanPLN').val(simulateAmountPLN);
                        $('#inputBiayaAdminPLN').val(simulateFeePLN);
                        $('#inputTotalBayarPLN').val(simulateTotalPLN);


                        $('#plnPointItem').removeClass('d-none');
                        $('#btnBayar').addClass('d-none');
                        // $('#btnPeriksaPLN').addClass('d-none');
                        // $('#btnPeriksaPLN').removeAttr('disabled');
                        $('#btnPeriksaPLN').text('Periksa');

                        $('#btnSubmitPLN').removeAttr('disabled');
                        $('#btnBayar2').removeClass('d-none');
                        // $('#btnLogin').removeClass('d-none');
                        $('#detailPLN').show();
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 400 || xhr.status === 500) {
                            // Buat elemen div dengan kelas 'alert' dan 'alert-danger'
                            var alertDiv = $(
                                `<div class="alert alert-danger alert-dismissible fade show" role="alert">${xhr.responseJSON.data}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`
                            );

                            $('#alertPLN').empty().append(alertDiv);
                        }

                        // Hapus spinner dan aktifkan tombol
                        $('#btnPeriksaPLN').removeAttr('disabled');
                        $('#btnPeriksaPLN').text('Periksa');
                    }
                });
            });
        });

        $(document).ready(function() {
            // Handle the change event of the checkbox
            $("#pln").change(function() {
                // Check if the checkbox is checked
                if ($(this).is(":checked")) {
                    // If checked, remove d-none from Grand Total 1 and add d-none to Grand Total 2
                    $("#plnPoint").prop("disabled", false);
                } else {
                    // If not checked, remove d-none from Grand Total 2 and add d-none to Grand Total 1
                    $("#plnPoint").prop("disabled", true);
                    $("#plnPoint").remove();
                }
            });
        });
    </script>
    {{-- <script>
    $(document).ready(function() {
            $('#notelp').on('keyup', function(e) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/ajax/ppob') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        operator: 'pln',
                        category: 'pln'
                    },
                    success: function(response) {
                        $('#row-pricelist').html('');

                        if (response.message != 'Unauthorized') {
                            $.each(response, function(key, val) {
                                $('#row-pricelist').append(
                                    `<div style="cursor:pointer" data-product="${val.id}" class="col-xl-2 col-sm-6 card border border-warning pricelist me-xl-2 mb-xl-3"><div class="card"><div class="card-header pt-5"><div class="card-title d-flex flex-column"><div class="d-flex align-items-center"><span class="fw-bold text-dark me-2">${val.description}</span></div><span class="text-gray-400 pt-1 fw-semibold fs-6">${val.price}</span></div></div></div></div>`
                                )
                            });
                        } else {
                            $('#row-pricelist').append(
                                '<div class="col-md-12"><a href="{{ route('login') }}">Login first</a></div>'
                            )
                        }
                    }
                }).done(function() {
                    $('.pricelist').on('click', function(e) {
                        const id = $(this).data('product');
                        const notelp = $('#notelp').val();

                        $('#row-pricelist').append(
                            `<form id="form_id" method="post" action="{{ route('cart') }}"  hidden>@csrf<input type="text" value="${id}" name="id" /><input type="text" value="${notelp}" name="notelp" /><button type="submit" class="btn-submit"></button></form> `
                        ).click(function() {
                            $('#form_id').submit();
                        });

                    })
                });
            })

        })
</script> --}}
@endpush
