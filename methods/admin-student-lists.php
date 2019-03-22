<?php 

require('../app/config/connect.php');
function queryStudents($conn){
$sql = "SELECT * FROM students";
$query = $conn->prepare($sql);
$query->execute();
return $query;
}
function getEnrollmentList($conn,$row){
    $student_id = $row['student_id'];
    $get_enrollment = "SELECT * FROM enrollment WHERE student_id=? order by school_year DESC limit 1";
    $enrollment_query = $conn->prepare($get_enrollment);
    $enrollment_query->execute(array($student_id));
    $list = $enrollment_query->fetch(PDO::FETCH_ASSOC);
    return $list;
}
function showStudentsListTable($conn){
    ?>
    <table class="w3-table-all w3-margin-top list" id="studentsTable">
        
            <tr>
                <th style="width:15%;">Student ID</th>
                <th style="width:25%;">Name</th>
                <th style="width:25%;">Course</th>
                <th style="width:10%;">Year Level</th>
                <th style="width:15%;">Status</th>            
                <th style="width:10%;">Action</th>
            </tr>
    <?php
        $query = queryStudents($conn);
        $count=0;
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $row2 = getEnrollmentList($conn,$row);
            $count++;
    ?>
            <tr class="name">
            <td><?php echo $row['student_id']; ?></td>
            <td><?php echo strtoupper($row['fname'])." ".strtoupper($row['mi'])." ".strtoupper($row['lname']); ?></td>
            <td><?php echo $row2['course_code']; ?></td>
            <td><?php echo $row2['year_level']; ?></td>
            <td><?php echo $row2['status']; ?></td>
            <td>
                <form method="get" action="../app/student_view.php">
                    <input type="hidden" name="sid" value="<?php echo $row['id']?>">
                    <button type="submit" class="w3-button"><i class="fa fa-eye"></i></button>
                </form>
            </td>
            </tr>
    <?php } ?>
        </table>
<?php
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    
    <style>
        * {
        margin: 0;
        padding: 0;
        }

        body {
        background-color: #fafafa;
        }

        tr:hover:not(th) {background-color: rgba(237,28,64,.1);}


        input[type="button"] {
            transition: all .3s;
            border: 1px solid #ddd;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 15px;
        }

        input[type="button"]:not(.active) {
            background-color:transparent;
        }

        .active {
            background-color: lightgrey;
            color :#fff;
        }

        input[type="button"]:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
</head>
<!--//////======/pagination code derived from http://listjs.com/examples/pagination/====//////-->
<body>
    <div id="test-list">
    <input class="w3-input w3-border w3-padding" type="text" placeholder="Search for Student ID or Last Name" id="searchStudents" onkeyup="showStudents()">
     <?php showStudentsListTable($conn); ?>
        
    </div>

    <script src="../lib/js/students.js"></script>
</body>
</html>
