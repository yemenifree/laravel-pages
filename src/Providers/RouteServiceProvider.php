<?php namespace Gbrock\Providers;

use Gbrock\Models\PageDomain;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RouteServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    public function boot()
    {
        $root = __DIR__.'/../../';

        include $root . 'src/Http/routes.php';

        Route::model('page_template', 'Gbrock\Models\PageTemplate');
        Route::model('page_domain', 'Gbrock\Models\PageDomain');
    }
}
