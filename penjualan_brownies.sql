-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2024 at 04:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan_brownies`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_info`
--

CREATE TABLE `about_info` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_info`
--

INSERT INTO `about_info` (`id`, `judul`, `deskripsi`) VALUES
(0, 'WELCOME TO MY BROWNIES', '\r\nBrownies adalah sejenis kue cokelat yang meleleh di mulut dan disukai oleh banyak orang di seluruh dunia. Dengan tekstur yang lembut di dalam dan renyah di luar, brownies sering dianggap sebagai camilan yang sempurna untuk dinikmati kapan pun Anda menginginkannya. Resepnya bisa bervariasi dari yang sederhana hingga yang mewah, tetapi rasa cokelatnya yang kaya selalu menjadi daya tarik utama.\r\n\r\nJika Anda memiliki pertanyaan atau masalah terkait dengan pembuatan brownies atau ingin berbagi resep favorit Anda, jangan ragu untuk menghubungi kami di JokiGame2@gmail.com. Kami akan senang mendengar dari Anda dan siap membantu dengan apa pun yang Anda butuhkan!');

-- --------------------------------------------------------

--
-- Table structure for table `brownies`
--

CREATE TABLE `brownies` (
  `id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `likes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brownies`
--

INSERT INTO `brownies` (`id`, `image_url`, `likes`) VALUES
(1, 'gambar1.jpg', 30),
(2, 'gambar2.jpg', 21),
(3, 'gambar3.jpg', 18),
(4, 'gambar4.jpg', 21),
(5, 'gambar5.jpg', 29),
(6, 'gambar6.jpg', 39),
(7, 'gambar7.jpg', 40),
(8, 'gambar8.jpg', 19),
(9, 'gambar9.jpg', 33);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `brownie_id` int(11) DEFAULT NULL,
  `commenter_name` varchar(50) NOT NULL,
  `comment_text` text DEFAULT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `brownie_id`, `commenter_name`, `comment_text`, `comment_date`) VALUES
(49, 3, 'joko kendil', 'brownies ini mirip kayak anies', '2024-05-21 04:07:58'),
(50, 3, 'joko kendil', 'brownies ini mirip kayak anies', '2024-05-21 04:31:50'),
(51, 1, 'syahrul', 'sangat enak broeniesnyaa', '2024-05-27 23:07:26'),
(52, 6, 'budi', 'lezat', '2024-05-27 23:08:02'),
(53, 6, 'budi', 'lezat', '2024-05-27 23:08:27'),
(54, 6, 'budi', 'lezat', '2024-05-27 23:09:03'),
(55, 6, 'budi', 'lezat', '2024-05-27 23:09:24'),
(56, 1, 'syahrul', 'enak', '2024-05-30 01:54:56');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `tanggal_pembelian` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nomor_telepon` varchar(15) DEFAULT NULL,
  `diskon` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `username`, `nama_barang`, `jumlah`, `total_harga`, `tanggal_pembelian`, `alamat`, `nomor_telepon`, `diskon`) VALUES
(0, 'mumu', 'Brownies Lumer', 2, 60000.00, '2024-05-30', 'cirebon', '0895341111415', 0),
(0, 'syahrul', 'Brownies Lumer', 12, 324000.00, '2024-05-30', 'cirebon', '0895341111415', 36000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brownies`
--
ALTER TABLE `brownies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brownie_id` (`brownie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brownies`
--
ALTER TABLE `brownies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`brownie_id`) REFERENCES `brownies` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
