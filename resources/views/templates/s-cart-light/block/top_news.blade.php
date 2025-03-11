@php
$news = $modelNews->start()->setlimit(sc_config('item_top'))->getData();
@endphp

@if ($news->count())
<!-- START SECTION NEWS -->
  <section class="section" style="margin: 50px 0 20px 0;">
    <div class="container">
      <h2 class="wow fadeScale" style="font-family: 'Poppins', sans-serif; font-size: 30px; color:rgb(13, 101, 195); text-transform: none; margin-bottom: 20px;">{{ sc_language_render('front.blog') }}</h2>
      
      Menghadirkan artikel terbaru yang penuh dengan informasi terkini, analisis mendalam, dan perspektif yang berharga. 
      Dapatkan pembaruan langsung dari sumber terpercaya, mencakup berbagai topik penting yang mempengaruhi dunia Anda. 
      Jangan lewatkan kesempatan untuk tetap up-to-date dengan perkembangan terbaru dan jadilah yang pertama mengetahui informasi yang relevan dan penting
    </div>
    <!-- Owl Carousel-->
    <div class="owl-carousel owl-style-7" data-items="1" data-sm-items="2" data-xl-items="3" data-xxl-items="4" data-nav="true" data-dots="true" data-margin="30" data-autoplay="true">
      @foreach ($news as $blog)
        {{-- Render product single --}}
        @include($sc_templatePath.'.common.blog_single', ['blog' => $blog])
        {{-- //Render product single --}}
      @endforeach
    </div>
  </section>
<!-- END SECTION NEWS -->
@endif