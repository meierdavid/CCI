-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 07 Janvier 2019 à 14:28
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `bddcci`
--

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE IF NOT EXISTS `entreprise` (
  `numSiret` int(11) NOT NULL,
  `nomEntreprise` varchar(50) NOT NULL,
  `adresseEntreprise` varchar(50) NOT NULL,
  `codePEntreprise` int(11) NOT NULL,
  `villeEntreprise` varchar(50) NOT NULL,
  `horairesEntreprise` varchar(2000) NOT NULL,
  `livraisonEntreprise` tinyint(4) NOT NULL,
  `tempsReservMax` int(11) DEFAULT NULL,
  `siteWebEntreprise` varchar(100) DEFAULT NULL,
  `logoEntreprise` varchar(2000) DEFAULT NULL,
  `soldeEntreprise` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`numSiret`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `entreprise`
--

INSERT INTO `entreprise` (`numSiret`, `nomEntreprise`, `adresseEntreprise`, `codePEntreprise`, `villeEntreprise`, `horairesEntreprise`, `livraisonEntreprise`, `tempsReservMax`, `siteWebEntreprise`, `logoEntreprise`, `soldeEntreprise`) VALUES
(2147483647, 'Darky', '271 avenue du pic saint-loup', 34090, 'Montpellier', '08:00-12:00/14:00-18:00 08:00-12:00/14:00-18:00 08:00-12:00/14:00-18:00 08:00-12:00/14:00-18:00 08:00-12:00/14:00-18:00 -/- -/-', 0, 3, 'commerce.darky.fr', '894317fda51b0cc9261e78add5a69c3b.png', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
