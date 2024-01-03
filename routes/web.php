<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Backend\BackendController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['prefix'=>'admin','middleware'=>'auth'] , function(){
    Route::get('/',[BackendController::class,'index'])->name('admin');

    Route::post('/cart/store',[CartController::class,'addToCart'])->name('cart.store');
    Route::post('cart-update/{rowId}',[CartController::class,'cartUpdate'])->name('cart.update');
    Route::get('/cart-remove/{rowId}',[CartController::class,'cartRemove'])->name('cart.remove');

    
    Route::post('pdf',[PDFController::class,'index'])->name('generate.pdf');
    Route::get('/download-pdf',[PDFController::class,'downloadPDF'])->name('download.pdf');
    
    Route::resource('product',ProductController::class);
    Route::resource('customer',CustomerController::class);
    Route::resource('user',UserController::class);
    Route::resource('invoice',InvoiceController::class);

        Route::get('january-invoice',[InvoiceController::class,'JanuaryInvoice'])->name('january.invoice');
        Route::get('fedruary-invoice',[InvoiceController::class,'FedruaryInvoice'])->name('fedruary.invoice');
        Route::get('march-invoice',[InvoiceController::class,'MarchInvoice'])->name('march.invoice');
        Route::get('april-invoice',[InvoiceController::class,'AprilInvoice'])->name('april.invoice');
        Route::get('may-invoice',[InvoiceController::class,'MayInvoice'])->name('may.invoice');
        Route::get('june-invoice',[InvoiceController::class,'JuneInvoice'])->name('june.invoice');
        Route::get('july-invoice',[InvoiceController::class,'JulyInvoice'])->name('july.invoice');
        Route::get('augest-invoice',[InvoiceController::class,'AugestInvoice'])->name('augest.invoice');
        Route::get('september-invoice',[InvoiceController::class,'SeptemberInvoice'])->name('september.invoice');
        Route::get('october-invoice',[InvoiceController::class,'OctoberInvoice'])->name('october.invoice');
        Route::get('november-invoice',[InvoiceController::class,'NovemberInvoice'])->name('november.invoice');
        Route::get('december-invoice',[InvoiceController::class,'DecemberInvoice'])->name('december.invoice');

        Route::POST('yearly-invoice/{id}',[InvoiceController::class,'YearlyInvoice'])->name('yearly-invoice.invoice');
});

require __DIR__.'/auth.php';
