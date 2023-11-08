@extends('layouts.user')

@section('content-user')

{{-- Containre --}}
<div class="container">
    {{-- Row --}}
    <div class="row">
        {{-- Kolom Kiri (Menu)--}}
        @include('user.user-navigation')
        {{-- End Kolom Kiri --}}

        {{-- Kolom Kanan (Form Edit Profile) --}}
        <div class="col-12 col-lg-7">
            <div class="card">
                {{-- Card Head --}}
                <div class="card-header">
                    <div class="card-title">
                        <h1>
                            <b>
                                Profil Saya
                            </b>
                        </h1>
                    </div>
                </div>
                {{-- Card Body --}}
                <div class="card-body">
                    {{-- Row --}}
                    <div class="row">
                        {{-- kolom batas form --}}
                        <form class="col-12" method="post" action="{{ route('user.profile.update') }}">
                            @csrf @method('PUT')
                            <h3>
                                <b>
                                    Data Pemilik Akun
                                </b>
                            </h3>
                            {{-- <div class="mb-10 mt-5 d-flex">
                                <div class="form-check form-check form-check-danger form-check-solid me-5">
                                    <input type="radio" class="form-check-input h-20px w-20px" name="radio" value=""
                                        id="flexCheckboxSm" />
                                    <label class="form-check-label" for="flexCheckboxSm">
                                        Tuan
                                    </label>
                                </div>
                                <div class="form-check form-check form-check-danger form-check-solid me-5">
                                    <input type="radio" class="form-check-input h-20px w-20px" name="radio2" value=""
                                        id="flexCheckboxSm2" />
                                    <label class="form-check-label" for="flexCheckboxSm2">
                                        Nyonya
                                    </label>
                                </div>
                                <div class="form-check form-check form-check-danger form-check-solid me-5">
                                    <input type="radio" class="form-check-input h-20px w-20px" name="radio3" value=""
                                        id="flexCheckboxSm3" />
                                    <label class="form-check-label" for="flexCheckboxSm3">
                                        Nona
                                    </label>
                                </div>
                            </div> --}}
                            <!--begin::Input group-->
                            {{-- <div class="mb-5">
                                <label class="form-label">
                                    Username
                                </label>
                                <input type="text" class="form-control" />
                                <div class="form-text fs-8">Seperti di KTP/SIM/Paspor</div>
                            </div>
                            <div class="form-text fs-6">Tanggal Lahir</div>
                            <div class="input-group mb-10">
                                <input type="date" class="form-control" aria-describedby="basic-addon2" />
                            </div> --}}
                            <!--end::Input group-->
                            {{-- <h3>
                                <b>
                                    Info Kontak
                                </b>
                            </h3> --}}
                            <div class="form-text fs-6 mt-5">Nomor Handphone</div>
                            <div class="input-group mb-5">
                                <input type="text" class="form-control" name="phone" value="{{ auth()->user()->phone }}"
                                    required />
                            </div>

                            <div class="form-text fs-6">Email</div>
                            <div class="input-group mb-10">
                                <input type="text" class="form-control" name="email" value="{{ auth()->user()->email }}"
                                    required />
                            </div>
                            <h3>
                                <b>
                                    {{-- Info Identitas --}}
                                    Keamanan
                                </b>
                            </h3>
                            {{-- <div class="form-text mt-5 fs-6">Detail Kewarganegaraan</div> --}}
                            {{-- <div class="input-group mb-5">
                                <input type="text" class="form-control" />
                            </div> --}}
                            <div class="form-text fs-6">Password Baru</div>
                            <div class="input-group">
                                <input type="password" class="form-control" name="new_password" placeholder="*****" />
                            </div>
                            <div class="form-text mb-10 fs-8 text-danger">
                                Kosongkan jika tidak ingin mengubah password Anda.
                            </div>
                            {{-- <div class="form-text mb-10 fs-8">Werga Negara Asing (WNA) boleh memasukkan nomor izin
                                tinggal atau nomor paspor</div> --}}
                            {{-- <h3>
                                <b>
                                    Info Paspor
                                </b>
                            </h3>
                            <div class="form-text mt-5 fs-6">Email</div>
                            <div class="input-group mb-5">
                                <input type="email" class="form-control" />
                            </div>
                            <div class="form-text fs-6">Tanggal Penerbitan</div>
                            <div class="input-group mb-5">
                                <input type="date" class="form-control" />
                            </div>
                            <div class="form-text fs-6">Tanggal Kadaluwarsa</div>
                            <div class="input-group">
                                <input type="date" class="form-control" />
                            </div>
                            <div class="form-text fs-8 mb-10">Berlaku setidaknya 6 bulan dari tanggal kepergian</div>
                            <h3>
                                <b>
                                    Kontak Darurat
                                </b>
                            </h3>
                            <div class="input-group mb-5 mt-5">
                                <input type="text" class="form-control" placeholder="Nama" />
                            </div>
                            <div class="form-text fs-6">Nomor Handphone</div>
                            <div class="input-group mb-10">
                                <input type="text" class="form-control" />
                            </div> --}}
                            <button type="submit" class="btn btn-danger px-16">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Kolom Kanan --}}
        @include('user.logout')
    </div>
    {{-- End Row --}}
</div>
{{-- End Container --}}

@endsection
