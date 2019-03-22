
<?php 

$user_role = $_GET['role'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CHCC</title>
    <link type="text/css" rel="stylesheet" href="../lib/css/index.css">
    <link type="text/css" rel="stylesheet" href="../lib/css/w3.css">
    <link type="text/css" rel="stylesheet" href="../lib/css/font-awesome.css">
    
</head>
<body>
<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:500px; margin-top: 50px;">
    <! ******************LOGIN FORM CONTAINER****************** -->
  <div id="Login" class="w3-container tab" >
    <div class="w3-center"><br>
      <span class="w3-input w3-display-topleft"><b>FORGOT PASSWORD</b></span>
      <br>
      <h1 class="w3-margin-top w3-center"><img src="../lib/res/Logo.png"></h1>
    </div>
    <! ******************LOGIN FORM****************** -->
    <!--form class="w3-container" method="post" action="app/forgot_pass.php"-->
      <div class="w3-section">
        <label>
          <b>
            <i style="font-size: 1.5em !important;" class="fa fa-user"></i>
            <?php 
              if($user_role=="Student"){
                echo "Student ID";
              }else{
                echo "Employee ID";
              }
            ?>
          </b>
        </label>
        <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter ID Number" id="fpusername" name="username" required>
        <label><b><i style="font-size: 1.5em !important;" class="fa fa-key"></i> Email</b></label>
        <input class="w3-input w3-border" type="email" id="fpemail" placeholder="Enter Email" name="email" required>
        <input type="hidden" name="role" id="fprole" value="<?php echo $user_role?>">
        <br>
            
        <div class="w3-row">
          <div class="w3-col s12">
           <button class="w3-input w3-block w3-blue w3-padding" type="submit" style= "height: 52px;" onclick="forgot()">Reset Password</button>
           </div>
          
        </div>
        
        
      </div>
    <!--/form-->
  </div>
</div>

<div id="error" class="w3-modal">
  <div class="w3-modal-content">

    <header class="w3-container w3-red"> 
      <span onclick="document.getElementById('error').style.display='none'" 
      class="w3-button w3-display-topright">&times;</span>
      <h5><i class="fas fa-exclamation-triangle"></i> ERROR</h5>
    </header>

    <div class="w3-container w3-padding">
      <p>Username and email did not match with our system. Please try again.</p>
    </div>

  </div>
</div>
<div id="success" class="w3-modal">
  <div class="w3-modal-content">

    <header class="w3-container w3-green"> 
      <span onclick="document.getElementById('success').style.display='none'" 
      class="w3-button w3-display-topright">&times;</span>
      <h5><i class="far fa-check-circle"></i> SUCCESS</h5>
    </header>

    <div class="w3-container w3-padding">
      <p>Please check your email and phone for your new login information.</p>
      <?php
        if($user_role=="Admin"){
          ?>
          <a href="../admin" class="w3-right">Back to Login</a>
          <?php
        }else{
          ?>
          <a href="../" class="w3-right">Back to Homepage</a>
          <?php
        }
      ?>
      
    </div>

  </div>
</div>

</body>
</html>
<script>
  function forgot(){
    var user = document.getElementById("fpusername").value;
    var email = document.getElementById("fpemail").value;
    var role = document.getElementById("fprole").value;

    console.log(role);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        var res = this.responseText;
        if(res.includes("error")){
          document.getElementById("error").style.display = 'block';
        }
        else{
          document.getElementById("success").style.display = 'block';
        }
      }
    };
    xhttp.open("POST", "../app/forgot_pass.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("user="+user+"&email="+email+"&role="+role);

  }
</script>
