<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;

class LoginController extends AbstractController {

    public function login() {
        if (!empty($_POST)) {
            var_dump("Login wird verarbeitet...");
            var_dump($_POST);
        }
        else {
            $this->renderAdmin('login/login', []);
        }
    }
}