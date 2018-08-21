-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2018 at 05:44 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pembayaranspp`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_08_12_175858_update_santri_table_1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `payment_type_id` int(11) NOT NULL,
  `payment_type_name` varchar(255) NOT NULL,
  `payment_type_price` int(11) NOT NULL,
  `payment_type_unit` enum('day','month','year') NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`payment_type_id`, `payment_type_name`, `payment_type_price`, `payment_type_unit`, `is_deleted`) VALUES
(1, 'SPP', 150000, 'month', 0),
(2, 'Laundry', 60000, 'month', 0),
(3, 'Biaya makan', 450000, 'month', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pesantren_profile`
--

CREATE TABLE `pesantren_profile` (
  `pesantren_profile_id` int(11) NOT NULL,
  `pesantren_profile_name` varchar(255) NOT NULL,
  `pesantren_profile_address` text NOT NULL,
  `pesantren_profile_logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesantren_profile`
--

INSERT INTO `pesantren_profile` (`pesantren_profile_id`, `pesantren_profile_name`, `pesantren_profile_address`, `pesantren_profile_logo`) VALUES
(1, 'Pesantren Al Ikhlas', 'Jl Mawar RT 01 RW 01 Desa Aman Kec. Gudo Kab. Jombang', 'rhNYUC6zIHLvvtk75t4k.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `santri`
--

CREATE TABLE `santri` (
  `santri_id` int(11) NOT NULL,
  `santri_number` varchar(255) NOT NULL,
  `santri_name` varchar(255) NOT NULL,
  `santri_nick_name` varchar(255) NOT NULL,
  `santri_birth_place` varchar(255) NOT NULL,
  `santri_birth_date` date NOT NULL,
  `santri_gender` enum('man','woman') NOT NULL,
  `santri_order_child` smallint(6) NOT NULL,
  `santri_address` text NOT NULL,
  `santri_school` varchar(255) NOT NULL,
  `santri_school_address` text NOT NULL,
  `santri_parent_name` varchar(255) NOT NULL,
  `santri_parent_address` text NOT NULL,
  `santri_parent_job` varchar(255) NOT NULL,
  `santri_parent_telephone` varchar(14) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `santri`
--

INSERT INTO `santri` (`santri_id`, `santri_number`, `santri_name`, `santri_nick_name`, `santri_birth_place`, `santri_birth_date`, `santri_gender`, `santri_order_child`, `santri_address`, `santri_school`, `santri_school_address`, `santri_parent_name`, `santri_parent_address`, `santri_parent_job`, `santri_parent_telephone`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, '3213131', 'Anas mufti', 'anas', 'jombang', '2000-06-14', 'man', 2, 'gedangan', 'smkn 2 mojokerto', 'jl pulorejo', 'anas', 'bancang', 'guru', '08475202391', '2018-08-13 09:34:52', '2018-08-13 09:34:52', 0),
(2, '12313', 'Geri adam', 'geri', 'surabaya', '2010-02-15', 'man', 6, 'surabaya', 'smkn 2 mojokerto', 'pulorejo', 'geri', 'jombang', 'guru', '083848920921', '2018-08-13 03:30:14', '2018-08-13 03:30:14', 0),
(3, '2313131', 'Ahmad', 'ahmad', 'surabaya', '1998-10-26', 'man', 5, 'gedongan', 'smkn 2 mojokerto', 'pulorejo', 'ahmad', 'gedongan', 'guru', '08398182912', '2018-08-13 07:48:14', '2018-08-13 07:48:14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `santri_id` int(11) NOT NULL,
  `transaction_number` varchar(20) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `transaction_total` int(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `santri_id`, `transaction_number`, `transaction_date`, `transaction_total`, `created_at`, `updated_at`, `is_deleted`) VALUES
(19, 3, 'TR2018080001', '2018-08-13 23:04:49', 150000, '2018-08-13 23:04:49', '2018-08-13 23:04:49', 0),
(20, 1, 'TR2018080002', '2018-08-13 23:10:32', 150000, '2018-08-13 23:10:32', '2018-08-13 23:10:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_item`
--

CREATE TABLE `transaction_item` (
  `transaction_item_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `transaction_month` int(11) DEFAULT NULL,
  `transaction_year` int(11) DEFAULT NULL,
  `transaction_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_item`
--

INSERT INTO `transaction_item` (`transaction_item_id`, `transaction_id`, `payment_type_id`, `transaction_month`, `transaction_year`, `transaction_price`) VALUES
(35, 19, 1, 10, 2018, 150000),
(36, 20, 1, 8, 2018, 150000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `name`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@admin.com', '$2y$10$svSqbqv4hi1Pcq3wuO5DouXoJ1uEgwfCYrzVChbW0PCjOXPy/V28y', 'admin', NULL, '2018-07-09 10:11:56', '2018-08-04 17:55:18'),
(2, 'admin2@gmail.com', '$2y$10$kBWUQtrkGFoMxuUULTdmn.t0eK.NrR0ABPTj.GizT4wQx.d1QWlb6', 'Admin Dua', NULL, '2018-08-04 17:51:04', '2018-08-04 17:54:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`payment_type_id`);

--
-- Indexes for table `pesantren_profile`
--
ALTER TABLE `pesantren_profile`
  ADD PRIMARY KEY (`pesantren_profile_id`);

--
-- Indexes for table `santri`
--
ALTER TABLE `santri`
  ADD PRIMARY KEY (`santri_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `transaction_item`
--
ALTER TABLE `transaction_item`
  ADD PRIMARY KEY (`transaction_item_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `payment_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pesantren_profile`
--
ALTER TABLE `pesantren_profile`
  MODIFY `pesantren_profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `santri`
--
ALTER TABLE `santri`
  MODIFY `santri_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `transaction_item`
--
ALTER TABLE `transaction_item`
  MODIFY `transaction_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
