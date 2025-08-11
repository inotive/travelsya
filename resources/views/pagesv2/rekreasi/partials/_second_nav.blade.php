<div class="second-nav">
    <div class="container d-flex align-items-center">
        <div class="d-flex justify-content-between w-100">
            <div class="d-flex align-items-center">
                <a href="javascript:" onclick="history.back()" class="back-btn text-danger fs-16">
                    <h4 class="text-danger">
                        <i class="fa-solid fa-arrow-left me-2 text-danger"></i>
                        <span class="fw-bold my-auto">
                            Kembali
                        </span>
                    </h4>
                </a>
            </div>
            <div class="d-flex align-items-center">
                <div class="ms-sm-auto position-relative">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-left-round border-right-none"
                            id="basic-addon1">
                            <i class="fa-solid fa-search"></i>
                        </span>
                        <input type="text" id="find" class="form-control search-input"
                            placeholder="Cari tempat rekrasi favorit kamu disini" />
                    </div>
                    <div class="card d-none mt-2 rounded shadow-sm position-absolute w-100" id="card_result"
                        style="z-index: 9999">
                        <div class="card-body" id="search-wrapper" style="max-height: 50vh; overflow-y : scroll">
                            <div class="mx-auto fw-bold text-center" style="color : var(--bs-gray-500)">Ketikan Minimal
                                2
                                karakter</div>
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

    $("#find").on("keyup", function(){
        console.log('Keyup');
        
        findData();
    })
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function findData(){
        var val = $('#find').val();
        
        console.log('findData()');
        

        if(val.length > 1){
            $.ajax({
                url: "{{ route('search_recreation') }}",
                type: "POST",
                data: {
                    name : val
                },
                success : function(data){
                    console.log(data);
                    
                    if(data){
                        $('#search-wrapper').empty();
                        $('#search-wrapper').append(data);
                        $('#card_result').removeClass('d-none');
                    }else{
                        $('#search-wrapper').empty();
                        $('#search-wrapper').append('<div class="mx-auto fw-bold text-center" style="color : var(--bs-gray-500)">Tidak ada data</div>');
                    }

                },error: function(xhr, status, error) {
                    console.log("AJAX Error:", error);
                    console.log("Status:", status);
                    console.log("Response Text:", xhr.responseText);

                    // Menampilkan pesan error ke pengguna
                    // alert("Terjadi kesalahan: " + xhr.responseText);
                }
                
            });
        }

    }
</script>
@endpush