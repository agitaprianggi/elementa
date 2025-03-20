@php
$categoriesTop = $modelCategory->start()->getCategoryTop()->getData();
@endphp
@if ($categoriesTop->count())
<div class="aside-item col-sm-6 col-md-5 col-lg-12">
  <h6 class="aside-title">{{ sc_language_render('front.categories') }}</h6>
  <select class="form-control" onchange="if (this.value) window.location.href=this.value;">
    <option value="">-- Pilih Kategori --</option>
    @foreach ($categoriesTop as $key => $category)
    <option value="{{ $category->getUrl() }}">{{ $category->title }}</option>
    @endforeach
  </select>
</div>
@endif