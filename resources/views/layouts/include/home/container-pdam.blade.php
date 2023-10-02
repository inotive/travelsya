<div class="row gx-5 gx-xl-8 mb-xl-8 mb-5">
    <!--begin::Col-->
    <div class="col-xl-12">

        <!--begin::Tiles Widget 2-->
        <form action="{{ route('product.payment.pdam') }}" method="GET"
            class="card bgi-no-repeat bgi-size-contain card-xl-stretch mb-xl-8 container-xxl mb-5">
            <!--begin::Body-->
            <div class="card-body d-flex flex-column justify-content-between">
                <!--begin::Title-->
                <h2 class="fw-bold mb-5">PDAM</h2>
                <!--end::Title-->
                <div class="row mb-5 gy-4">
                    <div class="col-xl-6">
                        <label class="fs-5 fw-semibold mb-4">
                            <span class="required">Wilayah Pelanggan</span>
                        </label>
                        <select name="productPDAM" id="productPDAM" class="form-select form-select-lg"></select>
                    </div>
                    <div class="col-xl-6">
                        <label class="fs-5 fw-semibold mb-4">
                            <span class="required">Nomor Pelanggan</span>
                        </label>

                        <!--begin::Input-->
                        <input type="text" id="noPelangganPDAM" class="form-control form-control-lg"
                               name="noPelangganPDAM" placeholder="Masukan nomor pelanggan" value="" />
                        <small class="text-danger textAlert">No. Pelanggan harus terisi</small>
                        <!--end::Input-->

                        <input type="hidden" name="namaPelanggan" id="inputNamaPelangganPDAM">
                        <input type="hidden" name="totalTagihan" id="inputTotalTagihanPDAM">
                        <input type="hidden" name="biayaAdmin" id="inputBiayaAdminPDAM">
                        <input type="hidden" name="totalBayar" id="inputTotalBayarPDAM">
                    </div>
                    <div class="col-xl-12">
                        <button type="button" class="btn btn-lg btn-danger mt-8 w-100" id="btnPeriksaPDAM">Periksa</button>
                    </div>
                    <div class="row mt-4" id="detailPDAM">
                        <div class="col-12">
                            <label class="fs-5 fw-semibold my-3">
                                <span>Detail Pelanggan</span>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr class="py-5">
                                            <td class="bg-light fw-bold fs-6 text-gray-800">Nama Pelanggan</td>
                                            <td class="text-right" colspan="3"><span id="namaPelangganPDAM"></span></td>
                                        </tr>
                                        <tr class="py-5">
                                            <td class="bg-light fw-bold fs-6 text-gray-800">Total Tagihan</td>
                                            <td>Rp. <span id="totalTagihanPDAM"></span></td>
                                            <td class="bg-light fw-bold fs-6 text-gray-800">Biaya Admin</td>
                                            <td>Rp. <span id="biayaAdminPDAM"></span></td>
                                        </tr>
                                        <tr class="py-5">
                                            <td class="bg-light fw-bold fs-6 text-gray-800">Total Bayar</td>
                                            <td colspan="2">Rp. <span id="totalBayarPDAM"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="col-12">
                            @auth
                            <button type="submit" class="btn btn-danger w-100" id="btnSubmitPDAM"
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
                            <div id="alertContainer"></div>
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
                url: "{{ route('product.product.pdam') }}",
                success: function (response) {
                    $.each(response, function (key, value) {
                        $('#productPDAM').append($('<option>', {
                            value: value.id,
                            text: value.description
                        }));
                    });
                }
            });

            $('#noPelangganPDAM').on('keyup', function () {
                $('.textAlert').hide();
            });

            $('#detailPDAM').hide();

            $('#btnPeriksaPDAM').on('click', function () {
                var noPelangganPDAM = $('#noPelangganPDAM').val();

                if(noPelangganPDAM == '') {
                    $('.textAlert').show();
                    return false;
                }

                $('#alertContainer').empty()
                $('#detailPDAM').hide();
                $('#btnPeriksaPDAM').attr('disabled', true);
                $('#btnPeriksaPDAM').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');

                $.ajax({
                    type: "POST",
                    url: "{{ route('product.pdam') }}",
                    data: {
                        'no_pelanggan': noPelangganPDAM,
                        'nom': 'CEKPDAMBLP',
                    },
                    success: function (responseTagihan) {
                        console.log(responseTagihan);

                        $.ajax({
                            type: "POST",
                            url: "{{ route('product.adminFee') }}",
                            data: {
                                'idProduct': $('#productPDAM').val(),
                            },
                            success: function (response) {
                                var simulateFeePDAM = parseInt(response[0].value);

                                var simulateAmountPDAM = parseInt(responseTagihan.data.tagihan);
                                var simulateTotalPDAM = simulateAmountPDAM + simulateFeePDAM;

                                $('#namaPelangganPDAM').text(responseTagihan.data.nama_pelanggan);
                                $('#totalTagihanPDAM').text(new Intl.NumberFormat('id-ID').format(simulateAmountPDAM));
                                $('#biayaAdminPDAM').text(new Intl.NumberFormat('id-ID').format(simulateFeePDAM));
                                $('#totalBayarPDAM').text(new Intl.NumberFormat('id-ID').format(simulateTotalPDAM));

                                $('#inputNamaPelangganPDAM').val(responseTagihan.data.nama_pelanggan);
                                $('#inputTotalTagihanPDAM').val(simulateAmountPDAM);
                                $('#inputBiayaAdminPDAM').val(simulateFeePDAM);
                                $('#inputTotalBayarPDAM').val(simulateTotalPDAM);

                                $('#btnPeriksaPDAM').removeAttr('disabled');

                                $('#detailPDAM').show();
                            }
                        });

                        $('#btnPeriksaPDAM').text('Periksa');
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 400) {
                            // Buat elemen div dengan kelas 'alert' dan 'alert-danger'
                            var alertDiv = $(`<div class="alert alert-danger alert-dismissible fade show" role="alert">${xhr.responseJSON.data}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`);

                            // Isi elemen div dengan pesan kesalahan dari respons JSON
                            // alertDiv.text(xhr.responseJSON.data);

                            // Tambahkan elemen alert ke dalam elemen yang ingin Anda tampilkan
                            $('#alertContainer').empty().append(alertDiv);
                        }

                        // Hapus spinner dan aktifkan tombol
                        $('#btnPeriksaPDAM').removeAttr('disabled');
                        $('#btnPeriksaPDAM').html('Periksa');
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
                        operator: 'pdam',
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
