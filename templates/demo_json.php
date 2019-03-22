<div id=>
	<table id="jsonRes" class="w3-table">
		
	</table>
</div>
<script>
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	        var myObj = JSON.parse(this.responseText);
	        document.getElementById("jsonRes").innerHTML = "<td style='border: 1px solid gray'>"+myObj.name+"</td><td>"+myObj.content+"</td>";
	    }
	};
	xmlhttp.open("GET", "../templates/demo.php", true);
	xmlhttp.send();


</script>