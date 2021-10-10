<?php

namespace App\Services\Token;

interface TokenService {
    /**
     * @param array $user
     *
     * @return string
     */
    public function genToken(array $user = []): string;
}
