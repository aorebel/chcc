
<div class="w3-container">
    <button onclick="document.getElementById('addSubject').style.display='block'" class="w3-button w3-yellow">
        Add Subject
    </button>
    <!--button onclick="document.getElementById('addClass').style.display='block'" class="w3-button w3-yellow">
        Add Class
    </button-->
    <!--button onclick="document.getElementById('addSection').style.display='block'" class="w3-button w3-yellow">
        Add Section
    </button-->
    <button onclick="document.getElementById('addCourse').style.display='block'" class="w3-button w3-yellow">
        Add Course
    </button>
</div><br>
<?php 
    //require_once('../app/config/connect.php');
    $getCourses = "select * from courses";
    $courses = $conn->prepare($getCourses);
    $courses->execute();

    while($courseRow = $courses->fetch(PDO::FETCH_ASSOC)){
        ?>
        <button class="w3-button w3-center  w3-blue w3-card-4" style="width: 17.5%; height: 150px; margin: 10px; word-wrap: break-word;" onclick="showCourseModal(<?php echo $courseRow['id'] ?>);" name="<?php //echo $courseRow['id'] ?>">
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

<div class="w3-container" id="AddTeacherModal">
    
    <div id="addSubject" class="w3-modal" >
        <div class="w3-modal-content w3-animate-top w3-card-4 add-academics" style="">
        <header class="w3-container w3-teal"> 
            <span onclick="document.getElementById('addSubject').style.display='none'" 
            class="w3-button w3-display-topright">&times;</span>
            <h4>ADD SUBJECT</h4>
        </header>
        <div class="w3-container">
            <?php require_once("../templates/add-subject.php"); ?>
        </div>
        <!--footer class="w3-container w3-teal">
            <p>Modal Footer</p>
        </footer-->
        </div>
    </div>
    <div id="addClass" class="w3-modal" >
        <div class="w3-modal-content w3-animate-top w3-card-4 add-academics">
        <header class="w3-container w3-teal"> 
            <span onclick="document.getElementById('addClass').style.display='none'" 
            class="w3-button w3-display-topright">&times;</span>
            <h4>ADD CLASS</h4>
        </header>
        <div class="w3-container">
            <?php require_once("../templates/add-class.php"); ?>
        </div>
        <!--footer class="w3-container w3-teal">
            <p>Modal Footer</p>
        </footer-->
        </div>
    </div>
    <div id="addSection" class="w3-modal" >
        <div class="w3-modal-content w3-animate-top w3-card-4 add-academics">
        <header class="w3-container w3-teal"> 
            <span onclick="document.getElementById('addSection').style.display='none'" 
            class="w3-button w3-display-topright">&times;</span>
            <h4>ADD SECTION</h4>
        </header>
        <div class="w3-container">
            <?php require_once("../templates/add-section.php"); ?>
        </div>
        <!--footer class="w3-container w3-teal">
            <p>Modal Footer</p>
        </footer-->
        </div>
    </div>
    <div id="addCourse" class="w3-modal" >
        <div class="w3-modal-content w3-animate-top w3-card-4 add-academics">
        <header class="w3-container w3-teal"> 
            <span onclick="document.getElementById('addCourse').style.display='none'" 
            class="w3-button w3-display-topright">&times;</span>
            <h4>ADD COURSE</h4>
        </header>
        <div class="w3-container">
            <?php require_once("../templates/add-course.php"); ?>
        </div>
        <!--footer class="w3-container w3-teal">
            <p>Modal Footer</p>
        </footer-->
        </div>
    </div>
</div>


<div id="showCourseModal" class="w3-modal" >
    <div class="w3-modal-content" style="position: absolute; width: 100% !important; height: 100% !important; top: 0 !important;">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('showCourseModal').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h5>View Course</h5>
      </header>
      <div class="" id="contentByCourse">
        <?php //require_once('../methods/showStudentByCourse.php'); ?>
      </div>
      <footer class="w3-container w3-teal">
        <p></p>
      </footer>
    </div>
    <br>
  </div>
<br>
<br>
<script>
    function showCourseModal(cid) {
        //var id = document.getElementById("courseID").value;
        var cid = cid;
        /*
        
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("contentByCourse").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("get", "../methods/showContentByCourse.php?cid="+cid,true);
        xmlhttp.send();
        //
        document.getElementById("showCourseModal").style.display = "block";
        
         */
         
        console.log(cid);

        window.location.href = "showContentByCourse.php?cid="+cid+"&tab=Section";
    }
    /*
    function openCourseTab(evt, courseTabName) {
      var i, x, CourseTabLinks;
      x = document.getElementsByClassName("courseTab");
      for (i = 0; i < x.length; i++) {
         x[i].style.display = "none";
      }
      courseTabLinks = document.getElementsByClassName("courseTabLink");
      for (i = 0; i < x.length; i++) {
          courseTabLinks[i].className = courseTabLinks[i].className.replace(" w3-red", ""); 
      }
      document.getElementById(courseTabName).style.display = "block";
      evt.currentTarget.className += " w3-red";
    }


    function openSectionTab(evt, sectionTabName) {
    var i, x, sectionTabLinks;
    x = document.getElementsByClassName("sectionTab");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    sectionTabLinks = document.getElementsByClassName("sectionTabLink");
    for (i = 0; i < x.length; i++) {
        sectionTabLinks[i].className = sectionTabLinks[i].className.replace(" w3-red", "");
    }
    document.getElementById(sectionTabName).style.display = "block";
    evt.currentTarget.className += " w3-red";
  }
    function openClassTab(evt, classTabName) {
    var i, x, classTabLinks;
    x = document.getElementsByClassName("classTab");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    classTabLinks = document.getElementsByClassName("classTabLink");
    for (i = 0; i < x.length; i++) {
        classTabLinks[i].className = classTabLinks[i].className.replace(" w3-red", "");
    }
    document.getElementById(classTabName).style.display = "block";
    evt.currentTarget.className += " w3-red";
  }
    function openSubjectTab(evt, subjectTabName) {
    var i, x, classTabLinks;
    x = document.getElementsByClassName("subjectTab");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    subjectTabLinks = document.getElementsByClassName("subjectTabLink");
    for (i = 0; i < x.length; i++) {
        subjectTabLinks[i].className = subjectTabLinks[i].className.replace(" w3-red", "");
    }
    document.getElementById(subjectTabName).style.display = "block";
    evt.currentTarget.className += " w3-red";
  }
  */

</script>