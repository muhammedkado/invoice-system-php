-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2023 at 01:19 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoice_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoice_order_item`
--

CREATE TABLE `invoice_order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_code` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `item_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `order_item_quantity` decimal(10,2) NOT NULL,
  `order_item_price` decimal(10,2) NOT NULL,
  `order_item_final_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `invoice_order_item`
--

INSERT INTO `invoice_order_item` (`order_item_id`, `order_id`, `item_code`, `item_name`, `order_item_quantity`, `order_item_price`, `order_item_final_amount`) VALUES
(4424, 702, 'qwe', 'asdasd', '22.00', '22.00', '484.00'),
(4426, 696, 'phone', 'asd asd asd asdasd', '22.00', '23.00', '506.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice_order_item`
--
ALTER TABLE `invoice_order_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice_order_item`
--
ALTER TABLE `invoice_order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4427;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
