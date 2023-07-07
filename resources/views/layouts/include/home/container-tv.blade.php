<div class="row gx-5 gx-xl-8 mb-xl-8 mb-5">
    <!--begin::Col-->
    <div class="col-xl-12">

        <!--begin::Tiles Widget 2-->
        <div class="card bgi-no-repeat bgi-size-contain card-xl-stretch mb-xl-8 container-xxl mb-5">

            <!--begin::Body-->
            <div class="card-body d-flex flex-column justify-content-between">
                <!--begin::Title-->
                <h2 class="fw-bold mb-5">TV-Internet</h2>
                <!--end::Title-->
                <div class="fv-row mb-5">
                    <div class="col-xl-6">
                        <label class="fs-5 fw-semibold mb-2">
                            <span class="required">No Pelanggan</span>
                        </label>

                        <!--begin::Input-->
                        <input type="text" id="notelp" class="form-control form-control-lg form-control-solid"
                            name="notelp" placeholder="" value="" />
                        <!--end::Input-->
                    </div>


                </div>
                <div class="row" id="row-pricelist">

                    <!-- '<a href="" class="col-xl-2 col-sm-2 card border-warning pricelist me-xl-3 border">
                        <div class="card">
                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <div class="d-flex align-items-center"><span class="fw-bold text-dark me-2 lh-1 ls-n2">100,000</span></div><span class="fw-semibold fs-6 pt-1 text-gray-400">Pulsa100,000</span>
                                </div>
                            </div>
                        </div>
                    </a>' -->
                </div>
            </div>
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
                                '<div class="col-md-12"><a href="{{ route('login.view') }}">Login first</a></div>'
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
    </script>
@endpush
