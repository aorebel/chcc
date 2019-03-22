 function showStudents() {
    var str = document.getElementById("searchStudents").value;
    var tbl = "students";
    if (str == "") {
        document.getElementById("studentsTable").innerHTML = "";
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
                document.getElementById("studentsTable").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","../app/searchStudent.php?q="+str+"&table="+tbl,true);
        xmlhttp.send();

    }
    console.log(str);
}
function showTeacher() {
    var str = document.getElementById("myInput").value;
    var tbl = "employees";
    //var role = "teacher";
    /*if (str == "") {
        document.getElementById("myTable").innerHTML = "";
        return;
    } else { */
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("myTable").innerHTML = this.responseText;
            }
        };
        //xmlhttp.open("GET","../app/searchEmp.php?q="+str+"&table="+tbl+"&role="+role,true);
        xmlhttp.open("GET","../app/searchTeacher.php?q="+str+"&table="+tbl,true);
        xmlhttp.send();
    //}
}
