<!--begin::Container-->
<div class="container-xl d-flex align-items-center">
    <!--begin::Heaeder menu toggle-->
    <div class="d-flex topbar align-items-center d-lg-none ms-n2 me-3" title="Show aside menu">
        <div class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px" id="kt_header_menu_mobile_toggle">
            <i class="ki-duotone ki-abstract-14 fs-1"><span class="path1"></span><span class="path2"></span></i>
        </div>
    </div>
    <!--end::Heaeder menu toggle-->

    <!--begin::Header Logo-->
    <div class="header-logo me-5 me-md-10 flex-grow-1 flex-lg-grow-0 mt-3 mb-3">
        <a href="{{route('home')}}">
            <img alt="Logo" src="{{asset('assets/media/logos/logo.png')}}" class="logo-default h-40px" />
            <img alt="Logo" src="{{asset('assets/media/logos/logo.png')}}" class="logo-sticky h-40px" />
        </a>
    </div>
    <!--end::Header Logo-->

    <!--begin::Wrapper-->
    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
        <!--begin::Navbar-->
        <div class="d-flex align-items-stretch" id="kt_header_nav">

            <!--begin::Menu wrapper-->
            <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                <!--begin::Menu-->
                <div class="menu menu-rounded menu-column menu-lg-row menu-active-bg menu-title-gray-700 menu-state-primary menu-arrow-gray-400 fw-semibold my-5 my-lg-0 align-items-stretch px-2 px-lg-0" id="#kt_header_menu" data-kt-menu="true">
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item here me-0 me-lg-2">
                        <!--begin:Menu link-->
                        <!-- <span class="menu-link py-3"><span class="menu-title">Transaksi</span><span class="menu-arrow d-lg-none"></span></span> -->
                        <!--end:Menu link--><!--begin:Menu sub-->
                    </div><!--end:Menu item--><!--begin:Menu item-->
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Menu wrapper-->

        </div>
        <!--end::Navbar-->


        <!--begin::Toolbar wrapper-->
        <div class="topbar d-flex align-items-stretch flex-shrink-0">


            <!--begin::Theme mode-->
            <div class="d-flex align-items-center ms-1 ms-lg-3">

                <!--begin::Menu toggle-->
                <a href="#" class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                    <i class="ki-duotone ki-night-day theme-light-show fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></i> <i class="ki-duotone ki-moon theme-dark-show fs-1"><span class="path1"></span><span class="path2"></span></i></a>
                <!--begin::Menu toggle-->

                <!--begin::Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3 my-0">
                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                            <span class="menu-icon" data-kt-element="icon">
                                <i class="ki-duotone ki-night-day fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></i>
                            </span>
                            <span class="menu-title">
                                Light
                            </span>
                        </a>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item-->
                    <div class="menu-item px-3 my-0">
                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                            <span class="menu-icon" data-kt-element="icon">
                                <i class="ki-duotone ki-moon fs-2"><span class="path1"></span><span class="path2"></span></i> </span>
                            <span class="menu-title">
                                Dark
                            </span>
                        </a>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item-->
                    <div class="menu-item px-3 my-0">
                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                            <span class="menu-icon" data-kt-element="icon">
                                <i class="ki-duotone ki-screen fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i> </span>
                            <span class="menu-title">
                                System
                            </span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::Menu-->

            </div>
            <!--end::Theme mode-->

            <!--begin::User-->
            @if(Auth::check())
            <div class="d-flex align-items-center me-lg-n2 ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                <!--begin::Menu wrapper-->
                <div class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                    <div class="symbol symbol-30px">
                        <div class="symbol-label fs-2 fw-bold bg-white text-danger">
                            {{-- {{ substr( Auth::user()->name, 0,1 ) }} --}}
                            <img class="h-30px w-30px rounded" src="{{ auth()->user()->image != null ? asset('storage/users/' . auth()->user()->image) : asset('assets/img/default-company.png') }}" alt="" />
                        </div>
                    </div>
                </div>

                <!--begin::User account menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">

                            <!--begin::Username-->
                            <div class="d-flex flex-column">
                                {{ Auth::user()->name }}
{{--                                    <li class="nav-item dropdown">--}}
{{--                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                                            --}}
{{--                                        </a>--}}

{{--                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">--}}
{{--                                            <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                               onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                                {{ __('Logout') }}--}}
{{--                                            </a>--}}

{{--                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                                                @csrf--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                @endguest--}}
{{--                               ` <div class="fw-bold d-flex align-items-center fs-5">--}}
{{--                                    {{(session()->get('user')) ? session()->get('user')['data']['name'] : '' }} <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span>--}}
{{--                                </div>--}}
`
                                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">
                                    {{(session()->get('user')) ? session()->get('user')['data']['email'] : '' }}</a>
                            </div>
                            <!--end::Username-->
                        </div>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->

                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <a href="{{route('user.profile')}}" class="menu-link px-5">
                            Akun Saya
                        </a>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <a href="{{route('user.orderHistory')}}" class="menu-link px-5">
                            Riwayat Transaksi
                        </a>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->

                    <!--begin::Menu item-->
                    <div class="menu-item px-5">

                        <a href="{{route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="menu-link px-5">
                            Sign Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::User account menu-->
                <!--end::Menu wrapper-->
            </div>
            @else
            <div class="d-flex align-items-center me-lg-n2 ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                <a class="text-white" href="{{route('login')}}">Login</a>
            </div>
            @endif
            <!--end::User -->

            <!--begin::Aside mobile toggle-->
            <!--end::Aside mobile toggle-->
        </div>
        <!--end::Toolbar wrapper-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Container-->
