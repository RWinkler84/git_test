<pre><?php

class Animal {
    public function __construct() {
        echo "Ein neues Animal wurde erstellt...\n";
    }
    public function eat() {
        echo "Animal::eat() wurde aufgerufen...\n";
    }
    public function move() {
        echo "Animal::move() wurde aufgerufen...\n";
    }
}

class Dog extends Animal {
    public function __construct() {
        parent::__construct();
        echo "Ein neuer Dog wurde erstellt...\n";
    }
    public function bark() {
        echo "Dog::bark() wurde aufgerufen...\n";
    }
}

$d = new Dog();
$d->bark();
$d->eat();
$d->move();


?></pre>