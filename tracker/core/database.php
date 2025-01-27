<?php

class Database
{
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO('mysql:host=localhost;dbname=tracker', 'root', '');
        } catch (Exception $e) {
            throw new Exception('Die Datenbankverbindung ist fehlgeschlagen ' . $e->getMessage());
            die('Datenbankverbindung konnte nicht aufgebaut werden.');
        }
    }

    public function read(string $queryString, array $params = [])
    {
        $statement = $this->connection->prepare($queryString);

        if (!empty($params)) {
            foreach ($params as $placeholder => $value) {
                $placeholder = str_starts_with($placeholder, ':') ? $placeholder : ':' . $placeholder;
                $statement->bindValue($placeholder, $value);
            }
        }

        try {
            $statement->execute();
        } catch (Exception $e) {
            throw new Exception('Der Query konnte nicht durchgeführt werden ' . $e->getMessage());
        }

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    public function write(string $queryString, array $params = [])
    {
        $statement = $this->connection->prepare($queryString);

        if (!empty($params)) {
            foreach ($params as $placeholder => $value) {
                $placeholder = str_starts_with($placeholder, ':') ? $placeholder : ':' . $placeholder;
                $statement->bindValue($placeholder, $value);
            }
        }

        try {
            $status = $statement->execute();
        } catch (Exception $e) {
            throw new Exception('Der Query konnte nicht durchgeführt werden ' . $e->getMessage());
        }

        return ([
            'statusCode' => 200,
            'message' => 'Daten erfolgreich geändert.'
        ]);
    }
}
