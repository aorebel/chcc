
<div class="w3-container">
	<button onclick="printMe()" class="w3-button w3-yellow w3-right" style="margin-left: 10px;">Print</button>
	
	
</div>

<div id="transcript" style="">
	<?php  ?>
	<header class="w3-center verdana">
		<p>
			Republic of the Philippines<br>
			<span class="school-name">Concepcion Holy Cross College</span><br>
			Concepcion, Tarlac
		</p>
		
			<b>EVALUATION FORM</b>
		<h5>
			<b>
				<?php echo $fullname; ?>
				<br>
				<?php echo getCourseName($conn,$enInfo['course_code']); ?>
			</b>
		</h5>
	</header>
<?php 

$course_code = $enInfo['course_code'];

?>
	
	<table id="<?php echo $yearLevel.'_'.$schoolYear.'_'.$semester;?>" class="w3-padding w3-container" style="font-family: arial narrow !important; font-size: 14px !important; width: 95%; margin-left: 20px !important; ">


			<?php  

			$querySubjects = "SELECT course_code, year_level, sem from subjects where course_code = ? group by course_code, year_level, sem having count(*)";
			$Subjects = $conn->prepare($querySubjects);
			$Subjects->execute(array($course_code));
			while($subjrow = $Subjects->fetch(PDO::FETCH_ASSOC)){
				if($subjrow['year_level']=="I"){
					$syYear = "1st Year";
				}
			    else if($subjrow['year_level']=="II"){
					$syYear = "2nd Year";
				}
				else if($subjrow['year_level']=="III"){
					$syYear = "3rd Year";
				}
				else if($subjrow['year_level']=="IV"){
					$syYear = "4th Year";
				}

			?>
				<tr>
					<td class="w3-center w3-border" style="font-weight: bold;">
						<?php echo $syYear." <br> ".$subjrow['sem']; ?>
					</td>
					<td>
						
						<table class="w3-table">
							<tr>
								<th class="w3-border">Subject Code</th>
								<th class="w3-border">Subject</th>	
								<th class="w3-border">Grade</th>
								<th class="w3-border">Remarks</th>
							</tr>
							<?php 
								$queryGetSubjects = "SELECT * from subjects where course_code = ? and year_level = ? and sem = ?";
								$getSubjects = $conn->prepare($queryGetSubjects);
								$getSubjects->execute(array($course_code,$subjrow['year_level'],$subjrow['sem']));
								while($sbjrow = $getSubjects->fetch(PDO::FETCH_ASSOC)){
									$queryGradeOnAdmin = "select * from grade where student_id = ? and school_year = ? and sem = ? and subject_id = ?";
									$getGradeOnAdmin = $conn->prepare($queryGradeOnAdmin);
									$getGradeOnAdmin->execute(array($sid,$sysy,$semsy,$sbjrow['id']));
									$gradeOnAdminRow=$getGradeOnAdmin->fetch(PDO::FETCH_ASSOC);

									$s_id = $gradeOnAdminRow['subject_id'];
									$subject = getSubjectBySubjectCode($conn, $s_id);
									$subByAdRow = $subject->fetch(PDO::FETCH_ASSOC);

									$gradeByAdminGrade = $gradeOnAdminRow['grade'];
									$gradeByAdminRemarks = $gradeOnAdminRow['remarks'];
									$yearLevel = $gradeOnAdminRow['year_level'];
									$schoolYear = $gradeOnAdminRow['school_year'];
									$semester = $gradeOnAdminRow['sem'];

							?>
							<tr>

						
								<td class="w3-border"><?php echo $sbjrow['subject_code']; ?></td>
								<td class="w3-border" style="width:30%;"><?php echo $sbjrow['subject']; ?></td>
							
			
								<td class="w3-border"><?php echo $gradeByAdminGrade; ?></td>
								<td class="w3-border">
									<?php 

										if($gradeByAdminPrelims<=0 || $gradeByAdminMidterms<=0 || $gradeByAdminFinals<=0){

										}else{
											echo $gradeByAdminRemarks; 	
										}
									?>
									
								</td>

							</tr>
						<?php } ?>
						</table>
					
					</td>
				</tr>
		<?php } ?>
		
	</table>

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