function openTab(evt, tabName) {
  var i, x, tablinks;
 

  x = document.getElementsByClassName("aTab");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" w3-white", ""); 
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " w3-white";
  if (history.pushState) {
      var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page='+tabName;
      window.history.pushState({path:newurl},'',newurl);
  }
}
function getAdminUrl(){
    //display_ct();
    var url_string = window.location.href;
    var url = new URL(url_string);
    var page = url.searchParams.get("page");
    if(page=="Employees"){
        document.getElementById("Employees").style.display = "block";
        document.getElementById("btnEmployees").classList.add("w3-white");
    }
    else if(page=="Home"){
        document.getElementById("Home").style.display = "block";
        document.getElementById("btnHome").classList.add("w3-white");
    }
    else if(page=="Students"){
        document.getElementById("Students").style.display = "block";
        document.getElementById("btnStudents").classList.add("w3-white");
    }
    else if(page=="Academics"){
        document.getElementById("Academics").style.display = "block";
        document.getElementById("btnAcademics").classList.add("w3-white");
    }
    else if(page=="Account"){
        document.getElementById("Account").style.display = "block";
        document.getElementById("btnAccount").classList.add("w3-white");
    }
    else if(page=="chgPass"){
        document.getElementById("chgPass").style.display = "block";
        document.getElementById("btnchgPass").classList.add("w3-white");
    }
}
function showStudentModal(cid) {
        //var id = document.getElementById("courseID").value;
  var cid = cid;
  
  
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("contentStudentByContent").innerHTML = this.responseText;
      }
  };
  xmlhttp.open("get", "../methods/showStudentByCourse.php?cid="+cid,true);
  xmlhttp.send();
  //
  document.getElementById("showStudentByCourseModal").style.display = "block";
  
   
  //console.log(cid);
}
function showStudents() {
  var str = document.getElementById("searchStudents").value;
  var tbl = "students";
  if (str == "") {
      document.getElementById("studentsTable").innerHTML = "";
      return;
  } else { 
      if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
      } else {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              document.getElementById("studentsTable").innerHTML = this.responseText;
          }
      };
      xmlhttp.open("GET","../app/searchStudent.php?q="+str+"&table="+tbl,true);
      xmlhttp.send();

      }
  console.log(str);
}
function openYearLevel(evt, yearLevelName) {
var i, x, yearlevellinks;
x = document.getElementsByClassName("yearLevel");
for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
}
yearlevellinks = document.getElementsByClassName("yearlevellink");
for (i = 0; i < x.length; i++) {
    yearlevellinks[i].className = yearlevellinks[i].className.replace(" w3-red", "");
}
document.getElementById(yearLevelName).style.display = "block";
evt.currentTarget.className += " w3-red";
}