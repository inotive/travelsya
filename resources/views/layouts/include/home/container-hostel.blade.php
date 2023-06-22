<form action="{{route("hostel.index")}}" method="get">
<div class="row"
x-data="{ 
  totalDuration: 32,
  durationValue: 0,
  totalRoom: 10,
  totalGuest: 30,
  checkinValue: '',
  checkoutValue: '',
  handleSelectCheckin(e) {
    var date = e.target.value
    this.checkinValue = date;
    if(this.durationValue > 0) {
      this.checkoutValue = formatDateAndAddOneDay(date, this.durationValue);
    }
  },
  handleSelectDuration(e) { 
    var duration = parseInt(e.target.value);
    this.durationValue = duration;
    if(duration == 0) {
      this.checkoutValue = '';
    }else if(this.checkinValue !== '') {
      this.checkoutValue = formatDateAndAddOneDay(this.checkinValue, duration);
    }else{
      return
    }
  },
  handleSelectRoom(e) {

  },
  handleSelectGuest(e) {

  }
}">
  <div class="col-md-3 mb-5">
    <label class="form-label fw-bold fs-6">Pilih Lokasi</label>
    <select name="location" id="location" class="form-select select" data-control="select2" data-placeholder="Pilih Lokasi" autocomplete="on">
      <optgroup label="Kota"></optgroup>
      <template x-for="data in $store.hotel.cities">
        <option x-bind:value="data.city" x-text="data.city"></option>
      </template>
      <optgroup label="Hotel"></optgroup>
      <template x-for="data in $store.hotel.hotels">
        <option x-bind:value="data.name" x-text="data.label"></option>
      </template>
    </select>
  </div>
  <div class="col-md-3 mb-5">
    <label class="form-label fw-bold fs-6">Tanggal Check-in</label>
    <div class="input-group" id="js_datepickerhostel" data-td-target-input="nearest" data-td-target-toggle="nearest">
      <input name="start" id="checkin" type="text" class="form-control" data-td-target="#js_datepickerhostel" x-on:change="handleSelectCheckin"/>
      <span class="input-group-text" data-td-target="#js_datepickerhostel" data-td-toggle="datetimepicker">
        <i class="ki-duotone ki-calendar fs-2">
          <span class="path1"></span>
          <span class="path2"></span>
        </i>
      </span>
    </div>
  </div>
  <div class="col-md-3 col-6 mb-5">
    <label class="form-label fw-bold fs-6">Duration</label>
    <select name="duration" id="duration" class="form-select" x-bind:value="durationValue" x-on:change="handleSelectDuration">
      <template x-for="data in [ ...Array(totalDuration).keys() ]" key="data">
        <option x-bind:value="data" x-text="data === 0 ? `Pilih Jumlah Bulan` : `${data} Bulan`">-</option>
      </template>
    </select>
  </div>
  <div class="col-md-3 col-6 mb-5">
    <label class="form-label fw-bold fs-6">Tanggal Checkout</label>
    <input name="end" type="text" class="form-control" disabled x-bind:value="checkoutValue" />
  </div>
  <div class="col-md-3 col-6 mb-5">
    <label class="form-label fw-bold fs-6">Total Kamar</label>
    <select name="room" id="room" class="form-select">
      <template x-for="data in [ ...Array(totalRoom).keys() ]" key="data">
        <option x-bind:value="data" x-text="data === 0 ? `Pilih Jumlah Kamar` : `${data} Kamar`">-</option>
      </template>
    </select>
  </div>
  <div class="col-md-3 col-6 mb-5">
    <label class="form-label fw-bold fs-6">Total Tamu</label>
    <select name="guest" id="guest" class="form-select">
      <template x-for="data in [ ...Array(totalGuest).keys() ]" key="data">
        <option x-bind:value="data" x-text="data === 0 ? `Pilih Jumlah Tamu` : `${data} Tamu`">-</option>
      </template>
    </select>
  </div>
  <div class="col-md-3 col-6 mb-5">
    <label class="form-label fw-bold fs-6">Tipe Properti</label>
    <select name="property" id="property" class="form-select">
        <option value="">Semua</option>
        <option value="apartemen">Apartemen</option>
        <option value="villa">Villa</option>
        <option value="residence">Residence</option>
        <option value="rumah">Rumah</option>
    </select>
  </div>
  <div class="col-md-3 col-6 mb-5">
    <label class="form-label fw-bold fs-6">Tipe Kamar</label>
    <select name="roomtype" id="roomtype" class="form-select">
        <option value="">Semua</option>
        <option value="1BR">1BR</option>
        <option value="2BR">2BR</option>
        <option value="3BR+">3BR+</option>
    </select>
  </div>
  <div class="col-md-3 col-6 mb-5">
    <label class="form-label fw-bold fs-6">Tipe Furnish</label>
    <select name="furnish" id="furnish" class="form-select">
        <option value="">Semua</option>
        <option value="fullfurnished">Full Furnished</option>
        <option value="unfurnished">Unfurnished</option>
    </select>
  </div>
  <div class="col-md-12 mb-5 text-end">
    <button style="margin-right: 1em" type="button" class="btn btn-flush" data-bs-dismiss="modal">Kembali</button>
    <button type="submit" class="btn btn-danger">Cari Hotel</button>
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
  var formattedDate = ("0" + date.getDate()).slice(-2) + "-" + ("0" + (date.getMonth() + 1)).slice(-2) + "-" + date.getFullYear();
  return formattedDate;
}

</script>
@endpush
