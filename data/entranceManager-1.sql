-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 23, 2023 at 12:31 PM
-- Server version: 8.0.31-0ubuntu0.20.04.1
-- PHP Version: 7.4.33

SET FOREIGN_KEY_CHECKS=0;
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

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `uuid`, `name`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'a9992b0f-2504-4ada-b7bb-44463171ef7e', 'ShareTrip Limited', 1, '2023-03-23 11:37:27', '2023-03-23 11:37:27'),
(2, '82f0fc41-77f6-44f4-bb35-f0b024e2aebd', 'DeshiPay', 1, '2023-03-23 11:37:27', '2023-03-23 11:37:27');

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`id`, `uuid`, `name`, `company`, `location`, `ip`, `port`, `version`, `osVersion`, `platform`, `fmVersion`, `serialNumber`, `deviceModel`, `status`, `deviceStatus`, `lastConnectedAt`, `createdAt`, `updatedAt`) VALUES
(3, '93d34ca6-579c-4665-a985-37807a3537b2', '3rd Floor', 1, 1, '118.179.202.221', 43707, 'Ver 6.60 Aug 19 2021\0', '1\0', 'ZAM180_TFT\0', 'ZKFPV.10\0', 'CQUG224260104\0', 'SpeedFace-V5L', 1, 1, '2023-03-23 11:20:48', '2023-03-23 11:20:48', '2023-03-23 11:20:48'),
(4, '7d7f25da-eaa4-43a1-b2fc-57ee6489a630', '3rd Floor Old', 1, 1, '118.179.202.220', 43705, 'Ver 6.60 Sep 19 2019\0', '1\0', 'ZMM220_TFT\0', 'ZKFPV.10\0', 'AF4C214960622\0', 'uFace800', 1, 1, '2023-03-23 11:23:26', '2023-03-23 11:23:26', '2023-03-23 11:23:26'),
(5, 'eee4d3c3-aeb4-491c-83aa-96c90fca53d3', '6th Floor', 2, 1, '123.0.20.194', 50501, 'Ver 6.60 Mar 24 2021\0', '1\0', 'ZAM180_TFT\0', 'ZKFPV.10\0', 'CMWB221360134\0', 'SpeedFace-V5L', 1, 1, '2023-03-23 11:23:45', '2023-03-23 11:23:45', '2023-03-23 11:23:45');

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `uuid`, `location`, `address`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'f9502f41-1652-44fd-b555-5281a3998f1d', 'Bashundhara R/A', 'JCX Business Tower, 3rd & 6th Floor\nPlot - 1136/A, Block - I, Bashundhara R/A,\nDhaka 1229, Bangladesh', 1, '2023-03-23 11:39:01', '2023-03-23 11:39:01'),
(4, '6d6077dc-26bd-4c66-969c-5869e18e522e', 'Banani Front', 'Rangs Pearl Tower, 4th Floor,\r\nHouse no. 76, Road 12, Block E,\r\nBanani, Dhaka 1213, Bangladesh', 1, '2023-03-23 11:39:01', '2023-03-23 11:39:01'),
(5, '1805cfe7-b347-43ca-a0e0-f573a010d2fb', 'Chittagong', 'Chittagong, Bangladesh', 1, '2023-03-23 11:39:01', '2023-03-23 11:39:01'),
(6, 'd4250078-bdfa-4e73-ac3c-a47fb6cfb6d2', 'DeshiPay', 'JCX Business Tower (6th Floor),\r\nPlot # 1133/A, Block # I,\r\nJapan Street, Bashundhara R/A,\r\nDhaka - 1229, Bangladesh', 1, '2023-03-23 11:39:01', '2023-03-23 11:39:01');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
