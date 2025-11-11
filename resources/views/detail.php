<?php
$id = isset($id) ? (int)$id : 0;
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

$normalize = function ($s) {
  $s = strtolower($s);
  $s = preg_replace('/[^a-z0-9]+/','', $s);
  $s = str_replace(['vestzzle','bedazzeld','swervstudio'], ['vestzle','bedazzled','swerstudio'], $s);
  return $s;
};

$displayName = ($id > 0 && $id <= count($names)) ? $names[$id-1] : ("Produk $id");

// Mencari folder katalog
$root = public_path('assets/katalog');
$dirs = glob($root . '/*', GLOB_ONLYDIR) ?: [];
$matchDir = null;
$needle = $normalize($displayName);
foreach ($dirs as $d) {
  $norm = $normalize(basename($d));
  if (strpos($norm, $needle) !== false || strpos($needle, $norm) !== false) {
    $matchDir = $d; break;
  }
}

$images = [];
if ($matchDir) {
  $imgFiles = glob($matchDir . '/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE) ?: [];
  foreach ($imgFiles as $f) {
    $images[] = str_replace('\\', '/', str_replace(public_path(), '', $f));
  }
}
$hero = $images[0] ?? "/assets/img/placeholder.png";
$gallery = count($images) > 1 ? array_slice($images, 1) : [];

$produk = [
    "id" => $id,
    "nama" => $displayName,
    "logo" => $hero,
    "deskripsi" => "Produk ini merupakan bagian dari Program Wirausaha Mahasiswa yang dikembangkan dengan semangat kreativitas dan inovasi. Menawarkan kualitas terbaik, kemasan menarik, dan cita rasa khas yang siap bersaing di pasar UMKM modern.",
    "ig" => "pmw_produk_{$id}",
    "wa" => "6281234567890",
];
$isReversed = $produk['id'] % 2 === 0; // untuk layout kanan-kiri bergantian
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($produk['nama'], ENT_QUOTES, 'UTF-8') ?> - Detail Produk</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #ce4826;
      --primary-dark: #a6341d;
      --text-dark: #222;
      --text-light: #666;
      --bg-light: #f9f9f9;
    }
    * { box-sizing: border-box; scroll-behavior: smooth; }
    body { margin: 0; font-family: 'Poppins', sans-serif; background: #fff; color: var(--text-dark); }

    header {
      position: sticky;
      top: 0;
      background: rgba(255,255,255,0.8);
      backdrop-filter: blur(12px);
      padding: 16px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      z-index: 100;
    }
    header a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: 0.3s;
    }
    header a:hover {
      color: var(--primary-dark);
      transform: translateX(-3px);
    }

    .hero-section {
      display: flex;
      flex-direction: <?= $isReversed ? 'row-reverse' : 'row' ?>;
      align-items: center;
      justify-content: center;
      padding: 80px 40px;
      gap: 50px;
      max-width: 1200px;
      margin: auto;
    }
    .hero-img {
      flex: 1;
      min-height: 500px;
      background: #ddd;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
      position: relative;
    }
    .hero-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.4s ease;
    }
    .hero-img:hover img { transform: scale(1.05); }

    .hero-text {
      flex: 1;
      animation: fadeInUp 0.7s ease;
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .hero-text h1 {
      font-size: 40px;
      font-weight: 800;
      color: var(--primary);
      margin-bottom: 20px;
    }
    .hero-text p {
      font-size: 16px;
      line-height: 1.8;
      color: var(--text-light);
      margin-bottom: 25px;
    }
    .cta-buttons {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
    }
    .btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 12px 20px;
      border-radius: 8px;
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s;
    }
    .btn-primary {
      background: var(--primary);
      color: #fff;
    }
    .btn-primary:hover {
      background: var(--primary-dark);
      box-shadow: 0 4px 15px rgba(206,72,38,0.4);
    }
    .btn-ghost {
      background: #f0f0f0;
      color: var(--text-dark);
    }
    .btn-ghost:hover {
      background: #e0e0e0;
    }

    /* Galeri */
    .gallery-section {
      max-width: 1200px;
      margin: 80px auto;
      padding: 0 40px;
    }
    .gallery-title {
      font-size: 32px;
      text-align: center;
      color: var(--primary);
      margin-bottom: 50px;
      position: relative;
      padding-bottom: 15px;
    }
    .gallery-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background: var(--primary);
    }
    
    .gallery-grid {
      display: flex;
      flex-direction: column;
      gap: 60px;
    }
    
    .gallery-item {
      display: flex;
      align-items: stretch;
      min-height: 0;
      border-radius: 15px;
      background: #fff;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      overflow: hidden;
      margin: 20px 0;
      max-width: 1200px;
      margin-left: auto;
      margin-right: auto;
    }
    
    .gallery-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    }
    
    .gallery-item.reverse {
      flex-direction: row-reverse;
    }
    
    .gallery-image {
      flex: 1;
      min-height: 0;
      overflow: visible;
      position: relative;
      background: #f8f8f8;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 30px;
      box-sizing: border-box;
    }
    
    .gallery-image img {
      max-height: 70vh;
      max-width: 100%;
      width: auto;
      height: auto;
      object-fit: contain;
      transition: transform 0.5s ease;
      background: #fff;
      display: block;
      margin: 0 auto;
      padding: 10px;
      border: 1px solid #f0f0f0;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      border-radius: 8px;
    }
    
    .gallery-item:hover .gallery-image img {
      transform: scale(1.03);
    }
    
    .gallery-content {
      flex: 1;
      padding: 20px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      position: relative;
      z-index: 1;
      min-width: 300px;
    }
    
    .gallery-content h3 {
      font-size: 24px;
      color: var(--text-dark);
      margin-bottom: 15px;
      position: relative;
      display: inline-block;
    }
    
    .gallery-content h3::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 0;
      width: 50px;
      height: 3px;
      background: var(--primary);
      transition: width 0.3s ease;
    }
    
    .gallery-item:hover .gallery-content h3::after {
      width: 70px;
    }
    
    .gallery-content p {
      color: var(--text-light);
      line-height: 1.8;
      margin-bottom: 20px;
    }
    
    @media (max-width: 992px) {
      .gallery-item {
        flex-direction: column;
        min-height: auto;
      }
      
      .gallery-item.reverse {
        flex-direction: column;
      }
      
      .gallery-image {
        width: 100%;
        padding: 20px;
        flex: none;
      }
      
      .gallery-image img {
        max-height: 60vh;
        max-width: 100%;
        width: auto !important;
        height: auto !important;
        padding: 10px;
        border: 1px solid #f0f0f0;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border-radius: 8px;
      }
      
      .gallery-content {
        padding: 30px 20px;
      }
    }
      font-weight: 700;
      text-align: center;
      color: var(--primary);
      margin-bottom: 30px;
    }
  
    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 20px;
    }
    .gallery-grid img {
      
      object-fit: cover;
      border-radius: 12px;
      transition: transform 0.3s ease;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .gallery-grid img:hover { transform: scale(1.05); }

    footer {
      background: var(--bg-light);
      text-align: center;
      padding: 30px;
      font-size: 14px;
      color: var(--text-light);
      margin-top: 40px;
    }

    /* Responsive */
    @media (max-width: 900px) {
      .hero-section { flex-direction: column; padding: 50px 20px; }
      .hero-img { min-height: 350px; }
      .hero-text h1 { font-size: 32px; text-align: center; }
      .hero-text p { text-align: center; }
      .cta-buttons { justify-content: center; }
    }
  </style>
</head>
<body>
  <header>
    <a href="<?= route('katalog') ?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M15.41 7.41 14 6 8 12l6 6 1.41-1.41L10.83 12z"/></svg>
      Kembali ke Katalog
    </a>
    <strong>Detail Produk</strong>
    <span></span>
  </header>

  <!-- Hero Produk -->
  <section class="hero-section">
    <div class="hero-img">
      <img src="<?= $produk['logo'] ?>" alt="<?= htmlspecialchars($produk['nama'], ENT_QUOTES, 'UTF-8') ?>">
    </div>
    <div class="hero-text">
      <h1><?= htmlspecialchars($produk['nama'], ENT_QUOTES, 'UTF-8') ?></h1>
      <p><?= htmlspecialchars($produk['deskripsi'], ENT_QUOTES, 'UTF-8') ?></p>
      <?php
        $waText = rawurlencode("Halo, saya tertarik dengan {$produk['nama']}. Apakah masih tersedia?");
        $waLink = "https://wa.me/{$produk['wa']}?text={$waText}";
        $igLink = "https://instagram.com/" . urlencode($produk['ig']);
      ?>
      <div class="cta-buttons">
        <a class="btn btn-primary" target="_blank" rel="noopener" href="<?= $waLink ?>">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M20.52 3.48A11.86 11.86 0 0012 0C5.38 0 .02 5.36.02 12c0 2.115.56 4.19 1.62 6.02L0 24l6.16-1.61A11.91 11.91 0 0012 24c6.62 0 12-5.38 12-12 0-3.2-1.25-6.21-3.48-8.52z"/></svg>
          Hubungi via WhatsApp
        </a>
        <a class="btn btn-ghost" target="_blank" rel="noopener" href="<?= $igLink ?>">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7z"/></svg>
          Instagram
        </a>
      </div>
    </div>
  </section>

  <!-- Galeri Produk -->
  <?php if (count($gallery) > 0): ?>
    <section class="gallery-section">
      <h2 class="gallery-title">Galeri Produk</h2>
      <div class="gallery-grid">
        <?php 
        $descriptions = [
          'Desain eksklusif dengan bahan berkualitas tinggi',
          'Detail jahitan rapi dan presisi',
          'Motif unik yang elegan dan modern',
          'Kombinasi warna yang menarik dan tahan lama',
          'Nyaman dipakai sepanjang hari',
          'Koleksi terbaru dengan sentuhan inovatif'
        ];
        
        foreach ($gallery as $index => $image): 
          $isEven = $index % 2 === 0;
          $descriptionIndex = $index % count($descriptions);
        ?>
          <div class="gallery-item <?= $isEven ? '' : 'reverse' ?>">
            <div class="gallery-image">
              <img src="<?= $image ?>" alt="<?= $produk['nama'] ?> - Foto <?= $index + 1 ?>">
            </div>
            <div class="gallery-content">
              <h3>Detail Produk <?= $index + 1 ?></h3>
              <p><?= $descriptions[$descriptionIndex] ?></p>
              <p>Setiap detail pada produk ini dirancang dengan teliti untuk memberikan kenyamanan dan gaya yang maksimal. Bahan yang digunakan dipilih secara khusus untuk memastikan kualitas terbaik.</p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>

  <footer>
    &copy; <?= date('Y') ?> Program Wirausaha Mahasiswa Polimedia
  </footer>
</body>
</html>
