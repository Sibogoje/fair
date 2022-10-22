
<?php
require_once '../scripts/connection.php';
$ii = $_POST['MemberID'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><? echo $ii; ?></title></title>
 
	 <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	

   <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>



footer {
  font-size: 14px;
  color: black;
  text-align: center;
}

@page {
  size: A4;
  margin: 11mm 17mm 17mm 17mm;
 
}

@media print {
    

  footer {
    position: fixed;
    bottom: 0;
    display: flex;
align-items: center;
justify-content: center;

  }

  .content-block, p {
    page-break-inside: avoid;
  }

  html, body {
    width: 210mm;
    height: 297mm;
  }
}

@media print {
@page {
           margin-top: 0;
           margin-bottom: 0;
         }
         body  {
           padding-top: 72px;
           padding-bottom: 79px ;
         }

}
.table {
	font-family:'Arial';
  
 

  
}
#bottom {
   
 display: flex;
align-items: center;
justify-content: center;
}
td {

  
}

.hed {
    
    padding: 10px;
}




@media print
{
    html
    {
		font-size: 15px;
       
    }
}

@media print
{
    html
    {
        zoom: 100%;
    }
}

</style>

</head>

<body>
    
<?


if(count($_POST)>0){
    
    
$stmt = $conn->prepare("SELECT * from profile where MemberNo = '$ii' ");
						$stmt->execute();
						$result = $stmt->get_result();
						if ($result->num_rows > 0) {
						    while($row = $result->fetch_assoc()) {
						  // output data of each row
						 ?>
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
                    <td scope="col"><? echo $row['MemberFirstname']." ".$row['MemberSurname']; ?></td>
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
                    <td scope="col"><? echo $row['ApprovedBenefit']; ?></td>
                    <th scope="col" style="vertical-align: top;">Terminated</th>
					<td scope="col"><? echo $row['Terminated']; ?></td>
					 <th scope="col" style="vertical-align: top;">Balance</th>
					<td scope="col"><? echo $row['balance']; ?></td>
					</tr>
				<tr style="text-align: center; background: black; color: white;">
                    <th scope="col" colspan="6">Transaction Statement</th>
                   
                    </tr>	
					</thead>
					</table>
					
<?


}}    
    
    
$stmt12 = $conn->prepare("SELECT   
`accountsID`,
`TransactionDate`,
  `TransactionTypeID`,
  `memberID`,
  `Details`,
  `Credit`,
  `StartingBalance`,
  `Amount`,
  `NewBalance`,
  `Comments`  FROM `tblMemberAccounts1` WHERE `memberID` ='$ii'  ORDER BY TransactionDate DESC, accountsID DESC");
						$stmt12->execute();
						$result12 = $stmt12->get_result();
						if ($result12->num_rows > 0) {
						  // output data of each row
						 ?>
		<table class="table datatable"  id="free">
			<thead>
                  <tr>
                    <th scope="col">TransactionDate</th>
                    <th scope="col">Details</th>
                    <th scope="col">Type</th>
                    <th scope="col">Comments</th>
					<th scope="col">Prev balance</th>
					<th scope="col">Amount</th>
					<th scope="col">NewBalance</th>
                  </tr>
                </thead>
                <tbody>
				
          
		   <?php
						while($row12 = $result12->fetch_assoc()) {
							$tyes = "";
							if ($row12['Credit'] == "1"){
								$tyes = "Credit";
							}else {
								$tyes = "Debit";
								
							}
						//	number_format($num, 2);
							
?>							
<tr>
                    <th scope="row"><?php echo $row12['TransactionDate']; ?></th>
                    <td><?php echo $row12['Details']; ?></td>
                    <td><?php echo $tyes; ?></td>
                    <td><?php echo $row12['Comments']; ?></td>
                    <td><?php echo number_format($row12['StartingBalance'], 2); ?></td>
					<td><?php echo  number_format($row12['Amount'], 2);  ?></td>
					<td><?php echo number_format($row12['NewBalance'], 2); ?></td>
					<td>
			  
					</td>
                  </tr>
                 
				   
<?php						
						}
						?>
						</tbody>
						 </table>
						<?php
						
						} else {
						  echo "0 results";



						} 
?>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>

<?php						
						
} else {
  header('location: ./');
}
?>
 
<script type="text/javascript">

$(document).ready(function () {
    window.print();
});

</script>	
</body>

</html>


