<div class="modal fade" id="create-room" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary"
                    data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <!--begin:Form-->
                {{-- <form id="kt_modal_new_target_form" class="form" method="post"
                    action="{{ route('partner.management.hotel.storeroom') }}"> --}}
                    @csrf
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Add Room</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <input type="hidden" id="hotel_id">
                    <div class="row g-9 mb-8">
                        <div class="col-md-12">
                            <label class="required fs-6 fw-semibold mb-2">Nama</label>
                            <input class="form-control form-control-lg" id="name"
                                placeholder="Masukan nama room" name="name"
                                required />

                            @error('name')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-12">
                            <label class="required fs-6 fw-semibold mb-2">Description</label>
                            
                            <input class="form-control form-control-lg" id="description"
                                placeholder="Masukan Deskripsi" name="description"
                                 />

                            @error('description')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Room Rate</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                            <input type="number" class="form-control form-control-lg" id="price"
                                placeholder="Masukan Nominal Price" name="price"
                                required />
                            </div>
                            @error('price')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Fix Rate</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                            <input type="number" class="form-control form-control-lg" id="sellingprice"
                                placeholder="Masukan Nominal Seling Price" name="sellingprice"
                                required />
                            </div>
                            @error('sellingprice')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-12">
                            <label class="required fs-6 fw-semibold mb-2">Tipe Bed</label>
                            
                            <input class="form-control form-control-lg" id="bedtype"
                                placeholder="Masukan Tipe Kasur" name="bed_type"
                                 />

                            @error('bed_type')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-12">
                            <label class="required fs-6 fw-semibold mb-2">Room Size</label>
                            
                            <input class="form-control form-control-lg" id="roomsize"
                                placeholder="Masukan Tipe Kasur" name="roomsize"
                                 />

                            @error('roomsize')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-12">
                            <label class="required fs-6 fw-semibold mb-2">Max Extra Bed</label>
                            
                            <input class="form-control form-control-lg" id="maxextrabed"
                                placeholder="Masukan maksimal extra bed" name="maxextrabed"
                                 />

                            @error('maxextrabed')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-12">
                            <label class="required fs-6 fw-semibold mb-2">Total Room</label>
                            
                            <input class="form-control form-control-lg" id="totalroom"
                                placeholder="Masukan Total Ruangan" name="totalroom"
                                 />

                            @error('totalroom')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-12">
                            <label class="required fs-6 fw-semibold mb-2">Guest</label>
                            
                            <input class="form-control form-control-lg" id="guest"
                                placeholder="Masukan Jumlah Tamu" name="guest"
                                 />

                            @error('guest')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                 
                    
                    
                    
                    
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <div class="row">
                            <div class="col-6">
                                <button type="reset" id="kt_modal_new_target_cancel"
                                    class="btn btn-light me-3">Cancel
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="submit" id="kt_modal_new_target_submit"
                                    class="btn btn-primary">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...
                                        <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </div>


                    </div>
                    <!--end::Actions-->
                </form>
                <!--end:Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>