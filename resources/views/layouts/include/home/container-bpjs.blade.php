<div class="row gx-5 gx-xl-8 mb-xl-8 mb-5">
    <!--begin::Col-->
    <div class="col-xl-12">

        <!--begin::Tiles Widget 2-->
        <form action="" method="GET"
            class="card bgi-no-repeat bgi-size-contain card-xl-stretch mb-xl-8 container-xxl mb-5">

            <!--begin::Body-->
            <div class="card-body d-flex flex-column justify-content-between">
                <!--begin::Title-->
                <h2 class="fw-bold mb-5">BPJS</h2>
                <!--end::Title-->
                <div class="row mb-5 gy-4">
                    <div class="col-6">
                        <label class="fs-5 fw-semibold mb-3">
                            <span class="required">Produk</span>
                        </label>

                        <select name="product_id" id="productBPJS" class="form-control form-control-lg">
                            <option value="362" selected>BPJS Kesehatan</option>
                        </select>
                    </div>
                    <div class="col-xl-6">
                        <label class="fs-5 fw-semibold mb-3">
                            <span class="required">Nomor BPJS</span>
                        </label>

                        <!--begin::Input-->
                        <input type="text" id="noPelangganBPJS" class="form-control form-control-lg"
                            name="noPelangganBPJS" placeholder="Masukan nomor BPJS" value="" />
                        <small class="text-danger textAlert">No. BPJS harus terisi</small>
                        <!--end::Input-->

                        <input type="hidden" name="namaPelanggan" id="inputNamaPelangganBPJS">
                        <input type="hidden" name="totalTagihan" id="inputTotalTagihanBPJS">
                        <input type="hidden" name="biayaAdmin" id="inputBiayaAdminBPJS">
                        <input type="hidden" name="totalBayar" id="inputTotalBayarBPJS">
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-danger mt-8 w-100" id="btnPeriksaBPJS">Periksa</button>
                    </div>
                    <div class="row mt-4" id="detailBPJS">
                        <div class="col-12">
                            <label class="fs-5 fw-semibold my-3">
                                <span>Detail Pelanggan</span>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr class="py-5">
                                            <td class="bg-light fw-bold fs-6 text-gray-800">Nama Pelanggan</td>
                                            <td class="text-right" colspan="3"><span id="namaPelangganBPJS"></span>
                                            </td>
                                        </tr>
                                        <tr class="py-5">
                                            <td class="bg-light fw-bold fs-6 text-gray-800">Total Tagihan</td>
                                            <td>Rp. <span id="totalTagihanBPJS"></span></td>
                                        </tr>
                                        <tr class="py-5">
                                            <td class="bg-light fw-bold fs-6 text-gray-800">Biaya Admin</td>
                                            <td>Rp. <span id="biayaAdminBPJS"></span></td>
                                        </tr>
                                        <tr class="py-5">
                                            <td class="bg-light fw-bold fs-6 text-gray-800">Total Bayar</td>
                                            <td colspan="2">Rp. <span id="totalBayarBPJS"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @auth
                            <div class="col-12 d-flex justify-content-between d-none">
                                <p class="fw-light-grey-900">Anda Memiliki Point <b>{{ auth()->user()->point }}</b>. Pakai
                                    Point
                                </p>
                                <h4>
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input pakai-point" type="checkbox" name=""
                                            {{ auth()->user()->point == 0 ? 'disabled' : '' }} id="bpjs" />
                                    </div>
                                </h4>
                            </div>
                            <input type="hidden" name="point" value="{{ auth()->user()->point }}" id="bpjsPoint"
                                disabled>
                        @endauth
                        <div class="col-12">
                            @auth
                                <button type="submit" class="btn btn-danger w-100" id="btnSubmitBPJS"
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
                            <div id="alertBPJS"></div>
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
        $(document).ready(function() {

            $('#noPelangganBPJS').on('keyup', function() {
                $('.textAlert').hide();
            });

            $('#detailBPJS').hide();

            $('#btnPeriksaBPJS').on('click', function() {
                var noPelangganBPJS = $('#noPelangganBPJS').val();

                if (noPelangganBPJS == '') {
                    $('.textAlert').show();
                    return false;
                }

                $('#alertBPJS').empty()
                $('#detailBPJS').hide();
                $('#btnPeriksaBPJS').attr('disabled', true);
                $('#btnPeriksaBPJS').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                );

                $.ajax({
                    type: "POST",
                    url: "{{ route('product.bpjs') }}",
                    data: {
                        'no_pelanggan': "0"+noPelangganBPJS,
                        'nom': 'CEKBPJSKS',
                    },
                    success: function(responseTagihan) {

                        var simulateFeeBPJS = parseInt(responseTagihan.data.fee);

                        var simulateAmountBPJS = parseInt(responseTagihan.data.tagihan);
                        var simulateTotalBPJS = simulateAmountBPJS + simulateFeeBPJS;

                        $('#namaPelangganBPJS').text(responseTagihan.data.nama_pelanggan);
                        $('#totalTagihanBPJS').text(new Intl.NumberFormat('id-ID').format(
                            simulateAmountBPJS));
                        $('#biayaAdminBPJS').text(new Intl.NumberFormat('id-ID').format(
                            simulateFeeBPJS));
                        $('#totalBayarBPJS').text(new Intl.NumberFormat('id-ID').format(
                            simulateTotalBPJS));

                        $('#inputNamaPelangganBPJS').val(responseTagihan.data.nama_pelanggan);
                        $('#inputTotalTagihanBPJS').val(simulateAmountBPJS);
                        $('#inputBiayaAdminBPJS').val(simulateFeeBPJS);
                        $('#inputTotalBayarBPJS').val(simulateTotalBPJS);

                        $('#btnPeriksaBPJS').removeAttr('disabled');
                        $('#btnPeriksaBPJS').text('Periksa');

                        $('#btnSubmitBPJS').removeAttr('disabled');

                        $('#detailBPJS').show();
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 400) {
                            var alertBPJS = $(
                                `<div class="alert alert-danger alert-dismissible fade show" role="alert">${xhr.responseJSON.data}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`
                            );

                            $('#alertBPJS').empty().append(alertBPJS);
                        }

                        $('#btnPeriksaBPJS').removeAttr('disabled');
                        $('#btnPeriksaBPJS').html('Periksa');
                    }
                });
            });
        });

        $(document).ready(function() {
            // Handle the change event of the checkbox
            $("#bpjs").change(function() {
                // Check if the checkbox is checked
                if ($(this).is(":checked")) {
                    // If checked, remove d-none from Grand Total 1 and add d-none to Grand Total 2
                    $("#bpjsPoint").prop("disabled", false);
                } else {
                    // If not checked, remove d-none from Grand Total 2 and add d-none to Grand Total 1
                    $("#bpjsPoint").prop("disabled", true);
                    $("#bpjsPoint").remove();
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
                        operator: 'bpjs',
                        category: 'bpjs'
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
