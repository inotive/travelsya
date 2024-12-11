<section class="hero-wrapper position-relative" style="margin-bottom: 75px;">
    <img src="{{ asset('images/health_beauty.jpg') }}" alt="travelsya rekreasi" class="hero-img" height="100%"
        width="100%">
    <div class="hero-item-wrapper row position-absolute w-100 mx-auto">
        <div class="col-12 banner-title col-md-6">
            <span class="badge badge-custom-hero">Health and Beauty</span>
            <h1 class="banner-text-title mt-3 text-white fw-bold">Cantik Sehat, Hidup Lebih Bahagia</h1>
        </div>
        <div class="col-12 col-md-6 banner-search">
            <div class="search-banner-wrapper">
                <div class="card card-body p-3">
                    <form action="{{ route('health_beauty.search') }}" method="post">
                        @csrf

                        <div class="btn-group w-100" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">

                            <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#health_tab">Health</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#beauty_tab">Beauty</a>
                                </li>
                            </ul>

                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-transparent">
                                <i class="fa-solid fa-search"></i>
                            </span>
                            <input type="text" class="form-control" name="location"
                                placeholder="Mau reservasi dimana?" />
                            <span class="input-group-text bg-transparent">
                                <i class="fa-solid fa-location-crosshairs"></i>
                            </span>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-transparent">
                                <i class="fa-solid fa-calendar-days"></i>
                            </span>
                            <input type="text" name="date" onfocus="(this.type='date')" class="form-control"
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