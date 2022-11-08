<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer(
            ['includes.sidebar', 'user.posts.create', 'user.posts.edit', 'user.categories'], 
            function ($view) {
                $view->with('categories', Category::all());
            }
        );

        Paginator::defaultView('pagination::default');
 
        Paginator::defaultSimpleView('pagination::default');
    }
}
