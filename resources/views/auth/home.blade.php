<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-DISDAY</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/baznas.png') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        html,
        body {
            height: 100%;
            min-height: 100vh;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
        }

        .navbar {
            padding: 15px 0;
        }

        .nav-link.active {
            border-bottom: 2px solid #FFC107;
        }

        .card-custom {
            background-color: #00593b;
            color: white;
            border-radius: 8px;
            padding: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-width: 100%;
        }

        .footer-custom {
            background-color: #00593b;
            /* Warna hijau */
            color: white;
            /* Warna teks putih */
            text-align: center;
            padding: 10px;
            font-weight: bold;
            position: relative;
        }

        .footer-custom::after {
            content: "";
            display: block;
            width: 100%;
            height: 5px;
            background-color: #FFC107;
            /* Warna kuning */
            position: absolute;
            bottom: 0;
            left: 0;
        }


        .text-success {
            color: #00593b !important;
        }

        .border-bottom {
            border-bottom: 1px solid #FFC107 !important;
        }

        @media (max-width: 767.98px) {
            .navbar-brand {
                display: flex;
                flex-direction: row !important;
                align-items: center;
            }
            
            .navbar-brand img {
                width: 60px;
                height: auto;
            }
            
            .navbar-brand div {
                margin-left: 10px;
            }
            
            .navbar .nav-link {
        padding: 0 5px;
        font-size: 14px;
        color: #00593b !important;
        }
    
        .navbar .nav-link:first-child {
            margin-left: 0;
        }
    
        .navbar .nav-link:last-child {
            margin-left: 10px;
        }
        
        


            .container.mt-5.pt-5 {
                padding-left: 15px;
                padding-right: 15px;
            }

            .row.d-flex.justify-content-end.align-items-center {
                flex-direction: column;
                align-items: flex-start !important;
                text-align: left;
            }

            .row.mt-4.align-items-stretch {
                flex-direction: column;
            }

            .col-md-6.d-flex {
                flex-direction: column;
                width: 100%;
            }

            .col-md-6.d-flex .card-custom {
                min-width: 100%;
                margin-bottom: 15px;
            }

            .social-icons a img {
                width: 30px;
                margin-right: 10px;
            }

            .rounded-circle.bg-light {
                width: 40px;
                height: 40px;
                font-size: 14px;
            }

            .text-right {
                margin-left: 0;
                margin-top: 10px;
            }

            h2.font-weight-bold,
            p.lead {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-white border-bottom fixed-top d-lg-none">
    <div class="container d-flex flex-column align-items-start">
        <!-- Row 1: Logo & Judul -->
        <div class="d-flex align-items-center w-100 mb-2">
            <img src="{{ asset('images/baznas.png') }}" width="50" alt="Logo BAZNAS">
            <div class="ml-2">
                <strong class="text-success mb-0 d-block">E-DISDAY</strong>
                <small class="text-muted">Pendistribusian & Pemberdayaan</small>
            </div>
        </div>

        <!-- Row 2: Menu di pojok kiri -->
        <div class="w-100 d-flex justify-content-start ml-2">
            <a class="nav-link px-2 {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
            <a class="nav-link px-2" href="https://wa.me/6285842716803" target="_blank">Bantuan Teknis</a>
        </div>
    </div>
</nav>

    
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom fixed-top d-none d-lg-flex">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom fixed-top">
                <div class="container">
                    <a class="navbar-brand d-flex align-items-center" href="#">
                        <img src="{{ asset('images/baznas.png') }}" width="80" alt="Logo BAZNAS">
                        <div class="ml-3">
                            <strong class="text-success">E-DISDAY</strong>
                            <p class="mb-0 text-muted" style="font-size: 15px;">Pendistribusian & Pemberdayaan</p>
                        </div>
                    </a>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item  mt-3">
                            <a class="nav-link active font-black" :href="route('home')" :active="request() - > routeIs('home')">Home</a>
                        </li>
                        <li class="nav-item  mt-3">
                            <a class="nav-link font-black" href="https://wa.me/6285842716803" target="_blank">Bantuan Teknis</a>
                        </li>
                    </ul>
                </div>
            </nav>
    </nav>


    <br>
    <br>
    <div class="container mt-5 pt-5 ">
           <div class="d-flex justify-content-start justify-content-lg-end align-items-center mb-3">
                <!-- Foto Profil -->
                @if (Auth::user()->foto_url)
                    <img src="{{ asset('uploads/foto_pengguna/' . Auth::user()->foto_url) }}"
                        class="rounded-circle mr-2"
                        style="width: 50px; height: 50px; object-fit: cover;">
                @else
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mr-2"
                        style="width: 50px; height: 50px; font-weight: bold; color: #2E7D32;">
                        {{ strtoupper(substr(Auth::user()->nama, 0, 2)) }}
                    </div>
                @endif
            
                <!-- Info Nama dan Jabatan -->
                <div class="text-left">
                    <strong>{{ Auth::user()->nama }}</strong><br>
                    <span>{{ Auth::user()->pengurus->jabatan->jabatan }}</span><br>
                    <span>{{ Auth::user()->pengurus->jabatan->divisi->divisi }}</span>
                </div>
            </div>

        <br class="d-none d-lg-block">
        <br class="d-none d-lg-block">

        <div class="row mt-4 align-items-stretch">
            <div class="col-md-6">
                <h5 class="text-success">{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}</h5>
                <h2 class="font-weight-bold text-success">Efektif, Akuntabel, dan Transparan</h2>
                <p class="lead text-success">e-DisDay untuk Manajemen yang Lebih Baik</p>
                <div class="d-flex align-items-center mt-4 mb-3">
                    <div class="d-flex social-icons">
                        <a href="https://www.instagram.com/baznascilacap?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                            target="_blank">
                            <img src="{{ asset('icons/ig.png') }}" alt="Instagram">
                        </a>
                        <a href="https://www.tiktok.com/@baznaskab.cilacap_?is_from_webapp=1&sender_device=pc"
                            target="_blank">
                            <img src="{{ asset('icons/tw.png') }}" alt="TikTok">
                        </a>
                        <a href="https://www.facebook.com/BaznasKabCilacap/" target="_blank">
                            <img src="{{ asset('icons/fb.png') }}" alt="Facebook">
                        </a>
                        <a href="https://wa.me/6285842716803" target="_blank">
                            <img src="{{ asset('icons/wa.png') }}" alt="WhatsApp">
                        </a>
                    </div>
                    <p class="h5 mb-0 ml-3 text-success">BAZNAS CILACAP</p>
                    
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 col-12 mb-3">
                        <a href="{{ route('permohonan') }}" class="text-white">
                            <div class="card card-custom">
                                <h4>E-DISDAY</h4>
                                <span style="font-size: 17px">Pendistribusian & Pemberdayaan</span>
                                <span class="text-white arrow-big" style="font-size: 30px">&#8594;</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <a href="https://ambulance.sibaznas.com" class="text-white">
                            <div class="card card-custom">
                                <h4>E-AMBULANCE</h4>
                                <span style="font-size: 17px">Rekam Jejak Layanan Ambulance</span>
                                <span class="text-white arrow-big" style="font-size: 30px">&#8594;</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <footer class="footer-custom">
        <p>Hak Cipta 2025 - BAZNAS CILACAP</p>
    </footer>
    


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
