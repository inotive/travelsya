        {{-- Kolom Kiri (Menu) --}}
        <style>
            .group-point-ini-guys {
                border: 3px solid transparent;
                border-radius: 8px;
                transition: border-color 0.3s ease, border-radius 0.3s ease;
            }


            .group-point-ini-guys:hover {
                border-color: #FF7E99;
                border-radius: 12px;
                cursor: pointer;
                color: red;
            }

            a.menu-link {
                text-decoration: none;
                color: black;
            }

            /* Gaya saat tautan di-hover */
            a.menu-link:hover {
                color: red;
            }

            .profile-points-active {
                border-color: #FF7E99;
                border-radius: 12px;
            }
        </style>
        <div class="col-12 col-lg-3 offset-lg-1 mb-10">
            <div class="card">
                {{-- Card Bagian Body --}}
                <div class="card-body">
                    {{-- Nama User --}}
                    <div class="card-title mb-5">
                        <h3>
                            <b>
                                {{ Auth::user()->name }}
                            </b>
                        </h3>
                    </div>
                    {{-- end Nama User --}}

                    {{-- Menu Item Start --}}

                    {{-- Bagian Poin --}}
                    <div class="group-point-ini-guys d-flex {{ request()->is('profile/points') ? 'profile-points-active' : '' }}"
                        onclick="window.location.href = '{{ route('user.points') }}';">
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('user.points') }}">
                                <span class="menu-icon">
                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_3_29068)">
                                            <path
                                                d="M17.6396 14.4767C18.735 13.0485 19.3301 11.2998 19.333 9.5V11.5C19.3298 13.2842 18.7446 15.0186 17.6663 16.4399V14.5L17.6396 14.4767Z"
                                                fill="#CE893D" />
                                            <path
                                                d="M17.6667 14.4998V16.4398C17.1903 17.078 16.6296 17.6488 16 18.1366V16.1665L15.9834 16.1465C16.6076 15.6662 17.1647 15.1045 17.64 14.4766L17.6667 14.4998Z"
                                                fill="#E6A71E" />
                                            <path
                                                d="M10.0003 0.833496C15.1536 0.833496 19.3337 4.71354 19.3337 9.50016C19.3307 11.3 18.7357 13.0487 17.6403 14.4769C17.165 15.1048 16.6079 15.6665 15.9837 16.1468C15.4723 16.5487 14.9191 16.894 14.3337 17.1768C13.6952 17.4881 13.0246 17.7285 12.3337 17.8936C10.7995 18.258 9.20117 18.258 7.66699 17.8936C6.97607 17.7285 6.3055 17.4881 5.66699 17.1768C5.08154 16.894 4.52832 16.5487 4.01693 16.1468C3.39274 15.6665 2.83561 15.1048 2.36035 14.4769C1.26497 13.0487 0.669922 11.3 0.666992 9.50016C0.666992 4.71354 4.84701 0.833496 10.0003 0.833496Z"
                                                fill="#FFCB5A" />
                                            <path
                                                d="M15.9997 16.1665V18.1366C15.4844 18.5413 14.9268 18.8888 14.3363 19.1732L14.333 19.1665V17.1764C14.9185 16.8937 15.4717 16.5483 15.9831 16.1465L15.9997 16.1665Z"
                                                fill="#CE893D" />
                                            <path
                                                d="M14.333 19.1668L14.3363 19.1735C13.7013 19.4849 13.034 19.7251 12.3464 19.8901L12.333 19.8335V17.8936C13.0239 17.7285 13.6945 17.4881 14.333 17.1768V19.1668Z"
                                                fill="#E6A71E" />
                                            <path
                                                d="M12.3467 19.8901C11.578 20.0744 10.7904 20.1672 10 20.1668V18.1668C10.7858 18.1683 11.5692 18.0765 12.3333 17.8936V19.8335L12.3467 19.8901Z"
                                                fill="#CE893D" />
                                            <path
                                                d="M10 18.1668V20.1668C9.20964 20.1672 8.42204 20.0744 7.65332 19.8901L7.66667 19.8335V17.8936C8.43083 18.0765 9.21419 18.1683 10 18.1668Z"
                                                fill="#E6A71E" />
                                            <path
                                                d="M7.66634 17.8936V19.8335L7.65299 19.8901C6.96533 19.7251 6.29801 19.4849 5.66309 19.1735L5.66634 19.1668V17.1768C6.30485 17.4881 6.97542 17.7285 7.66634 17.8936Z"
                                                fill="#CE893D" />
                                            <path
                                                d="M4.0166 16.1465C4.52799 16.5483 5.08122 16.8937 5.66667 17.1764V19.1665L5.66341 19.1732C5.07373 18.8877 4.51611 18.5402 4 18.1366V16.1665L4.0166 16.1465Z"
                                                fill="#E6A71E" />
                                            <path
                                                d="M2.3597 14.4766C2.83496 15.1045 3.39209 15.6662 4.01628 16.1465L3.99967 16.1665V18.1366C3.37012 17.6488 2.80941 17.078 2.33301 16.4398V14.4998L2.3597 14.4766Z"
                                                fill="#CE893D" />
                                            <path
                                                d="M0.666992 9.5C0.669922 11.2998 1.26497 13.0485 2.36035 14.4767L2.33366 14.5V16.4399C1.25537 15.0186 0.670247 13.2842 0.666992 11.5V9.5Z"
                                                fill="#E6A71E" />
                                            <path
                                                d="M17.3337 9.50016C17.3337 5.8182 14.0505 2.8335 10.0003 2.8335C5.9502 2.8335 2.66699 5.8182 2.66699 9.50016C2.66699 13.1821 5.9502 16.1668 10.0003 16.1668C14.0505 16.1668 17.3337 13.1821 17.3337 9.50016Z"
                                                fill="#E6A71E" />
                                            <path
                                                d="M14.5807 13.4095L14.125 12.9235C14.5145 12.5605 14.8446 12.1385 15.1027 11.6729L15.6867 11.9935C15.3952 12.521 15.0218 12.999 14.5807 13.4095Z"
                                                fill="#FFCB5A" />
                                            <path
                                                d="M10.0003 15.1668C6.50798 15.1668 3.66699 12.6248 3.66699 9.50016C3.66699 6.37549 6.50798 3.8335 10.0003 3.8335C13.4927 3.8335 16.3337 6.37549 16.3337 9.50016H15.667C15.667 6.74316 13.125 4.50016 10.0003 4.50016C6.87565 4.50016 4.33366 6.74316 4.33366 9.50016C4.33366 12.2572 6.87565 14.5002 10.0003 14.5002C11.1123 14.5055 12.2049 14.2106 13.1629 13.6462L13.5044 14.2192C12.443 14.8449 11.2324 15.1724 10.0003 15.1668Z"
                                                fill="#FFCB5A" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_3_29068">
                                                <rect width="20" height="20" fill="white"
                                                    transform="translate(0 0.5)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </span>
                                <div class="ini-pemersatu" style="margin-left: 16px">
                                    <div
                                        class=" fs-8 {{ request()->is('profile/points') ? 'fw-bold text-danger' : 'text-gray-500' }}">
                                        Points Anda</div>
                                    <span
                                        class="fw-medium fs-4 menu-title {{ request()->is('profile/points') ? 'fw-bold text-danger' : 'text-black' }}">
                                        <b>
                                            {{ number_format(auth()->user()->point, 0, ',', '.') }}
                                        </b>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                    {{-- End Bagian Poin --}}

                    {{-- Start Bagian e-Wallet --}}
                    <div class="group-wallet-ini-guys d-flex">
                        <div class="menu-item">
                            <div class="menu-link">
                                <span class="menu-icon">
                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.5 7.375H18.75V6.125C18.75 5.2962 18.4208 4.50134 17.8347 3.91529C17.2487 3.32924 16.4538 3 15.625 3H4.375C3.5462 3 2.75134 3.32924 2.16529 3.91529C1.57924 4.50134 1.25 5.2962 1.25 6.125V14.875C1.25 15.7038 1.57924 16.4987 2.16529 17.0847C2.75134 17.6708 3.5462 18 4.375 18H15.625C16.4538 18 17.2487 17.6708 17.8347 17.0847C18.4208 16.4987 18.75 15.7038 18.75 14.875V13.625H12.5C11.6712 13.625 10.8763 13.2958 10.2903 12.7097C9.70424 12.1237 9.375 11.3288 9.375 10.5C9.375 9.6712 9.70424 8.87634 10.2903 8.29029C10.8763 7.70424 11.6712 7.375 12.5 7.375ZM12.5 8.625C12.0027 8.625 11.5258 8.82254 11.1742 9.17417C10.8225 9.52581 10.625 10.0027 10.625 10.5C10.625 10.9973 10.8225 11.4742 11.1742 11.8258C11.5258 12.1775 12.0027 12.375 12.5 12.375H18.75V8.625H12.5ZM12.5 11.75C12.2528 11.75 12.0111 11.6767 11.8055 11.5393C11.6 11.402 11.4398 11.2068 11.3451 10.9784C11.2505 10.7499 11.2258 10.4986 11.274 10.2561C11.3222 10.0137 11.4413 9.79093 11.6161 9.61612C11.7909 9.4413 12.0137 9.32225 12.2561 9.27402C12.4986 9.22579 12.7499 9.25054 12.9784 9.34515C13.2068 9.43976 13.402 9.59998 13.5393 9.80554C13.6767 10.0111 13.75 10.2528 13.75 10.5C13.75 10.8315 13.6183 11.1495 13.3839 11.3839C13.1495 11.6183 12.8315 11.75 12.5 11.75Z"
                                            fill="#FF8F00" />
                                        <path
                                            d="M18.7504 6.125V7.375H16.8754C16.7082 6.51657 16.4221 5.68565 16.0254 4.90625C15.6833 4.23464 15.2638 3.60536 14.7754 3.03125H15.6254C16.4488 3.03121 17.239 3.35616 17.8241 3.93547C18.4093 4.51477 18.7422 5.30163 18.7504 6.125Z"
                                            fill="#FF6F00" />
                                        <path
                                            d="M17.0436 8.625H18.7498V12.375H16.5186C16.9429 11.1728 17.1215 9.89755 17.0436 8.625Z"
                                            fill="#FF6F00" />
                                        <path
                                            d="M15.9689 13.625H18.7502V14.875C18.7502 15.7038 18.421 16.4987 17.8349 17.0847C17.2489 17.6708 16.454 18 15.6252 18H11.1689C11.4002 17.9062 11.6314 17.8 11.8564 17.6875C13.6187 16.7972 15.0571 15.3763 15.9689 13.625Z"
                                            fill="#FF6F00" />
                                    </svg>
                                </span>
                                <div class="ini-pemersatu" style="margin-left: 16px">
                                    <div class="text-gray-500 fs-8">e-Wallet</div>
                                    <span class=" fw-medium fs-4 menu-title">
                                        <b class="text-danger">
                                            {{-- {{ number_format(auth()->user()->point, 0,',','.') }} --}}
                                            Coming Soon
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
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                                        stroke="{{ request()->is('profile') ? '#C02425' : '#A5A5A5' }}" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                        stroke="{{ request()->is('profile') ? '#C02425' : '#A5A5A5' }}" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <span style="margin-left: 16px;"
                                class="menu-title {{ request()->is('profile') ? 'fw-bold text-danger' : 'text-black' }}">
                                Profil Saya
                            </span>
                        </a>
                    </div>

                    {{-- Menu Item Riwayat Pesanan --}}
                    <div class="menu-item">
                        <a class="menu-link text-gray-900" href="{{ route('user.orderHistory') }}">
                            <span class="menu-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16 4H18C18.5304 4 19.0391 4.21071 19.4142 4.58579C19.7893 4.96086 20 5.46957 20 6V20C20 20.5304 19.7893 21.0391 19.4142 21.4142C19.0391 21.7893 18.5304 22 18 22H6C5.46957 22 4.96086 21.7893 4.58579 21.4142C4.21071 21.0391 4 20.5304 4 20V6C4 5.46957 4.21071 4.96086 4.58579 4.58579C4.96086 4.21071 5.46957 4 6 4H8"
                                        stroke="{{ request()->is('profile/order-history*') ? '#C02425' : '#A5A5A5' }}"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M15 2H9C8.44772 2 8 2.44772 8 3V5C8 5.55228 8.44772 6 9 6H15C15.5523 6 16 5.55228 16 5V3C16 2.44772 15.5523 2 15 2Z"
                                        stroke="{{ request()->is('profile/order-history*') ? '#C02425' : '#A5A5A5' }}"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <span style="margin-left: 16px;"
                                class="menu-title {{ request()->is('profile/order-history*') ? 'fw-bold text-danger' : '' }}">
                                Riwayat Pesanan</b>
                            </span>
                        </a>
                    </div>
                    {{-- Menu Item --}}
                    <div class="menu-item">
                        <a class="menu-link text-gray-900"
                            href="https://api.whatsapp.com/send?phone=628115417708&text=Halo%20min%2C%20transaksi%20saya%20gagal%20mohon%20bantuan%20refund"
                            target="_blank">
                            <span class="menu-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21 4H3C1.89543 4 1 4.89543 1 6V18C1 19.1046 1.89543 20 3 20H21C22.1046 20 23 19.1046 23 18V6C23 4.89543 22.1046 4 21 4Z"
                                        stroke="#A5A5A5" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M1 10H23" stroke="#A5A5A5" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                            <span style="margin-left: 16px" class="menu-title">
                                Refund & Pembatalan
                            </span>
                        </a>
                    </div>
                    {{-- Menu Item Pusat Bantuan --}}
                    <div class="menu-item">
                        <a class="menu-link text-gray-900" href="{{ route('user.help') }}">
                            <span class="menu-icon">
                                {{-- <img src="{{ asset('assets/media/svg/profile-account/headphones-active.svg') }}"
                                    class="h-24px me-10" /> --}}
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3 18V12C3 9.61305 3.94821 7.32387 5.63604 5.63604C7.32387 3.94821 9.61305 3 12 3C14.3869 3 16.6761 3.94821 18.364 5.63604C20.0518 7.32387 21 9.61305 21 12V18"
                                        stroke="{{ request()->is('profile/help') ? '#C02425' : '#A5A5A5' }}"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M21 19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H18C17.4696 21 16.9609 20.7893 16.5858 20.4142C16.2107 20.0391 16 19.5304 16 19V16C16 15.4696 16.2107 14.9609 16.5858 14.5858C16.9609 14.2107 17.4696 14 18 14H21V19ZM3 19C3 19.5304 3.21071 20.0391 3.58579 20.4142C3.96086 20.7893 4.46957 21 5 21H6C6.53043 21 7.03914 20.7893 7.41421 20.4142C7.78929 20.0391 8 19.5304 8 19V16C8 15.4696 7.78929 14.9609 7.41421 14.5858C7.03914 14.2107 6.53043 14 6 14H3V19Z"
                                        stroke="{{ request()->is('profile/help') ? '#C02425' : '#A5A5A5' }}"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <span style="margin-left: 16px;"
                                class="menu-title {{ request()->is('profile/help') ? 'fw-bold text-danger' : '' }}">
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
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9"
                                        stroke="#A5A5A5" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M16 17L21 12L16 7" stroke="#A5A5A5" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M21 12H9" stroke="#A5A5A5" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                            <span style="margin-left: 16px">
                                Log out
                            </span>
                            @include('user.logout')
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Kolom Kiri --}}
