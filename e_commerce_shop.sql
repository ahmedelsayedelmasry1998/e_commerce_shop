-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2024 at 03:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_commerce_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) DEFAULT NULL,
  `descraption` varchar(255) DEFAULT NULL,
  `parentItem` varchar(255) DEFAULT NULL,
  `visibility` int(1) DEFAULT 0,
  `allowComment` int(1) DEFAULT 0,
  `allowAds` int(1) DEFAULT 0,
  `userId` int(11) DEFAULT NULL,
  `cat_active` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catId`, `catName`, `descraption`, `parentItem`, `visibility`, `allowComment`, `allowAds`, `userId`, `cat_active`) VALUES
(5, 'Hand Made', 'This Is Hand Made', 'Hand Made Item', 1, 1, 1, 23, 0),
(6, 'Hand Made', 'This Is Hand Made', 'Hand Made Item', 1, 1, 1, 23, 1),
(15, 'Hard Ware', 'This Is Hand Made', 'Mouse', 1, 1, 1, 23, 1),
(20, 'Hand Made', 'This Is Hand Made', 'Mouse', 1, 1, 1, 23, 0),
(21, 'SoftWare', 'This Is Hand Made', 'Mouse', 1, 1, 1, 23, 1),
(22, 'Programmer Products', 'This Is Programmer Products', 'Mouse', 1, 1, 1, 23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentId` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT 0,
  `commentDate` date DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `itemId` int(11) DEFAULT NULL,
  `comment_active` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentId`, `comment`, `status`, `commentDate`, `userId`, `itemId`, `comment_active`) VALUES
(1, 'This Comment For Mouse', 1, '2023-11-08', 24, 4, 1),
(2, 'This Is Comment For Hand Made', 1, '2023-11-08', 24, 7, 1),
(3, 'Thank You', 1, '2023-12-01', 23, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemId` int(11) NOT NULL,
  `itemName` varchar(255) DEFAULT NULL,
  `itemPrice` int(11) DEFAULT NULL,
  `addedDate` date DEFAULT NULL,
  `countryMade` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `approve` int(1) DEFAULT 0,
  `userId` int(11) DEFAULT NULL,
  `catId` int(11) DEFAULT NULL,
  `item_active` int(1) DEFAULT 1,
  `itemPhoto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemId`, `itemName`, `itemPrice`, `addedDate`, `countryMade`, `status`, `rating`, `approve`, `userId`, `catId`, `item_active`, `itemPhoto`) VALUES
(4, 'Mouse', 120, '2023-11-10', 'Egypt', 0, NULL, 0, 24, 15, 1, '../uploads_files/mouse.jfif'),
(5, 'Hand Made Item', 150, '2023-11-10', 'Egypt', 0, NULL, 0, 24, 6, 1, '../uploads_files/download.jfif'),
(6, 'Keyboard', 20, '2023-11-08', 'Tayland', 0, NULL, 0, 24, 15, 1, '../uploads_files/blossom-floral-bouquet-decoration-colorful-beautiful-flowers-background-garden-flowers-plant-pattern-wallpapers-greeting-cards-postcards-design-wedding-invites.jpg'),
(7, 'Button', 5, '2023-11-17', 'Egypt', 1, NULL, 0, 24, 15, 1, '../uploads_files/blossom-floral-bouquet-decoration-colorful-beautiful-flowers-background-garden-flowers-plant-pattern-wallpapers-greeting-cards-postcards-design-wedding-invites.jpg'),
(8, 'Screen', 30, '2023-11-17', 'Geramany', 2, NULL, 0, 24, 15, 1, '../uploads_files/galactic-night-sky-astronomy-science-combined-generative-ai.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `hireDate` date DEFAULT NULL,
  `userAvatar` varchar(255) DEFAULT NULL,
  `regStatus` int(1) DEFAULT 0,
  `userType` int(1) DEFAULT 0,
  `user_active` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `username`, `password`, `fullname`, `email`, `hireDate`, `userAvatar`, `regStatus`, `userType`, `user_active`) VALUES
(23, 'Ahmed Elmasry', '12345', 'Ahmed Elsayed Elmasry', 'www@ahmed.com', '1998-01-09', NULL, 0, 1, 1),
(24, 'Mohamed Elmasry', '54321', 'Mohamed Elsayed Elmasry', 'www@mohamed.com', '2020-12-20', NULL, 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catId`),
  ADD KEY `cat_users` (`userId`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `comments_users` (`userId`),
  ADD KEY `comments_items` (`itemId`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `item_users` (`userId`),
  ADD KEY `item_category` (`catId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `cat_users` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_items` FOREIGN KEY (`itemId`) REFERENCES `items` (`itemId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_users` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `item_category` FOREIGN KEY (`catId`) REFERENCES `category` (`catId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_users` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
