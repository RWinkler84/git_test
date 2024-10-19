<pre><?php

class BankAccount {
    public $iban;
    public $balance;

    function printBalance() {
        // var_dump($this->iban);
        echo "Der Kontostand von {$this->iban} ist: {$this->balance}.\n";
    }
}

$account1 = new BankAccount();
$account1->iban = 'DE1234500000000234';
$account1->balance = 750;
$account1->printBalance();
var_dump($account1);

$account2 = new BankAccount();
$account2->iban = 'AT12345000000234';
$account2->balance = 500;
$account2->printBalance();
var_dump($account2);

?></pre>