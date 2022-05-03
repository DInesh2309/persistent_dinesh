-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2022 at 02:59 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `router_details`
--

CREATE TABLE `router_details` (
  `Id` int(10) NOT NULL,
  `Sapid` varchar(18) DEFAULT NULL,
  `Hostname` varchar(14) DEFAULT NULL,
  `Loopback` varchar(15) DEFAULT NULL,
  `Macaddress` varchar(17) DEFAULT NULL,
  `status` enum('A','I','D') NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `router_details`
--

INSERT INTO `router_details` (`Id`, `Sapid`, `Hostname`, `Loopback`, `Macaddress`, `status`) VALUES
(1, 'SAP-DINESH-MH-123B', 'DINESHM1234AAB', '255.254.254.255', 'D8-9C-67-AE-5B-23', 'A'),
(2, 'SAP-DINESH-MH-123A', 'DINESHM1234AAA', '255.254.254.254', 'D8-9C-67-AE-5B-24', 'A'),
(3, 'SAP-DINESH-MH-123C', 'DINESHM1234AAC', '255.254.254.255', 'D8-9C-67-AE-5B-23', 'A'),
(4, 'SAP-DINESH-MH-123D', 'DINESHM1234AAD', '255.254.254.253', 'D8-9C-67-AE-5B-24', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `router_details`
--
ALTER TABLE `router_details`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `router_details`
--
ALTER TABLE `router_details`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
