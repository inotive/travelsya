@extends('layouts.user')

@section('content-user')

{{-- Containre --}}
<div class="container">
    {{-- Row --}}
    <div class="row">
        {{-- Kolom Kiri (Menu)--}}
        <div class="col-12 col-lg-3 offset-lg-1 mb-10">
            <div class="card">
                {{-- Card Bagian Body --}}
                <div class="card-body">
                    {{-- Nama User --}}
                    <div class="card-title mb-5">
                        <h3>
                            <b>
                                John Doe
                            </b>
                        </h3>
                    </div>
                    {{-- end Nama User --}}

                    {{-- Menu Item Start --}}

                    {{-- Bagian Poin --}}
                    <div class="group-point-ini-guys d-flex">
                        <div class="menu-item">
                            <div class="menu-link">
                                <span class="menu-icon">
                                    <img src="{{ asset('assets/media/svg/profile-account/coin.svg') }}"
                                        class="h-24px me-10" />
                                </span>

                                <div class="ini-pemersatu">
                                    <div class="text-gray-500 fs-8">Points Anda</div>
                                    <span class=" fw-medium fs-4 menu-title">
                                        <b>
                                            {{ number_format(auth()->user()->point, 0,',','.') }}
                                        </b>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Bagian Poin --}}

                    {{-- Start Bagian e-Wallet --}}
                    <div class="group-wallet-ini-guys d-flex">
                        <div class="menu-item">
                            <div class="menu-link">
                                <span class="menu-icon">
                                    <img src="{{ asset('assets/media/svg/profile-account/wallet.svg') }}"
                                        class="h-24px me-10" />
                                </span>
                                <div class="ini-pemersatu">
                                    <div class="text-gray-500 fs-8">e-Wallet</div>
                                    <span class=" fw-medium fs-4 menu-title">
                                        <b>
                                            56.500
                                        </b>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Separator --}}
                    <div class="separator mb-3 border"></div>

                    {{-- Menu Item Profil Saya --}}
                    <div class="menu-item">
                        <a class="menu-link text-gray" href="{{ route('user.profile') }}">
                            <span class="menu-icon">
                                <img src="{{ asset('assets/media/svg/profile-account/user.svg') }}"
                                    class="h-24px me-10" />
                            </span>
                            <span class="menu-title fw-bold text-danger">
                                <b>Profil Saya</b>
                            </span>
                        </a>
                    </div>

                    {{-- Menu Item Riwayat Pesanan --}}
                    <div class="menu-item">
                        <a class="menu-link text-gray-900" href="{{ route('user.orderHistory') }}">
                            <span class="menu-icon">
                                <img src="{{ asset('assets/media/svg/profile-account/clipboard.svg') }}"
                                    class="h-24px me-10" />
                            </span>
                            <span class="menu-title">
                                Riwayat Pesanan</b>
                            </span>
                    </div>
                    </a>
                    {{-- Menu Item --}}
                    <div class="menu-item">
                        <a class="menu-link text-gray-900" href="#">
                            <span class="menu-icon">
                                <img src="{{ asset('assets/media/svg/profile-account/credit-card.svg') }}"
                                    class="h-24px me-10" />
                            </span>
                            <span class="menu-title">
                                Refund & Pembatalan
                            </span>
                        </a>
                    </div>
                    {{-- Menu Item Pusat Bantuan --}}
                    <div class="menu-item">
                        <a class="menu-link text-gray-900" href="{{ route('user.help')}}">
                            <span class="menu-icon">
                                <img src="{{ asset('assets/media/svg/profile-account/headphones.svg') }}"
                                    class="h-24px me-10" />
                            </span>
                            <span class="menu-title">
                                Pusat Bantuan
                            </span>
                        </a>
                    </div>
                    {{-- SEPARATOR --}}
                    <div class="separator my-3 border"></div>
                    {{-- Menu ITEm Logout --}}
                    <div class="menu-item">
                        <a class="menu-link text-gray-900" id="kt_docs_sweetalert_basic" href="#">
                            <span class="menu-icon">
                                <img src="{{ asset('assets/media/svg/profile-account/log-out.svg') }}"
                                    class="h-24px me-10" />
                            </span>
                            Log out
                            @include('user.logout')
                        </a>
                    </div>
                </div>
            </div>
        </div>
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