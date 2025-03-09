<div class="second-nav border-top border-bottom border-3">
    <div class="container d-flex flex-row align-items-center">
        <div class="d-flex w-100">
            <div class="d-flex align-items-center">
                <a href="{{ route('home') }}" class="back-btn text-danger fs-16 text-decoration-none">
                    <h4 class="text-danger">
                        <i class="fa-solid fa-arrow-left me-2 text-danger"></i>
                        <span class="fw-bold my-auto">
                            Kembali
                        </span>
                    </h4>
                </a>
            </div>
            <div class="ms-sm-auto position-relative">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-left-round border-right-none" id="basic-addon1">
                        <i class="fa-solid fa-search"></i>
                    </span>
                    <input type="text" onkeyup="findData()" id="find" class="form-control search-input"
                        placeholder="Cari tempat rental mobil langganan kamu disini" />
                </div>
                <div class="card d-none mt-2 rounded shadow-sm position-absolute w-100" id="card_result" style="z-index: 9999">
                    <div class="card-body" id="search-wrapper" style="max-height: 50vh; overflow-y : scroll">
                        <div class="mx-auto fw-bold text-center" style="color : var(--bs-gray-500)">Ketikan Minimal 2 karakter</div>
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
                url: "{{ route('search_car_rent') }}",
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
