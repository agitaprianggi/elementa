@php
/*
$layout_page = shop_product_detail
**Variables:**
- $product: no paginate
- $productRelation: no paginate
*/
@endphp

@extends($sc_templatePath.'.layout')

{{-- block_main --}}
@section('block_main_content_center')
@php
    $countItem = 0
@endphp
      <!-- Single Product-->
      <section class="section section-sm section-first bg-default">
        <div class="container">
          <div class="row row-30">
            <div class="col-lg-6">
              <div class="slick-vertical slick-product">
                <!-- Slick Carousel-->
                <div class="slick-slider carousel-parent" id="carousel-parent" data-items="1" data-swipe="true" data-child="#child-carousel" data-for="#child-carousel">
                  <div class="item">
                    <div class="slick-product-figure"><img src="{{ sc_file($product->getImage()) }}" alt="" width="530" height="480"/>
                    </div>
                  </div>
                  @if ($product->images->count())
                  @php
                    $countItem = 1 + $product->images->count();
                  @endphp
                  @foreach ($product->images as $key=>$image)
                  <div class="item">
                    <div class="slick-product-figure"><img src="{{ sc_file($image->getImage()) }}" alt="" width="530" height="480"/>
                    </div>
                  </div>
                  @endforeach
                  @endif
                </div>

                @if ($countItem > 1)
                <div class="slick-slider child-carousel slick-nav-1" id="child-carousel" data-arrows="true" data-items="{{ $countItem }}" data-sm-items="{{ $countItem }}" data-md-items="{{ $countItem }}" data-lg-items="{{ $countItem }}" data-xl-items="{{ $countItem }}" data-xxl-items="{{ $countItem }}" data-md-vertical="true" data-for="#carousel-parent">
                    <div class="item">
                      <div class="slick-product-figure"><img src="{{ sc_file($product->getImage()) }}" alt="" width="530" height="480"/>
                      </div>
                    </div>
                    @foreach ($product->images as $key=>$image)
                    <div class="item">
                      <div class="slick-product-figure"><img src="{{ sc_file($image->getThumb()) }}" alt="" width="530" height="480"/>
                      </div>
                    </div>
                    @endforeach
                  </div>
                @endif

              </div>
            </div>
            <div class="col-lg-6">
              <form id="buy_block" class="product-information" action="{{ sc_route('cart.add') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="product_id" id="product-detail-id" value="{{ $product->id }}" />
                <input type="hidden" name="storeId" id="product-detail-storeId" value="{{ $product->store_id }}" />
                <div class="single-product">
                  <h4 id="product-detail-name" style="
                      font-size: 24px;
                      font-weight: 700;
                      color: #333;
                      margin-bottom: 5px;
                      text-transform: capitalize;
                      position: relative;
                      display: inline-block;">
                      {!! $product->name !!}
                  </h4>

                  <!-- Nama Penulis -->
                  <p class="product-writer" style="
                    font-size: 18px;
                    color: #d76b6b;
                    font-weight: 500;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    margin-top: 12px;
                    padding: 10px 15px;
                    background: #fff3f3;
                    border-radius: 8px;
                    width: fit-content;
                    transition: background 0.3s ease-in-out;">
                    
                    <!-- Ikon dengan background lingkaran -->
                    <span style="
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        width: 30px;
                        height: 30px;
                        background: #ff914d;
                        border-radius: 50%;
                        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                        transition: transform 0.3s ease-in-out;">
                        <i class="fa-solid fa-user-pen" style="color: white; font-size: 16px;"></i> 
                    </span>

                    <!-- Nama Penulis -->
                    <span style="transition: color 0.3s ease-in-out;">
                        Oleh: <span id="product-detail-model" style="font-weight: bold;">{{ $product->writer }}</span>
                    </span>
                </p>

                  {{-- Show price --}}
                  <div class="group-md group-middle">
                    <div class="single-product-price" id="product-detail-price">
                      {!! $product->showPriceDetail() !!}
                    </div>
                  </div>
                  {{--// Show price --}}

                  <!-- <hr class="hr-gray-100"> -->

                @if ($product->kind != SC_PRODUCT_GROUP && $product->allowSale() && !sc_config('product_cart_off'))
                  <div style="
                      display: flex; flex-direction: column; gap: 2px; align-items: flex-start;
                  ">

                    @if ($product->property == 'physical' || $product->property == 'downphys')
                    {{-- Bagian Stepper dan Tombol Beli --}}
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div class="product-stepper">
                                <input class="form-input" name="qty" type="number" value="1" readonly>
                            </div>

                            {{-- Tombol "Beli Versi Cetak" --}}
                            <button id="sc_button-form-process" type="submit" style="
                                background: #0097b2;
                                border: none;
                                padding: 9px 15px;
                                border-radius: 8px;
                                cursor: pointer;
                                transition: background 0.3s ease-in-out;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                gap: 8px;
                                min-width: 160px;
                            " onmouseover="this.style.background='#d9d9d9'" 
                            onmouseout="this.style.background='#0097b2'">
                                <i class="fa fa-cart-plus" style="color: white; font-size: 16px;"></i>
                                <span style="color: white; font-size: 14px; font-weight: bold;">Beli Versi Cetak</span>
                            </button>
                    @endif
                            
                        {{-- Tombol "Beli Versi Digital" --}}
                            @if ($product->property == 'download' || $product->property == 'downphys')
                                <a href="{{ $product->downloadPath->path }}" 
                                    id="sc_button-digital"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    style="
                                        background: #ff914d;
                                        border: none;
                                        padding: 9px 15px;
                                        border-radius: 6px;
                                        cursor: pointer;
                                        transition: background 0.3s ease-in-out;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        gap: 8px;
                                        min-width: 160px;
                                        text-align: center;
                                    "
                                    onmouseover="this.style.background='#d9d9d9'" 
                                    onmouseout="this.style.background='#ff914d'">
                                    <i class="fa fa-book" style="color: white; font-size: 14px;"></i>
                                    <span style="color: white; font-size: 14px; font-weight: bold; text-align: center;">Beli Versi Digital</span>
                                </a>
                            @endif
                        </div>
                @endif

                  {{-- Show attribute --}}
                  @if (sc_config('product_property'))
                  <div id="product-detail-attr">
                      @if ($product->attributes())
                      {!! $product->renderAttributeDetails() !!}
                      @endif
                  </div>
                  @endif
                  {{--// Show attribute --}}

                  {{-- Stock info (dipindah ke bawah tombol) --}}
                    @if (sc_config('product_stock'))
                        <div style="
                            margin-top: 5px; 
                            padding: 5px; 
                            border-radius: 8px; 
                            background: #f8f9fa; 
                            display: inline-block;
                            width: auto
                            margin-bottom: -5px;;
                        ">
                            <strong style="color: #555;">{{ sc_language_render('product.stock_status') }}:</strong>
                            <div id="stock_status" 
                                style="font-weight: bold; padding: 5px 5px; border-radius: 5px; margin-top: 0px; display: inline-block;
                                    @if($product->stock <= 0 && !sc_config('product_buy_out_of_stock')) 
                                        background: #ffccd1; color: #d9534f;
                                    @else 
                                        background: #d4edda; color: #28a745;
                                    @endif">
                                @if($product->stock <= 0 && !sc_config('product_buy_out_of_stock')) 
                                    {{ sc_language_render('product.out_stock') }} 
                                @else 
                                    {{ sc_language_render('product.in_stock') }} 
                                @endif
                            </div> 
                        </div>
                    @endif

                  {{--// Stock info --}}

                  {{-- date available --}}
                  @if (sc_config('product_available') && $product->date_available >= date('Y-m-d H:i:s'))
                      {{ sc_language_render('product.date_available') }}:
                      <span id="product-detail-available">
                          {{ $product->date_available }}
                      </span>
                  @endif
                  {{--// date available --}}

                  {{-- Category info --}}
                  <div style="border-radius: 8px; display: flex; flex-direction: column;">
                      <strong style="font-size: 14px; color: #333;">{{ sc_language_render('product.category') }}:</strong>
                      <div style="display: flex; gap: 6px; flex-wrap: wrap; margin-top: 5px;">
                          @foreach ($product->categories as $category)
                              <a href="{{ $category->getUrl() }}" 
                                style=" padding: 6px 12px; 
                                        border: 1.5px solid #e0e0e0; 
                                        border-radius: 15px; 
                                        font-size: 12px; 
                                        font-weight: 500; 
                                        color: #606060; 
                                        text-decoration: none; 
                                        transition: all 0.3s ease-in-out;" 
                                onmouseover="this.style.backgroundColor='#ff914d'; 
                                              this.style.color='white'; 
                                              this.style.borderColor='#ff914d'; 
                                              this.style.boxShadow='0 3px 6px rgba(0, 0, 0, 0.1)';"
                                onmouseout="this.style.backgroundColor='transparent'; 
                                            this.style.color='#606060'; 
                                            this.style.borderColor='#e0e0e0'; 
                                            this.style.boxShadow='none';">
                                  {{ $category->getTitle() }}
                              </a>
                          @endforeach
                      </div>
                  </div>
                  {{--// Category info --}}

                  {{-- Brand info --}}
                  @if (sc_config('product_brand') && !empty($product->brand->name))
                  <div>
                      {{ sc_language_render('product.brand') }}:
                      <span id="product-detail-brand">
                          {!! empty($product->brand->name) ? 'None' : '<a href="'.$product->brand->getUrl().'">'.$product->brand->name.'</a>' !!}
                      </span>
                  </div>
                  @endif
                  {{--// Brand info --}}

                  {{-- Product kind --}}
                  @if ($product->kind == SC_PRODUCT_GROUP)
                    <div class="products-group">
                        @php
                        $groups = $product->groups
                        @endphp
                        <b>{{ sc_language_render('product.kind_group') }}</b>:<br>
                        @foreach ($groups as $group)
                        <span class="sc-product-group">
                            <a target=_blank href="{{ $group->product->getUrl() }}">
                                {!! sc_image_render($group->product->image) !!}
                            </a>
                        </span>
                        @endforeach
                    </div>
                  @endif

                  @if ($product->kind == SC_PRODUCT_BUILD)
                    <div class="products-group">
                        @php
                        $builds = $product->builds
                        @endphp
                        <b>{{ sc_language_render('product.kind_bundle') }}</b>:<br>
                        <span class="sc-product-build">
                            {!! sc_image_render($product->image) !!} =
                        </span>
                        @foreach ($builds as $k => $build)
                        {!! ($k) ? '<i class="fa fa-plus" aria-hidden="true"></i>':'' !!}
                        <span class="sc-product-build">{{ $build->quantity }} x
                            <a target="_new" href="{{ $build->product->getUrl() }}">{!!
                                sc_image_render($build->product->image) !!}</a>
                        </span>
                        @endforeach
                    </div>
                  @endif
                {{-- Product kind --}}

                  <!-- <hr class="hr-gray-100"> -->

                {{-- Social --}}
                <div style="display: flex; align-items: center; gap: 10px; margin-top: 15px; padding: 10px; border-radius: 8px;">
                    <span style="font-size: 14px; font-weight: 600; color: #333;">Bagikan:</span>
                    <div>
                        <ul style="display: flex; gap: 8px; list-style: none; padding: 0; margin: 0;">
                        @php
                            use Illuminate\Support\Str;

                            $url = rawurlencode(url()->current()); // Gunakan rawurlencode() agar spasi tetap %20
                            $title = rawurlencode($product->name ?? config('app.name'));

                            // Ambil konten produk, hilangkan tag HTML, dan batasi panjangnya
                            $rawDescription = strip_tags(sc_html_render($product->content));
                            $description = rawurlencode(Str::limit($rawDescription, 150, '...'));
                        @endphp

                            <li>
                                <a href="https://api.whatsapp.com/send?text={{ $title }}%0A{{ request()->description ?? '' }}%0A{{ $url }}" target="_blank" class="social-btn" style="background-color: #25D366;">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://t.me/share/url?url={{ $url }}&text={{ $title }}" target="_blank" 
                                class="social-btn" style="background-color: #0088cc;">
                                    <i class="fa-brands fa-telegram"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://social-plugins.line.me/lineit/share?url={{ $url }}" target="_blank" 
                                class="social-btn" style="background-color: #00c300;">
                                    <i class="fa-brands fa-line"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank" 
                                class="social-btn" style="background-color: #3b5998;">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/intent/tweet?text={{ $title }}&url={{ $url }}" target="_blank" 
                                class="social-btn" style="background-color: #1da1f2;">
                                    <i class="fa-brands fa-x-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" onclick="copyToClipboard()" class="social-btn" style="background-color: #555;">
                                    <i class="fa-solid fa-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                {{-- // Social --}}
                
                </div>
              </form>
            </div>
          </div>
        <!-- Bootstrap Tabs -->
        <div class="custom-tabs">
            <!-- Nav Tabs -->
            <ul class="nav nav-tabs justify-content-center" id="myTab">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-deskripsi" data-bs-toggle="tab" href="#tabs-1-1">Deskripsi Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-info" data-bs-toggle="tab" href="#tabs-1-2">Informasi Tambahan</a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content p-4">
                <!-- Deskripsi Produk -->
                <div class="tab-pane fade show active" id="tabs-1-1">
                    <p>{!! sc_html_render($product->content) !!}</p>
                </div>

                <!-- Informasi Tambahan -->
                <div class="tab-pane fade" id="tabs-1-2">
                    <table class="table table-borderless">
                        <tbody>
                            <tr><td><strong>Ukuran</strong></td><td>{{ $product->length }} x {{ $product->width }}</td></tr>
                            <tr><td><strong>Halaman</strong></td><td>{{ $product->page }}</td></tr>
                            <tr><td><strong>Tahun Terbit</strong></td><td>{{ $product->year }}</td></tr>
                            <tr><td><strong>Penulis</strong></td><td>{{ $product->writer }}</td></tr>
                            <tr><td><strong>Penerbit</strong></td><td>{{ $product->supplier->name }}</td></tr>
                            <tr><td><strong>ISBN</strong></td><td>{{ $product->isbn }}</td></tr>
                            <tr><td><strong>e-ISBN</strong></td><td>{{ $product->eisbn }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
      </section>


      @if ($productRelation->count())
      <!-- Related Products-->
      <section class="section section-sm section-last bg-default">
        <div class="container">
          <h4 class="font-weight-sbold">{{ sc_language_render('front.products_recommend') }}</h4>
          <div class="row row-lg row-10 row-lg-30 justify-content-center">
            @foreach ($productRelation as $key => $productRel)
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                  {{-- Render product single --}}
                  @include($sc_templatePath.'.common.product_single', ['product' => $productRel])
                  {{-- //Render product single --}}
            </div>
            @endforeach
          </div>
        </div>
      </section>
      @endif

<!--/product-details-->

<style>
  .button-group {
      display: flex;
      align-items: center; /* Pusatkan secara vertikal */
      gap: 10px; /* Beri jarak antar elemen */
      flex-wrap: wrap; /* Jika terlalu sempit, elemen akan turun ke baris berikutnya */
  }

  .button-lg {
      padding: 14px 10px;
      font-size: 20px;
      line-height: 1;
      letter-spacing: .025em;
      border-radius: 6px;
      color: #ffffff;
      background: #0097b2 ;
      border: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: background 0.3s ease;
  }

  .button-lg:hover {
      background: #d9d9d9; /* Efek hover */
  }

  .single-product .button {
      min-width: 70px;
      min-height: 70px;
      font-size: 24px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 6px;
      background: #0097b2 ;
      border: none;
      cursor: pointer;
      transition: background 0.3s ease;
  }

  .single-product .button:hover {
      background: #d9d9d9; /* Efek hover */
  }

  /* Menghilangkan card terluar */
.custom-tabs {
    background: transparent;
    padding: 0;
    box-shadow: none;
    margin-top: 30px;
}

/* Styling untuk Tabs */
.nav-tabs {
    border-bottom: none;
    background: #0097b2; /* Warna yang diinginkan */
    padding: 10px;
    border-radius: 10px 10px 0 0;
    display: flex;
    justify-content: center; /* Membuat tab lebih rapi */
}

.nav-tabs .nav-link {
    color: white;
    padding: 12px 20px;
    font-weight: bold;
    border-radius: 20px;
    margin: 5px;
    transition: all 0.3s ease-in-out;
}

.nav-tabs .nav-link.active {
    background: rgba(255, 255, 255, 0.2);
    color: white;
}

/* Styling untuk konten tab */
.tab-content {
    background: white;
    border-radius: 0 0 10px 10px;
    padding: 20px;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08); /* Shadow lebih lembut */
}

/* Styling untuk tabel informasi tambahan */
.table-borderless td {
    padding: 12px;
}

.social-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        color: white;
        font-size: 18px;
        text-decoration: none;
        transition: transform 0.3s ease-in-out;
    }

    .social-btn:hover {
        transform: scale(1.1);
    }

/* Responsif agar tampil lebih baik di mobile */
@media (max-width: 768px) {
    .nav-tabs {
        flex-direction: column;
        align-items: center;
    }

    .nav-tabs .nav-link {
        width: 100%;
        text-align: center;
    }
}


  /* Responsif */
  @media (min-width: 576px) {
      .button-lg {
          padding: 17px 10px;
          font-size: 24px;
          min-height: 70px;
      }

      .single-product .button {
          min-width: 70px;
          min-height: 70px;
          font-size: 24px;
      }
  } 
  .product-stepper {
    display: none;
    }  
</style>

@endsection
{{-- block_main --}}


@push('styles')
{{-- Your css style --}}
@endpush

@push('scripts')
{{-- //script here --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var triggerTabList = [].slice.call(document.querySelectorAll('.nav-tabs a'))
        triggerTabList.forEach(function (triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl)
            triggerEl.addEventListener('click', function (event) {
                event.preventDefault()
                tabTrigger.show()
            })
        })
    });

    function copyToClipboard() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert("Link disalin!");
        }).catch(err => {
            console.error("Gagal menyalin link", err);
        });
    }
</script>
@endpush
