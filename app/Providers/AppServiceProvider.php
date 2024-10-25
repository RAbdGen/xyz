<?php

namespace App\Providers;

use App\Models\Week;
use App\Models\Track;
use Illuminate\View\View;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Inject currently logged user into UserService
        $this->app->singleton(UserService::class, function (Application $app) {
            return new UserService(
                $app->make(Request::class)->user()
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Inject total tracks count into footer
        Facades\View::composer('components.app', fn (View $view) => $view->with([
            'tracks_count' => Track::count()
        ]));

        // Inject week param to navigation (go back to listing from tracks.show view)
        Facades\View::composer('components.navigation', fn (View $view) => $view->with([
            'week' => request()->week
        ]));
    }
}
