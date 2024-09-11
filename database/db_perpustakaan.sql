-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Sep 2024 pada 00.00
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetLoanDetails` (IN `loan_id` VARCHAR(10))   BEGIN
    SELECT
        l.ID_loan,
        l.Loan_Date AS loan_date,
        l.Return_Date AS return_date,
        l.Member_ID,
        m.Name AS member_name,
        m.Phone AS member_phone,
        m.Address AS member_address,
        b.Title AS book_title,
        b.Author AS book_author
    FROM
        loans l
        JOIN members m ON l.Member_ID = m.Member_ID
        JOIN books b ON l.Book_ID = b.Book_ID
    WHERE
        l.ID_loan = loan_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetReturns` ()   BEGIN
    SELECT m.Name AS member_name, b.Title AS book_title, r.Returns_date, r.Shape
    FROM returns r
    JOIN loans l ON r.ID_loan = l.ID_loan
    JOIN members m ON l.Member_ID = m.Member_ID
    JOIN books b ON l.Book_ID = b.Book_ID;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `books`
--

CREATE TABLE `books` (
  `Book_ID` varchar(5) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Author` varchar(255) DEFAULT NULL,
  `Publisher` varchar(255) DEFAULT NULL,
  `Year_Published` year(4) DEFAULT NULL,
  `Genre` varchar(100) DEFAULT NULL,
  `ISBN` varchar(13) DEFAULT NULL,
  `Copies_Available` int(11) DEFAULT NULL,
  `Pict` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `books`
--

INSERT INTO `books` (`Book_ID`, `Title`, `Author`, `Publisher`, `Year_Published`, `Genre`, `ISBN`, `Copies_Available`, `Pict`) VALUES
('B0001', 'The Great Gatsby', 'F. Scott Fitzgerald', 'Scribner', '1926', 'Fiction', '9780743273565', 8, 'book1.png'),
('B0005', 'Bumi', 'Tere Liye', 'Gramedia Pustaka Utama', '2014', 'Bildungsroman, Fiksi petualangan, Fantasi', '9786020301129', 4, '1725404779_Bumi_(sampul).jpg'),
('B0006', 'Tentang Kamu', 'Tere Liye', 'Republika', '2016', 'Fiksi', '9786020822341', 6, '1725407654_Tentang_Kamu_sampul.jpeg'),
('B0007', 'Negeri Para Bedebah', 'Tere Liye', 'Gramedia Pustaka Utama', '2012', 'Fiksi, Realisme', '9789792285529', 5, '1725429307_Negeri_Para_Bedebah.jpg'),
('B0008', 'Rindu', 'Tere Liye', 'Republika', '2014', 'Sejarah, Fiksi, dan Fantasi', '9786028997904', 4, '1725429570_covPAB-014.jpg'),
('B0009', 'Bulan', 'Tere Liye', 'Gramedia Pustaka Utama', '2015', 'Fiksi Petualangan, Fantasi', '9786020301129', 7, '1725923345_Sampul_novel_Bulan.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `book_category`
--

CREATE TABLE `book_category` (
  `Book_ID` varchar(5) NOT NULL,
  `Category_ID` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `Category_ID` varchar(5) NOT NULL,
  `Name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `loans`
--

CREATE TABLE `loans` (
  `ID_loan` varchar(5) NOT NULL,
  `Book_ID` varchar(5) DEFAULT NULL,
  `Member_ID` varchar(5) DEFAULT NULL,
  `Loan_Date` date DEFAULT NULL,
  `Return_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `loans`
--

INSERT INTO `loans` (`ID_loan`, `Book_ID`, `Member_ID`, `Loan_Date`, `Return_Date`) VALUES
('L0009', 'B0008', 'M0002', '2024-09-08', '2024-09-17'),
('L0010', 'B0001', 'M0004', '2024-09-12', '2024-09-24'),
('L0011', 'B0005', 'M0003', '2024-09-08', '2024-09-25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `members`
--

CREATE TABLE `members` (
  `Member_ID` varchar(5) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `Membership_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `members`
--

INSERT INTO `members` (`Member_ID`, `Name`, `Email`, `Phone`, `Address`, `Membership_Date`) VALUES
('M0001', 'Jhon Doe', 'jhon@gmail.com', '08123456789', 'Jl. Kaliurang No. 5, Sleman Yogyakarta', '2024-08-01'),
('M0002', 'Luthfa', 'luthfa@gmail.com', '08985219694', 'Janturan Tirtoadi Mlati Sleman', '2024-09-01'),
('M0003', 'Ardi', 'ardi.firda@gmail.com', '0898521945', 'Janturan Tirtoadi Mlati Sleman', '2024-08-23'),
('M0004', 'Hermawan', 'hemawan07@gmail.com', '08692365923', 'jl Cendana Tulung Agung, Jawa Tengah', '2024-09-08'),
('M0005', 'Johan', 'johan02@gmail.com', '08872689261', 'Jl Banyu wangi km 20 Sidoarum Magelang', '2024-09-08'),
('M0006', 'Ardi Prajoko', 'ardi.prajoko@gmail.com', '0898521923', 'Janturan Tirtoadi Mlati Sleman', '2024-09-10'),
('M0007', 'Luthfa Sobrian', 'luthfa.s@gmail.com', '0898521947', 'Sanggrahan Tirtoadi Mlati Sleman', '2024-09-10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `returnlogs`
--

CREATE TABLE `returnlogs` (
  `old_ID_return` varchar(5) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `old_Returns_date` date NOT NULL,
  `old_Shape` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `loan_date` date NOT NULL,
  `return_date` date NOT NULL,
  `member_name` varchar(255) NOT NULL,
  `book_author` varchar(255) NOT NULL,
  `member_phone` varchar(50) NOT NULL,
  `member_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `returnlogs`
--

INSERT INTO `returnlogs` (`old_ID_return`, `book_title`, `old_Returns_date`, `old_Shape`, `id`, `loan_date`, `return_date`, `member_name`, `book_author`, `member_phone`, `member_address`) VALUES
('R0001', 'The Great Gatsby', '2024-09-17', 'baik', 4, '2024-09-07', '2024-09-18', 'Ardi', 'F. Scott Fitzgerald', '0898521945', 'Janturan Tirtoadi Mlati Sleman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `returns`
--

CREATE TABLE `returns` (
  `ID_return` varchar(5) NOT NULL,
  `ID_loan` varchar(5) NOT NULL,
  `Returns_date` date NOT NULL,
  `Shape` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('iF9RWlNHU7J2kQLK8eG3WBYvVWPgRi6ugCZgww1z', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaUJtaVBSRmhmd1BaR1d3TEtONmRLZFNEMHlKU1dlOGtkNnF6OVA4dSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1725969108);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Luthfa Sobrian', 'luthfa@gmail.com', NULL, '$2y$12$9jFIDCc6S.lwvRR.PHPdi.Siqqw20zsJmrQrm0a70aJeAfEtWH/CO', 'ukk13kBBrZxDFjQeBKVNSkxdG16GPcuaPWdPp0htpyxg216bkvITis9twu5R', '2024-09-08 07:06:02', '2024-09-08 07:06:02');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`Book_ID`);

--
-- Indeks untuk tabel `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`Book_ID`,`Category_ID`),
  ADD KEY `Category_ID` (`Category_ID`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Category_ID`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`ID_loan`),
  ADD KEY `Book_ID` (`Book_ID`),
  ADD KEY `Member_ID` (`Member_ID`);

--
-- Indeks untuk tabel `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`Member_ID`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `returnlogs`
--
ALTER TABLE `returnlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`ID_return`),
  ADD KEY `returns_ibfk_1` (`ID_loan`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `returnlogs`
--
ALTER TABLE `returnlogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `book_category`
--
ALTER TABLE `book_category`
  ADD CONSTRAINT `book_category_ibfk_1` FOREIGN KEY (`Book_ID`) REFERENCES `books` (`Book_ID`),
  ADD CONSTRAINT `book_category_ibfk_2` FOREIGN KEY (`Category_ID`) REFERENCES `categories` (`Category_ID`);

--
-- Ketidakleluasaan untuk tabel `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`Book_ID`) REFERENCES `books` (`Book_ID`),
  ADD CONSTRAINT `loans_ibfk_2` FOREIGN KEY (`Member_ID`) REFERENCES `members` (`Member_ID`);

--
-- Ketidakleluasaan untuk tabel `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_ibfk_1` FOREIGN KEY (`ID_loan`) REFERENCES `loans` (`ID_loan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
