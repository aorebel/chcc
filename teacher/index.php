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
require_once('../app/functions.php');
require_once('../app/getSYSem.php');

if($role!="teacher"){
    ob_start();
    if($role=="admin"){
        header("Location: https://www.chcc.ga/admin/admin.php?page=Home");
        ob_end_flush();
    }else{
        header("Location: https://www.chcc.ga/".$role."/?page=Home");
        ob_end_flush();
    }
    
    //session_destroy();
    
}else if(!$role){
    header("Location: https://www.chcc.ga/");
}
$sid = $user;
$emp = getEmp($conn, $sid);
$id = $emp['id'];

$mi = explode(".", $emp['mi']);
$fullname = ucwords($emp['fname']." ".$mi[0].". ".$emp['lname']);
$sid = $emp['emp_id'];
$rPic = checkPicture($conn, $sid);

$tu = getTeacherUnits($conn, $sem, $sy, $sid);
//$isRole == "teacher";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Expires" CONTENT="-1">
    <title>Teacher Portal</title>
    
    <link rel="shortcut icon" href="https://chcc.ga/Logo.png" type='image/x-icon'>
    <link rel="stylesheet" href="../lib/css/w3.css">
    <link rel="stylesheet" href="../lib/css/sidebar.css">
    <link rel="stylesheet" href="../lib/css/font-awesome.css">
    <script type="text/javascript" src="../lib/js/timer.js"></script>
    <style type="text/css">
        
        .w3-white{
            text-shadow: none !important;
        }
    </style>
    <script>
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
            else if(page=="Subjects"){
                document.getElementById("Subjects").style.display = "block";
                document.getElementById("btnSubjects").classList.add("w3-white");
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
        function openTab(evt, tabName) {
          var i, x, tablinks;
          var url_string = window.location.href;
          var url = new URL(url_string);
          var page = url.searchParams.get("page");

          var tab = "btn"+page;

          x = document.getElementsByClassName("tab");
          for (i = 0; i < x.length; i++) {
             x[i].style.display = "none";
          }
          /*tablinks = document.getElementsByClassName("tablinks");
          console.log(tablinks);
          for (i = 0; i < x.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" w3-white", ""); 
          }*/

          tablinks = document.getElementById(tab);
          tablinks.className = tablinks.className.replace(" w3-white", ""); 

          document.getElementById(tabName).style.display = "block";
          evt.currentTarget.className += " w3-white";
          if (history.pushState) {
              var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page='+tabName;
              window.history.pushState({path:newurl},'',newurl);
          }
        }
    </script>

    <script type='text/javascript'>

(function()
{
  if( window.localStorage )
  {
    if( !localStorage.getItem('firstLoad') )
    {
      localStorage['firstLoad'] = true;
      window.location.reload();
    }  
    else
      localStorage.removeItem('firstLoad');
  }
})();

</script>
</head>
<body onload="getUrl()">
    <div id="wraper" class="w3-row">
        <div id="sidebar" class="w3-col s12 m1 w3-blue">
            <div class="side-nav w3-blue w3-center">
    
                <img src="../lib/res/Logo.png" width="107" style="margin-top: -50px; padding: 5px;">
                <button class="w3-bar-item w3-button tablinks" id="btnHome" onclick="openTab(event,'Home')"><i class="fa fa-user"></i><br>PROFILE</button>
                <button class="w3-bar-item w3-button tablinks" id="btnSubjects" onclick="openTab(event,'Subjects')"><i class="fa fa-building"></i><br>CLASSES</button>
                <button class="w3-bar-item w3-button tablinks" id="btnSchedule" onclick="openTab(event,'Schedule')"><i class="fa fa-address-book"></i><br>SCHEDULE</button>
                
                <button class="w3-bar-item w3-button tablinks" id="btnGrades" onclick="openTab(event,'Grades')"><i class="fa fa-list"></i><br>GRADES</button>
                <!--button class="w3-bar-item w3-button tablink" value="02" name="id" id="btnAccount" onclick="openTab(event,'Account')"><i class="fa fa-coins"></i><br>ACCOUNT</button-->
                <br>
                <button class="w3-bar-item w3-button tablinks" id="btnchgPass" onclick="openTab(event,'chgPass')"><i class="fa fa-edit"></i><br>Change<br>Password</button>
         
            </div>
        </div>
        <div id="content" class="w3-col s12 m11 w3-right">
          <span id="ct" class="w3-right w3-bar w3-light-gray" style="text-align: center !important; display: none;"></span>
            
            <div id="Home" class="w3-container tab" style="display:none">
                <div class="header w3-row w3-text-blue-grey"><br>
                    <h3 class="w3-container" style="margin-top: 6px;"><i class="fa fa-user"></i> TEACHER PORTAL > PROFILE<a href="../app/logout.php" class="w3-button w3-right" style="font-size: 18px !important;">LOGOUT</a></h3>               
                    
                    <hr>    
                </div>

                <?php require_once("home.php"); ?>
            </div>
            <div id="Schedule" class="w3-container tab" style="display:none">
                <div class="header w3-row w3-text-blue-grey"><br>
                    <h3 class="w3-container" style="margin-top: 6px;"><i class="fa fa-user"></i> TEACHER PORTAL > SCHEDULE<a href="../app/logout.php" class="w3-button w3-right" style="font-size: 18px !important;">LOGOUT</a></h3>               
                    
                    <hr>    
                </div>
                <?php require_once("schedule.php"); ?>
             
            </div>
            <div id="Subjects" class="w3-container tab" style="display:none">
                <div class="header w3-row w3-text-blue-grey"><br>
                    <h3 class="w3-container" style="margin-top: 6px;"><i class="fa fa-user"></i> TEACHER PORTAL > CLASSES<a href="../app/logout.php" class="w3-button w3-right" style="font-size: 18px !important;">LOGOUT</a></h3>               
                    
                    <hr>    
                </div>
                <?php require_once("classes.php"); ?>
             
            </div>
            <div id="Grades" class="w3-container tab" style="display:none">
                <div class="header w3-row w3-text-blue-grey"><br>
                    <h3 class="w3-container" style="margin-top: 6px;"><i class="fa fa-user"></i> TEACHER PORTAL > STUDENT'S GRADES<a href="../app/logout.php" class="w3-button w3-right" style="font-size: 18px !important;">LOGOUT</a></h3>               
                    
                    <hr>    
                </div>
                <?php require_once("score.php"); ?>
               
            </div>
            
            <div id="chgPass" class="w3-container tab" style="display:none">
                <div class="header w3-row w3-text-blue-grey"><br>
                    <h3 class="w3-container" style="margin-top: 6px;"><i class="fa fa-user"></i> TEACHER PORTAL > CHANGE PASSWORD<a href="../app/logout.php" class="w3-button w3-right" style="font-size: 18px !important;">LOGOUT</a></h3>               
                    
                    <hr>    
                </div>
                <?php require_once("chgPass.php"); ?>
                
            </div>
            
        </div>
    </div>
    <script type="text/javascript">
        
        /*
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
                document.getElementById("Subjetcs").style.display = "block";
                document.getElementById("btnSubjects").classList.add("w3-white");
            }
            else if(page=="Account"){
                document.getElementById("Account").style.display = "block";
                document.getElementById("btnAccount").classList.add("w3-white");
            }
            else if(page=="chgPass"){
                document.getElementById("chgPass").style.display = "block";
                document.getElementById("btnchgPass").classList.add("w3-white");
            }
        }*/
    </script>
</body>
</html>



