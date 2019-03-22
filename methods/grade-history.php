<?php
require_once('../app/config/connect.php');
$student = $_POST['student'];
$sem = $_POST['sem'];
$sy = $_POST['sy'];

echo $stundent;
?>
<h3 class="w3-center" style="margin-bottom: 20px;">
<?php echo $sy." ( ".$sem." )"; ?>
</h3>
<table class="w3-table">
	<tr>
		<th>Subject Code</th>
		<th style="width: 50%">Subject Description</th>
		<th style="width: 60px;">Grade</th>
		<th style="width: 60px;">Remarks</th>
	</tr>


<?php 

$queryGrade = "SELECT * from grade where student_id = ?  and sem = ? and school_year = ?";
$getGrade = $conn->prepare($queryGrade);
$getGrade->execute(array($student,$sem,$sy));
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
		<td ><?php echo $grow['grade']; ?></td>
		<td ><?php echo $grow['remarks']; ?></td>
	</tr>

<?php

}

?>


</table>