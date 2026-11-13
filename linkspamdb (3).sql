-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2025 at 08:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `linkspamdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `engagement`
--

CREATE TABLE `engagement` (
  `ID` bigint(20) NOT NULL,
  `types` varchar(10) NOT NULL,
  `postID` varchar(25) NOT NULL,
  `users` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `engagement`
--

INSERT INTO `engagement` (`ID`, `types`, `postID`, `users`) VALUES
(28, 'promote', '678e3f0b88465a40', '[\"user_3ad2d10485b5ec95\"]'),
(29, 'promote', 'post_bb2692deb20bd1', '[\"user_3ad2d10485b5ec95\"]'),
(30, 'promote', 'post_f0306a2331b3c8', '[\"user_3ad2d10485b5ec95\"]'),
(31, 'promote', 'post_9c1c4bdb44c2a9', '[]'),
(32, 'promote', 'post_4fe890c897b6de', '[\"user_bd64b71ee2efd11f\"]');

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `fullName` text NOT NULL,
  `cardNumber` bigint(20) NOT NULL,
  `cardExp` int(4) NOT NULL,
  `reg_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`ID`, `userID`, `fullName`, `cardNumber`, `cardExp`, `reg_date`) VALUES
(1, 0, '', 12346, 1235, '2025-04-28'),
(2, 0, '', 564532123, 1230, '2025-04-28'),
(3, 0, '', 2232131343132323, 1230, '2025-04-28'),
(4, 0, '', 2345244511234897, 1230, '2025-04-28'),
(5, 0, '', 3134345624876243, 1230, '2025-04-28'),
(6, 0, '', 8764344652433464, 1230, '2025-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `ID` int(11) NOT NULL,
  `userID` varchar(22) DEFAULT NULL,
  `userName` varchar(25) DEFAULT NULL,
  `fullName` varchar(25) DEFAULT NULL,
  `userEmail` varchar(254) DEFAULT NULL,
  `userPhoneNumber` varchar(10) DEFAULT NULL,
  `userPassword` varchar(255) DEFAULT NULL,
  `subType` varchar(6) DEFAULT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expire` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`ID`, `userID`, `userName`, `fullName`, `userEmail`, `userPhoneNumber`, `userPassword`, `subType`, `reset_token_hash`, `reset_token_expire`) VALUES
(3, 'user_8ff575b5ca4d71e3', 'Test123', 'Lolwethu Damane', 'test123@gmail.com', '0623211609', '@Angelina00', 'Free', NULL, NULL),
(4, 'user_3ad2d10485b5ec95', 'Angelina', 'Angelina Maarman', 'Angelina@gmail.com', '0829932489', '$2y$10$/yxS/j1/BwbBhY7oQ3LQZuLqIdRXo5HHNRizkLsqSE7B0sV89CIj2', 'Free', 'a89c9bcab563b554d089bffe58a2032e9418660a074dfb2fc700632b1ed94d1e', '2025-06-03 20:01:26'),
(5, 'user_94873ad7da33b0a9', 'Lhoza00admin', 'Lolwethu Damane', 'lolwethubetrtie07@gmail.com', '0711809090', '$2y$10$u/C/itG/5cTS0voE7i9g/.du9bTstYQ7QzgBjoBPMXiXg.XMg4Zg6', 'Client', NULL, NULL),
(6, 'user_b156406afc74cb82', 'InvalidName5', 'Lolwethu Damane', 'lolwethudamane123@gmail.com', '0711809123', '$2y$10$FcniCTVWvLVyXOj9CzZGV.H1I/vZVS61qa7rlBpkI3Ub1A2rT3dte', 'Client', NULL, NULL),
(7, 'user_bd64b71ee2efd11f', 'LolwethuD', 'Lolwethu Damane', 'lolwethudamane43@gmail.com', '0711809943', '$2y$10$KnuyaEzS3tBR3bL8w7nRtu7Ro6ffs2ipsu7u0LEJC/PlxX2RNQ7Bm', 'Free', NULL, NULL),
(9, 'user_c4ea203de2124739', 'User Not Found', 'User Not Found', 'usernotfound098456@gmail.com', '1234567890', '$2y$10$9oP8fzBXgdUUxmJQvBXPfeaXp5Q3rADtc3.EH5mgIypAgNS6xnHMG', 'Client', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userposts`
--

CREATE TABLE `userposts` (
  `ID` int(11) NOT NULL,
  `postID` varchar(19) DEFAULT NULL,
  `userID` varchar(22) DEFAULT NULL,
  `userName` varchar(12) DEFAULT NULL,
  `hashTags` varchar(20) NOT NULL,
  `userTags` text NOT NULL,
  `post` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `comments` bigint(20) DEFAULT 0,
  `promotes` bigint(20) DEFAULT 0,
  `shares` int(11) NOT NULL DEFAULT 0,
  `dateUpload` date NOT NULL DEFAULT current_timestamp(),
  `hasImage` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userposts`
--

INSERT INTO `userposts` (`ID`, `postID`, `userID`, `userName`, `hashTags`, `userTags`, `post`, `image`, `comments`, `promotes`, `shares`, `dateUpload`, `hasImage`) VALUES
(24, 'f2b27f428014536e', 'user_3ad2d10485b5ec95', 'Angelina', '', '', '', 'uploads/Angelina/Angelina_f2b27f428014536e.jpeg', 0, 0, 0, '2025-05-20', 1),
(25, 'a4ebd02b60a673ac', 'user_3ad2d10485b5ec95', 'Angelina', '', '', 'I just wanted a second post to test if this works', '', 0, 0, 0, '2025-05-24', 0),
(26, '678e3f0b88465a40', 'user_bd64b71ee2efd11f', 'LolwethuD', '', '', 'Hey guys, need help on how does the app work', '', 0, 33, 0, '2025-05-24', 0),
(31, 'post_bb2692deb20bd1', 'user_3ad2d10485b5ec95', 'Angelina', '', '', 'Limitation of being fixed', '', 0, 0, 0, '2025-06-07', 0),
(32, 'post_f0306a2331b3c8', 'user_3ad2d10485b5ec95', 'Angelina', '', '', 'I think post limit is 5 still', '', 0, 0, 0, '2025-06-07', 0),
(33, 'post_de891d446d961c', 'user_bd64b71ee2efd11f', 'LolwethuD', '', '', 'Can I post the ONE PIECE IS REEEAALLL', 'uploads/LolwethuD/LolwethuD_post_de891d446d961c86.jpeg', 0, 0, 0, '2025-07-06', 1),
(34, 'post_6e14c12656c28e', 'user_bd64b71ee2efd11f', 'LolwethuD', '', '', 'Uhmm not applicable', 'uploads/LolwethuD/LolwethuD_post_6e14c12656c28e8a.png', 0, 0, 0, '2025-07-06', 1),
(36, 'post_9c1c4bdb44c2a9', 'user_3ad2d10485b5ec95', 'Angelina', '', '', 'Link', 'uploads/Angelina/Angelina_post_9c1c4bdb44c2a921.jpeg', 0, 0, 0, '2025-07-07', 1),
(44, 'post_4fe890c897b6de', 'user_bd64b71ee2efd11f', 'LolwethuD', '#ball, #tall, #call,', '@Angelina, @InvalidName5, @LolwethuD', 'ork', '', 0, 1, 0, '2025-07-20', 0),
(46, 'post_b97dcd95cfbe7d', 'user_bd64b71ee2efd11f', 'LolwethuD', '', '@LolwethuD', 'Hey bro need your help\r\n', '', 0, 0, 0, '2025-08-13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userstats`
--

CREATE TABLE `userstats` (
  `ID` int(11) NOT NULL,
  `userID` varchar(22) DEFAULT NULL,
  `userName` varchar(25) NOT NULL,
  `userLevel` int(3) DEFAULT 0,
  `xpLevel` bigint(20) DEFAULT 0,
  `userPfp` text DEFAULT NULL,
  `userCover` text DEFAULT NULL,
  `jobSkill` varchar(25) DEFAULT NULL,
  `affiliationCount` int(11) NOT NULL DEFAULT 0,
  `followers` mediumtext NOT NULL,
  `followings` mediumtext NOT NULL,
  `followingCount` bigint(20) NOT NULL DEFAULT 0,
  `followerCount` bigint(20) NOT NULL DEFAULT 0,
  `bioStatement` varchar(255) DEFAULT NULL,
  `dayStreak` int(4) NOT NULL DEFAULT 0,
  `lastDay` datetime NOT NULL DEFAULT current_timestamp(),
  `totalSharedTo` int(11) NOT NULL DEFAULT 0,
  `TotalAffiliateCode` int(11) NOT NULL DEFAULT 0,
  `shoutOuts` int(11) NOT NULL DEFAULT 0,
  `totalXP` int(11) NOT NULL DEFAULT 0,
  `Gender` text NOT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `townCity` text NOT NULL,
  `Province` text NOT NULL,
  `ZipCode` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userstats`
--

INSERT INTO `userstats` (`ID`, `userID`, `userName`, `userLevel`, `xpLevel`, `userPfp`, `userCover`, `jobSkill`, `affiliationCount`, `followers`, `followings`, `followingCount`, `followerCount`, `bioStatement`, `dayStreak`, `lastDay`, `totalSharedTo`, `TotalAffiliateCode`, `shoutOuts`, `totalXP`, `Gender`, `DateOfBirth`, `townCity`, `Province`, `ZipCode`) VALUES
(2, 'user_8ff575b5ca4d71e3', 'Test123', 0, 0, NULL, '', NULL, 0, '[\"user_3ad2d10485b5ec95\"]', '', 0, 1, NULL, 0, '2025-07-12 18:21:31', 0, 0, 0, 0, '', NULL, '', '', 0),
(3, 'user_3ad2d10485b5ec95', 'Angelina', 2, 2, 'uploads/Angelina/Angelina_8a5dd73f26e485ca.jpeg', '', 'I am just a girl', 0, '[\"user_bd64b71ee2efd11f\"]', '[\"user_3ad2d10485b5ec95\",\"user_8ff575b5ca4d71e3\"]', 2, 1, 'Let me know just let me know, do you love it what I do wuth your body, Let me know just let me know, do you love it what I do wuth your body, Let me know just let me know, do you love it what I do wuth your body, Let me know just let me know, do you love', 0, '2025-07-12 18:21:31', 0, 0, 0, 0, 'Female', '0000-00-00', 'Cape Town', 'Free State', 7441),
(4, 'user_94873ad7da33b0a9', 'Lhoza00admin', 0, 0, NULL, '', NULL, 0, '[]', '', 0, 0, NULL, 0, '2025-07-12 18:21:31', 0, 0, 0, 0, '', NULL, '', '', 0),
(5, 'user_b156406afc74cb82', 'InvalidName5', 0, 0, NULL, '', NULL, 0, '[]', '', 0, 0, NULL, 0, '2025-07-12 18:21:31', 0, 0, 0, 0, '', NULL, '', '', 0),
(6, 'user_bd64b71ee2efd11f', 'LolwethuD', 0, 0, 'uploads/LolwethuD/LolwethuD_931aeda9301d624f.jpeg', NULL, '', 0, '[]', '[]', 0, 0, 'Lorem txl  Good news christ was without sin, but for our sake god made him share our sin in order thaat in union with him we might share the righteousness of GOD. Jesus christ, the eternal son of GOD, became flesh and obeyed sin, and no one ever heard.', 0, '2025-08-17 08:52:45', 0, 0, 0, 0, '', '0000-00-00', 'Dimbaza', 'Eastern Cape', 0),
(8, 'user_c4ea203de2124739', 'User Not Found', 0, 0, NULL, NULL, NULL, 0, '', '', 0, 0, NULL, 0, '2025-07-12 18:21:31', 0, 0, 0, 0, '', NULL, '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `engagement`
--
ALTER TABLE `engagement`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `postID` (`postID`),
  ADD KEY `type` (`types`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `cardNumber` (`cardNumber`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `userEmail` (`userEmail`),
  ADD UNIQUE KEY `userPhoneNumber` (`userPhoneNumber`),
  ADD KEY `reset_token_hash` (`reset_token_hash`),
  ADD KEY `reset_token_expire` (`reset_token_expire`);

--
-- Indexes for table `userposts`
--
ALTER TABLE `userposts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userstats`
--
ALTER TABLE `userstats`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `engagement`
--
ALTER TABLE `engagement`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `userposts`
--
ALTER TABLE `userposts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `userstats`
--
ALTER TABLE `userstats`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
