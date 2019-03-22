<?php

session_start();
require_once("config/connect.php");
require_once("config/textlocal.class.php");
$uname = $_POST['uname'];
$role = $_POST['role'];
$oldPass = $_POST['oldPass'];
$newPass = $_POST['newPass'];
$x=$_POST['x'];
$notFirst = "no";

$query="select * from users where user_id = ?";
$getItems=$conn->prepare($query);
$getItems->execute(array($uname));
$userItem = $getItems->fetch(PDO::FETCH_ASSOC);

//$user = $userItem['uname']; 
$pass = $userItem['pass'];
//echo $role;
$link = "https://chcc.ga/".$role."/?page=Home";
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
		
		if($role=="student"){
			$queryContactNumber = "SELECT * from students where student_id = ?";
			$getContactNumber = $conn->prepare($queryContactNumber);
			$getContactNumber->execute(array($uname));
			$norow = $getContactNumber->fetch(PDO::FETCH_ASSOC);
		}else{
			$queryContactNumber = "SELECT * from employees where emp_id = ?";
			$getContactNumber = $conn->prepare($queryContactNumber);
			$getContactNumber->execute(array($uname));
			$norow = $getContactNumber->fetch(PDO::FETCH_ASSOC);
		}
		
		if($newPass == $oldPass){
			$setUpdate = "update users set pass=?, isFirstLogin = ? where user_id = ?";
			$updateUsers = $conn->prepare($setUpdate);
			$updateUsers->execute(array($newPass,$notFirst,$uname));

			

			?>

			<div class="w3-modal-content w3-card-4 w3-animate-zoom w3-padding w3-panel w3-green">
                <h3>Success!</h3>
				<?php 
					if($role=="admin"){
				?>
                	<a class="w3-button w3-white w3-round-medium w3-padding" href="../admin/admin.php?page=Home">Continue</a>
				<?php 
				}else{ ?>
					<a class="w3-button w3-white w3-round-medium w3-padding" href="<?php echo $link?>">Continue</a>

				<?php } ?>
            </div>

			<?php
		}
		
		else{
		?>
		
		<div class="w3-modal-content w3-card-4 w3-animate-zoom w3-padding w3-panel w3-red">
            <h3>Error!</h3>
            <p>Password did not Match! </p>
			<?php 

			//echo $uname." ".$role." ".$oldPass;

			if($x){ 
				$_SESSION["error"]="Wrong Password";			
            	echo "<a class='w3-button w3-white w3-round-medium w3-padding' href='../templates/chg_pass.php'>Go Back</a>";
			 
			}else{
				if($role=="admin"){
					//session_destroy();
				?>	

	            	<a class="w3-button w3-white w3-round-medium w3-padding" href="../admin/admin.php?page=Home">Go Back</a>
				<?php 
				}
				else if($role=="student"){
					//session_destroy();
				?>
	            	<a class="w3-button w3-white w3-round-medium w3-padding" href="../student/?page=Home">Go Back</a>
				<?php 
				}
				else if($role=="teacher"){
					//session_destroy();
				?>
	            	<a class="w3-button w3-white w3-round-medium w3-padding" href="../teacher/?page=Home">Go Back</a>
				<?php 
				}
				else if($role=="cashier"){
					//session_destroy();
				?>
	            	<a class="w3-button w3-white w3-round-medium w3-padding" href="../cashier/?page=Home">Go Back</a>
				<?php 
				}
				
			}

			?>

        </div>

		<?php
		}
	?>