@push('add-style')
<style>
  .slide {
    height: 100%;
    width: 100%
  }

  @media (min-width: 860px) {
    .desktop.carousel {
      display: block;
    }
    .mobile.carousel {
      display: none;
    }
  }

  @media (max-width: 860px) {
    .mobile.carousel {
      display: block;
    }
    .desktop.carousel {
      display: none;
    }
  }
</style>
@endpush

<div class="desktop carousel">
    @foreach ($listAds as $ads)
        <div class="slide">
            <img src="{{ asset('storage/'. $ads->image) }}" class="mw-100 rounded-4" />
        </div>
    @endforeach

  {{-- <div class="slide">
    <img src="{{asset('assets/media/banner-2.jpg')}}" class="mw-100 rounded-4" />
  </div>
  <div class="slide">
    <img src="{{asset('assets/media/banner-1.jpg')}}" class="mw-100 rounded-4" />
  </div>
  <div class="slide">
    <img src="{{asset('assets/media/banner-2.jpg')}}" class="mw-100 rounded-4" />
  </div> --}}
</div>

<div class="mobile carousel">
    @foreach ($listAds as $ads)
        <div class="slide">
            <img src="{{ asset('storage/'. $ads->image) }}" class="mw-100 rounded-4" />
        </div>
    @endforeach
  {{-- <div class="slide">
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
  </div> --}}
</div>

@push('add-script')

<script type="module">
  var slider = tns({
    container: '.desktop.carousel',
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
  var slider = tns({
    container: '.mobile.carousel',
    center: true,
    items: 1,
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
