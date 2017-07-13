-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 04 Jul 2017 pada 06.29
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daib`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `resi`
--

CREATE TABLE `resi` (
  `tgl` date NOT NULL,
  `id` int(5) NOT NULL,
  `id_resi` int(10) NOT NULL,
  `kode_barang` char(6) NOT NULL,
  `jml_liter` int(2) NOT NULL,
  `jml_galon` float NOT NULL,
  `harga` int(10) NOT NULL,
  `subtotal` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `resi_new`
--

CREATE TABLE `resi_new` (
  `id_resi` int(10) NOT NULL,
  `tgl` datetime NOT NULL,
  `id_barang` int(10) NOT NULL,
  `liter` int(2) NOT NULL,
  `galon` int(3) NOT NULL,
  `harga` int(10) NOT NULL,
  `sub` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `resi_new`
--

INSERT INTO `resi_new` (`id_resi`, `tgl`, `id_barang`, `liter`, `galon`, `harga`, `sub`) VALUES
(1296949525, '2017-07-04 09:37:36', 2, 5, 4, 2000, 8000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(10) NOT NULL,
  `nama_admin` varchar(20) NOT NULL,
  `username_admin` varchar(20) NOT NULL,
  `email_admin` varchar(20) NOT NULL,
  `alamat_admin` varchar(100) NOT NULL,
  `hp_admin` varchar(12) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_admin`, `username_admin`, `email_admin`, `alamat_admin`, `hp_admin`, `pass`) VALUES
(5, 'anggyka nuarry', 'anggyka', 'anggyka@gmail.com', 'jln.suprapto no.43 sampit', '081255461907', '$2y$10$kY2MELvIFJ5MHk1JMnyEWeklMZkbUrAPvp6qGVrTmgxxZrO9d4Lwe');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `kode_barang` char(6) NOT NULL,
  `nama_barang` varchar(15) NOT NULL,
  `harga_barang` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`kode_barang`, `nama_barang`, `harga_barang`) VALUES
('AQ001', 'KONVE/5L', 1000),
('AQ002', 'KONVE/10L', 2000),
('AQ003', 'KONVE/20L', 3000),
('AQ004', 'KONVE/25L', 4000),
('AQ005', 'KONVE/30L', 5000),
('AQR01', 'RO/5L', 2000),
('AQR02', 'RO/10L', 3000),
('AQR03', 'RO/20L', 5000),
('AQR04', 'RO/25L', 7000),
('AQR05', 'RO/30L', 8000),
('AQZ01', 'OZON/5L', 3000),
('AQZ02', 'OZON/10L', 4000),
('AQZ03', 'OZON/20L', 6000),
('AQZ04', 'OZON/25L', 8000),
('AQZ05', 'OZON/30L', 10000),
('aqq878', 'tes/20L', 5000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang_new`
--

CREATE TABLE `tb_barang_new` (
  `id_barang` int(10) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `hrg_5` int(10) NOT NULL,
  `hrg_10` int(10) NOT NULL,
  `hrg_20` int(10) NOT NULL,
  `hrg_25` int(10) NOT NULL,
  `hrg_30` int(10) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_barang_new`
--

INSERT INTO `tb_barang_new` (`id_barang`, `nama_barang`, `hrg_5`, `hrg_10`, `hrg_20`, `hrg_25`, `hrg_30`, `deskripsi`, `gambar`) VALUES
(1, 'OZON', 3000, 4000, 6000, 9000, 10000, '', ''),
(2, 'RO', 2000, 3000, 5000, 6000, 8000, '', ''),
(3, 'KONVENSIONAL', 1000, 2000, 3000, 4000, 5000, '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keluar`
--

CREATE TABLE `tb_keluar` (
  `kode_pengeluaran` char(10) NOT NULL,
  `jenis_pengeluaran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_keluar`
--

INSERT INTO `tb_keluar` (`kode_pengeluaran`, `jenis_pengeluaran`) VALUES
('JD-01', 'Tutup Galon');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keranjang_new`
--

CREATE TABLE `tb_keranjang_new` (
  `id_keranjang` int(10) NOT NULL,
  `id_pelanggan` int(10) NOT NULL,
  `id_barang` int(10) NOT NULL,
  `harga_produk` int(10) NOT NULL,
  `qty_produk` int(255) NOT NULL,
  `tgl_produk` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(5) NOT NULL,
  `no_pelanggan` char(20) NOT NULL,
  `nama_pelanggan` varchar(20) NOT NULL,
  `alamat_pelanggan` varchar(30) NOT NULL,
  `hp_pelanggan` varchar(12) NOT NULL,
  `pass_pelanggan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `no_pelanggan`, `nama_pelanggan`, `alamat_pelanggan`, `hp_pelanggan`, `pass_pelanggan`) VALUES
(1, '133131', 'ari', 'kopi', '1122333333', 'abababa'),
(2, '121212', 'aaaaa', 'bbbbb', '22222222', 'ccccccc'),
(3, '11112222', 'yogi', 'dadadada', '31313131', 'aabbcc'),
(5, 'QP02017032105', 'bbbbb', 'dcwdwdq', '4141234141', 'dqdqdqd'),
(6, 'QP02017032106', 'dadadd', 'dDdd', '8089080898', 'dadadadd'),
(7, 'QP02017032107', 'dadadd', 'dDdd', '8089080898', '5343525'),
(8, 'QP02017040808', 'arry', 'aabababa', '0912366666', 'abcd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan_new`
--

CREATE TABLE `tb_pelanggan_new` (
  `id_pelanggan` int(10) NOT NULL,
  `nama_pelanggan` varchar(20) NOT NULL,
  `username_pelanggan` varchar(20) NOT NULL,
  `email_pelanggan` varchar(20) NOT NULL,
  `alamat_pelanggan` varchar(100) NOT NULL,
  `hp_pelanggan` varchar(12) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pelanggan_new`
--

INSERT INTO `tb_pelanggan_new` (`id_pelanggan`, `nama_pelanggan`, `username_pelanggan`, `email_pelanggan`, `alamat_pelanggan`, `hp_pelanggan`, `pass`) VALUES
(2, 'anggyka', 'anggyka', 'anggyka@gmail.com', 'dadadadadad', '08314154', '$2y$10$kY2MELvIFJ5MHk1JMnyEWeklMZkbUrAPvp6qGVrTmgxxZrO9d4Lwe'),
(3, 'bambang', 'bambang', 'bambang@gmail.com', 'jl. suprapto no. 43 sampit', '085243255441', '$2y$10$unqGPHgoDmOH4g.c40XIk.fFVhmVVRJdXSoPP9DvFr9gomfB7CWTm');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pemesanan`
--

CREATE TABLE `tb_pemesanan` (
  `notu` char(20) NOT NULL,
  `nolang` char(20) NOT NULL,
  `jumlahgal` varchar(5) NOT NULL,
  `jenisgal` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pemesanan_new`
--

CREATE TABLE `tb_pemesanan_new` (
  `id_pemesanan` int(10) NOT NULL,
  `tgl_pemesanan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_pelanggan` int(10) NOT NULL,
  `ozon` int(3) NOT NULL,
  `ro` int(3) NOT NULL,
  `conv` int(3) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pemesanan_new`
--

INSERT INTO `tb_pemesanan_new` (`id_pemesanan`, `tgl_pemesanan`, `id_pelanggan`, `ozon`, `ro`, `conv`, `status`) VALUES
(1, '2017-06-16 16:59:01', 1, 1, 2, 3, 'Belum Diproses'),
(2, '2017-06-20 08:39:22', 2, 0, 0, 0, 'Belum Diproses'),
(3, '2017-06-20 09:30:44', 3, 5, 10, 0, 'Belum Diproses'),
(4, '2017-06-20 09:41:03', 2, 1, 10, 0, 'Belum Diproses'),
(5, '2017-07-02 00:43:12', 2, 5, 4, 0, 'Belum Diproses');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengeluaran`
--

CREATE TABLE `tb_pengeluaran` (
  `id_pengeluaran` int(10) NOT NULL,
  `tgl_k` datetime NOT NULL,
  `kode_pengeluaran` varchar(15) NOT NULL,
  `jumlah_k` int(3) NOT NULL,
  `harga_k` int(10) NOT NULL,
  `total_k` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pengeluaran`
--

INSERT INTO `tb_pengeluaran` (`id_pengeluaran`, `tgl_k`, `kode_pengeluaran`, `jumlah_k`, `harga_k`, `total_k`) VALUES
(2, '2017-06-16 19:01:16', 'JD-01', 3, 50000, 150000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `tgl` date NOT NULL,
  `id` int(6) NOT NULL,
  `id_penjualan` int(10) NOT NULL,
  `id_resi` int(10) NOT NULL,
  `kode_barang` char(6) NOT NULL,
  `jml_galon` float NOT NULL,
  `harga` int(10) NOT NULL,
  `subtotal` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penjualan_new`
--

CREATE TABLE `tb_penjualan_new` (
  `id_penjualan` int(10) NOT NULL,
  `id_resi` int(10) NOT NULL,
  `id_transaksi` int(10) NOT NULL,
  `tgl` datetime NOT NULL,
  `id_barang` int(10) NOT NULL,
  `liter` int(2) NOT NULL,
  `galon` int(3) NOT NULL,
  `harga` int(10) NOT NULL,
  `sub` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_penjualan_new`
--

INSERT INTO `tb_penjualan_new` (`id_penjualan`, `id_resi`, `id_transaksi`, `tgl`, `id_barang`, `liter`, `galon`, `harga`, `sub`) VALUES
(1, 1102616465, 1398277028, '2017-06-20 12:31:32', 3, 10, 3, 2000, 6000),
(2, 1145853037, 1398277028, '2017-06-20 12:31:51', 3, 25, 5, 4000, 20000),
(3, 1333103058, 1398277028, '2017-06-20 12:31:20', 1, 10, 23, 4000, 92000),
(4, 1037217240, 1242212401, '2017-06-20 12:32:40', 2, 5, 12, 2000, 24000),
(5, 1327721951, 1242212401, '2017-06-20 12:32:47', 2, 30, 21, 8000, 168000),
(6, 1333578598, 1242212401, '2017-06-20 12:32:33', 2, 20, 7, 5000, 35000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `resi`
--
ALTER TABLE `resi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resi_new`
--
ALTER TABLE `resi_new`
  ADD PRIMARY KEY (`id_resi`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_barang_new`
--
ALTER TABLE `tb_barang_new`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tb_keranjang_new`
--
ALTER TABLE `tb_keranjang_new`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tb_pelanggan_new`
--
ALTER TABLE `tb_pelanggan_new`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tb_pemesanan_new`
--
ALTER TABLE `tb_pemesanan_new`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indexes for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_penjualan_new`
--
ALTER TABLE `tb_penjualan_new`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_resi` (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `resi`
--
ALTER TABLE `resi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `resi_new`
--
ALTER TABLE `resi_new`
  MODIFY `id_resi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1296949526;
--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_barang_new`
--
ALTER TABLE `tb_barang_new`
  MODIFY `id_barang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_keranjang_new`
--
ALTER TABLE `tb_keranjang_new`
  MODIFY `id_keranjang` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tb_pelanggan_new`
--
ALTER TABLE `tb_pelanggan_new`
  MODIFY `id_pelanggan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_pemesanan_new`
--
ALTER TABLE `tb_pemesanan_new`
  MODIFY `id_pemesanan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  MODIFY `id_pengeluaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_penjualan_new`
--
ALTER TABLE `tb_penjualan_new`
  MODIFY `id_penjualan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
