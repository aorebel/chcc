<?php 
ob_start();
require_once('config/connect.php');
date_default_timezone_set("Asia/Manila");
$commandID = $_POST['commandID'];
$status = $_POST['status'];


$currentMonth = date ("m");
$currentYear = date ("Y");


if( ($currentMonth>=6) && ($currentMonth<=10) && ($commandID=="5") || ($commandID=="3" ) || ($commandID=="6" ) ){
	$syEnd = $currentYear +1;
	$sy = $currentYear."-".$syEnd;
	$sem = "1st Sem";
}
else if( ($currentMonth>=1) && ($currentMonth<=4) && ($commandID=="5") || ($commandID=="3") || ($commandID=="6" ) ){
	$syStart = $currentYear - 1;
	$sy = $syStart."-".$currentYear;
	$sem = "2nd Sem";
}
else if( ($currentMonth>=11) && ($currentMonth<=12) && ($commandID=="5") || ($commandID=="3") || ($commandID=="6" ) ){
	$syEnd = $currentYear +1;
	$sy = $currentYear."-".$syEnd;
	$sem = "2nd Sem";
}
else if( ($currentMonth>=9) && ($currentMonth<=12) && ($commandID=="1") ){
	$syEnd = $currentYear +1;
	$sy = $currentYear."-".$syEnd;
	$sem = "2nd Sem";
}
else if( ($currentMonth>=4) && ($currentMonth<=8) && ($commandID=="1") ){
	$syEnd = $currentYear +1;
	$sy = $currentYear."-".$syEnd;
	$sem = "1st Sem";
}
else if( ($currentMonth>=3) && ($currentMonth<=4) && ($commandID=="1") ){
	$syEnd = $currentYear +1;
	$sy = $currentYear."-".$syEnd;
	$sem = "Summer";
}

else if( ($currentMonth>=1) && ($currentMonth<=2) && ($commandID=="1") ){
	$syEnd = $currentYear +1;
	$sy = $currentYear."-".$syEnd;
	$sem = "2nd Sem";
}

$updateQueryCommand = "update commands set status= ?, school_year=?, sem=? where id = ?";
$updateCommand = $conn->prepare($updateQueryCommand);
$updateCommand->execute(array($status,$sy,$sem,$commandID));


header('location: ../admin/admin.php?page=Home');
ob_end_flush();

?>