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
-- Structure for view `classsubjects`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `classsubjects`  AS  select `classes`.`class_code` AS `class_code`,`classes`.`school_year` AS `school_year`,`classes`.`slots` AS `slots`,`classes`.`sem` AS `sem`,`classes`.`subject_id` AS `subject_id`,`classes`.`sched_day` AS `sched_day`,`classes`.`sched_time_start` AS `sched_time_start`,`classes`.`sched_time_end` AS `sched_time_end`,`classes`.`room` AS `room`,`classes`.`section_code` AS `section_code`,`classes`.`status` AS `status`,`subjects`.`subject_code` AS `subject_code`,`subjects`.`subject` AS `subject`,`subjects`.`course_code` AS `course_code`,`subjects`.`year_level` AS `year_level`,`subjects`.`subject_type` AS `subject_type` from (`classes` join `subjects`) where (`classes`.`subject_id` = `subjects`.`id`) ;

--
-- VIEW  `classsubjects`
-- Data: None
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
