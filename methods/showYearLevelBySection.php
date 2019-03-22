<?php 

$course_code = $courseRow['course_code'];
//echo $course_code;

?>
<head>
  <style>
    td{
      border: 1px solid lightgrey;
    }
  </style>
</head>
<div class="w3-bar w3-light-gray">
  <button class="w3-bar-item w3-button sectionTabLink w3-red" onclick="openSectionTab(event,'firstYearSection')">First Year</button>
  <button class="w3-bar-item w3-button sectionTabLink" onclick="openSectionTab(event,'secondYearSection')">Second Year</button>
  <button class="w3-bar-item w3-button sectionTabLink" onclick="openSectionTab(event,'thirdYearSection')">Third Year</button>
  <button class="w3-bar-item w3-button sectionTabLink" onclick="openSectionTab(event,'forthYearSection')">Forth Year</button>
</div>

<div id="firstYearSection" class="w3-container w3-border w3-padding sectionTab">

    <?php       
      //sectionTableHeader();
      $year_level = "I";
      $sectionRow = querySection($conn, $course_code,$year_level);
      sectionTable($conn,$sectionRow,$courseRow);

    ?>
    <br>
  <button class="w3-button w3-yellow w3-right" onclick="openAddSection('<?php echo $course_code ?>','I')">ADD SECTION</button>
</div>

<div id="secondYearSection" class="w3-container w3-border w3-padding sectionTab" style="display:none">
    <?php       
      //sectionTableHeader();
      $year_level = "II";
      $sectionRow = querySection($conn, $course_code,$year_level);
      sectionTable($conn,$sectionRow,$courseRow);
     
    ?>
    <br>
    <button class="w3-button w3-yellow w3-right" onclick="openAddSection('<?php echo $course_code ?>','II')">ADD SECTION</button>
</div>

<div id="thirdYearSection" class="w3-container w3-padding w3-border sectionTab" style="display:none">
    <?php       
     //sectionTableHeader();
      $year_level = "III";
      $sectionRow = querySection($conn, $course_code,$year_level);
      sectionTable($conn,$sectionRow,$courseRow);
    ?>
    <br>
    <button class="w3-button w3-yellow w3-right" onclick="openAddSection('<?php echo $course_code ?>','III')">ADD SECTION</button>
</div>
<div id="forthYearSection" class="w3-container w3-padding w3-border sectionTab" style="display:none;">
    <?php       
      //sectionTableHeader();
      $year_level = "IV";
      $sectionRow = querySection($conn, $course_code,$year_level);
      sectionTable($conn,$sectionRow,$courseRow);
    
    ?>
    <br>
    <button class="w3-button w3-yellow w3-right" onclick="openAddSection('<?php echo $course_code ?>','IV')">ADD SECTION</button>
</div>


<div id="addSection2" class="w3-modal">
    <div class="w3-modal-content" style="width: 55% !important; margin-top: -60px !important;">

      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('addSection2').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h4>Add Section for  (<span id="sectionCourseID"></span>)</h4>
      </header>

      <div class="w3-container w3-padding">
        <form class="w3-container" action="../app/add_section.php" method="POST">
          
            <input type="hidden" name="course_code" id="courseCode2" class="w3-input w3-border">
          
            <input type="hidden" name="year_level" id="yearLevel2" class="w3-input w3-border">
          
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
            <label class="w3-text-blue">Allowed Units:</label>
            <input type="text" name="units" class="w3-input w3-border" required>
        </p>
        <br>
        <p>   

          <button class="w3-btn w3-blue">Add Section</button>
        </p>
        </form>
    </div> 
  </div>
</div>


<?php 

function sectionTable($conn,$sectionRow,$courseRow){
  $count = 0;
  while($row = $sectionRow->fetch(PDO::FETCH_ASSOC)){
    $count++
    ?>
    <div  class="w3-button w3-block w3-light-gray w3-border-bottom w3-left-align">
      <span onclick="showAccordion(<?php echo $row['section_code']."S";?>)" class="w3-button w3-com m9">
        <?php echo "Section ".$row['section']." | Allowed Units ".$row['units'];?>
      </span>
           <button class="w3-button w3-right w3-green" style="margin-left: 10px;" onclick="editSection('<?php echo $row['section_code'];?>')">Edit Section</button>
          <!--button class="w3-button w3-right w3-green" onclick="showAddSubject('<?php //echo $row['section_code'];?>')">Add Subject to Section</button-->
      
    </div>
    
    <table id="<?php echo $row['section_code']."S";?>" class="w3-hide w3-container w3-table w3-col s12 m12 w3-padding" >

      <div>
        <tr>
          <th class='w3-border'>#</th>
          <th class='w3-border'>Class Code</th>
          <th class='w3-border'>Subject Code</th>
          <th class='w3-border'>Descriptive Title</th>
          <th class='w3-border'>Subject Type</th>
          <th class='w3-border'>Availed Slots</th>
          <th class='w3-border'>Slots</th>
          <!--th class='w3-border'>Action</th-->
        </tr>
        
      <?php
        $sectionClass = queryClass($conn, $row['section_code']);

        $count = 0;
        while($sectionClassRow = $sectionClass->fetch(PDO::FETCH_ASSOC)){
        $count++;
        require_once('../app/getSYSem.php');
        $querySC = "SELECT * from student_classes where class_code = ? and sem = ? and school_year = ?";
        $sc = $conn->prepare($querySC);
        $sc->execute(array($sectionClassRow['class_code'], $sem, $sy));
        $scCount  = $sc->rowCount();
        ?>
        <tr id="sectionContent">

          <td class='w3-border' style="width: 5%!important"><?php echo $count; ?></td>
          <td class='w3-border' style="width: 15%!important"><?php echo $sectionClassRow['class_code']; ?></td>
          <td class='w3-border' style="width: 20%!important"><?php echo $sectionClassRow['subject_code']; ?></td>
          <td class='w3-border' style="width: 40%!important">
            <?php 
              $isLab = substr($sectionClassRow['class_code'], -1);
              echo $sectionClassRow['subject']; 
              if($sectionClassRow['subject_type']=="With Lab"){
                if($isLab=="L"){
                  echo " Lab";
                }
                else{
                  echo " Lec";
                }
              }
            ?>
              
          </td>
          <td class='w3-border' style="width: 15%!important"><?php echo $sectionClassRow['subject_type']; ?></td>          
          <td class='w3-border' style="width: 30%!important"><?php echo $scCount; ?></td>
          <td class='w3-border' style="width: 30%!important"><?php echo $sectionClassRow['slots']; ?></td>
          <!--td class='w3-border' style="width: 10%!important">
            <button class="w3-button w3-green" ><i class="fa fa-edit"></i></button>
          </td-->
        </tr>
      

      </div>
    
    <?php
  }?>
  </table>
  <?php
}
}
?>


<div id="addClass" class="w3-modal">
  <div class="w3-modal-content" style="width: 40% !important; margin-top: -60px !important;">

    <header class="w3-container w3-blue"> 
      <span onclick="document.getElementById('addClass').style.display='none'" 
      class="w3-button w3-display-topright">&times;</span>
      <h4>Add Subject to Section </h4>
    </header>

    <div class="w3-container w3-padding">
      <?php require_once('../templates/add-subject-to-section.php'); ?>
    </div> 
  </div>
</div>

<div id="editSection" class="w3-modal">
  <div class="w3-modal-content" style="width: 40% !important; margin-top: -60px !important;">

    <header class="w3-container w3-blue"> 
      <span onclick="document.getElementById('editSection').style.display='none'" 
      class="w3-button w3-display-topright">&times;</span>
      <h4>Edit Section </h4>
    </header>

    <div class="w3-container w3-padding">
      <form action="../app/edit_section.php" method="post">
        <p>
          <label class="w3-text-blue">Allowed Units:</label>
          <input type="text" name="units2" class="w3-input w3-border" required>
        </p>
        <p>
          <label class="w3-text-blue">Section Status:</label>
          <select name="status2" class="w3-input w3-border" required>
            <option value="">Select Status</option>
            <option value="">Open</option>
            <option value="">Close</option>
          </select>
        </p>
        <input type="hidden" name="section" id="edit" class="w3-input w3-border" required>
        <input type="hidden" name="cid" id="edit" class="w3-input w3-border" value="<?php echo $course_id; ?>" required>
        <button name="submint" class="w3-button w3-blue">Edit Section</button>
      </form>
    </div> 
  </div>
</div>

<?php 

if(isset($_POST['submit'])){
  


}

?>


<script>
  function showAccordion(id) {
    var x = id;
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace("w3-black", "w3-red");
    } else { 
        x.className = x.className.replace(" w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace("w3-red", "w3-black");
    }
  }
  function showAddSubject(section){
    var x = section;
    //console.log(x);
    document.getElementById('addSectionCode').innerHTML = x;
    document.getElementById('addClass').style.display="block";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("subjectBySection").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "../app/getSubjectsByCourseLevel.php?section=" + x, true);
    xmlhttp.send();
    //console.log(x);
  }
  function editSection(section){
    var x = section;
    //console.log(x);
    document.getElementById('edit').value = x;
    document.getElementById('editSection').style.display="block";
    showSubjectsByCourseLevel(x);
  }
  function openAddSection(course, year){
    var course = course;
    var year = year;

    document.getElementById('addSection2').style.display = "block";
    document.getElementById('sectionCourseID').innerHTML = course+" - "+year;
    document.getElementById('courseCode2').value = course;
    document.getElementById('yearLevel2').value = year;
  }
</script>