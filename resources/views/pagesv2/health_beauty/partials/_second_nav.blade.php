<div class="card border-transparent header-image" data-bs-theme="light" style="border-radius: 0 !important; margin-bottom: 0 !important; margin-top: -1px !important; border-bottom-left-radius: 4em !important; border-bottom-right-radius: 4em !important; box-shadow: none !important; margin-left: calc(-1 * (max(100vw - 100%, 0px) / 2)) !important; margin-right: calc(-1 * (max(100vw - 100%, 0px) / 2)) !important; min-height: 200px !important;">
    <div class="card-body d-flex ps-xl-20">
        <div class="m-0 w-100">
            <div class="position-relative fs-2x z-index-2 fw-bold text-white mb-2 d-flex justify-content-between align-items-center" style="padding-top: 40px;">
                <div class="d-flex align-items-center">
                    <button onclick="history.back()"
                        class="btn btn-icon btn-rounded btn-color-white bg-white bg-opacity-15 bg-hover-opacity-25 fw-semibold me-3">
                        <i class="las la-times"></i>
                    </button>
                    <div>
                        <div class="fs-1">Health & Beauty</div>
                        <div class="fs-4 text-gray-300">Cari klinik kecantikan dan kesehatan di lokasimu!</div>
                    </div>
                </div>
                <div class="position-relative">
                    <div class="input-group rounded-pill overflow-hidden" style="width: 400px; background: white;">
                        <span class="input-group-text bg-white border-0 text-dark" id="basic-addon1">
                            <i class="fa-solid fa-search"></i>
                        </span>
                        <input type="text" onkeyup="findData()" class="form-control search-input border-0 text-dark" id="find"
                            placeholder="Cari klinik kesehatan dan kecantikan disini" style="background: white; color: dark;" />
                    </div>
                    <div class="card d-none mt-2 rounded shadow-sm position-absolute w-100" id="card_result" style="z-index: 9999; width: 400px !important;">
                        <div class="card-body" id="search-wrapper" style="max-height: 50vh; overflow-y : scroll">
                            <div class="mx-auto fw-bold text-center" style="color : var(--bs-gray-500)">Ketikan Minimal 2 karakter</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
    const password = document.querySelector('input[id="find"]');
        password.addEventListener("focus", (event) => {
            $('#card_result').removeClass('d-none');
        });

        password.addEventListener("blur", (event) => {
            $("#card_result").delay(500).queue(function() {
                $('#card_result').addClass('d-none');
                $('#search-wrapper').empty();
                $('#search-wrapper').append('<div class="mx-auto fw-bold text-center" style="color : var(--bs-gray-500)">Ketikan Minimal 2 karakter</div>');
            });
        });
    function findData(){
        var val = $('#find').val();

        if(val.length > 1){
            $.ajax({
                url: "{{ route('search_clinic') }}",
                type: "POST",
                data: {
                    name : val
                },
                success : function($res){
                    if($res){
                        $('#search-wrapper').empty();
                        $('#search-wrapper').append($res);
                        // $('#card_result').removeClass('d-none');
                    }else{
                        $('#search-wrapper').empty();
                        $('#search-wrapper').append('<div class="mx-auto fw-bold text-center" style="color : var(--bs-gray-500)">Tidak ada data</div>');
                    }

                }
            });
        }

    }
</script>
@endpush
