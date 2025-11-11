<?php
// Daftar nama produk
$names = [
  '7AVE Clothes',
  'Anywhere',
  'ArCloth',
  'ArthemizLabs',
  'BreakerClothes',
  'ciprek',
  'Devotion Cloth',
  'Insphere',
  'Kacang Sembunyi Warisan Bunda',
  'Lowbudget Cos',
  'Mangata',
  'PolarBoo',
  'Student Sips Drink',
  'Sunnyside Production',
  'Toteen',
  'Vestzle',
  'Hanabira Works',
  'Homefox',
  'Nusariot',
  'Pieces of Me',
  'Ritistic',
  'Sketch-Mode',
  'Visual CreatiVerse',
];

$produk = [];
for ($i = 0; $i < count($names); $i++) {
  $display = $names[$i];
  $id = $i + 1;
  $thumbWeb = "/assets/image/" . rawurlencode($display) . ".png";
  $produk[] = [
    'id' => $id,
    'nama' => $display,
    'logo' => $thumbWeb,
  ];
}

$highlight = array_slice($produk, 0, 3);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Katalog Wirausaha Mahasiswa</title>
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #fff;
      color: #333;
      overflow-x: hidden;
    }

    /* Navbar Back Button */
    header {
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      padding: 15px 30px;
      display: flex;
      justify-content: flex-start;
      align-items: center;
      backdrop-filter: blur(12px);
      background: rgba(255, 255, 255, 0.25);
      z-index: 1000;
      box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    }
    .back-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 18px;
      background: #ce4826;
      color: #fff;
      font-weight: 600;
      font-size: 16px;
      border-radius: 30px;
      text-decoration: none;
      transition: all 0.3s ease;
    }
    .back-btn:hover {
      background: #a6341d;
      transform: translateX(-3px);
      box-shadow: 0 4px 12px rgba(206, 72, 38, 0.4);
    }
    .back-btn svg {
      width: 20px;
      height: 20px;
      fill: #fff;
    }

    /* Hero Section (Full width for 1 product) */
    .hero {
      margin-top: 90px;
      width: 100vw;
      overflow: hidden;
      display: flex;
      justify-content: center;
      background: #fff;
    }
    .slides {
      display: flex;
      transition: transform 0.8s ease;
      width: 100%;
    }
    .slide {
      flex: 0 0 100vw;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 80px;
      padding: 60px 80px;
      box-sizing: border-box;
    }
    .slide img {
      width: 420px;
      height: 595px;
      object-fit: cover;
      background: #aaa;
      border-radius: 8px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.25);
    }
    .hero-content {
      max-width: 500px;
    }
    .hero-content h2 {
      font-size: 36px;
      margin-bottom: 20px;
      color: #000;
      font-weight: 800;
      letter-spacing: 1px;
    }
    .hero-content p {
      font-size: 16px;
      color: #444;
      margin-bottom: 25px;
      line-height: 1.6;
      font-weight: 500;
    }
    .btn {
      padding: 12px 25px;
      border-radius: 6px;
      font-weight: bold;
      border: none;
      cursor: pointer;
      transition: 0.3s;
      text-decoration: none;
      display: inline-block;
    }
    .btn-primary { background: #ce4826; color: #fff; }
    .btn-primary:hover { background: #a6341d; }

    /* Katalog Grid */
    .container {
      padding: 60px 60px;
      max-width: 1400px;
      margin: auto;
    }
    .judul {
      text-align: center;
      font-size: 32px;
      color: #ce4826;
      margin-bottom: 40px;
    }
    .grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 30px;
      justify-items: center;
    }
    .card {
      position: relative;
      border-radius: 12px;
      overflow: hidden;
      background: #f8f8f8;
      cursor: pointer;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      width: 280px;
    }
    .card img {
      width: 100%;
      height: 380px;
      object-fit: cover;
      display: block;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.25);
    }
    .card-info {
      text-align: center;
      padding: 15px;
    }
    .card-info h3 {
      margin: 0;
      font-size: 18px;
      color: #ce4826;
    }

    /* Responsive */
    @media (max-width: 1200px) {
      .slide { flex-direction: column; gap: 30px; text-align: center; }
      .slide img { width: 70%; height: auto; }
      .hero-content { max-width: 500px; }
      .grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 768px) {
      header { padding: 15px; }
      .grid { grid-template-columns: repeat(2, 1fr); }
      .hero-content h2 { font-size: 28px; }
    }
    @media (max-width: 480px) {
      .grid { grid-template-columns: 1fr; }
      .slide { padding: 20px; }
      .back-btn { font-size: 14px; padding: 8px 14px; }
    }

    footer {
      text-align: center;
      padding: 25px;
      background: #f2f2f2;
      font-size: 14px;
      color: #666;
      margin-top: 25px;
    }
  </style>
</head>
<body>
  <!-- Navbar hanya tombol kembali -->
  <header>
    <a href="<?= route('home') ?>" class="back-btn">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.41 7.41 14 6l-6 6 6 6 1.41-1.41L10.83 12z"/></svg>
      Kembali ke Home
    </a>
  </header>

  <!-- Highlight -->
  <section class="hero">
    <div class="slides" id="slides">
      <?php 
      $descriptions = [
        'Temukan koleksi eksklusif dari wirausaha mahasiswa terbaik kampus kami. Setiap produk dibuat dengan dedikasi tinggi dan kreativitas tanpa batas.',
        'Dukung pengusaha muda berbakat dengan menjelajahi berbagai produk inovatif hasil karya mahasiswa. Setiap pembelian adalah dukungan untuk masa depan mereka.',
        'Jelajahi beragam produk unggulan dari berbagai bidang usaha. Mulai dari fashion, makanan, hingga kerajinan tangan, semuanya ada di sini.'
      ];
      ?>
      <?php foreach ($highlight as $index => $item): ?>
        <div class="slide">
          <img src="<?= $item['logo'] ?>" alt="<?= $item['nama'] ?>">
          <div class="hero-content">
            <h2>Selamat Datang di Galeri Wirausaha Mahasiswa</h2>
            <p><?= $descriptions[$index] ?></p>
            <a href="<?= route('detail', ['id' => $item['id']]) ?>" class="btn btn-primary">Jelajahi Sekarang</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Katalog -->
  <div class="container">
    <h2 class="judul">Katalog Wirausaha Mahasiswa</h2>
    <div class="grid">
      <?php foreach ($produk as $p): ?>
        <a href="<?= route('detail', ['id' => $p['id']]) ?>" class="card">
          <img src="<?= $p['logo'] ?>" alt="<?= $p['nama'] ?>">
          <div class="card-info">
            <h3><?= $p['nama'] ?></h3>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>

  <footer>
    &copy; <?= date('Y') ?> Program Wirausaha Mahasiswa Polimedia
  </footer>

  <script>
    let index = 0;
    const slides = document.getElementById('slides');
    const total = slides.children.length;
    setInterval(() => {
      index = (index + 1) % total;
      slides.style.transform = `translateX(-${index * 100}vw)`;
    }, 5000);
  </script>
</body>
</html>
