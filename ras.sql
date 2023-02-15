-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2023 at 07:34 PM
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
  `BHK` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apartment`
--

INSERT INTO `apartment` (`ApartmentID`, `holdingNumber`, `rentpermonth`, `size`, `availability`, `BHK`) VALUES
('', 0, 0, 0, 1, 0),
('1A', 0, 22000, 2000, 1, 4),
('1A', 12332, 22000, 2000, 1, 2),
('1A', 12345, 25000, 2200, 0, 3),
('1A', 12346, 25000, 2200, 0, 1),
('1A', 12347, 25000, 2200, 0, 3),
('1A', 12348, 25000, 2200, 0, 2),
('1B', 12345, 25000, 2200, 0, 2),
('1B', 12346, 25000, 2200, 0, 2),
('1B', 12347, 25000, 2200, 0, 1),
('1B', 12348, 25000, 2200, 0, 1),
('1C', 12345, 25000, 2200, 1, 4),
('1C', 12346, 25000, 2200, 1, 5),
('1C', 12347, 25000, 2200, 1, 3),
('1C', 12348, 25000, 2200, 1, 2),
('1D', 12345, 25000, 2200, 0, 3),
('1D', 12346, 25000, 2200, 0, 2),
('1D', 12347, 25000, 2200, 0, 1),
('1D', 12348, 25000, 2200, 0, 2),
('2A', 12345, 22000, 2100, 1, 2),
('2A', 12346, 22000, 2100, 1, 3),
('2A', 12347, 22000, 2100, 1, 2),
('2A', 12348, 22000, 2100, 1, 1),
('2B', 12345, 24000, 2300, 1, 3),
('2B', 12346, 24000, 2300, 1, 2),
('2B', 12347, 24000, 2300, 1, 2),
('2B', 12348, 24000, 2300, 1, 2),
('2C', 12345, 24000, 2100, 0, 2),
('2C', 12346, 24000, 2100, 0, 0),
('2C', 12347, 24000, 2100, 0, 0),
('2C', 12348, 24000, 2100, 0, 0),
('2D', 12345, 28000, 2500, 1, 0),
('2D', 12346, 28000, 2500, 1, 0),
('2D', 12347, 28000, 2500, 1, 0),
('2D', 12348, 28000, 2500, 1, 0),
('3A', 12345, 24000, 2300, 1, 0),
('3A', 12346, 24000, 2300, 1, 0),
('3A', 12347, 24000, 2300, 1, 0),
('3A', 12348, 24000, 2300, 1, 0),
('3B', 12345, 19000, 2000, 0, 0),
('3B', 12346, 19000, 2000, 0, 0),
('3B', 12347, 19000, 2000, 0, 0),
('3B', 12348, 19000, 2000, 0, 0),
('3C', 12345, 18000, 2300, 1, 0),
('3C', 12346, 18000, 2300, 1, 0),
('3C', 12347, 18000, 2300, 1, 0),
('3C', 12348, 18000, 2300, 1, 0),
('3D', 12345, 25000, 2500, 1, 0),
('3D', 12346, 25000, 2500, 1, 0),
('3D', 12347, 25000, 2500, 1, 0),
('3D', 12348, 25000, 2500, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `holdingNumber` bigint(20) NOT NULL,
  `buildingName` varchar(200) NOT NULL,
  `image` varchar(150) NOT NULL,
  `ownerID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`holdingNumber`, `buildingName`, `image`, `ownerID`) VALUES
(12332, 'Jurgen Klopp Housing Ltd.', '', 9),
(12333, 'Salah Palace Ltd.', '', 9),
(12345, 'ABC Limited', '', 0),
(12346, 'DEF Limited', '', 0),
(12347, 'GHI Limited', '', 0),
(12348, 'JKL Limited', '', 0);

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
  `houseNo` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`holdingNumber`, `street`, `city`, `area`, `thana`, `houseNo`) VALUES
(12345, 'Road no. 2', 'Chattogram', 'Sugondha', 'Panchlaish', 25),
(12346, 'Road no. 5', 'Chattogram', 'Cosmopoliton', 'Panchlaish', 33),
(12347, 'Road no. 1', 'Chattogram', 'Chandgaon', 'Chandgaon', 23),
(12348, 'Road no. 8', 'Chattogram', 'CDA', 'Agrabad', 41);

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `ownerID` bigint(20) NOT NULL,
  `holdingNumber` bigint(20) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`ownerID`, `holdingNumber`, `first_name`, `last_name`, `phone`, `email`, `image`) VALUES
(1, 12345, 'Lionel', 'Messi', '+8801813548764', 'messi10@gmail.com', ''),
(2, 12346, 'Neymar', 'Jr', '+8801813548782', 'neymar10@gmail.com', ''),
(3, 12347, 'Cristiano', 'Ronaldo', '+8801813548796', 'cr7@gmail.com', ''),
(3, 12348, 'Cristiano', 'Ronaldo', '+8801813548796', 'cr7@gmail.com', ''),
(4, 12346, 'Kylian', 'Mbappe', '+8801813548745', 'km7@gmail.com', ''),
(9, 12332, 'Mohammad', 'Salah', '2187348', 'salah11@gmail.com', ''),
(9, 12333, 'Mohammad', 'Salah', '2187348', 'salah11@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `holdingNumber` bigint(20) NOT NULL,
  `apartmentid` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `nid` varchar(100) NOT NULL,
  `fdesc` varchar(300) NOT NULL,
  `registerddate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`holdingNumber`, `apartmentid`, `first_name`, `last_name`, `phone`, `email`, `image`, `nid`, `fdesc`, `registerddate`) VALUES
(12345, '1A', 'Emam', 'Hossain', '01628615864', 'emam10@gmail.com', '', '8705214356', '', '2023-02-01'),
(12345, '1B', 'Elon', 'Musk', '0181237641289', 'elon.musk@gmail.com', '', '2183741234', '', '2023-01-01'),
(12345, '1D', 'Jahedul', 'Sumon', '0181384223', 'Sumon66@gmail.com', '', '7641234651', '', '2022-10-01'),
(12346, '1A', 'Tajbir', 'Ahmed', '01811623515', 'tajbir11@gmail.com', '', '2341236493', '', '2022-11-05'),
(12346, '1B', 'Robiul', 'Apu', '0181384752', 'Robiul34@gmail.com', '', '234124326', '', '2022-12-12'),
(12346, '1D', 'Emam', 'Easin', '0181384298', 'Easin78@gmail.com', '', '5626234510', '', '2022-08-15'),
(12347, '1A', 'Salauddin', 'Shible', '0123456778', 'shible10@gmail.com', '', '2341345367', '', '2023-01-11'),
(12347, '1B', 'Yeasin', 'Arafat', '0181384234', 'Yeasin69@gmail.com', '', '5463563243', '', '2023-01-23'),
(12347, '1C', 'Lionel', 'Messi', '+8801811623615', 'messi10@gmail.com', '', '23471283748291', 'total 7 members', '2023-02-15'),
(12347, '1D', 'Aoual', 'Imtiaj', '0181384243', 'imtiaj6969@gmail.com', '', '895723452', '', '2023-01-01'),
(12348, '1A', 'Md.', 'Shahariad', '01832457381', 'shahriad@hotmail.com', '', '23146751234', '', '2023-01-01'),
(12348, '1B', 'Mehedi', 'Sabbir', '0181384267', 'Sabbir35@gmail.com', '', '7465746573', '', '2023-01-01'),
(12348, '1D', 'Riduan', 'Islam', '0181384290', 'riduan55@gmail.com', '', '452343457', '', '2022-07-01');

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
('123471C@ras.com', '23471283748291', 'tenant'),
('cr7@gmail.com', 'suiii', 'owner'),
('km7@gmail.com', 'psgfan', 'owner'),
('messi10@gmail.com', '123321', 'owner'),
('neymar10@gmail.com', 'natalia', 'owner'),
('salah11@gmail.com', '1234', 'owner'),
('tajbir@gmail.com', '123456', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apartment`
--
ALTER TABLE `apartment`
  ADD PRIMARY KEY (`ApartmentID`,`holdingNumber`);

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`holdingNumber`),
  ADD KEY `holdingNumber` (`holdingNumber`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`holdingNumber`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`ownerID`,`holdingNumber`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`holdingNumber`,`apartmentid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `holdingNumber` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12350;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `ownerID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
