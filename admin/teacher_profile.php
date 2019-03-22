<?php
require_once('../app/config/connect.php');
require_once('../app/functions.php');
require_once('../app/getSYSem.php');
require_once('../app/session.php');

$id = strval($_GET['id']);

$get_info = "select * from employees where id =?";
$info =  $conn->prepare($get_info);
$info->execute(array($id));
$emp = $info->fetch(PDO::FETCH_ASSOC);
//echo $id." - ".$tbl; 
$mi = explode(".", $emp['mi']);
$fullname = ucwords($emp['fname']." ".$mi[0].". ".$emp['lname']);
$sid = $emp['emp_id'];
$rPic = checkPicture($conn, $sid);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../lib/css/admin-dash.css">
    <link rel="stylesheet" href="../lib/css/sidebar.css">
    <link rel="stylesheet" href="../lib/css/w3.css">
    <link rel="stylesheet" href="../lib/css/font-awesome.css">
</head>
<body>
    <div id="wraper" class="w3-row">
        <! *******************SIDEBAR FOR NAVIGATION*************** -->
        <div id="sidebar" class="w3-col s12 m1 w3-sidebar w3-bar-block">
            <div class="side-nav w3-blue w3-center">
    
                <img src="../lib/res/logo.png" width="107" style="margin-top: -50px; padding: 5px;">
                <button class="w3-bar-item w3-button" value="Home" name="id" id="Home" onclick="openLink('Home')"><i class="fa fa-home"></i><br>HOME</button>
                <button class="w3-bar-item w3-button w3-white" value="Employees" name="id" id="Employees" onclick="openLink('Employees')"><i class="fa fa-users"></i><br>EMPLOYEES</button>
                <button class="w3-bar-item w3-button" value="Students" name="id" id="Students" onclick="openLink('Students')"><i class="fa fa-address-book"></i><br>STUDENTS</button>
                <button class="w3-bar-item w3-button" value="Academics" name="id" id="Academics" onclick="openLink('Academics')"><i class="fa fa-book"></i><br>ACADEMICS</button>
                <button class="w3-bar-item w3-button" value="Account" name="id" id="Account" onclick="openLink('Account')"><i class="fa fa-coins"></i><br>ACCOUNT</button>
                <br>
                <button class="w3-bar-item w3-button tablink" value="chgPass" name="id" id="chgPass" onclick="openLink('chgPass')"><i class="fa fa-edit"></i><br>Change Password</button>
         
            </div>
        </div>
        <! *******************SIDEBAR FOR NAVIGATION END*************** -->
        <div id="body" class="w3-col s12 m11 w3-right">
        	<! ***********************************CONTENT HEADER********************************-->
            <div class="header w3-row w3-text-blue-grey">
                <h3 class="w3-container"><i class="fa fa-eye"></i> TEACHER PROFILE > <?php echo $fullname; ?>
                <a href="../app/logout.php" class="w3-button logout" style="margin-top: -3px !important;">LOGOUT</a>         
            </div>
            <! ***********************************EMPLOYEE PROFILE TAB BUTTONS********************************-->
	        <div class="w3-bar w3-black" style="font-size: 18px !important; text-shadow: none !important;">
	            
            	<button class="w3-button tablink w3-red" onclick="openTab(event,'Profile')">Profile</button>
			    <button class="w3-button tablink" onclick="openTab(event,'Classes')">Classes</button>
                <button class="w3-button tablink" onclick="openTab(event,'Studs')">Students</button>


			    <a href="../admin/admin.php?page=Employees" class="w3-button w3-right" >Exit</a>
			    
			</div>
            <! ***********************************EMPLOYEE PROFILE END********************************-->
    		<div id="Profile" class="w3-container w3-animate-opacity tab" style="width:95% !important; display: block;">
    			<br><br>
	            <?php require_once('../methods/view_emp_profile.php'); ?>
            </div>
            <div id="Classes" class="w3-container w3-animate-opacity tab" style="width:95% !important; display: none;">
    			<br>
    			
	            <?php require_once('../methods/teacher_classes.php'); ?>
            </div>

            <div id="Students" class="w3-container w3-animate-opacity tab" style="width:95% !important; display: none;">
                <br><br>
                SUBJETCSsdasdasd asdasd asd asd sad 
                <?php //require_once(''); ?>
            </div>
            <div id="Studs" class="w3-container w3-animate-opacity tab" style="width:95% !important; display: none;">
    			<br><br>
    			SUBJETCS
	            <?php //require_once(''); ?>
            </div>
            
            
        </div>
    </div>
    <script>
		function openTab(evt, tabName) {
		  var i, x, tablinks;
		  x = document.getElementsByClassName("tab");
		  for (i = 0; i < x.length; i++) {
		      x[i].style.display = "none";
		  }
		  tablinks = document.getElementsByClassName("tablink");
		  for (i = 0; i < x.length; i++) {
		      tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
		  }
		  document.getElementById(tabName).style.display = "block";
		  evt.currentTarget.className += " w3-red";
		}
        function openLink(linkname){
            var link = document.getElementById(linkname).value;
            window.location.href = '../admin/admin.php?page='+link;
        }
	</script>
</body>
</html>


