
<pre><?php

class BankAccount {
    public function __construct(private string $iban, private float $balance) {}

    private function printBalance() {
        echo "Der Kontostand von {$this->iban} ist: {$this->balance}.\n";
    }

    public function sepa(BankAccount $to, float $amount) {
        if ($this->balance < $amount) {
            echo "Die Überweisung von {$amount} Euro konnte nicht durchgeführt werden...\n";
            return;
        }
        echo "Es wird überwiesen von {$this->iban} auf {$to->iban}: {$amount} Euro.\n";
        $this->balance-=$amount; // $this->balance = $this->balance - $amount;
        $to->balance+=$amount; // $to->balance = $to->balance + $amount;
        $this->printBalance();
        $to->printBalance();
    }

    public function getIban() {
        return $this->iban;
    }
    public function getBalance() {
        return $this->balance;
    }
    public function atmPayIn($amount) {
        $this->balance+=$amount;
        $this->printBalance();
    }
}

$account1 = new BankAccount('DE1234500000000234', 750);
$account2 = new BankAccount('AT12340000000234', 1250);

// $account1->atmPayIn(100);
// $account1->printBalance();

$account1->sepa($account2, 100);
?></pre>