-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 20. maj 2021 ob 03.44
-- Različica strežnika: 10.1.37-MariaDB
-- Različica PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `sledilniktelovadbe`
--

-- --------------------------------------------------------

--
-- Struktura tabele `misicnaskupina`
--

CREATE TABLE `misicnaskupina` (
  `ID` int(11) NOT NULL,
  `naziv` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Odloži podatke za tabelo `misicnaskupina`
--

INSERT INTO `misicnaskupina` (`ID`, `naziv`) VALUES
(1, 'roke'),
(2, 'hrbet'),
(3, 'prsa'),
(4, 'trebuh'),
(5, 'ramena'),
(6, 'noge');

-- --------------------------------------------------------

--
-- Struktura tabele `nazivvaje`
--

CREATE TABLE `nazivvaje` (
  `ID` int(11) NOT NULL,
  `misicnaSkupinaID` int(11) DEFAULT NULL,
  `naziv` varchar(25) COLLATE utf8_slovenian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `nazivvaje`
--

INSERT INTO `nazivvaje` (`ID`, `misicnaSkupinaID`, `naziv`) VALUES
(0, 6, 'dvig na prste'),
(1, 1, 'upogib bicepsa'),
(2, 6, 'poÄep'),
(3, 2, 'priteg za glavo'),
(4, 5, 'potisk nad glavo'),
(5, 4, 'trebuÅ¡njak'),
(6, 3, 'sklec');

-- --------------------------------------------------------

--
-- Struktura tabele `trening`
--

CREATE TABLE `trening` (
  `ID` int(11) NOT NULL,
  `uporabnikID` int(11) DEFAULT NULL,
  `naziv` varchar(25) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `datum` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `trening`
--

INSERT INTO `trening` (`ID`, `uporabnikID`, `naziv`, `datum`) VALUES
(87, 10, 'america', '2021-05-06'),
(112, 7, 'Test1', '2021-05-19'),
(113, 7, '1', '2021-05-20');

-- --------------------------------------------------------

--
-- Struktura tabele `uporabnik`
--

CREATE TABLE `uporabnik` (
  `ID` int(11) NOT NULL,
  `ime` varchar(16) NOT NULL,
  `geslo` varchar(65) NOT NULL,
  `email` varchar(20) NOT NULL,
  `datRegistracije` date NOT NULL,
  `rojstniDan` date DEFAULT NULL,
  `visina` double(5,1) DEFAULT NULL,
  `teza` double(5,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Odloži podatke za tabelo `uporabnik`
--

INSERT INTO `uporabnik` (`ID`, `ime`, `geslo`, `email`, `datRegistracije`, `rojstniDan`, `visina`, `teza`) VALUES
(7, 'LeonSovic', '$2y$08$m5T6Dtomr2cIGazzYxei1OZt0b9h7AXutEi0AlkRuCR3Tlopkdcs.', 'leon@sovic.com', '2021-01-14', '2002-02-18', 174.0, 73.0),
(8, 'salomalo', '$2y$08$/t4FGGxudz6nBzSq.QEV2urGh4Sl2k0LGHD7G8vtx4MH6zE1l97y.', 's@a.co', '2021-02-03', '2021-02-03', NULL, NULL),
(10, 'abba123', '$2y$08$HschhDHaEsgMLRuKNufHQeveGApsDeByUboM5BS.f5hhjwj0qIF4W', 'abba@a.com', '2021-05-06', '2021-05-06', NULL, NULL),
(11, 'leon.sovic', '$2y$08$LzqWBgKa.8tN979Ird.ck.HNbQRg10UOJfdirE7eH7IIzPktZbIFy', 'e@e.com', '2021-05-09', '2021-05-09', NULL, NULL),
(12, 'leon.sovic13', '$2y$08$j8o3nJ5x1UTeMqKXpM4Pueitrr3SIDUmR9tCNzltHuo0HKmhv23TO', 'e@e.com', '2021-05-09', '2021-05-09', NULL, NULL),
(13, 'leon_avic', '$2y$08$jgkJnxXb2aD7SOt8wDg4p.7UH8aynWmCyET85UKM9QVfLc2Muopn6', 'e@e.com', '2021-05-09', '2021-05-09', NULL, NULL),
(14, 'leonicxc', '$2y$08$rvgLXm0QwmWvU9vFKt1R9uec3w6HsB/TX1psCAarSYuAJxRAUA0Wa', 'e@e.com', '2021-05-09', '2021-05-09', NULL, NULL),
(15, 'sovicleon', '$2y$08$pAmXqg5Aam5KUsSbv6IBA.GDJM/YiaChqsZQhmu9UUH9hFVm5M682', 'soviacds@a.com', '2021-05-20', '2021-05-01', NULL, NULL),
(16, 'leonsovic1', '$2y$08$nOU6LX0tUJ/Jj6VXOflqP.6zYMqUE5wN8IH/BPC0GDV/jR5GrANwm', 'leon@as.ciom', '2021-05-20', '2021-05-09', 174.0, 74.0),
(17, 'Trener1', '$2y$08$tl0ZTcJshjUQohpNHyBDe.gBYSjT.lXVxvebSHmyNRg0v/GhfSl3O', 'trener@fit.com', '2021-05-20', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabele `vaja`
--

CREATE TABLE `vaja` (
  `ID` int(11) NOT NULL,
  `treningID` int(11) DEFAULT NULL,
  `nazivVajeID` int(11) DEFAULT NULL,
  `sets` int(5) DEFAULT NULL,
  `reps` int(10) DEFAULT NULL,
  `volumen` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Odloži podatke za tabelo `vaja`
--

INSERT INTO `vaja` (`ID`, `treningID`, `nazivVajeID`, `sets`, `reps`, `volumen`) VALUES
(6, 112, 1, 4, 10, 12),
(7, 112, 6, 3, 20, 0);

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `misicnaskupina`
--
ALTER TABLE `misicnaskupina`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksi tabele `nazivvaje`
--
ALTER TABLE `nazivvaje`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `misicnaSkupinaID` (`misicnaSkupinaID`);

--
-- Indeksi tabele `trening`
--
ALTER TABLE `trening`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `uporabnikID` (`uporabnikID`);

--
-- Indeksi tabele `uporabnik`
--
ALTER TABLE `uporabnik`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksi tabele `vaja`
--
ALTER TABLE `vaja`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `treningID` (`treningID`),
  ADD KEY `nazivVajeID` (`nazivVajeID`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `trening`
--
ALTER TABLE `trening`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT tabele `uporabnik`
--
ALTER TABLE `uporabnik`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT tabele `vaja`
--
ALTER TABLE `vaja`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Omejitve tabel za povzetek stanja
--

--
-- Omejitve za tabelo `nazivvaje`
--
ALTER TABLE `nazivvaje`
  ADD CONSTRAINT `nazivvaje_ibfk_1` FOREIGN KEY (`misicnaSkupinaID`) REFERENCES `misicnaskupina` (`ID`);

--
-- Omejitve za tabelo `trening`
--
ALTER TABLE `trening`
  ADD CONSTRAINT `trening_ibfk_1` FOREIGN KEY (`uporabnikID`) REFERENCES `uporabnik` (`ID`);

--
-- Omejitve za tabelo `vaja`
--
ALTER TABLE `vaja`
  ADD CONSTRAINT `vaja_ibfk_1` FOREIGN KEY (`treningID`) REFERENCES `trening` (`ID`),
  ADD CONSTRAINT `vaja_ibfk_2` FOREIGN KEY (`nazivVajeID`) REFERENCES `nazivvaje` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
