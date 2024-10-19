<?php

$account1 = [
    'iban' => 'DE1234000001234123',
    'name' => 'Max Müller',
    'balance' => 750
];

$account2 = [
    'iban' => 'AT1234000001234123',
    'name' => 'Monika Mustermann',
    'balance' => 1250
];

function print_balance($account) {
    echo "Der Kontostand der IBAN {$account['iban']} ist: {$account['balance']}";
}

// print_balance($account2);
// print_balance([]);

function sepa(&$fromAccount, &$toAccount, $amount) {
    if ($fromAccount['balance'] > $amount) {
        $fromAccount['balance'] = $fromAccount['balance'] - $amount;
        $toAccount['balance'] = $toAccount['balance'] + $amount;

        print_r($fromAccount);
    }
}

sepa($account1, $account2, 150);
print_r($account1);

print_balance($account2);

/*
$p1 = [];
$p2 = [];
sepa($p1, $p2, 100);
*/