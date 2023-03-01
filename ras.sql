-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2023 at 09:47 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ras`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_apartment` (IN `availability` INT)   SELECT * FROM `apartment` a WHERE a.availability = availability$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_apartment_with_location` (IN `cit` VARCHAR(100), IN `than` VARCHAR(100), IN `are` VARCHAR(100), IN `minimum` INT, IN `maximum` INT, IN `bh` INT, IN `floo` INT)   SELECT * 
FROM apartment a 
NATURAL JOIN location l 
NATURAL JOIN building b
WHERE a.availability = 1 AND 
a.rentpermonth BETWEEN minimum AND maximum AND
(bh = -1 || a.BHK = bh) AND
(floo = -1 || a.floor = floo) AND 
(than = 'none' || l.thana = than) AND 
 (are = 'none' || l.area = are) AND 
 (cit = 'none' || l.city = cit)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_expense` (IN `month` VARCHAR(100), IN `holding` BIGINT)   SELECT *
FROM expense
where date LIKE 'month-%' and holdingNumber = holding$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_owners` (IN `holding` INT)   SELECT * 
FROM owner
NATURAL JOIN own
WHERE holdingNumber = holding$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `apartment`
--

CREATE TABLE `apartment` (
  `ApartmentID` varchar(100) NOT NULL,
  `holdingNumber` bigint(20) NOT NULL,
  `rentpermonth` double NOT NULL,
  `size` double NOT NULL,
  `availability` tinyint(1) NOT NULL DEFAULT 1,
  `BHK` int(100) NOT NULL,
  `video` varchar(200) NOT NULL,
  `floor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apartment`
--

INSERT INTO `apartment` (`ApartmentID`, `holdingNumber`, `rentpermonth`, `size`, `availability`, `BHK`, `video`, `floor`) VALUES
('123456-1A', 123456, 35000, 2400, 0, 4, 'apartments/123456-1A.mp4', 1),
('123456-1B', 123456, 50000, 3200, 0, 5, 'apartments/123456-1B.mp4', 1),
('123456-2A', 123456, 48000, 3000, 1, 4, 'apartments/123456-2A.mp4', 2),
('123456-2B', 123456, 48000, 3000, 1, 4, 'apartments/123456-2B.mp4', 2),
('123457-1A', 123457, 60000, 3500, 0, 5, 'apartments/123457-1A.mp4', 1),
('123457-1B', 123457, 70000, 4000, 1, 6, 'apartments/123457-1B.mp4', 1),
('123457-1C', 123457, 60000, 3500, 1, 4, 'apartments/123457-1C.mp4', 1),
('123457-1D', 123457, 60000, 3500, 1, 4, 'apartments/123457-1D.mp4', 1),
('123458-3A', 123458, 15000, 800, 0, 3, 'apartments/123458-3A.mp4', 3),
('123458-3B', 123458, 23500, 1000, 1, 3, 'apartments/123458-3B.mp4', 3),
('123458-4C', 123458, 22500, 1000, 1, 3, 'apartments/123458-4C.mp4', 4),
('123458-5A', 123458, 26000, 1200, 1, 3, 'apartments/123458-5A.mp4', 5);

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `holdingNumber` bigint(20) NOT NULL,
  `buildingName` varchar(200) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`holdingNumber`, `buildingName`, `image`) VALUES
(123456, 'Minhaz House', 'building/123456.jpg'),
(123457, 'Ali Hossain Masters House', 'building/123457.png'),
(123458, 'Shible Palace', 'building/123458.png');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` bigint(20) NOT NULL,
  `holdingNumber` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `paid_by` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `holdingNumber` bigint(20) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `area` varchar(100) NOT NULL,
  `thana` varchar(100) NOT NULL,
  `houseNo` int(100) NOT NULL,
  `block` varchar(100) NOT NULL,
  `google_map_location` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`holdingNumber`, `street`, `city`, `area`, `thana`, `houseNo`, `block`, `google_map_location`) VALUES
(123456, '12', 'Chattogram', 'South Kulshi', 'Kulshi', 2, 'B', 'https://goo.gl/maps/HvSppqecUkbKrwAm6'),
(123457, '13', 'Chattogram', 'Kala Mia Bazar', 'Bakolia', 6, 'D', 'https://goo.gl/maps/k5WMckXvJapYz9Fa7'),
(123458, '17', 'Chattogram', 'Kala Mia Bazar', 'Bakolia', 7, 'E', 'https://goo.gl/maps/ncaNGtCrp4eSvzca7');

-- --------------------------------------------------------

--
-- Table structure for table `own`
--

CREATE TABLE `own` (
  `email` varchar(100) NOT NULL,
  `holdingNumber` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `own`
--

INSERT INTO `own` (`email`, `holdingNumber`) VALUES
('easin33384@gmail.com', 123456),
('shible0805@gmail.com', 123456),
('shible0805@gmail.com', 123458),
('tajbir26@gmail.com', 123457);

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`first_name`, `last_name`, `phone`, `email`, `image`) VALUES
('Emam', 'Hossain', '+8801628615864', 'easin33384@gmail.com', 'owner/easin33384@gmail.com.jpg'),
('Salauddin', 'Shible', '01738668434', 'shible0805@gmail.com', 'owner/shible0805@gmail.com.jpg'),
('Tajbir', 'Ahmed', '01811623615', 'tajbir26@gmail.com', 'owner/tajbir26@gmail.com.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ownership_request`
--

CREATE TABLE `ownership_request` (
  `holdingNumber` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ownership_request`
--

INSERT INTO `ownership_request` (`holdingNumber`, `email`, `status`) VALUES
(123456, 'shible0805@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `ApartmentID` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `rent_of` varchar(100) NOT NULL,
  `paid_date` date DEFAULT NULL,
  `verify` varchar(100) DEFAULT NULL,
  `type` varchar(100) NOT NULL,
  `tnx_id` varchar(100) NOT NULL,
  `verified_by` varchar(100) DEFAULT NULL,
  `verified_at` date DEFAULT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_history`
--

INSERT INTO `payment_history` (`ApartmentID`, `name`, `rent_of`, `paid_date`, `verify`, `type`, `tnx_id`, `verified_by`, `verified_at`, `amount`) VALUES
('123456-1A', '', '2023-03', NULL, NULL, '', '', NULL, NULL, 0),
('123456-1B', '', '2023-03', NULL, NULL, '', '', NULL, NULL, 0),
('123456-2A', '', '2023-03', NULL, NULL, '', '', NULL, NULL, 0),
('123456-2B', '', '2023-03', NULL, NULL, '', '', NULL, NULL, 0),
('123457-1A', '', '2023-03', NULL, NULL, '', '', NULL, NULL, 0),
('123457-1B', '', '2023-03', NULL, NULL, '', '', NULL, NULL, 0),
('123457-1C', '', '2023-03', NULL, NULL, '', '', NULL, NULL, 0),
('123457-1D', '', '2023-03', NULL, NULL, '', '', NULL, NULL, 0),
('123458-3A', '', '2023-03', NULL, NULL, '', '', NULL, NULL, 0),
('123458-3B', '', '2023-03', NULL, NULL, '', '', NULL, NULL, 0),
('123458-4C', '', '2023-03', NULL, NULL, '', '', NULL, NULL, 0),
('123458-5A', '', '2023-03', NULL, NULL, '', '', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `holdingNumber` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `staffid` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `joining_date` date NOT NULL DEFAULT current_timestamp(),
  `salary` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `ApartmentID` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `nid` varchar(100) NOT NULL,
  `fdesc` varchar(300) NOT NULL,
  `registerddate` date NOT NULL DEFAULT current_timestamp(),
  `nid_image` varchar(200) NOT NULL,
  `advanced_amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`ApartmentID`, `first_name`, `last_name`, `phone`, `email`, `image`, `nid`, `fdesc`, `registerddate`, `nid_image`, `advanced_amount`) VALUES
('123456-1A', 'Shahriad', 'Hossain', '+01880962305', 'hossainshahriad@gmail.com', 'tenant/123456-1A.jpg', '1234', 'Toatal 6 members including 2 children', '2022-12-01', 'nid/123456-1A.png', 35000),
('123456-1B', 'Salauddin', 'Shible', '01738668434', 'shible0805@gmail.com', 'tenant/123456-1B.jpg', '1234', 'Total 7 members.', '2022-12-01', 'nid/123456-1B.png', 50000),
('123457-1A', 'Imtiaj', 'Aoual', '+8801811623615', 'easin33384@gmail.com', 'tenant/123457-1A.jpg', '1234', 'Total 15 members', '2022-12-01', 'nid/123457-1A.png', 50000),
('123458-3A', 'Tajbir', 'Ahmed', '+8801811623615', 'tajbir26@gmail.com', 'tenant/123458-3A.jpg', '1234', 'total 3 members.', '2022-12-01', 'nid/123458-3A.png', 40000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `type`) VALUES
('123456-1A@ras.com', '1234', 'tenant'),
('123456-1B@ras.com', '1234', 'tenant'),
('123457-1A@ras.com', '1234', 'tenant'),
('123458-3A@ras.com', '1234', 'tenant'),
('easin33384@gmail.com', '1234', 'owner'),
('shible0805@gmail.com', '1234', 'owner'),
('tajbir26@gmail.com', '1234', 'owner'),
('tajbir@gmail.com', '123456', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apartment`
--
ALTER TABLE `apartment`
  ADD PRIMARY KEY (`ApartmentID`),
  ADD KEY `ApartmentID` (`ApartmentID`),
  ADD KEY `holdingNumber` (`holdingNumber`);

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`holdingNumber`),
  ADD KEY `holdingNumber` (`holdingNumber`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`),
  ADD KEY `holdingNumber` (`holdingNumber`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`holdingNumber`),
  ADD KEY `holdingNumber` (`holdingNumber`);

--
-- Indexes for table `own`
--
ALTER TABLE `own`
  ADD PRIMARY KEY (`email`,`holdingNumber`),
  ADD KEY `email` (`email`),
  ADD KEY `holdingNumber` (`holdingNumber`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`email`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `ownership_request`
--
ALTER TABLE `ownership_request`
  ADD PRIMARY KEY (`holdingNumber`,`email`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`ApartmentID`,`rent_of`),
  ADD KEY `ApartmentID` (`ApartmentID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffid`),
  ADD KEY `holdingNumber` (`holdingNumber`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`ApartmentID`),
  ADD KEY `apartmentid` (`ApartmentID`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `holdingNumber` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123459;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apartment`
--
ALTER TABLE `apartment`
  ADD CONSTRAINT `apartment_ibfk_1` FOREIGN KEY (`holdingNumber`) REFERENCES `building` (`holdingNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `expense_ibfk_1` FOREIGN KEY (`holdingNumber`) REFERENCES `building` (`holdingNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`holdingNumber`) REFERENCES `building` (`holdingNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `own`
--
ALTER TABLE `own`
  ADD CONSTRAINT `own_ibfk_1` FOREIGN KEY (`email`) REFERENCES `owner` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `own_ibfk_2` FOREIGN KEY (`holdingNumber`) REFERENCES `building` (`holdingNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `owner`
--
ALTER TABLE `owner`
  ADD CONSTRAINT `owner_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ownership_request`
--
ALTER TABLE `ownership_request`
  ADD CONSTRAINT `ownership_request_ibfk_1` FOREIGN KEY (`holdingNumber`) REFERENCES `building` (`holdingNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD CONSTRAINT `payment_history_ibfk_1` FOREIGN KEY (`ApartmentID`) REFERENCES `apartment` (`ApartmentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`holdingNumber`) REFERENCES `building` (`holdingNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tenant`
--
ALTER TABLE `tenant`
  ADD CONSTRAINT `tenant_ibfk_1` FOREIGN KEY (`ApartmentID`) REFERENCES `apartment` (`ApartmentID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
