<?php

require_once('../app/config/connect.php');
require_once('../app/functions.php');
require_once('../app/getSYSem.php');


$sid = $_POST['sid'];

$queryGetStudentInfo = "SELECT * from students where id=?";
$getStudentInfo = $conn->prepare($queryGetStudentInfo);
$getStudentInfo->execute([$sid]);
$studentInfo = $getStudentInfo->fetch(PDO::FETCH_ASSOC);
$id = $studentInfo['student_id'];
//echo $id;

$mi = explode(".", $studentInfo['mi']);
$fullname = ucwords($studentInfo['fname']." ".$mi[0].". ".$studentInfo['lname']);

//$sid = $user;


$get_enrollment_info = "select * from studentenrollment where student_id = ? order by id DESC limit 1";
$enrollment_info = $conn->prepare($get_enrollment_info);
$enrollment_info->execute(array($id));
$enInfo = $enrollment_info->fetch(PDO::FETCH_ASSOC);

$courseCode = $enInfo['course_code'];
$roman = $enInfo['year_level'];
if($roman=="I"){
    $yl = "1";
}
else if($roman=="II"){
    $yl = "2";
}
else if($roman=="III"){
    $yl = "3";
}
else if($roman=="IV"){
    $yl = "4";
}

$cue=$courseCode."-".$yl;

$enrollmentRow = queryEnrollmentInfo($conn, $id) -> fetch(PDO::FETCH_ASSOC);
$isRegular = $enrollmentRow['status'];

$querySC = "select * from student_classes where student_id = ? and sem = ? and school_year = ?";
$sc = $conn->prepare($querySC);
$sc->execute(array($id, $sem, $sy));
$scRow = $sc->fetch(PDO::FETCH_ASSOC);


$assRow = getAssessmentInfo($conn,$id,$sem,$sy);

$option = $assRow['pay_plan'];
$net = $assRow['net_payable'];

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
echo "<h5 class='w3-center'><b>".$fullname."</b><br>";
echo $id."<br>".$cue."</h5>";
$ref = randomPass();


$assRow = getAssessmentInfo($conn,$id,$sem,$sy);

$assID = $assRow['id'];

$queryCashier = "SELECT * from cashier where student_id = ? and assessment_id = ? ";
$getCashier = $conn->prepare($queryCashier);
$getCashier->execute(array($id, $assID));
$cashRow = $getCashier->fetch(PDO::FETCH_ASSOC);

if(!empty($cashRow)){

  $queryCashier1 = "SELECT * from cashier where student_id = ? and assessment_id = ? order by id DESC limit 1";
  $getCashier1 = $conn->prepare($queryCashier1);
  $getCashier1->execute(array($id, $assID));
  $cashRow1 = $getCashier1->fetch(PDO::FETCH_ASSOC);

  $queryCashier2 = "SELECT * from cashier where student_id = ? and assessment_id = ? and status = ? order by id DESC limit 1";
  $getCashier2 = $conn->prepare($queryCashier2);
  $getCashier2->execute(array($id, $assID,"Pending"));
  $cashRow2 = $getCashier2->fetch(PDO::FETCH_ASSOC);

  $queryCashier3 = "SELECT sum(amount) as sum from cashier where student_id = ? and assessment_id = ? and status != ? order by id DESC limit 1";
  $getCashier3 = $conn->prepare($queryCashier3);
  $getCashier3->execute(array($id, $assID, "Pending"));
  $cashRow3 = $getCashier3->fetch(PDO::FETCH_ASSOC);

}



$option = $assRow['pay_plan'];
$net = $assRow['net_payable'];

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
$regFee = 500.00;

$ref = randomPass();

$refCode = $cashRow2['ref_no'];


if(empty($cashrow)){
  $paymentStatus = "No payments yet";
}else{
  if($cashRow['count']==""){

  }
}


?>
<head>
	
    <link rel="stylesheet" href="../lib/css/forPrint.css">
</head>
<div class="w3-row w3-padding">
	<div class="w3-col s12 l6 w3-padding">
<table class="verdana dot-border w3-padding" style="width: 100%; margin-top:20px;" >
  <tr class="top-5">
    <td class="width-30">Payment Plan:</td>
    <td class="width-30"></td>
    <td class="width-10 w3-center"></td>
    <td id="po" class="right bold"><?php echo $plan; ?></td>
  </tr>
  <tr class="top-5">
    <td class="width-30">Discount:</td>
    <td class="width-30"></td>
    <td class="width-10 w3-center"></td>
    <td id="discount" class="right bold">PHP <?php echo $assRow['discount']; ?></td>
  </tr>
  <tr class="top-5">
    <td class="width-30">Net Payable:</td>
    <td class="width-30"></td>
    <td class="width-10 w3-center"></td>
    <td id="net" class="right bold">PHP <?php echo $assRow['net_payable']; ?></td>
  </tr>
  <tr class="top-5">
    <td class="width-30">Per Pay Payable:</td>
    <td class="width-30"></td>
    <td class="width-10 w3-center"></td>
    <td id="perPay" class="right bold">PHP <?php if($cashRow1['bal']>0){echo $perPay;}else{ echo 0;} ?>.00</td>
  </tr>
</table>
<table class="verdana dot-border w3-padding" style="width: 100%; margin-top:20px;" >
  <tr class="top-5">
    <td class="width-30">Payment Status:</td>
    <td id="po" class="right bold"><?php echo $paymentStatus; ?></td>
  </tr>
  <tr class="top-5">
    <td class="width-30">Payments Left:</td>
    <td id="discount" class="right bold"><?php echo $cashRow1['counter']; ?> Payments Left</td>
  </tr>
  <tr class="top-5">
    <td class="width-30">Total Paid Amount:</td>
    <td id="net" class="right bold">PHP <?php echo $cashRow3['sum']; ?></td>
  </tr>
  <tr class="top-5">
    <td class="width-30">Outstanding Balance:</td>
    <td id="net" class="right bold">PHP <?php echo $cashRow1['bal']; ?></td>
  </tr>
  <tr class="top-5">
    <td class="width-30">Current Due:</td>
    <td id="perPay" class="right bold">PHP <?php if($cashRow1['bal']>0){echo $perPay;} ?>.00</td>
  </tr>
</table>
</div>
<div class="w3-col s12 l6 w3-padding">
	<div class="w3-row">
		<div class="w3-col s12 l9">
			<table class="verdana dot-border w3-padding" style="width: 100%; margin-top:20px;" >
			  	<tr class="top-5">
				    <td class="width-50">Pending Student Payment:</td>
				    
				    <td id="net" class="right bold">PHP <?php echo $cashRow2['amount']; ?></td>
				 </tr>
				 <tr style="display: none;">
				 	<td class="width-50">REFERENCE CODE:</td>
				 	<td id="net" class="right bold"> (  <?php echo $refCode; ?> )</td>
				 </tr>
         <tr>
          <td class="width-50">Confirm Password:</td>
          <td id="net" class="right bold">
            <input type="password" id="penpass" class="w3-input w3-border">
          </td>
         </tr>
			</table>
		</div>
		<div class="w3-col s12 l3">
      <?php 
        if(!empty($cashRow2)){
      ?>
			<button class="w3-button w3-blue" style="margin-top: 20px;" onclick="confirmPay('<?php echo $id; ?>','<?php echo $refCode; ?>')">Confirm Paid</button>
      <?php }else{
      ?>
      <button class="w3-button w3-gray" style="margin-top: 20px;" disabled>Confirm Paid</button>
      <?php
      } ?>
		</div>
	
	</div>
	<table class="verdana w3-border w3-padding" style="width: 100%; margin-top:20px;" >
	  	<tr class="top-5">
		    <td class="width-30" style="width: 30% !important;">Amount Due:</td>
		    <td  class="w3-right bold " style="">PHP <span id="duepay"><?php 
        if($cashRow1['bal']>0){echo $perPay;}
         ?></span></td>
	  	</tr>
	  	<tr class="top-5">
		    <td class="width-30">Description:</td>
		    <td id="net" class="right bold">
          <select name="desc" id="duedesc" class="w3-input">
            <option value="">Select Description</option>
            <option value="Tuition Fee">Pay Tuition Fee</option>
            <?php if(empty($cashRow)){?>
            <option value="Registration Fee">Registration Fee</option>
            <?php } ?>
            <option value="Promisorry">Promisorry Note</option>
          </select>  
        </td>
	  	</tr>
	  	<tr class="top-5">
		    <td class="width-30">Amount Paid:</td>
		    <td id="net" class="right bold width-70">
		    	<input type="text" id="dueamount" class="w3-input w3-border">
		    </td>
	  	</tr>
	  	<tr class="top-5">
		    <td class="width-30">Comment:</td>
		    <td id="net" class="right bold width-70">
				<textarea name="" id="dueComment" cols="30" rows="2" class="w3-input w3-border"></textarea>
		    </td>
	  	</tr>
	  	<tr class="top-5">
		    <!--td class="width-30">Change:</td>
		    <td id="duechange" class="right bold"></td-->
	  	</tr>
	  	<tr class="top-5">
        <td class="width-30">Confirm Password:</td>
        <td id="net" class="right bold width-70">
          <input type="password" id="duepass" class="w3-input w3-border">
        </td>
      </tr>
	</table>
  <?php 
  if($assRow['pay_plan']==null){?>
    <button class="w3-right w3-button w3-gray" disabled>Submit Payment</button>
    <?php
  }else{
    if(!empty($cashRow2) || $cashRow1['counter']=="0"){
  
  
  ?>
	<button class="w3-right w3-button w3-gray" disabled>Submit Payment</button>
  <?php }else{

    ?>
  <button class="w3-right w3-button w3-blue" onclick="postPay('<?php echo $id; ?>','<?php echo $assID; ?>')">Submit Payment</button>
  <?php
     }} ?>
</div>
</div>		


<script>

</script>