-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas wygenerowania: 14 Sie 2012, 16:39
-- Wersja serwera: 5.6.11
-- Wersja PHP: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;



-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `chat`
--

INSERT INTO `chat` (`message_id`, `user_id`, `message`, `timestamp`) VALUES
(0, 0, 'test', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `football_matchs`
--

CREATE TABLE IF NOT EXISTS `football_matchs` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `StreamID` int(11) NOT NULL,
  `Competition` varchar(100) NOT NULL,
  `Data` varchar(50) NOT NULL,
  `MatchStart` varchar(5) NOT NULL,
  `MatchEnd` varchar(5) NOT NULL,
  `TeamHome` varchar(100) NOT NULL,
  `TeamHomeFlag` varchar(6) NOT NULL,
  `TeamAway` varchar(100) NOT NULL,
  `TeamAwayFlag` varchar(6) NOT NULL,
  `Visible` varchar(6) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Zrzut danych tabeli `football_matchs`
--

INSERT INTO `football_matchs` (`Id`, `StreamID`, `Competition`, `Data`, `MatchStart`, `MatchEnd`, `TeamHome`, `TeamHomeFlag`, `TeamAway`, `TeamAwayFlag`, `Visible`) VALUES
(1, 215000, 'International Friendly Matches', '14 August', '15:45', '17:45', 'Indonesia', 'id', 'Phillipines', 'ph', 'true'),
(2, 215005, 'International Friendly Matches', '14 August', '16:00', '18:00', 'Kazakhstan', 'kz', 'Georgia', 'ge', 'true'),
(3, 214903, 'Uefa Euro 2015 U21 Qualifiers/Friendlies', '14 August', '17:00', '19:00', 'Wales U21', 'wa', 'Finland U21', 'fi', 'true'),
(4, 214921, 'Uefa Euro 2015 U21 Qualifiers/Friendlies', '14 August', '17:00', '19:00', 'Slovakia U21', 'sk', 'Italy U21', 'it', 'true'),
(5, 214905, 'Uefa Euro 2015 U21 Qualifiers/Friendlies', '14 August', '17:30', '19:30', 'Albania U21', 'al', 'Austria U21', 'at', 'true'),
(6, 214920, 'Uefa Euro 2015 U21 Qualifiers/Friendlies', '14 August', '18:00', '20:00', 'Czech Republic U21', 'cz', 'Netherlands U21', 'nl', 'true'),
(7, 214922, 'Uefa Euro 2015 U21 Qualifiers/Friendlies', '14 August', '18:00', '20:00', 'Sweden U21', 'se', 'Norway U21', 'no', 'true'),
(8, 214978, 'International Friendly Matches', '14 August', '18:00', '20:00', 'Finland', 'fi', 'Slovenia', 'si', 'true'),
(9, 215001, 'International Friendly Matches', '14 August', '18:00', '20:00', 'Belarus', 'by', 'Montenegro', 'me', 'true'),
(10, 215002, 'International Friendly Matches', '14 August', '18:00', '20:00', 'Estonia', 'ee', 'Latvia', 'lv', 'true'),
(11, 215004, 'International Friendly Matches', '14 August', '18:00', '20:00', 'Azerbaijan', 'az', 'Malta', 'mt', 'true'),
(12, 215484, 'Uefa Euro 2015 U21 Qualifiers/Friendlies', '14 August', '18:00', '20:00', 'Serbia U21', 'rs', 'FYR Macedonia U21', 'mk', 'true'),
(13, 214979, 'International Friendly Matches', '14 August', '18:30', '20:30', 'Chile', 'cl', 'Iraq', 'iq', 'true'),
(14, 214924, 'Uefa Euro 2015 U21 Qualifiers/Friendlies', '14 August', '18:45', '20:45', 'Portugal U21', 'pt', 'Switzerland U21', 'ch', 'true'),
(15, 214881, 'International Friendly Matches', '14 August', '19:00', '21:00', 'Canada U19', 'ca', 'Argentina U19', 'ar', 'true'),
(16, 214907, 'Uefa Euro 2015 U21 Qualifiers/Friendlies', '14 August', '19:00', '21:00', 'Iceland U21', 'is', 'Belarus U21', 'by', 'true'),
(17, 214980, 'International Friendly Matches', '14 August', '19:00', '21:00', 'Moldova', 'md', 'Andorra', 'ad', 'true'),
(18, 215500, 'French Ligue 1', '14 August', '19:00', '21:00', 'Le Club Magazine', 'fr', '', '', 'true'),
(19, 215003, 'International Friendly Matches', '14 August', '19:30', '21:30', 'Luxembourg', 'lu', 'Lithuania', 'lt', 'true'),
(20, 214908, 'Uefa Euro 2015 U21 Qualifiers/Friendlies', '14 August', '20:00', '22:00', 'Faroe Islands U21', 'fo', 'Ireland U21', 'ie', 'true'),
(21, 214910, 'Uefa Euro 2015 U21 Qualifiers/Friendlies', '14 August', '20:00', '22:00', 'Slovenia U21', 'si', 'Estonia U21', 'ee', 'true'),
(22, 214981, 'International Friendly Matches', '14 August', '20:00', '22:00', 'Sweden', 'se', 'Norway', 'no', 'true'),
(23, 214982, 'International Friendly Matches', '14 August', '20:00', '22:00', 'Romania', 'ro', 'Slovakia', 'sk', 'true'),
(24, 214983, 'International Friendly Matches', '14 August', '20:00', '22:00', 'Ukraine', 'ua', 'Israel', 'il', 'true'),
(25, 214984, 'International Friendly Matches', '14 August', '20:00', '22:00', 'Colombia', 'co', 'Serbia', 'rs', 'true'),
(26, 214985, 'International Friendly Matches', '14 August', '20:15', '22:15', 'South Africa', 'za', 'Nigeria', 'ng', 'true'),
(27, 214995, 'International Friendly Matches', '14 August', '20:15', '22:15', 'Liechtenstein', 'li', 'Croatia', 'hr', 'true'),
(28, 214299, 'International Friendly Matches', '14 August', '20:30', '22:30', 'Bosnia and Herzegovina', 'ba', 'USA', 'us', 'true'),
(29, 214986, 'International Friendly Matches', '14 August', '20:30', '22:30', 'Hungary', 'hu', 'Czech Republic', 'cz', 'true'),
(30, 214987, 'International Friendly Matches', '14 August', '20:30', '22:30', 'Austria', 'at', 'Greece', 'gr', 'true'),
(31, 214989, 'International Friendly Matches', '14 August', '20:30', '22:30', 'Turkey', 'tr', 'Ghana', 'gh', 'true'),
(32, 215428, 'International Friendly Matches', '14 August', '20:40', '00:00', 'International Friendly Matches Simulcast', 'eu', '', '', 'true'),
(33, 214917, 'FIFA World Cup 2014 Qualifying', '14 August', '20:45', '22:45', 'Northern Ireland', 'ix', 'Russia', 'ru', 'true'),
(34, 214990, 'International Friendly Matches', '14 August', '20:45', '22:45', 'Switzerland', 'ch', 'Brazil', 'br', 'true'),
(35, 214991, 'International Friendly Matches', '14 August', '20:45', '22:45', 'Poland', 'pl', 'Denmark', 'dk', 'true'),
(36, 214992, 'International Friendly Matches', '14 August', '20:45', '22:45', 'Germany', 'de', 'Paraguay', 'py', 'true'),
(37, 214993, 'International Friendly Matches', '14 August', '20:45', '22:45', 'Wales', 'wa', 'Ireland', 'ie', 'true'),
(38, 214994, 'International Friendly Matches', '14 August', '20:45', '22:45', 'FYR Macedonia', 'mk', 'Bulgaria', 'bg', 'true'),
(39, 214996, 'International Friendly Matches', '14 August', '20:45', '22:45', 'Italy', 'it', 'Argentina', 'ar', 'true'),
(40, 215006, 'International Friendly Matches', '14 August', '20:45', '22:45', 'Albania', 'al', 'Armenia', 'am', 'true');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `football_streams`
--

CREATE TABLE IF NOT EXISTS `football_streams` (
  `StreamID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Link` varchar(300) NOT NULL,
  `Quality` varchar(10) NOT NULL,
  `Raiting` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `football_streams`
--

INSERT INTO `football_streams` (`StreamID`, `Name`, `Type`, `Link`, `Quality`, `Raiting`) VALUES
(215000, 'Livesoccerhd11', 'Flash', 'http://livesoccerhd.info/l11.html', '150 Kbps', 50);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `login` varchar(12) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` int(100) NOT NULL,
  `fb_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_id`, `login`, `password`, `email`, `fb_id`) VALUES
(0, 'test', '098f6bcd4621d373cade4e832627b4f6', 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_online`
--

CREATE TABLE IF NOT EXISTS `users_online` (
  `ip` varchar(16) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users_online`
--

INSERT INTO `users_online` (`ip`, `datetime`) VALUES
('127.0.0.1', '2013-08-14 14:38:28');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_online_record`
--

CREATE TABLE IF NOT EXISTS `users_online_record` (
  `Rekord` int(11) NOT NULL,
  `Data` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
