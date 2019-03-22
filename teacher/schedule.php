<?php

require_once("../methods/teacher_student_class.php");


?>


<script>
function printTeacherClass(){
    var printContents = document.getElementById('teacherClass').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();
    //document.body.innerHTML = printContents;
    document.body.innerHTML = originalContents;
}

</script>