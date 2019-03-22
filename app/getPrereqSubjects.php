<!--option value="None">No Pre-requisite</option>

<option value="2nd Yr Standing">2nd Yr Standing</option>
<option value="3rd Yr Standing">3rd Yr Standing</option>            
<option value="4th Yr Standing">4th Yr Standing</option-->
<?php 
    require_once('config/connect.php');
    $course_code = $_REQUEST['course'];
    $isReq = "Yes";
    $gen = "GENED";
    $getSubjects = "SELECT * from subjects where req = ?";
    $subjects = $conn->prepare($getSubjects);
    $subjects->execute(array($isReq));
    echo $course_code;
    while($subjectRow = $subjects->fetch(PDO::FETCH_ASSOC)){
        ?>
        <option value="<?php echo $subjectRow['subject_code']; ?>">
            
            <b><?php echo $subjectRow['subject_code']; ?></b> 
            ( <?php echo $subjectRow['subject']; ?> )

                      
        </option>

        <?php
    }
 ?>   
           
        