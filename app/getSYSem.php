<?php

$currentMonth = date ("m");
$currentYear = date ("Y");
if( ($currentMonth>=9) && ($currentMonth<=12) ){
	$syEnd = $currentYear +1;
	$sy = $currentYear."-".$syEnd;
	$sem = "2nd Sem";
}
else if( ($currentMonth>=4) && ($currentMonth<=8) ){
	$syEnd = $currentYear +1;
	$sy = $currentYear."-".$syEnd;
	$sem = "1st Sem";
}
else if( ($currentMonth>=3) && ($currentMonth<=4) ){
	$syEnd = $currentYear +1;
	$sy = $currentYear."-".$syEnd;
	$sem = "Summer";
}

else if( ($currentMonth>=1) && ($currentMonth<=2) ){
	$currentYear -= 1;
	$syEnd = $currentYear +1;
	$sy = $currentYear."-".$syEnd;
	$sem = "2nd Sem";
}


?>