<section class="container mt-5">
    <div class="section-title">
        <div class="title text-capitalize d-flex align-items-center">
            Rute Bus Terpopuler
        </div>
    </div>

    <div class="card border-none">
        <div class="card-body p-0">
            <div class="row">
                @foreach ($route as $r)
                <a href="{{ route('bus_travel.findroute', ['kota_awal' => $r['from'], 'kota_tujuan' => $r['to']]) }}" class="col-md-3 col-12 p-3">
                    <span class="fs-5 text-dark text-capitalize">Bus {{ strToLower($r['from']) }} {{ strToLower($r['to']) }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
