<?php 
session_start();
ob_start();
require('config/connect.php');
require('functions.php');
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>

        <link rel="stylesheet" href="../lib/css/w3.css">
        <link rel="stylesheet" href="../lib/css/font-awesome.css">
    </head>
    <body>
        <?php

        $uname = $_POST['username'];
        $pass = $_POST['password'];

        $sql = "SELECT * FROM users WHERE uname=?";
        $query = $conn->prepare($sql);
        $query->execute(array($uname));

        $count = $query->rowCount();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $user = $row['user_id'];
        if($count > 0) {            
            if($row['pass']==$pass){
                $isActivated = checkActivation($conn,$uname);
                $isFirst = isFirstLogin($conn,$uname);    

                if($isActivated){
                    if(!$isFirst){
                        $role=$row['role'];
                        
                        isAdmin($role, $isFirst,$user);

                        $activity = "Login";

                        $queryAddSession = "INSERT into session (user_id, activity) values(?,?)";
                        $addSession = $conn->prepare($queryAddSession);
                        $addSession->execute(array($user,$activity));
                    }else{
                        $_SESSION["user"]=$row['user_id'];
                        $_SESSION["user_role"]=$row['role'];
                        $_SESSION["isFirstLogin"]=$isFirst;

                        $activity = "First Login";

                        $queryAddSession = "INSERT into session (user_id, activity) values(?,?)";
                        $addSession = $conn->prepare($queryAddSession);
                        $addSession->execute(array($user,$activity));

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
                echo "Wrong login information !";
            }		        
            
        }else{
            echo "Admin Does not Exist ";
        } 
        ?>
    </body>
</html>



