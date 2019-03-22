<div class="w3-padding">
<h4 class="w3-center">
	Lists of Classes<br>
	SY <?php echo $sy." ( ".$sem." )"; ?>
</h4>
<span class="w3-right"><b>Total Units: <?php echo $tu; ?></b></span>
<table class="w3-table">
    <tr>
        <th class="w3-border">Section</th>
        <th class="w3-border">Class Code</th>
        <th class="w3-border">Subject Code</th>
        <th class="w3-border">Subject</th>
        <th class="w3-border">Room</th>
        <th class="w3-border">Days</th>
        <th class="w3-border">Time Start</th>
        <th class="w3-border">Time End</th>        
        <th class="w3-border">Units</th>
    </tr>
    <?php 
        
        $tClassess = getTeacherClass($conn, $sid,$sy,$sem);
        while($tcRow = $tClassess->fetch(PDO::FETCH_ASSOC)){
        $tc = $tcRow['class_code'];
        $queryTclassess = "select * from classsubjects where class_code = ? and sem=? and school_year=?";
        $tclassess = $conn->prepare($queryTclassess);
        $tclassess->execute(array($tc,$sem,$sy));
        $tccrow = $tclassess->fetch(PDO::FETCH_ASSOC);
        ?>

        <tr class="w3-center">
          <td class=" w3-center"><?php echo $tccrow['section_code']; ?></td>
          <td class=" w3-center"><?php echo $tccrow['class_code']; ?></td>
          <td class=" w3-center"><?php echo $tccrow['subject_code']; ?></td>
          <td class=" w3-center"><?php echo $tccrow['subject']; ?></td>
          <td class=" w3-center"><?php echo $tccrow['room']; ?></td>
          <td class=" w3-center"><?php echo $tccrow['sched_day']; ?></td>
          <td class=" w3-center"><?php echo $tccrow['sched_time_start']; ?></td>
          <td class=" w3-center"><?php echo $tccrow['sched_time_end']; ?></td>
          <?php 
          if($tccrow['subject_type']=="With Lab"){
            if(substr($tccrow['class_code'], -1)=="L"){
              echo "<td class=' w3-center'>1</td>";
            }
            else{
              echo "<td class=' w3-center'>2</td>";
            }
          }
          else{
            $subj = $tccrow['subject_id'];
            $subunit = getSubjectBySubjectCode($conn, $subj);
            $srow = $subunit->fetch(PDO::FETCH_ASSOC);
            echo "<td class=' w3-center'>".$srow['total_units']."</td>";
          }
          ?>
         
       
        <?php
         

    }

    ?>
</table>
</div>