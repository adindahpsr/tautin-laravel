@extends('mainlayout')

@section('maincontent')

    <div class="content" data-aos="fade-up">
        <img src="{{ asset('images/home.svg') }}" alt="Icon" class="content-image" />
        <div class="header mode-color" data-aos="fade-up" data-aos-delay="100">
            <h1>taut.in membuat segalanya menjadi mudah. <span class="highlight-text">Every click. Every step.</span></h1>
        </div>
    </div>

    <section class="fitur-section">
        <div class="fitur-header">
            <h1 data-aos="fade-up">Semua yang kamu butuhkan ada di sini.</h1>
            <p data-aos="fade-up" data-aos-delay="100">
            Mulai tahun 2025, taut.in hadir untuk membantu kamu berbagi dengan cara yang aman,
            praktis, dan bersifat sementara. Bukan hanya sekedar menjadi alat pemendek tautan, 
            kami membantu pelajar, kreator, dan profesional dalam berbagi tautan, pesan sensitif, dan 
            QR Code dengan lebih nyaman. Privasi tetap terjaga, tampilan bersih, dan proses berbagi menjadi lebih efisien.
            </p>
        </div>

        <div class="fitur-cards" id="fitur" data-aos="fade-up" data-aos-delay="300">
            <a href="/short-links" class="fitur-card">
                <img src="https://img.icons8.com/?size=100&id=9749&format=png&color=000000" alt="1" class="number-icon" />
                <h3>Link Expiry</h3>
                <p>
                    Kelola tautan dengan fleksibel dan aman. Atur masa aktif link sesuai kebutuhan, 
                    Tambahkan enkripsi opsional untuk keamanan ekstra, dan buat QR Code atau tautan kustom dengan mudah. 
                    Semua dirancang untuk memberikan kontrol penuh tanpa mengorbankan kenyamanan.
                </p>
                <img src="https://img.icons8.com/?size=100&id=n2C7Bts7cbWW&format=png&color=000000" alt="Panah" class="arrow-icon" />
            </a>
            <a href="/one-time-link" class="fitur-card">
                <img src="https://img.icons8.com/?size=100&id=9752&format=png&color=000000" alt="1" class="number-icon" />
                <h3>One-Time Link</h3>
                <p>
                    Tautan hanya bisa diakses satu kali. Setelah dibuka, tautan akan otomatis kedaluwarsa dan tidak dapat digunakan 
                    kembali. Fitur ini cocok ntuk berbagi informasi sensitif yang hanya perlu dilihat satu kali.
                </p>
                <img src="https://img.icons8.com/?size=100&id=n2C7Bts7cbWW&format=png&color=000000" alt="Panah" class="arrow-icon" />
            </a>
            <a href="/self-destruct" class="fitur-card">
                <img src="https://img.icons8.com/?size=100&id=9756&format=png&color=000000" alt="1" class="number-icon" />
                <h3>Self-Destruct Message</h3>
                <p>
                    Pesan otomatis terhapus setelah dibaca. Kirim pesan yang bersifat sementara, langsung terhapus setelah dibuka, tanpa 
                    meninggalkan jejak. Ideal untuk menjaga kerahasiaan informasi yang bersifat pribadi.
                </p>
                <img src="https://img.icons8.com/?size=100&id=n2C7Bts7cbWW&format=png&color=000000" alt="Panah" class="arrow-icon" />
            </a>
        </div>
    </section>

    <section class="kenapa-section" data-aos="fade-up">
        <div class="kenapa-container">
            <div class="kenapa-left">
                <span class="badge" data-aos="fade-up" data-aos-delay="100">TAUT.IN</span>
                <h2 data-aos="fade-up" data-aos-delay="200"><strong>Kenapa sih harus taut.in?</strong></h2>
                <div class="fitur-grid">
                    <div class="fitur-item" data-aos="fade-up" data-aos-delay="300">
                        <img src="https://img.icons8.com/?size=100&id=2438&format=png&color=f95454" alt="Terenkripsi" />
                        <div>
                            <strong>Terenkripsi</strong>
                            <p>Data terenkripsi dengan aman.</p>
                        </div>
                    </div>
                    <div class="fitur-item" data-aos="fade-up" data-aos-delay="300">
                        <img src="https://img.icons8.com/?size=100&id=24650&format=png&color=f95454" alt="Penghapusan Otomatis" />
                        <div>
                            <strong>Penghapusan Otomatis</strong>
                            <p>Tautan otomatis terhapus setelah diakses.</p>
                        </div>
                    </div>
                    <div class="fitur-item" data-aos="fade-up" data-aos-delay="300">
                        <img src="https://img.icons8.com/?size=100&id=11694&format=png&color=f95454" alt="Tanpa Pelacakan" />
                        <div>
                            <strong>Tanpa Pelacakan</strong>
                            <p>Tanpa cookies, iklan, atau analitik.</p>
                        </div>
                    </div>
                    <div class="fitur-item" data-aos="fade-up" data-aos-delay="300">
                        <img src="https://img.icons8.com/?size=100&id=5&format=png&color=f95454" alt="Tanpa Berbagi Data" />
                        <div>
                            <strong>Tanpa Berbagi Data</strong>
                            <p>Data tidak dibagikan ke pihak ketiga.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kenapa-right" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('images/flowers.svg') }}" alt="Flowers" />
            </div>
        </div>
    </section>


    {{-- Section Ajak Pengguna Coba Sekarang --}}
    <div class="container" data-aos="fade-up">
        <div class="title">Selamat Datang di taut.in!</div>
        <div class="subtitle">Mulai pengalaman berbagi yang lebih aman dan praktis,</div>
        <a href="#fitur" class="btn">Gratis!</a>
    </div>

@endsection
