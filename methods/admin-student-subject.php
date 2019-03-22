<?php 

?>
<div class="w3-container">
<?php
if(($eRow['id']=="1") && ($eRow['status']=="Open") ){
  if(empty($assRow)){
  	if( ($isRegular=="REGULAR") ){
  		?>
  	
  		<?php if(empty($scRow)){ ?>
  		<button onclick="document.getElementById('addBlockClassx').style.display='block'" class="w3-button w3-yellow w3-right">Enroll Subjects in Block Section</button>
  		<?php } 
  	}
  	else {

  		?>
  	
  		<button onclick="document.getElementById('addCurrentClassx').style.display='block'" class="w3-button w3-yellow w3-right">Enroll New Subjects</button>

  		<?php
  	}
  }else{
    if( ($isRegular=="REGULAR") ){
      ?>
    
      <?php if(empty($scRow)){ ?>
      <button onclick="document.getElementById('addBlockClassx').style.display='block'" class="w3-button w3-yellow w3-right" disabled>Enroll Subjects in Block Section</button>
      <?php } 
    }
    else {

      ?>
    
      <button onclick="document.getElementById('addCurrentClass').style.display='block'" class="w3-button w3-yellow w3-right" disabled>Enroll New Subjects</button>

      <?php
    }
  }
}else{
  ?>

  <h3 class="w3-red w3-center"><i class="fas"></i>Enrollment is currently close</h3>
  <?php
}
?>
</div>
<?php
if($assRow){
?>
<h4 class="w3-center">

	<?php 
		if( ($sy == $enrollmentRow['school_year']) && ($sem == $enrollmentRow['sem']) ){
			echo "Enrolled Subjects for ";
		}
		else{
			echo "Pre-Enrolled Subjects for ";
		}
		echo $sy." - ".$sem ;
	?>
</h4>


<hr style="margin-top: 10px;">

<div id="studentSubjectOnAdmin">
	
	<table class="w3-table">
		<tr class="w3-border-bottom">
			<th>Section</th>
			<th>Class</th>
			<th>Subject Code</th>
			<th>Subject</th>
			<th>Days</th>
			<th>Class Start</th>
			<th>Class End</th>
			<th>Room</th>
		</tr>
	<?php 
		$page = "subject";
    $querySS = "select * from studentassessment where student=? and sem=? and school_year=? order by class_code ASC";
    $stmtSS = $conn->prepare($querySS);
    $stmtSS->execute(array($sid,$sem,$sy));
    $totalUnits = 0;
    $totalLab = 0;
    while($rowSS = $stmtSS->fetch(PDO::FETCH_ASSOC)){
      ?>

      
        <tr>
          <td><?php echo $rowSS['section_code']; ?></td>
          <td><?php echo $rowSS['class_code']; ?></td>
          <td><?php echo $rowSS['subject_code']; ?></td>
          <td>
            <?php 
            if(strstr($rowSS['class_code'], "L")){
              echo $rowSS['subject']." Lab"; 
              $totalLab ++;
              //$totalUnits -= $rowSS['units'];
            }
            else{
              echo $rowSS['subject']; 
              $totalUnits += $rowSS['units'];
            }
            
            ?>
              
          </td>
          <td><?php echo str_replace("-", "", $rowSS['sched_day']); ?></td>
          <td><?php echo $rowSS['sched_time_start']; ?></td>
          <td><?php echo $rowSS['sched_time_end']; ?></td>
          <td><?php echo $rowSS['room']; ?></td>

        </tr>
        

      <?php
      
      
    }
    if($page == "subject"){
    ?><h3 class="w3-right"><?php echo "Total Units: ".$totalUnits." | Lab Units: ".$totalLab; ?></h3><?php }







	?>
	</table>
</div>

<?php }else{ ?>
<h1 class="text-center" style="margin-top: 150px;">No Subjects for SY <?php echo $sy." ".$sem." yet"; ?></h1>
<?php } ?>

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
<div id="addBlockClassx" class="w3-modal">
  <div class="w3-modal-content">

    <header class="w3-container w3-blue"> 
      <span onclick="document.getElementById('addBlockClassx').style.display='none'" 
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
            <button onclick="showSectionContent('<?php echo  $sectionx."X"; ?>')" class="w3-button w3-block w3-blue w3-left-align w3-center" style="border-top: 1px lightgray solid; font-family: arial narrow; font-weight: 800; font-size: 1.2em;"><?php echo  $sectionx; ?></button>

            <div id="<?php echo  $sectionx."X"; ?>" class="w3-hide w3-container">
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
<?php 

	

?>
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
          location.reload();
          
          //document.getElementById('enrollBlock').attrubute = "disabled";
        }
    };
    xhttp.open("POST", "../app/add_block_section.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("section="+section);

}
</script>
