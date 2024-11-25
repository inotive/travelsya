@extends('layouts.web')
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

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>


<div class="card border-transparent header-image" data-bs-theme="light" style=""
    x-bind:style="`background:linear-gradient(to right, rgba(44, 4, 4, 0.73), rgba(245, 246, 252, 0.52)), url(${$store.menubar.selected.imageHeader}) no-repeat center`">
    <div class="card-body d-flex ps-xl-20">
        <div class="m-0">
            <div class="position-relative fs-2x z-index-2 fw-bold text-white mb-2">
                <button
                    class="btn btn-icon btn-rounded btn-color-white bg-white bg-opacity-15 bg-hover-opacity-25 fw-semibold mb-5"
                    onclick="history.back();">
                    <i class="las la-angle-left"></i>
                </button>
                <div>
                    <span class="me-2">Rekreasi</span>
                    <br /><span class="fs-3 text-gray-300 me-2">Cari aktivitas dan atraksi menyenangkan!</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-xl mt-10 mb-30">
    <div class="content d-flex flex-column flex-column-fluid">
        <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-sm">
            <div class="content flex-row-fluid mb-10" id="kt_content">

                <h2>Apa yang ingin anda lakukan?</h2>
                <div class="d-flex gap-3 flex-wrap mt-4 align-items-center">
                    @foreach ($type_list as $tl)
                        <div class="filter-btn {{ $tl == $type ? 'active' : '' }}" data-filter="{{ $tl }}">
                            {{ $tl }}</div>
                    @endforeach
                    <input type="text" id="keyword" class="form-control form-control-lg ms-auto" name="keyword"
                        placeholder="Cari Tempat" value="" style="max-width: 300px;" />
                </div>

                <div id="results" class="mt-4">
                    <h5 class="mt-10">Menampilkan {{ $recreation_list->count() }} hasil pencarian {{ $type }}
                    </h5>
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        @foreach ($recreation_list as $list)
                            @if (count($list->recreationPackages) > 0)
                                <div class="col">
                                    <a href="{{ route('recreations.details', [$list['id']]) }}">
                                        <div class="card shadow h-100">
                                            <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                                class="card-img-top" alt="...">
                                            <div class="card-body d-flex flex-column">
                                                <h4 class="card-title text-capitalize">{{ $list->business_name }}</h4>
                                                <p class="card-text flex-grow-1 text-capitalize">
                                                    {{ $list->kota->city_name ?? 'Deleted city' }}
                                                </p>
                                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                                    <h4 style="color: rgb(255, 0, 0);">
                                                        Rp.{{ number_format($list['recreationPackages'][0]->price ?? 0) }}

                                                        @if (count($list['recreationPackages']) > 1)
                                                            -
                                                            {{ number_format($list['recreationPackages'][count($list['recreationPackages']) - 1]->price ?? 0) }}
                                                        @endif
                                                    </h4>
                                                    <span class="card-text" style="color: rgb(255, 0, 0);">
                                                        <i class="fa fa-star"></i>&nbsp;(5)
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

@push('add-style')
    <style>
        body {
            background-size: 100% 80px !important;
        }

        .card-hostel:hover {
            border: 1px solid #D9214E;
            cursor: pointer;
        }

        .item-menubar {
            cursor: pointer;
        }

        .child-item-menubar {
            display: flex;
            background: url("./assets/media/bg-icon-menubar.png") no-repeat center center;
            background-size: 72px 72px;
            -webkit-box-pack: center;
            justify-content: center;
            align-items: center;
            width: 72px;
            height: 72px;
            margin: 0 auto;
        }

        .item-label {
            flex: 1;
            align-self: center;
            white-space: pre-wrap;
            word-break: keep-all;
            word-wrap: break-word;
            text-overflow: ellipsis;
            overflow: hidden;
            width: 100%;
            text-align: left;
            margin-left: 1.2em;
        }

        .header-image {
            border-radius: 0px;
            background: linear-gradient(to right, rgba(44, 4, 4, 0.73), rgba(245, 246, 252, 0.52)),
                url("https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2532&q=80") no-repeat center center;
            background-size: cover;
            /* border-bottom-left-radius: 4em;
            border-bottom-right-radius: 4em; */
        }

        @media (max-width: 767px) {
            .item-label {
                margin-left: 0px;
                text-align: center;
            }
        }
    </style>
@endpush
@push('add-script')
    <script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#card-filter").hide();
            $("#button-refilter").click(function() {
                $("#card-filter").toggle();
            })

            var today = new Date();
        })

        // filter
        $(document).ready(function() {
            $('.filter-btn').click(function() {
                $('.filter-btn').removeClass('active');
                $(this).addClass('active');
                filterResults();
            });

            $('#keyword').on('input', function() {
                filterResults();
            });

            function filterResults() {
                let filter = $('.filter-btn.active').data('filter');
                let keyword = $('#keyword').val();

                $.ajax({
                    url: '/recreations/filter', // Pastikan URL ini benar
                    method: 'GET',
                    data: {
                        filter: filter,
                        keyword: keyword
                    },
                    success: function(response) {
                        console.log('respon', response);

                        $('#results').html(
                        response); // Pastikan elemen dengan ID 'results' ada di halaman
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                    }
                });
            }
        });
    </script>
@endpush
