<?php

namespace App\Providers;

use App\Services\BookStore\BookStorage;
use App\Services\BookStore\BookStoreService;
use App\Services\BookStore\Reader\JSONReader;
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
            $reader = new JSONReader(config('books.file_path'));
            return new BookStorage($reader);
        });
    }
}
