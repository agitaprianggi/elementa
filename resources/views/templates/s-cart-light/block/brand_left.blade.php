@php
$properties = $modelProperty->start()->getData()
@endphp
@if ($properties->count())
<div class="aside-item col-sm-6 col-lg-12">
    <h6 class="aside-title">Produk</h6>
    <div class="row row-10 row-lg-20 gutters-10">
        <div class="group-sm group-tags">
            @foreach ($properties as $property)
            <a class="link-tag" href="{{ $property->getUrl() }}"> {{ $property->name }}</a>
            @endforeach
        </div>
    <!--properties_products-->
    </div>
</div>
<!--/properties_products-->
@endif
