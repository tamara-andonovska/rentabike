-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2021 at 10:47 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentabike`
--

-- --------------------------------------------------------

--
-- Table structure for table `bike`
--

CREATE TABLE `bike` (
  `ID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `barcode` int(8) NOT NULL,
  `model` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bike`
--

INSERT INTO `bike` (`ID`, `categoryID`, `barcode`, `model`, `price`) VALUES
(1, 1, 18971524, 'Cannondale SuperSix Evo ', 500),
(2, 2, 67213895, 'Airborne Seeker', 350),
(3, 3, 74852674, 'BLVD Singlespeed Bike', 300),
(4, 1, 22658743, 'Pinarello Dogma F12', 450),
(5, 1, 37891525, 'Cannondale SystemSix Hi-Mod', 620),
(6, 1, 42356977, 'Wilier Zero SLR Disc Dura-Ace Di2', 550),
(7, 3, 98653241, 'DELFIN - CORE-LINE', 380),
(8, 3, 87456241, '4130 - PERPLEXING PURPLE', 400),
(9, 2, 15156982, 'Specialized Ruze', 420);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `name`) VALUES
(1, 'road bike'),
(2, 'mountain bike'),
(3, 'fixie');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `ime` varchar(20) NOT NULL,
  `prezime` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`ime`, `prezime`, `email`, `user`, `pass`) VALUES
('Tamara', 'Andonovska', 'tami_andonovska@hotmail.com', 'tams', '123456789'),
('Tamara', 'Andonovska', 't.andonovska8@gmail.com', 'Tamara', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `rent`
--

CREATE TABLE `rent` (
  `ID` int(11) NOT NULL,
  `dateFrom` datetime NOT NULL,
  `dateTo` datetime NOT NULL,
  `barcode` int(11) NOT NULL,
  `totalPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rent`
--

INSERT INTO `rent` (`ID`, `dateFrom`, `dateTo`, `barcode`, `totalPrice`) VALUES
(12, '2021-07-22 11:54:00', '2021-08-19 11:54:00', 18971524, 425),
(34, '2021-07-21 16:04:00', '2021-07-22 16:04:00', 67213895, 297),
(36, '2021-07-14 16:08:00', '2021-07-21 16:08:00', 74852674, 240),
(38, '2021-08-01 16:12:00', '2021-08-02 16:12:00', 74852674, 255),
(41, '2021-08-24 11:30:00', '2021-08-30 11:30:00', 18971524, 425),
(42, '2021-08-24 11:30:00', '2021-08-30 11:30:00', 67213895, 297),
(45, '2021-09-01 15:12:00', '2021-09-30 15:12:00', 18971524, 400),
(46, '2021-09-05 15:12:00', '2021-09-12 15:12:00', 67213895, 280),
(59, '2021-08-18 16:47:00', '2021-08-25 16:47:00', 74852674, 240),
(60, '2021-11-07 16:52:00', '2021-11-12 16:52:00', 74852674, 255),
(68, '2023-06-06 18:39:00', '2023-06-14 18:39:00', 74852674, 240),
(72, '2021-07-01 17:22:00', '2021-07-03 17:22:00', 67213895, 297),
(73, '2021-10-06 15:45:00', '2021-10-07 15:45:00', 18971524, 425),
(74, '2021-11-17 19:52:00', '2021-11-20 19:52:00', 67213895, 297),
(75, '2021-11-13 22:39:00', '2021-11-14 22:39:00', 67213895, 297),
(76, '2021-12-09 22:46:00', '2021-12-12 22:46:00', 67213895, 297),
(77, '2021-12-02 22:51:00', '2021-12-03 22:51:00', 42356977, 467),
(78, '2021-12-04 22:52:00', '2021-12-05 22:52:00', 42356977, 467),
(82, '2021-12-30 23:09:00', '2021-12-31 23:09:00', 22658743, 382),
(83, '2021-12-25 23:10:00', '2021-12-26 23:10:00', 87456241, 340),
(84, '2022-01-12 23:55:00', '2022-01-13 23:55:00', 15156982, 357),
(85, '2022-01-20 00:01:00', '2022-01-21 00:01:00', 74852674, 255);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bike`
--
ALTER TABLE `bike`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `rent`
--
ALTER TABLE `rent`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bike`
--
ALTER TABLE `bike`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rent`
--
ALTER TABLE `rent`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
