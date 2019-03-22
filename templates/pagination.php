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
<!--//////======/pagination code derived from https://codepen.io/bastony/post/tablesortingtutorial-js ====//////-->
<body>
    <div id="test-list">
    <input class="w3-input w3-border w3-padding" type="text" placeholder="Search for names.." id="myInput" onkeyup="myFunction()">
     
        <table class="w3-table-all w3-margin-top list" id="myTable">
            <tr>
            <th style="width:60%;">Name</th>
            <th style="width:40%;">Country</th>
            </tr>
            <tr class="name">
            <td>Alfreds Futterkiste</td>
            <td>Germany</td>
            </tr>
            <tr class="name">
            <td>Berglunds snabbkop</td>
            <td>Sweden</td>
            </tr>
            <tr class="name">
            <td>Island Trading</td>
            <td>UK</td>
            </tr>
            <tr class="name">
            <td>Koniglich Essen</td>
            <td>Germany</td>
            </tr>
            <tr class="name">
            <td>Laughing Bacchus Winecellars</td>
            <td>Canada</td>
            </tr>
            <tr class="name">
            <td>Magazzini Alimentari Riuniti</td>
            <td>Italy</td>
            </tr>
            <tr class="name">
            <td>North/South</td>
            <td>UK</td>
            </tr>
            <tr class="name">
            <td>Paris specialites</td>
            <td>France</td>
            </tr>
        </table>
    </div>
    <script>
        
        function myFunction() {
            var input, filter, table, tr, td, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0,1];
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
    <script src="../lib/js/pagenation.js"></script>
</body>
</html>