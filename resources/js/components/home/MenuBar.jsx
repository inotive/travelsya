import React, { useState } from 'react';
import { createRoot } from 'react-dom/client';
import "./StyleMenuBar.css";
import DummyMenu from '../../const/DummyMenu';
import MenuHotel from './MenuHotel';
 
export default function MenuBar() {
  const [isShow, setShow] = useState(false);
  const [mode, setMode] = useState();

  const dummy = {
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
                {DummyMenu?.data.map(item => 
                  <div 
                    data-bs-toggle="modal" 
                    data-bs-target={`${item?.isActive ? `#modal_action_feature` : ``}`} 
                    key={item?.id} 
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
                    {mode?.code === "hotel" ? <MenuHotel /> : null}
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