<?php 
require_once('config/connect.php');
require_once('functions.php');
$sy = $_POST['sy'];
$sid = $_POST['sid'];
$yr = $_POST['yr'];
$course = $_POST['course'];
$sem = $_POST['sem'];
$subject = $_POST['subject'];
$mid = $_POST['mid'];
$fin = $_POST['fin'];

$querySubjectID = "select * from subjects where id = ?";
$subjectID = $conn->prepare($querySubjectID);
$subjectID ->execute(array($subject));
$subByAdRow = $subjectID->fetch(PDO::FETCH_ASSOC);
$subName = $subByAdRow['subject'];

$queryGrade = "select * from grade where student_id = ? and subject_id = ?";
$grade = $conn->prepare($queryGrade);
$grade->execute(array($sid, $subject));
$row = $grade->fetch(PDO::FETCH_ASSOC);
if( ($row['remarks']=="Passed") ){

	echo "Error adding subject. <b>".$subName."</b> Detected duplicate.";
}
else{
	if( ($mid=="") || ($fin=="") ){
		$remark="Incomplete";
	}
	else{
		$midterms = $mid*0.50;
		$finals = $fin*0.50;
		$final = $midterms + $finals;
		if($final>=75){
			$remark = "Passed";
		}
		else{
			$remark = "Failed";	
		}
	}
	$queryAddLegacy = "insert into grade (student_id,school_year,sem,year_level,course_code,subject_id,midterms,finals,grade,remarks) value(?,?,?,?,?,?,?,?,?,?)";
	$addLegacy = $conn->prepare($queryAddLegacy);
	$addLegacy->execute(array($sid,$sy,$sem,$yr,$course,$subject,$mid,$fin,$final,$remark));
	if($addLegacy){
		

		//$table=array("sy"=>$sy,"sem"=>$sem,"yr"=>$yr,"course"=>$course,"subject"=>$subject,"mid"=>$mid,"fin"=>$fin,"final"=>$final,"remark"=>$remark,"subName"=>$subName);
		//$array = json_encode($table);
		//echo $array;
		//echo "<tr><td>".$subject."</td><td>".$subName."</td><td>".$mid."</td><td>".$fin."</td><td>".$final."</td><td>".$remark."</td></tr>";
		echo " ".$subject." ".$subName." ".$mid." ".$fin." ".$final." ".$remark." Successfully added to the record!";
	}
	else{
		echo "Server Error!";
	}

}

?>