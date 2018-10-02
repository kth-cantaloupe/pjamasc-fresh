-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 02 okt 2018 kl 22:45
-- Serverversion: 10.1.34-MariaDB
-- PHP-version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `pjamasc`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `info`
--

CREATE TABLE `info` (
  `info_id` int(11) NOT NULL,
  `info_title` varchar(60) COLLATE utf8_swedish_ci NOT NULL,
  `info_value` varchar(60) COLLATE utf8_swedish_ci NOT NULL,
  `info_weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `info`
--

INSERT INTO `info` (`info_id`, `info_title`, `info_value`, `info_weight`) VALUES
(1, 'Phone number', '08 555 55 55', 0),
(2, 'E-mail', 'info@pjamasc.se', 1);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`info_id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `info`
--
ALTER TABLE `info`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
