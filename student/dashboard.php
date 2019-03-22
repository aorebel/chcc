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
    <link rel="stylesheet" href="../lib/css/admin-dash.css">
    <link rel="stylesheet" href="../lib/css/sidebar.css">
    <link rel="stylesheet" href="../lib/css/w3.css">
    <link rel="stylesheet" href="../lib/css/font-awesome.css">
</head>
<body>
    <div id="wraper" class="w3-row">
        <div id="sidebar" class="w3-col s12 m1 w3-sidebar w3-bar-block">
            <div class="side-nav w3-teal">
                <a href="" class="w3-bar-item btn-dash active"><i class="fa fa-user"></i><br>PROFILE</a>
                <a href="" class="w3-bar-item btn-dash"><i class="fa fa-address-book"></i><br>SECTION</a>
                <a href="" class="w3-bar-item btn-dash"><i class="fa fa-building"></i><br>GRADES</a>
                <a href="" class="w3-bar-item btn-dash"><i class="fa fa-bar-chart"></i><br>TRANSCRIPT</a>
                <a href="" class="w3-bar-item btn-dash"><i class="fa fa-money"></i><br>ACCOUNT</a>
                <br>
                <a href="" class="w3-bar-item w3-button chg-pass"><i class="fa fa-edit"></i><br>Change Password</a>
            </div>
        </div>
        <div id="content" class="w3-col s12 m11 w3-right">
          
            <div class="header w3-row w3-text-blue-grey">
                <h3 class="w3-container"><i class="fa fa-user"></i> STUDENT PROFILE</h3>
                <span class="logout">
                <a href="" class="w3-button">
                    <i class="fa fa-globe "></i>
                </a>
                    | 
                <a href="" class="w3-button ">LOGOUT</a>
                </span>
                </h3>
                <hr>    
            </div>
            <div id="profile"></div>
        </div>
    </div>
</body>
</html>