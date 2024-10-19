<?php

namespace App\Controller;

class NotFoundController extends AbstractController {

    public function error404() {
        http_response_code(404);
        $this->render("notfound/error404", []);
        // var_dump("error404() wurde ausgeführt.");
    }
}