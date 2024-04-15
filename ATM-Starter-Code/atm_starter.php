<?php
    require "process.php";
    require_once "checking.php";
    require_once "savings.php";
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATM</title>
    <!-- Bootstrap V5.3-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style type="text/css">
        body {
            margin-left: 120px;
            margin-top: 50px;
            background: lightgray;
        }
        .wrapper {
            display: grid;
            grid-template-columns: 300px 300px;
        }
        .account {
            border: 1px solid black;
            padding: 10px;
        }
        .label {
            text-align: right;
            padding-right: 10px;
            margin-bottom: 5px;
        }
        label {
            font-weight: bold;
        }
        input[type=text] {
            width: 80px;
        }
        .error {
            color: red;
        }
        .accountInner {
            margin-left: 10px;
            margin-top: 10px;
        }
        #text {
            color: red
        }
    </style>
</head>
<body>
    <h1>PHP Bank</h1>
    <br>
    <form method="post">              
        <h2>ATM</h2>
        <div class="wrapper">
            <!-- Checking Account Section -->
            <div class="account">
                <div class="accountInner">
                    <?php
                    echo $checking->getAccountDetails(); 
                    ?>
                    <input type="hidden" name="checkingId" value='<?= $checking->getAccountId(); ?>'>
                    <input type="hidden" name="checkingBalance" value='<?= $checking->getBalance(); ?>'>
                    <input type="hidden" name="checkingAccStartDate" value='<?= $checking->getStartDate(); ?>'>

                    <input type="text" name="checkingWithdrawAmount" value="" />
                    <input type="submit" name="withdrawChecking" value="Withdraw" />
                </div>
                <div class="accountInner">
                    <input type="text" name="checkingDepositAmount" value="" />
                    <input type="submit" name="depositChecking" value="Deposit" /><br />
                </div>
            </div>
            <!-- Savings Account Section -->
            <div class="account">
                <div class="accountInner">
                    <?php
                    echo $savings->getAccountDetails(); 
                    ?>
                    <input type="hidden" name="savingsAccountId" value='<?= $savings->getAccountId(); ?>'>
                    <input type="hidden" name="savingsBalance" value='<?= $savings->getBalance(); ?>'>
                    <input type="hidden" name="savingsAccStartDate" value='<?= $savings->getStartDate(); ?>'>

                    <input type="text" name="savingsWithdrawAmount" value="" />
                    <input type="submit" name="withdrawSavings" value="Withdraw" />
                </div>
                <div class="accountInner">
                    <input type="text" name="savingsDepositAmount" value="" />
                    <input type="submit" name="depositSavings" value="Deposit" /><br />
                </div>

              

</body>
</html>