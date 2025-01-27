<?php

namespace Model;

class User extends AbstractModel
{

    private int $userId;
    private string $userName;
    private bool $isAdmin;


    public function attemptLogin($userName, $userPassword)
    {
        if ($this->isLoginDataValid($userName, $userPassword)) {
            $_SESSION['isLoggedIn'] = true;
        }
    }

    private function isLoginDataValid($userName, $userPassword)
    {
        error_log('bin drin');
        $userData = $this->getAllUserData();
        error_log(print_r($userData), true);

        // return false;
    }

    private function getAllUserData(): array
    {
        $queryString = 'SELECT * FROM users';

        $userData = $this->db->read($queryString);

        return $userData;
    }
}
