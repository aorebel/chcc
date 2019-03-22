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
                <a href="dashboard.php" class="w3-bar-item btn-dash "><i class="fa fa-home"></i><br>HOME</a>
                <a href="teachers.php" class="w3-bar-item btn-dash active"><i class="fa fa-address-book"></i><br>EMPLOYEES</a>
                <a href="students.php" class="w3-bar-item btn-dash"><i class="fa fa-building"></i><br>STUDENTS</a>
                <a href="subjects.php" class="w3-bar-item btn-dash"><i class="fa fa-book"></i><br>COURSES</a>
                <a href="account.php" class="w3-bar-item btn-dash"><i class="fa fa-coins"></i><br>ACCOUNT</a>
                <br>
                <a href="chg_pass.php" class="w3-bar-item w3-button chg-pass"><i class="fa fa-edit"></i><br>Change Password</a>
            </div>
        </div>
        <! *******************SIDEBAR FOR NAVIGATION END*************** -->
        <div id="body" class="w3-col s12 m11 w3-right">
            <div class="header w3-row w3-text-blue-grey">
                <h3 class="w3-container"><i class="fa fa-address-book"></i> EMPLOYEES BOARD</h3>
                <a href="" class="w3-button logout">LOGOUT</a>
                <hr>
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
