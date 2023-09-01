<div class="row gx-5 gx-xl-8 mb-xl-8 mb-5">
    <!--begin::Col-->
    <div class="col-xl-12">

        <!--begin::Tiles Widget 2-->
        <div class="card bgi-no-repeat bgi-size-contain card-xl-stretch mb-xl-8 container-xxl mb-5">

            <!--begin::Body-->
            <form action="{{ route('product.payment.pulsa.data') }}" method="GET" class="card-body d-flex flex-column justify-content-between">
                <!--begin::Title-->
                <h2 class="fw-bold mb-5">Pulsa & Data</h2>
                <!--end::Title-->
                <div class="row mb-5 gy-4">
                    <div class="col-12">
                        <label class="fs-5 fw-semibold mb-2">
                            <span >Produk</span>
                        </label>

                        <select name="category" id="category" class="form-control form-control-lg" onchange="checkOperator()">
                            <option value="pulsa" selected>Pulsa</option>
                            <option value="data">Paket Data</option>
                        </select>
                    </div>
                    <div class="col-xl-6">
                        <label class="fs-5 fw-semibold mb-2">
                            <span >Nomor Handphone</span>
                        </label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text" id="inputGroup-sizing-lg">
                                <img src="https://image.gambarpng.id/pngs/gambar-transparent-pin-code_60985.png" id="logo_provider" alt="" height="25" width="25">
                            </span>
                            <input type="text" id="no_telp" name="notelp" class="form-control" placeholder="08xx" onkeyup="checkOperator()"/>
                        </div>
                    </div>

                    <div class="col-6">
                        <label class="fs-5 fw-semibold mb-2">
                            <span>Nominal</span>
                        </label>

                        <select name="product" id="product" class="form-control form-control-lg"></select>
                    </div>

                </div>

                <div class="row">
                    <div class="col">
                        @auth
                            <button type="submit" class="btn btn-danger w-100">Bayar</button>
                        @endauth

                        @guest
                            <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger w-100">
                                Login Terlebih Dahulu
                            </button>
                        @endguest
                    </div>
                </div>
            </form>
            <!--end::Body-->
        </div>
        <!--end::Tiles Widget 2-->
    </div>
    <!--end::Col-->

    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login Terlebih Dahulu</h5>
                </div>
                <div class="modal-body">
                    <div class="row gy-4">
                        <div class="col-12">
                            <label for="" class="form-label">Email</label>
                            <input type="text" class="form-control form-control-lg"
                                placeholder="Masukan Email Anda">
                        </div>
                        <div class="col-12">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control form-control-lg"
                                placeholder="Masukan Password Anda">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-lg btn-light">Kembali</button>
                    <a href="{{ route('login') }}" class="btn btn-lg text-white"
                        style="background-color: #c02425">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('add-style')
    <script src="{{ asset('assets/js/custom/noTelp.js') }}"></script>
@endpush

@push('add-script')
    <script>
        function checkOperator() {
            var category = $('#category').val();
            var nomerHP = $('#no_telp').val();
            var provider = '';

            // Empty Provider
            if (nomerHP == null || nomerHP == "" || nomerHP < 4) {
                $('#logo_provider').attr('src', 'https://image.gambarpng.id/pngs/gambar-transparent-pin-code_60985.png');
                provider = '';
            }

            // Telkomsel
            if (/^0812|^0822|^0852|^0853|^0811|^0813|^0851|^0821/.test(nomerHP)) {
                $('#logo_provider').attr('src', 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bc/Telkomsel_2021_icon.svg/1200px-Telkomsel_2021_icon.svg.png');
                provider = 'telkomsel'
            }

            // Indosat
            if (/^0857|^0856/.test(nomerHP)) {
                $('#logo_provider').attr('src', 'https://upload.wikimedia.org/wikipedia/commons/a/ac/Indosat_Ooredoo_logo_%282017%29.svg');
                provider = 'indosat'
            }

            // Three
            if (/^0896|^0895|^0897|^0898|^0899/.test(nomerHP)) {
                $('#logo_provider').attr('src', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/40/Three_logo.svg/370px-Three_logo.svg.png');
                provider = 'three'
            }

            // XL
            if (/^0817|^0818|^0819|^0859|^0877|^0878/.test(nomerHP)) {
                $('#logo_provider').attr('src', 'https://upload.wikimedia.org/wikipedia/en/5/55/XL_logo_2016.svg');
                provider = 'xl'
            }

            // AXIS
            if (/^0831|^0832|^0833|^0838/.test(nomerHP)) {
                $('#logo_provider').attr('src', 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Axis_logo_2015.svg/2560px-Axis_logo_2015.svg.png');
                provider = 'axis'
            }

            // Smartfren
            if (/^0881|^0882|^0883|^0884|^0885|^0886|^0887|^0888|^0889/.test(nomerHP)) {
                $('#logo_provider').attr('src', 'https://seeklogo.com/images/S/smartfren-logo-A978AD9193-seeklogo.com.png');
                provider = 'smartfren'
            }

            if (nomerHP.length <= 4) {
                if(provider !== '') {
                    $.ajax({
                        type: "GET",
                        url: "/product/"+category+"/"+provider,
                        success: function (response) {
                            // console.log(response)

                            $('#product').empty();

                            // Menambahkan pilihan berdasarkan respons
                            $.each(response, function (key, value) {
                                $('#product').append($('<option>', {
                                    value: value.id,
                                    text: value.description+ ' - Rp. '+value.price
                                }));
                            });
                        }
                    });
                }
            }
        }

        $(document).ready(function() {

            const { getOperator} = window.NoTelp;

            $('#no_telp').on('keyup', function(e) {
                var notelp = e.target.value;
                var operatorTelp1 = getOperator(notelp);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });

                if (operatorTelp1.valid) {
                    $.ajax({
                        url: "{{ url('/ajax/ppob') }}",
                        type: "POST",
                        dataType: 'json',
                        data: {
                            operator: operatorTelp1.operator,
                            category: 'pulsa'
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
                }
            })

        })
    </script>
@endpush
