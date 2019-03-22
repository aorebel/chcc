<?php 
	require_once('../app/config/connect.php');

    $section_code = $_REQUEST['section'];
    $getSections = "select * from sections where section_code = ?";
    $sections = $conn->prepare($getSections);
    $sections->execute(array($section_code));
    $sRow = $sections->fetch(PDO::FETCH_ASSOC);

    $sectionYearLevel = $sRow['year_level'];
    $sectionCourse = $sRow['course_code'];
    $gened="GENED";

    $getSubject = "select * from subjects where year_level = ? and course_code = ? or course_code=?";
    $subjects = $conn->prepare($getSubject);
    $subjects->execute(array($sectionYearLevel,$sectionCourse,$gened));

    ?><option value="">Select Subject</option><?php
    while($subjectRow = $subjects->fetch(PDO::FETCH_ASSOC)){
        ?>
        <option value="<?php echo $subjectRow['id']; ?>"><?php echo $subjectRow['subject']; ?></option>

        <?php
    }
 ?>