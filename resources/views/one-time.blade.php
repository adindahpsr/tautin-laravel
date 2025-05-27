@extends('mainlayout')

@section('maincontent')

    <div class="link-expiry-section">

        <div class="feature-info mode-color no-box" data-aos="fade-up">
            <h1>One-Time Link</h1>
            <p data-aos="fade-up" data-aos-delay="100">
                Tautan hanya bisa diakses satu kali. Setelah dibuka, tautan akan otomatis kedaluwarsa dan tidak dapat digunakan 
                kembali. Fitur ini cocok ntuk berbagi informasi sensitif yang hanya perlu dilihat satu kali.
            </p>
        </div> 

        <div class="content form-box" data-aos="fade-up" data-aos-delay="200">
            <form id="form-data" action="{{ route('one-time-link.store') }}" method="POST">
                @csrf
                <div class="input-area">
                    <label for="input">Tautan Asli</label>
                    <input type="text" name="input" id="input" class="input-field" placeholder="https://example.com/tautan-saya" value="{{ old('input') }}">

                    <label for="custom_code">Kustom Nama Tautan (Opsional)</label>
                    <input type="text" name="custom_code" id="custom_code" class="input-field" placeholder="Buat nama unik untuk tautan ini" value="{{ old('custom_code') }}"> 
                    
                    <div class="checkbox-area" style="margin-top: 10px;">
                        <input type="checkbox" id="encrypt_link" name="encrypt_link" value="1" {{ old('encrypt_link') ? 'checked' : '' }}>
                        <label for="encrypt_link">Enkripsi URL</label>
                    </div>
                    
                    <input type="submit" id="btn" data-action="/one-link" value="Generate!">
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
                </div>
            </div>
        </div>
    </div>

@endsection    
