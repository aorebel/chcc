<?php 

require_once('../app/config/connect.php');
require_once('../app/session.php');
require_once('../app/getSYSem.php');

$course = $_POST['course'];
$day = $_POST['day'];
$timeStart = $_POST['timeStart'];
$timeEnd = $_POST['timeEnd'];
$id = $_POST['sid'];
//$y = strtotime($timeStart)+(59*60);
//$timeEnd = date("H:i:s",$y);
$array = [];

$queryTC = "SELECT * from teacher_classes where school_year=? and sem=?";
$checkTC = $conn->prepare($queryTC);
$checkTC->execute(array($sy,$sem));
while($tcRow = $checkTC->fetch(PDO::FETCH_ASSOC)){
	array_push($array, $tcRow['class_code']);

}

//echo implode("<br>", $array);
echo "<h3 style='text-align: center'>Disabled add button indicates class is already given to other teacher</h3>";

$query = "SELECT * from classsubjects where sem=? and school_year=? and course_code=? and sched_day like ? and sched_time_start>=? and sched_time_start<=? order by section_code ASC";
$pdo = $conn->prepare($query);
$pdo->execute(array($sem, $sy, $course, "%".$day."%", $timeStart, $timeEnd));

//echo $sy." ".$sem." ".$course." ".$day." ".$timeStart." ".$timeEnd; 
?>
<h5 id="atcRes" class="w3-center"></h5>
<table class="w3-table w3-border">
<tr>
	<th class="w3-border">Section</th>
	<th class="w3-border">Class Code</th>
	<th class="w3-border">Subject Code</th>
	<th class="w3-border">Subject</th>
	<th class="w3-border">Days</th>
	<th class="w3-border">Time</th>
	<th class="w3-border">Room</th>
	<th class="w3-border">Action</th>
</tr>

<?php 

while($row = $pdo->fetch(PDO::FETCH_ASSOC)){
$class = $row['class_code'];
echo "<tr class='w3-border'>";
echo "<td class='w3-border'>".$row['section_code']."</td>";
echo "<td class='w3-border'>".$row['class_code']."</td>";
echo "<td class='w3-border'>".$row['subject_code']."</td>";

echo "<td class='w3-border'>".$row['sched_day']."</td>";

echo "<td class='w3-border'>".$row['sched_time_start']." to ".$row['sched_time_end']."</td>";
if(strpos($row['class_code'], "L")){
	echo "<td class='w3-border'>".$row['subject']." Lab</td>";
}else{
	echo "<td class='w3-border'>".$row['subject']."</td>";
}

echo "<td class='w3-border'>".$row['room']."</td>";
if(in_array($class, $array)){
?>
<td>
	
	<button class="w3-button w3-gray" id="<?php echo $row['class_code']; ?>" onclick="addTClass('<?php echo $sem.",".$sy.",".$id.",".$class; ?>')" disabled><i class="fas fa-plus"></i></button>
</td>


<?php
}
else{


?>
<td>
	<?php 
		//class selection area 
		$sched = [];
		$schedStart = $row['sched_time_start'];
		$schedEnd = $row['sched_time_end'];
		// get the list of classes from teacher_classes
		$checkScheduleQuery = "SELECT * from teacher_classes";
		$checkSchedule = $conn->prepare($checkScheduleQuery);
		$checkSchedule->execute(array($id));
		while($tcsrow = $checkSchedule->fetch(PDO::FETCH_ASSOC)){
			//echo $tcsrow['class_code'];
			$classID = $tcsrow['class_code'];
			$checkClassScheduleQuery = "SELECT * from classes where class_code = ?";
			$checkClassSchedule = $conn->prepare($checkClassScheduleQuery);
			$checkClassSchedule->execute(array($classID));
			while($csrow = $checkClassSchedule->fetch(PDO::FETCH_ASSOC)){
				$start = $csrow['sched_time_start'];
				$end = $csrow['sched_time_end'];
				// check if the class is already occupied by other teacher
				if($tcsrow['class_code']==$row['class_code']){
					array_push($sched, "true");
				}
				// check if the schedule is already occuied by the teacher 
				if(in_array($csrow['sched_day'], explode("-", $row['sched_day'])) && $tcsrow['emp_id']==$id && $tcsrow['class_code']==$csrow['class_code']){
					if($schedStart > $start & $start > $schedEnd){
					array_push($sched, "false");
					}else if($schedEnd < $start & $schedEnd < $end){
						array_push($sched, "false");
					}else if($schedStart < $start & $schedEnd > $end){
						array_push($sched, "true");
					}else if($schedStart > $start & $schedEnd < $end){
						array_push($sched, "true");
					}else if($schedStart == $start && $end == $schedEnd){
						array_push($sched, "true");
					}else if($schedStart == $start || $end == $schedEnd){
						array_push($sched, "true");
					}else if($schedStart >= $start && $schedEnd <= $start){
						array_push($sched, "true");
					}else{
						array_push($sched, "true");
					}

				}	

				
				
			}
		}
		if(in_array("true", $sched)){
			//echo $start." | ".$schedStart;
			?>
			<button class="w3-button w3-gray" id="<?php echo $row['class_code']; ?>" onclick="addTClass('<?php echo $sem.",".$sy.",".$id.",".$class; ?>')" disabled><i class="fas fa-plus"></i></button>
			<?php
		}else{
			//echo $start." | ".$schedStart;
			?>
			<button class="w3-button w3-green" id="<?php echo $row['class_code']; ?>" onclick="addTClass('<?php echo $sem.",".$sy.",".$id.",".$class; ?>')"><i class="fas fa-plus"></i></button>
			<?php
		}
	?>
	
</td>
</tr>

<?php
}
}
?>

</table>
<script>
	
</script>