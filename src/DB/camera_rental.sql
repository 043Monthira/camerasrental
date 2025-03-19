-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2025 at 09:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camera_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `cameras`
--

CREATE TABLE `cameras` (
  `camera_id` int(11) NOT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price_per_day` decimal(10,2) DEFAULT NULL,
  `availability_status` enum('available','rented') DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cameras`
--

INSERT INTO `cameras` (`camera_id`, `brand`, `model`, `description`, `price_per_day`, `availability_status`, `created_at`, `image`) VALUES
(1, 'Sony', ' A7IV', 'กล้องฟูลเฟรม 35 มม 33 ล้านพิกเซล พร้อมกันสั่น 5 แกน VDO Up to 4K 60p 10-bit 4:2:2', 1500.00, 'available', '2025-03-03 09:37:47', 'Sony01.jpg'),
(2, 'Sony', 'A7CII', ' กล้องฟูลเฟรม 35 มม 33 ล้านพิกเซล พร้อมกันสั่น 5 แกน VDO 4K', 1200.00, 'available', '2025-03-03 20:00:14', 'Sony02.jpg'),
(3, 'Sony', 'Fx3 + Top Handle', ' กล้อง Full Frame senser 12.9 Mp 4K 120 p 10-bit 4:2:2 สำหรับการถ่ายภาพยนต์ บันทึกวิดิโอ ทั้วไป มีพัดลมระบายความร้อน', 1800.00, 'available', '2025-03-03 20:00:14', 'Sony03.jpg\r\n'),
(4, 'Sony', 'Fx3', 'กล้อง APS-C sensor 26MP APS-C/Super 35mm 4K 120fps 10-bit 4:2:2 สำหรับงานถ่ายภาพยนตร์ บันทึก VDO ทั่วไป มีพัดลมระบายความร้อน', 1000.00, 'available', '2025-03-03 20:00:14', 'Sony04.jpg\r\n'),
(5, 'Gopro', 'HERO 13 Black', 'Action Cam ยอดนิยม ถ่าย Video ความละเอียดสูงสุด 5.3K60 / 4K120/ 2.7K240 ภาพถ่าย 27MP', 500.00, 'available', '2025-03-03 20:00:14', 'Gopro01.jpg'),
(6, 'Gopro', 'HERO 12 Black', 'Action Cam ยอดนิยม ถ่าย Video ความละเอียดสูงสุด 5.3K60 / 4K120 พร้อม HyperSmooth 6.0', 450.00, 'available', '2025-03-03 20:00:14', 'Gopro02.jpg'),
(7, 'Gopro', 'HERE 11 Black', 'Action Cam ยอดนิยม ถ่าย Video ความละเอียดสูงสุด 5.3K60 / 4K120 พร้อม HyperSmooth 5.0 มีจอด้านหน้า', 450.00, 'available', '2025-03-03 22:43:47', 'Gopro03.jpg'),
(8, 'Gopro', 'HERE 10 Black', 'Action Cam ยอดนิยม ถ่าย Video ความละเอียดสูงสุด 5.3K60 พร้อม HyperSmooth 4.0 มีจอด้านหน้า', 400.00, 'available', '2025-03-04 08:47:38', 'Gopro04.jpg'),
(9, 'Cannon', 'EOS R50 + RF-S18-45mm F4.5-6.3 IS STM', 'กล้อง CMOS APS-C ความละเอียดภาพ 24.2 ล้านพิกเซล ถ่าย VDO 4K UHD จาก 6K oversampling, และ 4K 60p', 550.00, 'available', '2025-03-04 08:55:53', 'Cannon01.jpg'),
(10, 'Cannon', ' EOS R10 (Body)', 'กล้อง CMOS APS-C ความละเอียดภาพ 24.2 ล้านพิกเซล ถ่าย VDO 4K UHD จาก 6K oversampling, และ 4K 60p ถ่ายภาพต่อเนื่องได้สูงถึง 23 เฟรมต่อวินาที', 500.00, 'available', '2025-03-04 08:57:23', 'Cannon02.jpg'),
(11, 'Cannon', 'EOS R7 (Body)', 'กล้อง Mirrorless CMOS APS-C ความละเอียดภาพ 32.5 ล้านพิกเซล VDO 4K UHD จาก 7K oversampling, 4K 60p และ Canon Log 3', 700.00, 'available', '2025-03-04 08:58:15', 'Cannon03.jpg'),
(12, 'Cannon', 'EOS RP+Adapte EP-R', 'กล้องมิเรอร์เลสฟูลเฟรม ความละเอียด 26.2 ล้านพิกเซล ระบบ focus Dual Pixel CMOS พร้อมระบบ Eye Detection AF (Servo AF) ถ่าย vdo 4K UHD* ที่ 24p/25p', 750.00, 'available', '2025-03-04 08:59:30', 'Cannon04.jpg'),
(13, 'Nikon ', 'Z6III', 'กล้อง Mirrorless Full Frame ความละเอียด 24.5MP ถ่าย Video 6K/60p RAW, 5.4K/60p และ Full HD/240p', 1500.00, 'available', '2025-03-04 09:00:41', 'Nikon01.jpg'),
(14, 'Fujifilm', 'X-M5 สีเงิน', 'กล้อง Mirrorless Sensor X-Trans BSI CMOS IV ความละเอียด 26 MP Video 6.2K 30p แบบ 4:2:2 10-bit Video 4K 60p แบบ Internal ( Crop 1.18x )', 450.00, 'available', '2025-03-04 09:01:50', 'Fuji01.jpg'),
(15, 'Fujifilm', 'X-M5 สีดำ', 'กล้อง Mirrorless Sensor X-Trans BSI CMOS IV ความละเอียด 26 MP Video 6.2K 30p แบบ 4:2:2 10-bit Video 4K 60p แบบ Internal ( Crop 1.18x )', 450.00, 'available', '2025-03-04 09:02:53', 'Fuji02.jpg'),
(16, 'Fujifiml', 'X100 VI', 'กล้องเลนส์ 23mm F2 Sensor X-Trans CMOS 5 HR ความละเอียด 40.2 ล้านพิกเซล พร้อมระบบ Film Simulation สำหรับถ่ายทั่วไป ถ่ายStreet', 1000.00, 'available', '2025-03-04 09:04:04', 'Fuji03.jpg'),
(17, 'Fujifilm', 'X-S20 (Bodyonly)', 'กล้อง เซ็นเซอร์ X-Trans CMOS 4 ความละเอียด 26 ล้านพิกเซล มีระบบกันสั่น 5 แกน 7 Stop วีดีโอ 6K 30p, 4K 60p', 600.00, 'available', '2025-03-04 09:05:37', 'Fuji04.jpg'),
(18, 'Panasonic', 'Lumix S511 (Body)', 'กล้อง 24.2MP Full-Frame CMOS Sensor ถ่าย VDO สูงสุด 6K30p 4:2:0 10-Bit C4K/4K60p 4:2:2 10-Bit Unlimited', 1000.00, 'available', '2025-03-04 09:08:12', 'Lumix01.jpg'),
(19, 'Panasonic', 'Lumix S9', 'กล้อง เซ็นเซอร์ขนาด Full-Frame ความละเอียด 24.2MP กันสั่นแบบ IBIS 5 แกน 6.5 Stops ปรับสีด้วยระบบ REAL TIME LUT', 950.00, 'available', '2025-03-04 09:08:12', 'Lumix02.jpg'),
(20, 'Panasonic', 'Lumix DC-GH6 (Body)', 'กล้อง sensor 25MP CMOS ถ่าย VDO สูงสุด 5.8K Full-sensor 30p มี V-Log, Full Size HDMI, ProRes 422, DCI 4K in 10-bit 4:2:0 ได้สูงสุด 120 fps, มีพัดลมในตัวกล้อง, Unlimited recording', 900.00, 'available', '2025-03-04 09:08:19', 'Lumix03.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `created_at`, `username`, `password`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', '1234567890', '123 Main St, Surat Thani', '2025-03-03 20:06:07', 'Jondeo', '11111'),
(2, 'Jane', 'Smith', 'jane.smith@example.com', '0987654321', '456 Another Rd, Surat Thani', '2025-03-03 20:06:07', 'JaneSmith', '22222'),
(9, 'monthira', 'tapsaeng', '6640011043@psu.ac.th', '0954385710', '29/32', '2025-03-19 19:47:38', 'nana', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cameras`
--
ALTER TABLE `cameras`
  ADD PRIMARY KEY (`camera_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cameras`
--
ALTER TABLE `cameras`
  MODIFY `camera_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
