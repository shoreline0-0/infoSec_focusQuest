-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2025 at 05:08 AM
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
(3, 32, 2, '2025-02-07 05:01:17', 'Success', 'Login'),
(4, 32, 2, '2025-02-07 05:09:16', 'Success', 'Login'),
(5, 32, 2, '2025-02-07 05:11:07', 'Success', 'Logout'),
(6, 43, 1, '2025-02-07 05:11:25', 'Success', 'Login'),
(7, 43, 1, '2025-02-07 05:11:28', 'Success', 'Logout'),
(8, 32, 2, '2025-02-07 05:11:42', 'Success', 'Login'),
(9, 43, 2, '2025-02-07 05:12:11', 'Success', 'Login'),
(10, 43, 2, '2025-02-07 05:12:22', 'Success', 'Logout'),
(11, 32, 2, '2025-02-07 05:12:27', 'Success', 'Login'),
(12, 32, 2, '2025-02-07 05:13:01', 'Success', 'Logout'),
(13, 32, 2, '2025-02-07 05:15:00', 'Success', 'Login'),
(14, 32, 2, '2025-02-07 11:11:07', 'Success', 'Login'),
(15, 32, 2, '2025-02-07 11:12:43', 'Success', 'Login'),
(16, 32, 2, '2025-02-07 11:12:50', 'Success', 'Login'),
(17, 32, 2, '2025-02-07 11:50:39', 'Success', 'Login'),
(18, 0, 1, '2025-02-07 11:52:41', 'Success', 'Login'),
(19, 0, 1, '2025-02-07 11:53:28', 'Success', 'Logout'),
(20, 0, 1, '2025-02-07 11:54:35', 'Success', 'Login'),
(21, 0, 1, '2025-02-07 11:54:52', 'Success', 'Logout'),
(22, 0, 1, '2025-02-07 11:54:52', 'Success', 'Logout'),
(23, 32, 2, '2025-02-07 11:54:58', 'Success', 'Login'),
(24, 32, 2, '2025-02-07 11:56:20', 'Success', 'Logout'),
(25, 32, 2, '2025-02-07 11:56:20', 'Success', 'Logout'),
(26, 46, 1, '2025-02-07 12:43:32', 'Success', 'Login'),
(27, 46, 1, '2025-02-07 12:45:32', 'Success', 'Logout'),
(28, 47, 1, '2025-02-09 04:01:26', 'Success', 'Login'),
(29, 47, 1, '2025-02-09 04:01:28', 'Success', 'Logout'),
(30, 48, 1, '2025-02-09 04:04:34', 'Success', 'Login'),
(31, 48, 1, '2025-02-09 04:04:39', 'Success', 'Logout'),
(32, 32, 2, '2025-02-09 04:04:56', 'Success', 'Login'),
(33, 32, 2, '2025-02-09 04:05:11', 'Success', 'Login'),
(34, 48, 2, '2025-02-09 04:05:37', 'Success', 'Login');

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
(3, 1, 4, 3),
(5, 1, 1, 321),
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

INSERT INTO `users` (`userID`, `fName`, `lName`, `email`, `password`, `roleID`) VALUES
(4, 'Walter', 'Mart', 'walterm@email.com', 'password3', 1),
(5, 'Vlad imir', 'Dracoola', 'vlad@email.com', 'password4', 1),
(20, 'Mlem', 'Mlom', 'mlom@email.com', 'mlemmlom', 1),
(22, 'Min erva', 'Santos', 'msantos@email.com', 'asdfghjkl', 1),
(23, 'Klint', 'van Zieks', 'ilikebeer@email.com', '111ayeee', 1),
(24, 'Barok', 'van Zieks', 'barokvz@email.com', '84r0kv@n', 1),
(25, 'Iris', 'Watson', 'irisw@email.com', 'shhiwrite', 1),
(26, 'Its', 'Jork', 'pekorajork@email.com', '$2y$10$LT.jpOBCZcF.R', 1),
(27, 'eevee', 'eevee', 'eevee', '$2y$10$Elu/15Ofy8stZ', 1),
(28, 'snorlax', 'snorlax', 'bibi@gmail.com', '688787d8ff144c502c7f', 1),
(29, 'qqq', 'www', 'eee', '12b0f0dcaefb10c02a83aa9adb025978ddb5512dc04eb39df6811c6a6bf9770c', 1),
(31, 'fgh', 'qwe', 'abc@gmail.com', 'd36ba4d423748ebcaf05a6fe6b086bf0c4176ec943e6abc73c3b71950cefc296', 1),
(32, 'Coleen', 'Martha', 'coleenmartha@gmail.com', 'f2fdd58856e77152463d6183ffa198d69bb241ddf8378734c4d074f74544f4c8', 2),
(42, 'Kendra', 'Kramer', 'kkramer@gmail.com', '6fb084f6007e20732f8a9ef1bff8f40437ac94c3d6b5e9d0ab4af0ee83a1d4ba', 2),
(45, 'Dahlia', 'Hawthorne', 'dollie@gmail.com', '494f0b290d7b1390a777208609ac5c8d82333aef38a6776cc9c13ab16dcf47b9', 1),
(46, 'Ahoy', 'Matey', 'raaaaa@gmail.com', '4982a2031bb08b35b1d9bde5b0fb0ce753f8887a294dee5ea1c32b23b2e53f1b', 1),
(47, 'Ash', 'Ketchum', 'pokemon@gmail.com', 'eaf37ddf51d742b7b0ae8083618fef81da75965214c56087ebb4eaa79ee3fc4a', 1),
(48, 'Your Phone', 'Linging', 'tingtingting@gmail.com', '5f72706521a5d4e4e58bde90e22a7ef86b03a1d77815eab9963414c248e3a01a', 2);

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
  ADD UNIQUE KEY `userID_2` (`userID`),
  ADD KEY `fk_roleID` (`roleID`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_logs`
--
ALTER TABLE `access_logs`
  MODIFY `accessID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

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
