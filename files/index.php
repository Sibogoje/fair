
<?php 
session_start();
if(isset($_SESSION['zid']))
{
$gg = $_SESSION['user'];
require_once '../scripts/connection.php';


include 'db_connect.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Files Management</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<!-- Select2 CSS --> 

        <script src='../select2/dist/js/select2.min.js' type='text/javascript'></script>

        <link href='../select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>

  <!-- Favicons -->
  <link href="https://fair.liquag.com/" rel="icon">
  <link href="https://fair.liquag.com/" rel="apple-touch-icon">

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
   <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />


  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
        <style>
            #form{

                padding: 20px;
            }
            .container{
                margin-top: 2%;
            }
            .topnav{
                padding: 10px;
                background-color: #303030;
                color: white;
            }
            #nav{
            background-color: gray;
            height: 50px;
            color: white;
        }
        </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <?php include '../header.php'; ?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Files Management</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Files</a></li>
          <li class="breadcrumb-item active">Management</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
<!-- New beneficiary form-->


               <form class="row g-3 needs-validation" id="upload_form" method="post"  enctype="multipart/form-data" novalidate>
               
               <div class="col-md-12 col-lg-6">
               <div class="form-floating">
                <div class="form-group">
                    <input type="file" class="inp" name="uploadingfile" id="uploadingfile">
                </div>
                </div></div>

                <div class="col-md-12 col-lg-6">
				<div class="form-floating">
				  
					 <select type="text" class="form-control" id="single"    placeholder="MemberID" name="MemberID"  required>
					<option value="" selected></option>
						<?php 
						$stmt12 = $conn->prepare("SELECT * FROM `tblmembers` where `Terminated` = '0' ");
						$stmt12->execute();
						$result12 = $stmt12->get_result();
						if ($result12->num_rows > 0) {
						  // output data of each row
						while($row12 = $result12->fetch_assoc()) {
					
					    	
							

						?>
					<option value="<?php echo $row12['MemberNo']; ?>"><?php echo $row12['MemberNo']." ".$row12['MemberSurname']." ".$row12['MemberFirstname'] ; ?></option>
						<?php   }
						} else {
						//  echo "0 results";
						} ?> 
					</select>
                    
				  <div class="valid-feedback">
                    Looks good!
                  </div>
                  </div>
				  </div>	


                <div class="form-group">
                    <input class="btn btn-warning add" class="inp" type="button" value="Upload File" name="btnSubmit"
                           onclick="uploadFileHandler()" style="width: 100%;" >
                </div>
                <div class="form-group">
                    <div class="progress" id="progressDiv">
                        <progress id="progressBar" value="0" max="100" style="width:100%; height: 1.2rem;"></progress>
                    </div>
                </div>
                <div class="form-group">
                    <h3 id="status"></h3>
                    <p id="uploaded_progress"></p>
                </div>
            </form>


        <div class="container">
            <div class="row">
                
            </div>
        </div>
        </main>
        
        
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
        $(document).ready(function(){
    $('#single').select2();        

        });
        </script>
       
        
    </body>
</html>
<?php
}else{
    header('Location: https://fair.liquag.com/index.php');
}

?>