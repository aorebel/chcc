<?php 

require('../app/config/connect.php');
require_once('../app/session.php');
require_once('../app/getSYSem.php');
//$coount = 0;


//echo " ".$user." ";
//$queryClass = "SELECT * from teacherclass where teacher = ? and sem=? and school_year = ? and class_code not like ? order by class_code asc";
$queryClass = "SELECT class_code,subject_id,subject,section_code from teacherclass where teacher = ? and sem=? and school_year = ? group by subject_id, class_code, subject, section_code having count(subject_id)>0 order by class_code asc";
$getClass = $conn->prepare($queryClass);
$getClass->execute(array($user,$sem,$sy));
//echo $getClass->rowCount();
while ($crow = $getClass->fetch(PDO::FETCH_ASSOC)) {
	
	$class = $crow['class_code'];
	$subjID = $crow['subject_id'];

	if(substr($crow['class_code'], -1)=="L"){
		$subject = $crow['subject']." Lab";
	}
	else {
		$subject = $crow['subject'];
	}
    ?>
    <button class="w3-button w3-blue w3-text-left" id="<?php echo $class ?>" onclick="showGradeForm('<?php echo $class; ?>','<?php echo $subjID; ?>','<?php echo $subject; ?>','<?php echo $user; ?>')" style="width: 100%; height: 50px;margin: 3px;">
    	<span class="w3-left"><?php echo "Section ".strtoupper($crow['section_code'])." - ".strtoupper($subject); ?></span>
    </button>
    
    <?php
}

?>

<div id="gradeForm" class="w3-modal">
  <div class="w3-modal-content">

    <header class="w3-container w3-blue"> 
      <span onclick="document.getElementById('gradeForm').style.display='none'" 
      class="w3-button w3-display-topright">&times;</span>
      <h4>Add Grade Form</h4>
    </header>

    <div id="addGradeFormContainer" class="w3-container w3-padding" style="font-size: 11px; font-family: verdana;">
      
    </div>

  </div>
</div>

<script>
	function showGradeForm(cc,subjID,subject,user){
		//alert(cc+"-"+subjID+"-"+subject+"-"+user);
		var xhttp = new XMLHttpRequest();
		document.getElementById("gradeForm").style.display = 'block';
	    xhttp.onreadystatechange = function() {
	        if (this.readyState == 4 && this.status == 200) {
	          
	          document.getElementById('addGradeFormContainer').innerHTML = this.responseText;
	         
	          
	        }
	    };
	    xhttp.open("POST", "../methods/grade-form.php", true);
	    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	    xhttp.send("subject="+subject+"&teacher="+user+"&cc="+cc+"&subjID="+subjID);
	}
	function postGrade(cc,subj,stud,sem,sy,mode){
	console.log(mode);
	var grade = cc+""+stud+"G";
	var remarks = cc+""+stud+"R";

	var val = cc+""+stud+""+mode;
	//var fin = cc+""+stud+"fin";
	var score = document.getElementById(val).value;
	console.log(val+" "+score);

	var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);
          //location.reload();
          document.getElementById(grade).innerHTML = data.grade;
          document.getElementById(remarks).innerHTML = data.remarks;
          console.log(this.responseText);
        }
    };
    xhttp.open("POST", "../app/post_grade.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("subject="+subj+"&student="+stud+"&sem="+sem+"&sy="+sy+"&mode="+mode+"&score="+score);
}
function dropStud(cc,subj,stud,sem,sy){
	var d = cc+""+stud+"D";
	var remarks = cc+""+stud+"R";
	var g = cc+""+stud+"G";

	var mid = cc+""+stud+"mid";
	var fin = cc+""+stud+"fin";
	var pre = cc+""+stud+"pre";

	var grade = document.getElementById(g).innerHTML;
	
	
	//alert("Are you sure you want to drop student with student ID "+stud+" ?");
	drop = document.getElementById(d).value;

	//alert(drop+" "+grade);
	var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);
          //location.reload();
          if(drop=="Incomplete"){
          	document.getElementById(remarks).innerHTML = data.remarks;
	        document.getElementById(fin).disabled = false;
	        document.getElementById(mid).disabled = false;
	        document.getElementById(pre).disabled = false;
	        //drop = data.remarks
	        drop = null;
	        console.log(this.responseText);
          }
          else{
          	document.getElementById(remarks).innerHTML = data.remarks;
	        document.getElementById(fin).disabled = true;
	        document.getElementById(mid).disabled = true;
	        document.getElementById(pre).disabled = true;
	        drop = null;
	        console.log(this.responseText);
          }
          
        }
    };
    xhttp.open("POST", "../app/drop_student.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("subject="+subj+"&student="+stud+"&sem="+sem+"&sy="+sy+"&drop="+drop+"&grade="+grade);
}
</script>
