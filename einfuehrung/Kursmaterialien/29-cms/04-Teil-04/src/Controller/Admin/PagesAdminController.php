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
        if (!empty($_POST)) {
            $title = @(string) ($_POST['title'] ?? '');
            $slug = @(string) ($_POST['slug'] ?? '');
            $content = @(string) ($_POST['content'] ?? '');

            if (!empty($title) && !empty($slug) && !empty($content)) {
                $this->pagesRepository->create($title, $slug, $content);
            }
        }
        $this->renderAdmin('pages/create', []);
    }
}