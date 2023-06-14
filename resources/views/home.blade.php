@extends('layouts.web')

@section('content-web')
@include('layouts.include.carousel')

<!-- start::Menubar -->
@include('layouts.include.home.menu-bar')
<!-- end::Menubar -->

@include('layouts.include.home.favorite-hotel')

@include('layouts.include.home.explore-city')

@endsection

@push('add-script')
<script src="{{asset('assets/js/custom/noTelp.js')}}"></script>

<script>
  var dummyMenus = [
    {
      id: 0,
      isActive: true,
      code: "hotel",
      label: "Hotel",
      image: "../assets/media/products-categories/icon-hotel.png",
      imageHeader: "https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2532&q=80",
      titleHeader: "Cari dan book Hotel untuk hari spesialmu!",
      classImage: "w-40px"
    },{
      id: 1,
      isActive: false,
      code: "plane",
      label: "Pesawat",
      image: "../assets/media/products-categories/icon-plane.png",
      imageHeader: "https://plus.unsplash.com/premium_photo-1679758630312-a3d601c411d8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2064&q=80",
      titleHeader: "",
      classImage: "w-40px"
    },{
      id: 2,
      isActive: false,
      code: "train",
      label: "Kereta Api",
      image: "../assets/media/products-categories/icon-kai.png",
      imageHeader: "",
      titleHeader: "",
      classImage: "w-40px"
    },{
      id: 3,
      isActive: false,
      code: "bus",
      label: "Bus & Travel",
      image: "../assets/media/products-categories/icon-bus.png",
      imageHeader: "",
      titleHeader: "",
      classImage: "w-40px"
    },{
      id: 4,
      isActive: false,
      code: "attraction",
      label: "Rekreasi",
      image: "../assets/media/products-categories/icon-rekreasi.png",
      imageHeader: "",
      titleHeader: "",
      classImage: "w-40px"
    },{
      id: 5,
      isActive: false,
      code: "rent-car",
      label: "Rental Mobil",
      image: "../assets/media/products-categories/icon-mobil.png",
      imageHeader: "",
      titleHeader: "",
      classImage: "w-40px"
    },{
      id: 6,
      isActive: true,
      code: "hostel",
      label: "Hostel",
      image: "../assets/media/products-categories/icon-hostel.png",
      imageHeader: "https://plus.unsplash.com/premium_photo-1661963540233-94097ba21f27?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2062&q=80",
      titleHeader: "Cari dan book Hostel untuk harian, mingguan, bulanan disini!",
      classImage: "w-40px"
    },{
      id: 7,
      isActive: false,
      code: "pln",
      label: "PLN",
      image: "../assets/media/products-categories/icon-pln.png",
      imageHeader: "",
      titleHeader: "",
      classImage: "w-30px"
    },{
      id: 8,
      isActive: true,
      code: "bpjs",
      label: "BPJS",
      image: "../assets/media/products-categories/icon-bpjs.png",
      imageHeader: "https://images.unsplash.com/photo-1528642474498-1af0c17fd8c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1769&q=80",
      titleHeader: "Bayar BPJS sekarang lebih mudah melalui Travelsya!",
      classImage: "w-30px"
    },{
      id: 9,
      isActive: true,
      code: "pdam",
      label: "PDAM",
      image: "../assets/media/products-categories/icon-pdam.png",
      imageHeader: "https://images.unsplash.com/photo-1526599256864-6bedb9d7dfb5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1771&q=80",
      titleHeader: "Bayar PDAM sekarang lebih mudah melalui Travelsya!",
      classImage: "w-40px"
    },{
      id: 10,
      isActive: false,
      code: "bank-transfer",
      label: "Transfer Bank",
      image: "../assets/media/products-categories/icon-transfer.png",
      imageHeader: "",
      titleHeader: "",
      classImage: "w-40px"
    },{
      id: 11,
      isActive: false,
      code: "e-wallet",
      label: "E-Wallet",
      image: "../assets/media/products-categories/icon-wallet.png",
      imageHeader: "",
      titleHeader: "",
      classImage: "w-40px"
    },{
      id: 12,
      isActive: true,
      code: "pulsa",
      label: "Pulsa & Data",
      image: "../assets/media/products-categories/icon-pulsa.png",
      imageHeader: "https://plus.unsplash.com/premium_photo-1664195539623-e25ce8e8d64b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80",
      titleHeader: "Isi pulsa dan paket datamu disini!",
      classImage: "w-40px"
    },{
      id: 13,
      isActive: true,
      code: "tv",
      label: "TV Berbayar",
      image: "../assets/media/products-categories/icon-tv.png",
      imageHeader: "https://images.unsplash.com/photo-1595935736128-db1f0a261263?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2971&q=80",
      titleHeader: "Bayar TV kabel sekarang lebih mudah melalui Travelsya!",
      classImage: "w-30px"
    },{
      id: 14,
      isActive: true,
      code: "pajak",
      label: "Pajak",
      image: "../assets/media/products-categories/icon-pajak.png",
      imageHeader: "https://images.unsplash.com/photo-1598432439250-0330f9130e14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1770&q=80",
      titleHeader: "Bayar Pajak sekarang lebih mudah melalui Travelsya!",
      classImage: "w-30px"
    }
  ]

  var dummyCities = [
    {
      id: 0,
      name: 'balikpapan',
      label: 'Balikpapan'
    },{
      id: 1,
      name: 'bontang',
      label: 'Bontang'
    },{
      id: 2,
      name: 'samarinda',
      label: 'Samarinda'
    },{
      id: 3,
      name: 'sangatta',
      label: 'Sangatta'
    },{
      id: 4,
      name: 'tenggarong',
      label: 'Tenggarong'
    },{
      id: 5,
      name: 'banjarmasin',
      label: 'Banjarmasin'
    }
  ]

  var dummyExploreCities = [
    {
      id: 0,
      label: "Welcome to Bali",
      image: "https://service.travelsya.com/bahan/kota_1.png"
    },
    {
      id: 1,
      label: "Welcome to Yogyakarta",
      image: "https://service.travelsya.com/bahan/kota_2.png"
    },
    {
      id: 2,
      label: "Welcome to Jakarta",
      image: "https://service.travelsya.com/bahan/kota_3.png"
    },
    {
      id: 3,
      label: "Welcome to Surabaya",
      image: "https://service.travelsya.com/bahan/kota_4.png"
    },
    {
      id: 4,
      label: "Welcome to Bandung",
      image: "https://service.travelsya.com/bahan/kota_5.png"
    },
  ]

  var dummyFavoriteHotel = [
    {
      id: 0,
      label: "Hotel Mulia Jakarta",
      city: "Jakarta",
      image: "https://www.kayak.co.id/rimg/himg/ec/0f/60/ice-122686-64795234_3XL-516024.jpg",
      price: 1300000,
      realPrice: 825000,
      rate: 3,
      totalRate: 12
    },
    {
      id: 1,
      label: "Hotel Mulia Jakarta",
      city: "Jakarta",
      image: "https://www.kayak.co.id/rimg/himg/ec/0f/60/ice-122686-64795234_3XL-516024.jpg",
      price: 1300000,
      realPrice: 825000,
      rate: 3,
      totalRate: 12
    },
    {
      id: 2,
      label: "Hotel Mulia Jakarta",
      city: "Jakarta",
      image: "https://www.kayak.co.id/rimg/himg/ec/0f/60/ice-122686-64795234_3XL-516024.jpg",
      price: 1300000,
      realPrice: 825000,
      rate: 3,
      totalRate: 12
    },
    {
      id: 3,
      label: "Hotel Mulia Jakarta",
      city: "Jakarta",
      image: "https://www.kayak.co.id/rimg/himg/ec/0f/60/ice-122686-64795234_3XL-516024.jpg",
      price: 1300000,
      realPrice: 825000,
      rate: 3,
      totalRate: 12
    }
  ]

  document.addEventListener('alpine:init', () => {
    Alpine.data('menubar', () => ({
      menus: dummyMenus,
      mode: {}, 
      handleClickMenu(data) {
        this.mode = data
      },
    })),
    Alpine.data('hotel', () => ({
      cities: dummyCities
    })),
    Alpine.data('explorecity', () => ({
      exploreCities: dummyExploreCities
    })),
    Alpine.data('favoritehotel', () => ({
      favoriteHotel: dummyFavoriteHotel
    }))
  })

  $(document).ready(function() {
    var today = new Date(); 
    $('.js-daterangepicker').daterangepicker({
      minDate:today,
    });
    const {
      getOperator
    } = window.NoTelp;
    $('.notelp').on('keyup', function(e) {
        var cat = $(this).data('cat');
        var notelp = e.target.value;
        var operatorTelp1 = getOperator(notelp);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        if (operatorTelp1.valid) {
            $.ajax({
                url: "{{ url('/ajax/ppob') }}",
                type: "POST",
                dataType: 'json',
                data: {
                    operator: operatorTelp1.operator,
                    category: cat
                },
                success: function(response) {

                    if (response.message != 'Unauthorized') {
                        if (cat == "pulsa")
                            $('#row-pricelist-pulsa').html('');

                        if (cat == "data")
                            $('#row-pricelist-data').html('');


                        $.each(response, function(key, val) {
                            if (cat == "pulsa") {

                                $('#row-pricelist-pulsa').append(
                                    `<option value="${val.id}">${val.description} - ${val.price}</option>`
                                )
                            }
                            if (cat == "data") {

                                $('#row-pricelist-data').append(
                                    `<option value="${val.id}">${val.description} - ${val.price}</option>`
                                )
                            }

                        });
                    } else {
                        `<option value=0>Login First</option>`
                    }
                }
            })
        }
    })

  })
</script>
@endpush