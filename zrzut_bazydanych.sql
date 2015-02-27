-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 17 Lip 2014, 17:03
-- Wersja serwera: 5.5.25a-log
-- Wersja PHP: 5.3.19

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `virt100500_baza`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sms`
--

CREATE TABLE IF NOT EXISTS `sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sms_img` varchar(256) NOT NULL,
  `sms_title` varchar(256) NOT NULL,
  `sms_cena` varchar(128) NOT NULL,
  `sms_numer` int(12) NOT NULL,
  `sms_tresc` varchar(64) NOT NULL,
  `sms_opis` text NOT NULL,
  `command` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sms_backup`
--

CREATE TABLE IF NOT EXISTS `sms_backup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service` varchar(32) NOT NULL,
  `command` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sms_database`
--

CREATE TABLE IF NOT EXISTS `sms_database` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(64) NOT NULL,
  `buy_time` int(32) NOT NULL,
  `smskey` varchar(16) NOT NULL,
  `service` varchar(32) NOT NULL,
  `command` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
