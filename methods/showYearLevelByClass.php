<head>
  <style>
    .hide{
      display: none;
    }
    .show{
      display: show;
    }
  </style>
</head>
<div class="w3-bar w3-light-gray">
    <button class="w3-bar-item w3-button classTabLink w3-red" onclick="openClassTab(event,'firstYearClass')">First Year</button>
    <button class="w3-bar-item w3-button classTabLink" onclick="openClassTab(event,'secondYearClass')">Second Year</button>
    <button class="w3-bar-item w3-button classTabLink" onclick="openClassTab(event,'thirdYearClass')">Third Year</button>
    <button class="w3-bar-item w3-button classTabLink" onclick="openClassTab(event,'forthYearClass')">Forth Year</button>
  </div>
  
  <div id="firstYearClass" class="w3-container w3-padding w3-border classTab">
    <table class="w3-table w3-border">
      <?php 

        $year_level = "I";
        //$semester = ""
        
        //$sectionCode = $course_code."1";
      
        $section = querySection($conn, $course_code,$year_level);
        while($secRow = $section->fetch(PDO::FETCH_ASSOC)){
          $sectionCode = $secRow['section_code'];
       
          ?>
              <table class="w3-table w3-border"  id = "<?php echo $sectionCode; ?>">
              
              <?php 
              echo "<h3 class='w3-center'>".strtoupper($sectionCode)."</h3>";
              echo classTableHeader();
              $classes = queryClass2($conn,$sectionCode);
              classTable($conn,$classes);

              ?>
              </table>
           
          <?php
        }

        
      ?>
    </table>
  </div>

  <div id="secondYearClass" class="w3-container w3-padding w3-border classTab" style="display:none">
    <table class="w3-table w3-border">
    <?php 
        $year_level = "II";
        $section = querySection($conn, $course_code,$year_level);
        while($secRow = $section->fetch(PDO::FETCH_ASSOC)){
          $sectionCode = $secRow['section_code'];
       
          ?>
              <table class="w3-table w3-border"  id = "<?php echo $sectionCode; ?>">
              
              <?php 
              echo "<h3 class='w3-center'>".strtoupper($sectionCode)."</h3>";
              echo classTableHeader();
              $classes = queryClass2($conn,$sectionCode);
              classTable($conn,$classes);

              ?>
              </table>
           
          <?php
        }
      ?>
    </table>
  </div>

  <div id="thirdYearClass" class="w3-container w3-padding w3-border classTab" style="display:none">
    <table class="w3-table w3-border">
    <?php 
        $year_level = "III";
        $section = querySection($conn, $course_code,$year_level);
        while($secRow = $section->fetch(PDO::FETCH_ASSOC)){
          $sectionCode = $secRow['section_code'];
       
          ?>
              <table class="w3-table w3-border"  id = "<?php echo $sectionCode; ?>">
              
              <?php 
              echo "<h3 class='w3-center'>".strtoupper($sectionCode)."</h3>";
              echo classTableHeader();
              $classes = queryClass2($conn,$sectionCode);
              classTable($conn,$classes);

              ?>
              </table>
           
          <?php
        }
      ?>
      </table>
  </div>
   <div id="forthYearClass" class="w3-container w3-padding w3-border classTab" style="display:none">
    <table class="w3-table w3-border">
    <?php 
        $year_level = "IV";
        //classTableHeader();
        //$sectionCode = $course_code."4";
        //$classes = queryClass2($conn,$sectionCode);
        //classTable($conn,$classes);
        $section = querySection($conn, $course_code,$year_level);
        while($secRow = $section->fetch(PDO::FETCH_ASSOC)){
          $sectionCode = $secRow['section_code'];
       
          ?>
              <table class="w3-table w3-border"  id = "<?php echo $sectionCode; ?>">
              
              <?php 
              echo "<h3 class='w3-center'>".strtoupper($sectionCode)."</h3>";
              echo classTableHeader();
              $classes = queryClass2($conn,$sectionCode);
              classTable($conn,$classes);

              ?>
              </table>
           
          <?php
        }
      ?>
      </table>
  </div>
  
  <div id="editClass" class="w3-modal">
    <div class="w3-modal-content" style="width: 55% !important; margin-top: -60px !important;">

      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('editClass').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h4>Edit Class Schedule (<span id="classID"></span>)</h4>
      </header>

      <div class="w3-container w3-padding">
        <?php require_once('../templates/edit-class.php'); ?>
      </div> 
    </div>
  </div>

  <script>
    function showEditClassForm(classCode,sem,sy,start,end,room){
      //var section = section;
      //console.log(classCode);
      var classCode = classCode;
      document.getElementById('editClass').style.display="block";
      document.getElementById('classCode').innerHTML=classCode;
      //document.getElementById('classCode2').value=classCode;
      document.getElementById('classID').innerHTML=classCode;
      document.getElementById('sem').value=sem;
      document.getElementById('sy').value=sy;
      document.getElementById('timeStart').value=start;
      document.getElementById('timeEnd').value=end;
      document.getElementById('room').value=romm;
        //subject = subject.replace(/\s+/g, '-')
        
        //console.log(classCode+"skdjhadsla");
   

    }
    function showClassesOfSection(section){
      var section = section;
      var sectionx = document.getElementById(section);
      alert(section);
      section.classList.toggle("show");
    }
  </script>