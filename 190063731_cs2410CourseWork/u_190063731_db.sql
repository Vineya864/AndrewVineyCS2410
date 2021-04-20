-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 20, 2021 at 10:30 AM
-- Server version: 5.7.33-0ubuntu0.18.04.1
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u_190063731_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `ID` int(11) NOT NULL,
  `Name` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Species` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `Breed` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `Birth` date NOT NULL,
  `Availability` int(11) NOT NULL DEFAULT '1',
  `Description` text COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`ID`, `Name`, `Species`, `Breed`, `Birth`, `Availability`, `Description`) VALUES
(2, 'Buster', 'Dog', 'german shepherd\r\n', '2021-04-24', 0, 'Ut varius volutpat felis et tincidunt. Donec tincidunt neque id diam eleifend, eget maximus magna maximus. In finibus fermentum scelerisque. Pellentesque commodo hendrerit auctor. Donec vehicula ligula quis dui molestie,'),
(3, 'Grace', 'Dog', 'Greyhound', '2021-04-05', 1, 'Sed purus justo, ultrices vitae odio fermentum, blandit hendrerit enim. Integer interdum blandit ullamcorper. Praesent sit amet volutpat dui, vitae sagittis ante. Mauris a libero libero. Donec venenatis, metus at lobortis porttitor, nisl elit faucibus sapien, in lacinia ex ex at ex. Etiam vitae semper enim. Aenean c'),
(4, 'David', 'Dog', 'Poodle', '2020-05-07', 1, 'leifend fermentum tellus ut fermentum. Aenean elementum ligula et erat convallis feugiat. In ipsum velit, vestibulum in risus et, varius gravida arcu. Duis tincidunt tristique dui, nec hendrerit erat posuere nec. Donec a sagittis felis. Pellentesque habitant morbi '),
(5, 'Kate', 'Cat', 'short hair tabby cat', '2021-04-08', 1, 'Mauris eget lacus tristique, aliquam mi eget, molestie tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sagittis scelerisque tempor. Vestibulum dignissim tortor at sollicitudin dignissim. Maecenas a erat arcu. Duis placerat ipsum vel interdum porttitor. Suspendisse potenti. ');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `AnimalID` int(11) NOT NULL,
  `Approved` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`ID`, `UserID`, `AnimalID`, `Approved`) VALUES
(1, 2, 2, 'Approved'),
(2, 2, 4, 'Rejected'),
(3, 4, 3, 'Pending'),
(4, 2, 4, 'Rejected'),
(5, 2, 4, 'Pending'),
(6, 4, 5, 'Pending'),
(7, 7, 4, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Password` text NOT NULL,
  `Name` varchar(20) DEFAULT NULL,
  `Type` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Email`, `Password`, `Name`, `Type`) VALUES
(1, 'test@email', 'testPassword', 'test', 1),
(2, 'testemail(at)aston.ac.uk', '$2y$10$kVO46EaaNwBRAtkr.s8qMetCS/YxE9K7/CpWPpVmXQw0xJXshb0Oa', 'Admin', 1),
(3, 'auser(at)gmail.com', '$2y$10$tyBowH74PMwq9Lq4ohxeheyMMgh5aXaH2PR5FSOWvvu9OORnHlpLC', 'aUser', 0),
(4, 'james(at)aston.ac.uk', '$2y$10$87/ZnycU1d0/RzhSMlZU2uUEXz2Gi.Tr0i6uJUDMYlBXkfmIMbu5q', 'james', 0),
(5, 'newTest(at)test.com', '$2y$10$RMXN75WNigfR7CM1SCSKse6.HHErQChCRu/jbE9VSLsv6wl6NWCoO', 'james', 0),
(6, 'james(at)aston.ac.uk', '$2y$10$uPIOfybmHH5tWqh9HgPEsOjlOd02oIqMEfjW1k3ipTirOvzzi5mmW', 'james', 0),
(7, 'ramzanaamnah00(at)gmail.com', '$2y$10$c21NRKVKPzzx.NjgIbyaWu1JL73kMIocHrhoWI3.zYxz8glkDVH8y', 'Aamnah Ramzan', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `AnimalKey` (`AnimalID`),
  ADD KEY `UserKey` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `AnimalKey` FOREIGN KEY (`AnimalID`) REFERENCES `animals` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UserKey` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
