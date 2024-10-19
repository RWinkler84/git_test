<?php

namespace App\Support;

class CsrfHelper {

    public function handle() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if (isset($_POST['csrf_token']) && isset($_SESSION['csrf_token'])) {
                $csrfTokenForm = (string) $_POST['csrf_token'];
                if ($csrfTokenForm === $_SESSION['csrf_token']) {
                    unset($_SESSION['csrf_token']);
                    return;
                }
            }
            
            http_response_code(401);
            echo "CSRF nicht erfolgreich";
            die();
        }
    }

    public function generateToken() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['csrf_token'])) {
            $csrfToken = bin2hex(random_bytes(64));
            $_SESSION['csrf_token'] = $csrfToken;
        }
        return $_SESSION['csrf_token'];
    }
}