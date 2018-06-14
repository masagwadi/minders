<?php
include('config/functions.php');
include('partials/header.php');
session_start();

$ref = $_GET['ref'];
$email = $_GET['email'];
$sdate = $_GET['sdate'];


$sql = "SELECT * from bookings WHERE owneremail = '$email' AND reference = '$ref' AND startdate = '$sdate' LIMIT 1";
$result = $dbConn->query($sql) or die("Could not execute mysqli QUERY090 - I'm at Func login 21");


if ($result->num_rows != 1) {
    $errMSG= "<b>Error:</b> Invalid login details";
} else {


    $query3 = "UPDATE `bookings` SET `bookings`.`bookpayment` = 'paid' WHERE `bookings`.`reference` = '$ref' AND `owneremail`='$email'";
    $result205 = $dbConn->query($query3) or die("Could not execute mysqli QUERY090 - I'm at Func login 21");
// $resultcode2=db_Query($query3);

}
?>

<h1>Thanks You Pay pay</h1>



<?php
include('partials/footer.php');
?>