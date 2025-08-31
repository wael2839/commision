-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2024 at 06:46 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `byte_in_the_hole`
--
CREATE DATABASE IF NOT EXISTS `byte_in_the_hole` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `byte_in_the_hole`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adm_id` int(11) NOT NULL,
  `adm_name` varchar(255) NOT NULL,
  `adm_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `adm_name`, `adm_password`) VALUES
(1, 'wael', '1234'),
(2, 'azezy', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `enr_stu_id` int(11) NOT NULL,
  `enr_sub_id` int(11) NOT NULL,
  `enr_grade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `fac_id` int(11) NOT NULL,
  `fac_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`fac_id`, `fac_name`) VALUES
(1, 'Medicine'),
(2, 'Engineering'),
(3, 'Law');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stu_id` int(11) NOT NULL,
  `stu_name` varchar(255) NOT NULL,
  `stu_fac_id` int(11) NOT NULL,
  `stu_dob` date NOT NULL,
  `stu_adm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stu_id`, `stu_name`, `stu_fac_id`, `stu_dob`, `stu_adm_id`) VALUES
(1, 'Ali', 3, '1998-07-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`enr_stu_id`,`enr_sub_id`),
  ADD KEY `Enr_Sub_Id` (`enr_sub_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`fac_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stu_id`),
  ADD KEY `faculty_fk` (`stu_fac_id`),
  ADD KEY `Admin_fk` (`stu_adm_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `fac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `Enr_Stu_Id` FOREIGN KEY (`enr_stu_id`) REFERENCES `student` (`stu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Enr_Sub_Id` FOREIGN KEY (`enr_sub_id`) REFERENCES `subject` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `Admin_fk` FOREIGN KEY (`stu_adm_id`) REFERENCES `admin` (`adm_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `faculty_fk` FOREIGN KEY (`stu_fac_id`) REFERENCES `faculty` (`fac_id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Database: `commission`
--
CREATE DATABASE IF NOT EXISTS `commission` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `commission`;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `c_phone` varchar(14) CHARACTER SET utf8 NOT NULL,
  `c_date` date NOT NULL,
  `c_note` text CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `c_name`, `c_phone`, `c_date`, `c_note`) VALUES
(0, 'زبون عام', '09999999', '2024-01-24', ''),
(5, 'محمد', '0955664422', '2024-01-31', ''),
(6, 'فراس', '0995533112', '2024-01-31', '');

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `f_id` int(11) NOT NULL,
  `f_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_phone` varchar(14) CHARACTER SET utf8 NOT NULL,
  `f_address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_date` date NOT NULL,
  `f_note` text CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`f_id`, `f_name`, `f_phone`, `f_address`, `f_date`, `f_note`) VALUES
(5, 'عبد الله', '098877555', 'حلب', '2024-01-31', ''),
(6, 'عبد الرحمن', '0966554477', 'منبج', '2024-01-31', ''),
(7, 'وائل', '0987078954', 'منبج', '2024-01-31', '');

-- --------------------------------------------------------

--
-- Table structure for table `pay_bill`
--

CREATE TABLE `pay_bill` (
  `pb_id` int(11) NOT NULL,
  `pb_date` date NOT NULL,
  `pb_note` text CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pay_bill`
--

INSERT INTO `pay_bill` (`pb_id`, `pb_date`, `pb_note`) VALUES
(0, '2024-01-24', NULL),
(1, '2024-02-01', ''),
(3, '2024-02-01', ''),
(4, '2024-02-01', ''),
(5, '2024-02-15', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `p_comm` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `p_name`, `p_comm`) VALUES
(4, 'تفاح', 0.1),
(5, 'برتقال', 0.05),
(6, 'اجاص', 0.1),
(7, 'ليمون', 0.05);

-- --------------------------------------------------------

--
-- Table structure for table `receive`
--

CREATE TABLE `receive` (
  `r_id` int(11) NOT NULL,
  `r_date` date NOT NULL,
  `f_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `notes` text CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receive`
--

INSERT INTO `receive` (`r_id`, `r_date`, `f_id`, `p_id`, `quantity`, `notes`) VALUES
(6, '2024-01-31', 5, 5, 25, ''),
(7, '2024-01-31', 5, 7, 30, ''),
(8, '2024-01-31', 5, 4, 10, ''),
(9, '2024-02-01', 6, 7, 33, ''),
(10, '2024-02-01', 7, 5, 20, '');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `s_id` int(11) NOT NULL,
  `s_date` date NOT NULL,
  `f_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `s_quantity` int(11) NOT NULL,
  `s_weight` float NOT NULL,
  `s_price` float NOT NULL,
  `c_id` int(11) DEFAULT NULL,
  `pb_id` int(11) DEFAULT NULL,
  `s_notes` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`s_id`, `s_date`, `f_id`, `p_id`, `s_quantity`, `s_weight`, `s_price`, `c_id`, `pb_id`, `s_notes`) VALUES
(20, '2024-02-01', 5, 4, 10, 5, 8000, 0, 1, ''),
(22, '2024-02-01', 5, 7, 5, 25, 4500, 0, 1, ''),
(23, '2023-12-02', 7, 5, 15, 45, 6500, 0, 3, ''),
(24, '2024-02-01', 6, 7, 20, 40, 5500, 0, 4, ''),
(25, '2024-02-01', 6, 7, 10, 55, 15, 0, 4, ''),
(26, '2024-01-30', 7, 5, 5, 33, 6000, 0, 3, ''),
(27, '2024-02-01', 5, 7, 10, 24, 1000, 0, 1, ''),
(28, '2024-02-01', 5, 5, 25, 25, 1500, 0, 1, ''),
(29, '2024-02-01', 5, 7, 15, 85, 9875, 0, 1, ''),
(30, '2024-02-01', 6, 7, 3, 10, 3564, 0, 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `a_id` int(11) NOT NULL,
  `a_username` varchar(30) CHARACTER SET utf8 NOT NULL,
  `a_password` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`a_id`, `a_username`, `a_password`) VALUES
(1, 'وائل العلوش', 'wael2001'),
(2, 'wwww', '123'),
(3, ':username', ':pass'),
(4, ':username', ':pass'),
(5, 'sss', '123'),
(6, 'eee', '111'),
(7, 'rrr', '111');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `farmer`
--
ALTER TABLE `farmer`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `pay_bill`
--
ALTER TABLE `pay_bill`
  ADD PRIMARY KEY (`pb_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `receive`
--
ALTER TABLE `receive`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `f_id` (`f_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `sb_id` (`c_id`),
  ADD KEY `f_id` (`f_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `pb_id` (`pb_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`a_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `farmer`
--
ALTER TABLE `farmer`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pay_bill`
--
ALTER TABLE `pay_bill`
  MODIFY `pb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `receive`
--
ALTER TABLE `receive`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `receive`
--
ALTER TABLE `receive`
  ADD CONSTRAINT `receive_ibfk_1` FOREIGN KEY (`f_id`) REFERENCES `farmer` (`f_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `receive_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_10` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_ibfk_7` FOREIGN KEY (`f_id`) REFERENCES `farmer` (`f_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_ibfk_8` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_ibfk_9` FOREIGN KEY (`pb_id`) REFERENCES `pay_bill` (`pb_id`) ON DELETE SET NULL ON UPDATE SET NULL;
--
-- Database: `inventory_system`
--
CREATE DATABASE IF NOT EXISTS `inventory_system` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `inventory_system`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(13, 'Ù†ÙˆØ¹ Ø§ÙˆÙ„'),
(14, 'Ù†ÙˆØ¹ Ø«Ø§Ù†ÙŠ');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `file_type` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `file_name`, `file_type`) VALUES
(1, '1.jpg', 'image/jpeg'),
(2, '3.jpg', 'image/jpeg'),
(3, '2.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `buy_price` decimal(25,2) DEFAULT NULL,
  `sale_price` decimal(25,2) NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_id` int(11) DEFAULT '0',
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`) VALUES
(23, 'Ø²ÙŠØªÙˆÙ†', '1000', '5.00', '7.00', 13, 1, '2023-07-07 10:24:47');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) CHARACTER SET utf8 NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`) VALUES
(1, 'Harry Denn', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'no_image.png', 1, '2023-07-07 10:21:15'),
(6, 'محمد', 'admin1', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, 'no_image.jpg', 1, '2022-08-19 10:06:25'),
(7, 'حسين', 'admin2', '7c4a8d09ca3762af61e59520943dc26494f8941b', 3, 'no_image.jpg', 1, '2022-08-19 10:15:42'),
(8, 'ÙˆØ§Ø¦Ù„ Ø§Ù„Ø¹Ù„ÙˆØ´', 'Admin22', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, 'no_image.jpg', 1, '2023-07-07 10:21:36');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'المسؤولين', 1, 1),
(2, 'خاص', 2, 1),
(3, 'المستخدمين', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_level` (`user_level`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_level` (`group_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_products` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `SK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user_level`) REFERENCES `user_groups` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(11) NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

--
-- Dumping data for table `pma__designer_settings`
--

INSERT INTO `pma__designer_settings` (`username`, `settings_data`) VALUES
('root', '{\"angular_direct\":\"direct\",\"relation_lines\":\"true\",\"snap_to_grid\":\"off\",\"full_screen\":\"on\",\"side_menu\":\"false\",\"pin_text\":\"false\",\"small_big_all\":\">\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

--
-- Dumping data for table `pma__export_templates`
--

INSERT INTO `pma__export_templates` (`id`, `username`, `export_type`, `template_name`, `template_data`) VALUES
(1, 'root', 'database', 'commission', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"structure_or_data_forced\":\"0\",\"table_select[]\":[\"admin\",\"customer\",\"farmer\",\"pay_bill\",\"product\",\"receive\",\"sale\",\"sale_bill\"],\"table_structure[]\":[\"admin\",\"customer\",\"farmer\",\"pay_bill\",\"product\",\"receive\",\"sale\",\"sale_bill\"],\"table_data[]\":[\"admin\",\"customer\",\"farmer\",\"pay_bill\",\"product\",\"receive\",\"sale\",\"sale_bill\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@DATABASE@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"json_structure_or_data\":\"data\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Structure of table @TABLE@\",\"latex_structure_continued_caption\":\"Structure of table @TABLE@ (continued)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Content of table @TABLE@\",\"latex_data_continued_caption\":\"Content of table @TABLE@ (continued)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"structure_and_data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"structure_and_data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_procedure_function\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"xml_structure_or_data\":\"data\",\"xml_export_events\":\"something\",\"xml_export_functions\":\"something\",\"xml_export_procedures\":\"something\",\"xml_export_tables\":\"something\",\"xml_export_triggers\":\"something\",\"xml_export_views\":\"something\",\"xml_export_contents\":\"something\",\"yaml_structure_or_data\":\"data\",\"\":null,\"lock_tables\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"csv_columns\":null,\"excel_removeCRLF\":null,\"htmlword_columns\":null,\"json_pretty_print\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_create_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

--
-- Dumping data for table `pma__pdf_pages`
--

INSERT INTO `pma__pdf_pages` (`db_name`, `page_nr`, `page_descr`) VALUES
('commission', 1, 'ERD_commision');

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"commission\",\"table\":\"users\"},{\"db\":\"commission\",\"table\":\"pay_bill\"},{\"db\":\"commission\",\"table\":\"sale\"},{\"db\":\"commission\",\"table\":\"receive\"},{\"db\":\"commission\",\"table\":\"product\"},{\"db\":\"commission\",\"table\":\"farmer\"},{\"db\":\"commission\",\"table\":\"customer\"},{\"db\":\"commission\",\"table\":\"admin\"},{\"db\":\"commission\",\"table\":\"sale_bill\"},{\"db\":\"commission\",\"table\":\"bill\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT '0',
  `x` float UNSIGNED NOT NULL DEFAULT '0',
  `y` float UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

--
-- Dumping data for table `pma__table_coords`
--

INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES
('commission', 'admin', 1, 946, 37),
('commission', 'customer', 1, 1190, 377),
('commission', 'farmer', 1, 489, 108),
('commission', 'pay_bill', 1, 800, 530),
('commission', 'product', 1, 480, 388),
('commission', 'receive', 1, 238, 200),
('commission', 'sale', 1, 804, 191);

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'commission', 'product', '{\"sorted_col\":\"`p_id` ASC\"}', '2024-01-31 19:17:28'),
('root', 'watches', 'productformen', '[]', '2023-06-16 15:03:34');

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2024-01-27 16:38:42', '{\"collation_connection\":\"utf8mb4_unicode_ci\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `platform`
--
CREATE DATABASE IF NOT EXISTS `platform` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `platform`;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `course_img` varchar(50) NOT NULL,
  `course_teacher` varchar(50) NOT NULL,
  `course_duration` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_img`, `course_teacher`, `course_duration`) VALUES
(1, 'html', 'html.png', 'محمد ', '05:29:54'),
(2, 'seo', 'seo.jpg', 'نور', '04:50:08'),
(3, 'English', 'english.jpg', 'عبودة', '09:50:55'),
(4, 'Word', 'word.png', 'عدنان', '03:50:47'),
(5, 'C#', 'cs.png', 'حسونة', '12:50:30');

-- --------------------------------------------------------

--
-- Table structure for table `course_stu`
--

CREATE TABLE `course_stu` (
  `course_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `reg_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_stu`
--

INSERT INTO `course_stu` (`course_id`, `stu_id`, `reg_date`) VALUES
(1, 2, '2023-08-26 05:23:35'),
(1, 2, '2023-08-26 05:08:00'),
(2, 3, '2023-08-26 05:08:00'),
(1, 1, '2023-08-26 05:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `episode`
--

CREATE TABLE `episode` (
  `epi_id` int(11) NOT NULL,
  `epi_name` varchar(50) NOT NULL,
  `epi_frame` text NOT NULL,
  `epi_duration` time NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `episode`
--

INSERT INTO `episode` (`epi_id`, `epi_name`, `epi_frame`, `epi_duration`, `course_id`) VALUES
(1, 'تعلم أساسيات لغة html', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/Wn3bVMLYHhs?si=m-VXXi3adnFNYs28\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', '00:02:09', 1),
(2, 'تثبيت محرر الأكواد', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/l8TiNcxJiQc?si=mo0YydyNndk181SS\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', '00:09:43', 1),
(3, 'شرح عناصر العنونة للصفحات heading', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/by8fvFcyj_U?si=CuDhNZ44RMce5Mdz\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', '00:02:38', 1),
(4, 'شرح الأساسيات والعنصر meta في html', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/2uyP9S-Ecso?si=8WimD4q8NT7e6Hj0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', '00:10:35', 1),
(5, 'شرح وسوم تنسيق النص وإضافة live server', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/KlFZUJW2pMc?si=WIxKJfBTNvWLdqFR\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', '00:08:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stu_id` int(11) NOT NULL,
  `stu_name` varchar(50) NOT NULL,
  `stu_pass` varchar(50) NOT NULL,
  `stu_email` varchar(50) NOT NULL,
  `stu_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stu_id`, `stu_name`, `stu_pass`, `stu_email`, `stu_date`) VALUES
(1, 'mohammad', 'mhmd1234#', 'mhmd@gmail.com', '2023-08-26'),
(2, 'ayman', '123456789', 'ayman@gmail.com', '2023-08-26'),
(3, 'reem', '123321123', 'noorhhsas@gmail.com', '2023-08-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_stu`
--
ALTER TABLE `course_stu`
  ADD KEY `course_id` (`course_id`),
  ADD KEY `stu_id` (`stu_id`);

--
-- Indexes for table `episode`
--
ALTER TABLE `episode`
  ADD PRIMARY KEY (`epi_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `episode`
--
ALTER TABLE `episode`
  MODIFY `epi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_stu`
--
ALTER TABLE `course_stu`
  ADD CONSTRAINT `course_stu_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_stu_ibfk_2` FOREIGN KEY (`stu_id`) REFERENCES `student` (`stu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `episode`
--
ALTER TABLE `episode`
  ADD CONSTRAINT `episode_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Database: `star_box`
--
CREATE DATABASE IF NOT EXISTS `star_box` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `star_box`;

-- --------------------------------------------------------

--
-- Table structure for table `kyan`
--

CREATE TABLE `kyan` (
  `ID` int(11) DEFAULT NULL,
  `Cobon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kyan`
--

INSERT INTO `kyan` (`ID`, `Cobon`) VALUES
(NULL, NULL);
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
--
-- Database: `wael`
--
CREATE DATABASE IF NOT EXISTS `wael` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `wael`;
--
-- Database: `watches`
--
CREATE DATABASE IF NOT EXISTS `watches` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `watches`;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(100) NOT NULL,
  `firstName` char(50) NOT NULL,
  `lastName` char(50) NOT NULL,
  `email` char(255) NOT NULL,
  `letter` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `firstName`, `lastName`, `email`, `letter`) VALUES
(6, 'wael', 'Aloush', 'waelee2018@gmail.com', 'hello wael');

-- --------------------------------------------------------

--
-- Table structure for table `discountformen`
--

CREATE TABLE `discountformen` (
  `id` int(50) NOT NULL,
  `productType` char(50) NOT NULL,
  `productName` char(50) NOT NULL,
  `productNumber` char(255) NOT NULL,
  `oldPrice` char(50) NOT NULL,
  `newPrice` char(50) NOT NULL,
  `productImage` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discountformen`
--

INSERT INTO `discountformen` (`id`, `productType`, `productName`, `productNumber`, `oldPrice`, `newPrice`, `productImage`) VALUES
(1, 'Steel Watch', 'DIVER 300M', '3298', '5600', '4480', 'men2.png'),
(2, 'Steel Watch', 'CONSTELLATION', '3098', '6300', '5040', 'men1.png');

-- --------------------------------------------------------

--
-- Table structure for table `discountforwomen`
--

CREATE TABLE `discountforwomen` (
  `id` int(50) NOT NULL,
  `productType` char(50) NOT NULL,
  `productName` char(50) NOT NULL,
  `productNumber` char(255) NOT NULL,
  `oldPrice` char(50) NOT NULL,
  `newPrice` char(50) NOT NULL,
  `productImage` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discountforwomen`
--

INSERT INTO `discountforwomen` (`id`, `productType`, `productName`, `productNumber`, `oldPrice`, `newPrice`, `productImage`) VALUES
(1, 'Steel Watch', 'Aqua Terra', '8650', '5300', '4240', 'women2.png'),
(2, 'Leather Watch', 'CONSTELLATION', '8700', '6000', '4800', 'women1.png');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` int(11) NOT NULL,
  `userName` char(50) NOT NULL,
  `email` char(50) NOT NULL,
  `password` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id`, `userName`, `email`, `password`) VALUES
(1, 'admin22', 'waelee2018@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `newleatherwatchformen`
--

CREATE TABLE `newleatherwatchformen` (
  `id` int(50) NOT NULL,
  `productName` char(50) NOT NULL,
  `productPrice` char(255) NOT NULL,
  `productImage` char(255) NOT NULL,
  `productNum` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `newleatherwatchformen`
--

INSERT INTO `newleatherwatchformen` (`id`, `productName`, `productPrice`, `productImage`, `productNum`) VALUES
(1, 'GLOBEMASTER', '7100', 'globmaster.jpg', '2197'),
(2, 'CONSTELLATION', '6000', 'constellation.png', '2190'),
(3, 'DIVER 300M', '5300', 'diver.png', '2218'),
(4, 'PLANET OCCEAN', '6450', 'planet.png', '2220');

-- --------------------------------------------------------

--
-- Table structure for table `newleatherwatchforwomen`
--

CREATE TABLE `newleatherwatchforwomen` (
  `id` int(50) NOT NULL,
  `productName` char(50) NOT NULL,
  `productPrice` char(255) NOT NULL,
  `productImage` char(255) NOT NULL,
  `productNum` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `newleatherwatchforwomen`
--

INSERT INTO `newleatherwatchforwomen` (`id`, `productName`, `productPrice`, `productImage`, `productNum`) VALUES
(1, 'AQUA TERRA', '3400', 'aqua-terra.jpg', '2758'),
(2, 'CONSTELLATION', '6200', 'constellation.png', '2788'),
(3, 'LADY MATIC', '2800', 'ladymatic.png', '2898'),
(5, 'SPEED MASTER', '3100', 'speed-master.jpg', '3750');

-- --------------------------------------------------------

--
-- Table structure for table `newsteelwatchformen`
--

CREATE TABLE `newsteelwatchformen` (
  `id` int(50) NOT NULL,
  `productName` char(50) NOT NULL,
  `productPrice` char(255) NOT NULL,
  `productImage` char(255) NOT NULL,
  `productNum` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `newsteelwatchformen`
--

INSERT INTO `newsteelwatchformen` (`id`, `productName`, `productPrice`, `productImage`, `productNum`) VALUES
(1, 'GLOBEMASTER', '5300', 'globemaster.png', '1980'),
(2, 'CONSTELLATION', '6300', 'constellation.jpg', '1992'),
(3, 'DIVER 300M', '5600', 'diver.jpg', '2089'),
(6, 'PLANET OCCEAN', '6700', 'planet.png', '2190'),
(7, 'wael', '15000', 'planet.png', '5000');

-- --------------------------------------------------------

--
-- Table structure for table `newsteelwatchforwomen`
--

CREATE TABLE `newsteelwatchforwomen` (
  `id` int(50) NOT NULL,
  `productName` char(50) NOT NULL,
  `productPrice` char(255) NOT NULL,
  `productImage` char(255) NOT NULL,
  `productNum` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `newsteelwatchforwomen`
--

INSERT INTO `newsteelwatchforwomen` (`id`, `productName`, `productPrice`, `productImage`, `productNum`) VALUES
(1, 'AQUA TERRA', '4100', 'aqua-terra.png', '2598'),
(2, 'CONSTELLATION', '5000', 'constellation.png', '2628'),
(3, 'LADY MATIC', '5300', 'ladymatic.png', '2699'),
(5, 'SPEED MASTER', '6450', 'speedmaster.png', '2748');

-- --------------------------------------------------------

--
-- Table structure for table `productformen`
--

CREATE TABLE `productformen` (
  `id` int(50) NOT NULL,
  `firstName` char(50) NOT NULL,
  `lastName` char(50) NOT NULL,
  `email` char(255) NOT NULL,
  `productName` char(50) NOT NULL,
  `productNum` char(255) NOT NULL,
  `phoneNumber` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productformen`
--

INSERT INTO `productformen` (`id`, `firstName`, `lastName`, `email`, `productName`, `productNum`, `phoneNumber`) VALUES
(1, '', '', '', '', '', ''),
(2, 'sdfs', 'Aloush', 'waelee2018@gmail.com', 'wael', '2190', '0987078954'),
(26, 'sdfs', 'Aloush', '', 'wael', '2190', '0987078954'),
(27, 'wael', 'asda', 'waelee2018@gmail.com', 'wael', '3098', '0987078954'),
(28, 'wael', 'Aloush', 'waelee2018@gmail.com', 'wael', '121212121', '0987078954'),
(29, '', '', '', 'SPEED MASTER', '123', ''),
(30, 'wael', 'Aloush', 'waelee2018@gmail.com', 'SPEED MASTER', '2190', '0987078954'),
(31, '', '', '', 'wael', '5000', '');

-- --------------------------------------------------------

--
-- Table structure for table `productforwomen`
--

CREATE TABLE `productforwomen` (
  `id` int(50) NOT NULL,
  `firstName` char(50) NOT NULL,
  `lastName` char(50) NOT NULL,
  `email` char(255) NOT NULL,
  `productName` char(50) NOT NULL,
  `productNum` char(255) NOT NULL,
  `phoneNumber` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productforwomen`
--

INSERT INTO `productforwomen` (`id`, `firstName`, `lastName`, `email`, `productName`, `productNum`, `phoneNumber`) VALUES
(23, 'sdfs', 'Aloush', 'waelee2018@gmail.com', 'SPEED MASTER', '545454', '0987078954'),
(24, 'sdfs', 'Aloush', 'waelee2018@gmail.com', 'wael', '2190', '0987078954'),
(25, 'sdfs', 'Aloush', '', 'wael', '2190', '0987078954'),
(26, 'wael', 'asda', 'waelee2018@gmail.com', 'wael', '3098', '0987078954'),
(27, 'wael', 'Aloush', 'waelee2018@gmail.com', 'wael', '121212121', '0987078954'),
(28, 'wael', 'Aloush', 'waelee2018@gmail.com', 'SPEED MASTER', '2190', '0987078954');

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `hour` char(24) NOT NULL,
  `minute` char(60) NOT NULL,
  `second` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`id`, `date`, `hour`, `minute`, `second`) VALUES
(1, '2023-06-16', '15', '21', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discountformen`
--
ALTER TABLE `discountformen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discountforwomen`
--
ALTER TABLE `discountforwomen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newleatherwatchformen`
--
ALTER TABLE `newleatherwatchformen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newleatherwatchforwomen`
--
ALTER TABLE `newleatherwatchforwomen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsteelwatchformen`
--
ALTER TABLE `newsteelwatchformen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsteelwatchforwomen`
--
ALTER TABLE `newsteelwatchforwomen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productformen`
--
ALTER TABLE `productformen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productforwomen`
--
ALTER TABLE `productforwomen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `discountformen`
--
ALTER TABLE `discountformen`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `discountforwomen`
--
ALTER TABLE `discountforwomen`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `newleatherwatchformen`
--
ALTER TABLE `newleatherwatchformen`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `newleatherwatchforwomen`
--
ALTER TABLE `newleatherwatchforwomen`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `newsteelwatchformen`
--
ALTER TABLE `newsteelwatchformen`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `newsteelwatchforwomen`
--
ALTER TABLE `newsteelwatchforwomen`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `productformen`
--
ALTER TABLE `productformen`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `productforwomen`
--
ALTER TABLE `productforwomen`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
