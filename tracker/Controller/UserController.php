<?php

namespace Controller;

use Model\User;

class UserController extends AbstractController
{

    public function loginPage()
    {
        $this->renderer->renderLoginPage();
    }

    public function login()
    {
        $user = new User;

        if (empty($_POST['userName']) || empty($_POST['password'])) {

            $response = [
                'statusCode' => 400,
                'message' => 'Nutzername und Passwort dürfen nicht leer sein.'
            ];

            http_response_code(400);
            header('Content-Type: application/json');

            echo json_encode($response);
        } else {

            $response =  $user->attemptLogin($_POST['userName'], $_POST['password']);
            header('Content-Type: application/json');

            echo json_encode($response);
        }
    }


    public function logout()
    {
        session_destroy();
        header('Content-Type: application/json');

        echo json_encode([
            'responseCode' => 200,
            'message' => 'Du wurdest erfolgreich ausgeloggt.'
        ]);
    }
}
