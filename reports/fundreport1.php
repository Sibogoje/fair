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


	
	$response2 = array(
					'statusCode'=>200,
					'approved'=>$ApprovedBenefit
					
					
					
					);
					echo json_encode($response2);
}

?>