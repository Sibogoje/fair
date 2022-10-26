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
$stmt = $conn->prepare("SELECT COUNT(`memberID`) AS `TT`, 
 SUM(`ApprovedBenefit`) AS `APPROVED`,
 SUM(`Newbalance`) AS `BALANCE`,
 SUM(`memberID`) AS `MEMBERS`,
 SUM(`Newbalance`) AS `SS`,
 SUM(`Newbalance`) AS `SS`,
 
 FROM `fundsum` WHERE `RetirementFundID`=? AND TransactionDate >=? AND TransactionDate <=? AND `Terminated`=?");
$stmt->bind_param("ssss", $id, $d1, $d2, $active);
$stmt->execute();
$result = $stmt->get_result();
$totalapproved = 0;
$totalrunning = 0;
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
$ApprovedBenefit = $row['FF'];	
$ruuning_balance = $row['SS'];
$MemberNo = $row['TT'];


	
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