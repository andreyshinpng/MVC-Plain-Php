<?php

namespace App\Models;

class User extends ActiveRecordEntity
{
    protected $id;

    protected $username;

    protected $email;

    protected $role;

    protected $password_hash;

    protected $auth_token;

    protected $created_at;

    public static function getTableName(): string
    {
        return 'users';
    }

    public function getUsername() {
        return $this->username;
    }

}