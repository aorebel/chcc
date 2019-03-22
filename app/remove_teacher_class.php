<?php 
require_once('config/connect.php');

$class = $_POST['class'];
$eid = $_POST['eid'];
$sem = $_POST['sem'];
$sy = $_POST['sy'];

//echo $class;

$query = "delete from teacher_classes where sem=? and school_year=? and class_code=? and emp_id=?";
$delete = $conn->prepare($query);
$delete->execute(array($sem, $sy, $class, $eid));

echo $class." will be deleted.";

?>
