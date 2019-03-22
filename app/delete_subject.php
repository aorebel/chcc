<?php 


require_once('config/connect.php');

$subID = $_POST['id'];

$query = "DELETE from subjects where id = ?";
$pdo = $conn->prepare($query);
if($pdo->execute(array($subID))){
	echo "success";
}


?>