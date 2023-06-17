<div>
  <div class="mt-10 mb-5" x-data>
    <div class="container-xl bg-transparent">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="row gy-3">
            <template x-for="data in $store.menubar.data">
              <div 
                data-bs-toggle="modal" 
                x-bind:data-bs-target="data.isActive ? '#modal_action_feature' : '' "
                @click="$store.menubar.selected = data"
                class="item-menubar col-4 col-md-3 col-lg-2 align-items-center"
              >
                <div class="row">
                  <div class="col-md-4 col-sm-12 justify-content-center">
                    <div class="child-item-menubar">
                      <img 
                        src="" 
                        x-bind:src="data.image"
                        :class="data.classImage || ''"
                        x-bind:style="data.isActive ? 'filter: grayscale(0)' : 'filter: grayscale(1)' "
                      />
                    </div>
                  </div>
                  <span 
                    x-text="data.label" 
                    :class="data.isActive ? 'text-gray-600' : 'text-gray-300'"
                    class="col-md-8 col-sm-12 fw-bold fs-6 item-label text-gray-600">-</span>
                </div>
              </div>
            </template>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal bg-body" id="modal_action_feature" x-data>
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content shadow-none">
        <div 
          class="card border-transparent header-image" 
          data-bs-theme="light"
          x-bind:style="`background:linear-gradient(to right, rgba(44, 4, 4, 0.73), rgba(245, 246, 252, 0.52)), url(${$store.menubar.selected.imageHeader}) no-repeat center center`"
        >
          <div class="card-body d-flex ps-xl-20">
            <div class="m-0">
              <div class="position-relative fs-2x z-index-2 fw-bold text-white mb-2">
                <button data-bs-dismiss="modal" class="btn btn-icon btn-rounded btn-color-white bg-white bg-opacity-15 bg-hover-opacity-25 fw-semibold mb-5">
                  <i class="las la-angle-left"></i>
                </button>
                <div>
                  <span class="me-2" x-html="$store.menubar.selected.label"></span>
                  <br/><span class="fs-3 text-gray-300 me-2">Find the best deals on every Travelsya product you need!</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-body">
          <div class="container-xl mt-10 mb-30">
            <div class="card shadow-sm">
              <div class="card-body">
                <div x-show="$store.menubar.selected.code==='hotel'">
                  @include('layouts.include.home.container-hotel')
                </div>
                <div x-show="$store.menubar.selected.code==='hostel'">
                  @include('layouts.include.home.container-hostel')
                </div>
                <div x-show="$store.menubar.selected.code==='attraction'">
                  @include('layouts.include.home.container-attraction')
                </div>
                <div x-show="$store.menubar.selected.code==='bpjs'">
                  @include('layouts.include.home.container-bpjs')
                </div>
                <div x-show="$store.menubar.selected.code==='pln'">
                  @include('layouts.include.home.container-pln')
                </div>
                <div x-show="$store.menubar.selected.code==='pdam'">
                  @include('layouts.include.home.container-pdam')
                </div>
                <div x-show="$store.menubar.selected.code==='e-wallet'">
                  @include('layouts.include.home.container-wallet')
                </div>
                <div x-show="$store.menubar.selected.code==='pulsa-data'">
                  @include('layouts.include.home.container-pulsa-data')
                </div>
                <div x-show="$store.menubar.selected.code==='tv'">
                  @include('layouts.include.home.container-tv')
                </div>
                <div x-show="$store.menubar.selected.code==='tax'">
                  @include('layouts.include.home.container-tax')
                </div>
                <div x-show="$store.menubar.selected.code==='plane'">
                  @include('layouts.include.home.container-plane')
                </div>
                <div x-show="$store.menubar.selected.code==='train'">
                  @include('layouts.include.home.container-train')
                </div>
                <div x-show="$store.menubar.selected.code==='bus-travel'">
                  @include('layouts.include.home.container-bus-travel')
                </div>
                <div x-show="$store.menubar.selected.code==='rent-car'">
                  @include('layouts.include.home.container-rent-car')
                </div>
                <div x-show="$store.menubar.selected.code==='bank-transfer'">
                  @include('layouts.include.home.container-bank-transfer')
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('add-style')
<style>
  .item-menubar {
    cursor: pointer;
  }
  .child-item-menubar {
    display: flex;
    background: url("./assets/media/bg-icon-menubar.png") no-repeat center center;
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
  .header-image {
    border-radius: 0px;
    background: linear-gradient(to right, rgba(44, 4, 4, 0.73), rgba(245, 246, 252, 0.52)), 
    url("https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2532&q=80") no-repeat center center;
    background-size: cover;
    border-bottom-left-radius: 4em;
    border-bottom-right-radius: 4em;
  }
  @media (max-width: 767px) {
    .item-label {
      margin-left: 0px;
      text-align: center;
    }
  }
</style>
@endpush