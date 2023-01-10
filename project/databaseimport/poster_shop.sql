-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2022 at 02:05 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poster_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_accounts`
--

DROP TABLE IF EXISTS `customer_accounts`;
CREATE TABLE `customer_accounts` (
  `firts_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `zip_code` int(8) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `building_house_number` varchar(255) NOT NULL,
  `cc_pin` int(4) NOT NULL,
  `cc_expiration` varchar(255) NOT NULL,
  `cc_number` int(19) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_cart`
--

DROP TABLE IF EXISTS `customer_cart`;
CREATE TABLE `customer_cart` (
  `customer_email` varchar(255) NOT NULL,
  `purchased_state` tinyint(1) NOT NULL,
  `customer_first_name` varchar(255) NOT NULL,
  `customer_lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `first_Name` varchar(255) NOT NULL,
  `last_Name` varchar(255) NOT NULL,
  `employee_ID` int(8) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`first_Name`, `last_Name`, `employee_ID`, `role`) VALUES
('Vincent', 'DeRoma', 1, 'Accountant'),
('Viren', 'Bhavsar', 2, 'Human Resources');

-- --------------------------------------------------------

--
-- Table structure for table `employee_login`
--

DROP TABLE IF EXISTS `employee_login`;
CREATE TABLE `employee_login` (
  `emp_id` int(8) NOT NULL,
  `emp_username` varchar(255) NOT NULL,
  `emp_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_login`
--

INSERT INTO `employee_login` (`emp_id`, `emp_username`, `emp_password`) VALUES
(2, 'virenb', '$2y$10$8Gc.2CazriPsV7fQfa8Sue8Y8drp0.0Fh3can6Tmktcgkesw5agmq');

-- --------------------------------------------------------

--
-- Table structure for table `employee_roles`
--

DROP TABLE IF EXISTS `employee_roles`;
CREATE TABLE `employee_roles` (
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_roles`
--

INSERT INTO `employee_roles` (`role_name`) VALUES
('Accountant'),
('Human Resources'),
('Inventory Manager'),
('Product Manager'),
('Shipping Manager');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `productID` int(3) NOT NULL,
  `posterName` varchar(255) NOT NULL,
  `quantity` float NOT NULL,
  `price` float NOT NULL,
  `visibility` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`productID`, `posterName`, `quantity`, `price`, `visibility`) VALUES
(1, 'Place Holder', 20, 20.2, 1),
(2, 'Kids on Bikes', 20, 20.2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `poster`
--

DROP TABLE IF EXISTS `poster`;
CREATE TABLE `poster` (
  `productID` int(3) NOT NULL,
  `imageFile` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `orientation` tinyint(1) NOT NULL,
  `color_profile` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poster`
--

INSERT INTO `poster` (`productID`, `imageFile`, `category`, `orientation`, `color_profile`) VALUES
(1, './1.jpg', 'Cars', 1, 1),
(2, './2.jpg', 'Street', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `poster_category`
--

DROP TABLE IF EXISTS `poster_category`;
CREATE TABLE `poster_category` (
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poster_category`
--

INSERT INTO `poster_category` (`category`) VALUES
('Cars'),
('City'),
('Street');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_accounts`
--
ALTER TABLE `customer_accounts`
  ADD PRIMARY KEY (`email_address`),
  ADD KEY `firts_name` (`firts_name`,`last_name`),
  ADD KEY `last_name` (`last_name`);

--
-- Indexes for table `customer_cart`
--
ALTER TABLE `customer_cart`
  ADD KEY `customer_email` (`customer_email`),
  ADD KEY `customer_first_name` (`customer_first_name`),
  ADD KEY `customer_lastname` (`customer_lastname`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_ID`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `employee_login`
--
ALTER TABLE `employee_login`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `employee_roles`
--
ALTER TABLE `employee_roles`
  ADD PRIMARY KEY (`role_name`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `poster`
--
ALTER TABLE `poster`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `poster_category`
--
ALTER TABLE `poster_category`
  ADD PRIMARY KEY (`category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `poster`
--
ALTER TABLE `poster`
  MODIFY `productID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_cart`
--
ALTER TABLE `customer_cart`
  ADD CONSTRAINT `customer_email` FOREIGN KEY (`customer_email`) REFERENCES `customer_accounts` (`email_address`),
  ADD CONSTRAINT `customer_first_name` FOREIGN KEY (`customer_first_name`) REFERENCES `customer_accounts` (`firts_name`),
  ADD CONSTRAINT `customer_last_name` FOREIGN KEY (`customer_lastname`) REFERENCES `customer_accounts` (`last_name`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_type` FOREIGN KEY (`role`) REFERENCES `employee_roles` (`role_name`);

--
-- Constraints for table `employee_login`
--
ALTER TABLE `employee_login`
  ADD CONSTRAINT `employee` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`employee_ID`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `porduct_ID` FOREIGN KEY (`productID`) REFERENCES `poster` (`productID`);

--
-- Constraints for table `poster`
--
ALTER TABLE `poster`
  ADD CONSTRAINT `catgegory` FOREIGN KEY (`category`) REFERENCES `poster_category` (`category`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
