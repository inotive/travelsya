@push('add-style')
<style>
  .item-menubar {
  }
  .child-item-menubar {
    display: flex;
    background: url("{{asset('assets/media/bg-icon-menubar.png')}}") no-repeat center center;
    background-size: 72px 72px;
    -webkit-box-pack: center;
    justify-content: center;
    align-items: center;
    width: 72px;
    height: 72px;
  }
  .item-label {
    flex: 1;
    align-self: center;
    white-space: pre-wrap;
    word-break: keep-all;
    word-wrap: break-word;
    text-overflow: ellipsis;
    overflow: hidden;
    width: 100%;
  }
</style>
@endpush
<div class="mt-10 mb-5">
  <div id="" class="container-xl bg-transparent">
    <div class="card">
      <div class="card-body">
        <div class="row g-3">
          <a href="/" class="col-6 col-md-3 col-lg-2 col-sm-6 d-flex align-items-center">
            <div class="child-item-menubar">
              <img src="{{asset('assets/media/products-categories/icon-hotel.png')}}" class="w-40px" />
            </div>
            <span class="text-danger fw-bold fs-6 item-label">Hotel</span>
          </a>
          <a href="/" class="col-6 col-md-3 col-lg-2 col-sm-6 d-flex align-items-center">
            <div class="child-item-menubar">
              <img src="{{asset('assets/media/products-categories/icon-hostel.png')}}" class="w-40px" />
            </div>
            <span class="text-gray-800 fw-bold fs-6 item-label">Hostel</span>
          </a>
          <a href="/" class="col-6 col-md-3 col-lg-2 col-sm-6 d-flex align-items-center">
            <div class="child-item-menubar">
              <img src="{{asset('assets/media/products-categories/icon-bpjs.png')}}" class="w-30px" />
            </div>
            <span class="text-gray-800 fw-bold fs-6 item-label">BPJS</span>
          </a>
          <a href="/" class="col-6 col-md-3 col-lg-2 col-sm-6 d-flex align-items-center">
            <div class="child-item-menubar">
              <img src="{{asset('assets/media/products-categories/icon-pajak.png')}}" class="w-30px" />
            </div>
            <span class="text-gray-800 fw-bold fs-6 item-label">Pajak</span>
          </a>
          <a href="/" class="col-6 col-md-3 col-lg-2 col-sm-6 d-flex align-items-center">
            <div class="child-item-menubar">
              <img src="{{asset('assets/media/products-categories/icon-pdam.png')}}" class="w-40px" />
            </div>
            <span class="text-gray-800 fw-bold fs-6 item-label">PDAM</span>
          </a>
          <a href="/" class="col-6 col-md-3 col-lg-2 col-sm-6 d-flex align-items-center">
            <div class="child-item-menubar">
              <img src="{{asset('assets/media/products-categories/icon-pulsa.png')}}" class="w-40px" />
            </div>
            <span class="text-gray-800 fw-bold fs-6 item-label">Pulsa & Data</span>
          </a>
          <a href="/" class="col-6 col-md-3 col-lg-2 col-sm-6 d-flex align-items-center">
            <div class="child-item-menubar">
              <img src="{{asset('assets/media/products-categories/icon-tv.png')}}" class="w-30px" />
            </div>
            <span class="text-gray-800 fw-bold fs-6 item-label">TV Berbayar</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>