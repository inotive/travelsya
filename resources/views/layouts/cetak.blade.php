<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>Travelsya</title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <link rel="canonical" href="" />

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="{{ url('https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700') }}" />
    <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <style type="text/css" media="print">
        * {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    </style>


</head>
<div class="container">
    @yield('content')
        
</div>
<script>
    let intervalId;

    function autoPrint() {
        window.print();
    }

    intervalId = setInterval(autoPrint, 5000);

    setTimeout(function() {
        clearInterval(intervalId);
    }, 8000);
</script>
</body>
</html>
<!--end::Body-->