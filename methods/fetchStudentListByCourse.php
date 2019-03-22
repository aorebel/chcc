<?php
require('../app/config/connect.php');
function queryStudents($conn){
$sql = "SELECT * FROM students";
$query = $conn->prepare($sql);
$query->execute();
return $query;
}
function getEnrollmentList($conn,$row, $course, $year){
    $student_id = $row['student_id'];
    $get_enrollment = "SELECT * FROM enrollment WHERE student_id=? and  where course_code = ? and year_level = ? order by id DESC limit 1";
    $enrollment_query = $conn->prepare($get_enrollment);
    $enrollment_query->execute(array($student_id,$course,$year));
    $list = $enrollment_query->fetch(PDO::FETCH_ASSOC);
    return $list;
}
function showStudentsListTable($conn){
    ?>
    <table class="w3-table-all w3-margin-top list" id="studentsTable">
        
            <tr>
                <th style="width:15%;">Student ID</th>
                <th style="width:25%;">Name</th>
                <th style="width:25%;">Course</th>
                <th style="width:10%;">Year Level</th>
                <th style="width:15%;">Status</th>            
                <th style="width:10%;">Action</th>
            </tr>
    <?php
        $query = queryStudents($conn);
        $count=0;
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $row2 = getEnrollmentList($conn,$row,$course_id,$year);
            $count++;
    ?>
            <tr class="name">
            <td><?php echo $row['student_id']; ?></td>
            <td><?php echo strtoupper($row['fname'])." ".strtoupper($row['mi'])." ".strtoupper($row['lname']); ?></td>
            <td><?php echo $row2['course_code']; ?></td>
            <td><?php echo $row2['year_level']; ?></td>
            <td><?php echo $row2['status']; ?></td>
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