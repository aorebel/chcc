
<?php 
require_once('../app/session.php');
$queryCashier1 = "SELECT * from cashier where student_id = ?order by id DESC limit 1";
$getCashier1 = $conn->prepare($queryCashier1);
$getCashier1->execute(array($sid));
$cashRow1 = $getCashier1->fetch(PDO::FETCH_ASSOC);
//echo $getCashier1->rowCount();

$bdate = date($studentInfo['bdate']);
$age = substr(date('Ymd') - date('Ymd', strtotime($bdate)), 0, -4);
$mid = explode(".", $studentInfo['mi']);
$enrollmentRow = queryEnrollmentInfo($conn, $sid) -> fetch(PDO::FETCH_ASSOC);
$isRegular = $enrollmentRow['status'];

$rPic = checkPicture($conn, $sid);
$cashRow = getCashier($conn,$sid);
?>
<div style="display: block; margin-top: -30px; margin-right: 30px; margin-bottom: 20px; margin-left: 20px;">
<?php
if(($eRow['id']=="1") && ($eRow['status']=="Open") ){
  if($role=="admin"){
    if(empty($assRow)){
      if( ($isRegular=="REGULAR") ){
        ?>
      
        <?php if(empty($scRow)){ ?>
        <button onclick="document.getElementById('addBlockClass').style.display='block'" class="w3-button w3-yellow w3-right">Enroll Subjects in Block Section</button>
        <?php } 
      }
      else {

        ?>
      
        <button onclick="document.getElementById('addCurrentClass').style.display='block'" class="w3-button w3-yellow w3-right">Enroll New Subjects</button>

        <?php
      }
    }else{
      if( ($isRegular=="REGULAR") ){
        ?>
      
        <?php if(empty($scRow)){ ?>
        <button onclick="document.getElementById('addBlockClass').style.display='block'" class="w3-button w3-yellow w3-right" disabled>Enroll Subjects in Block Section</button>
        <?php } 
      }
      else {

        ?>
      
        <button onclick="document.getElementById('addCurrentClass').style.display='block'" class="w3-button w3-yellow w3-right" disabled>Enroll New Subjects</button>

        <?php
      }
    }
  }else if($role=="student"){
    if( ($isRegular=="REGULAR") && ($enrollmentRow['year_level']=="II")  && ($enrollmentRow['course_code']=="BA")  || ($enrollmentRow['course_code']=="BEED")  || ($enrollmentRow['course_code']=="ENG")  || ($enrollmentRow['course_code']=="FIL")  || ($enrollmentRow['course_code']=="MAPEH")  || ($enrollmentRow['course_code']=="SOCSCI") || ($enrollmentRow['course_code']=="MATH") ){
      if(empty($scRow)){ ?>
        <!--button onclick="document.getElementById('addBlockClass').style.display='block'" class="w3-button w3-yellow w3-right">Enroll Subjects in Block Section</button-->
      <?php 
      } 
    }else{
      echo "<h3 class='w3-red w3-center'><i class='fas'></i>Second Year <b>REGULAR</b> students of selected courses are only allowed for online enrollment.</h3>";
    }
  }
}else{
  ?>

  <h3 class="w3-red w3-center"><i class="fas"></i>Enrollment is currently close</h3>
  <input type="hidden" id="eStats" value="close">
  <?php
}
?>
</div>
<div id="profile" class="w3-container w3-padding" style="padding-bottom: 50px; margin-top: 20px;">
    <div class=" w3-col m12 l2" style="background: #fff; color: #fff;">hi</div>
    <div class=" w3-col m12 l2" style="">
        <?php 
        if($role=="admin"){
          if(!empty($rPic)){
              ?>
              <img src="<?php echo $rPic['dir']."".$rPic['title']; ?>" alt="Person" id="studImg" style="width:100%; height: 195px;" >
              <?php
          }
          else{
              ?>
              <img src="../lib/res/avatar.png" alt="Person" id="studImg" style="width:100%; height: 195px;" >
              <?php
          }
          
        ?>
        
        <button class="w3-input w3-blue" onclick="openFileUploader()">Upload Photo</button>
        <?php }else{ 

          
          if(!empty($rPic)){
              ?>
              <img src="<?php echo $rPic['dir']."".$rPic['title']; ?>" alt="Person" id="studImg" style="width:100%; height: 230px;" >
              <?php
          }
          else{
              ?>
              <img src="../lib/res/avatar.png" alt="Person" id="studImg" style="width:100%; height: 230px;" >
              <?php
          }
        }?>
        <div class="w3-container w3-center w3-blue" >
          <h5><b><?php echo $sid; ?></b></h5>
          <h4 style="margin-top: -15px; font-size: 20px; font-family: century gothic;"><?php echo $enInfo['course_code']." - ".$enInfo['year_level']; ?></h4>
        </div>
    </div>
    <div class="w3-col m12 l5 w3-padding" style="background: lightgrey; height: 305px;">
        
        <h2 class="w3-center"><?php echo $fullname ?></h2>
        <p class="w3-center" style="margin-top: -15px;"><?php echo getCourseName($conn,$enInfo['course_code']); ?></p><hr>
        <div style="font-size: 18px; font-family: century gothic;">
          <span class="w3-tab" style="">AGE: <?php echo $age; ?> YEARS OLD</span><br>
          <span class="w3-tab" style="">BIRTHDATE: <?php echo $bdate; ?></span><br>
          <span class="w3-tab" style="">GENDER: <?php echo $studentInfo['gender'];?></span><br>
          <span class="w3-tab" style="">CONTACT NO: <?php echo $studentInfo['contact'];?></span><br>
          <span class="w3-tab" style="">EMAIL ADDRESS: <?php echo $studentInfo['email'];?></span><br>
          <!--span class="w3-tab" style="font-size: 20px; font-family: century gothic;">GUARDIAN: <?php //echo $studentInfo['emergency_person']?></span><br>
          <span class="w3-tab" style="font-size: 20px; font-family: century gothic;">CONTACT NO: <?php //echo $studentInfo['emergency_contact']?></span><br-->
          <span class="w3-tab" style="">REGISTRATION DATE: <?php echo $studentInfo['reg_date']?></span><br><br>
        </div>
    </div>
    <div class="w3-col m12 l3 w3-padding w3-center">
        <h5 class="w4-card w3-black w3-padding">Enrollment Status</h5>
        <?php
            if( ($sy == $enrollmentRow['school_year']) && ($sem == $enrollmentRow['sem']) ){
                ?>

                <span class="w3-round w3-green w3-padding">Enrolled</span><br><br>

                <?php
            }else{
                ?>

                <span class="w3-round w3-red w3-padding">Not Yet Enrolled</span><br><br>


                <?php

                if($assRow['pay_plan']!=""){
                  ?>

                    <span class="w3-round w3-orange w3-padding">ENLISTED</span><br><br>

                    <?php
                }
            }
            
        ?>
        
        
        <span class="w3-tab">SY: <?php echo $sy; ?></span><br>
        <span class="w3-tab">Semester: <?php echo $sem; ?></span><br>
        <span class="w3-tab"><?php echo $isRegular; ?></span><br>
        <hr>
        <span class="w3-tab">Payment Plan: <?php 
          if($assRow['pay_plan']==""){
            echo "N/A";
          }
          else{
            echo $assRow['pay_plan'];  
          }
          
          ?></span><br>
        <span class="w3-tab">Outstanding Balance:</span><br>
        <span class="w3-tab"><?php 
          if(empty($cashRow1)){
             if(empty($assRow)){
              echo "N/A";
             }
             else{
              if($assRow['pay_plan']==""){
                echo "PHP ".$assRow['total_amount'];
              }
              else{
                echo "PHP ".$assRow['net_payable'];
                echo "<br>Next Pay Balance:<br>";
                if($assRow['pay_plan']=="full"){
                  $div = 1;
                }
                else if($assRow['pay_plan']=="half"){
                  $div = 2;
                }
                else if($assRow['pay_plan']=="tri"){
                  $div = 3;
                }
                else if($assRow['pay_plan']=="quarter"){
                  $div = 4;
                }
                echo "PHP ".$assRow['net_payable']/$div.".00";
              }
            }
          }
          else{
            
            echo "PHP ".$cashRow1['bal'];
            echo "<br><b>Next Pay Balance:<br>";
            if($cashRow1['counter']==0){
              echo "Fully Paid <br>";
              echo $cashRow1['bal'];
            }else if($cashRow1['counter']>0){
              echo "PHP ".$cashRow1['perPay'].".00";
            }
            if(empty($cashRow['counter'])){
              echo "No payments made yet";
            }
            
          }
          
          ?></span><br>
    </div> 
    
</div>
<div class="w3-padding">
    
    <button class="w3-input w3-green w3-padding" style="margin-top: 20px !important; margin-bottom: 50px;line-height: 30px; height: 50px; font-size: 18px; font-family: century gothic; font-weight: 500;" onclick="openEditForm('<?php echo $id; ?>')"><i class="fa fa-edit"></i> Edit Information</button>
</div>


<div id="editStudentInfo" class="w3-modal">

    
  <div class="w3-modal-content" style="margin-top: -60px;">
    <header class="w3-container w3-blue"> 
      <span onclick="document.getElementById('editStudentInfo').style.display='none'" 
      class="w3-button w3-display-topright">&times;</span>
      <h5>Edit Student Information Form</h5>
    </header>

    <div class="w3-container">
      <?php require_once('../templates/edit-student-by-admin.php'); ?>
    </div>
  </div>
</div>

<div id="fileUploader" class="w3-modal">

    
  <div class="w3-modal-content" style="margin-top: -60px; width: 30%;">
    <header class="w3-container w3-blue"> 
      <span onclick="document.getElementById('fileUploader').style.display='none'" 
      class="w3-button w3-display-topright">&times;</span>
      <h5>Upload Student ID Picture</h5>
    </header>

    <div class="w3-container">
        <form action="../app/upload.php" method="post" enctype="multipart/form-data">  
          <p class="w3-input">
            <input type="hidden" name="role" value="student">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="sid" value="<?php echo $sid; ?>">
            <input type="hidden" name="type" value="ID Picture">
            <input type="file" name="sfile" id="sfile" style="border: none !important; font-family: century gothic;" required>
          </p>
          <p>
              <button class="w3-button w3-blue" >UPLOAD</button>
          </p>
        </form>
    </div>
  </div>
</div>


<!-- ********************************ADD CUSTOM SUBJECT******************************** -->
<div id="addCurrentClass" class="w3-modal">
  <div class="w3-modal-content">

    <header class="w3-container w3-blue"> 
      <span onclick="document.getElementById('addCurrentClass').style.display='none'" 
      class="w3-button w3-display-topright">&times;</span>
      <h5>Enroll New Subjects Form </h5>
    </header>

    <div class="w3-container">
    
      <h3 class="w3-center" style="margin-top: 150px;">UNDER CONSTRUCTION</h3>

    </div>

  </div>
</div>
<!-- ********************************ADD CUSTOM SUBJECT END******************************** -->
<!-- ********************************ADD BLOCK SUBJECT******************************** -->
<div id="addBlockClass" class="w3-modal">
  <div class="w3-modal-content">

    <header class="w3-container w3-blue"> 
      <span onclick="document.getElementById('addBlockClass').style.display='none'" 
      class="w3-button w3-display-topright">&times;</span>
      <h5>Enroll Block Section Selection </h5>
    </header>

    <div class="w3-container w3-padding">
      
      <?php echo "<h5 class='w3-center'><b>SY ".$sy." ( ".$sem." )</b></h5>"; 
        $querySectionLists = "select * from sections where section_code like ? and course_code=?";
        $sectionLists = $conn->prepare($querySectionLists);
        $sectionLists->execute(array("%".$cue."%",$courseCode));
        
        while($sectionListsRow = $sectionLists->fetch(PDO::FETCH_ASSOC)){

          $sectionx = $sectionListsRow['section_code'];
          $pushThis = $sectionx.",".$sid.",".$sem.",".$sy.",".$isRegular.",".$courseCode;
            ?>
            <button onclick="showSectionContent('<?php echo  $sectionx; ?>')" class="w3-button w3-block w3-blue w3-left-align w3-center" style="border-top: 1px lightgray solid; font-family: arial narrow; font-weight: 800; font-size: 1.2em;"><?php echo  $sectionx; ?></button>

            <div id="<?php echo  $sectionx; ?>" class="w3-hide w3-container">
            <?php
                    $csys = getClassSYSem($conn, $sem, $sy, $sectionx);
                //if(){
                  if($isRegular=="REGULAR" && !empty($csys)){
              ?>
            <div class="w3-container w3-padding">
              <div style="display: none;">
                <span id="stuID"><?php echo  $sid; ?></span>
                <span id="syID"><?php echo  $sy; ?></span>
                <span id="semID"><?php echo  $sem; ?></span>
              </div>

              <span id="blockRes" class="w3-left"></span>
              <button id="enrollBlock" onclick="enrollBlockSubject('<?php echo  $pushThis; ?>')" class="w3-button w3-blue w3-right">Enroll this Block</button>
            </div>
              <?php
            }?>
              <table class="w3-table">
                <?php 
                if(!empty($csys)){

                    classBlockTableHead(); 
                    getClassBlock($conn,$sectionx,$sy,$sem,$isRegular);

                }
                else{
                    echo "<div class='w3-row text-center' style='padding: 50px; font-weight: bold;'>No Subjects for SY ".$sy." ".$sem." yet!</div>";
                } 

                ?>
                </table>
            </div>
          <?php } ?>
  </div>
  </div>
</div>
<!-- ********************************ADD BLOCK SUBJECT END******************************** -->


<script src="../lib/js/draggable.js"></script>
<script>
    //dragElement(document.getElementById("editStudentByAdminForm"));
    function openEditForm(id){
        var id=id;
        document.getElementById('editStudentInfo').style.display='block';
        document.getElementById('studentID').value = id;
    }
    function changetodate(iname){
        //var name = name;
        document.getElementById(iname).setAttribute('type','date');

    }
    function openFileUploader(){
        document.getElementById("fileUploader").style.display = "block";
    }

</script>
<script>
function showSectionContent(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace("w3-blue", "w3-gray");
    } else { 
        x.className = x.className.replace(" w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace("w3-gray", "w3-blue");
    }
}


function enrollBlockSubject(id){
  var section = id;
  
  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          //console.log(this.responseText);
          var res = this.responseText;
          //document.getElementById('blockRes').innerHTML = res;
          
          alert(res);
          location.reload(true);
          
          //document.getElementById('enrollBlock').attrubute = "disabled";
        }
    };
    xhttp.open("POST", "../app/add_block_section.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("section="+section);

}
</script>
