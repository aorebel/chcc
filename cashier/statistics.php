
<?php 
//$queryCheckAss = "SELECT sum(net_payable) as sumAss, count(student_id) as students, id from assessment where sem=? and school_year=?";
$queryCheckAss = "SELECT * from assessment where sem=? and school_year=?";
$getCheckAss = $conn->prepare($queryCheckAss);
$getCheckAss->execute(array($sem,$sy));
while($sumAss = $getCheckAss->fetch(PDO::FETCH_ASSOC)){
	$students += 1;
	$net += $sumAss['net_payable'];
}

$queryCheckEnrollment = "SELECT count(student_id) as students from enrollment where sem=? and school_year=?";
$getCheckEnrollment = $conn->prepare($queryCheckEnrollment);
$getCheckEnrollment->execute(array($sem,$sy));
$sumEnrollment = $getCheckEnrollment->fetch(PDO::FETCH_ASSOC);

$queryCheckAss2 = "SELECT * from assessment where sem=? and school_year=?";
$getCheckAss2 = $conn->prepare($queryCheckAss2);
$getCheckAss2->execute(array($sem,$sy));

while($rowAss2 = $getCheckAss2->fetch(PDO::FETCH_ASSOC)){
	//echo $rowAss2['id'];
	$assID2 = $rowAss2['id'];
	$queryCheckCashier = "SELECT * from cashier where assessment_id = ? and status != ?";
	$getCheckCashier = $conn->prepare($queryCheckCashier);
	$getCheckCashier->execute(array($assID2,"Pending"));
	while($cashSumRow = $getCheckCashier->fetch(PDO::FETCH_ASSOC)){
		//echo $cashSumRow['amount']."<br>";
		$sumcashier += $cashSumRow['amount'];
	}
	$queryCheckCashier2 = "SELECT * from cashier where assessment_id = ? and status = ?";
	$getCheckCashier2 = $conn->prepare($queryCheckCashier2);
	$getCheckCashier2->execute(array($assID2,"Pending"));
	while($cashSumRow2 = $getCheckCashier2->fetch(PDO::FETCH_ASSOC)){
		$countPending +=1;
	}

	$queryCheckCashier3 = "SELECT * from cashier where assessment_id = ? and status = ?";
	$getCheckCashier3 = $conn->prepare($queryCheckCashier3);
	$getCheckCashier3->execute(array($assID2,"Confirmed"));
	while($cashSumRow3 = $getCheckCashier3->fetch(PDO::FETCH_ASSOC)){
		$countConfirmed +=1;
	}
	//echo $sumcashier;
}
//echo $net;
$paidAve = floatval($sumcashier)/floatval($net);
$paidPer =  $paidAve * 100;

$unpaid = floatval($net) - floatval($sumcashier);
$unpaidAve =  floatval($unpaid)/floatval($net);
$unpaidPer = $unpaidAve * 100;
?>


<h3 class="w3-center"><?php echo $sy." - ".$sem; ?><br>Payment Statistics</h3>
<div class="w3-border w3-padding">
	<div class="w3-center">
		<b >
			Expected Collection <br>
			<?php echo "₱ ".$net;?>
		</b>
	</div>
	<br>
	
	<b>Collected Amount</b>
	<div class="w3-light-grey">
	  	
	  	<div class="w3-green" style="height:30px; line-height:30px; width:<?php echo $paidPer;?>%; padding-left: 20px;">
	  		<span class="w3-center"><b><?php echo number_format($paidPer, 2, '.', '');?>%</b></span>
	  		
	  	</div>
	  	<span class="w3-right" style="margin-top: -25px;"><b><?php echo "₱ ".$sumcashier; ?>.00</b></span>
	</div><br>
	
	<b>Uncollected Amount</b>
	<div class="w3-light-grey">
	  	<div class="w3-red" style="height:30px; line-height:30px; width:<?php echo $unpaidPer;?>%; padding-left: 20px;">
	  		<span class="w3-center"><b><?php echo number_format($unpaidPer, 2, '.', '');?>%</b></span>
	  	</div>
	  	<span class="w3-right" style="margin-top: -25px;"><b><?php echo "₱ ".$unpaid; ?>.00</b></span>
	</div><br>

	
</div>

<div class="w3-padding w3-row-padding">
	<div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16" style="height: 160px;">
        <div class="w3-left"><i class="fa fa-edit w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $students;?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Enlisted Students</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-green w3-padding-16" style="height: 160px;">
        <div class="w3-left"><i class="fa fa-user w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $sumEnrollment['students'];?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Enrolled Student</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16" style="height: 160px;">
        <div class="w3-left"><i class="fa fa-coins w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $countConfirmed;?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Confirmed Payments</i></h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16" style="height: 160px;">
        <div class="w3-left"><i class="fa fa-building w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $countPending;?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Pending Payments</h4>
      </div>
    </div>
</div>