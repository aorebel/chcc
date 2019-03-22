<?php
    session_start();
    require ('../app/config/connect.php');
    $user = $_SESSION['user'];
    $role = $_SESSION['user_role'];

    $sql = "select * from users where uname = ?";
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../lib/css/sidebar.css">
    <link rel="stylesheet" href="../lib/css/w3.css">
    <link rel="stylesheet" href="../lib/css/font-awesome.css">
</head>
<body>
    <div id="wraper" class="w3-row">
        <div id="sidebar" class="w3-col s12 m1 w3-sidebar w3-bar-block w3-collapse">
            <div class="side-nav w3-teal">
                <a href="dashboard.php" class="w3-bar-item btn-dash active">
                    <i class="fa fa-home"></i><br>HOME</a>
                <a href="teachers.php" class="w3-bar-item btn-dash">
                    <i class="fa fa-address-book"></i><br>EMPLOYEES</a>
                <a href="students.php" class="w3-bar-item btn-dash">
                    <i class="fa fa-building"></i><br>STUDENTS</a>
                <a href="subjects.php" class="w3-bar-item btn-dash">
                    <i class="fa fa-book"></i><br>COURSES</a>
                <a href="account.php" class="w3-bar-item btn-dash">
                    <i class="fa fa-coins"></i><br>ACCOUNT</a>
                <br>
                <a href="chg_pass.php" class="w3-bar-item w3-button chg-pass"><i class="fa fa-edit"></i><br>Change Password</a>
            </div>
        </div>
        <div id="content" class="w3-col s12 m11 w3-right">
            <div class="w3-bar w3-top w3-black w3-hide-large" style="z-index:4">
                  <button class="w3-bar-item w3-button w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
                </div>
              <!-- Header -->
              <header class="w3-container" style="padding-top:20px">
                <h5><b><i class="fa fa-home"></i> School Administrator Dashboard</b><a href="" class="w3-button w3-button-0 w3-right" style="margin-top: -7px;">Logout</a></h5>

              </header>
            <hr>
  
            <!-- ////////////////////COURSES CARDS///////////////-->
            <div class="w3-row w3-container w3-row-padding">
                <?php require_once("../templates/admin-cards.php"); ?>
            </div>
            
        </div>
        
    </div>
    <div id="footer" class="w3-row w3-blue">
            <div class="w3-container w3-center">
                <h5>All rights reserved</h5>
            </div>
        </div>
</body>
</html>