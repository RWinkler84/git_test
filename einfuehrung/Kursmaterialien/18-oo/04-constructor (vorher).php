<pre><?php

class BankAccount {
    public $iban;
    public $balance;

    function printBalance() {
        echo "Der Kontostand von {$this->iban} ist: {$this->balance}.\n";
    }
}

$account1 = new BankAccount();
$account1->iban = 'DE1234500000000234';
$account1->balance = 750;
$account1->printBalance();


?></pre>