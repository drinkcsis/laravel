<?php

namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class TokenService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Services\Token\TokenService::class;
    }
}
