<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Observers\TransactionObserver;
use App\Repositories\Contracts\CourseRepositoryInterface;
use App\Repositories\Contracts\PricingRepositoryInterface;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Repositories\CourseRepository;
use App\Repositories\PricingRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(PricingRepositoryInterface::class, PricingRepository::class);
        $this->app->singleton(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->singleton(CourseRepositoryInterface::class, CourseRepository::class);
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Transaction::observe(TransactionObserver::class);
    }
}
