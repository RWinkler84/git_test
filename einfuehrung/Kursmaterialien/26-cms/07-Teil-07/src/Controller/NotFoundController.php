<?php

namespace App\Controller;

class NotFoundController extends AbstractController {

    public function error404() {
        return $this->showError404();
    }
}