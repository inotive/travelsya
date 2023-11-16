@extends('admin.layout', ['title' => 'Daftar Bantuan', 'url' => ''])

@section('content-admin')
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
                                    <h4 class="fw-bold">Tambah Bantuan</h4>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Alert-->
                        </div>
                    </div>
                    <form id="kt_modal_new_target_form" action="{{ route('admin.help.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hidden" name="hotel_id" value="{{ $hotel->id }}"> --}}

                        <div class="col-12 ">
                            <label class="form-label">Kategori Bantuan</label>
                            <input type="text" name="categories" id="categories" class="form-control"
                                placeholder="Masukan Nama Kategori Bantuan" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Judul Bantuan</label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Masukan Judul Bantuan" required>
                        </div>



                        <div class="col-12 mt-2">
                            <!--begin::Alert-->
                            <div class="alert bg-light d-flex flex-column flex-sm-row p-3">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                    <!--begin::Title-->
                                    <h4 class="fw-bold">Isi Content Bantuan</h4>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Alert-->
                        </div>

                        <div id="kt_docs_quill_basic" >

                        </div>
                        <input type="hidden" name="content" id="hidden-content">
                        
                </div>
                <!--end:: Body-->
                <div class="card-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary w-50" id="kt_modal_new_target_submit">Simpan
                        Data</button>
                    <a href="{{ route('admin.help.index') }}"
                        class="btn btn-outline btn-outline btn-outline-secondary me-3 text-dark btn-active-light-secondary w-50">Back</a>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--CKEditor Build Bundles:: Only include the relevant bundles accordingly-->
    <script>
        var quill = new Quill('#kt_docs_quill_basic', {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
            placeholder: 'Masukkan konten',
            theme: 'snow' // or 'bubble'
        });
        quill.on('text-change', function() {
        var hiddenInput = document.getElementById('hidden-content');
        hiddenInput.value = quill.root.innerHTML;
    });
    </script>
@endsection
