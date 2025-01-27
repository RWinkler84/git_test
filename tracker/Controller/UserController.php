<?php

namespace Controller;

use Model\User;

class UserController extends AbstractController
{


    public function loginPage()
    {

        echo $this->html->renderView('login');
    }

    public function login()
    {
            error_log('daten sind da');
        $user = new User;

        if (!isset($_POST['userName']) || !isset($_POST['password'])) {
            
            $response = [
                'statusCode' => 400,
                'message' => 'Nutzername und Passwort dürfen nicht leer sein.'
            ];

            http_response_code(400);
            header('Content-Type: application/json');

            echo json_encode($response);

        } else {
            $user->attemptLogin($_POST['userName'], $_POST['password']);
        }
    }
}
