

<?php 
    require_once('../app/config/connect.php');
    $getCourses = "select * from courses";
    $courses = $conn->prepare($getCourses);
    $courses->execute();

    while($courseRow = $courses->fetch(PDO::FETCH_ASSOC)){
        ?>
        <button class="w3-button w3-center  w3-blue w3-card-4" style="width: 17.5%; height: 100px; margin: 10px;" onclick="showStudentModal(<?php echo $courseRow['id'] ?>);" name="<?php echo $courseRow['id'] ?>">
            <?php 
                if(!empty($courseRow['major'])){
                    echo "<b>BSED</b><br/>";
                    echo "<i>".$courseRow['major']." Major</i>";     
                }
                else{
                    echo "<b>".strtoupper($courseRow['course_code'])."</b>";
                }
                
            ?>
        </button>
        <?php        
    }        

?>
<button class="w3-button w3-center  w3-blue w3-card-4" style="width: 17.5%; height: 100px; margin: 10px;" onclick="showStudentModal('0');" name="<?php echo $courseRow['id'] ?>"><b>UNCONFIRMED<br>STUDENTS</b></button>  
<div class="w3-container" id="AddStudentModal">
    
    <div class="w3-col s12 m12">
        <input class="w3-input w3-border w3-padding" type="text" placeholder="Search for Student ID or Last Name" id="searchStudents" onkeyup="showStudents()">
    </div>
    <div class="w3-container">
        <table id="studentsTable"></table>
    </div>

    <div id="addStudent" class="w3-modal" >
        <div class="w3-modal-content w3-animate-top w3-card-4" style="margin-bottom: 25px; padding-bottom: 25px;">
        <header class="w3-container w3-teal"> 
            <span onclick="document.getElementById('addStudent').style.display='none'" 
            class="w3-button w3-display-topright">&times;</span>
            <h2>ADD STUDENT</h2>
        </header>
        <div class="w3-container">
            <?php require_once("../templates/add-student.php"); ?>
        </div>
        </div>
    </div>
</div>
<div id="showStudentByCourseModal" class="w3-modal" >
    <div class="w3-modal-content" style="width: 85% !important; ">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('showStudentByCourseModal').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h5>View Students</h5>
      </header>
      <div class="w3-container w3-padding" id="contentStudentByContent" style="height: 500px; overflow-y: auto;">
        <?php //require_once('../methods/showStudentByCourse.php'); ?>
      </div>
    </div>
    <br>
</div>
<div id="showStudentAccount" class="w3-modal" >
    <div class="w3-modal-content" style="width: 85% !important; ">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('showStudentAccount').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h5>View Student's Account</h5>
      </header>
      <div class="w3-container w3-padding" id="contentStudentAccount" style="height: 500px; overflow-y: auto;">
        <?php //require_once('../methods/showStudentByCourse.php'); ?>
      </div>
      <footer class="w3-container w3-teal">
        <p></p>
      </footer>
    </div>
    <br>
</div>
<br>
<div class="w3-container">
    
</div>

<script>
function showStudentModal(cid) {
    //var id = document.getElementById("courseID").value;
    var cid = cid;
    
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("contentStudentByContent").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("get", "showStudentsByCourse.php?cid="+cid,true);
    xmlhttp.send();
    //
    document.getElementById("showStudentByCourseModal").style.display = "block";
    
     
    console.log(cid);
}
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
        xmlhttp.open("GET","searchStudents.php?q="+str+"&table="+tbl,true);
        xmlhttp.send();

        }
    console.log(str);
}
function openYearLevel(evt, yearLevelName) {
  var i, x, yearlevellinks;
  x = document.getElementsByClassName("yearLevel");
  for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
  }
  yearlevellinks = document.getElementsByClassName("yearlevellink");
  for (i = 0; i < x.length; i++) {
      yearlevellinks[i].className = yearlevellinks[i].className.replace(" w3-red", "");
  }
  document.getElementById(yearLevelName).style.display = "block";
  evt.currentTarget.className += " w3-red";
}
function openAddStudentForm(){
    document.getElementById('addStudent').style.display='block';
}
    
/*
function printStudentList(){
    var printContents = document.getElementById('studentsLits').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();
    //document.body.innerHTML = printContents;
    document.body.innerHTML = originalContents;
}*/
function showStudentAccount(id){
    document.getElementById("showStudentAccount").style.display = 'block';

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("contentStudentAccount").innerHTML = this.responseText;
      }
    };
    xhttp.open("POST", "student_account.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("sid="+id);
}
function confirmPay(id,ref){
    var pass = document.getElementById("penpass").value;
    //alert("Are you sure you want to confirm this transaction from "+id+" ?");
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        //console.log(this.responseText);
        
        //if(this.responseText.includes("success")){
            alert("You've successfully confirmed Payment"+this.responseText);    
            window.location.href = 'success.php?ref='+ref;
        //}
      }
    };
    xhttp.open("POST", "../app/confirm_pay.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("sid="+id+"&ref="+ref+"&pass="+pass);
}
function postPay(id,assID){
    var pass = document.getElementById("duepass").value;
    var due = document.getElementById("duepay").innerHTML;
    var desc = document.getElementById("duedesc").value;
    var pay = document.getElementById("dueamount").value;
    var comment = document.getElementById("dueComment").value;
    //console.log(ref);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        //alert(this.responseText);

        //if(this.responseText.includes("success")){
            //alert(this.responseText);
            window.location.href = "success.php?ref="+this.responseText;
        //}
      }
    };
    xhttp.open("POST", "../app/post_pay.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("sid="+id+"&assID="+assID+"&pass="+pass+"&due="+due+"&desc="+desc+"&amount="+pay+"&comment="+comment);
}
</script>
