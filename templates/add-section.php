
    <form class="w3-container" action="../app/add_section.php" method="POST">
    <p>      
        <label class="w3-text-blue"><b>Section Code</b></label>
        <select name="section_code" class="w3-input w3-border">
            <option value="">Select Code</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
            <option value="F">F</option>
        </select>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Course</b></label>
        <select name="course_code" id="" class="w3-input w3-border" required>
            <option value="">Select Course Code</option>
    <?php 
        
        $getCourses = "select * from courses";
        $courses = $conn->prepare($getCourses);
        $courses->execute();
        while($courseRow = $courses->fetch(PDO::FETCH_ASSOC)){
            ?>
            <option value="<?php echo $courseRow['course_code']; ?>"><?php 
                echo $courseRow['course']; 
                if(!empty($courseRow['major'])){
                    echo " Major in ".$courseRow['major']; 
                }
            ?>
                
            </option>

            <?php
        }
     ?>

        </select>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Year Level</b></label>
        <select name="year_level" class="w3-input w3-border" required> 
            <option value="">Select Year Level</option>
            <option value="I">First Year</option>
            <option value="II">Second Year</option>
            <option value="III">Third Year</option>
            <option value="IV">Fourth Year</option>
        </select>
    </p>
    <!--p>
        <label class="w3-text-blue">Slots:</label>
        <input type="text" name="slots" class="w3-input w3-border" required>
    </p-->
    <p>
        <label class="w3-text-blue">Allowed Units:</label>
        <input type="text" name="units" class="w3-input w3-border" required>
    </p>
    
    <br>
    <p>      
    <button class="w3-btn w3-blue">Add Section</button></p>
    </form>
