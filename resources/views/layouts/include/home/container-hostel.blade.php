<form action="{{ route('hostel.index') }}" method="get">
    <div class="row g-6" x-data="{
        totalDuration: 32,
        durationValue: 0,
        totalRoom: 11,
        totalGuest: 31,
        checkinValue: '',
        checkoutValue: '',
        handleSelectCheckin(e) {
            var date = e.target.value
            this.checkinValue = date;
            console.log(this.checkinValue)
            if (this.durationValue > 0) {
                this.checkoutValue = formatDateAndAddOneDay(date, this.durationValue);
            }
        },
        handleSelectDuration(e) {
            var duration = parseInt(e.target.value);
            this.durationValue = duration;
            if (duration == 0) {
                this.checkoutValue = '';
            } else if (this.checkinValue !== '') {
                this.checkoutValue = formatDateAndAddOneDay(this.checkinValue, duration);
            } else {
                return
            }
        },
        handleSelectRoom(e) {
            var value = parseInt(e.target.value)
            this.totalGuest = value * 3 + 1;
        },
        handleSelectRoom(e) {
            var value = parseInt(e.target.value)
            this.totalGuest = value * 3 + 1;
        },
        handleSelectGuest(e) {

        }
    }">
        <div class="col-md-12 ">
            <!--begin::Heading-->
            <div class="mb-3">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-5 fw-semibold">
                    <span class="required">Durasi Menginap</span>

                    <span class="m2-1" data-bs-toggle="tooltip"
                        title="Your billing numbers will be calculated based on your API method">
                        <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span
                                class="path2"></span><span class="path3"></span></i>
                    </span>
                </label>
                <!--end::Label-->
            </div>
            <!--end::Heading-->

            <!--begin::Radio group-->
            <div class="btn-group w-100" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">

                <!--begin::Radio-->
                <label class="btn btn-outline btn-color-muted btn-active-success" data-kt-button="true">
                    <!--begin::Input-->
                    <input class="btn-check" type="radio" name="category" value="monthly" />
                    <!--end::Input-->
                    Bulanan
                </label>
                <!--end::Radio-->

                <!--begin::Radio-->
                <label class="btn btn-outline btn-color-muted btn-active-success" data-kt-button="true">
                    <!--begin::Input-->
                    <input class="btn-check" type="radio" name="category" value="yearly" />
                    <!--end::Input-->
                    Tahunan
                </label>
                <!--end::Radio-->

            </div>
            <!--end::Radio group-->
        </div>
        <div class="col-md-12 ">
            <label class="form-label fw-bold fs-6">Pilih Lokasi</label>
            <select name="location" id="location" class="form-select select" data-control="select2"
                data-placeholder="Pilih Lokasi" autocomplete="on">
                <optgroup label="Kota"></optgroup>
                <template x-for="data in $store.hostel.cities">
                    <option x-bind:value="data.name" x-text="data.label"></option>
                </template>
            </select>
        </div>
        <div class="col-md-4 ">
            <label class="form-label fw-bold fs-6">Mulai Sewa</label>
            {{-- <div class="input-group">
                <input name="start" id="checkinHostel" type="date" class="form-control" value="" />
                <span class="input-group-text">
                    <i class="ki-duotone ki-calendar fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </span>
            </div> --}}
            <div class="input-group" id="js_datepicker_list_hostel" data-td-target-input="nearest"
                data-td-target-toggle="nearest">
                <input name="start" id="checkin" type="text" class="form-control"
                    data-td-target="#js_datepicker_list_hostel" data-td-toggle="datetimepicker"
                    x-on:change="handleSelectCheckin" value="" />
                <span class="input-group-text" data-td-target="#js_datepicker_list_hostel"
                    data-td-toggle="datetimepicker">
                    <i class="ki-duotone ki-calendar fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </span>
            </div>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold fs-6">Durasi Sewa</label>
            <select name="duration" x-bind:value="durationValue" id="durationHostel" class="form-select"
                x-on:change="handleSelectDuration">
                {{-- @for ($i = 1; $i < 12; $i++) <option value="{{ $i }}">{{ $i }} Tahun</option>
                    @endfor --}}
                    <option value="">Pilih Durasi</option>
            </select>
            {{-- <select name="duration" id="duration" class="form-select" x-bind:value="durationValue"
                x-on:change="handleSelectDuration">
                <template x-for="data in [ ...Array(totalDuration).keys() ]" key="data">
                    <option x-bind:value="data" x-text="data === 0 ? `Pilih Jumlah Bulan` : `${data} Bulan`">-
                    </option>
                </template>
            </select> --}}
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold fs-6">Sewa Berakhir</label>
            <input name="end" type="text" class="form-control" disabled x-bind:value="checkoutValue" />
            {{-- <input name="end" type="text" class="form-control" disabled /> --}}
        </div>
        {{-- <div class="col-md-6 col-6 ">--}}
            {{-- <label class="form-label fw-bold fs-6">Total Kamar</label>--}}
            {{-- <select name="room" id="room" class="form-select" x-on:change="handleSelectRoom">--}}
                {{-- <template x-for="data in [ ...Array(totalRoom).keys() ]" key="data">--}}
                    {{-- <option x-bind:value="data" x-text="data === 0 ? `Pilih Jumlah Kamar` : `${data} Kamar`">---}}
                        {{-- </option>--}}
                    {{-- </template>--}}
                {{-- </select>--}}
            {{-- </div>--}}
        {{-- <div class="col-md-6 col-6 ">--}}
            {{-- <label class="form-label fw-bold fs-6">Total Tamu</label>--}}
            {{-- <select name="guest" id="guest" class="form-select">--}}
                {{-- <template x-for="data in [ ...Array(totalGuest).keys() ]" key="data">--}}
                    {{-- <option x-bind:value="data" x-text="data === 0 ? `Pilih Jumlah Tamu` : `${data} Tamu`">---}}
                        {{-- </option>--}}
                    {{-- </template>--}}
                {{-- </select>--}}
            {{-- </div>--}}
        <div class="col-md-4">
            <label class="form-label fw-bold fs-6">Tipe Properti</label>
            <select name="property" id="property" class="form-select">
                <option value="">Semua</option>
                <option value="apartemen">Apartemen</option>
                <option value="villa">Villa</option>
                <option value="residence">Residence</option>
                <option value="rumah">Rumah</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold fs-6">Tipe Kamar</label>
            <select name="roomtype" id="roomtype" class="form-select">
                <option value="">Semua</option>
                <option value="1BR">1BR</option>
                <option value="2BR">2BR</option>
                <option value="3BR+">3BR+</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold fs-6">Tipe Furnish</label>
            <select name="furnish" id="furnish" class="form-select">
                <option value="">Semua</option>
                <option value="fullfurnished">Full Furnished</option>
                <option value="unfurnished">Unfurnished</option>
            </select>
        </div>
        <div class="col-md-12  text-end">
            <button style="margin-right: 1em" type="button" class="btn btn-flush" data-bs-dismiss="modal">Kembali
            </button>
            <button type="submit" class="btn btn-danger">Cari Hostel</button>
        </div>
    </div>
</form>
@push('add-script')
<script>
    function formatDateAndAddOneDay(dateString, duration = 0) {
        var parts = dateString.split('-');
        var day = parseInt(parts[0], 10);
        var month = parseInt(parts[1], 10) - 1;
        // Subtracting 1 to match JavaScript months (0-11)
        var year = parseInt(parts[2], 10);
        var date = new Date(year, month, day);
        date.setMonth(date.getMonth() + parseInt(duration));
        var formattedDate = ("0" + date.getDate()).slice(-2) + "-" + ("0" + (date.getMonth() + 1)).slice(-2) + "-" +
            date.getFullYear();
        return formattedDate;
    }

    var today_hostel = new Date();
    new tempusDominus.TempusDominus(document.getElementById("js_datepicker_list_hostel"), {
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
            minDate: today_hostel,
        },
    });

    $(document).ready(function () {
        $('input[name=category]').change(function () {
            var categoryValue = $(this).val();
            var durationSelect = $('#durationHostel');
            durationSelect.empty();

            durationSelect.append($('<option>', {
                value: '',
                text: 'Pilih Durasi'
            }));

            if (categoryValue === 'monthly') {
                for (var i = 1; i <= 11; i++) {
                    durationSelect.append($('<option>', {
                        value: i,
                        text: i + ' Bulan'
                    }));
                }
            }

            if (categoryValue === 'yearly') {
                for (var i = 1; i <= 10; i++) {
                    durationSelect.append($('<option>', {
                        value: i * 12,
                        text: i + ' Tahun'
                    }));
                }
            }

            // Setel nilai default jika diperlukan.
            durationSelect.val('');
            durationSelect.trigger('change');
        });

        $('#durationHostel').change(function () {
            var selectedDuration = $(this).val();
            var category = $('input[name=category]:checked').val();
            var checkinDate = $('#checkinHostel').val();

            // console.log(checkinDate);

            if (category === 'monthly') {
                if (checkinDate) {
                    var checkinDateObj = new Date(checkinDate);
                    if (!isNaN(checkinDateObj.getTime())) {
                        checkinDateObj.setMonth(checkinDateObj.getMonth() + parseInt(selectedDuration));
                        var endDate = checkinDateObj.toISOString().slice(0, 10); // Format ke dalam YYYY-MM-DD
                        $('#endHostel').val(endDate);
                    }
                }
            } else if (category === 'yearly') {
                if (checkinDate) {
                    // Parsing tanggal checkin ke dalam objek Date
                    var checkinDateObj = new Date(checkinDate);
                    if (!isNaN(checkinDateObj.getTime())) {
                        // Jika parsing berhasil
                        checkinDateObj.setFullYear(checkinDateObj.getFullYear() + parseInt(selectedDuration));
                        var endDate = checkinDateObj.toISOString().slice(0, 10); // Format ke dalam YYYY-MM-DD
                        $('#endHostel').val(endDate);
                    }
                }
            } else {
                $('#endHostel').val(''); // Kosongkan nilai jika kategori bukan "monthly" atau "yearly"
            }
        });
    });
</script>
@endpush