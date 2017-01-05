-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 16 Lis 2016, 23:38
-- Wersja serwera: 10.1.16-MariaDB
-- Wersja PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `gra`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `map`
--

CREATE TABLE `map` (
  `village_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `position_x` int(11) NOT NULL,
  `position_y` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `village_name` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_polish_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_polish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `profile_pic` varchar(200) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `email`, `name`, `profile_pic`) VALUES
(1, 'gracz244', 'df4892648029cf5c78b7f33cb837bbecaa076ac2ca57334593ecc4f2caa27098', 'pawe@wp.pl', '', ''),
(2, 'graczulek', 'f1ba95f135546ef592c3d5ab138f22a4db3369c6227279c256b54e46031e12ad', 'apskdakldh@gmail.com', '', ''),
(3, 'marcinex', '2826bc789ed991efe64e13af78c12392d0457226de7d23b6d9573412e5d49675', 'aksdhoj@wp.pl', '', ''),
(4, 'pasodp', '23e71694f328c8091eb0e48b8498f8972b8a0bc64ab07707a0195c0947383fc1', 'asodhoasdh@opwkaj.pl', '', '');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`village_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `map`
--
ALTER TABLE `map`
  MODIFY `village_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
