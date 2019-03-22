
<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:500px">
    <! ******************LOGIN FORM CONTAINER****************** -->
    <div id="Login" class="w3-container tab" >
      <div class="w3-center"><br>
        <span class="w3-input w3-display-topleft"><b>STUDENT LOGIN</b></span>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-medium w3-hover-red w3-display-topright"  title="Close Modal" style="width: 50px !important">&times;</span><br>
        <h1 class="w3-margin-top w3-center"><img src="lib/res/Logo.png"></h1>
      </div>
      <! ******************LOGIN FORM****************** -->
      <form class="w3-container" method="post" action="app/login.php">
        <div class="w3-section">
          <label><b><i style="font-size: 1.5em !important;" class="fa fa-user"></i> Username</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="username" required>
          <label><b><i style="font-size: 1.5em !important;" class="fa fa-key"></i> Password</b></label>
          <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="password" required>
          <input type="hidden" name="role" value="student">
          <a href="templates/forgot-pass.php?role=Student" class="w3-center w3-row" style="margin-bottom: 20px;">Forgot password?</a>
              <br>
              
               <div class="w3-row">
                <div class="w3-col s6">
                 <button class="w3-input w3-block w3-blue w3-padding" type="submit" style= "height: 52px;">Login</button>
                 </div>
                 <div class="w3-col s6">
                <span style="width: 100%; height: 50px; line-height: 30px;" class="w3-input w3-button w3-yellow tablink4" onclick="openTab(event,'Register')" >Register</span>    
                </div>  
                
              </div>
          
          
        </div>
      </form>
    </div>
    <! ******************REGISTER FORM CONTAINER****************** -->
    <div id="Register" class="w3-container tab" style="display:none">
      <div class="w3-center"><br>
        <span class="w3-input w3-display-topleft"><b>STUDENT SIGNUP</b></span>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-medium w3-hover-red w3-display-topright"  title="Close Modal" style="width: 50px !important">&times;</span><br>
        <h1 class="w3-margin-top w3-center"><img src="lib/res/Logo.png"></h1>
      </div>
      <! ******************REGISTER FORM****************** -->
      <form class="w3-container" method="post" action="app/registerStudent.php">
        <div id="checkUserStudent">
          
        </div>
        <div class="w3-section">
          <label><b><i style="font-size: 1.5em !important;" class="fa fa-address-card"></i> Student ID</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Studnet ID" name="id" id="studentIDonLogin" onfocusout="checkStudent()" required>
          <label><b><i style="font-size: 1.5em !important;" class="fa fa-envelope"></i> Email Address</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="email" placeholder="Enter Email Address" name="email" required>
          
          <div class="w3-row">
            
            <div class="w3-col s6">
             <button class="w3-input w3-block w3-blue w3-padding" type="submit" style= "height: 50px;">Register</button>
             </div>
             <div class="w3-col s6">
            <span style="width: 100%; height: 50px; line-height: 30px;" class="w3-input w3-button w3-yellow  tablink4" onclick="openTab(event,'Login')" >Back</span>    
            </div>  
            
          </div>
          
          
        </div>
      </form>
    </div>    
    <! ******************TAB BUTTONS****************** -->
  

  </div>
<script>
    function openTab(evt4,tabName) {
      var i;
      var x = document.getElementsByClassName("tab");
      for (i = 0; i < x.length; i++) {
         x[i].style.display = "none";  
      }
      var tablinks = document.getElementsByClassName("tablink4");
      for (i = 0; i < x.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
      }
      document.getElementById(tabName).style.display = "block";  
      evt4.currentTarget.className += " w3-red"; 
    }
</script>