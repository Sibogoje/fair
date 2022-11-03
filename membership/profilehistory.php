
<?php
require_once '../scripts/connection.php';
$ii = $_POST['c_id'];


if(count($_POST)>0){
$stmt12 = $conn->prepare("SELECT * from profile where MemberNo = '$ii' ");
						$stmt12->execute();
						$result12 = $stmt12->get_result();
						if ($result12->num_rows > 0) {
						    while($row12 = $result12->fetch_assoc()) {
						  // output data of each row
						 ?>
						 <div class="table-responsive">
		<table class="table datatable"  id="free">
			<thead>
                  <tr>
                    <th scope="col" colspan="6"><img src="header.PNG" width="100%"></th>
                   
                    </tr>
                   	<tr style="text-align: center; background: black; color: white;">
                    <th scope="col" colspan="6">MEMBER DETAILS</th>
                   
                    </tr>
                    <tr>
                    <th scope="col" style="vertical-align: top;">Full Name</th>
                    <td scope="col"><?php echo $row12['MemberFirstname']." ".$row12['MemberSurname']; ?></td>
                    <th scope="col" style="vertical-align: top;">MemberNo</th>
					<td scope="col"><?php echo $row12['MemberNo']; ?></td>
					<th scope="col" style="vertical-align: top;">National ID</th>
					<td scope="col"><?php echo $row12['MemberIDnumber']; ?></td>
					</tr>
					
					
					<tr>
                    <th scope="col" style="vertical-align: top;">Date of Birth</th>
                    <td scope="col"><?php echo $row12['DateOfBirth']; ?></td>
                    <th scope="col" style="vertical-align: top;">Account Opened</th>
					<td scope="col"><?php echo $row12['DateAccountOpened']; ?></td>
					 <th scope="col" style="vertical-align: top;">Postal Address</th>
					<td scope="col"><?php echo $row12['MemberPostalAddress']; ?></td>
					</tr>
					
						<tr>
                    <th scope="col" style="vertical-align: top;">Approved Benefit</th>
                    <td scope="col"><?php echo $row12['ApprovedBenefit']; ?></td>
                    <th scope="col" style="vertical-align: top;">Terminated</th>
					<td scope="col"><?php echo $row12['Terminated']; ?></td>
					 <th scope="col" style="vertical-align: top;">Balance</th>
					<td scope="col"><?php  ?></td>
					</tr>
					
				<tr style="text-align: center; background: grey; color: white;">
                    <th scope="col" colspan="6" >DECEASED DETAILS</th>
                   </tr>
                   
					<tr>
                    <th scope="col" style="vertical-align: top;">Deceased Name</th>
                    <td scope="col"><?php echo $row12['DeceasedSurname']." ".$row12['DeceasedFirstnames']; ?></td>
                    <th scope="col" style="vertical-align: top;" >Deceased ID</th>
					<td scope="col"><?php echo $row12['DeceasedID']; ?></td>
					<th scope="col" style="vertical-align: top;">Deceased Date Of Death</th>
					<td scope="col"><?php echo $row12['DateOfDeath']; ?></td>
					</tr>
					
					<tr style="text-align: center; background: grey; color: white;">
                    <th scope="col" colspan="6">GUARDIAN DETAILS</th>
                   </tr>
					
				    <tr>
                    <th scope="col" style="vertical-align: top;">Guardian Name</th>
                    <td scope="col"><?php echo $row12['GuardianSurname']." ".$row12['GuardianFirstNames']; ?></td>
                    <th scope="col" style="vertical-align: top;">Guardian ID</th>
					<td scope="col"><?php echo $row12['GuardianID']; ?></td>
					<th scope="col" style="vertical-align: top;">Guardian Contacts</th>
					<td scope="col"><?php echo $row12['GuardianCell']; ?></td>
					</tr>
					
				<tr style="text-align: center; background: grey; color: white;">
                    <th scope="col" colspan="6">NEXT OF KIN DETAILS</th>
                   </tr>
                   
                  <tr>
                    <th scope="col" style="vertical-align: top;">N. Kin Name</th>
                    <td scope="col"><?php echo $row12['KinSurname']." ".$row12['KinFirstNames']; ?></td>
                    <th scope="col" style="vertical-align: top;">N. Kin Email</th>
					<td scope="col"><?php echo $row12['KinEmail']; ?></td>
					<th scope="col" style="vertical-align: top;">N. Kin Cell</th>
					<td scope="col"><?php echo $row12['KinCell']; ?></td>
					</tr>
					
					<tr style="text-align: center; background: grey; color: white;">
                    <th scope="col" colspan="6">EMPLOYER DETAILS</th>
                   </tr>
                   
                  <tr>
                    <th scope="col" style="vertical-align: top;">Employer Name</th>
                    <td scope="col"><?php echo $row12['EmployerName']; ?></td>
                    <th scope="col" style="vertical-align: top;">Employer Contact Person</th>
					<td scope="col"><?php echo $row12['EmployerContactPerson']; ?></td>
					<th scope="col" style="vertical-align: top;">Contact</th>
					<td scope="col"><?php echo $row12['EmployerCell']; ?></td>
					</tr>
					
					
						<tr style="text-align: center; background: grey; color: white;">
                    <th scope="col" colspan="6">FUND DETAILS</th>
                   </tr>
                   
                  <tr>
                    <th scope="col" style="vertical-align: top;">Fund Name</th>
                    <td scope="col" ><?php echo $row12['FundName']; ?></td>
                    <th scope="col" style="vertical-align: top;">Fund Contact Person</th>
					<td scope="col"><?php echo $row12['FundContact']; ?></td>
					<th scope="col" style="vertical-align: top;">Contact</th>
					<td scope="col"><?php echo $row12['FundCellNo']; ?></td>
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
						
} else {
  header('location: ./');
}
?>



