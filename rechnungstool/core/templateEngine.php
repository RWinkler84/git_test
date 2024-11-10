<?php 

function templateEngine($template, $placeholders)
{
    foreach ($placeholders as $placeholder => $value) {
        $placeholder = '{' . $placeholder . '}';
        $template = str_replace($placeholder, $value, $template);
    }

    return $template;
}