@php
/*
$layout_page = shop_home
**Variables:**
- $products: paginate
Use paginate: $products->appends(request()->except(['page','_token']))->links()
*/ 
@endphp

@extends($sc_templatePath.'.layout')

{{--  block_main_content_center  --}}
@section('block_main_content_center')
 
  @if (count($products))
    <div class="product-top-panel group-md">
      <!-- Render pagination result -->
      @include($sc_templatePath.'.common.pagination_result', ['items' => $products])
      <!--// Render pagination result -->
      
      <!-- Render include filter sort -->
      @include($sc_templatePath.'.common.product_filter_sort', ['filterSort' => $filter_sort])
      <!--// Render include filter sort -->
    </div>

    <style>
      .product-grid {
          display: grid;
          gap: 30px; /* Jarak antar elemen */
          margin-top: 50px;
      }

      .product-item img {
          width: 100%;
          height: auto; /* Hindari pemotongan vertikal */
          object-fit: contain; /* Atau gunakan 'cover' kalau ingin crop proporsional */
          display: block;
      }

      .product-item .image-wrapper {
          width: 100%;
          height: auto;
          overflow: hidden;
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
              grid-template-columns: repeat(4, 1fr); /* 4 kolom */
          }
      }
  </style>

    <div class="product-grid">
        @foreach ($products as $key => $product)
        <div class="product-item">
            {{-- Render product single --}}
            @include($sc_templatePath.'.common.product_single', ['product' => $product])
            {{-- //Render product single --}}
        </div>
        @endforeach
    </div>
    <!-- //Product list -->

    <!-- Render pagination -->
    @include($sc_templatePath.'.common.pagination', ['items' => $products])
    <!--// Render pagination -->
  @else
    <div class="product-top-panel group-md">
      <p style="text-align:center">{!! sc_language_render('front.no_item') !!}</p>
    </div>
  @endif

@endsection
{{--  //block_main_content_center  --}}


@push('styles')
@endpush

@push('scripts')
<!-- //script here -->
@endpush