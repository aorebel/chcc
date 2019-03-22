<?php 
  $queryStudentCount = "select * from students";
  $getStudentCount = $conn->prepare($queryStudentCount);
  $getStudentCount->execute();
  $studentCount = $getStudentCount->rowCount();

  function employeeCount($conn,$employee){
  $queryEmployeeCount = "select * from employees where role=?";
  $getEmployeeCount = $conn->prepare($queryEmployeeCount);
  $getEmployeeCount->execute(array($employee));
  $employeeCount = $getEmployeeCount->rowCount();
  return $employeeCount;
  }
  $teacherCount = employeeCount($conn,'teacher');
  $cashierCount = employeeCount($conn,'cashier');
  $adminCount = employeeCount($conn,'admin');
  function courseCountStudent($conn, $course){
    $year = date("Y");
    $year2 = $year+1;
    $sy = $year."-".$year2;
    $queryStudentsPerCourse = "select * from studentenrollment where course_code=? and school_year=?";
    $getStudentsPerCourse = $conn->prepare($queryStudentsPerCourse);
    $getStudentsPerCourse->execute(array($course,$sy));
    $studentsPerCourse = $getStudentsPerCourse->rowCount();
    return $studentsPerCourse;
  }


  $queryCourses = "select * from courses";
  $getCourses = $conn->prepare($queryCourses);
  $getCourses->execute();
  $rowCount = $getCourses->rowCount();
  

?>