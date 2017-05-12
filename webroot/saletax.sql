-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2017 at 08:39 AM
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
-- Table structure for table `sale_taxes`
--

CREATE TABLE `sale_taxes` (
  `id` int(10) NOT NULL,
  `tax_figure` decimal(4,2) NOT NULL,
  `quote_description` varchar(200) NOT NULL,
  `invoice_description` varchar(200) NOT NULL,
  `account_category_id` int(10) NOT NULL,
  `account_group_id` int(10) NOT NULL,
  `account_first_subgroup_id` int(10) NOT NULL,
  `account_second_subgroup_id` int(10) NOT NULL,
  `ledger_account_id` int(10) NOT NULL,
  `freeze` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_taxes`
--

INSERT INTO `sale_taxes` (`id`, `tax_figure`, `quote_description`, `invoice_description`, `account_category_id`, `account_group_id`, `account_first_subgroup_id`, `account_second_subgroup_id`, `ledger_account_id`, `freeze`) VALUES
(1, '14.50', 'VAT @ 14.50 % or as applicable on date of dispatch', 'VAT @ 14.50 %', 2, 6, 4, 5, 18, 0),
(2, '5.50', 'VAT @ 5.50 % or as applicable on date of dispatch', 'VAT @ 5.50%', 2, 6, 4, 5, 19, 0),
(3, '0.00', 'NIL CST agst C & E1 Form', 'NIL CST agst C & E1 Form', 2, 6, 4, 5, 20, 0),
(4, '2.00', '2% CST against C Form or as applicable on date of dispatch', '2% CST against C Form ', 2, 6, 4, 5, 21, 0),
(5, '2.00', '2 % CST against C & E1 Form', '2 % CST against C & E1 Form', 2, 6, 4, 5, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sale_tax_companies`
--

CREATE TABLE `sale_tax_companies` (
  `sale_taxe_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `freeze` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_tax_companies`
--

INSERT INTO `sale_tax_companies` (`sale_taxe_id`, `company_id`, `freeze`) VALUES
(1, 25, 0),
(1, 26, 0),
(2, 25, 0),
(2, 26, 0),
(2, 27, 0),
(3, 25, 0),
(3, 26, 0),
(4, 25, 0),
(4, 26, 0),
(5, 25, 0),
(5, 26, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sale_taxes`
--
ALTER TABLE `sale_taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_tax_companies`
--
ALTER TABLE `sale_tax_companies`
  ADD PRIMARY KEY (`sale_taxe_id`,`company_id`),
  ADD KEY `company_key` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sale_taxes`
--
ALTER TABLE `sale_taxes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
