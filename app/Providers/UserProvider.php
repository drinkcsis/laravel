<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider as IlluminateUserProvider;

class UserProvider implements IlluminateUserProvider
{
    /**
     * @var array
     */
    protected $allow_users;

    public function __construct()
    {
        $this->allow_users = [
            'user1' => '111',
            'user2' => '222'
        ];
    }

    /**
     * @param mixed $identifier
     *
     * @return void
     */
    public function retrieveById($identifier)
    {
        // Get and return a user by their unique identifier
        return $this->allow_users[$identifier];
    }

    /**
     * @param mixed  $identifier
     * @param string $token
     *
     * @return void
     */
    public function retrieveByToken($identifier, $token)
    {
        // Get and return a user by their unique identifier and "remember me" token
        dd('UserProvider::retrieveByToken');
    }

    /**
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        // Save the given "remember me" token for the given user
        dd('UserProvider::updateRememberToken');
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        // Get and return a user by looking up the given credentials
        if (empty($credentials) ||
            (count($credentials) === 1 &&
             array_key_exists('password', $credentials))) {
            return;
        }

        $userName = $credentials['name'];
        if(!array_key_exists($userName, $this->allow_users) ||
           $this->allow_users[$userName] !== $credentials['password']) {
            return;
        }

        return $this->getGenericUser([
            'name'      => $userName,
            'password'  => $this->allow_users[$userName]
        ]);
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // Check that given credentials belong to the given user
        return $credentials['password'] === $user->getAuthPassword();
    }

    /**
     * Get the generic user.
     *
     * @param mixed $user
     *
     * @return \App\Models\User|null
     */
    protected function getGenericUser($user)
    {
        if (! is_null($user)) {
            return new User((array) $user);
        }
    }

}
