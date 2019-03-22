<?php 
require_once('../app/config/connect.php');
?>

	<?php
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