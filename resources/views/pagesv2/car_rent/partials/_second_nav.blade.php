<div class="second-nav border-top border-bottom border-3">
    <div class="container d-flex flex-row align-items-center">
        <div class="d-flex w-100">
            <div class="d-flex align-items-center">
                <a href="{{ url()->previous() }}" class="back-btn text-danger fs-16 text-decoration-none">
                    <h4 class="text-danger">
                        <i class="fa-solid fa-arrow-left me-2 text-danger"></i>
                        <span class="fw-bold my-auto">
                            Kembali
                        </span>
                    </h4>
                </a>
            </div>
            <div class="ms-sm-auto position-relative" style="width: 50%;">
                <form id="search-form" action="{{ route('car_rent.show') }}" method="POST" style="display: flex;">
                    @csrf
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-left-round border-right-none" id="basic-addon1">
                            <i class="fa-solid fa-search"></i>
                        </span>
                        <input type="text" name="search" id="find" class="form-control search-input"
                            placeholder="Cari rental, merk, atau model mobil" 
                            onkeyup="findData()" />
                        <button type="submit" class="btn btn-danger" style="border-radius: 0 50px 50px 0;">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </form>
                <div class="card d-none mt-2 rounded shadow-sm position-absolute w-100" id="card_result"
                    style="z-index: 9999">
                    <div class="card-body" id="search-wrapper" style="max-height: 50vh; overflow-y : scroll">
                        <div class="mx-auto fw-bold text-center" style="color : var(--bs-gray-500)">Ketikan Minimal 2
                            karakter</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
    $(document).ready(function() {
        const searchInput = document.querySelector('input[id="find"]');
        const searchForm = document.getElementById('search-form');
        
        if (searchInput) {
            searchInput.addEventListener("focus", (event) => {
                $('#card_result').removeClass('d-none');
            });

            searchInput.addEventListener("blur", (event) => {
                setTimeout(function() {
                    $('#card_result').addClass('d-none');
                }, 250);
            });
        }

        if (searchForm) {
            searchForm.addEventListener('submit', function() {
                $('#card_result').addClass('d-none');
            });
        }
    });

    function findData(){
        var val = $('#find').val();

        if(val.length > 1){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                url: "{{ route('search_car_rent') }}",
                type: "POST",
                data: {
                    name : val
                },
                success : function(res){
                    if(res){
                        $('#search-wrapper').empty();
                        $('#search-wrapper').append(res);
                    }else{
                        $('#search-wrapper').empty();
                        $('#search-wrapper').append('<div class="mx-auto fw-bold text-center" style="color : var(--bs-gray-500)">Tidak ada data</div>');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error: ' + error);
                    console.log('Response: ', xhr.responseText);
                    $('#search-wrapper').empty();
                    $('#search-wrapper').append('<div class="mx-auto fw-bold text-center" style="color : var(--bs-gray-500)">Terjadi kesalahan saat mencari data</div>');
                }
            });
        } else {
            $('#search-wrapper').empty();
            $('#search-wrapper').append('<div class="mx-auto fw-bold text-center" style="color : var(--bs-gray-500)">Ketikan Minimal 2 karakter</div>');
        }
    }
</script>
@endpush