<?php

namespace App\Support;

use PDO;

class AuthService {

    public function __construct(protected PDO $pdo) {}


    public function handleLogin(string $username, string $password): bool {
        $stmt = $this->pdo->prepare('SELECT * FROM `users` WHERE `username` = :username');
        $stmt->bindValue(':username', $username);
        $stmt->setFetchMode(PDO::FETCH_CLASS, AuthServiceUser::class);
        $stmt->execute();
        $user = $stmt->fetch();

        $passwordOk = password_verify($password, $user->password);
        
        return $passwordOk;
    }
}