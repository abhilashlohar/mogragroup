-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2017 at 12:37 PM
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
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `controller` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `master` int(55) NOT NULL,
  `orderwise` int(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `controller`, `action`, `name`, `master`, `orderwise`) VALUES
(1, 'Quotations', 'Add', '', 0, 0),
(2, 'Quotations', 'Edit', '', 0, 0),
(3, 'SalesOrders', 'Add', '', 0, 0),
(4, 'SalesOrders', 'Edit', '', 0, 0),
(5, 'JobCards', 'Add', '', 0, 0),
(6, 'JobCards', 'Edit', '', 0, 0),
(7, 'Invoices', 'Add', '', 0, 0),
(8, 'Invoices', 'Edit', '', 0, 0),
(9, 'InventoryVouchers', 'Add', '', 0, 0),
(10, 'InventoryVouchers', 'Edit', '', 0, 0),
(11, 'Challans', 'Add', '', 0, 0),
(12, 'Challans', 'Edit', '', 0, 0),
(13, 'PurchaseOrders', 'Add', '', 0, 0),
(14, 'PurchaseOrders', 'Edit', '', 0, 0),
(15, 'Grns', 'Add', '', 0, 0),
(16, 'Grns', 'Edit', '', 0, 0),
(17, 'InvoiceBookings', 'Add', '', 0, 0),
(18, 'InvoiceBookings', 'Edit', '', 0, 0),
(19, 'Logins', 'Add', 'Logins', 1, 0),
(20, 'UserRights', 'Add', '', 0, 0),
(21, 'Quotations', 'Pdf', '', 0, 0),
(22, 'SalesOrders', 'Pdf', '', 0, 0),
(23, 'Invoices', 'Pdf', '', 0, 0),
(24, 'JobCards', 'View', '', 0, 0),
(25, 'Quotations', 'Confirm', '', 0, 0),
(26, 'SalesOrders', 'Confirm', '', 0, 0),
(27, 'Invoices', 'Confirm', '', 0, 0),
(28, 'Challans', 'Pdf', '', 0, 0),
(29, 'Challans', 'Confirm', '', 0, 0),
(30, 'Quotations', 'Close', '', 0, 0),
(31, 'PurchaseOrders', 'Pdf', '', 0, 0),
(32, 'PurchaseOrders', 'Confirm', '', 0, 0),
(33, 'Invoices', 'Close', '', 0, 0),
(34, 'JobCards', 'Close', '', 0, 0),
(35, 'Grns', 'View', '', 0, 0),
(36, 'ItemLedgers', 'stockReport', '', 0, 0),
(37, 'LedgerAccounts', 'BalanceSheet', '', 0, 0),
(38, 'LedgerAccounts', 'ProfitLossStatement', '', 0, 0),
(39, 'ItemLedgers', 'materialindentreport', '', 0, 0),
(40, 'Ledgers', 'AccountStatement', '', 0, 0),
(41, 'Ledgers', 'Index', '', 0, 0),
(42, 'Customers', 'Add', 'Add new customer', 1, 0),
(43, 'Customers', 'Index', 'List customers', 1, 0),
(44, 'Customers', 'Edit', '', 0, 0),
(45, 'Customers', 'EditCompany', '', 0, 0),
(46, 'Employees', 'Add', 'Add New  Employee', 1, 0),
(47, 'Employees', 'Index', 'List Employees', 1, 0),
(48, 'Employees', 'Edit', '', 0, 0),
(49, 'Employees', 'EditCompany', '', 0, 0),
(50, 'Items', 'Add', 'Add New Item', 1, 0),
(51, 'Items', 'Index', 'List Items', 1, 0),
(52, 'Items', 'Edit', '', 0, 0),
(53, 'Items', 'EditCompany', '', 0, 0),
(54, 'Vendors', 'Add', 'Add New Supplier', 1, 0),
(55, 'Vendors', 'Index', 'List Suppliers', 1, 0),
(56, 'Vendors', 'Edit', '', 0, 0),
(57, 'Vendors', 'EditCompany', '', 0, 0),
(58, 'Companies', 'Add', 'Add New Company', 1, 0),
(59, 'Companies', 'Index', 'List Companies', 1, 0),
(60, 'Companies', 'Edit', '', 0, 0),
(61, 'ItemCategories', 'Index', 'Item Categories', 1, 0),
(62, 'ItemGroups', 'Index', 'Item Groups', 1, 0),
(63, 'ItemSubGroups', 'Index', 'Item Sub-Groups', 1, 0),
(64, 'Units', 'Index', 'Units', 1, 0),
(65, 'CustomerGroups', 'Add', 'Customer Groups', 1, 0),
(66, 'CustomerSegs', 'Add', 'Customers Segments', 1, 0),
(67, 'SaleTaxes', 'Index', 'Sale-Taxes', 1, 0),
(68, 'Filenames', 'Index', 'Files', 1, 0),
(69, 'Filenames', 'Index2', '', 0, 0),
(70, 'Transporters', 'Index', 'Transporters', 1, 0),
(71, 'Districts', 'Index', 'Districts', 1, 0),
(72, 'Designations', 'Index', 'Designations', 1, 0),
(73, 'Departments', 'Index', 'Departments', 1, 0),
(74, 'ledgerAccounts', 'Add', 'Ledger Accounts', 1, 0),
(75, 'ledgerAccounts', 'Edit', '', 0, 0),
(76, 'AccountReferences', 'Index', 'Account References', 1, 0),
(77, 'AccountReferences', 'Edit', '', 0, 0),
(78, 'Ledgers', 'openingBalance', 'Opening Balance', 1, 0),
(79, 'Ledgers', 'openingBalanceView', '', 0, 0),
(80, 'Items', 'openingBalance', 'Item Opening Balance', 1, 0),
(81, 'Items', 'openingBalanceView', '', 0, 0),
(82, 'TermsConditions', 'Index', 'Terms&Conditions', 1, 0),
(83, 'TermsConditions', 'Edit', '', 0, 0),
(84, 'Items', 'cost', 'Item Price Factor', 1, 0),
(85, 'Items', 'costView', '', 0, 0),
(86, 'QuotationCloseReasons', 'Index', 'Quotation Close Reason', 1, 0),
(87, 'QuotationCloseReasons', 'Edit', '', 0, 0),
(88, 'LeaveTypes', 'Index', 'Leave Types', 1, 0),
(89, 'LeaveTypes', 'Edit', '', 0, 0),
(90, 'Payments', 'Add', '', 0, 0),
(91, 'Payments', 'Edit', '', 0, 0),
(92, 'Payments', 'View', '', 0, 0),
(93, 'Payments', 'Index', '', 0, 0),
(94, 'Receipts', 'Add', '', 0, 0),
(95, 'Receipts', 'Edit', '', 0, 0),
(96, 'Receipts', 'View', '', 0, 0),
(97, 'Receipts', 'Index', '', 0, 0),
(98, 'PettyCashReceiptVouchers', 'Add', '', 0, 0),
(99, 'PettyCashReceiptVouchers', 'Edit', '', 0, 0),
(100, 'PettyCashReceiptVouchers', 'View', '', 0, 0),
(101, 'PettyCashReceiptVouchers', 'Index', '', 0, 0),
(102, 'ContraVouchers', 'Add', '', 0, 0),
(103, 'ContraVouchers', 'Edit', '', 0, 0),
(104, 'ContraVouchers', 'View', '', 0, 0),
(105, 'ContraVouchers', 'Index', '', 0, 0),
(106, 'CreditNotes', 'Add', '', 0, 0),
(107, 'CreditNotes', 'Edit', '', 0, 0),
(108, 'CreditNotes', 'View', '', 0, 0),
(109, 'CreditNotes', 'Index', '', 0, 0),
(110, 'DebitNotes', 'Add', '', 0, 0),
(111, 'DebitNotes', 'Edit', '', 0, 0),
(112, 'DebitNotes', 'View', '', 0, 0),
(113, 'DebitNotes', 'Index', '', 0, 0),
(114, 'JournalVouchers', 'Add', '', 0, 0),
(115, 'JournalVouchers', 'Edit', '', 0, 0),
(116, 'JournalVouchers', 'View', '', 0, 0),
(117, 'JournalVouchers', 'Index', '', 0, 0),
(118, 'VouchersReferences', 'Index', '', 0, 0),
(119, 'VouchersReferences', 'Edit', '', 0, 0),
(120, 'MaterialIndents', 'Index', '', 0, 0),
(121, 'FinancialYears', '', 'Financial Year', 1, 0),
(122, 'FinancialMonths', '', 'Financial Month', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
