<?php 

require_once('config/connect.php');
/*
$q = $_POST('q');
$tbl = $_POST('tbl');

function searchUser($q, $tbl){

}
*/
$q = strval($_GET['q']);
$tbl = strval($_GET['table']);


if(!empty($q)){
    echo null;
}

//echo $q;
?>

<tr>
	<th style="width:15%;">Student ID</th>
    <th style="width:25%;">Name</th>
    <th style="width:25%;">Course</th>
    <th style="width:10%;">Year Level</th>
    <th style="width:15%;">Status</th>            
    <th style="width:10%;">Action</th>
</tr>

<?php
//$search = $conn->prepare("SELECT * FROM $tbl WHERE `student_id` LIKE ? or `lname` like ?" );
// Execute with wildcards
//$search->execute(array("%$q%","%$q%"));


$result = searchStudent($tbl, $q, $conn);
// Echo results
foreach($result as $row) {
    $student_id = $row['student_id'];
    $get_enrollment = "SELECT * FROM enrollment WHERE student_id=? order by school_year DESC limit 1";
    $enrollment_query = $conn->prepare($get_enrollment);
    $enrollment_query->execute(array($student_id));
    $row2 = $enrollment_query->fetch(PDO::FETCH_ASSOC)
?>
    <tr class="name">
    <td><?php echo $row['student_id']; ?></td>
    <td><?php echo strtoupper($row['fname'])." ".strtoupper($row['mi'])." ".strtoupper($row['lname']); ?></td>
    <td><?php echo $row2['course_code']; ?></td>
    <td><?php echo $row2['year_level']; ?></td>
    <td><?php echo $row2['section']; ?></td>
    <td><?php echo $row2['status']; ?></td>
    <td>
        <form method="get" action="../admin/student_view.php">
            <input type="hidden" name="sid" value="<?php echo $row['id']?>">
            <input type="hidden" name="tab" value="Profile">
            <button type="submit" class="w3-button"><i class="fa fa-eye"></i></button>
        </form>
    </td>
    </tr>
<?php }



function searchStudent($field, $key, $conn){
	$search = $conn->prepare("SELECT * FROM $field WHERE `student_id` LIKE ? or `lname` like ? or `fname` like ?" );
	// Execute with wildcards
	$search->execute(array("%$key%","%$key%","%$key%"));
	return $search;
}
?>
