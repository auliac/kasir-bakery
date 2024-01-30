-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jan 2024 pada 13.14
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `metode` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_produk`, `subtotal`, `jumlah`, `status`, `metode`) VALUES
(117, 12, 13500, 1, 'dibayar', 'Tunai'),
(118, 11, 12500, 1, 'dibayar', 'Tunai'),
(119, 12, 13500, 1, 'dibayar', 'Tunai'),
(120, 12, 13500, 1, 'dibayar', 'Tunai'),
(121, 14, 10000, 1, 'dibayar', 'Tunai'),
(122, 14, 10000, 1, 'dibayar', 'Tunai'),
(123, 14, 10000, 1, 'dibayar', 'Tunai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `stok`, `gambar`) VALUES
(11, 'Sandwich Keju', 12500, 90, 'roti-1.jpeg'),
(12, 'Roti Abon Sapi', 13500, 94, 'roti-2.jpeg'),
(14, 'Roti Coklat', 10000, 89, 'roti-4.jpg'),
(15, 'Roti Keju', 12000, 94, 'roti-5.jpg'),
(17, 'Bika Ambon', 6000, 0, 'snack-1.jpeg'),
(18, 'Lemper Ikan', 9000, 6, 'snack-2.jpg'),
(19, 'Nastar Jambu', 5000, 15, 'snack-3.jpg'),
(20, 'Roti Tuna', 10000, 10, 'pastry-1.jpg'),
(22, 'Roti Buah Persik', 11000, 10, 'pastry-3.jpg'),
(23, 'Roti Ayam', 10000, 5, 'pastry-2.jpeg'),
(25, 'Roti Coklat Meses', 11000, 10, 'roti-6.jpg'),
(27, 'Donat Coklat Keju', 10000, 15, 'donat-1.jpg'),
(38, 'Roti Karamel', 12500, 10, 'roti-7.jpeg'),
(39, 'Pai Ayam', 11500, 9, 'roti-8.jpg'),
(40, 'Roti Coklat Lava', 16500, 0, 'roti-9.jpg'),
(43, 'Roti Sapi', 15000, 40, 'roti-3.jpeg'),
(45, 'Roti Coklat Pisang', 14000, 20, 'roti-10.jpeg'),
(46, 'Keju Gulung', 10000, 20, 'snack-4.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `registrasi`
--

CREATE TABLE `registrasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `registrasi`
--

INSERT INTO `registrasi` (`id`, `nama`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', '$2y$10$V9cNFjKx5Eh2hn6Ib5n51OIhH8m.SZ/rBfJJICKrL2QfYhGSUkCua', 'admin'),
(2, 'petugas', 'petugas', '$2y$10$oC8IGDgkYm1bza09Ky/hy.lHJdlbvWY8J2BFD/PnaORCDnA8oU7/O', 'petugas'),
(3, 'Kudou Shinichi', 'kudossi', '$2y$10$XWOvFOeVNpwZMPTSMOeGI.iaoA/MA4SyTGccNW8dWvoDrHz4xZxuO', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `registrasi`
--
ALTER TABLE `registrasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `registrasi`
--
ALTER TABLE `registrasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
