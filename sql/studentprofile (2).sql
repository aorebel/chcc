-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2018 at 05:09 AM
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
-- Structure for view `studentprofile`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `studentprofile`  AS  select `students`.`student_id` AS `student_id`,`students`.`lname` AS `lname`,`students`.`fname` AS `fname`,`students`.`mi` AS `mi`,`students`.`bdate` AS `bdate`,`students`.`gender` AS `gender`,`students`.`contact` AS `contact`,`students`.`email` AS `email`,`students`.`emergency_person` AS `emergency_person`,`students`.`emergency_contact` AS `emergency_contact`,`students`.`reg_date` AS `reg_date`,`enrollment`.`course_code` AS `course_code`,`enrollment`.`enrollment_date` AS `enrollment_date`,`enrollment`.`school_year` AS `school_year`,`enrollment`.`section` AS `section`,`enrollment`.`sem` AS `sem`,`enrollment`.`status` AS `status`,`enrollment`.`year_level` AS `year_level`,`picture`.`type` AS `type`,`picture`.`title` AS `title`,`picture`.`dir` AS `dir` from ((`students` join `enrollment`) join `picture`) where ((`students`.`student_id` = `enrollment`.`student_id`) and (`students`.`student_id` = `picture`.`user_id`)) ;

--
-- VIEW  `studentprofile`
-- Data: None
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
