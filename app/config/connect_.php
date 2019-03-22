<?php
$servername = "chcc.ga";
$username = "chcc_admin";
$password = "_@c4Y[M2ednx";
$db_name = "chcc_db";
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_CASE => PDO::CASE_NATURAL,
  PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
];
try {
    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password,$options);
    // set the PDO error mode to exception
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    //echo "connected";
} catch (PDOException $e) {
  echo "Connection failed : ". $e->getMessage();
}
?>
