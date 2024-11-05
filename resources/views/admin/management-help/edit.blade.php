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
                                    <h4 class="fw-bold">Edit Bantuan</h4>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Alert-->
                        </div>
                    </div>
                    <form id="kt_modal_new_target_form" action="{{ route('admin.help.update', ['help' => $help->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-12 ">
                            <label class="form-label">Kategori Bantuan</label>
                            <input type="text" name="categories" id="categories" class="form-control"
                                placeholder="Masukan Nama Kategori Bantuan"
                                value="{{ old('categories', $help->categories) }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Judul Bantuan</label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Masukan Judul Bantuan" value="{{ old('title', $help->title) }}" required>
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

                        <div id="kt_docs_quill_basic">
                            {!! $help->content !!}
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
@endsection

@push('add-script')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    var myToolbar = [
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],
        [{ 'color': [] }, { 'background': [] }],
        [{ 'font': [] }],
        [{ 'align': [] }],
        ['clean'],
        ['image']
    ];

    var quill = new Quill('#kt_docs_quill_basic', {
        modules: {
            toolbar: {
                container: myToolbar,
            }
        },
        placeholder: 'Masukkan konten',
        theme: 'snow'
    });

    quill.on('text-change', function() {
        var hiddenInput = document.getElementById('hidden-content');
        hiddenInput.value = quill.root.innerHTML;
    });

    // // Set konten dari textarea ke dalam Quill
    // var hiddenInput = document.getElementById('hidden-content');
    // quill.clipboard.dangerouslyPasteHTML(hiddenInput.value);
</script>

@endpush

