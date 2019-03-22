

<! ***********************************tabEmployees BUTTONS********************************-->
<div class="w3-bar w3-black" style="font-size: 18px !important; text-shadow: none !important;">
    
    <button class="w3-button tabEmployeeslink w3-red" onclick="opentabEmployees(event,'Teachers')">Teachers</button>
    <button class="w3-button tabEmployeeslink" onclick="opentabEmployees(event,'Cashier')">Cashier</button>
    <button class="w3-button tabEmployeeslink" onclick="opentabEmployees(event,'Admin')">Admin</button>
 
    <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-yellow w3-right">
        Add Employee
    </button>
    
</div>
<br>
<div id="empLists">
     <button class="w3-button w3-yellow w3-right" onclick="printEmpList()">Print Employees List</button>
  <! ***********************************tabEmployees BUTTONS END********************************-->
  <! ***********************************TEACHER'S tabEmployees********************************-->
  <div id="Teachers" class="w3-container w3-animate-opacity tabEmployees" style="width:100% !important; display: block;">

      <h3 class="w3-center">Teachers' List</h3>
      <! ***********************************FETCH TEACHER'S LIST********************************-->
      <div class="w3-row">
          <?php require_once("../methods/admin-teacher-lists.php"); ?>
      </div>
  </div>

  <! ***********************************CASHIER'S tabEmployees********************************-->
  <div id="Cashier" class="w3-container w3-animate-opacity tabEmployees" style="width:100% !important; display: none;">
      <! ***********************************FETCH CASHIER'S LIST********************************-->
      <h3 class="w3-center">Cashiers' List</h3>
      <div class="w3-row">
          <?php require_once("../methods/admin-cash-lists.php"); ?>
      </div>
  </div>

  <! ***********************************ADMIN'S tabEmployees********************************-->
  <div id="Admin" class="w3-container w3-animate-opacity tabEmployees" style="width:100% !important; display: none;">
      <! ***********************************FETCH ADMIN'S LIST********************************-->
      <h3 class="w3-center">Admins' List</h3>
      <div class="w3-row">
          <?php require_once("../methods/admin-admin-lists.php"); ?>
      </div>
  </div>
</div>
<div class="w3-container" id="AddTeacherModal">
        
    <div id="id01" class="w3-modal" >
        <div class="w3-modal-content w3-animate-top w3-card-4" style="margin-bottom: 25px; padding-bottom: 25px; margin-top: -50px;">
        <header class="w3-container w3-blue"> 
            <span onclick="document.getElementById('id01').style.display='none'" 
            class="w3-button w3-display-topright">&times;</span>
            <h3>ADD EMPLOYEE</h3>
        </header>
        <div class="w3-container" style="height: 500px; overflow-y: auto;">
            <?php require_once("../templates/add-employee.php"); ?>
        </div>
        <!--footer class="w3-container w3-teal">
            <p>Modal Footer</p>
        </footer-->
        </div>
    </div>
</div>
<script>
    function opentabEmployees(evt, tabEmployeesName) {
      var i, x, tabEmployeeslinks;
      x = document.getElementsByClassName("tabEmployees");
      for (i = 0; i < x.length; i++) {
          x[i].style.display = "none";
      }
      tabEmployeeslinks = document.getElementsByClassName("tabEmployeeslink");
      for (i = 0; i < x.length; i++) {
          tabEmployeeslinks[i].className = tabEmployeeslinks[i].className.replace(" w3-red", "");
      }
      document.getElementById(tabEmployeesName).style.display = "block";
      evt.currentTarget.className += " w3-red";
    }
</script>