@php
/*
$layout_page = product_info_list
**Variables:**
- $subCategory: paginate
Use paginate: $subCategory->appends(request()->except(['page','_token']))->links()
- $productInfos: paginate
Use paginate: $productInfos->appends(request()->except(['page','_token']))->links()
*/ 
@endphp

@extends($sc_templatePath.'.layout')

{{-- block_main_content_center --}}
@section('block_main_content_center')
  {{-- sub category --}}
  @isset ($subCategory)
    @if($subCategory->count())
    <h6 class="aside-title">{{ sc_language_render('front.sub_categories') }}</h6>
    <div class="row item-folder">
        @foreach ($subCategory as $key => $item)
        <div class="col-6 col-sm-4 col-md-2">
            <div class="item-folder-wrapper product-single">
                <div class="single-products">
                    <div class="productinfo text-center product-box-{{ $item->id }}">
                        <a href="{{ $item->getUrl() }}"><img src="{{ sc_file($item->getThumb()) }}"
                                alt="{{ $item->title }}" /></a>
                        <a href="{{ $item->getUrl() }}">
                            <p>{{ $item->title }}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

      {{-- Render pagination --}}
      @include($sc_templatePath.'.common.pagination', ['items' => $subCategory])
      {{--// Render pagination --}}
      
    </div>
    @endif
  @endisset
  {{-- //sub category --}}

  @if (count($productInfos))
    <div class="product-top-panel group-md">
      <!-- Render pagination result -->
      @include($sc_templatePath.'.common.pagination_result', ['items' => $productInfos])
      <!--// Render pagination result -->
      
      <!-- Render include filter sort -->
      @include($sc_templatePath.'.common.product_filter_sort', ['filterSort' => $filter_sort])
      <!--// Render include filter sort -->
    </div>


    <!-- Product list -->
    <div class="row row-30 row-lg-50">
      @foreach ($productInfos as $key => $product)
      <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4">
          <!-- Render product single -->
          @include($sc_templatePath.'.common.product_info_single', ['product' => $product])
          <!-- //Render product single -->
        </div>
      @endforeach
    </div>
    <!-- //Product list -->

    <!-- Render pagination -->
    @include($sc_templatePath.'.common.pagination', ['items' => $productInfos])
    <!--// Render pagination -->
  @else
  <div class="product-top-panel group-md">
    <p style="text-align:center">{!! sc_language_render('front.no_item') !!}</p>
  </div>
  @endif

@endsection
{{-- //block_main_content_center --}}


@push('styles')
{{-- Your css style --}}
@endpush

@push('scripts')
{{-- //script here --}}
@endpush