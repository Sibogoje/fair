
<?php
require_once '../scripts/connection.php';
$ff = $_POST['single'];
	 $d1=$_POST['from'];
	 $d2=$_POST['to'];



$ii = "";
$name = "";
$national = "";
$dob = "";
$accountopen = "";
$approved = "";
$income = "";
$expenses = "";
$payments = "";
$other = "";
$balance = "";



if(count($_POST)>0){
// Fetch records from database 
$query = $conn->query("SELECT MemberID from member_fees where F_ID = '$ff'  AND `Terminated` = '0'  ");

 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "Per Fund Report  ". date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
      $tyes = "";
    // Set column headers 
    $fields = array("Member NO", "Full name", "Gender", "D O B", "Acc Opened", "Amount Appr.", "Income", "Expenses", "Payments", "Other Transactions",  "Balance"); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 

$ii = $row['MemberID'];


$stmt = $conn->prepare("SELECT * from tblmembers where MemberID = '$ii' ");
						$stmt->execute();
						$result = $stmt->get_result();
						if ($result->num_rows > 0) {
						    while($row = $result->fetch_assoc()) {
						        
						      $name =  $row['MemberFirstname']." ".$row['MemberSurname']; 
						      $memberno = $row['MemberNo'];
						      $national = $row['Gender'];
						      $dob = $row['DateOfBirth'];
						      $accountopen = $row['DateAccountOpened'];
						      $approved  = number_format($row['ApprovedBenefit'], 2);
							 
							  $stmt12 = $conn->prepare("SELECT `NewBalance` from `balances` where  `memberID` = '$ii' ");
								 $stmt12->execute();
								 $result12 = $stmt12->get_result();
								 if ($result12->num_rows > 0) {
									 while($row12 = $result12->fetch_assoc()) {
		 
					               $balance  = $row12['NewBalance']; 

									 }}
										
		
						    }
						    
						}
						$stmt12 = $conn->prepare("SELECT SUM(`Amount`) AS `TT3` from `tblmemberaccounts` where  TransactionTypeID = '8' AND memberID = '$ii' ");
						$stmt12->execute();
						$result12 = $stmt12->get_result();
						if ($result12->num_rows > 0) {
						    while($row12 = $result12->fetch_assoc()) {
						        
						        $income = number_format($row12['TT3'], 2);
						        
						    }}
						    
						    $stmt12 = $conn->prepare("SELECT SUM(`Amount`) AS `TT3` from `tblmemberaccounts` where  TransactionTypeID IN ('2','5', '6','7' ) AND memberID = '$ii' ");
						$stmt12->execute();
						$result12 = $stmt12->get_result();
						if ($result12->num_rows > 0) {
						    while($row12 = $result12->fetch_assoc()) {
						        
						        $expenses = number_format($row12['TT3'], 2);
						    }}
						    
						    
						    $stmt12 = $conn->prepare("SELECT SUM(`Amount`) AS `TT3` from `tblmemberaccounts` where  TransactionTypeID IN ('3', '4') AND memberID = '$ii' ");
						$stmt12->execute();
						$result12 = $stmt12->get_result();
						if ($result12->num_rows > 0) {
						    while($row12 = $result12->fetch_assoc()) {
						        
						        $payments = number_format($row12['TT3'], 2);
						    }}
						    
						    $stmt12 = $conn->prepare("SELECT SUM(`Amount`) AS `TT3` from `tblmemberaccounts` where  TransactionTypeID = '10' AND memberID = '$ii' ");
						$stmt12->execute();
						$result12 = $stmt12->get_result();
						if ($result12->num_rows > 0) {
						    while($row12 = $result12->fetch_assoc()) {
						        
						        $other  = number_format($row12['TT3'], 2);
						    }}








								
							
        $lineData = array($memberno,$name, $national, $dob, $accountopen,  $approved, $income, $expenses, $payments, $other,  $balance ); 
        fputcsv($f, $lineData, $delimiter); 
    } 


    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
   
} 
exit; 
	 }
?>


