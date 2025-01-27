<?php

namespace View;

class ViewRenderer
{

    public function renderView($view, $placeholders = [])
    {
        $header = file_get_contents(__DIR__ . '/../views/templates/header.html');
        $template = file_get_contents(__DIR__ . '/../views/templates/' . $view . '.html');
        $footer = file_get_contents(__DIR__ . '/../views/templates/footer.html');

        if (!empty($placeholders)) {
            foreach ($placeholders as $placeholder => $value) {

                $template = str_replace('{' . $placeholder . '}', $value, $template);
            }
        }

        $pageHTML = $header . $template . $footer;

        return $pageHTML;
    }

        public function renderComponent($component, $placeholders = [])
    {
        $template = file_get_contents(__DIR__ . '/../views/templates/components/' . $component . '.html');

        if (!empty($placeholders)) {
            foreach ($placeholders as $placeholder => $value) {

                $template = str_replace('{' . $placeholder . '}', $value, $template);
            }
        }

        return $template;
    }
}
