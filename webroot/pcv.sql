-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2017 at 08:34 AM
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
-- Table structure for table `petty_cash_vouchers`
--

CREATE TABLE `petty_cash_vouchers` (
  `id` int(10) NOT NULL,
  `voucher_no` int(10) NOT NULL,
  `bank_cash_id` int(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_on` date NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `company_id` int(10) NOT NULL,
  `transaction_date` date NOT NULL,
  `edited_by` int(10) NOT NULL,
  `edited_on` date NOT NULL,
  `cheque_no` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petty_cash_vouchers`
--

INSERT INTO `petty_cash_vouchers` (`id`, `voucher_no`, `bank_cash_id`, `created_by`, `created_on`, `payment_mode`, `company_id`, `transaction_date`, `edited_by`, `edited_on`, `cheque_no`) VALUES
(1, 1, 453, 16, '2017-05-12', 'Cheque', 25, '2017-05-12', 16, '2017-05-12', '1');

-- --------------------------------------------------------

--
-- Table structure for table `petty_cash_voucher_rows`
--

CREATE TABLE `petty_cash_voucher_rows` (
  `id` int(10) NOT NULL,
  `petty_cash_voucher_id` int(10) NOT NULL,
  `received_from_id` int(10) NOT NULL,
  `amount` decimal(20,5) NOT NULL,
  `cr_dr` varchar(5) NOT NULL,
  `narration` text NOT NULL,
  `auto_inc` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petty_cash_voucher_rows`
--

INSERT INTO `petty_cash_voucher_rows` (`id`, `petty_cash_voucher_id`, `received_from_id`, `amount`, `cr_dr`, `narration`, `auto_inc`) VALUES
(11, 1, 305, '3000.00000', 'Dr', '1', 0),
(12, 1, 306, '5000.00000', 'Cr', '2', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `petty_cash_vouchers`
--
ALTER TABLE `petty_cash_vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petty_cash_voucher_rows`
--
ALTER TABLE `petty_cash_voucher_rows`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `petty_cash_vouchers`
--
ALTER TABLE `petty_cash_vouchers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `petty_cash_voucher_rows`
--
ALTER TABLE `petty_cash_voucher_rows`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
