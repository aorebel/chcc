<?php 

function getUserInfo($conn, $table, $idField, $id, $email){
	//require_once("config/connect.php");
	$get_user_info = "select * from $table where $field = ? and email = ?";
	$user_info = $conn->prepare($get_user_info);
	$user_info->execute(array($id, $email));
	$info=$user_info->fetch(PDO::FETCH_ASSOC);
	return $info;
}

function checkActivation($conn,$uname){ 
	
	//require_once("config/connect.php");
	$check_user = "select * from activation where uname=?";
	$verify_if_activated = $conn->prepare($check_user);
	$verify_if_activated->execute(array($uname));
	$getField = $verify_if_activated->fetch(PDO::FETCH_ASSOC);
	$act = "Activated";
	if($getField['status']==$act){
		return true;
	}
	else{
		return false;
	}
	//return $getField;

}
function isFirstLogin($conn,$uname){
	//require_once("config/connect.php");
	$check_login = "select * from users where uname=?";
	$verify_login = $conn->prepare($check_login);
	$verify_login->execute(array($uname));
	$getLoginStatus = $verify_login->fetch(PDO::FETCH_ASSOC);
	$isFirstLogin = "yes";
	if($getLoginStatus['isFirstLogin']==$isFirstLogin){
		return true;
	}
	else{
		return false;
	}
	
}

function isAdmin($role,$isFirst,$uname){
	if($role == "admin"){
    $_SESSION["user"] = $uname;
    $_SESSION["user_role"] = "admin";
    $_SESSION["time_start_login"] = time();        
    $_SESSION["isFirstLogin"]=$isFirst;
    header("location: ../admin/admin.php?page=Home");
	  ob_end_flush();
	}else{
    echo "Invalid Access";
  }
}
function isCashier($role,$isFirst, $uname){
	if($role == "cashier"){
		$_SESSION["user"]   = $uname;
		//$_SESSION['uname'] = "cashier";
    $_SESSION["user_role"] = "cashier";        
    $_SESSION["time_start_login"] = time();
    $_SESSION["isFirstLogin"]=$isFirst;
    header("location: ../cashier/?page=Home");
	  ob_end_flush();
	}else{
        echo "Invalid Access";
    }
}
function isTeacher($role,$isFirst,$uname){
	if($role == "teacher"){
		$_SESSION["user"]   = $uname;
		//$_SESSION['uname'] = $row['uname'];
    $_SESSION["user_role"] = "teacher";        
    $_SESSION["time_start_login"] = time();
    $_SESSION["isFirstLogin"]=$isFirst;
    header('location:../teacher/?page=Home');
	  ob_end_flush();
	}else{
        echo "Invalid Access";
    }
}
function isStudent($role,$isFirst, $uname){
	if($role == "student"){
		$_SESSION["user"]   = $uname;
		//$_SESSION['uname'] = $row['uname'];
    $_SESSION["user_role"] = "student";        
    $_SESSION["time_start_login"] = time();
    $_SESSION["isFirstLogin"]=$isFirst;
    header('location:../student/?page=Home');
	  ob_end_flush();
	}else{
        echo "Invalid Access";
    }
}
function randomNo($l){
  $length = $l;
  $str = "";
  $characters = range('0','9');
  $max = count($characters) - 1;
  for ($i = 0; $i < $length; $i++) {
    $rand = mt_rand(0, $max);
    $str .= $characters[$rand];
  }
  return $str;
}

function randomPass() {
	$length = 10;
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}
function randomCode() {
	$length = 6;
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}
function getUserID($conn,$user){
  $query = "select * from users where uname=?";
  $get = $conn->prepare($query);
  $get->execute(array($user));
  $row = $get->fetch(PDO::FETCH_ASSOC);
  return $row;
}
function getSID($conn, $id){
  $query = "select * from students where student_id=?";
  $get = $conn->prepare($query);
  $get->execute(array($id));
  $row = $get->fetch(PDO::FETCH_ASSOC);
  return $row;
}
function getTeacher($conn, $id){
  $query = "select * from teachers where emp_id=?";
  $get = $conn->prepare($query);
  $get->execute(array($id));
  $row = $get->fetch(PDO::FETCH_ASSOC);
  return $row;
}
function getEmp($conn, $id){
  $query = "select * from employees where emp_id=?";
  $get = $conn->prepare($query);
  $get->execute(array($id));
  $row = $get->fetch(PDO::FETCH_ASSOC);
  return $row;
}
function getCash($conn, $id){
  $query = "select * from cash where emp_id=?";
  $get = $conn->prepare($query);
  $get->execute(array($id));
  $row = $get->fetch(PDO::FETCH_ASSOC);
  return $row;
}
function getRole($conn,$sid){
  $queryRole = "select * from users where user_id=?";
  $getRole = $conn->prepare($queryRole);
  $getRole->execute(array($sid));
  $rowRole = $getRole->fetch(PDO::FETCH_ASSOC);
  return $rowRole;
}

function getCourseCode($conn,  $course_id){
	$queryCourse = "select * from courses where id=?";
	$getCourse2 = $conn->prepare($queryCourse);
	$getCourse2->execute(array($course_id));
	$courseRow2 = $getCourse2->fetch(PDO::FETCH_ASSOC);
	return $courseRow2;
}

function queryCourseInfo($conn, $year_level, $course_code){
  $queryCourse = "select * from courses where year_level = ? and course_code = ?";
  $getCourseInfo = $conn->prepare($queryCourse);
  $getCourseInfo->execute(array($year_level, $course_code));
  $courseInfo = $getCourseInfo->fetch(PDO::FETCH_ASSOC);
  return $courseInfo;
}
function queryEnrollmentInfo($conn, $sid){
  $sql = "select * from enrollment where student_id = ? order by id DESC limit 1";
  $stmt = $conn->prepare($sql);
  $stmt->execute(array($sid));
  return $stmt;
}
function queryStudents($conn, $course, $year){
$sql = "SELECT DISTINCT student_id, fname, lname, mi, id, status FROM studentenrollment where course_code =? and year_level = ? group by student_id, fname, lname, mi, status, id having count(*) > 0 ";
//$sql = "SELECT * from studentenrollment where course_code = ? and year_level = ? in ( select max(student_id) from enrollment group by year_level and course_code)";
$query = $conn->prepare($sql);
$query->execute(array($course, $year));
return $query;
}
function queryUnregistered($conn,$course){
  $sql = "SELECT * FROM studentenrollment where course_code =?";
  $query = $conn->prepare($sql);
  $query->execute(array($course));
  return $query;
}
function getCourseName($conn,$course_code){
  $sql = "select * from courses where course_code = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute(array($course_code));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if($course_code=="UNCONFIRMED"){
    return $course_code;
  }
  else{
    if(!empty($row['major'])){
      $course = $row['course']." Major in ".$row['major'];
      return $course;
  
    }
    else{
      return $row['course'];
    }
    
  }
  
}
function querySection($conn, $course_code,$year_level){
    $querySection = "select * from sections where course_code=? and year_level = ?";
    $getSection = $conn->prepare($querySection);
    $getSection->execute(array($course_code,$year_level));
    return $getSection;
}


function sectionTableHeader(){
  ?>
    <th style="width:5%;" class="w3-border-right">#</th>
    <th style="width:15%;" class="w3-border-right">Section Code</th>
    <th style="width:35%;" class="w3-border-right">Section Name</th>
    <th style="width:5%;" class="w3-border-right">Slots</th>
    <th style="width:40%;" class="w3-border-right">Action</th>

  <?php
}



function classTableHeader(){
  ?>
    <th class="w3-border">#</th>
    <th class="w3-border">Class Code</th>
    <th class="w3-border">Section</th>    
    <th class="w3-border">School Year</th>
    <th class="w3-border">Sem</th>
    <th class="w3-border">Room Code</th>
    <th class="w3-border">Days</th>
    <th class="w3-border">Start Time</th>
    <th class="w3-border">End Time</th>
    <th class="w3-border">Status</th>
    <th class="w3-border">Action</th>
  <?php
}

function queryClass($conn, $section_code){
    $queryClass = "select * from classsubjects where section_code=? ORDER BY school_year and sem DESC";
    $getClass = $conn->prepare($queryClass);
    $getClass->execute(array($section_code));
    return $getClass;
}

function queryClass2($conn, $section_code){
    $queryClass = "select * from classsubjects where section_code like ? ORDER BY section_code ASC, sched_day ASC, sched_time_start ASC";
    $getClass = $conn->prepare($queryClass); 
    $getClass->execute(array("%".$section_code."%"));
    return $getClass;
}
function classTable($conn,$class){
  $count = 0;
  while($classRow = $class->fetch(PDO::FETCH_ASSOC)){
    $count++

    ?>
    <tr>
      <td class='w3-border'><?php echo $count; ?></td>
      <td class='w3-border'><?php echo $classRow['class_code']; ?></td>
      <td class='w3-border'><?php echo $classRow['section_code']; ?></td>
      <td class='w3-border' id="<?php echo $classRow['class_code'].'1' ?>"><?php echo $classRow['school_year']; ?></td>
      <td class='w3-border' id="<?php echo $classRow['class_code'].'2' ?>"><?php echo $classRow['sem']; ?></td>
      <td class='w3-border' id="<?php echo $classRow['class_code'].'3' ?>"><?php echo $classRow['room']; ?></td>
      <td class='w3-border' id="<?php echo $classRow['class_code'].'4' ?>"><?php echo $classRow['sched_day']; ?></td>

      <td class='w3-border' id="<?php echo $classRow['class_code'].'5' ?>"><?php echo $classRow['sched_time_start']; ?></td>
      <td class='w3-border' id="<?php echo $classRow['class_code'].'6' ?>"><?php echo $classRow['sched_time_end']; ?></td>
      <td class='w3-border'><?php echo $classRow['status']; ?></td>
      <td class='w3-border'>
		    <button class="w3-button w3-green" onclick="showEditClassForm('<?php echo $classRow['class_code']; ?>','<?php echo $classRow['sem']; ?>','<?php echo $classRow['school_year']; ?>','<?php echo $classRow['sched_time_start']; ?>','<?php echo $classRow['sched_time_end']; ?>','<?php echo $classRow['room']; ?>')"><i class="fa fa-edit"></i></button>
      </td>


    </tr>
    <?php
  }
}
function getSubjectBySubjectCode($conn, $sid){
	$querySubjectCode = "select * from subjects where id = ?";
	$getSubject = $conn->prepare($querySubjectCode);
	$getSubject->execute(array($sid));
	//$subjectCode = $getSubject->fetch(PDO::FETCH_ASSOC);
  return $getSubject;
}
function querySubject($conn, $course_code,$year_level){
    $querySubject = "select * from subjects where course_code=? and year_level = ?";
    $getSubject = $conn->prepare($querySubject);
    $getSubject->execute(array($course_code,$year_level));
    return $getSubject;
}

function subjectsTableHeader(){
  ?>
    <th class="w3-border-right">#</th>
    <th class="w3-border-right">Subject Code</th>
    <th class="w3-border-right">Subject</th>
    <th class="w3-border-right">Prerequisite</th>
    <th class="w3-border-right">Lecture Units</th>
    <th class="w3-border-right">Lab Units</th>
    <th class="w3-border-right">Subject Type</th>    
    <th class="w3-border-right">Department</th>
    <!--th class="w3-border-right">Action</th-->
  <?php
}
function subjectsTable($conn, $course_code, $year_level){

  $query = "SELECT sem from subjects where year_level = ? and course_code = ? group by sem having count(*)>0 order by sem asc";
  $pdo = $conn->prepare($query);
  $pdo->execute(array($year_level, $course_code)); 
  while($row = $pdo->fetch(PDO::FETCH_ASSOC)){

    $sem = $row['sem'];
    ?>
    <div class="w3-row">
    <h4 class="w3-center"><?php echo $sem."ester";?></h4>
    <div class="w3-container">
      <table class="w3-table w3-border">
    <?php 
    subjectsTableHeader();
    //echo $year_level."<br>".$course_code;
    $gened = "GENED";
    $querySubject = "SELECT * from subjects where year_level = ? and sem = ? and course_code=? or course_code=? ORDER BY pre_req ASC";
    $getSubject = $conn->prepare($querySubject);
    $getSubject->execute(array($year_level,$sem,$course_code,$gened));
    $count = 0;
    $units = 0;  

    while($subjectRow = $getSubject->fetch(PDO::FETCH_ASSOC)){
     //echo $subjectRow['year_level']."<br>";
      $count++;

      ?>
      <tr>
        <td class='w3-border'><?php echo $count; ?></td>
        <td class='w3-border'><?php echo $subjectRow['subject_code']; ?></td>
        <td class='w3-border'><?php echo $subjectRow['subject']; ?></td>
        <td class='w3-border'><?php echo $subjectRow['pre_req']; ?></td>
        <td class='w3-border'>
          <?php 
            if($subjectRow['subject_type']=="With Lab"){
              echo "2";
            }else{
              echo $subjectRow['total_units'];
            }
          
          ?>
            
        </td>
        <td class='w3-border'><?php echo $subjectRow['other_units']; ?></td>
        <td class='w3-border'><?php echo $subjectRow['subject_type']; ?></td>
        <td class='w3-border'><?php echo $subjectRow['course_code']; ?></td>

        <!--td class='w3-border'>
        <button class="w3-button w3-round-medium w3-red" onclick="openEditSubject('<?php //echo $subjectRow['id']; ?>')"><i class="fa fa-trash-alt"></i></button>
        </td-->
      

      </tr>
      <?php
      $units += $subjectRow['total_units'];
    }
    ?>
    </table>
    <h4 class="w3-right">Total Units: <?php echo $units; ?></h4>
    </div>
    </div>
    <?php



  }

  
}

function checkCommand($conn, $command){
  $queryCommand = "select * from commands where id = ?";
  $getCommand = $conn->prepare($queryCommand);
  $getCommand->execute(array($command));
  $row = $getCommand->fetch(PDO::FETCH_ASSOC);
  return $row['status'];
}

function checkCommandStatus($conn, $command, $status){
  $queryCommand = "select * from commands where id = ? and status = ?";
  $getCommand = $conn->prepare($queryCommand);
  $getCommand->execute(array($command, $status));
  $row = $getCommand->fetch(PDO::FETCH_ASSOC);
  if(!empty($row)){
    return true;

  }
  else{
    return false;
  }

}


function classBlockTableHead(){
  ?>
  <tr>
    <th class="w3-padding w3-center">Subject Code</th>
    <th class="w3-padding w3-center">Subject</th>
    <th class="w3-padding w3-center">Days</th>
    <th class="w3-padding w3-center">Start Time</th>
    <th class="w3-padding w3-center">End Time</th>
    <th class="w3-padding w3-center">Room</th>
    <th class="w3-padding w3-center">Status</th>
    <th class="w3-padding w3-center">Instructor</th>
  </tr>
  
  <?php 
}

function getClassBlock($conn,$sectionx,$sy,$sem,$isRegular){
  $query = "select * from classes where sem=? and school_year=? and section_code=? ORDER BY sched_day ASC, sched_time_start ASC";
  $classes = $conn->prepare($query);
  $classes->execute(array($sem,$sy,$sectionx));
  while($row = $classes->fetch(PDO::FETCH_ASSOC)){
    $sid = $row['subject_id'];
    $subject = getSubjectBySubjectCode($conn, $sid)->fetch(PDO::FETCH_ASSOC);

    ?>
    <tr class="w3-center">
      <td class=" w3-center"><?php echo $subject['subject_code']; ?></td>
      <td class=" w3-center"><?php echo $subject['subject']; ?></td>
      <td class=" w3-center"><?php echo $row['sched_day']; ?></td>
      <td class=" w3-center"><?php echo $row['sched_time_start']; ?></td>
      <td class=" w3-center"><?php echo $row['sched_time_end']; ?></td>
      <td class=" w3-center"><?php echo $row['room']; ?></td>
      <td class=" w3-center"><?php echo $row['status']; ?></td>
      <?php 
      $queryTeacher = "SELECT * from teacher_classes where class_code = ? and sem = ? and school_year = ?";
      $getTeacher = $conn->prepare($queryTeacher);
      $getTeacher->execute(array($row['class_code'],$row['sem'],$row['school_year']));
      $trow = $getTeacher->fetch(PDO::FETCH_ASSOC);

      $queryEmp = "SELECT * from employees where emp_id = ?";
      $getEmp = $conn->prepare($queryEmp);
      $getEmp->execute(array($trow['emp_id']));
      $teacher = $getEmp->fetch(PDO::FETCH_ASSOC);

      ?>
      <td>
      <div class="w3-row w3-center">
        <i><?php echo $teacher['fname']." ".$teacher['mi']." ".$teacher['lname']; ?></i>
      </div>
      </td>
    </tr>
    <?php
  }

}
function getMiscFee($conn,$feeName,$version){
  $query = "select sum(price) from `fees` WHERE category = 'Miscellaneous'  and fee_name=? and version=?";
  $pdo = $conn->prepare($query);
  $pdo->execute(array($feeName,$version));
  $sum = $pdo->fetch(PDO::FETCH_ASSOC);
  return $sum['sum(price)'];
}
function getRegFee($conn,$feeName,$version){
  $query = "select sum(price) from `fees` WHERE category = 'Registration'  and fee_name=? and version=?";
  $pdo = $conn->prepare($query);
  $pdo->execute(array($feeName,$version));
  $sum = $pdo->fetch(PDO::FETCH_ASSOC);
  return $sum['sum(price)'];
}
function getOtherFee($conn,$feeName,$version){
  $query = "select sum(price) from `fees` WHERE category = 'Other Fees'  and fee_name=? and version=?";
  $pdo = $conn->prepare($query);
  $pdo->execute(array($feeName,$version));
  $sum = $pdo->fetch(PDO::FETCH_ASSOC);
  return $sum['sum(price)'];
}
function getDevFee($conn,$feeName,$version){
  $query = "select sum(price) from `fees` WHERE category = 'Development Fee'  and fee_name=? and version=?";
  $pdo = $conn->prepare($query);
  $pdo->execute(array($feeName,$version));
  $sum = $pdo->fetch(PDO::FETCH_ASSOC);
  return $sum['sum(price)'];
}
function getLabFee($conn,$course,$feeName,$version){
  $query = "select price from `fees` WHERE category = 'Lab Fee' and name = ?  and fee_name=? and version=?";
  $pdo = $conn->prepare($query);
  $pdo->execute(array($course,$feeName,$version));
  $sum = $pdo->fetch(PDO::FETCH_ASSOC);
  return $sum['price'];
}
function getLabSubFee($conn,$feeName,$version){
  $query = "select price from `fees` WHERE category = 'Tuition Fee' and name = 'Lab Subject' and fee_name=? and version=?";
  $pdo = $conn->prepare($query);
  $pdo->execute(array($feeName,$version));
  $sum = $pdo->fetch(PDO::FETCH_ASSOC);
  return $sum['price'];
}
function getLecSubFee($conn,$feeName,$version){
  $query = "select price from `fees` WHERE category = 'Tuition Fee' and name = 'Regular Subject' and fee_name=? and version=?";
  $pdo = $conn->prepare($query);
  $pdo->execute(array($feeName,$version));
  $sum = $pdo->fetch(PDO::FETCH_ASSOC);
  return $sum['price'];
}
function getAssessmentInfo($conn, $sid, $sem, $sy){
  $query = "select * from assessment where student_id=? and sem=? and school_year=?";
  $pdo = $conn->prepare($query);
  $pdo->execute(array($sid,$sem,$sy));
  return $pdo->fetch(PDO::FETCH_ASSOC);
}


function showStudentSubjects($conn, $sid, $sy, $sem, $page){
    //require_once('getSYSem.php');
    //$querySS = "select * from classroom where student=? order by year_level DESC";
    $querySS = "select * from studentassessment where student=? and sem=? and school_year=? order by class_code ASC";
    $stmtSS = $conn->prepare($querySS);
    $stmtSS->execute(array($sid,$sem,$sy));
    $totalUnits = 0;
    $totalLab = 0;
    while($rowSS = $stmtSS->fetch(PDO::FETCH_ASSOC)){
      ?>

      
        <tr>
          <td><?php echo $rowSS['section_code']; ?></td>
          <td><?php echo $rowSS['class_code']; ?></td>
          <td><?php echo $rowSS['subject_code']; ?></td>
          <td>
            <?php 
            if(strstr($rowSS['class_code'], "L")){
              echo $rowSS['subject']." Lab"; 
              $totalLab ++;
              //$totalUnits -= $rowSS['units'];
            }
            else{
              echo $rowSS['subject']; 
              $totalUnits += $rowSS['units'];
            }
            
            ?>
              
          </td>
          <td>
            <?php
            
            //else{
            //echo $rowSS['subject_type']
              if($rowSS['subject_type']=="With Lab"){
                if(strstr($rowSS['class_code'], "L")){
                  echo "0";
                  //$totalUnits -= $rowSS['units'];
                }else{
                  echo "2";
                }
                
              }else{
                echo $rowSS['units']; 
              }
              
            //}
           ?>
             
          </td>
          <td>
            <?php 

            if(strstr($rowSS['class_code'], "L")){
              echo $rowSS['other_units'];
              //$totalUnits -= $rowSS['units'];
            }
            else{
              echo "0";
            }

            ?>
              
          </td>
          <td><?php echo $rowSS['room']; ?></td>

        </tr>
        

        <?php
        
        
      }
      if($page == "subject"){
      ?><h3 class="w3-right"><?php echo "Total Units: ".$totalUnits." | Lab Units: ".$totalLab; ?></h3><?php
    }
  }
  function showCOR($conn, $sid, $sy, $sem){
    //require_once('getSYSem.php');
    //$querySS = "select * from classroom where student=? order by year_level DESC";
    $querySS = "select * from studentassessment where student=? and sem=? and school_year=? order by class_code ASC";
    $stmtSS = $conn->prepare($querySS);
    $stmtSS->execute(array($sid,$sem,$sy));
    $totalUnits = 0;
    $totalLab = 0;
    while($rowSS = $stmtSS->fetch(PDO::FETCH_ASSOC)){
      ?>

      
        <tr>
          <td><?php echo $rowSS['section_code']; ?></td>
          <td><?php echo $rowSS['subject_code']; ?></td>
          <td>
            <?php 
            if(strstr($rowSS['class_code'], "L")){
              echo $rowSS['subject']." Lab"; 
              $totalLab ++;
              //$totalUnits -= $rowSS['units'];
            }
            else{
              echo $rowSS['subject']; 
              $totalUnits += $rowSS['units'];
            }
            
            ?>
              
          </td>
          <td>
            <?php
            
            //else{
            //echo $rowSS['subject_type']
              if($rowSS['subject_type']=="With Lab"){
                if(strstr($rowSS['class_code'], "L")){
                  echo "0";
                  //$totalUnits -= $rowSS['units'];
                }else{
                  echo "2";
                }
                
              }else{
                echo $rowSS['units']; 
              }
              
            //}
           ?>
             
          </td>
          <td>
            <?php 

            if(strstr($rowSS['class_code'], "L")){
              echo $rowSS['other_units'];
              //$totalUnits -= $rowSS['units'];
            }
            else{
              echo "0";
            }

            ?>
              
          </td>
          <td>
            <?php 
              echo $rowSS['sched_day']; 
            ?>
            
          </td>
          <td>
            <?php echo $rowSS['sched_time_start']." - ".$rowSS['sched_time_end']; ?>
          </td>
          <td><?php echo $rowSS['room']; ?></td>
          <?php 
          $queryTeacher = "SELECT * from teacher_classes where class_code = ? and sem = ? and school_year = ?";
          $getTeacher = $conn->prepare($queryTeacher);
          $getTeacher->execute(array($rowSS['class_code'],$sem,$sy));
          $trow = $getTeacher->fetch(PDO::FETCH_ASSOC);

          $queryEmp = "SELECT * from employees where emp_id = ?";
          $getEmp = $conn->prepare($queryEmp);
          $getEmp->execute(array($trow['emp_id']));
          $teacher = $getEmp->fetch(PDO::FETCH_ASSOC);

          ?>
          <td>
            <div class="w3-row w3-center">
              <i><?php echo $teacher['fname']." ".$teacher['mi']." ".$teacher['lname']; ?></i>
            </div>
          </td>

        </tr>
        

        <?php
        
        
      }
      
  }

  function checkPicture($conn, $sid){
    $queryCheckPicture = "select * from picture where user_id = ?";
    $checkPicture = $conn->prepare($queryCheckPicture);
    $checkPicture->execute(array($sid));
    $row = $checkPicture->fetch(PDO::FETCH_ASSOC);
    return $row;
  }
  function getCashier($conn, $sid){
    $query = "select * from cashier where student_id = ?";
    $pdo = $conn->prepare($query);
    $pdo->execute(array($sid));
    $row = $pdo->fetch(PDO::FETCH_ASSOC);
    return $row;
  }

  function getTeacherClass($conn, $sid,$sy,$sem){
    $sql = "select * from teacher_classes where emp_id = ? and sem = ? and school_year = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($sid,$sem,$sy));
    //$row = $pdo->fetch(PDO::FETCH_ASSOC);
    return $pdo;
  }
  function getClassPerDay($conn, $class, $sy, $sem, $day){
    $queryClass = "select * from classes where class_code != ? and school_year = ? and sem = ? and sched_day like ?";
    $pdoClass = $conn->prepare($queryClass);
    
    return $pdoClass->execute(array($tcClass,$sy,$sem,"%".$day."%"));
  }
  function getClassGroup($conn, $sem, $sy){
    //$query = "SELECT * FROM classsubjects WHERE sem = ? and school_year = ? and course_code IN (SELECT * FROM (SELECT course_code FROM classsubjects GROUP BY course_code HAVING COUNT(course_code) > 1) AS cc)";
    $query = "SELECT count(course_code), course_code FROM classsubjects where sem = ? and school_year = ? GROUP BY course_code HAVING COUNT(course_code) > 0";
    $pdo = $conn->prepare($query);
    $pdo->execute(array($sem,$sy));
    return $pdo;
  } 

  function getSchedDays($conn, $sem, $sy, $ccc){
    $query = "SELECT count(sched_day), sched_day FROM classsubjects where sem = ? and school_year = ? and course_code = ? GROUP BY sched_day HAVING COUNT(sched_day) > 1 ";
    $pdo = $conn->prepare($query);
    $pdo->execute(array($sem,$sy,$ccc));
    return $pdo;
  }

  function getClassTime($conn, $sid, $sem, $sy, $ccc, $day){
    //echo "lajslkj";
    $tClassess = getTeacherClass($conn, $sid,$sy,$sem);
    $count = $tClassess->rowCount();
    //echo $count;

    if($count>0){
      $start = [];
      $end = [];
      $a = [];
      $b = [];
      $sched = [];
      
      while($tcRow = $tClassess->fetch(PDO::FETCH_ASSOC)){
        $tc = $tcRow['class_code'];
        $select = "SELECT * from classsubjects where class_code = ? and sem =? and school_year = ?";
        $pdo = $conn->prepare($select);
        $pdo->execute(array($tc,$sem,$sy));
        $row = $pdo->fetch(PDO::FETCH_ASSOC);
        $days = $row['sched_day'];
        array_push($a, $row['sched_time_start']);
        array_push($b, $row['sched_time_end']);
        array_push($start, $row['sched_time_start']."/".$days);
        array_push($end, $row['sched_time_end']."/".$days);
        


      }
       
          //$queryClasses = "SELECT count(*),sched_day,sched_time_start, sched_time_end from classsubjects where sem =? and school_year=? and course_code=? and sched_day like ?   group by sched_time_start HAVING count(*) > 0 order by sched_time_start ASC";
          $queryClasses = "SELECT sched_day,sched_time_start, sched_time_end from classsubjects where sem =? and school_year=? and course_code=? and sched_day like ? group by sched_day,sched_time_start, sched_time_end having count(*)>0 order by sched_time_start ASC";
          $classes = $conn->prepare($queryClasses);
          $classes->execute(array($sem,$sy,$ccc,"%".$day."%"));
          while($ccRow = $classes->fetch(PDO::FETCH_ASSOC)){
            $cstart = $ccRow['sched_time_start']."/".$ccRow['sched_day'];
            $cend = $ccRow['sched_time_end']."/".$ccRow['sched_day'];
            $sched = $ccRow['sched_day'];
            $res = [];
            //echo $cstart."<br>";
            for($i=0;$i<=sizeof($start); $i++){
              if( ( ($cstart>=$start[$i]) && ($cstart<$end[$i]) ) || ( ($cend>$end[$i]) && ($cstart<$end[$i]) ) || (($cstart>=$start[$i]) && ($cend<$end[$i])) ){

                array_push($res, "true");
              }else{
                array_push($res, "false");
              }
            }
            //echo implode("<br>", $res);

            if( in_array("true",$res) ){
              ?>
              <button class="w3-button w3-gray w3-center" style="margin-bottom: 10px; width: 90%;" onclick="showClasses('<?php echo $ccRow['sched_day'].",".$ccRow['sched_time_start'].",".$ccRow['sched_time_end'].",".$ccc; ?>')" disabled><?php echo $ccRow['sched_day'] ?><br><?php echo substr($ccRow['sched_time_start'], 0, -3)." <br>to<br> ".substr($ccRow['sched_time_end'], 0, -3); ?></button>
              <?php 
            }
           
            else{
              

            ?>
            
            <button class="w3-button w3-blue w3-center" style="margin-bottom: 10px; width: 90%;" onclick="showClasses('<?php echo $ccRow['sched_day'].",".$ccRow['sched_time_start'].",".$ccRow['sched_time_end'].",".$ccc; ?>')"><?php echo $ccRow['sched_day'] ?><br><?php echo substr($ccRow['sched_time_start'], 0, -3)." <br>to<br> ".substr($ccRow['sched_time_end'], 0, -3); ?></button>
            <?php
            }
            
            
          }
        //}
        
      
    }
    else{
      /*if($day == "T"){
          $notDay = "Th";

          $queryClasses = "SELECT count(*), sched_time_start, sched_time_end from classsubjects where sem =? and school_year=? and course_code=? and sched_day like ? and sched_day not like ? group by sched_time_start HAVING count(*) > 0  order by sched_time_start ASC";
          $classes = $conn->prepare($queryClasses);
          $classes->execute(array($sem,$sy,$ccc,"%".$day."%","%".$notDay."%"));
          while($ccRow = $classes->fetch(PDO::FETCH_ASSOC)){
            ?>

            <button class="w3-button w3-blue w3-center" style="margin-bottom: 10px; width: 90%;" onclick="showClasses('<?php echo $day.",".$ccRow['sched_time_start'].",".$ccRow['sched_time_end'].",".$ccc; ?>')"><?php echo substr($ccRow['sched_time_start'], 0, -3)." - ".substr($ccRow['sched_time_end'], 0, -3); ?></button>
            <?php

          }
        }
        else{*/
        //$queryClasses = "SELECT count(*),sched_day, sched_time_start, sched_time_end from classsubjects where sem =? and school_year=? and course_code=? and sched_day like ? group by sched_time_start HAVING count(*) > 0 order by sched_time_start ASC";
        $queryClasses = "SELECT sched_day, sched_time_start, sched_time_end from classsubjects where sem =? and school_year=? and course_code=? and sched_day like ? group by sched_day, sched_time_start, sched_time_end having count(*)>0 order by sched_time_start ASC";
        $classes = $conn->prepare($queryClasses);
        $classes->execute(array($sem,$sy,$ccc,"%".$day."%"));
        while($ccRow = $classes->fetch(PDO::FETCH_ASSOC)){
          
          ?>

          <button class="w3-button w3-blue w3-center" style="margin-bottom: 10px; width: 90%;" onclick="showClasses('<?php echo $ccRow['sched_day'].",".$ccRow['sched_time_start'].",".$ccRow['sched_time_end'].",".$ccc; ?>')"><?php echo $ccRow['sched_day'] ?><br><?php echo substr($ccRow['sched_time_start'], 0, -3)." <br>to<br> ".substr($ccRow['sched_time_end'], 0, -3); ?></button>
          <?php
        }
        
    //}
  }
}

function getClassTime2($conn, $sid, $sem, $sy, $ccc, $day){
    //echo "lajslkj";
  //echo $sid;
    $tClassess = getTeacherClass($conn, $sid,$sy,$sem);
    $count = $tClassess->rowCount();
    //echo $count;

    if($count>0){
      $tstart = [];
      $tend = [];
      $a = [];
      $b = [];
      $sched = [];
      $tclass = [];
      
      while($tcRow = $tClassess->fetch(PDO::FETCH_ASSOC)){
        $tc = $tcRow['class_code'];
        $select = "select * from classsubjects where class_code = ? and sem =? and school_year = ?";
        $pdo = $conn->prepare($select);
        $pdo->execute(array($tc,$sem,$sy));
        $row = $pdo->fetch(PDO::FETCH_ASSOC);
        //$days = $row['sched_day'];
        $days = $day;
        array_push($a, $row['sched_time_start']);
        array_push($b, $row['sched_time_end']);
        array_push($tstart, $row['sched_time_start']."/".$days);
        array_push($tend, $row['sched_time_end']."/".$days);
        array_push($tclass, $tc);

      }
       
          //$queryClasses = "SELECT count(*),sched_day,sched_time_start, sched_time_end from classsubjects where sem =? and school_year=? and course_code=? and sched_day like ?   group by sched_time_start HAVING count(*) > 0 order by sched_time_start ASC";
          $range=range(strtotime("07:00:00"),strtotime("19:00:00"),60*60);
          foreach($range as $time){
            $countert ++;
            $start =  date("H:i:s",$time);
            $x = strtotime($start)+(60*60);
            $y = strtotime($start)+(59*60);
            $fend = date("H:i:s",$y);
            $end= date("H:i:s",$x);

            $cstart = $start."/".$days;
            $cend = $fend."/".$days;
            $sched = $days;
            $res = []; 
            $ctstart = [];
            $ctend = [];



            $queryClasses = "SELECT * from classsubjects where sem =? and school_year=? and course_code=? and sched_day like ? and sched_time_start between ? and ? and sched_time_end != ? order by sched_time_start ASC";
            $classes = $conn->prepare($queryClasses);
            $classes->execute(array($sem,$sy,$ccc,"%".$day."%",$start,$fend,$start));
            while($crow = $classes->fetch(PDO::FETCH_ASSOC)){
              //echo $crow['class_code']."-".implode(",", $tclass)."<br>";
             $ctstart = $crow['sched_time_start']."/".$days;
             $ctend = $crow['sched_time_end']."/".$days;
             for($i=0;$i<=sizeof($tstart); $i++){
                if(  ( ($cstart<=$tstart[$i]) && ($cstart>$tend[$i]) ) || ( ($cend>$tend[$i]) && ($cstart<$tend[$i]) ) ){

                  array_push($res, "true");
                }
                else{
                  array_push($res, "false");
                }
                if( ( ($ctstart<=$tstart[$i]) && ($ctstart>$tend[$i]) ) || ( ($ctend>$tend[$i]) && ($ctstart<$tend[$i]) ) ){
                  array_push($res, "true");
                }
                else{
                  array_push($res, "false");
                }
              }
             
            }


            
            //echo ;
            
            //echo $cstart."<br>";
            
            //echo implode("<br>", $res);
            if($classes->rowCount()>0){
              if( in_array("true",$res)){
                ?>
                <button class="w3-button w3-gray w3-center" style="margin-bottom: 10px; width: 90%;"  disabled><?php echo $day ?><br><?php echo substr($start, 0, -3)." <br>to<br> ".substr($end, 0, -3); ?></button>
                <?php 
              }
             
              else{
                

              ?>
              
              <button class="w3-button w3-blue w3-center" style="margin-bottom: 10px; width: 90%;" onclick="showClasses('<?php echo $day.",".$start.",".$end.",".$ccc; ?>')"><?php echo $day ?><br><?php echo substr($start, 0, -3)." <br>to<br> ".substr($end, 0, -3); ?></button>
              <?php
              }
            
            //}else{
               ?>
              <!--button class="w3-button w3-gray w3-center" style="margin-bottom: 10px; width: 90%;" disabled><?php //echo $day ?><br><?php //echo substr($start, 0, -3)." <br>to<br> ".substr($end, 0, -3); ?></button-->
              <?php 
            //}
          }
        }
        
      
    }
    else{
      /*if($day == "T"){
          $notDay = "Th";

          $queryClasses = "SELECT count(*), sched_time_start, sched_time_end from classsubjects where sem =? and school_year=? and course_code=? and sched_day like ? and sched_day not like ? group by sched_time_start HAVING count(*) > 0  order by sched_time_start ASC";
          $classes = $conn->prepare($queryClasses);
          $classes->execute(array($sem,$sy,$ccc,"%".$day."%","%".$notDay."%"));
          while($ccRow = $classes->fetch(PDO::FETCH_ASSOC)){
            ?>

            <button class="w3-button w3-blue w3-center" style="margin-bottom: 10px; width: 90%;" onclick="showClasses('<?php echo $day.",".$ccRow['sched_time_start'].",".$ccRow['sched_time_end'].",".$ccc; ?>')"><?php echo substr($ccRow['sched_time_start'], 0, -3)." - ".substr($ccRow['sched_time_end'], 0, -3); ?></button>
            <?php

          }
        }
        else{*/
        //$queryClasses = "SELECT count(*),sched_day, sched_time_start, sched_time_end from classsubjects where sem =? and school_year=? and course_code=? and sched_day like ? group by sched_time_start HAVING count(*) > 0 order by sched_time_start ASC";
        $range=range(strtotime("07:00:00"),strtotime("19:00:00"),60*60);
          foreach($range as $time){
            $countert ++;
            $start =  date("H:i:s",$time);
            $x = strtotime($start)+(60*60);
            $y = strtotime($start)+(59*60);
            $fend = date("H:i:s",$y);
            $end= date("H:i:s",$x);
              $queryClasses = "SELECT sched_day, sched_time_start, sched_time_end from classsubjects where sem =? and school_year=? and course_code=? and sched_day like ? and sched_time_start between ? and ? and sched_time_end != ? order by sched_time_start ASC";
              $classes = $conn->prepare($queryClasses);
              $classes->execute(array($sem,$sy,$ccc,"%".$day."%",$start,$fend,$start));
              //echo ;
              if($classes->rowCount()>0){
                //echo $ccRow['class_code'];
              
              ?>

                <button class="w3-button w3-blue w3-center" style="margin-bottom: 10px; width: 90%;" onclick="showClasses('<?php echo $day.",".$start.",".$end.",".$ccc; ?>')"><?php echo $day ?><br><?php echo substr($start, 0, -3)." <br>to<br> ".substr($end, 0, -3); ?></button>
                <?php
              }else{
                 ?>
              <button class="w3-button w3-gray w3-center" style="margin-bottom: 10px; width: 90%;" disabled><?php echo $day ?><br><?php echo substr($start, 0, -3)." <br>to<br> ".substr($end, 0, -3); ?></button>
              <?php 
              }
          }
        
    //}
  }
}







function getStudentSched($conn, $sid, $sem, $sy, $day)
{
  if($day == "T"){
          $notDay = "Th";

          $queryClasses = "SELECT * from studentassessment where sem =? and school_year=? and student = ? and sched_day like ? and sched_day not like ?  order by sched_time_start ASC";
          $classes = $conn->prepare($queryClasses);
          $classes->execute(array($sem,$sy,$sid,"%".$day."%","%".$notDay."%"));
          while($ccRow = $classes->fetch(PDO::FETCH_ASSOC)){
            ?>

            <span class="w3-button w3-gray w3-center" style="margin-bottom: 10px; width: 90%;  word-wrap: break-word; white-space: normal;"><?php echo $ccRow['subject_code']." ( ".$ccRow['class_code']." )<br>".$ccRow['room']."<br>".substr($ccRow['sched_time_start'], 0, -3)." - ".substr($ccRow['sched_time_end'], 0, -3); ?></span>
            <?php

        }}
        else{
          $queryClasses = "SELECT * from studentassessment where sem =? and school_year=? and student = ? and sched_day like ? order by sched_time_start ASC";
        $classes = $conn->prepare($queryClasses);
        $classes->execute(array($sem,$sy,$sid,"%".$day."%"));
        while($ccRow = $classes->fetch(PDO::FETCH_ASSOC)){
          
          ?>

          <span class="w3-button w3-gray w3-center" style="margin-bottom: 10px; width: 90%;  word-wrap: break-word; white-space: normal;"><?php echo $ccRow['subject_code']." ( ".$ccRow['class_code']." )<br>".$ccRow['room']."<br>".substr($ccRow['sched_time_start'], 0, -3)." - ".substr($ccRow['sched_time_end'], 0, -3); ?></span>
          <?php
        }
        
    }
}
function getTeacherSched($conn, $sid, $sem, $sy, $day)
{
  
  $queryClasses = "SELECT * from teacherclass where sem =? and school_year=? and teacher = ? and sched_day like ? order by sched_time_start ASC";
  $classes = $conn->prepare($queryClasses);
  $classes->execute(array($sem,$sy,$sid,"%".$day."%"));
  while($row = $classes->fetch(PDO::FETCH_ASSOC)){
    
    $cccc = $row['class_code'];
    ?>

    <span class="w3-button w3-blue w3-center" style="margin-bottom: 10px; width: 90%;  word-wrap: break-word; white-space: normal;" onclick="showStudentsOnTeacher('<?php echo $cccc; ?>')"><?php echo $row['subject_code']." <br> ".$row['class_code']."<br>".$row['room']."<br>".substr($row['sched_time_start'], 0, -3)." - ".substr($row['sched_time_end'], 0, -3); ?></span>
    <?php
  }
   
}
function getClassSYSem($conn, $sem, $sy, $sc){
  $query = "select * from classes where sem = ? and school_year = ? and section_code = ?";
  $pdo = $conn->prepare($query); 
  $pdo->execute(array($sem, $sy, $sc));
  $row = $pdo->fetch(PDO::FETCH_ASSOC);
  return $row;
}

function getTeacherUnits($conn, $sem, $sy, $eid){
  $queryTC = "select * from teacher_classes where school_year=? and sem=? and emp_id=?";
  $getTC = $conn->prepare($queryTC);
  $getTC->execute(array($sy,$sem,$eid));
  while($rowTC=$getTC->fetch(PDO::FETCH_ASSOC)){
    $class = $rowTC['class_code'];

    //echo $class."<br>";
    $queryClass = "select * from classes where class_code = ?";
    $getClass = $conn->prepare($queryClass);
    $getClass->execute(array($class));
    $rowClass = $getClass->fetch(PDO::FETCH_ASSOC);
    $subject = $rowClass['subject_id'];

//echo $subject."<br>";
    $query = "select * from subjects where id=?";
    $pdo = $conn->prepare($query);
    $pdo->execute(array($subject));
    $row = $pdo->fetch(PDO::FETCH_ASSOC);

    if($row['subject_type']=="With Lab"){
      if(strpos($class, 'L') !== false){
        $unit = 1;
      }
      else{
        $unit = 2;
      }
    }else{
      $unit = $row['total_units'];
    }

    $units +=$unit;
    //echo $unit."<br>";

      
  }
  return $units;
}
function getTeacherUnit($conn, $sem, $sy, $tc){
  

    //echo $class."<br>";
    $queryClass = "select * from classes where class_code = ? and sem=? and school_year=?";
    $getClass = $conn->prepare($queryClass);
    $getClass->execute(array($class,$sem,$sy));
    $rowClass = $getClass->fetch(PDO::FETCH_ASSOC);
    $subject = $rowClass['subject_id'];

//echo $subject."<br>";
    $query = "select * from subjects where id=?";
    $pdo = $conn->prepare($query);
    $pdo->execute(array($subject));
    $row = $pdo->fetch(PDO::FETCH_ASSOC);

    if($row['subject_type']=="With Lab"){
      if(strpos($class, 'L') !== false){
        $unit = 1;
      }
      else{
        $unit = 2;
      }
    }else{
      $unit = $row['total_units'];
    }

    $units +=$unit;
    //echo $unit."<br>";

      

  return $units;
}
function curFee($year,$conn){
  $query = "SELECT * from curriculum where year_level = ? order by `date` DESC limit 1";
  $pdo = $conn->prepare($query);
  $pdo->execute(array($year));
  $row = $pdo->fetch(PDO::FETCH_ASSOC);
  return $row;
}
?>

