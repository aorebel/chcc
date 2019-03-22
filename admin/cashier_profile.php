<?php
require_once('../app/config/connect.php');

$id = strval($_GET['sid']);

$get_info = "select * from employees where emp_id =?";
$info =  $conn->prepare($get_info);
$info->execute(array($id));
$emp = $info->fetch(PDO::FETCH_ASSOC);
//echo $id." - ".$tbl; 
$fullname = ucwords($emp['fname']." ".$emp['mi'].". ".$emp['lname']);

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
    <script type="text/javascript" src="../lib/js/adminTabs.js"></script>
</head>
<body>
    <div id="wraper" class="w3-row">
        <! *******************SIDEBAR FOR NAVIGATION*************** -->
        <div id="sidebar" class="w3-col s12 m1 w3-sidebar w3-bar-block">
            <div class="side-nav w3-blue w3-center">
    
                <img src="../lib/res/logo.png" width="107" style="margin-top: -50px; padding: 5px;">
                <button class="w3-bar-item w3-button tablink" value="Home" name="id" id="btnHome" onclick="openTab(event,'Home')"><i class="fa fa-home"></i><br>HOME</button>
                <button class="w3-bar-item w3-button tablink" value="Employees" name="id" id="btnEmployees" onclick="openTab(event,'Employees')"><i class="fa fa-users"></i><br>EMPLOYEES</button>
                <button class="w3-bar-item w3-button tablink" value="Students" name="id" id="btnStudents" onclick="openTab(event,'Students')"><i class="fa fa-address-book"></i><br>STUDENTS</button>
                <button class="w3-bar-item w3-button tablink" value="Academics" name="id" id="btnAcademics" onclick="openTab(event,'Academics')"><i class="fa fa-book"></i><br>ACADEMICS</button>
                <button class="w3-bar-item w3-button tablink" value="Account" name="id" id="btnAccount" onclick="openTab(event,'Account')"><i class="fa fa-coins"></i><br>ACCOUNT</button>
                <br>
                <button class="w3-bar-item w3-button tablink" value="Change Password" name="id" id="btnChgPass" onclick="openTab(event,'chgPass')"><i class="fa fa-edit"></i><br>Change Password</button>
         
            </div>
        </div>
        <! *******************SIDEBAR FOR NAVIGATION END*************** -->
        <div id="body" class="w3-col s12 m11 w3-right">
        	<! ***********************************CONTENT HEADER********************************-->
            <div class="header w3-row w3-text-blue-grey">
                <h3 class="w3-container"><i class="fa fa-eye"></i> CASHIER PROFILE > <?php echo $fullname; ?>
                <a href="" class="w3-button logout" style="margin-top: -3px !important;">LOGOUT</a>         
            </div>
            <! ***********************************EMPLOYEE PROFILE TAB BUTTONS********************************-->
	        <div class="w3-bar w3-black" style="font-size: 18px !important; text-shadow: none !important;">
	            
            	<button class="w3-button tablink w3-red" onclick="openTab(event,'Profile')">Profile</button>
			    <a class="w3-button w3-right" >Exit</a>
			    
			</div>
            <! ***********************************EMPLOYEE PROFILE END********************************-->
    		<div id="Profile" class="w3-container w3-animate-opacity tab" style="width:95% !important; display: block;">
    			<br><br>
	            <?php require_once('../methods/view_emp_profile.php'); ?>
            </div>
            <div id="Classes" class="w3-container w3-animate-opacity tab" style="width:95% !important; display: none;">
    			<br><br>
    			SUBJETCS
	            <?php //require_once(''); ?>
            </div>
            <div id="Students" class="w3-container w3-animate-opacity tab" style="width:95% !important; display: none;">
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
	</script>
</body>
</html>


