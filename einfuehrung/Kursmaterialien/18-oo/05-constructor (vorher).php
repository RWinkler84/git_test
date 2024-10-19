<pre><?php

class BankAccount {
    public $iban;
    public $balance;

    function __construct($i, $b) {
        $this->iban = $i;
        $this->balance = $b;
    }

    function printBalance() {
        echo "Der Kontostand von {$this->iban} ist: {$this->balance}.\n";
    }
}

$account1 = new BankAccount('DE1234500000000234', 750);
$account1->printBalance();


$account2 = new BankAccount('AT12340000000234', 1250);
$account2->printBalance();

?></pre>