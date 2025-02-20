-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2022 at 01:53 PM
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
-- Database: `ooap_hhm`
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
  `token` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'disabled',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`user_id`, `username`, `password`, `position`, `email`, `token`, `status`, `created_date`) VALUES
(00001, 'CreaMiraelle', '$2y$10$ExU/XRICW880BD/KDxNXTuk31ZwTaiVhnVvoi6fPUQu0ip3O4FBZS', 'manager', 'ngocanhcao7i@gmail.com', 'activated', 'enabled', '2021-11-18 16:23:44'),
(00002, 'nqunhth', '$2y$10$m0YXc.V0ubshC8gCp5FNMeBIAzx0mZ/veZ0uAzuo4RJObEP4.8en6', 'manager', '123sdf@gmail.com', 'activated', 'enabled', '2021-11-19 03:18:38'),
(00003, 'aaa', '$2y$10$XHSZXmz5/6qWeM83E8zhI.hDqgYzMp4xg8rFiF0OU5HANzLpm3pP6', 'doctor', 'kurocrea@gmail.com', '0352275d9e20fa64b2d92adca5028893', 'enabled', '2021-12-05 05:23:11'),
(00004, 'bbb', '$2y$10$Gzzga8kPLLIIzpxciJmOV.W513u2ni7W/l6SaVgXf.DjYWL1RgnXm', 'doctor', 'nqunhth@gmail.com', 'activated', 'enabled', '2021-12-05 05:34:55'),
(00005, 'ccc', '$2y$10$23plJ5m1YoYaWwiz49T3o.z63/dOsngeTPP/IEB0EgqagV1FG0TQ2', 'doctor', 'nqunhth@gmail.com', 'activated', 'enabled', '2021-12-05 05:35:55'),
(00006, 'ddd', '$2y$10$gzkiajOxhfQGx3YtCYQRkeqGb7ouT8tCCAkn9YQmFzooZ.ZdyW4Ty', 'doctor', 'nqunhth@gmail.com', 'activated', 'enabled', '2021-12-05 05:37:17'),
(00007, 'eee', '$2y$10$2r5gGlUFgAVcgYiK4neg4usEeP9n3NbKz8OBHfManxOL5EgkYTG0G', 'receptionist', 'nqunhth@gmail.com', 'activated', 'enabled', '2021-12-05 05:37:52'),
(00008, 'fff', '$2y$10$9Lhib/Lw60LSuQDxnY19B.Lky/aiPTqiGIsRabU9jOxJmQJXlHblm', 'receptionist', 'nqunhth@gmail.com', 'activated', 'enabled', '2021-12-05 05:38:51'),
(00009, 'ggg', '$2y$10$H01NTI950QhcaFzarNCTAuHTkNdv0rjMQhm6fC8u4aOC/QckTuJ4u', 'pharmacist', 'nqunhth@gmail.com', 'activated', 'enabled', '2021-12-05 05:39:44'),
(00010, 'hhh', '$2y$10$Ym7heY5Tk7HvCDeBHkhJR.KnOSU/6aL2608amhaWiRDEuYnjQXgni', 'pharmacist', 'nqunhth@gmail.com', 'activated', 'enabled', '2021-12-05 06:01:44');

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
(00004),
(00005),
(00006);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invo_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `cus_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cus_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `creator_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `invo_status` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'enabled',
  `sum_cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invo_id`, `cus_name`, `cus_address`, `creator_id`, `created_date`, `invo_status`, `sum_cost`) VALUES
(00023, 'Phương phương', '567 nmb', 00010, '2021-12-24 10:03:28', 'enabled', 60000),
(00024, 'Hạ Minh', '765 kln', 00010, '2021-12-24 10:04:02', 'disabled', 55000),
(00025, 'Trần Thủy', '976 khju', 00010, '2021-12-24 10:05:19', 'enabled', 183000),
(00026, 'Lâm Thịnh', '4234 fgdf', 00010, '2021-12-24 10:08:35', 'enabled', 56000),
(00027, 'das', 'das', 00010, '2021-12-25 10:36:06', 'enabled', 70000),
(00028, 'dấđ', 'dsđá', 00010, '2021-12-26 03:36:48', 'enabled', 54000),
(00029, 'fsdfsdf', 'fsdfsf', 00010, '2022-01-02 09:01:06', 'enabled', 182000),
(00030, 'fdsfsf', 'fsdfsd', 00010, '2022-01-02 09:03:38', 'enabled', 78000),
(00031, 'gdf', 'gdfg', 00010, '2022-01-02 09:05:31', 'enabled', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_medicine`
--

CREATE TABLE `invoice_medicine` (
  `inme_id` int(10) UNSIGNED NOT NULL,
  `medicine_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `medicine_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `invo_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoice_medicine`
--

INSERT INTO `invoice_medicine` (`inme_id`, `medicine_id`, `medicine_name`, `invo_id`, `quantity`, `cost`) VALUES
(7, 00004, 'Thuốc giảm đau', 00023, 1, 10000),
(8, 00009, 'Cồn 70 độ vừa', 00023, 1, 35000),
(9, 00012, 'Kẹo cam', 00023, 1, 15000),
(10, 00009, 'Cồn 70 độ vừa', 00024, 1, 35000),
(11, 00014, 'Vitamin C', 00024, 1, 10000),
(12, 00016, 'Vitamin E', 00024, 1, 10000),
(13, 00006, 'Thuốc bôi', 00025, 3, 24000),
(14, 00015, 'Vitamin D', 00025, 3, 30000),
(15, 00011, 'Kẹo the', 00025, 1, 3000),
(16, 00014, 'Vitamin C', 00025, 3, 30000),
(17, 00010, 'Cồn 70 độ lớn', 00025, 2, 96000),
(18, 00003, 'Thuốc ngủ', 00026, 4, 4000),
(19, 00015, 'Vitamin D', 00026, 2, 20000),
(20, 00011, 'Kẹo the', 00026, 2, 6000),
(21, 00013, 'Kẹo sữa', 00026, 2, 6000),
(22, 00014, 'Vitamin C', 00026, 2, 20000),
(23, 00004, 'Thuốc giảm đau', 00027, 1, 10000),
(24, 00009, 'Cồn 70 độ vừa', 00027, 1, 35000),
(25, 00012, 'Kẹo cam', 00027, 1, 15000),
(26, 00015, 'Vitamin D', 00027, 1, 10000),
(27, 00002, 'Thuốc ho', 00028, 1, 5000),
(28, 00003, 'Thuốc ngủ', 00028, 1, 1000),
(29, 00010, 'Cồn 70 độ lớn', 00028, 1, 48000),
(30, 00004, 'Thuốc giảm đau', 00029, 3, 30000),
(31, 00006, 'Thuốc bôi', 00029, 2, 16000),
(32, 00010, '', 00029, 2, 96000),
(33, 00012, 'Kẹo cam', 00029, 2, 30000),
(34, 00016, 'Vitamin E', 00029, 1, 10000),
(35, 00005, 'Thuốc hạ sốt', 00030, 1, 6000),
(36, 00005, 'Thuốc hạ sốt', 00030, 1, 6000),
(37, 00010, 'Cồn 70 độ lớn', 00030, 1, 48000),
(38, 00012, 'Kẹo cam', 00030, 1, 15000),
(39, 00013, 'Kẹo sữa', 00030, 1, 3000),
(40, 00003, 'Thuốc ngủ', 00031, 4, 4000),
(41, 00001, 'Thuốc cảm', 00031, 2, 6000);

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
  `medi_status` varchar(8) COLLATE utf8_unicode_ci DEFAULT 'enabled',
  `queue_number` int(11) NOT NULL,
  `specialist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `medical_register`
--

INSERT INTO `medical_register` (`medi_id`, `pat_id`, `creator_id`, `doctor_id`, `doctor_name`, `created_date`, `medi_reason`, `medi_status`, `queue_number`, `specialist_id`) VALUES
(00001, 00001, 00007, 00004, 'Trần Thị BBB', '2021-12-21 17:00:00', 'Extreme Depression', 'enabled', 1, 0),
(00002, 00002, 00007, 00003, 'Nguyễn Văn AAA', '2021-12-21 17:00:00', 'Heart Failure', 'enabled', 2, 5),
(00003, 00003, 00007, 00003, 'Nguyễn Văn AAA', '2021-12-21 17:00:00', 'Crazy', 'enabled', 3, 5),
(00004, 00004, 00007, 00003, 'Nguyễn Văn AAA', '2021-12-21 17:00:00', 'Test', 'enabled', 4, 0),
(00005, 00005, 00007, 00003, 'Nguyễn Văn AAA', '2021-12-21 17:00:00', 'Sore throat', 'enabled', 5, 0),
(00006, 00006, 00007, 00003, 'Nguyễn Văn AAA', '2021-12-25 14:00:56', 'Đau bụng', 'enabled', 1, 5);

--
-- Triggers `medical_register`
--
DELIMITER $$
CREATE TRIGGER `set_queue` BEFORE INSERT ON `medical_register` FOR EACH ROW BEGIN
set new.queue_number = ( select count(*) from medical_register where date(created_date) = date(new.created_date)) + 1;
END
$$
DELIMITER ;

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
(00007, 'XYZ456', 'Thuốc ho', 18000, 'lọ', 'Tự chế', 100),
(00008, 'DFG890', 'Cồn 70 độ nhỏ', 30000, 'bình', 'Nhà thuốc ERT', 100),
(00009, 'DFG891', 'Cồn 70 độ vừa', 35000, 'bình', 'Nhà thuốc ERT', 100),
(00010, 'DFG123', 'Cồn 70 độ lớn', 48000, 'bình', 'Nhà thuốc ERT', 100),
(00011, 'GHN345', 'Kẹo the', 3000, 'viên', 'Nhà thuốc TVB', 100),
(00012, 'GHN345', 'Kẹo cam', 15000, 'hộp', 'Nhà thuốc TVB', 100),
(00013, 'GHN345', 'Kẹo sữa', 3000, 'viên', 'Nhà thuốc TVB', 100),
(00014, 'UNM566', 'Vitamin C', 10000, 'viên', 'Nhà thuốc YUI', 100),
(00015, 'UNM390', 'Vitamin D', 10000, 'viên', 'Nhà thuốc YUI', 100),
(00016, 'UNM583', 'Vitamin E', 10000, 'viên', 'Nhà thuốc YUI', 100);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `news_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `news_content` text COLLATE utf8_unicode_ci NOT NULL,
  `news_img` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `news_author` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Anonymous',
  `news_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_title`, `news_content`, `news_img`, `news_author`, `news_date`) VALUES
(00001, 'Booster shots eligible', 'A vaccination site offering third COVID-19 vaccine doses for frontline workers at Gò Vấp District, HCM City, on December 10, 2021. HCM City was the first in the country to start giving booster shots. — VNA/VNS Photo Thu Hương\r\nHÀ NỘI — The Vietnamese health ministry has reduced the waiting time between the second COVID-19 vaccine dose of the primary course and the booster shot.\r\n\r\nInstead of six months, the latest booster guidelines say the third jab can be administered just three months after people received their second shot.', 'https://image.vietnamnews.vn/uploadvnnews/Article/2021/12/20/192315_4092342884632612_anhai.jpg', 'Anonymous', '2021-12-21 08:45:35'),
(00002, 'We are stronger together', '\"Through collaboration and an unwavering commitment to patient care, one of Ontario’s hardest-hit health systems managed through the third wave of the pandemic\"\r\nBy Dr. Naveed Mohammad.         \r\n\r\nSince the onset of the COVID-19 pandemic, the communities served by William Osler Health System (Osler) – the City of Brampton, North Etobicoke and the surrounding areas – have been hit particularly hard, consistently recording some of the highest positivity rates in the province. This has had a profound impact on Osler’s staff, physicians and volunteers who have put forth an unprecedented dedicated effort to continue delivering safe, quality care to an influx of patients.\r\n\r\nAt the height of the third wave of the pandemic, Osler operated well over capacity and would have been challenged to meet the health care needs of its communities without the unrelenting support of its hospital partners. While providing care to their own communities during this extraordinary time, close to 40 hospitals and other health care facilities graciously accepted the transfer of more than 800 patients from Osler’s inpatient hospitals – Brampton Civic Hospital and Etobicoke General Hospital. More than 33 health care professionals from the province of Newfoundland and Labrador, the Ontario Home and Community Care sector, Kemptville District Hospital and the Canadian Red Cross also answered the call and volunteered their time and expertise – some even arriving by military aircraft to support Osler in its time of need.\r\n\r\nWith the help of all our health care partners, as well as the support of the Ontario Government, Ontario Health, the Province of Newfoundland and Labrador, and the Royal Canadian Air Force, Osler was able to provide care for an exceptionally high number of patients with COVID-19 when they needed it most.\r\n\r\nOur entire team at Osler and the patients we care for are profoundly grateful to all those who supported us during this difficult time. This support ensured all patients from Osler’s communities, including many who were critically ill at the time of transfer, received quality, compassionate care at other hospital facilities. It has been a challenging time for all hospitals across Ontario, and we appreciate the ongoing partnerships and collaboration that help make us stronger together.\r\n\r\nThe level of collaboration among hospitals across the province and the entire country during this time continues to be a source of inspiration. Collaboration makes us all better.\r\n\r\nDr. Naveed Mohammad is President and CEO of William Osler Health System which includes Brampton Civic Hospital, Peel Memorial Centre for Integrated Health and Wellness and Etobicoke General Hospital, and serves 1.3 million residents of Brampton, Etobicoke and the surrounding communities within Ontario’s Central West region.', 'https://i0.wp.com/hospitalnews.com/wp-content/uploads/2021/10/CEO-e1637328807830.jpg?w=586&ssl=1', 'Anonymous', '2021-12-21 08:54:21');

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
  `pat_job` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pat_status` varchar(9) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'caring'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pat_id`, `pat_name`, `pat_age`, `pat_address`, `pat_phone`, `pat_job`, `pat_status`) VALUES
(1, 'Cao Ngoc A', 21, 'adddddd', '009090909', 'jobless', 'caring'),
(2, 'Cao Ngoc B', 39, '44 Huhuhu', '444449', 'jobless', 'done'),
(3, 'Hutao', 21, '333 Washington', '444449', 'jobless', 'consulted'),
(4, 'Ning', 23, 'fwfsdf', '24343', 'President', 'caring'),
(5, 'UI', 23, 'fwfsdf', '24343', 'Singer', 'caring'),
(6, 'Hưng Yên', 45, '980 ljnv', '13465', 'Nội trợ', 'done');

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
(00001, 'Cao Ngọc Anh', 20, 'female', '2001-03-08', 'Nhân sự', 'xxx XXX yy YY zz ZZZZZ', '123456789', '123456789', '2021-11-10', 'https://i.imgur.com/uKqhZDC.jpg'),
(00002, 'Nguyễn Hồ Quỳnh Thư', 20, 'female', '2001-02-19', 'Nhân sự', 'xxx XXX yy YY zz ZZZZZ', '123456789', '123456789', '2021-11-10', ''),
(00003, 'Nguyễn Văn AAA', 0, 'male', '2021-12-05', 'Tổng quát', '', '', '', '2021-12-05', 'https://i.imgur.com/i1CefLT.jpg'),
(00004, 'Trần Thị BBB', 0, 'male', '2021-12-05', 'Tổng quát', '', '', '', '2021-12-05', ''),
(00005, 'Lê Thị CCC', 0, 'male', '2021-12-05', 'Tai mũi họng', '', '', '', '2021-12-05', 'https://i.imgur.com/wkDKNnO.jpg'),
(00006, 'Nguyễn Minh DDD', 0, 'male', '2021-12-05', 'Thẩm mỹ', '', '', '', '2021-12-05', ''),
(00007, 'Đinh Thị EEE', 0, 'male', '2021-12-05', 'Tiếp tân', '', '', '', '2021-12-05', 'https://i.imgur.com/uKqhZDC.jpg'),
(00008, 'Hoàng Lê FFF', 0, 'male', '2021-12-05', 'Tiếp tân', '', '', '', '2021-12-05', ''),
(00009, 'Nguyễn Ngọc GGG', 0, 'male', '2021-12-05', 'Dược sĩ', '', '', '', '2021-12-05', 'https://i.imgur.com/uKqhZDC.jpg'),
(00010, 'Nguyễn Tiến HHH', 99, 'female', '2021-12-05', 'Dược sĩ', 'fsdfsdf5435345', '989797', '3123', '2021-12-05', 'https://i.imgur.com/1lzYV7S.png');

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
  `pres_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `pat_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `creator_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `creator_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `pres_status` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'enabled',
  `conclusion` text COLLATE utf8_unicode_ci NOT NULL,
  `medicines` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`pres_id`, `pat_id`, `creator_id`, `creator_name`, `created_date`, `pres_status`, `conclusion`, `medicines`) VALUES
(00001, 00006, 00003, 'Nguyễn Văn AAA', '2022-01-02 09:53:34', 'enabled', 'Đau bụng do ăn bậy. Nên hạn chế ăn đồ quá hạn dùng', 'thuốc đau bụng, thuốc giảm đau');

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
  `spec_status` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'enabled',
  `spec_reason` text COLLATE utf8_unicode_ci NOT NULL,
  `test_area` text COLLATE utf8_unicode_ci NOT NULL,
  `request` text COLLATE utf8_unicode_ci NOT NULL,
  `result` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `specialist_consulting`
--

INSERT INTO `specialist_consulting` (`spec_id`, `pat_id`, `creator_id`, `creator_name`, `created_date`, `spec_status`, `spec_reason`, `test_area`, `request`, `result`) VALUES
(1, 6, 00005, 'Lê Thị CCC', '2021-12-25 14:02:18', 'enabled', 'Đau bụng', 'Bụng', 'Nội soi phần bụng', 'Ăn bậy quá nhiều');

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
(00004),
(00005),
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
-- Indexes for table `invoice_medicine`
--
ALTER TABLE `invoice_medicine`
  ADD PRIMARY KEY (`inme_id`);

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
  ADD PRIMARY KEY (`pres_id`);

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
  MODIFY `invo_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `invoice_medicine`
--
ALTER TABLE `invoice_medicine`
  MODIFY `inme_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `medical_register`
--
ALTER TABLE `medical_register`
  MODIFY `medi_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicine_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `pat_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `pres_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `receptionist`
--
ALTER TABLE `receptionist`
  MODIFY `receptionist_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `specialist_consulting`
--
ALTER TABLE `specialist_consulting`
  MODIFY `spec_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
