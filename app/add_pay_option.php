<?php 

require_once('config/connect.php');
$option = $_POST['option'];
$id = $_POST['id'];
$total = $_POST['total'];

$array = (object)array();


if($option==""){
	$array->status = "error";
	$data = json_encode($array);
	echo $data;
}else{
	if($option=="full"){
		$discount = 1000.00;
		$div = 1;
		$net = $total - $discount;
		$perPay = "N/A";
		$plan = "Full Payment";
	}
	else if($option=="half"){
		$discount = 0;
		$div = 2;
		$net = $total - $discount;
		$perPay = $net/$div;
		$plan = "Two (2) Payments";
	}
	else if($option=="tri"){
		$discount = 0;
		$div = 3;
		$net = $total - $discount;
		$perPay = $net/$div;
		$plan = "Three (3) Payments";
	}
	else if($option=="quarter"){
		$discount = 0;
		$div = 4;
		$net = $total - $discount;
		$perPay = $net/$div;
		$plan = "Four (4) Payments";
	}

	
	$query = "update assessment set pay_plan = ?, discount = ?, net_payable = ? where id= ?";
	$insert = $conn->prepare($query);
	$insert->execute(array($option,$discount,$net,$id));
	if($insert){
		$array->status = "success";
		$array->option = $plan;
		$array->discount = $discount;
		$array->net = $net;
		$array->perPay = $perPay;
		$data = json_encode($array);
		echo $data;
	}
}

?>