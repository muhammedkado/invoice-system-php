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
-- Table structure for table `invoice_order`
--

CREATE TABLE `invoice_order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_receiver_name` varchar(250) NOT NULL,
  `order_receiver_address` mediumtext NOT NULL,
  `order_total_before_tax` decimal(10,2) NOT NULL,
  `order_total_tax` decimal(10,2) NOT NULL,
  `order_tax_per` varchar(250) NOT NULL,
  `order_total_after_tax` double(10,2) NOT NULL,
  `order_amount_paid` decimal(10,2) NOT NULL,
  `order_total_amount_due` decimal(10,2) NOT NULL,
  `customer_note` mediumtext NOT NULL,
  `payment_information` mediumtext NOT NULL,
  `billing_Date` date NOT NULL,
  `due_date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `invoice_order`
--

INSERT INTO `invoice_order` (`order_id`, `user_id`, `order_date`, `order_receiver_name`, `order_receiver_address`, `order_total_before_tax`, `order_total_tax`, `order_tax_per`, `order_total_after_tax`, `order_amount_paid`, `order_total_amount_due`, `customer_note`, `payment_information`, `billing_Date`, `due_date`, `status`, `email`) VALUES
(696, 123456, '2023-05-02 22:48:27', 'kadijobs', 'hatay-turkiye', '506.00', '0.00', '', 506.00, '0.00', '506.00', 'wewew', '', '2023-05-03', '2023-05-31', 'Paid', '		mehmetkado8@gmail.com'),
(702, 123456, '2023-05-03 10:08:03', 'islava', 'aasdasd', '484.00', '0.00', '', 484.00, '0.00', '484.00', 'qawd', '', '2023-05-03', '2023-05-06', 'Late', '		mehmetkado9@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice_order`
--
ALTER TABLE `invoice_order`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice_order`
--
ALTER TABLE `invoice_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=703;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
