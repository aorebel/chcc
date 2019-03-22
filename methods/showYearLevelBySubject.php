<?php 

$course_code = $courseRow['course_code'];

?>
<div class="w3-bar w3-light-gray">
    <button class="w3-bar-item w3-button subjectTabLink w3-red" onclick="openSubjectTab(event,'firstYearSubject')">First Year</button>
    <button class="w3-bar-item w3-button subjectTabLink" onclick="openSubjectTab(event,'secondYearSubject')">Second Year</button>
    <button class="w3-bar-item w3-button subjectTabLink" onclick="openSubjectTab(event,'thirdYearSubject')">Third Year</button>
    <button class="w3-bar-item w3-button subjectTabLink" onclick="openSubjectTab(event,'forthYearSubject')">Forth Year</button>
    <button class="w3-bar-item w3-button w3-yellow w3-right" onclick="showAddSubject()">Add Subject</button>
  </div>
  
  <div id="firstYearSubject" class="w3-container w3-padding w3-border subjectTab">

    <?php 
        $year_level = "I";
        //subjectsTableHeader();
        subjectsTable($conn,$course_code,$year_level);
      ?>
    
  </div>

  <div id="secondYearSubject" class="w3-container w3-padding w3-border subjectTab" style="display:none">
    
    <?php 
        $year_level2 = "II";
        //subjectsTableHeader();
        subjectsTable($conn,$course_code,$year_level2);
      ?>
    
  </div>

  <div id="thirdYearSubject" class="w3-container w3-padding w3-border subjectTab" style="display:none">

    <?php 
        $year_level3 = "III";
        //subjectsTableHeader();
        subjectsTable($conn,$course_code,$year_level3);
      ?>
    
  </div>

  <div id="forthYearSubject" class="w3-container w3-padding w3-border subjectTab" style="display:none">

    <?php 
        $year_level4 = "IV";
        //subjectsTableHeader();
        subjectsTable($conn,$course_code,$year_level4);
      ?>
    
  </div>

  <div id="editSubject" class="w3-modal">
    <div class="w3-modal-content">

      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('editSubject').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Modal Header</h2>
      </header>

      <div class="w3-container">
        <p>Some text..</p>
        <p>Some text..</p>
      </div>

    </div>
  </div>

  <div id="addSubjectForm" class="w3-modal">
    <div class="w3-modal-content">

      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('addSubjectForm').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h5>Add Subject</h5>
      </header>

      <div class="w3-container w3-padding" style="height: 500px; overflow-y: auto;">
        <?php require_once('../templates/add-subject.php'); ?>
      </div>

    </div>
  </div>


<script>
  function showAddSubject(){
    document.getElementById("addSubjectForm").style.display = 'block';
  }
</script>