import React, { useState } from 'react';
import { createRoot } from 'react-dom/client';
 
export default function ExploreCity() {
  const data = [
    {
      id: 0,
      label: "Welcome to Bali",
      image: "https://service.travelsya.com/bahan/kota_1.png"
    },
    {
      id: 1,
      label: "Welcome to Yogyakarta",
      image: "https://service.travelsya.com/bahan/kota_2.png"
    },
    {
      id: 2,
      label: "Welcome to Jakarta",
      image: "https://service.travelsya.com/bahan/kota_3.png"
    },
    {
      id: 3,
      label: "Welcome to Surabaya",
      image: "https://service.travelsya.com/bahan/kota_4.png"
    },
    {
      id: 4,
      label: "Welcome to Bandung",
      image: "https://service.travelsya.com/bahan/kota_5.png"
    },
  ]
  return (
    <div className="bg-white mt-20">
      <div className="container-xxl py-10">
        <div className="row">
          <h2 className="fw-bold mb-3 mt-4">Jelajahi Sudut Kota</h2>
          <p className="fs-4 text-gray-700 mb-10">Ada berbagai pilihan destinasi liburan dengan harga spesial lho, jangan sampai kelewatan</p>
        </div>
        <div className="row">
          {data?.map(item => 
            <div className="col-6 col-md-3 pb-6" key={item.id}>
              <img src={item?.image} alt={item?.label} className="img-thumbnail w-100" />
            </div>
          ) || null}
        </div>
      </div>
    </div>
  )
}

if (document.getElementById('home-explore-city')) {
  const container = document.getElementById('home-explore-city');
  const root = createRoot(container);
  root.render(<ExploreCity />);
}