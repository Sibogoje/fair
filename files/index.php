
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
<script src='jquery-3.2.1.min.js' type='text/javascript'></script>
        <script src='select2/dist/js/select2.min.js' type='text/javascript'></script>

        <link href='../select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>

  <!-- Favicons -->
  <link href="http://localhost/fairlife/logo.png" rel="icon">
  <link href="http://localhost/fairlife/logo.png" rel="apple-touch-icon">

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




        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-4">
                     <?php
                    $phpFileUploadErrors = array(
                        0 => 'File upload successfully',
                        1 => 'the upload file exceed the  upload_max_filesize directive in php.ini',
                        2 => 'the upload file exceed the MAX_FILE_SIZE directive that was specified in the HTML form',
                        3 => 'the upload file was only partially uploaded',
                        4 => 'no file was uploaded',
                        5 => 'missing a temporary folder',
                        6 => 'failed to write file to disc',
                        7 => 'a php extension stopped the file upload',
                    );

                    if (isset($_FILES['file'])) {

                        $file_array = reArrayFiles($_FILES['file']);
                        //pre_r($file_array);
                        for ($i = 0; $i < count($file_array); $i++) {
                            if ($file_array[$i]['error']) {
                                ?><div class="alert alert-danger">
                                <?php echo $file_array[$i]['name'] . ' - ' . $phpFileUploadErrors[$file_array[$i]['error']];
                                ?></div><?php
                            } else {
                                $extensions = array('pdf', 'jpeg', 'jpg', 'png', 'gif', 'pptx', 'ppt', 'docx', 'doc', 'xlsx', 'sql', 'txt', 'xlsx', 'xls', 'xlsm', 'xlsb', 'xltm', 'xlt', 'xla', 'xlr');
                                $file_ext = explode('.', $file_array[$i]['name']);
                                $file_ext = end($file_ext);
                                $file_size = $file_array[$i]['size'];
                                $file_type = $file_array[$i]['type'];

                                if (!in_array($file_ext, $extensions)) {
                                    ?>
                                    <div class="alert alert-danger">

                                        <?php echo "{$file_array[$i]['name']} - invalid file extension" ?>

                                    </div>

                                    <?php
                                } else {
                                    if (move_uploaded_file($file_array[$i]['tmp_name'], "uploads/" . $file_array[$i]['name'])) {
                                        $connect->query("INSERT INTO tbl_uploads(file,type,size) 
                                            VALUES ('" . $file_array[$i]['name'] . "','$file_type','$file_size')");
                                    }
                                    ?>
                                    <div class="alert alert-success">
                                        <?php echo $file_array[$i]['name'] . ' - ' . $phpFileUploadErrors[$file_array[$i]['error']] ?>
                                    </div>

                                    <?php
                                }
                            }
                        }
                    }

                    function reArrayFiles($file_post) {

                        $file_ary = array();
                        $file_count = count($file_post['name']);
                        $file_keys = array_keys($file_post);

                        for ($i = 0; $i < $file_count; $i++) {
                            foreach ($file_keys as $key) {
                                $file_ary[$i][$key] = $file_post[$key][$i];
                            }
                        }

                        return $file_ary;
                    }

                    function pre_r($array) {
                        echo '<pre>';
                        print_r($array);
                        echo '</pre>';
                    }

                    //end multi upload-->
                    ?> 
                    <!--for table!-->
                    <?php
                    $result = $connect->query("SELECT * FROM tbl_uploads") or die($connect->error);
                    ?>
                    
                    <!-- Table with stripped rows -->
              <div class="table-responsive">
              <table class="table datatable" id="jj" width="100%" cellspacing="0">
                <thead>
                  <tr>
                                <th>Owner</th>
                                <th>FileName</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>action</th>
                            </tr>
                </thead>
                <tbody>
				<?php 
$stmt = $conn->prepare("SELECT * FROM tbl_uploads" );

$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
  // output data of each row
while($row = $result->fetch_assoc()) {

//$uid = $row['MemberNo'];
?>

                  <tr>
                      <td><?php echo $row['file'] ?></td>
                                <td><?php echo $row['file'] ?></td>
                                <td><?php echo $row['type'] ?></td>
                                <td><?php echo $row['size'] ?></td>
                                <td>
                                    <a href="uploads/<?php echo $row['file'] ?>" target="_blank"><i class="bi bi-download btn"></i></a>
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
                <!--for file upload form!-->
                <div class="col-lg-4 md-2">



                    <form id="form" action="" method="post" enctype="multipart/form-data" class="form-control">
                        <div class="form-group">
                             <input name="file[]" multiple="" class="form-control" type="file" required/>
                        </div>
                        <div class="form-group">
                             <button id="confirm" class="btn btn-primary btn-sm" name="upload">Upload</button>
                        </div>
                    </form>
                   
                </div>
            </div>
        </div>
        </main>
        
        
          <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.min.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

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
    header('Location: fair.liquag.com//index.php');
}

?>