<div class="row" x-data="hotel">
  <div class="col-md-3 mb-5">
    <label class="form-label fw-bold fs-6">Pilih Kota</label>
    <select name="location" id="location" class="form-select">
      <template x-for="data in cities">
        <option x-bind:value="data.name" x-text="data.label"></option>
      </template>
    </select>
  </div>
  <div class="col-md-3 mb-5">
    <label class="form-label fw-bold fs-6">Tanggal Check-in</label>
      <input type="text" class="form-control js-daterangepicker" />
  </div>
  <div class="col-md-3 col-6 mb-5">
    <label class="form-label fw-bold fs-6">Total Kamar</label>
    <select name="lokasi" id="kamar" class="form-select">
    <!-- {(() => {
        const rows = [];
        for (let i = 1; i < 6; i++) {
          rows.push(<option key={i} value={i}>{i} Kamar</option>);
        }
        return rows;
      })()} -->
    </select>
  </div>
  <div class="col-md-3 col-6 mb-5">
    <label class="form-label fw-bold fs-6">Total Tamu</label>
    <select name="lokasi" id="tamu" class="form-select">
      <!-- {(() => {
        const rows = [];
        for (let i = 1; i < 6; i++) {
          rows.push(<option key={i} value={i}>{i} Tamu</option>);
        }
        return rows;
      })()} -->
    </select>
  </div>
  <div class="col-md-12 mb-5 text-end">
    <button style="margin-right: '1em'" type="button" class="btn btn-flush" data-bs-dismiss="modal">Kembali</button>
    <button type="button" class="btn btn-danger">Cari Hotel</button>
  </div>
</div>