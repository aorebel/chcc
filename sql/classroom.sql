-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2018 at 05:07 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chcc_db`
--

-- --------------------------------------------------------

--
-- Structure for view `classroom`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `classroom`  AS  select `chcc_db`.`classes`.`class_code` AS `class_code`,`chcc_db`.`classes`.`school_year` AS `school_year`,`chcc_db`.`classes`.`sem` AS `sem`,`chcc_db`.`classes`.`subject_id` AS `subject_id`,`chcc_db`.`classes`.`sched_day` AS `sched_day`,`chcc_db`.`classes`.`sched_time_start` AS `sched_time_start`,`chcc_db`.`classes`.`sched_time_end` AS `sched_time_end`,`chcc_db`.`classes`.`room` AS `room`,`chcc_db`.`classes`.`section_code` AS `section_code`,`chcc_db`.`classes`.`status` AS `status`,`chcc_db`.`subjects`.`subject_code` AS `subject_code`,`chcc_db`.`subjects`.`subject` AS `subject`,`chcc_db`.`subjects`.`course_code` AS `course_code`,`chcc_db`.`subjects`.`year_level` AS `year_level`,`chcc_db`.`subjects`.`subject_type` AS `subject_type`,`chcc_db`.`student_classes`.`student_id` AS `student`,`chcc_db`.`teacher_classes`.`emp_id` AS `teacher` from (((`chcc_db`.`classes` join `chcc_db`.`subjects`) join `chcc_db`.`student_classes`) join `chcc_db`.`teacher_classes`) where ((`chcc_db`.`classes`.`subject_id` = `chcc_db`.`subjects`.`id`) and (`chcc_db`.`classes`.`class_code` = `chcc_db`.`student_classes`.`class_code`) and (`chcc_db`.`classes`.`class_code` = `chcc_db`.`teacher_classes`.`class_code`)) ;

--
-- VIEW  `classroom`
-- Data: None
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `admin`  AS  select `chcc_db`.`employees`.`emp_id` AS `emp_id`,`chcc_db`.`employees`.`lname` AS `lname`,`chcc_db`.`employees`.`fname` AS `fname`,`chcc_db`.`employees`.`mi` AS `mi`,`chcc_db`.`employees`.`contact` AS `contact`,`chcc_db`.`employees`.`gender` AS `gender`,`chcc_db`.`employees`.`bdate` AS `bdate`,`chcc_db`.`employees`.`email` AS `email`,`chcc_db`.`employees`.`hire_date` AS `hire_date`,`chcc_db`.`employees`.`status` AS `status` from `chcc_db`.`employees` where (`chcc_db`.`employees`.`role` = 'admin') ;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cash`  AS select `chcc_db`.`employees`.`emp_id` AS `emp_id`,`chcc_db`.`employees`.`lname` AS `lname`,`chcc_db`.`employees`.`fname` AS `fname`,`chcc_db`.`employees`.`mi` AS `mi`,`chcc_db`.`employees`.`contact` AS `contact`,`chcc_db`.`employees`.`gender` AS `gender`,`chcc_db`.`employees`.`bdate` AS `bdate`,`chcc_db`.`employees`.`email` AS `email`,`chcc_db`.`employees`.`hire_date` AS `hire_date`,`chcc_db`.`employees`.`status` AS `status` from `chcc_db`.`employees` where (`chcc_db`.`employees`.`role` = 'cashier');


CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `classsubject`  AS select `chcc_db`.`classes`.`class_code` AS `class_code`,`chcc_db`.`classes`.`school_year` AS `school_year`,`chcc_db`.`classes`.`slots` AS `slots`,`chcc_db`.`classes`.`sem` AS `sem`,`chcc_db`.`classes`.`subject_id` AS `subject_id`,`chcc_db`.`classes`.`sched_day` AS `sched_day`,`chcc_db`.`classes`.`sched_time_start` AS `sched_time_start`,`chcc_db`.`classes`.`sched_time_end` AS `sched_time_end`,`chcc_db`.`classes`.`room` AS `room`,`chcc_db`.`classes`.`section_code` AS `section_code`,`chcc_db`.`classes`.`status` AS `status`,`chcc_db`.`subjects`.`subject_code` AS `subject_code`,`chcc_db`.`subjects`.`subject` AS `subject`,`chcc_db`.`subjects`.`course_code` AS `course_code`,`chcc_db`.`subjects`.`year_level` AS `year_level`,`chcc_db`.`subjects`.`subject_type` AS `subject_type` from (`chcc_db`.`classes` join `chcc_db`.`subjects`) where (`chcc_db`.`classes`.`subject_id` = `chcc_db`.`subjects`.`id`) ;


CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `studentassessment`  AS select `chcc_db`.`classes`.`class_code` AS `class_code`,`chcc_db`.`classes`.`school_year` AS `school_year`,`chcc_db`.`classes`.`sem` AS `sem`,`chcc_db`.`classes`.`subject_id` AS `subject_id`,`chcc_db`.`classes`.`sched_day` AS `sched_day`,`chcc_db`.`classes`.`sched_time_start` AS `sched_time_start`,`chcc_db`.`classes`.`sched_time_end` AS `sched_time_end`,`chcc_db`.`classes`.`room` AS `room`,`chcc_db`.`classes`.`section_code` AS `section_code`,`chcc_db`.`classes`.`status` AS `status`,`chcc_db`.`subjects`.`subject_code` AS `subject_code`,`chcc_db`.`subjects`.`subject` AS `subject`,`chcc_db`.`subjects`.`total_units` AS `units`,`chcc_db`.`subjects`.`other_units` AS `other_units`,`chcc_db`.`subjects`.`course_code` AS `course_code`,`chcc_db`.`subjects`.`year_level` AS `year_level`,`chcc_db`.`subjects`.`subject_type` AS `subject_type`,`chcc_db`.`student_classes`.`student_id` AS `student` from ((`chcc_db`.`classes` join `chcc_db`.`subjects`) join `chcc_db`.`student_classes`) where ((`chcc_db`.`classes`.`subject_id` = `chcc_db`.`subjects`.`id`) and (`chcc_db`.`classes`.`class_code` = `chcc_db`.`student_classes`.`class_code`) and (`chcc_db`.`classes`.`sem` = `chcc_db`.`student_classes`.`sem`) and (`chcc_db`.`classes`.`school_year` = `chcc_db`.`student_classes`.`school_year`)) ;



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `studentenrollment`  AS select `chcc_db`.`students`.`id` AS `id`,`chcc_db`.`students`.`student_id` AS `student_id`,`chcc_db`.`students`.`lname` AS `lname`,`chcc_db`.`students`.`fname` AS `fname`,`chcc_db`.`students`.`mi` AS `mi`,`chcc_db`.`students`.`bdate` AS `bdate`,`chcc_db`.`students`.`gender` AS `gender`,`chcc_db`.`students`.`contact` AS `contact`,`chcc_db`.`students`.`email` AS `email`,`chcc_db`.`students`.`emergency_person` AS `emergency_person`,`chcc_db`.`students`.`emergency_contact` AS `emergency_contact`,`chcc_db`.`students`.`reg_date` AS `reg_date`,`chcc_db`.`enrollment`.`course_code` AS `course_code`,`chcc_db`.`enrollment`.`enrollment_date` AS `enrollment_date`,`chcc_db`.`enrollment`.`school_year` AS `school_year`,`chcc_db`.`enrollment`.`section` AS `section`,`chcc_db`.`enrollment`.`sem` AS `sem`,`chcc_db`.`enrollment`.`status` AS `status`,`chcc_db`.`enrollment`.`year_level` AS `year_level` from (`chcc_db`.`students` join `chcc_db`.`enrollment`) where (`chcc_db`.`students`.`student_id` = `chcc_db`.`enrollment`.`student_id`) ;



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `studentprofile`  AS select `chcc_db`.`students`.`student_id` AS `student_id`,`chcc_db`.`students`.`lname` AS `lname`,`chcc_db`.`students`.`fname` AS `fname`,`chcc_db`.`students`.`mi` AS `mi`,`chcc_db`.`students`.`bdate` AS `bdate`,`chcc_db`.`students`.`gender` AS `gender`,`chcc_db`.`students`.`contact` AS `contact`,`chcc_db`.`students`.`email` AS `email`,`chcc_db`.`students`.`emergency_person` AS `emergency_person`,`chcc_db`.`students`.`emergency_contact` AS `emergency_contact`,`chcc_db`.`students`.`reg_date` AS `reg_date`,`chcc_db`.`enrollment`.`course_code` AS `course_code`,`chcc_db`.`enrollment`.`enrollment_date` AS `enrollment_date`,`chcc_db`.`enrollment`.`school_year` AS `school_year`,`chcc_db`.`enrollment`.`section` AS `section`,`chcc_db`.`enrollment`.`sem` AS `sem`,`chcc_db`.`enrollment`.`status` AS `status`,`chcc_db`.`enrollment`.`year_level` AS `year_level`,`chcc_db`.`picture`.`type` AS `type`,`chcc_db`.`picture`.`title` AS `title`,`chcc_db`.`picture`.`dir` AS `dir` from ((`chcc_db`.`students` join `chcc_db`.`enrollment`) join `chcc_db`.`picture`) where ((`chcc_db`.`students`.`student_id` = `chcc_db`.`enrollment`.`student_id`) and (`chcc_db`.`students`.`student_id` = convert(`chcc_db`.`picture`.`user_id` using utf8))) ;



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `teacherclass`  AS select `chcc_db`.`classes`.`class_code` AS `class_code`,`chcc_db`.`classes`.`school_year` AS `school_year`,`chcc_db`.`classes`.`sem` AS `sem`,`chcc_db`.`classes`.`subject_id` AS `subject_id`,`chcc_db`.`classes`.`sched_day` AS `sched_day`,`chcc_db`.`classes`.`sched_time_start` AS `sched_time_start`,`chcc_db`.`classes`.`sched_time_end` AS `sched_time_end`,`chcc_db`.`classes`.`room` AS `room`,`chcc_db`.`classes`.`section_code` AS `section_code`,`chcc_db`.`classes`.`status` AS `status`,`chcc_db`.`subjects`.`subject_code` AS `subject_code`,`chcc_db`.`subjects`.`subject` AS `subject`,`chcc_db`.`subjects`.`total_units` AS `units`,`chcc_db`.`subjects`.`other_units` AS `other_units`,`chcc_db`.`subjects`.`course_code` AS `course_code`,`chcc_db`.`subjects`.`year_level` AS `year_level`,`chcc_db`.`subjects`.`subject_type` AS `subject_type`,`chcc_db`.`teacher_classes`.`emp_id` AS `teacher` from ((`chcc_db`.`classes` join `chcc_db`.`subjects`) join `chcc_db`.`teacher_classes`) where ((`chcc_db`.`classes`.`subject_id` = `chcc_db`.`subjects`.`id`) and (`chcc_db`.`classes`.`class_code` = `chcc_db`.`teacher_classes`.`class_code`) and (`chcc_db`.`classes`.`sem` = `chcc_db`.`teacher_classes`.`sem`) and (`chcc_db`.`classes`.`school_year` = `chcc_db`.`teacher_classes`.`school_year`)) ;




CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `teacher`  AS select `chcc_db`.`employees`.`emp_id` AS `emp_id`,`chcc_db`.`employees`.`lname` AS `lname`,`chcc_db`.`employees`.`fname` AS `fname`,`chcc_db`.`employees`.`mi` AS `mi`,`chcc_db`.`employees`.`bdate` AS `bdate`,`chcc_db`.`employees`.`gender` AS `gender`,`chcc_db`.`employees`.`email` AS `email`,`chcc_db`.`employees`.`contact` AS `contact`,`chcc_db`.`employees`.`hire_date` AS `hire_date`,`chcc_db`.`employees`.`status` AS `status` from `chcc_db`.`employees` where (`chcc_db`.`employees`.`role` = 'teacher') ;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
