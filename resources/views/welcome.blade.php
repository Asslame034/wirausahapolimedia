<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Wirausaha Mahasiswa Polimedia</title>
  <meta name="description" content="Website Wirausaha Mahasiswa Polimedia">
  <meta name="keywords" content="Wirausaha Mahasiswa Polimedia, Mahasiswa, Wirausaha, Website">
  <!-- CSRF Token for AJAX -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicons -->
  <link href="/assets/img/favicon.png" rel="icon">
  <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="/assets/css/main.css" rel="stylesheet">
  <!-- Chatbot CSS -->
  <link href="/chatbot/style.css" rel="stylesheet">

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="{{ route('home') }}" class="logo d-flex align-items-center">
        <h1 class="sitename">Wirausaha Mahasiswa Polimedia</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#gallery">Gallery</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
      <img src="/assets/img/hero-bg-2.jpg" alt="" class="hero-bg">

      <div class="container">
        <div class="row gy-4 justify-content-between">
          <div class="col-lg-6 order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100">
            <img src="/assets/img/hero-img.png" class="img-fluid animated" alt="">
          </div>

          <div class="col-lg-6  d-flex flex-column justify-content-center" data-aos="fade-in">
            <h1>Selamat Datang di <br><span>Wirausaha Polimedia</span></h1>
            <p>Website ini dibuat untuk mendukung Wirausaha Mahasiswa Polimedia dan menampilkan ide-ide wirausaha mahasiswa.</p>
            <div class="d-flex">
                <a href="{{ route('katalog') }}" class="btn-get-started">Katalog Wirausaha Mahasiswa Polimedia</a>
            </div>
          </div>

        </div>
      </div>

      <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
          <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
        </defs>
        <g class="wave1">
          <use xlink:href="#wave-path" x="50" y="3"></use>
        </g>
        <g class="wave2">
          <use xlink:href="#wave-path" x="50" y="0"></use>
        </g>
        <g class="wave3">
          <use xlink:href="#wave-path" x="50" y="9"></use>
        </g>
      </svg>

    </section><!-- /Hero Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 justify-content-center text-center">

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="bi bi-emoji-smile"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
              <p>Peserta Wirausaha Mahasiswa Polimedia</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="bi bi-journal-richtext"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
              <p>Proyek Wirausaha Mahasiswa Polimedia</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="bi bi-people"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
              <p>Mentor Wirausaha Mahasiswa Polimedia</p>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Stats Section -->

    <!-- Details Section -->
    <section id="about" class="about section">

      <div class="container section-title" data-aos="fade-up">
        <h2>Details</h2>
        <div><span>TENTANG</span> <span class="description-title">Wirausaha Mahasiswa Polimedia </span></div>
      </div>

      <div class="container">

        <div class="row gy-4 align-items-center features-item">
          <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
            <img src="/assets/img/details-1.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">
            <h3>Informasi Proyek Wirausaha Mahasiswa Polimedia</h3>
            <p class="fst-italic">
              Website ini menampilkan berbagai proyek wirausaha yang dikembangkan oleh mahasiswa sebagai bagian dari Wirausaha Mahasiswa Polimedia.
            </p>
            <ul>
              <li><i class="bi bi-check"></i><span> Mendukung pengembangan ide bisnis mahasiswa.</span></li>
              <li><i class="bi bi-check"></i> <span> Memberikan panduan dan sumber daya untuk wirausaha.</span></li>
              <li><i class="bi bi-check"></i> <span> Menampilkan capaian dan dokumentasi kegiatan Wirausaha Mahasiswa Polimedia.</span></li>
            </ul>
          </div>
        </div>

        <div class="row gy-4 align-items-center features-item">
          <div class="col-md-5 order-1 order-md-2 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="/assets/img/details-2.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 order-2 order-md-1" data-aos="fade-up" data-aos-delay="200">
            <h3>Mentoring dan Pendampingan</h3>
            <p class="fst-italic">
              Setiap mahasiswa peserta Wirausaha Mahasiswa Polimedia mendapatkan bimbingan dari mentor berpengalaman untuk mengembangkan usaha mereka.
            </p>
            <p>
              Pendampingan mencakup strategi bisnis, pemasaran, manajemen keuangan, dan presentasi proyek. Tujuannya adalah membantu mahasiswa meraih keberhasilan wirausaha.
            </p>
          </div>
        </div>
      </div>

    </section><!-- /Details Section -->

    <!-- Gallery Section -->
    <section id="gallery" class="gallery section">

      <div class="container section-title" data-aos="fade-up">
        <h2>Gallery</h2>
        <div><span>Galeri Inovasi </span> <span class="description-title">& Kreativitas Mahasiswa Polimedia</span></div>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-0">

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="/assets/img/gallery/gallery-1.jpg" class="glightbox" data-gallery="images-gallery">
                <img src="/assets/img/gallery/gallery-1.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="/assets/img/gallery/gallery-2.jpg" class="glightbox" data-gallery="images-gallery">
                <img src="/assets/img/gallery/gallery-2.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="/assets/img/gallery/gallery-3.jpg" class="glightbox" data-gallery="images-gallery">
                <img src="/assets/img/gallery/gallery-3.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="/assets/img/gallery/gallery-4.jpg" class="glightbox" data-gallery="images-gallery">
                <img src="/assets/img/gallery/gallery-4.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

        </div>
      </div>

    </section><!-- /Gallery Section -->



  </main>

  <!-- Chatbot Widget -->
  <div id="wm-chatbot" class="wm-chatbot" aria-live="polite" aria-label="Asisten Wirausaha">
    <button id="wm-chatbot-toggle" class="wm-chatbot__toggle" aria-expanded="false" aria-controls="wm-chatbot-panel">
      <i class="bi bi-chat-dots-fill"></i>
      <span class="wm-chatbot__badge">Chat Bot</span>
    </button>
    <div id="wm-chatbot-panel" class="wm-chatbot__panel" role="dialog" aria-modal="false">
      <div class="wm-chatbot__header">
        <div class="wm-chatbot__brand">
          <span class="wm-chatbot__logo">WM</span>
          <div>
            <div class="wm-chatbot__title">Asisten Wirausaha</div>
            <div class="wm-chatbot__subtitle">Bagaimana saya bisa bantu?</div>
          </div>
        </div>
        <button id="wm-chatbot-close" class="wm-chatbot__close" aria-label="Tutup chat"><i class="bi bi-x-lg"></i></button>
      </div>
      <div class="wm-chatbot__content">
        <div id="wm-chatbot-messages" class="wm-chatbot__messages" aria-live="polite"></div>
        <div class="wm-chatbot__suggestions" id="wm-chatbot-suggestions" aria-label="Pertanyaan cepat"></div>
      </div>
      <form id="wm-chatbot-form" class="wm-chatbot__form" autocomplete="off">
        <input id="wm-chatbot-input" class="wm-chatbot__input" type="text" placeholder="Ketik pertanyaan Anda..." aria-label="Ketik pertanyaan" />
        <button class="wm-chatbot__send" type="submit" aria-label="Kirim"><i class="bi bi-send-fill"></i></button>
      </form>
    </div>
  </div>
  <!-- /Chatbot Widget -->

  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="{{ route('home') }}" class="logo d-flex align-items-center">
            <span class="sitename">Wirausaha Mahasiswa Polimedia</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Jl. Srengseng Sawah Raya No.17</p>
            <p>Jakarta Selatan, NY 12630</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+62 21 7864753</span></p>
            <p><strong>Email:</strong> <span>info@wirausahamahasiswapolimedia.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About Wirausaha Mahasiswa Polimedia</a></li>
            <li><a href="#">Projects</a></li>
            <li><a href="#">Terms of Service</a></li>
            <li><a href="#">Privacy Policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Mentoring</a></li>
            <li><a href="#">Workshop</a></li>
            <li><a href="#">Business Consulting</a></li>
            <li><a href="#">Networking</a></li>
            <li><a href="#">Documentation</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12 footer-newsletter">
          <h4>Our Newsletter</h4>
          <p>Subscribe untuk mendapatkan informasi terbaru seputar Wirausaha Mahasiswa Polimedia dan kegiatan wirausaha mahasiswa!</p>
          <form action="forms/newsletter.php" method="post" class="php-email-form">
            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Subscription berhasil. Terima kasih!</div>
          </form>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Wirausaha Mahasiswa Polimedia</strong> <span>All Rights Reserved</span></p>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/php-email-form/validate.js"></script>
  <script src="/assets/vendor/aos/aos.js"></script>
  <script src="/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="/assets/js/main.js"></script>
  <!-- Chatbot Script -->
  <script src="/chatbot/script.js"></script>

</body>

</html>
