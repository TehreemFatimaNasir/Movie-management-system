-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2025 at 10:55 PM
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
-- Database: `dbmovies`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingid` int(11) NOT NULL,
  `theaterid` int(11) NOT NULL,
  `bookingdate` date NOT NULL,
  `person` varchar(50) NOT NULL,
  `userid` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingid`, `theaterid`, `bookingdate`, `person`, `userid`, `status`) VALUES
(6, 2, '2025-01-17', '20', 6, 1),
(8, 16, '2025-01-16', '10', 6, 0),
(9, 16, '2025-01-17', '20', 9, 1),
(10, 15, '2025-01-18', '15', 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `catid` int(11) NOT NULL,
  `catname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catid`, `catname`) VALUES
(10, 'Islamic');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `classid` int(11) NOT NULL,
  `classname` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`classid`, `classname`, `price`) VALUES
(6, 'Gold class', 500.00),
(7, 'Platinum class', 800.00),
(8, 'Box class', 1200.00);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movieid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `releasedate` date NOT NULL,
  `image` varchar(1000) NOT NULL,
  `trailer` varchar(1000) NOT NULL,
  `movie` varchar(1000) NOT NULL,
  `rating` varchar(50) NOT NULL,
  `catid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movieid`, `title`, `description`, `releasedate`, `image`, `trailer`, `movie`, `rating`, `catid`) VALUES
(2, 'Squid Game', 'abc movie desciption', '2023-07-20', 'download.jpeg', '', '', '5', 5),
(8, 'Mufasa: The Lion King', 'Mufasa, a cub lost and alone, meets a sympathetic ', '2025-01-10', 'mufasa191224.jpg', 'watch.htm', '', '4', 5),
(13, 'The Avengers', 'Action/Adventure', '2012-02-04', 'avengers.jpeg', 'Avengers.mp4', 'Avengers.mp4', '4.7', 7),
(19, ' Abraham: The Friend of God', 'The Friend of God', '2010-04-04', 'pic1.jpeg', '', '', '4.5', 10),
(20, 'Al Nebras', '', '2012-05-05', 'pic2.jpeg', '', '', '4.3', 10),
(21, ' Journey to Mecca', 'One of the greatest travellers in human history', '2013-02-22', 'pic3.jpeg', '', '', '5', 10),
(22, 'Salah Al-deen Al-Ayyobi', '', '2014-02-03', 'pic4.jpeg', '', '', '5', 10),
(23, 'Imam', '', '2014-09-09', 'pic5.jpeg', '', '', '4.5', 10),
(24, 'Lion of the Desert', '', '0208-05-05', 'pic6.jpeg', '', '', '3.5', 10),
(25, 'Muhammad: The Messenger of God ', '', '2015-05-05', 'pic7.jpeg', '', '', '5', 10),
(26, 'Kingdom of Heaven', '', '0016-02-02', 'pic8.jpeg', '', '', '4.9', 10),
(27, 'Hussein, Who Said No', '', '2019-05-05', 'pic9.jpeg', '', '', '5', 10),
(28, 'Farouk Omar', '', '2012-05-05', 'pic10.jpeg', 'Farouk Umar Series- Official Trailer 2018 (HD) in Hindi_Urdu.mp4', 'Farouk Umar Series- Official Trailer 2018 (HD) in Hindi_Urdu (1).mp4', '5', 10),
(29, 'Bilal: A New Breed of Hero', '', '2015-05-05', 'pic11.jpeg', 'videoplayback.mp4', 'videoplayback.mp4', '5', 10);

-- --------------------------------------------------------

--
-- Table structure for table `theater`
--

CREATE TABLE `theater` (
  `theaterid` int(11) NOT NULL,
  `movieid` varchar(50) NOT NULL,
  `timing` varchar(50) NOT NULL,
  `days` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `price` int(11) NOT NULL,
  `theater_name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `theater`
--

INSERT INTO `theater` (`theaterid`, `movieid`, `timing`, `days`, `date`, `price`, `theater_name`, `location`, `image`) VALUES
(2, '8', '06:33', 'Friday', '2025-01-10', 2000, 'Cinepax Ocean Mall', 'Karachi', 'mufasa191224.jpg'),
(5, '7', '22:12', 'Monday', '2025-01-19', 1500, 'Atrium', 'Karachi', NULL),
(12, '12', '21:10', 'Friday', '2025-01-17', 1500, 'Nueplex', 'Karachi', NULL),
(13, '17', '19:12', 'Monday', '2025-01-20', 1700, 'Cinepax Ocean Mall', 'Karachi', NULL),
(14, '28', '14:23', 'Friday', '2025-01-17', 1500, 'Cinepax Ocean Mall', 'Karachi', NULL),
(16, '27', '19:30', 'Monday', '2025-01-26', 1600, 'Bahria Town Cinegold Plex', 'Karachi', NULL),
(17, '22', '06:30', 'wednesday', '2025-01-22', 1600, 'Atrium', 'Karachi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `roteype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `name`, `email`, `password`, `roteype`) VALUES
(1, 'admin', 'admin@gmail.com', '123', 1),
(2, 'newuser', 'newuser@gmail.com', '123', 2),
(11, 'amna', 'amna@gmail.com', '123', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingid`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`classid`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movieid`);

--
-- Indexes for table `theater`
--
ALTER TABLE `theater`
  ADD PRIMARY KEY (`theaterid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `classid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movieid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `theater`
--
ALTER TABLE `theater`
  MODIFY `theaterid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
