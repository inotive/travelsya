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

            <a href="{{ route('rekreasi.detail', ['id' => $detail->id, 'date' => \Carbon\Carbon::now()->addDays(1)->format('Y-m-d')]) }}"
                class="text-decotarion-none text-dark">
                <button type="button"
                    class="btn {{ $date == \Carbon\Carbon::now()->addDays(1)->format('Y-m-d') ? 'btn-outline-danger fs-6 border bg-danger bg-opacity-25 text-danger' : 'btn-outline-secondary border' }} rounded-pill ms-2">Besok</button>
            </a>
            @for ($i = 2; $i <= 4; $i++)
                @php
                    $current = \Carbon\Carbon::now()->addDays($i)->format('Y-m-d');
                @endphp
                <a href="{{ route('rekreasi.detail', ['id' => $detail->id, 'date' => $current]) }}"
                    class="text-decotarion-none text-dark">
                    <button type="button"
                        class="btn {{ $date == $current ? 'btn-outline-danger fs-6 border bg-danger bg-opacity-25 text-danger' : 'btn-outline-secondary border' }} rounded-pill ms-2">{{ \App\Helpers\General::getDateShortDayMonth(\Carbon\Carbon::now()->addDays($i)->format('Y-m-d')) }}</button>
                </a>
            @endfor
            <a
                href="{{ route('rekreasi.detail', ['id' => $detail->id, 'date' => \Carbon\Carbon::now()->addDays(9)->format('Y-m-d')]) }}">
                <button type="button"
                    class="btn {{ $date == \Carbon\Carbon::now()->addDays(9)->format('Y-m-d') ? 'btn-outline-danger fs-6 border bg-danger bg-opacity-25 text-danger' : 'btn-outline-secondary border' }} rounded-pill ms-2"><span
                        class="fa-solid fa-calendar me-2"></span>{{ \Carbon\Carbon::now()->addDays(9)->format('d M') }}</button>
            </a>
            <a href="{{ route('rekreasi.detail', ['id' => $detail->id, 'date' => \Carbon\Carbon::now()->format('Y-m-d')]) }}"
                class="text-decoration-none text-danger fw-bold fs-3 ms-3">Reset</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @foreach ($detail->recreationPackages as $key => $package)
                <div class="card bg-danger bg-opacity-25 p-3 mb-35px">
                    @if ($package->has_weekend == 0)
                        @include('pagesv2.rekreasi.components._ticket_on', [
                            'weektype' => 'weekday',
                            'days' => \App\Helpers\General::getNextWeekdays($date),
                            'today_price' => $package->price,
                        ])
                    @else
                        @if ($is_weekend)
                            @include('pagesv2.rekreasi.components._ticket_off', [
                                'weektype' => $weektype,
                                'days' => \App\Helpers\General::getNextWeekdays($date),
                                'today_price' => $package->price,
                            ])

                            @include('pagesv2.rekreasi.components._ticket_on', [
                                'weektype' => $weektype,
                                'days' => \App\Helpers\General::getNextWeekdays($date),
                                'today_price' => $package->weekend_price,
                            ])
                        @else
                            @include('pagesv2.rekreasi.components._ticket_on', [
                                'weektype' => $weektype,
                                'days' => \App\Helpers\General::getNextWeekdays($date),
                                'today_price' => $package->price,
                            ])
                            @include('pagesv2.rekreasi.components._ticket_off', [
                                'weektype' => $weektype,
                                'days' => \App\Helpers\General::getNextWeekdays($date),
                                'today_price' => $package->weekend_price,
                            ])
                        @endif
                    @endif
                    {{--                @if (\App\Helpers\General::isWeekEnd($date)) --}}
                    {{--                <span class="title fw-bold mb-3 text-capitalize">{{ $package->name }}</span> --}}

                    {{--                @include('pagesv2.rekreasi.components._ticket_off', ['weektype' => 'Weekdays']) --}}
                    {{--                @include('pagesv2.rekreasi.components._ticket_on', ['weektype' => 'Weekend', 'days' => --}}
                    {{--                \App\Helpers\General::getNextWeekends($date)]) --}}
                    {{--                @else --}}

                    {{--                --}}
                    {{--                @include('pagesv2.rekreasi.components._ticket_off', ['weektype' => 'Weekend']) --}}
                    {{--                @endif --}}
                </div>
            @endforeach
        </div>

        {{--        <div class="col-4"> --}}
        {{--            <div class="card bg-danger bg-opacity-25 p-3"> --}}
        {{--                <div class="card d-flex flex-column p-3"> --}}
        {{--                    <div class="d-flex flex-row align-items-center"> --}}
        {{--                        <span class="fa-solid fa-cirlce-dot"></span> --}}
        {{--                        <span class="text-danger fw-bold ms-3"> --}}
        {{--                            Tiket --}}
        {{--                        </span> --}}
        {{--                        <span class="ms-sm-auto">Tersedia</span> --}}
        {{--                    </div> --}}
        {{--                    <div class="d-flex flex-row align-items-center"> --}}
        {{--                        <span></span> --}}
        {{--                        <span class="ms-3"> --}}
        {{--                            Tiket Premium --}}
        {{--                        </span> --}}
        {{--                        <span class="ms-sm-auto">1 tersedia</span> --}}
        {{--                    </div> --}}
        {{--                </div> --}}
        {{--            </div> --}}
        {{--        </div> --}}
    </div>
</div>

@push('js')
    <script>
        function decreaseTicket(id) {
            let qty = $("#qty_" + id).val();
            let dec = parseInt(qty) - 1;
            let price = $("#package_price_" + id).val();


            if (dec > 0) {
                $("#qty_" + id).val(dec);
                $("#qty_total_" + id).text(dec);
                $("#total_price_" + id).text(numberFormat(dec * price, 0, ',', '.'));
            }
        }

        function increaseTicket(id) {
            let qty = $("#qty_" + id).val();
            let inc = parseInt(qty) + 1;
            let price = $("#package_price_" + id).val();

            $("#qty_" + id).val(inc);
            $("#qty_total_" + id).text(inc);
            $("#total_price_" + id).text(numberFormat(inc * price, 0, ',', '.'));
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
