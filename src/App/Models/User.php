<?php

namespace App\Models;

use App\Exceptions\InvalidArgumentException;

class User extends ActiveRecordEntity
{
    protected $id;

    protected $username;

//    protected $email;
//
//    protected $role;
//
//    protected $password_hash;
//
//    protected $auth_token;
//
//    protected $created_at;

    public static function getTableName(): string
    {
        return 'users';
    }

    public function getUsername() {
        return $this->username;
    }

    public static function signUp(array $userData): User
    {
        if (empty($userData['username'])) {
            throw new InvalidArgumentException('Empty username');
        }
        if (!preg_match('/^[a-zA-Z0-9]+$/', $userData['username'])) {
            throw new InvalidArgumentException('Invalid username (use only latins)');
        }
        if (empty($userData['email'])) {
            throw new InvalidArgumentException('Empty email');
        }
        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email');
        }
        if (empty($userData['password'])) {
            throw new InvalidArgumentException('Empty password');
        }
        if (mb_strlen($userData['password']) < 8) {
            throw new InvalidArgumentException('Invalid password (at least 8 chars)');
        }
        if (static::findOneByColumn('username', $userData['username']) !== null) {
            throw new InvalidArgumentException('User with same username already exists');
        }
        if (static::findOneByColumn('email', $userData['email']) !== null) {
            throw new InvalidArgumentException('User with same email already exists');
        }

        $user = new User();
        $user->username = $userData['username'];
        $user->email = $userData['email'];
        $user->passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);
        $user->isConfirmed = false;
        $user->role = 'user';
        $user->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
        $user->save();

        return $user;
    }

}