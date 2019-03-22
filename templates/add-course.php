
    <form class="w3-container" action="../app/add_course.php" method="POST">
    <p>      
        <label class="w3-text-blue"><b>Course Code</b></label>
        <input class="w3-input w3-border" name="course_code" type="text" required>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Course Name</b></label>
        <input class="w3-input w3-border" name="course" type="text" required>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Major</b></label>
        <input class="w3-input w3-border" name="major" type="text">
    </p>
    <p>      
        <label class="w3-text-blue"><b>Description</b></label>
        <textarea name="desc" id="" cols="30" rows="5" class="w3-input w3-border"></textarea>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Required Units</b></label>
        <input class="w3-input w3-border" name="req_units" type="text" required>
    </p>  
    
    <br>
    <p>      
    <button class="w3-btn w3-blue">Add Course</button></p>
    </form>

