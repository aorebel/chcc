<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<?php

require ('../app/config/connect.php');
require_once('../app/session.php');
require_once('../app/getSYSem.php');
require_once('../app/functions.php');

if($role!="student"){
    ob_start();
    header("Location: ../index.php");
    session_destroy();
    ob_end_flush();
}
//echo $user." ";
//$uRow = getUserID($conn, $user);




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Expires" CONTENT="-1">
    <title>Student Portal</title>
    <link rel="stylesheet" href="../lib/css/w3.css">
    
    <link rel="shortcut icon" href="https://chcc.ga/Logo.png" type='image/x-icon'>
    <link rel="stylesheet" href="../lib/css/sidebar.css">
    <link rel="stylesheet" href="../lib/css/forPrint.css">
    <link rel="stylesheet" href="../lib/css/font-awesome.css">
    <script type="text/javascript" src="../lib/js/timer.js"></script>
    <style type="text/css">
        
        .w3-white{
            text-shadow: none !important;
        }
    </style>
    <script type="text/javascript">
        function openTab(evt, tabName) {
          var i, x, tablinks;
         

          x = document.getElementsByClassName("tab");
          for (i = 0; i < x.length; i++) {
             x[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablink");
          for (i = 0; i < x.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" w3-white", ""); 
          }
          document.getElementById(tabName).style.display = "block";
          evt.currentTarget.className += " w3-white";
          if (history.pushState) {
              var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page='+tabName;
              window.history.pushState({path:newurl},'',newurl);
          }
        }
        function getUrl(){
            display_ct();
            var url_string = window.location.href;
            var url = new URL(url_string);
            var page = url.searchParams.get("page");
            if(page=="Schedule"){
                document.getElementById("Schedule").style.display = "block";
                document.getElementById("btnSchedule").classList.add("w3-white");
            }
            else if(page=="Home"){
                document.getElementById("Home").style.display = "block";
                document.getElementById("btnHome").classList.add("w3-white");
            }
            else if(page=="Grades"){
                document.getElementById("Grades").style.display = "block";
                document.getElementById("btnGrades").classList.add("w3-white");
            }
            else if(page=="Transcript"){
                document.getElementById("Transcript").style.display = "block";
                document.getElementById("btnTranscript").classList.add("w3-white");
            }
            else if(page=="Account"){
                document.getElementById("Account").style.display = "block";
                document.getElementById("btnAccount").classList.add("w3-white");
            }
            else if(page=="chgPass"){
                document.getElementById("chgPass").style.display = "block";
                document.getElementById("btnchgPass").classList.add("w3-white");
            }
        }
    </script>



</head>
<body onload="getUrl()">

<div>
<?php 

$queryGetStudentInfo = "SELECT * from students where student_id=?";
$getStudentInfo = $conn->prepare($queryGetStudentInfo);
$getStudentInfo->execute([$user]);
$studentInfo = $getStudentInfo->fetch(PDO::FETCH_ASSOC);
$id = $studentInfo['id'];
//echo $id;

$mi = explode(".", $studentInfo['mi']);
$fullname = ucwords($studentInfo['fname']." ".$mi[0].". ".$studentInfo['lname']);

$sid = $user;


$get_enrollment_info = "select * from studentenrollment where student_id = ? order by id DESC limit 1";
$enrollment_info = $conn->prepare($get_enrollment_info);
$enrollment_info->execute(array($user));
$enInfo = $enrollment_info->fetch(PDO::FETCH_ASSOC);

$courseCode = $enInfo['course_code'];
$roman = $enInfo['year_level'];
if($roman=="I"){
    $yl = "1";
}
else if($roman=="II"){
    $yl = "2";
}
else if($roman=="III"){
    $yl = "3";
}
else if($roman=="IV"){
    $yl = "4";
}

$cue=$courseCode."".$yl;

$enrollmentRow = queryEnrollmentInfo($conn, $sid) -> fetch(PDO::FETCH_ASSOC);
$isRegular = $enrollmentRow['status'];

$queryECommand = "select * from commands";
$eCommand = $conn->prepare($queryECommand);
$eCommand->execute();
$eRow = $eCommand->fetch(PDO::FETCH_ASSOC);

$querySC = "select * from student_classes where student_id = ? and sem = ? and school_year = ?";
$sc = $conn->prepare($querySC);
$sc->execute(array($sid, $sem, $sy));
$scRow = $sc->fetch(PDO::FETCH_ASSOC);


$assRow = getAssessmentInfo($conn,$sid,$sem,$sy);
$urole = "student";




?>
</div>
<div id="wraper" class="w3-row">
    <div id="sidebar" class="w3-col s12 m12 l1 w3-blue" style="">
        <div class="side-nav w3-blue w3-center">

            <img src="../lib/res/Logo.png" width="107" style="margin-top: -50px; padding: 5px;">
            <button class="w3-bar-item w3-button tablink" value="01" name="id" id="btnHome" onclick="openTab(event,'Home')"><i class="fa fa-user"></i><br>PROFILE</button>
            <button class="w3-bar-item w3-button tablink" value="02" name="id" id="btnSchedule" onclick="openTab(event,'Schedule')"><i class="fa fa-address-book"></i><br>SCHEDULE</button>
            <button class="w3-bar-item w3-button tablink" value="02" name="id" id="btnGrades" onclick="openTab(event,'Grades')"><i class="fa fa-building"></i><br>GRADES</button>
            <button class="w3-bar-item w3-button tablink" value="02" name="id" id="btnTranscript" onclick="openTab(event,'Transcript')"><i class="fa fa-list"></i><br>EVALUATION</button>
            <button class="w3-bar-item w3-button tablink" value="02" name="id" id="btnAccount" onclick="openTab(event,'Account')"><i class="fa fa-coins"></i><br>FINANCIAL</button>
            <br>
            <button class="w3-bar-item w3-button tablink" value="02" name="id" id="btnChgPass" onclick="openTab(event,'chgPass')"><i class="fa fa-edit"></i><br>Change<br>Password</button>
     
        </div>
    </div>
    <div id="content" class="w3-col s12 m12 l11 w3-right" >
        <!--span class="w3-blue w3-padding w3-round-medium" style="position: fixed; right: 0; top:5; margin-right: 20px; "><i class="fas fa-bars"></i></span-->
      <span id="ct" class="w3-right w3-bar w3-light-gray" style="text-align: center !important; display: none;"></span>
        
        <div id="Home" class="w3-row tab w3-right" style="display:none; margin-left: 0px;">
            <div class="header w3-row w3-text-blue-grey"><br>
                <h3 class="w3-container" style="margin-top: 6px;"></i><i class="fa fa-user"></i> STUDENT PORTAL > PROFILE<a href="../app/logout.php" class="w3-button w3-right" style="font-size: 18px !important;">LOGOUT</a></h3>               
                
                <hr>   
            </div>
            <div style="display: block;">
            <?php require_once("home.php"); ?>
            </div>

        </div>
        <div id="Schedule" class="w3-row tab w3-right" style="display:none; margin-left: 0px;">
            <div class="header w3-row w3-text-blue-grey" style="margin-left: 0px;"><br>
                <h3 class="w3-container" style="margin-top: 6px; margin-left: 0px;"><i class="fa fa-user"></i> STUDENT PORTAL > SCHEDULE<a href="../app/logout.php" class="w3-button w3-right" style="font-size: 18px !important;">LOGOUT</a></h3>               
                
                <hr>    
            </div>
            <div style="margin-top: 6px; margin-left: 0px !important; ">
            <?php require_once("schedule.php"); ?>
            </div>

        </div>
        <div id="Grades" class="w3-container tab w3-right" style="display:none; margin-left: 0px;">
            <div class="header w3-row w3-text-blue-grey"><br>
                <h3 class="w3-container" style="margin-top: 6px; margin-left: 0px;"><i class="fa fa-user"></i> STUDENT PORTAL > GRADES<a href="../app/logout.php" class="w3-button w3-right" style="font-size: 18px !important;">LOGOUT</a></h3>               
                
                <hr>    
            </div>
            <div style="margin-top: 6px; margin-left: 0px;">
            <?php require_once("grades.php"); ?></div>
         
        </div>
        <div id="Transcript" class="w3-container tab w3-right" style="display:none; margin-left: 0px;">
            <div class="header w3-row w3-text-blue-grey"><br>
                <h3 class="w3-container" style="margin-top: 6px; margin-left: 0px;"><i class="fa fa-user"></i> STUDENT PORTAL > TRANSCRIPT<a href="../app/logout.php" class="w3-button w3-right" style="font-size: 18px !important;">LOGOUT</a></h3>               
                
                <hr>    
            </div>
            <div style="margin-top: 6px; margin-left: 0px;">
            <?php require_once("evaluation.php"); ?></div>
           
        </div>
        <div id="Account" class="w3-container tab w3-right" style="display:none;margin-left: 0px;">
            <div class="header w3-row w3-text-blue-grey"><br>
                <h3 class="w3-container" style="margin-top: 0px; margin-left: 0px;"><i class="fa fa-user"></i> STUDENT PORTAL > ACCOUNT<a href="../app/logout.php" class="w3-button w3-right" style="font-size: 18px !important;">LOGOUT</a></h3>               
                
                <hr>    
            </div>
            <div style="margin-top: 0px; margin-left: 0px;">
            <?php require_once("account.php"); ?></div>
            
        </div>
        <div id="chgPass" class="w3-container tab w3-right" style="display:none;margin-left: 0px;">
            <div class="header w3-row w3-text-blue-grey"><br>
                <h3 class="w3-container" style="margin-top: 6px; margin-left: 0px;"><i class="fa fa-user"></i> STUDENT PORTAL > CHANGE PASSWORD<a href="../app/logout.php" class="w3-button w3-right" style="font-size: 18px !important;">LOGOUT</a></h3>               
                
                <hr>    
            </div>
            <div style="margin-top: 6px; margin-left: 0px;">
            <?php require_once("../templates/chg_pass.php"); ?></div>
            
        </div>
        
    </div>
</div>
    
</body>
</html>