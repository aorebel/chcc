
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="id" id="">
        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
if(isset($_POST['id'])){
$id = $_POST['id'];
require("config/connect.php");
$stmt = "select * from faculty where id=?";
$sql = $conn->prepare($stmt);
$sql->execute(array($id));
if($sql->rowCount()>0){
    while($rows = $sql->fetch(PDO::FETCH_ASSOC)){
        echo $rows['emp_id'];
    }
}
}
?>