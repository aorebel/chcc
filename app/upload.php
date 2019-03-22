<?php 
ob_start();
require_once("config/connect.php");
require_once("functions.php");
require_once("session.php");


$id = $_POST['id'];
$sid = $_POST['sid'];
$type = $_POST['type'];
$urole = $_POST['role'];

//echo $file['name'];

$success = 0;
$uploadedFile = '';

//File upload path
$uploadPath = "../lib/img/";
$targetPath = $uploadPath . basename( $_FILES['sfile']['name']);

if(@move_uploaded_file($_FILES['sfile']['tmp_name'], $targetPath)){
    $success = 1;
    $uploadedFile = $targetPath;

    $dir = $uploadPath;
    $title = basename( $_FILES['sfile']['name']);

    $row = checkPicture($conn, $sid);
    
    if(empty($row)){
    	$queryUpload = "insert into picture (user_id,type,title,dir) values(?,?,?,?) ";
    	$upload = $conn->prepare($queryUpload);
    	$upload->execute(array($sid,$type,$title,$dir));
    	if($upload){
    		echo "upload success! ".$title;
            if($role=="admin"){
                if($urole=="student"){
                    header("location: ../admin/student_view.php?sid=$id");
                    ob_end_flush();
                }
                else {
                    header("location: ../admin/employee_profile.php?id=$id");
                    ob_end_flush();
                }

            }else if($role=="teacher"){
                header("location: ../teacher/?page=Home");
                    ob_end_flush();
            }
            }else if($role=="cashier"){
                header("location: ../cashier/?page=Home");
                    ob_end_flush();
            }
            }else if($role=="student"){
                header("location: ../student/?page=Home");
                    ob_end_flush();
            }
            
    		
    	}
    	else{
    		echo "upload error with server! ".$title;
    	}

    }else{
    	$queryUpdate = "update picture set type=?, title=?, dir=? where user_id = ?";
    	$update = $conn->prepare($queryUpdate);
    	$update->execute(array($type,$title,$dir,$sid));
    	if($update){
    		echo "update success! ".$title;
    		if($role=="admin"){
                if($urole=="student"){
                    header("location: ../admin/student_view.php?sid=$id");
                    ob_end_flush();
                }
                else {
                    header("location: ../admin/employee_profile.php?id=$id");
                    ob_end_flush();
                }

            }else if($role=="teacher"){
                header("location: ../teacher/?page=Home");
                    ob_end_flush();
            }
            }else if($role=="cashier"){
                header("location: ../cashier/?page=Home");
                    ob_end_flush();
            }
            }else if($role=="student"){
                header("location: ../student/?page=Home");
                    ob_end_flush();
            }
    	}
    	else{
    		echo "update error with server! ".$title;
    	}
    }
}

sleep(1);
/*
$target_dir = "../lib/img";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}*/
?>