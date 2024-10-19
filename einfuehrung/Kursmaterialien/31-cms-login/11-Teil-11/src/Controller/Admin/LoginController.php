<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Pages\PagesRepository;
use App\Support\AuthService;

class LoginController extends AbstractController {

    public function __construct(
        PagesRepository $pagesRepository, 
        protected AuthService $authService) {

        parent::__construct($pagesRepository);
    }

    public function logout() {
        $this->authService->logout();
        header("Location: ./?route=admin/login");
    }

    public function login() {
        if (!empty($_POST)) {
            $username = @(string) ($_POST['username'] ?? '');
            $password = @(string) ($_POST['password'] ?? '');

            if (!empty($username) && !empty($password)) {
                $loginOk = $this->authService->handleLogin($username, $password);
                if ($loginOk) {
                    header("Location: ./?route=admin/page");
                    return;
                }
            }
            header("Location: ./?route=admin/login");
            return;
        }
        else {
            $this->renderAdmin('login/login', []);
        }
    }
}