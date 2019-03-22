<?php

//$role = $_SESSION('user_role');



if($urole=="student"){

    $fname = $studentInfo['fname'];
    $lname = $studentInfo['lname'];
    $mid = $studentInfo['mi'];
    $gender = $studentInfo['gender'];
    $bdate = $studentInfo['bdate'];
    $email = $studentInfo['email'];
    $contact = $studentInfo['contact'];
    $reg = $studentInfo['reg_date'];
    //$isReg = $enInfo[]

    if($studentInfo['status']==""){
        $userI = $studentInfo['student_id'];
        $querySStat = "SELECT * from enrollment where student_id = ? order by id DESC limit 1";
        $getSStat = $conn->prepare($querySStat);
        $getSStat->execute(array($userI));
        $statRow = $getSStat->fetch(PDO::FETCH_ASSOC);
        $status = $statRow['status'];
    }
    else{
        $userI = $studentInfo['student_id'];
        $querySStat = "SELECT * from students where student_id = ?";
        $getSStat = $conn->prepare($querySStat);
        $getSStat->execute(array($userI));
        $statRow = $getSStat->fetch(PDO::FETCH_ASSOC);
        $status = $statRow['status'];
    }
}
else{
    $fname = $emp['fname'];
    $lname = $emp['lname'];
    $mid = $emp['mi'];
    $gender = $emp['gender'];
    $bdate = $emp['bdate'];
    $email = $emp['email'];
    $contact = $emp['contact'];
    $reg = $emp['hire_date'];
    $status = $emp['status'];
}



?>
<form class="w3-container" action="../app/edit_student_by_admin.php" method="POST">
<?php

if($role!="admin"){


?>



<div class="w3-col s12 m6 w3-padding">

    <p>      
        <label class="w3-text-blue"><b>First Name</b></label>

        <input class="w3-input w3-border" name="first" type="hidden" value="<?php echo $fname ?>" >

            <span class="w3-input w3-gray w3-border"><?php echo $fname; ?></span>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Middle Initial</b></label>

        <input class="w3-input w3-border" name="mi" type="hidden" value="<?php echo $mid ?>" maxlength="2">
            <span class="w3-input w3-gray w3-border"><?php echo $mid; ?></span>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Last Name</b></label>

        <input class="w3-input w3-border" name="last" type="hidden" value="<?php echo $lname; ?>" >
            <span class="w3-input w3-gray w3-border"><?php echo $lname; ?></span>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Birthdate</b></label>
       
        <input class="w3-input w3-border" id="esbdDate" name="bdate" type="hidden" value="<?php echo $bdate; ?>" onfocus="changetodate('esbdDate')" required>

            <span class="w3-input w3-gray w3-border"><?php echo $bdate; ?></span>
    </p>
    <p>      
        <label class="w3-text-blue"><b>gender</b></label>
        <input class="w3-input w3-border" type="hidden" name="gender" value="<?php echo $studentInfo['gender']; ?>">
            <input class="w3-input w3-gray w3-border" type="text" value="<?php echo $gender; ?>" disabled>
           
    </p>
    
    
</div>
<div class="w3-col s12 m6 w3-padding">

    <p>      
        <label class="w3-text-blue"><b>Email</b></label>
        <input class="w3-input w3-border" name="email" type="email" value="<?php echo $email; ?>" required>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Contact Number</b></label>
        <input class="w3-input w3-border" name="contact" type="tel" value="<?php echo $contact; ?>" maxlength="11" required>
    </p>
    <?php if($urole=="student"){?>
    <p>      
        <label class="w3-text-blue"><b>Year Level</b></label>
        <input name="yl" class="w3-input w3-border" type="hidden" value="<?php echo $enInfo['year_level']; ?>"> 
        <span class="w3-input w3-gray w3-border"><?php echo $enInfo['year_level']; ?></span>
            
    </p>
    <p>      
        <label class="w3-text-blue"><b>Course</b></label>
        <input name="course" type="hidden" class="w3-input w3-border" value="<?php echo $enInfo['course_code']; ?>" >
        <span class="w3-input w3-gray w3-border"><?php echo $enInfo['course_code']; ?></span>
          
    </p>
<?php }else{ ?>
    <p>
        <label class="w3-text-blue"><b>Status</b></label>
        <input name="status" type="hidden" class="w3-input w3-border" value="<?php echo $status; ?>">
        <span class="w3-input w3-gray w3-border"><?php echo $status; ?></span>
         
    </p>
<?php } ?>
    <!--p>      
        <label class="w3-text-blue"><b>Emergency Contact Person</b></label>
        <input class="w3-input w3-border" name="guardian" type="text" value="<?php //echo $studentInfo['emergency_person']; ?>" required>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Emergency Contact Number</b></label>
        <input class="w3-input w3-border" name="ecn" type="tel" value="<?php //echo $studentInfo['emergency_contact']; ?>" required>
    </p-->
    <p>      
        <label class="w3-text-blue"><b>Registration Date</b></label>
        <input class="w3-input w3-border" type="hidden" onfocus="changetodate('esbdReg')" value="<?php echo $reg; ?>" >
        <span class="w3-input w3-gray w3-border" ><?php echo $reg; ?> </span>
    </p>
    
</div>




<?php



}
else {
    ?>

<div class="w3-col s12 m6 w3-padding">

    <p>      
        <label class="w3-text-blue"><b>First Name</b></label>
        <input class="w3-input w3-border" name="first" type="text" value="<?php echo $fname ?>" required>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Middle Initial</b></label>
        <input class="w3-input w3-border" name="mi" type="text" value="<?php echo $mid ?>" required>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Last Name</b></label>
        <input class="w3-input w3-border" name="last" type="text" value="<?php echo $lname; ?>" required>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Birthdate</b></label>
        <input class="w3-input w3-border" id="esbdDate" name="bdate" type="date" value="<?php echo $bdate; ?>" style="background: #fff;" onfocus="changetodate('esbdDate')" required>
    </p>
    <p>      
        <label class="w3-text-blue"><b>gender</b></label>
        <select class="w3-input w3-border" name="gender" value="<?php echo $studentInfo['gender']; ?>" style="background: #fff;" required>
            <option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
    </p>
    
    
</div>
<div class="w3-col s12 m6 w3-padding">

    <p>      
        <label class="w3-text-blue"><b>Email</b></label>
        <input class="w3-input w3-border" name="email" type="email" value="<?php echo $email; ?>" required>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Contact Number</b></label>
        <input class="w3-input w3-border" name="contact" type="tel" value="<?php echo $contact; ?>" required>
    </p>
    <?php if($urole=="student"){?>
    <p>      
        <label class="w3-text-blue"><b>Year Level</b></label>
        <select name="yl" class="w3-input w3-border" style="background: #fff;" required> 
            <option value="<?php echo $enInfo['year_level']; ?>"><?php echo $enInfo['year_level']; ?></option>
            <option value="">Select Year Level</option>
            <option value="I">First Year</option>
            <option value="II">Second Year</option>
            <option value="III">Third Year</option>
            <option value="IV">Fourth Year</option>
        </select>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Course</b></label>
        <select name="course" id="" class="w3-input w3-border" style="background: #fff;" required>
            <option value="<?php echo $enInfo['course_code']; ?>"><?php echo getCourseName($conn,$enInfo['course_code']); ?></option>
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
        <label class="w3-text-blue"><b>Status</b></label>
        <select name="status" class="w3-input w3-border" style="background: #fff;" required>
            <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
            <option value="REGULAR">REGULAR</option>
            <option value="IRREGULAR">IRREGULAR</option>
        </select>
    </p>
    <?php }else{ ?>
        <p>
            <label class="w3-text-blue"><b>Status</b></label>
            <select name="status" class="w3-input w3-border" style="background: #fff;" required>
                <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
               <option value="Permanent">Permanent</option>
                <option value="Part Time">Part Time</option>
                <option value="On Leave">On Leave</option>
            </select>
        </p>
    <?php } ?>
    <!--p>      
        <label class="w3-text-blue"><b>Emergency Contact Person</b></label>
        <input class="w3-input w3-border" name="guardian" type="text" value="<?php //echo $studentInfo['emergency_person']; ?>" required>
    </p>
    <p>      
        <label class="w3-text-blue"><b>Emergency Contact Number</b></label>
        <input class="w3-input w3-border" name="ecn" type="tel" value="<?php //echo $studentInfo['emergency_contact']; ?>" required>
    </p-->
    <p>      
        <label class="w3-text-blue"><b>Registration Date</b></label>
        <input class="w3-input w3-border" name="reg" type="date" id="esbdReg" onfocus="changetodate('esbdReg')" value="<?php echo $reg; ?>" style="background: #fff;" required >
    </p>
    
</div>

<?php
}

?>

<div class="w3-padding w3-row">
    <p>   
    <?php 
        if($role=="admin"){
    ?>   
        <label class="w3-text-blue" style="text-align: left !important;"><b>Admin Password</b></label>
        <?php 
        }
        else{
            ?>   
        <label class="w3-text-blue" style="text-align: left !important;"><b>User Password</b></label>
        <?php 
            }
        ?>
        <input class="w3-input w3-border" name="adminPass" type="password" id="adminPass" onfocus="changetodate('esbdReg')" value="" required>
    </p>
    <p>
        <input type="hidden"  name="id" value="<?php echo $id?>">
        <input type="hidden"  name="sid" value="<?php echo $sid?>">
        <input type="hidden"  name="urole" value="<?php echo $urole?>">     
        <input type="hidden"  name="role" value="<?php echo $role?>">   
        <button class="w3-input w3-blue w3-padding" style="height: 50px; line-height: 30px; font-weight: bold;">Edit Information</button>
    </p>
</div>
    </form>
