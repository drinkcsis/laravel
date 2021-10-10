<?php

namespace App\Providers;

use App\Services\Token\BearerService;
use App\Services\Token\TokenService;
use App\Services\Token\JWTService;
use Illuminate\Support\ServiceProvider;

class TokenServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(TokenService::class, static function ($app) {
            if(config('token.type') === 'jwt') {
                return new JWTService(config('token.jwt.secret'));
            }
            if(config('token.type') === 'bearer') {
                return new BearerService();
            }
            throw new \InvalidArgumentException('Invalid token type in config/token.php');
        });
    }
}
