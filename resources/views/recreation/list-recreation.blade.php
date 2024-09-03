@extends('layouts.web')

@section('title', 'Daftar Wisata Rekreasi')

<style>
    .filter-btn {
        border: 1px solid #ccc;
        padding: 5px 20px;
        border-radius: 30px;
        background-color: #f8f9fa;
        cursor: pointer;
    }

    .filter-btn.active {
        background-color: #f8d7da;
        color: #dc3545;
        border-color: #dc3545;
    }

</style>


@section('content-web')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-sm">
  <div class="content flex-row-fluid mb-10" id="kt_content">

    <h2>Apa yang ingin anda lakukan?</h2>
    <div class="d-flex gap-3 flex-wrap mt-4 align-items-center">
        <div class="filter-btn active" data-filter="atraksi">Atraksi</div>
        <div class="filter-btn" data-filter="spa-kecantikan">Spa & Kecantikan</div>
        <div class="filter-btn" data-filter="event">Event</div>
        <div class="filter-btn" data-filter="arena-bermain">Arena Bermain</div>
        <input type="text" id="keyword" class="form-control form-control-lg ms-auto" name="keyword" placeholder="Cari Tempat" value="" style="max-width: 300px;" />
    </div>



    <h5 class="mt-10">Menampilkan 100 Atraksi</h5>

    <div class="row row-cols-1 row-cols-md-4 g-4">
        <div class="col">
          <div class="card shadow">
            <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top" alt="...">
            <div class="card-body">
                <h4 class="card-title">Meiso Kelapa Gading</h4>
                <p class="card-text">Jakarta Utara</p>
                <div class="d-flex justify-content-between mt-5">
                    <h4 style="color: rgb(255, 0, 0);">IDR 130,000</h4>
                    <span class="card-text fa fa-star" style="color: rgb(255, 0, 0);"></span>
                </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow">
            <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top" alt="...">
            <div class="card-body">
                <h4 class="card-title">Meiso Kelapa Gading</h4>
                <p class="card-text">Jakarta Utara</p>
                <div class="d-flex justify-content-between mt-5">
                    <h4 style="color: rgb(255, 0, 0);">IDR 130,000</h4>
                    <span class="card-text fa fa-star" style="color: rgb(255, 0, 0);"></span>
                </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow">
            <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top" alt="...">
            <div class="card-body">
                <h4 class="card-title">Meiso Kelapa Gading</h4>
                <p class="card-text">Jakarta Utara</p>
                <div class="d-flex justify-content-between mt-5">
                    <h4 style="color: rgb(255, 0, 0);">IDR 130,000</h4>
                    <span class="card-text fa fa-star" style="color: rgb(255, 0, 0);"></span>
                </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow">
            <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top" alt="...">
            <div class="card-body">
                <h4 class="card-title">Meiso Kelapa Gading</h4>
                <p class="card-text">Jakarta Utara</p>
                <div class="d-flex justify-content-between mt-5">
                    <h4 style="color: rgb(255, 0, 0);">IDR 130,000</h4>
                    <span class="card-text fa fa-star" style="color: rgb(255, 0, 0);"></span>
                </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow">
            <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top" alt="...">
            <div class="card-body">
                <h4 class="card-title">Meiso Kelapa Gading</h4>
                <p class="card-text">Jakarta Utara</p>
                <div class="d-flex justify-content-between mt-5">
                    <h4 style="color: rgb(255, 0, 0);">IDR 130,000</h4>
                    <span class="card-text fa fa-star" style="color: rgb(255, 0, 0);"></span>
                </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow">
            <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top" alt="...">
            <div class="card-body">
                <h4 class="card-title">Meiso Kelapa Gading</h4>
                <p class="card-text">Jakarta Utara</p>
                <div class="d-flex justify-content-between mt-5">
                    <h4 style="color: rgb(255, 0, 0);">IDR 130,000</h4>
                    <span class="card-text fa fa-star" style="color: rgb(255, 0, 0);"></span>
                </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow">
            <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top" alt="...">
            <div class="card-body">
                <h4 class="card-title">Meiso Kelapa Gading</h4>
                <p class="card-text">Jakarta Utara</p>
                <div class="d-flex justify-content-between mt-5">
                    <h4 style="color: rgb(255, 0, 0);">IDR 130,000</h4>
                    <span class="card-text fa fa-star" style="color: rgb(255, 0, 0);"></span>
                </div>
            </div>
          </div>
        </div>
      </div>
  </div>

</div>



<!--end::Container-->
@endsection
@push('add-style')
<style>
    body {
        background-size: 100% 80px !important;
    }

    .card-hostel:hover {
        border: 1px solid #D9214E;
        cursor: pointer;
    }
</style>
@endpush
@push('add-script')
<script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#card-filter").hide();
        $("#button-refilter").click(function() {
            $("#card-filter").toggle();
        })

        var today = new Date();

        new tempusDominus.TempusDominus(document.getElementById("js_datepicker_list_hotel"), {
            display: {
                viewMode: "calendar",
                components: {
                    date: true,
                    hours: false,
                    minutes: false,
                    seconds: false
                }
            },
            localization: {
                locale: "id",
                format: "dd-MM-yyyy",
            },
            restrictions: {
                minDate: today,
            },
        });
    })

</script>
@endpush
