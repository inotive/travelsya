<div class="row gx-5 gx-xl-8 mb-xl-8 mb-5">
    <!--begin::Col-->
    <div class="col-xl-12">

        <!--begin::Tiles Widget 2-->
        <div class="card bgi-no-repeat bgi-size-contain card-xl-stretch mb-xl-8 container-xxl mb-5">

            <!--begin::Body-->
            <form method="post" action="{{ url('ewallet/payment') }}"
                class="card-body d-flex flex-column justify-content-between">
                @csrf
                <!--begin::Title-->
                <h2 class="fw-bold mb-5">E-Wallet</h2>
                <!--end::Title-->
                <div class="row mb-5 gy-4">
                    <div class="col-6">
                        <label class="fs-5 fw-semibold mb-2">
                            <span>Jenis Produk</span>
                        </label>
                        <select name="jenis_ewallet" id="jenis_ewallet" class="form-select form-select-lg" required>
                            <option value="">Pilih E-Wallet</option>
                            @foreach ($ewallets as $ewallet)
                            <option value="{{ $ewallet }}">{{ $ewallet }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="fs-5 fw-semibold mb-2">
                            <span>Produk</span>
                        </label>

                        <select name="produk_ewallet" id="produk_ewallet" class="form-select form-select-lg"
                            required></select>
                    </div>
                    <div class="col-xl-12">
                        <label class="fs-5 fw-semibold mb-2">
                            <span>Nomor Handphone</span>
                        </label>
                        <input type="text" id="notelp" class="form-control form-control-lg" name="notelp"
                            placeholder="Masukan nomor telfon" required />
                    </div>

                </div>

                <div class="row">
                    <div class="col">
                        @auth
                        <button type="submit" class="btn btn-danger w-100">Bayar</button>
                        @endauth

                        @guest
                        <a href="{{ route('login') }}" class="btn btn-danger w-100">
                            Login Terlebih Dahulu
                        </a>
                        @endguest
                    </div>
                </div>
            </form>
            <!--end::Body-->
        </div>
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

        $('#jenis_ewallet').change(function (e) {
            e.preventDefault();

            const jenis_ewallet = $(this).val();

            if(jenis_ewallet !== '') {
                $.ajax({
                    type: "GET",
                    url: "ewallet/products/"+jenis_ewallet,
                    success: function (response) {
                        $('#produk_ewallet').empty();

                        // Menambahkan pilihan berdasarkan respons
                        $.each(response, function (key, value) {
                            // Format Rupiah
                            var formattedPrice = new Intl.NumberFormat("id-ID", {
                                style: "currency",
                                currency: "IDR",
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }).format(value.price);

                            $('#produk_ewallet').append($('<option>', {
                                value: value.id,
                                text: value.name +' - '+ formattedPrice
                            }));
                        });
                    }
                });
            }
        });

            // const {
            //     getOperator
            // } = window.NoTelp;
            // $('#notelp').on('keyup', function(e) {
            //     var notelp = e.target.value;
            //     var operatorTelp1 = getOperator(notelp);

            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            //         }
            //     });
            //     if (operatorTelp1.valid) {
            //         $.ajax({
            //             url: "{{ url('/ajax/ppob') }}",
            //             type: "POST",
            //             dataType: 'json',
            //             data: {
            //                 operator: operatorTelp1.operator,
            //                 category: 'pulsa'
            //             },
            //             success: function(response) {
            //                 $('#row-pricelist').html('');

            //                 if (response.message != 'Unauthorized') {
            //                     $.each(response, function(key, val) {
            //                         $('#row-pricelist').append(
            //                             `<div style="cursor:pointer" data-product="${val.id}" class="col-xl-2 col-sm-6 card border border-warning pricelist me-xl-2 mb-xl-3"><div class="card"><div class="card-header pt-5"><div class="card-title d-flex flex-column"><div class="d-flex align-items-center"><span class="fw-bold text-dark me-2">${val.description}</span></div><span class="text-gray-400 pt-1 fw-semibold fs-6">${val.price}</span></div></div></div></div>`
            //                         )
            //                     });
            //                 } else {
            //                     $('#row-pricelist').append(
            //                         '<div class="col-md-12"><a href="{{ route('login') }}">Login first</a></div>'
            //                     )
            //                 }
            //             }
            //         }).done(function() {
            //             $('.pricelist').on('click', function(e) {
            //                 const id = $(this).data('product');
            //                 const notelp = $('#notelp').val();

            //                 $('#row-pricelist').append(
            //                     `<form id="form_id" method="post" action="{{ route('cart') }}"  hidden>@csrf<input type="text" value="${id}" name="id" /><input type="text" value="${notelp}" name="notelp" /><button type="submit" class="btn-submit"></button></form> `
            //                 ).click(function() {
            //                     $('#form_id').submit();
            //                 });

            //             })
            //         });
            //     }
            // })

        })
</script>
@endpush