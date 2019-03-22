<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<body onload="getTabUrl()">
<div style="display: none;">
  
<?php 

require_once('../app/config/connect.php');
require_once('../app/functions.php');
require_once('../app/session.php');
include('../templates/header.html');
if($role!="admin"){
    ob_start();
    header("Location: ../index.php");
    session_destroy();
    ob_end_flush();
}
$course_id = $_REQUEST['cid'];
$sy = "2018-2019";
 
$courseRow = getCourseCode($conn, $course_id);

?>
  
</div>
  

<h2 class="w3-center"><?php echo $courseRow['course']; ?>(<?php echo $courseRow['course_code'];?>)</h2>
<?php 
  if(!empty($courseRow['major'])){
?>
<h4 class="w3-center">Major in <?php echo $courseRow['major']; ?></h4>

<?php } ?>
<div class="w3-sidebar w3-bar-block w3-blue w3-card" style="width:10%; height: 100% !important; top: 0 !important;">
  <img src="../lib/res/Logo.png" width="125" style="margin-top: 0px; padding: 5px;">
  <h5 class="w3-bar-item">Menu</h5>
  <button id="btnSection" class="w3-bar-item w3-button courseTabLink" onclick="openCourseTab(event, 'Section','<?php echo $course_id; ?>')">Section</button>
  <button id="btnClass" class="w3-bar-item w3-button courseTabLink" onclick="openCourseTab(event, 'Class','<?php echo $course_id; ?>')">Class</button>
  <button id="btnSubject" class="w3-bar-item w3-button courseTabLink" onclick="openCourseTab(event, 'Subjects','<?php echo $course_id; ?>')">Subjects</button>
  <a href="../admin/admin.php?page=Academics" class="w3-bar-item w3-button courseTabLink"><i class="fa fa-arrow-left"></i>Back</a>
</div>
<div style="margin-left:10%; height: 100%; margin-top: -10px !important;" > 

  <div id="Section" class="w3-container courseTab" style="display:none; margin-bottom: 50px;">
    <h2>Section</h2>
    <?php
    	require_once('../methods/showYearLevelBySection.php');
    ?>
  </div>

  <div id="Class" class="w3-container courseTab" style="display:none; margin-bottom: 50px;">
    <h2>Class</h2>
    <?php
    	require_once('../methods/showYearLevelByClass.php');
    ?>
  </div>

  <div id="Subjects" class="w3-container courseTab" style="display:none; margin-bottom: 50px;">
    <h2>Subjects</h2>
    <?php
    	require_once('../methods/showYearLevelBySubject.php');
    ?>
  </div>

</div>

</body>
<script>
  function openEditSubject(id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if(this.readyState == 4 && this.status == 200) {
        var res = this.responseText;
        alert(res);
        if(res.includes("success")){
          location.reload();
        }
      }
    };
    xhttp.open("POST", "../app/delete_subject.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id="+id);
  }
  function showAddSubjectForm(){
    document.getElementById("addSubjectForm").style.display = 'block';
  }
</script>