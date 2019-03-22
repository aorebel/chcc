
<script>
/*	
	function showSubjectsByCourseLevel(x){
        var str = x;
        //var str = document.getElementById('edit');
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("editSectionForm").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "../app/getEditSectionItems.php?section=" + str, true);
        xmlhttp.send();
        //console.log(str);
    }
*/
</script>

<div id="e" class="w3-hide"></div>
<div id="cid" class="w3-hide"><?php echo $course_id; ?></div>
<div id="editSectionForm">
	
</div>

<p>	
	<input type="hidden" name="section" id="edit">
    <button class="w3-button w3-blue" onclick="editSectionOnAdmin()">Edit Section</button>
</p>
<p id="editSectionResult"></p>

<script>
	

	function editSectionOnAdmin(){
        var section = document.getElementById('edit').value;
        var slots = document.getElementById('editSlots').value;
        var units = document.getElementById('editUnits').value;
        
        //var str = document.getElementById('addSectionCode');
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = this.responseText;
                if(res=="true"){
                	document.getElementById('editSectionResult').innerHTML = "Update successful!"; 
                }
                else{
                    document.getElementById('editSectionResult').innerHTML = "Error! Cannot Update!";                       
                }
            }
        };
        xmlhttp.open("GET", "../app/edit_section.php?section=" + section+"&slots="+slots+"&units="+units, true);
        xmlhttp.send();
        //console.log(subject+"-"+section);
    }

</script>