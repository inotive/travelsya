<div class="row gx-5 gx-xl-8 mb-xl-8 mb-5">
    <!--begin::Col-->
    <div class="col-xl-12">

        <!--begin::Tiles Widget 2-->
        <form action="{{ route('product.payment.bpjs') }}" method="GET" class="card bgi-no-repeat bgi-size-contain card-xl-stretch mb-xl-8 container-xxl mb-5">

            <!--begin::Body-->
            <div class="card-body d-flex flex-column justify-content-between">
                <!--begin::Title-->
                <h2 class="fw-bold mb-5">BPJS</h2>
                <!--end::Title-->
                <div class="row mb-5 gy-4">
                    <div class="col-12">
                        <label class="fs-5 fw-semibold mb-2">
                            <span class="required">Produk</span>
                        </label>

                        <select name="product_id" id="productBPJS" class="form-control form-control-lg">
                            <option value="362" selected>BPJS Kesehatan</option>
                        </select>
                    </div>
                    <div class="col-xl-8">
                        <label class="fs-5 fw-semibold mb-2">
                            <span class="required">Nomor BPJS</span>
                        </label>

                        <!--begin::Input-->
                        <input type="text" id="noPelangganBPJS" class="form-control form-control-lg" name="noPelangganBPJS" placeholder="Masukan nomor BPJS" value=""/>
                        <small class="text-danger textAlert" style="display: none">No. BPJS harus terisi</small>
                        <!--end::Input-->

                        <input type="hidden" name="namaPelanggan" id="inputNamaPelangganBPJS">
                        <input type="hidden" name="totalTagihan" id="inputTotalTagihanBPJS">
                        <input type="hidden" name="biayaAdmin" id="inputBiayaAdminBPJS">
                        <input type="hidden" name="totalBayar" id="inputTotalBayarBPJS">
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-danger mt-8 w-100" id="btnPeriksaBPJS">Periksa</button>
                    </div>
                    <div class="col-12">
                        <label class="fs-5 fw-semibold my-3">
                            <span>Detail Pelanggan</span>
                        </label>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="py-5">
                                        <td class="bg-light fw-bold fs-6 text-gray-800">Nama Pelanggan</td>
                                        <td class="text-right" colspan="3"><span id="namaPelangganBPJS"></span></td>
                                    </tr>
                                    <tr class="py-5">
                                        <td class="bg-light fw-bold fs-6 text-gray-800">Total Tagihan</td>
                                        <td>Rp. <span id="totalTagihanBPJS"></span></td>
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
                    <div class="col-12">
                        <button type="submit" class="btn btn-danger w-100">Pembayaran</button>
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

        $('#noPelangganBPJS').on('keyup', function () {
            $('.textAlert').hide();
        });

        $('#btnPeriksaBPJS').on('click', function () {
            var noPelangganBPJS = $('#noPelangganBPJS').val();

            if(noPelangganBPJS == '') {
                $('.textAlert').show();
                return false;
            }

            $.ajax({
                type: "POST",
                // url: "{{ route('product.bpjs') }}",
                url: "https://servicevps.travelsya.com/product/bpjs",
                data: {
                    'no_pelanggan': noPelangganBPJS,
                    'nom': 'CEKBPJSKS',
                },
                success: function (responseTagihan) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('product.adminFee') }}",
                        data: {
                            'idProduct':  362,
                        },
                        success: function (response) {
                            var simulateFeeBPJS = parseInt(response[0].value);

                            var simulateAmountBPJS = parseInt(responseTagihan.data.tagihan);
                            var simulateTotalBPJS = simulateAmountBPJS + simulateFeeBPJS;

                            $('#namaPelangganBPJS').text(responseTagihan.data.nama_pelanggan);
                            $('#totalTagihanBPJS').text(new Intl.NumberFormat('id-ID').format(simulateAmountBPJS));
                            $('#biayaAdminBPJS').text(new Intl.NumberFormat('id-ID').format(simulateFeeBPJS));
                            $('#totalBayarBPJS').text(new Intl.NumberFormat('id-ID').format(simulateTotalBPJS));

                            $('#inputNamaPelangganBPJS').val(responseTagihan.data.nama_pelanggan);
                            $('#inputTotalTagihanBPJS').val(simulateAmountBPJS);
                            $('#inputBiayaAdminBPJS').val(simulateFeeBPJS);
                            $('#inputTotalBayarBPJS').val(simulateTotalBPJS);
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
