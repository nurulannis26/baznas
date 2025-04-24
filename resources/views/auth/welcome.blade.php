<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-DISDAY</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/baznas.png') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 4 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: white;
        }
        .sidebar {
            background-color: #00593b;
            color: white;
            padding: 3rem;
            border-left: 12px solid #FFC107;
            height: 100vh;
        }
        .sidebar img {
            border-radius: 12px;
        }
        .social-icons img {
            width: 40px;
            margin: 0 8px;
        }
        .text-success {
            color: #00593b  !important;
        }
        .btn-success {
            background-color: #00593b  !important;
        }
    </style>
</head>
<body class="d-flex vh-100">

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar (Hanya tampil di layar sm ke atas) -->
            <div class="col-md-7 d-none d-md-flex align-items-center justify-content-center sidebar">
                <div class="">
                    <!-- Logo & Title -->
                    <div class="d-flex align-items-center  mb-3">
                        <img src="{{ asset('images/baznas.png') }}" alt="BAZNAS Cilacap" class="mr-3" width="80">
                        <div class="text-left">
                            <h1 class="h4 font-weight-bold mb-1">E-DISDAY</h1>
                            <p class="h6 mb-0">Pendistribusian & Pemberdayaan</p>
                        </div>
                    </div>
                    
                    <br>
                    <!-- Slogan -->
                    <p class="mt-6 h5 font-weight-normal">
                        Efektif, Akuntabel, dan Transparan <br> 
                        E-DISDAY untuk Manajemen yang Lebih Baik
                    </p>
    
                    <!-- Social Media Icons -->
                    <div class="d-flex align-items-center mt-4 justify-content-center">
                        <div class="d-flex social-icons">
                            <a href="https://www.instagram.com/baznascilacap?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                        target="_blank">
                            <img src="{{ asset('icons/ig.png') }}" alt="Instagram">
                        </a>
                        <a href="https://www.tiktok.com/@baznaskab.cilacap_?is_from_webapp=1&sender_device=pc" target="_blank">
                            <img src="{{ asset('icons/tw.png') }}" alt="TikTok">
                        </a>
                        <a href="https://www.facebook.com/BaznasKabCilacap/" target="_blank">
                            <img src="{{ asset('icons/fb.png') }}" alt="Facebook">
                        </a>
                        <a href="https://wa.me/6285842716803" target="_blank">
                            <img src="{{ asset('icons/wa.png') }}" alt="WhatsApp">
                        </a>
                        </div>
                        <p class="h5 font-weight-medium mb-0 ml-3">BAZNAS CILACAP</p>
                    </div>
                </div>
                
            </div>
            
            <!-- Main Content -->
            <div class="col-md-5 d-flex flex-column align-items-center justify-content-center">
                <div class="text-center">
                    <img src="{{ asset('images/baznas.png') }}" alt="BAZNAS Cilacap" class="mb-3" width="80">
                    <h2 class="h4 font-weight-bold text-success">Selamat datang di E-DISDAY</h2>
                    <p class="h6 text-success">Pendistribusian & Pemberdayaan</p>
                    <hr class="border-warning w-50 mb-3">
                    <form action="{{ route('login.action') }}" method="POST" autocomplete="on">
                        @csrf
                        <div class="mt-2 font-bold text-left">
                            Masuk ke akun anda
                        </div>
                        <div class="mt-2 form-group text-left">
                            <label for="phone">No HP</label>
                            <input type="number" id="phone" name="nohp" class="form-control" placeholder="Masukkan No HP" required>
                        </div>
                        <div class="form-group text-left">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                        </div>
                
                        {{-- <div class="form-group d-flex justify-content-between align-items-center">
                            <div>
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">Ingat Saya</label>
                            </div>
                            <a href="#" class="text-success">Lupa Password?</a>
                        </div> --}}
                
                        <button type="submit" class="btn btn-success btn-block mt-4">Masuk</button>
                    </form>
                
                    <p class="help-text mt-3">Butuh bantuan? <a href="https://wa.me/6285842716803" class="text-success">Hubungi bantuan teknis</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 4 JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
