{{-- <div class="text-center">
    <h2>This Service Still Under Construction</h2>
</div> --}}

<div class="row gx-5 gx-xl-8 mb-xl-8 mb-5">
    <!--begin::Col-->
    <div class="col-xl-12">

        <!--begin::Tiles Widget 2-->
        <form action="{{ route('product.payment.tax') }}" method="GET"
            class="card bgi-no-repeat bgi-size-contain card-xl-stretch mb-xl-8 container-xxl mb-5">
            <!--begin::Body-->
            <div class="card-body d-flex flex-column justify-content-between">
                <!--begin::Title-->
                <h2 class="fw-bold mb-5">Pajak</h2>
                <!--end::Title-->
                <div class="row mb-5 gy-4">
                    <div class="col-xl-4">
                        <label class="fs-5 fw-semibold mb-2">
                            <span class="required">Nomor Pelanggan</span>
                        </label>

                        <!--begin::Input-->
                        <input type="text" id="noPelangganPajak" class="form-control form-control-lg"
                            name="noPelangganPajak" placeholder="Masukan nomor pelanggan" value="" />
                        <small class="text-danger textAlert" style="display: none">No. Pelanggan harus terisi</small>
                        <!--end::Input-->

                        <input type="hidden" name="namaPelanggan" id="inputNamaPelangganPajak">
                        <input type="hidden" name="totalTagihan" id="inputTotalTagihanPajak">
                        <input type="hidden" name="biayaAdmin" id="inputBiayaAdminPajak">
                        <input type="hidden" name="totalBayar" id="inputTotalBayarPajak">
                    </div>
                    <div class="col-xl-4">
                        <label class="fs-5 fw-semibold mb-2">
                            <span class="required">Wilayah Pelanggan</span>
                        </label>
                        <select name="productPajak" id="productPajak" class="form-select form-select-lg"></select>
                    </div>
                    <div class="col-xl-4">
                        <button type="button" class="btn btn-danger mt-8 w-100" id="btnPeriksaPajak">Periksa</button>
                    </div>

                    <div class="row mt-4" id="detailPajak">
                        <div class="col-12">
                            <label class="fs-5 fw-semibold my-3">
                                <span>Detail Pelanggan</span>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr class="py-5">
                                            <td class="bg-light fw-bold fs-6 text-gray-800">Nama Pelanggan</td>
                                            <td class="text-right" colspan="3"><span id="namaPelangganPajak"></span>
                                            </td>
                                        </tr>
                                        <tr class="py-5">
                                            <td class="bg-light fw-bold fs-6 text-gray-800">Total Tagihan</td>
                                            <td>Rp. <span id="totalTagihanPajak"></span></td>
                                            <td class="bg-light fw-bold fs-6 text-gray-800">Biaya Admin</td>
                                            <td>Rp. <span id="biayaAdminPajak"></span></td>
                                        </tr>
                                        <tr class="py-5">
                                            <td class="bg-light fw-bold fs-6 text-gray-800">Total Bayar</td>
                                            <td colspan="2">Rp. <span id="totalBayarPajak"></span></td>
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

                    <div class="row mt-5">
                        <div class="col-xl-12">
                            <div id="alertPajak"></div>
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
<script src="{{ asset('assets/js/custom/noTelp.js') }}"></script>
@endpush

@push('add-script')
<script>
    $(document).ready(function () {

            $.ajax({
                type: "GET",
                url: "{{ route('product.product.tax') }}",
                success: function (response) {
                    $('#productPajak').empty();

                    $.each(response, function (key, value) {
                        $('#productPajak').append($('<option>', {
                            value: value.kode,
                            text: value.description
                        }));
                    });
                }
            });

            $('#noPelangganPajak').on('keyup', function () {
                $('.textAlert').hide();
            });


            $('#detailPajak').hide();

            $('#btnPeriksaPajak').on('click', function () {
                var noPelangganPajak = $('#noPelangganPajak').val();

                if(noPelangganPajak == '') {
                    $('.textAlert').show();
                    return false;
                }

                $('#alertPajak').empty()
                $('#detailPajak').hide();
                $('#btnPeriksaPajak').attr('disabled', true);
                $('#btnPeriksaPajak').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');

                $.ajax({
                    type: "POST",
                    url: "{{ route('product.tax') }}",
                    data: {
                        'no_pelanggan': noPelangganPajak,
                        'nom': $('#productPajak').val()
                    },
                    success: function (response) {
                        // var simulateFeePajak = parseInt(responseTagihan.data.fee)

                        // SIMULASI!!!
                        var simulateFeePajak = 1000;
                        var simulateAmountPajak = Math.floor(Math.random() * (300000 - 150000 + 1)) + 150000;
                        var simulateTotalPajak = simulateAmountPajak + simulateFeePajak;

                        $('#namaPelangganPajak').text('Joko Susilo');
                        $('#totalTagihanPajak').text(new Intl.NumberFormat('id-ID').format(simulateAmountPajak));
                        $('#biayaAdminPajak').text(new Intl.NumberFormat('id-ID').format(simulateFeePajak));
                        $('#totalBayarPajak').text(new Intl.NumberFormat('id-ID').format(simulateTotalPajak));

                        $('#inputNamaPelangganPajak').val('Joko Susilo');
                        $('#inputTotalTagihanPajak').val(simulateAmountPajak);
                        $('#inputBiayaAdminPajak').val(simulateFeePajak);
                        $('#inputTotalBayarPajak').val(simulateTotalPajak);

                        $('#btnPeriksaPajak').removeAttr('disabled');
                        $('#btnPeriksaPajak').html('Periksa');
                        $('#detailPajak').show();
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 400 || xhr.status === 500) {
                            var alertDiv = $(`<div class="alert alert-danger alert-dismissible fade show" role="alert">${xhr.responseJSON.data}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`);

                            $('#alertPajak').empty().append(alertDiv);
                        }

                        // Hapus spinner dan aktifkan tombol
                        $('#btnPeriksaPajak').removeAttr('disabled');
                        $('#btnPeriksaPajak').html('Periksa');
                    }
                });
            });
        });
</script>

{{-- <script>
    $(document).ready(function () {
            $('#notelp').on('keyup', function (e) {

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
                        operator: 'Pajak',
                        category: 'negara'
                    },
                    success: function (response) {
                        $('#row-pricelist').html('');

                        if (response.message != 'Unauthorized') {
                            $.each(response, function (key, val) {
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
                }).done(function () {
                    $('.pricelist').on('click', function (e) {
                        const id = $(this).data('product');
                        const notelp = $('#notelp').val();

                        $('#row-pricelist').append(
                            `<form id="form_id" method="post" action="{{ route('cart') }}"  hidden>@csrf<input type="text" value="${id}" name="id" /><input type="text" value="${notelp}" name="notelp" /><button type="submit" class="btn-submit"></button></form> `
                        ).click(function () {
                            $('#form_id').submit();
                        });

                    })
                });
            })

        })
</script> --}}
@endpush