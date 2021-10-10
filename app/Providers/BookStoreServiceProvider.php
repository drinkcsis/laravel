<?php

namespace App\Providers;

use App\Services\Book\BookStoreService;
use App\Services\Book\JSONStorage;
use Illuminate\Support\ServiceProvider;

class BookStoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(BookStoreService::class, static function ($app) {
            return new JSONStorage();
        });
    }
}
