<?php 

require_once('config/connect.php');

$id = $_POST['id'];

$query = "SELECT * from users where user_id = ?";
$pdo = $conn->prepare($query);
$pdo->execute(array($id));
$row = $pdo->fetch(PDO::FETCH_ASSOC);
//echo $id;
if($row['user_id']==$id){
 	echo "<div class='w3-panel w3-red w3-padding'>This student ID is already registered. If you forgot your password please go to forget password on the login tab.</div>";
}else{
	echo "<div class='w3-panel w3-green w3-padding'>Student is not yet registered.</div>";
}
//echo $row['uname'];
?>