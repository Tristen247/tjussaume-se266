<?php

require_once "./account.php";

class SavingsAccount extends Account 
{

	public function withdrawal($amount) 
	{
		 // Check if there are sufficient funds for the withdrawal
		 if ($this->balance >= $amount && $amount > 0) {
			// Subtract the amount from the balance
			$this->balance -= $amount;
			// Return true to indicate the withdrawal was successful
			return true;
		} else {
			// Return false if not enough funds or invalid input
			return false;
		}

		// write code here. Return true if withdrawal goes through; false otherwise
	} //end withdrawal

	public function getAccountDetails() 
	{
		$accountDetails = "<h2>Savings Account</h2>";
		$accountDetails .= parent::getAccountDetails();
		
		return $accountDetails;
	   // look at how it's defined in other class. You should be able to figure this out ...
	} //end getAccountDetails
	
} // end Savings



// The code below runs everytime this class loads and 
// should be commented out after testing.
/*
    $savings = new SavingsAccount('S123', 5000, '03-20-2020');
    
    echo $savings->getAccountDetails();
*/
?>
