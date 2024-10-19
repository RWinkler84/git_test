<pre><?php

class BankAccount {
    public $iban;
    public $balance;
}

$account1 = new BankAccount();
$account1->iban = 'DE1234500000000234';
$account1->balance = 750;
var_dump($account1);

$account2 = new BankAccount();
$account2->iban = 'AT12345000000234';
$account2->balance = 500;
// $account2->xyz = 'ABC';
var_dump($account2);

?></pre>