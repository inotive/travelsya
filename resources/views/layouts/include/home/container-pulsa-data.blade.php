<div class="text-center">
    <div class="row gy-3" >
        <div class="col-12">
            <h3>Nomor Handphone</h3>
        </div>
        <div class="col-12">
            <input type="text"  class="form-control form-control-lg" placeholder="Masukan Nomor Telfon">
        </div>
        <div class="col-12">
            <h3>Nominal</h3>
        </div>
        <div class="row" id="row-pricelist">

            <!-- '<a href="" class="col-xl-2 col-sm-2 card border border-warning pricelist me-xl-3 ">
                <div class="card">
                    <div class="card-header pt-5">
                        <div class="card-title d-flex flex-column">
                            <div class="d-flex align-items-center"><span class=" fw-bold text-dark me-2 lh-1 ls-n2">100,000</span></div><span class="text-gray-400 pt-1 fw-semibold fs-6">Pulsa100,000</span>
                        </div>
                    </div>
                </div>
            </a>' -->
        </div>
        @for($i= 1; $i< 10;$i++)
            <div class="col-3 ">
                <div class="card bg-light">
                    <div class="card-body">
                        {{number_format($i*10000,0,',','.')}}
                        <p class="d-block text-success">Rp. {{number_format(($i*10000) + 2500,0,',','.')}}</p>
                    </div>
                </div>
            </div>
        @endfor
        <div class="col-12 w-100">
            <a href="{{route('checkout.product', ['product' => 'pulsa'])}}" type="button" class="btn btn-danger" >
                Beli Pulsa
            </a>
        </div>
    </div>
</div>


@push('add-style')
    <script src="{{asset('assets/js/custom/noTelp.js')}}"></script>
@endpush

@push('add-script')

    <script>
        $(document).ready(function() {

            const {
                getOperator
            } = window.NoTelp;
            $('#notelp').on('keyup', function(e) {
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
                                $('#row-pricelist').append('<div class="col-md-12"><a href="{{route("login.view")}}">Login first</a></div>')
                            }
                        }
                    }).done(function() {
                        $('.pricelist').on('click', function(e) {
                            const id = $(this).data('product');
                            const notelp = $('#notelp').val();

                            $('#row-pricelist').append(
                                `<form id="form_id" method="post" action="{{route("cart")}}"  hidden>@csrf<input type="text" value="${id}" name="id" /><input type="text" value="${notelp}" name="notelp" /><button type="submit" class="btn-submit"></button></form> `
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
