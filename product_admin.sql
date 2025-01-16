-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Št 16.Jan 2025, 16:54
-- Verzia serveru: 10.4.32-MariaDB
-- Verzia PHP: 8.2.12

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `product_admin`
--
CREATE DATABASE IF NOT EXISTS `product_admin` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `product_admin`;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `account_type` enum('Admin','Editor','Merchant','Customer') NOT NULL DEFAULT 'Customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `email`, `password`, `phone`, `account_type`, `created_at`, `updated_at`) VALUES
(1, 'Jan Papauch', 'jan.p@example.com', 'hashedpassword1', '123-456-7890', 'Merchant', '2025-01-14 19:37:50', '2025-01-14 20:38:33'),
(3, 'John Doe', 'john.doe@example.com', 'hashedpassword1', '123-456-7890', 'Admin', '2025-01-14 20:01:37', '2025-01-14 20:01:37'),
(6, 'Juraj Hruška', 'juraj.lolo@gugu.com', '', NULL, 'Customer', '2025-01-14 20:31:48', '2025-01-14 20:31:48'),
(8, 'Zuzana Maková', 'zuza.bluza@email.com', '', NULL, 'Customer', '2025-01-14 20:39:08', '2025-01-14 20:39:08');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sold` int(11) DEFAULT 0,
  `stock` int(11) DEFAULT 0,
  `expire` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `products`
--

INSERT INTO `products` (`id`, `name`, `sold`, `stock`, `expire`) VALUES
(1, 'Lopta', 8, 4, '2025-01-16'),
(3, 'Postel', 7, 8, '2025-01-15');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexy pre tabuľku `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pre tabuľku `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
