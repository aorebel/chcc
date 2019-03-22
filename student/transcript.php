
<div class="w3-container">
	<button onclick="printMe()" class="w3-button w3-yellow w3-right" style="margin-left: 10px;">Print</button>
	
	
</div>
<?php 
$queryGrade = "select * from grade where student_id = ?";
$pdoGrade = $conn->prepare($queryGrade);
$pdoGrade->execute(array($sid));
$row = $pdoGrade->fetch(PDO::FETCH_ASSOC);

	//if( ($enInfo['school_year']!=$sy)  || ($enInfo['sem']!=$sem) ){
	 	//echo "<h1 class='w3-center'>Please pay your enrollment dues first to view this section.</h1>";
	//}
	//else{


	?>
	<div id="transcript" style="">
	<?php  ?>
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
	$queryGetSy = "SELECT count(*),school_year,sem,course_code,year_level,course_code from grade where student_id = ? group by school_year, sem,course_code,year_level having count(*) > 0 order by school_year and sem ASC";
	$getSy = $conn->prepare($queryGetSy);
	$getSy->execute(array($sid));
	while ($syrow = $getSy->fetch(PDO::FETCH_ASSOC)) {
		$semsy = $syrow['sem'];
		$sysy = $syrow['school_year'];
		if($syrow['year_level']=="I"){
			$syYear = "1st Year";
		}
	    else if($syrow['year_level']=="II"){
			$syYear = "2nd Year";
		}
		else if($syrow['year_level']=="III"){
			$syYear = "3rd Year";
		}
		else if($syrow['year_level']=="IV"){
			$syYear = "4th Year";
		}

?>
	
	<table id="<?php echo $yearLevel.'_'.$schoolYear.'_'.$semester;?>" class="w3-padding w3-container" style="font-family: arial narrow !important; font-size: 14px !important; width: 95%; margin-left: 20px !important; ">
		<!--tr>
			<th>
				
			</th>
			<th>
				<table class="w3-table">
					<tr>
						<th>Subject Code</th>
						<th>Subject</th>							
						<th>Prelims</th>		
						<th>Midterms</th>
						<th>Finals</th>
						<th>Final Grade</th>
						<th>Remarks</th>
					</tr>
				</table>
			</th>
		</tr-->
		<tr>

			<?php  

			$querySubjects = "SELECT * from subjects where course_code = ? order by year_level";
			$getSubjects = $conn->prepare($querySubjects);
			$getSubjects->execute(array($syrow['course_code']));
			while($subjrow = $getSubjects->fetch(PDO::FETCH_ASSOC)){

			?>
			<td class="w3-center w3-border" style="font-weight: bold;">
				<?php echo $subjrow['year_level']." <br> ".$subjrow['sem']; ?>
			</td>
			<td>
				
				<table class="w3-table">
					<tr>
						<th class="w3-border">Subject Code</th>
						<th class="w3-border">Subject</th>							
						<th class="w3-border">Prelims</th>		
						<th class="w3-border">Midterms</th>
						<th class="w3-border">Finals</th>
						<th class="w3-border">Final Grade</th>
						<th class="w3-border">Remarks</th>
					</tr>
					<tr>
						<td class="w3-border"><?php echo $subByAdCode; ?></td>
						<td class="w3-border" style="width:30%;"><?php echo $subByAdName; ?></td>
					
					<?php 
					
						$queryGradeOnAdmin = "select * from grade where student_id = ? and school_year = ? and sem = ? and subject_id = ?";
						$getGradeOnAdmin = $conn->prepare($queryGradeOnAdmin);
						$getGradeOnAdmin->execute(array($sid,$sysy,$semsy,$subjrow['id']));
						while($gradeOnAdminRow=$getGradeOnAdmin->fetch(PDO::FETCH_ASSOC)){
							$s_id = $gradeOnAdminRow['subject_id'];
							$subject = getSubjectBySubjectCode($conn, $s_id);
							$subByAdRow = $subject->fetch(PDO::FETCH_ASSOC);
							$subByAdName = $subByAdRow['subject'];
							$subByAdCode = $subByAdRow['subject_code'];		
							$gradeByAdminPrelims = $gradeOnAdminRow['prelims'];
							$gradeByAdminMidterms = $gradeOnAdminRow['midterms'];
							$gradeByAdminFinals = $gradeOnAdminRow['finals'];
							$gradeByAdminGrade = $gradeOnAdminRow['grade'];
							$gradeByAdminRemarks = $gradeOnAdminRow['remarks'];
							$yearLevel = $gradeOnAdminRow['year_level'];
							$schoolYear = $gradeOnAdminRow['school_year'];
							$semester = $gradeOnAdminRow['sem'];

					?>
							

							<td class="w3-border">
								<?php 
									if($gradeByAdminPrelims<=0){

									}else{
										echo $gradeByAdminPrelims; 	
									}
									
								?>
								
							</td>
							<td class="w3-border">
								<?php 

									if($gradeByAdminMidterms<=0){

									}else{
										echo $gradeByAdminMidterms; 	
									}
								?>
								
							</td>
							<td class="w3-border">
								<?php 
									if($gradeByAdminFinals<=0){

									}else{
										echo $gradeByAdminFinals; 	
									}
								?>
								
							</td>
							<td class="w3-border"><?php echo $gradeByAdminGrade; ?></td>
							<td class="w3-border">
								<?php 

									if($gradeByAdminPrelims<=0 || $gradeByAdminMidterms<=0 || $gradeByAdminFinals<=0){

									}else{
										echo $gradeByAdminRemarks; 	
									}
								?>
								
							</td>
							

					<?php
						}?>
					
					?>
					</tr>
				</table>

			</td>
		<?php } ?>
		</tr>
	</table>
<?php
//} 
}
?>


	
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