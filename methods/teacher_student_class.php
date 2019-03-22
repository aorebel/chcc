<?php 

$queryClasses = "SELECT * from teacher_classes where sem =? and school_year=? and emp_id = ?";
$classes = $conn->prepare($queryClasses);
$classes->execute(array($sem,$sy,$sid));
$ccRow = $classes->fetch(PDO::FETCH_ASSOC);

if(empty($ccRow)){ ?>
    <div class="w3-row jumbo text-center">No Subjects for SY <?php echo $sy." ".$sem." yet"; ?></div>
<?php }
else{


?>

<div class="w3-container w3-padding" id="<?php echo $ccid; ?>" style="margin-bottom: 50px;">
                   
    <div class="w3-col s12 m2">
        <h4 style="text-align: center;font-weight: bold;">Monday</h4>
        <?php 
            $day = "M";
            getTeacherSched($conn, $sid, $sem, $sy, $day);
        ?>
    </div>
    <div class="w3-col s12 m2">
        <h4 style="text-align: center;font-weight: bold;">Tuesday</h4>
        <?php 
            $day = "T";
            getTeacherSched($conn, $sid, $sem, $sy, $day);
        ?>
    </div>
    <div class="w3-col s12 m2">
        <h4 style="text-align: center;font-weight: bold;">Wednesday</h4>
        <?php 
            $day = "W";
            getTeacherSched($conn, $sid, $sem, $sy, $day);
        ?>
    </div>
    <div class="w3-col s12 m2">
        <h4 style="text-align: center;font-weight: bold;">Thursday</h4>
        <?php 
            $day = "Th";
            getTeacherSched($conn, $sid, $sem, $sy, $day);
        ?>
    </div>
    <div class="w3-col s12 m2">
        <h4 style="text-align: center;font-weight: bold;">Friday</h4>
        <?php 
            $day = "F";
            getTeacherSched($conn, $sid, $sem, $sy, $day);
        ?>
    </div>
    <div class="w3-col s12 m2">
        <h4 style="text-align: center;font-weight: bold;">Saturday</h4>
        <?php 
            $day = "S";
            getTeacherSched($conn, $sid, $sem, $sy, $day);
        ?>
    </div>
</div>


<div id="showStudentsList" class="w3-modal">
  <div class="w3-modal-content">

    <header class="w3-container w3-blue"> 
      <span onclick="document.getElementById('showStudentsList').style.display='none'" 
      class="w3-button w3-display-topright">&times;</span>
      <h3>Student Lists</h3>
    </header>

    <div id="studentLists" class="w3-container" style="margin-bottom: 50px;">
      
    </div>

  </div>
</div>

<?php  } ?>

<script>
	function showStudentsOnTeacher(cc){

		document.getElementById("showStudentsList").style.display = 'block';
		var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //document.getElementById("classSelection").innerHTML = this.responseText;

              document.getElementById("studentLists").innerHTML = this.responseText;

            }
        };
        xhttp.open("POST", "../methods/viewStudentsByTeacher.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("class="+cc);
	}
</script>