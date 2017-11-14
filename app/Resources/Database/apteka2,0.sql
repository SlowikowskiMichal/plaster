-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 13 Lis 2017, 22:00
-- Wersja serwera: 10.1.28-MariaDB
-- Wersja PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `test`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `farmaceuta`
--

CREATE TABLE `farmaceuta` (
  `id_farmaceuty` int(11) NOT NULL,
  `id_miasta` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `imie` text COLLATE utf8_polish_ci,
  `nazwisko` text COLLATE utf8_polish_ci,
  `login` linestring DEFAULT NULL,
  `hasło` linestring DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `farmaceuta`
--

INSERT INTO `farmaceuta` (`id_farmaceuty`, `id_miasta`, `id`, `imie`, `nazwisko`, `login`, `hasło`) VALUES
(2, 1, 4, 'Michał', 'Słowikowski', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lekarz`
--

CREATE TABLE `lekarz` (
  `id_lekarza` int(11) NOT NULL,
  `id_miasta` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `imie` text COLLATE utf8_polish_ci,
  `nazwisko` text COLLATE utf8_polish_ci,
  `login` linestring DEFAULT NULL,
  `hasło` linestring DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `lekarz`
--

INSERT INTO `lekarz` (`id_lekarza`, `id_miasta`, `id`, `imie`, `nazwisko`, `login`, `hasło`) VALUES
(1, 1, 1, 'Mieczysław', 'Parny', NULL, NULL),
(2, 2, 3, 'Kamil', 'Starecki', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `leki`
--

CREATE TABLE `leki` (
  `id_leku` int(11) NOT NULL,
  `nazwa_leku` text COLLATE utf8_polish_ci,
  `id_stanu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `leki`
--

INSERT INTO `leki` (`id_leku`, `nazwa_leku`, `id_stanu`) VALUES
(1, 'Paracetamol', 1),
(2, 'Rutinoscorbin', 2),
(3, 'Penicylina', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `loginhaslo`
--

CREATE TABLE `loginhaslo` (
  `id` int(11) NOT NULL,
  `login` text COLLATE utf8_polish_ci,
  `haslo` text COLLATE utf8_polish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `loginhaslo`
--

INSERT INTO `loginhaslo` (`id`, `login`, `haslo`) VALUES
(1, 'login1', 'haslo1'),
(2, 'login2', 'haslo2'),
(3, 'login3', 'haslo3'),
(4, 'login4', 'haslo4');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `miasta`
--

CREATE TABLE `miasta` (
  `id_miasta` int(11) NOT NULL,
  `nazwa` text COLLATE utf8_polish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `miasta`
--

INSERT INTO `miasta` (`id_miasta`, `nazwa`) VALUES
(1, 'Rzym'),
(2, 'Pcim');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pacjent`
--

CREATE TABLE `pacjent` (
  `id_klienta` int(11) NOT NULL,
  `id_miasta` int(11) NOT NULL,
  `imie` text COLLATE utf8_polish_ci,
  `nazwisko` text COLLATE utf8_polish_ci,
  `login` linestring DEFAULT NULL,
  `hasło` linestring DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pacjent`
--

INSERT INTO `pacjent` (`id_klienta`, `id_miasta`, `imie`, `nazwisko`, `login`, `hasło`) VALUES
(1, 1, 'Paweł', 'Kowal', NULL, NULL),
(2, 2, 'Łukasz', 'Marecki', NULL, NULL),
(3, 1, 'Paweł', 'Gaweł', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `recepta`
--

CREATE TABLE `recepta` (
  `id_recepty` int(11) NOT NULL,
  `id_klienta` int(11) NOT NULL,
  `id_lekarza` int(11) NOT NULL,
  `id_leku` int(11) NOT NULL,
  `data_wydania` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `recepta`
--

INSERT INTO `recepta` (`id_recepty`, `id_klienta`, `id_lekarza`, `id_leku`, `data_wydania`) VALUES
(1, 1, 2, 2, '2017-05-02 00:00:00'),
(2, 1, 1, 1, '2017-05-03 00:00:00'),
(3, 2, 2, 3, '2017-05-05 00:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `stan_magazyn`
--

CREATE TABLE `stan_magazyn` (
  `id_stanu` int(11) NOT NULL,
  `stan` text COLLATE utf8_polish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `stan_magazyn`
--

INSERT INTO `stan_magazyn` (`id_stanu`, `stan`) VALUES
(1, 'Dostepny'),
(2, 'Ostatki'),
(3, 'Brak');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `farmaceuta`
--
ALTER TABLE `farmaceuta`
  ADD PRIMARY KEY (`id_farmaceuty`),
  ADD KEY `id_miasta` (`id_miasta`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `lekarz`
--
ALTER TABLE `lekarz`
  ADD PRIMARY KEY (`id_lekarza`),
  ADD KEY `id_miasta` (`id_miasta`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `leki`
--
ALTER TABLE `leki`
  ADD PRIMARY KEY (`id_leku`);

--
-- Indexes for table `loginhaslo`
--
ALTER TABLE `loginhaslo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `miasta`
--
ALTER TABLE `miasta`
  ADD PRIMARY KEY (`id_miasta`);

--
-- Indexes for table `pacjent`
--
ALTER TABLE `pacjent`
  ADD PRIMARY KEY (`id_klienta`),
  ADD KEY `id_miasta` (`id_miasta`);

--
-- Indexes for table `recepta`
--
ALTER TABLE `recepta`
  ADD PRIMARY KEY (`id_recepty`,`id_leku`),
  ADD KEY `id_klienta` (`id_klienta`),
  ADD KEY `id_lekarza` (`id_lekarza`),
  ADD KEY `id_leku` (`id_leku`);

--
-- Indexes for table `stan_magazyn`
--
ALTER TABLE `stan_magazyn`
  ADD PRIMARY KEY (`id_stanu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `farmaceuta`
--
ALTER TABLE `farmaceuta`
  MODIFY `id_farmaceuty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `lekarz`
--
ALTER TABLE `lekarz`
  MODIFY `id_lekarza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `pacjent`
--
ALTER TABLE `pacjent`
  MODIFY `id_klienta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
