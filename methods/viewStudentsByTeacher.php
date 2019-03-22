<?php 
require_once("../app/config/connect.php");
require_once("../app/getSYSem.php");

$class = $_POST['class'];
$count = 1;
$queryClass = "SELECT subject,section_code,sched_day,sched_time_start,sched_time_end from classsubjects where class_code=?";
$getClass = $conn->prepare($queryClass);
$getClass->execute(array($class));
$classRow = $getClass->fetch(PDO::FETCH_ASSOC);

?>
<div id="teacherClass">
<h5 class="w3-center" style="font-weight: 500;">
	<?php echo $classRow['subject']; ?><br>
	<?php echo $class; ?> ( Section  <?php echo $classRow['section_code']; ?> )<br>
	<?php echo $classRow['sched_day']; ?> 
	<?php echo $classRow['sched_time_start']; ?> - <?php echo $classRow['sched_time_end']; ?><br>
</h5>
<p class="w3-center">STUDENT LIST</p>
<button class="w3-button w3-yellow w3-right" onclick="printTeacherClass()" style="margin-top: -100px;">Print</button>
<table class="w3-row w3-padding" style="margin-bottom: 20px; margin-left: 30px; width: 100%;">
<?php 

$queryStudentClasses = "SELECT student_id from student_classes where class_code=? and sem=? and school_year=?";
$getStudentClasses = $conn->prepare($queryStudentClasses);
$getStudentClasses->execute(array($class, $sem, $sy));
$row=$getStudentClasses->rowCount();
if($row<=0){
	echo "<h3 style='margin-top:20px; margin-bottom:50px; text-align: center'>No students enrolled/enlisted this subject yet!</h3>";
}
while($scRow=$getStudentClasses->fetch(PDO::FETCH_ASSOC)){
	$student_id = $scRow['student_id'];
	$queryStudent = "SELECT * from students where student_id = ?";
	$getStudent = $conn->prepare($queryStudent);
	$getStudent->execute(array($student_id));
	$stRow = $getStudent->fetch(PDO::FETCH_ASSOC);

	$mi = explode(".", $stRow['mi']);
	$fullname = ucwords($stRow['fname']." ".$mi[0].". ".$stRow['lname']);

	$queryPicture = "SELECT * from picture where user_id=?";
	$getPicture = $conn->prepare($queryPicture);
	$getPicture->execute(array($student_id));
	$pRow = $getPicture->fetch(PDO::FETCH_ASSOC);

	
?>

	<!--div class="w3-col s3 w3-padding w3-center ">
	
		<div class="w3-row w3-padding" style="height:100px;">
			<div class="w3-col s12 m3">
				<?php //echo $student_id; ?>
			</div>
			<div class="w3-col s12 m3">
			<?php //echo $fullname; ?>

			
		</div>
	</div-->
	<tr>
		<td class="w3-center" style="width: 30%;">
			<span class="w3-left">
				<?php echo $count++?>
			</span>
			<?php echo $student_id; ?>
		</td>
		<td class="" style="width: 70%;">
			<?php echo $fullname; ?>
		</td>
	</tr>

<?php } 


?>
</table>
</div>
<?php


?>

