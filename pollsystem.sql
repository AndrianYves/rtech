-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 27, 2020 at 03:44 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pollsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('admin','superadmin') NOT NULL,
  `stat` enum('active','inactive') NOT NULL DEFAULT 'active',
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `type`, `stat`, `reg_date`) VALUES
(1, 'admin', '1', 'superadmin', 'active', '2020-01-06 09:16:02'),
(2, 'mark', '1', 'admin', 'active', '2020-01-06 09:16:02'),
(3, 'abuzo', '1', 'admin', 'active', '2020-01-06 09:16:02'),
(4, 'superadmin', '$2y$10$WQrDC5iNa5qtNDK7yEHcJeEkeB7r6fvHV96dpSBc1rTUQ3o3lErke', 'superadmin', 'active', '2020-01-06 09:16:02');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `descriptions` text NOT NULL,
  `status` set('active','inactive','archived') NOT NULL DEFAULT 'active',
  `image` varchar(255) DEFAULT NULL,
  `timestamp` timestamp(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `descriptions`, `status`, `image`, `timestamp`) VALUES
(32, 'Trend Micro', 'A seminar for trend micro will be at SLU maryheights campus at February', 'active', NULL, '0000-00-00 00:00:00.000000'),
(33, 'WEBINAR', 'web advanced technology seminar will be held at baguio city', 'active', NULL, '0000-00-00 00:00:00.000000'),
(34, 'POGI', 'SI MARK', 'active', NULL, '0000-00-00 00:00:00.000000'),
(44, 'game na game', 'game na game na game na game', 'archived', NULL, '0000-00-00 00:00:00.000000'),
(45, 'Hello', '', 'active', '240.jpg', '0000-00-00 00:00:00.000000'),
(46, 'heloo', '', 'active', '252.jpg', '2020-01-20 11:27:06.000000'),
(47, 'sdfsdf', 'sdfsdf', 'active', '1.jpg', '2020-01-20 11:28:35.000000');

-- --------------------------------------------------------

--
-- Table structure for table `mainheader`
--

DROP TABLE IF EXISTS `mainheader`;
CREATE TABLE IF NOT EXISTS `mainheader` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mainheader`
--

INSERT INTO `mainheader` (`id`, `content`) VALUES
(1, 'It takes as much energy to wish as it does to plan');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `descriptions` varchar(500) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `name`, `descriptions`, `date_created`) VALUES
(1, 'mission', 'Techno House promotes collaboration among its Members by articulating the fundamental values and principles that underpin the pursuit, dissemination and application of knowledge. The Association advocates for higher education policies and practices that respect diverse perspectives and promote social responsibility. With a particular emphasis on values and leadership, and acting as a forum for sharing and joint action, encourages innovation, mutual learning and cooperation among institutions.', '2020-01-10 07:58:20'),
(2, 'vision', 'Tecnho House aims to be the most representative and influential global association of diverse higher education institutions and their organizations, promoting and advancing a dynamic leadership role for higher education in society.', '2020-01-10 07:58:24'),
(3, 'goals', 'to enhance higher education community’s role and actions in university', '2020-01-10 07:59:06');

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

DROP TABLE IF EXISTS `polls`;
CREATE TABLE IF NOT EXISTS `polls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `descriptions` text NOT NULL,
  `status` set('active','archived') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `title`, `descriptions`, `status`) VALUES
(20, 'Xtreme Martial Arts', 'Which of the given choices is your LEAST favorite XMA?', 'active'),
(21, 'Skate is life', 'Who is your favorite Skater?', 'active'),
(22, 'S A M C I S', 'What course would you choose?', 'active'),
(23, 'Starbucks', 'What size do you usually go for when visiting this lovely coffee shop?', 'active'),
(26, 'pinaka pogi', 'sa IT', 'archived'),
(31, 'NBA', 'who is the mvp of the year', 'active');

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
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `poll_answers`
--

INSERT INTO `poll_answers` (`id`, `poll_id`, `title`, `votes`) VALUES
(54, 20, 'Judo', 3),
(55, 20, 'Karate', 0),
(56, 20, 'Aikido', 1),
(57, 20, 'Taekwondo', 0),
(58, 20, 'Kung Fu', 0),
(59, 20, 'Krav Maga', 0),
(60, 21, 'Marcos Brenes', 4),
(61, 21, 'Luis Mora', 1),
(62, 21, 'Chris Cole', 1),
(63, 21, 'Daewon Song', 7),
(64, 21, 'Spencer Nuzzi', 2),
(65, 21, 'Sean Malto', 1),
(66, 22, 'Information Technology ( IT )', 8),
(67, 22, 'Accountancy', 1),
(68, 22, 'Tourism', 0),
(69, 22, 'Computer Science ( CS )', 4),
(70, 22, 'Financial Management ( FinMan )', 0),
(71, 22, 'Business Administrator ( BusAd )', 2),
(72, 23, 'Tall', 4),
(73, 23, 'Grande', 6),
(74, 23, 'Venti', 17),
(75, 23, 'I do not go to Starbucks because I\'m poor', 8),
(76, 24, 'asd', 0),
(77, 25, 'ito', 0),
(78, 26, 'mark', 5),
(79, 26, 'abuzo', 0),
(80, 27, 'oijswfo4', 0),
(81, 27, 'owiejfoiwe', 0),
(82, 28, 'ofijsa', 0),
(83, 28, 'georgko', 0),
(84, 28, 'prjgpijgr', 0),
(85, 28, 'gojr', 0),
(86, 29, 'asdsd', 0),
(94, 30, 'Bebe boy', 1),
(95, 30, 'Bebe girl', 0),
(96, 30, 'Bebe gay', 0),
(97, 30, 'Bebe bi', 0),
(98, 30, 'Bebe lesb', 0),
(99, 30, 'Bebe trans', 0),
(100, 31, 'Reblon james', 0),
(101, 31, 'Russel Westside', 1),
(102, 31, 'chicken curry', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reg_scheds`
--

DROP TABLE IF EXISTS `reg_scheds`;
CREATE TABLE IF NOT EXISTS `reg_scheds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `creator` varchar(555) NOT NULL,
  `inactive_message` varchar(555) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reg_scheds`
--

INSERT INTO `reg_scheds` (`id`, `start_date`, `end_date`, `creator`, `inactive_message`, `date_created`) VALUES
(1, '2020-01-01 00:00:00', '2020-03-31 00:00:00', 'superadmin', 'Sorry, registration period has already ended. Please wait for it to be opened or inquire to any of the administrators. Thank You.', '2020-01-09 07:53:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `id_number` int(8) DEFAULT NULL,
  `course` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `expiry_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `posting_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('active','inactive','pending') DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `id_number`, `course`, `email`, `password`, `expiry_date`, `posting_date`, `status`) VALUES
(15, 'Mark', 'Abuzo', 2161234, 'BSIT-II', 'asd@yahoo.com', '$2y$10$HWhB7GAw7t.967uiUzQdKeNprEjviRBK3wBtc.PYBxf53bGCdS8dq', '2020-11-30 16:00:00', '2019-11-30 16:00:00', 'inactive'),
(51, 'Mark', 'Abuzo', 2167831, 'BSBA-IV', 'mark@yahoo.com', '$2y$10$HWhB7GAw7t.967uiUzQdKeNprEjviRBK3wBtc.PYBxf53bGCdS8dq', '2020-06-18 16:00:00', '2019-12-18 16:00:00', 'active'),
(52, 'josh', 'avil', 2163538, 'BSIT-IV', 'josh@avila', 'Josh1234', '2020-06-18 16:00:00', '2019-12-18 16:00:00', 'active'),
(54, 'Jason', 'Torio', 2153667, 'BSIT-IV', 'torio@jason', 'Torio1234', '2020-06-18 16:00:00', '2019-12-18 16:00:00', 'active'),
(66, 'Frank Jason', 'Torio', 20131231, 'BSIT - 4', 'torio@gmail.com', '$2y$10$XzKq4gzHstRPbZ7x6m59WuwVOFI5ZIkWF456ObkNp6AVWedeO1R0K', '2020-07-10 16:00:00', '2020-01-10 16:00:00', 'pending'),
(67, 'Laurence', 'Bernardo', 2000000, 'BSIT-IV', 'laurence@gmail.com', '$2y$10$6XdO7I6GgT8xfJgmisbAIes2EXQ9fFh..QwJO.mLnK/hc48H5pvv6', '2020-07-11 16:00:00', '2020-01-11 16:00:00', 'pending'),
(68, 'dude', 'dude', 1234567, 'BSIT-3', '1234@gmail.com', '$2y$10$IqTEdRA8Odv8moVkhQ95/.aaG0G72ZQ2/FozCVy64DHUc307nfOGq', '2020-07-19 16:00:00', '2020-01-19 16:00:00', 'active'),
(69, 'sample', 'asmple', 1111111, 'bsit4', '1111111@gmail.com', '$2y$10$EvYkX5tosZB5V2xqrywg2OZNGtlLSDc1qbJouaXkas5LrVRBpHnaS', '2020-07-26 16:00:00', '2020-01-26 16:00:00', 'active');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
