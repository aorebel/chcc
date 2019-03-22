<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Expires" CONTENT="-1">
    <title>Student Profile</title>
    <link rel="shortcut icon" href="https://chcc.ga/Logo.png" type='image/x-icon'>

    <link rel="stylesheet" href="../lib/css/w3.css">
    <link rel="stylesheet" href="../lib/css/sidebar.css">
    <link rel="stylesheet" href="../lib/css/forPrint.css">
    <link rel="stylesheet" href="../lib/css/font-awesome.css">
    
<script>

function openTab(evt, tabName, id) {
  var i, x, tablinks;
  x = document.getElementsByClassName("aTab");
  for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("stablink");
  
  //for (i = 0; i < x.length; i++) {
      tablinks[0].className = tablinks[0].className.replace(" w3-red", "");
      tablinks[1].className = tablinks[1].className.replace(" w3-red", "");
      tablinks[2].className = tablinks[2].className.replace(" w3-red", "");
      tablinks[3].className = tablinks[3].className.replace(" w3-red", "");
      tablinks[4].className = tablinks[4].className.replace(" w3-red", "");

      //console.log(tablinks[j].className);
  //}
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " w3-red";

  if (history.pushState) {
    var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?sid='+id+'&tab='+tabName;
    window.history.pushState({path:newurl},'',newurl);
  }
}
function openLink(linkname){
    var link = linkname;
    window.location.href = '../admin/admin.php?page='+link;
}
function getUrl(){
    var url_string = window.location.href;
    var url = new URL(url_string);
    var tab = url.searchParams.get("tab");
    var cache = url.searchParams.get("cache");
    if(tab=="Profile"){
      document.getElementById("Profile").style.display = "block";
      document.getElementById("tabProf").classList.add("w3-red");
    }
    else if(tab=="Subjects"){
      document.getElementById("Subjects").style.display = "block";
      document.getElementById("tabSubj").classList.add("w3-red");
    }
    else if(tab=="Assessment"){
      document.getElementById("Assessment").style.display = "block";
      document.getElementById("tabAss").classList.add("w3-red");
    }
    else if(tab=="COR"){
      document.getElementById("COR").style.display = "block";
      document.getElementById("tabCOR").classList.add("w3-red");
    }
    else if(tab=="Transcript"){
      document.getElementById("Transcript").style.display = "block";
      document.getElementById("tabTrans").classList.add("w3-red");
    }
    if(cache=="1"){
      //location.reload(true);
    }
}
</script>

    
</head>
<body onload="getUrl()">


<div style="display: none;">
    
<?php
require_once('../app/config/connect.php');
require_once('../app/functions.php');
require_once('../app/getSYSem.php');
require_once('../app/session.php');

if($role!="admin"){
    ob_start();
    header("Location: ../index.php");
    session_destroy();
    ob_end_flush();
}
//$id = "681";
$id = strval($_GET['sid']);

$get_student_info = "select * from students where id = ?";
$student_info =  $conn->prepare($get_student_info);
$student_info->execute(array($id));
$studentInfo = $student_info->fetch(PDO::FETCH_ASSOC);
//echo $id." - ".$tbl; 
$mi = explode(".", $studentInfo['mi']);
$fullname = ucwords($studentInfo['fname']." ".$mi[0].". ".$studentInfo['lname']);

$sid = $studentInfo['student_id'];


$get_enrollment_info = "select * from enrollment where student_id = ?";
$enrollment_info = $conn->prepare($get_enrollment_info);
$enrollment_info->execute(array($sid));
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
//$entats = $eRow[]
$role = "admin";

?>



</div>

    <div id="wraper" class="w3-row">
        <! *******************SIDEBAR FOR NAVIGATION*************** -->
      <div id="sidebar" class="w3-col s12 m1">
          <div class="side-nav w3-blue w3-center">
  
              <img src="../lib/img/Logo.png" width="107" style="margin-top: -50px; padding: 5px;">
              <button class="w3-bar-item w3-button tablinks" value="Home" name="id" id="Home" onclick="openLink('Home')"><i class="fa fa-home"></i><br>HOME</button>
              <button class="w3-bar-item w3-button tablinks" value="Employees" name="id" id="Employees" onclick="openLink('Employees')"><i class="fa fa-users"></i><br>EMPLOYEES</button>
              <button class="w3-bar-item w3-button tablinks w3-white" value="Students" name="id" id="Students" onclick="openLink('Students')"><i class="fa fa-address-book"></i><br>STUDENTS</button>
              <button class="w3-bar-item w3-button tablinks" value="Academics" name="id" id="Academics" onclick="openLink('Academics')"><i class="fa fa-book"></i><br>ACADEMICS</button>
              <button class="w3-bar-item w3-button tablinks" value="Account" name="id" id="Account" onclick="openLink('Account')"><i class="fa fa-coins"></i><br>ACCOUNT</button>
              <br>
              <button class="w3-bar-item w3-button tablinks" value="chgPass" name="id" id="chgPass" onclick="openLink('chgPass')"><i class="fa fa-edit"></i><br>Change<br>Password</button>
       
          </div>
      </div>
      <! *******************SIDEBAR FOR NAVIGATION END*************** -->
      <div id="content2" class="w3-col s12 m11 w3-right " style="padding-left: 0px !important;">
      	<! ***********************************CONTENT HEADER********************************-->
          <div class="header w3-row" style="margin-top: 25px;">
              <h3 class="w3-container"><i class="fa fa-eye"></i> STUDENTS PROFILE > <?php echo $fullname; ?>
              <a href="../app/logout.php" class="w3-button w3-right logout" style="margin-top: -3px !important; font-size: 18px !important;">Logout</a>     </h3>    
          </div>
          <! ***********************************STUDENT PROFILE TAB BUTTONS********************************-->
  	      <div class="w3-bar w3-black" style="font-size: 18px !important; text-shadow: none !important; margin-top: 35px;">
  	            
            <button id="tabProf" class="w3-button stablink" onclick="openTab(event,'Profile','<?php echo $id; ?>')">Profile</button>
  			    <button id="tabSubj" class="w3-button stablink" onclick="openTab(event,'Subjects','<?php echo $id; ?>')">Subjects</button>
  			    <button id="tabAss" class="w3-button stablink" onclick="openTab(event,'Assessment','<?php echo $id; ?>')">Assessment</button>
            <button id="tabCOR" class="w3-button stablink w3-hide" onclick="openTab(event,'COR','<?php echo $id; ?>')">COR</button-->
  			    <button id="tabTrans" class="w3-button stablink" onclick="openTab(event,'Transcript','<?php echo $id; ?>')">Transcript</button>

  			    <!--button class="w3-button tablink" onclick="openTab(event,'Guardian')">Guardian Info</button-->
  			    <a href="../admin/admin.php?page=Students" class="w3-button w3-right" >Exit</a>
  			    
  			  </div>
            <! ***********************************STUDENT PROFILE END********************************-->
    		<div id="Profile" class="w3-padding w3-container w3-animate-opacity aTab" style="width:100% !important; display: none;">
  			<br><br>
            <?php 

              require_once('../methods/view_student_profile.php');

            ?>
        </div>
        <div id="Subjects" class="w3-padding w3-container w3-animate-opacity aTab" style="width:100% !important; display: none;">
			     <br><br>
			
            <?php require_once('../methods/admin-student-subject.php'); ?>

        </div>
        <div id="Assessment" class="w3-padding w3-container w3-animate-opacity aTab" style="width:100% !important; display: none; margin-left: 0px; margin-right: 10px;">
            <?php 

            if( !empty($assRow) ){
                ?>
                <div class="w3-right" style="margin-right: 100px;">
      
                  <button class="w3-button w3-yellow" onclick="printAss()" style="margin-left: 20px; margin-top: 20px;">
                      Print
                  </button>
                  <button class="w3-button w3-yellow" onclick="addPayOpt()" style="margin-top: 20px;">
                      Add Payment Option
                  </button>
                </div>
                <br><br>
                <?php 
                require_once('../methods/view-assessment-on-admin.php'); 
            }else{
                ?>

                <h1 class="text-center" style="margin-top: 200px; margin-left: 0px !important;">No Subjects for SY <?php echo $sy." ".$sem." yet"; ?></h1>

                <?php
            }

            ?>
            
        </div>
        <div id="COR" class="w3-padding w3-container w3-animate-opacity aTab" style="width:100% !important; display: none;">
            
            <?php 
            if(empty($assRow)){
              ?>

              <h1 class="text-center" style="margin-top: 200px; margin-left: 0px !important;">No Subjects for SY <?php echo $sy." ".$sem." yet"; ?></h1>

              <?php
            }else{
              if( ($enrollmentRow['sem']==$sem) && ($enrollmentRow['school_year']==$sy) ){
                require_once('../methods/admin-student-cor.php');
              }else{
                ?>
                <h2 class="w3-center" style="margin-top: 150px;">Student have not paid for the enrollment yet.</h2>
                <?php
              }
            }

            
          ?>
        </div>
        <div id="Transcript" class="w3-padding w3-container w3-animate-opacity aTab" style="width:100% !important; display: none;">
			
           <?php require_once('../methods/admin-student-grade.php'); ?>

        </div>
        <div id="Guardian" class="w3-padding w3-container w3-animate-opacity aTab" style="width:100% !important; display: none;">
    			<br><br>
    			SUBJETCS
          <?php //require_once(''); ?>
        </div>
        
      </div>
    </div>

    <div class="w3-modal" id="payOptForm">  
        <div class="w3-modal-content" style="width: 300px;">  
            <header class="w3-container w3-blue"> 
              <span onclick="document.getElementById('payOptForm').style.display='none'" 
              class="w3-button w3-display-topright">&times;</span>
              <h5>Enroll New Subjects Form </h5>
            </header>

            <div class="w3-container">
                <div class="w3-padding" style="padding: 20px 10px 20px 10px">
                <p style="margin-bottom: 20px; font-family: century gothic; font-size: 12px;">Paying full in cash will grant students PHP 1000.00 discount on their tuition fee. All Partial payments are 0% interest guaranteed!</p> 
                <p> 
                    <label for="">Payment Option:</label>
                    <select name="text" name="payOpt" id="payOpt" class="w3-input w3-border" required>
                        <option value="">Select Payment Option</option>
                        <option value="full">Pay Full in Cash</option>
                        <option value="half">Two Payments</option>
                        <option value="tri">Three Payments</option>
                        <option value="quarter">Four Payments</option>
                        
                    </select>
                </p>
                <p style="padding-bottom: 20px; margin-bottom: 20px;"> 
                    <button class="w3-right w3-button w3-blue" onclick="addPOpt('<?php echo $assRow['id']; ?>','<?php echo $assRow['total_amount']; ?>')">Add Payment Option</button>
                </p>
                </div>
            </div>
            <footer style="height: 20px;"></footer>
        </div>
    </div>
<script>


    
function addPayOpt(){
    //alert();
    document.getElementById("payOptForm").style.display = "block";
}
function addPOpt(id,total){
    var id = id;
    var total = total
    var payOpt = document.getElementById("payOpt").value;
    //alert(id);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          //console.log(this.responseText);
           
          var data = JSON.parse(this.responseText);

          if(data.status=="success"){
              //document.getElementById('po').innerHTML = data.option;
              //document.getElementById('discount').innerHTML = data.discount;
              //document.getElementById('net').innerHTML = data.net;
              //document.getElementById('perPay').innerHTML = data.perPay;
              //document.getElementById("payOptForm").style.display = "none";
              //alert(this.responseText);
              location.reload();
          }
          else{ 
            alert("Please select a payment option!");
          }
          //document.getElementById('enrollBlock').attrubute = "disabled";
        }
    };
    xhttp.open("POST", "../app/add_pay_option.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("option="+payOpt+"&id="+id+"&total="+total);

}
</script>
</body>
</html>



