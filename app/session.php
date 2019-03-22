<?php 
session_start();
ob_start();
require_once ('config/connect.php');

$root=$_SERVER['DOCUMENT_ROOT'];


$user = $_SESSION['user'];
$role = $_SESSION['user_role'];

//echo $user;
if( ($_SESSION['user']=="") or ($_SESSION['user_role']=="") ){
	echo "false";
	header("Location: ../index.php");
	ob_end_flush();
}
else{
	$querySession = "SELECT * from users where user_id=? and role=?";
	$session = $conn->prepare($querySession);
	$session->execute(array($user,$role));
	$sessionRow = $session->fetch(PDO::FETCH_ASSOC);
	//echo $root;
	if(!empty($sessionRow)){
		
	}
	else{
		echo "access not granted!";
		header("Location: ../index.php");
		ob_end_flush();
	}
}
?>