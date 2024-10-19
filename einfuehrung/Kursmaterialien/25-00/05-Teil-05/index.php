<pre><?php

class Animal {
    protected float $weight;
    public function __construct(float $weight) {
        $this->weight = $weight;
    }
    public function eat() {
        echo "Animal::eat() wurde aufgerufen, mit dem Gewicht: {$this->weight}...\n";
    }

    public function callEat() {
        // $this->eat();
        self::eat();
    }
}

class Dog extends Animal {
    protected string $name;
    public function __construct(float $weight, string $name) {
        parent::__construct($weight);
        $this->name = $name;
    }
    public function bark() {
        echo "Dog::bark() wurde aufgerufen {$this->weight}kg mit Namen: {$this->name}...\n";
    }

    public function eat() {
        parent::eat();
        echo "Das Essen war für den Hund sehr lecker\n";
    }

    public function eatAndBark() {
        parent::eat();
        $this->bark();
    }
}

$d = new Dog(20, 'Otto');
// $d->bark();
// $d->eat();
$d->callEat();
?></pre>