<section class="container" style="margin-top: 50px;">
    <div class="section-title">
        <div class="title text-capitalize d-flex align-items-center">
            Rute Shuttle / Travel Terpopuler
        </div>
    </div>

    <div class="card border-none">
        <div class="card-body p-0">
            <div class="row">
                @foreach ($route_travel as $r)
                    @if (isset($r['from']) && isset($r['to']))
                        <a href="{{ route('bus_travel.findroute', ['kota_awal' => $r['from'], 'kota_tujuan' => $r['to']]) }}"
                            class="col-md-3 col-12 p-3">
                            <span class="fs-5 text-dark text-capitalize">Travel {{ strToLower($r['from']) }}
                                {{ strToLower($r['to']) }}</span>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
