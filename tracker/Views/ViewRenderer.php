<?php

namespace View;

class ViewRenderer
{

    public function renderView($view, $placeholders = [])
    {
        global $user;

        $header = file_get_contents(__DIR__ . '/../Views/templates/header.html');
        $template = file_get_contents(__DIR__ . '/../Views/templates/' . $view . '.html');
        $footer = file_get_contents(__DIR__ . '/../Views/templates/footer.html');

        $topMenu = file_get_contents(__DIR__ . '/../Views/templates/components/topMenu.html');


        // global Placeholders
        $placeholders['topMenu'] = $topMenu;
        $placeholders['greetings'] = isset($_SESSION['userName']) ? "Hi, {$user->getUserName()}! Das gibt es zu tun..." : 'Task Tracker-Login';
        $placeholders['logout'] = $user->getUserName() != 'Guest' ? '<button id="logoutButton" class="cancelButton " onclick="logout()" style="margin-top: 0;">&#10140;</button>' : '';

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
