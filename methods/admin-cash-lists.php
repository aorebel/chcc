<?php 

require('../app/config/connect.php');

$role = "cashier";
$sql = "SELECT * FROM employees WHERE role=?";
$query = $conn->prepare($sql);
$query->execute(array($role));

$count = $query->rowCount();


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
    <input class="w3-input w3-border w3-padding" type="text" placeholder="Search for Employee ID or Last Name" id="myInput2" onkeyup="showCash()">
     
        <table class="w3-table-all w3-margin-top list" id="myTable2">
        
            <tr>
            <th style="width:30%;">Employee ID</th>
            <th style="width:30%;">Name</th>
            <th style="width:20%;">Hire Date</th>
            <th style="width:15%;">Status</th>
            <th style="width:5%;">Action</th>
            </tr>
        <?php
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
        ?>
            <tr class="name">
            <td><?php echo $row['emp_id']; ?></td>
            <td><?php echo strtoupper($row['fname'])." ".strtoupper($row['mi'])." ".strtoupper($row['lname']); ?></td>
            <td><?php echo $row['hire_date']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <form method="get" action="employee_view.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']?>">
                    <input type="hidden" name="role" value="<?php echo $row['role']?>">
                    <input type="hidden" name="tab" value="Profile">
                    <button type="submit" class="w3-button"><i class="fa fa-eye"></i></button>
                </form>
            </td>
            </tr>
        <?php } ?>
        </table>
    </div>

    <script >
        function showCash() {
            var str = document.getElementById("myInput2").value;
            //var tbl = "employees";
            if (str == "") {
                document.getElementById("myTable2").innerHTML = "";
                return;
            } else { 
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("myTable2").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET","../app/searchCashier.php?q="+str,true);
                xmlhttp.send();

            }
            console.log(str);
        }
    </script>
</body>
</html>