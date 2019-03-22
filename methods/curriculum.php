<?php 

require_once('../app/config/connect.php');

$feeName = $_POST['feeName'];
$feeVer = $_POST['feeVer'];

$query = "SELECT * from fees where fee_name=? and version=?";
$pdo = $conn->prepare($query);
$pdo->execute(array($feeName,$feeVer));
while($row = $pdo->fetch(PDO::FETCH_ASSOC)){
	?>

	<div class="w3-table w3-row">
		<div class="w3-col s12 m4">
			<label for="" class="w3-text-blue"><?php echo $row['category']; ?></label>
		</div>
		<div class="w3-col s12 m5">
			<label for="" class="w3-text-blue"><?php echo $row['name']; ?></label>
		</div>
		<div class="w3-col s12 m3">
			
			<span><?php echo $row['price']; ?></span>
		</div>
	</div>

	<?php 
}


?>