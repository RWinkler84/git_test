<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;

class PagesAdminController extends AbstractController {

    public function index() {
        $pages = $this->pagesRepository->fetchAll();
        $this->renderAdmin('pages/index', [
            'pages' => $pages
        ]);
    }

    public function create() {
        $this->renderAdmin('pages/create', []);
    }
}