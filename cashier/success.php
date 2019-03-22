<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Success!</title>
	<link rel="stylesheet" href="../lib/css/w3.css">
	<link rel="stylesheet" href="../lib/css/forPrint.css">
</head>
<?php 


require_once('../app/config/connect.php');
require_once('../app/getSYSem.php');
require_once('../app/readNumber.php');
require_once('../app/functions.php');
require_once('../lib/stripe/init.php');

//session_start();
$role = $_SESSION['user_role'];
echo $role;
//require_once('../app/config/mail.php');
$ref = $_GET['ref'];

$queryCashier = "SELECT * from cashier where ref_no=?";
$getCashier = $conn->prepare($queryCashier);
$getCashier->execute(array($ref));
$cashRow = $getCashier->fetch(PDO::FETCH_ASSOC);

$sid = $cashRow['student_id'];
$assID = $cashRow['assessment_id'];

$assRow = getAssessmentInfo($conn,$sid,$sem,$sy);

$queryGetStudentInfo = "SELECT * from students where student_id=?";
$getStudentInfo = $conn->prepare($queryGetStudentInfo);
$getStudentInfo->execute([$sid]);
$studentInfo = $getStudentInfo->fetch(PDO::FETCH_ASSOC);
$id = $studentInfo['id'];
$mi = explode(".", $studentInfo['mi']);
$fullname = ucwords($studentInfo['fname']." ".$mi[0].". ".$studentInfo['lname']);

$get_enrollment_info = "select * from studentenrollment where student_id = ? order by id DESC limit 1";
$enrollment_info = $conn->prepare($get_enrollment_info);
$enrollment_info->execute(array($sid));
$enInfo = $enrollment_info->fetch(PDO::FETCH_ASSOC);


if($enInfo['year_level']=="I"){
	$ylevel = "1st Year";
}
else if($enInfo['year_level']=="II"){
	$ylevel = "2nd Year";
}
else if($enInfo['year_level']=="III"){
	$ylevel = "3rd Year";
}
else if($enInfo['year_level']=="IV"){
	$ylevel = "4th Year";
}

$inWords = readNumber($cashRow['amount'], $depth=0);

//$inWord = explode(" ", $inWords)


?>
<body>
	<div class="w3-container w3-padding">
		<h5 class="w3-center">Thank you for paying! Your transction ID is <b><?php echo $ref;?></b></h5>
		<p class="w3-center"><a href="https://chcc.ga/cashier/?page=Students" class="w3-button w3-blue ">Back</a></p>
		<hr>		
		
	</div>
<button class="w3-button w3-yellow" style="position: absolute; right: 0; margin-right: 20px;" onclick="printReceipt()">Print Receipt</button>
	<div id="rForm" class="w3-padding" style="width: 100%; ">
		<header class="w3-center verdana">
			<p>
				Republic of the Philippines<br>
				<span class="school-name">Concepcion Holy Cross College</span><br>
				Concepcion, Tarlac
			</p>
			
				<b><span style="font-size: 20px; letter-spacing: 10px;">OFFICIAL RECEIPT</span><br>
			
			<?php echo "SY ".$sy." ".$sem."ester" ?></b>
			
		</header>
		<div class="w3-row w3-padding infoTable">
			<div class="w3-col s9 w3-padding">
				<p class="verdana">
					<span class="width-20">Transaction No:</span>
					<span class="width-80 right bold i"><?php echo $cashRow['cash_code']; ?></span><br>
					<span class="width-20">Student No:</span>
					<span class="width-80 right bold i"><?php echo $sid; ?></span><br>
					<span class="width-20">Student Name:</span>
					<span class="width-80 right bold i"><?php echo $studentInfo['lname'].", ".$studentInfo['fname']." ".$mi[0].". ";?></span><br>
					<span class="width-20">Active Email:</span>
					<span class="width-80 right bold i"><?php echo $studentInfo['email'];?></span><br>
					<span class="width-20">Course:</span>
					<span class="width-80 right bold i"><?php echo getCourseName($conn,$enInfo['course_code']);?></span><br>
					<span class="width-20">Year Level:</span>
					<span class="width-80 right bold i"><?php echo $ylevel;?></span><br>
				</p>
			</div>
			<div class="w3-row w3-padding subjTable  " style="margin-top: 20px; margin-bottom: 10px;">
				<table class="w3-table verdana w3-padding w3-border"  style="height: 300px;">
					<tr class="w3-border" style="height: 30px !important;">
						<th class="w3-center w3-border">ITEM DESCRIPTION</th>
						<th class="w3-center w3-border">AMOUNT</th>
						<th class="w3-center w3-border">DATE PAID</th>
					</tr>
					<tr style="padding-top: 50px;" style="font-family: typewriter !important;">
						<td class="w3-center"><b><?php echo str_replace("<br>", " ", $cashRow['comment']); ?></b></td>
						<td class="w3-center"><?php echo $cashRow['amount']; ?></td>
						<td class="w3-center"><?php echo $cashRow['confirm_date']; ?></td>
					</tr>
				
				</table>
				<table class="w3-table verdana w3-padding w3-border" >
					<tr>
						<td>Total Amount Paid:  </td>
						<td class="w3-right"><?php echo $cashRow['amount'];?></td>
					</tr>
					<tr>
						<td>Amount in words:</td>
						<td class="w3-right"><b><?php echo ucfirst($inWords);?> Pesos Only </b></td>
					</tr>
					
				</table>
			</div>
			<div class="verdana w3-padding">
				<p class="w3-center">Keep this document for future reference</p>
				<p class="w3-center">This is a sytem generated receipt all information are based on the user input gathered from the previous form that was filled. If there's any correction please contact your School Admin.</p>
			</div>
		</div>
	</div>
	<script>
		function printReceipt(){
		    var printContents = document.getElementById('rForm').innerHTML;
		    var originalContents = document.body.innerHTML;

		    document.body.innerHTML = printContents;

		    window.print();
		    //document.body.innerHTML = printContents;
		    document.body.innerHTML = originalContents;
		}
	</script>
</body>
</html>
