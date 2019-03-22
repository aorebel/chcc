<?php 
session_start(); 
ob_start();
include("config/connect.php");
require('functions.php');
?>
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="../lib/css/w3.css">
    <link rel="stylesheet" href="../lib/css/font-awesome.css">  
  </head>
  <body>
<?php
$user = $_POST['username'];
$pass = $_POST['password'];
$role = $_POST['role'];
if(isset($user) && $user != null && isset($pass) && $pass != null) {
  $username = trim($user);
  $password = trim($pass);
  
  $role1 = "student";
  $role2 = "teacher";
  $role3 = "cashier";
  if($username != null && $password != null) {
    try {
      $query = "select * from `users` where `uname`=? and `pass`=? and `role`=?";
      $stmt = $conn->prepare($query);
      $stmt->execute(array($username, $password, $role));

      //$stmt->execute();
      //$count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);
      /*if($count == 1 && !empty($row) && $row['role']==$role1) {
        $_SESSION['user_id']   = $row['user_id'];
        $_SESSION['user_role'] = $row['uname'];
        $_SESSION['user'] = $row['role'];
        header('location:../student/dashboard.php');
        //echo "../student/dashboard.php";
      } 
      else if($count == 1 && !empty($row) && $row['role']==$role2) {
        $_SESSION['user_id']   = $row['user_id'];
        $_SESSION['user_role'] = $row['uname'];
        $_SESSION['user'] = $row['role'];
        header('location:../teacher/dashboard.php');
        //echo "../student/dashboard.php";
      } 
      else if($count == 1 && !empty($row) && $row['role']==$role3) {
        $_SESSION['user_id']   = $row['user_id'];
        $_SESSION['user_role'] = $row['uname'];
        $_SESSION['user'] = $row['role'];
        header('location:../cashier/dashboard.php');
        //echo "../student/dashboard.php";
      } 
      else {
        echo "invalid";
      }*/
      $u = $row['user_id'];
      if(!empty($row)){
        $isActivated = checkActivation($conn,$user);
        $isFirst = isFirstLogin($conn,$user);  
        if($isActivated){
            if(!$isFirst){
                $role=$row['role'];
                if($role=="student"){
                  isStudent($role, $isFirst,$u);
                }
                else if($role=="teacher"){
                  isTeacher($role, $isFirst,$u);
                }
                else if($role=="cashier"){
                  isCashier($role, $isFirst,$u);
                }
                else{
                  header("Location: ../index.php");
                  ob_end_flush();
                }
                
            }else{
                //$_SESSION["uname"]=$row['uname'];
                $_SESSION["user"]=$row['user_id'];
                $_SESSION["user_role"]=$row['role'];
                $_SESSION["isFirstLogin"]=$isFirst;

                //echo $_SESSION['uname'];
                header("location: ../templates/chg_pass.php");
                ob_end_flush();
            }
        }
        else{
            ?>

            <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-padding w3-panel w3-red">
                <h3>Error!</h3>
                <p>Account not yet activated. </p>

                <a class="w3-button w3-white w3-round-medium w3-padding" href="../activate.php">Activate</a>

            </div>

            <?php
        }

      }
      else{
        echo "<div class='w3-round-large w3-red w3-padding' style='margin:50px;'><h3>Invalid Access!</h3><a href='../index.php' ><span class='w3-right w3-button w3-gray w3-text-white w3-round' style='margin-top: -40px;'>Go back</span></a></div>";
      }
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  } else {
    echo "Both fields are required!";
  }
} else {
  header('location:./');
  ob_end_flush();
}
?>
</body>
</html>
