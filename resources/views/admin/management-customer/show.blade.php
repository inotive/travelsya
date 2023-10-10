<div class="modal fade" id="history" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-1000px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
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
                {{-- <form id="kt_modal_new_target_form" class="form" action="#"> --}}
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3">
                        History Transaksi - Pelanggan <span class="fw-bold nama-customer"></span>
                    </h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    {{-- <div class="text-muted fw-semibold fs-5">If you need more info, please check
                            <a href="#" class="fw-bold link-primary">Project Guidelines</a>.
                        </div> --}}
                    <!--end::Description-->
                </div>
                <!--end::Heading-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-bordered gs-0 gy-4 text-center" id="kt_datatable_zero_configuration">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bold text-muted bg-l  ight">
                                    {{-- <th class="ps-4 rounded-start">No</th> --}}
                                    <th class="min-w-125px">Tanggal</th>
                                    <th class="min-w-125px">Invoice</th>
                                    <th class="min-w-50px">Layanan</th>
                                    <th class="min-w-125px">Deskripsi</th>
                                    <th class="min-w-125px">Metode</th>
                                    <th class="min-w-125px">Grand</th>
                                    <th class="min-w-70px">Point</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            <tbody class="fw-semibold text-gray-600" id="dataTbody">
                                {{-- @foreach ($customers as $customer) --}}
                                {{-- <tr>
                                        <td>
                                            <div class="text-dark fw-bold  mb-1 fs-6">12 A 123</div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold  d-block mb-1 fs-6">INV-20230622-HOSTEL-1687467039</div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold  d-block mb-1 fs-6">Pulsa</div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold  d-block mb-1 fs-6">Custom</div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold  d-block mb-1 fs-6">HOTEL GRAND - SAS</div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold  d-block mb-1 fs-6">Bank</div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold  d-block mb-1 fs-6">Rp</div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold  d-block mb-1 fs-6">25 Point</div>
                                        </td>
                                    </tr> --}}
                                {{-- @endforeach --}}

                            </tbody>
                            <!--end::Table body-->
                        </table>
                        {{-- {{$customers->appends(request()->input())->links('vendor.pagination.bootstrap-5')}} --}}
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--begin::Input group-->
                <!--end::Actions-->
                {{-- </form> --}}
                <!--end:Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<script>
    function showDetailTransactions(customerId) {
    $.ajax({
        url: 'customer/show', 
        method: 'GET',
        data: { customerId: customerId },
        success: function(response) {
            
            // Fill Table Body
            var tableBody = $('#dataTbody');
            var data = response;
            tableBody.empty();

            for (var i = 0; i < data.length; i++) {
                $('.nama-customer').text(data[i].user)

                var created_at = formatDate(data[i].created_at);
                var row = '<tr>' +
                    '<td>' + created_at + '</td>' +
                    '<td>' + data[i].no_inv + '</td>' +
                    '<td>' + (data[i].service_name ? data[i].service_name.charAt(0).toUpperCase() + data[i].service_name.slice(1) : '-') + '</td>' +
                    '<td>' + data[i].transaction_name + ' - ' + data[i].transaction_desc + '</td>' +
                    '<td>' + (data[i].payment_method ? data[i].payment_method.replace(/_/g, ' ') : '-') + '</td>' +
                    '<td>' + (data[i].transaction_price ? 'Rp ' + data[i].transaction_price.toLocaleString('id-ID') : '-') + '</td>' +
                    '<td>' + data[i].point + '</td>' +
                    '</tr>';

                tableBody.append(row);


            }

            // Inisialisasi DataTable
                // $('#kt_datatable_zero_configuration').DataTable({
                //     "scrollY": "500px",
                //     "scrollCollapse": true,
                //     "language": {
                //         "lengthMenu": "Show _MENU_",
                //     },
                //     "dom": "<'row'" +
                //         "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                //         "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                //         ">" +

                //         "<'table-responsive'tr>" +

                //         "<'row'" +
                //         "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                //         "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                //         ">"
                // });
        }
    });
}

    function formatDate(dateString) {
        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        return new Date(dateString).toLocaleDateString(undefined, options);
    }

</script>
