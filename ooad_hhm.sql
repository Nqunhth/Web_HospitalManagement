-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2021 at 04:16 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ooad_hhm`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `user_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(60) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no email',
  `status` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'enabled',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`user_id`, `username`, `password`, `position`, `email`, `status`, `created_date`) VALUES
(00001, 'CreaMiraelle', '$2y$10$ExU/XRICW880BD/KDxNXTuk31ZwTaiVhnVvoi6fPUQu0ip3O4FBZS', 'manager', 'ngocanhcao7i@gmail.com', 'enabled', '2021-11-18 16:23:44'),
(00002, 'nqunhth', '$2y$10$m0YXc.V0ubshC8gCp5FNMeBIAzx0mZ/veZ0uAzuo4RJObEP4.8en6', 'manager', '123sdf@gmail.com', 'enabled', '2021-11-19 03:18:38'),
(00003, '3', '$2y$10$.DXTHwP/V8NVjRUQ2KwasObFl9pKRJnC24qKQOvLaJRdBEv.ScU2W', 'doctor', '3', 'enabled', '2021-11-19 03:25:49'),
(00006, 'aaa', '$2y$10$joclZCG46Bb/KF4t8pvXuuRtqxpLOmsTBfpJ7dleydBjrUYHfNFF.', 'doctor', 'dgfdg', 'enabled', '2021-11-20 06:39:11'),
(00007, 'bbb', '$2y$10$dCFbF1Y4c96zsTnzm4Go4ub.Hgx4hI5l0gR6VaaVMBEmhqXyss09e', 'receptionist', 'bbbb', 'enabled', '2021-11-29 11:31:26'),
(00008, 'ccc', '$2y$10$joVCfa1SA7a4W2p9RDjZNuaEELr5NADAD09ZnAxM8fh.SxnACNw26', 'receptionist', 'cccc', 'enabled', '2021-11-29 11:31:45'),
(00009, 'ddd', '$2y$10$7dLKMEIzXZw/wSdLZrpfp.jXVDjA6U4Own0LAderF8Q7OODKMYh7m', 'pharmacist', 'dddd', 'enabled', '2021-11-29 11:32:07'),
(00010, 'eee', '$2y$10$/zxKQPy7S1kX06JyxWFeXeQwKl.Q8KZT.1y04cjmWhKrMc4F9jT0y', 'pharmacist', 'eeee', 'enabled', '2021-11-29 11:32:18');

-- --------------------------------------------------------

--
-- Table structure for table `assigned_specialist`
--

CREATE TABLE `assigned_specialist` (
  `doc_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `medi_id` int(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` int(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`) VALUES
(00003),
(00006);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invo_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `pat_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `creator_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `invo_status` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `sum_cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_medicine`
--

CREATE TABLE `invoice_medicine` (
  `medicine_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `invo_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_register`
--

CREATE TABLE `medical_register` (
  `medi_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `pat_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `creator_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `doctor_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `doctor_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `medi_reason` text COLLATE utf8_unicode_ci NOT NULL,
  `medi_status` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `queue_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicine_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `medicine_seri` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `medicine_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `medicine_unit_price` int(11) NOT NULL,
  `medicine_unit` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `medicine_producer` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `medicine_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicine_id`, `medicine_seri`, `medicine_name`, `medicine_unit_price`, `medicine_unit`, `medicine_producer`, `medicine_quantity`) VALUES
(00001, 'ABC123', 'Thuốc cảm', 3000, 'viên', 'Tự chế', 200),
(00002, 'XYZ456', 'Thuốc ho', 5000, 'viên', 'Tự chế', 200),
(00003, 'DEF789', 'Thuốc ngủ', 1000, 'viên', 'Tự chế', 100),
(00004, 'ABC456', 'Thuốc giảm đau', 10000, 'viên', 'Tự chế', 100),
(00005, 'DEF123', 'Thuốc hạ sốt', 6000, 'viên', 'Tự chế', 100),
(00006, 'XYZ123', 'Thuốc bôi', 8000, 'tuýp', 'Tự chế', 100),
(00007, 'XYZ456', 'Thuốc ho', 18000, 'lọ', 'Tự chế', 100);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `news_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `news_content` text COLLATE utf8_unicode_ci NOT NULL,
  `news_img` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `pat_id` int(5) NOT NULL,
  `pat_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pat_age` tinyint(4) NOT NULL,
  `pat_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pat_phone` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `pat_job` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_info`
--

CREATE TABLE `personal_info` (
  `user_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `full_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `age` tinyint(4) NOT NULL,
  `gender` varchar(6) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'male',
  `birthday` date NOT NULL DEFAULT current_timestamp(),
  `specialized_field` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `id_card_number` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `id_card_date` date NOT NULL DEFAULT current_timestamp(),
  `avatar` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `personal_info`
--

INSERT INTO `personal_info` (`user_id`, `full_name`, `age`, `gender`, `birthday`, `specialized_field`, `address`, `phone_number`, `id_card_number`, `id_card_date`, `avatar`) VALUES
(00001, 'Cao Ngọc Anh', 20, 'female', '2001-03-08', 'Nhân sự', 'xxx XXX yy YY zz ZZZZZ', '123456789', '123456789', '2021-11-10', ''),
(00002, 'Nguyễn Hồ Quỳnh Thư', 20, 'female', '2001-02-19', 'Nhân sự', 'xxx XXX yy YY zz ZZZZZ', '123456789', '123456789', '2021-11-10', ''),
(00003, 'Người nào đó', 20, 'male', '2001-04-01', 'Tổng quát', 'xxx XXX yy YY zz ZZZZZ', '123456789', '123456789', '2021-11-10', ''),
(00006, 'Please update', 20, 'female', '2000-05-20', 'Răng hàm mặt', 'xxx XXX yy YY zz ZZZZZ', '123456789', '123456789', '2021-11-10', ''),
(00007, 'Please update', 20, 'male', '2001-12-09', 'Tiếp tân', 'xxx XXX yy YY zz ZZZZZ', '123456789', '123456789', '2021-11-10', ''),
(00008, 'Please update', 20, 'male', '2002-09-19', 'Tiếp tân', 'xxx XXX yy YY zz ZZZZZ', '123456789', '123456789', '2021-11-10', ''),
(00009, 'Please update', 20, 'male', '1998-05-09', 'Dược sĩ', 'xxx XXX yy YY zz ZZZZZ', '123456789', '123456789', '2021-11-10', ''),
(00010, 'Please update', 20, 'male', '2000-04-23', 'Tiếp tân', 'xxx XXX yy YY zz ZZZZZ', '123456789', '123456789', '2021-11-10', '');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist`
--

CREATE TABLE `pharmacist` (
  `pharmacist_id` int(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pharmacist`
--

INSERT INTO `pharmacist` (`pharmacist_id`) VALUES
(00009),
(00010);

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `pres` int(5) UNSIGNED ZEROFILL NOT NULL,
  `pat_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `creator_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `creator_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pres_status` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `conclusion` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pres_medicine`
--

CREATE TABLE `pres_medicine` (
  `pres_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `medicine_id` int(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receptionist`
--

CREATE TABLE `receptionist` (
  `receptionist_id` int(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `receptionist`
--

INSERT INTO `receptionist` (`receptionist_id`) VALUES
(00007),
(00008);

-- --------------------------------------------------------

--
-- Table structure for table `specialist_consulting`
--

CREATE TABLE `specialist_consulting` (
  `spec_id` int(5) NOT NULL,
  `pat_id` int(5) NOT NULL,
  `creator_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `creator_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `spec_status` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `spec_reason` text COLLATE utf8_unicode_ci NOT NULL,
  `test_area` text COLLATE utf8_unicode_ci NOT NULL,
  `request` text COLLATE utf8_unicode_ci NOT NULL,
  `result` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`) VALUES
(00001),
(00002),
(00003),
(00006),
(00007),
(00008),
(00009),
(00010);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invo_id`);

--
-- Indexes for table `medical_register`
--
ALTER TABLE `medical_register`
  ADD PRIMARY KEY (`medi_id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicine_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`pat_id`);

--
-- Indexes for table `personal_info`
--
ALTER TABLE `personal_info`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `pharmacist`
--
ALTER TABLE `pharmacist`
  ADD PRIMARY KEY (`pharmacist_id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`pres`);

--
-- Indexes for table `receptionist`
--
ALTER TABLE `receptionist`
  ADD PRIMARY KEY (`receptionist_id`);

--
-- Indexes for table `specialist_consulting`
--
ALTER TABLE `specialist_consulting`
  ADD PRIMARY KEY (`spec_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `user_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctor_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invo_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medical_register`
--
ALTER TABLE `medical_register`
  MODIFY `medi_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicine_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `pat_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_info`
--
ALTER TABLE `personal_info`
  MODIFY `user_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pharmacist`
--
ALTER TABLE `pharmacist`
  MODIFY `pharmacist_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `pres` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receptionist`
--
ALTER TABLE `receptionist`
  MODIFY `receptionist_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `specialist_consulting`
--
ALTER TABLE `specialist_consulting`
  MODIFY `spec_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
