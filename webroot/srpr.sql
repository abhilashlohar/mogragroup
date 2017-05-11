-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2017 at 02:25 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shilpa_treding`
--

-- --------------------------------------------------------

--
-- Table structure for table `purchase_returns`
--

CREATE TABLE `purchase_returns` (
  `id` int(10) NOT NULL,
  `invoice_booking_id` int(10) NOT NULL,
  `created_on` date NOT NULL,
  `company_id` int(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `voucher_no` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_returns`
--

INSERT INTO `purchase_returns` (`id`, `invoice_booking_id`, `created_on`, `company_id`, `created_by`, `voucher_no`) VALUES
(1, 0, '2017-05-10', 25, 16, 1),
(2, 0, '2017-05-10', 25, 16, 2),
(3, 0, '2017-05-10', 25, 16, 3),
(4, 0, '2017-05-10', 25, 16, 4),
(5, 0, '2017-05-10', 25, 16, 5),
(6, 0, '2017-05-10', 25, 16, 6),
(7, 0, '2017-05-10', 25, 16, 7),
(8, 0, '2017-05-10', 25, 16, 8),
(9, 0, '2017-05-10', 25, 16, 9),
(10, 0, '2017-05-11', 25, 16, 10),
(11, 0, '2017-05-11', 25, 16, 11),
(12, 0, '2017-05-11', 25, 16, 12),
(13, 0, '2017-05-11', 25, 16, 13),
(14, 0, '2017-05-11', 25, 16, 14),
(15, 0, '2017-05-11', 25, 16, 15),
(16, 0, '2017-05-11', 25, 16, 16),
(17, 0, '2017-05-11', 25, 16, 17),
(18, 7, '2017-05-11', 25, 16, 18),
(19, 6, '2017-05-11', 25, 16, 19);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_rows`
--

CREATE TABLE `purchase_return_rows` (
  `id` int(11) NOT NULL,
  `purchase_return_id` int(10) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_return_rows`
--

INSERT INTO `purchase_return_rows` (`id`, `purchase_return_id`, `item_id`, `quantity`) VALUES
(1, 1, 1039, 40),
(2, 1, 1038, 61),
(3, 2, 1039, 40),
(4, 2, 1038, 61),
(5, 3, 867, 2),
(6, 4, 867, 2),
(7, 5, 867, 2),
(8, 6, 867, 2),
(9, 7, 867, 2),
(10, 8, 867, 2),
(11, 9, 867, 2),
(12, 10, 963, 2),
(13, 10, 966, 1),
(14, 10, 1178, 1),
(15, 10, 746, 5),
(16, 10, 782, 2),
(17, 10, 1207, 2),
(18, 11, 867, 2),
(19, 12, 963, 2),
(20, 12, 966, 1),
(21, 12, 1178, 1),
(22, 12, 746, 5),
(23, 12, 782, 2),
(24, 12, 1207, 2),
(25, 13, 963, 2),
(26, 13, 966, 1),
(27, 13, 1178, 1),
(28, 13, 746, 5),
(29, 13, 782, 2),
(30, 13, 1207, 2),
(31, 14, 963, 2),
(32, 14, 966, 1),
(33, 14, 1178, 1),
(34, 14, 746, 5),
(35, 14, 782, 2),
(36, 14, 1207, 2),
(37, 15, 963, 2),
(38, 15, 966, 1),
(39, 15, 1178, 1),
(40, 15, 746, 5),
(41, 15, 782, 2),
(42, 15, 1207, 2),
(43, 16, 963, 2),
(44, 16, 966, 1),
(45, 16, 1178, 1),
(46, 16, 746, 5),
(47, 16, 782, 2),
(48, 16, 1207, 2),
(49, 17, 867, 2),
(50, 18, 867, 1),
(51, 18, 867, 1),
(52, 18, 867, 1),
(53, 18, 867, 2),
(54, 18, 867, 2),
(55, 18, 867, 1),
(56, 18, 867, 1),
(57, 18, 867, 1),
(58, 18, 867, 1),
(59, 18, 867, 1),
(60, 18, 867, 1),
(61, 18, 867, 1),
(62, 18, 867, 2),
(63, 18, 867, 2),
(64, 18, 867, 2),
(65, 18, 867, 2),
(66, 18, 867, 2),
(67, 18, 867, 2),
(68, 18, 867, 2),
(69, 18, 867, 1),
(70, 18, 867, 2),
(71, 18, 867, 2),
(72, 18, 867, 2),
(73, 19, 963, 1),
(74, 19, 966, 1),
(75, 19, 1178, 1),
(76, 19, 746, 1),
(77, 19, 782, 1),
(78, 19, 1207, 1),
(79, 19, 963, 1),
(80, 19, 966, 1),
(81, 19, 1178, 1),
(82, 19, 746, 1),
(83, 19, 782, 1),
(84, 19, 1207, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sale_returns`
--

CREATE TABLE `sale_returns` (
  `id` int(10) NOT NULL,
  `temp_limit` decimal(10,2) DEFAULT '0.00',
  `customer_id` int(10) NOT NULL,
  `customer_address` text NOT NULL,
  `lr_no` varchar(255) NOT NULL,
  `terms_conditions` text,
  `discount_type` tinyint(1) NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `pnf` decimal(10,2) NOT NULL,
  `pnf_type` tinyint(1) NOT NULL,
  `pnf_per` decimal(4,2) NOT NULL,
  `total_after_pnf` decimal(15,2) NOT NULL,
  `sale_tax_per` decimal(4,2) NOT NULL,
  `sale_tax_id` int(10) NOT NULL,
  `sale_tax_amount` decimal(15,2) NOT NULL,
  `exceise_duty` decimal(10,2) NOT NULL,
  `ed_description` varchar(255) NOT NULL,
  `fright_amount` decimal(8,2) NOT NULL,
  `fright_text` varchar(255) NOT NULL,
  `grand_total` decimal(18,2) NOT NULL,
  `due_payment` decimal(18,2) NOT NULL,
  `date_created` date NOT NULL,
  `company_id` int(10) NOT NULL,
  `process_status` varchar(30) NOT NULL,
  `sales_order_id` int(10) NOT NULL,
  `sr1` varchar(10) NOT NULL,
  `sr2` int(10) NOT NULL,
  `sr3` varchar(10) NOT NULL,
  `sr4` varchar(10) NOT NULL,
  `customer_po_no` varchar(100) NOT NULL,
  `po_date` date NOT NULL,
  `additional_note` varchar(255) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `transporter_id` int(10) NOT NULL,
  `discount_per` decimal(4,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `form47` varchar(100) NOT NULL,
  `form49` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `inventory_voucher_status` varchar(20) NOT NULL DEFAULT 'Pending',
  `payment_mode` varchar(20) NOT NULL,
  `fright_ledger_account` int(10) NOT NULL,
  `sales_ledger_account` int(10) NOT NULL,
  `st_ledger_account_id` int(10) NOT NULL,
  `pdf_font_size` varchar(10) NOT NULL DEFAULT '16px',
  `delivery_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_returns`
--

INSERT INTO `sale_returns` (`id`, `temp_limit`, `customer_id`, `customer_address`, `lr_no`, `terms_conditions`, `discount_type`, `total`, `pnf`, `pnf_type`, `pnf_per`, `total_after_pnf`, `sale_tax_per`, `sale_tax_id`, `sale_tax_amount`, `exceise_duty`, `ed_description`, `fright_amount`, `fright_text`, `grand_total`, `due_payment`, `date_created`, `company_id`, `process_status`, `sales_order_id`, `sr1`, `sr2`, `sr3`, `sr4`, `customer_po_no`, `po_date`, `additional_note`, `employee_id`, `created_by`, `transporter_id`, `discount_per`, `discount`, `form47`, `form49`, `status`, `inventory_voucher_status`, `payment_mode`, `fright_ledger_account`, `sales_ledger_account`, `st_ledger_account_id`, `pdf_font_size`, `delivery_description`) VALUES
(1, '0.00', 17, '', '', NULL, 1, '17237.40', '0.00', 1, '0.00', '17237.40', '14.50', 0, '2499.42', '0.00', '', '0.00', 'Authorised Vehicle ', '19736.82', '0.00', '0000-00-00', 25, '', 0, 'STL', 1, 'BE-3253', '17-18', '', '0000-00-00', '', 0, 0, 0, '0.00', '0.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(2, '0.00', 80, '', '', NULL, 1, '15262.50', '0.00', 1, '0.00', '15262.50', '14.50', 0, '2213.06', '0.00', '', '0.00', 'Freight "TO-PAY" basis', '17475.56', '0.00', '0000-00-00', 25, '', 0, 'STL', 1, 'BE-3383', '17-18', '', '0000-00-00', '', 0, 0, 0, '0.00', '0.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(3, '0.00', 31, '', '', NULL, 1, '31648.00', '0.00', 1, '0.00', '31648.00', '0.00', 0, '0.00', '4068.00', 'Add: Reimbursement of Excise duty, so paid vide Invoice No. 880  dt. 29.03.2017 of M/s Darling Pumps Pvt. Ltd., Indore for Add: Reimbursement of CST so paid vide Invoice No. 880 dated 29.03.2017 against ''C'' Form for\r\n(Rs. 3006/-+Rs.1062/-=4068/-)', '0.00', 'Freight "PAID" basis', '31648.00', '0.00', '0000-00-00', 25, '', 0, 'STL', 2, 'BE-3240', '17-18', '', '0000-00-00', '', 0, 0, 0, '20.00', '6895.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(4, '0.00', 31, '', '', NULL, 1, '31648.00', '0.00', 1, '0.00', '31648.00', '0.00', 0, '0.00', '4068.00', 'Add: Reimbursement of Excise duty, so paid vide Invoice No. 880  dt. 29.03.2017 of M/s Darling Pumps Pvt. Ltd., Indore for Add: Reimbursement of CST so paid vide Invoice No. 880 dated 29.03.2017 against ''C'' Form for\r\n(Rs. 3006/-+Rs.1062/-=4068/-)', '0.00', 'Freight "PAID" basis', '31648.00', '0.00', '0000-00-00', 25, '', 0, 'STL', 3, 'BE-3240', '17-18', '', '0000-00-00', '', 0, 0, 0, '20.00', '6895.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(5, '0.00', 31, '', '', NULL, 1, '31648.00', '0.00', 1, '0.00', '31648.00', '0.00', 0, '0.00', '4068.00', 'Add: Reimbursement of Excise duty, so paid vide Invoice No. 880  dt. 29.03.2017 of M/s Darling Pumps Pvt. Ltd., Indore for Add: Reimbursement of CST so paid vide Invoice No. 880 dated 29.03.2017 against ''C'' Form for\r\n(Rs. 3006/-+Rs.1062/-=4068/-)', '0.00', 'Freight "PAID" basis', '31648.00', '0.00', '0000-00-00', 25, '', 0, 'STL', 4, 'BE-3240', '17-18', '', '0000-00-00', '', 0, 0, 0, '20.00', '6895.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(6, '0.00', 31, '', '', NULL, 1, '31648.00', '0.00', 1, '0.00', '31648.00', '0.00', 0, '0.00', '4068.00', 'Add: Reimbursement of Excise duty, so paid vide Invoice No. 880  dt. 29.03.2017 of M/s Darling Pumps Pvt. Ltd., Indore for Add: Reimbursement of CST so paid vide Invoice No. 880 dated 29.03.2017 against ''C'' Form for\r\n(Rs. 3006/-+Rs.1062/-=4068/-)', '0.00', 'Freight "PAID" basis', '31648.00', '0.00', '0000-00-00', 25, '', 0, 'STL', 5, 'BE-3240', '17-18', '', '0000-00-00', '', 0, 0, 0, '20.00', '6895.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(7, '0.00', 66, '', '', NULL, 1, '2599.75', '51.99', 1, '2.00', '2651.74', '5.50', 0, '145.85', '2599.75', 'Add: Reimbursement of Excise duty, so paid vide Invoice No. 0156V/18 dated 19.04.2017of M/s remi Elektrotechnik Limited, Vasai', '0.00', 'Freight "TO-PAY" basis', '2797.59', '0.00', '0000-00-00', 25, '', 0, 'STL', 6, 'BE-3320', '17-18', '', '0000-00-00', '', 0, 0, 0, '10.00', '0.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(8, '0.00', 66, '', '', NULL, 1, '2599.75', '51.99', 1, '2.00', '2651.74', '5.50', 0, '145.85', '2599.75', 'Add: Reimbursement of Excise duty, so paid vide Invoice No. 0156V/18 dated 19.04.2017of M/s remi Elektrotechnik Limited, Vasai', '0.00', 'Freight "TO-PAY" basis', '2797.59', '0.00', '0000-00-00', 25, '', 0, 'STL', 7, 'BE-3320', '17-18', '', '0000-00-00', '', 0, 0, 0, '10.00', '0.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(9, '0.00', 66, '', '', NULL, 1, '2599.75', '51.99', 1, '2.00', '2651.74', '5.50', 0, '145.85', '2599.75', 'Add: Reimbursement of Excise duty, so paid vide Invoice No. 0156V/18 dated 19.04.2017of M/s remi Elektrotechnik Limited, Vasai', '0.00', 'Freight "TO-PAY" basis', '2797.59', '0.00', '0000-00-00', 25, '', 0, 'STL', 8, 'BE-3320', '17-18', '', '0000-00-00', '', 0, 0, 0, '10.00', '0.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(10, '0.00', 66, '', '', NULL, 1, '2599.75', '51.99', 1, '2.00', '2651.74', '5.50', 0, '145.85', '2599.75', 'Add: Reimbursement of Excise duty, so paid vide Invoice No. 0156V/18 dated 19.04.2017of M/s remi Elektrotechnik Limited, Vasai', '0.00', 'Freight "TO-PAY" basis', '2797.59', '0.00', '0000-00-00', 25, '', 0, 'STL', 9, 'BE-3320', '17-18', '', '0000-00-00', '', 0, 0, 0, '10.00', '0.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(11, '0.00', 66, '', '', NULL, 1, '2599.75', '51.99', 1, '2.00', '2651.74', '5.50', 0, '145.85', '2599.75', 'Add: Reimbursement of Excise duty, so paid vide Invoice No. 0156V/18 dated 19.04.2017of M/s remi Elektrotechnik Limited, Vasai', '0.00', 'Freight "TO-PAY" basis', '2797.59', '0.00', '0000-00-00', 25, '', 0, 'STL', 10, 'BE-3320', '17-18', '', '0000-00-00', '', 0, 0, 0, '10.00', '0.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(12, '0.00', 66, '', '', NULL, 1, '82699.75', '1653.99', 1, '2.00', '84353.74', '5.50', 0, '4639.46', '2599.75', 'Add: Reimbursement of Excise duty, so paid vide Invoice No. 0156V/18 dated 19.04.2017of M/s remi Elektrotechnik Limited, Vasai', '0.00', 'Freight "TO-PAY" basis', '88993.20', '0.00', '0000-00-00', 25, '', 0, 'STL', 11, 'BE-3320', '17-18', '', '0000-00-00', '', 0, 0, 0, '10.00', '8900.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(13, '0.00', 51, '', '', NULL, 1, '675.75', '0.00', 1, '0.00', '675.75', '5.50', 0, '37.17', '675.75', 'Add: Reimbursement of Excise duty, so paid vide Invoice No. 3887V/17 dated 08.03.2017 of M/s Remi Elektrotechnik Limited, Vasai', '1500.00', '"FREIGHT PAID DOOR DELIVERY"  basis', '2212.92', '0.00', '0000-00-00', 25, '', 0, 'STL', 12, 'BE-3353', '17-18', '', '0000-00-00', '', 0, 0, 0, '0.00', '0.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(14, '0.00', 51, '', '', NULL, 1, '675.75', '0.00', 1, '0.00', '675.75', '5.50', 0, '37.17', '675.75', 'Add: Reimbursement of Excise duty, so paid vide Invoice No. 3887V/17 dated 08.03.2017 of M/s Remi Elektrotechnik Limited, Vasai', '1500.00', '"FREIGHT PAID DOOR DELIVERY"  basis', '2212.92', '0.00', '0000-00-00', 25, '', 0, 'STL', 13, 'BE-3353', '17-18', '', '0000-00-00', '', 0, 0, 0, '0.00', '0.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(15, '0.00', 51, '', '', NULL, 1, '54975.75', '0.00', 1, '0.00', '54975.75', '5.50', 0, '3023.67', '675.75', 'Add: Reimbursement of Excise duty, so paid vide Invoice No. 3887V/17 dated 08.03.2017 of M/s Remi Elektrotechnik Limited, Vasai', '1500.00', '"FREIGHT PAID DOOR DELIVERY"  basis', '59499.42', '0.00', '0000-00-00', 25, '', 0, 'STL', 14, 'BE-3353', '17-18', '', '0000-00-00', '', 0, 0, 0, '0.00', '0.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(16, '0.00', 51, '', '', NULL, 1, '675.75', '0.00', 1, '0.00', '675.75', '5.50', 0, '37.17', '675.75', 'Add: Reimbursement of Excise duty, so paid vide Invoice No. 3887V/17 dated 08.03.2017 of M/s Remi Elektrotechnik Limited, Vasai', '1500.00', '"FREIGHT PAID DOOR DELIVERY"  basis', '2212.92', '0.00', '0000-00-00', 25, '', 0, 'STL', 15, 'BE-3353', '17-18', '', '0000-00-00', '', 0, 0, 0, '0.00', '0.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(17, '0.00', 51, '', '', NULL, 1, '675.75', '0.00', 1, '0.00', '675.75', '5.50', 0, '37.17', '675.75', 'Add: Reimbursement of Excise duty, so paid vide Invoice No. 3887V/17 dated 08.03.2017 of M/s Remi Elektrotechnik Limited, Vasai', '1500.00', '"FREIGHT PAID DOOR DELIVERY"  basis', '2212.92', '0.00', '0000-00-00', 25, '', 0, 'STL', 16, 'BE-3353', '17-18', '', '0000-00-00', '', 0, 0, 0, '0.00', '0.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(18, '0.00', 51, '', '', NULL, 1, '675.75', '0.00', 1, '0.00', '675.75', '5.50', 0, '37.17', '675.75', 'Add: Reimbursement of Excise duty, so paid vide Invoice No. 3887V/17 dated 08.03.2017 of M/s Remi Elektrotechnik Limited, Vasai', '1500.00', '"FREIGHT PAID DOOR DELIVERY"  basis', '2212.92', '0.00', '0000-00-00', 25, '', 0, 'STL', 17, 'BE-3353', '17-18', '', '0000-00-00', '', 0, 0, 0, '0.00', '0.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(19, '0.00', 51, '', '', NULL, 1, '675.75', '0.00', 1, '0.00', '675.75', '5.50', 0, '37.17', '675.75', 'Add: Reimbursement of Excise duty, so paid vide Invoice No. 3887V/17 dated 08.03.2017 of M/s Remi Elektrotechnik Limited, Vasai', '1500.00', '"FREIGHT PAID DOOR DELIVERY"  basis', '2212.92', '0.00', '0000-00-00', 25, '', 0, 'STL', 18, 'BE-3353', '17-18', '', '0000-00-00', '', 0, 0, 0, '0.00', '0.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(20, '0.00', 12, '', '', NULL, 1, '0.00', '0.00', 1, '0.00', '0.00', '5.50', 0, '0.00', '0.00', '', '0.00', 'Love Kush Enterprises', '0.00', '0.00', '0000-00-00', 25, '', 0, 'STL', 19, 'BE-3359', '17-18', '', '0000-00-00', '', 0, 0, 0, '0.00', '0.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(21, '0.00', 12, '', '', NULL, 1, '0.00', '0.00', 1, '0.00', '0.00', '5.50', 0, '0.00', '0.00', '', '0.00', 'Love Kush Enterprises', '0.00', '0.00', '0000-00-00', 25, '', 0, 'STL', 20, 'BE-3359', '17-18', '', '0000-00-00', '', 0, 0, 0, '0.00', '0.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(22, '0.00', 12, '', '', NULL, 1, '0.00', '0.00', 1, '0.00', '0.00', '5.50', 0, '0.00', '0.00', '', '0.00', 'Love Kush Enterprises', '0.00', '0.00', '0000-00-00', 25, '', 0, 'STL', 21, 'BE-3359', '17-18', '', '0000-00-00', '', 0, 0, 0, '0.00', '0.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(23, '0.00', 12, '', '', NULL, 1, '0.00', '0.00', 1, '0.00', '0.00', '5.50', 0, '0.00', '0.00', '', '0.00', 'Love Kush Enterprises', '0.00', '0.00', '0000-00-00', 25, '', 0, 'STL', 22, 'BE-3359', '17-18', '', '0000-00-00', '', 0, 0, 0, '0.00', '0.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(24, '0.00', 12, '', '', NULL, 1, '26944.00', '0.00', 1, '0.00', '26944.00', '5.50', 0, '1481.92', '0.00', '', '0.00', 'Love Kush Enterprises', '28425.92', '0.00', '0000-00-00', 25, '', 0, 'STL', 23, 'BE-3359', '17-18', '', '0000-00-00', '', 0, 0, 0, '0.00', '0.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(25, '0.00', 10, '', '', NULL, 1, '17478.44', '0.00', 1, '0.00', '17478.44', '5.50', 0, '961.31', '778.44', 'Add:Reimbursement of Excise duty, so paid vide Invoice No. 7 dt. 08.04.2017 of M/s Mechneers India Pvt. Ltd., Udaipur', '0.00', 'Freight "TO-PAY" bais', '18439.75', '0.00', '0000-00-00', 25, '', 0, 'STL', 24, 'BE-3346', '17-18', '', '0000-00-00', '', 0, 0, 0, '0.00', '0.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', ''),
(26, '0.00', 4, '', '', NULL, 1, '55500.00', '555.00', 1, '1.00', '56055.00', '14.50', 0, '8127.98', '0.00', '', '111.00', '', '64293.97', '0.00', '2017-05-11', 25, '', 0, 'STL', 25, 'BE-2626', '17-18', '', '0000-00-00', '', 0, 0, 0, '20.00', '13875.00', '', '', '', 'Pending', '', 0, 0, 0, '16px', '');

-- --------------------------------------------------------

--
-- Table structure for table `sale_return_rows`
--

CREATE TABLE `sale_return_rows` (
  `id` int(10) NOT NULL,
  `sale_return_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(5) NOT NULL,
  `rate` decimal(15,2) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `height` int(3) NOT NULL,
  `inventory_voucher_status` varchar(10) NOT NULL DEFAULT 'Pending',
  `item_serial_number` varchar(100) NOT NULL,
  `inventory_voucher_applicable` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_return_rows`
--

INSERT INTO `sale_return_rows` (`id`, `sale_return_id`, `item_id`, `description`, `quantity`, `rate`, `amount`, `height`, `inventory_voucher_status`, `item_serial_number`, `inventory_voucher_applicable`) VALUES
(1, 1, 978, '', 2, '5624.00', '11248.00', 0, 'Pending', '', ''),
(2, 1, 979, '', 1, '5989.40', '5989.40', 0, 'Pending', '', ''),
(3, 2, 982, '', 1, '15262.50', '15262.50', 0, 'Pending', '', ''),
(4, 3, 935, '', 1, '34475.00', '34475.00', 0, 'Pending', '', ''),
(5, 4, 935, '', 1, '34475.00', '34475.00', 0, 'Pending', '', ''),
(6, 5, 935, '', 1, '34475.00', '34475.00', 0, 'Pending', '', ''),
(7, 6, 935, '', 1, '34475.00', '34475.00', 0, 'Pending', '', ''),
(8, 7, 806, '', 0, '44500.00', '0.00', 0, 'Pending', '', ''),
(9, 8, 806, '', 0, '44500.00', '0.00', 0, 'Pending', '', ''),
(10, 9, 806, '', 0, '44500.00', '0.00', 0, 'Pending', '', ''),
(11, 10, 806, '', 0, '44500.00', '0.00', 0, 'Pending', '', ''),
(12, 11, 806, '', 0, '44500.00', '0.00', 0, 'Pending', '', ''),
(13, 12, 806, '', 0, '44500.00', '0.00', 0, 'Pending', '', ''),
(14, 12, 806, '', 1, '44500.00', '44500.00', 0, 'Pending', '', ''),
(15, 13, 1112, '', 0, '54300.00', '0.00', 0, 'Pending', '', ''),
(16, 15, 1112, '', 1, '54300.00', '54300.00', 0, 'Pending', '', ''),
(17, 16, 1112, '', 0, '54300.00', '0.00', 0, 'Pending', '', ''),
(18, 17, 1112, '', 0, '54300.00', '0.00', 0, 'Pending', '', ''),
(19, 18, 1112, '', 0, '54300.00', '0.00', 0, 'Pending', '', ''),
(20, 19, 1112, '', 0, '54300.00', '0.00', 0, 'Pending', '', ''),
(21, 23, 1128, '', 0, '26944.00', '0.00', 0, 'Pending', '', ''),
(22, 25, 803, '', 1, '16700.00', '16700.00', 0, 'Pending', '', ''),
(23, 12, 806, '', 1, '44500.00', '44500.00', 0, 'Pending', '', ''),
(24, 12, 806, '', 2, '44500.00', '89000.00', 0, 'Pending', '', ''),
(25, 24, 1128, '', 1, '26944.00', '26944.00', 0, 'Pending', '', ''),
(26, 26, 1155, '', 1, '69375.00', '69375.00', 0, 'Pending', '85', ''),
(27, 26, 1155, '', 1, '69375.00', '69375.00', 0, 'Pending', '85', ''),
(28, 26, 1155, '', 1, '69375.00', '69375.00', 0, 'Pending', '85', ''),
(29, 26, 1155, '', 1, '69375.00', '69375.00', 0, 'Pending', '85', ''),
(30, 26, 1155, '', 1, '69375.00', '69375.00', 0, 'Pending', '85', ''),
(31, 26, 1155, '', 1, '69375.00', '69375.00', 0, 'Pending', '85', ''),
(32, 26, 1155, '', 1, '69375.00', '69375.00', 0, 'Pending', '85', ''),
(33, 26, 1155, '', 1, '69375.00', '69375.00', 0, 'Pending', '85', ''),
(34, 26, 1155, '', 1, '69375.00', '69375.00', 0, 'Pending', '85', ''),
(35, 26, 1155, '', 1, '69375.00', '69375.00', 0, 'Pending', '85', ''),
(36, 26, 1155, '', 1, '69375.00', '69375.00', 0, 'Pending', '85', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_return_rows`
--
ALTER TABLE `purchase_return_rows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_returns`
--
ALTER TABLE `sale_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_return_rows`
--
ALTER TABLE `sale_return_rows`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `purchase_return_rows`
--
ALTER TABLE `purchase_return_rows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `sale_returns`
--
ALTER TABLE `sale_returns`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `sale_return_rows`
--
ALTER TABLE `sale_return_rows`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
