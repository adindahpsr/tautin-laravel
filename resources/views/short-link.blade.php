@extends('mainlayout')

@section('maincontent')

    <div class="link-expiry-section">

        <div class="feature-info mode-color no-box" data-aos="fade-up">
            <h1>Link Expiry</h1>
            <p data-aos="fade-up" data-aos-delay="100">
                Kelola tautan dengan fleksibel dan aman. Atur masa aktif link sesuai kebutuhan, 
                Tambahkan enkripsi opsional untuk keamanan ekstra, dan buat QR Code atau tautan kustom dengan mudah. 
                Semua dirancang untuk memberikan kontrol penuh tanpa mengorbankan kenyamanan.
            </p>
        </div>

        <div class="content form-box" data-aos="fade-up" data-aos-delay="200">
            <form id="form-data" action="{{ route('shorten.store') }}" method="POST">
                @csrf
                <div class="input-area">
                    <label for="input">Tautan Asli</label>
                    <input type="text" name="input" id="input" class="input-field" placeholder="https://example.com/tautan-saya" required>

                    <label for="custom_code">Kustom Nama Tautan (Opsional)</label>
                    <input type="text" name="custom_code" id="custom_code" class="input-field" placeholder="Buat nama unik untuk tautan ini" value="{{ old('custom_code') }}">

                    <label for="expiry_time">Durasi Aktif</label>
                    <select name="expiry_time" id="expiry_time" required>
                        <option value="1">1 jam</option>
                        <option value="3">3 jam</option>
                        <option value="6">6 jam</option>
                        <option value="12">12 jam</option>
                        <option value="24">24 jam</option>
                    </select>

                    <div class="checkbox-wrapper">
                        <div class="checkbox-area">
                            <input type="checkbox" id="encrypt" name="encrypt" value="1" {{ old('encrypt') ? 'checked' : '' }}>
                            <label for="encrypt">Enkripsi URL</label>
                        </div>

                        <div class="checkbox-area">
                            <input type="checkbox" id="generate_qr" name="generate_qr" value="1" {{ old('generate_qr') ? 'checked' : '' }}>
                            <label for="generate_qr">QR Code</label>
                        </div>
                    </div>

                    <input type="submit" id="btn" data-action="/generate-shorten-link" value="Generate!">
                </div>
            </form>

            <div class="output-area" data-aos="zoom-in-up" data-aos-delay="300">
                <div id="output" class="output hidden">
                    <div class="short-link-wrapper">
                        <a id="shortened-link" href="#" target="_blank"></a>
                        <div class="icon" id="copy">
                            <i class="fa fa-copy"></i>
                        </div>
                    </div>
                    <img id="qr-code" src="" alt="QR Code" class="hidden" />
                    <button id="download-qr" class="hidden">Unduh QR Code</button>
                </div>
            </div>
        </div>
    </div>

@endsection
