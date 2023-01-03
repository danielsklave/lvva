<?php

namespace App\Providers;

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

        setlocale(LC_TIME, 'lv-LV.UTF-8');
        \Carbon\Carbon::setLocale(config('app.locale'));

        Paginator::defaultView('pagination::default');
 
        Paginator::defaultSimpleView('pagination::default');

        Blade::directive('admin', function() {
            return "<?php if(auth()->user() && auth()->user()->is_admin): ?>";
        });
    
        Blade::directive('endadmin', function() {
            return "<?php endif; ?>";
        });
    }
}
