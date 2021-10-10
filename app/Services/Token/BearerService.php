<?php

namespace App\Services\Token;

use Illuminate\Support\Str;

class BearerService implements TokenService {
    /**
     * @param array $user
     *
     * @return string
     */
    public function genToken(array $user = []): string {
        return hash('sha256', $plainTextToken = Str::random(40));
    }
}
