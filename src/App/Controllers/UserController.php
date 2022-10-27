<?php

namespace App\Controllers;

use App\Exceptions\InvalidArgumentException;
use App\Models\User;
use App\View\View;

class UserController
{
    public function __construct()
    {
        $this->view = new View(__DIR__ . "/../../../templates");
    }

    public function signUp()
    {
        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('signup.php', ['error' => $e->getMessage()]);
                return;
            }
            if ($user instanceof User) {
                $this->view->renderHtml('signup_successful.php');
                return;
            }
        }
        $this->view->renderHtml('signup.php');
    }
}