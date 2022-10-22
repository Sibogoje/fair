
<?php
require_once '../scripts/connection.php';
$ff = $_POST['c_id'];


if(count($_POST)>0){
    
    
 $stmtz = $conn->prepare("SELECT * from tblmembers1 where RetirementFundID = '$ff' AND  `Terminated` = '0' ");
						$stmtz->execute();
						$resultz = $stmtz->get_result();
						if ($resultz->num_rows > 0) {
						    while($rowz = $resultz->fetch_assoc()) {   
    
    $ii = $rowz['MemberNo'];
        
$stmt = $conn->prepare("SELECT * from profile where MemberNo = '$ii' ");
						$stmt->execute();
						$result = $stmt->get_result();
						if ($result->num_rows > 0) {
						    while($row = $result->fetch_assoc()) {
						  // output data of each row
						 ?>
						 <div class="table-responsive">
		<table class="table datatable"  id="free">
			<thead>
                  
                   	<tr style="text-align: center; background: black; color: white;">
                    <th scope="col" colspan="6"><? echo $row['MemberFirstname']." ".$row['MemberSurname']; ?></th>
                   
                    </tr>
                    <tr>
                    <th scope="col" style="vertical-align: top;">FundID</th>
                    <td scope="col"><? echo $row['RetirementFundID']; ?></td>
                    <th scope="col" style="vertical-align: top;">MemberNo</th>
					<td scope="col"><? echo $row['MemberNo']; ?></td>
					<th scope="col" style="vertical-align: top;">National ID</th>
					<td scope="col"><? echo $row['MemberIDnumber']; ?></td>
					</tr>
					
					
					<tr>
                    <th scope="col" style="vertical-align: top;">Date of Birth</th>
                    <td scope="col"><? echo $row['DateOfBirth']; ?></td>
                    <th scope="col" style="vertical-align: top;">Account Opened</th>
					<td scope="col"><? echo $row['DateAccountOpened']; ?></td>
					 <th scope="col" style="vertical-align: top;">Postal Address</th>
					<td scope="col"><? echo $row['MemberPostalAddress']; ?></td>
					</tr>
					
						<tr>
                    <th scope="col" style="vertical-align: top;">Approved Benefit</th>
                    <td scope="col"  style="font-weight: bold;"><? echo "E ". number_format($row['ApprovedBenefit'], 2); ?></td>
                    <th scope="col" style="vertical-align: top;">Terminated</th>
					<td scope="col"><? echo $row['Terminated']; ?></td>
					 <th scope="col" style="vertical-align: top;">Balance</th>
					<td scope="col" style="font-weight: bold;"><? echo "E ". number_format($row['balance'], 2); ?></td>
					</tr>
				<tr style="text-align: center; background: white; color: black;">
                    <th scope="col" colspan="6">Account Summary   [<? echo date('d-M-Y')?>]</th>
                   
                    </tr>	
				
					
<?


}}    


    
    
$stmt12 = $conn->prepare("SELECT SUM(`Amount`) AS `TT3` from `tblMemberAccounts1` where  TransactionTypeID = '8' AND memberID = '$ii' ");
						$stmt12->execute();
						$result12 = $stmt12->get_result();
						if ($result12->num_rows > 0) {
						    while($row12 = $result12->fetch_assoc()) {
						  // output data of each row
						 // $sum = $sum + $row12['TT3'] ;
						 ?>

                  
                   
                    <tr>
                    <th scope="col" colspan="3" style="vertical-align: top;">Income Earned</th>
                    <td scope="col" colspan="3" style="text-align: right;"><? echo "E ". number_format($row12['TT3'], 2); ?></td>
                    </tr>

 <?php	}
	?>

<?php	} else {
echo "0 results";	}    
 


    
$stmt12 = $conn->prepare("SELECT SUM(`Amount`) AS `TT3` from `tblMemberAccounts1` where  TransactionTypeID IN ('2','5', '6','7' ) AND memberID = '$ii' ");
						$stmt12->execute();
						$result12 = $stmt12->get_result();
						if ($result12->num_rows > 0) {
						    while($row12 = $result12->fetch_assoc()) {
						  // output data of each row
						 // $sum = $sum + $row12['TT3'] ;
						 ?>
	
                  
                   
                    <tr>
                    <th scope="col" colspan="3" style="vertical-align: top;">Expenses/Costs</th>
                    <td scope="col" colspan="3" style="text-align: right;"><? echo "- E ". number_format($row12['TT3'], 2); ?></td>
                    </tr>

 <?php	}
	?>

<?php	} else {
echo "0 results";	}    
 
 
 
 
     
$stmt12 = $conn->prepare("SELECT SUM(`Amount`) AS `TT3` from `tblMemberAccounts1` where  TransactionTypeID IN ('3', '4') AND memberID = '$ii' ");
						$stmt12->execute();
						$result12 = $stmt12->get_result();
						if ($result12->num_rows > 0) {
						    while($row12 = $result12->fetch_assoc()) {
						  // output data of each row
						 // $sum = $sum + $row12['TT3'] ;
						 ?>
	
                  
                   
                    <tr>
                    <th scope="col" colspan="3" style="vertical-align: top;">Payments</th>
                    <td scope="col" colspan="3" style="text-align: right;"><? echo "- E ".number_format($row12['TT3'], 2); ?></td>
                    </tr>

 <?php	}
	?>

<?php	} else {
echo "0 results";	}    
 
 
     
$stmt12 = $conn->prepare("SELECT SUM(`Amount`) AS `TT3` from `tblMemberAccounts1` where  TransactionTypeID = '10' AND memberID = '$ii' ");
						$stmt12->execute();
						$result12 = $stmt12->get_result();
						if ($result12->num_rows > 0) {
						    while($row12 = $result12->fetch_assoc()) {
						  // output data of each row
						 // $sum = $sum + $row12['TT3'] ;
						 ?>
	
                   
                    <tr>
                    <th scope="col" colspan="3" style="vertical-align: top;">Other Transactions</th>
                    <td scope="col" colspan="3" style="text-align: right;"><? echo "E ".number_format($row12['TT3'], 2); ?></td>
                    </tr>
</thead>
 <?php	}
	?>
</table>
</div>
<?php	} else {
echo "0 results";	}    
 













?>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>

<?php						

}
						    
						    
						}
						
} else {
  header('location: ./');
}





