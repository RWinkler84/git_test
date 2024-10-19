
<pre><?php

class BankAccount {
    function __construct(private string $iban, private float $balance) {}

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

    function getIban() {
        return $this->iban;
    }
    function getBalance() {
        return $this->balance;
    }
    /* function setBalance($balance) {
        $this->balance = $balance;
    } */
    function atmPayIn($amount) {
        $this->balance+=$amount;
    }
}

$account1 = new BankAccount('DE1234500000000234', 750);
$account2 = new BankAccount('AT12340000000234', 1250);

// var_dump($account1->getIban());
$account1->atmPayIn(100);

// $account1->iban = 'DE12234234230234';
// $account1->balance = 333;
// var_dump($account1->balance);

?></pre>