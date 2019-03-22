<?php 
//$table = array("name" => "my table","content" => "my content");
$name => "my table";
$content => "my content";
$table = array('name' => ".$name.",'content' => ".$content.");

$array = json_encode($table);
echo $array;
?>