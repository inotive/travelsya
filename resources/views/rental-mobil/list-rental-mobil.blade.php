<!DOCTYPE html>

<head>

    <title>Rental Mobil | Travelsya</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Hasil Pencarian Rental Mobil</h1>

        <div class="search-result">
            <span class="calendar-icon"></span>
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
        <div id="cars-container">

            @foreach ($cars as $item)

                <div class="car-list">
                    <div class="car-item" id="surabaya" data-lokasi="Surabaya" data-jenis="Sedan">
                        <img src="{{ asset('storage/cars/' . $item->image_url) }}">
                        <div class="car-info">
                            <h3>Toyota Agya</h3>
                            <div class="car-details">
                                <span class="fa-solid fa-user">{{ $item->number_seats }} kursi</span>
                                <span>{{ $item->category }}</span>
                            </div>
                            <p class="car-price">Mulai dari IDR {{ number_format($item->rental_price_per_day, 0, ',', '.') }}/hari</p>
                        </div>
                    </div>
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
</script>

<style>

    #cars-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
        overflow: hidden;
    }

    .car-list {
        width: 900px;
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
        background-color: rgba(228, 28, 28, 0.73);
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
        color: white;
        border-radius: 9999px;
        padding: 2px 8px;
        border: none;
    }

    .filter-category {
        background-color: #bbb3b3;
        color: rgb(7, 7, 7);
        border-radius: 90px;
        border: 1px solid black;
        padding: 2px 8px;
    }
</style>

</html>
