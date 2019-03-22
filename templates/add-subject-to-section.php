<?php 

$currentMonth2 = date ("m");
$currentYear2 = date ("Y");
if( ($currentMonth2>=9) && ($currentMonth2<=12) ){
    $syEnd2 = $currentYear2 +1;
    $sy2 = $currentYear2."-".$syEnd2;
    $sem2 = "2nd Sem";
}
else if( ($currentMonth2>=4) && ($currentMonth2<=8) ){
    $syEnd2 = $currentYear2 +1;
    $sy2 = $currentYear2."-".$syEnd2;
    $sem2 = "1st Sem";
}
else if( ($currentMonth2>=3) && ($currentMonth2<=4) ){
    $syEnd2 = $currentYea2 +1;
    $sy2 = $currentYear2."-".$syEnd2;
    $sem2 = "Summer";
}

else if( ($currentMonth2>=1) && ($currentMonth2<=2) ){
    $syEnd2 = $currentYear2 +1;
    $sy2 = $currentYear2."-".$syEnd2;
    $sem2 = "2nd Sem";
}


?>
<script>
    
    function showSubjectsByCourseLevel(){
        
        var str = document.getElementById('addSectionCode').innerHTML;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("subjectBySection").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "../app/getSubjectsByCourseLevel.php?section=" + str, true);
        xmlhttp.send();
        console.log(str);
    }

        
    var count = 2;
     
    function countDown(cid){
        var cid = cid;
        var redirect = "showContentByCourse.php?cid="+cid;
        //var timer = document.getElementById("timer");
        if(count > 0){
            count--;
            //timer.innerHTML = "This page will redirect in "+count+" seconds.";
            setTimeout("countDown()", 1000);
        }else{
            window.location.href = redirect;
        }
    }

</script>
<div id="addSectionCode" class="w3-hide"></div>
<h3 class="w3-center">Add Subject for SY <?php 
    //require_once('../app/getSYSem.php');
    echo $sy2." ( ".$sem2." )"; 
?></h3>
<div id="cid" class="w3-hide"><?php echo $course_id; ?></div>
<p>      
    <label class="w3-text-blue"><b>Subject</b></label>
    <select name="subject_code" id="subjectBySection" class="w3-input w3-border" onclick="" required> 

    </select>
</p>
<p>
    <button class="w3-button w3-blue" onclick="addSubjectToSection()">Add Subject to Section</button>
</p>
<p id="result"></p>
<script>
    //showSubjectsByCourseLevel();

    function addSubjectToSection(){
        var section = document.getElementById('addSectionCode').innerHTML;
        var cid = document.getElementById('cid').innerHTML;
        var subject = document.getElementById('subjectBySection').value;
        var x = section;
        //var str = document.getElementById('addSectionCode');
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //var res = this.responseText;
                var res = JSON.parse(this.responseText);

                if(!res.status.includes("success")){

                    document.getElementById('result').innerHTML = "Subject already exist on this section!";   
                    //console.log(cid);
                    //countDown(cid);
                }
                //else if(res.status.includes("success")){
                    //document.getElementById('result').innerHTML = "Subject already listed to this section";   
                //}
                else{

                    //var s = res[0];
                    document.getElementById('result').innerHTML = "Subject <b>"+res.subject+"</b> successfully added to section "+x+" !"; 
                    //document.getElementById('result').innerHTML = res.status;
                    if(res.lab=="yes"){
                        document.getElementById(section+"S").innerHTML +="<tr><td></td><td>"+res.cc+"</td><td>"+res.sc+"</td><td>"+res.subject+"</td><td>"+res.st+"</td><td>"+res.availed+"</td><td>"+res.slots+"</td></tr><tr><td></td><td>"+res.ccL+"</td><td>"+res.scL+"</td><td>"+res.subjectL+"</td><td>"+res.stL+"</td><td>"+res.availedL+"</td><td>"+res.slotsL+"</td></tr>";
                    }
                    else{
                        document.getElementById(section+"S").innerHTML +="<tr><td></td><td>"+res.cc+"</td><td>"+res.sc+"</td><td>"+res.subject+"</td><td>"+res.st+"</td><td>"+res.availed+"</td><td>"+res.slots+"</td></tr>";
                    }
                    
                    //let doc = new DOMParser().parseFromString(res, 'text/html');
                    //let tr = doc.body.firstChild;
                    //let td = tr.nextSibling;
                    //document.getElementById(x).append(tr);  
                }
                //console.log(res+""+x);

            }
        };
        xmlhttp.open("GET", "../app/addSubjectToSection.php?section=" + section+"&subject="+subject, true);
        xmlhttp.send();
        //console.log(subject+"-"+section);
    }
</script>