<div id="kt_content_container" class="container-xl mb-30 mt-10">
  <hr class="border-dotted">
  <div class="row">
    <h2 class="fw-bold mb-3 mt-4">Partner Hotel Travelsya</h2>
    <div class="col-md-6">
      <p class="fs-4 text-gray-700 mb-10">Untuk Memastikan Kenyamanan saat menginap, kami melakukan kerja sama dengan berbagai hotel di seluruh indonesia</p>
    </div>
    <div class="col-md-6 text-end">
      <!-- <a href="/hotels" class="text-danger fs-4 fw-bold">Lihat Semua</a> -->
    </div>
  </div>

  <div class="row" x-data>
    <template x-for="data in $store.partnerhotel.data">
      <div class=" col-6 col-md-2">
        <!-- <div class="card">
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
        </div> -->


        <div class="card-xl-stretch me-md-6">
          <a x-bind:href="data.image" class="d-block overlay w-full" data-fslightbox="lightbox-hot-sales">
            <div
              class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
              x-bind:style="`background-image: url(${data.image})`"
            ></div>
            <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
              <i class="bi bi-eye-fill fs-2x text-white"></i>
            </div>
          </a>
          <div class="mt-5">
            <div class="h-40px">
              <a href="#" class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-baseå" x-html="data.label"></a>
            </div>
            <!-- <p class="fs-6 text-gray-600 text-dark mt-3" x-html="data.address"></p>
            <p class="fs-7 text-gray-800 text-dark mt-3 mb-0">Telp: <span x-html="data.telp"></span></p>
            <p class="fs-7 text-gray-800 text-dark mb-0">Email: <span x-html="data.email"></span></p>
            <p class="fs-7 text-gray-800 text-dark mb-0">Website: <span x-html="data.website"></span></p> -->
          </div>
        </div>

      </div>
    </template>
  </div>
</div>
