-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2025 at 06:28 AM
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
-- Table structure for table `difficulty`
--

CREATE TABLE `difficulty` (
  `difficultyID` int(11) NOT NULL,
  `penalty` int(2) NOT NULL,
  `maxDistractions` int(2) NOT NULL,
  `goal` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `difficulty`
--

INSERT INTO `difficulty` (`difficultyID`, `penalty`, `maxDistractions`, `goal`) VALUES
(1, 2, 4, 40),
(3, 5, 7, 75),
(5, 15, 15, 175),
(11, 1, 56, 600),
(12, 4, 5, 6),
(15, 0, 0, 0),
(16, 103, 202, 301),
(17, 3243, 4323, 1221);

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
(1, 1, 1, 40, '2024-12-16 06:25:06', 'Failed'),
(5, 3, 1, 0, '2024-12-16 06:29:30', 'Failed'),
(6, 20, 3, 400, '2025-01-06 06:19:26', 'Success'),
(7, 4, 3, 345, '2025-01-06 06:19:26', 'Success'),
(8, 1, 1, 100, '2025-01-06 06:24:21', 'Success');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `fName` varchar(50) NOT NULL,
  `lName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `fName`, `lName`, `email`, `password`) VALUES
(1, 'Sherlene', 'Agustin', 'agustinsf@edu.ph', 'qwer'),
(3, 'Yam', 'Borromeo', 'yamb@email.com', 'password2'),
(4, 'Walter', 'Mart', 'walterm@email.com', 'password3'),
(5, 'Vladimir', 'Dracoola', 'vlad@email.com', 'password4'),
(20, 'Mlem', 'Mlom', 'mlom@email.com', 'mlemmlom'),
(21, 'Kokeya', 'Kho', 'kokeyak@email.com', 'qwertyuiop'),
(22, 'Minerva', 'Santos', 'minervas@email.com', 'asdfghjkl'),
(23, 'Klint', 'van Zieks', 'ilikebeer@email.com', '111ayeee'),
(24, 'Barok', 'van Zieks', 'barokvz@email.com', '84r0kv@n'),
(25, 'Iris', 'Watson', 'irisw@email.com', 'shhiwrite'),
(26, 'Its', 'Jork', 'pekorajork@email.com', '$2y$10$LT.jpOBCZcF.R'),
(27, 'eevee', 'eevee', 'eevee', '$2y$10$Elu/15Ofy8stZ'),
(28, 'snorlax', 'snorlax', 'bibi@gmail.com', '688787d8ff144c502c7f'),
(29, 'qqq', 'www', 'eee', '12b0f0dcaefb10c02a83aa9adb025978ddb5512dc04eb39df6811c6a6bf9770c'),
(31, 'fgh', 'qwe', 'abc@gmail.com', 'd36ba4d423748ebcaf05a6fe6b086bf0c4176ec943e6abc73c3b71950cefc296'),
(32, 'Coleen', 'Martha', 'coleenmartha@gmail.com', 'f2fdd58856e77152463d6183ffa198d69bb241ddf8378734c4d074f74544f4c8');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `difficulty`
--
ALTER TABLE `difficulty`
  MODIFY `difficultyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `gamelog`
--
ALTER TABLE `gamelog`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gamelog`
--
ALTER TABLE `gamelog`
  ADD CONSTRAINT `gamelog_ibfk_1` FOREIGN KEY (`difficultyID`) REFERENCES `difficulty` (`difficultyID`),
  ADD CONSTRAINT `gamelog_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
