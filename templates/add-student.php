
    <!--form class="w3-container" action="../app/add_student.php" method="POST"-->
    <div class="w3-row">
        <div class="w3-col s12 m6" style="padding-right: 20px;">
            <p>      
                <label class="w3-text-blue"><b>First Name</b></label>
                <input class="w3-input w3-border" name="first" id="first" type="text" required>
            </p>
            <p>      
                <label class="w3-text-blue"><b>Middle Initial</b></label>
                <input class="w3-input w3-border" name="mi" id="mi" type="text" maxlength="2" required>
            </p>
            <p>      
                <label class="w3-text-blue"><b>Last Name</b></label>
                <input class="w3-input w3-border" name="last" id="last" type="text" required>
            </p>
            <p>      
                <label class="w3-text-blue"><b>Birthdate</b></label>
                <input class="w3-input w3-border" name="bdate" id="bdate" type="date" required>
            </p>
            <p>      
                <label class="w3-text-blue"><b>Gender</b></label>
                <select class="w3-input w3-border" name="gender" id="gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </p>
            <p>      
                <label class="w3-text-blue"><b>Email</b></label>
                <input class="w3-input w3-border" name="email" id="email" type="email" required>
            </p>
            
        </div>
        <div class="w3-col s12 m6">
            <p>      
                <label class="w3-text-blue"><b>Contact Number</b></label>
                <input class="w3-input w3-border" name="contact" id="contact" type="tel" maxlength="11" required>
            </p>
            <!--p style="display: none">      
                <label class="w3-text-blue"><b>Emergency Contact Person</b></label>
                <input class="w3-input w3-border" name="guardian" type="text" >
            </p>
            <p style="display: none">      
                <label class="w3-text-blue"><b>Emergency Contact Number</b></label>
                <input class="w3-input w3-border" name="ecn" type="tel" >
            </p-->
            <p>      
                <label class="w3-text-blue">
                    <b>Course</b>
                    <i class="w3-gray"></i>
                </label>
                <select name="course_code" id="course_code" class="w3-input w3-border" required>
                    <option value="">Select Course</option>
            <?php 
                
                $getCourses = "select * from courses";
                $courses = $conn->prepare($getCourses);
                $courses->execute();
                while($courseRow = $courses->fetch(PDO::FETCH_ASSOC)){
                    if(!empty($courseRow['major'])){
                        ?>
                    <option value="<?php echo $courseRow['course_code']; ?>">
                        <?php echo $courseRow['course']." - ".$courseRow['major']; ?>
                            
                    </option>

                    <?php
                    }else{
                    ?>
                    <option value="<?php echo $courseRow['course_code']; ?>">
                        <?php echo $courseRow['course']; ?>
                        
                    </option>

                    <?php
                }}
             ?>

                </select>
            </p>
            <p>      
                <label class="w3-text-blue"><b>Year Level</b></label>
                <select name="year_level" id="year_level" class="w3-input w3-border" required>
                    <option value="">Select Year Level</option>
                    <option value="I">1st Year</option>
                    <option value="II">2nd Year</option>
                    <option value="III">3rd Year</option>
                    <option value="IV">4th Year</option>
                </select>
            </p>
            <p>      
                <label class="w3-text-blue"><b>Registration Date</b></label>
                <input class="w3-input w3-border" name="reg" id="reg" type="date" required>
            </p>
            <p>      
                <label class="w3-text-blue"><b>Is student regular?</b></label>
                <select name="isRegular" id="isRegular" class="w3-input w3-border">
                    <option value="">Select Answer</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </p><br>
    </div>
</div>
<div class="w3-row">
    <p>      
        <label class="w3-text-blue"><b>Admin Password</b></label>
        <input class="w3-input w3-border" name="aspass" id="aspass" type="password" required>
    </p>
</div>
<br>
<p id="asres"></p>
<br>
<div class="w3-row">
    <p>      
        <button class="w3-btn w3-blue w3-right" onclick="addStudent()">Add Student</button>
    </p>
</div>
<!--/form-->
<script>
    function addStudent(){
        var fname = document.getElementById("first").value;
        var lname = document.getElementById("last").value;
        var mi = document.getElementById("mi").value;
        var bdate = document.getElementById("bdate").value;
        var gender = document.getElementById("gender").value;
        var email = document.getElementById("email").value;
        var contact = document.getElementById("contact").value;
        var course_code = document.getElementById("course_code").value;
        var year_level = document.getElementById("year_level").value;
        var reg = document.getElementById("reg").value;
        var isRegular = document.getElementById("isRegular").value;
        var pass = document.getElementById("aspass").value;



        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //console.log(this.responseText);
              
              alert(this.responseText);  
              var res = this.responseText;
              if(res=="success"){
                //location.reload();
                //location.replace("https://chcc.ga/admin/admin.php?page=Students");
                //replace(url: DOMString)
              }else{
                document.getElementById("asres").innerHTML = this.responseText;
              }            
              //document.getElementById('enrollBlock').attrubute = "disabled";
            }
        };
        xhttp.open("POST", "../app/add_student.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("first="+fname+"&last="+lname+"&mi="+mi+"&bdate="+bdate+"&gender="+gender+"&contact="+contact+"&email="+email+"&course_code="+course_code+"&year_level="+year_level+"&isRegular="+isRegular+"&reg="+reg+"&pass="+pass);
    }
</script>
