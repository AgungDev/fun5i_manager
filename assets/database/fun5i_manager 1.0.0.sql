-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 17, 2022 at 05:23 PM
-- Server version: 8.0.29-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fun5i_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `_apps`
--

CREATE TABLE `_apps` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `_apps`
--

INSERT INTO `_apps` (`id`, `name`) VALUES
(1, 'try to schedules'),
(2, 'try to schedules dev');

-- --------------------------------------------------------

--
-- Table structure for table `_users`
--

CREATE TABLE `_users` (
  `id` int NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sandi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `_users`
--

INSERT INTO `_users` (`id`, `fullname`, `email`, `sandi`) VALUES
(1, 'arjun nurdin', 'arjun0nur@gmail.com', 'e3afed0047b08059d0fada10f400c1e5');

-- --------------------------------------------------------

--
-- Table structure for table `_user_apps_registration`
--

CREATE TABLE `_user_apps_registration` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `apps_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `_apps`
--
ALTER TABLE `_apps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_users`
--
ALTER TABLE `_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_user_apps_registration`
--
ALTER TABLE `_user_apps_registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `apps_id` (`apps_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `_apps`
--
ALTER TABLE `_apps`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `_users`
--
ALTER TABLE `_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `_user_apps_registration`
--
ALTER TABLE `_user_apps_registration`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
