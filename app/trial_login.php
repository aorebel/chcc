<?php 
session_start();
require('config/connect.php');

$uname = $_POST['uname'];
$pass = $_POST['pass'];

$sql = "SELECT * FROM users WHERE uname=?";
$query = $conn->prepare($sql);
$query->execute(array($uname));

$count = $query->rowCount();
$row = $query->fetch(PDO::FETCH_ASSOC);
if($count > 0) {
    
    if($row['pass']==$pass){

        if($row["role"]=="teacher"){
            $_SESSION['user'] = $uname;
            $_SESSION['user_role'] = "teacher";
            $_SESSION['time_start_login'] = time();
            header("location: ../teacher/dashboard.php");
        }
        else if($row["role"]=="student"){
            $_SESSION['user'] = $uname;
            $_SESSION['user_role'] = "student";
            $_SESSION['time_start_login'] = time();
            header("location: ../student/dashboard.php");
        }else{
            echo "Invalid Access";
        }
    }
    else{
        echo "Wrong login information !";
    }		        
    
}else{
    echo "User Does not Exist ";
} 






?>