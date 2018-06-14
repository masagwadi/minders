<?php


$now = time(); // or your date as well
$your_date = strtotime("2018-6-7");
$datediff = $now - $your_date;

$diffinal = round($datediff / (60 * 60 * 24));

echo $diffinal;

?>