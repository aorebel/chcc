<?php

require_once('config/connect.php');

//$id=$_REQUEST['subject'];
$id = $_REQUEST['classCode'];
$type="With Lab";
$querySubjects = "select * from classsubjects where class_code=? and subject_type=?";
$getSubject = $conn->prepare($querySubjects);
$getSubject->execute(array($id,$type));
$row = $getSubject->fetch(PDO::FETCH_ASSOC);
if(!empty($row)){
	echo "true";
}
else{
	echo "false";
}

?>