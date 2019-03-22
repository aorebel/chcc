<?php 

require_once('config/connect.php');
ob_start();
$section_letter = $_POST['section_code'];
//$slots = $_POST['slots'];
$units = $_POST['units'];
$course_code = $_POST['course_code'];
$year_level = $_POST['year_level'];
if($year_level=="I"){
	$year="1";
}
else if($year_level=="II"){
	$year="2";
}
else if($year_level=="III"){
	$year="3";
}
else{
	$year="4";
}


$query = "SELECT * from courses where course_code = ?";
$pdo = $conn->prepare($query);
$pdo->execute(array($course_code));
$row = $pdo->fetch(PDO::FETCH_ASSOC);
$id = $row['id'];

$section_code = $course_code."".$year."".$section_letter;
$section = $course_code." ".$year."".$section_letter;
$checkSection = "select * from sections where section_code = ? or section = ?";
$validateSection = $conn->prepare($checkSection);
$validateSection->execute(array($section_code, $section));
$count = $validateSection->rowCount();

if($count){
	echo "Section already exists";
}
else{

	$querySection = "insert into sections (section_code,section, course_code, year_level, units) values (?,?,?,?,?)";
	$addSection = $conn->prepare($querySection);
	$addSection->execute(array($section_code, $section, $course_code, $year_level, $units));
	

	$getSections = "select * from sections where section_code = ?";
    $sections = $conn->prepare($getSections);
    $sections->execute(array($section_code));
    $sRow = $sections->fetch(PDO::FETCH_ASSOC);

	$querySubjectCode="select * from subjects where course_code = ? and year_level = ?";
	$getSubjectCode = $conn->prepare($querySubjectCode);
	$getSubjectCode->execute(array($course_code,$year_level));
	while($rows = $getSubjectCode->fetch(PDO::FETCH_ASSOC)){
		$withLab = $rows['subject_type'];
		$sem = $rows['sem'];
		$subject = $rows['subject'];
		$subject_id = $rows['id'];

		$subject_code = $rows['subject_code'];
		$code=explode(' ', $subject_code);
		
		if($course_code=="SOCSCI"){
			if(strpos($subject_code,"SPE")!==false){
				$abbr = "SPE";
			}else if(strpos($subject_code,"Ed/")!==false){
				$abbr = "Ed";
			}else{
				$abbr=$code[0];
			}
		}else{
			$abbr=$code[0];
		}
		$class_code = $abbr."".$year."".$sRow['id']."".$subject_id;
	    $status = "Close"; 

	    echo $class_code."<br>";
	    
		if($withLab=="With Lab"){
			$classLab = $class_code."L";
			$queryAddSubjectLab = "insert into classes (class_code,section_code,subject_id,status,sem) values(?,?,?,?,?)";
		    $tryAddSubjectLab = $conn->prepare($queryAddSubjectLab);
		    $tryAddSubjectLab->execute(array($classLab,$section_code,$subject_id,$status,$sem));
		}

	    $queryAddSubject = "insert into classes (class_code,section_code,subject_id,status,sem) values(?,?,?,?,?)";
	    $tryAddSubject = $conn->prepare($queryAddSubject);
	    $tryAddSubject->execute(array($class_code,$section_code,$subject_id,$status,$sem));
	    
    }



	?>
	
	<!--p>Section successfully added...</p>
	<span id="i"><?php //echo $id; ?></span>
	<script>countDown();</script-->

	<?php 


	header('Location: ../admin/showContentByCourse.php?cid='.$id.'&tab=Section');
	ob_end_flush();
}

?>
<script>
		
	var count = 2;
    
     
    function countDown(id){
    	
        if(count > 0){
            count--;
            //timer.innerHTML = "This page will redirect in "+count+" seconds.";
            setTimeout("countDown()", 1000);
        }else{
        	var id = document.getElementById("i").innerHTML;
        	alert(id);
            window.location.href = "../admin/showContentByCourse.php?cid="+id+"&tab=Section&res=1";
        }
    }
</script>