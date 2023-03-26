-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 26, 2023 at 03:33 PM
-- Server version: 8.0.32-0ubuntu0.20.04.2
-- PHP Version: 7.4.3-4ubuntu2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `entranceManager`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int NOT NULL,
  `uuid` char(36) NOT NULL,
  `userId` int NOT NULL,
  `state` smallint NOT NULL COMMENT '1=FingerPrint, 4=RFID Card, 25=Palm\r\n15=Face',
  `deviceId` int NOT NULL,
  `companyId` int NOT NULL,
  `locationId` int NOT NULL,
  `deviceTime` datetime NOT NULL,
  `isSync` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'OPS Sync State 0=No, 1=Yes',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=Inactive, 1=Active',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `id` int NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(50) NOT NULL,
  `companyId` int NOT NULL,
  `locationId` int NOT NULL,
  `ip` char(15) NOT NULL,
  `port` int NOT NULL DEFAULT '4370',
  `version` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `osVersion` varchar(20) NOT NULL,
  `platform` varchar(20) NOT NULL,
  `fmVersion` varchar(20) NOT NULL,
  `serialNumber` varchar(20) NOT NULL,
  `deviceModel` varchar(25) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Inactive, 1=Active',
  `deviceStatus` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Disconnected, 1=Connected, 2=''Communication Failed'', 3=''Unknown''',
  `isPrimary` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `lastConnectedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int NOT NULL,
  `uuid` char(36) NOT NULL,
  `userId` int NOT NULL,
  `userUid` varchar(10) NOT NULL,
  `role` smallint NOT NULL COMMENT '0=User, 14=SuperAdmin',
  `name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `password` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `cardNo` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `finger` varchar(4000) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '0=Sync 1=FingerSync 2=Completed',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_device_relation`
--

CREATE TABLE `employee_device_relation` (
  `id` int NOT NULL,
  `uuid` char(36) NOT NULL,
  `employeeId` int NOT NULL,
  `deviceId` int NOT NULL,
  `finger` tinyint(1) NOT NULL DEFAULT '0',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int NOT NULL,
  `uuid` char(36) NOT NULL,
  `location` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=Inactive, 1=Active',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD UNIQUE KEY `unique_index` (`userId`,`state`,`deviceId`,`deviceTime`),
  ADD KEY ` attendanceCompany` (`companyId`),
  ADD KEY `attendanceLocation` (`locationId`),
  ADD KEY `attendanceDevice` (`deviceId`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `companyRel` (`companyId`),
  ADD KEY `locationRel` (`locationId`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD UNIQUE KEY `userId` (`userId`);

--
-- Indexes for table `employee_device_relation`
--
ALTER TABLE `employee_device_relation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employeeId` (`employeeId`,`deviceId`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD UNIQUE KEY `location` (`location`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_device_relation`
--
ALTER TABLE `employee_device_relation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT ` attendanceCompany` FOREIGN KEY (`companyId`) REFERENCES `company` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `attendanceDevice` FOREIGN KEY (`deviceId`) REFERENCES `device` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `attendanceLocation` FOREIGN KEY (`locationId`) REFERENCES `location` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `device`
--
ALTER TABLE `device`
  ADD CONSTRAINT `companyRel` FOREIGN KEY (`companyId`) REFERENCES `company` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `locationRel` FOREIGN KEY (`locationId`) REFERENCES `location` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
