<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-DisDay</title>
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
            min-width: 110%;
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
    </style>
</head>

<body>
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
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Bantuan Teknis</a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <br>

    <div class="container mt-5 pt-5 ">
        <div class="row d-flex justify-content-end align-items-center">
            <!-- Foto Profil -->
            <div class="rounded-circle bg-light text-center d-flex align-items-center justify-content-center"
                style="width: 50px; height: 50px; font-weight: bold; color: #2E7D32;">
                AK
            </div>

            <!-- Informasi Nama & Jabatan -->
            <div class="ml-3 text-right">
                <p class="font-weight-bold mb-0 text-left">Akhmad Kholil, SH.</p>
                <p class="mb-0 text-left">Wakil Ketua II</p>
                <p class="mb-0 text-left">Bidang Pendistribusian dan Pemberdayaan</p>
            </div>
        </div>


        <br>
        <br>

        <div class="row mt-4 align-items-stretch">
            <div class="col-md-6">
                <h5 class="text-success">Rabu, 5 Februari 2025</h5>
                <h2 class="font-weight-bold text-success">Efektif, Akuntabel, dan Transparan</h2>
                <p class="lead text-success">e-DisDay untuk Manajemen yang Lebih Baik</p>
                <div class="d-flex align-items-center mt-4">
                    <div class="d-flex social-icons">
                        <img src="{{ asset('icons/ig.png') }}" alt="Instagram">
                        <img src="{{ asset('icons/tw.png') }}" alt="TikTok">
                        <img src="{{ asset('icons/fb.png') }}" alt="Facebook">
                        <img src="{{ asset('icons/wa.png') }}" alt="WhatsApp">
                    </div>
                    <p class="h5 mb-0 ml-3 text-success">BAZNAS CILACAP</p>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="col-md-6 d-flex">
                    <div class="card card-custom">
                        <h4>E-DISDAY</h4>
                        <span style="font-size: 17px">Pendistribusian & Pemberdayaan</span>
                        <a href="#" class="text-white arrow-big" style="font-size: 30px">&#8594;</a>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="card card-custom">
                        <h4>E-AMBULANCE</h4>
                        <span style="font-size: 17px">Rekam Jejak Layanan Ambulance</span>
                        <a href="#" class="text-white arrow-big" style="font-size: 30px">&#8594;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer-custom">
        <p>Hak Cipta 2025 - BAZNAS CILACAP</p>
    </footer>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
