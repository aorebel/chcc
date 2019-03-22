<?php 
$tu = getTeacherUnits($conn, $sem, $sy, $sid);
$commid = "1";

$cStat = checkCommand($conn, $commid);
//echo $cStat;

?>

<head>
	<title>Teacher Class</title>
	<style>
		.hide{
			display: none;
		}
		.show{
			display: block;
		}
	</style>
    <script>

        function toggleAddClassDiv(){
            var addTC = document.getElementById("addTC").innerHTML;
            var div = document.getElementById("addClassDiv");
            //alert(addTC);
            //div.classList.toggle("hide");
            div.style.display = 'block';

        }
        function toggleOptions(id){
            var div = document.getElementById(id);
            //alert(addTC);
            div.classList.toggle("hide");
        }
    </script>
</head>

<div class="w3-padding">
<?php

if($tu!="29"){
    ?>
        <button class="w3-button w3-yellow w3-right" id="addTC" onclick="toggleAddClassDiv();" style="margin-bottom: 50px;">Add Class</button>
    <?php   
}else{
    ?>
        <button class="w3-button w3-gray w3-right" style="margin-bottom: 50px;" disabled>Add Class</button>
    <?php  
}


?>
</div>

<div class="w3-padding">
<h4 class="w3-center">
	Lists of Classes<br>
	SY <?php echo $sy." ( ".$sem." )"; ?>
</h4>
<span class="w3-right"><b>Total Units: <?php echo $tu; ?></b></span>
<table class="w3-table">
    <tr>
        <th class="w3-border">Section</th>
        <th class="w3-border">Units</th>
        <th class="w3-border">Subject Code</th>
        <th class="w3-border">Subject</th>
        <th class="w3-border">Room</th>
        <th class="w3-border">Days</th>
        <th class="w3-border">Time Start</th>
        <th class="w3-border">Time End</th>
        <th class="w3-border">Action</th>
    </tr>
    <?php 
        
        $tClassess = getTeacherClass($conn, $sid,$sy,$sem);
        while($tcRow = $tClassess->fetch(PDO::FETCH_ASSOC)){
        $tc = $tcRow['class_code'];
        $queryTclassess = "select * from classsubjects where class_code = ? and sem=? and school_year=?";
        $tclassess = $conn->prepare($queryTclassess);
        $tclassess->execute(array($tc,$sem,$sy));
        $tccrow = $tclassess->fetch(PDO::FETCH_ASSOC);

        $querySubjectsss = "SELECT * from subjects where id = ?";
        $getSubjectsss = $conn->prepare($querySubjectsss);
        $getSubjectsss->execute(array($tccrow['subject_id']));
        $sssrow = $getSubjectsss->fetch(PDO::FETCH_ASSOC);

        ?>

        <tr class="w3-center">
          <td class=" w3-center"><?php echo $tccrow['section_code']; ?></td>
          <td class=" w3-center">
            <?php 
            if($sssrow['subject_type']=="With Lab"){
                if(substr($tccrow['class_code'], -1)=="L"){
                    echo "1";
                }else{
                    echo "2"; 
                }
            }else{
                echo $sssrow['total_units'];
            }
            
            
            ?>
              
          </td>
          <td class=" w3-center"><?php echo $tccrow['subject_code']; ?></td>
          <td class=" w3-center"><?php echo $tccrow['subject']; ?></td>
          <td class=" w3-center"><?php echo $tccrow['room']; ?></td>
          <td class=" w3-center"><?php echo $tccrow['sched_day']; ?></td>
          <td class=" w3-center"><?php echo $tccrow['sched_time_start']; ?></td>
          <td class=" w3-center"><?php echo $tccrow['sched_time_end']; ?></td>
          <?php
          if($cStat=="Open"){
            ?>
            <td class="w3-center"><button class="w3-button w3-red" onclick="deleteClass('<?php echo $tccrow['class_code']; ?>','<?php echo $sid;?>','<?php echo $sem;?>','<?php echo $sy;?>')"><i class="fas fa-trash-alt"></i></button></td>
            <?php
          }
          else{
            ?>
            <td class="w3-center"><button class="w3-button w3-gray"  disabled><i class="fas fa-trash-alt"></i></button></td>
            <?php
          }
          ?>
        </tr>
       
        <?php
         

    }

    ?>
</table>
</div>
<hr>


<div id="addClassDiv" class="w3-modal">
  <div class="w3-modal-content" >

    <header class="w3-container w3-blue"> 
      <span onclick="document.getElementById('addClassDiv').style.display='none'" 
      class="w3-button w3-display-topright">&times;</span>
      <h5>Add Class for Teacher</h5>
    </header>

    <div class="w3-container" style="height: 500px; overflow-y: auto;">

        <div class="w3-padding w3-row" id="">
        <h4 class="w3-center">
            Lists of  Available Classes by Course<br>
            SY <?php echo $sy." ( ".$sem." )"; ?>
        </h4>
        <div class="w3-padding w3-center">
        <?php 
            $ccid = 0;
            $cCodes = getClassGroup($conn,$sem,$sy);
            while($ccRow = $cCodes->fetch(PDO::FETCH_ASSOC)){
                $ccid++;
                $ccc = $ccRow['course_code']; 
            ?>      
            <div class="w3-container">
                <button class="w3-input w3-gray" onclick="toggleOptions('<?php echo $ccid; ?>')"><?php echo $ccc;?></button>
                <div class="w3-container hide" id="<?php echo $ccid; ?>">
                    
                    <div class="w3-col s12 m2">
                        <h4>Monday</h4>
                        <?php 
                            $day = "M";
                            getClassTime($conn, $sid, $sem, $sy, $ccc, $day);
                        ?>
                    </div>
                    <div class="w3-col s12 m2">
                        <h4>Tuesday</h4>
                        <?php 
                            $day = "T";
                            getClassTime($conn, $sid, $sem, $sy, $ccc, $day);
                        ?>
                    </div>
                    <div class="w3-col s12 m2">
                        <h4>Wednesday</h4>
                        <?php 
                            $day = "W";
                            getClassTime($conn, $sid, $sem, $sy, $ccc, $day);
                        ?>
                    </div>
                    <div class="w3-col s12 m2">
                        <h4>Thursday</h4>
                        <?php 
                            $day = "Th";
                            getClassTime($conn, $sid, $sem, $sy, $ccc, $day);
                        ?>
                    </div>
                    <div class="w3-col s12 m2">
                        <h4>Friday</h4>
                        <?php 
                            $day = "F";
                            getClassTime($conn, $sid, $sem, $sy, $ccc, $day);
                        ?>
                    </div>
                    <div class="w3-col s12 m2">
                        <h4>Saturday</h4>
                        <?php 
                            $day = "S";
                            getClassTime($conn, $sid, $sem, $sy, $ccc, $day);
                        ?>
                    </div>
                </div>
            </div>  
            <?php
            }

        ?>
        </div>

    </div>

    </div>

  </div>
</div>




<div id="sClass" class="w3-modal">
  <div class="w3-modal-content">

    <header class="w3-container w3-blue"> 
      <span onclick="document.getElementById('sClass').style.display='none'" 
      class="w3-button w3-display-topright">&times;</span>
      <h4>Select Class from <span id="cCourse"></span> for <span id="day"></span> with start time ranging from <span id="timeStart"></span> to <span id="timeEnd"></span> Schedule</h4>
    </header>

    <div class="w3-container w3-padding" id="classSelection">
      
    </div>

  </div>
</div>


<script>
    //location.reload();
    
    function showClasses(id){
        //alert(id);
        var data = id.split(",");
        var day;
        /*if(data[0]=="M"){
            day = "Monday";
        }
        else if(data[0]=="T"){
            day = "Tuesday";
        }
        else if(data[0]=="W"){
            day = "Wednesday";
        }
        else if(data[0]=="Th"){
            day = "Thursday";
        }
        else if(data[0]=="F"){
            day = "Friday";
        }
        else if(data[0]=="S"){
            day = "Saturday";
        }*/
        var sid = "<?php echo $sid?>";
        //alert(sid);
        //var res = str.slice(0,5);
        document.getElementById("cCourse").innerHTML = data[3];
        document.getElementById("day").innerHTML = data[0];
        document.getElementById("timeStart").innerHTML = data[1].slice(0,5);
        document.getElementById("timeEnd").innerHTML = data[2].slice(0,5);
        document.getElementById("sClass").style.display = 'block';

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("classSelection").innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "../methods/class-selection.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("day="+data[0]+"&timeStart="+data[1]+"&timeEnd="+data[2]+"&course="+data[3]+"&sid="+sid);
    }
    function addTClass(id){
        var data = id.split(",");
        var sem = data[0];
        var sy = data[1];
        var eid = data[2];
        var tclass = data[3];
        var xhttp = new XMLHttpRequest(); 
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //document.getElementById("classSelection").innerHTML = this.responseText;
              //var res = JSON.parse(this.responseText);
              var res = this.responseText;
              if(res=="error"){
                document.getElementById("atcRes").innerHTML = "Teacher already have this class";
              }
              else if(res=="failed"){
                document.getElementById("atcRes").innerHTML = "Server error";
              }
              else if(res=="full"){
                document.getElementById("atcRes").innerHTML = "Overload! Teacher cannot handle more than 29 units";
              }
              else{
                location.reload();
                //alert(res);
              }

            }
        };
        xhttp.open("POST", "../app/add_teacher_class.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("sem="+sem+"&sy="+sy+"&eid="+eid+"&tclass="+tclass);
        //alert(id);
    }
    function deleteClass(tclass,eid,sem,sy){
        console.log(tclass);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //document.getElementById("classSelection").innerHTML = this.responseText;
              alert(this.responseText);
              location.reload();

            }
        };
        xhttp.open("POST", "../app/remove_teacher_class.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("sem="+sem+"&sy="+sy+"&eid="+eid+"&class="+tclass);
    }

</script>
 