<div id="kt_app_footer" class="app-footer">
    <!--begin::Footer container-->
    <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-semibold me-1">2023&copy;</span>
            <a href="#" target="_blank" class="text-gray-800 text-hover-primary">Travelsya Panel</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Menu-->
        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
            <li class="menu-item">
                <a href="#" target="_blank" class="menu-link px-2">About</a>
            </li>
            <li class="menu-item">
                <a href="#" target="_blank" class="menu-link px-2">Support</a>
            </li>
            <li class="menu-item">
                <a href="#" target="_blank" class="menu-link px-2">Purchase</a>
            </li>
        </ul>
        {{-- <select name="kecamatan" id="field-kecamatan" class="form-control">
            <option value="{{$kecamatan->id}}">{{$kecamatan->name}}</option>
            @endforeach
        </select> --}}

        <select name="tipe_caleg" id="field-wilayah-caleg" class="form-control">
            <option value="kecamatan">Kecamatan</option>
            <option value="kota">Provinsi</option>
        </select> --}}
        <!--end::Menu-->
    </div>
    <!--end::Footer container-->
</div>
<!--end::Footer-->

<script>
    function displayKecamatan()
    {
        var value = this.value;

        if(value == "kecamatan")
        {
            $('#field-kecamatan').addClass('d-none');
        }
        else{
            $('#field-kecamatan').removeClass('d-none');
        }
    }
</script>
