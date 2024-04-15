<?php
require_once "checking.php";
require_once "savings.php";

// initial values
$initialCheckingId = 'C123';
$initialCheckingBalance = 1000;
$initialCheckingStartDate = '12-20-2019';
$initialSavingsId = 'S123';
$initialSavingsBalance = 5000;
$initialSavingsStartDate = '03-20-2020';

// Create the account objects 
$checking = new CheckingAccount($_POST['checkingAccountId'] ?? $initialCheckingId, 
                                $_POST['checkingAccountBalance'] ?? $initialCheckingBalance, 
                                $_POST['checkingAccountStartDate'] ?? $initialCheckingStartDate);

$savings = new SavingsAccount($_POST['savingsAccountId'] ?? $initialSavingsId, 
                              $_POST['savingsAccountBalance'] ?? $initialSavingsBalance, 
                              $_POST['savingsAccountStartDate'] ?? $initialSavingsStartDate);

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['depositChecking']) && is_numeric($_POST['checkingDepositAmount'])) {
        $checking->deposit((float)$_POST['checkingDepositAmount']);
    } elseif (isset($_POST['withdrawChecking']) && is_numeric($_POST['checkingWithdrawAmount'])) {
        $checking->withdrawal((float)$_POST['checkingWithdrawAmount']);
    }
    //finish and repeat for savings account

    // After processing info, redirect back to atm_starter.php with updated values
    header('Location: atm_starter.php?' . http_build_query([
        'checkingAccountId' => $checking->getAccountId(),
        'checkingBalance' => $checking->getBalance(),
        'checkingStartDate' => $checking->getStartDate(),
        // Add savings account 
    ]));
    exit;
}

