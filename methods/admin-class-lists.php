<?php 

require('../app/config/connect.php');


$sql = "SELECT * FROM classes";
$query = $conn->prepare($sql);
$query->execute();

//$count = $query->rowCount();


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
    <input class="w3-input w3-border w3-padding" type="text" placeholder="Search for names.." id="searchClass" onkeyup="myFunction()">
     
        <table class="w3-table-all w3-margin-top list" id="classTable">
        
            <tr>
            <th style="width:10%;">Class Code</th>
            <th style="width:10%;">Course Code</th>
            <th style="width:10%;">Subject Code</th>
            <th style="width:20%;">Subject</th>
            <th style="width:10%;">Days</th>
            <th style="width:10%;">Time</th>
            <th style="width:10%;">Section Code</th>
            <th style="width:5%;">Slots Required</th>
            <th style="width:5%;">Slots Available</th>
            <th style="width:10%;">School Year</th>
            <th style="width:10%;">Sem</th>
            </tr>
        <?php
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $subject_id = $row['subject_code'];
                $get_subject = "SELECT * FROM subjects WHERE subject_code=?";
                $subject_query = $conn->prepare($get_subject);
                $subject_query->execute(array($subject_id));
                $row2 = $subject_query->fetch(PDO::FETCH_ASSOC)
        ?>
            <tr class="name">
            <td><?php echo $row['class_code']; ?></td>
            <td><?php echo $row2['course_code']; ?></td>
            <td><?php echo $row['subject_code']; ?></td>
            <td><?php echo strtoupper($row2['subject']) ?></td>
            <td><?php echo $row['sched_day']; ?></td>
            <td><?php echo $row['sched_time_start']." - ".$row['sched_time_end']; ?></td>
            <td><?php echo $row['section_code']; ?></td>
            <td><?php echo $row['slot_req']; ?></td>
            <td><?php echo $row['slot_avail']; ?></td>
            <td><?php echo $row['school_year']; ?></td>
            <td><?php echo $row['sem']; ?></td>
            
            </tr>
        <?php } ?>
        </table>
    </div>
    <script>
        
        function myFunction() {
            var input, filter, table, tr, td, i;
            input = document.getElementById("searchClass");
            filter = input.value.toUpperCase();
            table = document.getElementById("cassTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0,1,2,3,4,5];
                if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }
            }
        }
        
    </script>
    <script src="../lib/js/students.js"></script>
</body>
</html>