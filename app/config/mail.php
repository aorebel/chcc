<?php 


require_once('../lib/PHPMailer/PHPMailerAutoload.php');

$username = "admin@chcc.ga";
$password = "Twt]e0B+qqmL";

$mail = new PHPMailer();

// set mailer to use SMTP
$mail->IsSMTP();

// As this email.php script lives on the same server as our email server
// we are setting the HOST to localhost
$mail->Host = "mail.chcc.ga"; // specify main and backup server

$mail->SMTPAuth = true; // turn on SMTP authentication

// When sending email using PHPMailer, you need to send from a valid email address
// In this case, we setup a test email account with the following credentials:
// email: user@example.com
// pass: password
$mail->Username = $username; // SMTP username
$mail->Password = $password; // SMTP password

// $email is the user's email address the specified
// on our contact us page. We set this variable at
// the top of this page with:
// $email = $_REQUEST['email'] ;
$mail->From = $username;
/*
// below we want to set the email address we will be sending our email to.
$mail->AddAddress("user@yourdomain.com", "Name");

// set word wrap to 50 characters
$mail->WordWrap = 50;
// set email format to HTML
$mail->IsHTML(true);

$mail->Subject = "You have received feedback from your website!";

// $message is the user's message they typed in
// on our contact us page. We set this variable at
// the top of this page with:
// $message = $_REQUEST['message'] ;
$mail->Body = $message;
$mail->AltBody ="Name    : {$name}\n\nEmail   : {$email}\n\nMessage : {$message}";

if(!$mail->Send())
{
echo "Message could not be sent. <p>";
echo "Mailer Error: " . $mail->ErrorInfo;
exit;
}

echo "Thank you for contacting us. We will be in touch with you very soon.";
*/

?>