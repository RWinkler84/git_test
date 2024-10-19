<?php

namespace App\Controller;

abstract class AbstractController {

    protected function render($path, array $data = []) {
        ob_start();
        extract($data);
        require __DIR__ . '/../../views/frontend/' . $path . '.view.php';
        $content = ob_get_contents();
        ob_end_clean();
        
        require __DIR__ . '/../../views/frontend/layouts/main.view.php';
    }
}