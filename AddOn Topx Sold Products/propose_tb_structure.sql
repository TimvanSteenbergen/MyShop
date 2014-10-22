-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 22, 2014 at 02:18 PM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_addon_topx`
--

-- --------------------------------------------------------

--
-- Table structure for table `topx`
--

CREATE TABLE IF NOT EXISTS `topx` (
`id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_date` bigint(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `customer_email` varchar(250) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `also_bought` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `topx`
--

INSERT INTO `topx` (`id`, `order_id`, `order_date`, `product_id`, `quantity`, `customer_email`, `shop_id`, `also_bought`) VALUES
(1, 260300, 1413838800, 3031, 1, 'loomanrenee@gmail.com', 260309, ''),
(2, 260300, 1413838800, 3032, 1, 'loomanrenee@gmail.com', 260309, ''),
(3, 260300, 1413838800, 3615, 1, 'loomanrenee@gmail.com', 260309, ''),
(4, 260300, 1413752400, 3011, 1, 's.f.stoffels@online.nl', 260303, ''),
(5, 260300, 1413752400, 3051, 1, 'alzirenebarbosa@hotmail.com', 260318, ''),
(6, 260300, 1413925200, 3024, 1, 'overloon@thomashuis.nl', 260315, ''),
(7, 260300, 1413925200, 3032, 1, 'overloon@thomashuis.nl', 260315, ''),
(8, 260300, 1414011600, 3024, 1, 'overloon@thomashuis.nl', 260315, ''),
(9, 260300, 1414011600, 3032, 1, 'overloon@thomashuis.nl', 260315, ''),
(10, 260300, 1413752400, 3619, 1, 'info@rimpelconsult.nl', 260315, ''),
(11, 260300, 1413752400, 3676, 1, 'info@rimpelconsult.nl', 260315, ''),
(12, 260300, 1413752400, 3606, 1, 'info@rimpelconsult.nl', 260315, ''),
(13, 260300, 1413752400, 3024, 1, 'info@rimpelconsult.nl', 260315, ''),
(14, 260300, 1413752400, 3607, 1, 'ine.berkelmans@gmail.com', 260302, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `topx`
--
ALTER TABLE `topx`
 ADD PRIMARY KEY (`id`), ADD KEY `product_id` (`product_id`,`quantity`,`order_date`), ADD KEY `order_id` (`order_id`), ADD KEY `customer_email` (`customer_email`), ADD KEY `shop_id` (`shop_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `topx`
--
ALTER TABLE `topx`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;