
<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:500px">
    <! ******************LOGIN FORM CONTAINER****************** -->
    <div id="teacherLogin" class="w3-container tab-teacher" >
      <div class="w3-center"><br>
        <span class="w3-input w3-display-topleft"><b>TEACHER LOGIN</b></span>
        <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-medium w3-hover-red w3-display-topright"  title="Close Modal" style="width: 50px !important">&times;</span><br>
        <h1 class="w3-margin-top w3-center"><img src="lib/res/Logo.png"></h1>
      </div>
      <! ******************LOGIN FORM****************** -->
      <form class="w3-container" method="post" action="app/login.php">
        <div class="w3-section">
          <label><b><i style="font-size: 1.5em !important;" class="fa fa-user"></i> Username</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="username" required>
          <label><b><i style="font-size: 1.5em !important;" class="fa fa-key"></i> Password</b></label>
          <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="password" required>
          <input type="hidden" name="role" value="teacher">
          <a href="templates/forgot-pass.php?role=Teacher" class="w3-center w3-row" style="margin-bottom: 20px;">Forgot password?</a>
              <br>
              
               <div class="w3-row">
                <div class="w3-col s6">
                 <button class="w3-input w3-block w3-blue w3-padding" type="submit" style= "height: 52px;">Login</button>
                 </div>
                 <div class="w3-col s6">
                <span style="width: 100%; height: 51px; line-height: 30px;" class="w3-input w3-button w3-yellow tablink3" onclick="openTabTeacher(event,'teacherRegister')" >Register</span>    
                </div>  
                
              </div>
          
          
        </div>
      </form>
    </div>
    <! ******************REGISTER FORM CONTAINER****************** -->
    <div id="teacherRegister" class="w3-container tab-teacher" style="display:none">
      <div class="w3-center"><br>
        <span class="w3-input w3-display-topleft"><b>TEACHER SIGNUP</b></span>
        <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-medium w3-hover-red w3-display-topright"  title="Close Modal" style="width: 50px !important">&times;</span><br>
        <h1 class="w3-margin-top w3-center"><img src="lib/res/Logo.png"></h1>
      </div>
      <! ******************REGISTER FORM****************** -->
      <form class="w3-container" method="post" action="app/registerTeacher.php">
        <div class="w3-section">
          <label><b><i style="font-size: 1.5em !important;" class="fa fa-address-card"></i> Employee ID</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Employee ID" name="id" required>
          <label><b><i style="font-size: 1.5em !important;" class="fa fa-envelope"></i> Email Address</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="email" placeholder="Enter Email Address" name="email" required>
         
          <div class="w3-row">
                <div class="w3-col s6">
                 <button class="w3-input w3-block w3-blue w3-padding" type="submit" style= "height: 52px;">Register</button>
                 </div>
                 <div class="w3-col s6">
                <span style="width: 100%; height: 50px; line-height: 30px;" class="w3-input w3-button w3-yellow tablink3" onclick="openTabTeacher(event,'teacherLogin')" >Back</span>    
                </div>  
                
              </div>
          
          
        </div>
      </form>
    </div>    
    <! ******************TAB BUTTONS****************** -->
    

  </div>
  <script>
    function openTabTeacher(evt3,tabName2) {
      var i;
      var x = document.getElementsByClassName("tab-teacher");
      for (i = 0; i < x.length; i++) {
         x[i].style.display = "none";  
      }
      var tablinks = document.getElementsByClassName("tablink3");
      for (i = 0; i < x.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
      }
      document.getElementById(tabName2).style.display = "block"; 
      evt3.currentTarget.className += " w3-red"; 
    }
</script>

