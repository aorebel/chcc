<?php

require_once('../app/config/connect.php');
require_once('../app/session.php');
require_once('../app/getSYSem.php');
require_once('../app/functions.php');
require_once('../lib/stripe/init.php');
//require_once('../app/config/mail.php');

\Stripe\Stripe::setApiKey('sk_test_jXSjDN0qguLjuLrPauPqE2Io');
	


$item = $_POST['item'];
$assID = $_POST['assID'];
$sid = $_POST['sid'];
//$price = $_POST['price'];
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$email = $_POST['email'];
$token = $_POST['stripeToken'];

$option = $_POST['option'];
$net = $_POST['net'];

if($option=="full"){
  $div = 1;
  $perPay = $net/$div;
  $plan = "Full Payment";
}
else if($option=="half"){
  $div = 2;
  $perPay = $net/$div;
  $plan = "Two (2) Payments";
}
else if($option=="tri"){
  $div = 3;
  $perPay = $net/$div;
  $plan = "Three (3) Payments";
}
else if($option=="quarter"){
  $div = 4;
  $perPay = $net/$div;
  $plan = "Four (4) Payments";
}
$regFee = 500;

$ref = randomPass();

if($item=="Registration Fee"){
	$price = $regFee."00";
}else if($item=="Current Due"){
	$price = (int)$perPay."00";
	$item = "Tuition Fee";
}
echo "assID: ".$assID."<br>";
echo "Sid: ".$sid."<br>";
echo "net: ".$net."<br>";
echo "Price: ".$price."<br>";

//$price = "300000";
echo $token;
//create customer in stripe




$desc = $item;
$amount = substr($price, 0, -2);
$comment = "Paid with Card";

$get_year = new DateTime();
$year = date_format($get_year, 'Y');
$y = substr($year, -2);



$queryEnrollment = "SELECT * from enrollment where student_id = ? order by id DESC limit 1";
$getEnrollment = $conn->prepare($queryEnrollment);
$getEnrollment->execute(array($sid));
$enRow = $getEnrollment->fetch(PDO::FETCH_ASSOC);


$queryCashier = "SELECT * from cashier order by id DESC limit 1";
$getCashier = $conn->prepare($queryCashier);
$getCashier->execute();
$cashRow = $getCashier->fetch(PDO::FETCH_ASSOC);

$queryCashier1 = "SELECT * from cashier where assessment_id = ? order by id DESC limit 1";
$getCashier1 = $conn->prepare($queryCashier1);
$getCashier1->execute(array($assID));
$cashRow1 = $getCashier1->fetch(PDO::FETCH_ASSOC);
$counter = $getCashier1->rowCount();

if($cashRow1['counter']>0 || (empty($cashRow1))){

	if(substr($cashRow['cash_code'], 0,2)==$y){
		$cash_code = $cashRow['cash_code']+1;
	}else{
		$cash_code = $y."0000000001";
	}
	if($desc=="Registration Fee"){
		
		if($option == "full"){
			$counter = 1;
		}else if($option == "half"){
			$counter = 2;
		}else if($option == "tri"){
			$counter = 3;
		}else if($option == "quarter"){
			$counter = 4;
		}
		if($amount<500){
			$res = "Deny";
		}else{
			$res = "Confirm";
		}
		$curBal = $net;
	}else if($desc=="Tuition Fee"){
		if(!empty($cashRow1)){
			$counter = $cashRow1['counter']-1;
			$curBal = $cashRow1['bal'];
		}else{
			if($option == "full"){
				$counter = 1-1;
			}else if($option == "half"){
				$counter = 2-1;
			}else if($option == "tri"){
				$counter = 3-1;
			}else if($option == "quarter"){
				$counter = 4-1;
			}
			$curBal = $net;
		}
		if($amount){
			$res = "Confirm";
		}else{
			$res = "Deny";
		}
	}

	
	if( $cashRow1['counter']=="1"){
		$bal = $curBal - $amount;
		if($bal < 0){
			$change = $amount - $curBal;
			$amount = $amount - $change;
			$bal = 0;
			$paid = "Yes";

		}else{
			$bal = $curBal - $amount;
			$change = "0";
			if($bal>0){
				$paid = "No";
			}
		}
	}else{
		$bal = $curBal - $amount;
		$change = $bal;
		$paid = "Yes";
	}

	if($desc!=""){
		if($res == "Confirm" && $paid == "Yes"){
			echo $cash_code." ".$counter." ".$desc;
			$queryStudent = "SELECT * from students where student_id = ?";
			$getStudent = $conn->prepare($queryStudent);
			$getStudent->execute(array($sid));
			$row = $getStudent->fetch(PDO::FETCH_ASSOC);

			//$cdate = date_format($get_date, 'Y-m-d'); 
			
			$get_date = new DateTime();
			$date = date_format($get_date, 'Y-m-d'); 

			$description = $desc."<br>".$comment;
			$ref = randomPass();
			$query = "INSERT into cashier (cash_code,student_id,assessment_id,amount,perPay,comment,counter,bal,ref_no,status,confirm_date) value(?,?,?,?,?,?,?,?,?,?,?)";
			$pdo = $conn->prepare($query);
			$pdo->execute(array($cash_code,$sid,$assID,$amount,$perPay,$description,$counter,$bal,$ref,"Confirmed",$date));

			if($enRow['sem']==$sem && $enRow['schoo_year']==$sy){
				$queryUpdate = "UPDATE enrollment set enrollment_date = ? where student_id=? and sem = ? and school_year = ?";
				$pdoUpdate = $conn->prepare($queryUpdate);
				$pdoUpdate->execute(array($date,$id,$sem,$sy));
			}else{
				$queryInsert = "INSERT into enrollment (student_id,school_year,sem,year_level,course_code,enrollment_date,status) values(?,?,?,?,?,?,?)";
				$insert = $conn->prepare($queryInsert);
				$insert->execute(array($sid,$sy,$sem,$enRow['year_level'],$enRow['course_code'],$date,"REGULAR"));
			}
			if($pdo){
				echo "<br>success ".$curBal." - ".$amount." bal: ".$bal."<br>";
				echo "Change is ".$change." - ".$counter." - ".$option;
				$customer = \Stripe\Customer::create(array(
					"email" => $email,
					"source" => $token
				));

				//create customer in stripe
				$charge = \Stripe\Charge::create(array(
					"amount" => $price,
					"currency" => "PHP",
					"description" => $item,
					"customer" => $customer->id
				));
				header('location: success.php?ref='.$ref);
			}
		}else{
			echo "Payment error".$due." ".$amount ;
		}
	}else{
		echo "error".$user;
	}

}
else {
	echo "Student already fully paid";
}

 




//redirect to success




?>