<?php 

require_once('../app/config/connect.php');
require_once('../app/functions.php');
require_once('../app/getSYSem.php');

$course_id = $_REQUEST['cid'];


$courseRow2 = getCourseCode($conn, $course_id);
$course = $courseRow2['course_code'];


function showStudentsListTable($conn, $course, $year){
    ?>
    <table class="w3-table-all w3-margin-top list" id="studentsTable">
        
            <tr>
            	<th class="w3-border-right">#</th>
                <th style="width:15%;" class="w3-border-right">Student ID</th>
                <th style="width:25%;" class="w3-border-right">Name</th>
                <th style="width:25%;" class="w3-border-right">Course</th>
                <th style="width:10%;" class="w3-border-right">Year Level</th>
                <th style="width:15%;" class="w3-border-right">Status</th>            
                <th style="width:10%;">Action</th>
            </tr>
    <?php
        $query = queryStudents($conn, $course, $year);
        $count=0;
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $count++;
    ?>
            <tr class="name">
			<td class="w3-border-right"><?php echo $count; ?></td>
            <td class="w3-border-right"><?php echo $row['student_id']; ?></td>
            <td class="w3-border-right"><?php echo strtoupper($row['fname'])." ".strtoupper($row['mi'])." ".strtoupper($row['lname']); ?></td>
            <td class="w3-border-right"><?php echo $course; ?></td>
            <td class="w3-border-right"><?php echo $year; ?></td>
            <td class="w3-border-right"><?php echo $row['status']; ?></td>
            <td>
                <form method="get" action="../admin/student_view.php">
                    <input type="hidden" name="sid" value="<?php echo $row['id']?>">
                    <input type="hidden" name="tab" value="Profile">
                    <input type="hidden" name="cache" value="1">
                    <button type="submit" class="w3-button"><i class="fa fa-eye"></i></button>
                </form>
            </td>
            </tr>
    <?php } ?>
        </table>
<?php }



?>
<h3 class="w3-center"><?php echo strtoupper($courseRow2['course']); ?></h3>
<?php 

if($course_id=="0"){
    $course = "UNCONFIRMED";
    $year = NULL;
    queryUnregistered($conn,$course);


 ?>

<table class="w3-table-all w3-margin-top list" id="studentsTable">
        
    <tr>
        <th class="w3-border-right">#</th>
        <th style="width:15%;" class="w3-border-right">Student ID</th>
        <th style="width:25%;" class="w3-border-right">Name</th>
        <th style="width:25%;" class="w3-border-right">Course</th>
        <th style="width:10%;" class="w3-border-right">Year Level</th>
        <th style="width:15%;" class="w3-border-right">Status</th>            
        <th style="width:10%;">Action</th>
    </tr>
<?php
$query = queryUnregistered($conn,$course);;
$count=0;
while($row = $query->fetch(PDO::FETCH_ASSOC)){
    $count++;
?>
    <tr class="name">
    <td class="w3-border-right"><?php echo $count; ?></td>
    <td class="w3-border-right"><?php echo $row['student_id']; ?></td>
    <td class="w3-border-right"><?php echo strtoupper($row['fname'])." ".strtoupper($row['mi'])." ".strtoupper($row['lname']); ?></td>
    <td class="w3-border-right"><?php echo $row['course_code']; ?></td>
    <td class="w3-border-right"><?php echo $row['year_level']; ?></td>
    <td class="w3-border-right"><?php echo $row['status']; ?></td>
    <td>
        <form method="get" action="../app/student_view.php">
            <input type="hidden" name="sid" value="<?php echo $row['id']?>">
            <button type="submit" class="w3-button"><i class="fa fa-eye"></i></button>
        </form>
    </td>
    </tr>
<?php } ?>
</table>

 <?php 
 } 
else{

?>

<div class="w3-bar">
    <button class="w3-bar-item w3-button w3-blue yearlevellink w3-red" onclick="openYearLevel(event,'firstYear')">1st Year</button>
    <button class="w3-bar-item w3-button w3-blue yearlevellink" onclick="openYearLevel(event,'secondYear')">2nd Year</button>
    <button class="w3-bar-item w3-button w3-blue yearlevellink" onclick="openYearLevel(event,'thirdYear')">3rd Year</button>
    <button class="w3-bar-item w3-button w3-blue yearlevellink" onclick="openYearLevel(event,'forthYear')">4th Year</button>
    <button class="w3-bar-item w3-button w3-yellow " onclick="printStudentList()">Print Students List</button>
  </div>
  <div id="studentsLits">
      <div id="firstYear" class="w3-container w3-padding w3-border yearLevel">
        
        <?php 
            $year = "I";
            queryStudents($conn, $course, $year);
            showStudentsListTable($conn, $course, $year);
            
        ?>
        <br>
      </div>

      <div id="secondYear" class="w3-container w3-padding w3-border yearLevel" style="display:none">
        <?php 
        	$year = "II";
        	queryStudents($conn, $course, $year);
        	showStudentsListTable($conn, $course, $year);
        ?>
        <br>
      </div>

      <div id="thirdYear" class="w3-container w3-padding w3-border yearLevel" style="display:none">
        <?php 
        	$year = "III";
        	queryStudents($conn, $course, $year);
        	showStudentsListTable($conn, $course, $year);
        ?>
        <br>
      </div>
      <div id="forthYear" class="w3-container w3-padding w3-border yearLevel" style="display:none">
        <?php 
        	$year = "IV";
        	queryStudents($conn, $course, $year);
        	showStudentsListTable($conn, $course, $year);
        ?>
        <br>
      </div>
  </div>
<?php } ?>

