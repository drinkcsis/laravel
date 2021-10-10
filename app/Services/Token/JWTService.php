<?php

namespace App\Services\Token;

use ReallySimpleJWT\Token;

class JWTService implements TokenService {

    /**
     * @var $secret string
     */
    protected $secret;

    /**
     * @param $secret string
     */
    public function __construct(string $secret)
    {
        $this->secret = $secret;
    }

    /**
     * @param $user array
     *
     * @return string
     */
    public function genToken(array $user = []): string {
        $expiration = time() + 3600;
        $payload = [
            'user' => $user,
            'iat' => time(),
            'exp' => $expiration,
            'iss' => ''
        ];
        return Token::customPayload($payload, $this->secret);
    }
}
