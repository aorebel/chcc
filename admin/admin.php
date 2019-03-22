<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<?php
    
    require_once ('../app/config/connect.php');
    
    require_once('../app/session.php');
    //$sql = "select * from users where uname = ?";
    //echo $role;
    if($role!="admin"){
        ob_start();
        header("Location: ../index.php");
        ob_end_flush();
    }

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
    <title>Admin Dashboard</title>
    <link rel="shortcut icon" href="https://chcc.ga/Logo.png" type='image/x-icon'>
    <link rel="stylesheet" href="../lib/css/sidebar.css">
    <link rel="stylesheet" href="../lib/css/w3.css">
    <link rel="stylesheet" href="../lib/css/font-awesome.css">
    
    <link rel="shortcut icon" href="https://chcc.ga/Logo.png" type='image/x-icon'>
    <script type="text/javascript" src="../lib/js/timer.js"></script>
    <script type="text/javascript" src="../lib/js/adminTabs.js"></script>
    <style>
        .w3-white{
            text-shadow: none !important;
        }
        .tablink:hove{
            text-shadow: none !important;
        }
        .w3-modal-content>header{
            background: #2196F3!important;
        }
        .add-academics{
            margin-bottom: 25px !important; 
            padding-bottom: 25px !important; 
            margin-top: -80px !important;
        }
        .w3-input{
            height:35px !important;
            line-height: 35px !important;
        }
    </style>
    <script>
      function openSettings(menu){
      if(menu=="AcadFee"){
        document.getElementById("AcadFee").style.display = 'block';
      }else{
        document.getElementById("adcom").style.display = 'block';
        if(menu=="Enrollment"){
            document.getElementById("Enrollment").style.display = 'block';
            document.getElementById("Grading").style.display = 'none';
        }else if(menu=="Grading"){
            document.getElementById("Grading").style.display = 'block';
            document.getElementById("Enrollment").style.display = 'none';
        }
      } 
    }
    </script>
</head>

<body onload="getAdminUrl()">
    <div id="wraper" class="w3-row">
        <div id="sidebar" class="w3-col s12 m1">
            <div class="side-nav w3-blue w3-center">
    
                <img src="../lib/res/Logo.png" width="107" style="margin-top: -50px; padding: 5px;">
                <button class="w3-bar-item w3-button tablink" value="Home" name="id" id="btnHome" onclick="openTab(event,'Home')"><i class="fa fa-home"></i><br>HOME</button>
                <button class="w3-bar-item w3-button tablink" value="Employees" name="id" id="btnEmployees" onclick="openTab(event,'Employees')"><i class="fa fa-users"></i><br>EMPLOYEES</button>
                <button class="w3-bar-item w3-button tablink" value="Students" name="id" id="btnStudents" onclick="openTab(event,'Students')"><i class="fa fa-address-book"></i><br>STUDENTS</button>
                <button class="w3-bar-item w3-button tablink" value="Academics" name="id" id="btnAcademics" onclick="openTab(event,'Academics')"><i class="fa fa-book"></i><br>ACADEMICS</button>
                <button class="w3-bar-item w3-button tablink" value="Account" name="id" id="btnAccount" onclick="openTab(event,'Account')"><i class="fa fa-coins"></i><br>ACCOUNT</button>
                <br>
                <button class="w3-bar-item w3-button tablink" value="Change Password" name="id" id="btnChgPass" onclick="openTab(event,'chgPass')"><i class="fa fa-edit"></i><br>Change<br>Password</button>
         
            </div>
        </div>
        <div id="content" class="w3-col s12 m11 w3-right" style="">
            <!--div class="w3-bar w3-top w3-black w3-hide-large" style="z-index:4">
              <button class="w3-bar-item w3-button w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>Menu</button>
            </div-->
              <!-- Header -->
            <header class="w3-container" style="padding-top:20px; margin-left: 8% !important;">

                <h5 >
                    <b >
                        <i class="fa fa-home"></i> 
                        School Administrator Dashboard 
                    </b>
                    <a href="../app/logout.php" class="w3-button w3-button-0 w3-right" style="margin-top: -7px;">Logout</a>
                    
                </h5>

              </header>
            <hr>
            <!-- ////////////////////COURSES CARDS///////////////-->
        
            <div id="Home" class="w3-container w3-padding aTab" style="display:none; padding-bottom: 50px !important;">
                <div style="margin-bottom: 20px;">
                    <i class="fas fa-cog w3-button w3-blue" style="margin-right: 20px;text-align: center !important; width: 300px !important; font-size: 30px;" onclick="openSettings('Enrollment')">
                        <span style="font-weight:400;font-size: 24px;font-family: century gothic !important;">Enrollment</span>
                    </i>
                    <i class="fas fa-cog w3-button w3-blue" style="margin-right: 20px;text-align: center !important; width: 300px !important; font-size: 30px;" onclick="openSettings('Grading')">
                        <span style="font-weight:400;font-size: 24px;font-family: century gothic !important;">Grading</span>
                    </i>
                    <i class="fas fa-cog w3-button w3-blue" style="text-align: center !important; width: 300px !important; font-size: 30px;" onclick="openSettings('AcadFee')">
                        <span style="font-weight:400;font-size: 24px;font-family: century gothic !important;">Academic Fee</span>
                    </i>

                    <br>
                </div>
                <?php require_once("../templates/admin-cards.php"); ?>
            </div>

            <div id="Employees" class="w3-container w3-padding aTab" style="display:none">
                <?php require_once("employees.php"); ?>
             
            </div>
            <div id="Students" class="w3-container w3-padding aTab" style="display:none">
                <?php require_once("students.php"); ?>
             
            </div>
            <div id="Academics" class="w3-container w3-padding aTab" style="display:none">
                <?php require_once("academics.php"); ?>
               
            </div>
            <div id="Account" class="w3-container w3-padding aTab" style="display:none">
                <?php require_once("account.php"); ?>
                
            </div>
            <div id="chgPass" class="w3-container w3-padding aTab" style="display:none">
                <?php require_once("../templates/chg_pass.php"); ?>
                
            </div>
            
        </div>
        
    </div>


<script>
    function printEmpList(){
    var printContents = document.getElementById('empLists').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();
    //document.body.innerHTML = printContents;
    document.body.innerHTML = originalContents;
}

    function executeCommand(id, status){      
     var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            history.go(0);
          
        }
      };
      xmlhttp.open("POST", "../app/command.php",true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send("commandID="+id+"&status="+status);
      //console.log(id+" - "+status);
      
    }
    function showCurriculum(id){
        var id = id;
        //console.log(id);
        if(id=="acadFee1"){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  //console.log(this.responseText);
                    document.getElementById(id).innerHTML = this.responseText;
                }
            };
            xhttp.open("POST", "../methods/show-fee-names.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send();
        }
        if(id=="acadFee2"){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  //console.log(this.responseText);
                    document.getElementById(id).innerHTML = this.responseText;
                }
            };
            xhttp.open("POST", "../methods/show-fee-names.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send();
        }
        if(id=="acadFee3"){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  //console.log(this.responseText);
                    document.getElementById(id).innerHTML = this.responseText;
                }
            };
            xhttp.open("POST", "../methods/show-fee-names.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send();
        }
        if(id=="acadFee4"){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  //console.log(this.responseText);
                    document.getElementById(id).innerHTML = this.responseText;
                }
            };
            xhttp.open("POST", "../methods/show-fee-names.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send();
        }

        
    }
    function showCurriculumVer(id){
        //console.log(id);
        if(id=="acadVer1"){
            feeName = document.getElementById('acadFee1').value;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  //console.log(this.responseText);
                    document.getElementById(id).innerHTML = this.responseText;
                }
            };
            xhttp.open("POST", "../methods/cum-ver.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("feeName="+feeName);
        }
        if(id=="acadVer2"){
            feeName = document.getElementById('acadFee2').value;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  //console.log(this.responseText);
                    document.getElementById(id).innerHTML = this.responseText;
                }
            };
            xhttp.open("POST", "../methods/cum-ver.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("feeName="+feeName);
        }
        if(id=="acadVer3"){
            feeName = document.getElementById('acadFee3').value;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  //console.log(this.responseText);
                    document.getElementById(id).innerHTML = this.responseText;
                }
            };
            xhttp.open("POST", "../methods/cum-ver.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("feeName="+feeName);
        }
        if(id=="acadVer4"){
            feeName = document.getElementById('acadFee4').value;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  //console.log(this.responseText);
                    document.getElementById(id).innerHTML = this.responseText;
                }
            };
            xhttp.open("POST", "../methods/cum-ver.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("feeName="+feeName);
        }
    }
    function saveFee(id){
        //console.log(id);
        if(id=="I"){
            feeName = document.getElementById('acadFee1').value;
            version = document.getElementById('acadVer1').value;

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                  //console.log(this.responseText);
                    //document.getElementById(id).innerHTML = this.responseText;
                     document.getElementById('saveCur').innerHTML = this.responseText;
                     //console.log(this.responseText);
                }
            };
            xhttp.open("POST", "../app/save_fee.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("feeName="+feeName+"&version="+version+"&yearLevel="+id);
        }
        if(id=="II"){
            feeName = document.getElementById('acadFee2').value;
            version = document.getElementById('acadVer2').value;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  //console.log(this.responseText);
                    //document.getElementById(id).innerHTML = this.responseText;
                     document.getElementById('saveCur').innerHTML = this.responseText;
                }
            };
            xhttp.open("POST", "../app/save_fee.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("feeName="+feeName+"&version="+version+"&yearLevel="+id);
        }
        if(id=="III"){
            feeName = document.getElementById('acadFee3').value;
            version = document.getElementById('acadVer3').value;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  //console.log(this.responseText);
                    //document.getElementById(id).innerHTML = this.responseText;
                     document.getElementById('saveCur').innerHTML = this.responseText;
                }
            };
            xhttp.open("POST", "../app/save_fee.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("feeName="+feeName+"&version="+version+"&yearLevel="+id);
        }
        if(id=="IV"){
            feeName = document.getElementById('acadFee4').value;
            version = document.getElementById('acadVer4').value;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  //console.log(this.responseText);
                    //document.getElementById(id).innerHTML = this.responseText;
                     document.getElementById('saveCur').innerHTML = this.responseText;
                }
            };
            xhttp.open("POST", "../app/save_fee.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("feeName="+feeName+"&version="+version+"&yearLevel="+id);
        }
    }
    
  </script>





    
</body>
</html>
