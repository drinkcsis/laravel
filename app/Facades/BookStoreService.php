<?php

namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class BookStoreService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Services\BookStore\BookStoreService::class;
    }
}
