<!--div class="w3-container">
  <h3 class="w3-center" style="margin-top: 150px; margin-bottom: 50px;">Under Construction</h3>
</div-->
<h3 class="w3-center" style="margin-bottom: 20px;">
<?php echo $sy." ( ".$sem." )"; ?>
</h3>
<?php



$queryGrade = "SELECT * from grade where student_id = ?  and sem = ? and school_year = ?";
$getGrade = $conn->prepare($queryGrade);
$getGrade->execute(array($user,$sem,$sy));
$gCount = $getGrade->rowCount();

if($gCount>0){


	/*if( ($enInfo['school_year']!=$sy)  && ($enInfo['sem']!=$sem) ){
	 	echo "<h1 class='w3-center'>Please pay your enrollment dues first to view this section.</h1>";
	}
	else{*/
	?>
	

	<table class="w3-table">
		<tr>
			<th>Subject Code</th>
			<th style="width: 50%">Subject Description</th>		
			<th style="width: 60px;">Prelims</th>
			<th style="width: 60px;">Midterms</th>
			<th style="width: 60px;">Finals</th>
			<th style="width: 60px;">Grade</th>
			<th style="width: 60px;">Remarks</th>
		</tr>
	<?php
		while($grow = $getGrade->fetch(PDO::FETCH_ASSOC)){

			$subjectID = $grow['subject_id'];



			$queryClasses = " SELECT * from subjects where id = ?";
			$getClasses = $conn->prepare($queryClasses);
			$getClasses->execute(array($subjectID));
			$sassrow = $getClasses->fetch(PDO::FETCH_ASSOC);

		?>

			<tr>
				<td ><?php echo $sassrow['subject_code']; ?></td>
				<td ><?php echo $sassrow['subject']; ?></td>		
				<td >
					<?php 
						if($grow['prelims']<=0){

						}else{
							echo $grow['prelims'];	
						}
					?>
						
					</td>
				<td >
					<?php
						if($grow['midterms']<=0) {

						}else{
							echo $grow['midterms'];	
						}
					?>
					
				</td>
				<td >
					<?php 
						if($grow['finals']){

						}
						else{
							echo $grow['finals']; 		
						}
					
					?>
					
				</td>
				<td >
					<?php 

						echo $grow['grade']; 
					?>
						
				</td>
				<td >
					<?php 

					if( ($grow['prelims']<=0) || ($grow['midterms']<=0) || ($grow['prelims']<=0) ){

					}else{
						echo $grow['remarks'];
					}
					 ?>
						
				</td>
			</tr>

			

			


		<?php

		//}
	}
}else{
	echo "<h1 class='w3-center'>No subjects enrolled/enlisted for ".$sy." ( ".$sem." ) yet! </h1>";
}

?>


</table>
<?php 

$queryGradeSY = "SELECT sem, school_year, grade, prelims, midterms, finals, remarks from grade where student_id = ?  and sem != ? and school_year != ? group by sem, school_year, grade, prelims, midterms, finals, remarks having count(*) > 0 order by grade, school_year DESC";
$getGradeSY = $conn->prepare($queryGradeSY);
$getGradeSY->execute(array($user,$sem,$sy));

while($growSY = $getGradeSY->fetch(PDO::FETCH_ASSOC)){
	$gsy = $growSY['school_year'];
	$gsem = $growSY['sem'];

	
	if($growSY['year_level']=="I"){
		$yearLevel = "1st Year";
	}
	else if($growSY['year_level']=="II"){
		$yearLevel = "2nd Year";
	}
	else if($growSY['year_level']=="III"){
		$yearLevel = "3rd Year";
	}
	else if($growSY['year_level']=="IV"){
		$yearLevel = "4th Year";
	}
	if( ($enInfo['school_year']!=$sy)  || ($enInfo['sem']!=$sem) ){
	 	//echo "<h1 class='w3-center'>Please pay your enrollment dues first to view this section.</h1>";
	}
	else{

	?>
	<button class="w3-input w3-blue" onclick="showGradeHistory('<?php echo $user; ?>','<?php echo $gsy; ?>','<?php echo $gsem; ?>')">
		<?php echo $yearLevel." ( ".$growSY['sem']." )"; ?>
	</button>
	<?php
	}
}
?>

<div id="gradeHistory" class="w3-modal">
  <div class="w3-modal-content">

    <header class="w3-container w3-blue"> 
      <span onclick="document.getElementById('gradeHistory').style.display='none'" 
      class="w3-button w3-display-topright">&times;</span>
      <h3>Grade History</h3>
    </header>

    <div class="w3-container" id="gradeHistoryContent">
      
    </div>

  </div>
</div>

<script>
	
function showGradeHistory(student,sy,sem){
	//alert(student);
	document.getElementById("gradeHistory").style.display = 'block';
	var xhttp = new XMLHttpRequest();
	    xhttp.onreadystatechange = function() {
	        if (this.readyState == 4 && this.status == 200) {
	          document.getElementById("gradeHistoryContent").innerHTML = this.responseText;
	        }
	    };
	    xhttp.open("POST", "../methods/grade-history.php", true);
	    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	    xhttp.send("student="+student+"&sem="+sem+"&sy="+sy);
}

</script>

