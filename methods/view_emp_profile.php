
<?php 
$urole = $erole;
$bdate = date($emp['bdate']);
$age = substr(date('Ymd') - date('Ymd', strtotime($bdate)), 0, -4);

if($emp['status']==null){
  $stats = "Status not yet set";
}else{
  $stats = $emp['status'];
}
?>

<div id="profile" class="w3-container w3-padding"><br>
    <div class=" w3-col m12 l2" style="background: #fff; color: #fff;">hi</div>    
    <div class=" w3-col m12 l2">
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
          <h4 style="margin-top: -17px; font-size: 20px; font-family: century gothic;"><?php echo strtoupper($emp['role']); ?></h4>
        </div>
    </div>
    <div class="w3-col m12 l5 w3-padding" style="background: lightgrey; height: 305px !important;">
        
        <h2 class="w3-center"><?php echo $fullname; ?></h2>
        <p class="w3-center" style="margin-top: -15px; "><?php echo strtoupper($stats); ?></p><hr>
        <div style="font-size: 18px; font-family: century gothic;">
        <span class="w3-tab" style="">AGE: <?php echo $age; ?> YEARS OLD</span><br>
        <span class="w3-tab" style="">BIRTHDATE: <?php echo $bdate?></span><br>
        <span class="w3-tab" style="">GENDER: <?php echo $emp['gender']?></span><br>
        <span class="w3-tab" style="">CONTACT NO: <?php echo $emp['contact']?></span><br>
        <span class="w3-tab" style="">EMAIL ADDRESS: <?php echo $emp['email']?></span><br>
        <span class="w3-tab" style="">
        REGISTRATION DATE: <?php echo $emp['hire_date']?></span><br><br>
        </div>
    </div>
    <div class="w3-col m12 l3 w3-padding w3-center">
        
        <h5 class="w4-card w3-black w3-padding">Employments Status</h5>
        
        <span class="w3-tab">AY: <?php echo $sy; ?></span><br>
        <span class="w3-tab">Semester: <?php echo $sem; ?></span><br>
        <span class="w3-tab"><?php echo strtoupper($stats); ?></span><br>
    </div> 
    
</div>
<div class="w3-padding">
    
    <button class="w3-input w3-green w3-padding" style="margin-top: 20px !important;line-height: 30px; height: 50px; font-size: 18px; font-family: century gothic; font-weight: 500;" onclick="openEditForm('<?php echo $id; ?>')"><i class="fa fa-edit" ></i> Edit Information</button>
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
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="hidden" name="role" value="<?php echo $emp['role']; ?>">
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

<div id="editInfo" class="w3-modal">

    
  <div class="w3-modal-content" style="margin-top: -60px;">
    <header class="w3-container w3-blue"> 
      <span onclick="document.getElementById('editInfo').style.display='none'" 
      class="w3-button w3-display-topright">&times;</span>
      <h5>Edit Employee Information Form</h5>
    </header>

    <div class="w3-container">
      <?php require_once('../templates/edit-student-by-admin.php'); ?>
    </div>
  </div>
</div>





<script>
    function openFileUploader(){
        document.getElementById("fileUploader").style.display = "block";
    }
    function openEditForm(id){
        var id=id;
        document.getElementById('editInfo').style.display='block';
        //document.getElementById('studentID').value = id;
    }
</script>
