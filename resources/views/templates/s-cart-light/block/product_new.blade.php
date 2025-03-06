@php
$productsNew = $modelProduct->start()->getProductLatest()->setlimit(sc_config('product_top'))->getData();
@endphp

@if ($productsNew->count())
      <!-- New Products-->
  <section class="section section-xl bg-default">
    <div class="container">

        <h2 class="wow fadeScale" style="font-size: 30px; color:rgb(13, 101, 195);">Temukan Produk Terbaru Kami</h2>

        Memperkenalkan koleksi buku terbaru, sebuah karya yang penuh dengan cerita mendalam, karakter yang memikat, 
        dan plot yang tak terduga. Dapatkan pengalaman membaca yang tak terlupakan dengan buku yang menawarkan wawasan baru, 
        petualangan menarik, dan emosi yang menggugah. Segera dapatkan buku terbaru kami dan biarkan setiap halamannya membawa Anda ke dunia yang baru. 
        Jangan lewatkan kesempatan untuk menjadi yang pertama menikmati kisah ini!

        <style>
            .product-grid {
                display: grid;
                gap: 30px; /* Jarak antar elemen */
                margin-top: 50px;
            }

            @media (max-width: 767px) { /* Untuk layar HP */
                .product-grid {
                    grid-template-columns: repeat(2, 1fr); /* 2 kolom */
                }
            }

            @media (min-width: 768px) { /* Untuk layar tablet ke atas */
                .product-grid {
                    grid-template-columns: repeat(5, 1fr); /* 5 kolom */
                }
            }
        </style>

        <div class="product-grid">
            @foreach ($productsNew as $key => $productNew)
            <div class="product-item">
                {{-- Render product single --}}
                @include($sc_templatePath.'.common.product_single', ['product' => $productNew])
                {{-- //Render product single --}}
            </div>
            @endforeach
        </div>

    </div>
  </section>
@endif