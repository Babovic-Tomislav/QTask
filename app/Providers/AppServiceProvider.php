<?php

namespace App\Providers;

use App\Contract\AuthorSelectTransformerInterface;
use App\Transformer\AuthorSelectTransformer;
use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(AuthorSelectTransformerInterface::class, function () {
            return new AuthorSelectTransformer();
        });
    }
}
