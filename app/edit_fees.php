<?php 
ob_start();
require_once('session.php');
require_once('config/connect.php');


$newCur = $_POST['curName'];
$feeVer = $_POST['feeVer'];
$feeName = $_POST['feeName'];



if($newCur!=null){
	$curName = $newCur;
	$version = date("Y").".1";
}else{
	$curName = $feeName;
	$version = $feeVer+0.1;
}

//echo $curName;

$queryFees = "SELECT * from fees where fee_name = ? and version = ?";
$Fees = $conn->prepare($queryFees);
$Fees->execute(array($feeName, $feeVer));
while($row = $Fees->fetch(PDO::FETCH_ASSOC)){
	$count++;
	$fee = $row['name'];
	$name = $row['id'];
	$amount = $_POST[$name];

	echo $curName." - ".$version." - ".$row['category']." - ".$row['name']." - ".$amount."<br>";

	$query = "INSERT INTO fees (fee_name, version, name, price) values (?,?,?,?)";
	$pdo = $conn->prepare($query);
	$pdo->execute(array($curName, $version, $fee, $amount));

	if($pdo){
		echo "Success!";
		header('Location: https://chcc.ga/admin/admin.php?page=Account');
		ob_end_flush();
	}
}
?>