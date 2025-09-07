-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1:3306
-- Létrehozás ideje: 2025. Aug 24. 19:23
-- Kiszolgáló verziója: 9.1.0
-- PHP verzió: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `munkahely`
--
CREATE DATABASE IF NOT EXISTS `munkahely` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci;
USE `munkahely`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

DROP TABLE IF EXISTS `felhasznalok`;
CREATE TABLE IF NOT EXISTS `felhasznalok` (
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `valodi_nev` varchar(50) COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `password` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `gender_type` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `birth_date` date NOT NULL,
  `aktiv` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `kodolt_jelszo` varchar(32) COLLATE utf8mb4_hungarian_ci NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`email`, `nickname`, `valodi_nev`, `password`, `gender_type`, `birth_date`, `aktiv`, `deleted`, `kodolt_jelszo`) VALUES
('lekkasanyi@gmail.com', 'sanyi', 'Lekka Sándor', 'alma', 'f', '2025-05-26', 'a', NULL, 'ebbc3c26a34b609dc46f5c3378f96e08');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `gyerekek`
--

DROP TABLE IF EXISTS `gyerekek`;
CREATE TABLE IF NOT EXISTS `gyerekek` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gy_nev` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `gy_szulhely` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `gy_szuldatum` date NOT NULL,
  `gy_lakcim` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `tartosbeteg` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `mv_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `gyerekek`
--

INSERT INTO `gyerekek` (`id`, `gy_nev`, `gy_szulhely`, `gy_szuldatum`, `gy_lakcim`, `tartosbeteg`, `mv_id`) VALUES
(18, 'Tóth Varga Klaudia', 'Budapest', '2021-10-26', '6728 Rúzsa, Petőfi u. 16.', 'n', 2),
(19, 'Tóth Varga László', 'Szeged', '2023-04-23', '6728 Rúzsa, Petőfi u. 16.', 'n', 2),
(20, 'Ocskó Boglárka', 'Kiskunhalas', '2019-08-14', '6794 Üllés Petőfi Sándor utca 60.', 'n', 4),
(21, 'Farkas-Csamangó Erik', 'Szeged', '2007-02-19', '6793 Forráskút, I. ker. 65.', 'n', 7),
(22, 'Farkas-Csamangó Milán', 'Szeged', '2016-07-23', '6793 Forráskút, I. ker. 65.', 'n', 7),
(17, 'Kardos Máté Márk', 'Szeged', '2018-11-19', '6723 Szeged Budapesti krt. 32. B lph. 3/7.', 'n', 5),
(16, 'Kardos Dániel', 'Szeged', '2020-06-21', '6723 Szeged Budapesti krt. 32. B lph. 3/7.', 'i', 5),
(15, 'Kardos Gréta Katalin', 'Szeged', '2017-03-20', '6723 Szeged Budapesti krt. 32. B lph. 3/7.', 'i', 5),
(23, 'Farkas-Csamangó Máté', 'Szeged', '2019-05-14', '6793 Forráskút, I. ker. 65.', 'n', 7),
(24, 'Tóth Bence Gábor', 'Makó', '2016-08-11', '6900 Makó Rudnay Gyula u. 3. A ép. B lph. 2/5.', 'n', 8),
(25, 'Tóth Napsugár Vanda', 'Makó', '2011-01-30', '6900 Makó Rudnay Gyula u. 3. A ép. B lph. 2/5.', 'n', 8),
(26, 'Tóth Melánia Panka', 'Makó', '2022-11-20', '6900 Makó Rudnay Gyula u. 3. A ép. B lph. 2/5.', 'n', 8),
(27, 'Bagaméri Patrik István', 'Békéscsaba', '2007-07-10', '5746 Kunágota, Bocskai u. 129.', 'n', 23),
(28, 'Bíró Lia', 'Békéscsaba', '2017-05-21', '5746 Kunágota, Bocskai u. 129.', 'n', 23),
(29, 'Balog Jázmin', 'Szabadka', '2013-09-18', '6422 Tompa, Kölcsey u. 29.', 'n', 24),
(30, 'Balog Zoé', 'Szabadka', '2015-03-28', '6422 Tompa, Kölcsey u. 29.', 'n', 24),
(31, 'Cipak Maja', 'Szabadka', '2018-02-14', '6422 Tompa, Kölcsey u. 29.', 'n', 24);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `munkavallalok`
--

DROP TABLE IF EXISTS `munkavallalok`;
CREATE TABLE IF NOT EXISTS `munkavallalok` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mv_nev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `mv_szulhely` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `mv_szuldatum` date NOT NULL,
  `mv_lakcim` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `szol_csoport` int NOT NULL,
  `munkaviszony_kezdete` date NOT NULL,
  `leszereles_datuma` date DEFAULT NULL,
  `alapszabadsag` int NOT NULL DEFAULT '20',
  `orvosi_alk_ervenyessege` date NOT NULL,
  `pszich_alk_ervenyessege` date NOT NULL,
  `szakmai_vizsga_datuma` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `munkavallalok`
--

INSERT INTO `munkavallalok` (`id`, `mv_nev`, `mv_szulhely`, `mv_szuldatum`, `mv_lakcim`, `szol_csoport`, `munkaviszony_kezdete`, `leszereles_datuma`, `alapszabadsag`, `orvosi_alk_ervenyessege`, `pszich_alk_ervenyessege`, `szakmai_vizsga_datuma`) VALUES
(5, 'Kardos Ádám', 'Nyíregyháza', '1996-04-07', '6723 Szeged Budapesti krt. 32. B lph. 3/7.', 5, '2017-06-01', NULL, 20, '2026-03-13', '2026-04-03', '2023-03-09'),
(2, 'Tóth László Gábor', 'Budapest', '1993-10-12', '6728 Rúzsa, Petőfi u. 16.', 5, '2021-03-01', NULL, 20, '2026-03-07', '2026-02-15', '2024-05-17'),
(3, 'Gálik Tamás Illés', 'Szeged', '1961-01-05', '6726 Szeged Korondi u. 6/A. 1/3.', 5, '2012-12-01', NULL, 20, '2025-02-28', '2026-01-31', '2024-06-07'),
(4, 'Lengyel Mária', 'Szeged', '1977-11-17', '6794 Üllés Petőfi Sándor utca 60.', 5, '2017-07-28', NULL, 20, '2025-06-01', '2026-02-27', '2024-06-07'),
(6, 'Márki Levente Márk', 'Szeged', '1998-02-22', '6758 Röszke, Felszabadulás u. 174.', 5, '2019-02-01', NULL, 20, '2026-12-06', '2026-04-09', '2023-07-06'),
(7, 'Farkas-Csamangó Tamás', 'Szeged', '1983-11-28', '6793 Forráskút, I. ker. 65.', 5, '2016-04-01', NULL, 20, '2025-11-23', '2025-02-06', '2023-03-23'),
(8, 'Kocsis Anita', 'Makó', '1988-09-15', '6900 Makó Rudnay Gyula u. 3. A ép. B lph. 2/5.', 5, '2020-12-01', NULL, 20, '2025-12-13', '2026-01-29', '2023-07-13'),
(9, 'Sándorné Vadász Alexandra Margit', 'Berettyóújfalu', '1994-01-04', '5746 Kunágota, Kossuth u.113.', 5, '2020-12-01', NULL, 20, '2026-10-18', '2026-02-06', '2024-05-17'),
(10, 'Balázs Piri Ákos', 'Szabadka', '1990-08-13', '6758 Kübekháza, Dózsa György u.572.', 1, '2018-05-02', NULL, 20, '2027-01-13', '2026-04-03', '2024-05-17'),
(11, 'Berta Péter', 'Zenta', '1968-08-31', '6449 Mélykút Pesti u. 2.', 1, '2017-07-27', NULL, 20, '2026-03-07', '2026-05-29', '2023-03-23'),
(12, 'Berka István', 'Orosháza', '1987-01-06', '5800 Mezőkovácsháza, Ifjúsági ltp. 5/B.', 2, '2019-06-01', NULL, 20, '2025-05-15', '2026-01-15', '2023-07-06'),
(13, 'Balázs Piri Alexandra', 'Zenta', '1992-09-28', '6724 Szeged, Rókusi krt. 38.', 2, '2020-05-01', NULL, 20, '2026-06-12', '2026-05-22', '2024-06-07'),
(14, 'Brcic Kostic Edit', 'Szabadka', '1980-11-04', '6760 Kistelek, Diófa u. 39.', 2, '2019-01-01', NULL, 20, '2025-10-04', '2026-01-15', '2023-03-23'),
(15, 'Almási Tünde', 'Zenta', '1970-03-15', 'Oromhegyes, Titó M. u. 98.', 3, '2019-03-01', NULL, 20, '2026-04-02', '2026-05-07', '2023-03-09'),
(23, 'Bíró Tibor', 'Medgyesegyháza', '1980-02-04', '5746 Kunágota, Bocskai u. 129.', 1, '2019-06-01', NULL, 20, '2027-05-05', '2026-01-22', '2025-05-12'),
(17, 'Baté-Nyitri Dóra', 'Törökkanizsa', '1986-10-03', '6758 Röszke, III. körzet 198.', 4, '2019-11-01', NULL, 20, '2026-10-16', '2026-01-29', '2023-03-23'),
(18, 'Bakos Adriánó', 'Topolya', '1986-01-16', '6724 Szeged Kápolna u. 16/A', 3, '2022-03-01', NULL, 20, '2027-01-15', '2026-05-07', '2024-06-07'),
(19, 'Hajbel Valentin', 'Szabadka', '1990-12-31', '6724 Szeged, Csongrádi sgt. 122/B.', 3, '2019-11-01', NULL, 20, '2028-09-17', '2026-01-24', '2025-05-12'),
(20, 'Csarnai Imre Csaba', 'Budapest', '1988-08-21', '5600 Békéscsaba, Bartók Béla út 61-65/B.', 4, '2019-11-01', NULL, 20, '2026-02-15', '2026-01-29', '2025-05-12'),
(21, 'Nagy Attila', 'Zenta', '1994-06-17', '6721 Szeged, Brüsszeli krt. 18/B.', 4, '2019-11-01', NULL, 20, '2025-10-11', '2026-01-29', '2023-07-13'),
(22, 'Lovas Dóra', 'Békéscsaba', '1996-10-26', '5820 Mezőhegyes, Ómezőhegyes major 6.', 1, '2019-06-01', NULL, 20, '2027-04-07', '2026-01-22', '2025-05-12'),
(24, 'Cipak Roland', 'Szabadka', '1984-04-04', '6422 Tompa, Kölcsey u. 29.', 3, '2018-05-02', NULL, 20, '2026-01-23', '2025-12-07', '2024-06-07'),
(25, 'Jóska Pista', 'Csajádaröcsöge', '1995-08-31', '6724 Szeged, Kunigunda u. 3.', 2, '2010-05-20', '2025-08-24', 20, '2026-05-20', '2026-05-20', '2026-05-20');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ugyintezok`
--

DROP TABLE IF EXISTS `ugyintezok`;
CREATE TABLE IF NOT EXISTS `ugyintezok` (
  `nev` varchar(20) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `valodi_nev` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `jelszo` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `aktiv` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `torolve` datetime DEFAULT NULL,
  `kodolt_jelszo` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `jogkor` varchar(1) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `jelszo_modositas_kell` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `jelszo_lejar` datetime NOT NULL,
  PRIMARY KEY (`nev`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `ugyintezok`
--

INSERT INTO `ugyintezok` (`nev`, `valodi_nev`, `jelszo`, `aktiv`, `torolve`, `kodolt_jelszo`, `email`, `jogkor`, `jelszo_modositas_kell`, `jelszo_lejar`) VALUES
('sanyi', 'Lekka Sándor', '1234', 'i', NULL, '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'lekkasanyi@gmail.com', 'r', 'n', '2030-09-05 00:00:00'),
('kalap', 'Kala Pál', '4321', 'i', NULL, 'fe2592b42a727e977f055947385b709cc82b16b9a87f88c6abf3900d65d0cdc3', 'kala@pal.hu', 'k', 'n', '2030-12-31 00:00:00'),
('majoranna', 'Major Anna', '9179b9cd583a6afe0e0e0cc94cc64e866391b1148aa61d8255c64520a9b946e8', 'i', NULL, '9179b9cd583a6afe0e0e0cc94cc64e866391b1148aa61d8255c64520a9b946e8', 'major@anna.hu', 'k', 'i', '2025-11-24 20:11:33'),
('mintapelda', 'Minta Példa', 'feb56693342f7174a16d210a64df308f0c7e7ca4d1dbeb76b1851bc55552c627', 'i', NULL, 'feb56693342f7174a16d210a64df308f0c7e7ca4d1dbeb76b1851bc55552c627', 'minta@pelda.hu', 'k', 'n', '2025-08-01 16:18:31'),
('levelesteszta', 'Leveles Tészta', '2e4c88504e53a31722b5b8ad5b68323cd77046400dcac2df48274c0d57ba7842', 'i', NULL, '2e4c88504e53a31722b5b8ad5b68323cd77046400dcac2df48274c0d57ba7842', 'leveles@teszta.hu', 'v', 'n', '2025-11-21 21:19:13');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `validalas`
--

DROP TABLE IF EXISTS `validalas`;
CREATE TABLE IF NOT EXISTS `validalas` (
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `hatarido` datetime NOT NULL,
  `kod` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `vegleges` datetime DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `validalas`
--

INSERT INTO `validalas` (`email`, `hatarido`, `kod`, `vegleges`) VALUES
('lekkasanyi@gmail.com', '2025-06-10 22:39:35', 'XnAkVpnVamoXjM7J', '2025-06-09 22:39:38');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
