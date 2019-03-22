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
                <a href="dashboard.php" class="w3-bar-item btn-dash"><i class="fa fa-home"></i><br>HOME</a>
                <a href="teachers.php" class="w3-bar-item btn-dash"><i class="fa fa-address-book"></i><br>TEACHERS</a>
                <a href="students.php" class="w3-bar-item btn-dash"><i class="fa fa-building"></i><br>STUDENTS</a>
                <a href="subjects.php" class="w3-bar-item btn-dash"><i class="fa fa-bar-chart"></i><br>SUBJECTS</a>
                <a href="account.php" class="w3-bar-item btn-dash"><i class="fa fa-money"></i><br>ACCOUNT</a>
                <br>
                <a href="chg_pass.php" class="w3-bar-item w3-button chg-pass active"><i class="fa fa-edit"></i><br>Change Password</a>
            </div>
        </div>
        <div id="body" class="w3-col s12 m11 w3-right">
            <div class="header w3-row w3-text-blue-grey">
                <h3 class="w3-container"><i class="fa fa-edit"></i> CHANGE PASSWORD</h3>
                <a href="" class="w3-button logout">LOGOUT</a>
                <hr>
            </div>
            <br>
            <!--div class="w3-container" id="AddTeacherModal">
                <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-grey">
                    Add Student
                </button>
                <div id="id01" class="w3-modal" >
                    <div class="w3-modal-content w3-animate-top w3-card-4" style="margin-bottom: 25px; padding-bottom: 25px;">
                    <header class="w3-container w3-teal"> 
                        <span onclick="document.getElementById('id01').style.display='none'" 
                        class="w3-button w3-display-topright">&times;</span>
                        <h2>ADD STUDENT</h2>
                    </header>
                    <div class="w3-container">
                        <?php require_once("../templates/add-student.php"); ?>
                    </div>
                    <!--footer class="w3-container w3-teal">
                        <p>Modal Footer</p>
                    </footer>
                    </div>
                </div>
            </div-->
            <br>
            <div class="w3-container">
                <?php //require_once("../methods/admin-student-lists.php"); ?>
            </div>
        </div>
    </div>
</body>
</html>
