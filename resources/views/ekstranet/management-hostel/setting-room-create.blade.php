@extends('ekstranet.layout', ['title' => 'Setting Hostel - ' . $hostel->name, 'url' => '#'])

@section('content-admin')
    <!--begin::Row-->
    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-12">
            <div class="card  mb-xl-8">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <div class="row">
                        <div class="col-12">
                            <!--begin::Alert-->
                            <div class="alert bg-light d-flex flex-column flex-sm-row p-3">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                    <!--begin::Title-->
                                    <h4 class="fw-bold">Room Information</h4>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Alert-->
                        </div>
                    </div>
                    <form id="kt_modal_new_target_form" action="{{ route('partner.management.hostel.setting.room.post') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="hostel_id" value="{{ $hostel->id }}">
                        <div class="row gy-5">
                            <div class="col-12">
                                <label class="form-label">Nama Properti</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Masukan Nama Properti" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Tarif Per Bulan</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="text" name="rentprice_monthly" id="rentprice_monthly" class="form-control"
                                        placeholder="Masukan Harga" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Tarif Per Bulan (Termasuk Pajak 25%)</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="text" name="sellingrentprice_monthly" id="sellingrentprice_monthly"
                                        class="form-control" placeholder="" readonly>
                                </div>
                            </div>
                            {{-- <input type="hidden" name="sellingrentprice_monthly" id="sellingprice_monthly_hidden"> --}}
                            <div class="col-6">
                                <label class="form-label">Tarif Per Tahun</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="text" name="rentprice_yearly" id="rentprice_yearly" class="form-control"
                                        placeholder="Masukan Harga" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Tarif Per Tahun (Termasuk Pajak 25%)</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="text" name="sellingrentprice_yearly" id="sellingrentprice_yearly"
                                        class="form-control" placeholder="" readonly>
                                </div>
                            </div>
                            {{-- <input type="hidden" name="sellingrentprice_yearly" id="sellingprice_yearly_hidden"> --}}

                            <div class="col-12">
                                <!--begin::Alert-->
                                <div class="alert bg-light d-flex flex-column flex-sm-row p-3">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column pe-0 pe-sm-10">
                                        <!--begin::Title-->
                                        <h4 class="fw-bold">Spesifikasi Properti</h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Alert-->
                            </div>

                            {{-- <div class="col-12">
                                <!--begin::Alert-->
                                <!--begin::Heading-->
                                <div class="mb-3">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-5 fw-semibold">
                                        <span class="required">Tipe Properti</span>

                                        <span class="m2-1" data-bs-toggle="tooltip"
                                            title="Your billing numbers will be calculated based on your API method">
                                            <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span></i>
                                        </span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Heading-->

                                <!--begin::Radio group-->
                                <div class="btn-group w-100 mb-5" data-kt-buttons="true"
                                    data-kt-buttons-target="[data-kt-button]">
                                    <!--begin::Radio-->
                                    <label class="btn btn-outline btn-color-muted btn-active-success" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="property_type" value="Apartemen" />
                                        <!--end::Input-->
                                        Apartemen
                                    </label>
                                    <!--end::Radio-->

                                    <!--begin::Radio-->
                                    <label class="btn btn-outline btn-color-muted btn-active-success active"
                                        data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="property_type" checked="checked"
                                            value="Villa" />
                                        <!--end::Input-->
                                        Villa
                                    </label>
                                    <!--end::Radio-->

                                    <!--begin::Radio-->
                                    <label class="btn btn-outline btn-color-muted btn-active-success" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="property_type" value="Residance" />
                                        <!--end::Input-->
                                        Residence
                                    </label>
                                    <!--end::Radio-->

                                    <!--begin::Radio-->
                                    <label class="btn btn-outline btn-color-muted btn-active-success" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="property_type" value="Rumah" />
                                        <!--end::Input-->
                                        Rumah
                                    </label>
                                    <!--end::Radio-->
                                </div>
                                <!--end::Radio group-->
                                <!--end::Alert-->
                            </div> --}}
                            <div class="col-4">
                                <label class="form-label">Jumlah Kamar</label>
                                <div class="input-group">
                                    <input type="number" name="totalroom" id="totalroom" class="form-control"
                                        placeholder="Masukan Jumlah Kamar">
                                    <span class="input-group-text">Kamar</span>
                                </div>

                            </div>
                            <div class="col-4">
                                <label class="form-label">Jumlah Kamar Mandi</label>
                                <div class="input-group">
                                    <input type="number" name="totalbathroom" id="totalbathroom" class="form-control"
                                        placeholder="Masukan Jumlah Kamar Mandi">
                                    <span class="input-group-text">Kamar Mandi</span>

                                </div>
                            </div>
                            <div class="col-4 mb-6">
                                <label class="form-label">Luas Properti</label>
                                <input type="text" name="roomsize" id="roomsize" class="form-control"
                                    placeholder="Masukan ukuran luas properti dalam bentuk m2 (pxl)">
                            </div>
                            <div class="col-12">
                                <!--begin::Alert-->
                                <div class="alert bg-light d-flex flex-column flex-sm-row p-3">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column pe-0 pe-sm-10">
                                        <!--begin::Title-->
                                        <h4 class="fw-bold">Room Occupancy Policyze</h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Alert-->
                            </div>
                            <div class="col-6">
                                <label class="form-label">Maksimal Penghuni Kamar</label>
                                <input type="text" name="guest" id="guest" class="form-control"
                                    placeholder="Masukan Maximal Jumlah Tamu Yang Bisa Menginap" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Apakah Tersedia Extra Bed pada Kamar Ini?</label>
                                <!--begin::Radio group-->
                                <div class="btn-group w-100" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                                    <!--begin::Radio-->
                                    <label class="btn btn-outline btn-color-muted btn-active-success active" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="method" value="ya" id="extrabedYaCheckbox"/>
                                        <!--end::Input-->
                                        Ya, ada
                                    </label>
                                    <!--end::Radio-->

                                    <!--begin::Radio-->
                                    <label class="btn btn-outline btn-color-muted btn-active-success" data-kt-button="false">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="method" checked="checked" value="tidak" id="extrabedTidakCheckbox"/>
                                        <!--end::Input-->                                        Tidak Ada
                                    </label>
                                    <!--end::Radio-->
                                </div>
                            </div>
                            <div class="col-4 extrabedWidget">
                                <label class="form-label">Maksimal Extra Bed</label>
                                <input type="number" name="maxextrabed" id="maxextrabed" class="form-control"
                                       placeholder="Masukkan Maksimal Extra Bed">
                            </div>

                            <div class="col-4 extrabedWidget">
                                <label class="form-label">Biaya Extra Bed</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="number" name="extrabedprice" id="extrabedprice" class="form-control"
                                        placeholder="Masukan Biaya Extra Bed">
                                </div>
                            </div>
                            <div class="col-4 extrabedWidget">
                                <label class="form-label">Extra Selling Charge</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="number" name="extrabedsellingprice" id="extrabedsellingprice" class="form-control"
                                           placeholder="Masukan Biaya Extra Bed" disabled readonly>
                                </div>
                            </div>
                            <div class="col-12">
                                <!--begin::Alert-->
                                <div class="alert bg-light d-flex flex-column flex-sm-row p-3">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column pe-0 pe-sm-10">
                                        <!--begin::Title-->
                                        <h4 class="fw-bold">Gambar pada ruangan</h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Alert-->
                            </div>
                            <div class="row-6">
                                {{-- <label class="form-label">Image</label> --}}
                                {{-- <input type="file" name="image_1" id="image_1" class="form-control"> --}}
                                <!--begin::Image input-->
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="image-input image-input-outline m-5" data-kt-image-input="true">
                                        <!--begin::Image preview wrapper-->
                                        <div class="image-input-wrapper w-125px h-125px"></div>
                                        <!--end::Image preview wrapper-->

                                        <!--begin::Edit button-->
                                        <label
                                            class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                            data-bs-dismiss="click" title="Change image">
                                            <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span
                                                    class="path2"></span></i>

                                            <!--begin::Inputs-->
                                            <input type="file" name="hostel_room_image[]" accept=".png, .jpg, .jpeg"
                                                multiple />
                                            <input type="hidden" name="image_remove" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Edit button-->

                                        <!--begin::Cancel button-->
                                        <span
                                            class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                            data-bs-dismiss="click" title="Cancel image">
                                            <i class="ki-outline ki-cross fs-3"></i>
                                        </span>
                                        <!--end::Cancel button-->
                                        <!--begin::Remove button-->
                                        <span
                                            class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                            data-bs-dismiss="click" title="Remove image">
                                            <i class="ki-outline ki-cross fs-3"></i>
                                        </span>
                                        <!--end::Remove button-->
                                    </div>
                                @endfor
                                <div class="col-12">
                                    <!--begin::Alert-->
                                    <div class="alert bg-light d-flex flex-column flex-sm-row p-3">
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-column pe-0 pe-sm-10">
                                            <!--begin::Title-->
                                            <h4 class="fw-bold">Fasilitas Kamar</h4>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Alert-->
                                </div>
                                {{-- <div class="col-6 d-flex justify-content-around">
                                @foreach ($facility as $item)
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="checkbox" name="facility_id[]"
                                            value="{{ $item->id }}" />
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $item->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div> --}}

                                <table class="table table-rounded table-bordered border gy-7 gs-7"
                                    id="kt_datatable_zero_configuration_1" style="border: 1px solid rgb(112, 112, 112);">
                                    <thead>
                                        <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200 ">
                                            <th class="text-center"></th>
                                            <th class="text-center">Nama Fasilitas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($facility as $item)
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-lg">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="facility_id[]" value="{{ $item->id }}"
                                                            id="facility{{ $item->id }}">
                                                    </div>
                                                </td>
                                                <td>{{ $item->name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                </div>
                <!--end:: Body-->
                <div class="card-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary w-50" id="kt_modal_new_target_submit">Simpan
                        Data</button>
                    {{-- <a href="{{route('partner.management.hostel.setting.room', ['id'=>$hostel->id])}}"
                    class="btn btn-outline btn-outline btn-outline-secondary me-3 text-dark btn-active-light-secondary w-50">Back</a> --}}
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('add-script')
    <script>
        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "." + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }

        function addCommas(nStr) {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + '.' + '$2');
            }
            return x1 + x2;
        }

        $("#rentprice_monthly").keyup(function() {
            var el = $(this);
            el.val(formatRupiah(el.val()))

            var basePrice = parseInt(el.val().split('.').join(""));
            var sellingprice = basePrice + (basePrice * 15 / 100);
            $('#sellingrentprice_monthly').val(addCommas(sellingprice));

            $('#sellingrentprice_monthly_hidden').val(sellingprice);
        })

        $("#rentprice_yearly").keyup(function() {
            var el = $(this);
            el.val(formatRupiah(el.val()))

            var basePrice = parseInt(el.val().split('.').join(""));
            var sellingprice = basePrice + (basePrice * 15 / 100);
            $('#sellingrentprice_yearly').val(addCommas(sellingprice));

            $('#sellingrentprice_yearly_hidden').val(sellingprice);
        })

        $("#extrabedprice").keyup(function () {
                var el = $(this);
                el.val(formatRupiah(el.val()))

                var basePrice = parseInt(el.val().split('.').join(""));
                var sellingPrice = basePrice + (basePrice * 15 / 100);
                $('#extrabedsellingprice').val(addCommas(sellingPrice));
            })

        const extrabedYaCheckbox = document.getElementById('extrabedYaCheckbox');
        const extrabedTidakCheckbox = document.getElementById('extrabedTidakCheckbox');
        const extrabedWidget = document.getElementsByClassName('extrabedWidget');

        extrabedYaCheckbox.addEventListener('change', toggleWidget);
        extrabedTidakCheckbox.addEventListener('change', toggleWidget);

        function toggleWidget() {
            if (extrabedYaCheckbox.checked) {
                $('.extrabedWidget').removeClass('d-none');
                // extrabedWidget.style.display = 'block'; // Jika checkbox 'Ya' diceklis, tampilkan widget
            } else if (extrabedTidakCheckbox.checked) {
                $('.extrabedWidget').addClass('d-none');
                // extrabedWidget.style.display = 'none'; // Jika checkbox 'Tidak' diceklis, sembunyikan widget
            }
        }

        $(document).ready(function() {
            $('#kt_datatable_zero_configuration_1').DataTable({
                "scrollY": "500px",
                "scrollCollapse": true,
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom": "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">"
            });
        });
    </script>
@endpush
