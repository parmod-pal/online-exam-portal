-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 04, 2022 at 03:28 PM
-- Server version: 5.7.23-23
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rimsrcsp_rimsrstudinfo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission_details`
--

CREATE TABLE `admission_details` (
  `id` int(11) NOT NULL,
  `studentid` varchar(50) NOT NULL,
  `admittedfor` varchar(150) NOT NULL,
  `dateofadmission` date NOT NULL,
  `dateofcompletion` date NOT NULL,
  `certificateissuedon` date NOT NULL,
  `mentorassigned` varchar(150) NOT NULL,
  `noofattempts` int(11) NOT NULL,
  `posteddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admission_details`
--

INSERT INTO `admission_details` (`id`, `studentid`, `admittedfor`, `dateofadmission`, `dateofcompletion`, `certificateissuedon`, `mentorassigned`, `noofattempts`, `posteddate`) VALUES
(1, '1', '3', '2014-03-14', '0000-00-00', '0000-00-00', 'Prof. Gopal', 1, '2014-03-14');

-- --------------------------------------------------------

--
-- Table structure for table `countrylist`
--

CREATE TABLE `countrylist` (
  `Id` int(11) NOT NULL,
  `Name` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countrylist`
--

INSERT INTO `countrylist` (`Id`, `Name`) VALUES
(1, 'Afghanistan'),
(2, 'Aland Islands'),
(3, 'Albania'),
(4, 'Algeria'),
(5, 'American Samoa'),
(6, 'Andorra'),
(7, 'Angola'),
(8, 'Anguilla'),
(9, 'Antarctica'),
(10, 'Antigua And Barbuda'),
(11, 'Argentina'),
(12, 'Armenia'),
(13, 'Aruba'),
(14, 'Australia'),
(15, 'Austria'),
(16, 'Azerbaijan'),
(17, 'Bahamas'),
(18, 'Bahrain'),
(19, 'Bangladesh'),
(20, 'Barbados'),
(21, 'Belarus'),
(22, 'Belgium'),
(23, 'Belize'),
(24, 'Benin'),
(25, 'Bermuda'),
(26, 'Bhutan'),
(27, 'Bolivia'),
(28, 'Bosnia And Herzegovina'),
(29, 'Botswana'),
(30, 'Bouvet Island'),
(31, 'Brazil'),
(32, 'British Indian Ocean Territory'),
(33, 'Brunei Darussalam'),
(34, 'Bulgaria'),
(35, 'Burkina Faso'),
(36, 'Burundi'),
(37, 'Cambodia'),
(38, 'Cameroon'),
(39, 'Canada'),
(40, 'Cape Verde'),
(41, 'Cayman Islands'),
(42, 'Central African Republic'),
(43, 'Chad'),
(44, 'Chile'),
(45, 'China'),
(46, 'Christmas Island'),
(47, 'Cocos (Keeling) Islands'),
(48, 'Colombia'),
(49, 'Comoros'),
(50, 'Congo'),
(51, 'Congo, The Democratic Republic Of The'),
(52, 'Cook Islands'),
(53, 'Costa Rica'),
(54, 'Croatia'),
(55, 'Cuba'),
(56, 'Cyprus'),
(57, 'Czech Republic'),
(58, 'Denmark'),
(59, 'Djibouti'),
(60, 'Dominica'),
(61, 'Dominican Republic'),
(62, 'Ecuador'),
(63, 'Egypt'),
(64, 'El Salvador'),
(65, 'Equatorial Guinea'),
(66, 'Eritrea'),
(67, 'Estonia'),
(68, 'Ethiopia'),
(69, 'Falkland Islands (Malvinas)'),
(70, 'Faroe Islands'),
(71, 'Fiji'),
(72, 'Finland'),
(73, 'France'),
(74, 'French Guiana'),
(75, 'French Polynesia'),
(76, 'French Southern Territories'),
(77, 'Gabon'),
(78, 'Gambia'),
(79, 'Georgia'),
(80, 'Germany'),
(81, 'Ghana'),
(82, 'Gibraltar'),
(83, 'Greece'),
(84, 'Greenland'),
(85, 'Grenada'),
(86, 'Guadeloupe'),
(87, 'Guam'),
(88, 'Guatemala'),
(89, 'Guernsey'),
(90, 'Guinea'),
(91, 'Guinea-Bissau'),
(92, 'Guyana'),
(93, 'Haiti'),
(94, 'Heard Island And Mcdonald Islands'),
(95, 'Holy See (Vatican City State)'),
(96, 'Honduras'),
(97, 'Hong Kong'),
(98, 'Hungary'),
(99, 'Iceland'),
(100, 'India'),
(101, 'Indonesia'),
(102, 'Iran, Islamic Republic Of'),
(103, 'Iraq'),
(104, 'Ireland'),
(105, 'Isle Of Man'),
(106, 'Israel'),
(107, 'Italy'),
(108, 'Jamaica'),
(109, 'Japan'),
(110, 'Jersey'),
(111, 'Jordan'),
(112, 'Kazakhstan'),
(113, 'Kenya'),
(114, 'Kiribati'),
(115, 'Korea, Republic Of'),
(116, 'Kuwait'),
(117, 'Kyrgyzstan'),
(118, 'Latvia'),
(119, 'Lebanon'),
(120, 'Lesotho'),
(121, 'Liberia'),
(122, 'Libyan Arab Jamahiriya'),
(123, 'Liechtenstein'),
(124, 'Lithuania'),
(125, 'Luxembourg'),
(126, 'Macao'),
(127, 'Macedonia, The Former Yugoslav Republic Of'),
(128, 'Madagascar'),
(129, 'Malawi'),
(130, 'Malaysia'),
(131, 'Maldives'),
(132, 'Mali'),
(133, 'Malta'),
(134, 'Marshall Islands'),
(135, 'Martinique'),
(136, 'Mauritania'),
(137, 'Mauritius'),
(138, 'Mayotte'),
(139, 'Mexico'),
(140, 'Micronesia, Federated States Of'),
(141, 'Moldova, Republic Of'),
(142, 'Monaco'),
(143, 'Mongolia'),
(144, 'Montserrat'),
(145, 'Morocco'),
(146, 'Mozambique'),
(147, 'Myanmar'),
(148, 'Namibia'),
(149, 'Nauru'),
(150, 'Nepal'),
(151, 'Netherlands'),
(152, 'Netherlands Antilles'),
(153, 'New Caledonia'),
(154, 'New Zealand'),
(155, 'Nicaragua'),
(156, 'Niger'),
(157, 'Nigeria'),
(158, 'Niue'),
(159, 'Norfolk Island'),
(160, 'Northern Mariana Islands'),
(161, 'Norway'),
(162, 'Oman'),
(163, 'Pakistan'),
(164, 'Palau'),
(165, 'Palestinian Territory, Occupied'),
(166, 'Panama'),
(167, 'Papua New Guinea'),
(168, 'Paraguay'),
(169, 'Peru'),
(170, 'Philippines'),
(171, 'Pitcairn'),
(172, 'Poland'),
(173, 'Portugal'),
(174, 'Puerto Rico'),
(175, 'Qatar'),
(176, 'Reunion'),
(177, 'Romania'),
(178, 'Russian Federation'),
(179, 'Rwanda'),
(180, 'Saint Helena'),
(181, 'Saint Kitts And Nevis'),
(182, 'Saint Lucia'),
(183, 'Saint Pierre And Miquelon'),
(184, 'Saint Vincent And The Grenadines'),
(185, 'Samoa'),
(186, 'San Marino'),
(187, 'Sao Tome And Principe'),
(188, 'Saudi Arabia'),
(189, 'Senegal'),
(190, 'Serbia And Montenegro'),
(191, 'Seychelles'),
(192, 'Sierra Leone'),
(193, 'Singapore'),
(194, 'Slovakia'),
(195, 'Slovenia'),
(196, 'Solomon Islands'),
(197, 'Somalia'),
(198, 'South Africa'),
(199, 'South Georgia And The South Sandwich Islands'),
(200, 'Spain'),
(201, 'Sri Lanka'),
(202, 'Sudan'),
(203, 'Suriname'),
(204, 'Svalbard And Jan Mayen'),
(205, 'Swaziland'),
(206, 'Sweden'),
(207, 'Switzerland'),
(208, 'Syrian Arab Republic'),
(209, 'Taiwan, Province Of China'),
(210, 'Tajikistan'),
(211, 'Tanzania, United Republic Of'),
(212, 'Thailand'),
(213, 'Timor-Leste'),
(214, 'Togo'),
(215, 'Tokelau'),
(216, 'Tonga'),
(217, 'Trinidad And Tobago'),
(218, 'Tunisia'),
(219, 'Turkey'),
(220, 'Turkmenistan'),
(221, 'Turks And Caicos Islands'),
(222, 'Tuvalu'),
(223, 'Uganda'),
(224, 'Ukraine'),
(225, 'United Arab Emirates'),
(226, 'United Kingdom'),
(227, 'United States'),
(228, 'United States Minor Outlying Islands'),
(229, 'Uruguay'),
(230, 'Uzbekistan'),
(231, 'Vanuatu'),
(232, 'Venezuela'),
(233, 'Viet Nam'),
(234, 'Virgin Islands, British'),
(235, 'Virgin Islands, U.S.'),
(236, 'Wallis And Futuna'),
(237, 'Western Sahara'),
(238, 'Yemen'),
(239, 'Zambia'),
(240, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `courseattend`
--

CREATE TABLE `courseattend` (
  `id` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `programid` int(11) NOT NULL,
  `courseno` varchar(150) NOT NULL,
  `coursename` varchar(250) NOT NULL,
  `maxmark` int(11) NOT NULL,
  `markobtained` int(11) NOT NULL,
  `markpercent` int(11) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `dateofpost` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courseattend`
--

INSERT INTO `courseattend` (`id`, `studentid`, `programid`, `courseno`, `coursename`, `maxmark`, `markobtained`, `markpercent`, `remarks`, `dateofpost`) VALUES
(1, 7, 4, 'FC 607', 'Principles of Project Management', 100, 85, 85, 'PASSED WITH DISTINCTION', '2013-09-26'),
(2, 8, 3, 'CC 505', 'Project Practicum', 100, 55, 55, 'PASSED', '2013-09-30'),
(3, 9, 1, 'FC 607', 'Management Basics', 100, 65, 65, 'PASSED WITH DISTINCTION', '2013-09-30'),
(4, 13, 3, 'FC 610', 'Managing The Human Resources in the 21st Century', 100, 98, 98, 'PASSED WITH DISTINCTION', '2013-09-30'),
(5, 13, 3, 'FC 607', 'Principles of Project Management', 100, 65, 65, 'PASSED WITH DISTINCTION', '2013-09-30'),
(6, 13, 3, 'FC 608', 'Principles of Project Management', 100, 45, 45, 'FAILED', '2013-09-30'),
(7, 13, 3, 'FC 610', 'Managing The Human Resources in the 21st Century', 100, 65, 65, 'PASSED', '2013-09-30'),
(8, 13, 3, 'CC 501', 'Principles of Project Management', 100, 69, 69, 'PASSED', '2013-09-30'),
(9, 13, 3, 'CC 502', 'Project Leadership', 100, 52, 52, 'PASSED', '2013-09-30'),
(10, 13, 3, 'FC 607', 'Principles of Project Management', 100, 78, 78, 'PASSED', '2013-09-30'),
(11, 13, 3, 'CC 503', 'Project Best Practices - I', 100, 49, 49, 'PASSED', '2013-09-30'),
(12, 13, 3, 'CC 504', 'Project Best Practices - II', 100, 65, 65, 'PASSED WITH DISTINCTION', '2013-09-30'),
(13, 13, 3, 'CC 505', 'Project Practicum', 100, 88, 88, 'PASSED WITH DISTINCTION', '2013-09-30'),
(14, 14, 1, 'FC 607', 'Principles of Project Management', 100, 40, 40, 'FAILED', '2013-09-30'),
(15, 7, 4, 'FC 608', 'Basics of Economics and Statistics', 100, 75, 75, 'PASSED', '2013-10-01'),
(16, 17, 3, 'FC 607', 'Principles of Project Management', 100, 68, 68, 'PASSED', '2013-10-01'),
(17, 17, 3, 'FC 608', 'Basics of Economics and Statistics', 100, 78, 78, 'PASSED WITH DISTINCTION', '2013-10-01'),
(18, 7, 4, 'FC 609', 'Fundamentals of Accounting & Strategic Financial Management', 100, 90, 90, 'PASSED WITH DISTINCTION', '2013-10-01'),
(19, 18, 2, 'FC 607', 'Principles of Project Management', 100, 85, 85, 'PASSED WITH DISTINCTION', '2013-10-02'),
(20, 18, 2, 'FC 608', 'Basics of Economics and Statistics', 100, 90, 90, 'PASSED WITH DISTINCTION', '2013-10-02'),
(21, 13, 3, 'FC 609', 'Fundamentals of Accounting & Strategic Financial Management', 100, 60, 60, 'PASSED', '2013-10-03'),
(22, 13, 3, 'FC 611', 'Effective Marketing & Basic Selling Skills', 100, 77, 77, 'PASSED WITH DISTINCTION', '2013-10-03'),
(23, 19, 3, 'CC 501', 'Principles of Project Management', 100, 66, 66, 'PASSED', '2013-10-03'),
(24, 19, 3, 'CC 502', 'Project Leadership', 100, 80, 80, 'PASSED WITH DISTINCTION', '2013-10-03'),
(25, 19, 3, 'FC 607', 'Management Basics', 100, 66, 66, 'PASSED', '2013-10-07'),
(26, 19, 3, 'FC 608', 'Basics of Economics and Statistics', 100, 55, 55, 'FAILED', '2013-10-07'),
(27, 19, 3, 'FC 609', 'Fundamentals of Accounting & Strategic Financial Management', 100, 0, 0, 'EXEMPTED', '2013-10-07'),
(28, 19, 3, 'FC 610', 'Managing The Human Resources in the 21st Century', 100, 0, 0, 'EXEMPTED', '2013-10-07'),
(29, 19, 3, 'FC 611', 'Effective Marketing & Basic Selling Skills', 100, 0, 0, 'EXEMPTED', '2013-10-07'),
(30, 19, 3, 'CC 503', 'Project Best Practices - I', 100, 80, 80, 'PASSED WITH DISTINCTION', '2013-10-07'),
(31, 19, 3, 'CC 504', 'Project Best Practices - II', 100, 69, 69, 'PASSED', '2013-10-07'),
(32, 19, 3, 'CC 505', 'Project Practicum', 100, 75, 75, 'PASSED', '2013-10-07'),
(33, 8, 3, 'CC 504', 'Project Best Practices - II', 100, 65, 65, 'PASSED', '2013-10-07'),
(34, 8, 3, 'CC 503', 'Project Best Practices - I', 100, 67, 67, 'PASSED', '2013-10-07'),
(35, 8, 3, 'CC 502', 'Project Leadership', 100, 70, 70, 'PASSED', '2013-10-07'),
(36, 8, 3, 'CC 501', 'Principles of Project Management', 100, 75, 75, 'PASSED', '2013-10-07');

-- --------------------------------------------------------

--
-- Table structure for table `coursedet`
--

CREATE TABLE `coursedet` (
  `id` int(11) NOT NULL,
  `courseno` varchar(150) NOT NULL,
  `coursename` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coursedet`
--

INSERT INTO `coursedet` (`id`, `courseno`, `coursename`) VALUES
(1, 'FC 607', 'Management Basics'),
(2, 'FC 608', 'Basics of Economics and Statistics'),
(3, 'FC 609', 'Fundamentals of Accounting & Strategic Financial Management'),
(4, 'FC 610', 'Managing The Human Resources in the 21st Century'),
(5, 'FC 611', 'Effective Marketing & Basic Selling Skills'),
(6, 'CC 501', 'Principles of Project Management'),
(7, 'CC 502', 'Project Leadership'),
(8, 'CC 503', 'Project Best Practices - I'),
(9, 'CC 504', 'Project Best Practices - II'),
(10, 'CC 505', 'Project Practicum');

-- --------------------------------------------------------

--
-- Table structure for table `experiance`
--

CREATE TABLE `experiance` (
  `id` int(11) NOT NULL,
  `studentid` varchar(50) NOT NULL,
  `institutename` varchar(250) NOT NULL,
  `designation` varchar(150) NOT NULL,
  `periodfrom` varchar(50) NOT NULL,
  `periodto` varchar(50) NOT NULL,
  `natureofwork` varchar(150) NOT NULL,
  `posteddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fee_details`
--

CREATE TABLE `fee_details` (
  `id` int(11) NOT NULL,
  `studentid` varchar(50) NOT NULL,
  `programid` varchar(50) NOT NULL,
  `payable` double NOT NULL,
  `paid` double NOT NULL,
  `balance` double NOT NULL,
  `modeofpay` varchar(250) NOT NULL,
  `modedet` varchar(250) NOT NULL,
  `installmentno` varchar(50) NOT NULL,
  `paiddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_details`
--

INSERT INTO `fee_details` (`id`, `studentid`, `programid`, `payable`, `paid`, `balance`, `modeofpay`, `modedet`, `installmentno`, `paiddate`) VALUES
(1, '1', '3', 75000, 0, 75000, 'Cash', '', '1', '2014-03-14');

-- --------------------------------------------------------

--
-- Table structure for table `logindet`
--

CREATE TABLE `logindet` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(250) NOT NULL,
  `usrtype` varchar(250) NOT NULL,
  `password` varchar(150) NOT NULL,
  `createddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logindet`
--

INSERT INTO `logindet` (`id`, `username`, `email`, `usrtype`, `password`, `createddate`) VALUES
(1, 'admin', 'director@rimsr.in', 'Super Admin', '64a4badc3b557e7c8e6bd604f30a1cc0', '2013-08-30');

-- --------------------------------------------------------

--
-- Table structure for table `programdet`
--

CREATE TABLE `programdet` (
  `id` int(11) NOT NULL,
  `programname` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programdet`
--

INSERT INTO `programdet` (`id`, `programname`) VALUES
(1, 'MBA - Online'),
(2, 'MBA - On-CAMPUS'),
(3, 'PGDPM'),
(4, 'Study Abroad'),
(5, 'Other'),
(6, 'DPM');

-- --------------------------------------------------------

--
-- Table structure for table `provisional`
--

CREATE TABLE `provisional` (
  `id` int(11) NOT NULL,
  `admissionno` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `programid` int(11) NOT NULL,
  `dateofissue` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provisional`
--

INSERT INTO `provisional` (`id`, `admissionno`, `studentid`, `programid`, `dateofissue`) VALUES
(100, 0, 0, 0, '2013-09-23'),
(101, 12345, 3, 2, '2013-09-23'),
(102, 516027, 5, 1, '2013-09-23'),
(103, 931902, 19, 3, '2013-10-03');

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `receiptno` int(11) NOT NULL,
  `admissionno` varchar(250) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `programid` int(11) NOT NULL,
  `payable` double NOT NULL,
  `paid` double NOT NULL,
  `balance` double NOT NULL,
  `dateofpay` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`receiptno`, `admissionno`, `firstname`, `middlename`, `lastname`, `gender`, `programid`, `payable`, `paid`, `balance`, `dateofpay`) VALUES
(1, '12345', 'PANDURANGAN', '', '', '', 2, 5000, 3000, 2000, '2013-09-18'),
(2, '931902', 'PANKAJ', 'A', 'SHARMA', 'Male', 3, 65000, 45000, 20000, '2013-10-03'),
(3, '931902', 'PANKAJ', 'A', 'SHARMA', 'Male', 3, 65000, 45000, 20000, '2013-10-03'),
(4, '931902', 'PANKAJ', 'A', 'SHARMA', 'Male', 3, 65000, 45000, 20000, '2013-10-03'),
(5, '802369', 'AKSHARA', 'V', 'MAHESHWARI', 'Female', 2, 23000, 23000, 0, '2013-10-03'),
(6, '802369', 'AKSHARA', 'V', 'MAHESHWARI', 'Female', 2, 23000, 23000, 0, '2013-10-03'),
(7, '931902', 'PANKAJ', 'A', 'SHARMA', 'Male', 3, 65000, 45000, 20000, '2013-10-03'),
(8, '931902', 'PANKAJ', 'A', 'SHARMA', 'Male', 3, 65000, 45000, 20000, '2013-10-03'),
(9, '12345', 'PANDURANGAN', '', 'P', 'Male', 2, 5000, 3000, 2000, '2013-10-03'),
(10, '12345', 'PANDURANGAN', '', 'P', 'Male', 2, 5000, 3000, 2000, '2013-10-03'),
(11, '063608', 'RADHIKA', 'M', 'NAIR', 'Female', 3, 65000, 65000, 0, '2013-10-03'),
(12, '063608', 'RADHIKA', 'M', 'NAIR', 'Female', 3, 65000, 65000, 0, '2013-10-03'),
(13, '063608', 'RADHIKA', 'M', 'NAIR', 'Female', 3, 65000, 65000, 0, '2013-10-03'),
(14, '063608', 'RADHIKA', 'M', 'NAIR', 'Female', 3, 65000, 65000, 0, '2013-10-07'),
(15, '063608', 'RADHIKA', 'M', 'NAIR', 'Female', 3, 65000, 65000, 0, '2013-10-07'),
(16, '931902', 'PANKAJ', 'A', 'SHARMA', 'Male', 3, 65000, 65000, 0, '2013-10-08'),
(17, '931902', 'PANKAJ', 'A', 'SHARMA', 'Male', 3, 65000, 65000, 0, '2013-10-08'),
(18, '931902', 'PANKAJ', 'A', 'SHARMA', 'Male', 3, 65000, 65000, 0, '2013-10-08');

-- --------------------------------------------------------

--
-- Table structure for table `scholistic`
--

CREATE TABLE `scholistic` (
  `id` int(11) NOT NULL,
  `studentid` varchar(50) NOT NULL,
  `programid` varchar(50) NOT NULL,
  `assignment` int(11) NOT NULL,
  `casestudies` int(11) NOT NULL,
  `testmark` int(11) NOT NULL,
  `exam` int(11) NOT NULL,
  `totalmark` int(11) NOT NULL,
  `attempt` int(11) NOT NULL,
  `examdate` date NOT NULL,
  `posteddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_edu_details`
--

CREATE TABLE `student_edu_details` (
  `id` int(11) NOT NULL,
  `studentid` varchar(50) NOT NULL,
  `course` varchar(150) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `institute` varchar(350) NOT NULL,
  `university` varchar(300) NOT NULL,
  `classaward` varchar(150) NOT NULL,
  `yearofpassing` varchar(50) NOT NULL,
  `posteddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_edu_details`
--

INSERT INTO `student_edu_details` (`id`, `studentid`, `course`, `subject`, `institute`, `university`, `classaward`, `yearofpassing`, `posteddate`) VALUES
(1, '1', 'SSLC', 'English, Gujarati, Mathematics, Social Science', 'Govt of Gujarat', 'Govt of Gujarat', 'First Class', '2000', '2014-03-14'),
(2, '1', 'Graduation', 'Instrumentation and Control', 'National Institute Of Technology, Tiruchirapalli', 'National Institute of Technology', 'First Division', '2007', '2014-03-14'),
(3, '1', 'Post Graduation', 'Power Systems', 'The University Of Western Australia', 'The University Of Western Australia', 'First Division', '2012', '2014-03-14'),
(4, '1', 'Others', 'Management', 'Indian Institute of Management, Kashipur', 'Indian Institute of Management, Kashipur', '', '2013', '2014-03-14');

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `id` int(11) NOT NULL,
  `admissionno` varchar(50) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `middlename` varchar(150) NOT NULL,
  `postaladdress` varchar(300) NOT NULL,
  `postalcity` varchar(150) NOT NULL,
  `postalstate` varchar(100) NOT NULL,
  `postalpin` int(25) NOT NULL,
  `peraddress` varchar(300) NOT NULL,
  `percity` varchar(150) NOT NULL,
  `perstate` varchar(100) NOT NULL,
  `perpin` int(25) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `emailid` varchar(250) NOT NULL,
  `dob` date NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `community` varchar(20) NOT NULL,
  `panno` varchar(50) NOT NULL,
  `aadharno` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `passportno` varchar(150) NOT NULL,
  `placeofissue` varchar(150) NOT NULL,
  `dateofissue` varchar(15) NOT NULL,
  `validupto` varchar(15) NOT NULL,
  `gaurdianname` varchar(150) NOT NULL,
  `gaurdianaddress` text NOT NULL,
  `fcity` varchar(150) NOT NULL,
  `fstate` varchar(150) NOT NULL,
  `fpin` int(11) NOT NULL,
  `gaurdianphone` varchar(25) NOT NULL,
  `gaurdianemail` varchar(250) NOT NULL,
  `maritialstatus` varchar(50) NOT NULL,
  `image` varchar(150) NOT NULL,
  `sslccertificate` varchar(250) NOT NULL,
  `degreecertificate` varchar(250) NOT NULL,
  `addrproof` varchar(250) NOT NULL,
  `communitycertificate` varchar(250) NOT NULL,
  `dateofregister` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`id`, `admissionno`, `firstname`, `lastname`, `middlename`, `postaladdress`, `postalcity`, `postalstate`, `postalpin`, `peraddress`, `percity`, `perstate`, `perpin`, `phone`, `mobile`, `emailid`, `dob`, `nationality`, `community`, `panno`, `aadharno`, `gender`, `passportno`, `placeofissue`, `dateofissue`, `validupto`, `gaurdianname`, `gaurdianaddress`, `fcity`, `fstate`, `fpin`, `gaurdianphone`, `gaurdianemail`, `maritialstatus`, `image`, `sslccertificate`, `degreecertificate`, `addrproof`, `communitycertificate`, `dateofregister`) VALUES
(1, '934228', 'KUNAL', ' DELWADIA', 'ABHILASHBHAI ', 'S-5 Hostel No 3 Indian Institute of Management Kashipur Udham Singh Nagar', 'Kashipur', 'Uttarakhand', 244713, '1, Spanadan, Apartment 132 Near Railway Over-Bridge Satellite Ring Road', 'Ahmedabad', 'Gujarath', 380015, '0792-6766092', '+918191898029', 'kunal.pgp2013@iimkashipur.ac.in', '0000-00-00', 'India', 'SC', 'AJGPD8882N', '', 'Male', 'G6017016', 'Ahmedabad', '--3/12/2007', '--4/12/2017', 'Abhilash Delwadia', '1, Spanadan, Apartment 132 Near Railway Over-Bridge Satellite Ring Road', 'Ahmedabad', 'Gujarath', 380015, '07926766092', 'Abhilashdelwadia@gmail.com', 'MARRRIED', '', '1Kunal_Degree_Marks_Card.pdf', '1Kunal_Degree_Certificate.pdf', '1Kunal_pass-port.pdf', '1Caste Certificate.pdf', '2014-03-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission_details`
--
ALTER TABLE `admission_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countrylist`
--
ALTER TABLE `countrylist`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `courseattend`
--
ALTER TABLE `courseattend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coursedet`
--
ALTER TABLE `coursedet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experiance`
--
ALTER TABLE `experiance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_details`
--
ALTER TABLE `fee_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logindet`
--
ALTER TABLE `logindet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programdet`
--
ALTER TABLE `programdet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provisional`
--
ALTER TABLE `provisional`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`receiptno`);

--
-- Indexes for table `scholistic`
--
ALTER TABLE `scholistic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_edu_details`
--
ALTER TABLE `student_edu_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admission_details`
--
ALTER TABLE `admission_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countrylist`
--
ALTER TABLE `countrylist`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `courseattend`
--
ALTER TABLE `courseattend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `coursedet`
--
ALTER TABLE `coursedet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `experiance`
--
ALTER TABLE `experiance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_details`
--
ALTER TABLE `fee_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logindet`
--
ALTER TABLE `logindet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `programdet`
--
ALTER TABLE `programdet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `provisional`
--
ALTER TABLE `provisional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `receiptno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `scholistic`
--
ALTER TABLE `scholistic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_edu_details`
--
ALTER TABLE `student_edu_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
