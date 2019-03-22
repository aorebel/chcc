
<div class="w3-container">

<h4 class="w3-center">

	<?php 
		if( ($sy == $enrollmentRow['school_year']) && ($sem == $enrollmentRow['sem'])){
			echo "Enrolled Subjects for ";
		}
		else{
			echo "Pre-Enrolled Subjects for ";
		}
		echo $sy." - ".$sem ;
	?>
</h4>
</div>
<?php 

if(empty($assRow)){
?>
    <h1 class="w3-row text-center" style="margin-top: 100px;">No Subjects for SY <?php echo $sy." ".$sem." yet"; ?></h1>
<?php 

} else{


?>
<hr style="margin-top: 10px;">

<div id="studentSubjectOnAdmin">
	
	<table class="w3-table">
		<tr class="w3-border-bottom">
			<th>Section</th>
			<th>Class</th>
			<th>Subject Code</th>
			<th>Subject</th>
			<th>Days</th>
			<th>Class Start</th>
			<th>Class End</th>
			<th>Room</th>
		</tr>
	<?php 
	$page = "subject";


    $querySS = "SELECT * from studentassessment where student=? and sem=? and school_year=? order by class_code ASC";
    $stmtSS = $conn->prepare($querySS);
    $stmtSS->execute(array($sid,$sem,$sy));
    $totalUnits = 0;
    $totalLab = 0;
    while($rowSS = $stmtSS->fetch(PDO::FETCH_ASSOC)){
      ?>

      
        <tr>
          <td><?php echo $rowSS['section_code']; ?></td>
          <td><?php echo $rowSS['class_code']; ?></td>
          <td><?php echo $rowSS['subject_code']; ?></td>
          <td>
            <?php 
            if(strstr($rowSS['class_code'], "L")){
              echo $rowSS['subject']." Lab"; 
              $totalLab ++;
              //$totalUnits -= $rowSS['units'];
            }
            else{
              echo $rowSS['subject']; 
              $totalUnits += $rowSS['units'];
            }
            
            ?>
              
          </td>
          <td><?php echo str_replace("-", "", $rowSS['sched_day']); ?></td>
          <td><?php echo $rowSS['sched_time_start']; ?></td>
          <td><?php echo $rowSS['sched_time_end']; ?></td>
          <td><?php echo $rowSS['room']; ?></td>

        </tr>
        <?php } ?>

	</table>
</div>


<hr>
<!--div class="w3-container w3-padding" id="<?php //echo $ccid; ?>" style="margin-bottom: 50px;">
                   
    <div class="w3-col s12 m2">
        <h4 style="text-align: center;font-weight: bold;">Monday</h4>
        <?php 
            //$day = "M";
            //getStudentSched($conn, $sid, $sem, $sy, $day);
        ?>
    </div>
    <div class="w3-col s12 m2">
        <h4 style="text-align: center;font-weight: bold;">Tuesday</h4>
        <?php 
            //$day = "T";
            //getStudentSched($conn, $sid, $sem, $sy, $day);
        ?>
    </div>
    <div class="w3-col s12 m2">
        <h4 style="text-align: center;font-weight: bold;">Wednesday</h4>
        <?php 
            //$day = "W";
            //getStudentSched($conn, $sid, $sem, $sy, $day);
        ?>
    </div>
    <div class="w3-col s12 m2">
        <h4 style="text-align: center;font-weight: bold;">Thursday</h4>
        <?php 
            //$day = "Th";
            //getStudentSched($conn, $sid, $sem, $sy, $day);
        ?>
    </div>
    <div class="w3-col s12 m2">
        <h4 style="text-align: center;font-weight: bold;">Friday</h4>
        <?php 
            //$day = "F";
            //getStudentSched($conn, $sid, $sem, $sy, $day);
        ?>
    </div>
    <div class="w3-col s12 m2">
        <h4 style="text-align: center;font-weight: bold;">Saturday</h4>
        <?php 
            //$day = "S";
            //getStudentSched($conn, $sid, $sem, $sy, $day);
        ?>
    </div>
</div-->
<?php } ?>


