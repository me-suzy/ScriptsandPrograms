# phpMyAdmin SQL Dump
# version 2.5.3
# http://www.phpmyadmin.net
#
# Serveur: localhost
# Généré le : Lundi 07 Mars 2005 à 14:17
# Version du serveur: 4.0.15
# Version de PHP: 4.3.3
# 
# Base de données: `ulc`
# 

# --------------------------------------------------------

#
# Structure de la table `abonnement`
#

DROP TABLE IF EXISTS `abonnement`;
CREATE TABLE `abonnement` (
  `login` varchar(16) NOT NULL default '',
  `idc` int(11) NOT NULL default '0',
  `type` varchar(16) NOT NULL default '',
  PRIMARY KEY  (`login`,`idc`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Structure de la table `calendrier`
#

DROP TABLE IF EXISTS `calendrier`;
CREATE TABLE `calendrier` (
  `idc` int(11) NOT NULL auto_increment,
  `groupe` varchar(16) NOT NULL default '',
  `login` varchar(16) NOT NULL default '',
  `type` varchar(16) NOT NULL default '',
  `visibilite` varchar(16) NOT NULL default '',
  `nom` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`idc`),
  KEY `login` (`login`)
) TYPE=MyISAM AUTO_INCREMENT=10 ;

# --------------------------------------------------------

#
# Structure de la table `compte`
#

DROP TABLE IF EXISTS `compte`;
CREATE TABLE `compte` (
  `login` varchar(16) NOT NULL default '',
  `password` varchar(16) NOT NULL default '',
  `nom` varchar(64) NOT NULL default '',
  `type` varchar(16) NOT NULL default '',
  PRIMARY KEY  (`login`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Structure de la table `droit`
#

DROP TABLE IF EXISTS `droit`;
CREATE TABLE `droit` (
  `idc` int(11) NOT NULL default '0',
  `porte` varchar(16) NOT NULL default '',
  `qui` varchar(16) NOT NULL default '',
  `type` varchar(16) NOT NULL default '',
  PRIMARY KEY  (`idc`,`porte`,`qui`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Structure de la table `evenement`
#

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE `evenement` (
  `ide` int(11) NOT NULL auto_increment,
  `idep` int(11) NOT NULL default '0',
  `etat` varchar(16) NOT NULL default '',
  `datep` date NOT NULL default '0000-00-00',
  `source` varchar(16) NOT NULL default '',
  `type` varchar(16) NOT NULL default '',
  `createur` varchar(16) NOT NULL default '',
  `login` varchar(16) NOT NULL default '0',
  `titre` varchar(64) NOT NULL default '',
  `debut` date NOT NULL default '0000-00-00',
  `fin` date NOT NULL default '0000-00-00',
  `priorite` varchar(16) NOT NULL default '',
  `commentaire` text NOT NULL,
  `estheure` char(1) NOT NULL default '',
  `heure` time NOT NULL default '00:00:00',
  `duree` int(11) NOT NULL default '0',
  PRIMARY KEY  (`ide`),
  KEY `login` (`login`),
  KEY `idep` (`idep`)
) TYPE=MyISAM AUTO_INCREMENT=100 ;

# --------------------------------------------------------

#
# Structure de la table `groupe`
#

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE `groupe` (
  `groupe` varchar(16) NOT NULL default '',
  `login` varchar(16) NOT NULL default '',
  `type` varchar(16) NOT NULL default '',
  PRIMARY KEY  (`groupe`,`login`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Structure de la table `invitation`
#

DROP TABLE IF EXISTS `invitation`;
CREATE TABLE `invitation` (
  `ide` int(11) NOT NULL default '0',
  `porte` varchar(16) NOT NULL default '',
  `qui` varchar(16) NOT NULL default '',
  `reponse` varchar(16) NOT NULL default '',
  `commentaire` text NOT NULL,
  PRIMARY KEY  (`ide`,`porte`,`qui`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Structure de la table `occurence`
#

DROP TABLE IF EXISTS `occurence`;
CREATE TABLE `occurence` (
  `idc` int(11) NOT NULL default '0',
  `ide` int(11) NOT NULL default '0',
  PRIMARY KEY  (`idc`,`ide`)
) TYPE=MyISAM;
    


