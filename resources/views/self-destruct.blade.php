@extends('mainlayout')

@section('maincontent')

<div class="link-expiry-section">
    <div class="feature-info mode-color no-box" data-aos="fade-up">
        <h1>Self-Destruct Message</h1>
        <p data-aos="fade-up" data-aos-delay="100">
            Pesan otomatis terhapus setelah dibaca. Kirim pesan yang bersifat sementara, langsung terhapus setelah dibuka, tanpa 
            meninggalkan jejak. Ideal untuk menjaga kerahasiaan informasi yang bersifat pribadi.
        </p>
    </div>
    
    <div class="content form-box" data-aos="fade-up" data-aos-delay="200">
        <form id="message-form" action="{{ route('self-destruct.store') }}" method="POST" class="form-wrapper">
            @csrf
            <label for="message" class="form-label">Pesan Rahasia</label>
            <textarea id="message" name="message" class="form-textarea" placeholder="Tulis pesan rahasiamu di sini..." required></textarea>
            <button type="submit" class="form-button">Buat Pesan</button>
        </form>

        <div class="output-area" data-aos="zoom-in-up" data-aos-delay="300">
            <div id="link-container" class="output" style="display: none;">
                <div class="short-link-wrapper">
                    <a id="message-link" href="#" target="_blank"></a>
                    <div class="icon" id="copy-btn">
                        <i class="fa fa-copy"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
