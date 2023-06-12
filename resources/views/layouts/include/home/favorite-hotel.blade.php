<div class="row">
  <h2 class="fw-bold mb-3 mt-4">Yang Paling Populer</h2>
  <div class="col-md-6">
    <p class="fs-4 text-gray-700 mb-10">Hotel yang paling sering dikunjungi saat liburan</p>
  </div>
  <div class="col-md-6 text-end">
    <a href="/hotels" class="text-danger fs-4 fw-bold">Lihat Semua</a>
  </div>
</div>

<div class="row justify-content-between" x-data="favoritehotel">
  <template x-for="data in favoriteHotel">
    <div class="col-md-3">
      <div class="card">
        <img 
          class="card-img-top h-200px"
          x-bind:src="data.image"
          x-bind:alt="data.label" 
        >
        <div class="card-body p-5">
          <span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1" x-html="data.label"></span>
          <span class="text-gray-400 fw-semibold d-block fs-6 mt-1" x-html="data.city"></span>
          <span class="text-gray-400 fw-semibold d-block mt-5">Mulai dari <s x-html="data.price"></s></span>
          <span class="text-danger text-end fw-bold fs-1 mt-2">IDR <span x-html="data.realPrice"></span></span>
          <span class="text-gray-600 cursor-pointer d-block  mt-5 text-align-center">
            <span class="fa fa-star fs-4" style="color: red;"></span> 
            <span x-html="data.rate"></span>
            <span class="text-gray-400" x-html="data.totalRate"></span>
          </span>
        </div>
      </div>
    </div>
  </template>
</div>