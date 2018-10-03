-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 03, 2018 at 09:13 AM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.2.9-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pjamasc`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_date` date NOT NULL,
  `event_title` varchar(60) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_date`, `event_title`) VALUES
('2018-12-24', 'Julafton'),
('2018-12-31', 'Nyårsafton'),
('2019-01-01', 'Nyårsdagen');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `info_id` int(11) NOT NULL,
  `info_title` varchar(60) COLLATE utf8_swedish_ci NOT NULL,
  `info_value` varchar(60) COLLATE utf8_swedish_ci NOT NULL,
  `info_weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`info_id`, `info_title`, `info_value`, `info_weight`) VALUES
(1, 'Telefonnummer', '08 555 55 55', 0),
(2, 'E-postadress', 'info@pjamasc.se', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(60) COLLATE utf8_swedish_ci NOT NULL,
  `product_description` mediumtext COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_description`) VALUES
(1, 'Slots', 'Klassiskt Slots-spel.'),
(2, 'Roulette', 'Roulette-spel.');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_author` int(11) NOT NULL,
  `review_product` int(11) NOT NULL,
  `review_creation` datetime NOT NULL,
  `review_rating` int(11) NOT NULL,
  `review_comment` mediumtext COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_author`, `review_product`, `review_creation`, `review_rating`, `review_comment`) VALUES
(1, 1, '2018-09-25 11:06:00', 10, 'Helt klart 10/10!');

-- --------------------------------------------------------

--
-- Table structure for table `rfp`
--

CREATE TABLE `rfp` (
  `rfp_id` int(11) NOT NULL,
  `rfp_owner` int(11) DEFAULT NULL,
  `rfp_notes` text COLLATE utf8_swedish_ci NOT NULL,
  `rfp_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `rfp`
--

INSERT INTO `rfp` (`rfp_id`, `rfp_owner`, `rfp_notes`, `rfp_creation`) VALUES
(1, 1, 'Hoppas ni kan hjälpa till!', '2018-09-25 11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(60) COLLATE utf8_swedish_ci NOT NULL,
  `user_name` varchar(60) COLLATE utf8_swedish_ci NOT NULL,
  `user_org_name` varchar(60) COLLATE utf8_swedish_ci NOT NULL,
  `user_org_no` char(10) COLLATE utf8_swedish_ci NOT NULL,
  `user_password` char(60) COLLATE utf8_swedish_ci NOT NULL,
  `user_type` enum('unconfirmed_customer','customer','admin') COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `user_name`, `user_org_name`, `user_org_no`, `user_password`, `user_type`) VALUES
(1, 'benter@kth.se', 'William', 'Cantaloupe', '5555550000', '$2y$12$DWDeZyfb9BebP8LkYTfXoO6iYFnAdwENFS1mw2Sm8FMapZWAwmIwi', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_date`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`info_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_author`,`review_product`),
  ADD KEY `review_author` (`review_author`),
  ADD KEY `review_product` (`review_product`);

--
-- Indexes for table `rfp`
--
ALTER TABLE `rfp`
  ADD PRIMARY KEY (`rfp_id`),
  ADD KEY `rfp_owner` (`rfp_owner`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rfp`
--
ALTER TABLE `rfp`
  MODIFY `rfp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`review_author`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`review_product`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rfp`
--
ALTER TABLE `rfp`
  ADD CONSTRAINT `rfp_ibfk_1` FOREIGN KEY (`rfp_owner`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
