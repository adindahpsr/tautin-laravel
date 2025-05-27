<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pesan Rahasia</title>

  <!-- Import Google Fonts: Poppins buat teks biasa, Crafty Girls buat judul yang estetik -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #fff;
      color: #333;
      font-family: 'Poppins', sans-serif;
    }

    .secret-box {
      border: 1px solid #fff;
      background-color: #a0e9ff;
      border-radius: 12px;
      padding: 30px 20px;
      max-width: 700px;
      margin: 60px auto 20px ;
      text-align: center;
      box-sizing: border-box;
    }

    .secret-box h2 {
      font-size: 28px;
      margin-bottom: 15px;
    }

    .secret-box p {
      font-size: 20px;
      font-weight: 400;
      line-height: 1.6;
      word-wrap: break-word;
    }

    .footer-note {
      text-align: center;
      margin-top: 20px;
      font-size: 16px;
      font-weight: 400;
      color: #aaa;
      padding: 0 10px;
    }

    /* === RESPONSIVE SETTING UNTUK LAYAR HP === */
    @media screen and (max-width: 480px) {
      .secret-box {
        margin: 30px 24px;
        padding: 25px 24px;
      }

      .secret-box h2 {
        font-size: 22px;
      }

      .secret-box p {
        font-size: 15px;
      }

      .footer-note {
        font-size: 14px;
      }
    }
  </style>
</head>

<body>

  <!-- KONTEN UTAMA: Menampilkan pesan rahasia -->
  <div class="secret-box">
    <h2>Pesan Rahasia</h2>
    <p>{{ $message }}</p> <!-- Isi pesan di-inject dari controller -->
  </div>

  <!-- FOOTER KECIL DENGAN COPYRIGHT -->
  <div class="footer-note">
    &copy; 2025 taut.in | Rahasia tetap rahasia.
  </div>

</body>
</html>
