<title>Traveslya Indonesia</title>
<meta charset="utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="article" />
<meta property="og:title" content="" />
<meta property="og:url" content="" />
<meta property="og:site_name" content="K" />
<link rel="canonical" href="" />
<link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
<meta name="csrf-token" content="{{ csrf_token() }}">


<!--begin::Fonts(mandatory for all pages)-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
<!--end::Fonts-->

<!--begin::Vendor Stylesheets(used for this page only)-->
<link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

<!--end::Vendor Stylesheets-->


<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
{{--
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" />
<!--end::Global Stylesheets Bundle-->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- begin:: Style swiper -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<!-- end:: Style swiper -->

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.3/dist/cdn.min.js"></script>
<style>
    body#kt_body {
        background-color: unset;
        background-image: unset;
    }

    .main {
        grid-area: main;
        padding: 0;
        overflow-x: scroll;
        overflow-y: hidden;
    }

    .bg-main {
        background-color: #C02425 !important;
    }

    .border-left-round {
        border-left: 1px solid var(--bs-gray-300);
        border-top: 1px solid var(--bs-gray-300);
        border-bottom: 1px solid var(--bs-gray-300);
        border-radius: 50px 0 0 50px;
    }

    .border-right-none {
        border-right: none;
    }

    input.search-input {
        border: none;
        border-top: 1px solid var(--bs-gray-300);
        border-bottom: 1px solid var(--bs-gray-300);
        border-right: 1px solid var(--bs-gray-300);
        border-radius: 0 50px 50px 0;
        width: 310px !important;
    }

    .text-main {
        color: #C02425 !important;
    }

    .second-nav {
        height: 80px;
    }

    .second-nav .container {
        height: 80px;
        ;
    }

    .hero-item-wrapper {
        top: 0;
        height: 100%;
        background: #00000063;
    }

    .badge-custom-hero {
        backdrop-filter: blur(16px);
        padding: 12px 15px;
        color: #fff;
        border-radius: 50px;
        overflow: hidden;
        font-size: 16px;
        background-color: #ffffff47;
    }

    .section-title .title {
        font-size: 24px;
        font-weight: 700;
    }

    .section-title .subtitle {
        font-size: 18px;
        color: #A5A5A5;
    }

    .icon-wrapper {
        height: 30px;
        width: 30px;
        padding: 5px;
        overflow: hidden;
        border-radius: 50%;
    }

    .banner-title {
        padding-left: 10%;
        align-items: flex-start;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .banner-search {
        align-items: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .banner-text-title {
        font-size: 40px;
    }

    .items {
        width: 100%;
        overflow-x: scroll;
        overflow-y: hidden;
        white-space: nowrap;
        transition: all 0.2s;
        transform: scale(0.98);
        will-change: transform;
        user-select: none;
        cursor: pointer;
    }

    .items.active {
        background: rgba(255, 255, 255, 0.3);
        cursor: grabbing;
        cursor: -webkit-grabbing;
        transform: scale(1);
    }

    .menu-user a:hover {
        color: #C02425 !important;
    }

    .menu-user a.active {
        color: #C02425 !important;
    }

    /* .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
        } */

    a.disabled {
        pointer-events: none;
        cursor: default;
    }

    .custom-dot-before::before {
        content: ". ";
        margin-left: 5px;
    }

    .custom-dot-after::after {
        content: " .";
        margin-right: 5px;
    }

    .mb-35px {
        margin-bottom: 35px !important;
    }

    .mb-25px {
        margin-bottom: 25px !important;
    }

    .btn-gray-carousel {
        background-color: lightgray !important;
        color: black !important;
    }

    .btn-gray-carousel:hover {
        background-color: pink !important;
        color: red !important;
    }

    .object-fit-contain {
        object-fit: contain !important;
    }

    .card-img-top-rounded {
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
    }

    .card-img-bottom-rounded {
        border-bottom-left-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
    }

    .carousel-tab {
        background-color: rgba(0, 0, 0, 0.50);
        border-radius: 10px;
        padding: 10px 20px;
    }

    .nav-line-tabs .nav-item .nav-link.active,
    .nav-line-tabs .nav-item.show .nav-link,
    .nav-line-tabs .nav-item .nav-link:hover:not(.disabled) {
        color: #C02425;
        border-bottom: 1px solid #C02425 !important;
    }

    .border-none {
        border: none !important;
    }

    .border-bottom-none {
        border-bottom: none !important;
    }

    .border-top-none {
        border-top: none !important;
    }

    .border-left-none {
        border-left: none !important;
    }

    .border-right-none {
        border-right: none !important;
    }

    .border-radius-bottom-left-none {
        border-bottom-left-radius: 0 !important;
    }

    .border-radius-top-left-none {
        border-top-left-radius: 0 !important;
    }

    .hr-line {
        color: #928b8b;
        border-left: 46px solid #fff;
    }

    .wrapper-search {
        align-items: center;
        justify-content: end;
        position: absolute;
        z-index: 999;
        top: 30%;
        width: 100%;
        right: 11px;
    }
    .bus-icon{
        background: #C02425;
        text-align: center;
        border-radius: 50px;
        background: #C02425;
        text-align: center;
        border-radius: 50px;
        padding: 3px 7px;
    }
    .shape-round-big{
        height: 100px;
        width: 100px;
        background-color: #FFEEF1;
        border-radius: 50px;
        position: absolute;
        right: -30px;
        top: -53px;
    }
    .shape-round-small{
        height: 34px;
        width: 34px;
        background-color: #FFBDBE;
        border-radius: 50px;
        position: absolute;
        top: 27px;
        right: -16px;
    }
    .bg-light{
        background: #fff !important;
    }
    .max-w-100{
        max-width: 100px;
    }
    .max-w-120{
        max-width: 120px;
    }
    .max-w-150{
        max-width: 150px;
    }
    .max-w-50{
        max-width: 50px;
    }
    .border-right-2{
        border-right: 2px solid #928b8b !important;
    }
    .round{
        border-radius: 50px;
    }
    .badge-secondary.badge-outline {
        border: 1px solid #989898 !important;
        color: #989898 !important;
        background-color: transparent;
    }
    .mb-50{
        margin-bottom: 50px !important;
    }
</style>
<style>
    .item-menubar {
        cursor: pointer;
    }

    .child-item-menubar {
        display: flex;
        background: url("./assets/media/bg-icon-menubar.png") no-repeat center center;
        background-size: 72px 72px;
        -webkit-box-pack: center;
        justify-content: center;
        align-items: center;
        width: 72px;
        height: 72px;
        margin: 0 auto;
    }

    .item-label {
        flex: 1;
        align-self: center;
        white-space: pre-wrap;
        word-break: keep-all;
        word-wrap: break-word;
        text-overflow: ellipsis;
        overflow: hidden;
        width: 100%;
        text-align: left;
        margin-left: 1.2em;
    }

    .header-image {
        border-radius: 0px;
        background: linear-gradient(to right, rgba(44, 4, 4, 0.73), rgba(245, 246, 252, 0.52)),
            url("https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2532&q=80") no-repeat center center;
        background-size: cover;
        border-bottom-left-radius: 4em;
        border-bottom-right-radius: 4em;
    }

    @media (max-width: 767px) {
        .item-label {
            margin-left: 0px;
            text-align: center;
        }
    }

    @-webkit-keyframes come-in {
        0% {
            -webkit-transform: translatey(100px);
            transform: translatey(100px);
            opacity: 0;
        }

        30% {
            -webkit-transform: translateX(-50px) scale(0.4);
            transform: translateX(-50px) scale(0.4);
        }

        70% {
            -webkit-transform: translateX(0px) scale(1.2);
            transform: translateX(0px) scale(1.2);
        }

        100% {
            -webkit-transform: translatey(0px) scale(1);
            transform: translatey(0px) scale(1);
            opacity: 1;
        }
    }

    @keyframes come-in {
        0% {
            -webkit-transform: translatey(100px);
            transform: translatey(100px);
            opacity: 0;
        }

        30% {
            -webkit-transform: translateX(-50px) scale(0.4);
            transform: translateX(-50px) scale(0.4);
        }

        70% {
            -webkit-transform: translateX(0px) scale(1.2);
            transform: translateX(0px) scale(1.2);
        }

        100% {
            -webkit-transform: translatey(0px) scale(1);
            transform: translatey(0px) scale(1);
            opacity: 1;
        }
    }

    .floating-container {
        position: fixed;
        width: 100px;
        height: 100px;
        bottom: 0;
        right: 0;
        margin: 35px 25px;
    }

    .floating-container:hover {
        height: 300px;
    }

    .floating-container:hover .floating-button {
        box-shadow: 0 10px 25px rgba(105, 0, 0, 0.6);
        -webkit-transform: translatey(5px);
        transform: translatey(5px);
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
    }

    .floating-container:hover .element-container .float-element:nth-child(1) {
        -webkit-animation: come-in 0.4s forwards 0.2s;
        animation: come-in 0.4s forwards 0.2s;
    }

    .floating-container:hover .element-container .float-element:nth-child(2) {
        -webkit-animation: come-in 0.4s forwards 0.4s;
        animation: come-in 0.4s forwards 0.4s;
    }

    .floating-container:hover .element-container .float-element:nth-child(3) {
        -webkit-animation: come-in 0.4s forwards 0.6s;
        animation: come-in 0.4s forwards 0.6s;
    }

    .floating-container .floating-button {
        position: absolute;
        width: 65px;
        height: 65px;
        background: #C02425;
        bottom: 0;
        border-radius: 50%;
        left: 0;
        right: 0;
        margin: auto;
        color: white;
        line-height: 65px;
        text-align: center;
        font-size: 23px;
        z-index: 100;
        box-shadow: 0 10px 25px -5px rgba(105, 0, 0, 0.6);
        cursor: pointer;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
    }

    .floating-container .float-element {
        position: relative;
        display: block;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        margin: 15px auto;
        color: white;
        font-weight: 500;
        text-align: center;
        line-height: 50px;
        z-index: 0;
        opacity: 0;
        -webkit-transform: translateY(100px);
        transform: translateY(100px);
    }

    .floating-container .float-element .material-icons {
        vertical-align: middle;
        font-size: 16px;
    }

    .floating-container .float-element:nth-child(1) {
        background: #42A5F5;
        box-shadow: 0 20px 20px -10px rgba(66, 165, 245, 0.5);
    }

    .floating-container .float-element:nth-child(2) {
        background: #4CAF50;
        box-shadow: 0 20px 20px -10px rgba(76, 175, 80, 0.5);
    }

    .floating-container .float-element:nth-child(3) {
        background: #FF9800;
        box-shadow: 0 20px 20px -10px rgba(255, 152, 0, 0.5);
    }

    .dashed {
        border: 1px dashed #000;
    }

    .border-bottom-dashed {
        border-bottom: 1px dashed #000;
    }

    .swiper-container {
        width: 100%;
        max-width: 1200px;
    }

    .swiper-slide {
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swiper-slide img {
        max-width: 100%;
        border-radius: 10px;
    }

</style>
@stack('add-style')
{{-- @vite(['resources/js/app.js']) --}}