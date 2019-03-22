<?php 
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

$y1 = substr($sy, 2, 2);
$s1 = substr($sem, 0, 1);
$lx = $y1."".$s1."00000001";
$code = $lx+$assRow['id'];
$lecunit = $assRow['lec_units']+($assRow['lab_units']*2);
$lecUnits = $lecunit-($assRow['lab_units']*2);

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

if($assRow['lab_units']>0){
	$labSubjFee = $assRow['lab_sub']/($assRow['lab_units']*2);
	$labRoomFee = $assRow['lab_room']/$assRow['lab_units'];
}else{
	$labSubjFee = "0";
	$labRoomFee = "0";
}
?>
<button class="w3-right w3-button w3-yellow" onclick="printCOR()">Print COR</button>
<div id="cForm" class="w3-padding" style="width: 100%; ">
	<header class="w3-center verdana">
		<p>
			Republic of the Philippines<br>
			<span class="school-name">Concepcion Holy Cross College</span><br>
			Concepcion, Tarlac
		</p>
		
			<span style="font-size: 20px; letter-spacing: 10px;">CERTIFICATE OF REGISTRATION</span><br>
		
		<b><?php echo "SY ".$sy." ".$sem."ester" ?></b>
		
	</header>
	<div class="w3-row w3-padding infoTable">
		<div class="w3-col s9 w3-padding">
			<p class="verdana">
				<span class="width-20">Assessment No:</span>
				<span class="width-80 right bold i"><?php echo $code; ?></span><br>
				<span class="width-20">Student No:</span>
				<span class="width-80 right bold i"><?php echo $sid; ?></span><br>
				<span class="width-20">Student Name:</span>
				<span class="width-80 right bold i"><?php echo $studentInfo['lname'].", ".$studentInfo['fname']." ".$mid[0].". ";?></span><br>
				<span class="width-20">Active Email:</span>
				<span class="width-80 right bold i"><?php echo $studentInfo['email'];?></span><br>
				<span class="width-20">Course:</span>
				<span class="width-80 right bold i"><?php echo getCourseName($conn,$enInfo['course_code']);?></span><br>
				<span class="width-20">Year Level:</span>
				<span class="width-80 right bold i"><?php echo $ylevel;?></span><br>
			</p>
		</div>
		<div class="w3-col s1"></div>
		<div class="w3-col s2 w3-right dot-border" style="margin-top: 20px; margin-right: 5px; padding-left: 10px; padding-right: 5px;">
			<p class="verdana">
				<span class="width-80">Lec Units:</span>
				<span class="width-20 right bold i text-right"><?php echo $lecunit; ?></span><br>
				<span class="width-80">Lab Units:</span>
				<span class="width-20 right bold i text-right"><?php echo $assRow['lab_units']; ?></span><br>
				<span class="width-80">Total Units:</span>
				<span class="width-20 right bold i text-right"><?php echo $assRow['units']; ?></span><br>
			</p>
		</div>
	</div>
	<div class="w3-row w3-padding subjTable dot-border " style="margin-top: -20px; margin-bottom: 10px;">
		<table class="w3-table verdana">
			<tr class="w3-border-bottom">
				<th>Section</th>
				<th>Subject Code</th>
				<th>Subject</th>
				<th>Lec Units</th>
				<th>Lab Units</th>				
				<th>Days</th>
				<th>Time</th>
				<th>Room</th>
				<th>Instructor</th>
			</tr>
		<?php 
			$page = "";
			showCOR($conn, $sid, $sy, $sem, $page);

		?>
		</table>
	</div>
	<div class="w3-row w3-padding feesTable">
		<div class="w3-col s7">
			<table class="verdana dot-border" style="width: 100%">
				<tr class="top-5">
					<th class="width-30 text-left">Fee:</th>
					<th class="width-30 text-left">Price per Unit</th>
					<th class="width-10 bold w3-center">Units</th>
					<th class="width-30 text-center">TOTAL</th>
				</tr>
				<tr class="top-5">
					<td class="width-30">Lec Units Fee:</td>
					<td class="width-30">PHP <?php echo $assRow['lec_fee']/$lecUnits?>.00</td>
					<td class="width-10 w3-center"><?php echo $lecUnits; ?></td>
					<td class="right bold ">PHP <?php echo $assRow['lec_fee']; ?></td>
				</tr>
				<tr class="top-5">
					<td class="width-30">Lab Room Fee:</td>
					<td class="width-30">PHP <?php echo $labRoomFee; ?>.00</td>
					<td class="width-10 w3-center"><?php echo $assRow['lab_units']; ?></td>
					<td class="right bold ">PHP <?php echo $assRow['lab_room']; ?></td>
				</tr>
				<tr class="top-5" style="border-bottom: 1px solid gray;">
					<td class="width-30">Lab Subject Fee:</td>
					<td class="width-30">PHP <?php echo $labSubjFee;  ?>.00</td>
					<td class="width-10 w3-center"><?php echo $assRow['lab_units']*2; ?></td>
					<td class="right bold ">PHP <?php echo $assRow['lab_sub']; ?></td>
				</tr>
			</table>
			<table class="verdana dot-border" style="width: 100%">
				<tr class="top-5">
					<td class="width-30">(Total) Tuition Fee :</td>
					<td class="width-30"></td>
					<td class="width-10 w3-center"></td>
					<td class="right bold bolder ">PHP <?php echo $assRow['tuition_fee']; ?></td>
				</tr>
			</table><br>
			<table class="verdana dot-border" style="width: 100%">
				<tr class="top-5">
					<td class="width-30">Tuition Fee:</td>
					<td class="width-30"></td>
					<td class="width-10 w3-center"></td>
					<td class="right bold ">PHP <?php echo $assRow['tuition_fee']; ?></td>
				</tr>
				<tr class="top-5">
					<td class="width-30">Miscellanious Fee:</td>
					<td class="width-30"></td>
					<td class="width-10 w3-center"></td>
					<td class="right bold">PHP <?php echo $assRow['misc_fee']; ?></td>
				</tr>
				<tr class="top-5">
					<td class="width-30">Enrollment Fee:</td>
					<td class="width-30"></td>
					<td class="width-10 w3-center"></td>
					<td class="right bold">PHP <?php echo $assRow['reg_fee']; ?></td>
				</tr>
				<tr class="top-5">
					<td class="width-30">Development Fee:</td>
					<td class="width-30"></td>
					<td class="width-10 w3-center"></td>
					<td class="right bold">PHP <?php echo $assRow['dev_fee']; ?></td>
				</tr>
				<tr class="top-5">
					<td class="width-30">Other Fees:</td>
					<td class="width-30"></td>
					<td class="width-10 w3-center"></td>
					<td class="right bold">PHP <?php echo $assRow['other_fee']; ?></td>
				</tr>
			</table>
			<table class="verdana dot-border" style="width: 100%">
				<tr class="top-5">
					<td class="width-30">Gross Payable Fees:</td>
					<td class="width-30"></td>
					<td class="width-10 w3-center"></td>
					<td class="right bold bolder">PHP <?php echo $assRow['total_amount']; ?></td>
				</tr>
			</table>
			<br>
			<table class="verdana dot-border" style="width: 100%">
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
					<td id="perPay" class="right bold">PHP <?php echo $perPay; ?></td>
				</tr>
			</table>
		</div>
		<div class="w3-col s5">

			<p class="bold verdana right">Please pay your dues before the exams to avoid conflicts! </p>
			<p class="verdana right" style="margin-right: 20px; margin-left: 10px;">
				Please check whether all entries in this Pre-Enrollment / Assessment Form are accurate and correct.
			</p><br><br><br><br><br><br><br><br><br><br><br><br>
			<p class="verdana " style="margin-right: 20px; margin-left: 10px;">
				Kindly sign below to attest the correction of all entries.
				<br><br>
				Conforme:<br><br>
				<span class="text-center border-bottom bold pad-left-20 pad-right-20" style="display: block; width: 100%;">
					<?php echo $studentInfo['fname']." ".$mid[0].". ".$studentInfo['lname'] ?>
				</span>
			</p>
		</div>
	</div>
	<div class="w3-row verdana">
	</div>
	<footer class="verdana text-center">
		<p>This is a system generated assessment. All calculations are done thru system-fed information and inputs from the client side of this system. For corrections please contact our admin office.</p>
	</footer>

</div>

<script>
function printCOR(){
    var printContents = document.getElementById('cForm').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();
    //document.body.innerHTML = printContents;
    document.body.innerHTML = originalContents;
}

</script>