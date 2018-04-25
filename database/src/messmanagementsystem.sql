-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2018 at 05:50 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `messmanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_taking`
--

CREATE TABLE `bill_taking` (
  `person_id` int(11) NOT NULL,
  `mess_id` int(11) NOT NULL,
  `total_meal` int(11) NOT NULL DEFAULT '0',
  `meal_cost` int(11) NOT NULL DEFAULT '0',
  `total_cost` int(11) NOT NULL DEFAULT '0',
  `paid_cost` int(11) NOT NULL DEFAULT '0',
  `rest_cost` int(11) NOT NULL DEFAULT '0',
  `month_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `email_id`
--

CREATE TABLE `email_id` (
  `email_id` varchar(25) NOT NULL,
  `person_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_id`
--

INSERT INTO `email_id` (`email_id`, `person_id`) VALUES
('hbappy79@gmail.com', 1),
('foysal@gmail.com', 2),
('lotif@gmail.com', 3),
('fahim@gmail.com', 4),
('gain@gmail.com', 5),
('rakib@gmail.com', 7);

-- --------------------------------------------------------

--
-- Table structure for table `meal_market`
--

CREATE TABLE `meal_market` (
  `person_id` int(11) NOT NULL,
  `mess_id` int(11) NOT NULL,
  `moy_id` int(11) NOT NULL,
  `date_of_month` int(11) NOT NULL,
  `total_cost` int(11) NOT NULL DEFAULT '0',
  `details` varchar(105) DEFAULT 'No Details'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meal_market`
--

INSERT INTO `meal_market` (`person_id`, `mess_id`, `moy_id`, `date_of_month`, `total_cost`, `details`) VALUES
(7, 3, 2, 4, 200, 'bazar');

-- --------------------------------------------------------

--
-- Table structure for table `mess_admin`
--

CREATE TABLE `mess_admin` (
  `person_id` int(11) NOT NULL,
  `mess_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mess_admin`
--

INSERT INTO `mess_admin` (`person_id`, `mess_id`) VALUES
(1, 3),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `mess_information`
--

CREATE TABLE `mess_information` (
  `mess_id` int(11) NOT NULL,
  `mess_name` varchar(20) NOT NULL DEFAULT 'No Name',
  `total_person` int(11) NOT NULL,
  `street` varchar(25) DEFAULT 'Not Set',
  `town` varchar(25) DEFAULT 'Not Set',
  `helpline` varchar(15) NOT NULL,
  `mess_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mess_information`
--

INSERT INTO `mess_information` (`mess_id`, `mess_name`, `total_person`, `street`, `town`, `helpline`, `mess_code`) VALUES
(3, 'Vai Vai Satrabash', 4, 'Islamnagar', 'Khulna', '01932089409', '1234'),
(4, 'kabir', 3, 'khulna', 'khulna', '01987654321', '2345');

-- --------------------------------------------------------

--
-- Table structure for table `mess_meal`
--

CREATE TABLE `mess_meal` (
  `person_id` int(11) NOT NULL,
  `mess_id` int(11) NOT NULL,
  `date_of_month` int(11) NOT NULL,
  `moy_id` int(11) NOT NULL,
  `meal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mess_meal`
--

INSERT INTO `mess_meal` (`person_id`, `mess_id`, `date_of_month`, `moy_id`, `meal`) VALUES
(1, 3, 2, 2, 1),
(1, 3, 2, 2, 1),
(1, 3, 2, 2, 1),
(2, 3, 3, 2, 3),
(7, 3, 3, 2, 3),
(7, 3, 4, 2, 6),
(7, 3, 4, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mess_person`
--

CREATE TABLE `mess_person` (
  `mess_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `active_status` tinyint(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mess_person`
--

INSERT INTO `mess_person` (`mess_id`, `person_id`, `active_status`) VALUES
(3, 1, 1),
(3, 2, 1),
(3, 3, 1),
(3, 4, 1),
(3, 5, 0),
(3, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mess_summary`
--

CREATE TABLE `mess_summary` (
  `mess_id` int(11) NOT NULL,
  `market_cost` int(11) NOT NULL DEFAULT '0',
  `total_meal` int(11) NOT NULL DEFAULT '0',
  `per_meal_cost` int(11) NOT NULL DEFAULT '0',
  `gas_cost` int(11) NOT NULL DEFAULT '0',
  `room_cost` int(11) NOT NULL DEFAULT '0',
  `electricity_cost` int(11) NOT NULL DEFAULT '0',
  `internet_cost` int(11) NOT NULL DEFAULT '0',
  `worker_bill` int(11) NOT NULL DEFAULT '0',
  `total_common_cost` int(11) NOT NULL DEFAULT '0',
  `month_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `month_of_year`
--

CREATE TABLE `month_of_year` (
  `moy_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `month_of_year`
--

INSERT INTO `month_of_year` (`moy_id`, `month`, `year`) VALUES
(1, 12, 2018),
(2, 4, 2018);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `person_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `address` varchar(45) NOT NULL,
  `district` varchar(25) NOT NULL DEFAULT 'Not Set',
  `versity` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`person_id`, `name`, `address`, `district`, `versity`, `password`) VALUES
(1, 'Hadiuzzaman Bappy', 'Raymanik', 'Jessore', 'KU', 'bappy'),
(2, 'Foysal Islam', 'Shatkhira', 'Shatkhira', 'KU', 'foysal'),
(3, 'Abdul Latif', 'Shirajganj', 'Shirajgonj', 'KU', 'latif'),
(4, 'Fahim Rahman', 'Nilfamari', 'Nilfamari', 'KU', 'fahim'),
(5, 'Gain', 'Dumuria', 'Khulna', 'Khulna', 'gain'),
(7, 'Rakib', 'Khulna', 'Khulna', 'KU', 'rakib');

-- --------------------------------------------------------

--
-- Table structure for table `phone_no`
--

CREATE TABLE `phone_no` (
  `person_id` int(11) NOT NULL,
  `phone_no` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phone_no`
--

INSERT INTO `phone_no` (`person_id`, `phone_no`) VALUES
(1, '01932089409'),
(2, '01987546235'),
(3, '01654987554'),
(4, '01526458795'),
(5, '01987654321'),
(7, '12345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill_taking`
--
ALTER TABLE `bill_taking`
  ADD KEY `fk_Bill_Taking_Mess_Person1_idx` (`person_id`),
  ADD KEY `fk_Bill_Taking_MESS_Information1_idx` (`mess_id`),
  ADD KEY `fk_Bill_Taking_Month1_idx` (`month_id`);

--
-- Indexes for table `email_id`
--
ALTER TABLE `email_id`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `meal_market`
--
ALTER TABLE `meal_market`
  ADD KEY `fk_Meal_Market_Mess_Person1_idx` (`person_id`),
  ADD KEY `fk_Meal_Market_Month1_idx` (`moy_id`),
  ADD KEY `mess_id` (`mess_id`);

--
-- Indexes for table `mess_admin`
--
ALTER TABLE `mess_admin`
  ADD KEY `fk_MESS_Admin_Mess_Person_idx` (`person_id`),
  ADD KEY `fk_MESS_Admin_MESS_Information1_idx` (`mess_id`);

--
-- Indexes for table `mess_information`
--
ALTER TABLE `mess_information`
  ADD PRIMARY KEY (`mess_id`);

--
-- Indexes for table `mess_meal`
--
ALTER TABLE `mess_meal`
  ADD KEY `fk_Mess_Meal_Mess_Person1_idx` (`person_id`),
  ADD KEY `fk_Mess_Meal_MESS_Information1_idx` (`mess_id`),
  ADD KEY `fk_Mess_Meal_Month_Of_Year1_idx` (`moy_id`);

--
-- Indexes for table `mess_person`
--
ALTER TABLE `mess_person`
  ADD KEY `fk_mess_person_mess_information1_idx` (`mess_id`),
  ADD KEY `fk_mess_person_person1_idx` (`person_id`);

--
-- Indexes for table `mess_summary`
--
ALTER TABLE `mess_summary`
  ADD KEY `fk_MESS_Summary_MESS_Information1_idx` (`mess_id`),
  ADD KEY `fk_MESS_Summary_Month1_idx` (`month_id`);

--
-- Indexes for table `month_of_year`
--
ALTER TABLE `month_of_year`
  ADD PRIMARY KEY (`moy_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `phone_no`
--
ALTER TABLE `phone_no`
  ADD PRIMARY KEY (`person_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mess_information`
--
ALTER TABLE `mess_information`
  MODIFY `mess_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `month_of_year`
--
ALTER TABLE `month_of_year`
  MODIFY `moy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill_taking`
--
ALTER TABLE `bill_taking`
  ADD CONSTRAINT `fk_Bill_Taking_MESS_Information1` FOREIGN KEY (`mess_id`) REFERENCES `mess_information` (`Mess_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Bill_Taking_Mess_Person1` FOREIGN KEY (`person_id`) REFERENCES `person` (`Person_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Bill_Taking_Month1` FOREIGN KEY (`month_id`) REFERENCES `month_of_year` (`MOY_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `email_id`
--
ALTER TABLE `email_id`
  ADD CONSTRAINT `fk_Email_ID_Mess_Person1` FOREIGN KEY (`person_id`) REFERENCES `person` (`Person_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `meal_market`
--
ALTER TABLE `meal_market`
  ADD CONSTRAINT `fk_Meal_Market_Mess_Person1` FOREIGN KEY (`person_id`) REFERENCES `person` (`Person_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Meal_Market_Month1` FOREIGN KEY (`moy_id`) REFERENCES `month_of_year` (`MOY_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `meal_market_ibfk_1` FOREIGN KEY (`mess_id`) REFERENCES `mess_information` (`mess_id`);

--
-- Constraints for table `mess_admin`
--
ALTER TABLE `mess_admin`
  ADD CONSTRAINT `fk_MESS_Admin_MESS_Information1` FOREIGN KEY (`mess_id`) REFERENCES `mess_information` (`Mess_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MESS_Admin_Mess_Person` FOREIGN KEY (`person_id`) REFERENCES `person` (`Person_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mess_meal`
--
ALTER TABLE `mess_meal`
  ADD CONSTRAINT `fk_Mess_Meal_MESS_Information1` FOREIGN KEY (`mess_id`) REFERENCES `mess_information` (`Mess_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Mess_Meal_Mess_Person1` FOREIGN KEY (`person_id`) REFERENCES `person` (`Person_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Mess_Meal_Month_Of_Year1` FOREIGN KEY (`moy_id`) REFERENCES `month_of_year` (`MOY_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mess_person`
--
ALTER TABLE `mess_person`
  ADD CONSTRAINT `fk_mess_person_mess_information1` FOREIGN KEY (`mess_id`) REFERENCES `mess_information` (`Mess_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mess_person_person1` FOREIGN KEY (`person_id`) REFERENCES `person` (`Person_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mess_summary`
--
ALTER TABLE `mess_summary`
  ADD CONSTRAINT `fk_MESS_Summary_MESS_Information1` FOREIGN KEY (`mess_id`) REFERENCES `mess_information` (`Mess_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MESS_Summary_Month1` FOREIGN KEY (`month_id`) REFERENCES `month_of_year` (`MOY_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `phone_no`
--
ALTER TABLE `phone_no`
  ADD CONSTRAINT `fk_Phone_NO_Mess_Person1` FOREIGN KEY (`person_id`) REFERENCES `person` (`Person_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
