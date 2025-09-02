<section class="container" style="margin-top: 50px; margin-bottom: 50px">
    <div class="section-title">
        <div class="title text-capitalize d-flex align-items-center">
            PO Bus Populer
        </div>
    </div>

    <div class="card border-none">
        <div class="card-body p-0">
            <div class="row">
                @foreach ($popular as $p)
                <div class="col-md-3 col-12 p-3">
                    @if($p->kota_awal && $p->kota_tujuan)
                        <a href="{{ route('bus_travel.findroute', ['kota_awal' => $p->kota_awal, 'kota_tujuan' => $p->kota_tujuan]) }}" class="card shadow-sm">
                    @else
                        <a href="javascript:" class="card shadow-sm">
                    @endif
                        <div class="card-body">
                            <img src="{{ asset('storage/' . $p['image']) }}" onerror="this.src=`https://png.pngtree.com/png-clipart/20230822/original/pngtree-bus-logo-vector-public-picnic-picture-image_8176238.png`" class="w-100" alt="bus_travel">
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
