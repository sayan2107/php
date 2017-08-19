-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2017 at 07:44 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `kart`
--

CREATE TABLE `kart` (
  `id` int(11) NOT NULL,
  `image` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `desc` text NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `shipping` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kart`
--

INSERT INTO `kart` (`id`, `image`, `name`, `desc`, `price`, `quantity`, `shipping`) VALUES
(1, 'a.jpeg', 'samsung note', 'lastest smartphone', 60, 7, 10),
(2, 'b.jpeg', 't-shirt', 'nice t shirt', 50.2, 10, 10),
(3, 'c.jpg', 'cookies', 'nice food', 10, 15, 10),
(4, 'd.jpeg', 'roolax watch', 'stylist watch', 58.3, 8, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kart`
--
ALTER TABLE `kart`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kart`
--
ALTER TABLE `kart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
