-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 19, 2019 at 08:58 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phppoll`
--

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

DROP TABLE IF EXISTS `polls`;
CREATE TABLE IF NOT EXISTS `polls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `title`, `desc`) VALUES
(19, 'Can you answer this?', 'There are 5 people in a room, you go in and shoot 4 of the 5. How many is left?'),
(20, 'Xtreme Martial Arts', 'Which of the given choices is your LEAST favorite XMA?'),
(21, 'Skate is life', 'Who is your favorite Skater?'),
(22, 'S A M C I S', 'What course would you choose?'),
(23, 'Starbucks', 'What size do you usually go for when visiting this lovely coffee shop?');

-- --------------------------------------------------------

--
-- Table structure for table `poll_answers`
--

DROP TABLE IF EXISTS `poll_answers`;
CREATE TABLE IF NOT EXISTS `poll_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `votes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `poll_answers`
--

INSERT INTO `poll_answers` (`id`, `poll_id`, `title`, `votes`) VALUES
(49, 19, '2 People', 2),
(50, 19, 'Yes', 1),
(51, 19, '1 Person', 5),
(52, 19, '5 People', 0),
(53, 19, 'No', 0),
(54, 20, 'Judo', 3),
(55, 20, 'Karate', 0),
(56, 20, 'Aikido', 1),
(57, 20, 'Taekwondo', 0),
(58, 20, 'Kung Fu', 0),
(59, 20, 'Krav Maga', 0),
(60, 21, 'Marcos Brenes', 3),
(61, 21, 'Luis Mora', 1),
(62, 21, 'Chris Cole', 1),
(63, 21, 'Daewon Song', 7),
(64, 21, 'Spencer Nuzzi', 2),
(65, 21, 'Sean Malto', 1),
(66, 22, 'Information Technology ( IT )', 8),
(67, 22, 'Accountancy', 1),
(68, 22, 'Tourism', 0),
(69, 22, 'Computer Science ( CS )', 3),
(70, 22, 'Financial Management ( FinMan )', 0),
(71, 22, 'Business Administrator ( BusAd )', 2),
(72, 23, 'Tall', 3),
(73, 23, 'Grande', 5),
(74, 23, 'Venti', 17),
(75, 23, 'I do not go to Starbucks because I\'m poor', 8);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
