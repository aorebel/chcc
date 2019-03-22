
<div class="w3-container">
	<button onclick="printMe()" class="w3-button w3-yellow w3-right" style="margin-left: 10px;">Print</button>
	<button onclick="showAddLegacySubject('<?php echo $sid ?>')" class="w3-button w3-yellow w3-right">Add Legacy Subject with Grade Record</button>
	
</div>
<?php 
$queryGrade = "select * from grade where student_id = ?";
$pdoGrade = $conn->prepare($queryGrade);
$pdoGrade->execute(array($sid));
$row = $pdoGrade->fetch(PDO::FETCH_ASSOC);
if(empty($row))
{

?>
<div id="transcript" style="display: none">
<?php
}else{?>
<div id="transcript" style="">
<?php } ?>
<header class="w3-center verdana">
		<p>
			Republic of the Philippines<br>
			<span class="school-name">Concepcion Holy Cross College</span><br>
			Concepcion, Tarlac
		</p>
		
			<b>EVALUATION FORM</b>
		<h5><b>
		<?php echo $fullname; ?>
			<br>
		<?php echo getCourseName($conn,$enInfo['course_code']); ?>
		</b>
		</h5>
	</header>
<?php if($role=="admin"){ ?>


<hr style="margin-top: 10px;">
<?php } ?>



<?php 
	//echo $sid;
	//require_once('../app/config/connect.php');
	require_once('../app/functions.php');
	//$sid = "15-0293";
	$queryGetSy = "SELECT count(*),school_year,sem, course_code, year_level, subject_id from grade where student_id = ? group by school_year, sem, course_code, year_level having count(*) > 0 order by school_year and sem ASC";
	$getSy = $conn->prepare($queryGetSy);
	$getSy->execute(array($sid));
	while ($syrow = $getSy->fetch(PDO::FETCH_ASSOC)) {
		$semsy = $syrow['sem'];
		$sysy = $syrow['school_year'];



?>
	
	<table id="<?php echo $yearLevel.'_'.$schoolYear.'_'.$semester;?>" class="w3-padding w3-container" style="font-family: arial narrow !important; font-size: 14px !important; width: 95%; margin-left: 0 !important;">
		<tr>
			<th><?php echo "<h5>".$syrow['course_code']." - ".$syrow['year_level']."</h5>( S.Y. ".$syrow['school_year']." - ".$syrow['sem']." )"; ?></th>
			<th>
				<table>
					
				
		
		<tr>
			<th>Subject Code</th>
			<th>Subject</th>	
			<th>Units</th>
			<th>Final Grade</th>
			<th>Remarks</th>
		</tr>
<?php 

	$queryGradeOnAdmin = "SELECT * from grade where student_id = ? and school_year = ? and sem = ?";
	$getGradeOnAdmin = $conn->prepare($queryGradeOnAdmin);
	$getGradeOnAdmin->execute(array($sid,$sysy,$semsy));

	while($gradeOnAdminRow=$getGradeOnAdmin->fetch(PDO::FETCH_ASSOC)){

		$s_id = $gradeOnAdminRow['subject_id'];
		$subject = getSubjectBySubjectCode($conn, $s_id);
		$subByAdRow = $subject->fetch(PDO::FETCH_ASSOC);
		$subByAdName = $subByAdRow['subject'];
		$subByAdCode = $subByAdRow['subject_code'];
		$gradeByAdminMidterms = $gradeOnAdminRow['midterms'];
		$gradeByAdminFinals = $gradeOnAdminRow['finals'];
		$gradeByAdminGrade = $gradeOnAdminRow['grade'];
		$gradeByAdminRemarks = $gradeOnAdminRow['remarks'];
		$yearLevel = $gradeOnAdminRow['year_level'];
		$schoolYear = $gradeOnAdminRow['school_year'];
		$semester = $gradeOnAdminRow['sem'];

?>
		<tr>
			<td class="w3-center" style="width:10%;"><?php echo $subByAdCode; ?></td>
			<td class="" style="width:50%; text-align: left !important;"><?php echo $subByAdName; ?></td>
			<td style="width:5%;">
				<?php 
					$getUnitsQuery = "SELECT * from subjects where id = ?";
					$getUnits = $conn->prepare($getUnitsQuery);
					$getUnits->execute(array($s_id));
					$unitsrow = $getUnits->fetch(PDO::FETCH_ASSOC);
					echo $unitsrow['total_units'];
					$totalUnits += $unitsrow['total_units'];
				?>
			</td>
			<td class="w3-center" style="width:4%;"><?php echo $gradeByAdminGrade; ?></td>
			<td class="w3-center" style="width:10%;"><?php echo $gradeByAdminRemarks; ?></td>
		</tr>

<?php
	}?>
	

		</table>
	</th>
</tr>
<tr class="w3-border">
	<td></td>
	<td>
		<span class="w3-center">Total Units</span>
		<span style="float: right; margin-right: 21%;"><?php echo $totalUnits/2; ?></span>
	</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	
</tr>
	<?php
}
?>			
	</table>

<?php ?>	
</div>
<div id="addLegacySubjects" class="w3-modal">

  <div class="w3-modal-content" style="width: 60%; margin-top: -40px;">

    <header class="w3-container w3-blue"> 
      <span onclick="document.getElementById('addLegacySubjects').style.display='none'" 
      class="w3-button w3-display-topright">&times;</span>
      <h5>Add Subject with Grade Record Form</h5>
    </header>

    <div class="w3-container">
    	
      <?php require_once('../templates/add-legacy-subject.php'); ?>
    </div>

  </div>
</div>
<script>
	

	function showAddLegacySubject(sid){
		document.getElementById('studID').value = sid;
		document.getElementById('addLegacySubjects').style.display='block';
	}
	function printMe(){
    var printContents = document.getElementById('transcript').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();
    //document.body.innerHTML = printContents;
    document.body.innerHTML = originalContents;
}
</script>