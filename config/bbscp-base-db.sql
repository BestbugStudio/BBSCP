-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Lug 26, 2014 alle 14:33
-- Versione del server: 5.6.17
-- PHP Version: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `__DBNAME__`
--
CREATE DATABASE IF NOT EXISTS `__DBNAME__` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `__DBNAME__`;

-- --------------------------------------------------------

--
-- Struttura della tabella `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `idArticle` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(90) NOT NULL,
  `content` text NOT NULL,
  `category` int(11) NOT NULL,
  PRIMARY KEY (`idArticle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `bbscp_admin_menu`
--

CREATE TABLE IF NOT EXISTS `bbscp_admin_menu` (
  `idMenu` int(11) NOT NULL AUTO_INCREMENT,
  `menu_title` varchar(45) NOT NULL,
  `static` tinyint(1) NOT NULL DEFAULT '1',
  `category` int(11) NOT NULL,
  `submenu_of` int(11) NOT NULL,
  `options` varchar(255) NOT NULL,
  `modulename` varchar(755) NOT NULL,
  PRIMARY KEY (`idMenu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `bbscp_admin_user`
--

CREATE TABLE IF NOT EXISTS `bbscp_admin_user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User id',
  `nickname` varchar(45) NOT NULL COMMENT 'nickname',
  `password` varchar(100) NOT NULL COMMENT 'password hash',
  `firstname` varchar(100) NOT NULL COMMENT 'user firstname',
  `lastname` varchar(100) NOT NULL COMMENT 'user lastname',
  `mail` varchar(45) NOT NULL COMMENT 'user e-mail',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'account confirmed?',
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `nickname` (`nickname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `idCategory` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(750) NOT NULL,
  PRIMARY KEY (`idCategory`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `site_menu`
--

CREATE TABLE IF NOT EXISTS `site_menu` (
  `idMenu` int(11) NOT NULL AUTO_INCREMENT,
  `menu_title` varchar(45) NOT NULL,
  `static` tinyint(1) NOT NULL DEFAULT '1',
  `category` int(11) NOT NULL,
  `submenu_of` int(11) NOT NULL,
  PRIMARY KEY (`idMenu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
