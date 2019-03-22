<?php 

//$curYear = day('Y');
//$curYear = strtotime($curYear);

?>
<span id="classCode" style="display: none;"></span>

<div class="w3-col s12 m6 ">   
    <p>      
        <label class="w3-text-blue"><b>School Year Start</b></label>
        <select name="sy" id="sy" class="w3-input w3-border" required>
            <option value="">Select Start of School Year</option>
            <?php 
                //$curYear = day('Y');
                //$curYear = strtotime($curYear);
                for($i=2015; $i<2099; $i++){
                    ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php
                }
            ?>
        </select>
    </p> 

</div>
<div class="w3-col s12 m6">  
    <p>      
        <label class="w3-text-blue"><b>Semester</b></label>
        <select name="sem" id="sem" class="w3-input w3-border"  required>
            <option value="">Select Semester</option>
            <option value="1st Sem">1st Semester</option>            
            <option value="2nd Sem">2nd Semester</option>
            <option value="Summer">Summer</option>

        </select>
    </p>
</div> 
<h3 style="text-align: center;">Schedule</h3>

<div class="w3-col s12 m12 w3-padding">
   
	<label class="w3-text-blue"><b>Schedule Days</b></label><br>
	<input class="w3-check" type="checkbox" name="day[]" id="day1" value="M">
	<label>Monday</label>
	<input class="w3-check" type="checkbox" name="day[]" id="day2" value="T">
	<label>Tuesday</label>
	<input class="w3-check" type="checkbox" name="day[]" id="day3" value="W">
	<label>Wednesday</label>
	<input class="w3-check" type="checkbox" name="day[]" id="day4" value="Th">
	<label>Thursday</label>
	<input class="w3-check" type="checkbox" name="day[]" id="day5" value="F">
	<label>Friday</label>
	<input class="w3-check" type="checkbox" name="day[]" id="day6" value="Sat">
	<label>Saturday</label>

</div>
<div class="w3-col s12 m4 w3-padding">
     
    <label class="w3-text-blue"><b>Schedule Time Start</b></label>
    <select name="timeStart" id="timeStart" onchange="showEndTime(this.value,'reg')" class="w3-input w3-border" required>
        <option value="">Select Start Time</option>
        <?php
            $range=range(strtotime("07:00"),strtotime("20:00"),15*60);
            foreach($range as $time){
                   ?>
                    <option value="<?php echo date("H:i",$time); ?>"><?php echo date("H:i",$time); ?></option>
                   <?php
            }
        ?>
    </select>

</div>
<div class="w3-col s12 m4 w3-padding">
      
    <label class="w3-text-blue"><b>Schedule Time End</b></label>
    <select name="timeEnd" id="timeEnd" class="w3-input w3-border" style="with: 95% !important;" require>
        
    </select>

</div>
<div class="w3-col s12 m4 w3-padding">
    
    <label class="w3-text-blue"><b>Room Code</b></label>
    <input type="text"  name="roomCode" id="roomCode" class="w3-input w3-border" required>
        

</div>

<p class="w3-padding">      
<button class="w3-btn w3-blue" style="margin-top: 10px;" onclick="editClass()">Add Class</button></p>
<div class="w3-padding w3-block" id="returnEditClassResult"></div>

<script>
	function showEndTime(start, type){
        var str = start.split(":").join("-");
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var result = this.responseText;
                
                document.getElementById('timeEnd').innerHTML = this.responseText;                  

                
            }
        };
        xmlhttp.open("GET", "../app/getTimeEnd.php?start="+str, true);
        xmlhttp.send();
        console.log(str);
    }
    function editClass(){
    	var classCode = document.getElementById('classCode').innerHTML;
        var classID = document.getElementById('classID').innerHTML;
    	//var withLab = document.getElementById('withLab').value;

        var days = [];            
        if(document.getElementById('day1').checked){ 
            days.push(document.getElementById('day1').value);
        }
        if(document.getElementById('day2').checked){ 
            days.push(document.getElementById('day2').value);
        }
        if(document.getElementById('day3').checked){ 
            days.push(document.getElementById('day3').value);
        }
        if(document.getElementById('day4').checked){ 
            days.push(document.getElementById('day4').value);
        }
        if(document.getElementById('day5').checked){ 
            days.push(document.getElementById('day5').value);
        }
        if(document.getElementById('day6').checked){ 
            days.push(document.getElementById('day6').value);
        }
        var notLab = days.join('-');       
        

        var sy = document.getElementById('sy').value;
        var sem = document.getElementById('sem').value;
        var timeStart = document.getElementById('timeStart').value;
        var timeEnd = document.getElementById('timeEnd').value;
        var roomCode = document.getElementById('roomCode').value;


  
        if (days!="") {

        }
        else{
            alert("Please select day/s!");
        }

	    var xhttp = new XMLHttpRequest();
	    xhttp.onreadystatechange = function() {
	        if (this.readyState == 4 && this.status == 200) {
	          var data = JSON.parse(this.responseText);
              //location.reload();
	          console.log(data);
              if(data.status=="Schedule successfully added!"){
                var syid = classCode+"1";
                var semid = classCode+"2";
                var roomid = classCode+"3";
                var dayid = classCode+"4";
                var startid = classCode+"5";
                var endid = classCode+"6";

                document.getElementById(classCode+"1").innerHTML=data.sy;
                document.getElementById(classCode+"2").innerHTML=data.sem;
                document.getElementById(classCode+"3").innerHTML=data.room;
                document.getElementById(classCode+"4").innerHTML=data.days;
                document.getElementById(classCode+"5").innerHTML=data.start+":00";
                document.getElementById(classCode+"6").innerHTML=data.end+":00";
                document.getElementById("returnEditClassResult").innerHTML = data.status;
                //location.reload();
                //var i1 = document.getElementById('firstYearClass').innerHTML;
                //window.top.location.reload(true);
                //console.log(syid+" "+semid+" ");
                //console.log(classID);
              }
              else{
                document.getElementById("returnEditClassResult").innerHTML = data.status;
              }
	        }
	    };
	    xhttp.open("POST", "../app/edit_class.php", true);
	    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	    xhttp.send("days="+notLab+"&timeStart="+timeStart+"&timeEnd="+timeEnd+"&roomCode="+roomCode+"&classCode="+classCode+"&sem="+sem+"&sy="+sy);

    	//console.log(timeStart+" "+timeEnd);
    }
    
</script>