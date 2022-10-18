<?php

namespace App\Controllers;

use App\View\View;

class MainController
{
    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function main()
    {
    }
}