<?php 

$range=range(strtotime("07:00:00"),strtotime("20:00:00"),60*60);
foreach($range as $time){
	$countert ++;
	$start =  date("H:i:s",$time);
	$x = strtotime($start)+(60*60);
	$end= date("H:i:s",$x);
	$y = "time".$counter++;
   ?>
    <span onclick="clicked('<?php echo $start; ?>')" id="<?php echo $start;?>"><?php echo $start." to ".$end; ?></span><br>
   <?php
}

?>
<script>
	function clicked(i){
		alert(document.getElementById(i).innerHTML);
	}
</script>