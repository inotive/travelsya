@push('add-style')
<style>
    .outline-none:focus {
        outline: none;
        box-shadow: none;
        border-color: inherit;
    }
</style>
@endpush
<div class="px-3 mb-35px fs-2" id="paket">
    <div class="section-title mb-4">
        <div class="w-100 title text-capitalize" style="font-size: calc(1rem + 0.85vw)">
            Paket
        </div>
        <div class="w- text-capitalize opacity-25" style="font-size: calc(1rem + 0.25vw)">
            Cek ketersediaan paket
        </div>
        <div class="w-100 title text-capitalize d-flex flex-row align-items-center">
            <a href="{{ route('rekreasi.detail', ['id' => $detail->id, 'date' => date('Y-m-d h:i:s', strtotime('+1 days',
                strtotime(now())))]) }}" class="text-decotarion-none text-dark">
                <button type="button"
                    class="btn @if($date == date('Y-m-d h:i:s', strtotime('+1 days',
                strtotime(now())))) bg-danger bg-opacity-25 text-danger @else btn-outline-secondary border @endif rounded-pill ms-2">Besok</button>
            </a>
            @for ($i = 2; $i <= 4; $i++) <a href="{{ route('rekreasi.detail', ['id' => $detail->id, 'date' => date('Y-m-d', strtotime('+' . $i . ' days',
                strtotime(now())))]) }}" class="text-decotarion-none text-dark">
                <button type="button"
                    class="btn @if($date == date('Y-m-d h:i:s', strtotime('+'.$i.' days',
                strtotime(now())))) bg-danger bg-opacity-25 text-danger @else btn-outline-secondary border @endif border rounded-pill ms-2">{{
                    \App\Helpers\General::getDateShortDayMonth(date('Y-m-d h:i:s', strtotime('+' . $i . ' days',
                    strtotime(now())))) }}</button>
                </a>
                @endfor
                <button type="button"
                    class="btn btn-outline-danger border bg-danger bg-opacity-25 text-danger rounded-pill ms-2"><span
                        class="fa-solid fa-calendar"> 15 Dec</span></button>
                <a href="{{ route('rekreasi.detail', ['id' => $detail->id, 'date' => date('Y-m-d h:i:s', strtotime(now()))]) }}"
                    class="text-decoration-none text-danger fw-bold fs-3 ms-3">Reset</a>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            @foreach ($detail->recreationPackages as $package)

            <div class="card bg-danger bg-opacity-25 p-3 mb-35px">
                @if (\App\Helpers\General::isWeekEnd($date))
                <span class="title fw-bold mb-3">{{ $package->name }}</span>

                @include('pagesv2.rekreasi.components._ticket_off', ['weektype' => 'Weekdays'])
                @include('pagesv2.rekreasi.components._ticket_on', ['weektype' => 'Weekend', 'days' =>
                \App\Helpers\General::getNextWeekends($date)])
                @else

                @include('pagesv2.rekreasi.components._ticket_on', ['weektype' => 'Weekday', 'days' =>
                \App\Helpers\General::getNextWeekdays($date)])
                @include('pagesv2.rekreasi.components._ticket_off', ['weektype' => 'Weekend'])
                @endif
            </div>
            @endforeach
        </div>

        <div class="col-4">
            <div class="card bg-danger bg-opacity-25 p-3">
                <div class="card d-flex flex-column p-3">
                    <div class="d-flex flex-row align-items-center">
                        <span class="fa-solid fa-cirlce-dot"></span>
                        <span class="text-danger fw-bold ms-3">
                            Tiket Reguler
                        </span>
                        <span class="ms-sm-auto">1 tersedia</span>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <span></span>
                        <span class="ms-3">
                            Tiket Premium
                        </span>
                        <span class="ms-sm-auto">1 tersedia</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    function decreaseTicket(id) {
        let qty = $("#qty_" + id).val();
        let dec = parseInt(qty) - 1;
        let price = $("#package_price_"+id).val();


        if (dec > 0) {
            $("#qty_" + id).val(dec);
            $("#qty_total_"+id).text(dec);
            $("#total_price_"+id).text(numberFormat(dec * price, 0, ',', '.'));
        }
    }

    function increaseTicket(id) {
        let qty = $("#qty_" + id).val();
        let inc = parseInt(qty) + 1;
        let price = $("#package_price_"+id).val();

        $("#qty_" + id).val(inc);
        $("#qty_total_"+id).text(inc);
        $("#total_price_"+id).text(numberFormat(inc * price, 0, ',', '.'));
    }

    function numberFormat(number, decimals = 0, decPoint = ',', thousandsSep = '.') {
        // Convert the number to a string and fix to the desired number of decimals
        let n = Number(number).toFixed(decimals);

        // Split the string into the integer and decimal parts
        let [integerPart, decimalPart] = n.split('.');

        // Add thousands separators
        integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSep);

        // Combine integer and decimal parts with the decimal point
        return decimals > 0 ? integerPart + decPoint + decimalPart : integerPart;
    }
</script>
@endpush