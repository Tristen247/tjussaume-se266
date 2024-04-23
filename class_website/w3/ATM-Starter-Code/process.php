<?php
require_once "account.php";
require_once "checking.php";
require_once "savings.php";

if (isset($_POST['checkingId'])){
    //checking
    $checkingAccountId = filter_input(INPUT_POST, 'checkingId', FILTER_SANITIZE_SPECIAL_CHARS);
    $checkingBalance = filter_input(INPUT_POST, 'checkingBalance', FILTER_VALIDATE_FLOAT);
    $checkingAccStartDate = filter_input(INPUT_POST, 'checkingAccStartDate', FILTER_SANITIZE_SPECIAL_CHARS);
    
    //Savings
    $savingsAccountId = filter_input(INPUT_POST, 'savingsAccountId',  FILTER_SANITIZE_SPECIAL_CHARS);
    $savingsBalance = filter_input(INPUT_POST, 'savingsBalance', FILTER_VALIDATE_FLOAT);
    $savingsAccStartDate = filter_input(INPUT_POST, 'savingsAccStartDate',  FILTER_SANITIZE_SPECIAL_CHARS);
}else{
    $checkingAccountId = 'C123';
    $checkingAccStartDate = '12-20-2019';
    $checkingBalance = 1000;
    $savingsAccountId = 'S123';
    $savingsAccStartDate = '03-20-2020';
    $savingsBalance = 5000;
}

$checking = new CheckingAccount ($checkingAccountId, $checkingBalance, $checkingAccStartDate);

$savings = new SavingsAccount ($savingsAccountId, $savingsBalance, $savingsAccStartDate);



if (isset ($_POST['withdrawChecking'])) 
{
    $withdrawAmount = filter_input(INPUT_POST, 'checkingWithdrawAmount', FILTER_VALIDATE_FLOAT);
    if ($withdrawAmount !== false && $withdrawAmount > 0) {
        $result = $checking->withdrawal($withdrawAmount);
        if (!$result) {
            echo "Withdrawal failed due to insufficient funds (overdraft limmit exceeded).";
        }
    } else {
        echo "Invalid withdrawal amount.";
    }
} 
else if (isset ($_POST['depositChecking'])) 
{
    $depositAmount = filter_input(INPUT_POST, 'checkingDepositAmount', FILTER_VALIDATE_FLOAT);
    if ($depositAmount !== false && $depositAmount > 0) {
        $checking->deposit ($depositAmount);
    } else {
        echo "Invalid deposit amount.";
    }
} 
else if (isset ($_POST['withdrawSavings'])) 
{
    $withdrawAmount = filter_input(INPUT_POST, 'savingsWithdrawAmount', FILTER_VALIDATE_FLOAT);
    $savingsBalance = $savings->getBalance(); // Obtain the current balance from the savings object

    if ($withdrawAmount === false || $withdrawAmount <= 0) {
        echo "Invalid withdrawal amount."; // Amount is negative number
    } elseif ($withdrawAmount > $savingsBalance) {
        echo "Withdrawal failed due to insufficient funds."; // Not enough balance
    } else {
        $savings->withdrawal($withdrawAmount); // else let them withdraw the amount requested
    }
}
else if (isset ($_POST['depositSavings'])) 
{
    $depositAmount = filter_input(INPUT_POST, 'savingsDepositAmount', FILTER_VALIDATE_FLOAT);
    if ($depositAmount !== false && $depositAmount > 0) {
        $savings->deposit ($depositAmount);
    } else {
        echo "Invalid deposit amount.";
    }
}

