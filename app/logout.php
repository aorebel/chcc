<?php 

session_start();
ob_start();
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 
header('location: ../');
ob_end_flush();

?>