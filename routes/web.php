<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GetAjaxDataController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OtherTransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReceivableController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\TransactionController;
use App\Models\OtherTransaction;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     // return view('login');
//     // return view('home');
//     return view('welcome');
// });
// Route::authUser();

Route::get('/', [AuthController::class, 'index']);
Route::post('login', [AuthController::class, 'postLogin']);

Route::middleware(['userLogin'])->group(function () {
    Route::middleware(['authUser'])->group(function () {
        // Users
        Route::post('register_post', [AuthController::class, 'postRegistration'])->name('register_post');
        Route::get('dashboard', [AuthController::class, 'adminHome'])->name('dashboard');
        Route::get('register', [AuthController::class, 'registration'])->name('register');
        Route::get('users_list', [AuthController::class, 'usersList'])->name('users_list');
        Route::get('user_profile', [AuthController::class, 'userProfile'])->name('user_profile');
        Route::post('profile_post', [AuthController::class, 'profileStore'])->name('profile_post');
        Route::get('edit_user/{id}', [AuthController::class, 'userEdit']);
        Route::post('updated_user', [AuthController::class, 'updateUser'])->name('updated_user');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('deleted_user/{id}', [AuthController::class, 'deleteUser']);

        // Suppliers
        Route::get('suppliers_list', [SuppliersController::class, 'index'])->name('suppliers_list');
        Route::get('add_supplier', [SuppliersController::class, 'addSupplier'])->name('add_supplier');
        Route::post('store_supplier', [SuppliersController::class, 'store'])->name('store_supplier');
        Route::get('edit_supplier/{id}', [SuppliersController::class, 'edit']);
        Route::post('update_supplier', [SuppliersController::class, 'update'])->name('update_supplier');
        Route::get('delete_supplier/{id}', [SuppliersController::class, 'distroy']);

        // Products
        Route::get('products_list', [ProductController::class, 'index'])->name('products_list');
        Route::get('add_product', [ProductController::class, 'create'])->name('add_product');
        Route::post('store_product', [ProductController::class, 'store'])->name('store_product');
        Route::get('edit_product/{id}', [ProductController::class, 'edit']);
        Route::post('update_product', [ProductController::class, 'update'])->name('update_product');
        Route::get('delete_product/{id}', [ProductController::class, 'distroy']);
        Route::get('restock_product', [ProductController::class, 'restockProduct'])->name('restock_product');
        Route::get('price_product', [ProductController::class, 'priceProduct'])->name('price_product');
        Route::post('store_restock_product', [ProductController::class, 'saveRestockProduct'])->name('store_restock_product');
        Route::post('store_price_product', [ProductController::class, 'savePricingProduct'])->name('store_price_product');
        Route::get('product_restock_history', [ProductController::class, 'productRestockHistory'])->name('product_restock_history');
        Route::get('product_price_history', [ProductController::class, 'productPriceHistory'])->name('product_price_history');
        Route::get('edit_restock_history/{id}', [ProductController::class, 'editRestockHistory']);
        Route::get('edit_price_history/{id}', [ProductController::class, 'editPriceHistory']);
        Route::post('update_restock_product', [ProductController::class, 'updateRestockHistory'])->name('update_restock_product');
        Route::post('update_price_product', [ProductController::class, 'updatePriceHistory'])->name('update_price_product');

        // Shop Setup
        Route::get('shop_setup', [ShopController::class, 'shopSetupView'])->name('shop_setup');
        Route::post('shop_setup_save/{id}', [ShopController::class, 'shopSetup']);

        // Receivables
        Route::get('receivables_list', [ReceivableController::class, 'index'])->name('receivables_list');
        Route::get('add_receivable', [ReceivableController::class, 'create'])->name('add_receivable');
        Route::post('store_receivable', [ReceivableController::class, 'store'])->name('store_receivable');
        Route::get('show_receivable/{id}', [ReceivableController::class, 'show']);
        Route::get('delete_receivable/{id}', [ReceivableController::class, 'destroy']);

        // Transactions
        Route::get('transactions_list', [TransactionController::class, 'index'])->name('transactions_list');
        Route::get('add_transaction', [TransactionController::class, 'create'])->name('add_transaction');
        Route::post('store_transaction', [TransactionController::class, 'store'])->name('store_transaction');
        Route::get('show_transaction/{id}', [TransactionController::class, 'show']);
        Route::get('delete_transaction/{id}', [TransactionController::class, 'destroyTransaction']);
        Route::get('delete_invoice/{id}', [TransactionController::class, 'destroy']);

    });

    Route::middleware(['isUser'])->group(function () {
        // Users
        Route::get('home', [AuthController::class, 'userHome'])->name('home');
        Route::get('user_profile_user', [AuthController::class, 'userProfile'])->name('user_profile_user');
        Route::post('profile_post_user', [AuthController::class, 'profileStore'])->name('profile_post_user');
        Route::get('logout_user', [AuthController::class, 'logout'])->name('logout_user');

        // Transactions
        Route::get('transactions_list_user', [TransactionController::class, 'index'])->name('transactions_list_user');
        Route::get('add_transaction_user', [TransactionController::class, 'create'])->name('add_transaction_user');
        Route::post('store_transaction_user', [TransactionController::class, 'store'])->name('store_transaction_user');
        Route::get('show_transaction_user/{id}', [TransactionController::class, 'show']);

    });

    // GetAjaxData
    Route::get('search_product', [GetAjaxDataController::class, 'autoSearchProduct']);
    Route::get('search_invoice', [GetAjaxDataController::class, 'autoSearchInvoice']);
    Route::get('print_receipt/{id}', [TransactionController::class, 'printReceipt']);
    Route::get('print_invoice/{id}', [TransactionController::class, 'printInvoice']);

    Route::get('payments_list', [TransactionController::class, 'payments'])->name('payments_list');
    Route::get('add_payment', [TransactionController::class, 'addPayment'])->name('add_payment');
    Route::post('store_payment', [TransactionController::class, 'store'])->name('store_payment');

    Route::get('income_exp_list', [OtherTransactionController::class, 'index'])->name('income_exp_list');
    Route::get('add_income_exp', [OtherTransactionController::class, 'create'])->name('add_income_exp');
    Route::post('income_exp', [OtherTransactionController::class, 'store'])->name('income_exp');
    Route::get('delete_income/{id}', [OtherTransactionController::class, 'destroy']);

    Route::get('customers', [CustomerController::class, 'index'])->name('customers');
    Route::get('delete_cus/{id}', [CustomerController::class, 'destroy']);
});


