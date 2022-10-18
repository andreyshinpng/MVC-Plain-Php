<?php

namespace App\Models;

class User
{
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }
}