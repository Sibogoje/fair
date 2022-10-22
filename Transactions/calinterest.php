<?php
require_once '../scripts/connection.php';
set_time_limit(0);
if(count($_POST)>0){
	 $date=$_POST['dates'];
	 $amount=$_POST['amount'];
$term = 0;
$stmt = $conn->prepare("SELECT SUM(`balance`) AS `SS` FROM `tblmembers1` WHERE `Terminated`=? ");
$stmt->bind_param("s", $term, );
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
	$totalrunning = $row['SS'];
	
				$stmt1 = $conn->prepare("SELECT `MemberNO`, `balance` FROM `tblmembers1` WHERE `Terminated`=? ");
				$stmt1->bind_param("s", $term, );
				$stmt1->execute();
				$result1 = $stmt1->get_result();
				if ($result1->num_rows > 0) {
				while($row1 = $result1->fetch_assoc()) {
					$MemberNO = $row1['MemberNO'];
					$ruuning_balance = $row1['balance'];
					
					$fraction = ($ruuning_balance / $totalrunning);
					$interest = $fraction *  $amount;
					
					$Newbalance = $ruuning_balance + $interest;

					$TransactionTypeID = 8;
					
					$gg = strtotime($date);
					
					$gggg = $gg -1;
					
					$gg2 =  date('F ', $gggg);
					
					$Details = "Monthly Interest  ".$gg2." Allocated";
					$Credit = 1;
					
					$Comments = "";
					$latest = 0;
					
					$insertnew = $conn->prepare("insert into `u747325399_fairlife`.`tblMemberAccounts1` (

  `TransactionDate`,
  `TransactionTypeID`,
  `memberID`,
  `Details`,
  `Credit`,
  `StartingBalance`,
  `Amount`,
  `NewBalance`,
  `Comments`

)

VALUES
  (

    ?,
    ?,
    ?,
    ?,
	?,
	?,
	?,
	?,
	?
  );");
$insertnew->bind_param("sssssssss", 
$date, 
$TransactionTypeID,
$MemberNO,
$Details,
$Credit,
$ruuning_balance,
$interest,
$Newbalance,
$Comments

);
$insertnew->execute();
					
					
					
				}
				}			
}
$response = array(
					'statusCode'=>200,
					'success'=>"Interest Updated"
					);
				echo json_encode($response);
}else{
	
	$response = array(
					'statusCode'=>201,
					'error'=>"No Interest Allocated"
					);
				echo json_encode($response);

}
}
	
	?>