@push('add-style')
<style>
.header-image {
  border-radius: 0px;
  background: linear-gradient(to right, rgba(44, 4, 4, 0.73), rgba(245, 246, 252, 0.52)), 
  url("https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2532&q=80") no-repeat center center;
  background-size: cover;
  border-bottom-left-radius: 4em;
  border-bottom-right-radius: 4em;
}
</style>
@endpush
<div class="modal bg-body" tabindex="-1" id="modal_action_feature">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content shadow-none">
      <!-- <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
          <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
        </div>
      </div> -->
      <div class="card border-transparent header-image" data-bs-theme="light">
        <div class="card-body d-flex ps-xl-20">
          <div class="m-0">
            <div class="position-relative fs-2x z-index-2 fw-bold text-white mb-7">
              <button data-bs-dismiss="modal" class="btn btn-icon btn-rounded btn-color-white bg-white bg-opacity-15 bg-hover-opacity-25 fw-semibold mb-5">
                <i class="las la-chevron-left"></i>
              </button>
              <div>
                <span class="me-2">Cari dan book Hotel untuk hari spesialmu!
                  <span class="position-relative d-inline-block text-danger">
                    <span class="position-absolute opacity-50 bottom-0 start-0 border-4 border-danger border-bottom w-100"></span>
                  </span>
                </span>
                <br><span class="fs-3 text-gray-300 me-2">Find the best deals on every Travelsya product you need!</span>
              </div>
            </div>
            <!-- <div class="mb-3">
              <a href="/" class="btn btn-danger fw-semibold me-2" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">Get Reward</a>
            </div> -->
          </div>
          <!-- <img src="{{asset('assets/media/staycation-transparent.png')}}" class="position-absolute me-3 bottom-0 end-0 h-200px" alt=""> -->
        </div>
      </div>
      <div class="modal-body">
        <div class="container-xl mt-10 mb-30">
          <div class="card shadow-sm">
            <div class="card-body">
              <div class="row">
                <div class="col-md-3 mb-5">
                  <label class="form-label">Pilih Kota</label>
                  <select name="lokasi" id="lokasi" class="form-control">
                    <option value="Jakarta">Jakarta</option>
                    <option value="Jakarta">Bandung</option>
                  </select>
                </div>
                <div class="col-md-3 mb-5">
                  <label class="form-label">Tanggal Check-in</label>
                  <input type="text" class="form-control js-daterangepicker">
                </div>
                <div class="col-md-3 mb-5">
                  <label class="form-label">Total Kamar</label>
                  <select name="lokasi" id="kamar" class="form-control">
                    @for($i=1;$i<6;$i++) <option value="1">{{$i}} Kamar</option>
                    @endfor
                  </select>
                </div>
                <div class="col-md-3 mb-5">
                  <label class="form-label">Total Tamu</label>
                  <select name="lokasi" id="tamu" class="form-control">
                    @for($i=1;$i<6;$i++) <option value="1">{{$i}} Tamu</option>
                    @endfor
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>