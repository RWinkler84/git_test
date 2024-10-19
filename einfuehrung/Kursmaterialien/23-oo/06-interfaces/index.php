<?php

interface Person {
    public function getAge(): int;
}

class Student implements Person {
    public function getAge(): int {
        return 21;
    }
}

class Teacher implements Person {
    public function getAge(): int {
        return 40;
    }
}

class Staff implements Person {
    public function getAge(): int {
        return 30;
    }
}

function printAgeOf(Person $person) {
    echo 'Diese Person ist ' . $person->getAge() . ' Jahre alt.';
}

$s = new Teacher();
printAgeOf($s);

var_dump($s instanceof Person);

if ($s instanceof Person) {
    var_dump($s->getAge());
}