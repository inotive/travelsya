<style>

    body {
        background-color: #f5f5f5;
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
        align-items: center;
        border: 1px solid #ccc;
        border-radius: 30px;
        padding: 10px 20px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 5px;
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

        .search-button {
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

        .card {
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
        .bubble {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
        }
        .bubble-1 {
            top: 10px;
            right: 10px;
            width: 100px;
            height: 100px;
            background-color: #ffcccb;
        }
        .bubble-2 {
            bottom: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background-color: #ffcccb;
        }

        .logo-travelsya{
            position: relative;
            margin-bottom: 20px;
        }


</style>
