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

//echo $q;
?>

<tr><th style="width:30%;">Employee ID</th>
    <th style="width:30%;">Name</th>
    <th style="width:20%;">Hire Date</th>
    <th style="width:15%;">Status</th>
    <th style="width:5%;">Action</th>
</tr>
    

<?php
//$search = $conn->prepare("SELECT * FROM $tbl WHERE `student_id` LIKE ? or `lname` like ?" );
// Execute with wildcards
//$search->execute(array("%$q%","%$q%"));

if($q==""){
    $search = $conn->prepare("SELECT * FROM teachers" );
    // Execute with wildcards
    $search->execute();
    $result = $search;
    foreach($result as $row) {
?>
    <tr class="name">
        <td><?php echo $row['emp_id']; ?></td>
        <td><?php echo strtoupper($row['fname'])." ".strtoupper($row['mi'])." ".strtoupper($row['lname']); ?></td>
        <td><?php echo $row['hire_date']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td>
            <form method="get" action="../admin/employee_view.php">
                <input type="hidden" name="id" value="<?php echo $row['id']?>">
                <input type="hidden" name="role" value="Teacher">
                <input type="hidden" name="tab" value="profile">
                <button type="submit" class="w3-button"><i class="fa fa-eye"></i></button>
            </form>
        </td>
    </tr>
<?php }
}

//$result = searchTeacher($tbl, $q, $conn);
$search = $conn->prepare("SELECT * FROM employees WHERE `emp_id` LIKE ? or `lname` like ? and role = ?" );
    // Execute with wildcards
$search->execute(array("%$q%","%$q%", "teacher"));
$result = $search;
// Echo results
foreach($result as $row) {
?>
    <tr class="name">
        <td><?php echo $row['emp_id']; ?></td>
        <td><?php echo strtoupper($row['fname'])." ".strtoupper($row['mi'])." ".strtoupper($row['lname']); ?></td>
        <td><?php echo $row['hire_date']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td>
            <form method="get" action="../admin/employee_view.php">
                <input type="hidden" name="id" value="<?php echo $row['id']?>">
                <input type="hidden" name="role" value="teacher">
                <input type="hidden" name="tab" value="Profile">
                <button type="submit" class="w3-button"><i class="fa fa-eye"></i></button>
            </form>
        </td>
    </tr>
<?php }


/*
function searchTeacher($field, $key, $conn){
	$search = $conn->prepare("SELECT * FROM $field WHERE `emp_id` LIKE ? or `lname` like ? and role='teacher'" );
	// Execute with wildcards
	$search->execute(array("%$key%","%$key%"));
	return $search;
}*/
?>