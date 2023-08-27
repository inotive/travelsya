@extends('admin.layout',['title' => 'Manajemen Data','url'=> route('admin.hostel'),'breadcrumb'=>['Hostel']])

@section('content-admin')
<div class="d-flex justify-content-end">
    <a href="{{route('admin.hostel.edit',$hostel->id)}}" class="btn btn-primary mb-5 mb-xl-8">Edit Hotel</a>
</div>

<div class="row">
    <div class="col-md-8">
        <!--begin::Tables Widget 11-->
        <div class="card mb-5 mb-xl-8">
        
            <!--begin::List widget 10-->
            <div class="card card-flush">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column gap-5">
                   <div class="d-flex justify-content-between">
                        <span class="card-label fw-bold fs-3 mb-1">{{$hostel->name}}</span>
                        <a class="align-self-center" href="//{{$hostel->website}}" target="__blank">Link Website</a>
                   </div>
                   <div class="d-flex flex-column">
                    {{$hostel->address}}
                   </div>
                    <div class="d-flex justify-content-between">
                        <span class="card-label mb-1">{{$hostel->phone}}</span>
                        <span class="card-label mb-1">{{$hostel->email}}</span>
                    </div>
                </div>
                <!--end: Card Body-->
            </div>
            <!--end::List widget 10-->
        </div>
        <!--end::Tables Widget 11-->
    </div>
    <div class="col-md-4">
        <!--begin::Tables Widget 11-->
        <div class="card mb-5 mb-xl-8">
        
            <!--begin::List widget 10-->
            <div class="card card-flush">
                <!--begin::Body-->
                <div class="card-body">
                   <div class="d-flex flex-column gap-7">
                        <div class="d-flex justify-content-between">
                            <span>Check In</span>
                            <span>{{$hostel->checkin}}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Check Out</span>
                            <span>{{$hostel->checkout}}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Status</span>
                            <span>{{$hostel->is_active ? "Aktif" : "Tidak Aktif"}}</span>
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

<div class="card mb-5 mb-xl-8">

    <!--begin::List widget 10-->
    <div class="card card-flush">
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Nav-->
            <ul class="nav nav-pills nav-pills-custom row position-relative mx-0 mb-9">
                <!--begin::Item-->
                <li class="nav-item col-2 mx-0 p-0">
                    <!--begin::Link-->
                    <a class="nav-link active d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#hostel">
                        <!--begin::Subtitle-->
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">Hostel Photo</span>
                        <!--end::Subtitle-->
                        <!--begin::Bullet-->
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                        <!--end::Bullet-->
                    </a>
                    <!--end::Link-->
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="nav-item col-2 mx-0 p-0">
                    <!--begin::Link-->
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#room">
                        <!--begin::Subtitle-->
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">Room</span>
                        <!--end::Subtitle-->
                        <!--begin::Bullet-->
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                        <!--end::Bullet-->
                    </a>
                    <!--end::Link-->
                </li>
                <!--end::Item-->
                <!--begin::Bullet-->
                <span class="position-absolute z-index-1 bottom-0 w-100 h-4px bg-light rounded"></span>
                <!--end::Bullet-->
            </ul>
            <!--end::Nav-->
            <!--begin::Tab Content-->
            <div class="tab-content">
                <!--begin::Tap pane-->
                <div class="tab-pane fade show active" id="hostel">
                    <div class="d-flex flex-wrap gap-5">
                        @foreach($hostel->hostelImage as $image)
                        <div class="mb-10 p-10 rounded-2" style="border:grey 1px solid;width:28%">
                            <img src="{{$image->image}}" alt="" class="w-100 mb-5">
                            <div class="d-flex flex-column gap-2">
                                <form action="{{route('admin.hostel.main-image')}}" method="post" class="d-flex flex-column">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$image->id}}">
                                    <input type="hidden" name="hostelid" value="{{$hostel->id}}">
                                    <button class="flex-fill btn btn-sm btn-info">
                                        Set Primary
                                    </button>
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
                <!--end::Tap pane-->
                <div class="tab-pane fade show" id="room">
                    <div class="d-flex flex-wrap gap-5">
                        @foreach($hostel->hostelRoom as $room)
                        <div class="mb-10 p-10 rounded-2" style="border:grey 1px solid;width:28%">
                            <img src="{{$room->image_1}}" alt="" class="w-100 mb-5">
                            <div class="d-flex flex-column gap-2 mt-5">
                                <span class="card-label fw-bold fs-3 mb-1">{{$room->name}}</span>
                                
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!--end::Tab Content-->
        </div>
        <!--end: Card Body-->
    </div>
    <!--end::List widget 10-->
</div>
<!--end::Tables Widget 11-->

@endsection
