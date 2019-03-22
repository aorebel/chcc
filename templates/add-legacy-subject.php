
<!--form class="w3-container" action="../app/add_class.php" method="POST"-->
<?php require_once('../app/config/connect.php'); ?>

<div class="w3-col s12 m6 w3-padding">      
    <label class="w3-text-blue"><b>School Year Start</b></label>
    <select name="sy" id="syL" class="w3-input w3-border" required>
        <option value="">Select Start of School Year</option>
        <?php 
            for($i=2015; $i<2099; $i++){
                ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php
            }
        ?>
    </select>
</div> 
<div class="w3-col s12 m6 w3-padding">      
    <label class="w3-text-blue"><b>Semester</b></label>
    <select name="sem" id="semL" class="w3-input w3-border" required>
        <option value="">Select Semester</option>
        <option value="1st Sem">1st Semester</option>            
        <option value="2nd Sem">2nd Semester</option>
        <option value="Summer">Summer</option>

    </select>
</div>
<div class="w3-col s12 m6 w3-padding">      
    <label class="w3-text-blue"><b>Course</b> <i class="w3-gray"></i></label>
    <select name="course" id="courseCodeL" class="w3-input w3-border" required>
        <option value="">Select Course</option>
<?php 
    
    $getCoursesL = "select * from courses";
    $coursesL = $conn->prepare($getCoursesL);
    $coursesL->execute();
    while($courseLRow = $coursesL->fetch(PDO::FETCH_ASSOC)){
        if(!empty($courseLRow['major'])){
            ?>
        <option value="<?php echo $courseLRow['course_code']; ?>"><?php echo $courseLRow['course']." - ".$courseLRow['major']; ?></option>

        <?php
        }else{
        ?>
        <option value="<?php echo $courseLRow['course_code']; ?>"><?php echo $courseLRow['course']; ?></option>

        <?php
    }}
 ?>

    </select>
</div>
<div class="w3-col s12 m6 w3-padding">      
    <label class="w3-text-blue"><b>Year Level</b></label>
    <select name="yr" id="yearLevel" class="w3-input w3-border" requried>
        <option value="">Select Year Level</option>
        <option value="I">1st Year</option>
        <option value="II">2nd Year</option>
        <option value="III">3rd Year</option>
        <option value="IV">4th Year</option>
    </select>
</div>
<div class="w3-col s12 m12 w3-padding">      
    <label class="w3-text-blue"><b>Subject</b> <i class="w3-gray"></i></label>
    <select name="subject" id="getSubjects" onkeyup="searchSubjects()" class="w3-input w3-border" required>
        <option value="">Select Subject</option>
<?php 
    
    $getSubjects = "select * from subjects";
    $subjects = $conn->prepare($getSubjects);
    $subjects->execute();
    while($subjectRow = $subjects->fetch(PDO::FETCH_ASSOC)){
        
        ?>
        <option value="<?php echo $subjectRow['id']; ?>"><?php echo $subjectRow['subject']; ?></option>

        <?php
    }
 ?>

    </select>
</div>
<div class="w3-col s12 s6 w3-padding">
    <label for="" class="w3-text-blue"><b>Midterms Grade</b></label>
    <input type="number" name="mid" id="midterms" class="w3-input w3-border" >
</div>
<div class="w3-col s12 s6 w3-padding">
    <label for="" class="w3-text-blue"><b>Finals Grade</b></label>
    <input type="number" name="fin" id="finals" class="w3-input w3-border" >
</div>
<p>
    <input type="hidden" name="sid" id="studID" >
    <button class="w3-input w3-blue" onclick="addLegacySubject()" >Add Subject with Grade</button>
</p>
<p id="addLegRes"></p>

<script>
    function addLegacySubject(){
        var sid = document.getElementById('studID').value;
        var yr = document.getElementById('yearLevel').value;
        var sy = document.getElementById('syL').value;
        var sem = document.getElementById('semL').value;
        var course = document.getElementById('courseCodeL').value;
        var subject = document.getElementById('getSubjects').value;
        var mid = document.getElementById('midterms').value;
        var fin = document.getElementById('finals').value
        //console.log(sid);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                
                    //var x = JSON.parse(res);
                    //document.getElementById(yr+'_'+sy+'_'+sem).innerHTML=+res;
                    document.getElementById('addLegRes').innerHTML+=res+"<br> Refresh page to update page!";
                
            }

        };
        xmlhttp.open("POST", "../app/add_legacy_subject.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("sid="+sid+"&yr="+yr+"&sy="+sy+"&sem="+sem+"&course="+course+"&subject="+subject+"&mid="+mid+"&fin="+fin);
    }
    function searchSubjects(){}
</script>
