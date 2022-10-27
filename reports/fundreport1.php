<?php
require_once '../scripts/connection.php';
set_time_limit(0);
if(count($_POST)>0){
	 $id=$_POST['MemberID'];
	 $d1=$_POST['date1'];
	 $d2=$_POST['date2'];
	 $active = 0;


////////////////////retrieve deceaced id

$ttfundsresult = mysqli_query($conn, "SELECT COUNT(DISTINCT `memberID`) AS 'memberID' FROM `fundsums` WHERE `RetirementFundID` = '$id' AND DATE(`TransactionDate`) BETWEEN '$d1'  AND '$d2'  "); 
$ttfundsrow = mysqli_fetch_assoc($ttfundsresult); 
$ttfundmembers = $ttfundsrow['memberID'];

$ttopening = mysqli_query($conn, "SELECT SUM(`Amount`) AS 'Opening' FROM `fundsums` WHERE `RetirementFundID` = '$id' AND DATE(`TransactionDate`) BETWEEN '$d1'  AND '$d2' AND `TransactionTypeID` = '1'  "); 
$ttopeningresult = mysqli_fetch_assoc($ttopening); 
$ttopeningrow = $ttopeningresult['Opening'];
	
	$response2 = array(
					'statusCode'=>200,
					'ttfundmembers'=>$ttfundmembers,
					'ttopeningrow'=>$ttopeningrow
					
					
					
					);
					echo json_encode($response2);
}

?>