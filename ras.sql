-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2023 at 01:01 PM
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
('12346-1A', 12346, 23000, 2200, 0, 3),
('12346-1B', 12346, 22000, 2000, 0, 2),
('12346-1C', 12346, 24000, 2300, 0, 3),
('12346-1D', 12346, 23000, 2200, 0, 3),
('12346-2A', 12346, 20000, 2100, 0, 2),
('12347-1A', 12347, 25000, 2200, 0, 3),
('12347-1B', 12347, 25000, 2200, 0, 1),
('12347-1C', 12347, 25000, 2200, 0, 3),
('12347-1D', 12347, 25000, 2200, 0, 1),
('12348-1A', 12348, 25000, 2200, 0, 2),
('12348-1B', 12348, 25000, 2200, 0, 1),
('12348-1D', 12348, 25000, 2200, 0, 2),
('12349-1A', 12349, 23000, 2400, 0, 2),
('12349-1B', 12349, 26000, 2100, 0, 3);

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
(12345, 'Professor Villa', 'building\\12345.jpg'),
(12346, 'Nilima House', 'building\\12346.jpg'),
(12347, 'Moniloy Cottage', 'building\\12347.jpg'),
(12348, 'Riton Flat', 'building\\12348.jpg'),
(12349, 'Liverpool Enterprise', 'building\\12349.jpg'),
(12350, 'Manchester City Palace', 'building\\12350.jpg'),
(12351, 'Salah Palace Ltd.', 'building/12351.jpg'),
(12352, 'Aston Villa', 'building/12352.jpg'),
(12353, 'Messi Palace', 'building/12353.jpg');

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
(12345, 'Road No.2', 'Chattogram', 'Sughandha', 'Panchlaish', 25),
(12346, 'Road No. 5', 'Chattogram', 'Cosmopoliton', 'Panchlaish', 33),
(12347, 'Road no. 1', 'Chattogram', 'Chandgaon', 'Chandgaon', 23),
(12348, 'Road no. 8', 'Chattogram', 'CDA', 'Agrabad', 41);

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
('alvarez19@gmail.com', 12353),
('cr7@gmail.com', 12345),
('cr7@gmail.com', 12347),
('haaland9@gmail.com', 12350),
('km7@gmail.com', 12346),
('martinez23@gmail.com', 12352),
('messi10@gmail.com', 12345),
('neymar10@gmail.com', 12348),
('salah11@gmail.com', 12349),
('salah11@gmail.com', 12351);

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
('Julian', 'Alvarez', '0238741', 'alvarez19@gmail.com', 'owner/alvarez19@gmail.com.jpg'),
('Cristiano', 'Ronaldo', '+8801813548796', 'cr7@gmail.com', 'owner\\cr7@gmail.com.png'),
('Erling', 'Haaland', '2187348', 'haaland9@gmail.com', 'owner\\haaland9@gmail.com.jpg'),
('Kylian', 'Mbappe', '2342374', 'km7@gmail.com', 'owner\\km7@gmail.com.jpg'),
('Emi', 'Martinez', '2341234', 'martinez23@gmail.com', 'owner/martinez23@gmail.com.jpg'),
('Lionel', 'Messi', '+8801813548764', 'messi10@gmail.com', 'owner\\messi10@gmail.com.jpg'),
('Neymar', 'Jr', '+8801813548782', 'neymar10@gmail.com', 'owner\\neymar10@gmail.com.jpg'),
('Mohammad', 'Salah', '2187348', 'salah11@gmail.com', 'owner\\salah11@gmail.com.jpg');

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
  `registerddate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`ApartmentID`, `first_name`, `last_name`, `phone`, `email`, `image`, `nid`, `fdesc`, `registerddate`) VALUES
('12346-1A', 'Tajbir', 'Ahmed', '01811623515', 'tajbir11@gmail.com', '', '2341236493', '', '2022-11-05'),
('12346-1B', 'Robiul', 'Apu', '0181384752', 'Robiul34@gmail.com', '', '234124326', '', '2022-12-12'),
('12346-1C', 'Shajidul', 'Islam', '1811623615', 'shajidul@gmail.com', '', '23471283748291', 'Four girlfriend and no wife', '2023-02-18'),
('12346-1D', 'Emam', 'Easin', '0181384298', 'Easin78@gmail.com', '', '5626234510', '', '2022-08-15'),
('12346-2A', 'Sanim', 'Sourav', '32487520347', 'sourav69@gmail.com', '', '832475234', 'trying to find a girl', '2023-02-18'),
('12347-1A', 'Salauddin', 'Shible', '0123456778', 'shible10@gmail.com', '', '2341345367', '', '2023-01-11'),
('12347-1B', 'Yeasin', 'Arafat', '0181384234', 'Yeasin69@gmail.com', '', '5463563243', '', '2023-01-23'),
('12347-1C', 'Lionel', 'Messi', '+8801811623615', 'messi10@gmail.com', '', '23471283748291', 'total 7 members', '2023-02-15'),
('12347-1D', 'Aoual', 'Imtiaj', '0181384243', 'imtiaj6969@gmail.com', '', '895723452', '', '2023-01-01'),
('12348-1A', 'Md.', 'Shahariad', '01832457381', 'shahriad@hotmail.com', '', '23146751234', '', '2023-01-01'),
('12348-1B', 'Mehedi', 'Sabbir', '0181384267', 'Sabbir35@gmail.com', '', '7465746573', '', '2023-01-01'),
('12348-1D', 'Riduan', 'Islam', '0181384290', 'riduan55@gmail.com', '', '452343457', '', '2022-07-01'),
('12349-1A', 'Marcus', 'Rashford', '1811623615', 'rashford10@gmail.com', 'tenant/12349-1A.jpg', '23471283748291', 'Single', '2023-02-19'),
('12349-1B', 'Bruno', 'Fernandez', '83745230485', 'bruno8@gmail.com', 'tenant/12349-1B.png', '2837401234', 'Married ', '2023-02-19');

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
('12346-1C@ras.com', '23471283748291', 'tenant'),
('12346-2A@ras.com', '832475234', 'tenant'),
('12347-1C@ras.com', '23471283748291', 'tenant'),
('12349-1A@ras.com', '23471283748291', 'tenant'),
('12349-1B@ras.com', '1234', 'tenant'),
('alvarez19@gmail.com', '1234', 'owner'),
('cr7@gmail.com', 'suiii', 'owner'),
('haaland9@gmail.com', '1234', 'owner'),
('km7@gmail.com', 'psgfan', 'owner'),
('martinez23@gmail.com', '1234', 'owner'),
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
  MODIFY `holdingNumber` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12354;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apartment`
--
ALTER TABLE `apartment`
  ADD CONSTRAINT `apartment_ibfk_1` FOREIGN KEY (`holdingNumber`) REFERENCES `building` (`holdingNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `tenant`
--
ALTER TABLE `tenant`
  ADD CONSTRAINT `tenant_ibfk_1` FOREIGN KEY (`ApartmentID`) REFERENCES `apartment` (`ApartmentID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
