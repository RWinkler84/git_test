<?php

namespace model;

class Task extends AbstractModel
{

    private $taskId = null;
    private $taskName = null;
    private $taskOwner = null;
    private $taskStatus;
    private $taskDescription = null;
    private $taskCreationDate = null;
    private $taskDueDate = null;
    private $taskUrgency = null;

    public function getAllTasks()
    {

        $queryString = "SELECT * FROM tasks";

        $results = $this->db->read($queryString);
        $resultsSanitized = [];

        for ($i = 0; $i < count($results); $i++) {

            foreach ($results[$i] as $key => $value) {
                $resultsSanitized[$i][$key] = htmlspecialchars($value);
            }
        }

        return $resultsSanitized;
    }



    public function getTaskById($id) {}

    public function getTasksByOwner($user) {}

    public function saveTaskToDatabase()
    {

        $queryString = 'INSERT INTO tasks (taskName, taskOwner, taskDueDate, taskDescription, taskUrgency, taskStatus) VALUES (:taskName, :taskOwner, :taskDueDate, :taskDescription, :taskUrgency, :taskStatus)';
        $params = [
            'taskName' => $this->taskName,
            'taskOwner' => $this->taskOwner,
            'taskDueDate' => $this->taskDueDate,
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

    public function deleteTask() {
        $queryString = 'DELETE FROM tasks WHERE id = :id';
        $params = ['id' => $this->getId()];

        $status = $this->db->write($queryString, $params);

        return $status;
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
        return $this->taskDueDate;
    }

    public function getTaskUrgency()
    {
        return $this->taskUrgency;
    }
}
