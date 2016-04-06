-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 06. apr 2016 ob 21.07
-- Različica strežnika: 5.6.16
-- Različica PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Zbirka podatkov: `workshop`
--

-- --------------------------------------------------------

--
-- Struktura tabele `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Odloži podatke za tabelo `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `email`, `username`, `password`) VALUES
(1, 'Developer', 'developer@test.com', 'developer', '81A349E9F10FF7454D0144A930587DEE');

-- --------------------------------------------------------

--
-- Struktura tabele `application`
--

CREATE TABLE IF NOT EXISTS `application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `workshop_id` int(10) unsigned NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_application_workshop_idx` (`workshop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Odloži podatke za tabelo `application`
--

INSERT INTO `application` (`id`, `workshop_id`, `full_name`, `email`, `date_added`) VALUES
(1, 1, 'John Doe', 'john@test.com', '2016-03-22 15:35:33'),
(2, 1, 'Jane Doe', 'jane@test.com', '2016-03-09 15:35:42'),
(3, 2, 'Jack Doe', 'jack@test.com', '2016-04-01 15:36:01'),
(4, 3, 'Bob Doe', 'bob@test.com', '2016-04-06 19:49:20');

-- --------------------------------------------------------

--
-- Struktura tabele `workshop`
--

CREATE TABLE IF NOT EXISTS `workshop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `capacity` int(10) unsigned DEFAULT '10',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Odloži podatke za tabelo `workshop`
--

INSERT INTO `workshop` (`id`, `title`, `start_date`, `capacity`) VALUES
(1, 'Apache delavnica', '2016-05-02 08:00:00', 10),
(2, 'PHP delavnica', '2016-05-09 14:00:00', 5),
(3, 'CSS delavnica', '2016-06-10 15:00:00', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
