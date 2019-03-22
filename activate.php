<?php 

require_once('app/config/connect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

    <link rel="stylesheet" href="lib/css/w3.css">
    <link rel="stylesheet" href="lib/css/font-awesome.css">
    <script type="text/javascript" src="lib/js/jquery.js"></script>
</head>
<body>
	<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:500px; margin-top: 80px;">
		<header class="w3-container w3-green"> 
	        <h2>Activate Account</h2>
	     </header>
		<form class="w3-container w3-padding" method="post" action="app/activation.php">

            <div class="w3-section w3-padding">
              <label><b><i style="font-size: 1.5em !important;" class="fa fa-user"></i> Username</b></label>
              <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="id" required>
              <label><b><i style="font-size: 1.5em !important;" class="fa fa-lock"></i> Activation Code</b></label>
              <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Confirmation Code" name="code" required>
              
              <input type="hidden" name="role" value="admin">
              <button class="w3-input w3-block w3-green w3-padding" type="submit">Activate</button>             
              
            </div>

        </form>

	</div>
</body>
</html>