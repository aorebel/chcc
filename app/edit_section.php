<?php 

require_once('config/connect.php');
ob_start();
/*
$units = $_REQUEST['units'];
//$slots = $_REQUEST['slots'];
$section = $_REQUEST['section'];

$query = "update sections set units=?, slots=? where section_code=?";
$stmt = $conn->prepare($query);
*/
$units = $_POST['units2'];
$status = $_POST['status2'];
$section = $_POST['section'];
$cid = $_POST['cid'];

$queryEditSection = "update sections set units = ?, status = ? where section_code = ?";
$editSection = $conn->prepare($queryEditSection);
if($editSection->execute(array($units,$status,$section))){
	header ("Location: ../admin/showContentByCourse.php?cid=$cid&tab=Section");
	ob_end_flush();
}else{
	echo "false";
}
?>
