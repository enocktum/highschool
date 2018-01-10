-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 12, 2014 at 04:40 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `highexam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admissionlogfile`
--

CREATE TABLE IF NOT EXISTS `admissionlogfile` (
  `admissionlogfileid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `day` date NOT NULL,
  `time` varchar(25) NOT NULL,
  `loginsuccessful` varchar(4) NOT NULL,
  `ipaddress` varchar(50) NOT NULL,
  `who` varchar(50) NOT NULL,
  PRIMARY KEY (`admissionlogfileid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `admissionlogfile`
--

INSERT INTO `admissionlogfile` (`admissionlogfileid`, `username`, `password`, `day`, `time`, `loginsuccessful`, `ipaddress`, `who`) VALUES
(1, 'admin', 'adminpass', '2014-08-01', '18:10:12', 'yes', '::1', 'admissiongeneralgate'),
(2, 'farrel', 'farrel', '2014-08-01', '18:10:15', 'yes', '::1', 'studentsadmissiongate'),
(3, 'admin', 'adminpass', '2014-08-04', '15:36:03', 'yes', '::1', 'admissiongeneralgate'),
(4, 'admin', 'adminpass', '2014-08-07', '10:37:16', 'yes', '::1', 'admissiongeneralgate'),
(5, 'farrel', 'farrel', '2014-08-07', '10:37:24', 'yes', '::1', 'studentsadmissiongate'),
(6, 'admin', 'adminpass', '2014-08-07', '11:24:18', 'yes', '::1', 'admissiongeneralgate'),
(7, 'admin', 'adminpass', '2014-08-07', '18:39:49', 'yes', '::1', 'admissiongeneralgate'),
(8, 'admin', 'adminpass', '2014-08-08', '15:46:52', 'yes', '::1', 'admissiongeneralgate'),
(9, 'admin', 'adminpass', '2014-08-08', '16:16:59', 'yes', '::1', 'admissiongeneralgate'),
(10, 'admin', 'adminpass', '2014-08-08', '17:58:49', 'yes', '::1', 'admissiongeneralgate'),
(11, 'farrel', 'farrel', '2014-08-08', '17:58:56', 'yes', '::1', 'studentsadmissiongate'),
(12, 'admin', 'adminpass', '2014-08-09', '10:38:31', 'yes', '::1', 'admissiongeneralgate'),
(13, 'farrel', 'farrel', '2014-08-09', '11:23:27', 'yes', '::1', 'studentsadmissiongate'),
(14, 'admin', 'adminpasss', '2014-08-09', '21:22:53', 'yes', '::1', 'admissiongeneralgate'),
(15, 'admin', 'adminpass', '2014-08-10', '12:26:59', 'yes', '::1', 'admissiongeneralgate'),
(16, 'admin', 'adminpass', '2014-08-11', '09:36:00', 'yes', '::1', 'admissiongeneralgate'),
(17, 'admin', 'amdinpass', '2014-08-11', '11:59:37', 'no', '::1', 'admissiongeneralgate'),
(18, 'admin', 'adminpass', '2014-08-11', '11:59:50', 'yes', '::1', 'admissiongeneralgate'),
(19, 'admin', 'adminpass', '2014-08-11', '13:19:55', 'yes', '::1', 'admissiongeneralgate'),
(20, 'exams', 'exams', '2014-08-11', '14:35:23', 'no', '::1', 'admissiongeneralgate'),
(21, 'admin', 'adminpass', '2014-08-11', '14:35:34', 'yes', '::1', 'admissiongeneralgate'),
(22, 'farrel', 'farrel', '2014-08-11', '14:35:48', 'yes', '::1', 'studentsadmissiongate'),
(23, 'admin', 'adminpass', '2014-08-11', '14:40:57', 'yes', '::1', 'admissiongeneralgate'),
(24, 'farrel', 'farrel', '2014-08-11', '14:41:02', 'yes', '::1', 'studentsadmissiongate'),
(25, 'admin', 'adminpass', '2014-08-11', '15:36:05', 'no', '::1', 'admissiongeneralgate'),
(26, 'admin', 'adminpass', '2014-08-11', '15:36:24', 'no', '::1', 'admissiongeneralgate'),
(27, 'admin', 'adminpass', '2014-08-11', '15:36:29', 'no', '::1', 'admissiongeneralgate'),
(28, 'admin', 'adminpass', '2014-08-11', '15:36:38', 'no', '::1', 'admissiongeneralgate'),
(29, '', '', '2014-08-11', '15:40:04', 'yes', '::1', 'admissiongeneralgate');

-- --------------------------------------------------------

--
-- Table structure for table `admissionlogin`
--

CREATE TABLE IF NOT EXISTS `admissionlogin` (
  `admissionloginid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  PRIMARY KEY (`admissionloginid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admissionlogin`
--

INSERT INTO `admissionlogin` (`admissionloginid`, `username`, `password`) VALUES
(1, 'admin', 'adminpass');

-- --------------------------------------------------------

--
-- Table structure for table `boardadmissionlogin`
--

CREATE TABLE IF NOT EXISTS `boardadmissionlogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `boardadmissionlogin`
--

INSERT INTO `boardadmissionlogin` (`id`, `username`, `password`) VALUES
(1, 'mtihani', 'mtihani');

-- --------------------------------------------------------

--
-- Table structure for table `boarddetails`
--

CREATE TABLE IF NOT EXISTS `boarddetails` (
  `boarddetailsid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `phonenumber` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `postaladdress` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `admissiondate` date NOT NULL,
  `province` varchar(50) NOT NULL,
  PRIMARY KEY (`boarddetailsid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `boarddetails`
--

INSERT INTO `boarddetails` (`boarddetailsid`, `firstname`, `lastname`, `gender`, `phonenumber`, `username`, `password`, `postaladdress`, `birthday`, `nationality`, `admissiondate`, `province`) VALUES
(2, 'Enock', 'Tum', 'Male', '0702000775', 'board', 'board1', '9082, Eldoret', '1993-11-10', 'Kenyan', '2013-11-21', 'Rift Valley');

-- --------------------------------------------------------

--
-- Table structure for table `currentterm`
--

CREATE TABLE IF NOT EXISTS `currentterm` (
  `currenttermid` int(11) NOT NULL AUTO_INCREMENT,
  `term` varchar(15) NOT NULL,
  `openingdate` date NOT NULL,
  `closingdate` date NOT NULL,
  PRIMARY KEY (`currenttermid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `currentterm`
--

INSERT INTO `currentterm` (`currenttermid`, `term`, `openingdate`, `closingdate`) VALUES
(1, 'one', '2014-08-06', '2014-07-28');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE IF NOT EXISTS `exams` (
  `examsid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `class` varchar(5) NOT NULL,
  PRIMARY KEY (`examsid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`examsid`, `name`, `class`) VALUES
(1, 'final', '1'),
(3, 'final', '2');

-- --------------------------------------------------------

--
-- Table structure for table `examspecificmeangrade`
--

CREATE TABLE IF NOT EXISTS `examspecificmeangrade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` varchar(100) NOT NULL,
  `year` varchar(4) NOT NULL,
  `exam` varchar(100) NOT NULL,
  `term` varchar(10) NOT NULL,
  `class` varchar(10) NOT NULL,
  `meangrade` float NOT NULL,
  `totalmarks` float NOT NULL,
  `subjectsdone` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `examspecificmeangrade`
--

INSERT INTO `examspecificmeangrade` (`id`, `studentid`, `year`, `exam`, `term`, `class`, `meangrade`, `totalmarks`, `subjectsdone`) VALUES
(1, 's001', '2014', 'final', 'one', '2', 66.9091, 736, '11');

-- --------------------------------------------------------

--
-- Table structure for table `footer`
--

CREATE TABLE IF NOT EXISTS `footer` (
  `schoolname` varchar(150) NOT NULL,
  `copyright` varchar(4) NOT NULL,
  `maintained` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `footer`
--

INSERT INTO `footer` (`schoolname`, `copyright`, `maintained`) VALUES
('ENOSOFT COMPANY HIGHSCHOOL SOFTWARE SOLUTION', '2014', 'Enock Tum');

-- --------------------------------------------------------

--
-- Table structure for table `gradingsystem`
--

CREATE TABLE IF NOT EXISTS `gradingsystem` (
  `gradingsystemid` int(11) NOT NULL AUTO_INCREMENT,
  `grade` varchar(25) NOT NULL,
  `rangee` varchar(50) NOT NULL,
  `comments` varchar(250) NOT NULL,
  `subject` varchar(100) NOT NULL,
  PRIMARY KEY (`gradingsystemid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=133 ;

--
-- Dumping data for table `gradingsystem`
--

INSERT INTO `gradingsystem` (`gradingsystemid`, `grade`, `rangee`, `comments`, `subject`) VALUES
(1, 'A', '85-100', 'superb performance', 'business studies'),
(2, 'A-', '80-85', 'very good', 'business studies'),
(3, 'B+', '75-80', 'good', 'business studies'),
(4, 'B', '70-75', 'good', 'business studies'),
(5, 'B-', '65-70', 'fair', 'business studies'),
(6, 'C+', '60-65', 'fair', 'business studies'),
(7, 'C', '50-60', 'average', 'business studies'),
(8, 'C-', '45-50', 'average', 'business studies'),
(9, 'D+', '40-45', 'average', 'business studies'),
(10, 'D', '35-40', 'below average', 'business studies'),
(11, 'D-', '30-35', 'you can do better', 'business studies'),
(12, 'E', '0-30', 'work really hard', 'business studies'),
(13, 'A', '85-100', 'excellent', 'agriculture'),
(14, 'A-', '80-85', 'very good', 'agriculture'),
(15, 'B+', '75-80', 'good', 'agriculture'),
(16, 'B', '70-75', 'good', 'agriculture'),
(17, 'B-', '65-70', 'fair', 'agriculture'),
(18, 'C+', '60-65', 'fair', 'agriculture'),
(19, 'C', '50-60', 'average', 'agriculture'),
(20, 'C-', '45-50', 'average', 'agriculture'),
(21, 'D+', '40-45', 'average', 'agriculture'),
(22, 'D', '35-40', 'below average', 'agriculture'),
(23, 'D-', '30-35', 'you can do better', 'agriculture'),
(24, 'E', '0-30', 'work really hard', 'agriculture'),
(25, 'A', '85-100', 'excellent', 'mathematics'),
(26, 'A-', '80-85', 'very good', 'mathematics'),
(27, 'B+', '75-80', 'good', 'mathematics'),
(28, 'B', '70-75', 'good', 'mathematics'),
(29, 'B-', '65-70', 'fair', 'mathematics'),
(30, 'C+', '60-65', 'fair', 'mathematics'),
(31, 'C', '50-60', 'average', 'mathematics'),
(32, 'C-', '45-50', 'average', 'mathematics'),
(33, 'D+', '40-45', 'average', 'mathematics'),
(34, 'D', '35-40', 'below average', 'mathematics'),
(35, 'D-', '30-35', 'you can do better', 'mathematics'),
(36, 'E', '0-30', 'work really hard', 'mathematics'),
(37, 'A', '85-100', 'excellent', 'english'),
(38, 'A-', '80-85', 'very good', 'english'),
(39, 'B+', '75-80', 'good', 'english'),
(40, 'B', '70-75', 'good', 'english'),
(41, 'B-', '65-70', 'fair', 'english'),
(42, 'C+', '60-65', 'fair', 'english'),
(43, 'C', '50-60', 'average', 'english'),
(44, 'C-', '45-50', 'average', 'english'),
(45, 'D+', '40-45', 'average', 'english'),
(46, 'D', '35-40', 'below average', 'english'),
(47, 'D-', '30-35', 'you can do better', 'english'),
(48, 'E', '0-30', 'work really hard', 'english'),
(49, 'A', '85-100', 'excellent', 'kiswahili'),
(50, 'A-', '80-85', 'very good', 'kiswahili'),
(51, 'B+', '75-80', 'good', 'kiswahili'),
(52, 'B', '70-75', 'good', 'kiswahili'),
(53, 'B-', '65-70', 'fair', 'kiswahili'),
(54, 'C+', '60-65', 'fair', 'kiswahili'),
(55, 'C', '50-60', 'average', 'kiswahili'),
(56, 'C-', '45-50', 'average', 'kiswahili'),
(57, 'D+', '40-45', 'average', 'kiswahili'),
(58, 'D', '35-40', 'below average', 'kiswahili'),
(59, 'D-', '30-35', 'you can do better', 'kiswahili'),
(60, 'E', '0-30', 'work really hard', 'kiswahili'),
(61, 'A', '85-100', 'excellent', 'physics'),
(62, 'A-', '80-85', 'very good', 'physics'),
(63, 'B+', '75-80', 'good', 'physics'),
(64, 'B', '70-75', 'good', 'physics'),
(65, 'B-', '65-70', 'fair', 'physics'),
(66, 'C+', '60-65', 'fair', 'physics'),
(67, 'C', '50-60', 'average', 'physics'),
(68, 'C-', '45-50', 'average', 'physics'),
(69, 'D+', '40-45', 'average', 'physics'),
(70, 'D', '35-40', 'below average', 'physics'),
(71, 'D-', '30-35', 'you can do better', 'physics'),
(72, 'E', '0-30', 'work really hard', 'physics'),
(73, 'A', '85-100', 'excellent', 'biology'),
(74, 'A-', '80-85', 'very good', 'biology'),
(75, 'B+', '75-80', 'good', 'biology'),
(76, 'B', '70-75', 'good', 'biology'),
(77, 'B-', '65-70', 'fair', 'biology'),
(78, 'C+', '60-65', 'fair', 'biology'),
(79, 'C', '50-60', 'average', 'biology'),
(80, 'C-', '45-50', 'average', 'biology'),
(81, 'D+', '40-45', 'average', 'biology'),
(82, 'D', '35-40', 'below average', 'biology'),
(83, 'D-', '30-35', 'you can do better', 'biology'),
(84, 'E', '0-30', 'work really hard', 'biology'),
(85, 'A', '85-100', 'excellent', 'chemistry'),
(86, 'A-', '80-85', 'very good', 'chemistry'),
(87, 'B+', '75-80', 'good', 'chemistry'),
(88, 'B', '70-75', 'good', 'chemistry'),
(89, 'B-', '65-70', 'fair', 'chemistry'),
(90, 'C+', '60-65', 'fair', 'chemistry'),
(91, 'C', '50-60', 'average', 'chemistry'),
(92, 'C-', '45-50', 'average', 'chemistry'),
(93, 'D+', '40-45', 'average', 'chemistry'),
(94, 'D', '35-40', 'below average', 'chemistry'),
(95, 'D-', '30-35', 'you can do better', 'chemistry'),
(96, 'E', '0-30', 'work really hard', 'chemistry'),
(97, 'A', '85-100', 'excellent', 'christian religious education'),
(98, 'A-', '80-85', 'very good', 'christian religious education'),
(99, 'B+', '75-80', 'good', 'christian religious education'),
(100, 'B', '70-75', 'good', 'christian religious education'),
(101, 'B-', '65-70', 'fair', 'christian religious education'),
(102, 'C+', '60-65', 'fair', 'christian religious education'),
(103, 'C', '50-60', 'average', 'christian religious education'),
(104, 'C-', '45-50', 'average', 'christian religious education'),
(105, 'D+', '40-45', 'average', 'christian religious education'),
(106, 'D', '35-40', 'below average', 'christian religious education'),
(107, 'D-', '30-35', 'you can do better', 'christian religious education'),
(108, 'E', '0-30', 'work really hard', 'christian religious education'),
(109, 'A', '85-100', 'excellent', 'history and government'),
(110, 'A-', '80-85', 'very good', 'history and government'),
(111, 'B+', '75-80', 'good', 'history and government'),
(112, 'B', '70-75', 'good', 'history and government'),
(113, 'B-', '65-70', 'fair', 'history and government'),
(114, 'C+', '60-65', 'fair', 'history and government'),
(115, 'C', '50-60', 'average', 'history and government'),
(116, 'C-', '45-50', 'average', 'history and government'),
(117, 'D+', '40-45', 'average', 'history and government'),
(118, 'D', '35-40', 'below average', 'history and government'),
(119, 'D-', '30-35', 'you can do better', 'history and government'),
(120, 'E', '0-30', 'work really hard', 'history and government'),
(121, 'A', '85-100', 'excellent', 'geography'),
(122, 'A-', '80-85', 'very good', 'geography'),
(123, 'B+', '75-80', 'good', 'geography'),
(124, 'B', '70-75', 'good', 'geography'),
(125, 'B-', '65-70', 'fair', 'geography'),
(126, 'C+', '60-65', 'fair', 'geography'),
(127, 'C', '50-60', 'average', 'geography'),
(128, 'C-', '45-50', 'average', 'geography'),
(129, 'D+', '40-45', 'average', 'geography'),
(130, 'D', '35-40', 'below average', 'geography'),
(131, 'D-', '30-35', 'you can do better', 'geography'),
(132, 'E', '0-30', 'work really hard', 'geography');

-- --------------------------------------------------------

--
-- Table structure for table `individualmeangrade`
--

CREATE TABLE IF NOT EXISTS `individualmeangrade` (
  `individualmeangradeid` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` varchar(25) NOT NULL,
  `meangrade` float NOT NULL,
  `term` varchar(25) NOT NULL,
  `class` varchar(25) NOT NULL,
  `year` varchar(25) NOT NULL,
  `subjectsdone` varchar(25) NOT NULL,
  `examsdone` varchar(25) NOT NULL,
  `totalmarks` double NOT NULL,
  PRIMARY KEY (`individualmeangradeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `individualmeangrade`
--

INSERT INTO `individualmeangrade` (`individualmeangradeid`, `studentid`, `meangrade`, `term`, `class`, `year`, `subjectsdone`, `examsdone`, `totalmarks`) VALUES
(1, 's001', 77.7273, 'one', '1', '2014', '11', '1', 855),
(2, 's001', 79.2328, 'two', '1', '2014', '11', '1', 871.561),
(3, 's001', 83.8182, 'three', '1', '2014', '11', '1', 922),
(9, 's001', 66.9091, 'one', '2', '2014', '11', '1', 736);

-- --------------------------------------------------------

--
-- Table structure for table `meangradegrading`
--

CREATE TABLE IF NOT EXISTS `meangradegrading` (
  `meangradegradingid` int(11) NOT NULL AUTO_INCREMENT,
  `between` varchar(25) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `classteacherremarks` varchar(200) NOT NULL,
  `principleremarks` varchar(200) NOT NULL,
  PRIMARY KEY (`meangradegradingid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `meangradegrading`
--

INSERT INTO `meangradegrading` (`meangradegradingid`, `between`, `grade`, `classteacherremarks`, `principleremarks`) VALUES
(1, '80-100', 'A', 'excellent results', 'perfect performance'),
(2, '75-80', 'A-', 'perfect perfomance', 'excellent'),
(3, '70-75', 'B+', 'very good', 'good results, aim for A'),
(4, '65-70', 'B', 'good', 'good, aim for A'),
(5, '60-65', 'B-', 'average', 'average results, you can do better'),
(6, '55-60', 'C+', 'you can do better', 'aim higher'),
(7, '50-55', 'C', 'pull up your socks', 'you can do better than this'),
(8, '45-50', 'C-', 'really pull up your socks', 'do something about your grade'),
(9, '40-45', 'D+', 'poor results, pick yourself up', 'poor, pull up'),
(10, '35-40', 'D', 'fail, tuition required', 'fail, make sure to pull up'),
(11, '30-35', 'D-', 'you really need a miracle', 'read really really hard'),
(12, '0-30', 'E', 'total failure', 'critical failure');

-- --------------------------------------------------------

--
-- Table structure for table `streams`
--

CREATE TABLE IF NOT EXISTS `streams` (
  `streamsid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`streamsid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `streams`
--

INSERT INTO `streams` (`streamsid`, `name`) VALUES
(1, 'east');

-- --------------------------------------------------------

--
-- Table structure for table `studentadmissionlogin`
--

CREATE TABLE IF NOT EXISTS `studentadmissionlogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `studentadmissionlogin`
--

INSERT INTO `studentadmissionlogin` (`id`, `username`, `password`) VALUES
(1, 'enock', 'enock');

-- --------------------------------------------------------

--
-- Table structure for table `studentbasicsubject`
--

CREATE TABLE IF NOT EXISTS `studentbasicsubject` (
  `studentbasicsubjectid` int(11) NOT NULL AUTO_INCREMENT,
  `subjects` varchar(500) NOT NULL,
  PRIMARY KEY (`studentbasicsubjectid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `studentbasicsubject`
--

INSERT INTO `studentbasicsubject` (`studentbasicsubjectid`, `subjects`) VALUES
(1, 'mathematics,english,kiswahili,physics,chemistry,biology,geography,christian religious education,history and government,business studies,agriculture');

-- --------------------------------------------------------

--
-- Table structure for table `studentdetails`
--

CREATE TABLE IF NOT EXISTS `studentdetails` (
  `studentdetailsid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) NOT NULL,
  `middlename` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `birthday` date NOT NULL,
  `province` varchar(45) NOT NULL,
  `nationality` varchar(45) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `primaryname` varchar(100) NOT NULL,
  `kcpemarks` int(3) NOT NULL,
  `primarypostaladdress` varchar(200) NOT NULL,
  `kcpeyear` date NOT NULL,
  `parentname` varchar(100) NOT NULL,
  `parentphonenumber` varchar(20) NOT NULL,
  `parentpostaladdress` varchar(200) NOT NULL,
  `admissionnumber` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `password` varchar(35) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `admissiondate` date NOT NULL COMMENT 'student admission date',
  `stream` varchar(45) NOT NULL COMMENT 'admission class assigned',
  `dormitory` varchar(100) NOT NULL,
  `currentclass` varchar(25) NOT NULL COMMENT 'student current class',
  `status` varchar(3) NOT NULL,
  `boardingstatus` varchar(50) NOT NULL,
  PRIMARY KEY (`studentdetailsid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `studentdetails`
--

INSERT INTO `studentdetails` (`studentdetailsid`, `firstname`, `middlename`, `lastname`, `birthday`, `province`, `nationality`, `gender`, `primaryname`, `kcpemarks`, `primarypostaladdress`, `kcpeyear`, `parentname`, `parentphonenumber`, `parentpostaladdress`, `admissionnumber`, `password`, `admissiondate`, `stream`, `dormitory`, `currentclass`, `status`, `boardingstatus`) VALUES
(1, 'nockstar', 'knight', 'rivals', '1993-11-10', 'uasin gishu', 'kenyan', 'Male', 'chepkoilel central', 369, '922,eldoret', '2014-08-14', 'Stanley Tum', '0710498189', '9082,eldoret', 's001', 's001', '2014-08-01', '', 'dorm 1', '2', '1', 'oncampus'),
(2, 'walala', 'wakaka', 'walala', '2000-01-11', 'kisumu', 'kenyan', 'Male', 'chepkwote', 0, '25,bondo', '2014-08-08', 'walala senior', '0452555', '5,walala land', 's002', 's002', '2014-08-08', '', 'dorm 4', '2', '1', 'offcampus');

-- --------------------------------------------------------

--
-- Table structure for table `studentgrades`
--

CREATE TABLE IF NOT EXISTS `studentgrades` (
  `gradeid` int(11) NOT NULL AUTO_INCREMENT,
  `term` varchar(5) NOT NULL,
  `testname` varchar(50) NOT NULL,
  `grade` varchar(2) NOT NULL,
  `marksgained` int(3) NOT NULL,
  `studentid` varchar(25) NOT NULL,
  `class` int(11) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `year` int(4) NOT NULL,
  `percentagemarks` float NOT NULL,
  `rawmarks` float NOT NULL,
  PRIMARY KEY (`gradeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `studentgrades`
--

INSERT INTO `studentgrades` (`gradeid`, `term`, `testname`, `grade`, `marksgained`, `studentid`, `class`, `remarks`, `subject`, `year`, `percentagemarks`, `rawmarks`) VALUES
(1, 'one', 'final', 'B', 38, 's001', 1, 'good', 'mathematics', 2014, 75, 50),
(2, 'one', 'final', 'A', 43, 's001', 1, 'excellent', 'english', 2014, 86, 50),
(3, 'one', 'final', 'A-', 41, 's001', 1, 'very good', 'kiswahili', 2014, 82, 50),
(4, 'one', 'final', 'A-', 42, 's001', 1, 'very good', 'physics', 2014, 84, 50),
(5, 'one', 'final', 'B-', 35, 's001', 1, 'fair', 'chemistry', 2014, 70, 50),
(6, 'one', 'final', 'A', 47, 's001', 1, 'excellent', 'biology', 2014, 94, 50),
(7, 'one', 'final', 'C+', 32, 's001', 1, 'fair', 'geography', 2014, 64, 50),
(8, 'one', 'final', 'C', 26, 's001', 1, 'average', 'christian religious education', 2014, 52, 50),
(9, 'one', 'final', 'A-', 42, 's001', 1, 'very good', 'history and government', 2014, 84, 50),
(10, 'one', 'final', 'A-', 42, 's001', 1, 'very good', 'business studies', 2014, 84, 50),
(11, 'one', 'final', 'B+', 32, 's001', 1, 'good', 'agriculture', 2014, 80, 40),
(12, 'two', 'final', 'B+', 40, 's001', 1, 'good', 'mathematics', 2014, 80, 50),
(13, 'two', 'final', 'A', 43, 's001', 1, 'excellent', 'english', 2014, 86, 50),
(14, 'two', 'final', 'A', 43, 's001', 1, 'excellent', 'kiswahili', 2014, 86, 50),
(15, 'two', 'final', 'B+', 32, 's001', 1, 'good', 'physics', 2014, 80, 40),
(16, 'two', 'final', 'C-', 5, 's001', 1, 'average', 'chemistry', 2014, 50, 10),
(17, 'two', 'final', 'A-', 42, 's001', 1, 'very good', 'biology', 2014, 84, 50),
(18, 'two', 'final', 'A', 45, 's001', 1, 'excellent', 'geography', 2014, 90, 50),
(19, 'two', 'final', 'A', 40, 's001', 1, 'excellent', 'christian religious education', 2014, 97.561, 41),
(20, 'two', 'final', 'A-', 42, 's001', 1, 'very good', 'business studies', 2014, 84, 50),
(21, 'two', 'final', 'A-', 42, 's001', 1, 'very good', 'history and government', 2014, 84, 50),
(22, 'two', 'final', 'C-', 25, 's001', 1, 'average', 'agriculture', 2014, 50, 50),
(23, 'three', 'final', 'A-', 42, 's001', 1, 'very good', 'mathematics', 2014, 84, 50),
(24, 'three', 'final', 'A', 40, 's001', 1, 'excellent', 'english', 2014, 100, 40),
(25, 'three', 'final', 'A-', 42, 's001', 1, 'very good', 'kiswahili', 2014, 84, 50),
(26, 'three', 'final', 'A', 46, 's001', 1, 'excellent', 'physics', 2014, 92, 50),
(27, 'three', 'final', 'D', 20, 's001', 1, 'below average', 'chemistry', 2014, 40, 50),
(28, 'three', 'final', 'C+', 32, 's001', 1, 'fair', 'biology', 2014, 64, 50),
(29, 'three', 'final', 'A', 50, 's001', 1, 'excellent', 'geography', 2014, 100, 50),
(30, 'three', 'final', 'A', 43, 's001', 1, 'excellent', 'christian religious education', 2014, 86, 50),
(31, 'three', 'final', 'A', 46, 's001', 1, 'excellent', 'history and government', 2014, 92, 50),
(32, 'three', 'final', 'A', 47, 's001', 1, 'superb performance', 'business studies', 2014, 94, 50),
(33, 'three', 'final', 'A', 43, 's001', 1, 'excellent', 'agriculture', 2014, 86, 50),
(34, 'one', 'final', 'B+', 40, 's001', 2, 'good', 'mathematics', 2014, 80, 50),
(35, 'one', 'final', 'C-', 25, 's001', 2, 'average', 'english', 2014, 50, 50),
(36, 'one', 'final', 'C+', 32, 's001', 2, 'fair', 'kiswahili', 2014, 64, 50),
(37, 'one', 'final', 'A-', 41, 's001', 2, 'very good', 'physics', 2014, 82, 50),
(38, 'one', 'final', 'E', 12, 's001', 2, 'work really hard', 'chemistry', 2014, 24, 50),
(39, 'one', 'final', 'A-', 42, 's001', 2, 'very good', 'biology', 2014, 84, 50),
(40, 'one', 'final', 'A-', 42, 's001', 2, 'very good', 'geography', 2014, 84, 50),
(41, 'one', 'final', 'C', 26, 's001', 2, 'average', 'christian religious education', 2014, 52, 50),
(42, 'one', 'final', 'A-', 41, 's001', 2, 'very good', 'history and government', 2014, 82, 50),
(43, 'one', 'final', 'B-', 35, 's001', 2, 'fair', 'business studies', 2014, 70, 50),
(44, 'one', 'final', 'C+', 32, 's001', 2, 'fair', 'agriculture', 2014, 64, 50);

-- --------------------------------------------------------

--
-- Table structure for table `studentselectedsubjects`
--

CREATE TABLE IF NOT EXISTS `studentselectedsubjects` (
  `studentselectedsubjects` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` varchar(25) NOT NULL,
  `subjects` varchar(500) NOT NULL,
  PRIMARY KEY (`studentselectedsubjects`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subjectid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  PRIMARY KEY (`subjectid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectid`, `name`, `category`) VALUES
(1, 'mathematics', 'compulsory'),
(2, 'english', 'compulsory'),
(3, 'kiswahili', 'compulsory'),
(4, 'physics', 'sciences'),
(5, 'chemistry', 'sciences'),
(6, 'biology', 'sciences'),
(7, 'geography', 'humanities'),
(8, 'christian religious education', 'humanities'),
(9, 'history and government', 'humanities'),
(10, 'business studies', 'applied'),
(11, 'agriculture', 'applied');

-- --------------------------------------------------------

--
-- Table structure for table `subjectcategory`
--

CREATE TABLE IF NOT EXISTS `subjectcategory` (
  `subjectcategoryid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`subjectcategoryid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `subjectcategory`
--

INSERT INTO `subjectcategory` (`subjectcategoryid`, `name`) VALUES
(1, 'applied'),
(2, 'compulsory'),
(3, 'humanities'),
(4, 'sciences'),
(5, 'other');

-- --------------------------------------------------------

--
-- Table structure for table `subjectchoiceclass`
--

CREATE TABLE IF NOT EXISTS `subjectchoiceclass` (
  `subjectchoiceclass` int(11) NOT NULL AUTO_INCREMENT,
  `class` varchar(25) NOT NULL,
  `subjects` varchar(500) NOT NULL,
  PRIMARY KEY (`subjectchoiceclass`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `subjectchoiceclass`
--

INSERT INTO `subjectchoiceclass` (`subjectchoiceclass`, `class`, `subjects`) VALUES
(1, '3', 'english,maths');

-- --------------------------------------------------------

--
-- Table structure for table `subjectteacher`
--

CREATE TABLE IF NOT EXISTS `subjectteacher` (
  `subjectteacherid` int(11) NOT NULL AUTO_INCREMENT,
  `subjectid` int(11) NOT NULL,
  `teacherdetailsid` int(11) NOT NULL,
  `classesid` int(11) NOT NULL,
  PRIMARY KEY (`subjectteacherid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `teacheradmissionlogin`
--

CREATE TABLE IF NOT EXISTS `teacheradmissionlogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `teacheradmissionlogin`
--

INSERT INTO `teacheradmissionlogin` (`id`, `username`, `password`) VALUES
(1, 'teacher', 'teacheradmin');

-- --------------------------------------------------------

--
-- Table structure for table `teacherdetails`
--

CREATE TABLE IF NOT EXISTS `teacherdetails` (
  `teacherdetailsid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `nationalid` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `admissiondate` date NOT NULL,
  `postaladdress` varchar(50) NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `phonenumber` varchar(25) NOT NULL,
  `birthday` date NOT NULL,
  PRIMARY KEY (`teacherdetailsid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `teacherdetails`
--

INSERT INTO `teacherdetails` (`teacherdetailsid`, `firstname`, `lastname`, `password`, `nationalid`, `nationality`, `province`, `gender`, `admissiondate`, `postaladdress`, `username`, `phonenumber`, `birthday`) VALUES
(1, 'Sammy', 'Bett', 'sammy', '30043271', 'Kenyan', 'Rift valley', 'Male', '2013-11-19', '9082,eldoret', 'sammy', '0702000775', '1993-11-10');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
