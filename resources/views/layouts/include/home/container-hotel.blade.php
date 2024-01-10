<form action="{{ route('hotels.index') }}" method="get">

    <div class="row" x-data="{
        totalDuration: 32,
        durationValue: 0,
        filterGuest: 0,
        totalRoom: 11,
        totalGuest: 31,
        checkinValue: '',
        checkoutValue: '',
        handleSelectCheckin(e) {
            var date = e.target.value
            this.checkinValue = date;
            if (this.durationValue > 0) {
                this.checkoutValue = calculateCheckoutDate(this.checkinValue, duration);
            }
        },
        handleSelectDuration(e) {
            var duration = parseInt(e.target.value);
            this.durationValue = duration;
            if (duration == 0) {
                this.checkoutValue = '';
            } else if (this.checkinValue !== '') {
                this.checkoutValue = calculateCheckoutDate(this.checkinValue, duration);
            } else {
                return
            }
        },
        handleSelectRoom(e) {
            var value = parseInt(e.target.value)
            this.totalGuest = value * 3 + 1;
            this.filterGuest = value;
        },
        handleSelectGuest(e) {
    
        }
    }">
        <div class="col-md-12 mb-5">
            <label class="form-label fw-bold fs-6">Pilih Lokasi</label>
            <select name="location" id="location" class="form-select" data-control="select2"
                data-placeholder="Pilih Lokasi" autocomplete="on">
                <optgroup label="Kota"></optgroup>
                <template x-for="data in $store.hotel.cities">
                    <option x-bind:value="data.name" x-text="data.label"></option>
                </template>
                {{-- <optgroup label="Hotel"></optgroup>
                <template x-for="data in $store.hotel.hotels">
                    <option x-bind:value="data.name" x-text="data.label"></option>
                </template> --}}
            </select>
        </div>
        <div class="col-md-4 mb-5">
            <label class="form-label fw-bold fs-6">Tanggal Check-in</label>
            <div class="input-group" id="js_datepicker_list_hotel" data-td-target-input="nearest"
                data-td-target-toggle="nearest">
                <input id="checkin" type="text" name="start" class="form-control cursor-pointer"
                    autocomplete="off" data-td-target="#js_datepicker_list_hotel" data-td-toggle="datetimepicker"
                    value="" x-on:change="handleSelectCheckin" />

                <span class="input-group-text" data-td-target="#js_datepicker_list_hotel"
                    data-td-toggle="datetimepicker">
                    <i class="ki-duotone ki-calendar fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </span>
            </div>
        </div>
        <div class="col-md-4 col-6 mb-5">
            <label class="form-label fw-bold fs-6">Duration</label>
            <select name="duration" id="duration" class="form-select" x-bind:value="durationValue"
                x-on:change="handleSelectDuration">
                <template x-for="data in Array.from({ length: totalDuration }).map((_, index) => index + 1)">
                    <option x-if="data > 0" x-bind:value="data" x-text="`${data} Malam`"></option>
                </template>
            </select>
        </div>
        <div class="col-md-4 col-6 mb-5">
            <label class="form-label fw-bold fs-6">Tanggal Checkout</label>
            <input type="text" class="form-control" name="end_date" disabled x-bind:value="checkoutValue" />
        </div>

        <div x-data="{ totalRoom: 0, totalGuest: 0 }" class="row">
            <div class="col-md-6 col-6 mb-5">
                <label class="form-label fw-bold fs-6">Total Kamar</label>
                <select name="room" id="room" class="form-select" onchange="handleSelectRoom(this)">
                    <option value="1">1 Kamar</option>
                    <option value="2">2 Kamar</option>
                    <option value="3">3 Kamar</option>
                    <option value="4">4 Kamar</option>
                    <option value="5">5 Kamar</option>
                    <option value="6">6 Kamar</option>
                    <option value="7">7 Kamar</option>
                    <option value="8">8 Kamar</option>
                    <option value="9">9 Kamar</option>
                    <option value="10">10 Kamar</option>
                </select>
                {{-- <select name="room" id="room" class="form-select" x-on:change="handleSelectRoom"
                    x-model="totalRoom">
                    <template x-for="data in Array.from({ length: 10 }).map((_, index) => index + 1)">
                        <option x-if="data > 0" x-bind:value="data" x-text="`${data} Kamar`"></option>
                    </template>
                </select> --}}
            </div>

            <div class="col-md-6 col-6 mb-5">
                <label class="form-label fw-bold fs-6">Total Tamu</label>
                <select name="guest" id="guest" class="form-select" onchange="handleSubmit()">
                    <option value="1">1 Tamu</option>
                    <option value="2">2 Tamu</option>
                    <option value="3">3 Tamu</option>
                    <option value="4">4 Tamu</option>
                    <option value="5">5 Tamu</option>
                    <option value="6">6 Tamu</option>
                    <option value="7">7 Tamu</option>
                    <option value="8">8 Tamu</option>
                    <option value="9">9 Tamu</option>
                    <option value="10">10 Tamu</option>
                </select>
                {{-- <select name="guest" id="guest" class="form-select" x-model="totalGuest">
                    <template x-for="data in Array.from({ length: 10 }).map((_, index) => index + 1)"
                        :key="data">
                        <option x-if="data > 0" x-bind:value="data" x-text="`${data} Tamu`"></option>
                    </template>
                </select> --}}
            </div>
            <!-- Validation message -->
            <p x-show=" totalRoom > totalGuest" class="text-danger" x-cloak>Total Tamu Harus Lebih atau sama dengan
                Total Kamar.</p>

        </div>
        <div class="col-md-12 mb-5 text-end">
            <button style="margin-right: 1em" type="button" class="btn btn-flush"
                data-bs-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-danger" x-on:click="handleSubmit">Cari Hotel</button>
        </div>

    </div>
</form>
@push('add-script')
    <script>
        function calculateCheckoutDate(checkinDate, duration) {
            var parts = checkinDate.split('-');
            var day = parseInt(parts[0], 10);
            var month = parseInt(parts[1], 10) - 1;
            var year = parseInt(parts[2], 10);
            var checkin = new Date(year, month, day);
            checkin.setDate(checkin.getDate() + duration);
            var checkoutDate = ("0" + checkin.getDate()).slice(-2) + "-" + ("0" + (checkin.getMonth() + 1)).slice(-2) +
                "-" + checkin.getFullYear();

            return checkoutDate;
        }

        var todayHotel = new Date();
        new tempusDominus.TempusDominus(document.getElementById("js_datepicker_list_hotel"), {
            display: {
                viewMode: "calendar",
                components: {
                    date: true,
                    hours: false,
                    minutes: false,
                    seconds: false
                }
            },
            localization: {
                locale: "id",
                format: "dd-MM-yyyy",
            },
            restrictions: {
                minDate: todayHotel,
            },
        });

        let guest = document.getElementById('guest');
        guest.addEventListener('change', function() {
            let room = document.getElementById('room').value;
            if (guest.value < room) {
                alert('Total Tamu harus Lebih Dari Total Kamar atau sama dengan Total Kamar.');
                guest.value = room;
                return;
            }
        });

        function handleSelectRoom(x) {
            console.log(x.value);
            let roomInput = document.getElementById('room');
            let guest = document.getElementById('guest');

            // let room = parseInt(roomInput.value);
            // let guest = parseInt(guestInput.value);

            guest.value = x.value
            // if (guest.value <  x.value) {
            //     // alert('Total Tamu harus Lebih Dari Total Kamar atau sama dengan Total Kamar.');
            //     return;
            // }

            // x.value=guest;

            console.log(guest.value, x.value);

        }

        function handleSubmit() {
            let room = document.getElementById('room').value;
            let guest = document.getElementById('guest').value;

            if (guest < room) {
                alert('Total Tamu harus Lebih Dari Total Kamar atau sama dengan Total Kamar.');
                guest = room
                return;
            }

            console.log(room, guest);

        }
    </script>
@endpush
