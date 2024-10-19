<?php

namespace App\Controller;

use App\Pages\PagesRepository;

class PagesController extends AbstractController {

    public function __construct(PagesRepository $pagesRepository) {
        parent::__construct($pagesRepository);
    }

    public function showPage(string $pageKey) {
        // var_dump($pageKey);
        $page = $this->pagesRepository->fetchPage($pageKey);
        if (empty($page)) {
            return $this->showError404();
        }

        // var_dump($page);
        $this->render('pages/showPage', [
            'page' => $page
        ]);
    }

}