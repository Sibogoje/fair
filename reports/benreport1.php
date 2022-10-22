<?php
require_once '../scripts/connection.php';
set_time_limit(0);
if(count($_POST)>0){
	 $id=$_POST['MemberID'];
	 $d1=$_POST['date1'];
	 $d2=$_POST['date2'];
	 $active = 0;
	 $DDD=$_POST['date1'];
	 $DDDD=$_POST['date2'];

////////////////////retrieve deceaced id
$stmt = $conn->prepare("SELECT `MemberNo` ,  `ApprovedBenefit` , `balance` FROM `tblmembers1` WHERE `MemberNo`=? ");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$totalapproved = 0;
$totalrunning = 0;

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
$ApprovedBenefit = $row['ApprovedBenefit'];	
$ruuning_balance = $row['balance'];
$MemberNo =  $id;


$stmtq = $conn->prepare("
SELECT SUM(AMOUNT), COUNT(MEMBERID) FROM `adhocpayments` WHERE MEMBERID='$id' AND DATE(TRANSDATE) BETWEEN '$d1'  AND '$d2'
");
$stmtq->execute();
$resultq = $stmtq->get_result();
if ($resultq->num_rows > 0) {
while($rowq = $resultq->fetch_assoc()) {
$tadhoc = $rowq['COUNT(MEMBERID)'];	
$sadhoc = $rowq['SUM(AMOUNT)'];



$d1s = date("d-m-Y", strtotime($DDD));	
$d2s = date("d-m-Y", strtotime($DDDD));	
$stmtr = $conn->prepare("
SELECT SUM(AMOUNT), COUNT(MEMBERID) FROM `regularpayments` WHERE MEMBERID='$id' AND DATE(TRANSDATE) BETWEEN $d1  AND $d2
");
$stmtr->execute();
$resultr = $stmtr->get_result();
if ($resultr->num_rows > 0) {
while($rowr = $resultr->fetch_assoc()) {
	$TREGS = $rowr['COUNT(MEMBERID)'];	
	$SREGS = $rowr['SUM(AMOUNT)'];
	
	
	
$d1s = date("d-m-Y", strtotime($DDD));	
$d2s = date("d-m-Y", strtotime($DDDD));	
$stmti = $conn->prepare("
SELECT SUM(AMOUNT) AS FF, COUNT(MEMBERID) AS DD FROM interestallocated WHERE MEMBERID='$id' AND DATE(TRANSDATE) BETWEEN '$d1' AND '$d2'
");
$stmti->execute();
$resulti = $stmti->get_result();
if ($resulti->num_rows > 0) {
while($rowi = $resulti->fetch_assoc()) {
	$TINTl = $rowi['DD'];	
	$SINTl = $rowi['FF'];
	


$d1s = date("d-m-Y", strtotime($DDD));	
$d2s = date("d-m-Y", strtotime($DDDD));	
$stmtf = $conn->prepare("
SELECT SUM(AMOUNT) AS FF, COUNT(MEMBERID) AS DD FROM fixedmonthlyfees WHERE MEMBERID='$id' AND DATE(TRANSDATE) BETWEEN '$d1' AND '$d2'
");
$stmtf->execute();
$resultf = $stmtf->get_result();
if ($resultf->num_rows > 0) {
while($rowf = $resultf->fetch_assoc()) {
	$tmonfee = $rowf['DD'];	
	$smonfee = $rowf['FF'];
	
$d1s = date("d-m-Y", strtotime($DDD));	
$d2s = date("d-m-Y", strtotime($DDDD));	
$stmtf = $conn->prepare("
SELECT SUM(AMOUNT) AS FF, COUNT(MEMBERID) AS DD FROM adminfees WHERE MEMBERID='$id' AND DATE(TRANSDATE) BETWEEN '$d1' AND '$d2'
");
$stmtf->execute();
$resultf = $stmtf->get_result();
if ($resultf->num_rows > 0) {
while($rowf = $resultf->fetch_assoc()) {
	$tadmin = $rowf['DD'];	
	$sadmin = $rowf['FF'];

$d1s = date("d-m-Y", strtotime($DDD));	
$d2s = date("d-m-Y", strtotime($DDDD));	


$stmta = $conn->prepare("
SELECT SUM(AMOUNT) AS FF, COUNT(MEMBERID) AS DD FROM additionalmember WHERE FUNDID='$id' AND DATE(TRANSDATE) BETWEEN '$d1' AND '$d2'
");
$stmta->execute();
$resulta = $stmta->get_result();
if ($resulta->num_rows > 0) {
while($rowa = $resulta->fetch_assoc()) {
	$tadd = $rowa['DD'];	
	$sadd = $rowa['FF'];	
	
	
$d1s = date("d-m-Y", strtotime($DDD));	
$d2s = date("d-m-Y", strtotime($DDDD));	
$stmttt = $conn->prepare("
SELECT SUM(AMOUNT) AS FF, COUNT(MEMBERID) AS DD FROM transactionfees WHERE MEMBERID='$id' AND DATE(TRANSDATE) BETWEEN '$d1' AND '$d2'
");
$stmttt->execute();
$resulttt = $stmttt->get_result();
if ($resulttt->num_rows > 0) {
while($rowtt = $resulttt->fetch_assoc()) {
	$ttfees = $rowtt['DD'];	
	$stfees = $rowtt['FF'];
	
	
$d1s = date("d-m-Y", strtotime($DDD));	
$d2s = date("d-m-Y", strtotime($DDDD));	
$stmttto = $conn->prepare("
SELECT SUM(AMOUNT) AS FF, COUNT(MEMBERID) AS DD FROM othertransactions WHERE MEMBERID='$id' AND DATE(TRANSDATE) BETWEEN '$d1' AND '$d2'
");
$stmttto->execute();
$resulttto = $stmttto->get_result();
if ($resulttto->num_rows > 0) {
while($rowtto = $resulttto->fetch_assoc()) {
	$tother = $rowtto['DD'];	
	$sother = $rowtto['FF'];
	
	$response2 = array(
					'statusCode'=>200,
					'approved'=>$ApprovedBenefit,
					'running'=>$ruuning_balance,
					'members'=>$MemberNo,
					'tadhoc'=>$tadhoc,
					'sadhoc'=>$sadhoc,
					'TREG'=>$TREGS,
					'SREG'=>$SREGS,
					'TINT'=>$TINTl,
					'SINT'=>$SINTl,
					'tmonfee'=>$tmonfee,
					'smonfee'=>$smonfee,
					'tadmin'=>$tadmin,
					'sadmin'=>$sadmin,
					'tadd'=>$tadd,
					'sadd'=>$sadd,
					'ttfees'=>$ttfees,
					'stfees'=>$stfees,
					'tother'=>$tother,
					'sother'=>$sother
					
					);
					echo json_encode($response2);
}
}

}
}

}
}

}
}

}
}

											
}
}


											
}
}


}
}				
				
				
				
}				
}else{
	
	$response2 = array(
					'statusCode'=>201,
					'error'=>"No Deceased Record found for ID ".$id
					);
				echo json_encode($response2);
}












}
	
	?>