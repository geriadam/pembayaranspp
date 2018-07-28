-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2018 at 03:52 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hakikidonarta`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_milestone`
--

CREATE TABLE `about_milestone` (
  `about_milestone_id` int(11) NOT NULL,
  `about_milestone_title` varchar(255) NOT NULL,
  `about_milestone_year` varchar(255) NOT NULL,
  `about_milestone_description` text NOT NULL,
  `about_milestone_image` text NOT NULL,
  `about_milestone_position` enum('left','right') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about_milestone`
--

INSERT INTO `about_milestone` (`about_milestone_id`, `about_milestone_title`, `about_milestone_year`, `about_milestone_description`, `about_milestone_image`, `about_milestone_position`) VALUES
(1, 'Milestone 1998', '1997', '<p><span style="font-family: "Open Sans", Arial, sans-serif; font-size: 14px; text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span></p><p><span style="font-family: "Open Sans", Arial, sans-serif; font-size: 14px; text-align: justify;"> Sed lacus mauris, scelerisque vitae elementum ac</span><br></p>', 'SwoGptQ06ZOoRlc7lB9y.jpg', 'left');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `article_id` int(11) NOT NULL,
  `article_category_id` int(11) NOT NULL,
  `article_title` varchar(255) NOT NULL,
  `article_featured_image` varchar(255) NOT NULL,
  `article_short_description` text,
  `article_description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `article_category_id`, `article_title`, `article_featured_image`, `article_short_description`, `article_description`, `created_at`, `updated_at`, `is_deleted`) VALUES
(2, 4, 'Neque porro quisquam est qui dolorem', 'wQKosYqB3KnGNfjot9A6.png', '<p><span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s,&nbsp;</span><br></p>', '<p><strong style="margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">Lorem Ipsum</strong><span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p><p><span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;"><br></span></p><p><span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</span></p><p><span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;"><br></span></p><p><span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text</span><span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;"><br></span><span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;"><br></span><br></p>', '2018-07-19 07:45:37', '2018-07-19 07:45:37', 0),
(3, 3, 'Unknown printer took a galley', 'RLWuZHmJR4XhcCdJwBk1.png', '<p><span style="font-family: "Open Sans", Arial, sans-serif; font-size: 14px; text-align: justify;">simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s</span><br></p>', '<p><strong style="margin: 0px; padding: 0px; font-family: "Open Sans", Arial, sans-serif; font-size: 14px; text-align: justify;">Lorem Ipsum</strong><span style="font-family: "Open Sans", Arial, sans-serif; font-size: 14px; text-align: justify;"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</span></p><p><span style="font-family: "Open Sans", Arial, sans-serif; font-size: 14px; text-align: justify;"><br></span></p><p><span style="font-family: "Open Sans", Arial, sans-serif; font-size: 14px; text-align: justify;">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from</span><span style="font-family: "Open Sans", Arial, sans-serif; font-size: 14px; text-align: justify;"><br></span><br></p>', '2018-07-19 07:47:59', '2018-07-19 09:39:31', 0),
(4, 5, 'Randomised words which don''t look even slightly', 'QkhfP0Z0ukuCRdQFoDU4.png', '<p><span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour,</span><span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">r randomised words which don''t look even slightly believable.</span><br></p>', '<p><span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes&nbsp;</span></p><p><span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;"><br></span></p><p><span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">&nbsp;the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lore</span></p><p><span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;"><br></span></p><p><span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</span><span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;"><br></span><span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;"><br></span><br></p>', '2018-07-19 07:48:57', '2018-07-19 09:42:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `article_category`
--

CREATE TABLE `article_category` (
  `article_category_id` int(11) NOT NULL,
  `article_category_name` varchar(255) NOT NULL,
  `article_category_color` varchar(255) NOT NULL DEFAULT 'orange',
  `article_category_image` text NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article_category`
--

INSERT INTO `article_category` (`article_category_id`, `article_category_name`, `article_category_color`, `article_category_image`, `is_deleted`) VALUES
(3, 'News', 'lightgreen', 'aADZUTwIg9Lj1egjYbTv.png', 0),
(4, 'Events', 'orange', 'V4ytisAmCX8frIi3R0un.png', 0),
(5, 'Tips', 'oldgreen', 'CF8iJLxJuvgvvfZzRyNO.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `contact_title` varchar(255) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_company` varchar(255) NOT NULL,
  `contact_phone` varchar(20) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_country` varchar(255) NOT NULL,
  `contact_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `contact_title`, `contact_name`, `contact_company`, `contact_phone`, `contact_email`, `contact_country`, `contact_message`) VALUES
(3, 'Tes title', 'Tes name', 'Tes compnay', '085733645271', 'tesaklda@gmail.com', 'Tes country', 'Tes message');

-- --------------------------------------------------------

--
-- Table structure for table `product_brand`
--

CREATE TABLE `product_brand` (
  `product_brand_id` int(11) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `product_brand_name` varchar(255) NOT NULL,
  `product_brand_image` text NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `product_category_id` int(11) NOT NULL,
  `product_category_parent_id` int(11) DEFAULT NULL,
  `product_category_name` varchar(255) NOT NULL,
  `product_category_image` varchar(255) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`product_category_id`, `product_category_parent_id`, `product_category_name`, `product_category_image`, `is_deleted`) VALUES
(5, NULL, 'Oil & fats', 'OYnYcsddlzbBQMNQxmH2.png', 0),
(6, NULL, 'Dairy', 'KMKsr8f7h2OHCdQtBG88.png', 0),
(7, NULL, 'Hidrocolloid', 'Z2SlEuTwlHbKNAV2pgMR.png', 0),
(8, NULL, 'Yeast & Imporved', 'rDDx8Cl4CXk88HfcwyKq.png', 0),
(9, NULL, 'Vitamin', 'h4pFJB3c7JYrRl4Bwxsx.png', 0),
(10, NULL, 'Food Colour & Flavour', 'bF1tXcmxEC8caKPUU5Aq.png', 0),
(11, NULL, 'Fruit Filling', 'pmo9gYo4LV12baOn6dVf.png', 0),
(12, NULL, 'Chocolate', 'yizIHW8WkJHqH9DylX6y.png', 0),
(13, NULL, 'Coffe', 'rONTgDEntrq3lWHpq5tt.png', 0),
(14, NULL, 'Cereals', 'sxP3hRgOfP8tdwFbPykD.png', 0),
(15, NULL, 'Nuts', 'aGw6iW2MiwKHJDDk3T8j.png', 0),
(16, NULL, 'Natural Sugar', 'FRJ82kIjz4Iu3ehv3kGK.png', 0);

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
(1, 'admin123@admin.com', '$2y$10$e3Uz4FoAh.QAYH0a26PZyuIykCfGQD.PiKyBM2EJPoySBgp371pty', 'Admin Hakiki', NULL, '2018-07-09 10:11:56', '2018-07-19 07:06:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_milestone`
--
ALTER TABLE `about_milestone`
  ADD PRIMARY KEY (`about_milestone_id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `article_category`
--
ALTER TABLE `article_category`
  ADD PRIMARY KEY (`article_category_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `product_brand`
--
ALTER TABLE `product_brand`
  ADD PRIMARY KEY (`product_brand_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_milestone`
--
ALTER TABLE `about_milestone`
  MODIFY `about_milestone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `article_category`
--
ALTER TABLE `article_category`
  MODIFY `article_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product_brand`
--
ALTER TABLE `product_brand`
  MODIFY `product_brand_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
