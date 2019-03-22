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
</head>
<body>
    <div id="wraper" class="w3-row">
        <! *******************SIDEBAR FOR NAVIGATION*************** -->
        <div id="sidebar" class="w3-col s12 m1 w3-sidebar w3-bar-block">
            <div class="side-nav w3-teal">
                <a href="dashboard.php" class="btn-dash"><i class="fa fa-home"></i><br>HOME</a>
                <a href="teachers.php" class="btn-dash active"><i class="fa fa-address-book"></i><br>EMPLOYEES</a>
                <a href="students.php" class="btn-dash "><i class="fa fa-building"></i><br>STUDENTS</a>
                <a href="subjects.php" class="btn-dash"><i class="fa fa-book"></i><br>COURSES</a>
                <a href="account.php" class="btn-dash"><i class="fa fa-coins"></i><br>ACCOUNT</a>
                <br>
                <a href="chg_pass.php" class="btn-dash chg-pass"><i class="fa fa-edit"></i><br>Change <br> Password</a>
            </div>
        </div>
        <! *******************SIDEBAR FOR NAVIGATION END*************** -->
        <div id="body" class="w3-col s12 m11 w3-right">
        	<! ***********************************CONTENT HEADER********************************-->
            <div class="header w3-row w3-text-blue-grey">
                <h3 class="w3-container"><i class="fa fa-eye"></i> ADMIN PROFILE > <?php echo $fullname; ?>
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


