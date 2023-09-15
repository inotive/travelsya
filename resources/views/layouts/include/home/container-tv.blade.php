<div class="row gx-5 gx-xl-8 mb-xl-8 mb-5">
    <!--begin::Col-->
    <div class="col-xl-12">

        <!--begin::Tiles Widget 2-->
        <form action="{{ route('product.payment.tvInternet') }}" method="GET" class="card bgi-no-repeat bgi-size-contain card-xl-stretch mb-xl-8 container-xxl mb-5">

            <!--begin::Body-->
            <div class="card-body d-flex flex-column justify-content-between">
                <!--begin::Title-->
                <h2 class="fw-bold mb-5">TV-Internet</h2>
                <!--end::Title-->
                <div class="row mb-5 gy-4">
                    <div class="col-xl-4">
                        <label class="fs-5 fw-semibold mb-2">
                            <span class="required">No Pelanggan</span>
                        </label>

                        <!--begin::Input-->
                        <input type="text" id="noPelangganTV" class="form-control form-control-lg form-control-solid"
                            name="noPelangganTV" placeholder="" value="" />
                        <small class="text-danger textAlert" style="display: none">No. Pelanggan harus terisi</small>
                        <!--end::Input-->

                        <input type="hidden" name="namaPelanggan" id="inputNamaPelangganTV">
                        <input type="hidden" name="totalTagihan" id="inputTotalTagihanTV">
                        <input type="hidden" name="biayaAdmin" id="inputBiayaAdminTV">
                        <input type="hidden" name="totalBayar" id="inputTotalBayarTV">
                    </div>
                    <div class="col-xl-4">
                        <label class="fs-5 fw-semibold mb-2">
                            <span class="required">Wilayah Pelanggan</span>
                        </label>
                        <select name="productTV" id="productTV" class="form-select form-select-lg"></select>
                    </div>
                    <div class="col-xl-4">
                        <button type="button" class="btn btn-danger mt-8 w-100" id="btnPeriksaTV">Periksa</button>
                    </div>
                </div>
                <div class="row" id="row-pricelist">
                    <div class="col-12">
                        <label class="fs-5 fw-semibold my-3">
                            <span>Detail Pelanggan</span>
                        </label>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                <tr class="py-5">
                                    <td class="bg-light fw-bold fs-6 text-gray-800">Nama Pelanggan</td>
                                    <td class="text-right" colspan="3"><span id="namaPelangganTV"></span></td>
                                </tr>
                                <tr class="py-5">
                                    <td class="bg-light fw-bold fs-6 text-gray-800">Total Tagihan</td>
                                    <td>Rp. <span id="totalTagihanTV"></span></td>
                                    <td class="bg-light fw-bold fs-6 text-gray-800">Biaya Admin</td>
                                    <td>Rp. <span id="biayaAdminTV"></span></td>
                                </tr>
                                <tr class="py-5">
                                    <td class="bg-light fw-bold fs-6 text-gray-800">Total Bayar</td>
                                    <td colspan="2">Rp. <span id="totalBayarTV"></span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="col-12">
                        @auth
                            <button type="submit" class="btn btn-danger w-100">Pembayaran</button>
                        @endauth

                        @guest
                            <a href="{{ route('login') }}" class="btn btn-danger w-100">
                                Login Terlebih Dahulu
                            </a>
                        @endguest
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
    <script src="{{ asset('assets/js/custom/noTelp.js') }}"></script>
@endpush

@push('add-script')
    <script>
        $(document).ready(function () {

            $.ajax({
                type: "GET",
                url: "{{ route('product.product.tvInternet') }}",
                // url: "https://servicevps.travelsya.com/product/tv-internet",
                success: function (response) {
                    $.each(response, function (key, value) {
                        $('#productTV').append($('<option>', {
                            value: value.id,
                            text: value.name
                        }));
                    });
                }
            });

            $('#noPelangganTV').on('keyup', function () {
                $('.textAlert').hide();
            });

            $('#btnPeriksaTV').on('click', function () {
                var noPelangganTV = $('#noPelangganTV').val();

                if(noPelangganTV == '') {
                    $('.textAlert').show();
                    return false;
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('product.tvInternet') }}",
                    data: {
                        'no_pelanggan': noPelangganTV,
                        'nom': 'CEKTELKOM',
                    },
                    success: function (responseTagihan) {
                        // console.log(response)

                        // SIMULASI!!!
                        // var simulateAmount = Math.floor(Math.random() * (300000 - 150000 + 1)) + 150000;
                        // var simulateFee = Math.floor(Math.random() * (3000 - 1500 + 1)) + 1500;
                        // var simulateTotal = simulateAmount + simulateFee;

                        // $('#namaPelangganTV').text('Joko Susilo');
                        // $('#totalTagihanTV').text(new Intl.NumberFormat('id-ID').format(simulateAmount));
                        // $('#biayaAdminTV').text(new Intl.NumberFormat('id-ID').format(simulateFee));
                        // $('#totalBayarTV').text(new Intl.NumberFormat('id-ID').format(simulateTotal));

                        // $('#inputNamaPelangganTV').val('Joko Susilo');
                        // $('#inputTotalTagihanTV').val(simulateAmount);
                        // $('#inputBiayaAdminTV').val(simulateFee);
                        // $('#inputTotalBayarTV').val(simulateTotal);

                        $.ajax({
                            type: "POST",
                            url: "{{ route('product.adminFee') }}",
                            data: {
                                'idProduct':  $('#productTV').val(),
                            },
                            success: function (response) {
                                var simulateFeeTV = parseInt(response[0].value);

                                var simulateAmountTV = parseInt(responseTagihan.data.tagihan);
                                var simulateTotalTV = simulateAmountTV + simulateFeeTV;

                                $('#namaPelangganTV').text(responseTagihan.data.nama_pelanggan);
                                $('#totalTagihanTV').text(new Intl.NumberFormat('id-ID').format(simulateAmountTV));
                                $('#biayaAdminTV').text(new Intl.NumberFormat('id-ID').format(simulateFeeTV));
                                $('#totalBayarTV').text(new Intl.NumberFormat('id-ID').format(simulateTotalTV));

                                $('#inputNamaPelangganTV').val(responseTagihan.data.nama_pelanggan);
                                $('#inputTotalTagihanTV').val(simulateAmountTV);
                                $('#inputBiayaAdminTV').val(simulateFeeTV);
                                $('#inputTotalBayarTV').val(simulateTotalTV);
                            }
                        });
                    }
                });
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
                        operator: '',
                        category: 'tv-internet'
                    },
                    success: function(response) {
                        $('#row-pricelist').html('');

                        if (response.message != 'Unauthorized') {
                            $.each(response, function(key, val) {
                                $('#row-pricelist').append(
                                    `<div style="cursor:pointer" data-product="${val.id}" class="col-xl-2 col-sm-6 card border border-warning pricelist me-xl-2 mb-xl-3"><div class="card"><div class="card-header pt-5"><div class="card-title d-flex flex-column"><div class="d-flex align-items-center"><span class="fw-bold text-dark me-2">${val.name}</span></div><span class="text-gray-400 pt-1 fw-semibold fs-6">${val.description}</span></div></div></div></div>`
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
