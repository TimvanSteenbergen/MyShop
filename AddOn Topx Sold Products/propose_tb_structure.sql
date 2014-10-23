-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 23, 2014 at 11:10 AM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `my_addon_topx`
--
CREATE DATABASE IF NOT EXISTS `my_addon_topx` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `my_addon_topx`;

-- --------------------------------------------------------

--
-- Table structure for table `order_data`
--

DROP TABLE IF EXISTS `order_data`;
CREATE TABLE IF NOT EXISTS `order_data` (
`id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_date` bigint(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `customer_email` varchar(250) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `also_bought` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=85 ;

--
-- Truncate table before insert `order_data`
--

TRUNCATE TABLE `order_data`;
--
-- Dumping data for table `order_data`
--

INSERT INTO `order_data` (`id`, `order_id`, `order_date`, `product_id`, `quantity`, `customer_email`, `shop_id`, `also_bought`) VALUES
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
(14, 260300, 1413752400, 3607, 1, 'ine.berkelmans@gmail.com', 260302, ''),
(15, 260300, 1413838800, 3031, 1, 'loomanrenee@gmail.com', 260309, ''),
(16, 260300, 1413838800, 3032, 1, 'loomanrenee@gmail.com', 260309, ''),
(17, 260300, 1413838800, 3615, 1, 'loomanrenee@gmail.com', 260309, ''),
(18, 260300, 1413752400, 3011, 1, 's.f.stoffels@online.nl', 260303, ''),
(19, 260300, 1413752400, 3051, 1, 'alzirenebarbosa@hotmail.com', 260318, ''),
(20, 260300, 1413925200, 3024, 1, 'overloon@thomashuis.nl', 260315, ''),
(21, 260300, 1413925200, 3032, 1, 'overloon@thomashuis.nl', 260315, ''),
(22, 260300, 1414011600, 3024, 1, 'overloon@thomashuis.nl', 260315, ''),
(23, 260300, 1414011600, 3032, 1, 'overloon@thomashuis.nl', 260315, ''),
(24, 260300, 1413752400, 3619, 1, 'info@rimpelconsult.nl', 260315, ''),
(25, 260300, 1413752400, 3676, 1, 'info@rimpelconsult.nl', 260315, ''),
(26, 260300, 1413752400, 3606, 1, 'info@rimpelconsult.nl', 260315, ''),
(27, 260300, 1413752400, 3024, 1, 'info@rimpelconsult.nl', 260315, ''),
(28, 260300, 1413752400, 3607, 1, 'ine.berkelmans@gmail.com', 260302, ''),
(29, 260300, 1413838800, 3031, 1, 'loomanrenee@gmail.com', 260309, ''),
(30, 260300, 1413838800, 3032, 1, 'loomanrenee@gmail.com', 260309, ''),
(31, 260300, 1413838800, 3615, 1, 'loomanrenee@gmail.com', 260309, ''),
(32, 260300, 1413752400, 3011, 1, 's.f.stoffels@online.nl', 260303, ''),
(33, 260300, 1413752400, 3051, 1, 'alzirenebarbosa@hotmail.com', 260318, ''),
(34, 260300, 1413925200, 3024, 1, 'overloon@thomashuis.nl', 260315, ''),
(35, 260300, 1413925200, 3032, 1, 'overloon@thomashuis.nl', 260315, ''),
(36, 260300, 1414011600, 3024, 1, 'overloon@thomashuis.nl', 260315, ''),
(37, 260300, 1414011600, 3032, 1, 'overloon@thomashuis.nl', 260315, ''),
(38, 260300, 1413752400, 3619, 1, 'info@rimpelconsult.nl', 260315, ''),
(39, 260300, 1413752400, 3676, 1, 'info@rimpelconsult.nl', 260315, ''),
(40, 260300, 1413752400, 3606, 1, 'info@rimpelconsult.nl', 260315, ''),
(41, 260300, 1413752400, 3024, 1, 'info@rimpelconsult.nl', 260315, ''),
(42, 260300, 1413752400, 3607, 1, 'ine.berkelmans@gmail.com', 260302, ''),
(43, 260300, 1413838800, 3031, 1, 'loomanrenee@gmail.com', 260309, ''),
(44, 260300, 1413838800, 3032, 1, 'loomanrenee@gmail.com', 260309, ''),
(45, 260300, 1413838800, 3615, 1, 'loomanrenee@gmail.com', 260309, ''),
(46, 260300, 1413752400, 3011, 1, 's.f.stoffels@online.nl', 260303, ''),
(47, 260300, 1413752400, 3051, 1, 'alzirenebarbosa@hotmail.com', 260318, ''),
(48, 260300, 1413925200, 3024, 1, 'overloon@thomashuis.nl', 260315, ''),
(49, 260300, 1413925200, 3032, 1, 'overloon@thomashuis.nl', 260315, ''),
(50, 260300, 1414011600, 3024, 1, 'overloon@thomashuis.nl', 260315, ''),
(51, 260300, 1414011600, 3032, 1, 'overloon@thomashuis.nl', 260315, ''),
(52, 260300, 1413752400, 3619, 1, 'info@rimpelconsult.nl', 260315, ''),
(53, 260300, 1413752400, 3676, 1, 'info@rimpelconsult.nl', 260315, ''),
(54, 260300, 1413752400, 3606, 1, 'info@rimpelconsult.nl', 260315, ''),
(55, 260300, 1413752400, 3024, 1, 'info@rimpelconsult.nl', 260315, ''),
(56, 260300, 1413752400, 3607, 1, 'ine.berkelmans@gmail.com', 260302, ''),
(57, 260300, 1413838800, 3031, 1, 'loomanrenee@gmail.com', 260309, ''),
(58, 260300, 1413838800, 3032, 1, 'loomanrenee@gmail.com', 260309, ''),
(59, 260300, 1413838800, 3615, 1, 'loomanrenee@gmail.com', 260309, ''),
(60, 260300, 1413752400, 3011, 1, 's.f.stoffels@online.nl', 260303, ''),
(61, 260300, 1413752400, 3051, 1, 'alzirenebarbosa@hotmail.com', 260318, ''),
(62, 260300, 1413925200, 3024, 1, 'overloon@thomashuis.nl', 260315, ''),
(63, 260300, 1413925200, 3032, 1, 'overloon@thomashuis.nl', 260315, ''),
(64, 260300, 1414011600, 3024, 1, 'overloon@thomashuis.nl', 260315, ''),
(65, 260300, 1414011600, 3032, 1, 'overloon@thomashuis.nl', 260315, ''),
(66, 260300, 1413752400, 3619, 1, 'info@rimpelconsult.nl', 260315, ''),
(67, 260300, 1413752400, 3676, 1, 'info@rimpelconsult.nl', 260315, ''),
(68, 260300, 1413752400, 3606, 1, 'info@rimpelconsult.nl', 260315, ''),
(69, 260300, 1413752400, 3024, 1, 'info@rimpelconsult.nl', 260315, ''),
(70, 260300, 1413752400, 3607, 1, 'ine.berkelmans@gmail.com', 260302, ''),
(71, 260300, 1413838800, 3031, 1, 'loomanrenee@gmail.com', 260309, ''),
(72, 260300, 1413838800, 3032, 1, 'loomanrenee@gmail.com', 260309, ''),
(73, 260300, 1413838800, 3615, 1, 'loomanrenee@gmail.com', 260309, ''),
(74, 260300, 1413752400, 3011, 1, 's.f.stoffels@online.nl', 260303, ''),
(75, 260300, 1413752400, 3051, 1, 'alzirenebarbosa@hotmail.com', 260318, ''),
(76, 260300, 1413925200, 3024, 1, 'overloon@thomashuis.nl', 260315, ''),
(77, 260300, 1413925200, 3032, 1, 'overloon@thomashuis.nl', 260315, ''),
(78, 260300, 1414011600, 3024, 1, 'overloon@thomashuis.nl', 260315, ''),
(79, 260300, 1414011600, 3032, 1, 'overloon@thomashuis.nl', 260315, ''),
(80, 260300, 1413752400, 3619, 1, 'info@rimpelconsult.nl', 260315, ''),
(81, 260300, 1413752400, 3676, 1, 'info@rimpelconsult.nl', 260315, ''),
(82, 260300, 1413752400, 3606, 1, 'info@rimpelconsult.nl', 260315, ''),
(83, 260300, 1413752400, 3024, 1, 'info@rimpelconsult.nl', 260315, ''),
(84, 260300, 1413752400, 3607, 1, 'ine.berkelmans@gmail.com', 260302, '');

-- --------------------------------------------------------

--
-- Table structure for table `topx`
--

DROP TABLE IF EXISTS `topx`;
CREATE TABLE IF NOT EXISTS `topx` (
`id` int(11) NOT NULL,
  `top_x` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `process_date` bigint(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Truncate table before insert `topx`
--

TRUNCATE TABLE `topx`;
--
-- Dumping data for table `topx`
--

INSERT INTO `topx` (`id`, `top_x`, `product_id`, `process_date`) VALUES
(1, 5, 3011, 1414051470),
(3, 5, 3031, 1414051470),
(5, 5, 3051, 1414051470),
(6, 5, 3606, 1414051470),
(7, 5, 3607, 1414051470),
(8, 5, 3615, 1414051470),
(9, 5, 3619, 1414051470),
(10, 5, 3676, 1414051470),
(11, 6, 3011, 1414051484),
(13, 6, 3031, 1414051484),
(15, 6, 3051, 1414051484),
(16, 6, 3606, 1414051484),
(17, 6, 3607, 1414051484),
(18, 6, 3615, 1414051484),
(19, 6, 3619, 1414051484),
(20, 6, 3676, 1414051484),
(2, 15, 3024, 1414051470),
(4, 15, 3032, 1414051470),
(12, 18, 3024, 1414051484),
(14, 18, 3032, 1414051484);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_data`
--
ALTER TABLE `order_data`
 ADD PRIMARY KEY (`id`), ADD KEY `order_id` (`order_id`), ADD KEY `order_date` (`order_date`), ADD KEY `product_id` (`product_id`), ADD KEY `quantity` (`quantity`), ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `topx`
--
ALTER TABLE `topx`
 ADD PRIMARY KEY (`id`), ADD KEY `top_x` (`top_x`,`product_id`,`process_date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_data`
--
ALTER TABLE `order_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `topx`
--
ALTER TABLE `topx`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;