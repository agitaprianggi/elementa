<?php
$prefixProductInfo = sc_config('PREFIX_PRODUCT_INFO_PRODUCT')??'product-info-product';
if (file_exists(app_path('Http/Controllers/ShopProductInfoProductController.php'))) {
    $nameSpaceFrontProduct = 'App\Http\Controllers';
} else {
    $nameSpaceFrontProduct = 'SCart\Core\Front\Controllers';
}

Route::group(['prefix' => $langUrl.$prefixProductInfo], function ($router) use ($suffix, $nameSpaceFrontProduct) {
    $router->get('/', $nameSpaceFrontProduct.'\ShopProductInfoProductController@allProductsProcessFront')
        ->name('product-info-product.all');
    $router->get('/{alias}'.$suffix, $nameSpaceFrontProduct.'\ShopProductInfoProductController@productDetailProcessFront')
        ->name('product-info-product.detail');
});
