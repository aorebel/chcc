
<form action="../app/edit_fees.php" method="post">
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
			<input type="text" class="w3-input w3-border w3-right" name="<?php echo $row['id']; ?>" id="<?php echo $row['name']; ?>" value="<?php echo $row['price']; ?>">
		</div>
	</div>

	<?php 
}


?>
<input id="checkBox" type="checkbox" name="newCur" class="w3-checkbox" value="" onclick="showNewFeeName()">
<span class="w3-text-blue">Change Curricullum Fee Name</span>
 <br>
<br>
<div class="" id="newFeeName" style="display: none;">
	<label for="" class="w3-text-blue">Curriculum Fee Name</label>
	<input type="text" name="curName" class="w3-input w3-border">
</div>
<br>
<input type="hidden" name="feeName" value="<?php echo $feeName; ?>">
<input type="hidden" name="feeVer" value="<?php echo $feeVer; ?>">
<button class="w3-button w3-blue w3-right ">Submit</button>
</form>

<script>
	
</script>