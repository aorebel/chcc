<?php
if(session_start()){
  //ob_start();
  $user = $_SESSION['user'];
  $role = $_SESSION['user_role'];

}else{
  session_start();
  //ob_start();
  $user = $_SESSION['user'];
  $role = $_SESSION['user_role'];
}




?>
<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?><div style="display: none;">

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

        <?php 
          if($role=="admin"){
            echo "<a href='https://chcc.ga/admin/admin.php?page=Home' class='w3-button w3-red w3-right'>Cancel</a>";
          }else{
            echo "<a href='https://chcc.ga/".$role."?page=Home' class='w3-button w3-red w3-right'>Cancel</a>";
          }
        ?>
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
    <title>CHCC</title>

    <link rel="icon" href="Logo.png">
    <link rel="shortcut icon" href="https://chcc.ga/Logo.png" type='image/x-icon'>
    <link type="text/css" rel="stylesheet" href="lib/css/index.css">
    <link type="text/css" rel="stylesheet" href="lib/css/w3.css">
    <link type="text/css" rel="stylesheet" href="lib/css/font-awesome.css">
    <script>
  function openPortal(actv, buttonName){
            var i, x, btnLink;

            var x = document.getElementsByClassName("portal");
              for (i = 0; i < x.length; i++) {
                 x[i].style.display = "none";  
              }
            var tablinks = document.getElementsByClassName("btnPortal");
              for (i = 0; i < x.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" w3-blue", "");
            }

            document.getElementById(buttonName).style.display = "block";
            actv.currentTarget.className += " w3-blue"; 
        }
</script>
</head>
<body>
    <div class="w3-row body">
      
        <button id="iMenu" class="w3-button w3-right w3-blue w3-padding w3-hide-large" onclick="toggleMenu()" >
          <i class="fas fa-bars"></i>
        </button>
        <div id="myHeader " class="w3-row w3-block index-header header w3-yellow" style="">
          
          <div class="w3-col s12 m12 l7 brandname">
            <div class="w3-row">  
              <div class="w3-col s12 m2 w3-padding w3-hide-small">
                  <img src="lib/res/Logo.jpg" alt="" height="90" width="90" style="border-radius: 45px;"  class="w3-right index-logo">
              </div>
              <div class="w3-col s12 m10" >
                  <span class="w3-left" style=" margin-top: 20px; font-size: 18px;">
                    <b>Concepcion Holy Cross College, Inc.</b></span>
                  <br>
                  <div class="w3-left" style=" display: block; font-size: 11px; width: 100%;">
                      <div class="w3-col s12 l12">
                        <i class="fas fa-envelope"></i>   Rose Park, Minane, Concepcion, Tarlac  
                      </div><br>
                      <div class="w3-col s12 l12" style="margin-top: 10px;">
                        <i class="fas fa-phone" style=""></i>  (045) 923 0747
                      </div>
                  </div>
              </div>
             </div> 
          </div>
          <div id="indexMenu" class="w3-col s12 m12 l5 nav w3-right w3-hide-medium w3-hide-small">
              <div class=" w3-row" style="height: 80px !important; width: 100%;line-height: 60px; margin:auto auto;">
                  <! button for student portal-->
                  <div class="w3-col s12 l4">
                    <button  onclick="openPortal(event, 'id01')" class="w3-input w3-blue w3-center btnPortal">
                        Student
                    </button>
                  </div>

                  <! button for teacher portal-->
                  <div class="w3-col s12 l4">
                    <button  onclick="openPortal(event, 'id02')" class="w3-input w3-blue w3-center btnPortal" >
                        Teacher
                    </button>
                  </div>
                  <! button for cashier portal-->
                  <div class="w3-col s12 l4">
                    <button  onclick="openPortal(event, 'id03')" class="w3-input w3-blue w3-center btnPortal" >
                        Cashier
                    </button>
                  </div>
              </div>
          </div>
          
        </div>

        <div class="w3-row w3-white" id="myHeader2" >
          <div class="w3-center header" style="width: 100%; background: rgba(255,255,255, .5);">
  
            <a href="#about" class="w3-button demo" onclick="currentDiv(1)" style="background: none; font-weight: 400; color: black;">About</a> 
            <a href="#vision" class="w3-button demo" onclick="currentDiv(2)" style="background: none; font-weight: 400; color: black;">Vision</a> 
            <a href="#mission" class="w3-button demo" onclick="currentDiv(3)" style="background: none; font-weight: 400; color: black;">Mission</a> 
            <a href="#tesda" class="w3-button demo" onclick="currentDiv(4)" style="background: none; font-weight: 400; color: black;">Tesda Courses</a> 
            <a href="#bachelor" class="w3-button demo" onclick="currentDiv(5)" style="background: none; font-weight: 400; color: black;">Bachelor Courses</a> 

          </div>
        </div>
       
        <div class="w3-row" id="indexContent">

            <div class="w3-content" style="max-width:1900px; ">
              
              <div id="about" class="w3-row mySlides w3-animate-left" style="">
                  <div class="w3-col m12 l4" style="">
                    <h2 class="w3-center" style="margin-top: 220px; color: white; ">
                      ABOUT <br> CONCEPCION <br> HOLY CROSS COLLEGE, INC.  
                    </h2>
                  </div>
                  <div class="w3-col m12 l8" style=" ">
                    <p style="">
                      CONCEPCION HOLY CROSS COLLEGE, INC (CHCC), founded by Mr. Pablo Lansangan Tioseco, Sr. in 1995, is the first full-fledged community college in Concepcion and Southern Tarlac. The College is located in a sprawling one hectare lot at Rose Park in Barangay Minane, Concepcion, Tarlac, along the municipal highway leading to Manila and other cities towards the south of Central Luzon, Philippines
                    </p>
                  </div>
              </div>
              <div id="vision" class="w3-row mySlides w3-animate-top" style="">
                <div class="w3-col s12 " style="">
                  <h1 class="w3-center" style="">
                    VISION
                  </h1>
                </div>
                <div class="w3-col s12 " style="">
                  <p style="">
                    Concepcion Holy Cross College, Inc., sees itself as an institution of excelence for the development of the youth, in the service of God, country and people.
                  </p>
                </div>
              </div>
              <div id="mission" class="w3-row mySlides w3-animate-right" style="">
                <div class="w3-col s12 " style="">
                  <h1 class="w3-center" style="">
                    MISSION
                  </h1>
                </div>
                <div class="w3-col s12 " style="">
                  <p style=" ">
                    The total development of the intellectual, spiritual, moral, social, and physical aspects of he youth, making them locally and globally competent through the Concepcion Holy Cross College, Inc. quality educational programs for everyone seeking holistic learning.
                  </p>
                </div>
              </div>
              <div id="tesda" class="w3-row mySlides  w3-animate-bottom" style="">
                  <div class="w3-col m12 l6" style="">
                    <h2 class="w3-center" style="">
                      TESDA OFFERING WITH ACCREDITATION<br><span style="font-size: 16px">(AND TESDA SCHOLARSHIPS)</span>  
                    </h2>
                  </div>
                  <div class="w3-col m12 l6" style="">
                    <p style="">
                      COOKERY NC II<br><br>
                      BREAD AND PASTRY PRODUCTION NC II<br><br>
                      WELDING (SMAW) NC II
                    </p>
                  </div>
              </div>
              <div id="bachelor" class="w3-row mySlides w3-animate-fade" style="">
                   
                  <div class="w3-col m12 l7 w3-padding" style=" height: 580px;  background: #02094f; color: white;">
                  
                    <h3 class="w3-center" style="margin-top: 20px;">COLLEGE OF TEACHERS EDUCATION</h3>
                    <ul style="display: block; width: 50%;margin: auto auto; margin-top: -10px; ">
                      <li>Bachelor of Elementary Education</li>
                      <li>Bachelor of Secondary Education
                        <ul>
                          <li>Major in English</li>
                          <li>Major in Filipino</li>
                          <li>Major in MAPEH</li>
                          <li>Major in Mathematics</li>
                          <li>Major in Social Studies</li>
                        </ul>
                      </li>
                    </ul>

                    <h3 class="w3-center">COLLEGE OF BUSINESS ADMINISTRATION MANAGEMENT</h3>
                    <ul style="width: 60%; margin: auto auto; margin-top: -10px;">
                      
                      <li>Bachelor of Secondary in Business Administration
                        <ul>
                          <li>Major in Financial Management</li>
                        </ul>
                      </li>
                    </ul>

                    <h3 class="w3-center">COLLEGE OF CRIMINAL JUSTICE EDUCATION</h3>
                    <ul style="width: 60%; margin: auto auto; margin-top: -10px;">
                      
                      <li>Bachelor of Science in Criminology</li>
                    </ul>

                    <h3 class="w3-center">COLLEGE OF HOSPITALITY AND TOURISM</h3>
                   <ul style="width: 60%; margin: auto auto; margin-top: -10px;">
                      
                      <li>Bachelor of Science in Hotel Restaurant Management</li>
                    </ul>

                    <h3 class="w3-center">COLLEGE OF COMPUTER SCIENCE</h3>
                    <ul style="width: 60%; margin: auto auto; margin-top: -10px;">
                      
                      <li>Bachelor of Science in Computer Science</li>
                    </ul>

                  </div>
                  <div class="w3-col m12 l5" style="height: 100%; top: 0; bottom: 0; left: 0; color: white; background: white;">
                    <h2 class="w3-center" style="margin-top: 260px; color: #02094f; ">
                      DEGREE PROGRAMS OFFERRED 
                    </h2>
                  </div>
              </div>


              
            </div>
            

        </div>

        <div class="w3-row w3-container">
            <! container for student portal login form-->
            <div id="id01" class="w3-modal portal">
                <?php require_once('templates/login-student.php'); ?>
            </div>
            <! container for teacher portal login form-->
            <div id="id02" class="w3-modal portal">
                <?php require_once('templates/login-teacher.php'); ?>
            </div>
            <! container for cashier portal login form-->
            <div id="id03" class="w3-modal portal">
                <?php require_once('templates/login-cashier.php'); ?>
            </div>
        </div>
    </div>
    <footer class="w3-container " style="width: 100%; background: rgba(255,255,0, .85); "></footer>
    <script type="text/javascript">
        



        var slideIndex = 1;
        showDivs(slideIndex);
        var slideIndex = 0;
        //carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
              x[i].style.display = "none"; 
            }
            slideIndex++;
            if (slideIndex > x.length) {slideIndex = 1} 
            x[slideIndex-1].style.display = "block"; 
            setTimeout(carousel, 8000); 
            showDivs(slideIndex);
        }
        function plusDivs(n) {
          showDivs(slideIndex += n);
        }

        function currentDiv(n) {
          showDivs(slideIndex = n);
        }

        function showDivs(n) {
          var i;
          var x = document.getElementsByClassName("mySlides");
          var dots = document.getElementsByClassName("demo");
          if (n > x.length) {slideIndex = 1}    
          if (n < 1) {slideIndex = x.length}
          for (i = 0; i < x.length; i++) {
             x[i].style.display = "none";  
          }
          for (i = 0; i < dots.length; i++) {
             dots[i].className = dots[i].className.replace(" w3-yellow", "");
          }
          x[slideIndex-1].style.display = "block";  
          dots[slideIndex-1].className += " w3-yellow";
        }

        function toggleMenu(){
          var menu = document.getElementById("indexMenu");
            menu.classList.toggle("w3-hide-medium");
            menu.classList.toggle("w3-hide-small");
          
        }
        function endSession(){
          <?php session_destroy(); ?>
          location.reload();
        }
        function continueSessionAdmin(id){
          //alert(id);
          if(id=="admin"){
            window.location.href = "https://chcc.ga/admin/"+id+".php?page=Home";
          }else{
            window.location.href = "https://chcc.ga/"+id+"?page=Home";
          }
          
        }
        function checkStudent(){
          var id = document.getElementById("studentIDonLogin").value;
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                
                //alert(this.responseText);  
                var res = this.responseText;
                           
                document.getElementById('checkUserStudent').innerHTML = res;
              }
          };
          xhttp.open("POST", "../app/check_user.php", true);
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp.send("id="+id);
        }
        
    </script>

</body>
</html>
