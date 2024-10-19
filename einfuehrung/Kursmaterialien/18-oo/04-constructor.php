<pre><?php

class BankAccount {
    public $iban;
    public $balance;

    function __construct($i, $b) {
        // var_dump("__construct() wurde aufgerufen!");
        $this->iban = $i;
        $this->balance = $b;
        // var_dump($b);
    }

    function printBalance() {
        echo "Der Kontostand von {$this->iban} ist: {$this->balance}.\n";
    }
}

var_dump("vor dem new BankAccount()");
$account1 = new BankAccount('DE1234500000000234', 750);
var_dump("nach dem new BankAccount()");
// $account1->iban = 'DE1234500000000234';
// $account1->balance = 750;
$account1->printBalance();


$account2 = new BankAccount('AT12340000000234', 1250);
$account2->printBalance();

?></pre>