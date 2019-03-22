<?php

require_once('config/connect.php');
require_once('config/mail.php');
require_once('functions.php');

require_once("config/textlocal.class.php");

$id = $_POST['user'];
$role = $_POST['role'];
$email = $_POST['email'];

if($role=="Student"){
	$get_user_info = "select * from students where student_id = ? and email = ?";
	$user_info = $conn->prepare($get_user_info);
	$user_info->execute(array($id, $email));
	$info=$user_info->fetch(PDO::FETCH_ASSOC);
}else{
	$get_user_info = "select * from employees where emp_id = ? and email = ?";
	$user_info = $conn->prepare($get_user_info);
	$user_info->execute(array($id, $email));
	$info=$user_info->fetch(PDO::FETCH_ASSOC);
}

$uname = str_replace("-", "", $id);
$first = $info['fname']; 
$pass = randomPass();
if(empty($info)){
	echo "error";
}else{
$isFirst = "yes";
$queryUpdateUser = "UPDATE users set isFirstLogin = ?, pass = ? where user_id = ?";
$updateUser = $conn->prepare($queryUpdateUser);
$updateUser->execute(array($isFirst,$pass,$id));

	if($updateUser){
		$mail->AddAddress($email, $first);

		// set word wrap to 50 characters
		$mail->WordWrap = 50;
		// set email format to HTML
		$mail->IsHTML(true);

		$mail->Subject = "Reset Password";

		// $message is the user's message they typed in
		// on our contact us page. We set this variable at
		// the top of this page with:
		// $message = $_REQUEST['message'] ;
		$message  =	"Success!!!". "<br>" .
					"Your new password is ".$pass. "<br>" .
					"Please login using your new password.";



		$mail->Body = $message;
		$mail->AltBody ="Name    : {$name}\n\nEmail   : {$email}\n\nMessage : {$message}";

		if($mail->Send()){

			$changeNum = $info['contact'];

			if(strlen($changeNum)==11){
				$newNum = substr($changeNum,1,10);
				$receiver = "63".$newNum;
			}else{
				$receiver = "63".$newNum;
			} 
			//$receiver = "639234609017";


			$smsAPI = "W2T3/WMB5v4-CZwLWhIQvYCXZvZbxY7IrV5R6TZlQ6";
			$Textlocal = new Textlocal(false, false, $smsAPI);
 			
			$numbers = array($receiver);
			$sender = 'CHCC Admin';
			$message = $info['fname'].' Your password at https://chcc.ga was successfully changed. Please check your email ( '.$email.' ) for your new login information';
		 
			$response = $Textlocal->sendSms($numbers, $message, $sender);

			echo "success";



		}
	}

}
?>