<style>

    /* SCRIPT LANDING RENTAL MOBIL */

    body {
        background-color: #f5f5f5;
        overflow-x: hidden;
        /* margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center; */
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Special Deals Section */
    .special-deals {
        padding: 2rem 0;
    }

    .section-header {
        margin-bottom: 1.5rem;
    }

    .hawa{
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(4px);
        border-radius: 12px;
        padding: 0.5rem 1rem;
        width: fit-content;
    }

    .section-header h2 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .section-header p {
        color: #666;
    }

    .card-grid {
        display: flex;
        gap: 1rem;
        overflow-x: auto;
        padding-bottom: 1rem;
    }

    .card {
        flex: 0 0 auto;
        width: 300px;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .card img {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    .coret{
        color: #969595;
    }

    .card-content {
        padding: 1rem;
    }
    
    .partner-card {
        padding: 1rem;
    }

    .bintang{
        color: yellow;
    }

    .lokasi {
        color: #969595;
    }

    .discount-tag {
        position: absolute;
        top: 118px;
        left: 10px;
        background-color: #e3b7b7;
        color: rgb(201, 15, 15);
        padding: 0.2rem 0.5rem;
        border-radius: 8px;
        font-size: 0.9rem;
        z-index: 2;
    }

    .panah {
        background-color: #ededed;
        border-radius: 100%;
    }

    .panah:hover {
        background-color: #ff9494;
    }

    .card h3 {
        margin-bottom: 0.5rem;
    }

    .price {
        color: #c41e3a;
        font-weight: bold;
    }

    /* Categories Section */
    .categories {
        padding: 2rem 0;
    }

    .category-grid {
        display: flex;
        gap: 1rem;
        overflow-x: auto;
        padding-bottom: 1rem;
    }

    .category-card {
        flex: 0 0 auto;
        width: 300px;
        height: 150px;
        position: relative;
        border-radius: 8px;
        overflow: hidden;
    }

    .category-card img {
        width: 100%;
        height: 100%;
        filter:brightness(0.6);
        object-fit: cover;
    }

    .category-card h3 {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 4rem 0rem;
        color: white;
        text-align: center;
    }

    /* Partners Section */
    .partners {
        padding: 2rem 0;
    }

    .search {
        display: flex;
        border: 1px solid #ccc;
        border-radius: 30px;
        padding: 10px 20px;
        background-color: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 5px;
        margin-right: -28%;
    }

    .search input {
        border: none;
        outline: none;
        font-size: 16px;
        color: #888;
        flex: 1;
    }

    .search i {
        color: #888;
        margin-right: 10px;
    }
    
    .partner-grid {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
    }

    .partner-logo {
        width: 150px;
        height: 60px;
        object-fit: contain;
        filter: grayscale(100%);
        transition: filter 0.3s;
    }

    .partner-logo:hover {
        filter: grayscale(0%);
    }

    * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .hero {
            position: relative;
            height: 700px;
            background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url("{{ asset('storage/images/car-rental-new.png') }}");
            background-size: cover;
            background-position: center;
        }

        .hero-content {
            position: absolute;
            top: 50%;
            left: 10%;
            transform: translateY(-50%);
            color: white;
            z-index: 1;
        }

        .hero-content h2 {
            font-size: 14px;
            margin-bottom: 8px;
        }

        .hero-content h1 {
            font-size: 36px;
            font-weight: bold;
        }

        .search-box {
            position: absolute;
            top: 50%;
            right: 10%;
            transform: translateY(-50%);
            background: white;
            border-radius: 12px;
            width: 380px;
            padding: 24px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            z-index: 2;
        }

        .button-group {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
            width: 30px;
        }

        .toggle-button {
            flex: 1;
            padding: 8px 16px;
            border: none;
            background: none;
            font-size: 12px;
            color: #666;
            cursor: pointer;
            width: fit-content;
        }

        .toggle-button.active {
            border-bottom: 2px solid #C02425;
            color: #C02425;
        }

        .search-container {
            position: relative;
            margin-bottom: 16px;
        }

        .search-container input {
            width: 100%;
            padding: 12px 40px 12px 45px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            background: #f5f5f5;
        }

        .date-container {
            position: relative;
            margin-bottom: 16px;
        }

        .date-container input {
            width: 100%;
            padding: 12px 45px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            background: #f5f5f5;
        }

        .duration-container {
            position: relative;
            margin-bottom: 16px;
        }

        .duration-container input {
            width: 100%;
            padding: 12px 45px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            background: #f5f5f5;
        }

        .submit-button {
            width: 100%;
            padding: 12px;
            background-color: #c41e3a;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
        }

        .icon {
            position: absolute;
            right: 300px;
            top: 52%;
            transform: translateY(-50%);
            color: #666;
        }

        .iconJam {
            position: absolute;
            right: 60px;
            top: 52%;
            transform: translateY(-50%);
            color: #666;
        }

        .ikon{
            position: absolute;
            right: 25px;
            top: 52%;
            transform: translateY(-50%);
            color: #000000;
        }

        .pasir{
            position: absolute;
            right: 305px;
            top: 35%;
        }

        .kembali{
            margin-left: 10%;
        }

        .card-inpo {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 25%;
        }
        .iconh {
            background-color: #d32f2f;
            color: rgb(255, 255, 255);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 15px;
        }
        h2 {
            margin: 0 0 10px 0;
            font-size: 18px;
        }
        p {
            margin: 0;
            font-size: 14px;
            color: #666;
        }

        .bubble{
            opacity: 0.2;
            background-color: #c41e3a; 
        }

        .bubble2{
            opacity: 0.2;
            background-color: #ff002b; 
        }

        .logo-travelsya{
            position: relative;
            margin-bottom: 20px;
        }

        .card {
            margin: 0 auto;
            width: 50%;
            margin-left: 5px;
            height: 400px;
            padding: 20px;
            border-radius: 20px;
            text-align: justify;
            display: flex;
        }

        .card-car {
            width: 250px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 12px;
        }

        .car-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        .car-title {
            font-size: 18px;
            font-weight: 500;
            margin: 12px 0 8px 0;
            color: #333;
        }

        .car-stats {
            display: flex;
            gap: 16px;
            color: #666;
            font-size: 14px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .stat-icon {
            width: 16px;
            height: 16px;
            opacity: 0.7;
        }
        
        .city-card {
            margin-top: 2%;
        }

        .copyright {
            height: 60px;
            background-color: #C02425;
            padding: 20px;
            width: 100vw;
            box-sizing: border-box;
            margin: 0;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
        }

        /*SCRIPT HASIL PENCARIAN */
        .search-bar {
            display: flex;
            align-items: center;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            margin: 11%;
            margin-top: 1%;
            margin-bottom: 1%;
            flex-wrap: nowrap;
        }
        .search-bar input {
            border: none;
            outline: none;
            font-size: 14px;
            margin-right: 20px;
        }
        .search-bar span {
            margin: 0 10px;
            font-size: 14px;
            color: #333;
            white-space: nowrap;
        }
        .search-bar .divider {
            height: 20px;
            width: 1px;
            background-color: #ddd;
            margin: 0 10px;
        }
        .search-bar .search-button {
            background-color: #ffe6e6;
            color: #ff4d4d;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            margin-left: auto;
        }

        .location {
            color: #d32f2f;
            font-size: 16px;
            display: flex;
            align-items: center;
            cursor: pointer;
            margin-right: 12%;
        }
        .location i {
            margin-right: 5px;
        }
        .custom-container {
            display: flex;
            justify-content: space-between;
            width: 78%;
            margin: 20px auto;
        }
        .custom-left-buttons, .custom-right-buttons {
            display: flex;
            gap: 10px;
        }
        .custom-button {
            padding: 10px 20px;
            border-radius: 20px;
            border: 2px solid #ccc;
            background-color: #fdfdfd;
            color: #000000;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .custom-button.active {
            border: 2px solid #d32f2f;
            color: #d32f2f;
            background-color: #fff5f5;
        }
        .custom-button i {
            font-size: 16px;
        }

        .car-card {
            display: flex;
            align-items: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 14px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 78%;
            margin: auto;
            margin-bottom: 10px;
        }
        .car-card-image {
            width: 180px;
            height: 150px;
            border-radius: 10px;
        }
        .car-card-details {
            flex: 1;
            margin-left: 20px;
        }
        .car-card-details h2 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .car-card-details .car-card-info {
            display: flex;
            align-items: center;
            margin-top: 10px;
            color: #666;
        }
        .car-card-details .car-card-info i {
            margin-right: 5px;
        }
        .car-card-details .car-card-info span {
            margin-right: 20px;
        }
        .car-card-price {
            text-align: right;
        }
        .car-card-price p {
            margin: 0;
            color: #666;
        }
        .car-card-price .car-card-amount {
            font-size: 20px;
            color: #d32f2f;
            font-weight: bold;
        }
        .car-card-price .car-card-button {
            background-color: #d32f2f;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 10px;
        }
        
        /* MODAL RENT */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }


</style>
