<?php

namespace View;

use DateTime;

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
        $today = new DateTime('now');
        $taskDueDate = '';
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
            if ($user->getUserId() == $task->getTaskCreatorId() || $user->getUserRole() == 'Admin') {
                $deleteButtonAction = 'requestDeleteTask(this)';
                $deleteButtonActive = 'red';
            } else {
                $deleteButtonAction = '';
                $deleteButtonActive = 'inactive';
            }

            if ($task->getTaskStatus() == 'erledigt') {
                $setDoneButtonAction = '';
                $setDoneButtonActive = 'inactive';
            } else {
                $setDoneButtonAction = 'setTaskDone()';
                $setDoneButtonActive = 'green';
            }

            // sets time block, if task has date and time
            if ($task->getTaskDueTime() != '') {
                $taskDueTimeBlock = "
                <div class='flex halfGap'>
                    <div class='bold'>Um?</div>
                    <div style='text-wrap: nowrap'>{$task->getTaskDueTime()}</div>
                </div>";
            } else {
                $taskDueTimeBlock = '';
            }

            //sets Reminder Dot, if task is due today or tomorrow
            $taskDueDate = $task->getTaskDueDate();

            if ($task->getTaskStatus() === 'erledigt') {
                $reminderDotColor = '';
            } elseif ($taskDueDate < $today) {
                $reminderDotColor = 'redBackground';
            } elseif ($taskDueDate->diff($today)->days <= 1) {
                $reminderDotColor = 'orangeBackground';
            } else {
                $reminderDotColor = '';
            }

            $placeholders = [
                'taskId' => $task->getId(),
                'taskName' => $task->getTaskName(),
                'taskOwner' => $task->getTaskOwner(),
                'taskDueDate' => $taskDueDate->format('d.m.y'),
                'taskDueTimeBlock' => $taskDueTimeBlock,
                'taskStatus' => $task->getTaskStatus(),
                'taskDescription' => $task->getTaskDescription(),
                'taskUrgency' => $topBarColor,
                'deleteButtonAction' => $deleteButtonAction,
                'deleteButtonActive' => $deleteButtonActive,
                'setDoneButtonAction' => $setDoneButtonAction,
                'setDoneButtonActive' => $setDoneButtonActive,
                'reminderDotColor' => $reminderDotColor
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
