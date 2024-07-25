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
-- Database: `rimsrcsp_rimsrgame`
--

-- --------------------------------------------------------

--
-- Table structure for table `basicinfo`
--

CREATE TABLE `basicinfo` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `username` varchar(150) NOT NULL,
  `profession` varchar(200) NOT NULL,
  `industry_type` varchar(150) NOT NULL,
  `proposed_size` varchar(150) NOT NULL,
  `proposed_activity` varchar(500) NOT NULL,
  `constitution` varchar(150) NOT NULL,
  `manufacture_details` longtext NOT NULL,
  `rawmaterial_details` longtext NOT NULL,
  `sales_strategy` mediumtext NOT NULL,
  `manufacture_process` longtext NOT NULL,
  `estimate_cost` float(10,2) NOT NULL,
  `licensing_fee` float(10,2) NOT NULL,
  `land` float(10,2) NOT NULL COMMENT 'Land Cost',
  `build` float(10,2) NOT NULL COMMENT 'Building Cost',
  `plant` float(10,2) NOT NULL COMMENT 'Plant Machinery',
  `furniture` float(10,2) NOT NULL COMMENT 'Furniture Fitting',
  `preexp` float(10,2) NOT NULL COMMENT 'Preliminary Expenses',
  `techfee` float(10,2) NOT NULL COMMENT 'Fee For Technical Know-How',
  `sexp` float(10,2) NOT NULL COMMENT 'Start-Up Expenses',
  `rd` float(10,2) NOT NULL COMMENT 'R & D / Innovation',
  `promoter_stake` float(10,2) NOT NULL,
  `termloan_nom` int(11) NOT NULL,
  `termloan_interest` float(10,2) NOT NULL,
  `dateofstart` datetime NOT NULL,
  `dateofupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `basicinfo`
--

INSERT INTO `basicinfo` (`id`, `userid`, `payment_id`, `currency`, `username`, `profession`, `industry_type`, `proposed_size`, `proposed_activity`, `constitution`, `manufacture_details`, `rawmaterial_details`, `sales_strategy`, `manufacture_process`, `estimate_cost`, `licensing_fee`, `land`, `build`, `plant`, `furniture`, `preexp`, `techfee`, `sexp`, `rd`, `promoter_stake`, `termloan_nom`, `termloan_interest`, `dateofstart`, `dateofupdate`) VALUES
(1, 4, 2, 'rupee', 'GFFGK', 'KFHJHGJLH', 'Manufacturing', 'Medium', 'JDKFLHGFLIJ', 'Proprietary', 'JGFDJHGHJKJK;', 'LGHOHO;K;L;', 'GFLGLJHK;LLP\'', 'GFDHGJLHK;', 1000000.00, 50000.00, 100000.00, 150000.00, 300000.00, 50000.00, 50000.00, 80000.00, 60000.00, 60000.00, 50.00, 12, 12.00, '2018-09-04 07:40:18', '2018-09-04 08:03:15'),
(2, 6, 4, 'rupee', 'ABCD', 'WATER PURIFICATION', 'Manufacturing', 'Tiny', 'BOTTLED WATER', 'Proprietary', 'JS;AKKJL;\';;', 'JHGJKHKLJJK', '789786JHGJJN', 'HGJHKKLLKL', 5000000.00, 250000.00, 500000.00, 750000.00, 1500000.00, 250000.00, 250000.00, 400000.00, 300000.00, 300000.00, 50.00, 60, 12.00, '2018-09-28 06:41:25', '2018-09-28 06:54:51'),
(3, 3, 1, 'rupee', 'DSFDG', 'SDFGSDF', 'Manufacturing', 'Tiny', 'SFDGDS', 'Private Limited', 'SDFGSDF', 'SDFGSFD', 'SDFGFSGFD', 'TYETERSF', 500000.00, 25000.00, 50000.00, 75000.00, 150000.00, 25000.00, 25000.00, 40000.00, 30000.00, 30000.00, 55.00, 12, 9.00, '2018-09-28 13:17:46', '2018-09-28 13:18:14'),
(4, 7, 5, 'rupee', 'Train to Prosper Training Services', 'Sales Infrastructure Sales Coaching Digital Marketing', 'Technology', 'Small', 'Sales & Service', 'Partnership', 'Software (Sales Infrastructure) that will enable us to coach and create Sales Experts and Digital Marketing Technology using which we will be able to market generate leads for any business.', 'computer systems technology stacks and skilled manpower ', '1. Conduct seminars to create awareness about sales mastery program.\r\n2. Enroll participants who were impressed by the Seminar to Sales Mastery Program.\r\n3. Mould Sales Experts through Sales Mastery Program.\r\n4. Use the Sales Infrastructure Digital Marketing Infrastructure & Sales Experts to achieve various business goals for my own organization and other organizations.  ', '1. Things to manufacture:  a. Sales Infrastructure Software (Convert the sales principle discussed in my book POSITIVE SELLING to Sales Infrastructure Software & \r\nb. Digital Marketing Software (a mechanism that is able to market & generate leads for any product or service in the required quantity)\r\nManufacturing Process: Recruit a tech team including experts and freshers and use them to develop these two products.', 27000000.00, 1350000.00, 2700000.00, 4050000.00, 8100000.00, 1350000.00, 1350000.00, 2160000.00, 1620000.00, 1620000.00, 35.00, 60, 22.00, '2019-01-22 07:44:00', '2019-01-22 07:54:32'),
(5, 11, 6, 'rupee', 'ABC AQUA', 'WATER TREATMENT', 'Manufacturing', 'Tiny', 'BOTTLED WATER', 'Proprietary', 'Potable water is an essential requirement in day-to-day life. While accessibility to pure drinking water at homes is not an issue supply of potable water is an issue in offices and in our travel. However with the availability of technology for treatment and manufacture of potable of water the scenario is dramatically changed.  Today with increased awareness about hygiene even if we miss out anything we do not forget to carry our water bottle when we travel.  Now with the availability of drinking water in bottles or jars in nook and corner it is no more necessary for us to carry drinking water along with us in our travel or elsewhere.  Thus â€œdrinking water industryâ€ is growing in double digit figure year on year and the demand for the product is increasing manifold in all parts of the country. ', '(1) Water Treatment Plant\r\n(2) Tube well\r\n(3) Pouch Packing Machine\r\n(4) Tap Dispenser and\r\n(5) Laboratory Equipment and others. \r\n', 'Making available pure drinking water to every person is an immediate necessity and a challenge.  Though multi-national companies like PEPSI (in the brand name of AQUAFINA) COCACOLA (in the brand name of KINLEY) PARLE INDIA (in the brand name of BISLERI) have huge manufacturing plants to manufacture drinking water together these three giants make up only 16% of the requirement.  \r\nSecondly with the rise in literacy in the country and awareness on hygiene more and more people understand the necessity for pure drinking water.  Importantly in a sample study conducted by \"ABC AQUA\" in five southern districts of Karnataka state it is estimated that the demand out-strips the supply.  As against the demand for 14 million bottles a day (mbd) the supply is 7.2 million mbd leaving a gap of 6.8 mbd. Considering that a medium-sized unit can manufacture around 300000 bottles of drinking water a day it is nowhere near the required number.  Thus the available market is huge and there is a huge opportunity for more manufacturing units to come-up in this sector.  \r\nConsidering the supply-demand mismatch where the demand is over-shooting the supply many times; the ABC AQUA decided to enter this segment.  \r\nMoreover the need for mid-sized and small units is more feasible as the cost of manufacture is substantially low in view of less overhead costs as compared to the manufacturing costs incurred by behemoths like COCA-COLA & PEPSI.\r\nThe marketing/sales strategy of the project on hand is to competitively price our product through cost controls.  The USP of ABC AQUA is to make available good quality packaged drinking water at a low price band and reach maximum number of consumers.  Instead of heavily relying on expensive advertisements and publicity campaigns ABC AQUA will focus on attractive pricing and making available ISI certified drinking water in nook and corner of Karnataka State through extensive dealer network.  Dealers will be adequately educated about the strengths of our product and the dealer commission will also be made attractive.  Instead of our company enjoying maximum revenue the dealers will be the first to get the most.\r\n', 'Treatment for drinking water production involves the removal of contaminants from raw water to produce water that is pure enough for human consumption without any short term or long term risks or any adverse effect on health.  Substances that are removed during the process of drinking water treatment include suspended solids harmful bacteria algae viruses fungi and heavy metals like mercury iron and manganese.\r\nThe processes involved in removing the contaminants include physical processes such as settling and filtration chemical processes.  The manufacturing process involves the following:\r\n1. Pre-chlorination for algae control and arresting biological growth.\r\n2. Aeration along with pre-chlorination for removal of dissolved mercury iron manganese and other metals.  \r\n3. Coagulation for flocculation or slow-sand filtration.\r\n4. Coagulant aids also known as polyelectrolytes â€“ to improve coagulation and for more robust flack formation.\r\n5. Sedimentation for solids separation that is removal of suspended solids trapped in the flack.\r\n6. Filtration to remove particles from water either by passage through a sand bed that can be washed and reused or by passage through a purpose designed filter that may be washable.\r\n7. Disinfection for killing harmful bacteria and other pathogens.\r\nTechnology for manufacture of potable water is well developed and standardized.  Generalized designs are available from which treatment processes can be selected for pilot testing on the specific water source. In addition a number of private companies provide patented technological solutions for treatment of specific contaminants. \r\n', 5000000.00, 250000.00, 500000.00, 750000.00, 1500000.00, 250000.00, 250000.00, 400000.00, 300000.00, 300000.00, 50.00, 60, 12.00, '2019-04-02 16:35:21', '2019-04-02 16:40:55'),
(6, 13, 7, 'rupee', 'ABC PHARMA', 'PHARMACOLOGY', 'Manufacturing', 'Small', 'MANUFACTURE OF ANTI-BIOTICS', 'Proprietary', 'JDF\'ANNFA\'  KLASKJ\'\' FKL\'\'LA', ';AKJJKA; F;JAJF', 'AJK;JFJ FJ;LJD', 'AF\'KFLA FKA\';', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, '2019-04-30 09:25:29', '2019-04-30 09:25:41'),
(7, 26, 0, 'rupee', 'KLE VK IDS', 'Dentistry', 'Services', 'Medium', 'Patient care', 'Private Limited', 'Dental care', 'instruments purchase from dealer\'s', 'public', 'self', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, '2020-09-03 05:33:33', '2020-09-03 05:33:33'),
(8, 27, 0, 'rupee', 'SKILLSertifika Global ', 'Edutech', 'Services', 'Small', 'Online Session', 'Private Limited', 'International Certification Program ', 'We need contents and faculty to deliver ', 'Digital Media  webinar  workshops seminar global partners and alliances', 'Online Delivery of courses', 3000000.00, 150000.00, 300000.00, 450000.00, 900000.00, 150000.00, 150000.00, 240000.00, 180000.00, 180000.00, 100.00, 0, 0.00, '2020-09-11 07:18:49', '2020-09-11 07:20:52'),
(9, 32, 0, 'rupee', 'Littlemorelight consulting private limited', 'Engineering Solution', 'Manufacturing', 'Small', 'Manufacturing Aero components', 'Private Limited', 'We have planned to Mannufacture and Assemble Aero component Brackets and nutplates. It is the small component of Aerospance which is majorly using in wings and frame of an aeroplane.', 'We need aluminium Composite Titanium and Steel raw materials for the manufacturing of brackets. We are planning to implementation of the government\'s mobilization policy and change in raw material supply was introduced to describe its influence to emergency material production capacity. ', 'We are planning to build a stronger marketing strategy for our engineering company with these six engineering marketing strategies. Search engine optimization or SEO is one of the best ways to improve our engineering companyâ€™s online visibility. We are planning to invest in pay-per-click advertising(ppc) and creating quality content.', 'The process is Metal forming initially flat sheet is able to be formed into different shapes by using shaped tools. Other important processes are required is Blanking and piercing Bending Stretching Extrusion Die forming etc.', 8000000.00, 400000.00, 800000.00, 1200000.00, 2400000.00, 400000.00, 400000.00, 640000.00, 480000.00, 480000.00, 0.00, 60, 13.00, '2020-11-03 01:02:39', '2020-11-03 01:16:13'),
(10, 33, 0, 'rupee', 'tyruyku', 'tw5ergi', 'Manufacturing', 'Tiny', 'rgfdsav', 'Proprietary', 'rewqfdas', '4rqaqaqaqaqaqa3', '4tgefw', 'yipuoo', 111011.00, 5550.54, 11101.09, 16651.64, 33303.29, 5550.54, 5550.54, 8880.88, 6660.66, 6660.66, 80.00, 60, 10.00, '2020-11-12 01:13:09', '2020-11-12 01:15:00'),
(11, 34, 0, 'rupee', 'elevensoft', 'web service', 'Services', 'Small', 'service', 'Private Limited', 'web service', 'server', 'online marketing', 'development', 500000.00, 25000.00, 50000.00, 75000.00, 150000.00, 25000.00, 25000.00, 40000.00, 30000.00, 30000.00, 12.00, 48, 0.00, '2020-11-12 08:41:41', '2020-11-12 08:43:07'),
(12, 37, 0, 'rupee', 'xcxcxcxxc', 'gvn', 'Manufacturing', 'Tiny', 'dfd', 'Proprietary', 'jhg', 'gjhgj', 'jhghj', 'jjhgjh', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, '2020-11-17 04:46:48', '2020-11-17 04:46:56'),
(13, 36, 0, 'rupee', 'rest', 'test', 'Manufacturing', 'Tiny', 'test', 'Private Limited', 'tset', 'ets', 'est', 'ste', 1500000.00, 75000.00, 150000.00, 225000.00, 450000.00, 75000.00, 75000.00, 120000.00, 90000.00, 90000.00, 0.00, 0, 0.00, '2020-11-17 05:53:12', '2020-11-17 05:53:21'),
(14, 46, 0, 'dollar', 'INCLUSION GLOBAL CONSULTING', 'EDUCATION AND MANAGEMENT', 'Services', 'Small', 'PROVISION OF PROFESSIONAL COURSES', 'Private Limited', 'Use trusted online training platforms to offer professional courses in best learning conditions and pricing', 'Courses licenses', 'Meeting Executives in businesses and Education sector send prospective letters use media', 'Negotiate courses with overseas partners Engage potential learners Onboard learners Receive payment', 1000.00, 50.00, 100.00, 150.00, 300.00, 50.00, 50.00, 80.00, 60.00, 60.00, 100.00, 0, 0.00, '2021-08-15 08:19:35', '2021-08-15 08:26:34'),
(15, 52, 0, 'rupee', 'gkjhhkkl;lk', 'kfhjjkklk;l', 'Manufacturing', 'Small', 'gkyhlk;klpl', 'Proprietary', 'uikl;l[;\'\r\n][-oo', 'uyuiioo', 'uiupiookpp', 'iojopop[', 1000000.00, 50000.00, 100000.00, 150000.00, 300000.00, 50000.00, 50000.00, 80000.00, 60000.00, 60000.00, 50.00, 60, 10.00, '2021-12-15 22:41:08', '2021-12-15 22:46:38'),
(16, 58, 0, 'dollar', 'r', 'acc', 'Manufacturing', 'Small', 'acc', 'Public Limited', 'r3', 'raw', 'r', 'ra', 11.00, 0.55, 111.00, 1.65, 3.30, 0.55, 0.55, 0.88, 0.66, 0.66, 0.00, 0, 0.00, '2022-02-07 20:08:52', '2022-02-07 20:09:49'),
(17, 59, 0, 'rupee', 'skill_aura', 'edu', 'Services', 'Small', 'training', 'Proprietary', 'trainings', 'Trainings trainers students', 'B2B', 'NA', 500000.00, 25000.00, 50000.00, 75000.00, 150000.00, 25000.00, 25000.00, 40000.00, 30000.00, 30000.00, 0.00, 36, 12.00, '2022-03-01 15:46:18', '2022-03-01 15:47:24');

-- --------------------------------------------------------

--
-- Table structure for table `directcost`
--

CREATE TABLE `directcost` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `power` float(10,2) NOT NULL COMMENT 'Power Charges',
  `water` float(10,2) NOT NULL COMMENT 'Water Charges',
  `training` float(10,2) NOT NULL COMMENT 'Training for Skilled Personnel',
  `transport` float(10,2) NOT NULL COMMENT 'Transport Cost',
  `dateofstart` datetime NOT NULL,
  `dateofupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `directcost`
--

INSERT INTO `directcost` (`id`, `userid`, `payment_id`, `power`, `water`, `training`, `transport`, `dateofstart`, `dateofupdate`) VALUES
(1, 4, 2, 10000.00, 8000.00, 5000.00, 6000.00, '2018-09-04 08:03:24', '2018-09-04 08:03:24'),
(2, 6, 4, 10000.00, 8000.00, 5000.00, 8000.00, '2018-09-28 06:55:37', '2018-09-28 06:55:37'),
(3, 3, 1, 500.00, 1500.00, 2500.00, 1500.00, '2018-09-28 13:20:30', '2018-09-28 13:20:30'),
(4, 7, 5, 240000.00, 60000.00, 225000.00, 300000.00, '2019-01-22 08:08:14', '2019-01-22 08:08:14'),
(5, 11, 6, 0.00, 0.00, 0.00, 0.00, '2019-04-02 16:47:51', '2019-04-02 16:47:51'),
(6, 13, 7, 0.00, 0.00, 0.00, 0.00, '2019-04-30 09:25:51', '2019-04-30 09:25:51'),
(7, 32, 0, 0.00, 0.00, 0.00, 0.00, '2020-11-03 01:11:43', '2020-11-03 01:11:43'),
(8, 37, 0, 0.00, 0.00, 0.00, 0.00, '2020-11-17 04:47:03', '2020-11-17 04:47:03'),
(9, 46, 0, 0.00, 0.00, 0.00, 0.00, '2021-08-15 08:45:58', '2021-08-15 08:45:58'),
(10, 52, 0, 10000.00, 2000.00, 5000.00, 5000.00, '2021-12-15 22:55:52', '2021-12-15 22:55:52'),
(11, 58, 0, 0.00, 0.00, 0.00, 0.00, '2022-02-07 20:10:25', '2022-02-07 20:10:25'),
(12, 59, 0, 0.00, 0.00, 0.00, 0.00, '2022-03-01 15:49:57', '2022-03-01 15:49:57');

-- --------------------------------------------------------

--
-- Table structure for table `finance_deposit_investment`
--

CREATE TABLE `finance_deposit_investment` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `wc_loan_interest` float(10,2) NOT NULL COMMENT 'Rate of Interest on Working Capital Loan (%)',
  `interest_free` float(10,2) NOT NULL COMMENT '% of Market Credit on Raw Material - Interest Free',
  `fd_bank` float(10,2) NOT NULL COMMENT 'Fixed Deposit in Banks',
  `dateofstart` datetime NOT NULL,
  `dateofupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance_deposit_investment`
--

INSERT INTO `finance_deposit_investment` (`id`, `userid`, `payment_id`, `wc_loan_interest`, `interest_free`, `fd_bank`, `dateofstart`, `dateofupdate`) VALUES
(1, 4, 2, 15.00, 30.00, 0.00, '2018-09-04 08:06:18', '2018-09-04 08:06:18'),
(2, 6, 4, 14.00, 30.00, 0.00, '2018-09-28 06:59:05', '2018-09-28 06:59:05'),
(3, 3, 1, 9.00, 2.00, 250000.00, '2018-09-28 13:21:55', '2018-09-28 13:21:55'),
(4, 7, 5, 12.00, 50.00, 500000.00, '2019-01-22 08:27:52', '2019-01-22 08:27:52'),
(5, 11, 6, 0.00, 0.00, 0.00, '2019-04-02 16:49:27', '2019-04-02 16:49:27'),
(6, 13, 7, 0.00, 0.00, 0.00, '2019-04-30 09:26:02', '2019-04-30 09:26:02'),
(7, 32, 0, 0.00, 0.00, 0.00, '2020-11-03 01:11:54', '2020-11-03 01:11:54'),
(8, 37, 0, 0.00, 0.00, 0.00, '2020-11-17 04:47:13', '2020-11-17 04:47:13'),
(9, 46, 0, 18.00, 30.00, 0.00, '2021-08-15 08:51:59', '2021-08-15 08:51:59'),
(10, 52, 0, 10.00, 10.00, 0.00, '2021-12-15 23:00:30', '2021-12-15 23:00:30'),
(11, 58, 0, 0.00, 0.00, 0.00, '2022-02-07 20:10:56', '2022-02-07 20:10:56'),
(12, 59, 0, 0.00, 0.00, 0.00, '2022-03-01 15:50:14', '2022-03-01 15:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `indirectcost`
--

CREATE TABLE `indirectcost` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `advertise` float(10,2) NOT NULL COMMENT 'Advertisement Expenses',
  `salesexp` float(10,2) NOT NULL COMMENT 'Regular Sales Expenses',
  `add_incentive` float(10,2) NOT NULL COMMENT 'Additional Incentive For Salesmen(per salesman)',
  `add_salesexp` float(10,2) NOT NULL COMMENT 'Additional Sales Expenses',
  `godown` float(10,2) NOT NULL COMMENT 'Go-Down Rent',
  `campus_cleaning` float(10,2) NOT NULL COMMENT 'Campus Cleaning Expenses',
  `business_insurance` float(10,2) NOT NULL,
  `technology_cost` float(10,2) NOT NULL,
  `food_charges` float(10,2) NOT NULL COMMENT 'Food Charges (For all Employees)',
  `entertainment_charges` float(10,2) NOT NULL COMMENT 'Entertainment Charges(For Managers)',
  `training_cost` float(10,2) NOT NULL COMMENT 'Managerial/Admin Training Cost(PP)',
  `legal_cost` float(10,2) NOT NULL COMMENT 'Legal Costs (Retention Fee)',
  `consultant_cost` float(10,2) NOT NULL COMMENT 'Consultant Costs ',
  `postal_charges` float(10,2) NOT NULL,
  `stationery` float(10,2) NOT NULL,
  `telephone_costs` float(10,2) NOT NULL,
  `printing_costs` float(10,2) NOT NULL,
  `website_costs` float(10,2) NOT NULL,
  `transport_costs` float(10,2) NOT NULL,
  `packaging` float(10,2) NOT NULL,
  `maintenance_exp` float(10,2) NOT NULL COMMENT 'Plant Maintenance Expenses',
  `miscellaneous` float(10,2) NOT NULL,
  `dateofstart` datetime NOT NULL,
  `dateofupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indirectcost`
--

INSERT INTO `indirectcost` (`id`, `userid`, `payment_id`, `advertise`, `salesexp`, `add_incentive`, `add_salesexp`, `godown`, `campus_cleaning`, `business_insurance`, `technology_cost`, `food_charges`, `entertainment_charges`, `training_cost`, `legal_cost`, `consultant_cost`, `postal_charges`, `stationery`, `telephone_costs`, `printing_costs`, `website_costs`, `transport_costs`, `packaging`, `maintenance_exp`, `miscellaneous`, `dateofstart`, `dateofupdate`) VALUES
(1, 4, 2, 10000.00, 6000.00, 5000.00, 5000.00, 10000.00, 5000.00, 4000.00, 0.00, 5000.00, 5000.00, 5000.00, 3000.00, 5000.00, 4000.00, 2000.00, 4000.00, 4000.00, 3500.00, 2000.00, 4000.00, 5000.00, 5000.00, '2018-09-04 08:05:34', '2018-09-04 08:05:34'),
(2, 6, 4, 7500.00, 5000.00, 3500.00, 2500.00, 10000.00, 7000.00, 5000.00, 0.00, 6000.00, 5000.00, 2000.00, 5000.00, 5000.00, 4000.00, 3000.00, 6000.00, 5000.00, 3500.00, 5000.00, 6000.00, 5000.00, 5000.00, '2018-09-28 06:55:42', '2018-09-28 06:55:42'),
(3, 3, 1, 500.00, 782.00, 548.00, 500.00, 1500.00, 2500.00, 5000.00, 6000.00, 2500.00, 1000.00, 2000.00, 5423.00, 2542.00, 8989.00, 248.00, 989.00, 45.00, 255.00, 525.00, 456.00, 285.00, 875.00, '2018-09-28 13:21:26', '2018-09-28 13:21:26'),
(4, 7, 5, 120000.00, 300000.00, 300000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 50000.00, 20000.00, 500000.00, 300000.00, 20000.00, 200000.00, 1920000.00, 70000.00, 300000.00, 500000.00, 0.00, 0.00, 1000000.00, '2019-01-22 08:25:47', '2019-01-22 08:25:47'),
(5, 11, 6, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2019-04-02 16:48:00', '2019-04-02 16:48:00'),
(6, 13, 7, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2019-04-30 09:25:56', '2019-04-30 09:25:56'),
(7, 32, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2020-11-03 01:11:47', '2020-11-03 01:11:47'),
(8, 37, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2020-11-17 04:47:08', '2020-11-17 04:47:08'),
(9, 46, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2021-08-15 08:50:34', '2021-08-15 08:50:34'),
(10, 52, 0, 10000.00, 4000.00, 500.00, 1000.00, 5000.00, 3500.00, 500.00, 0.00, 5000.00, 0.00, 4000.00, 0.00, 0.00, 500.00, 1000.00, 2000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2021-12-15 22:58:25', '2021-12-15 22:58:25'),
(11, 58, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2022-02-07 20:10:35', '2022-02-07 20:10:35'),
(12, 59, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2022-03-01 15:50:08', '2022-03-01 15:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `rawmaterial` float(10,2) NOT NULL COMMENT '% of Raw Material in Stock',
  `finishedgoods` float(10,2) NOT NULL COMMENT '% of Finished Goods in Stock',
  `dateofstart` datetime NOT NULL,
  `dateofupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `userid`, `payment_id`, `rawmaterial`, `finishedgoods`, `dateofstart`, `dateofupdate`) VALUES
(1, 4, 2, 0.00, 0.00, '2018-09-04 08:03:21', '2018-09-04 08:03:21'),
(2, 6, 4, 0.00, 0.00, '2018-09-28 06:55:32', '2018-09-28 06:55:32'),
(3, 3, 1, 0.00, 0.00, '2018-09-28 13:20:09', '2018-09-28 13:20:09'),
(4, 7, 5, 0.00, 0.00, '2019-01-22 08:06:15', '2019-01-22 08:06:15'),
(5, 11, 6, 0.00, 0.00, '2019-04-02 16:47:44', '2019-04-02 16:47:44'),
(6, 13, 7, 0.00, 0.00, '2019-04-30 09:25:50', '2019-04-30 09:25:50'),
(7, 32, 0, 0.00, 0.00, '2020-11-03 01:11:39', '2020-11-03 01:11:39'),
(8, 37, 0, 0.00, 0.00, '2020-11-17 04:47:01', '2020-11-17 04:47:01'),
(9, 36, 0, 0.00, 0.00, '2020-11-17 05:54:09', '2020-11-17 05:54:09'),
(10, 46, 0, 1.00, 4.00, '2021-08-15 08:45:20', '2021-08-15 08:45:20'),
(11, 52, 0, 10.00, 2.00, '2021-12-15 22:54:34', '2021-12-15 22:54:34'),
(12, 58, 0, 0.00, 0.00, '2022-02-07 20:10:18', '2022-02-07 20:10:18'),
(13, 59, 0, 0.00, 0.00, '2022-03-01 15:49:54', '2022-03-01 15:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `manpowerdet`
--

CREATE TABLE `manpowerdet` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `category` varchar(150) NOT NULL,
  `manpower` int(11) NOT NULL COMMENT 'Manpower Strength',
  `salary` float(10,2) NOT NULL COMMENT 'Monthly salary per employee',
  `welfarecost` float(10,2) NOT NULL COMMENT 'welfare cost per employee per prod. cycle',
  `incentive` float(10,2) NOT NULL COMMENT 'performance incentive  per emp. per prod. cycle',
  `bonus` float(10,2) NOT NULL COMMENT 'Bonus per emp. per prod. cycle',
  `dateofstart` datetime NOT NULL,
  `dateofupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manpowerdet`
--

INSERT INTO `manpowerdet` (`id`, `userid`, `payment_id`, `category`, `manpower`, `salary`, `welfarecost`, `incentive`, `bonus`, `dateofstart`, `dateofupdate`) VALUES
(1, 4, 2, 'Managerial Personnel', 3, 50000.00, 30000.00, 10000.00, 25000.00, '2018-09-04 07:46:01', '2018-09-04 08:03:19'),
(2, 4, 2, 'Sales Personnel', 5, 30000.00, 20000.00, 6000.00, 20000.00, '2018-09-04 07:46:01', '2018-09-04 08:03:19'),
(3, 4, 2, 'Admin Staff', 2, 20000.00, 15000.00, 3500.00, 10000.00, '2018-09-04 07:46:01', '2018-09-04 08:03:19'),
(4, 4, 2, 'Skilled Personnel', 5, 35000.00, 25000.00, 7000.00, 20000.00, '2018-09-04 07:46:01', '2018-09-04 08:03:19'),
(5, 4, 2, 'Unskilled Personnel', 2, 10000.00, 10000.00, 1500.00, 5000.00, '2018-09-04 07:46:01', '2018-09-04 08:03:19'),
(6, 6, 4, 'Managerial Personnel', 3, 50000.00, 25000.00, 20000.00, 20000.00, '2018-09-28 06:38:14', '2018-09-28 06:55:25'),
(7, 6, 4, 'Sales Personnel', 6, 35000.00, 20000.00, 10000.00, 10000.00, '2018-09-28 06:38:14', '2018-09-28 06:55:25'),
(8, 6, 4, 'Admin Staff', 3, 25000.00, 20000.00, 8000.00, 5000.00, '2018-09-28 06:38:14', '2018-09-28 06:55:25'),
(9, 6, 4, 'Skilled Personnel', 6, 35000.00, 20000.00, 10000.00, 10000.00, '2018-09-28 06:38:14', '2018-09-28 06:55:25'),
(10, 6, 4, 'Unskilled Personnel', 2, 10000.00, 20000.00, 5000.00, 3000.00, '2018-09-28 06:38:14', '2018-09-28 06:55:25'),
(11, 3, 1, 'Managerial Personnel', 2, 15000.00, 500.00, 1500.00, 2000.00, '2018-09-28 13:20:06', '2018-09-28 13:20:06'),
(12, 3, 1, 'Sales Personnel', 5, 10000.00, 450.00, 1500.00, 500.00, '2018-09-28 13:20:06', '2018-09-28 13:20:06'),
(13, 3, 1, 'Admin Staff', 2, 8000.00, 400.00, 1580.00, 2420.00, '2018-09-28 13:20:06', '2018-09-28 13:20:06'),
(14, 3, 1, 'Skilled Personnel', 25, 25000.00, 600.00, 2000.00, 2545.00, '2018-09-28 13:20:06', '2018-09-28 13:20:06'),
(15, 3, 1, 'Unskilled Personnel', 10, 6000.00, 350.00, 1000.00, 1500.00, '2018-09-28 13:20:06', '2018-09-28 13:20:06'),
(16, 7, 5, 'Managerial Personnel', 5, 30000.00, 24000.00, 30000.00, 0.00, '2019-01-22 08:05:40', '2019-01-22 08:05:40'),
(17, 7, 5, 'Sales Personnel', 25, 25000.00, 36000.00, 120000.00, 0.00, '2019-01-22 08:05:40', '2019-01-22 08:05:40'),
(18, 7, 5, 'Admin Staff', 2, 20000.00, 24000.00, 20000.00, 0.00, '2019-01-22 08:05:40', '2019-01-22 08:05:40'),
(19, 7, 5, 'Skilled Personnel', 25, 40000.00, 40000.00, 40000.00, 0.00, '2019-01-22 08:05:40', '2019-01-22 08:05:40'),
(20, 7, 5, 'Unskilled Personnel', 5, 15000.00, 24000.00, 15000.00, 0.00, '2019-01-22 08:05:40', '2019-01-22 08:05:40'),
(21, 11, 6, 'Managerial Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2019-04-02 16:47:31', '2019-04-02 16:47:31'),
(22, 11, 6, 'Sales Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2019-04-02 16:47:31', '2019-04-02 16:47:31'),
(23, 11, 6, 'Admin Staff', 0, 0.00, 0.00, 0.00, 0.00, '2019-04-02 16:47:31', '2019-04-02 16:47:31'),
(24, 11, 6, 'Skilled Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2019-04-02 16:47:31', '2019-04-02 16:47:31'),
(25, 11, 6, 'Unskilled Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2019-04-02 16:47:31', '2019-04-02 16:47:31'),
(26, 13, 7, 'Managerial Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2019-04-30 09:25:47', '2019-04-30 09:25:47'),
(27, 13, 7, 'Sales Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2019-04-30 09:25:47', '2019-04-30 09:25:47'),
(28, 13, 7, 'Admin Staff', 0, 0.00, 0.00, 0.00, 0.00, '2019-04-30 09:25:47', '2019-04-30 09:25:47'),
(29, 13, 7, 'Skilled Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2019-04-30 09:25:47', '2019-04-30 09:25:47'),
(30, 13, 7, 'Unskilled Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2019-04-30 09:25:47', '2019-04-30 09:25:47'),
(31, 32, 0, 'Managerial Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2020-11-03 01:07:36', '2020-11-03 01:16:51'),
(32, 32, 0, 'Sales Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2020-11-03 01:07:36', '2020-11-03 01:16:51'),
(33, 32, 0, 'Admin Staff', 0, 0.00, 0.00, 0.00, 0.00, '2020-11-03 01:07:36', '2020-11-03 01:16:51'),
(34, 32, 0, 'Skilled Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2020-11-03 01:07:36', '2020-11-03 01:16:51'),
(35, 32, 0, 'Unskilled Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2020-11-03 01:07:36', '2020-11-03 01:16:51'),
(36, 37, 0, 'Managerial Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2020-11-17 04:46:59', '2020-11-17 04:46:59'),
(37, 37, 0, 'Sales Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2020-11-17 04:46:59', '2020-11-17 04:46:59'),
(38, 37, 0, 'Admin Staff', 0, 0.00, 0.00, 0.00, 0.00, '2020-11-17 04:46:59', '2020-11-17 04:46:59'),
(39, 37, 0, 'Skilled Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2020-11-17 04:46:59', '2020-11-17 04:46:59'),
(40, 37, 0, 'Unskilled Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2020-11-17 04:46:59', '2020-11-17 04:46:59'),
(41, 36, 0, 'Managerial Personnel', 12, 0.00, 0.00, 0.00, 0.00, '2020-11-17 05:54:04', '2020-11-17 05:54:04'),
(42, 36, 0, 'Sales Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2020-11-17 05:54:04', '2020-11-17 05:54:04'),
(43, 36, 0, 'Admin Staff', 0, 0.00, 0.00, 0.00, 0.00, '2020-11-17 05:54:04', '2020-11-17 05:54:04'),
(44, 36, 0, 'Skilled Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2020-11-17 05:54:04', '2020-11-17 05:54:04'),
(45, 36, 0, 'Unskilled Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2020-11-17 05:54:04', '2020-11-17 05:54:04'),
(46, 46, 0, 'Managerial Personnel', 2, 40.00, 20.00, 5.00, 3.00, '2021-08-15 08:42:05', '2021-08-15 08:42:38'),
(47, 46, 0, 'Sales Personnel', 1, 30.00, 15.00, 4.00, 2.00, '2021-08-15 08:42:05', '2021-08-15 08:42:38'),
(48, 46, 0, 'Admin Staff', 2, 20.00, 10.00, 2.00, 1.00, '2021-08-15 08:42:05', '2021-08-15 08:42:38'),
(49, 46, 0, 'Skilled Personnel', 2, 40.00, 20.00, 3.00, 2.00, '2021-08-15 08:42:05', '2021-08-15 08:42:38'),
(50, 46, 0, 'Unskilled Personnel', 2, 10.00, 5.00, 1.00, 1.00, '2021-08-15 08:42:05', '2021-08-15 08:42:38'),
(51, 52, 0, 'Managerial Personnel', 5, 45000.00, 5000.00, 2500.00, 1500.00, '2021-12-15 22:53:29', '2021-12-15 22:53:29'),
(52, 52, 0, 'Sales Personnel', 7, 20000.00, 4000.00, 1500.00, 1000.00, '2021-12-15 22:53:29', '2021-12-15 22:53:29'),
(53, 52, 0, 'Admin Staff', 3, 15000.00, 4000.00, 1000.00, 500.00, '2021-12-15 22:53:29', '2021-12-15 22:53:29'),
(54, 52, 0, 'Skilled Personnel', 6, 25000.00, 5000.00, 2000.00, 1250.00, '2021-12-15 22:53:29', '2021-12-15 22:53:29'),
(55, 52, 0, 'Unskilled Personnel', 2, 5000.00, 2000.00, 500.00, 300.00, '2021-12-15 22:53:29', '2021-12-15 22:53:29'),
(56, 58, 0, 'Managerial Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2022-02-07 20:10:10', '2022-02-07 20:10:10'),
(57, 58, 0, 'Sales Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2022-02-07 20:10:10', '2022-02-07 20:10:10'),
(58, 58, 0, 'Admin Staff', 0, 0.00, 0.00, 0.00, 0.00, '2022-02-07 20:10:10', '2022-02-07 20:10:10'),
(59, 58, 0, 'Skilled Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2022-02-07 20:10:10', '2022-02-07 20:10:10'),
(60, 58, 0, 'Unskilled Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2022-02-07 20:10:10', '2022-02-07 20:10:10'),
(61, 59, 0, 'Managerial Personnel', 10, 20000.00, 0.00, 0.00, 0.00, '2022-03-01 15:49:50', '2022-03-01 15:49:50'),
(62, 59, 0, 'Sales Personnel', 2, 30000.00, 0.00, 0.00, 0.00, '2022-03-01 15:49:50', '2022-03-01 15:49:50'),
(63, 59, 0, 'Admin Staff', 1, 10000.00, 0.00, 0.00, 0.00, '2022-03-01 15:49:50', '2022-03-01 15:49:50'),
(64, 59, 0, 'Skilled Personnel', 4, 5000.00, 0.00, 0.00, 0.00, '2022-03-01 15:49:50', '2022-03-01 15:49:50'),
(65, 59, 0, 'Unskilled Personnel', 0, 0.00, 0.00, 0.00, 0.00, '2022-03-01 15:49:50', '2022-03-01 15:49:50');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `payment_amount` float(10,2) NOT NULL,
  `payment_currency` varchar(50) NOT NULL,
  `txn_id` varchar(250) NOT NULL,
  `dateoftrans` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `userid`, `purpose`, `payment_status`, `payment_amount`, `payment_currency`, `txn_id`, `dateoftrans`) VALUES
(1, 3, 'Business Game - Subscribe', 'Completed', 1.00, 'INR', '05M943688U355925X', '2018-09-28 18:36:32'),
(2, 4, 'Business Game - Subscribe', 'Completed', 1.00, 'INR', '98265624VE9964727', '2018-09-04 13:08:40'),
(3, 5, 'Business Game - Subscribe', 'Completed', 1.00, 'INR', '0JN514226T173372W', '2018-09-24 14:56:00'),
(4, 6, 'Business Game - Subscribe', 'Completed', 99.00, 'INR', '2KN49466VU9929712', '2018-09-28 12:01:13'),
(5, 7, 'Business Game - Subscribe', 'Completed', 99.00, 'INR', '81666693V2580160T', '2019-01-22 12:07:23'),
(6, 11, 'Business Game - Subscribe', 'Completed', 99.00, 'INR', '26E375191E909920A', '2019-04-02 21:54:09'),
(7, 13, 'Business Game - Subscribe', 'Completed', 99.00, 'INR', '1V286294EY2418636', '2019-04-30 14:36:25'),
(8, 39, 'Business Game - Subscribe', 'Completed', 499.00, 'INR', '0DT998223A735753N', '2021-01-29 13:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `prodinfo`
--

CREATE TABLE `prodinfo` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `installed_capacity` int(11) NOT NULL,
  `capacity_utiliz` float(10,2) NOT NULL,
  `nofday_perprod` int(11) NOT NULL,
  `work_in_progress` float(10,2) NOT NULL,
  `finishedprod_wip` float(10,2) NOT NULL,
  `dateofstart` datetime NOT NULL,
  `dateofupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodinfo`
--

INSERT INTO `prodinfo` (`id`, `userid`, `payment_id`, `installed_capacity`, `capacity_utiliz`, `nofday_perprod`, `work_in_progress`, `finishedprod_wip`, `dateofstart`, `dateofupdate`) VALUES
(1, 4, 2, 1000000, 70.00, 30, 0.00, 0.00, '2018-09-04 08:03:17', '2018-09-04 08:03:17'),
(2, 6, 4, 5000000, 70.00, 30, 0.00, 0.00, '2018-09-28 06:55:22', '2018-09-28 06:55:22'),
(3, 3, 1, 15000, 45.00, 15, 10.00, 45.00, '2018-09-28 13:18:43', '2018-09-28 13:18:43'),
(4, 7, 5, 100000, 100.00, 365, 0.00, 0.00, '2019-01-22 07:59:32', '2019-01-22 07:59:32'),
(5, 11, 6, 5000000, 75.00, 1, 0.00, 0.00, '2019-04-02 16:42:48', '2019-04-02 16:42:48'),
(6, 13, 7, 0, 0.00, 0, 0.00, 0.00, '2019-04-30 09:25:44', '2019-04-30 09:25:44'),
(7, 27, 0, 50000, 25.00, 10, 0.00, 0.00, '2020-09-11 07:21:58', '2020-09-11 07:21:58'),
(8, 32, 0, 0, 0.00, 0, 0.00, 0.00, '2020-11-03 01:16:36', '2020-11-03 01:16:36'),
(9, 34, 0, 5000, 15.00, 15, 5.00, 5.00, '2020-11-12 08:44:13', '2020-11-12 08:44:13'),
(10, 37, 0, 0, 0.00, 0, 0.00, 0.00, '2020-11-17 04:46:57', '2020-11-17 04:46:57'),
(11, 36, 0, 50000, 15.00, 15, 0.00, 0.00, '2020-11-17 05:53:44', '2020-11-17 05:53:44'),
(12, 46, 0, 100, 100.00, 300, 0.00, 0.00, '2021-08-15 08:29:04', '2021-08-15 08:29:04'),
(13, 52, 0, 100, 70.00, 50, 0.00, 0.00, '2021-12-15 22:48:02', '2021-12-15 22:48:02'),
(14, 58, 0, 0, 0.00, 0, 0.00, 0.00, '2022-02-07 20:10:01', '2022-02-07 20:10:01'),
(15, 59, 0, 100, 60.00, 5, 5.00, 20.00, '2022-03-01 15:48:57', '2022-03-01 15:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `prod_sales_cost`
--

CREATE TABLE `prod_sales_cost` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `profit_margin` float(10,2) NOT NULL COMMENT 'Profit Margin on the Cost of the Product (%)',
  `sales_discount` float(10,2) NOT NULL COMMENT 'Sales Discount (%)',
  `dateofstart` datetime NOT NULL,
  `dateofupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prod_sales_cost`
--

INSERT INTO `prod_sales_cost` (`id`, `userid`, `payment_id`, `profit_margin`, `sales_discount`, `dateofstart`, `dateofupdate`) VALUES
(1, 4, 2, 20.00, 0.00, '2018-09-04 08:09:52', '2018-09-04 08:09:52'),
(2, 6, 4, 20.00, 5.00, '2018-09-28 06:59:30', '2018-09-28 06:59:30'),
(3, 3, 1, 25.00, 6.00, '2018-09-28 13:22:27', '2018-09-28 13:22:27'),
(4, 7, 5, 70.00, 5.00, '2019-01-22 08:29:13', '2019-01-22 08:29:13'),
(5, 11, 6, 0.00, 0.00, '2019-04-02 16:49:41', '2019-04-02 16:49:41'),
(6, 13, 7, 0.00, 0.00, '2019-04-30 09:26:07', '2019-04-30 09:26:07'),
(7, 32, 0, 0.00, 0.00, '2020-11-03 01:12:01', '2020-11-03 01:12:01'),
(8, 37, 0, 0.00, 0.00, '2020-11-17 04:47:18', '2020-11-17 04:47:18'),
(9, 46, 0, 20.00, 2.00, '2021-08-15 08:57:53', '2021-08-15 08:57:53'),
(10, 52, 0, 10.00, 5.00, '2021-12-15 23:01:30', '2021-12-15 23:01:30'),
(11, 58, 0, 0.00, 0.00, '2022-02-07 20:11:12', '2022-02-07 20:11:12'),
(12, 59, 0, 0.00, 0.00, '2022-03-01 15:50:58', '2022-03-01 15:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `salesparticular`
--

CREATE TABLE `salesparticular` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `sales_target` float(10,2) NOT NULL COMMENT 'Sales Target in %',
  `sales_achieved` float(10,2) NOT NULL COMMENT 'Sales Achieved against Sales Target in %',
  `sales_cash` float(10,2) NOT NULL COMMENT 'Percentage of Sales on Cash',
  `doubtful_crsale` float(10,2) NOT NULL COMMENT 'Expected Doubtful Credit Sales in %',
  `dateofstart` datetime NOT NULL,
  `dateofupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesparticular`
--

INSERT INTO `salesparticular` (`id`, `userid`, `payment_id`, `sales_target`, `sales_achieved`, `sales_cash`, `doubtful_crsale`, `dateofstart`, `dateofupdate`) VALUES
(1, 4, 2, 70.00, 90.00, 90.00, 5.00, '2018-09-04 08:10:47', '2018-09-04 08:10:47'),
(2, 6, 4, 70.00, 90.00, 95.00, 5.00, '2018-09-28 06:59:36', '2018-09-28 06:59:36'),
(3, 3, 1, 15.00, 12.00, 45.00, 55.00, '2018-09-28 13:22:53', '2018-09-28 13:22:53'),
(4, 7, 5, 100.00, 0.00, 50.00, 5.00, '2019-01-22 08:30:45', '2019-01-22 08:30:45'),
(5, 11, 6, 0.00, 0.00, 0.00, 0.00, '2019-04-02 16:49:50', '2019-04-02 16:49:50'),
(6, 13, 7, 0.00, 0.00, 0.00, 0.00, '2019-04-30 09:26:10', '2019-04-30 09:26:10'),
(7, 32, 0, 0.00, 0.00, 0.00, 0.00, '2020-11-03 01:12:06', '2020-11-03 01:12:06'),
(8, 37, 0, 0.00, 0.00, 0.00, 0.00, '2020-11-17 04:47:23', '2020-11-17 04:47:23'),
(9, 46, 0, 80.00, 75.00, 70.00, 10.00, '2021-08-15 09:02:36', '2021-08-15 09:02:36'),
(10, 52, 0, 80.00, 100.00, 50.00, 5.00, '2021-12-15 23:02:20', '2021-12-15 23:02:20'),
(11, 58, 0, 0.00, 0.00, 0.00, 0.00, '2022-02-07 20:11:20', '2022-02-07 20:11:20'),
(12, 59, 0, 0.00, 0.00, 0.00, 0.00, '2022-03-01 15:51:02', '2022-03-01 15:51:02');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `payid` varchar(250) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `expiry` datetime NOT NULL,
  `dateoftrans` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userdet`
--

CREATE TABLE `userdet` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `emailid` varchar(250) NOT NULL,
  `phoneno` varchar(25) NOT NULL,
  `address` text NOT NULL,
  `profimg` varchar(250) NOT NULL,
  `payment` int(11) NOT NULL COMMENT 'Payment Id from payment table',
  `expiry` datetime NOT NULL,
  `secretcode` varchar(150) NOT NULL,
  `game_status` int(11) NOT NULL COMMENT '0-Not Finished,1-Finished',
  `usrtype` int(11) NOT NULL COMMENT '0 - User, 1- Admin',
  `dateofcreation` datetime NOT NULL,
  `dateofupdation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdet`
--

INSERT INTO `userdet` (`id`, `name`, `username`, `password`, `emailid`, `phoneno`, `address`, `profimg`, `payment`, `expiry`, `secretcode`, `game_status`, `usrtype`, `dateofcreation`, `dateofupdation`) VALUES
(0, 'Admin', 'rimsradmin', 'ce4b561ac963891e2c5edd0ee8fa982a', 'admin@rimsr.in', '', '', '889863Koala.jpg', 0, '0000-00-00 00:00:00', '0', 1, 1, '2016-08-01 00:00:00', '2018-08-21 17:11:34'),
(1, 'Sakthivel', 'admin', 'af15d5fdacd5fdfea300e88a8e253e82', 'info@rimsr.in', '8050126997', 'Koramangala 1st block, Bangalore', '889863Koala.jpg', 0, '0000-00-00 00:00:00', '9d7774c164e8cd2fc22b9ff58fb040cd', 0, 0, '2016-08-01 00:00:00', '2018-09-18 17:20:01'),
(2, 'Sashibhusan', 'Sashibhusan', 'qwer1234', 'sashi.pulsar220@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '2fa2e93d006cdc0c2cff0de945e438b9', 0, 0, '2018-09-03 18:19:32', '2021-05-17 14:22:23'),
(3, 'Sakthivel', 'Sakthivel', 'af15d5fdacd5fdfea300e88a8e253e82', 'sakthivel@negeninfotech.com', '', '', '', 1, '2018-09-28 21:47:23', '', 1, 0, '2018-09-03 18:33:33', '2018-09-28 13:23:20'),
(4, 'DR PAVITRA', 'DR PAVITRA', 'f02b862976de94e77ded4f7d33d0ef3c', 'sschandra@rimsr.in', '', '', '', 2, '2018-09-04 15:08:57', '', 1, 0, '2018-09-04 12:28:24', '2018-09-04 08:11:21'),
(5, 'Chandrashekar', 'Chandrashekar', 'e10adc3949ba59abbe56e057f20f883e', 'drsschandra@gmail.com', '', '', '', 3, '2018-09-27 15:34:32', '4d89b95f0f52e04aa2f35935d9692308', 0, 0, '2018-09-24 14:50:59', '2022-02-13 04:23:44'),
(6, 'Rajeshwari', 'Rajeshwari', '1dffe66d5cebfd81c5f7cae1c1b9cd8a', 'rajeshwariks2007@gmail.com', '', '', '', 4, '2018-09-28 15:01:55', '', 1, 0, '2018-09-27 12:36:15', '2018-09-28 07:00:35'),
(7, 'Martin Athanas', 'Martin Athanas', 'dd11e3e08dcac09806f1a32f9ad23487', 'martinathanas@gmail.com', '', '', '', 5, '2019-01-22 15:07:55', '', 1, 0, '2019-01-22 12:01:33', '2019-01-22 08:32:00'),
(8, 'Deepak Bijaya Padhi', 'Deepak Bijaya Padhi', 'bc308f1f7aeb0a64132d4fee2cd07493', 'deepak.padhi@yahoo.com', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2019-02-13 02:04:25', '2019-02-13 02:04:25'),
(9, 'Harsha Kestur ', 'Harsha Kestur ', 'ea6b2efbdd4255a9f1b3bbc6399b58f4', 'harsha.kestur@outlook.com', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2019-02-20 20:24:40', '2019-02-20 20:24:40'),
(10, 'Gourab', 'Gourab', 'e10adc3949ba59abbe56e057f20f883e', 'gourab.banerjee20@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2019-03-10 01:27:47', '2019-03-10 01:27:47'),
(11, 'ERNIE BAKER', 'ERNIE BAKER', '120e98b114e5de92281d3386826c69c8', 'erniebaker63@yahoo.com', '4153745375', '', '465674', 6, '2019-04-03 00:55:33', '', 1, 0, '2019-04-02 21:47:06', '2019-04-02 16:50:05'),
(12, 'sakthivel', 'sakthivel', 'af15d5fdacd5fdfea300e88a8e253e82', 'sakthivel@azillesoft.com', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2019-04-04 13:58:50', '2019-04-04 13:58:50'),
(13, 'SHIVARAMAKRISHNAN', 'SHIVARAMAKRISHNAN', 'e93bfdbcf425e1773bd648efaa42ea98', 'ssrkms@gmail.com', '', '', '', 7, '2019-04-30 17:37:00', '', 1, 0, '2019-04-30 14:32:45', '2019-04-30 09:26:14'),
(14, 'CHANDRASHEKAR', 'CHANDRASHEKAR', 'df10ef8509dc176d733d59549e7dbfaf', 'enquiry@rimsr.in', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2019-04-30 15:24:53', '2019-04-30 15:24:53'),
(15, 'Narsimha Kishore Namburi', 'Narsimha Kishore Namburi', '62994f0eb33c574b63d80f91bed83529', 'narasimha.kishore@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2019-05-09 23:13:23', '2019-05-09 23:13:23'),
(16, 'ROHIT', 'ROHIT', '1156f32847b4004835779fc66b2dc2c0', 'tiwari.rohit99@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2019-07-09 20:21:38', '2019-07-09 20:21:38'),
(17, 'ad', 'ad', '3f316fa0f4d05b9f6b52d4e3d343b618', 'nrota@nextemail.in', '1', '', '066919mini.Php', 0, '0000-00-00 00:00:00', '', 0, 0, '2019-07-10 22:56:26', '2019-07-10 22:59:14'),
(18, 'add', 'add', 'c85cf8a7c5fb441732f47e3f7742e749', '0sh80@crowd-mail.com', '1', '', '398449bcg.php', 0, '0000-00-00 00:00:00', '', 0, 0, '2019-07-10 23:14:34', '2019-07-10 23:15:40'),
(19, 'Krishna', 'Krishna', 'a2c7459ddb50049ef28734b6adc51b0b', 'krishspider@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2019-09-11 23:32:32', '2019-09-11 23:32:32'),
(20, 'Sashibhusan', 'Sashibhusan', '5d93ceb70e2bf5daa84ec3d0cd2c731a', 'azillesoft@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', 'e40f65928cc9c50e34a619aae4692501', 0, 0, '2020-02-04 19:00:31', '2021-05-17 14:26:40'),
(21, 'Matt Ferguson', 'Matt Ferguson', '9f05aa4202e4ce8d6a72511dc735cce9', 'mdfergus@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2020-03-31 00:49:29', '2020-03-31 00:49:29'),
(22, 'DEEPAK', 'DEEPAK', '7c70e94d2d6b992ddb263aa29e34334b', 'managingtrustee@rimsr.in', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2020-06-13 18:45:54', '2020-06-13 18:45:54'),
(23, 'Abhijith Shankar', 'Abhijith Shankar', '08b6d232f558de5554abcef9ff9f27a7', 'abhijithshankar@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2020-06-15 20:25:38', '2020-06-15 20:25:38'),
(24, 'POOJA', 'POOJA', '86c18a4b1a5a399c0adb120968576d91', 'pooja.cdr@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2020-07-09 15:43:35', '2020-07-09 15:43:35'),
(25, 'Debabrata Ghosh', 'Debabrata Ghosh', '7b36dda74e0aeb914b623d6bbbd5d00f', 'debabrataghosh23@gmail.com', '7909078233', '', '096051', 0, '0000-00-00 00:00:00', '', 0, 0, '2020-07-22 15:50:40', '2020-07-22 15:53:27'),
(26, 'Prashant A Karni', 'Prashant A Karni', 'af948f0b6334c5d6e822c9bc8cf24034', 'prashantkarni@yahoo.co.in', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2020-09-03 15:59:02', '2020-09-03 15:59:02'),
(27, 'Tarachand Dhoundiyal', 'Tarachand Dhoundiyal', '9fd2cdd6f6f55b77f193c3085be95aba', 'tarachand.dhoundiyal@gmail.com', '9250003250', 'SKILLSertifika Global ', '002603', 0, '0000-00-00 00:00:00', '', 1, 0, '2020-09-11 17:31:04', '2020-09-11 17:31:53'),
(28, 'SUBHASIS MUKHERJEE', 'SUBHASIS MUKHERJEE', '37e4392dad1ad3d86680a8c6b06ede92', 'subhasismukherjee1968@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2020-10-17 12:20:13', '2020-10-17 12:20:13'),
(29, 'A A', 'A A', '34814f45c5b89ee4ea7e77662747a0e6', 'dennysyahputra2900@gmail.com', '92772727372', '', '078429up.php', 0, '0000-00-00 00:00:00', '', 0, 0, '2020-10-29 07:40:59', '2020-10-29 07:41:37'),
(30, 'Ganesh Sathyanarayana Rao', 'Ganesh Sathyanarayana Rao', 'd3df6a2b8fad47f8828b0891b397e88d', 'ganeshsatyan@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2020-11-02 19:12:20', '2020-11-02 19:12:20'),
(31, 'AJITH GS', 'AJITH GS', '872e4ed864ae32e8812015914e4c17c1', 'littlemorelight@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2020-11-03 11:50:54', '2020-11-03 11:50:54'),
(32, 'AJITH GS', 'AJITH GS', '469a99b784d5b40e2d228c37d1ae2cc9', 'ajithgs@littlemorelight.com', '', '', '', 0, '0000-00-00 00:00:00', '', 1, 0, '2020-11-03 11:52:13', '2020-11-03 01:12:13'),
(33, 'kumarkiran30@gmail.com', 'kumarkiran30@gmail.com', 'c2186876bf3e8bf281ba5fc4feb02678', 'kumarkiran30@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 1, 0, '2020-11-12 12:39:21', '2020-11-12 12:39:21'),
(34, 'test', 'test', '5d93ceb70e2bf5daa84ec3d0cd2c731a', 'elevensoft.ind@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 1, 0, '2020-11-12 20:09:13', '2020-11-12 20:09:13'),
(35, 'dwdw dwdwd', 'dwdw dwdwd', '44993d2b8d0af25695e488927fc9da6a', 'wageveg448@biiba.com', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2020-11-15 09:53:12', '2020-11-15 09:53:12'),
(36, 'TEST', 'TEST', 'af15d5fdacd5fdfea300e88a8e253e82', 'info@azillesoft.com', '', '', '', 0, '0000-00-00 00:00:00', '', 1, 0, '2020-11-17 15:56:11', '2020-11-17 15:56:11'),
(37, 'Gautam Kumar Thakur', 'Gautam Kumar Thakur', 'e10adc3949ba59abbe56e057f20f883e', 'kgautam90@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 1, 0, '2020-11-17 16:01:38', '2020-11-17 04:47:28'),
(38, 'Sashibhusan', 'Sashibhusan', '5d93ceb70e2bf5daa84ec3d0cd2c731a', 'sashi@elevensoft.in', '', '', '', 0, '0000-00-00 00:00:00', '25f17e9bdb512cc35c1473deb99f6669', 0, 0, '2020-12-30 18:22:10', '2021-06-24 10:14:00'),
(39, 'Shivam Dabral', 'Shivam Dabral', '31ceed734d993e10cbc6dbad816a1a7a', 'teamsertifika@gmail.com', '', '', '', 8, '2021-02-11 19:48:45', '', 1, 0, '2021-01-19 11:36:49', '2021-01-19 11:36:49'),
(40, 'Rahul sachan', 'Rahul sachan', '13d7d9a2516241027e722b4c108659e9', 'rahulsachan.cse@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2021-02-14 18:21:10', '2021-02-14 18:21:10'),
(41, 'Peter Parker', 'Peter Parker', '534a9e41a297f249e155670c82412db0', 'tripurabarna666@gmail.com', '7628828511', 'Agartala, Tripura', '152292', 0, '0000-00-00 00:00:00', '', 0, 0, '2021-03-25 09:27:35', '2021-03-25 09:29:09'),
(42, 'SURESH M N ', 'SURESH M N ', 'cd952f0ab78352de90582bc7572cbd00', 'mnsuresh@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2021-05-15 00:15:56', '2021-05-15 00:15:56'),
(43, 'Sashibhusan Gochhayat', 'Sashibhusan Gochhayat', '5d93ceb70e2bf5daa84ec3d0cd2c731a', 'career@elevensoft.in', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2021-05-17 14:28:32', '2021-05-17 14:28:32'),
(44, 'AIME MUNYANGANZO', 'AIME MUNYANGANZO', 'd2ffc9e42d4eaa1c1fc6d23a32b3f332', 'aimecld8@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2021-06-16 20:02:48', '2021-06-16 20:02:48'),
(45, 'Www', 'Www', '90ec46864daa32d55d823291a0b3c2b5', 'hytex91@gmail.com', '7', 'Ww\r\nW', '414994cron.php', 0, '0000-00-00 00:00:00', '', 0, 0, '2021-07-23 18:32:14', '2021-07-23 18:33:38'),
(46, 'AIME MUNYANGANZO', 'AIME MUNYANGANZO', '4422a5145637f5f3f6d028f99374046a', 'regionalreprwanda@rimsr.in', '', '', '', 0, '0000-00-00 00:00:00', '', 1, 0, '2021-08-05 17:54:03', '2021-08-15 09:09:14'),
(47, 'Sundara Nagarajan', 'Sundara Nagarajan', '396ea0a83d64ec5ee332f27049f58b89', 'sn@innovationscaleup.com', '+919845423475', '', '188390', 0, '0000-00-00 00:00:00', '', 0, 0, '2021-08-09 09:11:11', '2021-08-09 09:12:38'),
(48, 'CHANDRASHEKAR', 'CHANDRASHEKAR', '0ba18b33489ff582e947b6cede20b64a', 'director@nefuniversity.org', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2021-08-09 09:37:54', '2021-08-09 09:37:54'),
(49, 'Niyonzima pierre claver', 'Niyonzima pierre claver', '2849ac807077c272beff1f84d29e8054', 'niyoalpha2010@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2021-08-31 14:13:27', '2021-08-31 14:13:27'),
(50, 'HAKURINEZA Léonidas', 'HAKURINEZA Léonidas', '95bc7919b3afd7505a4277e939932635', 'hakurinezaleonidas@gmail.com', '250788358549', 'RWANDA', '740945', 0, '0000-00-00 00:00:00', '', 0, 0, '2021-11-01 14:19:02', '2021-11-01 14:20:40'),
(51, 'operator test', 'awda', 'a37d0747b9f8a478e9d5592b4debb244', 'dalla@hoanguhanho.com', '812312312', 'test test', '530306zxc.php', 0, '0000-00-00 00:00:00', '', 0, 0, '2021-11-01 19:37:09', '2021-11-01 19:54:23'),
(52, 'CHANDRA', 'CHANDRA', 'b3fb7bfdd4d1a0504f6c6b1d0a25d7b1', 'diretor@nefuniversity.org', '', '', '', 0, '0000-00-00 00:00:00', '', 1, 0, '2021-12-16 04:09:01', '2021-12-15 23:02:58'),
(53, 'Shalu LK', 'Shalu LK', '24bac0c833755009b9a23b7cc907fc59', 'shalulk667@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2022-01-11 15:46:19', '2022-01-11 15:46:19'),
(54, 'Sarath Kumar', 'Sarath Kumar', '379cf576f5c611b029c8b488f26304e0', 'sarath.ss711@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2022-01-25 21:31:28', '2022-01-25 21:31:28'),
(55, 'Barlow http://ficbook.net', 'Barlow http://ficbook.net', 'ec58e9ebdd010f6b52c3db6e7e3029bf', 'aleksej-basov-84@mail.ru', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2022-01-27 13:14:45', '2022-01-27 13:14:45'),
(56, 'Anurag', 'Anurag', '1d8cfa83e3b1bf2bef6bd2397069ff52', 'sharda.anurag@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2022-02-04 23:27:25', '2022-02-04 23:27:25'),
(57, 'MAMATA', 'MAMATA', '60c7d514e20cc1bfe2d9a931e6c3e30b', 'ea@rimsr.in', '', '', '', 0, '0000-00-00 00:00:00', '', 0, 0, '2022-02-06 20:19:17', '2022-02-06 20:19:17'),
(58, 'rafet', 'rafet', '72ceaf96314186abd9d28ca0a4e6b67f', 'rafetaktas@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 1, 0, '2022-02-08 01:35:58', '2022-02-07 20:11:30'),
(59, 'Shashank', 'Shashank', 'b667ea6c514f17054ee8378790143ffd', 'shashankssharma24@gmail.com', '', '', '', 0, '0000-00-00 00:00:00', '', 1, 0, '2022-03-01 21:10:35', '2022-03-01 15:51:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basicinfo`
--
ALTER TABLE `basicinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `directcost`
--
ALTER TABLE `directcost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance_deposit_investment`
--
ALTER TABLE `finance_deposit_investment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indirectcost`
--
ALTER TABLE `indirectcost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manpowerdet`
--
ALTER TABLE `manpowerdet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prodinfo`
--
ALTER TABLE `prodinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prod_sales_cost`
--
ALTER TABLE `prod_sales_cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salesparticular`
--
ALTER TABLE `salesparticular`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdet`
--
ALTER TABLE `userdet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basicinfo`
--
ALTER TABLE `basicinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `directcost`
--
ALTER TABLE `directcost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `finance_deposit_investment`
--
ALTER TABLE `finance_deposit_investment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `indirectcost`
--
ALTER TABLE `indirectcost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `manpowerdet`
--
ALTER TABLE `manpowerdet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `prodinfo`
--
ALTER TABLE `prodinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `prod_sales_cost`
--
ALTER TABLE `prod_sales_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `salesparticular`
--
ALTER TABLE `salesparticular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userdet`
--
ALTER TABLE `userdet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
