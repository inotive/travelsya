<div class="footer py-4 d-flex flex-lg-column text-white " style="background-color:#C02425;"
                    id="kt_footer">
                    <!--begin::Container-->
                    <div class=" container-xxl ">
                        <div class="row py-10">
                            <div class="col-md-3">
                                <img class="img-fluid mb-5" src="{{ asset('assets/media/logos/logonew.png') }}" alt="logo-travelsya">
                                <p>Kalimantan Timur, Balikpapan</p>
                                <p>Indonesia</p>
                                <p>cs@travelsya.com</p>
                                <p>(0542)8795954</p>

                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col md-4">
                                        <p class="fw-bold fs-5">Layanan</p>
                                        <p data-bs-toggle="modal" data-bs-target="#modal-hotel">
                                            <a class="text-white" href="#">
                                                Booking Hotel
                                            </a>
                                        </p>
                                        <p>Tiket Pesawat</p>
                                        <p>Tiket Kereta Api</p>
                                        <p>Tiket Bus & Travel</p>
                                        <p>Tiket Rekreasi</p>
                                        <p>Rental Mobil</p>
                                        <p data-bs-toggle="modal" data-bs-target="#modal-hostel">
                                            <a class="text-white" href="#">
                                                Booking Hostel
                                            </a>
                                        </p>
                                        <p data-bs-toggle="modal" data-bs-target="#modal-pln">
                                            <a class="text-white" href="#">
                                                Bayar PLN
                                            </a>
                                        </p>
                                    </div>
                                    <div class="col md-4">
                                        <p class="fw-bold fs-5">&nbsp;</p>
                                        <p data-bs-toggle="modal" data-bs-target="#modal-bpjs">
                                            <a class="text-white" href="#">
                                                Bayar BPJS
                                            </a>
                                        </p>
                                        <p data-bs-toggle="modal" data-bs-target="#modal-pdam">
                                            <a class="text-white" href="#">
                                                Bayar PDAM
                                            </a>
                                        </p>
                                        {{-- <p>Transfer Bank</p> --}}
                                        <p data-bs-toggle="modal" data-bs-target="#modal-ewallet">
                                            <a class="text-white" href="#">
                                                Top up Ewallet
                                            </a>
                                        </p>
                                        <p data-bs-toggle="modal" data-bs-target="#modal-pulsadata">
                                            <a class="text-white" href="#">
                                                Pulsa & Data
                                            </a>
                                        </p>
                                        <p data-bs-toggle="modal" data-bs-target="#modal-tvBerbayar">
                                            <a class="text-white" href="#">
                                                TV Berbayar
                                            </a>
                                        </p>
                                        <p data-bs-toggle="modal" data-bs-target="#modal-pajak">
                                            <a class="text-white" href="#">
                                                Bayar Pajak
                                            </a>
                                        </p>
                                        <p>Health & Beauty</p>
                                    </div>
                                    <div class="col md-4">
                                        <p class="fw-bold fs-5">Dukungan</p>
                                        <a href="{{ route('company.about') }}" class="text-white">
                                            <p>Tentang Kami</p>
                                        </a>
                                        <a href="/partner-hotel" class="text-white">
                                            <p>Partner</p>
                                        </a>
                                        <a href="{{route('bantuan-user')}}" class="text-white">
                                            <p>Pusat Bantuan</p>
                                        </a>
                                        <a href="{{route('company.terms')}}" class="text-white">
                                            <p>Kebijakan Privasi</p>
                                        </a>
                                        <a href="{{ route('company.privat') }}" class="text-white">
                                            <p>Syarat & Ketentuan</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <p class="fw-bold fs-5">Download Aplikasi</p>
                                {{-- <img alt=""
                                    src="{{ asset('assets/media/products-categories/download-apps.png') }}"
                                    class="w-200px" /> --}}
                                <div class="col-8" style="margin-bottom: 16px;">
                                    <a href="{{ url('https://play.google.com/store/apps/details?id=com.travelsya.id&pcampaignid=web_share') }}" target="_blank">
                                        <img class="img-fluid" src="/media/ads/play_store.png" alt="play_store.png">
                                    </a>
                                </div>
                                <div class="col-8">
                                    <a href="{{ url('https://apps.apple.com/id/app/travelsya-travel-lifestyle/id6450695778?l=id') }}" target="_blank">
                                        <img class="img-fluid" src="/media/ads/app_store.png" alt="app_store.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <!--begin::Copyright-->

                            <div class="text-start order-2 order-md-1">
                                <span class="fw-semibold me-1 ">Copyright @ 2023&copy; right reserved</span>
                                <!-- <a href="https://keenthemes.com/" target="_blank"
                                        class="text-gray-800 text-hover-primary">Keenthemes</a> -->
                            </div>
                            <!--end::Copyright-->
                        </div>
                    </div>
                </div>
