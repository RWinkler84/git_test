<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;

class PagesAdminController extends AbstractController {

    public function index() {
        $this->renderAdmin('pages/index', []);
    }
}