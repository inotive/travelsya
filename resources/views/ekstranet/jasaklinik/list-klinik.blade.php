@extends('ekstranet.layout', ['title' => 'Daftar Jasa Kecantikan', 'url' => ''])

@section('content-admin')
    <!--begin::Tables Widget 11-->

    <a class="btn btn-sm btn-primary mb-3" href="{{ route('clinics.create') }}">
        <i class="ki-duotone ki-plus fs-2"></i> Tambah Jasa Kecantikan
    </a>
    

    <div class="card mb-5 mb-xl-8">
        
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table id="clinicTable" class="table-row-dashed fs-6 gy-5 table-bordered table align-middle">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800">
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama Bisnis</th>
                            <th class="text-center">Nama Jasa</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Durasi</th>
                            <th class="text-center">Biaya</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($clinics as $clinic)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td class="text-center">{{ $clinic->clinic->clinic_name ?? 'Nama Bisnis tidak ditemukan' }}</td>
                              <td class="text-center">{{ $clinic->name }}</td>
                              <td class="text-center">{{ $clinic->categoriesService->name ?? 'Kategori tidak ditemukan' }}</td>
                              <td class="text-center">{{ $clinic->duration }}</td>
                              <td class="text-center">{{ 'Rp '.number_format($clinic->price) }}</td>
                              <td class="text-center">
                                @if ($clinic->is_active === 1)
                                    <span class="badge badge-success">Aktif</span>
                                @elseif ($clinic->is_active === 0)
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                @endif
                              </td>
                              <td>
                                <button class="btn btn-sm btn-light-primary btn-icon" data-bs-toggle="modal" data-bs-target="#detailModal" onclick="showDetail({{ $clinic->id }})">
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                </button>
                                <button class="btn btn-sm btn-light-warning btn-icon">
                                    <a href="{{ route('clinics.edit', $clinic->id) }}">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                </button>
                                <button class="btn btn-sm btn-light-danger btn-icon" onclick="deleteClinic({{ $clinic->id }})">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </td>
                          </tr>
                          <div class="modal fade" id="kt_modal_delete_customer{{ $clinic->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                <div class="modal-content">
                                    <form action="{{ route('clinics.destroy', $clinic->id) }}" method="POST" id="kt_modal_delete_customer_form_{{ $clinic->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                            <h2 class="fw-bold">DELETE KLINIK</h2>
                                            <button type="button" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                                <i class="ki-duotone ki-cross fs-1"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body py-10 px-lg-17">
                                            <p>Anda yakin ingin menghapus klinik dengan nama <strong>{{ $clinic->name }}</strong>?</p>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                          </div>
                      @endforeach
                    </tbody>
                </table>
            </div>
            <!--end::Table container-->
            <div class="d-flex justify-content-center mt-4">
                {{ $clinics->links() }}
            </div>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Tables Widget 11-->

        {{-- Modal Detail --}}
    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content rounded">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span><span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <h5 class="text-center" id="modal-title">Detail Jasa Kecantikan</h5>
                    <div id="package-details">Loading...</div>
                </div>
            </div>
        </div>
    </div>
    

    @push('add-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

    <script>
        // DataTable
    $(document).ready(function() {
        $('#clinicTable').DataTable({
            "scrollY": "500px",
            "scrollCollapse": true,
            "language": {
                "lengthMenu": "MENU",
            },
            "dom": "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-content-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +
                "<'table-responsive'tr>" +
                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">"
            });

        // Attach event listener to modal
        $('#detailModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var clinicId = button.data('clinic-id');
            showDetail(clinicId);
        });
    });

    function showDetail(id) {
        console.log('Fetching details for clinic ID:', id);
        $.ajax({
            url: 'clinics/' + id,
            type: 'GET',
            success: function(response) {
                console.log('Received response:', response);
                if(response && response.name) {
                    $('#modal-title').text('Detail Jasa Kecantikan: ' + response.name);
                    $('#package-details').html(`
                        <p><strong>Bisnis:</strong> ${response.clinic_name || 'Tidak tersedia'}</p>
                        <p><strong>Nama Jasa:</strong> ${response.name || 'Tidak tersedia'}</p>
                        <p><strong>Kategori:</strong> ${response.category_name || 'Tidak tersedia'}</p>
                        <p><strong>Durasi:</strong> ${response.duration || 'Tidak tersedia'} ${response.duration_type || ''}</p>
                        <p><strong>Kadaluarsa Dalam (Hari):</strong> ${response.expiry_date || 'Tidak tersedia'}</p>
                        <p><strong>Harga:</strong> ${response.price ? 'Rp ' + number_format(response.price) : 'Tidak tersedia'}</p>
                        <p><strong>Deskripsi:</strong> ${response.description || 'Tidak tersedia'}</p>
                        <p><strong>Peraturan:</strong> ${response.rules || 'Tidak tersedia'}</p>
                        <p><strong>Status:</strong> ${response.is_active == 1 ? 'Aktif' : 'Tidak Aktif'}</p>
                    `);
                } else {
                    $('#package-details').html('<p>Data tidak ditemukan atau tidak lengkap.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
                $('#package-details').html('<p>Loading..</p>');
            }
        });
    }

    function number_format(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }

    // Update the onclick handler in the table
    function updateDetailButtons() {
        $('button[data-bs-target="#detailModal"]').each(function() {
            var clinicId = $(this).closest('tr').find('td:first').text();
            $(this).attr('data-clinic-id', clinicId);
        });
    }

    // Call this function after the table is initialized or updated
    updateDetailButtons();
    </script>
    @endpush
    
    @push('add-script')
    <script>
        console.log('Session success message:', "{{ session('success') }}");
        @if(session('success'))
            console.log('Success message exists in session');
        @else
            console.log('No success message in session');
        @endif
    </script>
    @endpush
    
@endsection