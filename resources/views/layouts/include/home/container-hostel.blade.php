<div class="row"
  x-data="{ 
    totalDuration: 32,
    durationValue: 0,
    totalRoom: 11,
    totalGuest: 31,
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
      var value = parseInt(e.target.value)
      this.totalGuest = value * 3 + 1;
    }
  }"
>
  <div class="col-md-3 mb-5">
    <label class="form-label fw-bold fs-6">Pilih Lokasi</label>
    <select id="location" class="form-select select" data-control="select2" data-placeholder="Pilih Lokasi" autocomplete="on">
      <optgroup label="Kota"></optgroup>
      <template x-for="data in $store.hostel.cities">
        <option x-bind:value="data.name" x-text="data.label"></option>
      </template>
    </select>
  </div>
  <div class="col-md-3 mb-5">
    <label class="form-label fw-bold fs-6">Tanggal Check-in</label>
    <div class="input-group" id="js_datepicker" data-td-target-input="nearest" data-td-target-toggle="nearest">
      <input id="checkin" type="text" class="form-control" data-td-target="#js_datepicker" x-on:change="handleSelectCheckin"/>
      <span class="input-group-text" data-td-target="#js_datepicker" data-td-toggle="datetimepicker">
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
        <option x-bind:value="data" x-text="data === 0 ? `Pilih Jumlah Malam` : `${data} Malam`">-</option>
      </template>
    </select>
  </div>
  <div class="col-md-3 col-6 mb-5">
    <label class="form-label fw-bold fs-6">Tanggal Checkout</label>
    <input type="text" class="form-control" disabled x-bind:value="checkoutValue" />
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
  <div class="col-md-12 mb-5 text-end">
    <button style="margin-right: 1em" type="button" class="btn btn-flush" data-bs-dismiss="modal">Kembali</button>
    <button type="button" class="btn btn-danger">Cari Hotel</button>
  </div>
</div>