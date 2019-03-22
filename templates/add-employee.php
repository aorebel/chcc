<br>
<!--form class="w3-container" action="../app/add_employee.php" method="POST"-->
<p>      
    <label class="w3-text-blue"><b>Role</b></label>
    <select class="w3-input w3-border" name="role" id="aerole" required>
        <option value="">Select Role</option>
        <option value="teacher">Teacher</option>
        <option value="cashier">Cashier</option>
        <option value="admin">Admin</option>
    </select>
</p>
<p>      
    <label class="w3-text-blue"><b>First Name</b></label>
    <input class="w3-input w3-border" name="first" id="aefirst" type="text" required>
</p>
<p>      
    <label class="w3-text-blue"><b>Middle Initial</b></label>
    <input class="w3-input w3-border" name="mi" id="aemi" type="text" maxlength="2" required>
</p>
<p>      
    <label class="w3-text-blue"><b>Last Name</b></label>
    <input class="w3-input w3-border" name="last" id="aelast" type="text" required>
</p>
<p>      
    <label class="w3-text-blue"><b>Birthdate</b></label>
    <input class="w3-input w3-border" name="bdate" id="aebdate" type="date" required>
</p>
<p>      
    <label class="w3-text-blue"><b>Gender</b></label>
    <select class="w3-input w3-border" name="gender" id="aegender" required>
        <option value="">Select Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>
</p>
<p>      
    <label class="w3-text-blue"><b>Email</b></label>
    <input class="w3-input w3-border" name="email" id="aeemail" type="email" required>
</p>
<p>      
    <label class="w3-text-blue"><b>Contact Number</b></label>
    <input class="w3-input w3-border" name="contact" id="aecontact" type="tel" maxlength="11" required>
</p>
 <p>      
    <label class="w3-text-blue"><b>Employment Status</b></label>
    <select class="w3-input w3-border" name="status"id="aestatus" required>
        <option value="">Select Status</option>
        <option value="Permanent">Permanent</option>
        <option value="Part-time">Part-time</option>
    </select>
</p>
<p>      
    <label class="w3-text-blue"><b>Hire Date</b></label>
    <input class="w3-input w3-border" name="hire" id="aehire" type="date" required>
</p><br>
<div class="w3-row">
    <p>      
        <label class="w3-text-blue"><b>Admin Password</b></label>
        <input class="w3-input w3-border" name="aspass" id="aepass" type="password" required>
    </p>
</div>
<p id="aeres"></p>

<p>      
<button class="w3-btn w3-blue" onclick="addEmp()">Add Employee</button></p>


<!--/form-->


<script>
    function addEmp(){
        var fname = document.getElementById("aefirst").value;
        var lname = document.getElementById("aelast").value;
        var mi = document.getElementById("aemi").value;
        var bdate = document.getElementById("aebdate").value;
        var gender = document.getElementById("aegender").value;
        var email = document.getElementById("aeemail").value;
        var contact = document.getElementById("aecontact").value;
        var status = document.getElementById("aestatus").value;
        var role = document.getElementById("aerole").value;
        var hire = document.getElementById("aehire").value;
        var pass = document.getElementById("aepass").value;

        //alert(hire);

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //console.log(this.responseText);
              
              alert(this.responseText);  
              var res = this.responseText;
              if(res=="success"){
                //location.replace("https://chcc.ga/admin/admin.php?page=Employees");
                location.reload();
              }else{
                document.getElementById("aeres").innerHTML = "Entered wrong password! Cannot add empoyee. Please try again...";
              }            
              //document.getElementById('enrollBlock').attrubute = "disabled";
            }
        };
        xhttp.open("POST", "../app/add_employee.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("first="+fname+"&last="+lname+"&mi="+mi+"&bdate="+bdate+"&gender="+gender+"&contact="+contact+"&email="+email+"&status="+status+"&role="+role+"&hire="+hire+"&pass="+pass);
    }
</script>

