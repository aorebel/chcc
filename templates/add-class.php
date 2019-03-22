
    <!--form class="w3-container" action="../app/add_class.php" method="POST"-->
    <div id="showSectionClasses">
        <table id="classTable" class="w3-table w3-border">


        </table>
    </div>
    <div class="w3-col s12 m4 ">   
        <p>      
            <label class="w3-text-blue"><b>School Year Start</b></label>
            <select name="sy" id="sy" class="w3-input w3-border" style="width: 95% !important" require>
                <option value="">Select Start of School Year</option>
                <?php 
                    for($i=2015; $i<2099; $i++){
                        ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php
                    }
                ?>
            </select>
        </p> 

    </div>
    <div class="w3-col s12 m4">  
        <p>      
            <label class="w3-text-blue"><b>Semester</b></label>
            <select name="sem" id="sem" class="w3-input w3-border" style="width: 95% !important;" required>
                <option value="">Select Semester</option>
                <option value="1st Sem">1st Semester</option>            
                <option value="2nd Sem">2nd Semester</option>
                <option value="Summer">Summer</option>

            </select>
        </p>
    </div> 
    <div class="w3-col s12 m4">  
        <p>    
            <label class="w3-text-blue"><b>Section</b></label>
            <select name="section_code" id="sectionCodeForAddClass" class="w3-input w3-border" onchange="showSubjectsByCourseLevel(this.value)" required>
                <option value="">Select Section</option>
        <?php 
            
            $getSections = "select * from sections";
            $sections = $conn->prepare($getSections);
            $sections->execute();
            while($sectionRow = $sections->fetch(PDO::FETCH_ASSOC)){
                ?>
                <option value="<?php echo $sectionRow['section_code']; ?>"><?php echo $sectionRow['section']; ?></option>

                <?php
            }
         ?>

            </select>
        </p>
    </div>
    <p>      
        <label class="w3-text-blue"><b>Subject</b></label>
        <select name="subject_code" id="subjectBySection" class="w3-input w3-border" onchange="showSchedule()" required> 

        </select>
    </p>
    <h3 style="text-align: center;">Schedule</h3>
    <p>      
        <label class="w3-text-blue"><b>Schedule Days</b></label><br>
        <input class="w3-check" type="checkbox" name="day[]" id="day1" value="M">
        <label>Monday</label>
        <input class="w3-check" type="checkbox" name="day[]" id="day2" value="T">
        <label>Tuesday</label>
        <input class="w3-check" type="checkbox" name="day[]" id="day3" value="W">
        <label>Wednesday</label>
        <input class="w3-check" type="checkbox" name="day[]" id="day4" value="Th">
        <label>Thursday</label>
        <input class="w3-check" type="checkbox" name="day[]" id="day5" value="F">
        <label>Friday</label>
        <input class="w3-check" type="checkbox" name="day[]" id="day6" value="Sat">
        <label>Saturday</label>
    </p>
    <div class="w3-col s12 m4">
        
        <p>      
            <label class="w3-text-blue"><b>Schedule Time Start</b></label>
            <select name="timeStart" id="timeStart" onchange="showEndTime(this.value,'reg')" class="w3-input w3-border" style="with: 95% !important;" required>
                <option value="">Select Start Time</option>
                <?php
                    $range=range(strtotime("07:00"),strtotime("20:00"),15*60);
                    foreach($range as $time){
                           ?>
                            <option value="<?php echo date("H:i",$time); ?>"><?php echo date("H:i",$time); ?></option>
                           <?php
                    }
                ?>
            </select>
        </p>
    </div>
    <div class="w3-col s12 m4">
        <p>      
            <label class="w3-text-blue"><b>Schedule Time End</b></label>
            <select name="timeEnd" id="timeEnd" class="w3-input w3-border" style="with: 95% !important;" required>
                
            </select>
        </p>
    </div>
    <div class="w3-col s12 m4">
        <p>      
            <label class="w3-text-blue"><b>Room Code</b></label>
            <input type="text"  name="roomCode" id="roomCode" class="w3-input w3-border" required>
                
        </p>
    </div>
    <div id="labSched" style="display: none;">
        <hr>
        <input type="hidden" name="withLab" id="withLab">
        <h3  style="text-align: center;">Lab Schedule</h3>
        <p>      
            <label class="w3-text-blue"><b>Schedule Days</b></label><br>
            <div class="w3-col s12 m2">
                <input class="w3-check" type="checkbox" name="labDay[]" id="labDay1" value="M">
                <label>Monday</label>
            </div>
            <div class="w3-col s12 m2">
                <input class="w3-check" type="checkbox" name="labDay[]" id="labDay2" value="T">
                <label>Tuesday</label>
            </div>
            <div class="w3-col s12 m2">
                <input class="w3-check" type="checkbox" name="labDay[]" id="labDay3" value="W">
                <label>Wednesday</label>
            </div>
            <div class="w3-col s12 m2">
                <input class="w3-check" type="checkbox" name="labDay[]" id="labDay4" value="Th">
                <label>Thursday</label>
            </div>
            <div class="w3-col s12 m2">
                <input class="w3-check" type="checkbox" name="labDay[]" id="labDay5" value="F">
                <label>Friday</label>
            </div>
            <div class="w3-col s12 m2">
                <input class="w3-check" type="checkbox" name="labDay[]" id="labDay6" value="Sat">
                <label>Saturday</label>
            </div>
        </p>
        <div class="w3-col s12 m4">
        <p>      
            <label class="w3-text-blue"><b>Schedule Time Start</b></label>
            <select name="timeStartLab" id="timeStartLab" onchange="showEndTime(this.value,'lab')" class="w3-input w3-border" style="width: 95% !important;" required>
                <option value="">Select Start Time</option>
                <?php
                    $range=range(strtotime("07:00"),strtotime("20:00"),15*60);
                    foreach($range as $time){
                       ?>
                        <option value="<?php echo date("H:i",$time); ?>"><?php echo date("H:i",$time); ?></option>
                       <?php
                    }
                ?>
            </select>
        </p>
    </div>
    <div class="w3-col s12 m4">
        <p>      
            <label class="w3-text-blue"><b>Schedule Time End</b></label>
            <select name="timeEndLab" id="timeEndLab" class="w3-input w3-border" style="width: 95% !important" required>
                

            </select>
        </p>
    </div>
        <div class="w3-col s12 m4">
        <p>      
            <label class="w3-text-blue"><b>Room Code</b></label>
            <input type="text" name="roomCodeLab" id="roomCodeLab" class="w3-input w3-border" required>
        </p>
    </div>
    </div>
    
    
    <br>
    <p>      
    <button class="w3-btn w3-blue" style="margin-top: 10px;" onclick="addSubject()">Add Class</button></p>
    <!--/form-->
    <script>
        function showSubjectsByCourseLevel(str){
            console.log(str);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("subjectBySection").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "../app/getSubjectsByCourseLevel.php?section=" + str, true);
            xmlhttp.send();
          
        }
        function showSchedule(){
            var subject = document.getElementById('subjectBySection').value;
            //subject = subject.replace(/\s+/g, '-')
            console.log(subject);

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var result = this.responseText;
                    if(result=="true"){
                        document.getElementById('labSched').style.display="block";
                        document.getElementById('withLab').value="Yes";
                    }
                    else{
                        document.getElementById('labSched').style.display="none";   
                        document.getElementById('withLab').value="No";
                    }
                    console.log(document.getElementById('withLab').value);
                }
            };
            xmlhttp.open("GET", "../app/getSubjectType.php?subject="+subject, true);
            xmlhttp.send();
        }

        function showEndTime(start, type){
            var str = start.split(":").join("-");
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var result = this.responseText;
                    if(type=="reg"){
                        document.getElementById('timeEnd').innerHTML = this.responseText;                  

                    }
                    else{
                        document.getElementById('timeEndLab').innerHTML = this.responseText;                      
                    }
                }
            };
            xmlhttp.open("GET", "../app/getTimeEnd.php?start="+str, true);
            xmlhttp.send();
            console.log(str);
        }

        function addSubject(){
          
            //var day= "";
            var withLab = document.getElementById('withLab').value;
            var days = [];            
            if(document.getElementById('day1').checked){ 
                days.push(document.getElementById('day1').value);
            }
            if(document.getElementById('day2').checked){ 
                days.push(document.getElementById('day2').value);
            }
            if(document.getElementById('day3').checked){ 
                days.push(document.getElementById('day3').value);
            }
            if(document.getElementById('day4').checked){ 
                days.push(document.getElementById('day4').value);
            }
            if(document.getElementById('day5').checked){ 
                days.push(document.getElementById('day5').value);
            }
            if(document.getElementById('day6').checked){ 
                days.push(document.getElementById('day6').value);
            }
            var notLab = days.join('-');
            
            var labDays = [];  
            var lab = "";          
            if(document.getElementById('labDay1').checked){ 
                labDays.push(document.getElementById('labDay1').value);
            }
            if(document.getElementById('labDay2').checked){ 
                labDays.push(document.getElementById('labDay2').value);
            }
            if(document.getElementById('labDay3').checked){ 
                labDays.push(document.getElementById('labDay3').value);
            }
            if(document.getElementById('labDay4').checked){ 
                labDays.push(document.getElementById('labDay4').value);
            }
            if(document.getElementById('labDay5').checked){ 
                labDays.push(document.getElementById('dlabDay5').value);
            }
            if(document.getElementById('labDay6').checked){ 
                labDays.push(document.getElementById('labDay6').value);
            }
            lab = labDays.join('-');
            var sy = document.getElementById('sy').value;

            
            var sem = document.getElementById('sem').value;
            
            var section = document.getElementById('sectionCodeForAddClass').value;
            var subject = document.getElementById('subjectBySection').value;
   
            var timeStart = document.getElementById('timeStart').value;
            var timeEnd = document.getElementById('timeEnd').value;
            var roomCode = document.getElementById('roomCode').value;

            var timeStartLab = "";
            var timeEndLab = "";
            var roomCodeLab = "";

            //console.log(notLab+"|"+lab+"|"+sy+"|"+sem+"|"+section+"|"+subject);
            /*
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var result = this.responseText;
                    if(result=="true"){
                        document.getElementById('labSched').style.display="block";
                        document.getElementById('withLab').value="Yes";
                    }
                    else{
                        document.getElementById('labSched').style.display="none";   
                        document.getElementById('withLab').value="No";
                    }
                }
            };
            xmlhttp.open("GET", "../app/add_class.php?subject="+subject, true);
            xmlhttp.send();*/
            if(withLab=="Yes"){

                timeStartLab = document.getElementById('timeStartLab').value;
                timeEndLab = document.getElementById('timeEndLab').value;
                roomCodeLab = document.getElementById('roomCodeLab').value;
                if ((days!="") && (labDays!="")) {
                }
            }
            else{
                if (days!="") {

                }
                else{
                    alert("Please select day/s!");
                }
            }
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  //document.getElementById("demo").innerHTML = this.responseText;
                  console.log(this.responseText);
                }
            };
            xhttp.open("POST", "../app/add_class.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("days="+notLab+"&sy="+sy+"&sem="+sem+"&section="+section+"&subject="+subject+"&timeStart="+timeStart+"&timeEnd="+timeEnd+"&roomCode="+roomCode+"&timeStartLab="+timeStartLab+"&timeEndLab="+timeEndLab+"&roomCodeLab="+roomCodeLab+"&withLab="+withLab+"&lab="+lab);
            //xhttp.send("days="+notLab+"&labDays="+lab+"&sy="+sy+"&sem="+sem+"&section="+section+"&subject="+subject+"&timeStart="+timeStart+"&timeEnd="+timeEnd="&roomCode="+roomCode+"&timeStartLab="+timeStartLab+"&timeEndLab="+timeEndLab+"&roomCodeLab="+roomCodeLab+"&withLab="+withLab, true);

        }

    </script>
