-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 02, 2013 at 04:38 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jdc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `h01_bank`
--

CREATE TABLE IF NOT EXISTS `h01_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(50) DEFAULT NULL,
  `branch_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bank_name_UNIQUE` (`bank_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `h01_bank`
--

INSERT INTO `h01_bank` (`id`, `bank_name`, `branch_name`) VALUES(1, 'HNB', 'Colombo');
INSERT INTO `h01_bank` (`id`, `bank_name`, `branch_name`) VALUES(2, 'BOC', 'Colombo');
INSERT INTO `h01_bank` (`id`, `bank_name`, `branch_name`) VALUES(3, 'People''s Bank', 'Colombo');

-- --------------------------------------------------------

--
-- Table structure for table `h02_fixed_vals`
--

CREATE TABLE IF NOT EXISTS `h02_fixed_vals` (
  `val_id` varchar(10) NOT NULL,
  `val_des` varchar(50) NOT NULL,
  `val_type` varchar(10) NOT NULL,
  `val_ord` int(11) NOT NULL,
  PRIMARY KEY (`val_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h02_fixed_vals`
--

INSERT INTO `h02_fixed_vals` (`val_id`, `val_des`, `val_type`, `val_ord`) VALUES('A', 'am', 'time', 1);
INSERT INTO `h02_fixed_vals` (`val_id`, `val_des`, `val_type`, `val_ord`) VALUES('DAY', 'Days', 'LV', 2);
INSERT INTO `h02_fixed_vals` (`val_id`, `val_des`, `val_type`, `val_ord`) VALUES('HRS', 'Hours', 'LV', 1);
INSERT INTO `h02_fixed_vals` (`val_id`, `val_des`, `val_type`, `val_ord`) VALUES('MONTH', 'Months', 'LV', 3);
INSERT INTO `h02_fixed_vals` (`val_id`, `val_des`, `val_type`, `val_ord`) VALUES('P', 'pm', 'time', 2);
INSERT INTO `h02_fixed_vals` (`val_id`, `val_des`, `val_type`, `val_ord`) VALUES('YEAR', 'Years', 'LV', 4);

-- --------------------------------------------------------

--
-- Table structure for table `m01_company`
--

CREATE TABLE IF NOT EXISTS `m01_company` (
  `comp_id` varchar(30) NOT NULL DEFAULT '',
  `com_name` varchar(50) DEFAULT NULL,
  `com_postal_code` varchar(10) DEFAULT NULL,
  `com_contact_Address_line1` varchar(20) DEFAULT NULL,
  `com_contact_Address_line2` varchar(20) DEFAULT NULL,
  `com_contact_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`comp_id`),
  UNIQUE KEY `com_name` (`com_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m01_company`
--

INSERT INTO `m01_company` (`comp_id`, `com_name`, `com_postal_code`, `com_contact_Address_line1`, `com_contact_Address_line2`, `com_contact_no`) VALUES('JDC', 'JDC Group', '1', 'main street', 'colombo', 11465555);
INSERT INTO `m01_company` (`comp_id`, `com_name`, `com_postal_code`, `com_contact_Address_line1`, `com_contact_Address_line2`, `com_contact_no`) VALUES('JDCG', 'JDC Graphic', '10', 'main street', 'Colombo 10', 112256986);
INSERT INTO `m01_company` (`comp_id`, `com_name`, `com_postal_code`, `com_contact_Address_line1`, `com_contact_Address_line2`, `com_contact_no`) VALUES('JDCP', 'JDC Printing', '78/A', 'main street', 'colombo', 774568899);
INSERT INTO `m01_company` (`comp_id`, `com_name`, `com_postal_code`, `com_contact_Address_line1`, `com_contact_Address_line2`, `com_contact_no`) VALUES('JDCU', 'Unifold', '46', 'bevery street', 'colombo', 11465555);

-- --------------------------------------------------------

--
-- Table structure for table `m02_department`
--

CREATE TABLE IF NOT EXISTS `m02_department` (
  `Dept_id` varchar(30) NOT NULL DEFAULT '',
  `Dept_name` varchar(30) DEFAULT NULL,
  `dept_description` text,
  `comp_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Dept_id`),
  KEY `comp_id` (`comp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m02_department`
--

INSERT INTO `m02_department` (`Dept_id`, `Dept_name`, `dept_description`, `comp_id`) VALUES('ACC', 'Account Department', 'Accounting', 'JDC');
INSERT INTO `m02_department` (`Dept_id`, `Dept_name`, `dept_description`, `comp_id`) VALUES('CMP', 'Commercial Department', 'related to commercial activities', 'JDC');
INSERT INTO `m02_department` (`Dept_id`, `Dept_name`, `dept_description`, `comp_id`) VALUES('HR', 'Human Resources-Printing', 'related to hr activities', 'JDCP');
INSERT INTO `m02_department` (`Dept_id`, `Dept_name`, `dept_description`, `comp_id`) VALUES('IT', 'Information Technology', 'IT related', 'JDC');
INSERT INTO `m02_department` (`Dept_id`, `Dept_name`, `dept_description`, `comp_id`) VALUES('PRO', 'Production Department-Unifold', 'do the production', 'JDCU');
INSERT INTO `m02_department` (`Dept_id`, `Dept_name`, `dept_description`, `comp_id`) VALUES('QA', 'Quality Assuarance-Graphic', 'related to QA', 'JDCG');
INSERT INTO `m02_department` (`Dept_id`, `Dept_name`, `dept_description`, `comp_id`) VALUES('SALES', 'Sales Department-Graphic', 'related to sales', 'JDCG');
INSERT INTO `m02_department` (`Dept_id`, `Dept_name`, `dept_description`, `comp_id`) VALUES('SLP', 'Sales Department-Printing', 'related to sales', 'JDCP');
INSERT INTO `m02_department` (`Dept_id`, `Dept_name`, `dept_description`, `comp_id`) VALUES('STR', 'Store Department-Printing', 'maintain stock', 'JDCP');
INSERT INTO `m02_department` (`Dept_id`, `Dept_name`, `dept_description`, `comp_id`) VALUES('TEC', 'Technical Department-Printing', 'related to technical', 'JDCP');

-- --------------------------------------------------------

--
-- Table structure for table `m03_emp_personal`
--

CREATE TABLE IF NOT EXISTS `m03_emp_personal` (
  `Emp_id` varchar(50) NOT NULL,
  `title` varchar(10) DEFAULT NULL,
  `First_name` varchar(20) DEFAULT NULL,
  `Middle_name` varchar(20) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `NIC` varchar(10) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `religion` varchar(20) DEFAULT NULL,
  `nationality` varchar(20) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `Contact_Address_line1` varchar(50) DEFAULT NULL,
  `Contact_Address_line2` varchar(50) DEFAULT NULL,
  `Contact_no` int(11) DEFAULT NULL,
  `Emp_mail` varchar(50) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `Distance` int(11) DEFAULT NULL,
  `marital_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-single,1-married',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-active 0-inactive',
  PRIMARY KEY (`Emp_id`),
  UNIQUE KEY `NIC_UNIQUE` (`NIC`),
  UNIQUE KEY `Emp_mail_UNIQUE` (`Emp_mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m03_emp_personal`
--

INSERT INTO `m03_emp_personal` (`Emp_id`, `title`, `First_name`, `Middle_name`, `surname`, `NIC`, `DOB`, `religion`, `nationality`, `postal_code`, `Contact_Address_line1`, `Contact_Address_line2`, `Contact_no`, `Emp_mail`, `photo`, `Distance`, `marital_status`, `status`) VALUES('Dilhan-824568888V', 'Mr', 'Dilhan', 'Sanjaya', 'Sendupperuma', '824568888V', '1982-03-07', 'Buddhism', 'Sri Lankan', '12', 'kirula road', 'Colombo 10', 774945308, 'Dilhan.send@gmail.com', '824568888V-Dilhan-photo.png', 13, 0, 1);
INSERT INTO `m03_emp_personal` (`Emp_id`, `title`, `First_name`, `Middle_name`, `surname`, `NIC`, `DOB`, `religion`, `nationality`, `postal_code`, `Contact_Address_line1`, `Contact_Address_line2`, `Contact_no`, `Emp_mail`, `photo`, `Distance`, `marital_status`, `status`) VALUES('Gayani-886451865V', 'Miss', 'Gayani', 'Chathurika', 'Sendupperuma', '886451865V', '1988-05-24', 'Buddhism', 'Sri Lankan', '168/6', 'Egoda Melegama', 'Wadduwa', 713686697, 'gchathurika9@gmail.com', '886451865V-Gayani-photo.jpg', 32, 0, 1);
INSERT INTO `m03_emp_personal` (`Emp_id`, `title`, `First_name`, `Middle_name`, `surname`, `NIC`, `DOB`, `religion`, `nationality`, `postal_code`, `Contact_Address_line1`, `Contact_Address_line2`, `Contact_no`, `Emp_mail`, `photo`, `Distance`, `marital_status`, `status`) VALUES('Janaka-835555555V', 'Mr', 'Janaka', 'Kumara', 'Perera', '835555555V', '1983-00-11', 'buddhism', 'Sri Lankan', '57', 'Main street', 'Wadduwa', 115678999, 'janaka@gmail.com', '835555555V-Janaka-photo.png', 45, 0, 1);
INSERT INTO `m03_emp_personal` (`Emp_id`, `title`, `First_name`, `Middle_name`, `surname`, `NIC`, `DOB`, `religion`, `nationality`, `postal_code`, `Contact_Address_line1`, `Contact_Address_line2`, `Contact_no`, `Emp_mail`, `photo`, `Distance`, `marital_status`, `status`) VALUES('Lakshan-898451825V', 'Mr', 'Lakshan', 'Chathuranga', 'Mahagamage', '898451825V', '1989-05-12', 'buddhism', 'Sri Lankan', '10', 'Main street', 'colombo', 776988669, 'lakshan@gmail.com', '898451825V-Lakshan-photo.png', 12, 0, 1);
INSERT INTO `m03_emp_personal` (`Emp_id`, `title`, `First_name`, `Middle_name`, `surname`, `NIC`, `DOB`, `religion`, `nationality`, `postal_code`, `Contact_Address_line1`, `Contact_Address_line2`, `Contact_no`, `Emp_mail`, `photo`, `Distance`, `marital_status`, `status`) VALUES('Malith-868451865v', 'Mr', 'Malith', 'Maduranga', 'Sendupperuma', '868451865v', '1986-03-09', 'Buddhism', 'Sri Lankan', '40/A', 'new street', 'yogayana', 774945308, 'gyth1988@gmail.com', '868451865v-Malith-photo.png', 45, 0, 1);
INSERT INTO `m03_emp_personal` (`Emp_id`, `title`, `First_name`, `Middle_name`, `surname`, `NIC`, `DOB`, `religion`, `nationality`, `postal_code`, `Contact_Address_line1`, `Contact_Address_line2`, `Contact_no`, `Emp_mail`, `photo`, `Distance`, `marital_status`, `status`) VALUES('mihikala-887945666V', 'Miss', 'mihikala', 'Chathurika', 'Perera', '887945666V', '1988-04-10', 'buddhism', 'Sri Lankan', '135', 'Egoda Melegama', 'Wadduwa', 774945308, 'mihikala@gmail.com', '887945666V-mihikala-photo.jpg', 30, 0, 1);
INSERT INTO `m03_emp_personal` (`Emp_id`, `title`, `First_name`, `Middle_name`, `surname`, `NIC`, `DOB`, `religion`, `nationality`, `postal_code`, `Contact_Address_line1`, `Contact_Address_line2`, `Contact_no`, `Emp_mail`, `photo`, `Distance`, `marital_status`, `status`) VALUES('Nadira-868451825V', 'Mr', 'Nadira', 'Nilupul', 'Perera', '868451825V', '1986-00-26', 'buddhism', 'Sri Lankan', '40/A', 'Galle Road', 'Dehiwala', 713686697, 'nadira@jdsl.com', '868451825V-Nadira-photo.png', 5, 0, 1);
INSERT INTO `m03_emp_personal` (`Emp_id`, `title`, `First_name`, `Middle_name`, `surname`, `NIC`, `DOB`, `religion`, `nationality`, `postal_code`, `Contact_Address_line1`, `Contact_Address_line2`, `Contact_no`, `Emp_mail`, `photo`, `Distance`, `marital_status`, `status`) VALUES('Sheryl-766451865V', 'Miss', 'Sheryl', 'Ann', 'Fernando', '766451865V', '1976-10-04', 'Catholic', 'Sri Lankan', '34', 'Galle Road', 'Wadduwa', 713686697, 'shrly@jdsl.com', '', 5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m04_designation`
--

CREATE TABLE IF NOT EXISTS `m04_designation` (
  `Des_code` varchar(100) NOT NULL,
  `job_Title` varchar(20) DEFAULT NULL,
  `des_type` char(2) NOT NULL DEFAULT 'P' COMMENT 'P-permanent,T-Trainee',
  `basic_Salary` int(11) DEFAULT NULL,
  PRIMARY KEY (`Des_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m04_designation`
--

INSERT INTO `m04_designation` (`Des_code`, `job_Title`, `des_type`, `basic_Salary`) VALUES('Accountant-P', 'Accountant', 'P', 30000);
INSERT INTO `m04_designation` (`Des_code`, `job_Title`, `des_type`, `basic_Salary`) VALUES('AccountantAssistant-P', 'Accountant Assistant', 'P', 15000);
INSERT INTO `m04_designation` (`Des_code`, `job_Title`, `des_type`, `basic_Salary`) VALUES('Clerk-P', 'Clerk', 'P', 12000);
INSERT INTO `m04_designation` (`Des_code`, `job_Title`, `des_type`, `basic_Salary`) VALUES('DataEntyOperator-P', 'Data Enty Operator', 'P', 15000);
INSERT INTO `m04_designation` (`Des_code`, `job_Title`, `des_type`, `basic_Salary`) VALUES('Driver-P', 'Driver', 'P', 20000);
INSERT INTO `m04_designation` (`Des_code`, `job_Title`, `des_type`, `basic_Salary`) VALUES('FinanceManager-P', 'Finance Manager', 'P', 70000);
INSERT INTO `m04_designation` (`Des_code`, `job_Title`, `des_type`, `basic_Salary`) VALUES('GraphicDesigner-P', 'Graphic Designer', 'P', 45000);
INSERT INTO `m04_designation` (`Des_code`, `job_Title`, `des_type`, `basic_Salary`) VALUES('HRAssistance-P', 'HR Assistance', 'P', 12000);
INSERT INTO `m04_designation` (`Des_code`, `job_Title`, `des_type`, `basic_Salary`) VALUES('HRmanager-P', 'HR manager', 'P', 35000);
INSERT INTO `m04_designation` (`Des_code`, `job_Title`, `des_type`, `basic_Salary`) VALUES('ITManager-P', 'IT Manager', 'P', 100000);
INSERT INTO `m04_designation` (`Des_code`, `job_Title`, `des_type`, `basic_Salary`) VALUES('ITTrainee-T', 'IT Trainee', 'T', 15000);
INSERT INTO `m04_designation` (`Des_code`, `job_Title`, `des_type`, `basic_Salary`) VALUES('JuniorSystemAdministrator-P', 'Junior System Admini', 'P', 25000);
INSERT INTO `m04_designation` (`Des_code`, `job_Title`, `des_type`, `basic_Salary`) VALUES('ManagingDirector-P', 'Managing Director', 'P', 150000);
INSERT INTO `m04_designation` (`Des_code`, `job_Title`, `des_type`, `basic_Salary`) VALUES('SecurityOfficer-P', 'Security Officer', 'P', 15000);
INSERT INTO `m04_designation` (`Des_code`, `job_Title`, `des_type`, `basic_Salary`) VALUES('SoftwareDeveloper-T', 'Software Developer', 'T', 20000);
INSERT INTO `m04_designation` (`Des_code`, `job_Title`, `des_type`, `basic_Salary`) VALUES('SystemAdministrator-P', 'System Administrator', 'P', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `m05_attendance`
--

CREATE TABLE IF NOT EXISTS `m05_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `att_date` date NOT NULL,
  `In_Time` decimal(16,2) DEFAULT NULL,
  `Out_time` decimal(16,2) DEFAULT NULL,
  `duration` decimal(16,2) NOT NULL,
  `Emp_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Emp_id` (`Emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `m06_emp_tasks`
--

CREATE TABLE IF NOT EXISTS `m06_emp_tasks` (
  `task_id` varchar(30) NOT NULL,
  `task_name` varchar(100) DEFAULT NULL,
  `From` date NOT NULL DEFAULT '0000-00-00',
  `To` date NOT NULL DEFAULT '0000-00-00',
  `supervisor_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`task_id`),
  KEY `supervisor_id` (`supervisor_id`),
  KEY `supervisor_id_2` (`supervisor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m07_supervisors`
--

CREATE TABLE IF NOT EXISTS `m07_supervisors` (
  `supervisor_id` varchar(50) NOT NULL,
  `Emp_id` varchar(50) DEFAULT NULL,
  `Des_code` varchar(100) DEFAULT NULL,
  `level` char(1) NOT NULL DEFAULT 'L' COMMENT 'L-low,H-high',
  PRIMARY KEY (`supervisor_id`),
  KEY `Des_code` (`Des_code`),
  KEY `Emp_id` (`Emp_id`),
  KEY `Emp_id_2` (`Emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m08_recruitment`
--

CREATE TABLE IF NOT EXISTS `m08_recruitment` (
  `rec_id` int(11) NOT NULL AUTO_INCREMENT,
  `vacancy` varchar(50) DEFAULT NULL,
  `Description` text,
  `Edu_qualification` varchar(200) DEFAULT NULL,
  `Prf_qualification` varchar(200) DEFAULT NULL,
  `opening_date` date DEFAULT NULL,
  `closing_date` date DEFAULT NULL,
  PRIMARY KEY (`rec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `m09_leave_type`
--

CREATE TABLE IF NOT EXISTS `m09_leave_type` (
  `leave_type_code` varchar(10) NOT NULL,
  `Leave_type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`leave_type_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m09_leave_type`
--

INSERT INTO `m09_leave_type` (`leave_type_code`, `Leave_type`) VALUES('ANNUAL', 'Annual Leave');
INSERT INTO `m09_leave_type` (`leave_type_code`, `Leave_type`) VALUES('Casual', 'Casual Leave');
INSERT INTO `m09_leave_type` (`leave_type_code`, `Leave_type`) VALUES('Lieu', 'Lieu Leave');

-- --------------------------------------------------------

--
-- Table structure for table `m10_leave_allocation`
--

CREATE TABLE IF NOT EXISTS `m10_leave_allocation` (
  `leave_allo_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(4) DEFAULT NULL,
  `allocated` decimal(16,2) NOT NULL COMMENT 'uom-days',
  `allo_uom` varchar(50) DEFAULT NULL,
  `used` decimal(16,2) NOT NULL COMMENT 'uom-days',
  `leave_type_code` varchar(10) DEFAULT NULL,
  `Emp_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`leave_allo_id`),
  KEY `Emp_id_idx` (`Emp_id`),
  KEY `leave_type_code_idx` (`leave_type_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `m11_vehicle`
--

CREATE TABLE IF NOT EXISTS `m11_vehicle` (
  `Vehicle_no` varchar(50) NOT NULL,
  `Vehicle_name` varchar(50) DEFAULT NULL,
  `Brand` varchar(100) DEFAULT NULL,
  `ltr_per_km` decimal(16,2) DEFAULT NULL,
  `usage_type` char(1) NOT NULL DEFAULT 'C' COMMENT 'C-Company P-Personal',
  PRIMARY KEY (`Vehicle_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m11_vehicle`
--

INSERT INTO `m11_vehicle` (`Vehicle_no`, `Vehicle_name`, `Brand`, `ltr_per_km`, `usage_type`) VALUES('qw123', 'car', 'toyota', '45.00', 'P');
INSERT INTO `m11_vehicle` (`Vehicle_no`, `Vehicle_name`, `Brand`, `ltr_per_km`, `usage_type`) VALUES('QW569', 'Prado', 'tata', '1.40', 'P');
INSERT INTO `m11_vehicle` (`Vehicle_no`, `Vehicle_name`, `Brand`, `ltr_per_km`, `usage_type`) VALUES('sw122', 'bmw', 'toyota', '12.00', 'C');
INSERT INTO `m11_vehicle` (`Vehicle_no`, `Vehicle_name`, `Brand`, `ltr_per_km`, `usage_type`) VALUES('SW789', 'Land Rower', 'toyota', '0.50', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `m12_hr_log`
--

CREATE TABLE IF NOT EXISTS `m12_hr_log` (
  `hr_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(50) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `actions_taken` text,
  PRIMARY KEY (`hr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `m13_email`
--

CREATE TABLE IF NOT EXISTS `m13_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(20) DEFAULT NULL,
  `message` text,
  `attachements` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `m14_customer`
--

CREATE TABLE IF NOT EXISTS `m14_customer` (
  `cus_id` varchar(20) NOT NULL DEFAULT '',
  `customer_name` varchar(50) DEFAULT NULL,
  `contactAddress` text,
  `Contact_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`cus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m14_customer`
--

INSERT INTO `m14_customer` (`cus_id`, `customer_name`, `contactAddress`, `Contact_no`) VALUES('BATA', 'Bata', 'no.168/6,\r\nmain street,\r\ncolombo 4', 715689746);
INSERT INTO `m14_customer` (`cus_id`, `customer_name`, `contactAddress`, `Contact_no`) VALUES('dsi', 'DSI', 'nbvnv', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `t01_employee_profile`
--

CREATE TABLE IF NOT EXISTS `t01_employee_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `AppointmentDate` date DEFAULT NULL,
  `EPF_no` varchar(50) DEFAULT NULL,
  `Account_No` int(11) DEFAULT NULL,
  `resign_date` date DEFAULT '0000-00-00',
  `Dept_id` varchar(30) DEFAULT NULL,
  `Emp_id` varchar(50) DEFAULT NULL,
  `Des_code` varchar(100) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Dept_id` (`Dept_id`),
  KEY `Emp_id` (`Emp_id`),
  KEY `bank_id` (`bank_id`),
  KEY `Des_code` (`Des_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `t01_employee_profile`
--

INSERT INTO `t01_employee_profile` (`id`, `AppointmentDate`, `EPF_no`, `Account_No`, `resign_date`, `Dept_id`, `Emp_id`, `Des_code`, `bank_id`) VALUES(1, '2013-03-05', '456789', 2147483647, '0000-00-00', 'IT', 'Malith-868451865v', 'ITManager-P', 3);
INSERT INTO `t01_employee_profile` (`id`, `AppointmentDate`, `EPF_no`, `Account_No`, `resign_date`, `Dept_id`, `Emp_id`, `Des_code`, `bank_id`) VALUES(2, '2013-01-01', '123454878', 12545455, '0000-00-00', 'IT', 'Gayani-886451865V', 'SystemAdministrator-P', 2);
INSERT INTO `t01_employee_profile` (`id`, `AppointmentDate`, `EPF_no`, `Account_No`, `resign_date`, `Dept_id`, `Emp_id`, `Des_code`, `bank_id`) VALUES(4, '2010-07-13', '342322222', 43433333, '0000-00-00', 'IT', 'Nadira-868451825V', 'SystemAdministrator-P', 2);
INSERT INTO `t01_employee_profile` (`id`, `AppointmentDate`, `EPF_no`, `Account_No`, `resign_date`, `Dept_id`, `Emp_id`, `Des_code`, `bank_id`) VALUES(6, '2013-07-01', '789645622', 111111111, '0000-00-00', 'IT', 'Lakshan-898451825V', 'DataEntyOperator-P', 1);
INSERT INTO `t01_employee_profile` (`id`, `AppointmentDate`, `EPF_no`, `Account_No`, `resign_date`, `Dept_id`, `Emp_id`, `Des_code`, `bank_id`) VALUES(8, '2013-05-01', '45874545454', 2147483647, '0000-00-00', 'HR', 'mihikala-887945666V', 'HRmanager-P', 1);
INSERT INTO `t01_employee_profile` (`id`, `AppointmentDate`, `EPF_no`, `Account_No`, `resign_date`, `Dept_id`, `Emp_id`, `Des_code`, `bank_id`) VALUES(9, '2008-03-13', '8957744444', 2147483647, '0000-00-00', 'HR', 'Janaka-835555555V', 'HRAssistance-P', 2);
INSERT INTO `t01_employee_profile` (`id`, `AppointmentDate`, `EPF_no`, `Account_No`, `resign_date`, `Dept_id`, `Emp_id`, `Des_code`, `bank_id`) VALUES(10, '2013-08-01', '345678999', 234678999, '0000-00-00', 'CMP', 'Dilhan-824568888V', 'ManagingDirector-P', 2);
INSERT INTO `t01_employee_profile` (`id`, `AppointmentDate`, `EPF_no`, `Account_No`, `resign_date`, `Dept_id`, `Emp_id`, `Des_code`, `bank_id`) VALUES(11, '2013-08-01', '4587454545433', 2147483647, '2013-09-24', 'CMP', 'Sheryl-766451865V', 'FinanceManager-P', 3);

-- --------------------------------------------------------

--
-- Table structure for table `t02_prv_emp_work_details`
--

CREATE TABLE IF NOT EXISTS `t02_prv_emp_work_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `join_date` date DEFAULT NULL,
  `pre_resign_date` date DEFAULT NULL,
  `position_held` varchar(20) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `reason_to_leave` varchar(100) DEFAULT NULL,
  `exp_type` char(1) DEFAULT NULL COMMENT 'm-months,y-years',
  `total_experience` varchar(10) DEFAULT NULL,
  `Emp_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Emp_id` (`Emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `t02_prv_emp_work_details`
--

INSERT INTO `t02_prv_emp_work_details` (`id`, `join_date`, `pre_resign_date`, `position_held`, `company_name`, `reason_to_leave`, `exp_type`, `total_experience`, `Emp_id`) VALUES(1, '2011-07-13', '2013-03-12', 'Senior Software Engi', 'Virtusa', 'nothing', 'y', '2', 'Malith-868451865v');
INSERT INTO `t02_prv_emp_work_details` (`id`, `join_date`, `pre_resign_date`, `position_held`, `company_name`, `reason_to_leave`, `exp_type`, `total_experience`, `Emp_id`) VALUES(2, '2013-01-01', '2013-07-23', 'PHP Developer', 'cyberconcepts', 'nothing', 'y', '1', 'Gayani-886451865V');
INSERT INTO `t02_prv_emp_work_details` (`id`, `join_date`, `pre_resign_date`, `position_held`, `company_name`, `reason_to_leave`, `exp_type`, `total_experience`, `Emp_id`) VALUES(3, '2009-02-04', '2010-02-09', 'Software Developer', 'Vogue Jewellers', 'none', 'y', '1', 'Nadira-868451825V');
INSERT INTO `t02_prv_emp_work_details` (`id`, `join_date`, `pre_resign_date`, `position_held`, `company_name`, `reason_to_leave`, `exp_type`, `total_experience`, `Emp_id`) VALUES(4, '2010-07-08', '2012-12-12', 'PHP Developer', 'cyberconcepts', 'nothing', 'y', '2', 'Lakshan-898451825V');
INSERT INTO `t02_prv_emp_work_details` (`id`, `join_date`, `pre_resign_date`, `position_held`, `company_name`, `reason_to_leave`, `exp_type`, `total_experience`, `Emp_id`) VALUES(5, '2009-07-01', '2012-07-12', 'HR Assistance', 'openarc', 'nothing', 'y', '3', 'mihikala-887945666V');
INSERT INTO `t02_prv_emp_work_details` (`id`, `join_date`, `pre_resign_date`, `position_held`, `company_name`, `reason_to_leave`, `exp_type`, `total_experience`, `Emp_id`) VALUES(6, '2003-07-17', '2007-07-12', 'HR Assistance', 'Commercial Bank', 'finish the training', 'y', '4', 'Janaka-835555555V');
INSERT INTO `t02_prv_emp_work_details` (`id`, `join_date`, `pre_resign_date`, `position_held`, `company_name`, `reason_to_leave`, `exp_type`, `total_experience`, `Emp_id`) VALUES(7, '2010-04-14', '2013-08-14', 'Software Developer', 'cyberconcepts', 'none', 'y', '3', 'Dilhan-824568888V');
INSERT INTO `t02_prv_emp_work_details` (`id`, `join_date`, `pre_resign_date`, `position_held`, `company_name`, `reason_to_leave`, `exp_type`, `total_experience`, `Emp_id`) VALUES(8, '2010-08-26', '2013-08-21', 'Accountant', 'Vogue Jewellers', 'none', 'y', '2', 'Sheryl-766451865V');

-- --------------------------------------------------------

--
-- Table structure for table `t03_emp_education`
--

CREATE TABLE IF NOT EXISTS `t03_emp_education` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` varchar(10) DEFAULT NULL,
  `to` varchar(10) DEFAULT NULL,
  `Institute` varchar(50) DEFAULT NULL,
  `Qualification` varchar(100) DEFAULT NULL,
  `Level` tinyint(1) DEFAULT '0' COMMENT '0-primary,1-secondary',
  `Emp_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Emp_id` (`Emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `t03_emp_education`
--

INSERT INTO `t03_emp_education` (`id`, `from`, `to`, `Institute`, `Qualification`, `Level`, `Emp_id`) VALUES(1, '2011-07-13', '2010-07-20', 'UCSC', 'MSC in IT', 0, 'Malith-868451865v');
INSERT INTO `t03_emp_education` (`id`, `from`, `to`, `Institute`, `Qualification`, `Level`, `Emp_id`) VALUES(2, '2013-01-01', '2012-07-12', 'UCSC', 'Degree in IT', 1, 'Gayani-886451865V');
INSERT INTO `t03_emp_education` (`id`, `from`, `to`, `Institute`, `Qualification`, `Level`, `Emp_id`) VALUES(3, '2009-02-04', '2010-07-29', 'NIBM', 'Degree in IT', 0, 'Nadira-868451825V');
INSERT INTO `t03_emp_education` (`id`, `from`, `to`, `Institute`, `Qualification`, `Level`, `Emp_id`) VALUES(4, '2008-07-15', '2011-07-21', 'NIBM', 'Degree in IT', 1, 'Lakshan-898451825V');
INSERT INTO `t03_emp_education` (`id`, `from`, `to`, `Institute`, `Qualification`, `Level`, `Emp_id`) VALUES(5, '2008-07-18', '2013-07-18', 'University of Sri Jayawardenapura', 'Degree in HR', 1, 'mihikala-887945666V');
INSERT INTO `t03_emp_education` (`id`, `from`, `to`, `Institute`, `Qualification`, `Level`, `Emp_id`) VALUES(6, '2003-01-15', '2004-02-11', 'NIBM', 'Diploma in HR', 1, 'Janaka-835555555V');
INSERT INTO `t03_emp_education` (`id`, `from`, `to`, `Institute`, `Qualification`, `Level`, `Emp_id`) VALUES(7, '2010-04-14', '2013-08-15', 'UCSC', 'Degree in IT', 1, 'Dilhan-824568888V');
INSERT INTO `t03_emp_education` (`id`, `from`, `to`, `Institute`, `Qualification`, `Level`, `Emp_id`) VALUES(8, '2004-02-18', '2007-08-16', 'University of Sri Jayawardenapura', 'Degree in Management', 1, 'Sheryl-766451865V');

-- --------------------------------------------------------

--
-- Table structure for table `t04_emp_family`
--

CREATE TABLE IF NOT EXISTS `t04_emp_family` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `relationship` varchar(20) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `NIC_f_fam_member` varchar(10) DEFAULT NULL,
  `occupation` varchar(50) DEFAULT NULL,
  `contact_no` varchar(10) DEFAULT NULL,
  `Emp_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Emp_id` (`Emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `t04_emp_family`
--

INSERT INTO `t04_emp_family` (`id`, `name`, `relationship`, `Age`, `NIC_f_fam_member`, `occupation`, `contact_no`, `Emp_id`) VALUES(1, 'Gayani Chathurika', 'Wife', 25, '886451865V', 'Software Developer', '0713686697', 'Malith-868451865v');
INSERT INTO `t04_emp_family` (`id`, `name`, `relationship`, `Age`, `NIC_f_fam_member`, `occupation`, `contact_no`, `Emp_id`) VALUES(2, 'Malith Sendupperuma', 'Husband', 27, '866451865V', 'Doctor', '0774945308', 'Gayani-886451865V');
INSERT INTO `t04_emp_family` (`id`, `name`, `relationship`, `Age`, `NIC_f_fam_member`, `occupation`, `contact_no`, `Emp_id`) VALUES(3, 'Mrs. Perera', 'Mother', 50, '588888888V', 'teacher', '0774945308', 'Nadira-868451825V');
INSERT INTO `t04_emp_family` (`id`, `name`, `relationship`, `Age`, `NIC_f_fam_member`, `occupation`, `contact_no`, `Emp_id`) VALUES(4, 'dilini', 'wife', 24, '896451865V', 'none', '0115689565', 'Lakshan-898451825V');
INSERT INTO `t04_emp_family` (`id`, `name`, `relationship`, `Age`, `NIC_f_fam_member`, `occupation`, `contact_no`, `Emp_id`) VALUES(5, 'Mrs.Perera', 'Mother', 50, '588888888V', 'teacher', '0115689565', 'mihikala-887945666V');
INSERT INTO `t04_emp_family` (`id`, `name`, `relationship`, `Age`, `NIC_f_fam_member`, `occupation`, `contact_no`, `Emp_id`) VALUES(6, 'Mrs. Perera', 'Mother', 56, '554354222V', 'none', '0774945308', 'Janaka-835555555V');
INSERT INTO `t04_emp_family` (`id`, `name`, `relationship`, `Age`, `NIC_f_fam_member`, `occupation`, `contact_no`, `Emp_id`) VALUES(7, 'Mrs.Sendupperuma', 'Wife', 30, '846451865V', 'none', '0774945308', 'Dilhan-824568888V');
INSERT INTO `t04_emp_family` (`id`, `name`, `relationship`, `Age`, `NIC_f_fam_member`, `occupation`, `contact_no`, `Emp_id`) VALUES(8, 'Dolton Fernando', 'Husband', 56, '554354222V', 'Doctor', '0713686697', 'Sheryl-766451865V');

-- --------------------------------------------------------

--
-- Table structure for table `t05_emp_managed`
--

CREATE TABLE IF NOT EXISTS `t05_emp_managed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Emp_id` varchar(50) DEFAULT NULL,
  `supervisor_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `supervisor_id` (`supervisor_id`),
  KEY `Emp_id` (`Emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t06_emp_hs_tasks`
--

CREATE TABLE IF NOT EXISTS `t06_emp_hs_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` varchar(10) DEFAULT NULL,
  `Emp_id` varchar(50) DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1-complete,0-incomplete,9-half complete',
  `marks` int(11) NOT NULL COMMENT '100-complete,50-half complete,0-incomplete',
  `feedback_date` date NOT NULL DEFAULT '0000-00-00',
  `comments` varchar(200) NOT NULL,
  `approved` char(1) NOT NULL DEFAULT 'N' COMMENT 'N-Never,A-approve,R-Reject',
  `approved_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Emp_id` (`Emp_id`),
  KEY `task_id_idx` (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t07_cv_fr_vacancy`
--

CREATE TABLE IF NOT EXISTS `t07_cv_fr_vacancy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cv` varchar(30) DEFAULT NULL,
  `rec_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rec_id` (`rec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t08_leave`
--

CREATE TABLE IF NOT EXISTS `t08_leave` (
  `lv_app_no` int(11) NOT NULL AUTO_INCREMENT,
  `From` date DEFAULT NULL,
  `to` date DEFAULT NULL,
  `applied_on` date DEFAULT NULL,
  `no_of_days` decimal(16,2) DEFAULT NULL COMMENT 'uom-days',
  `reason_for_leave` text,
  `leave_type_code` varchar(10) DEFAULT NULL,
  `Emp_id` varchar(50) DEFAULT NULL,
  `app_status` char(1) NOT NULL DEFAULT 'N' COMMENT 'A-Approved,R-Reject,N-Never,P-Pending',
  `appr_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`lv_app_no`),
  KEY `leave_type_code_idx` (`leave_type_code`),
  KEY `Emp_id_idx` (`Emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t09_emp_hs_vehicle`
--

CREATE TABLE IF NOT EXISTS `t09_emp_hs_vehicle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Vehicle_no` varchar(50) DEFAULT NULL,
  `Emp_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Vehicle_no_idx` (`Vehicle_no`),
  KEY `Emp_id_idx` (`Emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t11_gate_pass`
--

CREATE TABLE IF NOT EXISTS `t11_gate_pass` (
  `gate_pass_id` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date DEFAULT NULL,
  `departure` decimal(16,2) DEFAULT NULL,
  `departure_unit` char(2) NOT NULL COMMENT 'A-am,P-pm',
  `return` decimal(16,2) DEFAULT NULL,
  `return_unit` char(2) NOT NULL COMMENT 'P-pm,A-am',
  `distance` decimal(16,2) DEFAULT NULL,
  `Vehicle_no` varchar(50) DEFAULT NULL,
  `Emp_id` varchar(50) DEFAULT NULL,
  `cus_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`gate_pass_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t12_fuel_consumption`
--

CREATE TABLE IF NOT EXISTS `t12_fuel_consumption` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consumtion_ltr` decimal(16,2) NOT NULL,
  `gate_pass_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gate_pass_id` (`gate_pass_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t13_inq_idea`
--

CREATE TABLE IF NOT EXISTS `t13_inq_idea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idea_inq` varchar(50) DEFAULT NULL,
  `details` text NOT NULL,
  `inq_idea_status` char(1) NOT NULL DEFAULT 'I' COMMENT 'I-idea, Q-Inquiry',
  `feedbck_sup` varchar(50) DEFAULT NULL,
  `app_status` char(1) NOT NULL DEFAULT 'N' COMMENT 'A-Approve R-Reject N-Never',
  `app_date` date NOT NULL,
  `Emp_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `u01_users`
--

CREATE TABLE IF NOT EXISTS `u01_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_id` varchar(20) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_email` varchar(50) DEFAULT NULL,
  `Emp_id` varchar(50) NOT NULL,
  `active` tinyint(2) NOT NULL DEFAULT '1' COMMENT 'active-1,inactive-0',
  `deactive_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email` (`user_email`),
  KEY `user_role_id` (`user_role_id`),
  KEY `Emp_id` (`Emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `u01_users`
--

INSERT INTO `u01_users` (`id`, `user_role_id`, `username`, `password`, `user_email`, `Emp_id`, `active`, `deactive_date`) VALUES(32, 'DVP', 'gayani', '202cb962ac59075b964b07152d234b70', 'gchathurika9@gmail.com', 'Gayani-886451865V', 1, NULL);
INSERT INTO `u01_users` (`id`, `user_role_id`, `username`, `password`, `user_email`, `Emp_id`, `active`, `deactive_date`) VALUES(33, 'ADMIN', 'admin', '202cb962ac59075b964b07152d234b70', 'nadira@jdsl.com', 'Nadira-868451825V', 1, NULL);
INSERT INTO `u01_users` (`id`, `user_role_id`, `username`, `password`, `user_email`, `Emp_id`, `active`, `deactive_date`) VALUES(34, 'MGER', 'manager', '202cb962ac59075b964b07152d234b70', 'gyth1988@gmail.com', 'Malith-868451865v', 1, NULL);
INSERT INTO `u01_users` (`id`, `user_role_id`, `username`, `password`, `user_email`, `Emp_id`, `active`, `deactive_date`) VALUES(35, 'NEMP', 'emp', '202cb962ac59075b964b07152d234b70', 'mihikala@gmail.com', 'mihikala-887945666V', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `u02_user_roles`
--

CREATE TABLE IF NOT EXISTS `u02_user_roles` (
  `user_role_id` varchar(20) NOT NULL,
  `user_role` varchar(20) DEFAULT NULL,
  UNIQUE KEY `user_role_id` (`user_role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `u02_user_roles`
--

INSERT INTO `u02_user_roles` (`user_role_id`, `user_role`) VALUES('ADMIN', 'Administrator');
INSERT INTO `u02_user_roles` (`user_role_id`, `user_role`) VALUES('DEO', 'Data Entry Operator');
INSERT INTO `u02_user_roles` (`user_role_id`, `user_role`) VALUES('DVP', 'Developer');
INSERT INTO `u02_user_roles` (`user_role_id`, `user_role`) VALUES('HR', 'HR Manager');
INSERT INTO `u02_user_roles` (`user_role_id`, `user_role`) VALUES('MGER', 'Manager');
INSERT INTO `u02_user_roles` (`user_role_id`, `user_role`) VALUES('NEMP', 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `u03_module_options`
--

CREATE TABLE IF NOT EXISTS `u03_module_options` (
  `option_code` varchar(20) NOT NULL,
  `option_name` varchar(50) DEFAULT NULL,
  `page_id` varchar(50) DEFAULT NULL,
  `sub_option` varchar(20) DEFAULT NULL,
  `parent` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'parent-1,child-0',
  `hidden` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'hidden-1,view-0',
  PRIMARY KEY (`option_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `u03_module_options`
--

INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('ATT', 'Attendence', 'attendence_ctr', '', 1, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('ATTV', 'View Attendence', 'attendence_ctr', 'ATT', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('BCKUP', 'Database Backup', 'bckup_ctr', '', 1, 1);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('CMP', 'Company', 'company_ctr', '', 1, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('CMPDET', 'Department Details', 'department_ctr', 'CMP', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('CMPEMP', 'Employee Details', 'employee_ctr', 'CMP', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('CMPP', 'Company Details', 'company_ctr', 'CMP', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('LEV', 'Leave Management', 'leave_ctr', '', 1, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('LEVALLO', 'Leave Allocation', 'leave_ctr/allocation', 'LEV', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('LEVAPPR', 'Leave Approvals', 'leave_ctr/approvals', 'LEV', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('LEVREQ', 'Leave Requests', 'leave_ctr/requests', 'LEV', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('LEVTYPE', 'Leave Types', 'leave_ctr/types', 'LEV', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('PERFO', 'Performance', 'performance_ctr', '', 1, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('PERFOAPPT', 'Approving Tasks', 'performance_ctr/app_tasks', 'PERFO', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('PERFOASST', 'Assign Tasks', 'performance_ctr/assign_tasks', 'PERFO', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('PERFOEMPT', 'Employee Tasks', 'performance_ctr/emp_tasks', 'PERFO', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('PERFOSUPV', 'Maintain Supervisors', 'performance_ctr/supervisor', 'PERFO', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('REP', 'Reports', 'report_ctr', '', 1, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('REPATT', 'Attendence Report', 'report_ctr/attendance_report', 'REP', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('REPEMP', 'Employee Details Report', 'report_ctr/employee_report', 'REP', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('REPFUEL', 'Fuel Consumption Report', 'report_ctr/fuel_consump_report', 'REP', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('REPLV', 'Leave Report', 'report_ctr/leave_report', 'REP', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('REPPRO', 'Progress Report', 'report_ctr/progress_report', 'REP', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('REPSAL', 'Salary Details Report', 'report_ctr/salary_report', 'REP', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('STFF', 'Staff & Labour Relations', 'staff_ctr', '', 1, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('STFFEML', 'Organize Events', 'staff_ctr/hr_event', 'STFF', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('STFFHR', 'HR Log', 'staff_ctr/hr_log', 'STFF', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('STFFINQ', 'Inquiries', 'staff_ctr/inq', 'STFF', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('TAL', 'Recruitment Management', 'talent_ctr', '', 1, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('TALDESIG_MNT', 'Maintain Designations', 'talent_ctr/designation', 'TAL', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('TALIDEA', 'Innovative Ideas', 'talent_ctr/ideas', 'STFF', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('TALREC', 'Recruitment', 'talent_ctr/recruitment', 'TAL', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('TALRESG', 'Resignations', 'talent_ctr/resign', 'TAL', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('USR', 'Users', 'user_ctr', '', 1, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('USR_MNT', 'User Management', 'user_ctr', 'USR', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('VEH', 'Vehicle Fuel Consumption', 'fuel_ctr', '', 1, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('VEHCAL', 'Vehicle Details', 'fuel_ctr/vehicle', 'VEH', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('VEHCUS', 'Maintain Customers', 'fuel_ctr/customer', 'VEH', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('VEHDET', 'Gate Pass Details', 'fuel_ctr/gate_pass_det', 'VEH', 0, 0);
INSERT INTO `u03_module_options` (`option_code`, `option_name`, `page_id`, `sub_option`, `parent`, `hidden`) VALUES('VEHGTP', 'Generate Gate Passes', 'fuel_ctr/gate_pass', 'VEH', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `u04_user_roles_module_options`
--

CREATE TABLE IF NOT EXISTS `u04_user_roles_module_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_id` varchar(20) NOT NULL,
  `option_code` varchar(20) NOT NULL,
  `parameters` varchar(255) NOT NULL,
  `disp_ord` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `option_code` (`option_code`),
  KEY `user_role_id` (`user_role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=205 ;

--
-- Dumping data for table `u04_user_roles_module_options`
--

INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(1, 'DVP', 'CMP', 'index', 10);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(2, 'DVP', 'CMPP', 'index', 20);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(3, 'DVP', 'CMPDET', 'index', 30);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(4, 'DVP', 'CMPEMP', 'index', 40);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(5, 'DVP', 'ATT', 'index', 50);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(6, 'DVP', 'ATTV', 'index', 60);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(7, 'DVP', 'PERFO', 'index', 70);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(8, 'DVP', 'PERFOASST', 'index', 80);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(9, 'DVP', 'PERFOEMPT', 'index', 90);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(10, 'DVP', 'PERFOAPPT', 'index', 100);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(11, 'DVP', 'PERFOSUPV', 'index', 110);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(12, 'DVP', 'TAL', 'index', 120);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(13, 'DVP', 'TALDESIG_MNT', 'index', 130);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(14, 'DVP', 'TALREC', 'index', 140);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(15, 'DVP', 'LEV', 'index', 150);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(16, 'DVP', 'LEVTYPE', 'index', 160);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(17, 'DVP', 'LEVALLO', 'allocation', 170);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(18, 'DVP', 'LEVREQ', 'index', 180);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(19, 'DVP', 'LEVAPPR', 'index', 190);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(20, 'DVP', 'STFF', 'index', 200);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(21, 'DVP', 'STFFHR', 'index', 210);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(22, 'DVP', 'VEH', 'index', 220);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(23, 'DVP', 'VEHCAL', 'index', 230);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(24, 'DVP', 'VEHGTP', 'index', 240);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(25, 'DVP', 'VEHCUS', 'index', 250);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(26, 'DVP', 'REP', 'index', 260);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(27, 'DVP', 'USR', 'index', 270);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(30, 'DVP', 'USR_MNT', 'index', 280);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(35, 'ADMIN', 'CMP', 'index', 10);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(36, 'ADMIN', 'CMPP', 'index', 20);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(37, 'ADMIN', 'CMPDET', 'index', 30);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(38, 'ADMIN', 'CMPEMP', 'index', 40);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(39, 'ADMIN', 'ATT', 'index', 50);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(40, 'ADMIN', 'ATTV', 'index', 60);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(41, 'ADMIN', 'PERFO', 'index', 70);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(42, 'ADMIN', 'PERFOASST', 'index', 80);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(43, 'ADMIN', 'PERFOEMPT', 'index', 90);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(44, 'ADMIN', 'PERFOAPPT', 'index', 100);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(45, 'ADMIN', 'PERFOSUPV', 'index', 110);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(46, 'ADMIN', 'LEV', 'index', 150);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(47, 'ADMIN', 'LEVREQ', 'index', 180);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(48, 'ADMIN', 'LEVAPPR', 'index', 190);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(49, 'ADMIN', 'VEH', 'index', 220);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(50, 'ADMIN', 'VEHCAL', 'index', 230);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(51, 'ADMIN', 'VEHGTP', 'index', 240);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(52, 'ADMIN', 'VEHCUS', 'index', 250);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(53, 'ADMIN', 'REP', 'index', 260);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(54, 'ADMIN', 'USR', 'index', 270);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(55, 'ADMIN', 'USR_MNT', 'index', 280);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(56, 'DEO', 'CMP', 'index', 10);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(57, 'DEO', 'CMPEMP', 'index', 40);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(58, 'DEO', 'ATT', 'index', 50);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(59, 'DEO', 'ATTV', 'index', 60);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(60, 'DEO', 'PERFO', 'index', 70);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(61, 'DEO', 'PERFOEMPT', 'index', 90);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(62, 'DEO', 'LEV', 'index', 150);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(63, 'DEO', 'LEVREQ', 'index', 180);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(64, 'DEO', 'VEH', 'index', 220);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(66, 'DEO', 'VEHGTP', 'index', 240);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(68, 'HR', 'CMP', 'index', 10);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(69, 'HR', 'CMPDET', 'index', 30);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(70, 'HR', 'CMPEMP', 'index', 40);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(71, 'HR', 'ATT', 'index', 50);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(72, 'HR', 'ATTV', 'index', 60);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(73, 'HR', 'PERFO', 'index', 70);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(74, 'HR', 'PERFOASST', 'index', 80);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(75, 'HR', 'PERFOEMPT', 'index', 90);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(76, 'HR', 'PERFOAPPT', 'index', 100);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(78, 'HR', 'TAL', 'index', 120);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(79, 'HR', 'TALDESIG_MNT', 'index', 130);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(80, 'HR', 'TALREC', 'index', 140);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(81, 'HR', 'LEV', 'index', 150);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(82, 'HR', 'LEVTYPE', 'index', 160);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(83, 'HR', 'LEVALLO', 'index', 170);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(84, 'HR', 'LEVREQ', 'index', 180);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(85, 'HR', 'LEVAPPR', 'index', 190);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(86, 'HR', 'STFF', 'index', 200);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(87, 'HR', 'STFFHR', 'index', 210);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(88, 'HR', 'VEH', 'index', 220);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(90, 'HR', 'VEHGTP', 'index', 240);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(92, 'HR', 'REP', 'index', 260);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(93, 'NEMP', 'CMP', 'index', 10);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(94, 'NEMP', 'CMPEMP', 'index', 40);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(95, 'NEMP', 'ATT', 'index', 50);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(96, 'NEMP', 'ATTV', 'index', 60);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(97, 'NEMP', 'PERFO', 'index', 70);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(98, 'NEMP', 'PERFOEMPT', 'index', 90);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(99, 'NEMP', 'LEV', 'index', 150);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(100, 'NEMP', 'LEVREQ', 'index', 180);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(101, 'NEMP', 'VEH', 'index', 220);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(103, 'NEMP', 'VEHGTP', 'index', 240);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(105, 'MGER', 'CMP', 'index', 10);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(106, 'MGER', 'CMPP', 'index', 20);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(107, 'MGER', 'CMPDET', 'index', 30);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(108, 'MGER', 'CMPEMP', 'index', 40);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(109, 'MGER', 'ATT', 'index', 50);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(110, 'MGER', 'ATTV', 'index', 60);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(111, 'MGER', 'PERFO', 'index', 70);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(112, 'MGER', 'PERFOASST', 'index', 80);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(113, 'MGER', 'PERFOEMPT', 'index', 90);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(114, 'MGER', 'PERFOAPPT', 'index', 100);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(115, 'MGER', 'LEV', 'index', 150);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(116, 'MGER', 'LEVREQ', 'index', 180);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(117, 'MGER', 'LEVAPPR', 'index', 190);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(118, 'MGER', 'VEH', 'index', 220);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(120, 'MGER', 'VEHGTP', 'index', 240);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(122, 'MGER', 'REP', 'index', 260);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(135, 'DVP', 'BCKUP', 'index', 290);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(136, 'ADMIN', 'BCKUP', 'index', 290);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(139, 'DVP', 'REPLV', 'index', 261);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(140, 'DVP', 'REPPRO', 'index', 262);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(141, 'ADMIN', 'REPLV', 'index', 261);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(142, 'ADMIN', 'REPPRO', 'index', 262);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(143, 'HR', 'REPLV', 'index', 261);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(144, 'HR', 'REPPRO', 'index', 262);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(145, 'MGER', 'REPLV', 'index', 261);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(146, 'MGER', 'REPPRO', 'index', 262);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(148, 'MGER', 'VEHDET', 'index', 251);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(149, 'NEMP', 'VEHDET', 'index', 251);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(150, 'NEMP', 'VEHDET', 'index', 251);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(151, 'HR', 'VEHDET', 'index', 251);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(152, 'DEO', 'VEHDET', 'index', 251);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(153, 'ADMIN', 'VEHDET', 'index', 251);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(154, 'DVP', 'VEHDET', 'index', 251);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(155, 'DVP', 'TALRESG', 'index', 141);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(156, 'HR', 'TALRESG', 'index', 141);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(158, 'ADMIN', 'STFF', 'index', 200);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(160, 'DEO', 'STFF', 'index', 200);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(163, 'NEMP', 'STFF', 'index', 200);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(165, 'MGER', 'STFF', 'index', 200);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(169, 'DVP', 'TALIDEA', 'index', 142);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(170, 'ADMIN', 'TAL', 'index', 120);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(171, 'ADMIN', 'TALIDEA', 'index', 142);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(172, 'DEO', 'TAL', 'index', 120);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(173, 'DEO', 'TALIDEA', 'index', 142);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(174, 'HR', 'TALIDEA', 'index', 142);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(175, 'NEMP', 'TAL', 'index', 120);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(176, 'NEMP', 'TALIDEA', 'index', 142);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(177, 'MGER', 'TAL', 'index', 120);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(178, 'MGER', 'TALIDEA', 'index', 142);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(181, 'DVP', 'REPEMP', 'index', 263);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(182, 'DVP', 'REPATT', 'index', 264);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(183, 'DVP', 'REPFUEL', 'index', 265);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(184, 'DVP', 'REPSAL', 'index', 266);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(185, 'ADMIN', 'REPEMP', 'index', 263);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(186, 'ADMIN', 'REPATT', 'index', 264);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(187, 'ADMIN', 'REPFUEL', 'index', 265);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(188, 'ADMIN', 'REPSAL', 'index', 266);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(189, 'HR', 'REPEMP', 'index', 263);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(190, 'HR', 'REPATT', 'index', 264);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(191, 'HR', 'REPFUEL', 'index', 265);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(192, 'HR', 'REPSAL', 'index', 266);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(193, 'MGER', 'REPEMP', 'index', 263);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(194, 'MGER', 'REPATT', 'index', 264);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(195, 'MGER', 'REPFUEL', 'index', 265);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(196, 'MGER', 'REPSAL', 'index', 266);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(198, 'ADMIN', 'TALREC', 'index', 140);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(199, 'ADMIN', 'TALRESG', 'index', 141);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(200, 'ADMIN', 'TALDESIG_MNT', 'index', 130);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(201, 'DEO', 'TALREC', 'index', 140);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(202, 'DEO', 'TALRESG', 'index', 141);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(203, 'NEMP', 'TALREC', 'index', 140);
INSERT INTO `u04_user_roles_module_options` (`id`, `user_role_id`, `option_code`, `parameters`, `disp_ord`) VALUES(204, 'NEMP', 'TALRESG', 'index', 141);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m02_department`
--
ALTER TABLE `m02_department`
  ADD CONSTRAINT `m02_department_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `m01_company` (`comp_id`);

--
-- Constraints for table `m06_emp_tasks`
--
ALTER TABLE `m06_emp_tasks`
  ADD CONSTRAINT `m06_emp_tasks_ibfk_1` FOREIGN KEY (`supervisor_id`) REFERENCES `m07_supervisors` (`supervisor_id`);

--
-- Constraints for table `m10_leave_allocation`
--
ALTER TABLE `m10_leave_allocation`
  ADD CONSTRAINT `m10_leave_allocation_ibfk_1` FOREIGN KEY (`leave_type_code`) REFERENCES `m09_leave_type` (`leave_type_code`),
  ADD CONSTRAINT `m10_leave_allocation_ibfk_2` FOREIGN KEY (`Emp_id`) REFERENCES `m03_emp_personal` (`Emp_id`);

--
-- Constraints for table `t08_leave`
--
ALTER TABLE `t08_leave`
  ADD CONSTRAINT `t08_leave_ibfk_1` FOREIGN KEY (`leave_type_code`) REFERENCES `m09_leave_type` (`leave_type_code`),
  ADD CONSTRAINT `t08_leave_ibfk_2` FOREIGN KEY (`Emp_id`) REFERENCES `m03_emp_personal` (`Emp_id`);

--
-- Constraints for table `t12_fuel_consumption`
--
ALTER TABLE `t12_fuel_consumption`
  ADD CONSTRAINT `t12_fuel_consumption_ibfk_1` FOREIGN KEY (`gate_pass_id`) REFERENCES `t11_gate_pass` (`gate_pass_id`);

--
-- Constraints for table `u01_users`
--
ALTER TABLE `u01_users`
  ADD CONSTRAINT `u01_users_ibfk_1` FOREIGN KEY (`user_role_id`) REFERENCES `u02_user_roles` (`user_role_id`);

--
-- Constraints for table `u04_user_roles_module_options`
--
ALTER TABLE `u04_user_roles_module_options`
  ADD CONSTRAINT `u04_user_roles_module_options_ibfk_1` FOREIGN KEY (`user_role_id`) REFERENCES `u02_user_roles` (`user_role_id`),
  ADD CONSTRAINT `u04_user_roles_module_options_ibfk_2` FOREIGN KEY (`option_code`) REFERENCES `u03_module_options` (`option_code`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
