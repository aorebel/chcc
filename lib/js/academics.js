function openCourseTab(evt, courseTabName,cid) {
  var tab = courseTabName;
  var i, x, CourseTabLinks;
  x = document.getElementsByClassName("courseTab");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  courseTabLinks = document.getElementsByClassName("courseTabLink");
  for (i = 0; i < x.length; i++) {
      courseTabLinks[i].className = courseTabLinks[i].className.replace(" w3-red", ""); 
  }
  document.getElementById(courseTabName).style.display = "block";
  evt.currentTarget.className += " w3-red";

  if (history.pushState) {
    var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?cid='+cid+'&tab='+tab;
    window.history.pushState({path:newurl},'',newurl);
  }
console.log(tab);
}


function openSectionTab(evt, sectionTabName) {
  var i, x, sectionTabLinks;
  x = document.getElementsByClassName("sectionTab");
  for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
  }
  sectionTabLinks = document.getElementsByClassName("sectionTabLink");
  for (i = 0; i < x.length; i++) {
      sectionTabLinks[i].className = sectionTabLinks[i].className.replace(" w3-red", "");
  }
  document.getElementById(sectionTabName).style.display = "block";
  evt.currentTarget.className += " w3-red";
}
function openClassTab(evt, classTabName) {
  var i, x, classTabLinks;
  x = document.getElementsByClassName("classTab");
  for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
  }
  classTabLinks = document.getElementsByClassName("classTabLink");
  for (i = 0; i < x.length; i++) {
      classTabLinks[i].className = classTabLinks[i].className.replace(" w3-red", "");
  }
  document.getElementById(classTabName).style.display = "block";
  evt.currentTarget.className += " w3-red";
}
function openSubjectTab(evt, subjectTabName) {
  var i, x, classTabLinks;
  x = document.getElementsByClassName("subjectTab");
  for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
  }
  subjectTabLinks = document.getElementsByClassName("subjectTabLink");
  for (i = 0; i < x.length; i++) {
      subjectTabLinks[i].className = subjectTabLinks[i].className.replace(" w3-red", "");
  }
  document.getElementById(subjectTabName).style.display = "block";
  evt.currentTarget.className += " w3-red";
}
function getTabUrl(){
  var url_string = window.location.href;
  var url = new URL(url_string);
  var tab = url.searchParams.get("tab");
  if(tab=="Section"){
      document.getElementById("Section").style.display = "block";
      document.getElementById("btnSection").classList.add("w3-red");
  }
  else if(tab=="Class"){
      document.getElementById("Class").style.display = "block";
      document.getElementById("btnClass").classList.add("w3-red");
  }
  else if(tab=="Subjects"){
      document.getElementById("Subjects").style.display = "block";
      document.getElementById("btnSubject").classList.add("w3-red");
  }
}

