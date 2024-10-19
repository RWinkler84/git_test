<?php

namespace Admin;

use PDO;

class User {
    public function printName() {
        // $pdo = new PDO();
        $role = new Role();
        echo 'printName() von der Klasse Admin/User wurde aufgerufen';
    }
}