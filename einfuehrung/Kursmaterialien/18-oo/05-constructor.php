<pre><?php

class BankAccount {
    /*
    public string $iban;
    public float $balance;

    function __construct(string $iban, float $balance) {
        $this->iban = $iban;
        $this->balance = $balance;
    }
    */
    function __construct(public string $iban, public float $balance) {}

    function printBalance() {
        echo "Der Kontostand von {$this->iban} ist: {$this->balance}.\n";
    }
}

$account1 = new BankAccount('DE1234500000000234', 750);
$account1->printBalance();

$account2 = new BankAccount('AT12340000000234', 1250);
$account2->printBalance();

// $account3 = new BankAccount(1250, 'AT12340000000234');
// $account3->printBalance();

?></pre>