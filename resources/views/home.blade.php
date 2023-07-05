@extends('layouts.web') @section('content-web')
@include('layouts.include.carousel')

<!-- start::Menubar -->
@include('layouts.include.home.menu-bar')
<!-- end::Menubar -->

@include('layouts.include.home.favorite-hotel')
@include('layouts.include.home.explore-city') @endsection @push('add-script')
<script src="{{ asset('assets/js/custom/noTelp.js') }}"></script>

<script>
	var dummyMenus = [
		{
			id: 0,
			isActive: true,
			code: "hotel",
			label: "Hotel",
			image: "../assets/media/products-categories/icon-hotel.png",
			imageHeader:
				"https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2532&q=80",
			titleHeader: "Cari dan book Hotel untuk hari spesialmu!",
			classImage: "w-40px",
		},
		{
			id: 6,
			isActive: true,
			code: "hostel",
			label: "Hostel",
			image: "../assets/media/products-categories/icon-hostel.png",
			imageHeader:
				"https://plus.unsplash.com/premium_photo-1661963540233-94097ba21f27?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2062&q=80",
			titleHeader:
				"Cari dan book Hostel untuk harian, mingguan, bulanan disini!",
			classImage: "w-40px",
		},
		{
			id: 16,
			isActive: true,
			code: "attraction",
			label: "Rekreasi",
			image: "../assets/media/products-categories/icon-rekreasi.png",
			imageHeader:
				"https://images.unsplash.com/photo-1535764558463-30f3af596bee?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1771&q=80",
			titleHeader: "Cari destinasi rekreasi anda disini!",
			classImage: "w-45px",
		},
		{
			id: 8,
			isActive: true,
			code: "bpjs",
			label: "BPJS",
			image: "../assets/media/products-categories/icon-bpjs.png",
			imageHeader:
				"https://images.unsplash.com/photo-1528642474498-1af0c17fd8c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1769&q=80",
			titleHeader: "Bayar BPJS sekarang lebih mudah melalui Travelsya!",
			classImage: "w-30px",
		},
		{
			id: 7,
			isActive: true,
			code: "pln",
			label: "PLN",
			image: "../assets/media/products-categories/icon-pln.png",
			imageHeader: "",
			titleHeader: "",
			classImage: "w-30px",
		},
		{
			id: 9,
			isActive: true,
			code: "pdam",
			label: "PDAM",
			image: "../assets/media/products-categories/icon-pdam.png",
			imageHeader:
				"https://images.unsplash.com/photo-1526599256864-6bedb9d7dfb5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1771&q=80",
			titleHeader: "Bayar PDAM sekarang lebih mudah melalui Travelsya!",
			classImage: "w-40px",
		},
		{
			id: 11,
			isActive: true,
			code: "e-wallet",
			label: "E-Wallet",
			image: "../assets/media/products-categories/icon-wallet.png",
			imageHeader: "",
			titleHeader: "",
			classImage: "w-40px",
		},
		{
			id: 12,
			isActive: true,
			code: "pulsa-data",
			label: "Pulsa & Data",
			image: "../assets/media/products-categories/icon-pulsa.png",
			imageHeader:
				"https://plus.unsplash.com/premium_photo-1664195539623-e25ce8e8d64b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80",
			titleHeader: "Isi pulsa dan paket datamu disini!",
			classImage: "w-40px",
		},
		{
			id: 13,
			isActive: true,
			code: "tv",
			label: "TV Berbayar",
			image: "../assets/media/products-categories/icon-tv.png",
			imageHeader:
				"https://images.unsplash.com/photo-1595935736128-db1f0a261263?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2971&q=80",
			titleHeader:
				"Bayar TV kabel sekarang lebih mudah melalui Travelsya!",
			classImage: "w-30px",
		},
		{
			id: 14,
			isActive: true,
			code: "tax",
			label: "Pajak",
			image: "../assets/media/products-categories/icon-pajak.png",
			imageHeader:
				"https://images.unsplash.com/photo-1598432439250-0330f9130e14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1770&q=80",
			titleHeader: "Bayar Pajak sekarang lebih mudah melalui Travelsya!",
			classImage: "w-30px",
		},
		{
			id: 1,
			isActive: false,
			code: "plane",
			label: "Pesawat",
			image: "../assets/media/products-categories/icon-plane.png",
			imageHeader:
				"https://plus.unsplash.com/premium_photo-1679758630312-a3d601c411d8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2064&q=80",
			titleHeader: "",
			classImage: "w-40px",
		},
		{
			id: 2,
			isActive: false,
			code: "train",
			label: "Kereta Api",
			image: "../assets/media/products-categories/icon-kai.png",
			imageHeader: "",
			titleHeader: "",
			classImage: "w-40px",
		},
		{
			id: 3,
			isActive: false,
			code: "bus-travel",
			label: "Bus & Travel",
			image: "../assets/media/products-categories/icon-bus.png",
			imageHeader: "",
			titleHeader: "",
			classImage: "w-40px",
		},
		{
			id: 5,
			isActive: false,
			code: "rent-car",
			label: "Rental Mobil",
			image: "../assets/media/products-categories/icon-mobil.png",
			imageHeader: "",
			titleHeader: "",
			classImage: "w-40px",
		},
		{
			id: 10,
			isActive: false,
			code: "bank-transfer",
			label: "Transfer Bank",
			image: "../assets/media/products-categories/icon-transfer.png",
			imageHeader: "",
			titleHeader: "",
			classImage: "w-40px",
		},
	];

	var dummyHotels = [
		{
			id: "041a1f7d-d6ce-4a46-b59c-7b8ed1fc1409",
			name: "OVAL GUEST HOUSE",
			label: "OVAL GUEST HOUSE"
		},
		{
			id: "adadadssfdfdfwefwewcczcsaaaasdaadsds",
			name: "Her Mandiri Guest House",
			label: "Her Mandiri Guest House"
		},
		{
			id: "adadadssfdfdfwefwewcczcsaaasda222023",
			name: "Royal Suite Hotel",
			label: "Royal Suite Hotel"
		},
		{
			id: "adadadssfdfdfwefwewcczcsaaasdad42023",
			name: "de radja",
			label: "de radja"
		},
		{
			id: "adadadssfdfdfwefwewcczcsaaasdada2023",
			name: "Hotel Ayu",
			label: "Hotel Ayu"
		},
		{
			id: "adadadssfdfdfwefwewcczcsaaasdada3202",
			name: "radja kost",
			label: "radja kost"
		},
		{
			id: "adadadssfdfdfwefwewcczcsaaasdadaasds",
			name: "Hemra Hotel",
			label: "Hemra Hotel"
		}
	];

	var dummyHostel = {
		typeProperty: [
			{
				id: 0,
				name: "apartement",
				label: "Apartemen"
			},
			{
				id: 1,
				name: "house",
				label: "Rumah"
			},
			{
				id: 2,
				name: "villa",
				label: "Villa"
			},
			{
				id: 3,
				name: "residence",
				label: "Residence"
			}
		],
		typeBed: [
			{
				id: 0,
				name: "studio",
				label: "studio"
			},
			{
				id: 1,
				name: "1br",
				label: "1BR"
			},
			{
				id: 2,
				name: "2br",
				label: "2BR"
			},
			{
				id: 3,
				name: "3br",
				label: "3BR+"
			}
		],
		typeFurnish: [
			{
				id: 0,
				name: "fullfurnished",
				label: "Full Furnish"
			},
			{
				id: 1,
				name: "unfurnished",
				label: "Unfurnished"
			}
		]
	}

	var dummyExploreCities = [
		{
			id: 0,
			label: "Welcome to Bali",
			image: "https://service.travelsya.com/bahan/kota_1.png",
		},
		{
			id: 1,
			label: "Welcome to Yogyakarta",
			image: "https://service.travelsya.com/bahan/kota_2.png",
		},
		{
			id: 2,
			label: "Welcome to Jakarta",
			image: "https://service.travelsya.com/bahan/kota_3.png",
		},
		{
			id: 3,
			label: "Welcome to Surabaya",
			image: "https://service.travelsya.com/bahan/kota_4.png",
		},
		{
			id: 4,
			label: "Welcome to Bandung",
			image: "https://service.travelsya.com/bahan/kota_5.png",
		},
	];

	var dummyFavoriteHotel = [
		{
			id: 0,
			label: "Hotel Mulia Jakarta",
			city: "Jakarta",
			image: "https://www.kayak.co.id/rimg/himg/ec/0f/60/ice-122686-64795234_3XL-516024.jpg",
			price: 1300000,
			realPrice: 825000,
			rate: 3,
			totalRate: 12,
		},
		{
			id: 1,
			label: "Hotel Mulia Jakarta",
			city: "Jakarta",
			image: "https://www.kayak.co.id/rimg/himg/ec/0f/60/ice-122686-64795234_3XL-516024.jpg",
			price: 1300000,
			realPrice: 825000,
			rate: 3,
			totalRate: 12,
		},
		{
			id: 2,
			label: "Hotel Mulia Jakarta",
			city: "Jakarta",
			image: "https://www.kayak.co.id/rimg/himg/ec/0f/60/ice-122686-64795234_3XL-516024.jpg",
			price: 1300000,
			realPrice: 825000,
			rate: 3,
			totalRate: 12,
		},
		{
			id: 3,
			label: "Hotel Mulia Jakarta",
			city: "Jakarta",
			image: "https://www.kayak.co.id/rimg/himg/ec/0f/60/ice-122686-64795234_3XL-516024.jpg",
			price: 1300000,
			realPrice: 825000,
			rate: 3,
			totalRate: 12,
		},
	];

	var today = new Date();
	$(".js-daterangepicker").daterangepicker({
		minDate: today,
	});

	var dummyCities;
	$.ajax({
		url: "{{ route('hostel.ajax.city') }}",
		async:false,
		type: "GET",
		dataType: "json",
		success: function (response) {
			dummyCities = response.map((item, id) => ({
					id: id,
					name: item?.city.toLowerCase() || '',
					label: item?.city || ''
			}));
		},
	});

	$.ajaxSetup({
		headers: {
			"X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
				"content"
			)
		}
	})

	$(document).ready(function () {
		$('.form-select.select:not(.normal)').each(function () {
			$(this).select2({
				dropdownParent: $(this).parent()
			});
		});
		var today = new Date();
		$(".js-daterangepicker").daterangepicker({
			minDate: today,
		});

		new tempusDominus.TempusDominus(
			document.getElementById("js_datepicker"), {
			display: {
				viewMode: "calendar",
				components: {
					date: true,
					hours: false,
					minutes: false,
					seconds: false
				}
			},
			localization: {
				locale: "id",
				format: "dd-MM-yyyy",
			},
			restrictions: {
				minDate: today,
			},
		});

		new tempusDominus.TempusDominus(
			document.getElementById("js_datepickerhostel"), {
			display: {
				viewMode: "calendar",
				components: {
					date: true,
					hours: false,
					minutes: false,
					seconds: false
				}
			},
			localization: {
				locale: "id",
				format: "dd-MM-yyyy",
			},
			restrictions: {
				minDate: today,
			},
		});

		const {
			getOperator
		} = window.NoTelp;

		$(".notelp").on("keyup", function (e) {
			var cat = $(this).data("cat");
			var notelp = e.target.value;
			var operatorTelp1 = getOperator(notelp);

			if (operatorTelp1.valid) {
				$.ajax({
					url: "{{ url('/ajax/ppob') }}",
					type: "POST",
					dataType: "json",
					data: {
						operator: operatorTelp1.operator,
						category: cat,
					},
					success: function (response) {
						if (response.message != "Unauthorized") {
							if (cat == "pulsa")
								$("#row-pricelist-pulsa").html("");

							if (cat == "data")
								$("#row-pricelist-data").html("");

							$.each(response, function (key, val) {
								if (cat == "pulsa") {
									$("#row-pricelist-pulsa").append(
										`<option value="${val.id}">${val.description} - ${val.price}</option>`
									);
								}
								if (cat == "data") {
									$("#row-pricelist-data").append(
										`<option value="${val.id}">${val.description} - ${val.price}</option>`
									);
								}
							});
						} else {
							`<option value=0>Login First</option>`;
						}
					},
				});
			}
		});
	});

	document.addEventListener("alpine:init", () => {
		Alpine.store("menubar", {
			data: dummyMenus,
			selected: {},
		})
		Alpine.store("hotel", {
			cities: dummyCities,
			hotels: dummyHotels,
		}),
		Alpine.store("hostel", {
			cities: dummyCities,
			...dummyHostel
		}),
		Alpine.store("explorecity", {
			data: dummyExploreCities,
		}),
		Alpine.store("favoritehotel", {
			data: dummyFavoriteHotel,
		});
	});
</script>
@endpush