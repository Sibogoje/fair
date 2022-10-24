<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['zid']))
{
$gg = $_SESSION['user'];
require_once '../scripts/connection.php';

////////insert new 
if (isset($_POST['submit'])){
	
$MemberNo = $_POST['MemberNo']; 
$MemberSurname = $_POST['MemberSurname'];
$MemberFirstname = $_POST['MemberFirstname'];
$MemberIDnumber = $_POST['MemberIDnumber'];
$DeceasedID = $_POST['DeceasedID'];
$RelationshipDeceased = $_POST['RelationshipDeceased'];
$GuardianID = $_POST['GuardianID'];
$RelationshipGuardian = $_POST['RelationshipGuardian'];
$NextOfKinID = $_POST['NextOfKinID'];
$RelationshipNextOfKin = $_POST['RelationshipNextOfKin'];
$MemberPostalAddress = $_POST['MemberPostalAddress'];
$MemberPostOfficeID = $_POST['MemberPostOfficeID'];
$Gender = $_POST['Gender'];
$DateOfBirth = $_POST['DateOfBirth'];
$ApprovedBenefit = $_POST['ApprovedBenefit'];
$DateAccountOpened = $_POST['DateAccountOpened'];
$RegularPaymentFrequencyID = $_POST['RegularPaymentFrequencyID'];
$RegularPaymentTypeID = $_POST['RegularPaymentTypeID'];
$FixedPaymentAmount = $_POST['FixedPaymentAmount'];
$MaxPaymentAmount = $_POST['MaxPaymentAmount'];
$Comments = $_POST['Comments'];
$BankID = $_POST['BankID'];
$BankAccountNo = $_POST['BankAccountNo'];
$AccountTypeID = $_POST['AccountTypeID'];
$AccountHolderName = $_POST['AccountHolderName'];

$stmt = $conn->prepare("INSERT INTO `u747325399_fairlife`.`tblmembers1` (
  `MemberNo`,
  `MemberSurname`,
  `MemberFirstname`,
  `MemberIDnumber`,
  `DeceasedID`,
  `RelationshipDeceased`,
  `GuardianID`,
  `RelationshipGuardian`,
  `NextOfKinID`,
  `RelationshipNextOfKin`,
  `MemberPostalAddress`,
  `MemberPostOfficeID`,
  `Gender`,
  `DateOfBirth`,
  `ApprovedBenefit`,
  `DateAccountOpened`,
  `RegularPaymentFrequencyID`,
  `RegularPaymentTypeID`,
  `FixedPaymentAmount`,
  `MaxPaymentAmount`,
  `Comments`,
  `BankID`,
  `BankAccountNo`,
  `AccountTypeID`,
  `AccountHolderName`

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
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
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
$stmt->bind_param("sssssssssssssssssssssssss", 
$MemberNo,
$MemberSurname,
$MemberFirstname,
$MemberIDnumber,
$DeceasedID,
$RelationshipDeceased,
$GuardianID,
$RelationshipGuardian,
$NextOfKinID,
$RelationshipNextOfKin,
$MemberPostalAddress,
$MemberPostOfficeID,
$Gender,
$DateOfBirth,
$ApprovedBenefit,
$DateAccountOpened,
$RegularPaymentFrequencyID,
$RegularPaymentTypeID,
$FixedPaymentAmount,
$MaxPaymentAmount,
$Comments,
$BankID,
$BankAccountNo,
$AccountTypeID,
$AccountHolderName
);
// set parameters and execute
$stmt->execute();

echo "New records created successfully";

$stmt->close();
$conn->close();
}else{

}




?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>New Member</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="https://fair.liquag.com/" rel="icon">
  <link href="https://fair.liquag.com/" rel="apple-touch-icon">

  <script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/datatables.min.js"></script>

 <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
 <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
 
</head>

<body>

  <!-- ======= Header ======= -->
 <?php include '../header.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Deceased Profiles</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Members</a></li>
          <li class="breadcrumb-item active">Deceased Profiles</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
<!-- New beneficiary form-->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">All Beneficiaries</h5>
              <!-- Table with stripped rows -->
               <div class="table-responsive">
               <table class="table table-striped datatable nowrap" id="jj" style="width: 100%;" >
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Name</th>
                    <th scope="col">Total Funds</th>
                    <th scope="col">Fund ID</th>
					<th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
				<?php 
$stmt = $conn->prepare("SELECT * FROM `tbldeceased`");

$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
  // output data of each row
while($row = $result->fetch_assoc()) {


?>
                  <tr>
                    <th scope="row"><?php echo $row['DeceasedID']; ?></th>
                    <td><?php echo $row['DeceasedSurname']; ?></td>
                    <td><?php echo $row['DeceasedFirstnames']; ?></td>
                    <td><?php echo $row['TotalFunds']; ?></td>
                    <td><?php echo $row['RetirementFundID']; ?></td>
					<td>
			<button type="button" data-link="dedit.php?id=<?php echo $row['DeceasedID']; ?>" class="btn btn-warning edit" data-id="<?php echo $row['DeceasedID']; ?>"><i class="bi bi-eye-fill"></i></button>
              
					</td>
                  </tr>
<?php   }
} else {
  echo "0 results";
} ?>                 
                </tbody>
              </table>
              </div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

<!-- end of new beneficiary form -->
    

  </main><!-- End #main -->

  <!-- ======= Footer ======= -
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ --
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/php-email-form/validate.js"></script>
<!-- Vendor JS Files -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

<script>
//$(document).ready(function(){
/*	
	$('.edit').click(function(){
   window.location.href = $(this).data('link');
});
});
*/

$(document).ready(function() {
    $('#jj').DataTable( {
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All'],
        ],
        dom: 'Blfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        responsive: true,
       
        
    } );
    
  
} );
</script>
<script>
$(document).on("click",".edit",function(e){
 // your code goes here
  window.location.href = $(this).data('link');
});
</script>

</body>

</html>
<?php
}else{
    header('Location: https://fair.liquag.com/index.php');
}

?>