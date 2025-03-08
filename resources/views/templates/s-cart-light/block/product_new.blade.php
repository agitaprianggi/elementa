@php
$productsNew = $modelProduct->start()->getProductLatest()->setlimit(sc_config('product_top'))->getData();
@endphp

@if ($productsNew->count())
      <!-- New Products-->
  <section class="section" style="margin-top: 50px;">
    <div class="container">

        <h2 class="wow fadeScale" style="font-family: 'Poppins', sans-serif; font-size: 30px; color:rgb(13, 101, 195); text-transform: none; margin-bottom: 20px;">TEMUKAN PRODUK TERBARU KAMI</h2>

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

            @media (max-width: 767px) {
                .product-grid {
                    display: grid;
                    grid-template-columns: repeat(2, 1fr); /* 2 kolom */
                    gap: 10px; /* Tambahkan jarak antar item */
                    width: 100%;
                    max-width: 100%;
                    box-sizing: border-box; /* Pastikan padding tidak mempengaruhi lebar */
                }

                .product-grid .product-item {
                    width: 100%; /* Pastikan elemen anak tidak lebih besar dari grid */
                    max-width: 100%;
                    overflow: hidden; /* Hindari overflow */
                    box-sizing: border-box;
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