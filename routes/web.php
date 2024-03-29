<?php

use App\Http\Controllers\{CityController, AddressController, AjaxController, CategoryController, ClientController, CouponController, ProductController, OptionController, OptionKeyController, OrderController, RatingController, SocialMediaController};
use Illuminate\Support\Facades\{Auth, Route};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
});
Auth::routes();
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect(route('home'));
    })->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('cities', CityController::class);
    Route::get('/admin/getOptionKey', [AjaxController::class, 'getOptionKey'])->name('admin.ajax.getOptionKey');
    Route::get('/order/edit-product', [AjaxController::class, 'editOrderProductByQuantity'])->name('orderProduct.editQuantity');
    Route::get('/admin/categories', [AjaxController::class, 'getCategories'])->name('admin.ajax.getCategories');
    Route::get('/admin/subcategories', [AjaxController::class, 'getSubCategories'])->name('admin.ajax.getSubCategories');
    Route::get('/admin/products', [AjaxController::class, 'getProducts'])->name('admin.ajax.getProducts');
    Route::get('/admin/option-data', [AjaxController::class, 'getOptionData'])->name('admin.ajax.getOptionData');
    Route::get('/admin/product-data', [AjaxController::class, 'getProductData'])->name('admin.ajax.getProductData');
    Route::get('/admin/order-statuses', [AjaxController::class, 'getOrderStatuses'])->name('admin.ajax.getOrderStatuses');
    Route::resource('products', ProductController::class);
    Route::get('productExportExcel', [ProductController::class, 'exportExcel'])->name('products.exportExcel');
    Route::get('productExportPdf', [ProductController::class, 'exportPdf'])->name('products.exportPdf');
    Route::get('productImage', [ProductController::class, 'getImage'])->name('product.image');
    Route::get('getOptionKey', [ProductController::class, 'getOptionKey'])->name('product.optionKey');
    Route::post('productOption', [ProductController::class, 'productOption'])->name('create.productOption');
    Route::post('updateProductOption', [ProductController::class, 'updateProductOption'])->name('productOption.update');
    Route::delete('productsOption/{id}', [ProductController::class, 'productsOptionDestroy'])->name('productsOption.destroy');
    Route::resource('options', OptionController::class);
    Route::resource('optionKeys', OptionKeyController::class);
    // Route::get('option_Keys/{id}',[ OptionKeyController::class, 'index'])->name('optionkeys.get');
    Route::resource('orders', OrderController::class);
    Route::post('orders/destroyProduct',  [OrderController::class, 'destroyProduct'])->name('order.destroyProduct');
    Route::get('order/ExportExcel', [OrderController::class, 'exportExcel'])->name('order.exportExcel');
    Route::get('order/ExportPdf', [OrderController::class, 'exportPdf'])->name('order.exportPdf');
    Route::get('order/Export-Pdf', [OrderController::class, 'exportOrderPdf'])->name('order.exportOrderPdf');
    Route::post('orders/addProduct',  [OrderController::class, 'addProduct'])->name('order.addProduct');
    Route::post('orders/editStatus',  [OrderController::class, 'editStatus'])->name('order.editStatus');
    Route::post('order/cancel',  [OrderController::class, 'cancelOrder'])->name('order.cancel');
    Route::resource('coupons', CouponController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('changeStatus', [CategoryController::class, 'changeStatus'])->name('category.changeStatus');
    Route::get('exportExcel', [CategoryController::class, 'exportExcel'])->name('categories.exportExcel');
    Route::get('exportPdf', [CategoryController::class, 'exportPdf'])->name('categories.exportPdf');
    Route::get('exportOptionExcel', [OptionController::class, 'exportExcel'])->name('options.exportExcel');
    Route::get('exportOptionPdf', [OptionController::class, 'exportPdf'])->name('options.exportPdf');
    Route::get('exportOpKeyExcel/{id}', [OptionKeyController::class, 'exportExcel'])->name('optionKeys.exportExcel');
    Route::get('exportOpKeyPdf/{id}', [OptionKeyController::class, 'exportPdf'])->name('optionKeys.exportPdf');
    Route::resource('clients', ClientController::class)->middleware('auth');
    Route::get('client/ExportExcel', [ClientController::class, 'exportExcel'])->name('client.exportExcel');
    Route::get('client/ExportPdf', [ClientController::class, 'exportPdf'])->name('client.exportPdf');
    Route::resource('socialMedia', SocialMediaController::class);
    Route::resource('ratings', RatingController::class);
});

