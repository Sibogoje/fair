<?php
require_once '../scripts/connection.php';
set_time_limit(0);
if(count($_POST)>0){
	 $date=$_POST['dates'];
	 $amount=$_POST['amount'];
	 $sourceid=$_POST['MemberID'];

$term = 0;
$ttfundsresult = mysqli_query($conn, 'SELECT SUM(`NewBalance`) AS `SS` FROM `balances`'); 
$ttfundsrow = mysqli_fetch_assoc($ttfundsresult); 
$ttfunds = $ttfundsrow['SS'];


          $stmt1 = $conn->prepare("SELECT `memberID`, `NewBalance` FROM `balances` ");
				
				$stmt1->execute();
				$result1 = $stmt1->get_result();
				if ($result1->num_rows > 0) {
				while($row1 = $result1->fetch_assoc()) {
					$MemberNO = $row1['memberID'];
					$ruuning_balance = $row1['NewBalance'];
					
					$fraction = ($ruuning_balance / $ttfunds);
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
					
					$insertnew = $conn->prepare("insert into `tblmemberaccounts` (

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

////////////////////insert into Interest Table					
if ($insertnew->execute()) {


	$vers = 1;
	$updateinterests = $conn->prepare("insert into `tblinterestreceived` (

		`InterestSourceID`,
		`InterestStartDate`,
		`InterestDate`,
		`InterestAmount`,
		`AllocationDate`,
		`Allocated`
	  
	  )
	  
	  VALUES
		(
	  
		  ?,
		  ?,
		  ?,
		  ?,
		  ?,
		  ?
		);");
	  $updateinterests->bind_param("ssssss", 
	  $sourceid, 
	  $dates,
	  $dates,
	  $amount,
	  $dates,
	  $vers
	  
	  );

	$updateinterests->execute();




$response = array(
		'statusCode'=>200,
		'success'=>"Member No"
		);

 }else{

	$response = array(
		'statusCode'=>201,
		'error'=>"No Interest Allocated"
		);
	echo json_encode($response);



}					
					
				}
				}else{
					$response = array(
						'statusCode'=>202,
						'error'=>"No Members Found"
						);
					echo json_encode($response);
				}			




}
	
	?>