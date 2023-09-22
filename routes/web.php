<?php

use App\Http\Controllers\Account\SecurityController;
use App\Http\Controllers\Account\SettingsController;
use App\Http\Controllers\Auth\SocialiteLoginController;
use App\Http\Controllers\Documentation\ReferencesController;
use App\Http\Controllers\Logs\AuditLogsController;
use App\Http\Controllers\Logs\SystemLogsController;
use App\Http\Controllers\Teams\SystemTreeController;
use App\Http\Controllers\Wallets\WalletController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Teams\UserController;
use App\Http\Controllers\UsersController;
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

Route::get('/', function () {
    return redirect('index');
});

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

// Documentations pages
Route::prefix('documentation')->group(function () {
    Route::get('getting-started/references', [ReferencesController::class, 'index']);
    Route::get('getting-started/changelog', [PagesController::class, 'index']);
});

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

    Route::prefix('wallet')->name('wallet.')->group(function () {
        Route::get('upgrade', [WalletController::class, 'indexUpgrade']);
        Route::post('upgrade', [WalletController::class, 'upgrade'])->name('upgrade');
        Route::get('income-history', [WalletController::class, 'indexIncomeHistory']);
        Route::get('transfer-history', [WalletController::class, 'indexTransferHistory']);
        Route::post('transfer', [WalletController::class, 'create'])->name('transfer.create');
        Route::get('withdrawal-history', [WalletController::class, 'indexWithdrawalHistory']);
    });
});

Route::resource('users', UsersController::class);

/**
 * Socialite login using Google service
 * https://laravel.com/docs/8.x/socialite
 */
Route::get('/auth/redirect/{provider}', [SocialiteLoginController::class, 'redirect']);

require __DIR__.'/auth.php';
