<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<?php


session_start();
ob_start();
$user = $_SESSION['user'];
$role = $_SESSION['user_role'];


?>
<div style="display: none;">
<?php 

//session_start();
?>
</div>

<?php



  

  if(!empty($user)){
    //echo $role;
    ?>
    
  <div id="sw" class="w3-modal" style="display: block; " >
    <div class="w3-modal-content" style="background: rgba(255,255,255, .7) !important;">

      <header class="w3-container w3-red"> 
        <h3><i class="fas fa-exclamation-triangle"></i> WARNING</h3>
      </header>

      <div class="w3-container w3-padding">
        <p class="w3-center" style="font-family: century gothic; font-weight: 500; font-size: 16px;">
          A session is currently active on this browser. Select OK to logout from the previous session!
        </p>
        <button class="w3-button w3-red w3-right" onclick="continueSessionAdmin('<?php echo $role; ?>')">Cancel</button>
        <button class="w3-button w3-blue w3-right" style="margin-right: 20px;" onclick="endSession()">OK</button>
      </div>

    </div>
  </div>
    
    <?php

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <//link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../lib/css/w3.css">
    
    <link rel="shortcut icon" href="https://chcc.ga/Logo.png" type='image/x-icon'>
    <link rel="stylesheet" href="../lib/css/font-awesome.css">
    <script type="text/javascript" src="../lib/js/jquery.js"></script>
    <//script type="text/javascript" src="lib/js/login.js"></script>
    <style>
      #adcom label{
        display: block;
        width: 90% !important;
      }
    </style>
    
</head>
<body style="background: url('../lib/res/Background1.jpg'); background-size:cover; ">
    <div id="content" class="w3-row">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:500px; margin-top: 80px;">
        <! ******************LOGIN FORM CONTAINER****************** -->
        <div id="adminLogin" class="w3-container tab-admin" >
          <div class="w3-center"><br>
            <span class="w3-input w3-display-topleft"><b>ADMIN LOGIN</b></span><br>
            <img src="../lib/res/Logo.png">
          </div>
          <! ******************LOGIN FORM****************** -->
          <form class="w3-container" method="post" action="../app/admin_login.php">
            <div class="w3-section">
              <label><b><i style="font-size: 1.5em !important;" class="fa fa-user"></i> Username</b></label>
              <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="username" required>
              <label><b><i style="font-size: 1.5em !important;" class="fa fa-key"></i> Password</b></label>
              <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="password" required>
              <input type="hidden" name="role" value="admin"><br>
              
              <a href="../templates/forgot-pass.php?role=Admin" class="w3-center w3-row" style="margin-bottom: 20px;">Forgot password?</a>
              <br>
              
               <div class="w3-row">
                <div class="w3-col s6">
                 <button class="w3-input w3-block w3-blue w3-padding" type="submit" style= "height: 52px;">Login</button>
                 </div>
                 <div class="w3-col s6">
                <span style="width: 100%; height: 51px; line-height: 41px;" class="w3-input w3-button w3-yellow tablink2" onclick="openTabAdmin(event,'adminRegister')" >Register</span>    
                </div>  
                
              </div>
              
              
            </div>
          </form>
        </div>
        <! ******************REGISTER FORM CONTAINER****************** -->
        <div id="adminRegister" class="w3-container tab-admin" style="display:none">
          <div class="w3-center"><br>
            <span class="w3-input w3-display-topleft"><b>ADMIN SIGNUP</b></span>
            <h1 class="w3-margin-top w3-center"><img src="../lib/res/Logo.png"></h1>
          </div>
          <! ******************REGISTER FORM****************** -->
          <form class="w3-container" method="post" action="register.php">
            <div class="w3-section">
              <label><b><i style="font-size: 1.5em !important;" class="fa fa-address-card"></i> Employee ID</b></label>
              <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="id" required>
              <label><b><i style="font-size: 1.5em !important;" class="fa fa-envelope"></i> Email Address</b></label>
              <input class="w3-input w3-border w3-margin-bottom" type="email" placeholder="Enter Email Address" name="email" required>
              
              <input type="hidden" name="role" value="admin">
             
              <div class="w3-row">
                <div class="w3-col s6">
                 <button class="w3-input w3-block w3-blue w3-padding" type="submit" style= "height: 52px;">Register</button>
                 </div>
                 <div class="w3-col s6">
                <span style="width: 100%; height: 50px; line-height: 40px; " class="w3-input w3-button w3-yellow tablink2" onclick="openTabAdmin(event,'adminLogin')" >Back</span>    
                </div>  
                
              </div>

              
              
            </div>
          </form>
        </div>    
        <! ******************TAB BUTTONS****************** -->
        
      </div>
       <script>
        function openTabAdmin(evt2,tabName3) {
          var i;
          var x = document.getElementsByClassName("tab-admin");
          for (i = 0; i < x.length; i++) {
             x[i].style.display = "none";  
          }
          var tablinks = document.getElementsByClassName("tablink2");
          for (i = 0; i < x.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
          }
          document.getElementById(tabName3).style.display = "block";  
          evt2.currentTarget.className += " w3-red";
        }
        function endSession(){
          <?php session_destroy(); ?>
          location.reload();
        }
        function continueSessionAdmin(id){
          if(id=="admin"){
            window.location.href = "https://chcc.ga/admin/"+id+".php?page=Home";
          }else{
            window.location.href = "https://chcc.ga/"+id+"?page=Home";
          }
          
        }
    </script>
    </div>
</body>
</html>

