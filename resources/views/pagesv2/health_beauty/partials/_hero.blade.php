@push('add_style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@endpush
<section class="hero-wrapper position-relative">
    <img src="{{ asset('images/spa_&_kecantikan.png') }}" alt="travelsya rekreasi" class="hero-img" height="100%"
        width="100%">
    <div class="hero-item-wrapper row position-absolute w-100 mx-auto">
        <div class="col-12 banner-title col-md-6">
            <span class="badge badge-custom-hero">Health and Beauty</span>
            <h1 class="banner-text-title mt-5 text-white fw-bold">Cantik Sehat, Hidup Lebih Bahagia</h1>
        </div>
        <div class="col-12 col-md-6 banner-search">
            <div class="search-banner-wrapper">
                <div class="card card-body p-5">
                    <form action="{{ route('health_beauty.show') }}" method="post">
                        @csrf
                        <div class="mb-5">
                            <ul class="nav nav-underline">
                                <li class="nav-item">
                                    <a href="#" aria-current="page" class="nav-link active">Health</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" aria-current="page" class="nav-link">Beauty</a>
                                </li>
                            </ul>
                        </div>
                        <div class="input-group mb-5">
                            <span class="input-group-text bg-transparent">
                                <i class="fa-solid fa-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Mau reservasi dimana?" />
                            <span class="input-group-text bg-transparent">
                                <i class="fa-solid fa-location-crosshairs"></i>
                            </span>
                        </div>
                        <div class="input-group mb-5">
                            <span class="input-group-text bg-transparent">
                                <i class="fa-solid fa-calendar-days"></i>
                            </span>
                            <input type="text" onfocus="(this.type='date')" class="form-control"
                                placeholder="Tanggal reservasi" aria-label="Username" aria-describedby="basic-addon1" />
                        </div>
                        <button type="submit" class="btn btn-danger w-100 fw-semibold bg-main">Cari Sekarang</button>

                        {{-- <a href="{{ route('register') }}" class="btn btn-danger w-100 fw-semibold bg-main">Cari
                            Sekarang</a> --}}

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@push('js')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>
@endpush