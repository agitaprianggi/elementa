@php
$banners = $modelBanner->start()->setType('banner')->getData()
@endphp
@if ($banners->count())
<section class="section swiper-container swiper-slider swiper-slider-1" data-loop="true" data-autoplay="5000" style="border-radius: 0 0 50px 50px;">
  <div class="swiper-wrapper text-center text-lg-left">
    @foreach ($banners as $key => $banner)
    <div class="swiper-slide swiper-slide-caption context-dark" data-slide-bg="{{ sc_file($banner->image) }}">
      <div class="swiper-slide-caption section-md text-center">
        <div class="container">
          <a href="{{ sc_route('banner.click',['id' => $banner->id]) }}" target="{{ $banner->target }}">
            {!! sc_html_render($banner->html) !!}
          </a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <!-- Swiper Pagination-->
  <div class="swiper-pagination"></div>
  <!-- Swiper Navigation-->
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</section>
<!--slider-->
@endif

<style>
  .elementor-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* 3 kolom jika lebar cukup, 1 kolom jika layar sempit */
    gap: 20px; /* Jarak antar elemen */
  }

  .elementor-column {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .elementor-widget-wrap {
    text-align: center;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    background-color: #fff;
  }

  .elementor-icon-box-icon {
    font-size: 40px;
    display: inline-block; /* Pastikan tidak tersembunyi */
    color: #007bff;
  }

  .elementor-icon-box-title {
    font-size: 18px;
    font-weight: bold;
  }

  .elementor-icon-box-description {
    font-size: 14px;
    color: #666;
  }
</style>

<section class="container" style="margin-top: 50px;">
  <div class="elementor-container">
    <div class="elementor-column">
      <div class="elementor-widget-wrap">
        <div class="elementor-icon-box-icon">
          <i class="fas fa-book"></i>
        </div>
        <h5 class="elementor-icon-box-title">Distributor Buku</h5>
        <p class="elementor-icon-box-description">
          Siap melayani dan melengkapi kebutuhan koleksi bahan pustaka Anda
        </p>
      </div>
    </div>
    <div class="elementor-column">
      <div class="elementor-widget-wrap">
        <div class="elementor-icon-box-icon">
          <i class="fa fa-book-open"></i>
        </div>
        <h5 class="elementor-icon-box-title">Penerbitan Buku</h5>
        <p class="elementor-icon-box-description">
          Menerbitkan konten berkualitas sesuai standar Elementa Media Literasi
        </p>
      </div>
    </div>
    <div class="elementor-column">
      <div class="elementor-widget-wrap">
        <div class="elementor-icon-box-icon">
          <i class="fas fa-thumbs-up"></i>
        </div>
        <h5 class="elementor-icon-box-title">Partner Literasi</h5>
        <p class="elementor-icon-box-description">
          Siap berinovasi mengembangkan produk-produk di bidang literasi bersama Anda
        </p>
      </div>
    </div>
  </div>
</section>
