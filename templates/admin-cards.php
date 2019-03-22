<?php 

require_once('../app/config/connect.php');
require_once('../app/functions.php');
require_once('../methods/studentPercentPerCourse.php');


$Enrollment = checkCommand($conn, "1");
$curFee1 = curFee("I",$conn);
$curFee2 = curFee("II",$conn);
$curFee3 = curFee("III",$conn);
$curFee4 = curFee("IV",$conn);


?>
<div class="w3-row-padding w3-margin-bottom">
  <p class="w3-card w3-light-gray w3-padding" style="margin-bottom: 20px; font-family: century gothic; font-size: 12px;">
    Note: This system autmatically detects school year and Semester period. 1st semester always starts from the month of June and ends on the month of October. 2nd semester, otherwise, starts from the month of November and end on the month of April. 
  </p>
  
  

    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-user w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $studentCount;?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Students</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-edit w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $teacherCount;?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Teachers</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-coins w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $cashierCount;?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Cashiers</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-building w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $adminCount;?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Administrators</h4>
      </div>
    </div>
  </div>

  <!--div class="w3-container">
    <h5>Student Population</h5>
    <p>New Students</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-green" style="width:25%">25%</div>
    </div>

    <p>Transferees</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-orange" style="width:20%">20%</div>
    </div>

    <p>Regular</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-red" style="width:55%">55%</div>
    </div>
    <p>Irregular</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-blue" style="width:65%">65%</div>
    </div>
  </div-->
  <hr>

  <div class="w3-container">
    <h5>
      Student Population for S.Y. 
      <?php 
        $year = date("Y");
        $year2 = $year+1;
        $sy = $year."-".$year2;
        echo $sy;
      ?> 
      (<?php echo $studentCount?>)
    </h5>
    <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
     <?php 
      while($coursex=$getCourses->fetch(PDO::FETCH_ASSOC)){
      $studentsPerCourse = courseCountStudent($conn, $coursex['course_code']);
      $coursePercent = ($studentsPerCourse/$studentCount);
      $cp = $coursePercent*100;
      /*echo "<tr>";
      echo "<td>".$coursex['course']."</td>";
      echo "<td>".number_format($cp, 2, '.', '')."</td>";
      echo "</tr>";*/
      ?>
      <tr>
        <td><?php echo $coursex['course']; ?></td>
        <td><?php echo number_format($cp, 2, '.', ''); ?>%</td>
      </tr>
      <?php
      }?>
      <tr>
        <td>Unregistered</td>
        <td>
          <?php 
            $unreg = courseCountStudent($conn, "UNCONFIRMED");
            $unregPercent = ($unreg/$studentCount);
            $up = $unregPercent*100;
            echo number_format($up, 2, '.', ''); 
          ?>
          %
        </td>
      </tr>
      <!--tr>
        <td>Russia</td>
        <td>5.6%</td>
      </tr>
      <tr>
        <td>Spain</td>
        <td>2.1%</td>
      </tr>
      <tr>
        <td>India</td>
        <td>1.9%</td>
      </tr>
      <tr>
        <td>France</td>
        <td>1.5%</td>
      </tr-->
    </table><br>
    <!--button class="w3-button w3-dark-grey">More Countries  <i class="fa fa-arrow-right"></i></button-->
  </div>       

  <hr>
 
 <div id="adcom" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4 add-academics" style="">
        <header class="w3-container w3-teal"> 
            <span onclick="document.getElementById('adcom').style.display='none'" 
            class="w3-button w3-display-topright">&times;</span>
            <h4>SETTINGS</h4>
        </header>
        <div class="w3-container">
        <!form action="../app/command.php" method="post"-->
        <div class="w3-row" id="Enrollment" style="display: none;">
          <!-- OPEN/CLOSE ENROLLMENT -->
          <?php
          $commandStatus = checkCommandStatus($conn, "1", "Open");
          if($commandStatus){
            ?>
            <div class="w3-col s12 m12 w3-green w3-right" style="margin-top: 20px;" > 
              <label class="w3-left w3-padding">Enrollment is <span id="cstat1"><?php echo checkCommand($conn, "1");  ?></span></label>
              <input type="hidden" name="status" value="Close">
              <input type="hidden" name="commandID" value="1">
              <button class="w3-button w3-right w3-blue" id="btnCommand1" onclick="executeCommand('1', 'Close')" >Close</button>

            </div>
              <?php
            }else{
          ?>
          <div class="w3-col s12 m12 w3-red w3-right" style="margin-top: 20px;"> 
            <label class="w3-left w3-padding">Enrollment is <span id="cstat1"><?php echo checkCommand($conn, "1");  ?></span></label>
            <input type="hidden" name="status" value="Open">
              <input type="hidden" name="commandID" value="1">
            <button class="w3-button w3-right w3-blue w3-right" id="btnCommand1" onclick="executeCommand('1', 'Open')" >Open</button>
          </div>
        <?php } ?>
       </div>
       <div class="w3-row" id="Grading" style="display: none;"">
          <!-- OPEN/CLOSE PRELIMS-->
               
        <?php
          $commandStatus = checkCommandStatus($conn, "6", "Open");
          if($commandStatus){
            ?>
            <div class="w3-col s12 m12 w3-green" style="margin-top: 20px;"> 
              <label class="w3-left w3-padding">Add Prelims Grade is <span id="cstat6"><?php echo checkCommand($conn, "6");  ?></span></label>
              <input type="hidden" name="status" value="Close">
              <input type="hidden" name="commandID" value="6">
              <button class="w3-button w3-right w3-blue" id="btnCommand6" onclick="executeCommand('6', 'Close')" >Close</button>

            </div>
              <?php
            }else{
          ?>
          <div class="w3-col s12 m12 w3-red" style="margin-top: 20px;"> 
            <label class="w3-left w3-padding">Add Prelims Grade is <span id="cstat6"><?php echo checkCommand($conn, "6");  ?></span></label>
            <input type="hidden" name="status" value="Open">
              <input type="hidden" name="commandID" value="6">
            <button class="w3-button w3-right w3-blue" id="btnCommand6" onclick="executeCommand('6', 'Open')" >Open</button>
          </div>
        <?php } ?>
        

        <!-- OPEN/CLOSE MIDTERMS-->

         <?php
          $commandStatus = checkCommandStatus($conn, "3", "Open");
          if($commandStatus){
            ?>
            <div class="w3-col s12 m12 w3-green" style="margin-top: 20px;"> 
              <label class="w3-left w3-padding">Add Midterms Grade is <span id="cstat3"><?php echo checkCommand($conn, "3");  ?></span></label>
              <input type="hidden" name="status" value="Close">
              <input type="hidden" name="commandID" value="3">
              <button class="w3-button w3-right w3-blue" id="btnCommand3" onclick="executeCommand('3', 'Close')" >Close</button>

            </div>
              <?php
            }else{
          ?>
          <div class="w3-col s12 m12 w3-red" style="margin-top: 20px;"> 
            <label class="w3-left w3-padding">Add Midterms Grade is <span id="cstat3"><?php echo checkCommand($conn, "3");  ?></span></label>
            <input type="hidden" name="status" value="Open">
              <input type="hidden" name="commandID" value="3">
            <button class="w3-button w3-right w3-blue" id="btnCommand3" onclick="executeCommand('3', 'Open')" >Open</button>
          </div>
        <?php } ?>
          
          <!-- OPEN/CLOSE FINALS-->

         <?php
          $commandStatus = checkCommandStatus($conn, "5", "Open");
          if($commandStatus){
            ?>
            <div class="w3-col s12 m12 w3-green" style="margin-top: 20px;"> 
              <label class="w3-left w3-padding">Add Finals Grade is <span id="cstat5"><?php echo checkCommand($conn, "5");  ?></span></label>
              <input type="hidden" name="status" value="Close">
              <input type="hidden" name="commandID" value="5">
              <button class="w3-button w3-right w3-blue" id="btnCommand5" onclick="executeCommand('5', 'Close')" >Close</button>

            </div>
              <?php
            }else{
          ?>
          <div class="w3-col s12 m12 w3-red" style="margin-top: 20px;"> 
            <label class="w3-left w3-padding">Add Finals Grade is <span id="cstat5"><?php echo checkCommand($conn, "5");  ?></span></label>
            <input type="hidden" name="status" value="Open">
              <input type="hidden" name="commandID" value="5">
            <button class="w3-button w3-right w3-blue" id="btnCommand5" onclick="executeCommand('5', 'Open')" >Open</button>
          </div>
        <?php } ?>
        <!--/form-->
        </div>
    </div>
    </div>
</div>

<div id="AcadFee" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4 add-academics" style="">
        <header class="w3-container w3-teal"> 
            <span onclick="document.getElementById('AcadFee').style.display='none'" 
            class="w3-button w3-display-topright">&times;</span>
            <h4>SETTINGS</h4>
        </header>
        <div class="w3-container w3-padding">
          <p class="verdana">
            This section allows you to choose which payment computation to use for the current school year.
            <br>
            Note: System automatically detects Academic Year and Semester.
            <br>
            Attention! <br>
            Please change settings on this section only before any new enrollments are performed to avoid issues on students fees.

          </p>
          <div class="w3-row" id="saveCur">
            
          </div>
          <div class="w3-row" style="margin-bottom: 5px;">
            <div class="w3-col s12 m3">
              <label for="">1st Year Students</label>
            </div>
            <?php if($Enrollment == "Open"){ ?>
            
            <div class="w3-col s12 m4">
              <select name="acadFee" id="acadFee1" class="w3-input w3-border w3-padding" disabled>
                <option value=""><?php echo $curFee1['fee_name'] ?></option>
              </select>
            </div>
          
            <div class="w3-col s12 m4">
              <select name="acadFee" id="acadVer1" class="w3-input w3-border w3-padding" disabled>
                <option value=""><?php echo $curFee1['version'] ?></option>
              </select>
            </div>   
            <?php }else{
              ?>

              <div class="w3-col s12 m4">
              <select name="acadFee" id="acadFee1" class="w3-input w3-border w3-padding" onclick="showCurriculum('acadFee1')">
                <option value=""><?php echo $curFee1['fee_name'] ?></option>
              </select>
            </div>
          
            <div class="w3-col s12 m4">
              <select name="acadFee" id="acadVer1" class="w3-input w3-border w3-padding" onclick="showCurriculumVer('acadVer1')" onchange="//saveFee('I')">
                <option value=""><?php echo $curFee1['version'] ?></option>
              </select>
            </div>

              <?php
            } ?> 
            <div class="w3-col s12 m1">
              <button class="w3-blue w3-button" onclick="saveFee('I')">Save</button>
            </div>        
          </div>

           <div class="w3-row" style="margin-bottom: 5px;">
            <div class="w3-col s12 m3">
              <label for="">2nd Year Students</label>
            </div>
            <?php if($Enrollment == "Open"){ ?>
            
            <div class="w3-col s12 m4">
              <select name="acadFee" id="acadFee2" class="w3-input w3-border w3-padding" disabled>
                <option value=""><?php echo $curFee2['fee_name'] ?></option>
              </select>
            </div>
          
            <div class="w3-col s12 m4">
              <select name="acadFee" id="acadVer2" class="w3-input w3-border w3-padding" disabled>
                <option value=""><?php echo $curFee2['version'] ?></option>
              </select>
            </div>   
            <?php }else{
              ?>

              <div class="w3-col s12 m4">
              <select name="acadFee" id="acadFee2" class="w3-input w3-border w3-padding" onclick="showCurriculum('acadFee2')">
                <option value=""><?php echo $curFee2['fee_name'] ?></option>
              </select>
            </div>
          
            <div class="w3-col s12 m4">
              <select name="acadFee" id="acadVer2" class="w3-input w3-border w3-padding" onclick="showCurriculumVer('acadVer2')" onchange="//saveFee('II')">
                <option value=""><?php echo $curFee2['version'] ?></option>
              </select>
            </div>

              <?php
            } ?>   
            <div class="w3-col s12 m1">
              <button class="w3-blue w3-button" onclick="saveFee('II')">Save</button>
            </div>       
          </div>

           <div class="w3-row" style="margin-bottom: 5px;">
            <div class="w3-col s12 m3">
              <label for="">3rd Year Students</label>
            </div>
            <?php if($Enrollment == "Open"){ ?>
            
            <div class="w3-col s12 m4">
              <select name="acadFee" id="acadFee3" class="w3-input w3-border w3-padding" disabled>
                <option value=""><?php echo $curFee3['fee_name'] ?></option>
              </select>
            </div>
          
            <div class="w3-col s12 m4">
              <select name="acadFee" id="acadVer3" class="w3-input w3-border w3-padding" disabled>
                <option value=""><?php echo $curFee2['version'] ?></option>
              </select>
            </div>   
            <?php }else{
              ?>

              <div class="w3-col s12 m4">
              <select name="acadFee" id="acadFee3" class="w3-input w3-border w3-padding" onclick="showCurriculum('acadFee3')">
                <option value=""><?php echo $curFee3['fee_name'] ?></option>
              </select>
            </div>
          
            <div class="w3-col s12 m4">
              <select name="acadFee" id="acadVer3" class="w3-input w3-border w3-padding" onclick="showCurriculumVer('acadVer3')" onchange="//saveFee('III')">
                <option value=""><?php echo $curFee3['version'] ?></option>
              </select>
            </div>

              <?php
            } ?>     
            <div class="w3-col s12 m1">
              <button class="w3-blue w3-button" onclick="saveFee('III')">Save</button>
            </div>     
          </div>

           <div class="w3-row" style="margin-bottom: 5px;">
            <div class="w3-col s12 m3">
              <label for="">4th Year Students</label>
            </div>
            <?php if($Enrollment == "Open"){ ?>
            
            <div class="w3-col s12 m4">
              <select name="acadFee" id="acadFee4" class="w3-input w3-border w3-padding" disabled>
                <option value=""><?php echo $curFee4['fee_name'] ?></option>
              </select>
            </div>
          
            <div class="w3-col s12 m4">
              <select name="acadFee" id="acadVer4" class="w3-input w3-border w3-padding" disabled>
                <option value=""><?php echo $curFee4['version'] ?></option>
              </select>
            </div>   
            <?php }else{
              ?>

              <div class="w3-col s12 m4">
              <select name="acadFee" id="acadFee4" class="w3-input w3-border w3-padding" onclick="showCurriculum('acadFee4')">
                <option value=""><?php echo $curFee4['fee_name'] ?></option>
              </select>
            </div>
          
            <div class="w3-col s12 m4">
              <select name="acadFee" id="acadVer4" class="w3-input w3-border w3-padding" onclick="showCurriculumVer('acadVer4')" onchange="//saveFee('IV')">
                <option value=""><?php echo $curFee4['version'] ?></option>
              </select>
            </div>

              <?php
            } ?>        
            <div class="w3-col s12 m1">
              <button class="w3-blue w3-button" onclick="saveFee('IV')">Save</button>
            </div>  
          </div>

          
          
        </div>
    </div>
</div>
