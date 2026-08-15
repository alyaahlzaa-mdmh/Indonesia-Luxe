<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PackageApprovalController;
use App\Http\Controllers\Admin\PaymentValidationController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\VendorApprovalController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PaymentSubmissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TourCatalogController;
use App\Http\Controllers\UserBookingController;
use App\Http\Controllers\Vendor\BookingController as VendorBookingController;
use App\Http\Controllers\Vendor\DashboardController as VendorDashboardController;
use App\Http\Controllers\Vendor\ProfileController as VendorProfileController;
use App\Http\Controllers\Vendor\ReportController as VendorReportController;
use App\Http\Controllers\Vendor\TourDepartureSlotController;
use App\Http\Controllers\Vendor\TourPackageController as VendorTourPackageController;
use App\Http\Controllers\VendorPromoController;
use App\Http\Controllers\VendorRegistrationController;
use App\Http\Controllers\VendorReviewController;
use App\Http\Controllers\VendorWalletController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/language-switch', [LanguageController::class, 'switch'])->name('language.switch');

Route::get('/tours', [TourCatalogController::class, 'index'])->name('tours.index');
Route::get('/tours/{tourPackage:slug}', [TourCatalogController::class, 'show'])->name('tours.show');
Route::get('/promo/{slug?}', \App\Livewire\Guest\PromoDetail::class)->name('promo.show');

Route::middleware('guest')->group(function () {
    Route::get('/vendor/register', [VendorRegistrationController::class, 'create'])->name('vendor.register');
    Route::post('/vendor/register', [VendorRegistrationController::class, 'store'])->name('vendor.register.store');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified', 'role:customer'])->group(function () {
    Route::prefix('profile')
        ->name('profile.')
        ->group(function () {
            Route::get('/', [ProfileController::class, 'index'])->name('index');
            Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
            Route::put('/', [ProfileController::class, 'update'])->name('update');
            Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
            Route::delete('/wishlist/{wishlist}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
        });

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/items', [CartController::class, 'store'])->name('cart.items.store');
    Route::patch('/cart/items/{cartItem}', [CartController::class, 'update'])->name('cart.items.update');
    Route::delete('/cart/items/{cartItem}', [CartController::class, 'destroy'])->name('cart.items.destroy');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

    Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout.create');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::get('/orders/{order}', [UserBookingController::class, 'show'])->name('orders.show');
    Route::get('/bookings', [UserBookingController::class, 'index'])->name('bookings.index');

    Route::get('/orders/{order}/payment-submissions/create', [PaymentSubmissionController::class, 'create'])->name('payments.create');
    Route::post('/orders/{order}/payment-submissions', [PaymentSubmissionController::class, 'store'])->name('payments.store');

    Route::post('/bookings/{booking}/reviews', [ReviewController::class, 'store'])->name('bookings.reviews.store');
    Route::get('/logout', function () {
        return redirect('/');
    });
});

Route::prefix('vendor')
    ->name('vendor.')
    ->middleware(['auth', 'verified', 'role:vendor'])
    ->group(function () {
        Route::get('/pending', [VendorProfileController::class, 'pending'])->name('pending');
        Route::get('/profile', [VendorProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [VendorProfileController::class, 'update'])->name('profile.update');

        Route::middleware('vendor.approved')->group(function () {
            Route::get('/dashboard', VendorDashboardController::class)->name('dashboard');

            Route::resource('packages', VendorTourPackageController::class)
                ->parameters(['packages' => 'tourPackage']);
            Route::post('/packages/{tourPackage}/submit', [VendorTourPackageController::class, 'submit'])->name('packages.submit');

            Route::post('/packages/{tourPackage}/slots', [TourDepartureSlotController::class, 'store'])->name('slots.store');
            Route::patch('/slots/{tourDepartureSlot}', [TourDepartureSlotController::class, 'update'])->name('slots.update');
            Route::delete('/slots/{tourDepartureSlot}', [TourDepartureSlotController::class, 'destroy'])->name('slots.destroy');

            Route::get('/bookings', [VendorBookingController::class, 'index'])->name('bookings.index');
            Route::get('/bookings/{booking}', [VendorBookingController::class, 'show'])->name('bookings.show');
            Route::patch('/bookings/{booking}/complete', [VendorBookingController::class, 'complete'])->name('bookings.complete');

            Route::get('/review', [VendorReviewController::class, 'index'])->name('review.index');
            Route::get('/reports/sales', VendorReportController::class)->name('reports.sales');
            Route::get('/reports/sales/export', [VendorReportController::class, 'export'])->name('reports.sales.export');
            Route::get('/wallet', [VendorWalletController::class, 'index'])->name('wallet.index');
            Route::post('/wallet/withdraw', [VendorWalletController::class, 'withdraw'])->name('wallet.withdraw');
            Route::get('/promo', [VendorPromoController::class, 'index'])->name('promo.index');
            Route::post('/promo', [VendorPromoController::class, 'storePromo'])->name('promo.store');
            Route::put('/promo/{promo}', [VendorPromoController::class, 'updatePromo'])->name('promo.update');
            Route::delete('/promo/{promo}', [VendorPromoController::class, 'destroyPromo'])->name('promo.destroy');
            Route::post('/gift-card', [VendorPromoController::class, 'storeGiftCard'])->name('gift-card.store');
            Route::put('/gift-card/{giftCard}', [VendorPromoController::class, 'updateGiftCard'])->name('gift-card.update');
            Route::delete('/gift-card/{giftCard}', [VendorPromoController::class, 'destroyGiftCard'])->name('gift-card.destroy');
        });
    });

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified', 'role:admin'])
    ->group(function () {
        Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
        Route::get('/vendors', [VendorApprovalController::class, 'index'])->name('vendors.index');
        Route::patch('/vendors/{vendorProfile}', [VendorApprovalController::class, 'update'])->name('vendors.update');

        Route::get('/packages', \App\Livewire\Admin\PackageManagement::class)->name('packages.index');
        Route::patch('/packages/{tourPackage}', [PackageApprovalController::class, 'update'])->name('packages.update');

        Route::get('/payments', \App\Livewire\Admin\PaymentValidation::class)->name('payments.index');
        Route::patch('/payments/{paymentSubmission}', [PaymentValidationController::class, 'update'])->name('payments.update');

        Route::get('/promos', \App\Livewire\Admin\PromoGiftManagement::class)->name('promos.index');
        Route::get('/withdrawals', \App\Livewire\Admin\WithdrawalManagement::class)->name('withdrawals.index');

        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/reports/monthly', \App\Livewire\Admin\MonthlyReport::class)->name('reports.monthly');
    });

require __DIR__.'/settings.php';
