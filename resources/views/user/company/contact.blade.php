@extends('layouts.web')

@section('content-web')

<div class="container">
    <div class="row">
        <div class="col-12 mb-5">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Hubungi Kami
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="h1 text-center mb-5">Kontak Kami</div>
                            <div class="row">
                                <div class="col-12 col-md-3 mb-5">
                                    <a target="_blank" href="tel:(0542)8795954">
                                    <div class="card" style="background: #C02425">
                                            <div class="d-flex align-items-center justify-content-center m-5 text-white">
                                                <i class="fa-solid fa-phone text-white fs-1" style="margin-right: 16px;"></i>
                                                <div class="bungkus">
                                                    <div class="text ">Phone</div>
                                                    <div class="text-white fw-bold h4">
                                                    (0542)8795954
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-12 col-md-3 mb-5">
                                    <a target="_blank" href="https://api.whatsapp.com/send?phone=628115417708&text=Halo%20min%2C%20mau%20nanya%20nih" target="_blank">
                                    <div class="card" style="background: #C02425">
                                            <div class="d-flex justify-content-center align-items-center text-white m-5">
                                                <i class="fa-brands fa-whatsapp text-white fs-1" style="margin-right: 16px;"></i>
                                                <div class="bungkus text-white">
                                                    <div class="text">WhatsApp</div>
                                                    <div class="fw-bold h4 text-white">
                                                    0811 5417 708
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-12 col-md-3 mb-5">
                                    <a target="_blank" href="mailto:cs@travelsya.com">
                                    <div class="card" style="background: #C02425">
                                            <div class="d-flex align-items-center justify-content-center m-5 text-white">
                                                <i class="fa-solid fa-envelope text-white fs-1" style="margin-right: 16px;"></i>
                                                <div class="bungkus">
                                                    <div class="text ">Email</div>
                                                    <div class="text-white fw-bold h4">
                                                    cs@travelsya.com
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-12 col-md-3 mb-5">
                                    <a target="_blank" href="https://travelsya.com">
                                    <div class="card" style="background: #C02425">
                                            <div class="d-flex align-items-center justify-content-center m-5 text-white">
                                                <i class="fa-solid fa-globe text-white fs-1" style="margin-right: 16px;"></i>
                                                <div class="bungkus">
                                                    <div class="text ">Website</div>
                                                    <div class="text-white fw-bold h4">
                                                    travelsya.com
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-5">
                            <div class="h1 text-center mb-5">Ikuti Kami</div>
                            <div class="row">
                                <div class="col-12 col-md-4 mb-5">
                                    <a target="_blank" href="{{ url('https://www.youtube.com/@travelsyawisataindonesia6211') }}">
                                    <div class="card" style="background: #C02425">
                                            <div class="d-flex align-items-center justify-content-center m-5 text-white">
                                                <i class="fa-brands fa-youtube text-white fs-1" style="margin-right: 16px;"></i>
                                                <div class="bungkus">
                                                    <div class="text ">Youtube</div>
                                                    <div class="text-white fw-bold h4">
                                                    Travelsya Wisata Indonesia
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-12 col-md-4 mb-5">
                                    <a target="_blank" href="{{ url('https://www.instagram.com/travelsya/') }}">
                                    <div class="card" style="background: #C02425">
                                            <div class="d-flex align-items-center justify-content-center m-5 text-white">
                                                <i class="fa-brands fa-instagram text-white fs-1" style="margin-right: 16px;"></i>
                                                <div class="bungkus">
                                                    <div class="text ">Instagram</div>
                                                    <div class="text-white fw-bold h4">
                                                    @travelsya
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-12 col-md-4 mb-5">
                                    <a target="_blank" href="{{ url('https://www.tiktok.com/@travelsya') }}">
                                    <div class="card" style="background: #C02425">
                                            <div class="d-flex align-items-center justify-content-center m-5 text-white">
                                                <i class="fa-brands fa-tiktok text-white fs-1" style="margin-right: 16px;"></i>
                                                <div class="bungkus">
                                                    <div class="text ">Tiktok</div>
                                                    <div class="text-white fw-bold h4">
                                                    @travelsya
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-5">
                            <div class="h3 mb-5">
                                Lokasi Kami
                            </div>
                            <div class="d-flex align-items-center mb-5">
                                <i class="ki-duotone ki-map fs-3" style="margin-right: 8px">
                                     <span class="path1"></span>
                                     <span class="path2"></span>
                                     <span class="path3"></span>
                                    </i>
                                <small class="text-gray-400">Jl. Syarifuddin Yoes No 48, Sepinggan, Kecamatan Balikpapan Selatan, Kota Balikpapan, Kalimantan Timur 76114</small>
                            </div>
                            <div class="row mb-5">
                                <iframe class="col-12" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.901732639068!2d116.88292458530366!3d-1.2281640991587968!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df1460f4ae73a05%3A0xff637036dc036c79!2sJl.%20Syarifuddin%20Yoes%20No.48%2C%20Sepinggan%2C%20Kecamatan%20Balikpapan%20Selatan%2C%20Kota%20Balikpapan%2C%20Kalimantan%20Timur%2076114!5e0!3m2!1sid!2sid!4v1698024402661!5m2!1sid!2sid" height="300px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div class="col-12 mt-5 mb-5">
                            <div class="h1 text-center">Tersedia Di</div>
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="card col-2 border border-1" style="margin-right: 16px;">
                                    <a href="{{ url('https://play.google.com/store/apps/details?id=com.travelsya.id&pcampaignid=web_share') }}" target="_blank">
                                        <img class="img-fluid" src="/media/ads/play_store.png" alt="play_store.png">
                                    </a>
                                </div>
                                <div class="card col-2 border border-1">
                                    <a href="{{ url('https://apps.apple.com/id/app/travelsya-travel-lifestyle/id6450695778?l=id') }}" target="_blank">
                                        <img class="img-fluid" src="/media/ads/app_store.png" alt="app_store.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
