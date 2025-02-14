<?php

namespace View;

use DateTime;
use Controller\UserController;

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
        $placeholders['greetings'] = isset($_SESSION['userName']) ? "Hi, <span id='userName'>{$user->getUserName()}</span>! Das gibt es zu tun..." : 'Task Tracker-Login';
        $placeholders['filterMenu'] = $user->getUserName() == 'Guest' ? '' : $this->setFilterMenu();
        $placeholders['logout'] = $user->getUserName() == 'Guest' ? '' : '<button id="logoutButton" class="cancelButton " onclick="logout()" style="margin-top: 0;">&#10140;</button>';

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
        $taskDueDate = '';
        $template = '';
        $allUsersSelect = $this->getAllUsersSelect();

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
                $deleteButtonAction = 'requestDeleteTask(this, event)';
                $deleteButtonActive = 'red';
            } else {
                $deleteButtonAction = '';
                $deleteButtonActive = 'inactive';
            }

            if ($task->getTaskStatus() == 'erledigt') {
                $setDoneButtonAction = '';
                $setDoneButtonActive = 'inactive';
            } else {
                $setDoneButtonAction = 'setTaskDone(event)';
                $setDoneButtonActive = 'green';
            }

            // sets time block, if task has date and time
            if ($task->getTaskDueTime() != '') {
                $taskDueTimeBlock = "
                <div class='flex halfGap'>
                    <div class='bold'>Um?</div>
                    <div style='text-wrap: nowrap'>{$task->getTaskDueTime()->format('H:i')}</div>
                </div>";
            } else {
                $taskDueTimeBlock = '';
            }

            //checks, if task has a description and sets an indicator if true
            if ($task->getTaskDescription() != ''){
                $collapsableIndicator = '    
                    <div class="divider flex" style="margin-top: auto; justify-content: center;">
                        <div id="collapsableIndicator" style="box-sizing: content-box; font-size: 10px">&#9660;</div>    
                    </div>';
            } else {
                $collapsableIndicator = '';
            }

            //sets Reminder Dot, if task is due today or tomorrow
            $reminderDot = $this->setReminderDot($task);

            $placeholders = [
                'taskId' => $task->getId(),
                'taskName' => $task->getTaskName(),
                'taskOwner' => $task->getTaskOwner(),
                'taskDueDate' => $task->getTaskDueDate()->format('d.m.y'),
                'taskDueDateString' =>$task->getTaskDueDate()->format('Y-m-d'),
                'taskDueTimeBlock' => $taskDueTimeBlock,
                'collapsableIndicator' => $collapsableIndicator,
                'taskStatus' => $task->getTaskStatus(),
                'taskDescription' => $task->getTaskDescription(),
                'taskUrgency' => $topBarColor,
                'deleteButtonAction' => $deleteButtonAction,
                'deleteButtonActive' => $deleteButtonActive,
                'setDoneButtonAction' => $setDoneButtonAction,
                'setDoneButtonActive' => $setDoneButtonActive,
                'reminderDot' => $reminderDot,
            ];

            $template .= $this->renderComponent('taskContainer', $placeholders);
        }

        $placeholder = [
            'taskList' => $template,
            'allUserSelect' => $allUsersSelect       
        ];


        echo $this->renderView('index', $placeholder);
    }


    public function renderLoginPage()
    {
        echo $this->renderView('login');
    }


    private function setReminderDot($task)
    {
        $reminderDotColor = $this->setReminderDotColor($task);

        if ($reminderDotColor != '') {

            return "<div style='align-self: center'><div class='{$reminderDotColor}'style='border-radius: 50%; padding: 0.5rem; margin-left: 1rem;'></div></div>";
        }

        return '';
    }


    private function setReminderDotColor($task)
    {
        $now = new DateTime('now');
        $taskDueDate = $task->getTaskDueDate()->modify('23:59:59');

        // is a specific time set, add it to the date 
        $task->getTaskDueTime() != '' ? $taskDueDate->modify($task->getTaskDueTime()->format('H:i')) : false;

        if ($task->getTaskStatus() === 'erledigt') {
            return '';
        }

        //is dueDate passed and was on a different day than today?
        if ($taskDueDate < $now && $taskDueDate->format('d.m.y') != $now->format('d.m.y')) {
            return 'redBackground';
        }

        error_log(print_r($taskDueDate->diff($now)->h, true));
        //is dueTime less than six hours away?
        if ($taskDueDate > $now && $taskDueDate->diff($now)->d < 1 && $taskDueDate->diff($now)->h < 6) {
            return 'orangeBackground';
        }

        //is dueDate today?
        if ($taskDueDate->format('d.m.y') == $now->format('d.m.y')) {

            // is a time set on the same day and has already passed?
            if ($task->getTaskDueTime() != '' && $task->getTaskDueTime() < $now) {
                return 'redBackground';
            }

            return 'greenBackground';
        }

        //nothing fits, dueDate is way ahead?
        return $reminderDotColor = '';
    }

    private function getAllUsersSelect()
    {
        $allUsers = UserController::getAllUserData();
        $options = '';
 
        foreach ($allUsers as $user){
            $options .= "<option value='{$user['userName']}'>{$user['userName']}</option>";
        }

        return $options;
    }

    private function setFilterMenu() {
        return '
        <div id="filterMenu" class="flex gap" style="margin-left: auto;">
            <div style="margin-left: auto;"><button id="expandResponsiveMenuButton" open="false">&#9660;</button></div>
            <div class="filterOptionWrapper"><button id="filterOptionAll" class="filterMenuButton" activated>alle</button></div>
            <div class="filterOptionWrapper"><button id="filterOptionMine" class="filterMenuButton">meine</button></div>
            <div class="filterOptionWrapper"><button id="filterOptionToday" class="filterMenuButton">heute</button></div>
            <div class="filterOptionWrapper"><button id="filterOptionTomorrow" class="filterMenuButton">morgen</button></div>
        </div>
        ';
    }
}
