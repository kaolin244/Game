-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Gru 2016, 11:47
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
-- Struktura tabeli dla tabeli `amount`
--

CREATE TABLE `amount` (
  `village_id` int(11) NOT NULL,
  `wood` int(11) NOT NULL DEFAULT '0',
  `stone` int(11) NOT NULL DEFAULT '0',
  `food` int(11) NOT NULL DEFAULT '0',
  `population` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `amount`
--

INSERT INTO `amount` (`village_id`, `wood`, `stone`, `food`, `population`) VALUES
(1, 200, 5, 3, 2),
(2, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `buildings`
--

CREATE TABLE `buildings` (
  `village_id` int(11) NOT NULL,
  `warehouse` int(11) NOT NULL DEFAULT '0',
  `farm` int(11) NOT NULL DEFAULT '0',
  `lumberjack` int(11) NOT NULL DEFAULT '0',
  `mine` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `buildings`
--

INSERT INTO `buildings` (`village_id`, `warehouse`, `farm`, `lumberjack`, `mine`) VALUES
(1, 0, 0, 0, 0),
(2, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `map`
--

CREATE TABLE `map` (
  `village_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `map_position` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `village_name` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `map`
--

INSERT INTO `map` (`village_id`, `user_id`, `map_position`, `points`, `village_name`) VALUES
(1, 1, 22, 0, 'wioska_gracz244'),
(2, 2, 38, 0, 'wioska_marcinex');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_polish_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_polish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `email`, `name`) VALUES
(1, 'gracz244', 'df4892648029cf5c78b7f33cb837bbecaa076ac2ca57334593ecc4f2caa27098', 'gracz244@wp.pl', ''),
(2, 'marcinex', '2826bc789ed991efe64e13af78c12392d0457226de7d23b6d9573412e5d49675', 'marcinex@wp.pl', '');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `amount`
--
ALTER TABLE `amount`
  ADD PRIMARY KEY (`village_id`),
  ADD UNIQUE KEY `village_id` (`village_id`);

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
  MODIFY `village_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
