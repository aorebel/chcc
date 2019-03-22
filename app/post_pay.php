<?php

require_once('config/connect.php');
require_once('config/mail.php');
require_once('session.php');
require_once('getSYSem.php');
require_once('functions.php');

//session_start();
$user = $_SESSION['user'];

$pass = $_POST['pass'];
$sid = $_POST['sid'];
$assID = $_POST['assID'];
$desc = $_POST['desc'];
$amount = $_POST['amount'];
$due = $_POST['due'];
$commnet = $_POST['comment'];

$get_year = new DateTime();
$year = date_format($get_year, 'Y');
$y = substr($year, -2);

//get user information for password verification
$queryUser = "SELECT * from users where user_id = ? and pass = ?";
$getUser = $conn->prepare($queryUser);
$getUser->execute(array($user,$pass));
$userRow = $getUser->fetch(PDO::FETCH_ASSOC);

//check if student already enrolled
$queryEnrollment = "SELECT * from enrollment where student_id = ? order by id DESC limit 1";
$getEnrollment = $conn->prepare($queryEnrollment);
$getEnrollment->execute(array($sid));
$enRow = $getEnrollment->fetch(PDO::FETCH_ASSOC);

//check if assesment information
$queryAss = "SELECT * from assessment where id=? and school_year=? and sem=? order by id DESC limit 1";
$getAss = $conn->prepare($queryAss);
$getAss->execute(array($assID,$sy,$sem));
$assRow = $getAss->fetch(PDO::FETCH_ASSOC);
$net = $assRow['net_payable'];
$plan = $assRow['pay_plan'];

//Get cashier or transction number to reproduce
$queryCashier = "SELECT * from cashier order by id DESC limit 1";
$getCashier = $conn->prepare($queryCashier);
$getCashier->execute();
$cashRow = $getCashier->fetch(PDO::FETCH_ASSOC);

//getc cashier information that student have
$queryCashier1 = "SELECT * from cashier where assessment_id = ? order by id DESC limit 1";
$getCashier1 = $conn->prepare($queryCashier1);
$getCashier1->execute(array($assID));
$cashRow1 = $getCashier1->fetch(PDO::FETCH_ASSOC);

//if student still have more than 0 payments left orif students still did make a payment
if($cashRow1['counter']>0 || (empty($cashRow1))){

	//will check if the transaction number already created for the current year
	if(substr($cashRow['cash_code'], 0,2)==$y){
		//if transaction number that starts with the last two digit of the year is found new transaction code will be plus 1 of the previous
		$cash_code = $cashRow['cash_code']+1;
	}else{
		//else if trasaction number that start's with the last two digit of the year then generate new Trans number with differnet prepfic
		$cash_code = $y."0000000001";
	}

	//Check if description of the option is Registration fee
	if($desc=="Registration Fee"){
		
		if($plan == "full"){
			$counter = 1;
		}else if($plan == "half"){
			$counter = 2;
		}else if($plan == "tri"){
			$counter = 3;
		}else if($plan == "quarter"){
			$counter = 4;
		}
		// set current balance info from $net
		$curBal = $net;
	//Check if description of the option is Registration fee
	}else if($desc=="Tuition Fee"){

		if(!empty($cashRow1)){
			$counter = $cashRow1['counter']-1;
			$curBal = $cashRow1['bal'];
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
			$curBal = $net;
		}
	}else if($desc == "Promisorry"){
		if(!empty($cashRow1)){
			$counter = $cashRow1['counter'];
			$curBal = $cashRow1['bal'];
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
			$curBal = $net;
		}
	}

	if($desc=="Tuition Fee"){
		if($amount>=$due || $amount>=$cashRow1['bal']){
			$res = "Confirm";
		}else{
			$res = "Deny";
		}
	}else{
		if($amount<500){
			$res = "Deny";
		}else{
			$res = "Confirm";
		}
	}
	if($cashRow1['counter']=="1"){
		$bal = $curBal - $amount;
		if($bal < 0){
			$change = $amount - $curBal;
			$amount = $amount - $change;
			//$bal = $curBal - $amount;
			$bal=0;
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
		$paid = "Yes";
	}

	if(!empty($userRow) && $desc!=""){
		if($res == "Confirm"){
			//echo $cash_code." ".$counter." ".$desc;
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
			$pdo->execute(array($cash_code,$sid,$assID,$amount,$due,$description,$counter,$bal,$ref,"Confirmed",$date));

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
				//echo "You've successfully processed Payment.";
				//echo "Outstanding balance is ".$bal;
				echo $ref;
				//header('location: success.php?ref='.$ref);
			}
		}else{
			echo "Payment error".$due." ".$amount." ".$desc;
		}
	}else{
		echo "error".$user;
	}

}
else{
	echo "Student already fully paid";
}
?>
