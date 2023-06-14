import React, { useEffect } from "react";
import DummyCity from "../../const/DummyCity";
import searchToObject from "../../helpers/utils";

function MenuHotel() {
  const params = searchToObject();
  
  return (
    <div className="row">
      <div className="col-md-3 mb-5">
        <label className="form-label fw-bold fs-6">Pilih Kota</label>
        <select name="location" id="location" className="form-select">
          {DummyCity.data.map(item => 
            <option key={item.id} value={item?.name || ''}>{item?.label || ''}</option>
          )}
        </select>
      </div>
      <div className="col-md-3 mb-5">
        <label className="form-label fw-bold fs-6">Tanggal Check-in</label>
          <input type="text" className="form-control js-daterangepicker" />
      </div>
      <div className="col-md-3 col-6 mb-5">
        <label className="form-label fw-bold fs-6">Total Kamar</label>
        <select name="lokasi" id="kamar" className="form-select">
        {(() => {
            const rows = [];
            for (let i = 1; i < 6; i++) {
              rows.push(<option key={i} value={i}>{i} Kamar</option>);
            }
            return rows;
          })()}
        </select>
      </div>
      <div className="col-md-3 col-6 mb-5">
        <label className="form-label fw-bold fs-6">Total Tamu</label>
        <select name="lokasi" id="tamu" className="form-select">
          {(() => {
            const rows = [];
            for (let i = 1; i < 6; i++) {
              rows.push(<option key={i} value={i}>{i} Tamu</option>);
            }
            return rows;
          })()}
        </select>
      </div>
      <div className="col-md-12 mb-5 text-end">
        <button style={{ marginRight: '1em'}} type="button" className="btn btn-flush" data-bs-dismiss="modal">Kembali</button>
        <button type="button" className="btn btn-danger">Cari Hotel</button>
      </div>
    </div>
  )
}

export default MenuHotel;