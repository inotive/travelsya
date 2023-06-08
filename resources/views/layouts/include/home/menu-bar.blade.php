@push('add-style')
<style>
  .item-menubar {
    cursor: pointer;
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
    margin: 0 auto;
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
    text-align: left;
    margin-left: 1.2em;
  }
  @media (max-width: 767px) {
    .item-label {
      margin-left: 0px;
      text-align: center;
    }
  }
</style>
@endpush
<div class="mt-10 mb-5">
  <div id="" class="container-xl bg-transparent">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="row gy-3">
          <div data-bs-toggle="modal" data-bs-target="#modal_action_feature" class="item-menubar col-3 col-md-3 col-lg-2 align-items-center">
            <div class="row">
              <div class="col-md-4 col-sm-12 justify-content-center">
                <div class="child-item-menubar">
                  <img src="{{asset('assets/media/products-categories/icon-hotel.png')}}" class="w-40px" />
                </div>
              </div>
              <span class="col-md-8 col-sm-12 text-gray-600 fw-bold fs-6 item-label">Hotel</span>
            </div>
          </div>
          <div data-bs-toggle="modal" data-bs-target="#modal_action_feature" class="item-menubar col-3 col-md-3 col-lg-2 align-items-center">
            <div class="row">
              <div class="col-md-4 col-sm-12 justify-content-center">
                <div class="child-item-menubar">
                  <img src="{{asset('assets/media/products-categories/icon-plane.png')}}" class="w-40px" />
                </div>
              </div>
              <span class="col-md-8 col-sm-12 text-gray-600 fw-bold fs-6 item-label">Pesawat</span>
            </div>
          </div>
          <div data-bs-toggle="modal" data-bs-target="#modal_action_feature" class="item-menubar col-3 col-md-3 col-lg-2 align-items-center">
            <div class="row">
              <div class="col-md-4 col-sm-12 justify-content-center">
                <div class="child-item-menubar">
                  <img src="{{asset('assets/media/products-categories/icon-kai.png')}}" class="w-40px" />
                </div>
              </div>
              <span class="col-md-8 col-sm-12 text-gray-600 fw-bold fs-6 item-label">Kereta Api</span>
            </div>
          </div>
          <div data-bs-toggle="modal" data-bs-target="#modal_action_feature" class="item-menubar col-3 col-md-3 col-lg-2 align-items-center">
            <div class="row">
              <div class="col-md-4 col-sm-12 justify-content-center">
                <div class="child-item-menubar">
                  <img src="{{asset('assets/media/products-categories/icon-bus.png')}}" class="w-40px" />
                </div>
              </div>
              <span class="col-md-8 col-sm-12 text-gray-600 fw-bold fs-6 item-label">Bus & Travel</span>
            </div>
          </div>
          <div data-bs-toggle="modal" data-bs-target="#modal_action_feature" class="item-menubar col-3 col-md-3 col-lg-2 align-items-center">
            <div class="row">
              <div class="col-md-4 col-sm-12 justify-content-center">
                <div class="child-item-menubar">
                  <img src="{{asset('assets/media/products-categories/icon-rekreasi.png')}}" class="w-40px" />
                </div>
              </div>
              <span class="col-md-8 col-sm-12 text-gray-600 fw-bold fs-6 item-label">Rekreasi</span>
            </div>
          </div>
          <div data-bs-toggle="modal" data-bs-target="#modal_action_feature" class="item-menubar col-3 col-md-3 col-lg-2 align-items-center">
            <div class="row">
              <div class="col-md-4 col-sm-12 justify-content-center">
                <div class="child-item-menubar">
                  <img src="{{asset('assets/media/products-categories/icon-mobil.png')}}" class="w-40px" />
                </div>
              </div>
              <span class="col-md-8 col-sm-12 text-gray-600 fw-bold fs-6 item-label">Rental Mobil</span>
            </div>
          </div>
          <div data-bs-toggle="modal" data-bs-target="#modal_action_feature" class="item-menubar col-3 col-md-3 col-lg-2 align-items-center">
            <div class="row">
              <div class="col-md-4 col-sm-12 justify-content-center">
                <div class="child-item-menubar">
                  <img src="{{asset('assets/media/products-categories/icon-hostel.png')}}" class="w-40px" />
                </div>
              </div>
              <span class="col-md-8 col-sm-12 text-gray-600 fw-bold fs-6 item-label">Hostel</span>
            </div>
          </div>
          <a href="/" class="col-3 col-md-3 col-lg-2 align-items-center">
            <div class="row">
              <div class="col-md-4 col-sm-12 justify-content-center">
                <div class="child-item-menubar">
                  <img src="{{asset('assets/media/products-categories/icon-pln.png')}}" class="w-30px" />
                </div>
              </div>
              <span class="col-md-8 col-sm-12 text-gray-600 fw-bold fs-6 item-label">PLN</span>
            </div>
          </a>
          <a href="/" class="col-3 col-md-3 col-lg-2 align-items-center">
            <div class="row">
              <div class="col-md-4 col-sm-12 justify-content-center">
                <div class="child-item-menubar">
                  <img src="{{asset('assets/media/products-categories/icon-bpjs.png')}}" class="w-30px" />
                </div>
              </div>
              <span class="col-md-8 col-sm-12 text-gray-600 fw-bold fs-6 item-label">BPJS</span>
            </div>
          </a>
          <a href="/" class="col-3 col-md-3 col-lg-2 align-items-center">
            <div class="row">
              <div class="col-md-4 col-sm-12 justify-content-center">
                <div class="child-item-menubar">
                  <img src="{{asset('assets/media/products-categories/icon-pdam.png')}}" class="w-40px" />
                </div>
              </div>
              <span class="col-md-8 col-sm-12 text-gray-600 fw-bold fs-6 item-label">PDAM</span>
            </div>
          </a>
          <a href="/" class="col-3 col-md-3 col-lg-2 align-items-center">
            <div class="row">
              <div class="col-md-4 col-sm-12 justify-content-center">
                <div class="child-item-menubar">
                  <img src="{{asset('assets/media/products-categories/icon-transfer.png')}}" class="w-40px" />
                </div>
              </div>
              <span class="col-md-8 col-sm-12 text-gray-600 fw-bold fs-6 item-label">Transfer Bank</span>
            </div>
          </a>
          <a href="/" class="col-3 col-md-3 col-lg-2 align-items-center">
            <div class="row">
              <div class="col-md-4 col-sm-12 justify-content-center">
                <div class="child-item-menubar">
                  <img src="{{asset('assets/media/products-categories/icon-wallet.png')}}" class="w-40px" />
                </div>
              </div>
              <span class="col-md-8 col-sm-12 text-gray-600 fw-bold fs-6 item-label">E-Wallet</span>
            </div>
          </a>
          <a href="/" class="col-3 col-md-3 col-lg-2 align-items-center">
            <div class="row">
              <div class="col-md-4 col-sm-12 justify-content-center">
                <div class="child-item-menubar">
                  <img src="{{asset('assets/media/products-categories/icon-pulsa.png')}}" class="w-40px" />
                </div>
              </div>
              <span class="col-md-8 col-sm-12 text-gray-600 fw-bold fs-6 item-label">Pulsa & Data</span>
            </div>
          </a>
          <a href="/" class="col-3 col-md-3 col-lg-2 align-items-center">
            <div class="row">
              <div class="col-md-4 col-sm-12 justify-content-center">
                <div class="child-item-menubar">
                  <img src="{{asset('assets/media/products-categories/icon-tv.png')}}" class="w-30px" />
                </div>
              </div>
              <span class="col-md-8 col-sm-12 text-gray-600 fw-bold fs-6 item-label">TV Berbayar</span>
            </div>
          </a>
          <a href="/" class="col-3 col-md-3 col-lg-2 align-items-center">
            <div class="row">
              <div class="col-md-4 col-sm-12 justify-content-center">
                <div class="child-item-menubar">
                  <img src="{{asset('assets/media/products-categories/icon-pajak.png')}}" class="w-30px" />
                </div>
              </div>
              <span class="col-md-8 col-sm-12 text-gray-600 fw-bold fs-6 item-label">Pajak</span>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@include('layouts.include.home.modal-hotel')