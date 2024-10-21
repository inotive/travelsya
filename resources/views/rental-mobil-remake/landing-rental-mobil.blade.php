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
                    <button class="toggle-button active">Health</button>
                    <button class="toggle-button">Beauty</button>
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
                    <input type="text" placeholder="Pilihan tanggal">
                    <i style="color: #555555;" class="fa-solid fa-hourglass pasir"></i>
                </div>

                <button class="search-button">Cari Sekarang</button>
            </div>
        </section>

        <div style="display: flex;">
            <div class="card" style="margin-left: 12%; margin-top: 5%;">
                <div class="iconh text-white"><i class="fa fa-car"></i></div>
                <h2>Cara Menyewa Mobil</h2>
                <p>Cari tau mudahnya cara memesan Sewa Mobil di Travelsya.</p>
                <div class="bubble bubble-1"></div>
                <div class="bubble bubble-2"></div>
            </div>
            <div class="card" style="margin-left: 1%; margin-top: 5%;">
                <div class="iconh text-white"><i class="fa fa-car"></i></div>
                <h2>Syarat Sewa Mobil</h2>
                <p>Baca apa saja yang perlu kamu tau dan siapkan sebelum menyewa.</p>
                <div class="bubble bubble-1"></div>
                <div class="bubble bubble-2"></div>
            </div>
            <div class="card" style="margin-left: 1%; margin-top: 5%;">
                <div class="iconh text-white"><i class="fa fa-car"></i></div>
                <h2>Persyaratan Perjalanan</h2>
                <p>Cek protokol dan syarat perjalanan selama pandemi.</p>
                <div class="bubble bubble-1"></div>
                <div class="bubble bubble-2"></div>
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
        document.getElementById("tanggalwaktu").value = hariarray[hari] + " " + tanggal + " " + bulanarray[bulan] + "                    |         " + ("" + jam).slice(-8) + ":" + menit;a
    </script>
    
@endsection
