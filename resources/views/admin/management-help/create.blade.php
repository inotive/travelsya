@extends('admin.layout', ['title' => 'Daftar Bantuan', 'url' => ''])
@push('add-style')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush
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
                        <div class="row gy-5">
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
                            <div class="col-12">
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
                        </div>

                        <div id="quill-container">
                        </div>
                        <div>

                                @if (Auth::user()->role->journals_edit == 1 || Auth::user()->role->journals_delete == 1 || Auth::user()->role->journals_mark == 1)
                                    @if (Auth::user()->role->journals_edit == 1)
                                        @if($item->verify_at == null)
                                            <button type="button" class="btn btn-primary btn-xs" value="{{ $item->id }}" id="editButton" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-edit"></i>
                                            </button>
                                        @endif
                                    @endif

                                    @if (Auth::user()->role->journals_delete == 1)
                                            @if($item->verify_at == null)
                                        <button type="button" class="btn btn-danger btn-xs" value="{{ $item->id }}" id="deleteButton" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash"></i></button>
                                            @endif
                                    @endif

                                    @if (Auth::user()->role->journals_mark == 1)
                                            @if($item->verify_at == null)
                                        <a href="/journal/journal/{{ $item->id }}/tandai" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="bottom" title="Tandai No"><i class="fa fa-pen" style="color:black"></i></a>
                                            @endif
                                    @endif
                                @endif
                        </div>

                        <!--end:: Body-->
                        <div class="card-footer d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary w-50" id="kt_modal_new_target_submit">Simpan
                                Data
                            </button>
                            <a href="{{ route('admin.help.index') }}"
                               class="btn btn-outline btn-outline btn-outline-secondary me-3 text-dark btn-active-light-secondary w-50">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--CKEditor Build Bundles:: Only include the relevant bundles accordingly-->
    </div>
@endsection

@push('add-script')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        $(document).ready(function() {
            var myToolbar= [
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],

                [{ 'color': [] }, { 'background': [] }],
                [{ 'font': [] }],
                [{ 'align': [] }],

                ['clean'],
                ['image'] //add image here
            ];
            var quill = new Quill('#quill-container', {
                theme: 'snow',
                placeholder: 'Masukan konten',
                modules: {
                    toolbar: {
                        container: myToolbar,
                        // handlers: {
                        //     image: imageHandler
                        // }
                    }
                },
            });


            // function imageHandler() {
            //     var range = this.quill.getSelection();
            //     var value = prompt('please copy paste the image url here.');
            //     if(value){
            //         this.quill.insertEmbed(range.index, 'image', value, Quill.sources.USER);
            //     }
            // }
        });
    </script>
@endpush
