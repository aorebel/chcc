<?php 

require('config/connect.php');

$fname = $_POST["first"];
$lname = $_POST["last"];
$mi = $_POST["mi"];
$bdate = $_POST["bdate"];
$gender = $_POST["gender"];
$contact = $_POST["contact"];
$email = $_POST["email"];
$reg = $_POST["reg"];
$guardian = $_POST['guardian'];
$ecn = $_POST['ecn'];
$id = $_POST['studentID'];


//echo $newID." ".$ID." ".$row['hire_year'];
$sql = "update students set fname=?, mi=?, lname=?, bdate=?, gender=?, email=?, contact=?, guardian=?, ecn=?, reg=? where id=?";
$stmt = $conn->prepare($sql);
$stmt->execute(array($fname,$mi,$lname,$bdate,$gender,$email,$contact,$guardian,$ecn,$reg,$id));

header("location: student_view.php?sid=".$id);
?>