
    <form class="w3-container" action="../app/add_subject.php" method="POST">
    <p>      
        <label class="w3-text-blue"><b>Subject Code</b></label>
        <input class="w3-input w3-border" name="subj_code" type="text" required>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Descriptive Title</b></label>
        <input class="w3-input w3-border" name="subject" type="text" required>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Course</b> <i class="w3-gray"></i></label>
        <select name="course_code" id="courseCode" class="w3-input w3-border" required>
            <option value="">Select Course</option>
    <?php 
        
        $getCourses = "select * from courses";
        $courses = $conn->prepare($getCourses);
        $courses->execute();
        while($courseRow = $courses->fetch(PDO::FETCH_ASSOC)){
            if(!empty($courseRow['major'])){
                ?>
            <option value="<?php echo $courseRow['course_code']; ?>"><?php echo $courseRow['course']." - ".$courseRow['major']; ?></option>

            <?php
            }else{
            ?>
            <option value="<?php echo $courseRow['course_code']; ?>"><?php echo $courseRow['course']; ?></option>

            <?php
        }}
     ?>

        </select>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Year Level</b></label>
        <select name="year_level" id="yl2" class="w3-input w3-border" required>
            <option value="">Select Year Level</option>
            <option value="I">1st Year</option>
            <option value="II">2nd Year</option>
            <option value="III">3rd Year</option>
            <option value="IV">4th Year</option>
        </select>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Semester</b></label>
        <select name="sem" id="sem" class="w3-input w3-border" required>
            <option value="">Select Semester</option>
            <option value="1st Sem">1st Sem</option>
            <option value="2nd Sem">2nd Sem</option>
            <option value="Summer">Summer</option>
            
        </select>
    </p>
    <!--p>      
        <label class="w3-text-blue"><b>Preferred Sem</b></label>
        <select name="sem" id="" class="w3-input w3-border">
            <option value="">Select Year Level</option>
            <option value="1st Sem">1st Semester</option>
            <option value="2nd Sem">2nd Semester</option>
            <option value="Summer">Summer</option>
        </select>
    </p-->
    <p>      
        <label class="w3-text-blue"><b>Subject type</b></label>
        <select name="subject_type" id="subjectType" class="w3-input w3-border" onchange="showOtherUnits()" required>
            <option value="">Select Subject Type</option>
            <option value="Regular">Regular</option>
            <option value="With Lab">With Lab</option>
            <option value="Practicum">Practicum</option>
            <option value="Field Studies">Field Studies</option>
            <option value="OJT">OJT</option>
        </select>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Total Number of Units(Including Lec/Lab/OJT/Practicum/Field Studies) </b></label>
        <select name="units" id="" class="w3-input w3-border" required>
            <option value="">Select Units</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
        </select>
    </p>
    <p id="otherUnits" style="display: none;">      
        <label class="w3-text-blue"><b>Other Units (Lab/OJT/Practicum/Field Studies)</b></label>
        <select name="other_units" id="otherUnitValue" class="w3-input w3-border" required>
            <option value="0" selected>Select Units</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
        </select>
    </p>
    <p>
        <label class="w3-text-blue"><b>Requisite?</b><i class="w3-text-gray"> Please select 'Yes' if this subject will be a pre-requisite for other subjects.</i></label>
        <select name="req" class="w3-input w3-border" required>
            <option value="">Select Answer</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </p>
    <p>
        <label class="w3-text-blue"><b>With Prerequisite?</b></label>
        <select name="withPrereq" id="withPrereq" class="w3-input w3-border" onchange="showPrereq()" required>
            <option value="">Select Answer</option>
            <option value="Yes">Yes</option>
            <option value="No">None</option>
        </select>
    </p>
    <p id="pr" style="display: none">    
        <label class="w3-text-blue"><b>Pre-Requisite Subject</b></label>
        <select name="pre_req" id="prereq" class="w3-input w3-border">  
            <option value="0" selected>Select Subject</option>
        </select>
        
    </p>


    <?php if(!empty($_GET['cid'])){
        $cid = $_GET['cid'];
        ?>
            <input type="hidden" name="cid" value="<?php echo $cid;?>">
        <?php
    } ?>
    <br>
    <p>      
    <button class="w3-btn w3-blue">Add Subject</button></p>
    </form>
    <script type="text/javascript">
        
        function showOtherUnits(){
            var subject_type = document.getElementById("subjectType").value;
            if((subject_type != "") && (subject_type != "Regular")){
                document.getElementById("otherUnits").style.display="block";
            }
            else{
                //document.getElementById('otherUnitValue').value = "0";
            }
        }
        function showPrereq(){
            var withPrereq = document.getElementById('withPrereq').value;
            var courseCode = document.getElementById('courseCode').value;
            console.log(withPrereq+" - "+courseCode);
            if(withPrereq=="Yes"){
                var year = document.getElementById("yl2").value;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {

                        document.getElementById('pr').style.display = "block";
                        if(year==="II"){
                            document.getElementById("prereq").innerHTML = "<option value='2nd Yr Standing'>2nd Yr Standing</option>";
                        }else if(year==="III"){
                            document.getElementById("prereq").innerHTML = "<option value='3rd Yr Standing'>3rd Yr Standing</option>";
                        }else if(year==="IV"){
                            document.getElementById("prereq").innerHTML = "<option value='4th Yr Standing'>4th Yr Standing</option>";
                        }
                        document.getElementById("prereq").innerHTML += this.responseText;
                    }
                };
            xmlhttp.open("GET", "../app/getPrereqSubjects.php?course=" + courseCode, true);
            xmlhttp.send();
            }else{
                document.getElementById('pr').style.display = "none";
                //document.getElementById('prereq').value="0";
            }
            
        }
    </script>

