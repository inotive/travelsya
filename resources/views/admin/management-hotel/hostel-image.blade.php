@extends('admin.layout',['title' => 'Setting Hostel','url'=> route('admin.hostel'),'breadcrumb'=>[$hostel->name]])

@section('content-admin')
<!--begin::Tables Widget 11-->
<div class="d-flex flex-row-auto flex-wrap">
    <div class="row justify-content-between">

        <!--begin::Tables Widget 11-->
        <div class="card col-md-4 mb-6 mb-xl-8">

            <!--begin::List widget 10-->
            <div class="card card-flush">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin:Form-->
                    <form id="kt_modal_new_target_form " class="form " method="post" enctype="multipart/form-data" action="{{route('admin.hostel.store-image',$hostel->id)}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$hostel->id}}">
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <div class="col-md-12 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Upload Image Multiple</label>
                                <input type="file" name="image[]" id="" class="form-control form-control-solid file-upload " multiple="true">
                                @error('image')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center d-flex flex-column gap-5">

                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary flex-fill">
                                <span class="indicator-label">Upload Photo</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <a href="{{route('admin.hostel')}}" type="reset" id="kt_modal_new_target_cancel" class="btn btn-light flex-fill">Back</a>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end:Form-->
                </div>
            </div>
            <!--end: Card Body-->
        </div>
        <!--end::List widget 10-->
         <!--begin::Tables Widget 11-->
         <div class="card col-md-8 mb-6 mb-xl-8">

            <!--begin::List widget 10-->
            <div class="card card-flush">
                <!--begin::Body-->
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-5">
                        @foreach($hostel->hostelImage as $image)
                        <div class="mb-10" style="width:48%">
                            <img src="{{$image->image}}" alt="" class="w-100 mb-5">
                            <div class="d-flex flex-column gap-2">
                                <form action="{{route('admin.hostel.main-image')}}" method="post" class="d-flex flex-column">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$image->id}}">
                                    <input type="hidden" name="hostelid" value="{{$hostel->id}}">
                                    @if($image->main == 1)
                                    <button class="flex-fill btn btn-sm btn-info disabled">
                                        Primary
                                    </button>
                                    @else
                                    <button class="flex-fill btn btn-sm btn-info">
                                        Set Primary
                                    </button>
                                    @endif
                                </form>
                                <form action="{{route('admin.hostel.delete-image')}}" method="post" class="d-flex flex-column">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{$image->id}}">
                                    <button class="flex-fill btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!--end: Card Body-->
        </div>
        <!--end::List widget 10-->
    </div>
    <!--end::Tables Widget 11-->
</div>
</div>
<!--end::Tables Widget 11-->

@endsection
@push('add-style')
