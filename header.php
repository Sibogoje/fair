  
  <?php
  require_once 'scripts/connection.php';
  $role = $_SESSION['role'];
  ?>
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="https://fair.liquag.com/dash.php" class="logo d-flex align-items-center">
        <img src="https://fair.liquag.com/logo.png" alt="">
        <span class="d-none d-lg-block">Fairlife</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown" >
            
            <?php
            $sum1 = "";
            $notification = '';
$balanceresult = mysqli_query($conn, "SELECT COUNT(DISTINCT `memberID`) AS value_sum FROM balances where NewBalance<'5000.00' "); 
$balancerow = mysqli_fetch_assoc($balanceresult); 
$notification = $balancerow['value_sum'];
            
  ?>          

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-danger badge-number"><?php echo $notification; ?></span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications" >
            <li class="dropdown-header">
              <b>Accounts With Less than E 5000, 00</b>
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2"></span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
<div style="overflow-y: scroll; height:400px; margin: 10px;">
<?php
$stmt = $conn->prepare("SELECT Newbalance, memberID FROM `balances`  where `balances`.`NewBalance`<'5000.00' ");

$stmt->execute();
$resultz = $stmt->get_result();
if ($resultz->num_rows > 0) {
  // output data of each row
while($row = $resultz->fetch_assoc()) {

?>

            <li class="notification-item" style="overflow: auto;">
              <i class="bi bi-exclamation-circle text-danger"></i>
              <div>
                <h4><?php echo $row['memberID']; ?> </h4>
                <p style="color: red; font-weight: bold;"><?php echo "E ". $row['NewBalance'] ?></p>
                
              </div>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            
<?php
}
?>

            <?php
}else{
    
}
?>




            <li>
              <hr class="dropdown-divider">
            </li>
           
</div>
          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number"><?php echo "0" ?></span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have n new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
 


            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="https://fair.liquag.com/logo.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $gg ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li id="logout">
              <a class="dropdown-item d-flex align-items-center" href="localhost/fairlife/fair/logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
  
  
    <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
<?php if ($role == 'admin'){ ?>
      <li class="nav-item">
        <a class="nav-link " href="https://fair.liquag.com/dash.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
<?php  } ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="">
          <i class="bi bi-menu-button-wide"></i><span>Beneficiary</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
<?php  if ($role == 'admin' || $role=='Operations' || $role=='clerk'){ ?>           
          <li>
            <a href="https://fair.liquag.com/membership/new.php">
              <i class="bi bi-circle"></i><span>New Beneficiary</span>
            </a>
          </li>
          <?php } ?>


<?php if ($role == 'admin' || $role=='Operations' || $role=='clerk'){ ?>
          <li>
             <a href="https://fair.liquag.com/membership/">
              <i class="bi bi-circle"></i><span>All Beneficiaries</span>
            </a>
          </li>
          <?php } ?>

          <?php if ($role == 'admin' ){ ?>
          <li>
             <a href="https://fair.liquag.com/membership/pending.php">
              <i class="bi bi-circle"></i><span>Pending Approval</span>
            </a>
          </li>
          <?php } ?>        
          
        

          
<?php if ($role == 'admin' || $role=='Operations' || $role=='clerk'){ ?>          
          <li>
             <a href="https://fair.liquag.com/membership/dnew.php">
              <i class="bi bi-circle"></i><span>New Deceased</span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin' || $role=='Operations' || $role=='clerk'){ ?>          
		  <li>
            <a href="https://fair.liquag.com/membership/deceased.php">
              <i class="bi bi-circle"></i><span>Deceased Profiles</span>
            </a>
          </li>
          <?php } ?>
		   <!--
          <li>
            <a href="http://localhost/fair/membership/guardians.php">
              <i class="bi bi-circle"></i><span>Guardians</span>
            </a>
          </li>
-->



        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Funds</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
 <?php if ($role == 'admin' || $role=='Operations' || $role=='clerk'){ ?>           
          <li>
             <a href="https://fair.liquag.com/fund/fnew.php">
              <i class="bi bi-circle"></i><span>New Fund</span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin' || $role=='Operations' || $role=='clerk'){ ?>          
          <li>
             <a href="https://fair.liquag.com/fund/">
              <i class="bi bi-circle"></i><span>All Funds</span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin' || $role=='Operations' || $role=='clerk'){ ?>          
          <li>
             <a href="https://fair.liquag.com/fund/enew.php">
              <i class="bi bi-circle"></i><span>New Employer</span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin' || $role=='Operations' || $role=='clerk'){ ?>          
          <li>
             <a href="https://fair.liquag.com/fund/employers.php">
              <i class="bi bi-circle"></i><span>All Employers</span>
            </a>
          </li>
          <?php } ?>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Transactions</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
 <?php if ($role == 'admin' || $role=='Operations'){ ?>           
          <li>
            <a href="https://fair.liquag.com/Transactions/adhoc.php">
              <i class="bi bi-circle"></i><span>Adhoc Payments</span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin'){ ?>          
          <li>
            <a href="https://fair.liquag.com/Transactions/scheduled.php">
              <i class="bi bi-circle"></i><span>Scheduled</span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin' || $role=='Accounts' ){ ?>          
		   <li>
            <a href="https://fair.liquag.com/Transactions/monthlyfees.php">
              <i class="bi bi-circle"></i><span>Monthly Fees</span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin' || $role=='Accounts'){ ?>          
		   <li>
            <a href="https://fair.liquag.com/Transactions/interest.php">
              <i class="bi bi-circle"></i><span>Interest</span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin' || $role=='Operations'){ ?>          
          <li>
            <a href="https://fair.liquag.com/Transactions/additionalcapital.php">
              <i class="bi bi-circle"></i><span>Additional Capital</span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin'){ ?>          
		   <li>
            <a href="https://fair.liquag.com/Transactions/othertransactions.php">
              <i class="bi bi-circle"></i><span>Other Transactions</span>
            </a>
          </li>
<?php } ?>
<?php if ($role == 'admin' ){ ?>          
		   <li>
            <a href="https://fair.liquag.com/Transactions/terminate.php">
              <i class="bi bi-circle"></i><span>Interest</span>
            </a>
          </li>
          <?php } ?>
        </ul>
      </li><!-- End Tables Nav -->

<li class="nav-item">
        <a class="nav-link " href="https://fair.liquag.com/files/index.php">
          <i class="bi bi-file-earmark-medical-fill"></i>
          <span>Files</span>
        </a>
      </li>

 <li class="nav-heading">Repots</li>
 
 <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#reports-nav" data-bs-toggle="collapse" href="#">
          <i class="ri ri-todo-fill"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="reports-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
 <?php if ($role == 'admin' || $role=='Operations' || $role=='clerk'){ ?>           
             <li>
            <a href="https://fair.liquag.com/membership/profile.php">
              <i class="bi bi-circle"></i><span>Benefit Statement</span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin' || $role=='Operations' || $role=='clerk'){ ?>          
           <li>
            <a href="https://fair.liquag.com/membership/membersummary.php">
              <i class="bi bi-circle"></i><span>Member Summary</span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin' || $role=='Operations' || $role=='clerk'){ ?>          
           <li>
            <a href="https://fair.liquag.com/membership/profileaccount.php">
              <i class="bi bi-circle"></i><span>Statement</span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin' || $role=='Operations' || $role=='clerk'){ ?>          
           <li>
           <a href="https://fair.liquag.com/reports/beneficiaries.php">
              <i class="bi bi-circle"></i><span>Beneficiary Report</span>
            </a>
          </li>
          <?php } ?>
          
          <?php if ($role == 'admin' || $role=='Operations' || $role=='clerk'){ ?>
          <li>
             <a href="https://fair.liquag.com/membership/existence.php">
              <i class="bi bi-circle"></i><span>Existence Certificate</span>
            </a>
          </li>
          <?php } ?>
          
 <?php if ($role == 'admin' || $role=='Operations' || $role=='clerk'){ ?>         
            <li>
            <a href="https://fair.liquag.com/membership/membermove.php">
              <i class="bi bi-circle"></i><span>New Entrant Statement</span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin' || $role=='Operations'){ ?>          
           <li>
            <a href="https://fair.liquag.com/membership/consolsummary.php">
              <i class="bi bi-circle"></i><span>Beneficiary List</span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin'){ ?>          
          <li>
            <a href="https://fair.liquag.com/fund/fundfeesreport.php">
              <i class="bi bi-circle"></i><span>Fees Report</span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin' || $role=='Operations'){ ?>
          <li>
            <a href="https://fair.liquag.com/reports/funds.php">
              <i class="bi bi-circle"></i><span>Funds</span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin'){ ?>		  
           <li>
            <a href="https://fair.liquag.com/reports/adhocreport.php">
              <i class="bi bi-circle"></i><span>Adhoc Report</span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin'){ ?>          
           <li>
            <a href="https://fair.liquag.com/reports/scheduledreport.php">
              <i class="bi bi-circle"></i><span>Scheduled Report</span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin'){ ?>          
           <li>
            <a href="https://fair.liquag.com/reports/monthlyfeesreport.php">
              <i class="bi bi-circle"></i><span>Admin & Monthly Fees</span>
            </a>
          </li>
          <?php } ?>
 <?php if ($role == 'admin'){ ?>         
           <li>
            <a href="https://fair.liquag.com/reports/capitalintroductionreport.php">
              <i class="bi bi-circle"></i><span>Capital Introduction </span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin'){ ?>          
           <li>
            <a href="https://fair.liquag.com/reports/interestreport.php">
              <i class="bi bi-circle"></i><span>Interest Report</span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin'){ ?>          
                     <li>
            <a href="https://fair.liquag.com/reports/otherreport.php">
              <i class="bi bi-circle"></i><span>Other Transactions Report</span>
            </a>
          </li>
          <?php } ?>
 <?php if ($role == 'admin'){ ?>         
		   <li>
            <a href="https://fair.liquag.com/reports/employers.php">
              <i class="bi bi-circle"></i><span>Employer</span>
            </a>
          </li>
<?php } ?>
        </ul>
      </li><!-- End Tables Nav -->
	  
	   <li class="nav-heading">System Settings</li>
 
 <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#settings-nav" data-bs-toggle="collapse" href="#">
          <i class="ri ri-tools-fill"></i><span>Configure System Constants</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="settings-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
<?php if ($role == 'admin'){ ?>
          <li>
            <a href="https://fair.liquag.com/settings/banks.php">
              <i class="bi bi-circle"></i><span>Banks</span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin'){ ?>          
		   <li>
           <a href="https://fair.liquag.com/settings/post.php">
              <i class="bi bi-circle"></i><span>Post Offices</span>
            </a>
          </li>
          <?php } ?>
 <?php if ($role == 'admin'){ ?>         
		   <li>
            <a href="https://fair.liquag.com/users/transaction.php">
              <i class="bi bi-circle"></i><span>Transaction Types</span>
            </a>
          </li>
          <?php } ?>
<?php if ($role == 'admin'){ ?>          
		   <li>
            <a href="https://fair.liquag.com/users/fees.php">
              <i class="bi bi-circle"></i><span>Fees Types</span>
            </a>
          </li>
<?php } ?>
        </ul>
      </li><!-- End Tables Nav -->
<?php if ($role == 'admin'){ ?>
      <li class="nav-heading">Users Management</li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person-lines-fill"></i><span>System Users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

         
		   <li>
            <a href="https://fair.liquag.com/users/local.php">
              <i class="bi bi-circle"></i><span>Local System Users</span>
            </a>
          </li>

        </ul>
      </li><!-- End Tables Nav -->
     
<?php } ?>


    </ul>

  </aside><!-- End Sidebar-->
  <script>
      function activityWatcher(){

    //The number of seconds that have passed
    //since the user was active.
    var secondsSinceLastActivity = 0;

    //Five minutes. 60 x 5 = 300 seconds.
    var maxInactivity = (60 * 25);

    //Setup the setInterval method to run
    //every second. 1000 milliseconds = 1 second.
    setInterval(function(){
        secondsSinceLastActivity++;
       // console.log(secondsSinceLastActivity + ' seconds since the user was last active');
        //if the user has been inactive or idle for longer
        //then the seconds specified in maxInactivity
        if(secondsSinceLastActivity > maxInactivity){
           // console.log('User has been inactive for more than ' + maxInactivity + ' seconds');
            //Redirect them to your logout.php page.
            location.href = 'https://fair.liquag.com/logout.php';
        }
    }, 1000);

    //The function that will be called whenever a user is active
    function activity(){
        //reset the secondsSinceLastActivity variable
        //back to 0
        secondsSinceLastActivity = 0;
    }

    //An array of DOM events that should be interpreted as
    //user activity.
    var activityEvents = [
        'mousedown', 'mousemove', 'keydown',
        'scroll', 'touchstart'
    ];

    //add these events to the document.
    //register the activity function as the listener parameter.
    activityEvents.forEach(function(eventName) {
        document.addEventListener(eventName, activity, true);
    });


}

activityWatcher();
  </script>