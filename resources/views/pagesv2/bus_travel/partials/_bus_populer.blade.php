<section class="container" style="margin-top: 50px; margin-bottom: 50px">
    <div class="section-title">
        <div class="title text-capitalize d-flex align-items-center">
            PO Bus Populer
        </div>
    </div>

    <div class="card border-none">
        <div class="card-body p-0">
            <div class="row">
                @foreach ($popular->take(12) as $p)
                <div class="col-md-3 col-12 p-3">
                    <a href="{{ route('bus_travel.popular_search', ['id' => $p->id]) }}" style="text-decoration: none; color: inherit;">
                        <div class="card shadow-sm w-100 text-start p-0">
                            <div class="card-body">
                                <img src="{{ asset('storage/bus-travel-images/' . ($p->image ?? 'default.png')) }}"
                                    onerror="this.src='https://png.pngtree.com/png-clipart/20230822/original/pngtree-bus-logo-vector-public-picnic-picture-image_8176238.png'"
                                    class="w-100" alt="{{ $p->business_name ?? 'Bus Travel' }}" style="object-fit: contain; background-color: #ffffff;">
                                <div class="text-center mt-2">
                                    <small class="text-muted">{{ $p->business_name ?? 'Bus Travel' }}</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
