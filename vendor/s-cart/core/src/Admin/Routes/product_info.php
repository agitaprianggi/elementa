<?php
if (file_exists(app_path('Admin/Controllers/AdminProductInfoController.php'))) {
    $nameSpaceAdminProductInfo = 'App\Admin\Controllers';
} else {
    $nameSpaceAdminProductInfo = 'SCart\Core\Admin\Controllers';
}
Route::group(['prefix' => 'product_info'], function () use ($nameSpaceAdminProductInfo) {
    Route::get('/', $nameSpaceAdminProductInfo.'\AdminProductInfoController@index')->name('admin_product_info.index');
    Route::get('create', $nameSpaceAdminProductInfo.'\AdminProductInfoController@create')->name('admin_product_info.create');
    Route::get('build_create', $nameSpaceAdminProductInfo.'\AdminProductInfoController@createProductBuild')->name('admin_product_info.build_create');
    Route::get('group_create', $nameSpaceAdminProductInfo.'\AdminProductInfoController@createProductGroup')->name('admin_product_info.group_create');
    Route::post('/create', $nameSpaceAdminProductInfo.'\AdminProductInfoController@postCreate')->name('admin_product_info.create');
    Route::get('/edit/{id}', $nameSpaceAdminProductInfo.'\AdminProductInfoController@edit')->name('admin_product_info.edit');
    Route::post('/edit/{id}', $nameSpaceAdminProductInfo.'\AdminProductInfoController@postEdit')->name('admin_product_info.edit');
    Route::post('/delete', $nameSpaceAdminProductInfo.'\AdminProductInfoController@deleteList')->name('admin_product_info.delete');
    Route::post('/clone', $nameSpaceAdminProductInfo.'\AdminProductInfoController@cloneProduct')->name('admin_product_info.clone');
});