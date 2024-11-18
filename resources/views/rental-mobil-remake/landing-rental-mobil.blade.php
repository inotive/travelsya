@extends('layouts.web-remake', ['title' => 'Rental Mobil'])

@section('content-web')

    <div class="d-flex justify-content-between align-items-center position-relative" style="top: -10px;">
        <a href="{{ url()->previous() }}" class="btn mb-3 text-danger kembali"><i class="bi bi-arrow-left text-danger"></i> Kembali</a>
        <div class="search" style="margin-right: 10%; width: 22%;">
            <i class="fas fa-search fs-3" style="margin-right: 10px; color: gray;"></i>
            <input type="text" placeholder="Cari tempat rental mobil langganan kamu disini">
        </div>
    </div>

    <main>
        <section class="hero">
            <div class="hero-content">
                <h2 class="hawa text-white">Sewa Mobil</h2>
                <h1 class="text-white">Rental Mobil Terdekat</h1>
            </div>

            <div class="search-box">
                <div class="button-group">
                    <button class="toggle-button active">Dengan Supir</button>
                    <button class="toggle-button">Lepas Kunci</button>
                </div>

                <div class="search-container">
                    <i class="fa-solid fa-location-crosshairs ikon"></i>
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" placeholder="Tentukan Lokasi Anda">
                </div>

                <div class="date-container">
                    <input id="tanggalwaktu" style="padding-right: 3px;">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <svg class="iconJam" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 15 12"></polyline>
                    </svg>
                </div>

                <div class="duration-container">
                    <input type="text" placeholder="Durasi">
                    <i style="color: #555555;" class="fa-solid fa-hourglass pasir"></i>
                </div>

                <form action="{{ route('rental.search.result') }}" method="GET">
                    <button class="submit-button" type="submit">Cari Sekarang</button>
                </form>
            </div>
        </section>

        <div style="display: flex;">
            <div class="card-inpo" style="margin-left: 12%; margin-top: 5%; position: relative; overflow: hidden;">
                <div class="iconh text-white"><i class="fa fa-car"></i></div>
                <h2>Cara Menyewa Mobil</h2>
                <p>Cari tau mudahnya cara memesan Sewa Mobil di Travelsya.</p>
                <div class="bubble" style="position: absolute; right: -15px; top: -30px; width: 80px; height: 80px; border-radius: 50%;"></div>
                <div class="bubble2" style="position: absolute; right: -20px; top: 30px; width: 40px; height: 40px; border-radius: 50%;"></div>
            </div>
            <div class="card-inpo" style="margin-left: 1%; margin-top: 5%; position: relative; overflow: hidden;">
                <div class="iconh text-white"><i class="fa-solid fa-file-circle-exclamation text-white" style="font-size: 16px;"></i></i></div>
                <h2>Syarat Sewa Mobil</h2>
                <p>Baca apa saja yang perlu kamu tau dan siapkan sebelum menyewa.</p>
                <div class="bubble" style="position: absolute; right: -15px; top: -30px; width: 80px; height: 80px; border-radius: 50%;"></div>
                <div class="bubble2" style="position: absolute; right: -20px; top: 30px; width: 40px; height: 40px; border-radius: 50%;"></div>
            </div>
            <div class="card-inpo" style="margin-left: 1%; margin-top: 5%; position: relative; overflow: hidden;">
                <div class="iconh text-white"><i class="bi bi-shield-fill-check text-white" style="font-size: 20px;"></i></div>
                <h2>Persyaratan Perjalanan</h2>
                <p>Cek protokol dan syarat perjalanan selama pandemi.</p>
                <div class="bubble" style="position: absolute; right: -15px; top: -30px; width: 80px; height: 80px; border-radius: 50%;"></div>
                <div class="bubble2" style="position: absolute; right: -20px; top: 30px; width: 40px; height: 40px; border-radius: 50%;"></div>
            </div>
        </div>


        {{-- INFORMATION AREA --}}
        <div style="display: flex; justify-content: center; margin-top: 30px; margin-bottom: 30px;">
            <div style="width: 78%; background-color: #ffffff; padding: 20px; border-radius: 10px;">
                <h1 style="text-align:left; margin-bottom: 20px;">Rental Mobil Dengan Supir</h1>
                <p style="text-align: justify; font-size: 16px;">Bepergian bersama keluarga atau kerabat semakin asyik jika Anda menggunakan sarana transportasi yang tepat. Sewa mobil atau carter mobil dapat menjadi pilihan terbaik untuk memudahkan mobilitas Anda. Untuk semakin mendukung fleksibilitas Anda saat bepergian, Travelsya kini telah menjadi aplikasi sewa mobil yang terpercaya. Aplikasi rental mobil Travelsya membuat Anda dapat menikmati kenyamanan ini dengan memesan langsung layanan rental mobil yang anda butuhkan. Temukan berbagai pilihan mobil terbaik, lengkap dengan tarif mobil yang dibutuhkan. Cek harga sewa mobil harian untuk segala keperluan anda. <br> <br>
                    Dapatkan durasi rental 24 jam dengan memesan layanan sewa mobil lepas kunci di Travelsya. Jadikan perjalanan keluarga atau bisnis anda lebih hemat dan efisien.</p>
            </div>
        </div>

        <div style="display: flex; justify-content: center; margin-top: 30px; margin-bottom: 30px;">
            <div style="width: 78%; background-color: #ffffff; padding: 20px; border-radius: 10px;">
                <h1 style="text-align:left; margin-bottom: 20px;">Rental Mobil Lepas Kunci</h1>
                <p style="text-align: justify; font-size: 16px;">Memilih kendaraan yang tepat saat ingin bepergian adalah hal wajib. Jika Anda berencana keliling keluar kota dengan keluarga atau rombongan, persewaan mobil atau carter mobil di luar kota menjadi pilihan terbaik. Kini, perkembangan teknologi memudahkan Anda untuk persewaan mobil di manapun hanya dengan Travelsya. Anda dapat menemukan pilihan mobil terbaik, rental mobil terdekat dari lokasi anda yang sesuai dengan kebutuhan. Kemudahan ini akan menjadikan perjalanan Anda lebih nyaman dan hemat waktu.</p>
            </div>
        </div>

        <div style="display: flex; justify-content: center; margin-top: 30px; margin-bottom: 30px;">
            <div style="width: 78%; background-color: #ffffff; padding: 20px; border-radius: 10px;">
                <h1 style="text-align:left; margin-bottom: 20px;">Ketentuan Umum Sewa Mobil</h1>

                <div class="container d-flex flex-wrap justify-content-between ">
                    <div class="card mr-2 mb-3" style="margin-left: -10px;">
                        <h3>Syarat Sewa Mobil Dengan Supir</h3>
                        <hr>
                        <h4 style="margin-top: 5px;">Sudah Termasuk</h4>
                        <ul>
                            <li>Penggunaan Dalam Kota</li>
                            <li>Penggunaan sampai dengan 12 jam atau hingga 23:59 di setiap hari rental</li>
                        </ul>
                        <h4 style="margin-top: 5px;">Tidak Termasuk</h4>
                        <ul>
                            <li>Bensin, parkir, tol, uang makan sopir dan tips</li>
                            <li>Biaya akomodasi sopir selama bepergian keluar kota</li>
                            <li>Penggunaan di luar kota (biaya tambahan berlaku)</li>
                        </ul>
                        <button class="btn btn-link read-more text-danger" style="text-align: left; border: none; background: none; cursor: pointer;">
                            Baca lebih banyak <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>

                    <div class="card mb-3">
                        <h3>Syarat Sewa Mobil Lepas Kunci</h3>
                        <hr>
                        <h4 style="margin-top: 5px;">Sudah Termasuk</h4>
                        <ul>
                            <li>Asuransi untuk mobil dan penumpang</li>
                            <li>Penggunaan hingga 24 jam per hari</li>
                        </ul>
                        <h4 style="margin-top: 5px;">Tidak Termasuk</h4>
                        <ul>
                            <li>Bensin, pengambilan/pengembalian di luar kota, dan klaim asuransi</li>
                        </ul>
                        <h4 style="margin-top: 5px;">Lokasi Jemput</h4>
                        <button class="btn btn-link read-more text-danger" style="text-align: left; border: none; background: none; cursor: pointer;">
                            Baca lebih banyak <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="d-flex flex-wrap justify-content-between" style="display: flex; justify-content: center; margin-top: 30px; margin-bottom: 30px;">
            <div style="width: 90%; background-color: #ffffff; padding: 20px; border-radius: 10px; text-align: center;">
                <h1 style="text-align: left; margin-left: 12%;">Kendaraan Favorit Rental Mobil di Travelsya</h1>

                {{-- <div class="d-flex flex-wrap justify-content-between" style="gap: -1px;"> --}}
                <div class="d-flex flex-wrap justify-content-between" style="gap: -10px; margin-left: 11%;">
                        <div class="card-car" style="flex: 1; margin: 1%; max-width: 23%;">
                            <img src="{{ asset('storage/images/car-rental-new.png') }}" alt="Toyota New Avanza" class="car-image">
                            <h3 class="car-title" style="text-align: left;">Toyota New Avanza</h3>
                            <div class="car-stats">
                                <div class="stat-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-duffle-fill" viewBox="0 0 16 16">
                                        <path d="M5.007 4.097q.011-.146.027-.298c.05-.464.141-.979.313-1.45.169-.465.432-.933.853-1.249 1.115-.836 2.485-.836 3.6 0 .42.316.684.784.853 1.25.171.47.263.985.313 1.449q.016.15.027.298c1.401.194 2.65.531 3.525 1.012 2.126 1.169 1.446 6.095 1.089 8.018a.954.954 0 0 1-.95.772H1.343a.954.954 0 0 1-.95-.772c-.357-1.923-1.037-6.85 1.09-8.018.873-.48 2.123-.818 3.524-1.012M4.05 5.633a22 22 0 0 0-1.565.352l-.091.026-.034.01a.5.5 0 0 0 .282.959l.005-.002.02-.005.08-.023a21 21 0 0 1 1.486-.334A21 21 0 0 1 8 6.25c1.439 0 2.781.183 3.767.367a21 21 0 0 1 1.567.356l.02.005.004.001a.5.5 0 0 0 .283-.959h-.003l-.006-.002-.025-.007a15 15 0 0 0-.43-.113 22 22 0 0 0-1.226-.265A22 22 0 0 0 8 5.25c-1.518 0-2.926.192-3.95.383M6.8 1.9c-.203.153-.377.42-.513.791a5.3 5.3 0 0 0-.265 1.292 35 35 0 0 1 1.374-.076c.866-.022 1.742.003 2.584.076a5.3 5.3 0 0 0-.266-1.292c-.135-.372-.309-.638-.513-.791-.76-.57-1.64-.57-2.4 0Z"/>
                                    </svg>
                                    2
                                </div>
                                <div class="stat-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                    </svg>
                                    6
                                </div>
                            </div>
                        </div>

                        <div class="card-car" style="flex: 1; margin: 1%; max-width: 23%;">
                            <img src="{{ asset('storage/images/car-rental-new.png') }}" alt="Toyota New Avanza" class="car-image">
                            <h3 class="car-title" style="text-align: left;">Toyota New Avanza</h3>
                            <div class="car-stats">
                                <div class="stat-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-duffle-fill" viewBox="0 0 16 16">
                                        <path d="M5.007 4.097q.011-.146.027-.298c.05-.464.141-.979.313-1.45.169-.465.432-.933.853-1.249 1.115-.836 2.485-.836 3.6 0 .42.316.684.784.853 1.25.171.47.263.985.313 1.449q.016.15.027.298c1.401.194 2.65.531 3.525 1.012 2.126 1.169 1.446 6.095 1.089 8.018a.954.954 0 0 1-.95.772H1.343a.954.954 0 0 1-.95-.772c-.357-1.923-1.037-6.85 1.09-8.018.873-.48 2.123-.818 3.524-1.012M4.05 5.633a22 22 0 0 0-1.565.352l-.091.026-.034.01a.5.5 0 0 0 .282.959l.005-.002.02-.005.08-.023a21 21 0 0 1 1.486-.334A21 21 0 0 1 8 6.25c1.439 0 2.781.183 3.767.367a21 21 0 0 1 1.567.356l.02.005.004.001a.5.5 0 0 0 .283-.959h-.003l-.006-.002-.025-.007a15 15 0 0 0-.43-.113 22 22 0 0 0-1.226-.265A22 22 0 0 0 8 5.25c-1.518 0-2.926.192-3.95.383M6.8 1.9c-.203.153-.377.42-.513.791a5.3 5.3 0 0 0-.265 1.292 35 35 0 0 1 1.374-.076c.866-.022 1.742.003 2.584.076a5.3 5.3 0 0 0-.266-1.292c-.135-.372-.309-.638-.513-.791-.76-.57-1.64-.57-2.4 0Z"/>
                                    </svg>
                                    2
                                </div>
                                <div class="stat-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                    </svg>
                                    6
                                </div>
                            </div>
                        </div>

                        <div class="card-car" style="flex: 1; margin: 1%; max-width: 23%;">
                            <img src="{{ asset('storage/images/car-rental-new.png') }}" alt="Toyota New Avanza" class="car-image">
                            <h3 class="car-title" style="text-align: left;">Toyota New Avanza</h3>
                            <div class="car-stats">
                                <div class="stat-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-duffle-fill" viewBox="0 0 16 16">
                                        <path d="M5.007 4.097q.011-.146.027-.298c.05-.464.141-.979.313-1.45.169-.465.432-.933.853-1.249 1.115-.836 2.485-.836 3.6 0 .42.316.684.784.853 1.25.171.47.263.985.313 1.449q.016.15.027.298c1.401.194 2.65.531 3.525 1.012 2.126 1.169 1.446 6.095 1.089 8.018a.954.954 0 0 1-.95.772H1.343a.954.954 0 0 1-.95-.772c-.357-1.923-1.037-6.85 1.09-8.018.873-.48 2.123-.818 3.524-1.012M4.05 5.633a22 22 0 0 0-1.565.352l-.091.026-.034.01a.5.5 0 0 0 .282.959l.005-.002.02-.005.08-.023a21 21 0 0 1 1.486-.334A21 21 0 0 1 8 6.25c1.439 0 2.781.183 3.767.367a21 21 0 0 1 1.567.356l.02.005.004.001a.5.5 0 0 0 .283-.959h-.003l-.006-.002-.025-.007a15 15 0 0 0-.43-.113 22 22 0 0 0-1.226-.265A22 22 0 0 0 8 5.25c-1.518 0-2.926.192-3.95.383M6.8 1.9c-.203.153-.377.42-.513.791a5.3 5.3 0 0 0-.265 1.292 35 35 0 0 1 1.374-.076c.866-.022 1.742.003 2.584.076a5.3 5.3 0 0 0-.266-1.292c-.135-.372-.309-.638-.513-.791-.76-.57-1.64-.57-2.4 0Z"/>
                                    </svg>
                                    2
                                </div>
                                <div class="stat-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                    </svg>
                                    6
                                </div>
                            </div>
                        </div>

                        <div class="card-car" style="flex: 1; margin: 1%; max-width: 23%;">
                            <img src="{{ asset('storage/images/car-rental-new.png') }}" alt="Toyota New Avanza" class="car-image">
                            <h3 class="car-title" style="text-align: left;">Toyota New Avanza</h3>
                            <div class="car-stats">
                                <div class="stat-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-duffle-fill" viewBox="0 0 16 16">
                                        <path d="M5.007 4.097q.011-.146.027-.298c.05-.464.141-.979.313-1.45.169-.465.432-.933.853-1.249 1.115-.836 2.485-.836 3.6 0 .42.316.684.784.853 1.25.171.47.263.985.313 1.449q.016.15.027.298c1.401.194 2.65.531 3.525 1.012 2.126 1.169 1.446 6.095 1.089 8.018a.954.954 0 0 1-.95.772H1.343a.954.954 0 0 1-.95-.772c-.357-1.923-1.037-6.85 1.09-8.018.873-.48 2.123-.818 3.524-1.012M4.05 5.633a22 22 0 0 0-1.565.352l-.091.026-.034.01a.5.5 0 0 0 .282.959l.005-.002.02-.005.08-.023a21 21 0 0 1 1.486-.334A21 21 0 0 1 8 6.25c1.439 0 2.781.183 3.767.367a21 21 0 0 1 1.567.356l.02.005.004.001a.5.5 0 0 0 .283-.959h-.003l-.006-.002-.025-.007a15 15 0 0 0-.43-.113 22 22 0 0 0-1.226-.265A22 22 0 0 0 8 5.25c-1.518 0-2.926.192-3.95.383M6.8 1.9c-.203.153-.377.42-.513.791a5.3 5.3 0 0 0-.265 1.292 35 35 0 0 1 1.374-.076c.866-.022 1.742.003 2.584.076a5.3 5.3 0 0 0-.266-1.292c-.135-.372-.309-.638-.513-.791-.76-.57-1.64-.57-2.4 0Z"/>
                                    </svg>
                                    2
                                </div>
                                <div class="stat-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                    </svg>
                                    6
                                </div>
                            </div>
                        </div>
                        
                </div>
                
            </div>
        </div>

        <div style="display: flex; justify-content: center; margin-top: 30px; margin-bottom: 30px;">
            <div style="width: 78%; background-color: #ffffff; padding: 20px; border-radius: 10px;">
                <h1 style="text-align: left;">Kendaraan Favorit Rental Mobil di Travelsya</h1>

                    <div class="d-flex flex-wrap justify-content-between">
                            <div class="city-card" style="position: relative; width: 23%; height: 200px;">
                                <img alt="gambar kota"
                                    src="https://storage.googleapis.com/a1aa/image/7hfHYVNAmvwMTSHWl8q2zfsJfhcfk3fz0h8S5DNMrn6Y8LKdC.jpg"
                                    style="width: 100%; height: 86%; object-fit: cover; border-radius: 12px; filter: brightness(0.6);" />
                                <span style="position: absolute; top: 44%; left: 50%; transform: translate(-50%, -50%); color: white; font-weight: bold; border-radius: 5px; font-size: 14px;">
                                    Jakarta
                                </span>
                            </div>

                            <div class="city-card" style="position: relative; width: 23%; height: 200px;">
                                <img alt="gambar kota"
                                    src="https://storage.googleapis.com/a1aa/image/7hfHYVNAmvwMTSHWl8q2zfsJfhcfk3fz0h8S5DNMrn6Y8LKdC.jpg"
                                    style="width: 100%; height: 86%; object-fit: cover; border-radius: 12px; filter: brightness(0.6);" />
                                <span style="position: absolute; top: 44%; left: 50%; transform: translate(-50%, -50%); color: white; font-weight: bold; border-radius: 5px; font-size: 14px;">
                                    Balikpapan
                                </span>
                            </div>

                            <div class="city-card" style="position: relative; width: 23%; height: 200px;">
                                <img alt="gambar kota"
                                    src="https://storage.googleapis.com/a1aa/image/7hfHYVNAmvwMTSHWl8q2zfsJfhcfk3fz0h8S5DNMrn6Y8LKdC.jpg"
                                    style="width: 100%; height: 86%; object-fit: cover; border-radius: 12px; filter: brightness(0.6);" />
                                <span style="position: absolute; top: 44%; left: 50%; transform: translate(-50%, -50%); color: white; font-weight: bold; border-radius: 5px; font-size: 14px;">
                                    Banjarmasin
                                </span>
                            </div>

                            <div class="city-card" style="position: relative; width: 23%; height: 200px;">
                                <img alt="gambar kota"
                                    src="https://storage.googleapis.com/a1aa/image/7hfHYVNAmvwMTSHWl8q2zfsJfhcfk3fz0h8S5DNMrn6Y8LKdC.jpg"
                                    style="width: 100%; height: 86%; object-fit: cover; border-radius: 12px; filter: brightness(0.6);" />
                                <span style="position: absolute; top: 44%; left: 50%; transform: translate(-50%, -50%); color: white; font-weight: bold; border-radius: 5px; font-size: 14px;">
                                    Palembang
                                </span>
                            </div>

                            <div class="city-card" style="position: relative; width: 23%; height: 200px; margin-top: -10px;">
                                <img alt="gambar kota"
                                    src="https://storage.googleapis.com/a1aa/image/7hfHYVNAmvwMTSHWl8q2zfsJfhcfk3fz0h8S5DNMrn6Y8LKdC.jpg"
                                    style="width: 100%; height: 86%; object-fit: cover; border-radius: 12px; filter: brightness(0.6);" />
                                <span style="position: absolute; top: 44%; left: 50%; transform: translate(-50%, -50%); color: white; font-weight: bold; border-radius: 5px; font-size: 14px;">
                                    Bandung
                                </span>
                            </div>
                            
                            <div class="city-card" style="position: relative; width: 23%; height: 200px; margin-top: -10px;">
                                <img alt="gambar kota"
                                    src="https://storage.googleapis.com/a1aa/image/7hfHYVNAmvwMTSHWl8q2zfsJfhcfk3fz0h8S5DNMrn6Y8LKdC.jpg"
                                    style="width: 100%; height: 86%; object-fit: cover; border-radius: 12px; filter: brightness(0.6);" />
                                <span style="position: absolute; top: 44%; left: 50%; transform: translate(-50%, -50%); color: white; font-weight: bold; border-radius: 5px; font-size: 14px;">
                                    Yogyakarta
                                </span>
                            </div>

                            <div class="city-card" style="position: relative; width: 23%; height: 200px; margin-top: -10px;">
                                <img alt="gambar kota"
                                    src="https://storage.googleapis.com/a1aa/image/7hfHYVNAmvwMTSHWl8q2zfsJfhcfk3fz0h8S5DNMrn6Y8LKdC.jpg"
                                    style="width: 100%; height: 86%; object-fit: cover; border-radius: 12px; filter: brightness(0.6);" />
                                <span style="position: absolute; top: 44%; left: 50%; transform: translate(-50%, -50%); color: white; font-weight: bold; border-radius: 5px; font-size: 14px;">
                                    Bali
                                </span>
                            </div>

                            <div class="city-card" style="position: relative; width: 23%; height: 200px; margin-top: -10px;">
                                <img alt="gambar kota"
                                    src="https://storage.googleapis.com/a1aa/image/7hfHYVNAmvwMTSHWl8q2zfsJfhcfk3fz0h8S5DNMrn6Y8LKdC.jpg"
                                    style="width: 100%; height: 86%; object-fit: cover; border-radius: 12px; filter: brightness(0.6);" />
                                <span style="position: absolute; top: 44%; left: 50%; transform: translate(-50%, -50%); color: white; font-weight: bold; border-radius: 5px; font-size: 14px;">
                                    Surabaya
                                </span>
                            </div>
                    </div>
                
            </div>
        </div>

    </main>

    
    @include('layouts.include.home.script-rental-mobil-landing')

    <script>
        var tw = new Date();
        if (tw.getTimezoneOffset() == 0) (a = tw.getTime() + (7 * 60 * 60 * 1000))
        else (a = tw.getTime());
        tw.setTime(a);
        var tahun = tw.getFullYear();
        var hari = tw.getDay();
        var bulan = tw.getMonth();
        var tanggal = tw.getDate();
        var jam = tw.getHours();
        var menit = tw.getMinutes();
        if (jam < 10) jam = '0' + jam;
        if (menit < 10) menit = '0' + menit;
        var detik = tw.getSeconds();
        var hariarray = new Array("Minggu,", "Senin,", "Selasa,", "Rabu,", "Kamis,", "Jum'at,", "Sabtu,");
        var bulanarray = new Array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember");

        setInterval(function() {
            var tw = new Date();
            if (tw.getTimezoneOffset() == 0) (a = tw.getTime() + (7 * 60 * 60 * 1000))
            else (a = tw.getTime());
            tw.setTime(a);
            var tahun = tw.getFullYear();
            var hari = tw.getDay();
            var bulan = tw.getMonth();
            var tanggal = tw.getDate();
            var jam = tw.getHours();
            var menit = tw.getMinutes();
            if (jam < 10) jam = '0' + jam;
            if (menit < 10) menit = '0' + menit;
            document.getElementById("tanggalwaktu").value = hariarray[hari] + " " + tanggal + " " + bulanarray[bulan] + "                    |         " + ("" + jam).slice(-8) + ":" + menit
        }, 1000);
    </script>
    
@endsection
