<?php

require_once('config/connect.php');
require_once('config/mail.php');
require_once('functions.php');
require_once('getSYSem.php');


$sid = $_POST['user'];
$assID = $_POST['assID'];
$ref = $_POST['ref'];
$desc = $_POST['desc'];
$amount = $_POST['amount'];
$due = $_POST['due'];
$plan = $_POST['plan'];

$get_year = new DateTime();
$year = date_format($get_year, 'Y');
$y = substr($year, -2);

$queryAss = "SELECT * from assessment where id=?";
$getAss = $conn->prepare($queryAss);
$getAss->execute(array($assID));
$assRow = $getAss->fetch(PDO::FETCH_ASSOC);
$net = $assRow['net_payable'];

$queryCashier = "SELECT * from cashier order by id DESC limit 1";
$getCashier = $conn->prepare($queryCashier);
$getCashier->execute();
$cashRow = $getCashier->fetch(PDO::FETCH_ASSOC);

$queryCashier1 = "SELECT * from cashier where assessment_id = ? order by id DESC limit 1";
$getCashier1 = $conn->prepare($queryCashier1);
$getCashier1->execute(array($assID));
$cashRow1 = $getCashier1->fetch(PDO::FETCH_ASSOC);


if(substr($cashRow['cash_code'], 0,2)==$y){
	$cash_code = $cashRow['cash_code']+1;
}else{
	$cash_code = $y."0000000001";
}
if($desc=="Tuition Fee"){
	if(!empty($cashRow1)){
		$counter = $cashRow1['counter']-1;
		$net = $cashRow1['bal'];
	}else{
		if($plan == "full"){
			$counter = 1-1;
		}else if($plan == "half"){
			$counter = 2-1;
		}else if($plan == "tri"){
			$counter = 3-1;
		}else if($plan == "quarter"){
			$counter = 4-1;
		}
	}
	
}else{
	if(!empty($cashRow1)){
		$net = $cashRow1['bal'];
	}else{
		if($plan == "full"){
			$counter = 1;
		}else if($plan == "half"){
			$counter = 2;
		}else if($plan == "tri"){
			$counter = 3;
		}else if($plan == "quarter"){
			$counter = 4;
		}
	}
}





echo $cash_code." ".$counter." ".$desc;
$queryStudent = "SELECT * from students where student_id = ?";
$getStudent = $conn->prepare($queryStudent);
$getStudent->execute(array($sid));
$row = $getStudent->fetch(PDO::FETCH_ASSOC);

$query = "INSERT into cashier (cash_code,student_id,assessment_id,amount,perPay,comment,counter,bal,ref_no,status) value(?,?,?,?,?,?,?,?,?,?)";
$pdo = $conn->prepare($query);
$pdo->execute(array($cash_code,$sid,$assID,$amount,$due,$desc,$counter,$net,$ref,"Pending"));
if($pdo){
	echo "success";
}
?>
