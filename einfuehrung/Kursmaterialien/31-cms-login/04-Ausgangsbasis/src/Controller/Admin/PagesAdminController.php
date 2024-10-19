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
            $error = null;
            $title = @(string) ($_POST['title'] ?? '');
            $slug = @(string) ($_POST['slug'] ?? '');
            $content = @(string) ($_POST['content'] ?? '');

            if (!empty($title) && !empty($slug) && !empty($content)) {
                $success = $this->pagesRepository->create($title, $slug, $content);
                if ($success) {
                    header("Location: ./?route=admin/page");
                    return;
                }
                else {
                    $error = 'Der Eintrag konnte nicht angelegt werden (z.B. weil der Slug nicht existiert).';
                }
            } 
            else {
                $error = 'Das Formular wurde nicht vollständig ausgefüllt';
            }

            $this->renderAdmin('pages/create', [
                'error' => $error
            ]);
        }
        else {
            $this->renderAdmin('pages/create', []);
        }
    }

    public function delete($id) {
        $this->pagesRepository->delete($id);
        header("Location: ./?route=admin/page");
    }

    public function edit($id) {
        if (!empty($_POST)) {
            $title = @(string) ($_POST['title'] ?? '');
            $content = @(string) ($_POST['content'] ?? '');

            if (!empty($title) && !empty($content)) {
                $this->pagesRepository->updateTitleAndContent($id, $title, $content);
                header("Location: ./?route=admin/page");
                return;
            }

            $page = $this->pagesRepository->findById($id);
            $this->renderAdmin('pages/edit', [
                'page' => $page,
                'error' => 'Es ist ein Fehler aufgetreten'
            ]);
        }
        else {
            $page = $this->pagesRepository->findById($id);
            $this->renderAdmin('pages/edit', [
                'page' => $page
            ]);
        }
    }
}