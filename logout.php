<?php
session_start();
require_once 'scripts/connection.php';
if(isset($_SESSION['zid']))
{

$session = 0;
$sessionid = $_SESSION['zid'];
$userid = $_SESSION['xid'];
echo $userid." ".$sessionid;
$login = date('Y-m-d H:m:s');
$updatesession = $conn->prepare("UPDATE realuzer SET session=?, last_login=? WHERE id=? ");
$updatesession->bind_param("sss", $session, $login, $userid);
$updatesession->execute();

    $_SESSION=array();
    unset($_SESSION);
    session_destroy();

header('Location: ./index.php');
}

?>