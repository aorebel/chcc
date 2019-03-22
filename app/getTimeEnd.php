<option value="">Select End Time</option><?php
$str = $_REQUEST['start'];
$x = str_replace("-",":",$str);
$x = strtotime($x)+(15*60);
$start = date("H:i",$x);

$range=range(strtotime($start),strtotime("20:00"),15*60);
foreach($range as $time){
       ?>
        <option value="<?php echo date("H:i",$time); ?>"><?php echo date("H:i",$time); ?></option>
       <?php
}
?>