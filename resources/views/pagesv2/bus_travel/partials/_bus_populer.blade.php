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
                    <a href="javascript:" class="card shadow-sm">
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
