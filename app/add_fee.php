<?php 

require_once('config/connect.php');

$cat = $_POST['cat'];
$fee = $_POST['fee'];
$price = $_POST['price'];

$array = (object)array();

$queryCheck = "select * from fees where category =? and name = ?";
$check = $conn->prepare($queryCheck);
$check->execute(array($cat,$fee));
$row = $check->fetch(PDO::FETCH_ASSOC);
if(!empty($row)){
	$array->status = "error";
	$data = json_encode($array);
echo $data;
}
else{

$query = "insert into fees (category, name, price) value(?,?,?)";
$stmt = $conn->prepare($query);
$stmt->execute(array($cat,$fee,$price));

$array->status = "succes";
$array->cat = $cat;
$array->fee = $fee;
$array->price = $price.".00";

$data = json_encode($array);
echo $data;
//header('Location: ../admin/admin.php?page=Account');
}
?>