-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2024 at 09:14 PM
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
-- Database: `cis480_application`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `EMail` varchar(50) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `RegistrationDate` date NOT NULL,
  `UserLevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `FirstName`, `LastName`, `EMail`, `Password`, `RegistrationDate`, `UserLevel`) VALUES
(1, 'Francis', 'McCleneghen', 'fmccleneghen@example.com', 'PassW1', '2024-02-03', 1),
(2, 'Scott', 'McCleneghen', 'smcclenghen@example.com', 'PassW1', '2024-02-03', 3),
(3, 'Steve', 'Customer', 'scustomer@example.com', 'PassW1', '2024-02-03', 2),
(4, 'Anna', 'Customer', 'acustomer@example.com', 'PassW1', '0000-00-00', 2),
(6, 'Bob', 'Tester', 'btester@example.com', 'PassW1', '2024-02-04', 2),
(7, 'James', 'Anderson', 'janderson@example.com', 'PassW1', '2024-02-24', 2),
(8, 'Bobby', 'Huntoon', 'bhuntoon@example.com', 'PassW1', '2024-02-22', 3),
(9, 'Emily', 'Rodriguez', 'erodriguez@example.com', 'PassW1', '2024-02-24', 2),
(10, 'Benjamin', 'Patel', 'bpatel@example.com', 'PassW1', '2024-02-24', 2),
(11, 'Olivia', 'Campbell', 'ocampbell@example.com', 'PassW1', '2024-02-24', 2),
(12, 'William', 'Nguyen', 'wnguyen@example.com', 'PassW1', '2024-02-24', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_levels`
--

CREATE TABLE `user_levels` (
  `UserLevelNo` int(1) NOT NULL,
  `LevelName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_levels`
--

INSERT INTO `user_levels` (`UserLevelNo`, `LevelName`) VALUES
(1, 'Administrator'),
(2, 'User'),
(3, 'Technician');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`);

--
-- Indexes for table `user_levels`
--
ALTER TABLE `user_levels`
  ADD PRIMARY KEY (`UserLevelNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_levels`
--
ALTER TABLE `user_levels`
  MODIFY `UserLevelNo` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
