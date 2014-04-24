<!DOCTYPE html>
<html lang="en">
 <head>
     <title>Process : Paypal Website Payments Pro integration</title>
 </head>
 <body>
 <table border='0' width='40%' cellspacing='2' cellpadding='2' align="center">
<?php
require_once("config.php");
require_once("paypal_website_payment_pro.php");

$firstName =urlencode( $_POST['firstName']);
$lastName =urlencode( $_POST['lastName']);
$creditCardType =urlencode( $_POST['creditCardType']);
$creditCardNumber = urlencode($_POST['creditCardNumber']);
$expDateMonth =urlencode( $_POST['expDateMonth']);
$padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);
$expDateYear =urlencode( $_POST['expDateYear']);
$cvv2Number = urlencode($_POST['cvv2Number']);
$address1 = urlencode($_POST['address1']);
$city = urlencode($_POST['city']);
$state =urlencode( $_POST['state']);
$zip = urlencode($_POST['zip']);
$amount = urlencode($_POST['amount']);
$currencyCode="USD";
$paymentAction = urlencode("Sale");
if($_POST['recurring'] == 1) // For Recurring
{
	$profileStartDate = urlencode(date('Y-m-d h:i:s'));
	$billingPeriod = urlencode($_POST['billingPeriod']);// or "Day", "Week", "SemiMonth", "Year"
	$billingFreq = urlencode($_POST['billingFreq']);// combination of this and billingPeriod must be at most a year
	$initAmt = $amount;
	$failedInitAmtAction = urlencode("ContinueOnFailure");
	$desc = urlencode("Recurring $".$amount);
	$autoBillAmt = urlencode("AddToNextBilling");
	$profileReference = urlencode("Anonymous");
	$methodToCall = 'CreateRecurringPaymentsProfile';
	$nvpRecurring ='&BILLINGPERIOD='.$billingPeriod.'&BILLINGFREQUENCY='.$billingFreq.'&PROFILESTARTDATE='.$profileStartDate.'&INITAMT='.$initAmt.'&FAILEDINITAMTACTION='.$failedInitAmtAction.'&DESC='.$desc.'&AUTOBILLAMT='.$autoBillAmt.'&PROFILEREFERENCE='.$profileReference;
}
else
{
	$nvpRecurring = '';
	$methodToCall = 'doDirectPayment';
}



$nvpstr='&PAYMENTACTION='.$paymentAction.'&AMT='.$amount.'&CREDITCARDTYPE='.$creditCardType.'&ACCT='.$creditCardNumber.'&EXPDATE='.         $padDateMonth.$expDateYear.'&CVV2='.$cvv2Number.'&FIRSTNAME='.$firstName.'&LASTNAME='.$lastName.'&STREET='.$address1.'&CITY='.$city.'&STATE='.$state.'&ZIP='.$zip.'&COUNTRYCODE=US&CURRENCYCODE='.$currencyCode.$nvpRecurring;


$paypal_website_payment_pro = new paypal_website_payment_pro($config['username'], $config['password'], $config['signature'], '', '', $config['isOnline'], FALSE );
$resArray = $paypal_website_payment_pro->hash_call($methodToCall,$nvpstr);
$error = true;
if(isset($resArray["ACK"])) {
    $ack = strtoupper($resArray["ACK"]);
    if($ack=="SUCCESS") {
        $error = false;
    }
}

if($error)
{
	echo '<tr>';
		echo '<td colspan="2" style="font-weight:bold;color:red;" align="center">Error! Please check that u will provide all information correctly.</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td align="right">Ack:</td>';
		echo '<td>'.$resArray["ACK"].'</td>';
	echo '</tr>';
}
else
{
	echo '<tr>';
		echo '<td colspan="2" style="font-weight:bold;color:Green" align="center">Thank You For Your Payment.</td>';
	echo '</tr>';
	
}
?>
</table>
 </body>
</html>