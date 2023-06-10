import React, { useState } from 'react';
import { createRoot } from 'react-dom/client';
 
export default function ExploreCity() {
  return (
    <div class="bg-white mt-20">
      <div class="container-xxl py-10">
        <div class="row">
          <h2 class="fw-bold mb-3 mt-4">Jelajahi Sudut Kota</h2>
          <p class="fs-4 text-gray-700 mb-10">Ada berbagai pilihan destinasi liburan dengan harga spesial lho, jangan sampai kelewatan</p>
        </div>
        <div class="row">
          <div class="col-md-2">
              <img src="https://fastly.picsum.photos/id/352/300/200.jpg?hmac=uE24cIWqkmFTjbnCcvGEkIF6iCPiJtS2N2lbaa0ku9w" alt="..." class="img-thumbnail w-100" />
          </div>
          <div class="col-md-2">
              <img src="https://fastly.picsum.photos/id/352/300/200.jpg?hmac=uE24cIWqkmFTjbnCcvGEkIF6iCPiJtS2N2lbaa0ku9w" alt="..." class="img-thumbnail w-100" />
          </div>
          <div class="col-md-2">
              <img src="https://fastly.picsum.photos/id/352/300/200.jpg?hmac=uE24cIWqkmFTjbnCcvGEkIF6iCPiJtS2N2lbaa0ku9w" alt="..." class="img-thumbnail w-100" />
          </div>
          <div class="col-md-2">
              <img src="https://fastly.picsum.photos/id/352/300/200.jpg?hmac=uE24cIWqkmFTjbnCcvGEkIF6iCPiJtS2N2lbaa0ku9w" alt="..." class="img-thumbnail w-100" />
          </div>
          <div class="col-md-2">
              <img src="https://fastly.picsum.photos/id/352/300/200.jpg?hmac=uE24cIWqkmFTjbnCcvGEkIF6iCPiJtS2N2lbaa0ku9w" alt="..." class="img-thumbnail w-100" />
          </div>
          <div class="col-md-2">
              <img src="https://fastly.picsum.photos/id/352/300/200.jpg?hmac=uE24cIWqkmFTjbnCcvGEkIF6iCPiJtS2N2lbaa0ku9w" alt="..." class="img-thumbnail w-100" />
          </div>
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