<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(\App\Services\CartService $cartService): void
    {
        $this->configureDefaults();

        // Register observers
        \App\Models\Booking::observe(\App\Observers\BookingObserver::class);

        \Illuminate\Support\Facades\View::composer('partials.navbar', function ($view) use ($cartService) {
            $cartCount = 0;
            if (auth()->check()) {
                /** @var \App\Models\User $user */
                $user = auth()->user();
                $cartCount = $cartService->getOrCreateCart($user)->items()->count();
            }
            $view->with('cartCount', $cartCount);
        });
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(
            fn (): ?Password => app()->isProduction()
                ? Password::min(12)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
                : null
        );
    }
}
