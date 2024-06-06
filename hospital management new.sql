-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 09:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_tbl`
--

CREATE TABLE `account_tbl` (
  `loginID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Account_Type` int(20) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `Position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_tbl`
--

INSERT INTO `account_tbl` (`loginID`, `Name`, `Email`, `Password`, `Account_Type`, `Photo`, `Position`) VALUES
(5, 'admin', 'admin@gmail.com', 'admin', 1, '666119bcc2b91.jpg', ''),
(6, 'admins', 'admin2@gmail.com', 'admin22', 1, '6661221fbcd4c.jpg', ''),
(7, 'staff12', 'staff12@gmail.com', 'staff12', 2, '6661225a45662.jpg', 'Nurse'),
(12, 'ballin', 'ballin@gmail.com', '123', 3, '66615e4bb4963.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment_tbl`
--

CREATE TABLE `payment_tbl` (
  `paymentID` int(11) NOT NULL,
  `staff_ID` int(11) NOT NULL,
  `patient_ID` int(11) NOT NULL,
  `Payment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_tbl`
--

CREATE TABLE `request_tbl` (
  `requestID` int(11) NOT NULL,
  `Concern` varchar(255) NOT NULL,
  `requesterName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_tbl`
--

INSERT INTO `request_tbl` (`requestID`, `Concern`, `requesterName`) VALUES
(7, '', 'ballin');

-- --------------------------------------------------------

--
-- Table structure for table `salary_tbl`
--

CREATE TABLE `salary_tbl` (
  `salaryID` int(11) NOT NULL,
  `loginID` int(255) NOT NULL,
  `Salary` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_tbl`
--
ALTER TABLE `account_tbl`
  ADD PRIMARY KEY (`loginID`);

--
-- Indexes for table `payment_tbl`
--
ALTER TABLE `payment_tbl`
  ADD PRIMARY KEY (`paymentID`);

--
-- Indexes for table `request_tbl`
--
ALTER TABLE `request_tbl`
  ADD PRIMARY KEY (`requestID`);

--
-- Indexes for table `salary_tbl`
--
ALTER TABLE `salary_tbl`
  ADD PRIMARY KEY (`salaryID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_tbl`
--
ALTER TABLE `account_tbl`
  MODIFY `loginID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payment_tbl`
--
ALTER TABLE `payment_tbl`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_tbl`
--
ALTER TABLE `request_tbl`
  MODIFY `requestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `salary_tbl`
--
ALTER TABLE `salary_tbl`
  MODIFY `salaryID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
