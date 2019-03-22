<?php 
require_once('config/connect.php');
require_once('getSYSem.php');

$feeName = $_POST['feeName'];
$version = $_POST['version'];
$year_level = $_POST['yearLevel'];
if($year_level=="I"){
	$yl="1st Year";
}else if($year_level=="II"){
	$yl="2nd Year";
}else if($year_level=="III"){
	$yl="3rd Year";
}else if($year_level=="IV"){
	$yl="4th Year";
}
if($feeName == null || $version == null || $year_level == null){
echo "<div class='w3-panel w3-red w3-padding'>Please select your Fee Name and Version first for ".$yl." .</div>";
}else{
$query = "INSERT INTO curriculum (fee_name,version,school_year,sem,year_level) values (?,?,?,?,?)";
$pdo = $conn->prepare($query);
$pdo->execute(array($feeName,$version,$sy,$sem,$year_level));



echo "<div class='w3-panel w3-green w3-padding'>Curriculum Fee for ".$yl." successfully saved!</div>";
}
?>