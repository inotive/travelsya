{{-- <div class="text-center">
  <h2>This Service Still Under Construction</h2>
</div> --}}

<div class="row gx-5 gx-xl-8 mb-xl-8 mb-2">

    <div class="alert alert-info" role="alert">
        <h5>Info Terbaru COVID-19!</h5>
        <p>Ikuti perkembangan info, peraturan resmi, dan syarat perjalanan terbaru selama pandemi COVID-19 <a href="#">disini</a>.</p>
    </div>

    <div class="col-xl-12">

        <!--begin::Tiles Widget 2-->
        <div class="card bgi-no-repeat bgi-size-contain card-xl-stretch mb-xl-8 container-xxl mb-5">

            <!--begin::Body-->
            <form action="{{ route('rental.index') }}" method="GET" class="card-body d-flex flex-column justify-content-between">
                <!--end::Title-->
                <div class="row mb-5 gy-4">
                    <div class="col-6">
                        <label class="fs-5 fw-semibold mb-2">
                            <span>Ambil Rental</span>
                        </label>
                        <select name="ambil-rental" id="ambil-rental" class="form-control form-control-lg">
                            <option value="">Pilih Lokasi Sewa</option>
                            <option value="Surabaya">Surabaya (SUBC)</option>
                            <option value="Jakarta">Jakarta (JKTC)</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label class="fs-5 fw-semibold mb-2">
                            <span>Jam Pengambilan</span>
                        </label>
                        <input type="time" id="jam-rental" name="jam-rental" class="form-control">

                        {{-- <select name="jam-rental" id="jam-rental" class="form-control form-control-lg">
                            <option>Jakarta (JKTC)</option>
                        </select> --}}
                    </div>

                    <div class="col-6">
                        <label class="fs-5 fw-semibold mb-2">
                            <span>Tanggal Rental</span>
                        </label>
                        <input type="date" id="tanggal-rental" name="tanggal-rental" value="2024-09-02" class="form-control">
                    </div>

                    <div class="col-6">
                        <label class="fs-5 fw-semibold mb-2">
                            <span>Durasi Rental</span>
                        </label>
                        <select name="durasi-rental" id="durasi-rental" class="form-control form-control-lg">
                            <option value="1">1 Hari</option>
                            <option value="2">2 Hari</option>
                            <option value="3">3 Hari</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        {{-- @auth
                            <button type="submit" class="btn btn-danger w-100">Bayar</button>
                        @endauth --}}

                        <button type="submit" class="btn btn-danger w-100" id="tampilkan-kendaraan">
                            Cari Mobil
                        </button>

                        <br>
                        <br>


                </div>
                </div>
            </form>

            <!--end::Body-->
        </div>

        {{-- <div id="cars-container" style="display: none;">

            <h2 id="lokasi-kendaraan"></h2>
                <div class="car-list">
                    <div class="car-item" id="surabaya" data-lokasi="Surabaya" data-jenis="Sedan">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRlR67cGa736Fzj-4OYZ_lnI7hqZFMscw8oUw&s" alt="Toyota Grand New Avanza">
                        <div class="car-info">
                            <h3>Toyota Agya</h3>
                            <div class="car-details">
                                <span>6 kursi</span>
                                <span>Otomatis</span>
                            </div>
                            <p class="car-price">Mulai dari IDR 275,500/hari</p>
                        </div>
                    </div>
                    <div class="car-item" data-lokasi="Jakarta">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRIuz0bTRHsld_0GA-UhBgrKdcoQ4CFtBSRYQ&s" alt="Toyota Grand New Avanza">
                        <div class="car-info">
                            <h3>Honda HR-V</h3>
                            <div class="car-details">
                                <span>6 kursi</span>
                                <span>Otomatis</span>
                            </div>
                            <p class="car-price">Mulai dari IDR 275,500/hari</p>
                        </div>
                    </div>
                    <div class="car-item" data-lokasi="Jakarta">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRIuz0bTRHsld_0GA-UhBgrKdcoQ4CFtBSRYQ&s" alt="Toyota Grand New Avanza">
                        <div class="car-info">
                            <h3>Honda HR-V</h3>
                            <div class="car-details">
                                <span>6 kursi</span>
                                <span>Otomatis</span>
                            </div>
                            <p class="car-price">Mulai dari IDR 200,500/hari</p>
                        </div>
                    </div>
                    <div class="car-item" id="surabaya" data-lokasi="Surabaya">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRlR67cGa736Fzj-4OYZ_lnI7hqZFMscw8oUw&s" alt="Toyota Grand New Avanza">
                        <div class="car-info">
                            <h3>Toyota Agya</h3>
                            <div class="car-details">
                                <span>6 kursi</span>
                                <span>Otomatis</span>
                            </div>
                            <p class="car-price">Mulai dari IDR 275,500/hari</p>
                        </div>
                    </div>
                </div>

        </div> --}}

        @push('add-style')
            <script src="{{ asset('assets/js/custom/noTelp.js') }}"></script>
        @endpush

        @push('add-script')
            <script>
                $(document).ready(function() {

                    $.ajax({
                        type: "GET",
                        url: "{{ route('product.product.tax') }}",
                        success: function(response) {
                            $('#productPajak').empty();

                            $.each(response, function(key, value) {
                                $('#productPajak').append($('<option>', {
                                    value: value.kode,
                                    text: value.description
                                }));
                            });
                        }
                    });

                    $('#noPelangganPajak').on('keyup', function() {
                        $('.textAlert').hide();
                    });


                    $('#detailPajak').hide();

                    $('#btnPeriksaPajak').on('click', function() {
                        var noPelangganPajak = $('#noPelangganPajak').val();

                        if (noPelangganPajak == '') {
                            $('.textAlert').show();
                            return false;
                        }

                        $('#alertPajak').empty()
                        $('#detailPajak').hide();
                        $('#btnPeriksaPajak').attr('disabled', true);
                        $('#btnPeriksaPajak').html(
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                        );

                        $.ajax({
                            type: "POST",
                            url: "{{ route('product.tax') }}",
                            data: {
                                'no_pelanggan': noPelangganPajak,
                                'nom': $('#productPajak').val()
                            },
                            success: function(response) {
                                // var simulateFeePajak = parseInt(responseTagihan.data.fee)

                                // SIMULASI!!!
                                var simulateFeePajak = 1000;
                                var simulateAmountPajak = Math.floor(Math.random() * (300000 - 150000 +
                                    1)) + 150000;
                                var simulateTotalPajak = simulateAmountPajak + simulateFeePajak;

                                $('#namaPelangganPajak').text('Joko Susilo');
                                $('#totalTagihanPajak').text(new Intl.NumberFormat('id-ID').format(
                                    simulateAmountPajak));
                                $('#biayaAdminPajak').text(new Intl.NumberFormat('id-ID').format(
                                    simulateFeePajak));
                                $('#totalBayarPajak').text(new Intl.NumberFormat('id-ID').format(
                                    simulateTotalPajak));

                                $('#inputNamaPelangganPajak').val('Joko Susilo');
                                $('#inputTotalTagihanPajak').val(simulateAmountPajak);
                                $('#inputBiayaAdminPajak').val(simulateFeePajak);
                                $('#inputTotalBayarPajak').val(simulateTotalPajak);

                                $('#btnPeriksaPajak').removeAttr('disabled');
                                $('#btnPeriksaPajak').html('Periksa');
                                $('#detailPajak').show();
                            },
                            error: function(xhr, status, error) {
                                if (xhr.status === 400 || xhr.status === 500) {
                                    var alertDiv = $(
                                        `<div class="alert alert-danger alert-dismissible fade show" role="alert">${xhr.responseJSON.data}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`
                                    );

                                    $('#alertPajak').empty().append(alertDiv);
                                }

                                // Hapus spinner dan aktifkan tombol
                                $('#btnPeriksaPajak').removeAttr('disabled');
                                $('#btnPeriksaPajak').html('Periksa');
                            }
                        });
                    });
                });

                $(document).ready(function() {
                    // Handle the change event of the checkbox
                    $("#pajak").change(function() {
                        // Check if the checkbox is checked
                        if ($(this).is(":checked")) {
                            // If checked, remove d-none from Grand Total 1 and add d-none to Grand Total 2
                            $("#pajakPoint").prop("disabled", false);
                        } else {
                            // If not checked, remove d-none from Grand Total 2 and add d-none to Grand Total 1
                            $("#pajakPoint").prop("disabled", true);
                            $("#pajakPoint").remove();
                        }
                    });
                });

                // document.getElementById('tampilkan-kendaraan').addEventListener('click', function() {
                //     var carsContainer = document.getElementById('cars-container');
                //     carsContainer.style.display = 'block';
                //     carsContainer.classList.add('animated', 'fadeIn');
                // });

                // // COSTUM
                // document.getElementById('ambil-rental').addEventListener('change', function() {
                // let lokasi = this.value;
                // let cars = document.querySelectorAll('.car-item');
                // let count = 0;

                // if (lokasi === "") {
                //     cars.forEach(function(car) {
                //     car.style.display = 'none';
                //     });
                // } else {
                //     cars.forEach(function(car) {
                //     let dataLokasi = car.getAttribute('data-lokasi');
                //     if (dataLokasi === lokasi) {
                //     car.style.display = 'block';
                //     count++;
                //     } else {
                //     car.style.display = 'none';
                //     }
                // });
                // }


                // document.getElementById('lokasi-kendaraan').textContent = `Menampilkan Kendaraan Di ${lokasi}`;
                // });
                // document.getElementById('jumlah-kendaraan').textContent = `Menampilkan ${count} Kendaraan`;
            </script>

            {{-- <script>
    $(document).ready(function () {
            $('#notelp').on('keyup', function (e) {

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
                        operator: 'Pajak',
                        category: 'negara'
                    },
                    success: function (response) {
                        $('#row-pricelist').html('');

                        if (response.message != 'Unauthorized') {
                            $.each(response, function (key, val) {
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
                }).done(function () {
                    $('.pricelist').on('click', function (e) {
                        const id = $(this).data('product');
                        const notelp = $('#notelp').val();

                        $('#row-pricelist').append(
                            `<form id="form_id" method="post" action="{{ route('cart') }}"  hidden>@csrf<input type="text" value="${id}" name="id" /><input type="text" value="${notelp}" name="notelp" /><button type="submit" class="btn-submit"></button></form> `
                        ).click(function () {
                            $('#form_id').submit();
                        });

                    })
                });
            })

        })
</script> --}}

        <style>
            #cars-container {
                padding: 40px;
                max-width: 100%;
                margin: 0 auto;
                background-color: #f7f7f7;
                border: 1px solid #ddd;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            #cars-container h2 {
                margin-top: 0;
                text-align: center;
                margin-bottom: 30px;
            }

            .car-list {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }

            .car-item {
                width: calc(30% - 30px);
                margin: 15px;
                background-color: #fff;
                border: 1px solid #ddd;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                display: flex;
                flex-direction: column;
            }

            .car-item img {
                width: 100%;
                height: 200px;
                object-fit:contain;
            }

            .car-info {
                padding: 20px;
                flex-grow: 1;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }

            .car-info h3 {
                margin-top: 0;
                margin-bottom: 10px;
                text-align: center;
            }

            .car-details {
                font-size: 14px;
                color: #666;
                text-align: center;
                margin-bottom: 10px;
            }

            .car-price {
                font-size: 18px;
                font-weight: bold;
                color: #333;
                text-align: center;
                margin-top: auto;
            }

            @media (max-width: 1200px) {
                .car-item {
                    width: calc(25% - 30px); /* 4 item per baris */
                }
            }

            @media (max-width: 992px) {
                .car-item {
                    width: calc(33.33% - 30px); /* 3 item per baris */
                }
            }

            @media (max-width: 768px) {
                .car-item {
                    width: calc(50% - 30px); /* 2 item per baris */
                }
            }

            @media (max-width: 576px) {
                .car-item {
                    width: calc(100% - 30px); /* 1 item per baris */
                }
            }

        </style>

        @endpush
