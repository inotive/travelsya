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
                    <div class="col-xl-8">
                        <label class="fs-5 fw-semibold mb-2">
                            <span class="required">Nomor Pelanggan</span>
                        </label>

                        <input type="text" id="noPelangganPLN" class="form-control form-control-lg"
                            name="noPelangganPLN" placeholder="Masukan nomor pelanggan" value="" />
                        <small class="text-danger"  id="textAlert">No. Pelanggan harus
                            terisi</small>

                        <input type="hidden" name="namaPelanggan" id="inputNamaPelangganPLN">
                        <input type="hidden" name="totalTagihan" id="inputTotalTagihanPLN">
                        <input type="hidden" name="biayaAdmin" id="inputBiayaAdminPLN">
                        <input type="hidden" name="totalBayar" id="inputTotalBayarPLN">
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-danger mt-8 w-100" id="btnPeriksaPLN">Periksa</button>
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
                                            <td class="text-right" colspan="3"><span id="namaPelangganPLN"></span></td>
                                        </tr>
                                        <tr class="py-5">
                                            <td class="bg-light fw-bold fs-6 text-gray-800">Total Tagihan</td>
                                            <td>Rp. <span id="totalTagihanPLN"></span></td>
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
                        <div class="col-12">
                            @auth
                            <button type="submit" class="btn btn-danger w-100" id="btnSubmitPLN"
                                disabled>Pembayaran</button>
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
                            <div id="alertPLN"></div>
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
    $(document).ready(function () {
            $('#noPelangganPLN').on('keyup', function () {
                $('#textAlert').hide();
            });

            $('#detailPLN').hide();

            $('#btnPeriksaPLN').on('click', function () {
                var noPelangganPLN = $('#noPelangganPLN').val();

                if(noPelangganPLN == '') {
                    $('#textAlert').show();
                    return false;
                }

                $('#alertPLN').empty()
                $('#detailPLN').hide();
                $('#btnPeriksaPLN').attr('disabled', true);
                $('#btnPeriksaPLN').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');

                $.ajax({
                    type: "POST",
                    url: "{{ route('product.pln') }}",
                    data: {
                        'no_pelanggan': noPelangganPLN,
                        'nom': 'CEKPLN',
                    },
                    success: function (response) {
                        var simulateFeePLN = parseInt(response.data.fee);

                        var simulateAmountPLN = parseInt(response.data.tagihan);
                        var simulateTotalPLN = simulateAmountPLN + simulateFeePLN;

                        $('#namaPelangganPLN').text(response.data.nama_pelanggan);
                        $('#totalTagihanPLN').text(new Intl.NumberFormat('id-ID').format(simulateAmountPLN));
                        $('#biayaAdminPLN').text(new Intl.NumberFormat('id-ID').format(simulateFeePLN));
                        $('#totalBayarPLN').text(new Intl.NumberFormat('id-ID').format(simulateTotalPLN));

                        $('#inputNamaPelangganPLN').val(response.data.no_pelanggan);
                        $('#inputTotalTagihanPLN').val(simulateAmountPLN);
                        $('#inputBiayaAdminPLN').val(simulateFeePLN);
                        $('#inputTotalBayarPLN').val(simulateTotalPLN);

                        $('#btnPeriksaPLN').removeAttr('disabled');
                        $('#btnPeriksaPLN').text('Periksa');

                        $('#btnSubmitPLN').removeAttr('disabled');

                        $('#detailPLN').show();
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 400 || xhr.status === 500) {
                            // Buat elemen div dengan kelas 'alert' dan 'alert-danger'
                            var alertDiv = $(`<div class="alert alert-danger alert-dismissible fade show" role="alert">${xhr.responseJSON.data}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`);

                            $('#alertPLN').empty().append(alertDiv);
                        }

                        // Hapus spinner dan aktifkan tombol
                        $('#btnPeriksaPLN').removeAttr('disabled');
                        $('#btnPeriksaPLN').text('Periksa');
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
