<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Artikel;

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
    public function boot()
    {
        View::composer('user.layouts.footer', function ($view) {
            $latestArticles = Artikel::with('kategori')
                ->where('status', 'published')
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
            $view->with('latestArticles', $latestArticles);
        });
    }
}
