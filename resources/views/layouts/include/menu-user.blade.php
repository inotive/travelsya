<div class="card menu-user">
    <div class="card-body fw-bold text-gray-800">
        <h3 class="card-title mb-5">{{session()->get('user')['data']['name']}}</h3>
        <div class="d-flex align-items-center mb-3">
            <img src="../assets/media/stock/food/img-2.jpg" class="w-30px rounded-3 me-3" alt="" />
            <div class="">
                <div class="fw-bold text-gray-500"><small>Points Anda</small></div>
                <div class="fs-5">{{session()->get('user')['data']['point']}}</div>
            </div>
        </div>
        <div class="d-flex align-items-center mb-3">
            <img src="../assets/media/stock/food/img-2.jpg" class="w-30px rounded-3 me-3" alt="" />
            <div class="">
                <div class="fw-bold text-gray-500"><small>e-Wallet</small></div>
                <div class="fs-5">Rp. 1,300</div>
            </div>
        </div>
        <hr>
        <a href="#" class="d-flex align-items-center mb-3 text-gray-800 my-7">
            <i class="far fa-lg fa-user w-30px rounded-3 me-3"></i>
            <div class="fs-5">Profile Saya</div>
        </a>
        <a href="#" class="d-flex align-items-center mb-3 text-gray-800 my-7 {{(Request::segment(1) == 'transaction') ? 'active' : '' }}">
            <i class="far fa-clipboard fa-lg w-30px rounded-3 me-3"></i>
            <div class="fs-5">Riwayat Pesanan</div>
        </a>
        <a href="#" class="d-flex align-items-center mb-3 text-gray-800 my-7">
            <i class="fa fa-users fa-lg w-30px rounded-3 me-3"></i>
            <div class="fs-5">Data Penumpang</div>
        </a>
        <a href="#" class="d-flex align-items-center mb-3 text-gray-800 my-7">
            <i class="fa fa-lock fa-lg w-30px rounded-3 me-3"></i>
            <div class="fs-5">Keamanan</div>
        </a>
        <a href="#" class="d-flex align-items-center mb-3 text-gray-800 my-7">
            <i class="far fa-clipboard fa-lg w-30px rounded-3 me-3"></i>
            <div class="fs-5">Kode Referral</div>
        </a>
        <a href="#" class="d-flex align-items-center mb-3 text-gray-800 my-7">
            <i class="far fa-credit-card fa-lg w-30px rounded-3 me-3"></i>
            <div class="fs-5">Refund Pembatalan</div>
        </a>
        <a href="#" class="d-flex align-items-center mb-3 text-gray-800 my-7">
            <i class="fa fa-headset fa-lg w-30px rounded-3 me-3"></i>
            <div class="fs-5">Pusat Bantuan</div>
        </a>
        <hr>
        <a href="#" class="d-flex align-items-center mb-3 text-gray-800 my-7">
            <i class="fa fa-sign-out-alt fa-lg w-30px rounded-3 me-3"></i>
            <div class="fs-5">Log Out</div>
        </a>
    </div>
</div>