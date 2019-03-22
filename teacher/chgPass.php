<?php

require_once('../app/session.php');

$x = $_SESSION["isFirstLogin"];

?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>

        <link rel="stylesheet" href="../lib/css/w3.css">
        <link rel="stylesheet" href="../lib/css/font-awesome.css">
    </head>
    <body>
		<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:500px; margin-top: 8%;">
			
			<! ******************CHANGE PASS FORM CONTAINER****************** -->
		    <div id="cashierLogin" class="w3-container tab-cashier" >
		      <div class="w3-center"><br>
	            <span class="w3-input w3-display-topleft"><b>CHANGE PASSWORD</b></span><br>
	          </div>
		      <! ******************CHANGE PASS FORM****************** -->
		      <form class="w3-container" method="post" action="../app/chgPass.php">
		        <div class="w3-section">
		          <label><b></i> Old Password</b></label>
		          <input class="w3-input w3-border w3-margin-bottom" type="password" placeholder="Enter Old Password" name="oldPass" required>

		          <label><b></i>New Password</b></label>
		          <input class="w3-input w3-border" id="Pass" type="password" placeholder="Enter New Password" name="newPass" required>
		          <span onclick="myFunction()"  class="w3-border-0 w3-button w3-right" style="margin-top: -39px;"><i class="fa fa-eye" id="showPass" style="color: lightgrey;"></i></span><br>

		          <input type="hidden" name="role" value="<?php echo $_SESSION["user_role"]; ?>">
		          <input type="hidden" name="uname" value="<?php echo $_SESSION["user"]; ?>">
		          <input type="hidden" name="x" value="<?php echo $_SESSION["isFirstLogin"]; ?>">
		          <button class="w3-button w3-block w3-blue w3-section w3-padding" type="submit">SUBMIT</button>
		         
		          
		          
		        </div>
		      </form>
		    </div>	

		</div>    
		<script>
			
			function myFunction() {
			    var x = document.getElementById("Pass");
			    if (x.type === "password") {
			        x.type = "text";
			        document.getElementById("showPass").style.color = "blue";
			    } else {
			        x.type = "password";
			        document.getElementById("showPass").style.color = "lightgrey";
			    }
			}
		</script>	
    </body>
</html>