-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2018 at 06:29 AM
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
-- Table structure for table `activation`
--

CREATE TABLE `activation` (
  `id` int(11) NOT NULL,
  `uname` varchar(8) NOT NULL,
  `act_code` varchar(8) NOT NULL,
  `status` varchar(15) NOT NULL,
  `act_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activation`
--

INSERT INTO `activation` (`id`, `uname`, `act_code`, `status`, `act_date`) VALUES
(3, '1310001', '9rhk78', 'Activated', '2018-08-20'),
(4, '1410002', 'otUftX', 'Not Activated', '0000-00-00'),
(5, '181320', 'DmiGgf', 'Activated', '2018-08-21');

-- --------------------------------------------------------

--
-- Stand-in structure for view `admin`
-- (See below for the actual view)
--
CREATE TABLE `admin` (
`emp_id` varchar(8)
,`lname` varchar(11)
,`fname` varchar(13)
,`mi` varchar(2)
,`contact` varchar(13)
,`gender` varchar(7)
,`bdate` date
,`email` char(30)
,`hire_date` date
,`status` varchar(15)
);

-- --------------------------------------------------------

--
-- Table structure for table `assessment`
--

CREATE TABLE `assessment` (
  `id` int(11) NOT NULL,
  `student_id` varchar(8) NOT NULL,
  `misc_fee` decimal(5,2) NOT NULL,
  `units` int(11) NOT NULL,
  `lab_units` int(11) NOT NULL,
  `lec_units` int(11) NOT NULL,
  `tuition_fee` decimal(5,2) NOT NULL,
  `total_amount` decimal(5,2) NOT NULL,
  `pay_plan_code` varchar(15) NOT NULL,
  `discount` decimal(5,2) NOT NULL,
  `net_payable` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `cash`
-- (See below for the actual view)
--
CREATE TABLE `cash` (
`emp_id` varchar(8)
,`lname` varchar(11)
,`fname` varchar(13)
,`mi` varchar(2)
,`contact` varchar(13)
,`gender` varchar(7)
,`bdate` date
,`email` char(30)
,`hire_date` date
,`status` varchar(15)
);

-- --------------------------------------------------------

--
-- Table structure for table `cashier`
--

CREATE TABLE `cashier` (
  `id` int(11) NOT NULL,
  `student_id` varchar(8) NOT NULL,
  `assessment_id` varchar(8) NOT NULL,
  `amount` decimal(5,2) NOT NULL,
  `comment` text NOT NULL,
  `counter` int(1) NOT NULL,
  `bal` decimal(5,2) NOT NULL,
  `pay_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class_code` varchar(8) NOT NULL,
  `school_year` varchar(11) NOT NULL,
  `sem` varchar(15) NOT NULL,
  `subject_code` varchar(8) NOT NULL,
  `sched_day` varchar(50) NOT NULL,
  `sched_time_start` time NOT NULL,
  `sched_time_end` time NOT NULL,
  `room_code` varchar(15) NOT NULL,
  `unit_code` varchar(15) NOT NULL,
  `slot_req` int(11) NOT NULL,
  `slot_avail` int(11) NOT NULL,
  `section_code` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_code`, `school_year`, `sem`, `subject_code`, `sched_day`, `sched_time_start`, `sched_time_end`, `room_code`, `unit_code`, `slot_req`, `slot_avail`, `section_code`) VALUES
(1, '', '', '', '', '', '07:30:00', '00:00:00', '0', '0', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_code` varchar(8) NOT NULL,
  `course` varchar(50) NOT NULL,
  `major` varchar(25) NOT NULL,
  `description` longtext NOT NULL,
  `req_units` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(8) DEFAULT NULL,
  `lname` varchar(11) DEFAULT NULL,
  `fname` varchar(13) DEFAULT NULL,
  `mi` varchar(2) DEFAULT NULL,
  `bdate` date NOT NULL,
  `gender` varchar(7) NOT NULL,
  `email` char(30) NOT NULL,
  `contact` varchar(13) NOT NULL,
  `hire_date` date NOT NULL,
  `hire_year` varchar(5) NOT NULL,
  `role` varchar(25) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `emp_id`, `lname`, `fname`, `mi`, `bdate`, `gender`, `email`, `contact`, `hire_date`, `hire_year`, `role`, `status`) VALUES
(1, '18-10002', 'Alviar', 'Roel', 'R.', '0000-00-00', '', '', '', '2018-01-08', '', 'teacher', ''),
(2, '18-10003', 'Anunciacion', 'Karlo', NULL, '0000-00-00', '', '', '', '2017-10-20', '2017', 'teacher', ''),
(3, '18-10004', 'Ayson', 'Eric', NULL, '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(4, '18-10005', 'Bucu', 'Lenon', NULL, '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(5, '18-10006', 'Cano', 'Juanita', 'B.', '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(6, '18-10007', 'Claro', 'Lylani', 'S.', '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(7, '18-10008', 'Cortez', 'Venancia', 'A.', '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(8, '18-10009', 'Cortez', 'Vince', NULL, '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(9, '18-10010', 'David', 'Carlos', 'B.', '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(10, '18-10011', 'Dela Cruz', 'Francis Jose', 'B.', '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(11, '18-10012', 'Felix', 'Jayson', NULL, '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(12, '18-10013', 'Gomez', 'Cezar Jr.', 'M.', '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(13, '18-10014', 'Gueco', 'Orlando', NULL, '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(14, '18-10015', 'Las Igan', 'Ramil', 'M.', '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(15, '18-10016', 'Lim', 'Eduardo', NULL, '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(16, '18-10017', 'Macaraig', 'Ruben', NULL, '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(17, '18-10018', 'Manlapig', 'Eric', NULL, '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(18, '18-10019', 'Mejia', 'JM', NULL, '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(19, '18-10020', 'Mercado', 'Lucila Odelan', NULL, '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(20, '18-10021', 'Ocampo', 'Ivan Ave', 'P.', '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(21, '18-10022', 'Pangan', 'R Jay', 'D.', '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(22, '18-10023', 'Pattugalan', 'Marion', 'B.', '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(23, '18-10024', 'Pineda', 'Aurora', NULL, '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(24, '18-10025', 'Quesada', 'Joel', NULL, '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(25, '18-10026', 'Quiambao', 'Alladin', NULL, '0000-00-00', '', '', '', '0000-00-00', '', 'teacher', ''),
(26, '18-10027', 'Ramos', 'Lilia C.', NULL, '0000-00-00', '', '', '', '0000-00-00', '', '', ''),
(27, '18-10028', 'Santioque', 'Emerencina', NULL, '0000-00-00', '', '', '', '0000-00-00', '', '', ''),
(28, '18-10029', 'Suarez', 'Marilyn', NULL, '0000-00-00', '', '', '', '0000-00-00', '', '', ''),
(29, '18-10030', 'Tolosa', 'Rosalia', 'B.', '0000-00-00', '', '', '', '0000-00-00', '', '', ''),
(30, '18-10031', 'Yumul', 'Rommel', 'P.', '0000-00-00', '', '', '', '2018-03-01', '2018', '', ''),
(35, '18-10034', 'a', 'a', 'a', '2018-12-31', 'Male', 'asd@sdac.c', '08928013', '2018-01-31', '2018', 'teacher', 'active'),
(37, '18-10035', 'asdasda', 'deeas', 'w', '1992-02-02', 'Male', 'asdas@asda', '0909123', '2018-03-19', '2018', 'teacher', 'active'),
(45, '14-10001', 'Dy', 'Avin', 'Z', '1997-02-02', 'Female', 'avindy2015@gmail.com', '9234609017', '2014-02-23', '2014', 'cashier', 'active'),
(46, '18-10036', 'Dy', 'Vin', 'Z', '1996-02-04', 'Male', 'email@gmail.com', '9234609019', '2018-04-04', '2018', 'cashier', 'active'),
(47, '13-10001', 'school', 'admin', 'a', '1990-12-30', 'Female', 'avindy2017@gmail.com', '9234602017', '2013-08-31', '2013', 'admin', 'active'),
(48, '14-10002', 'Dy', 'Avin', 'a', '1985-12-26', 'Male', 'avindy2015@gmail.com', '9234609027', '2014-04-30', '2014', 'admin', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `id` int(11) NOT NULL,
  `student_id` varchar(8) NOT NULL,
  `assessment_id` varchar(8) DEFAULT NULL,
  `school_year` varchar(9) DEFAULT NULL,
  `sem` varchar(7) DEFAULT NULL,
  `year_level` varchar(3) DEFAULT NULL,
  `course_code` varchar(8) NOT NULL,
  `section` varchar(6) DEFAULT NULL,
  `enrollment_date` date NOT NULL,
  `status` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`id`, `student_id`, `assessment_id`, `school_year`, `sem`, `year_level`, `course_code`, `section`, `enrollment_date`, `status`) VALUES
(1, '', '10-1800', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(2, '', '13-0322', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(3, '', '14-0152', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(4, '', '14-0153', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(5, '', '14-0156', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(6, '', '14-0157', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(7, '', '14-0158', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(8, '', '14-0159', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(9, '', '14-0163', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(10, '', '14-0166', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(11, '', '14-0167', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(12, '', '14-0168', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(13, '', '14-0169', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(14, '', '15-0027', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(15, '', '15-0029', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(16, '', '15-0030', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(17, '', '15-0031', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(18, '', '15-0032', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(19, '', '15-0033', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(20, '', '15-0039', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(21, '', '15-0040', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(22, '', '15-0043', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(23, '', '15-0045', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(24, '', '15-0046', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(25, '', '15-0047', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(26, '', '15-0048', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(27, '', '15-0049', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(28, '', '15-0051', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(29, '', '15-0053', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(30, '', '15-0102', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'IRREGULAR'),
(31, '', '17-0059', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(32, '', '17-0061', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(33, '', '17-0062', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(34, '', '17-0063', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(35, '', '17-0064', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'IRREGULAR'),
(36, '', '17-0065', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(37, '', '16-0109', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(38, '', '16-0112', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(39, '', '13-0304', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(40, '', '14-0228', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(41, '', '10-1759', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(42, '', '12-0026', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(43, '', '13-0010', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(44, '', '13-0015', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(45, '', '13-0026', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(46, '', '13-0110', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(47, '', '13-0255', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(48, '', '13-0280', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(49, '', '13-0312', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(50, '', '14-0196', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(51, '', '14-0201', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(52, '', '14-0205', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(53, '', '14-0206', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(54, '', '14-0208', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(55, '', '14-0210', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(56, '', '14-0211', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(57, '', '14-0212', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(58, '', '14-0213', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(59, '', '14-0215', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(60, '', '14-0216', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(61, '', '14-0217', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(62, '', '14-0219', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(63, '', '14-0220', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(64, '', '14-0221', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(65, '', '14-0222', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(66, '', '14-0224', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(67, '', '14-0226', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(68, '', '14-0227', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(69, '', '14-0229', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(70, '', '14-0230', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(71, '', '14-0231', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(72, '', '14-0233', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(73, '', '14-0234', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(74, '', '14-0235', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(75, '', '14-0239', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(76, '', '14-0243', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(77, '', '14-0244', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(78, '', '14-0246', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(79, '', '14-0249', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(80, '', '14-0251', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(81, '', '14-0253', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(82, '', '14-0256', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(83, '', '14-0257', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(84, '', '14-0259', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(85, '', '14-0262', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(86, '', '14-0264', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(87, '', '14-0265', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(88, '', '14-0267', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(89, '', '14-0269', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(90, '', '14-0272', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'IRREGULAR'),
(91, '', '14-0276', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(92, '', '14-0277', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(93, '', '14-0278', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(94, '', '14-0279', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(95, '', '14-0280', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(96, '', '14-0281', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(97, '', '14-0282', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(98, '', '14-0284', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(99, '', '14-0285', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(100, '', '14-0286', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(101, '', '14-0287', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(102, '', '14-0289', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(103, '', '14-0290', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'IRREGULAR'),
(104, '', '14-0328', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(105, '', '14-0359', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(106, '', '14-0396', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(107, '', '14-0411', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(108, '', '14-0422', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(109, '', '14-0427', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(110, '', '14-0435', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(111, '', '15-0293', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(112, '', '17-0006', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(113, '', '17-0007', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(114, '', '17-0008', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(115, '', '17-0010', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(116, '', '17-0019', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(117, '', '17-0020', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(118, '', '17-0024', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(119, '', '17-0034', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(120, '', '15-0419', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'IRREGULAR'),
(121, '', '16-0007', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(122, '', '16-0013', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(123, '', '16-0014', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(124, '', '16-0018', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(125, '', '16-0019', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(126, '', '16-0027', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(127, '', '16-0029', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(128, '', '16-0032', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(129, '', '17-0039', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'IRREGULAR'),
(130, '', '14-0275', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'IRREGULAR'),
(131, '', '15-0238', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(132, '', '15-0240', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(133, '', '15-0242', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(134, '', '15-0249', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(135, '', '15-0253', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(136, '', '15-0257', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(137, '', '15-0268', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(138, '', '15-0272', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(139, '', '15-0274', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(140, '', '15-0278', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(141, '', '15-0288', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(142, '', '15-0290', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(143, '', '15-0297', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(144, '', '15-0298', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(145, '', '15-0299', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(146, '', '15-0306', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(147, '', '15-0323', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(148, '', '15-0324', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(149, '', '15-0325', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(150, '', '15-0326', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(151, '', '15-0327', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(152, '', '15-0336', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(153, '', '15-0340', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(154, '', '15-0341', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(155, '', '15-0344', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(156, '', '15-0348', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(157, '', '15-0349', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(158, '', '15-0360', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(159, '', '15-0361', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(160, '', '15-0364', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(161, '', '15-0368', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(162, '', '15-0391', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(163, '', '15-0395', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(164, '', '15-0396', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(165, '', '15-0407', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(166, '', '15-0449', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(167, '', '14-0274', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(168, '', '15-0226', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(169, '', '15-0228', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(170, '', '15-0370', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(171, '', '15-0377', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(172, '', '15-0380', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(173, '', '98-0432', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(174, '', '15-0254', '2018-2019', '1st Sem', 'III', '', 'BEED-A', '0000-00-00', 'REGULAR'),
(175, '', '15-0259', '2018-2019', '1st Sem', 'III', '', 'BEED-A', '0000-00-00', 'REGULAR'),
(176, '', '15-0262', '2018-2019', '1st Sem', 'III', '', 'BEED-A', '0000-00-00', 'REGULAR'),
(177, '', '15-0279', '2018-2019', '1st Sem', 'III', '', 'BEED-A', '0000-00-00', 'REGULAR'),
(178, '', '15-0305', '2018-2019', '1st Sem', 'III', '', 'BEED-A', '0000-00-00', 'REGULAR'),
(179, '', '15-0311', '2018-2019', '1st Sem', 'III', '', 'BEED-A', '0000-00-00', 'REGULAR'),
(180, '', '15-0335', '2018-2019', '1st Sem', 'III', '', 'BEED-A', '0000-00-00', 'REGULAR'),
(181, '', '15-0345', '2018-2019', '1st Sem', 'III', '', 'BEED-A', '0000-00-00', 'REGULAR'),
(182, '', '15-0384', '2018-2019', '1st Sem', 'III', '', 'BEED-A', '0000-00-00', 'REGULAR'),
(183, '', '13-0089', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(184, '', '13-0218', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(185, '', '14-0004', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(186, '', '14-0009', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(187, '', '14-0012', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(188, '', '14-0020', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(189, '', '14-0023', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(190, '', '14-0036', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(191, '', '14-0043', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(192, '', '14-0049', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(193, '', '14-0052', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(194, '', '14-0055', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(195, '', '14-0057', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(196, '', '14-0058', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'IRREGULAR'),
(197, '', '14-0061', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(198, '', '14-0062', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(199, '', '14-0067', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(200, '', '14-0068', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(201, '', '14-0069', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(202, '', '14-0075', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(203, '', '14-0077', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(204, '', '14-0078', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(205, '', '14-0082', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'IRREGULAR'),
(206, '', '14-0097', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(207, '', '14-0107', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(208, '', '14-0419', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(209, '', '15-0101', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(210, '', '15-0107', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(211, '', '15-0110', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(212, '', '15-0112', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(213, '', '15-0114', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(214, '', '15-0115', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(215, '', '15-0117', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(216, '', '15-0118', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(217, '', '15-0120', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(218, '', '15-0126', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(219, '', '15-0128', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(220, '', '15-0130', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(221, '', '15-0131', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(222, '', '15-0132', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(223, '', '15-0134', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(224, '', '15-0135', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(225, '', '15-0138', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(226, '', '15-0142', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(227, '', '15-0146', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(228, '', '15-0147', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(229, '', '15-0155', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(230, '', '15-0159', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(231, '', '15-0161', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(232, '', '15-0162', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(233, '', '15-0163', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(234, '', '15-0164', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(235, '', '15-0166', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(236, '', '15-0167', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(237, '', '15-0170', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(238, '', '15-0171', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(239, '', '15-0174', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(240, '', '15-0185', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(241, '', '15-0187', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(242, '', '15-0189', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(243, '', '15-0197', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(244, '', '15-0199', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(245, '', '15-0202', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(246, '', '17-0046', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(247, '', '17-0047', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(248, '', '17-0048', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'IRREGULAR'),
(249, '', '17-0050', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(250, '', '17-0051', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(251, '', '17-0052', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'IRREGULAR'),
(252, '', '15-0435', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(253, '', '16-0083', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'IRREGULAR'),
(254, '', '16-0084', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(255, '', '16-0085', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'IRREGULAR'),
(256, '', '16-0094', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(257, '', '16-0095', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(258, '', '16-0099', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(259, '', '16-0103', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(260, '', '16-0107', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(261, '', '16-0128', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(262, '', '15-0212', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(263, '', '15-0213', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(264, '', '15-0214', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(265, '', '15-0215', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(266, '', '15-0222', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(267, '', '15-0251', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(268, '', '15-0410', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(269, '', '17-0040', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(270, '', '15-0392', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(271, '', '15-0431', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'IRREGULAR'),
(272, '', '15-0443', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(273, '', '13-0122', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(274, '', '14-0127', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(275, '', '14-0133', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(276, '', '14-0145', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(277, '', '14-0207', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(278, '', '15-0063', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(279, '', '15-0070', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(280, '', '15-0071', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(281, '', '15-0072', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(282, '', '15-0075', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(283, '', '15-0088', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(284, '', '15-0090', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(285, '', '15-0092', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(286, '', '15-0093', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(287, '', '15-0398', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(288, '', '16-0054', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(289, '', '16-0056', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(290, '', '15-0433', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'IRREGULAR'),
(291, '', '13-0248', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(292, '', '14-0240', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(293, '', '14-0309', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(294, '', '17-0002', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(295, '', '17-0003', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(296, '', '17-0012', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(297, '', '17-0014', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(298, '', '17-0028', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(299, '', '16-0003', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(300, '', '16-0011', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(301, '', '16-0012', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(302, '', '16-0134', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(303, '', '15-0233', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(304, '', '15-0247', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(305, '', '15-0266', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(306, '', '15-0267', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(307, '', '15-0270', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(308, '', '15-0313', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(309, '', '15-0317', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(310, '', '15-0346', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(311, '', '15-0359', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(312, '', '15-0374', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(313, '', '15-0375', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(314, '', '15-0399', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(315, '', '15-0428', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(316, '', '10-1770', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(317, '', '14-0223', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(318, '', '14-0252', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(319, '', '14-0291', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(320, '', '14-0293', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(321, '', '14-0297', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(322, '', '14-0298', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(323, '', '14-0299', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(324, '', '14-0301', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(325, '', '14-0302', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(326, '', '14-0303', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(327, '', '14-0305', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(328, '', '14-0306', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(329, '', '14-0368', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(330, '', '15-0422', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(331, '', '13-0266', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(332, '', '14-0200', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(333, '', '14-0332', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(334, '', '17-0017', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(335, '', '17-0027', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(336, '', '16-0005', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(337, '', '16-0010', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(338, '', '16-0016', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(339, '', '16-0017', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(340, '', '16-0022', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(341, '', '16-0023', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(342, '', '16-0025', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(343, '', '16-0026', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(344, '', '16-0036', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(345, '', '16-0037', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(346, '', '15-0273', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(347, '', '15-0302', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(348, '', '15-0310', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(349, '', '15-0352', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(350, '', '15-0358', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(351, '', '15-0403', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(352, '', '16-0080', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(353, '', '16-0081', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(354, '', '11-0048', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(355, '', '13-0084', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'IRREGULAR'),
(356, '', '13-0316', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(357, '', '14-0174', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(358, '', '14-0175', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(359, '', '14-0181', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(360, '', '14-0182', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'IRREGULAR'),
(361, '', '14-0184', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(362, '', '14-0189', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(363, '', '14-0190', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(364, '', '14-0195', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(365, '', '14-0430', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(366, '', '15-0001', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(367, '', '15-0002', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(368, '', '15-0007', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(369, '', '15-0009', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(370, '', '15-0010', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(371, '', '15-0013', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(372, '', '15-0015', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(373, '', '15-0016', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(374, '', '15-0020', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(375, '', '15-0022', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'IRREGULAR'),
(376, '', '15-0437', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'IRREGULAR'),
(377, '', '16-0059', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(378, '', '16-0065', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(379, '', '16-0122', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(380, '', '15-0453', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(381, '', '13-0112', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(382, '', '17-0005', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(383, '', '17-0015', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(384, '', '17-0030', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(385, '', '17-0033', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(386, '', '17-0056', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(387, '', '16-0006', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(388, '', '16-0033', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'IRREGULAR'),
(389, '', '16-0034', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(390, '', '16-0035', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(391, '', '15-0244', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(392, '', '15-0246', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(393, '', '15-0287', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(394, '', '15-0292', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(395, '', '15-0316', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(396, '', '15-0318', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(397, '', '15-0328', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(398, '', '15-0362', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(399, '', '15-0383', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(400, '', '15-0456', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(401, '', '15-0442', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(402, '', '09-1655', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(403, '', '14-0296', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(404, '', '14-0300', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(405, '', '14-0313', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(406, '', '14-0314', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(407, '', '14-0315', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(408, '', '14-0316', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(409, '', '14-0317', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(410, '', '14-0319', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(411, '', '14-0320', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(412, '', '14-0322', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(413, '', '14-0329', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(414, '', '14-0337', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(415, '', '14-0338', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(416, '', '14-0361', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(417, '', '14-0365', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(418, '', '17-0018', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(419, '', '17-0025', '2018-2019', '1st Sem', 'I', '', NULL, '0000-00-00', 'REGULAR'),
(420, '', '16-0004', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'IRREGULAR'),
(421, '', '16-0031', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'REGULAR'),
(422, '', '15-0236', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(423, '', '15-0241', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(424, '', '15-0294', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(425, '', '15-0351', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(426, '', '15-0356', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(427, '', '15-0373', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(428, '', '14-0324', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(429, '', '14-0325', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(430, '', '14-0326', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(431, '', '14-0330', '2018-2019', '1st Sem', 'II', '', NULL, '0000-00-00', 'IRREGULAR'),
(432, '', '13-0309', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(433, '', '13-0310', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(434, '', '14-0266', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(435, '', '14-0339', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(436, '', '14-0364', '2018-2019', '1st Sem', 'IV', '', NULL, '0000-00-00', 'REGULAR'),
(437, '', '15-0234', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(438, '', '15-0264', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(439, '', '15-0281', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(440, '', '15-0314', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(441, '', '15-0330', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(442, '', '14-0336', '2018-2019', '1st Sem', 'III', '', NULL, '0000-00-00', 'REGULAR'),
(443, '', '05-1319', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(444, '', '10-1702', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(445, '', '10-1706', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(446, '', '10-1715', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(447, '', '11-0126', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(448, '', '11-0162', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(449, '', '12-0058', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(450, '', '12-0156', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(451, '', '12-0225', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(452, '', '12-0238', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(453, '', '13-0017', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(454, '', '13-0048', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(455, '', '13-0051', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(456, '', '13-0060', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(457, '', '13-0076', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(458, '', '13-0079', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(459, '', '13-0082', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(460, '', '13-0086', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(461, '', '13-0117', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(462, '', '13-0219', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(463, '', '13-0220', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(464, '', '13-0222', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(465, '', '13-0237', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(466, '', '13-0288', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(467, '', '13-0323', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(468, '', '14-0005', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(469, '', '14-0015', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(470, '', '14-0019', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(471, '', '14-0024', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(472, '', '14-0032', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(473, '', '14-0033', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(474, '', '14-0039', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(475, '', '14-0041', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(476, '', '14-0044', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(477, '', '14-0046', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(478, '', '14-0047', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(479, '', '14-0056', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(480, '', '14-0060', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(481, '', '14-0063', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(482, '', '14-0064', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(483, '', '14-0065', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(484, '', '14-0076', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(485, '', '14-0079', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(486, '', '14-0083', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(487, '', '14-0090', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(488, '', '14-0092', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(489, '', '14-0096', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(490, '', '14-0101', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(491, '', '14-0103', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(492, '', '14-0104', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(493, '', '14-0106', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(494, '', '14-0155', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(495, '', '14-0170', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(496, '', '14-0194', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(497, '', '14-0198', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(498, '', '14-0214', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(499, '', '14-0260', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(500, '', '14-0273', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(501, '', '14-0331', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(502, '', '14-0343', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(503, '', '14-0344', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(504, '', '14-0366', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(505, '', '14-0391', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(506, '', '14-0392', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(507, '', '14-0398', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(508, '', '14-0401', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(509, '', '14-0416', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(510, '', '14-0420', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(511, '', '14-0421', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(512, '', '14-0424', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(513, '', '14-0428', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(514, '', '14-0437', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(515, '', '14-0439', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(516, '', '15-0006', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(517, '', '15-0023', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(518, '', '15-0035', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(519, '', '15-0041', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(520, '', '15-0055', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(521, '', '15-0065', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(522, '', '15-0104', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(523, '', '15-0105', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(524, '', '15-0111', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(525, '', '15-0113', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(526, '', '15-0116', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(527, '', '15-0121', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(528, '', '15-0122', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(529, '', '15-0123', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(530, '', '15-0124', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(531, '', '15-0125', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(532, '', '15-0127', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(533, '', '15-0129', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(534, '', '15-0137', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(535, '', '15-0139', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(536, '', '15-0144', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(537, '', '15-0151', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(538, '', '15-0153', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(539, '', '15-0154', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(540, '', '15-0158', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(541, '', '15-0173', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(542, '', '15-0175', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(543, '', '15-0177', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(544, '', '15-0178', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(545, '', '15-0182', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(546, '', '15-0183', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(547, '', '15-0188', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(548, '', '15-0190', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(549, '', '15-0193', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(550, '', '15-0195', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(551, '', '15-0196', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(552, '', '15-0205', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(553, '', '15-0206', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(554, '', '15-0207', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(555, '', '15-0208', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(556, '', '15-0210', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(557, '', '15-0220', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(558, '', '15-0223', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(559, '', '15-0229', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(560, '', '15-0230', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(561, '', '15-0231', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(562, '', '15-0232', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(563, '', '15-0239', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(564, '', '15-0255', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(565, '', '15-0256', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(566, '', '15-0260', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(567, '', '15-0275', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(568, '', '15-0280', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(569, '', '15-0282', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(570, '', '15-0283', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(571, '', '15-0284', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(572, '', '15-0296', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(573, '', '15-0320', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(574, '', '15-0334', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(575, '', '15-0337', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(576, '', '15-0338', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(577, '', '15-0343', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(578, '', '15-0365', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(579, '', '15-0367', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(580, '', '15-0376', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(581, '', '15-0387', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(582, '', '15-0388', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR');
INSERT INTO `enrollment` (`id`, `student_id`, `assessment_id`, `school_year`, `sem`, `year_level`, `course_code`, `section`, `enrollment_date`, `status`) VALUES
(583, '', '15-0390', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(584, '', '15-0393', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(585, '', '15-0405', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(586, '', '15-0408', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(587, '', '15-0420', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(588, '', '15-0421', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(589, '', '15-0426', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(590, '', '15-0429', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(591, '', '15-0430', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(592, '', '15-0432', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(593, '', '15-0440', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(594, '', '15-0444', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(595, '', '15-0445', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(596, '', '15-0450', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(597, '', '15-0452', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(598, '', '16-0001', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(599, '', '16-0002', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(600, '', '16-0020', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(601, '', '16-0046', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(602, '', '16-0050', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(603, '', '16-0051', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(604, '', '16-0052', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(605, '', '16-0053', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(606, '', '16-0060', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(607, '', '16-0061', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(608, '', '16-0066', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(609, '', '16-0067', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(610, '', '16-0068', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(611, '', '16-0069', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(612, '', '16-0070', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(613, '', '16-0071', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(614, '', '16-0073', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(615, '', '16-0074', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(616, '', '16-0076', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(617, '', '16-0077', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(618, '', '16-0078', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(619, '', '16-0079', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(620, '', '16-0088', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(621, '', '16-0089', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(622, '', '16-0091', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(623, '', '16-0092', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(624, '', '16-0100', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(625, '', '16-0102', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(626, '', '16-0104', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(627, '', '16-0106', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(628, '', '16-0114', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(629, '', '16-0123', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(630, '', '16-0127', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(631, '', '16-0129', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(632, '', '16-0135', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(633, '', '16-0137', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(634, '', '16-0139', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(635, '', '16-0142', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(636, '', '16-0143', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(637, '', '16-0146', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(638, '', '16-0147', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(639, '', '17-0001', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(640, '', '17-0004', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(641, '', '17-0009', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(642, '', '17-0011', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(643, '', '17-0013', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(644, '', '17-0016', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(645, '', '17-0022', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(646, '', '17-0023', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(647, '', '17-0026', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(648, '', '17-0029', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(649, '', '17-0032', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(650, '', '17-0035', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(651, '', '17-0037', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(652, '', '17-0038', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(653, '', '17-0041', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(654, '', '17-0042', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(655, '', '17-0044', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(656, '', '17-0049', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(657, '', '17-0054', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(658, '', '17-0055', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(659, '', '17-0057', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(660, '', '17-0058', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(661, '', '17-0060', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(662, '', '17-0066', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(663, '', '17-0067', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(664, '', '17-0069', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(665, '', '17-0071', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(666, '', '17-0073', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(667, '', '17-0075', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(668, '', '17-0076', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(669, '', '17-0078', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(670, '', '17-0079', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(671, '', '17-0080', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(672, '', '17-0081', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(673, '', '17-0082', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(674, '', '17-0083', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'REGULAR'),
(675, '', '17-0084', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(676, '', '17-0085', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(677, '', '17-0086', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(678, '', '17-0087', '2018-2019', '1st Sem', NULL, '', NULL, '0000-00-00', 'IRREGULAR'),
(679, '', NULL, NULL, NULL, NULL, '', NULL, '0000-00-00', NULL),
(680, '', '18-1001', '2018-2019', NULL, 'III', 'BSCS', NULL, '0000-00-00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(11) NOT NULL,
  `fee_code` varchar(15) NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(5,2) NOT NULL,
  `school_year` varchar(9) NOT NULL,
  `sem` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE `picture` (
  `id` int(11) NOT NULL,
  `user_id` varchar(8) NOT NULL,
  `type` varchar(30) NOT NULL,
  `title` varchar(50) NOT NULL,
  `dir` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`id`, `user_id`, `type`, `title`, `dir`) VALUES
(1, '18-0001', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_code` varchar(15) NOT NULL,
  `room_capacity` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `section_code` varchar(8) NOT NULL,
  `section` varchar(25) NOT NULL,
  `course_code` varchar(8) NOT NULL,
  `year_lever` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `studentprofile`
-- (See below for the actual view)
--
CREATE TABLE `studentprofile` (
`student_id` varchar(8)
,`lname` varchar(15)
,`fname` varchar(20)
,`mi` varchar(2)
,`bdate` date
,`gender` varchar(7)
,`contact` varchar(13)
,`email` varchar(50)
,`emergency_person` varchar(50)
,`emergency_contact` varchar(13)
,`reg_date` date
,`course_code` varchar(8)
,`enrollment_date` date
,`school_year` varchar(9)
,`section` varchar(6)
,`sem` varchar(7)
,`status` varchar(9)
,`year_level` varchar(3)
,`type` varchar(30)
,`title` varchar(50)
,`dir` char(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_id` varchar(8) DEFAULT NULL,
  `fname` varchar(20) DEFAULT NULL,
  `lname` varchar(15) DEFAULT NULL,
  `mi` varchar(2) DEFAULT NULL,
  `bdate` date NOT NULL,
  `gender` varchar(7) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(13) NOT NULL,
  `emergency_person` varchar(50) NOT NULL,
  `emergency_contact` varchar(13) NOT NULL,
  `reg_date` date NOT NULL,
  `reg_year` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `fname`, `lname`, `mi`, `bdate`, `gender`, `email`, `contact`, `emergency_person`, `emergency_contact`, `reg_date`, `reg_year`) VALUES
(1, '10-1800', 'REA', 'ORIBIA', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(2, '13-0322', 'BENJAMIN II', 'MALLARI', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(3, '14-0152', 'EXEQUIEL', 'SANTIAGO', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(4, '14-0153', 'ABEGAIL', 'CASIANO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(5, '14-0156', 'ANGELICA', 'MANALANG', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(6, '14-0157', 'ROSE ANN', 'MARIN', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(7, '14-0158', 'ELLAMAE', 'LANSANG', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(8, '14-0159', 'KAREN', 'RAMOS', 'Q.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(9, '14-0163', 'ANIRA MAE', 'MALLARI', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(10, '14-0166', 'DANIELLA ANNE', 'DAVID', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(11, '14-0167', 'CHRISTINE DANE', 'AGUILAR', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(12, '14-0168', 'ELAISA', 'GONZALES', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(13, '14-0169', 'HAIDEE LYN', 'DIZON', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(14, '15-0027', 'MARVIN', 'AQUINO', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(15, '15-0029', 'JEAN', 'SIGUA', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(16, '15-0030', 'ROSSA MONICA', 'TORRES', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(17, '15-0031', 'JOHN MERK', 'SALTA', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(18, '15-0032', 'CHARLENE', 'DAVID', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(19, '15-0033', 'KAY ANN', 'DUNGO', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(20, '15-0039', 'ERICA MAE', 'FRANCISCO', 'V.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(21, '15-0040', 'MARJORIE', 'CABRAL', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(22, '15-0043', 'RICA', 'TALLADA', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(23, '15-0045', 'PRINCESS ANN MARIE', 'DAVID', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(24, '15-0046', 'MARRY LUZ', 'SUSANO', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(25, '15-0047', 'RENZ MARK', 'STO. DOMINGO', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(26, '15-0048', 'ALVIN', 'MANARANG', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(27, '15-0049', 'KAITLIN', 'MICLAT', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(28, '15-0051', 'KIMBERLY', 'MICLAT', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(29, '15-0053', 'JAMIACA', 'PADILLA', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(30, '15-0102', 'ALVIN', 'MAMANGUN', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(31, '17-0059', 'CHINI', 'AMURAO', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(32, '17-0061', 'TERRENCE JAN', 'DELA CRUZ', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(33, '17-0062', 'CAMILLIE', 'ESCOTO', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(34, '17-0063', 'DHALIA', 'SISON', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(35, '17-0064', 'NIKKO', 'TALLADA', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(36, '17-0065', 'IZZA MAE', 'VERGARA', 'Y.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(37, '16-0109', 'QUIMVERLY', 'LOBO', 'Z.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(38, '16-0112', 'RACHMAH', 'MUSTAPHA', 'I.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(39, '13-0304', 'JOAN', 'SOLANGON', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(40, '14-0228', 'NANCY', 'BAGSIC', 'O.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(41, '10-1759', 'LUCKY', 'ALIMURUNG', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(42, '12-0026', 'CARISSA', 'CAGUIAT', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(43, '13-0010', 'HANNAH JEAN', 'DE GUZMAN', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(44, '13-0015', 'PHOEBE', 'PEREZ', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(45, '13-0026', 'MARIANE', 'LUMANLAN', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(46, '13-0110', 'JEASELLE', 'BONDOC', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(47, '13-0255', 'JAMAICA', 'SORIANO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(48, '13-0280', 'CHINNEE RAE', 'STO. DOMINGO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(49, '13-0312', 'BLAISY ANN', 'GULLE', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(50, '14-0196', 'ERNIE MICHAEL', 'MANALOTO', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(51, '14-0201', 'NICOLE', 'CUNANAN', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(52, '14-0205', 'CHRISTINE', 'PINEDA', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(53, '14-0206', 'JANELA', 'CUTCHON', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(54, '14-0208', 'ALOHA', 'PUNZALAN', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(55, '14-0210', 'SHEILA', 'TAYAG', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(56, '14-0211', 'KATRINA', 'TOLENTINO', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(57, '14-0212', 'MYLENE', 'ANUNCIACION', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(58, '14-0213', 'JET CARL', 'GULLE', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(59, '14-0215', 'TIFFANY', 'DE VOTA', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(60, '14-0216', 'PRINCESS CLEOFE', 'SUPAN', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(61, '14-0217', 'RHEALENE', 'LINDO', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(62, '14-0219', 'CRISTINA', 'QUIAMBAO', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(63, '14-0220', 'JESSICA', 'PUNZALAN', 'Y.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(64, '14-0221', 'NICHOLE ANNE', 'FIGUEROA', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(65, '14-0222', 'SHIERLYN', 'DOMINGO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(66, '14-0224', 'JENNY', 'BAGSIC', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(67, '14-0226', 'LEA', 'MELCHOR', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(68, '14-0227', 'CHRISTIAN JEROME', 'CAPULONG', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(69, '14-0229', 'RACQUEL', 'FLORES', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(70, '14-0230', 'STEFHANIE', 'ARCEO', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(71, '14-0231', 'PRINCES SARAH', 'MADERAS', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(72, '14-0233', 'ROXANNE', 'SAN AGUSTIN', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(73, '14-0234', 'ROSELLE', 'ORTILIO', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(74, '14-0235', 'CHRISTOPHER', 'DE GUZMAN', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(75, '14-0239', 'JIMUEL CARLO', 'CRUZ', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(76, '14-0243', 'JUSTINE KAYE', 'ANGELES', 'N.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(77, '14-0244', 'ROCHELLE', 'MAGDALENO', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(78, '14-0246', 'PATRICIA ANN', 'BALUYOT', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(79, '14-0249', 'JAYA', 'DAYRIT', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(80, '14-0251', 'JOHN MICHAEL', 'DE GUZMAN', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(81, '14-0253', 'DENISE JOY', 'PABLO', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(82, '14-0256', 'KATELYN', 'DEL PILAR', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(83, '14-0257', 'JESTONI', 'ANUSENCION', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(84, '14-0259', 'NANCY', 'BASCO', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(85, '14-0262', 'RONEL', 'CASTRO', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(86, '14-0264', 'JAIME ROSE', 'CASTRO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(87, '14-0265', 'JOHN MORRIS', 'CASTRO', 'O.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(88, '14-0267', 'JEZELIE', 'GARCIA', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(89, '14-0269', 'AMAPOLA JANA', 'MALONZO', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(90, '14-0272', 'GHENT BRUVELLS', 'NAVARRO', 'F.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(91, '14-0276', 'MELITA', 'CARLOS', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(92, '14-0277', 'DANICA', 'ROQUE', 'Y.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(93, '14-0278', 'RICA', 'MAGSILANG', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(94, '14-0279', 'BEVERLY', 'LAXAMANA', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(95, '14-0280', 'APRIL JEAN', 'ANUSENCION', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(96, '14-0281', 'JOLINA', 'CASTRO', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(97, '14-0282', 'JOHN LAWRENZ', 'BOGNOT', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(98, '14-0284', 'ABIGAIL', 'DELA CRUZ', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(99, '14-0285', 'MAICAH', 'MEJIA', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(100, '14-0286', 'ANGELITA', 'PABLO', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(101, '14-0287', 'HAZEN JOHN', 'ENRIQUEZ', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(102, '14-0289', 'GLAYDEL', 'LUMBANG', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(103, '14-0290', 'CLARISE JOYCE', 'LANSANGAN', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(104, '14-0328', 'LIMUEL', 'TIGLAO', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(105, '14-0359', 'FATIMAH', 'CANLAS', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(106, '14-0396', 'JAMELLA IVANA', 'VILLAPA?A', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(107, '14-0411', 'LAILANI', 'TANGLAO', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(108, '14-0422', 'ANGELICA LYKA', 'MATAGA', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(109, '14-0427', 'SHAIRA', 'FLORES', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(110, '14-0435', 'CHRISTINE ANN', 'SANTIAGO', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(111, '15-0293', 'ROCHE MAE', 'CABILDO', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(112, '17-0006', 'MUTYA', 'RONTALE', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(113, '17-0007', 'JHENELLE', 'REYES', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(114, '17-0008', 'RIA ANDREA', 'RAMOS', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(115, '17-0010', 'OCE?A', 'CHINETH SHYLA', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(116, '17-0019', 'ERICK JHON', 'MALIWAT', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(117, '17-0020', 'MAGSILANG', 'STEUART MIGUEL', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(118, '17-0024', 'MARGARITA', 'ICBAN', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(119, '17-0034', 'KATHLEEN', 'AVILA', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(120, '15-0419', 'ELLA MAE', 'MESINA', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(121, '16-0007', 'MA. BERNADETTE', 'ROSALES', 'H.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(122, '16-0013', 'MA. PATRICIA', 'MATAGA', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(123, '16-0014', 'KATE', 'ALFONSO', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(124, '16-0018', 'MARIA THERESA', 'TAYAG', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(125, '16-0019', 'JACKILYN', 'MANALILI', 'O.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(126, '16-0027', 'ROCHELLA', 'SALAC', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(127, '16-0029', 'CATHERINE', 'GOMESERIA', 'E.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(128, '16-0032', 'RAFFY', 'TOLENTINO', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(129, '17-0039', 'MANALO', 'ANA MARGARITA', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(130, '14-0275', 'CZARINA', 'BAYSA', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(131, '15-0238', 'NOEMI', 'RIVERA', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(132, '15-0240', 'RUFFA', 'HIPOLITO', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(133, '15-0242', 'AILEEN', 'NAVARRO', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(134, '15-0249', 'JESSALYN', 'ESTRADA', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(135, '15-0253', 'RAQUEL', 'RODRIGUEZ', 'E.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(136, '15-0257', 'BEVERLY', 'GUINTO', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(137, '15-0268', 'JACKIE ROSE', 'TOLENTINO', 'N.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(138, '15-0272', 'LYKA JANE', 'ESPIRITU', 'N.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(139, '15-0274', 'LAYKA', 'MALIG', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(140, '15-0278', 'ALAINE', 'YSAIS', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(141, '15-0288', 'CARISSA', 'HIPOLITO', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(142, '15-0290', 'ROSEL MARIE', 'DE LEON', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(143, '15-0297', 'PRINCESS CAMILLE', 'HIPOLITO', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(144, '15-0298', 'BERNADETTE JOY', 'PINEDA', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(145, '15-0299', 'JANE', 'MERCADO', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(146, '15-0306', 'ANGELA ROSE', 'INTAL', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(147, '15-0323', 'LUISA CAMILLE', 'TRINIDAD', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(148, '15-0324', 'CLAUDETTE', 'MEJIA', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(149, '15-0325', 'VIA', 'MELCHOR', 'V.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(150, '15-0326', 'ANGELICA', 'JULAO', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(151, '15-0327', 'ANGELINE', 'BALATBAT', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(152, '15-0336', 'MIKEE', 'VILLANUEVA', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(153, '15-0340', 'DESERIE', 'CASTRO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(154, '15-0341', 'KRISTAL', 'AGUILAR', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(155, '15-0344', 'CAMILLE', 'DIZON', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(156, '15-0348', 'JANE', 'SALAS', 'F.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(157, '15-0349', 'MA. CORAZON', 'LENON', 'Y.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(158, '15-0360', 'JENNIFER', 'TIGLAO', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(159, '15-0361', 'PAULINE', 'GARCIA', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(160, '15-0364', 'JAYVEE', 'MIRANDA', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(161, '15-0368', 'NONA', 'SISON', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(162, '15-0391', 'HEIDI', 'ESPIRITU', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(163, '15-0395', 'JEISSEL', 'VILLAPA?A', 'Y.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(164, '15-0396', 'JUDE', 'CORTEZ', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(165, '15-0407', 'RHODA MARIELITA', 'RIVERA', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(166, '15-0449', 'NATHANIEL', 'CANASA', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(167, '14-0274', 'MIKEE', 'FELICIANO', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(168, '15-0226', 'SHARON', 'ENIPIN', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(169, '15-0228', 'JAYDEE ROAN', 'PILI', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(170, '15-0370', 'ALYSSA LAE', 'FELICIANO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(171, '15-0377', 'DOROTHY MARI', 'MERCADO', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(172, '15-0380', 'CLEIN JOCEL', 'PANGILINAN', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(173, '98-0432', 'MARY ANNE', 'TIMBOL', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(174, '15-0254', 'MADILYN', 'LUMANLAN', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(175, '15-0259', 'JERALINE', 'PASCUAL', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(176, '15-0262', 'KAREN', 'ANTONIO', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(177, '15-0279', 'MIA ZARAH', 'ATIENZA', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(178, '15-0305', 'SOPHIA', 'STO. DOMINGO', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(179, '15-0311', 'MARIA PAMELA', 'MANALANG', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(180, '15-0335', 'LOVELY ROSE', 'LAYUG', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(181, '15-0345', 'RAFAEL', 'PINEDA', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(182, '15-0384', 'JESS MARIE', 'TAPNIO', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(183, '13-0089', 'ERIC JOHN', 'SISON', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(184, '13-0218', 'HAROLD', 'SANTOS', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(185, '14-0004', 'JERRY BOY', 'DIMLA JR.', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(186, '14-0009', 'MICHAEL JOHN', 'CORTEZ', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(187, '14-0012', 'REIMON', 'TAJA', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(188, '14-0020', 'JOSEPH', 'SINIO', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(189, '14-0023', 'ROMULO JOHN', 'CASTRO', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(190, '14-0036', 'ROLDEAN AIMEE', 'GOMEZ', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(191, '14-0043', 'ARIEL', 'GACILOS', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(192, '14-0049', 'MARK LEAN', 'SOY', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(193, '14-0052', 'JEMILLE', 'RIVERA', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(194, '14-0055', 'NICHOLAS', 'DIOMERES', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(195, '14-0057', 'JOHN ALLEN', 'MALLARI', 'F.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(196, '14-0058', 'NICHOL', 'CAISIP', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(197, '14-0061', 'ERWIN', 'PEREZ', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(198, '14-0062', 'GIAN CARLO', 'CAO', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(199, '14-0067', 'LIMUEL', 'MERCADO', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(200, '14-0068', 'LEE ROBBIE', 'DIZON', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(201, '14-0069', 'JOE DHEN', 'BATILARAN', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(202, '14-0075', 'CHRISTINE MHAE', 'LOPEZ', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(203, '14-0077', 'JOHN CARLO', 'PELAYO', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(204, '14-0078', 'LYRA', 'ALIMURUNG', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(205, '14-0082', 'MAR JAY', 'SUAREZ', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(206, '14-0097', 'JOCELYN', 'MANZANO', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(207, '14-0107', 'ENRICO', 'BALOT', 'E.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(208, '14-0419', 'CLARA', 'MAGCALAS', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(209, '15-0101', 'MARY JANE', 'ANICETE', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(210, '15-0107', 'ROY', 'VITUG', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(211, '15-0110', 'RONALYN', 'MEJIA', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(212, '15-0112', 'CLARA JEAN', 'VACARO', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(213, '15-0114', 'BRYLLE LUIZ', 'PINEDA', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(214, '15-0115', 'JEFF RICHARD', 'SAMSON', 'Q.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(215, '15-0117', 'AJ', 'GUMAMIT', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(216, '15-0118', 'CHRISTIAN JARED', 'HIPOLITO', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(217, '15-0120', 'MARK VALENTIN', 'LOPEZ', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(218, '15-0126', 'RON RON', 'VILLANUEVA', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(219, '15-0128', 'SHERWIN RHOD', 'QUIRAT', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(220, '15-0130', 'JUNE', 'MANALO', 'N.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(221, '15-0131', 'SHAIRA', 'GUECO', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(222, '15-0132', 'BABY ANNE', 'TAYAG', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(223, '15-0134', 'MARLON', 'TOLENTINO', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(224, '15-0135', 'JENESIS', 'SISON', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(225, '15-0138', 'MA. ELAINE', 'SISON', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(226, '15-0142', 'CHARLS IVAN', 'ROMERO', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(227, '15-0146', 'HAROLD', 'TIZON', 'L', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(228, '15-0147', 'BRANDO', 'DE TORRES', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(229, '15-0155', 'JOHN  MICRO', 'PEREZ', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(230, '15-0159', 'JESSA', 'GUTIERREZ', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(231, '15-0161', 'ZAIREI CHRISTIAN', 'MADAYAG', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(232, '15-0162', 'PATRICK', 'GONZALES', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(233, '15-0163', 'WINSTON', 'DIZON', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(234, '15-0164', 'CARL LOUIE', 'ARCEO', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(235, '15-0166', 'NEIL GIO', 'DAYRIT', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(236, '15-0167', 'WILJOHN', 'SORIANO', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(237, '15-0170', 'DERNNEL PERRY', 'LAYUG', 'N.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(238, '15-0171', 'OLAIJUWOON', 'GOMEZ', 'H.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(239, '15-0174', 'JEODELL BRYAN', 'TAYAG', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(240, '15-0185', 'IVAN CLEIFORD', 'ANUSENCION', '', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(241, '15-0187', 'ALDWIN', 'MANGAHAS', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(242, '15-0189', 'KING ANGELO', 'CAO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(243, '15-0197', 'BRIXTER', 'JOSE', 'J.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(244, '15-0199', 'LINCOLN', 'DALUSONG', 'Q.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(245, '15-0202', 'CHRISTIAN', 'MANGUNE', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(246, '17-0046', 'MAESON', 'HERNANDEZ', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(247, '17-0047', 'CARL PATRICK', 'LENON', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(248, '17-0048', 'KENNETH', 'NARCISO', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(249, '17-0050', 'KATRINA ANN', 'RIVERA', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(250, '17-0051', 'JOHN HARSLY', 'RODRIGUEZ', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(251, '17-0052', 'JESUS', 'SANTOS', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(252, '15-0435', 'KEVIN NIKKO', 'DELA CRUZ', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(253, '16-0083', 'ALDEN', 'BALILO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(254, '16-0084', 'RONIE', 'PANGAN', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(255, '16-0085', 'JERICK', 'CAPARAS', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(256, '16-0094', 'RODREN', 'SALAZAR', 'E.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(257, '16-0095', 'ALLEN JAI', 'VALERIO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(258, '16-0099', 'JOHN PAUL', 'PUNO', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(259, '16-0103', 'MERICK PAUL', 'JIMENEZ', 'F.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(260, '16-0107', 'JESSIE', 'CHAN JR.', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(261, '16-0128', 'CHARLENE KAYE', 'SUMAWANG', 'I.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(262, '15-0212', 'JONELLE', 'SALAZAR', 'V.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(263, '15-0213', 'ROLLY', 'PONTANILLA JR', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(264, '15-0214', 'JOHN CARLO', 'CALARA', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(265, '15-0215', 'JOHNER', 'OMLANG', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(266, '15-0222', 'JOSHUA', 'SAMANIEGO', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(267, '15-0251', 'JAIRUS', 'SORIANO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(268, '15-0410', 'JOHN CARLO', 'REYES', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(269, '17-0040', 'JOMER JUSTINE', 'RIGOR', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(270, '15-0392', 'ALEX JR.', 'CANLAS', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(271, '15-0431', 'JAYVEE', 'DELA CRUZ', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(272, '15-0443', 'KEANU JACK', 'LACSAMANA', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(273, '13-0122', 'JOBELLE', 'LAXAMANA', 'E.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(274, '14-0127', 'PRINCES JOAN', 'CARI?O', 'H.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(275, '14-0133', 'APPLE JOY', 'SALTA', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(276, '14-0145', 'MARVIN', 'SANTOS', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(277, '14-0207', 'PRINCESS DIANE', 'MANALILI', 'V.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(278, '15-0063', 'WINDEL', 'PERGAMINO', 'E.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(279, '15-0070', 'RIXI LAUREN', 'FLORES', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(280, '15-0071', 'KRISTIAN GABRIEL', 'BASILLO', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(281, '15-0072', 'JENETH', 'CAGUIAT', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(282, '15-0075', 'MARK ANTHONY', 'GARCIA', 'J.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(283, '15-0088', 'ROMA LYKA', 'PANGILINAN', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(284, '15-0090', 'JAYSON', 'YANGA', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(285, '15-0092', 'RENNIEL', 'NUQUI', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(286, '15-0093', 'RICK JAMES', 'SANTANDER', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(287, '15-0398', 'RAYMOND', 'DOLLISIN', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(288, '16-0054', 'ERWIN', 'TAYAG', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(289, '16-0056', 'LAYCA', 'SANTIAGO', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(290, '15-0433', 'STEVEN', 'BALINGIT', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(291, '13-0248', 'PATRICIA MAE', 'DE VERO', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(292, '14-0240', 'JULIE ANNE', 'BANIEL', '', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(293, '14-0309', 'JOY', 'LACSON', 'I.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(294, '17-0002', 'MICHAEL', 'TIOMICO', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(295, '17-0003', 'MAY', 'TA?A', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(296, '17-0012', 'NAVARRO', 'WENDIE JANE', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(297, '17-0014', 'MARIMLA', 'IAN PHILIP', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(298, '17-0028', 'CHAMPAIGNE', 'DULAY', 'E.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(299, '16-0003', 'JUSTINE APPLE', 'MAGLALANG', 'F.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(300, '16-0011', 'JAMMIEL', 'CALIDO', 'Y.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(301, '16-0012', 'MARNELLIE', 'AGUAS', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(302, '16-0134', 'AMARIE', 'CALMA', 'V.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(303, '15-0233', 'JAE ANNE', 'MIRANDA', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(304, '15-0247', 'MA. THERESA', 'BULATAO', 'V.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(305, '15-0266', 'JENNY', 'ANUSENCION', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(306, '15-0267', 'KRISHA MAY', 'DELA CRUZ', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(307, '15-0270', 'SHEIDEN', 'HIPOLITO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(308, '15-0313', 'KATELYN', 'CABEBE', 'F.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(309, '15-0317', 'ROLAND', 'CASTRO', 'F.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(310, '15-0346', 'DANICA JANE', 'DATUIN', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(311, '15-0359', 'RONA FATIMA', 'RODRIGUEZ', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(312, '15-0374', 'ANGELICA', 'DAVID', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(313, '15-0375', 'JENICA REAN', 'ALIMURUNG', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(314, '15-0399', 'MAY ANN', 'FLORES', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(315, '15-0428', 'AGNES', 'GALANG', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(316, '10-1770', 'APRIL', 'LIWANAG', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(317, '14-0223', 'RANDEL', 'MIRANDA', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(318, '14-0252', 'KIM', 'LLARVES', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(319, '14-0291', 'LOIS JULLIANNE', 'YALUNG', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(320, '14-0293', 'TRIZIA CAMILLE', 'CRUZ', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(321, '14-0297', 'JAROLD', 'VELASCO', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(322, '14-0298', 'KEITH', 'DELA PE?A', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(323, '14-0299', 'CRISTAL JADE', 'VERSOZA', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(324, '14-0301', 'SHERILYN', 'SALVATIERRA', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(325, '14-0302', 'ANGELEE', 'DE GUZMAN', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(326, '14-0303', 'MARY GRACE', 'NUCUM', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(327, '14-0305', 'LEAH LAINE', 'ESGUERRA', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(328, '14-0306', 'DEZELE', 'CUNAN', 'J.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(329, '14-0368', 'MARJORIE', 'PAULO', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(330, '15-0422', 'JEFFREYSON', 'CANONO', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(331, '13-0266', 'ROSEMARIE', 'BALUYUT', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(332, '14-0200', 'JOVEL', 'CAINGAT', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(333, '14-0332', 'CYRIL', 'BULACSO', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(334, '17-0017', 'MANARANG', 'AKKIE SHIELA', 'V.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(335, '17-0027', 'FABRINE', 'GARCIA', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(336, '16-0005', 'KEILA JOYCE', 'TIRIA', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(337, '16-0010', 'JOHN KEVIN', 'DAVID', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(338, '16-0016', 'ANA MARIE', 'AGUILAR', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(339, '16-0017', 'JOY', 'TOLENTINO', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(340, '16-0022', 'SHIRLEY', 'MAGCALAS', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(341, '16-0023', 'JOHN PAUL', 'SALAS', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(342, '16-0025', 'JOHN DAVID', 'DELA CRUZ', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(343, '16-0026', 'RAUL', 'PANGILINAN', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(344, '16-0036', 'CHERRY', 'GUEVARRA', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(345, '16-0037', 'JEROME', 'PADILLA', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(346, '15-0273', 'ELLAMAE', 'DELA PE?A', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(347, '15-0302', 'MARIA DONITA', 'SABADO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(348, '15-0310', 'NIKKO ANDREW', 'PEREZ', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(349, '15-0352', 'ALVIN', 'MONERA', 'Q.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(350, '15-0358', 'JAYDHEE', 'AQUINO', 'Q.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(351, '15-0403', 'RAFAEL TRISTAN', 'LIMOS', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(352, '16-0080', 'IRSIH DALE', 'SALAZAR', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(353, '16-0081', 'IRISH', 'TIAMZON', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(354, '11-0048', 'JENNY-ANN', 'CASTRO', 'O.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(355, '13-0084', 'JOHN PAUL', 'ROQUE', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(356, '13-0316', 'MARK DAVID', 'BAGSIC', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(357, '14-0174', 'RENNEL', 'BERDIN', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(358, '14-0175', 'RESTITUTO LOUIE', 'MAGCALAS', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(359, '14-0181', 'CHRISTIAN RJ', 'ACEBUCHE', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(360, '14-0182', 'RAYRELL', 'MU?OZ', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(361, '14-0184', 'JOSHUA ERIN', 'VEGA', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(362, '14-0189', 'CHARLES JOHN', 'VALENZUELA', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(363, '14-0190', 'CLEIDON', 'MEJIA', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(364, '14-0195', 'CATHERINE', 'SALAS', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(365, '14-0430', 'ELLANA MAE', 'DIZON', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(366, '15-0001', 'AGUSTINO', 'AQUINO JR', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(367, '15-0002', 'GRETCHEL AINNAH', 'GALVEZ', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(368, '15-0007', 'JOSEPH NICASO II', 'LUCERO', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(369, '15-0009', 'RONALIN', 'LUCERO', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(370, '15-0010', 'ROEL', 'LEPARDO', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(371, '15-0013', 'MARY', 'PABLO', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(372, '15-0015', 'LAURENCE', 'PABALAN', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(373, '15-0016', 'ROVEN KARLOS', 'BALDIVIA', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(374, '15-0020', 'ANGELICA', 'ESGUERRA', 'E.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(375, '15-0022', 'KENNETH', 'BITOON', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(376, '15-0437', 'ALJAMIE', 'MALONZO', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(377, '16-0059', 'PAUL MERTLICH', 'BUAN', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(378, '16-0065', 'RIZALINE', 'NICOLAS', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(379, '16-0122', 'HANA NIAH', 'SANTOS', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(380, '15-0453', 'RALPH JOHN PAUL', 'BALILO', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(381, '13-0112', 'AIKO', 'QUIAMBAO', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(382, '17-0005', 'SABAT', 'ROWPEN JOBERT', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(383, '17-0015', 'MARIMLA', 'ALLEN PAULO', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(384, '17-0030', 'JOHN MICHAEL', 'DAVID', 'E.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(385, '17-0033', 'LUCIA ANN', 'BAGSIC', 'I.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(386, '17-0056', 'JUBILEE PRAISEL', 'LUNDANG', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(387, '16-0006', 'JEROME', 'NUGUID', 'H.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(388, '16-0033', 'ALLAN JAY', 'MANALO', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(389, '16-0034', 'MARIEL', 'NACIS', 'E.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(390, '16-0035', 'JHANZEN', 'ROMERO', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(391, '15-0244', 'GIRLIE', 'SANTOS', 'Y.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(392, '15-0246', 'ROSELYN', 'TIMBOL', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(393, '15-0287', 'JUNILA', 'CASTRO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(394, '15-0292', 'JAMIE', 'CARLOS', 'E.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(395, '15-0316', 'KATHLINE', 'PUNO', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(396, '15-0318', 'RICKY RENZ', 'CUNANAN', '', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(397, '15-0328', 'JHENCEL', 'AGUSTIN', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(398, '15-0362', 'EUGENE', 'DAVID', 'T', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(399, '15-0383', 'RONALD ROY', 'PUNZALAN', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(400, '15-0456', 'MHARRIZ ANN CLARETTE', 'FERRER', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(401, '15-0442', 'ANTONETTE ROXAINNE', 'YAMBOT', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(402, '09-1655', 'KATHLEEN ANN', 'ANTONIO', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(403, '14-0296', 'DANICA', 'STO. DOMINGO', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(404, '14-0300', 'JHUSTIN', 'AGUSTIN', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(405, '14-0313', 'ALLEN', 'ADRIANO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(406, '14-0314', 'MARIA CRISTINA', 'DIZON', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(407, '14-0315', 'CAROLINA', 'GIMENO', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(408, '14-0316', 'EHLA', 'PINGOL', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(409, '14-0317', 'HAZEL', 'GUEVARRA', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(410, '14-0319', 'ANJANETTE', 'YUMUL', 'Q.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(411, '14-0320', 'MICHAEL ANGELO', 'CASTRO', 'O.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(412, '14-0322', 'MOISES', 'NAVARRO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(413, '14-0329', 'MARITES', 'PAYUMO', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(414, '14-0337', 'MA. LUISA', 'GENUINO', 'Q.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(415, '14-0338', 'TIMOTHY', 'FELICIANO', 'N.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(416, '14-0361', 'LYKA', 'MAGCALAS', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(417, '14-0365', 'CHERRY LEVY', 'GOMEZ', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(418, '17-0018', 'MANALUNGSUNG', 'SHAIRA', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(419, '17-0025', 'JOVENIEL', 'GARCIA', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(420, '16-0004', 'PAMELA GEYRIL', 'PINEDA', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(421, '16-0031', 'NAEL', 'BONDOC', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(422, '15-0236', 'CHEYZEL', 'BALAOING', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(423, '15-0241', 'BRYAN', 'SALAS', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(424, '15-0294', 'PRECIOUS KATE', 'SABALA', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(425, '15-0351', 'DANILA MAY', 'MARIANO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(426, '15-0356', 'ERICA', 'RAMOS', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(427, '15-0373', 'DYESABEL', 'SANTOS', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(428, '14-0324', 'ROCHELLE', 'DAVID', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(429, '14-0325', 'ANDREA MARIE', 'NICOLAS', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(430, '14-0326', 'RENALYN', 'ADRIANO', 'V.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(431, '14-0330', 'LYKA', 'DELA FUENTE', 'O.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(432, '13-0309', 'LHAISY AMIRA', 'CLEOFAS', 'F.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(433, '13-0310', 'LEE ALVIN', 'VILLARONTE', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(434, '14-0266', 'JAYVEE', 'ZARATE', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(435, '14-0339', 'ROCHEL', 'DIZON', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(436, '14-0364', 'LIEZEL MAE', 'DAYRIT', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(437, '15-0234', 'RUFFA ROSE', 'ATRIS', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(438, '15-0264', 'PRINCESS ANGELI', 'ZARA', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(439, '15-0281', 'AARON KRISTIAN', 'BANAG', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(440, '15-0314', 'NICOLE', 'DE JESUS', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(441, '15-0330', 'PRINCE CARLO', 'VALERIO', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(442, '14-0336', 'MARIELA', 'CRUZ', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(443, '05-1319', 'CARMI', 'DAYRIT', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(444, '10-1702', 'CHRYSTAL JADE', 'LANSANGAN', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(445, '10-1706', 'LIRON JEI', 'MANGALINDAN', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(446, '10-1715', 'MYRELL', 'BUNIAG', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(447, '11-0126', 'ZOREN', 'DUNGCA', 'I.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(448, '11-0162', 'DARWIN MARK', 'GOMEZ', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(449, '12-0058', 'KLARENZ', 'HIPOLITO', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(450, '12-0156', 'ANGELO', 'POLINTAN', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(451, '12-0225', 'HERLYN', 'ROMERO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(452, '12-0238', 'JONEL', 'PINEDA', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(453, '13-0017', 'LOVELY MAE', 'GAMOTEA', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(454, '13-0048', 'RAMGINE', 'SANCHEZ', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(455, '13-0051', 'NICO', 'PINEDA', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(456, '13-0060', 'ANTHONY', 'DUNGCA', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(457, '13-0076', 'RENMAR', 'BALINGIT', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(458, '13-0079', 'ALLEN', 'MEGALLON', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(459, '13-0082', 'RONEL', 'ANGELES', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(460, '13-0086', 'ALEXANDER', 'BULATAO', 'V.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(461, '13-0117', 'MAY ANN', 'SALON', 'V.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(462, '13-0219', 'BRYAN LEE', 'MUTIA', 'I.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(463, '13-0220', 'CHARMZEL', 'PANGANIBAN', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(464, '13-0222', 'ROMER', 'GUEVARRA', ',M', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(465, '13-0237', 'RONEL JOHN', 'DAVID', 'K.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(466, '13-0288', 'DERICK', 'MANALANG', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(467, '13-0323', 'PRECIOUS', 'TARAPE', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(468, '14-0005', 'JOHN NICO', 'ESPIRITU', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(469, '14-0015', 'KEVIN CHRYSLER', 'EMATA', 'F.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(470, '14-0019', 'AEJAY', 'GONZALES', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(471, '14-0024', 'IAN JONATHAN', 'ARCEO', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(472, '14-0032', 'JERSON', 'PINGOL', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(473, '14-0033', 'MARK ANTHONY', 'FIGUEROA', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(474, '14-0039', 'TRISTAN', 'LIWANAG', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(475, '14-0041', 'DAREAL', 'RAMOS', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(476, '14-0044', 'JEREMY', 'BALAIS', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(477, '14-0046', 'ADRIAN', 'CASTRO', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(478, '14-0047', 'GENESIS', 'CABILANGAN', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(479, '14-0056', 'MIRIAM MAE', 'VEGA', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(480, '14-0060', 'JOHN ONEAL', 'CONSTANTINO', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(481, '14-0063', 'MARLON', 'FEBRES', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(482, '14-0064', 'EDCEL', 'HIPOLITO', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(483, '14-0065', 'JAIRO', 'FIGUEROA', 'I.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(484, '14-0076', 'CHRISTIAN', 'VILLARONTE', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(485, '14-0079', 'MARK ANTHONY', 'PELAYO', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(486, '14-0083', 'LAWRENCE', 'ARGUELLES', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(487, '14-0090', 'JOHN MICHAEL', 'ALUNAN', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(488, '14-0092', 'JASON', 'YTURRALDE', 'E.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(489, '14-0096', 'JONEL', 'SUAREZ', 'F.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(490, '14-0101', 'JOHN ROBIE', 'BONDOC', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(491, '14-0103', 'NOEL', 'MANIO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(492, '14-0104', 'GERALD', 'GA?A', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(493, '14-0106', 'KEVIN', 'SALAS', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(494, '14-0155', 'GERALD', 'BALUYUT', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(495, '14-0170', 'ARJAY', 'ROMERO', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(496, '14-0194', 'CLARKTON', 'MALLARI', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(497, '14-0198', 'KIMBERLY MAE', 'BUAN', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(498, '14-0214', 'ELIZABETH', 'GARCIA', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(499, '14-0260', 'MA.  LAVINIA', 'CAYETANO', 'F.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(500, '14-0273', 'DANNIELIE', 'FUERTE', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(501, '14-0331', 'RIZA', 'SANGALANG', 'Y.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(502, '14-0343', 'IRONE MARTELL', 'CANDOL', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(503, '14-0344', 'JOEMARIE', 'FERNANDEZ', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(504, '14-0366', 'JESSICA', 'MAGAT', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(505, '14-0391', 'JESSIE', 'GARCIA', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(506, '14-0392', 'CHRISTOPHER', 'MARIN', 'F.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(507, '14-0398', 'ALVIN', 'GOPEZ', 'V.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(508, '14-0401', 'JUSTIN ALET DIE', 'SIMBILLO', 'M', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(509, '14-0416', 'MA. ANGELICA', 'VILLAR', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(510, '14-0420', 'CYNDIRELLE', 'DIZON', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(511, '14-0421', 'GERALD', 'BAUTISTA', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(512, '14-0424', 'JUNE', 'FERRER', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(513, '14-0428', 'CHRISTIAN BRYAN', 'CONCEPCION', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(514, '14-0437', 'GRANT OWELL', 'PARAS', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', '');
INSERT INTO `students` (`id`, `student_id`, `fname`, `lname`, `mi`, `bdate`, `gender`, `email`, `contact`, `emergency_person`, `emergency_contact`, `reg_date`, `reg_year`) VALUES
(515, '14-0439', 'KENNETH', 'CAPIT', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(516, '15-0006', 'FELICE AURORA MARIA', 'CORPUZ', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(517, '15-0023', 'JESMILANE', 'CORTEZ', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(518, '15-0035', 'KIM ELAISA', 'QUIAMBAO', 'F.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(519, '15-0041', 'JOHN MATTHEW', 'LACANDULA', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(520, '15-0055', 'REXTER PAOLO', 'TUAZON', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(521, '15-0065', 'ROBIN', 'LINDO', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(522, '15-0104', 'JONATHAN', 'TIOMICO', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(523, '15-0105', 'BOB ALAN', 'FELICIANO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(524, '15-0111', 'JASHUA', 'SUAREZ', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(525, '15-0113', 'JAMMELO', 'DEJOS', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(526, '15-0116', 'EDISON', 'SOTTO', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(527, '15-0121', 'ALDRIN', 'BALATBAT', 'I.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(528, '15-0122', 'RANCHEL PAUL', 'AMIO', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(529, '15-0123', 'JAYPEE', 'SIMEON', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(530, '15-0124', 'AMIEL', 'MEJIA', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(531, '15-0125', 'ALDRIN', 'BONDOC', 'JV', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(532, '15-0127', 'JEREMY', 'MANALO', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(533, '15-0129', 'MICO', 'MIRANDA', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(534, '15-0137', 'ALVIN', 'PATIO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(535, '15-0139', 'ENRICO PAUL', 'MANESE', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(536, '15-0144', 'CZARINA', 'GUZMAN', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(537, '15-0151', 'RODEL', 'MANALASTAS', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(538, '15-0153', 'MICHAEL', 'GALVEZ', 'N.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(539, '15-0154', 'EMIL JUN', 'FABAY', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(540, '15-0158', 'BENHUR', 'GALANG', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(541, '15-0173', 'JORE-ANN', 'DAVID', 'E.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(542, '15-0175', 'DON MCLEAN', 'LACSON', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(543, '15-0177', 'JOHN PAULO', 'YANDAN', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(544, '15-0178', 'JAMIL', 'FLORES', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(545, '15-0182', 'RONNIE', 'BALOT', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(546, '15-0183', 'JAKE CHRISTIAN', 'GARCIA', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(547, '15-0188', 'DANALYN JOY', 'DALUSONG', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(548, '15-0190', 'ROMEL', 'PARAS', 'H.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(549, '15-0193', 'LEIMER', 'HIPOLITO', 'O.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(550, '15-0195', 'JOMAR', 'PANGILINAN', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(551, '15-0196', 'BRYAN MARK', 'HIPOLITO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(552, '15-0205', 'KENNET', 'DELOS REYES', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(553, '15-0206', 'BRYAN JOSEPH', 'CRUZ', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(554, '15-0207', 'LORENZO', 'DUE?AS', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(555, '15-0208', 'HECTOR', 'SAMPANG', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(556, '15-0210', 'RAYMOND', 'CARREON', 'V.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(557, '15-0220', 'AARON', 'PANGILINAN', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(558, '15-0223', 'JESLI', 'ESTRADA', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(559, '15-0229', 'MARJORIE', 'LONGEY', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(560, '15-0230', 'SHAIRA', 'CAGUIAT', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(561, '15-0231', 'ELLAIN GAIL', 'MALIG', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(562, '15-0232', 'NICOLE', 'AMURAO', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(563, '15-0239', 'SHEENA ANN', 'DELA CRUZ', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(564, '15-0255', 'JAMAICA', 'PINEDA', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(565, '15-0256', 'ERIKA', 'CAYANAN', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(566, '15-0260', 'ANNA CATHRINE', 'MANALOTO', 'E.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(567, '15-0275', 'JAY-AR', 'QUERIDO', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(568, '15-0280', 'CHARISSE MAE', 'ORIEL', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(569, '15-0282', 'MARINELLA', 'NAGUIT', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(570, '15-0283', 'LADY LEE', 'VERGARA', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(571, '15-0284', 'KRYSTAL JULIEANE', 'EDEJER', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(572, '15-0296', 'MICHAEL', 'GABRIEL', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(573, '15-0320', 'RENZY DIANE', 'FLORES', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(574, '15-0334', 'LEDNIF', 'ALIMURUNG', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(575, '15-0337', 'LYRA', 'VELASCO', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(576, '15-0338', 'KIM', 'PASCUAL', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(577, '15-0343', 'LIANNE', 'CUNANAN', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(578, '15-0365', 'MARIA JAMAICA', 'SANTIANES', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(579, '15-0367', 'KIMBERLY', 'TULIO', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(580, '15-0376', 'PRINCESS LORRAINE', 'RIGOR', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(581, '15-0387', 'CASTRO', 'KEVIN CU', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(582, '15-0388', 'WARLIE', 'MANGILA', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(583, '15-0390', 'CZARINA DIANNE', 'SANCHEZ', 'Y.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(584, '15-0393', 'ALYSSA MAE', 'ALVAREZ', 'H.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(585, '15-0405', 'KIMBERLY ANN', 'MU?OZ', 'V.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(586, '15-0408', 'JEREMIAH', 'BONDOC', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(587, '15-0420', 'ANALYN', 'MANALO', 'F.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(588, '15-0421', 'CHARLENE', 'BELLO', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(589, '15-0426', 'ERICA', 'LAZARO', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(590, '15-0429', 'JEANEL', 'ALIMURUNG', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(591, '15-0430', 'ROBERT', 'RAZON', 'N.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(592, '15-0432', 'KIMBERLY', 'DELA CRUZ', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(593, '15-0440', 'VANGY', 'BONDOC', 'E.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(594, '15-0444', 'JEFFERSON', 'LIWANAG', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(595, '15-0445', 'EJ ANGELO', 'MACAPINLAC', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(596, '15-0450', 'ALFREDO', 'BAUTISTA', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(597, '15-0452', 'JERICO', 'LIWANAG', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(598, '16-0001', 'ELLAINE', 'FELICIANO', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(599, '16-0002', 'IRENEO', 'ICBAN JR.', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(600, '16-0020', 'KATRINA', 'DE LEON', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(601, '16-0046', 'STEPHANIE', 'GUEVARRA', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(602, '16-0050', 'TRISHA EUNICE', 'MESA', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(603, '16-0051', 'KAMILLE', 'PASCUAL', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(604, '16-0052', 'C.J', 'MARIN', 'V.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(605, '16-0053', 'ANA SHANE', 'DELA CRUZ', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(606, '16-0060', 'SANDY', 'CORTEZ', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(607, '16-0061', 'HAZEL JOY', 'BONDOC', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(608, '16-0066', 'MIA', 'SAN MIGUEL', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(609, '16-0067', 'JOHN DARYL', 'MUSNI', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(610, '16-0068', 'REA LYN', 'TINIO', 'E.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(611, '16-0069', 'JAYDEE', 'VIRAY', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(612, '16-0070', 'ELLAH CHARLOTTE', 'ATIENZA', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(613, '16-0071', 'RENZ', 'ARPON', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(614, '16-0073', 'MA. THERESA', 'DOMINGUEZ', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(615, '16-0074', 'DANNELA ROSE', 'DULA', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(616, '16-0076', 'ELIAS JR.', 'LACSAMANA', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(617, '16-0077', 'GAMALIEL', 'DELA CRUZ', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(618, '16-0078', 'CLARIZZA MAE', 'FELICIANO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(619, '16-0079', 'ROSE ANN', 'GARCIA', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(620, '16-0088', 'HAZEL', 'PI?ON', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(621, '16-0089', 'GABRIEL', 'AVENA', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(622, '16-0091', 'ARVIN JAY', 'MAGCALAS', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(623, '16-0092', 'JOHN PAUL', 'DAVID', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(624, '16-0100', 'GINNA', 'VALENZUELA', 'G.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(625, '16-0102', 'DHEE JHAE', 'MENDEZ', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(626, '16-0104', 'ROYET', 'PINEDA', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(627, '16-0106', 'ELDE MARK', 'MAYOLA', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(628, '16-0114', 'JEREMY KHEN', 'BRIONES', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(629, '16-0123', 'SHERLYN', 'PINEDA', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(630, '16-0127', 'MAE CHELLE', 'LEONG-ON', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(631, '16-0129', 'JULIUS JADE', 'LOPEZ', 'N.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(632, '16-0135', 'DONNA', 'DE GUZMAN', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(633, '16-0137', 'AARON', 'CAPUNO', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(634, '16-0139', 'MARISSE', 'SISON', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(635, '16-0142', 'DAN WILSON', 'DAVID', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(636, '16-0143', 'KAREN JOY', 'MATIC', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(637, '16-0146', 'ANNABELLE', 'BALBIDO', 'N.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(638, '16-0147', 'NINIEMEI NIDIANE', 'RAFON', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(639, '17-0001', 'TYRONE MATTHEW', 'ESTASCIO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(640, '17-0004', 'JOSHUA', 'SAMSON', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(641, '17-0009', 'JESSABEL', 'QUITO', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(642, '17-0011', 'NOGOY', 'IRISH', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(643, '17-0013', 'MERCADO', 'NAOMI RUTH', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(644, '17-0016', 'MANLAPIG', 'ANDREA', 'T.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(645, '17-0022', 'KAYCY', 'LISING', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(646, '17-0023', 'BRENEL JIM', 'LACSAMANA', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(647, '17-0026', 'JENELLA', 'GARCIA', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(648, '17-0029', 'MAJA', 'DEL ROSARIO', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(649, '17-0032', 'BALUYUT', 'ANDREI MARNELLI', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(650, '17-0035', 'LALAINE', 'ANTONIO', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(651, '17-0037', 'MARIJO', 'BULANADI', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(652, '17-0038', 'FRANCIA FAITH', 'EVARISTO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(653, '17-0041', 'JOSHUA', 'PATAWARAN', 'V.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(654, '17-0042', 'EHROLL', 'OLIVER', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(655, '17-0044', 'THALIA INA JANE', 'DAYRIT', '', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(656, '17-0049', 'KAZIEL', 'PABLO', 'V.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(657, '17-0054', 'RANDELL', 'IGNACIO', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(658, '17-0055', 'QUEENCY', 'DEMATEO', 'O.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(659, '17-0057', 'ALYSSA CHRISTINE', 'BACANI', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(660, '17-0058', 'ERNIEN DALE', 'LANSANGAN', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(661, '17-0060', 'CLARK NEIL', 'BUSTARDE', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(662, '17-0066', 'JENNY', 'TIPAY', 'R.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(663, '17-0067', 'ANGELICA', 'BOGNOT', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(664, '17-0069', 'LOVELYN', 'CASTRO', 'O.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(665, '17-0071', 'JENNIFER', 'GAMET', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(666, '17-0073', 'JASTINE ROSE', 'RODRIGUEZ', 'V.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(667, '17-0075', 'ELLAN MARGA', 'SIGUA', 'S.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(668, '17-0076', 'FAITH', 'SESE', 'B.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(669, '17-0078', 'DANIEL', 'BARIN', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(670, '17-0079', 'JOSHUA', 'PABALAN', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(671, '17-0080', 'ROSE ANN', 'LOPEZ', 'L.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(672, '17-0081', 'JOHN KYLLE ERIES', 'CARREON', 'A.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(673, '17-0082', 'JYLIAN GELCO', 'JIMENEZ', 'M.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(674, '17-0083', 'JINKY CASTRO', 'MANDILAG', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(675, '17-0084', 'ANA MARIE', 'AGUSTIN', 'D.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(676, '17-0085', 'KRISTINE ANNE', 'DIZON', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(677, '17-0086', 'ALEC DUSTIN CLARK', 'GUEVARRA', 'C.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(678, '17-0087', 'CHRISTIAN', 'DAVID', 'P.', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(679, '18-1001', 'slakjd', 'askd', 'sd', '2018-01-23', 'Male', 'sadsd@sdac.c', '09123918022', 'askdj lakjdasd lkj', '098130928', '2018-12-02', '2018'),
(680, '18-1320', 'Avin', 'Dy', 'A', '2005-11-28', 'Male', 'avindy2015@gmail.com', '9234609011', 'mother', '09254609017', '2018-02-28', '2018');

-- --------------------------------------------------------

--
-- Table structure for table `student_classes`
--

CREATE TABLE `student_classes` (
  `id` int(11) NOT NULL,
  `student_class_code` varchar(8) NOT NULL,
  `student_id` varchar(8) NOT NULL,
  `class_code` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_code` varchar(8) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `course_code` varchar(15) NOT NULL,
  `year_level` varchar(15) NOT NULL,
  `total_units` int(11) NOT NULL,
  `pre_req` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `teachers`
-- (See below for the actual view)
--
CREATE TABLE `teachers` (
`emp_id` varchar(8)
,`lname` varchar(11)
,`fname` varchar(13)
,`mi` varchar(2)
,`bdate` date
,`gender` varchar(7)
,`email` char(30)
,`contact` varchar(13)
,`hire_date` date
,`status` varchar(15)
);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_classes`
--

CREATE TABLE `teacher_classes` (
  `id` int(11) NOT NULL,
  `teacher_class_code` varchar(8) NOT NULL,
  `emp_id` varchar(8) NOT NULL,
  `class_code` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `unit_code` varchar(15) NOT NULL,
  `description` text NOT NULL,
  `per_unit` decimal(4,2) NOT NULL,
  `units` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(8) NOT NULL,
  `uname` int(6) DEFAULT NULL,
  `pass` varchar(9) DEFAULT NULL,
  `role` varchar(7) DEFAULT NULL,
  `isFirstLogin` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `uname`, `pass`, `role`, `isFirstLogin`) VALUES
('13-10001', 1310001, 'adminpass', 'admin', 'no'),
('14-10002', 1410002, '9T7cJEcOi', 'admin', 'yes'),
('18-1320', 181320, 'pass1234', 'student', 'no');

-- --------------------------------------------------------

--
-- Structure for view `admin`
--
DROP TABLE IF EXISTS `admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `admin`  AS  select `employees`.`emp_id` AS `emp_id`,`employees`.`lname` AS `lname`,`employees`.`fname` AS `fname`,`employees`.`mi` AS `mi`,`employees`.`contact` AS `contact`,`employees`.`gender` AS `gender`,`employees`.`bdate` AS `bdate`,`employees`.`email` AS `email`,`employees`.`hire_date` AS `hire_date`,`employees`.`status` AS `status` from `employees` where (`employees`.`role` = 'admin') ;

-- --------------------------------------------------------

--
-- Structure for view `cash`
--
DROP TABLE IF EXISTS `cash`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cash`  AS  select `employees`.`emp_id` AS `emp_id`,`employees`.`lname` AS `lname`,`employees`.`fname` AS `fname`,`employees`.`mi` AS `mi`,`employees`.`contact` AS `contact`,`employees`.`gender` AS `gender`,`employees`.`bdate` AS `bdate`,`employees`.`email` AS `email`,`employees`.`hire_date` AS `hire_date`,`employees`.`status` AS `status` from `employees` where (`employees`.`role` = 'cashier') ;

-- --------------------------------------------------------

--
-- Structure for view `studentprofile`
--
DROP TABLE IF EXISTS `studentprofile`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `studentprofile`  AS  select `students`.`student_id` AS `student_id`,`students`.`lname` AS `lname`,`students`.`fname` AS `fname`,`students`.`mi` AS `mi`,`students`.`bdate` AS `bdate`,`students`.`gender` AS `gender`,`students`.`contact` AS `contact`,`students`.`email` AS `email`,`students`.`emergency_person` AS `emergency_person`,`students`.`emergency_contact` AS `emergency_contact`,`students`.`reg_date` AS `reg_date`,`enrollment`.`course_code` AS `course_code`,`enrollment`.`enrollment_date` AS `enrollment_date`,`enrollment`.`school_year` AS `school_year`,`enrollment`.`section` AS `section`,`enrollment`.`sem` AS `sem`,`enrollment`.`status` AS `status`,`enrollment`.`year_level` AS `year_level`,`picture`.`type` AS `type`,`picture`.`title` AS `title`,`picture`.`dir` AS `dir` from ((`students` join `enrollment`) join `picture`) where ((`students`.`student_id` = `enrollment`.`student_id`) and (`students`.`student_id` = `picture`.`user_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `teachers`
--
DROP TABLE IF EXISTS `teachers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `teachers`  AS  select `employees`.`emp_id` AS `emp_id`,`employees`.`lname` AS `lname`,`employees`.`fname` AS `fname`,`employees`.`mi` AS `mi`,`employees`.`bdate` AS `bdate`,`employees`.`gender` AS `gender`,`employees`.`email` AS `email`,`employees`.`contact` AS `contact`,`employees`.`hire_date` AS `hire_date`,`employees`.`status` AS `status` from `employees` where (`employees`.`role` = 'teacher') ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activation`
--
ALTER TABLE `activation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`uname`);

--
-- Indexes for table `cashier`
--
ALTER TABLE `cashier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_code` (`course_code`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emp_id` (`emp_id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_code` (`room_code`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `section_code` (`section_code`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `student_classes`
--
ALTER TABLE `student_classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_class_code` (`student_class_code`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subject_code` (`subject_code`);

--
-- Indexes for table `teacher_classes`
--
ALTER TABLE `teacher_classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacher_class_code` (`teacher_class_code`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unit_code` (`unit_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `uname` (`uname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activation`
--
ALTER TABLE `activation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cashier`
--
ALTER TABLE `cashier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=681;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=681;

--
-- AUTO_INCREMENT for table `student_classes`
--
ALTER TABLE `student_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_classes`
--
ALTER TABLE `teacher_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
