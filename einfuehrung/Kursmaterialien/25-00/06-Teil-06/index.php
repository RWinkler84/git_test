<pre><?php

abstract class Car {
    abstract protected function getConsumptionValue();

    public function printConsumption() {
        echo "Dieses Auto verbraucht {$this->getConsumptionValue()}.\n";
    }
}

class ElectricCar extends Car {
    protected function getConsumptionValue() {
        return "20kwh/100km";
    }
}

$e = new ElectricCar();
$e->printConsumption();

// $e->getConsumptionValue();


// $c = new Car();
// $c->printConsumption();


?></pre>