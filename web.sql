-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: mai 23, 2022 la 09:57 PM
-- Versiune server: 10.4.22-MariaDB
-- Versiune PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `web`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `curs`
--

CREATE TABLE `curs` (
  `id` int(11) NOT NULL,
  `nume` varchar(255) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `start_date` int(11) NOT NULL,
  `stop_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `curs`
--

INSERT INTO `curs` (`id`, `nume`, `trainer_id`, `start_date`, `stop_date`) VALUES
(9, 'C#', 6, 1652994000, 1655845200),
(10, 'Java', 7, 1651352400, 1653512400);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `inscrieri`
--

CREATE TABLE `inscrieri` (
  `id` int(11) NOT NULL,
  `nume` varchar(128) NOT NULL,
  `telefon` int(10) NOT NULL,
  `email` varchar(64) NOT NULL,
  `cursuri` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `inscrieri`
--

INSERT INTO `inscrieri` (`id`, `nume`, `telefon`, `email`, `cursuri`) VALUES
(20, 'STANCU DANIEL-FLORIN', 757654757, 'fstancu@gmail.com', '9|10|');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `titlu` varchar(128) NOT NULL,
  `descriere` varchar(4096) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `news`
--

INSERT INTO `news` (`id`, `titlu`, `descriere`, `date`) VALUES
(9, 'aaa', 'aaa', 1653335695);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `trainers`
--

CREATE TABLE `trainers` (
  `id` int(11) NOT NULL,
  `Nume` varchar(255) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `trainers`
--

INSERT INTO `trainers` (`id`, `Nume`, `Email`) VALUES
(6, 'Andrei', 'fstancu@gmail.com'),
(7, 'Stancu', 'a@gmail.com');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `utilizatori`
--

CREATE TABLE `utilizatori` (
  `id` int(11) NOT NULL,
  `nume` varchar(64) NOT NULL,
  `parola` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `utilizatori`
--

INSERT INTO `utilizatori` (`id`, `nume`, `parola`) VALUES
(1, 'test', 'test');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `curs`
--
ALTER TABLE `curs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainier_id` (`trainer_id`);

--
-- Indexuri pentru tabele `inscrieri`
--
ALTER TABLE `inscrieri`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `utilizatori`
--
ALTER TABLE `utilizatori`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `curs`
--
ALTER TABLE `curs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pentru tabele `inscrieri`
--
ALTER TABLE `inscrieri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pentru tabele `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pentru tabele `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pentru tabele `utilizatori`
--
ALTER TABLE `utilizatori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `curs`
--
ALTER TABLE `curs`
  ADD CONSTRAINT `curs_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
