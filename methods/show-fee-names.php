<?php 

require_once('../app/config/connect.php');


$query = "SELECT fee_name from fees group by fee_name having count(*)>0";
$pdo = $conn->prepare($query);
$pdo->execute();
while($row = $pdo->fetch(PDO::FETCH_ASSOC)){
	?>
	<option value="<?php echo $row['fee_name']; ?>"><?php echo $row['fee_name']; ?></option>
	<?php
}

?>