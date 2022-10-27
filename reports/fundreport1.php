<?php
require_once '../scripts/connection.php';
set_time_limit(0);
if(count($_POST)>0){
	 $id=$_POST['MemberID'];
	 $d1=$_POST['date1'];
	 $d2=$_POST['date2'];
	 $active = 0;


////////////////////retrieve deceaced id

$ttfundsresult = mysqli_query($conn, "SELECT COUNT(`memberID`) AS 'memberID' FROM `fundsums` WHERE `RetirementFundID`='$id' AND TransactionDate >='$d1' AND TransactionDate <='$d2' AND `Terminated`='$active'  "); 
$ttfundsrow = mysqli_fetch_assoc($ttfundsresult); 
$ttfundmembers = $ttfundsrow['memberID'];

$ttfundsresult = mysqli_query($conn, "SELECT SUM(`ApprovedBenefit`) AS 'ApprovedBenefit' FROM `fundsums` WHERE `RetirementFundID`='$id' AND TransactionDate >='$d1' AND TransactionDate <='$d2' AND `Terminated`='$active'  "); 
$ttfundsrow = mysqli_fetch_assoc($ttfundsresult); 
$ApprovedBenefit = $ttfundsrow['ApprovedBenefit'];


$ttfundsresult = mysqli_query($conn, "SELECT SUM(`NewBalance`) AS 'NewBalance' FROM `fundsums` WHERE `RetirementFundID`='$id' AND TransactionDate >='$d1' AND TransactionDate <='$d2' AND `Terminated`='$active'  "); 
$ttfundsrow = mysqli_fetch_assoc($ttfundsresult); 
$NewBalance = $ttfundsrow['NewBalance'];

$ttfundsresult = mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Opening' FROM `fundsums` WHERE `RetirementFundID`='$id' AND TransactionDate >='$d1' AND TransactionDate <='$d2' AND `Terminated`='$active' AND TransactionTypeID = '1'  "); 
$ttfundsrow = mysqli_fetch_assoc($ttfundsresult); 
$Opening = $ttfundsrow['Opening'];


$ttfundsresult = mysqli_query($conn, "SELECT SUM(`Amount`) AS 'TransferIn' FROM `fundsums` WHERE `RetirementFundID`='$id' AND TransactionDate >='$d1' AND TransactionDate <='$d2' AND `Terminated`='$active' AND TransactionTypeID = '2'  "); 
$ttfundsrow = mysqli_fetch_assoc($ttfundsresult); 
$TransferIn = $ttfundsrow['TransferIn'];

$ttfundsresult = mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Regular' FROM `fundsums` WHERE `RetirementFundID`='$id' AND TransactionDate >='$d1' AND TransactionDate <='$d2' AND `Terminated`='$active' AND TransactionTypeID = '3'  "); 
$ttfundsrow = mysqli_fetch_assoc($ttfundsresult); 
$Regular = $ttfundsrow['Regular'];

$ttfundsresult = mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Adhoc' FROM `fundsums` WHERE `RetirementFundID`='$id' AND TransactionDate >='$d1' AND TransactionDate <='$d2' AND `Terminated`='$active' AND TransactionTypeID = '4'  "); 
$ttfundsrow = mysqli_fetch_assoc($ttfundsresult); 
$Adhoc = $ttfundsrow['Adhoc'];

$ttfundsresult = mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Transfee' FROM `fundsums` WHERE `RetirementFundID`='$id' AND TransactionDate >='$d1' AND TransactionDate <='$d2' AND `Terminated`='$active' AND TransactionTypeID = '5'  "); 
$ttfundsrow = mysqli_fetch_assoc($ttfundsresult); 
$Transfee = $ttfundsrow['Transfee'];


$ttfundsresult = mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Monthly' FROM `fundsums` WHERE `RetirementFundID`='$id' AND TransactionDate >='$d1' AND TransactionDate <='$d2' AND `Terminated`='$active' AND TransactionTypeID = '6'  "); 
$ttfundsrow = mysqli_fetch_assoc($ttfundsresult); 
$Monthly = $ttfundsrow['Monthly'];

$ttfundsresult = mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Admin' FROM `fundsums` WHERE `RetirementFundID`='$id' AND TransactionDate >='$d1' AND TransactionDate <='$d2' AND `Terminated`='$active' AND TransactionTypeID = '7'  "); 
$ttfundsrow = mysqli_fetch_assoc($ttfundsresult); 
$Admin = $ttfundsrow['Admin'];

$ttfundsresult = mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Interest' FROM `fundsums` WHERE `RetirementFundID`='$id' AND TransactionDate >='$d1' AND TransactionDate <='$d2' AND `Terminated`='$active' AND TransactionTypeID = '8'  "); 
$ttfundsrow = mysqli_fetch_assoc($ttfundsresult); 
$Interest = $ttfundsrow['Interest'];

$ttfundsresult = mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Additional' FROM `fundsums` WHERE `RetirementFundID`='$id' AND TransactionDate >='$d1' AND TransactionDate <='$d2' AND `Terminated`='$active' AND TransactionTypeID = '9'  "); 
$ttfundsrow = mysqli_fetch_assoc($ttfundsresult); 
$Additional = $ttfundsrow['Additional'];

$ttfundsresult = mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Other' FROM `fundsums` WHERE `RetirementFundID`='$id' AND TransactionDate >='$d1' AND TransactionDate <='$d2' AND `Terminated`='$active' AND TransactionTypeID = '10'  "); 
$ttfundsrow = mysqli_fetch_assoc($ttfundsresult); 
$Other = $ttfundsrow['Other'];
	
	$response2 = array(
					'statusCode'=>200,
					'approved'=>$ApprovedBenefit,
					'NewBalance'=>$NewBalance,
					'Opening'=>$Opening,
					'TransferIn'=>$TransferIn,
					'Regular'=>$Regular,
					'Adhoc'=>$Adhoc,
					'Transfee'=>$Transfee,
					'Monthly'=>$Monthly,
					'Admin'=>$Admin,
					'Interest'=>$Interest,
					'Additional'=>$Additional,
					'Other'=>$Other
					
					
					);
					echo json_encode($response2);
}
}

}
?>