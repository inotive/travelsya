import React, { useState } from 'react';
import { createRoot } from 'react-dom/client';
import "./StyleMenuBar.css";
 
export default function MenuBar() {
  const [isShow, setShow] = useState(false);
  const [mode, setMode] = useState();

  const dummy = {
    data: [
      {
        id: 0,
        isActive: true,
        code: "hotel",
        label: "Hotel",
        image: "../assets/media/products-categories/icon-hotel.png",
        imageHeader: "https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2532&q=80",
        titleHeader: "Cari dan book Hotel untuk hari spesialmu!",
        classImage: "w-40px"
      },{
        id: 1,
        isActive: false,
        code: "plane",
        label: "Pesawat",
        image: "../assets/media/products-categories/icon-plane.png",
        imageHeader: "https://plus.unsplash.com/premium_photo-1679758630312-a3d601c411d8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2064&q=80",
        titleHeader: "",
        classImage: "w-40px"
      },{
        id: 2,
        isActive: false,
        code: "train",
        label: "Kereta Api",
        image: "../assets/media/products-categories/icon-kai.png",
        imageHeader: "",
        titleHeader: "",
        classImage: "w-40px"
      },{
        id: 3,
        isActive: false,
        code: "bus",
        label: "Bus & Travel",
        image: "../assets/media/products-categories/icon-bus.png",
        imageHeader: "",
        titleHeader: "",
        classImage: "w-40px"
      },{
        id: 4,
        isActive: false,
        code: "attraction",
        label: "Rekreasi",
        image: "../assets/media/products-categories/icon-rekreasi.png",
        imageHeader: "",
        titleHeader: "",
        classImage: "w-40px"
      },{
        id: 5,
        isActive: false,
        code: "rent-car",
        label: "Rental Mobil",
        image: "../assets/media/products-categories/icon-mobil.png",
        imageHeader: "",
        titleHeader: "",
        classImage: "w-40px"
      },{
        id: 6,
        isActive: true,
        code: "hostel",
        label: "Hostel",
        image: "../assets/media/products-categories/icon-hostel.png",
        imageHeader: "https://plus.unsplash.com/premium_photo-1661963540233-94097ba21f27?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2062&q=80",
        titleHeader: "Cari dan book Hostel untuk harian, mingguan, bulanan disini!",
        classImage: "w-40px"
      },{
        id: 7,
        isActive: false,
        code: "pln",
        label: "PLN",
        image: "../assets/media/products-categories/icon-pln.png",
        imageHeader: "",
        titleHeader: "",
        classImage: "w-30px"
      },{
        id: 8,
        isActive: true,
        code: "bpjs",
        label: "BPJS",
        image: "../assets/media/products-categories/icon-bpjs.png",
        imageHeader: "https://images.unsplash.com/photo-1528642474498-1af0c17fd8c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1769&q=80",
        titleHeader: "Bayar BPJS sekarang lebih mudah melalui Travelsya!",
        classImage: "w-30px"
      },{
        id: 9,
        isActive: true,
        code: "pdam",
        label: "PDAM",
        image: "../assets/media/products-categories/icon-pdam.png",
        imageHeader: "https://images.unsplash.com/photo-1526599256864-6bedb9d7dfb5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1771&q=80",
        titleHeader: "Bayar PDAM sekarang lebih mudah melalui Travelsya!",
        classImage: "w-40px"
      },{
        id: 10,
        isActive: false,
        code: "bank-transfer",
        label: "Transfer Bank",
        image: "../assets/media/products-categories/icon-transfer.png",
        imageHeader: "",
        titleHeader: "",
        classImage: "w-40px"
      },{
        id: 11,
        isActive: false,
        code: "e-wallet",
        label: "E-Wallet",
        image: "../assets/media/products-categories/icon-wallet.png",
        imageHeader: "",
        titleHeader: "",
        classImage: "w-40px"
      },{
        id: 12,
        isActive: true,
        code: "pulsa",
        label: "Pulsa & Data",
        image: "../assets/media/products-categories/icon-pulsa.png",
        imageHeader: "https://plus.unsplash.com/premium_photo-1664195539623-e25ce8e8d64b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80",
        titleHeader: "Isi pulsa dan paket datamu disini!",
        classImage: "w-40px"
      },{
        id: 13,
        isActive: true,
        code: "tv",
        label: "TV Berbayar",
        image: "../assets/media/products-categories/icon-tv.png",
        imageHeader: "https://images.unsplash.com/photo-1595935736128-db1f0a261263?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2971&q=80",
        titleHeader: "Bayar TV kabel sekarang lebih mudah melalui Travelsya!",
        classImage: "w-30px"
      },{
        id: 14,
        isActive: true,
        code: "pajak",
        label: "Pajak",
        image: "../assets/media/products-categories/icon-pajak.png",
        imageHeader: "https://images.unsplash.com/photo-1598432439250-0330f9130e14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1770&q=80",
        titleHeader: "Bayar Pajak sekarang lebih mudah melalui Travelsya!",
        classImage: "w-30px"
      }
    ],
    city: [
      {
        id: 0,
        name: 'balikpapan',
        label: 'Balikpapan'
      },{
        id: 1,
        name: 'bontang',
        label: 'Bontang'
      },{
        id: 2,
        name: 'samarinda',
        label: 'Samarinda'
      },{
        id: 3,
        name: 'sangatta',
        label: 'Sangatta'
      },{
        id: 4,
        name: 'tenggarong',
        label: 'Tenggarong'
      },{
        id: 5,
        name: 'banjarmasin',
        label: 'Banjarmasin'
      }
    ],
    hotelFavorite: [
      {
        id: 0,
        name: 'Hotel Santika Samarinda',
        location: {
          district: 'Loajanan',
          city: 'Samarinda'
        },
        price: {
          start: 450000,
          now: 325000
        },
        rating: 3,
        review: 2
      },{
        id: 1,
        name: 'Bena Kutai Balikpapan',
        location: {
          district: 'Rapak',
          city: 'Balikpapan'
        },
        price: {
          start: 450000,
          now: 325000
        },
        rating: 4,
        review: 90
      },{
        id: 2,
        name: 'Grand Senyiur',
        location: {
          district: 'Gunung Rinjani',
          city: 'Balikpapan'
        },
        price: {
          start: 450000,
          now: 325000
        },
        rating: 1,
        review: 129
      },{
        id: 3,
        name: 'Novotel Balikpapan Baru',
        location: {
          district: 'Rapak',
          city: 'Balikpapan'
        },
        price: {
          start: 450000,
          now: 325000
        },
        rating: 4,
        review: 2290
      },
    ]
  }

  return (
    <>
      <div className="mt-10 mb-5">
        <div id="" className="container-xl bg-transparent">
          <div className="card shadow-sm">
            <div className="card-body">
              <div className="row gy-3">
                {dummy.data.map(item => 
                  <div 
                    data-bs-toggle="modal" 
                    data-bs-target={`${item?.isActive ? `#modal_action_feature` : ``}`} 
                    key={item.id} 
                    onClick={() => setMode(item)} 
                    className="item-menubar col-4 col-md-3 col-lg-2 align-items-center"
                  >
                    <div className="row">
                      <div className="col-md-4 col-sm-12 justify-content-center">
                        <div className="child-item-menubar">
                          <img style={{filter: item?.isActive ? `grayscale(0)`:`grayscale(1)` }} src={item?.image || ""} className={`${item?.classImage || ""}`} />
                        </div>
                      </div>
                      <span className={`col-md-8 col-sm-12 ${item?.isActive ? `text-gray-600` : `text-gray-300`} fw-bold fs-6 item-label`}>{item?.label || "-"}</span>
                    </div>
                  </div>
                )}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div className="modal bg-body" tabIndex="-1" id="modal_action_feature">
        <div className="modal-dialog modal-fullscreen">
          <div className="modal-content shadow-none">
            <div 
              className="card border-transparent header-image" 
              data-bs-theme="light"
              style={{
                background: `linear-gradient(to right, rgba(44, 4, 4, 0.73), rgba(245, 246, 252, 0.52)), url(${mode?.imageHeader || ''})  no-repeat center center`
              }}
            >
              <div className="card-body d-flex ps-xl-20">
                <div className="m-0">
                  <div className="position-relative fs-2x z-index-2 fw-bold text-white mb-7">
                    <button data-bs-dismiss="modal" className="btn btn-icon btn-rounded btn-color-white bg-white bg-opacity-15 bg-hover-opacity-25 fw-semibold mb-5">
                      <i className="las la-angle-left"></i>
                    </button>
                    <div>
                      <span className="me-2">{mode?.titleHeader || ''}</span>
                      <br/><span className="fs-3 text-gray-300 me-2">Find the best deals on every Travelsya product you need!</span>
                    </div>
                  </div>
                </div>
                <img src="{{asset('assets/media/staycation-transparent.png')}}" className="position-absolute me-3 bottom-0 end-0 h-200px" alt="" />
              </div>
            </div>
            <div className="modal-body">
              <div className="container-xl mt-10 mb-30">
                <div className="card shadow-sm">
                  <div className="card-body">
                    <div className="row">
                      <div className="col-md-3 mb-5">
                        <label className="form-label fw-bold fs-6">Pilih Kota</label>
                        <select name="location" id="location" className="form-select">
                          {dummy.city.map(item => 
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
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}
 
if (document.getElementById('home-menu-bar')) {
    const container = document.getElementById('home-menu-bar');
    const root = createRoot(container);
    root.render(<MenuBar />);
}