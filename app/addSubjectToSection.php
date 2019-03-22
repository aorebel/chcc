<?php
	require_once('config/connect.php');
  require_once('functions.php');
  require_once('getSYSem.php');

	$section = $_REQUEST['section'];
	$subject = $_REQUEST['subject'];
	//$cid = $_REQUEST['course_id'];

  $array = (object)array();

	$querySubjectCode="select * from subjects where id=?";
	$getSubjectCode = $conn->prepare($querySubjectCode);
	$getSubjectCode->execute(array($subject));
	$row = $getSubjectCode->fetch(PDO::FETCH_ASSOC);
	$withLab = $row['subject_type'];

	$subject_code = $row['subject_code'];
	$code=explode(' ', $subject_code);
	$abbr=$code[0];

    $getSections = "select * from sections where section_code = ?";
    $sections = $conn->prepare($getSections);
    $sections->execute(array($section));
    $sRow = $sections->fetch(PDO::FETCH_ASSOC);

    $sectionYearLevel = $sRow['year_level'];
    $sectionCourse = $sRow['course_code'];

    if($sectionYearLevel=="I"){
    	$year_level = "1";
    }
    else if($sectionYearLevel=="II"){
    	$year_level = "2";
    }
    else if($sectionYearLevel=="III"){
    	$year_level = "3";
    }
    else{
    	$year_level = "4";
    }
    $class_code = $abbr."".$year_level."".$subject."".$sRow['id'];
    $status = "Close"; 


    $queryClassDuplicate = "select * from classes where subject_id=? and section_code=?";
    $isClassDuplicate = $conn->prepare($queryClassDuplicate);
    $isClassDuplicate->execute(array($subject,$section));
    $isDuplicate = $isClassDuplicate->fetch(PDO::FETCH_ASSOC);
    if(!empty($isDuplicate)){
    	$array->status = "Error. Subject already listed to this section.";
    }
    else{
    	if($withLab=="With Lab"){
    		$classLab = $class_code."L";
    		$queryAddSubjectLab = "insert into classes (class_code,section_code,subject_id,status) values(?,?,?,?)";
		    $tryAddSubjectLab = $conn->prepare($queryAddSubjectLab);
		    $tryAddSubjectLab->execute(array($classLab,$section,$subject,$status));
    	}

	    $queryAddSubject = "insert into classes (class_code,section_code,subject_id,status) values(?,?,?,?)";
	    $tryAddSubject = $conn->prepare($queryAddSubject);
	    $tryAddSubject->execute(array($class_code,$section,$subject,$status));

	    if($tryAddSubject){
	    	//echo displayInfo($conn, $section);
            /*$res = array(
                0=>$row['subject'],
                1=>displayInfo($conn, $section);
            );
            $res = [];
            $sub = $row['subject'];
            $table = displayInfo($conn, $section);
            array_push($res, $sub,$table);
            echo json_decode($res);*/
            
            if($withLab=="With Lab"){
              $array->lab = "yes";
              $array->status = "success";
              $array->subjectL = $row['subject'];
              $array->scL = $row['subject_code']." Lab";
              $array->stL = $row['subject_type'];
              $array->slotsL = $isDuplicate['slots'];
              $array->availedL = "0";
              $array->ccL = $classLab;

              $array->subject = $row['subject'];
              $array->sc = $row['subject_code'];
              $array->st = $row['subject_type'];
              $array->slots = $isDuplicate['slots'];
              $array->availed = "0";
              $array->cc = $class_code;
              $data = json_encode($array);
              echo $data;

            }
            else{
              $array->lab = "no";
              $array->status = "success";
              $array->subject = $row['subject'];
              $array->sc = $row['subject_code'];
              $array->st = $row['subject_type'];
              $array->slots = $isDuplicate['slots'];
              $array->availed = "0";
              $array->cc = $class_code;
              $data = json_encode($array);
              echo $data;
            }
            
            

	    }
	    else{
	    	$array->status =  "false";	
        $data = json_encode($array);
        echo $data;
   		}
   		//echo $withLab;
    }


    function displayInfo($conn, $sCode){
        $sc = $sCode;
        $sectionClass = queryClass($conn, $sc);

        $count = 0;
        while($sectionClassRow = $sectionClass->fetch(PDO::FETCH_ASSOC)){
        $count++

        ?>
        <tr id="sectionContent">

          <td class='w3-border' style="width: 5%!important"><?php echo $count; ?></td>
          <td class='w3-border' style="width: 15%!important"><?php echo $sectionClassRow['class_code']; ?></td>
          <td class='w3-border' style="width: 15%!important"><?php echo $sectionClassRow['subject_type']; ?></td>
          <td class='w3-border' style="width: 20%!important"><?php echo $sectionClassRow['subject_code']; ?></td>
          <td class='w3-border' style="width: 40%!important">
            <?php 
              $isLab = substr($sectionClassRow['class_code'], -1);
              echo $sectionClassRow['subject']; 
              if($sectionClassRow['subject_type']=="With Lab"){
                if($isLab=="L"){
                  echo " Lab";
                }
                else{
                  echo " Lec";
                }
              }
            ?>
              
            </td>
          <td class='w3-border' style="width: 30%!important"><?php echo $sectionClassRow['status']; ?></td>
          <td class='w3-border' style="width: 10%!important">
            <button class="w3-button w3-green" ><i class="fa fa-edit"></i></button>
          </td>
        </tr><?php
      
    }
}
?>