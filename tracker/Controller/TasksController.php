<?php

namespace Controller;

use model\Task;

class TasksController extends AbstractController
{

    public function getTaskList()
    {

        $task = new Task;
        $taskData = $task->getAllTasks();

        $tasks = $this->dataArrayToObjectArray('Task', $taskData);


        $this->renderer->renderTaskList($tasks);
    }


    public function saveNewTask()
    {

        if (empty($_POST['taskOwner']) || empty($_POST['taskName']) || empty($_POST['taskDueDate']) || empty($_POST)) {

            $response = [
                'statusCode' => '400',
                'message' => 'Bitte fülle alle Felder aus.'
            ];

            http_response_code(400);
            header('Content-Type: application/json');

            echo json_encode($response);
        } else {

            $task = new Task;

            $task->setTaskOwner($_POST['taskOwner']);
            $task->setTaskName($_POST['taskName']);
            $task->setTaskDueDate($_POST['taskDueDate']);
            $task->setTaskDueTime($_POST['taskDueTime']);
            $task->setTaskDescription($_POST['taskDescription']);
            $task->setTaskUrgency($_POST['taskUrgency']);
            $task->setTaskStatus('0');

            $response = $task->saveTaskToDatabase();

            echo json_encode($response);
        }
    }

    public function setTaskDone()
    {

        $data = json_decode(file_get_contents('php://input'), true);

        if (is_numeric($data['taskId'])) {
            $task = new Task;

            $task->setId($data['taskId']);

            $response = $task->setTaskDone();

            echo json_encode($response);
        }
    }


    public function deleteTask()
    {
        global $user;
        $data = json_decode(file_get_contents('php://input'), true);

        // error_log(is_numeric($data['taskId']));

        if (is_numeric($data['taskId'])) {
            $task = new Task;
            $task->createTaskById($data['taskId']);
        }

        error_log('user-id: ' . $user->getUserId());
        error_log('creatorId: ' . $task->getTaskCreatorId());
        error_log('task: ' . print_r($task, true));

        if ($user->getUserId() == $task->getTaskCreatorId() || $user->getUserRole() == 'Admin') {

            $response = $task->deleteTask();

            echo json_encode($response);
        } else {
            echo json_encode([
                'statusCode' => 300,
                'message' => 'Hör auf zu cheaten!'
            ]);
        }
    }
}
