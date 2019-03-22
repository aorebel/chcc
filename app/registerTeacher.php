<?php

require_once('config/connect.php');
require_once('functions.php');
require_once('config/mail.php');

$id = $_POST['id'];
$role = "teacher";
$email = $_POST['email'];
/*
 * Create a random string
 * @author	XEWeb <>
 * @param $length the length of the string to create
 * @return $str the string
 */
//echo $id;
//echo $role;
//echo $email;

$get_user_info = "select * from teachers where emp_id = ? and email = ?";
$user_info = $conn->prepare($get_user_info);
$user_info->execute(array($id, $email));
$info=$user_info->fetch(PDO::FETCH_ASSOC);
?>
	
	
<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Registration</title>
		<link rel="stylesheet" href="../lib/css/w3.css">
		<link rel="stylesheet" href="../lib/css/font-awesome.css">	
	</head>
	<body>
		<?php
		if(!empty($info)){
			$uname = preg_replace('/-/', '', $info['emp_id']);
			//$pLength = 10;
			//$cLength = 6;
			$password = randomPass();
			$code = randomCode();

			$queryDU = "SELECT * from users where user_id=?";
			$getDU = $conn->prepare($queryDU);
			$getDU->execute(array($id ));
			$duRow = $getDU->fetch(PDO::FETCH_ASSOC);
			if(!empty($duRow)){
				echo "This student ID is already registered. If you forgot you password please go to forget password on the login tab.";
			}else{
			$new = "yes";
			$query_users="insert into users (user_id, uname, pass, role, isFirstLogin) values(?, ?, ?, ?,?)";
			$stmt_users = $conn->prepare($query_users);
			$stmt_users->execute(array($id,$uname,$password,$role,$new));


			$status = "Not Activated";
			$query_code="insert into activation (uname, act_code, status) values(?, ?, ?)";
			$stmt_code = $conn->prepare($query_code);
			$stmt_code->execute(array($uname,$code,$status));	

			// below we want to set the email address we will be sending our email to.
			$mail->AddAddress($email, $firstname);

			// set word wrap to 50 characters
			$mail->WordWrap = 50;
			// set email format to HTML
			$mail->IsHTML(true);

			$mail->Subject = "Confirm Registration";

			// $message is the user's message they typed in
			// on our contact us page. We set this variable at
			// the top of this page with:
			// $message = $_REQUEST['message'] ;
			$message  =	"Success!!!". "<br>" .
						"Your username is ".$uname. "<br>" .
						"Your password is ".$password. "<br>" .
						"Your activation code is ".$code. "<br>" .
						"Copy and paste the link below to activate your account: ". "<br>" .
						"https://www.chcc.ga/activate.php";

			$mail->Body = $message;
			$mail->AltBody ="Name    : {$name}\n\nEmail   : {$email}\n\nMessage : {$message}";


			/*
			if(!$mail->Send())
			{
			echo "Message could not be sent. <p>";
			echo "Mailer Error: " . $mail->ErrorInfo;
			exit;
			}
			$to      = $info['email'];
			$subject = 
			
			
			$headers = 'From: webmaster@example.com' . "\r\n" .
			    'Reply-To: webmaster@example.com' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();

			$mail = mail($to, $subject, $message, $headers);*/
			if($mail->Send()){
				?>
				<div class="w3-modal-content w3-card-4 w3-animate-zoom w3-padding w3-panel w3-green">
			    <h3>Success!</h3>
			    <p>We have sent an email confirmation @ <?php echo $info['email']; ?> with your login information and activation code!</p>
			    <a class="w3-button w3-blue w3-round-medium w3-padding" href="../activate.php">Activate</a>
			 </div>
			<?php }else{ ?>
			<div class="w3-modal-content w3-card-4 w3-animate-zoom w3-padding w3-panel w3-red">
			    <h3>Error!</h3>
			    <p>Email cannot be send please ask your website administrator for assistance regarding your login details.</p>
			    <a class="w3-button w3-gray w3-round-medium w3-padding" href="../index.php">Back</a>
			 </div>
			
			<?php }
			}
		}
		else{
			echo "User does not exist!";
		}





?>
	</body>
	</html>	


