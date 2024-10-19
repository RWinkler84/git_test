<?php

namespace App\Pages;

class PagesRepository {

    public function fetchPage($key) {
        // TODO
        $pagesModel = new PagesModel();
        $pagesModel->id = 1;
        $pagesModel->key = $key;
        $pagesModel->title = 'Hallo Welt';
        $pagesModel->content = 'Ich bin der Seiteninhalt';
        return $pagesModel;
    }
}
