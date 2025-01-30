<?php

namespace Model;

use DateTime;

class Task extends AbstractModel
{

    private $taskId = null;
    private $taskName = null;
    private $taskCreatorId = null;
    private $taskOwner = null;
    private $taskStatus;
    private $taskDescription = null;
    private $taskCreationDate = null;
    private $taskDueDate = null;
    private $taskDueTime = null;
    private $taskUrgency = null;


    public function getAllTasks()
    {

        $queryString = "SELECT * FROM tasks ORDER BY taskDueDate DESC";

        $results = $this->db->read($queryString);
        $resultsSanitized = [];

        for ($i = 0; $i < count($results); $i++) {

            foreach ($results[$i] as $key => $value) {
                $resultsSanitized[$i][$key] = htmlspecialchars($value);
            }
        }

        $results = $this->sortTasks($resultsSanitized);

        return $results;
    }


    public function saveTaskToDatabase()
    {
        global $user;

        $queryString = 'INSERT INTO tasks (taskName, taskCreatorId, taskOwner, taskDueDate, taskDueTime, taskDescription, taskUrgency, taskStatus) VALUES (:taskName, :taskCreatorId, :taskOwner, :taskDueDate, :taskDueTime, :taskDescription, :taskUrgency, :taskStatus)';
        $params = [
            'taskName' => $this->taskName,
            'taskCreatorId' => $user->getUserId(),
            'taskOwner' => $this->taskOwner,
            'taskDueDate' => $this->taskDueDate,
            'taskDueTime' => $this->taskDueTime == '' ? null : $this->taskDueTime,
            'taskDescription' => $this->taskDescription,
            'taskUrgency' => $this->taskUrgency,
            'taskStatus' => $this->taskStatus
        ];

        $status = $this->db->write($queryString, $params);

        return $status;
    }


    public function setTaskDone()
    {
        $queryString = 'UPDATE tasks SET taskStatus = 1 WHERE id = :id';
        $params = ['id' => $this->getId()];

        $status = $this->db->write($queryString, $params);

        return $status;
    }


    public function deleteTask()
    {
        $queryString = 'DELETE FROM tasks WHERE id = :id';
        $params = ['id' => $this->getId()];

        $status = $this->db->write($queryString, $params);

        return $status;
    }

    public function getTaskById($id) {}


    public function getTasksByOwner($user) {}


    private function sortTasks($tasksArray)
    {
        $openTasks = [];
        $doneTasks = [];

        // chronologisch neuste nach älteste 
        // usort($tasksArray, function ($a, $b) {
        //     return $a['taskDueDate'] < $b['taskDueDate'];
        // });

        // erledigte nach hinten
        for ($i = 0; $i < count($tasksArray); $i++){

            if ($tasksArray[$i]['taskStatus'] == 0){
                $openTasks[] = $tasksArray[$i];
            } else {
                $doneTasks[] = $tasksArray[$i];
            }
        }

        return array_merge($openTasks, $doneTasks);
    }


   // SETTER 

    public function setId($id)
    {
        $this->taskId = $id;
    }

    public function setTaskName($taskName)
    {
        $this->taskName = $taskName;
    }

    public function setTaskCreatorId($taskCreatorId)
    {
        $this->taskCreatorId = $taskCreatorId;
    }

    public function setTaskOwner($taskOwner)
    {
        $this->taskOwner = $taskOwner;
    }

    public function setTaskStatus($taskStatus)
    {
        $this->taskStatus = $taskStatus;
    }

    public function setTaskDescription($taskDescription)
    {
        $this->taskDescription = $taskDescription;
    }

    public function setTaskCreationDate($taskCreationDate)
    {
        $this->taskCreationDate = $taskCreationDate;
    }

    public function setTaskDueDate($taskDueDate)
    {
        $this->taskDueDate = $taskDueDate;
    }

    public function setTaskDueTime($taskDueTime)
    {
        $this->taskDueTime = $taskDueTime;
    }

    public function setTaskUrgency($taskUrgency)
    {
        $this->taskUrgency = $taskUrgency;
    }


    // GETTER

    public function getId()
    {
        return $this->taskId;
    }

    public function getTaskName()
    {
        return $this->taskName;
    }

    public function getTaskCreatorId()
    {
        return $this->taskCreatorId;
    }

    public function getTaskOwner()
    {
        return $this->taskOwner;
    }

    public function getTaskStatus()
    {
        return $this->taskStatus;
    }

    public function getTaskDescription()
    {
        return $this->taskDescription;
    }

    public function getTaskCreationDate()
    {
        return $this->taskCreationDate;
    }

    public function getTaskDueDate()
    {   
        $taskDueDate = new DateTime($this->taskDueDate);

        return $taskDueDate->format('d.m.y');
    }

    public function getTaskDueTime()
    {   
        if ($this->taskDueTime == ''){

            return '';
        }

        $taskDueTime = new DateTime($this->taskDueTime);

        return $taskDueTime->format('H:i');
    }

    public function getTaskUrgency()
    {
        return $this->taskUrgency;
    }
}
