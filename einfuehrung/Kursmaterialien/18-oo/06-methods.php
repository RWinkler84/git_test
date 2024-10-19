<pre><?php

class BankAccount {
    function __construct(public string $iban, public float $balance) {}

    function printBalance() {
        echo "Der Kontostand von {$this->iban} ist: {$this->balance}.\n";
    }

    function sepa(BankAccount $to, float $amount) {
        if ($this->balance < $amount) {
            echo "Die Überweisung von {$amount} Euro konnte nicht durchgeführt werden...\n";
            return;
        }
        echo "Es wird überwiesen von {$this->iban} auf {$to->iban}: {$amount} Euro.\n";
        $this->balance-=$amount; // $this->balance = $this->balance - $amount;
        $to->balance+=$amount; // $to->balance = $to->balance + $amount;
    }
}

$account1 = new BankAccount('DE1234500000000234', 750);
$account2 = new BankAccount('AT12340000000234', 1250);

$account1->sepa($account2, 1500);

$account1->printBalance();
$account2->printBalance();

?></pre>