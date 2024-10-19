<pre><?php

class Animal {
    public float $weight;
    public function __construct(float $weight) {
        $this->weight = $weight;
        // echo "Ein neues Animal wurde erstellt...\n";
    }
    public function eat() {
        var_dump($this);
        echo "Animal::eat() wurde aufgerufen, mit dem Gewicht: {$this->weight}...\n";
    }
    public function move() {
        echo "Animal::move() wurde aufgerufen...\n";
    }
}

class Dog extends Animal {
    public string $name;
    public function __construct(float $weight, string $name) {
        parent::__construct($weight);
        $this->name = $name;
        //echo "Ein neuer Dog wurde erstellt...\n";
    }
    public function bark() {
        // var_dump($this);
        echo "Dog::bark() wurde aufgerufen {$this->weight}kg mit Namen: {$this->name}...\n";
    }
}

$d = new Dog(20, 'Otto');
$d->bark();
$d->eat();
$d->move();

$a = new Animal(25);
$a->eat();

?></pre>