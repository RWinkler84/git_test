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



    public function renderTaskList($tasks)
    {

        global $user;
        $template = '';

        foreach ($tasks as $task) {

            if ($task->getTaskStatus() == 1) {
                $task->setTaskStatus('erledigt');
                $task->setTaskUrgency('erledigt');
            } else {
                $task->setTaskStatus('offen');
            }

            // decide the color of the tasks top bar depending on urgency
            switch ($task->getTaskUrgency()) {
                case 'hoch':
                    $topBarColor = 'redBackground';
                    break;

                case 'normal':
                    $topBarColor = 'greenBackground';
                    break;

                case 'niedrig':
                    $topBarColor = 'lightest-greenBackground';
                    break;

                case 'erledigt':
                    $topBarColor = 'darker-greyBackground';
                    break;
            }

            // sets whether the delete and set done buttons are active



            $placeholders = [
                'taskId' => $task->getId(),
                'taskName' => $task->getTaskName(),
                'taskOwner' => $task->getTaskOwner(),
                'taskDueDate' => $task->getTaskDueDate(),
                'taskStatus' => $task->getTaskStatus(),
                'taskDescription' => $task->getTaskDescription(),
                'taskUrgency' => $topBarColor,
                'deleteButtonAction' => $user->getUserId() == $task->getTaskCreatorId() ? 'onclick="requestDeleteTask(this)"' : '',
                'deleteButtonActive' => $user->getUserId() == $task->getTaskCreatorId() ? 'red' : 'inactive'
            ];

            $template .= $this->renderComponent('taskContainer', $placeholders);
        }

        $placeholder = ['taskList' => $template];


        echo $this->renderView('index', $placeholder);
    }


    public function renderLoginPage()
    {
        echo $this->renderView('login');
    }
}
