<?php 

require_once("../app/config/connect.php");

$id = $_POST['id'];
$code = $_POST['code'];

$get_code = "select * from activation where uname = ? and act_code = ?";
$verify_code = $conn->prepare($get_code);
$verify_code->execute(array($id,$code));
$verified=$verify_code->fetch(PDO::FETCH_ASSOC);

$get_role = "select role from users where uname = ?";
$role = $conn->prepare($get_role);
$role->execute(array($id));
$row = $role->fetch(PDO::FETCH_ASSOC);

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

<?php

if($verified){
	$today = date("Y-m-d");
	$status = "Activated";
	$set_code = "update activation set act_date = ? , status = ? where uname = ?";
	$update_code = $conn->prepare($set_code);
	$update_code->execute(array($today, $status, $id));


	?>
	
		
	
	<div class="w3-modal-content w3-card-4 w3-animate-zoom w3-padding w3-panel w3-green">
	    <h3>Success!</h3>
	    <p>You're account has been activated! You can now sign in using the link below: </p>
	    <?php 
	    
	    if($row['role']=="admin"){
	    	//session_destroy();
	    ?>
	    <a class="w3-button w3-blue w3-round-medium w3-padding" href="../admin/index.php">Login</a>
	    <?php 
	    	
		} 
	    else {
	    	//session_destroy();
	    ?>
	    <a class="w3-button w3-blue w3-round-medium w3-padding" href="../index.php">Login</a>
	    <?php 

	} 

	    ?>
	 </div>

	<?php
}
else{
	?>
	
	<div class="w3-modal-content w3-card-4 w3-animate-zoom w3-padding w3-panel w3-red">
	    <h3>Error!</h3>
	    <p>Wrong activation code or wrong username. </p>

	    <a class="w3-button w3-white w3-round-medium w3-padding" href="../activate.php">Go Back</a>

	 </div>

	<?php
}

?>
</body>
</html>