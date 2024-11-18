@extends('layouts.web-remake', ['title' => 'Hasil Pencarian'])

@section('content-web')
    <div class="d-flex justify-content-between align-items-center position-relative" style="top: -10px;">
        <a href="{{ url()->previous() }}" class="btn mb-3 text-danger kembali"><i class="bi bi-arrow-left text-danger"></i>
            Kembali</a>
        <div class="position-relative" style="width: 20%; margin-left: 45%;">
            <i class="bi bi-search position-absolute" style="left: 15px; top: 50%; transform: translateY(-50%);"></i>

            <input type="search" name="search" value="{{ request()->query('search') }}"
                placeholder="Cari tempat rental mobil langganan kamu disini" class="form-control rounded-pill"
                aria-label="Search" style="padding-left: 40px; border: 1px solid #ccc; box-shadow: none;">
        </div>

        <div class="location">
            <i class="fas fa-map-marker-alt" style="margin-right: 10%;"></i>
            <span>Jakarta</span>
            <i class="fas fa-caret-down"></i>
        </div>
    </div>

    <div class="search-bar">
        <i class="fas fa-search"></i>
        <span>Dengan Supir</span>
        <div class="divider"></div>
        <span>Jakarta</span>
        <div class="divider"></div>
        <span>Rabu, 16 Okt</span>
        <span>•</span>
        <span>05:00</span>
        <div class="divider"></div>
        <span>1 Hari</span>
        <button class="search-button">Cari</button>
    </div>

    <div class="custom-container">
        <div class="custom-left-buttons">
            <div class="custom-button active">Paket Reguler</div>
            <div class="custom-button">Paket All-In</div>
        </div>
        <div class="custom-right-buttons">
            <div class="custom-button"><i class="fa-solid fa-money-bill"></i></i>Harga</div>
            <div class="custom-button"><i class="bi bi-filter fs-2"></i></i>Urutkan</div>
        </div>
    </div>

    <main>
        <div class="card-inpo"
            style="margin-left: 11%; margin-top: 1%; position: relative; overflow: hidden; width: 78%; background: linear-gradient(to left, #fff, #ffe6e6);">
            <h2>Cara Menyewa Mobil</h2>
            <p>Harga yang tertera belum termasuk biaya bensin, tol, parkir, makan sopir, dan pemakaian di luar area 0.</p>
            <div class="bubble"
                style="position: absolute; right: -15px; top: -30px; width: 80px; height: 80px; border-radius: 50%;"></div>
            <div class="bubble2"
                style="position: absolute; right: -20px; top: 30px; width: 40px; height: 40px; border-radius: 50%;"></div>
        </div>

        {{-- @for ($i = 10; $i > 0; $i
        <div class="car-card" style="margin-top: 3%;">
            <img alt="Image of a Toyota New Avanza car" class="car-card-image" height="100"
                src="https://storage.googleapis.com/a1aa/image/wtbdyRGbLqahJR94XEuJUj4GeOoVAdj5eibBnlWvU4TXr7pTA.jpg"
                width="150" />
            <div class="car-card-details">
                <h2>
                    Toyota New Avanza
                </h2>
                <div class="car-card-info">
                    <span>
                        <i class="fas fa-suitcase">
                        </i>
                        2 Koper
                    </span>
                    <span>
                        <i class="fas fa-user-friends">
                        </i>
                        6 Penumpang
                    </span>
                </div>
            </div>
            <div class="car-card-price">
                <p>
                    Mulai dari
                </p>
                <p class="car-card-amount" style="text-align: right;">
                    IDR 10000 <span style="font-size: smaller; color: #919191">/ hari</span>
                </p>
                <button class="car-card-button">
                    Pilih Mobil
                </button>
            </div>
        </div>
        @endfor --}}

        {{-- CAR CARD --}}
        <div class="car-card" style="margin-top: 3%;">
            <img alt="Image of a Toyota New Avanza car" class="car-card-image" height="100"
                src="https://storage.googleapis.com/a1aa/image/wtbdyRGbLqahJR94XEuJUj4GeOoVAdj5eibBnlWvU4TXr7pTA.jpg"
                width="150" />
            <div class="car-card-details">
                <h2>
                    Toyota New Avanza
                </h2>
                <div class="car-card-info">
                    <span>
                        <i class="fas fa-suitcase">
                        </i>
                        2 Koper
                    </span>
                    <span>
                        <i class="fas fa-user-friends">
                        </i>
                        6 Penumpang
                    </span>
                </div>
            </div>
            <div class="car-card-price">
                <p>
                    Mulai dari
                </p>
                <p class="car-card-amount" style="text-align: right;">
                    IDR 10000 <span style="font-size: smaller; color: #919191">/ hari</span>
                </p>
                <button class="car-card-button">
                    Pilih Mobil
                </button>
            </div>
        </div>

        <div class="car-card" style="margin-top: 1%;">
            <img alt="Image of a Toyota New Avanza car" class="car-card-image" height="100"
                src="https://storage.googleapis.com/a1aa/image/wtbdyRGbLqahJR94XEuJUj4GeOoVAdj5eibBnlWvU4TXr7pTA.jpg"
                width="150" />
            <div class="car-card-details">
                <h2>
                    Toyota New Avanza
                </h2>
                <div class="car-card-info">
                    <span>
                        <i class="fas fa-suitcase">
                        </i>
                        2 Koper
                    </span>
                    <span>
                        <i class="fas fa-user-friends">
                        </i>
                        6 Penumpang
                    </span>
                </div>
            </div>
            <div class="car-card-price">
                <p>
                    Mulai dari
                </p>
                <p class="car-card-amount" style="text-align: right;">
                    IDR 10000 <span style="font-size: smaller; color: #919191">/ hari</span>
                </p>
                <button class="car-card-button">
                    Pilih Mobil
                </button>
            </div>
        </div>
        <div class="car-card" style="margin-top: 1%;">
            <img alt="Image of a Toyota New Avanza car" class="car-card-image" height="100"
                src="https://storage.googleapis.com/a1aa/image/wtbdyRGbLqahJR94XEuJUj4GeOoVAdj5eibBnlWvU4TXr7pTA.jpg"
                width="150" />
            <div class="car-card-details">
                <h2>
                    Toyota New Avanza
                </h2>
                <div class="car-card-info">
                    <span>
                        <i class="fas fa-suitcase">
                        </i>
                        2 Koper
                    </span>
                    <span>
                        <i class="fas fa-user-friends">
                        </i>
                        6 Penumpang
                    </span>
                </div>
            </div>
            <div class="car-card-price">
                <p>
                    Mulai dari
                </p>
                <p class="car-card-amount" style="text-align: right;">
                    IDR 10000 <span style="font-size: smaller; color: #919191">/ hari</span>
                </p>
                <button class="car-card-button">
                    Pilih Mobil
                </button>
            </div>
        </div>
        <div class="car-card" style="margin-top: 1%;">
            <img alt="Image of a Toyota New Avanza car" class="car-card-image" height="100"
                src="https://storage.googleapis.com/a1aa/image/wtbdyRGbLqahJR94XEuJUj4GeOoVAdj5eibBnlWvU4TXr7pTA.jpg"
                width="150" />
            <div class="car-card-details">
                <h2>
                    Toyota New Avanza
                </h2>
                <div class="car-card-info">
                    <span>
                        <i class="fas fa-suitcase">
                        </i>
                        2 Koper
                    </span>
                    <span>
                        <i class="fas fa-user-friends">
                        </i>
                        6 Penumpang
                    </span>
                </div>
            </div>
            <div class="car-card-price">
                <p>
                    Mulai dari
                </p>
                <p class="car-card-amount" style="text-align: right;">
                    IDR 10000 <span style="font-size: smaller; color: #919191">/ hari</span>
                </p>
                <button type="button" data-toggle="modal" data-target="#modalRental" class="car-card-button">
                    Pilih Mobil
                </button>
            </div>
        </div>

        <div class="car-card" style="margin-top: 1%;">
            <img alt="Image of a Toyota New Avanza car" class="car-card-image" height="100"
                src="https://storage.googleapis.com/a1aa/image/wtbdyRGbLqahJR94XEuJUj4GeOoVAdj5eibBnlWvU4TXr7pTA.jpg"
                width="150" />
            <div class="car-card-details">
                <h2>
                    Toyota New Avanza
                </h2>
                <div class="car-card-info">
                    <span>
                        <i class="fas fa-suitcase">
                        </i>
                        2 Koper
                    </span>
                    <span>
                        <i class="fas fa-user-friends">
                        </i>
                        6 Penumpang
                    </span>
                </div>
            </div>

            <div class="car-card-price">
                <p>
                    Mulai dari
                </p>
                <p class="car-card-amount" style="text-align: right;">
                    IDR 10000 <span style="font-size: smaller; color: #919191">/ hari</span>
                </p>
                <button type="button" data-toggle="modal" data-target="#modalRental" class="car-card-button">
                    Pilih Mobil
                </button>
            </div>
        </div>

        {{-- MODAL CAR --}}
        <div class="modal fade" id="modalRental" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="">Modal title</h5>
                  <button type="button" class="close">
                    <span >&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  ...
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>

    </main>

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> --}}
    @include('layouts.include.home.script-rental-mobil-landing')
@endsection
