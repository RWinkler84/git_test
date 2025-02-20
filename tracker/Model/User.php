<?php

namespace Model;

class User extends AbstractModel
{

    private ?int $userId = null;
    private ?string $userName = 'Guest';
    private ?string $userRole = null;


    public function attemptLogin($userName, $userPassword)
    {
        if ($this->isLoginDataValid($userName, $userPassword)) {
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['userName'] = $userName;
            $_SESSION['userId'] = $this->userId;

            return [
                'message' => 'Erfolgreich eingeloggt.',
                'statusCode' => 200
            ];
        } else {

            return [
                'message' => 'Nutzername und/oder Passwort falsch.',
                'statusCode' => 400
            ];
        }
    }

    private function isLoginDataValid($userName, $userPassword): bool
    {
        $userData = $this->getAllUserData();

        foreach ($userData as $user) {
            if ($user['userName'] == $userName && $user['userPassword'] == $userPassword) {

                $this->userId = $user['id'];

                return true;
            }
        }

        return false;
    }

    public function getAllUserData(): array
    {
        $queryString = 'SELECT * FROM users';

        $userData = $this->db->read($queryString);

        return $userData;
    }

    public function createUserById($userId)
    {

        $queryString = 'SELECT * FROM users WHERE id = :id';
        $params = ['id' => $userId];

        $userData = $this->db->read($queryString, $params);

        if (!empty($userData)) {
            $this->userName = $userData[0]['userName'];
            $this->userId = $userData[0]['id'];
            $this->userRole = $userData[0]['userRole'];
        } else {
            return [
                'responseCode' => 500,
                'message' => 'User nicht gefunden'
            ];
        }
    }


    // GETTER
    public function getUserName(): string
    {
        return $this->userName;
    }


    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getUserRole()
    {
        return $this->userRole;
    }
}
