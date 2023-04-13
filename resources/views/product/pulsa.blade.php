@extends('layouts.web')

@section('content-web')
<div class="row gx-5 gx-xl-8 mb-5 mb-xl-8">
    <!--begin::Col-->
    <div class="col-xl-12">

        <!--begin::Tiles Widget 2-->
        <div class="card bgi-no-repeat bgi-size-contain card-xl-stretch mb-5 mb-xl-8 container-xxl">

            <!--begin::Body-->
            <div class="card-body d-flex flex-column justify-content-between ">
                <!--begin::Title-->
                <h2 class="fw-bold mb-5">Pulsa</h2>
                <!--end::Title-->
                <div class="fv-row mb-5">
                    <div class="col-xl-6">
                        <label class="fs-5 fw-semibold mb-2">
                            <span class="required">No Ponsel</span>
                        </label>

                        <!--begin::Input-->
                        <input type="text" id="notelp" class="form-control form-control-lg form-control-solid" name="name" placeholder="" value="" />
                        <!--end::Input-->
                    </div>


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
            </div>
            <!--end::Body-->
        </div>
        <!--end::Tiles Widget 2-->

    </div>
    <!--end::Col-->
</div>
@endsection

@push('add-style')
<script src="{{asset('assets/js/custom/noTelp.js')}}"></script>
@endpush

@push('add-script')

<script>
    console.log('test js')
    const {
        getOperator
    } = window.NoTelp;
    $('#notelp').keyup(function(e) {
        var notelp = e.target.value;
        // console.log(userInput);
        var operatorTelp1 = getOperator(notelp);
        // console.log('operatorTelp1 : ', operatorTelp1.card);

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
                operator: operatorTelp1.operator,
                category: 'pulsa'
            },
            success: function(response) {
                $('#row-pricelist').html('');

                console.log(response)
                if (response.message != 'not found') {
                    $.each(response, function(key, val) {
                        $('#row-pricelist').append(
                            `<a href="" class="col-xl-2 col-sm-6 card border border-warning pricelist me-xl-2 mb-xl-3"><div class="card"><div class="card-header pt-5"><div class="card-title d-flex flex-column"><div class="d-flex align-items-center"><span class="fw-bold text-dark me-2">${val.name}</span></div><span class="text-gray-400 pt-1 fw-semibold fs-6">${val.description}</span></div></div></div></a>`
                        )
                    });
                }
            }
        });
    })
</script>
@endpush