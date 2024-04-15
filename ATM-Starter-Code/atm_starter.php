
<?php
/*
    if (isset ($_POST['withdrawChecking'])) 
    {
        echo "I pressed the checking withdrawal button";
    } 
    else if (isset ($_POST['depositChecking'])) 
    {
        echo "I pressed the checking deposit button";
    } 
    else if (isset ($_POST['withdrawSavings'])) 
    {
        echo "I pressed the savings withdrawal button";
    } 
    else if (isset ($_POST['depositSavings'])) 
    {
        echo "I pressed the savings deposit button";
    } 
    */
    require_once "checking.php";
    require_once "savings.php";
    require_once "process.php";

    $checking = new CheckingAccount($_GET['checkingAccountId'], $_GET['checkingBalance'], $_GET['checkingStartDate']);
    $savings = new SavingsAccount($_GET['savingsAccountId'], $_GET['savingsBalance'], $_GET['savingsStartDate']);
?>

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATM</title>
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
        input[type=text] {width: 80px;}
        .error {color: red;}
        .accountInner {
            margin-left:10px;margin-top:10px;
        }

    </style>
</head>
<body>

    <form method="post" action="atm_starter.php">
               
    <h1>ATM</h1>
        <div class="wrapper">
            
            <div class="account">
                <div class="accountInner">

                    <?= $checking->getAccountDetails(); ?>
                    <input type="hidden" name="checkingAccountId" value="<?= htmlspecialchars($checking->getAccountId()); ?>" />
                    <input type="hidden" name="checkingAccountBalance" value="<?= htmlspecialchars($checking->getBalance()); ?>" />
                    <input type="hidden" name="checkingAccountStartDate" value="<?= htmlspecialchars($checking->getStartDate()); ?>" />
                    <!-- Repeat for savings account -->

                        
                    <input type="text" name="checkingWithdrawAmount" value="" />
                    <input type="submit" name="withdrawChecking" value="Withdraw" />
                </div>
                <div class="accountInner">
                    <input type="text" name="checkingDepositAmount" value="" />
                    <input type="submit" name="depositChecking" value="Deposit" /><br />
                </div>
                
            </div>

            <div class="account">
                    <div class="accountInner">
                        <input type="text" name="savingsWithdrawAmount" value="" />
                        <input type="submit" name="withdrawSavings" value="Withdraw" />
                    </div>
                    <div class="accountInner">
                        <input type="text" name="savingsDepositAmount" value="" />
                        <input type="submit" name="depositSavings" value="Deposit" /><br />
                    </div>
            
            </div>
            
        </div>
    </form>
</body>
</html>
