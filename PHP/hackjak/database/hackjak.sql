-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 08 Des 2017 pada 09.48
-- Versi Server: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hackjak`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `titik_kriminal`
--

CREATE TABLE `titik_kriminal` (
  `id_titik` int(11) NOT NULL,
  `lokasi` text NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `latitude` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `titik_kriminal`
--

INSERT INTO `titik_kriminal` (`id_titik`, `lokasi`, `longitude`, `latitude`) VALUES
(1, 'Jalan H. Tohir', '106.770620', '-6.200038');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `titik_kriminal`
--
ALTER TABLE `titik_kriminal`
  ADD PRIMARY KEY (`id_titik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `titik_kriminal`
--
ALTER TABLE `titik_kriminal`
  MODIFY `id_titik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
