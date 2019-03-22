<?php 

require_once('config/connect.php');
require_once('functions.php');
$sect = $_POST['section'];

$row1 = explode(",", $sect);
$se = $row1['0'];
$st = $row1['1'];
$sm = $row1['2'];
$s = $row1['3'];
$stat = $row1['4'];
$cc = $row1['5'];


//echo $st." ".$se." ".$sm." ".$s." ".$stat." ";


$querySE = "SELECT * from enrollment where student_id = ? order by id DESC limit 1";
$getSE = $conn->prepare($querySE);
$getSE->execute(array($st));
$serow = $getSE->fetch(PDO::FETCH_ASSOC);

$course = $serow['course_code'];
$yearL = $serow['year_level'];

$queryCurSelection = "SELECT * from curriculum where year_level = ? order by `date` DESC limit 1";
$getCurSelection = $conn->prepare($queryCurSelection);
$getCurSelection->execute(array($yearL));
$cfsrow = $getCurSelection->fetch(PDO::FETCH_ASSOC);
$feeName=$cfsrow['fee_name'];
$version=$cfsrow['version'];

//echo $course." - ".$yearL;

$addClassess = "";
$queryClasses = "select * from classes where section_code = ? and sem = ? and school_year = ?";
//$queryClasses = "select * from classes";
$classes = $conn->prepare($queryClasses);
$classes->execute(array($se,$sm,$s));
//$classes->execute();
//$x=0;

$res=[];
while($row = $classes->fetch(PDO::FETCH_ASSOC)){
	$class = $row['class_code'];
	$queryCheckIfExist = "select * from student_classes where student_id = ? and sem = ? and school_year = ? and class_code = ?";
	$checkIfExist = $conn->prepare($queryCheckIfExist);
	$checkIfExist->execute(array($st,$sm,$s,$class));
	$rowCheck = $checkIfExist->fetch(PDO::FETCH_ASSOC);

	$subject = $row['subject_id'];
	if(!empty($rowCheck)){
		$res[] = "false";
	}
	else{
		$data[] = $class;
		$queryAddClassess = "INSERT into student_classes (student_id, class_code, sem, school_year) values(?,?,?,?) ";
		$addClassess = $conn->prepare($queryAddClassess);
		$addClassess->execute(array($st, $class, $sm, $s));

		$queryGetGrade = "SELECT * from grade where student_id = ? and subject_id = ? and sem = ? and school_year = ?";
		$getGrade = $conn->prepare($queryGetGrade);
		$getGrade->execute(array($st,$subject,$sm,$s));
		$grow = $getGrade->fetch(PDO::FETCH_ASSOC);

		if(empty($grow)){

			$queryAddGrade = "INSERT into grade (student_id,course_code,year_level,subject_id,sem,school_year) values (?,?,?,?,?,?)";
			$addGrade = $conn->prepare($queryAddGrade);
			$addGrade->execute(array($st,$course,$yearL,$subject,$sm,$s));
		}
		

	}
}
if($addClassess){	
	$querySS = "SELECT * from studentassessment where student=? and sem=? and school_year=?";
	$stmtSS = $conn->prepare($querySS);
	$stmtSS->execute(array($st,$sm,$s));
	$totalUnits = 0;
	$totalLab = 0;
	while($rowSS = $stmtSS->fetch(PDO::FETCH_ASSOC)){

		//echo $rowSS['units']."<br>".$rowSS['student'];
		if(strstr($rowSS['class_code'], "L")){
			//echo $rowSS['subject']." Lab"; 
			$totalLab ++;
			//$totalUnits -= $rowSS['units'];
		}
		else{
			//echo $rowSS['subject']; 
			$totalUnits += (int)$rowSS['units'];
		}
	}
	$units = $totalUnits;
	$lab = $totalLab;
	$leclab = $lab+$lab;
	$tlab = $leclab+$lab;
	$lec = $units - $tlab;
	if($cc=="BSCS"){
		$courseL = "CompSci Students";
		
	}
	else{
		$courseL = "Non-CompSci Students";
	}


	//$lr = getLabFee($conn,$course);
	$lr = $lab*getLabFee($conn,$courseL,$feeName,$version);
	$misc = getMiscFee($conn,$feeName,$version);
	$reg = getRegFee($conn,$feeName,$version);
	$other = getOtherFee($conn,$feeName,$version);
	$dev = getDevFee($conn,$feeName,$version);
	$ls = ($tlab-$lab)*getLabSubFee($conn,$feeName,$version);
	$lf = $lec*getLecSubFee($conn,$feeName,$version);
	$tf = $lr+$ls+$lf;
	$total = $tf+$dev+$other+$reg+$misc;

	

	$queryAddAssessment = "insert into assessment (student_id,sem,school_year,units,lab_units,lec_units,misc_fee,reg_fee,other_fee,dev_fee,lab_sub,lab_room,tuition_fee,total_amount,lec_fee) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	$addAssessment = $conn->prepare($queryAddAssessment);
	$addAssessment->execute(array($st,$sm,$s,$units,$lab,$lec,$misc,$reg,$other,$dev,$ls,$lr,$tf,$total,$lf));

	


	echo "success";
}
//$cc = implode(",", $data) ;
//echo $cc;w
if(!empty($res)){
	echo "Class already enrolled for this school year and sem! Please reload the page!";
}

?>
