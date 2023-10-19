<?php

use App\Http\Controllers\Account\SecurityController;
use App\Http\Controllers\Account\SettingsController;
use App\Http\Controllers\Auth\SocialiteLoginController;
use App\Http\Controllers\Auth2\LoginController;
use App\Http\Controllers\Documentation\ReferencesController;
use App\Http\Controllers\Logs\AuditLogsController;
use App\Http\Controllers\Logs\SystemLogsController;
use App\Http\Controllers\Teams\SystemTreeController;
use App\Http\Controllers\Wallets\WalletController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Teams\UserController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomePageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\OrderController;
use TCG\Voyager\Facades\Voyager;

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

// Route::get('/index', function () {
//     return redirect('/');
// });

$menu = theme()->getMenu();
array_walk($menu, function ($val) {
    if (isset($val['path'])) {
        $route = Route::get($val['path'], [PagesController::class, 'index']);

        // Exclude documentation from auth middleware
        if (!Str::contains($val['path'], 'documentation')) {
            $route->middleware('auth');
        }
    }
});

// Route::prefix('mlm')->group(function () {
    Route::middleware('auth')->group(function () {
        // Account pages
        Route::prefix('account')->group(function () {
            Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
            Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
        });

        Route::prefix('account')->group(function () {
            Route::get('security', [SecurityController::class, 'index'])->name('security.index');
            Route::put('security/email', [SecurityController::class, 'changeEmail'])->name('security.changeEmail');
            Route::put('security/password', [SecurityController::class, 'changePassword'])->name('security.changePassword');
            Route::put('security/password2', [SecurityController::class, 'changePassword2'])->name('security.changePassword2');
            Route::post('security/password2', [SecurityController::class, 'createPassword2'])->name('security.createPassword2');

        });
        // Logs pages
        Route::prefix('log')->name('log.')->group(function () {
            Route::resource('system', SystemLogsController::class)->only(['index', 'destroy']);
            Route::resource('audit', AuditLogsController::class)->only(['index', 'destroy']);
        });

        Route::prefix('team')->name('team.')->group(function () {
            Route::resource('system-tree', SystemTreeController::class)->only(['index']);
            Route::get('users', [UserController::class, 'index']);
            Route::get('users/confirm/{id}', [UserController::class, 'confirm'])->name('user.confirm');
            Route::get('fee-users', [UserController::class, 'indexFeeUsers']);
            Route::post('upgrade', [WalletController::class, 'upgrade'])->name('upgrade');
        });
        Route::get('management/products', [ProductController::class, 'index']);
        Route::get('management/products/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('management/products', [ProductController::class, 'store'])->name('product.store');
        Route::get('management/products/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('management/products/update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::get('management/products/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

        Route::get('management/category', [CategoryController::class, 'index']);
        Route::get('management/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('management/category', [CategoryController::class, 'store'])->name('category.store');
        Route::get('management/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('management/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('management/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

        Route::get('management/order', [OrderController::class, 'index']);
        Route::get('management/order/{id}', [OrderController::class, 'show'])->name('order.detail');
        Route::get('gift', [GiftController::class, 'index']);
        Route::get('customer/gratitude', [GiftController::class, 'gratitude']);

        Route::prefix('wallet')->name('wallet.')->group(function () {
            Route::get('upgrade', [WalletController::class, 'indexUpgrade'])->name('upgrade.index');
            Route::post('upgrade', [WalletController::class, 'upgrade'])->name('upgrade');
            Route::get('income-history', [WalletController::class, 'indexIncomeHistory']);
            Route::get('transfer-history', [WalletController::class, 'indexTransferHistory']);
            Route::post('transfer', [WalletController::class, 'create'])->name('transfer.create');
            Route::get('withdrawal-history', [WalletController::class, 'indexWithdrawalHistory']);
            Route::post('withdrawal', [WalletController::class, 'withdrawal'])->name('withdrawal');
            Route::get('withdrawal/confirm/{id}', [WalletController::class, 'confirm'])->name('withdrawal.confirm');
        });
    });
    Route::resource('users', UsersController::class);
// });

Route::get('/', [WelcomePageController::class, 'index'])->name('welcome');
Route::post('/account/forgot-password', [SecurityController::class, 'forgotPassword'])->name('account.forgotPassword');

Route::prefix('shopping')->group(function () {
// Shop and welcome
Route::get('/shop', [ShopController::class, 'index' ])->name('shop.index');
Route::get('/shop/{product}', [ShopController::class, 'show' ])->name('shop.show');
Route::get('/shop/search/{query}', [ShopController::class, 'search' ])->name('shop.search');


// Cart
Route::get('/cart', [CartController::class, 'index' ])->name('cart.index');
Route::post('/cart', [CartController::class, 'store' ])->name('cart.store');
Route::delete('/cart/{product}/{cart}', [CartController::class, 'destroy' ])->name('cart.destroy');
Route::post('/cart/save-later/{product}', [CartController::class, 'saveLater' ])->name('cart.save-later');
Route::post('/cart/add-to-cart/{product}', [CartController::class, 'addToCart' ])->name('cart.add-to-cart');
Route::patch('/cart/{product}', [CartController::class, 'update' ])->name('cart.update');

// checkout
Route::get('/checkout', [CheckoutController::class, 'index' ])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store' ])->name('checkout.store');
Route::get('/guest-checkout', [CheckoutController::class, 'index' ])->name('checkout.guest');

// coupon
Route::post('/coupon', [CouponsController::class, 'index' ])->name('coupon.store');
Route::delete('/coupon/', [CouponsController::class, 'destroy' ])->name('coupon.destroy');

// auth routes
Auth::routes();
Route::get('/login/{provider}', [LoginController::class, 'redirectToProvider']);
Route::get('/login/{provider}/callback', [LoginController::class, 'handleProviderCallback']);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('/country_visits', [VisitsController::class, 'index'])->name('voyager.visits');
});

});
/**
 * Socialite login using Google service
 * https://laravel.com/docs/8.x/socialite
 */
Route::get('/auth/redirect/{provider}', [SocialiteLoginController::class, 'redirect']);

require __DIR__.'/auth.php';
