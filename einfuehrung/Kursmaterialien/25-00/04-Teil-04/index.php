<pre><?php

class Animal {
    private float $weight;
    public function __construct(float $weight) {
        $this->weight = $weight;
    }
    public function eat() {
        echo "Animal::eat() wurde aufgerufen, mit dem Gewicht: {$this->weight}...\n";
    }
}

class Dog extends Animal {
    private string $name;
    // private float $weight;
    public function __construct(float $weight, string $name) {
        parent::__construct($weight);
        $this->name = $name;
        // $this->weight = 30;
    }
    public function bark() {
        echo "Dog::bark() wurde aufgerufen {$this->weight}kg mit Namen: {$this->name}...\n";
    }
}

$d = new Dog(20, 'Otto');
var_dump($d);
$d->bark();
$d->eat();

?></pre>