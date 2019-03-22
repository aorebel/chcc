<label for="" class="w3-text-blue">Revision Version</label>
<select name="feeVer" id="feeVer" class="w3-input w3-border" onchange="showFeesTable()" required>
	

	<option value=""></option>

<?php 
	require_once('../app/config/connect.php');

	$feeName = $_POST['feeName'];

	echo $feeName;
	$queryFeeVer = "SELECT version, fee_name from fees where fee_name = ? group by version having count(*) > 0";
    $feeVer = $conn->prepare($queryFeeVer);
    $feeVer->execute(array($feeName));
    while($rowFV = $feeVer->fetch(PDO::FETCH_ASSOC)){
        ?>
        <option value="<?php echo $rowFV['version']?>"><?php echo $rowFV['version']?></option>
        <?php 
    }


?>
</select>

<script>
	
</script>