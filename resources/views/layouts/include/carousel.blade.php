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

  .slide {
    height: 100%;
    width: 100%
  }
</style>
@endpush
<!-- <div class="swiper carousel">
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
  <div class="swiper-button-prev"><</div>
  <div class="swiper-button-next">></div>
  <div class="swiper-scrollbar"></div>
</div> -->

<div class="carousel">
  <div class="slide">
    <img src="{{asset('assets/media/banner-1.jpg')}}" class="mw-100 rounded-4" />
  </div>
  <div class="slide">
    <img src="{{asset('assets/media/banner-2.jpg')}}" class="mw-100 rounded-4" />
  </div>
  <div class="slide">
    <img src="{{asset('assets/media/banner-1.jpg')}}" class="mw-100 rounded-4" />
  </div>
  <div class="slide">
    <img src="{{asset('assets/media/banner-2.jpg')}}" class="mw-100 rounded-4" />
  </div>
</div>

@push('add-script')
<!-- <script type="module">
  import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.esm.browser.min.js'

  var swiper = new Swiper(".carousel", {
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
</script> -->
<script type="module">
  var slider = tns({
    container: '.carousel',
    center: true,
    items: 2,
    speed: 2000,
    loop: true,
    autoplay: true,
    mouseDrag: true,
    edgePadding: 10,
    gutter: 20,
    autoplayButton: false,
    nav: false,
    dots: false,
    controls: false,
    autoplayButton: false,
    autoplayButtonOutput: false,
  });
  </script>
@endpush