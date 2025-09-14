<style>
/* Custom tooltip styling */
.tooltip {
    font-size: 0.875rem;
}

.tooltip-inner {
    background-color: #333;
    color: #fff;
    border-radius: 6px;
    padding: 8px 12px;
    font-weight: 500;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    max-width: 250px;
}

.tooltip.bs-tooltip-top .tooltip-arrow::before {
    border-top-color: #333;
}

.tooltip.bs-tooltip-bottom .tooltip-arrow::before {
    border-bottom-color: #333;
}

.tooltip.bs-tooltip-start .tooltip-arrow::before {
    border-left-color: #333;
}

.tooltip.bs-tooltip-end .tooltip-arrow::before {
    border-right-color: #333;
}

/* Optional: Add hover effect for route links */
.route-link {
    transition: all 0.2s ease;
    border-radius: 8px;
    text-decoration: none !important;
}

.route-link:hover {
    background-color: #f8f9fa;
    transform: translateY(-1px);
}
</style>

<section class="container" style="margin-top: 50px;">
    <div class="section-title">
        <div class="title text-capitalize d-flex align-items-center">
            Rute Shuttle / Travel Terpopuler
        </div>
    </div>

    <div class="card border-none">
        <div class="card-body p-0">
            <div class="row">
                @foreach ($route_travel->take(12) as $r)
                    @if (!empty($r->departure) && !empty($r->departure->from) && !empty($r->departure->to))
                        @php
                            $fromCity = $r->departure->from->city_name ?? 'Unknown';
                            $toCity = $r->departure->to->city_name ?? 'Unknown';
                            $routeText = 'Travel ' . strtolower($fromCity) . ' ke ' . strtolower($toCity);
                        @endphp
                        <a href="{{ route('bus_travel.findroute', [
                            'kota_awal' => $fromCity,
                            'kota_tujuan' => $toCity
                        ]) }}" class="col-md-3 col-12 p-3" data-bs-toggle="tooltip" title="{{ $routeText }}">
                            <span class="fs-5 text-dark text-capitalize text-truncate d-inline-block" style="max-width: 100%;">
                                {{ $routeText }}
                            </span>
                        </a>
                    @elseif (isset($r['from']) && isset($r['to']))
                        @php
                            $routeText = 'Travel ' . strToLower($r['from']) . ' ' . strToLower($r['to']);
                        @endphp
                        <a href="{{ route('bus_travel.findroute', ['kota_awal' => $r['from'], 'kota_tujuan' => $r['to']]) }}"
                            class="col-md-3 col-12 p-3" data-bs-toggle="tooltip" title="{{ $routeText }}">
                            <span class="fs-5 text-dark text-capitalize text-truncate d-inline-block" style="max-width: 100%;">
                                {{ $routeText }}
                            </span>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>

<script>
// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
