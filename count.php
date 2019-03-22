<?php 
/*
$i['count']="";
$j=0;
while( $j<100){
	$j++;
	if($j%3==0){
		$i['count']="Site";
		if(($j%3==0) && ($j%5==0)){
		$i['count']="SiteHost";
	}
	}
	
	else{$i['count']=$j;}
	echo $i['count']."<br>";
}
*/
?>


<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>



