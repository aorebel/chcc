<script type='text/javascript'>

(function()
{
  if( window.localStorage )
  {
    if( !localStorage.getItem('firstLoad') )
    {
      localStorage['firstLoad'] = true;
      window.location.reload();
    }  
    else
      localStorage.removeItem('firstLoad');
  }
})();

</script>

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
                    echo "<div style='display: block; position: inline; font-size: .8em; width: 100%; word-wrap: break-word !important; white-space: normal; text-align:center;'><b >".strtoupper($courseRow['course'])."</b></div><br/>";
                    echo "<i>".$courseRow['major']." Major</i>";     
                }
                else{
                    echo "<div style='display: block; position: inline; font-size: .8em; width: 100%; word-wrap: break-word !important; white-space: normal; text-align:center;'><b style='word-wrap: break-word; text-align:center;'>".strtoupper($courseRow['course'])."</b></div>";
                }
                
            ?>
        </button>
        <?php        
    }        

?>
<button class="w3-button w3-center  w3-blue w3-card-4" style="width: 17.5%; height: 100px; margin: 10px;" onclick="showStudentModal('0');" name="<?php echo $courseRow['id'] ?>"><b>UNCONFIRMED<br>STUDENTS</b></button>  
<div class="w3-container" id="AddStudentModal">
    <div class="w3-col s12 m2">        
        <button onclick="openAddStudentForm()" class="w3-button w3-yellow" style="width: 95% !important;">
        Add Student
        </button>
    </div>
    <div class="w3-col s12 m10">
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
    xmlhttp.open("get", "../methods/showStudentByCourse.php?cid="+cid,true);
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
        xmlhttp.open("GET","../app/searchStudent.php?q="+str+"&table="+tbl,true);
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
    

function printStudentList(){
    var printContents = document.getElementById('studentsLits').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();
    //document.body.innerHTML = printContents;
    document.body.innerHTML = originalContents;
}

</script>
