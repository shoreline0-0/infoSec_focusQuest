-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2025 at 06:06 AM
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
-- Database: `focusquest`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_logs`
--

CREATE TABLE `access_logs` (
  `accessID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `roleID` int(11) DEFAULT NULL,
  `logTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Success','Failed') NOT NULL,
  `accessType` enum('Login','Logout') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `access_logs`
--

INSERT INTO `access_logs` (`accessID`, `userID`, `roleID`, `logTime`, `status`, `accessType`) VALUES
(1, 32, 2, '2025-02-07 04:50:02', 'Success', 'Login'),
(2, 32, 2, '2025-02-07 04:50:19', 'Success', 'Login'),
(3, 32, 2, '2025-02-07 05:01:17', 'Success', 'Login');

-- --------------------------------------------------------

--
-- Table structure for table `difficulty`
--

CREATE TABLE `difficulty` (
  `difficultyID` int(11) NOT NULL,
  `penalty` int(2) NOT NULL,
  `maxDistractions` int(2) NOT NULL,
  `goal` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `difficulty`
--

INSERT INTO `difficulty` (`difficultyID`, `penalty`, `maxDistractions`, `goal`) VALUES
(1, 3, 2, 1),
(3, 1, 4, 3),
(5, 3, 3, 3),
(11, 4, 4, 4),
(12, 4, 5, 6),
(19, 1, 2, 3),
(20, 1, 1, 23);

-- --------------------------------------------------------

--
-- Table structure for table `gamelog`
--

CREATE TABLE `gamelog` (
  `logID` int(11) NOT NULL,
  `userID` int(3) NOT NULL,
  `difficultyID` int(3) NOT NULL,
  `score` int(7) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gamelog`
--

INSERT INTO `gamelog` (`logID`, `userID`, `difficultyID`, `score`, `timestamp`, `status`) VALUES
(7, 4, 3, 345, '2025-01-06 06:19:26', 'Success');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleID` int(1) NOT NULL,
  `roleName` varchar(5) NOT NULL,
  `adminAccess` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleID`, `roleName`, `adminAccess`) VALUES
(1, 'User', 0),
(2, 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `logID` int(10) NOT NULL,
  `userID` int(11) NOT NULL,
  `fName` varchar(50) NOT NULL,
  `lName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `roleID` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`logID`, `userID`, `fName`, `lName`, `email`, `password`, `roleID`) VALUES
(0, 4, 'Walter', 'Mart', 'walterm@email.com', 'password3', 1),
(0, 5, 'Vlad imir', 'Dracoola', 'vlad@email.com', 'password4', 1),
(0, 20, 'Mlem', 'Mlom', 'mlom@email.com', 'mlemmlom', 1),
(0, 22, 'Min erva', 'Santos', 'msantos@email.com', 'asdfghjkl', 1),
(0, 23, 'Klint', 'van Zieks', 'ilikebeer@email.com', '111ayeee', 1),
(0, 24, 'Barok', 'van Zieks', 'barokvz@email.com', '84r0kv@n', 1),
(0, 25, 'Iris', 'Watson', 'irisw@email.com', 'shhiwrite', 1),
(0, 26, 'Its', 'Jork', 'pekorajork@email.com', '$2y$10$LT.jpOBCZcF.R', 1),
(0, 27, 'eevee', 'eevee', 'eevee', '$2y$10$Elu/15Ofy8stZ', 1),
(0, 28, 'snorlax', 'snorlax', 'bibi@gmail.com', '688787d8ff144c502c7f', 1),
(0, 29, 'qqq', 'www', 'eee', '12b0f0dcaefb10c02a83aa9adb025978ddb5512dc04eb39df6811c6a6bf9770c', 1),
(0, 31, 'fgh', 'qwe', 'abc@gmail.com', 'd36ba4d423748ebcaf05a6fe6b086bf0c4176ec943e6abc73c3b71950cefc296', 1),
(0, 32, 'Coleen', 'Martha', 'coleenmartha@gmail.com', 'f2fdd58856e77152463d6183ffa198d69bb241ddf8378734c4d074f74544f4c8', 2),
(0, 42, 'Kendra', 'Kramer', 'kkramer@gmail.com', '6fb084f6007e20732f8a9ef1bff8f40437ac94c3d6b5e9d0ab4af0ee83a1d4ba', 2),
(0, 43, 'Eve', 'Adams', 'apple@gmail.com', '29d8cda42c88fcf7e49d0f66bee969440926f49da5d2c575e64a40e815b86323', 1),
(0, 45, 'Dahlia', 'Hawthorne', 'dollie@gmail.com', '494f0b290d7b1390a777208609ac5c8d82333aef38a6776cc9c13ab16dcf47b9', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_logs`
--
ALTER TABLE `access_logs`
  ADD PRIMARY KEY (`accessID`);

--
-- Indexes for table `difficulty`
--
ALTER TABLE `difficulty`
  ADD PRIMARY KEY (`difficultyID`);

--
-- Indexes for table `gamelog`
--
ALTER TABLE `gamelog`
  ADD PRIMARY KEY (`logID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `difficultyID` (`difficultyID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `fk_roleID` (`roleID`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_logs`
--
ALTER TABLE `access_logs`
  MODIFY `accessID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `difficulty`
--
ALTER TABLE `difficulty`
  MODIFY `difficultyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `gamelog`
--
ALTER TABLE `gamelog`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gamelog`
--
ALTER TABLE `gamelog`
  ADD CONSTRAINT `gamelog_ibfk_1` FOREIGN KEY (`difficultyID`) REFERENCES `difficulty` (`difficultyID`),
  ADD CONSTRAINT `gamelog_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_roleID` FOREIGN KEY (`roleID`) REFERENCES `roles` (`roleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
