<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil | Travelsya</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <a href="javascript:window.history.back()" type="button" class="btn btn-icon btn-rounded btn-color-white bg-white bg-opacity-15 bg-hover-opacity-25 fw-semibold mb-5">
        <i style="font-size: 2rem; padding-right: 3px" class="fa fa-angle-left"></i>
    </a>

    <div class="container mt-5">
        <h1 class="mb-4">Syarat Rental Mobil</h1>

        <div class="search-result">
            <i class="fa fa-calendar" aria-hidden="true"></i>
            <span>{{ $tanggalRental }}</span>
            <span>|</span>
            <span>{{ $durasiRental }} Hari</span>
            <span>|</span>
            <span>{{ $ambilRental }}</span>
            <span>|</span>
            <span>{{ $jamRental }}</span>
            <button class="change-button">Ubah</button>
        </div>

        <button class="filter-category" onclick="filterCars('')">All</button>
        <button class="filter-category" onclick="filterCars('automatic')">Automatic</button>
        <button class="filter-category" onclick="filterCars('manual')">Manual</button>

        <br>
        <br>
        <div id="cars-container" onclick="showModal(this.id)">

            @foreach ($cars as $item)
                <div class="car-list">
                    <div class="car-item" data-id="{{ $item->id }}">
                        <img src="{{ asset('storage/cars/' . $item->image_url) }}">
                        <div class="car-info">
                            <h3>{{ $item->brand->name ?? '' }}</h3>
                            <div class="car-details">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="kursi">{{ $item->number_seats }} kursi</span>
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>{{ $item->category }}</span>
                            </div>
                            <p class="car-price">Mulai dari</p>
                            <p class="car-price"><span class="harga">IDR{{ number_format($item->rental_price_per_day, 0, ',', '.') }}</span> /hari</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- MODAL --}}
    <div id="modal" class="modal">
        <div class="modal-content" style="top: -100px;">
            <span class="close" style="position: absolute; top: -8px; right: 10px;"
                onclick="document.getElementById('modal').style.display='none'">&times;</span>
            <div class="car-item" style="width: 450px; height: 100%; object-fit: contain;">
                <img id="modal-image" src="" style="width: 420px; height: 220px; object-fit: contain;">

                <div class="car-info">
                    <h3 id="modal-title"></h3>
                    <div class="car-details">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span class="kursi" id="modal-kursi"></span>
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span id="modal-category"></span>
                    </div>
                    <p class="car-price">Mulai dari</p>
                    <p class="car-price"><span class="harga" id="modal-harga"></span> /hari</p>
                </div>
            </div>

            @foreach ($carRental as $item)
                <h4 style="position: absolute; top: 40px; right: 460px;">Pilih Vendor</h4>
                <div class="container belakang">
                    <ul class="vendor-list" style="position: absolute; top: 70px; right: 380px;">
                        <li class="vendor-item">
                            <span class="vendor-name">{{ $item->business_name }}</span>
                            <p class="car-price" style="position: relative; left: 320px; top: 12px;"><span class="vendor-price"></span>/hari</p>
                            {{-- <p class="car-price" style="position: relative; left: 320px;"><span class="vendor-price"></span> /hari</p> --}}
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</body>

<script>
    function filterCars(category) {
        const params = new URLSearchParams(window.location.search);
        params.set('category', category);
        window.location.search = params.toString();
    }

    // MENENTUKAN GAMBAR MODAL
    const modal = document.getElementById('modal');
    const modalImage = document.getElementById('modal-image');

    document.querySelectorAll('.car-item').forEach(function(car) {
        car.addEventListener('click', function() {
            modalImage.src = car.querySelector('img').src;
            modal.style.display = 'block';
        });
    });

    document.querySelectorAll('.car-item').forEach((item) => {
        item.addEventListener('click', (e) => {

            const id = item.getAttribute('data-id');
            const lokasi = item.getAttribute('data-lokasi');
            const jenis = item.getAttribute('data-jenis');
            const image = item.querySelector('img').getAttribute('src');
            const title = item.querySelector('h3').textContent;
            const kursi = item.querySelector('.kursi').textContent;
            const category = item.querySelector('.car-details span:last-child').textContent;
            const harga = item.querySelector('.harga').textContent;

            document.getElementById('modal-image').setAttribute('src', image);
            document.getElementById('modal-title').textContent = title;
            document.getElementById('modal-kursi').textContent = kursi;
            document.getElementById('modal-category').textContent = category;
            document.getElementById('modal-harga').textContent = harga;

            document.querySelectorAll('.vendor-price').forEach((vendorPrice) => {
                vendorPrice.textContent = harga;
            });

            document.getElementById('modal').style.display = 'block';
        });
    });
</script>

<style>

    .btn-icon.btn-rounded {
        border-radius: 99px;
        padding: 0.6rem;
        margin: 115px;
        margin-top: -70px;
        position: absolute;
        width: 45px;
        height: 45px;
        color: #c31e1e;
        background-color: #c51919;
        border: 1px solid rgba(216, 207, 207, 0.73);
    }

    .hari{
        color: thistle;
    }

    .vendor-list {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .vendor-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #e0e0e0;
    }

    .vendor-item:last-child {
        border-bottom: none;
    }

    .vendor-name {
        font-weight: bold;
        height: 50px;
        width: 519px;
        background-color: #ffffff;
        border: 1px solid rgba(30, 28, 28, 0.73);
        border-radius: 9999px;
        padding: 12px;
        font-size: 14px;
        position: absolute;
        margin-right: 900px;
        color: rgb(0, 0, 0);
    }

    .vendor-price {
        color: #e44d26;
        font-weight: bold;
        padding: 12px;
        font-size: 14px;
        padding-left: 70px;
        padding-top: 10px;
    }

    .container h1{
        margin-top: 100px;
    }

    #cars-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(370px, 0fr));
        overflow: hidden;
    }

    .car-list {
        width: 980px;
    }

    #cars-container h2 {
        margin-top: 0;
        text-align: center;
        margin-bottom: 30px;
    }


    .car-item {
        width: calc(40% - 30px);
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
        height: 180px;
        object-fit: contain;
    }

    .kursi {
        margin-right: 6px;
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
        margin-bottom: 3px;
        margin-top: 8px;
    }

    .car-details {
        font-size: 14px;
        color: #666;
        margin-bottom: 10px;
    }

    .car-price {
        font-size: 11px;
        font-weight: bold;
        color: #777777;
        align-items: center;
        margin-bottom: -7px;
    }

    .harga {
        font-size: 20px;
        font-weight: bold;
        color: #c51919;
        margin: 0 px;
    }

    @media (max-width: 1200px) {
        .car-item {
            width: calc(25% - 30px);
            /* 4 item per baris */
        }
    }

    @media (max-width: 992px) {
        .car-item {
            width: calc(33.33% - 30px);
            /* 3 item per baris */
        }
    }

    @media (max-width: 768px) {
        .car-item {
            width: calc(50% - 30px);
            /* 2 item per baris */
        }
    }

    @media (max-width: 576px) {
        .car-item {
            width: calc(100% - 30px);
            /* 1 item per baris */
        }
    }

    .car-item {
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .search-criteria {
        background-color: #f8f9fa;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .search-result {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 50px;
        width: 1119px;
        margin-bottom: 20px;
        background-color: #c51919;
        border: 1px solid rgba(30, 28, 28, 0.73);
        border-radius: 9999px;
        padding: 4px 12px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        color: white;
    }

    .search-result>* {
        margin: 0 4px;
    }

    .calendar-icon {
        width: 16px;
        height: 16px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='4' width='18' height='18' rx='2' ry='2'%3E%3C/rect%3E%3Cline x1='16' y1='2' x2='16' y2='6'%3E%3C/line%3E%3Cline x1='8' y1='2' x2='8' y2='6'%3E%3C/line%3E%3Cline x1='3' y1='10' x2='21' y2='10'%3E%3C/line%3E%3C/svg%3E");
        background-size: contain;
        display: inline-block;
    }

    .change-button {
        background-color: #e8dada;
        color: rgb(195, 25, 25);
        border-radius: 9999px;
        padding: 2px 8px;
        border: none;
    }

    .filter-category {
        background-color: #ffffff;
        color: rgb(0, 0, 0);
        border-radius: 90px;
        border: 1px solid black;
        padding: 2px 8px;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .modal:target {
        display: block;
    }
</style>

</html>
