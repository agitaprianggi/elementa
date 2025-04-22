<!-- Page Footer -->
<footer class="section footer-classic bg-dark text-light py-5">
  <div class="container">
    <div class="row row-40 row-md-50 justify-content-between">
      <!-- Logo & Description -->
      <div class="col-md-3">
        <a href="{{ sc_route('home') }}">
          <img class="logo-footer mb-3" style="max-width: 180px; height: auto;" src="{{ sc_file(sc_store('logo', ($storeId ?? null))) }}" alt="{{ sc_store('title', ($storeId ?? null)) }}">
        </a>

        <p class="footer-store-name">Ikuti Kami</p>
        <p class="footer-detail">{!! sc_store('time_active', ($storeId ?? null)) !!}</p>

        <div class="footer-social mt-3">
          <a href="{{ sc_config('facebook_url') }}" target="_blank" class="social-icon"><i class="mdi mdi-facebook"></i></a>
          <!-- <a href="{{ sc_config('twitter_url') }}" class="social-icon"><i class="mdi mdi-twitter"></i></a> -->
          <a href="{{ sc_config('instagram_url') }}" target="_blank" class="social-icon"><i class="mdi mdi-instagram"></i></a>
          <!-- <a href="{{ sc_config('youtube_url') }}" class="social-icon"><i class="mdi mdi-youtube-play"></i></a> -->
        </div>

        <p class="footer-store-name mt-4">Temukan Kami di</p>
        <div class="footer-marketplace mt-2">
          <a href="https://www.tokopedia.com/elementa-media" target="_blank">
            <img src="{{ asset('data/logo/tokopedia-logo-square.png') }}" alt="Tokopedia" style="height: 32px; margin-right: 10px;">
          </a>
          <a href="https://shopee.co.id/elementamedia?entryPoint=ShopByPDP" target="_blank">
            <img src="{{ asset('data/logo/shopee-logo-square.png') }}" alt="Shopee" style="height: 32px;">
          </a>
        </div>
      </div>

      <!-- About Section -->
      <div class="col-md-3">
        <h5 class="footer-title">Tentang Kami</h5>
        <p class="footer-detail-w">PT. Elementa Media Literasi menyediakan buku cetak dan digital dengan tema beragam dan kekinian untuk memenuhi koleksi bacaan Anda.</p>
      </div>

      <!-- Contact Section -->
      <div class="col-md-3">
        <h5 class="footer-title">{{ sc_language_render('front.contact') }}</h5>
        <ul class="list-unstyled contact-list">
          <li><i class="mdi mdi-map-marker"></i> <a href="https://www.google.com/maps?q=-7.842639,110.374167" target="_blank" class="footer-detail">{{ sc_store('address', ($storeId ?? null)) }}</a></li>
          <li><i class="mdi mdi-phone"></i> <a href="tel:#" class="footer-detail">{{ sc_store('long_phone', ($storeId ?? null)) }}</a></li>
          <li><i class="mdi mdi-email-outline"></i> <a href="mailto:#{{ sc_store('email', ($storeId ?? null)) }}" class="footer-detail">{{ sc_store('email', ($storeId ?? null)) }}</a></li>
        </ul>
      </div>

      <!-- Subscribe Section -->
      <div class="col-md-3">
        <h5 class="footer-title">JADILAH YANG PERTAMA!</h5>
        <p class="footer-detail-w">Dapatkan informasi terbaru tentang buku, promo, dan penawaran eksklusif langsung ke email Anda.</p>
        <form class="d-flex mt-3" method="post" action="{{ sc_route('subscribe') }}">
          @csrf
          <input class="form-control me-2" type="email" name="subscribe_email" placeholder="Email Anda" required>
          <button class="btn btn-primary" type="submit"><i class="fl-bigmug-line-paper122"></i></button>
        </form>
      </div>
    </div>
  </div>

  <!-- Footer Bottom -->
  <div class="footer-bottom text-center mt-4 py-3 bg-secondary">
    <p class="mb-0 footer-detail">&copy; <span class="copyright-year"></span> {{ sc_store('title', ($storeId ?? null)) }}. All rights reserved.</p>
    @if (!sc_config('hidden_copyright_footer'))
      <p class="footer-detail text-white">Powered by <a href="{{ config('s-cart.homepage') }}" class="text-white">{{ config('s-cart.name') }} {{ config('s-cart.sub-version') }}</a></p>
    @endif
  </div>
</footer>

<!-- Custom Styles -->
<style>
  .footer-title {
    text-transform: uppercase;
    font-weight: bold;
    margin-bottom: 15px;
    color: white;
  }
  .footer-detail-w {
    color: #A0A0A0;
    transition: color 0.3s;
  }
  .footer-detail {
    color: #A0A0A0;
    transition: color 0.3s;
  }
  .footer-detail:hover {
    color:rgb(255, 192, 45);
  }
  .footer-social {
  display: flex;
  gap: 10px;
  }
  
  .footer-social .social-icon {
  font-size: 24px;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  background-color: rgba(255, 255, 255, 0.1);
  color: #ffffff;
  transition: all 0.3s ease-in-out;
  text-decoration: none;
  }
  .footer-social .social-icon:hover {
  background-color: rgb(255, 192, 45);
  color: #000;
  transform: scale(1.1);
  box-shadow: 0 0 10px rgba(255, 192, 45, 0.8);
  }
  .footer-bottom {
  position: relative; /* Pastikan bukan absolute */
  margin-top: 40px; /* Menambahkan jarak atas */
  padding: 15px 0;
  width: 100%;
  text-align: center;
  background-color: #333;
  }
  .contact-list li {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .contact-list i {
    font-size: 18px;
    color: rgb(255, 192, 45);
    transition: color 0.3s;
  }
  .contact-list i:hover {
    color: white;
  }
  .footer-store-name {
    font-size: 18px;
    font-weight: bold;
    color: rgb(255, 255, 255); /* Warna emas agar lebih mencolok */
    text-transform: uppercase;
    letter-spacing: 1px;
  }
  @media (max-width: 768px) {
  /* Pusatkan ikon kontak */
    .contact-list {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }

    .contact-list li {
      flex-direction: column;
      align-items: center;
      gap: 5px;
    }

    /* Pusatkan ikon sosial */
    .footer-social {
      display: flex;
      justify-content: center; /* Pusatkan ikon di tengah */
      flex-wrap: wrap; /* Jika terlalu banyak, akan turun ke bawah */
      gap: 10px;
      text-align: center;
    }
  }

</style>
