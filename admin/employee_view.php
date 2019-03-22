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
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Expires" CONTENT="-1">
    <title>Employee Profile</title>
    <link rel="shortcut icon" href="https://chcc.ga/Logo.png" type='image/x-icon'>
    <link rel="stylesheet" href="../lib/css/admin-dash.css">
    <link rel="stylesheet" href="../lib/css/sidebar.css">
    <link rel="stylesheet" href="../lib/css/w3.css">
    <link rel="stylesheet" href="../lib/css/font-awesome.css">
    <script>
        function openTab(evt, tabName, role, id) {
          var i, x, tablinks;
          x = document.getElementsByClassName("tab");
          for (i = 0; i < x.length; i++) {
              x[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("stablink");
          //for (i = 0; i < x.length; i++) {
              //tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
          //}
          tablinks[0].className = tablinks[0].className.replace(" w3-red", "");
          tablinks[2].className = tablinks[2].className.replace(" w3-red", "");
          tablinks[1].className = tablinks[1].className.replace(" w3-red", "");
          document.getElementById(tabName).style.display = "block";
          evt.currentTarget.className += " w3-red";
          if (history.pushState) {
            var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?id='+id+'&role='+role+'&tab='+tabName;
            window.history.pushState({path:newurl},'',newurl);
          }

        }
        function openLink(linkname){
            var link = document.getElementById(linkname).value;
            window.location.href = '../admin/admin.php?page='+link;
        }
        function getUrl(){
            var url_string = window.location.href;
            var url = new URL(url_string);
            var tab = url.searchParams.get("tab");
            if(tab=="Profile"){
              document.getElementById("Profile").style.display = "block";
              document.getElementById("tabPro").classList.add("w3-red");
            }
            else if(tab=="Classes"){
              document.getElementById("Classes").style.display = "block";
              document.getElementById("tabClass").classList.add("w3-red");

            }
            else if(tab=="Studs"){
              document.getElementById("Studs").style.display = "block";
              document.getElementById("tabStud").classList.add("w3-red");
            }

        }
    </script>
    
</head>

<body onload="getUrl()">



<div style="display: none;">
    
<?php
require_once('../app/config/connect.php');

require_once('../app/session.php');

require_once('../app/functions.php');
require_once('../app/getSYSem.php');
if($role!="admin"){
    ob_start();
    header("Location: ../index.php");
    session_destroy();
    ob_end_flush();
}

$id = strval($_GET['id']);
$erole = strval($_GET['role']);

$get_info = "select * from employees where id =? and role =?";
$info =  $conn->prepare($get_info);
$info->execute(array($id,$erole));
$emp = $info->fetch(PDO::FETCH_ASSOC);
//echo $id." - ".$tbl; 
$mi = explode(".", $emp['mi']);
$fullname = ucwords($emp['fname']." ".$mi[0].". ".$emp['lname']);
$sid = $emp['emp_id'];
$rPic = checkPicture($conn, $sid);
$role = "admin";

//$isRole == "admin";

?>

    
</div>

    <div id="wraper" class="w3-row">
        <! *******************SIDEBAR FOR NAVIGATION*************** -->
        <div id="sidebar" class="w3-col s12 m1">
            <div class="side-nav w3-blue w3-center">
    
                <img src="../lib/res/Logo.png" width="107" style="margin-top: -50px; padding: 5px;">
                <button class="w3-bar-item tablink w3-button" value="Home" name="id" id="Home" onclick="openLink('Home')"><i class="fa fa-home"></i><br>HOME</button>
                <button class="w3-bar-item tablink w3-button w3-white" value="Employees" name="id" id="Employees" onclick="openLink('Employees')"><i class="fa fa-users"></i><br>EMPLOYEES</button>
                <button class="w3-bar-item tablink w3-button" value="Students" name="id" id="Students" onclick="openLink('Students')"><i class="fa fa-address-book"></i><br>STUDENTS</button>
                <button class="w3-bar-item tablink w3-button" value="Academics" name="id" id="Academics" onclick="openLink('Academics')"><i class="fa fa-book"></i><br>ACADEMICS</button>
                <button class="w3-bar-item tablink w3-button" value="Account" name="id" id="Account" onclick="openLink('Account')"><i class="fa fa-coins"></i><br>ACCOUNT</button>
                <br>
                <button class="w3-bar-item tablink w3-button tablink" value="chgPass" name="id" id="chgPass" onclick="openLink('chgPass')"><i class="fa fa-edit"></i><br>Change<br>Password</button>
         
            </div>
        </div>
        <! *******************SIDEBAR FOR NAVIGATION END*************** -->
        <div id="content2" class="w3-col s12 m11 w3-right">
        	<! ***********************************CONTENT HEADER********************************-->
            <div class="header w3-row w3-text-blue-grey">

                <h3 class="w3-container"><i class="fa fa-eye"></i> <?php echo strtoupper($erole) ?> PROFILE > <?php echo $fullname; ?> 
                <a href="../app/logout.php" class="w3-button logout" style="margin-top: -3px !important;">LOGOUT</a>         
            </div>
            <! ***********************************EMPLOYEE PROFILE TAB BUTTONS********************************-->
	        <div class="w3-bar w3-black" style="font-size: 18px !important; text-shadow: none !important;">
	            <?php if($erole=="teacher"){ ?>
            	<button id="tabPro" class="w3-button stablink" onclick="openTab(event,'Profile','<?php echo $erole ?>', '<?php echo $id?>')">Profile</button>
                
			    <button id="tabClass" class="w3-button stablink" onclick="openTab(event,'Classes','<?php echo $erole ?>', '<?php echo $id?>')">Classes</button>
                <button id="tabStud" class="w3-button stablink" onclick="openTab(event,'Studs','<?php echo $erole ?>', '<?php echo $id?>')">Students</button>
                <?php } ?>

			    <a href="../admin/admin.php?page=Employees" class="w3-button w3-right" >Exit</a>
			    
			</div>
            <! ***********************************EMPLOYEE PROFILE END********************************-->
    		<div id="Profile" class="w3-container w3-animate-opacity tab" style="width:95% !important; display: none;">
    			<br><br>
	            <?php require_once('../methods/view_emp_profile.php'); ?>
            </div>
            
            <div id="Classes" class="w3-container w3-animate-opacity tab" style="width:95% !important; display: none;">
    			<br>
    			
	            <?php require_once('../methods/teacher_classes.php'); ?>
            </div>

            <div id="Students" class="w3-container w3-animate-opacity tab" style="width:95% !important; display: none;">
                <br><br>
                
                <?php //require_once(''); ?>
            </div>
          
            <div id="Studs" class="w3-container w3-animate-opacity tab" style="width:95% !important; display: none;">
    			<br><br>
    			
	            <?php require_once('../methods/teacher_student_class.php'); ?>
            </div>
            
            
        </div>
    </div>

</body>
</html>
<script>

</script>
