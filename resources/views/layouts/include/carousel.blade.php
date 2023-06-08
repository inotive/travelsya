@push('add-style')
<style>
  .swiper {
    width: 100%;
    height: 100%;
  }

  .swiper-slide {
    text-align: center;
    font-size: 18px;
    /* Center slide text vertically */
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .swiper-slide img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 1.3em;
  }

  .swiper-slide-prev img,
  .swiper-slide-next img {
    /* opacity: 0.4; */
  }
</style>
@endpush
<div class="swiper mySwiper">
  <div class="swiper-wrapper">
    <div class="swiper-slide">
      <img src="{{asset('assets/media/banner-1.jpg')}}" />
    </div>
    <div class="swiper-slide">
      <img src="{{asset('assets/media/banner-2.jpg')}}" />
    </div>
    <div class="swiper-slide">
      <img src="{{asset('assets/media/banner-1.jpg')}}" />
    </div>
    <div class="swiper-slide">
      <img src="{{asset('assets/media/banner-2.jpg')}}" />
    </div>
  </div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
  <div class="swiper-scrollbar"></div>
</div>

@push('add-script')
<script type="module">
  import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.esm.browser.min.js'

  var swiper = new Swiper(".mySwiper", {
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      spaceBetween: 25,
      slidesPerView: 1.95,
      centeredSlides: true,
      loop: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
    });
</script>
@endpush