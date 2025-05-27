<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Mengatur charset agar dokumen support karakter UTF-8 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Supaya kompatibel dengan browser lama seperti IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Supaya responsive di semua ukuran layar -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Token CSRF buat keperluan keamanan AJAX di Laravel -->

    <title>taut.in</title>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- CSS utama project -->
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    
    <!-- Toastify: library buat notifikasi popup -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!-- jQuery: dipakai buat AJAX & manipulasi DOM -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init({
        once: true, // animasi hanya jalan sekali
        duration: 800, // durasi animasinya
        easing: 'ease-out',
    });

    document.addEventListener("DOMContentLoaded", function() {
        const currentPath = window.location.pathname;

        document.querySelectorAll('.nav-link').forEach(link => {
            // Ambil href dari link
            const linkPath = new URL(link.href).pathname;

            // Cek apakah linkPath sama atau 'startsWith' currentPath (untuk kasus like /one-link/{code})
            if (currentPath === linkPath || currentPath.startsWith(linkPath)) {
            link.classList.add('active');
            } else {
            link.classList.remove('active');
            }
        });
    });
    </script>

    <!-- Wrapper utama buat navbar -->
    <div id="nav-background">
        <div id="nav-container">
            <header id="nav-header">
                <!-- Logo situs -->
                <h1>
                    <a href="/" class="mode-color" id="nav-logo">
                        <span class="logo-taut">taut.</span><span class="logo-in">in</span>
                    </a>
                </h1>

                <!-- Tombol burger menu buat tampilan mobile -->
                <div id="nav-menu-button"><i class="fa fa-bars"></i></div>
            </header>

            <!-- Navigasi utama -->
            <nav>
                <ul class="nav-ul hide-ul">
                    <li><a class="nav-link mode-color" href="/short-links">Link Expiry</a></li>
                    <li><a class="nav-link mode-color" href="/one-time-link">One-Time Link</a></li>
                    <li><a class="nav-link mode-color" href="/self-destruct">Destruct Message</a></li>
                </ul>
            </nav>
        </div>
    </div>
