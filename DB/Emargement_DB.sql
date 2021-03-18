-- MySQL dump 10.13  Distrib 5.6.23, for Win32 (x86)
--
-- Host: localhost    Database: emargement
-- ------------------------------------------------------
-- Server version	5.6.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ann_sco`
--

DROP TABLE IF EXISTS `ann_sco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ann_sco` (
  `idann_sco` int(11) NOT NULL AUTO_INCREMENT,
  `ann_sco` varchar(9) NOT NULL COMMENT '2016-2017',
  PRIMARY KEY (`idann_sco`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ann_sco`
--

LOCK TABLES `ann_sco` WRITE;
/*!40000 ALTER TABLE `ann_sco` DISABLE KEYS */;
INSERT INTO `ann_sco` VALUES (1,'2016-2017');
/*!40000 ALTER TABLE `ann_sco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compte`
--

DROP TABLE IF EXISTS `compte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compte` (
  `idcompte` int(11) NOT NULL AUTO_INCREMENT,
  `idrole` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `salt` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`idcompte`,`idrole`),
  KEY `fk_compte_role_idx` (`idrole`),
  CONSTRAINT `fk_compte_role` FOREIGN KEY (`idrole`) REFERENCES `role` (`idrole`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compte`
--

LOCK TABLES `compte` WRITE;
/*!40000 ALTER TABLE `compte` DISABLE KEYS */;
INSERT INTO `compte` VALUES (2,1,'Gueu_Pacome','admin','bd2bd9bd786a74e8473de7bdb185771d359523d25c4bd8d45797139651b1abee7796afc94c1500d92c81e4c70da63c3e5a6da4869c9b2b85ede21574a114312a','d18ab6ae5909788bed8f05bfdb6ca9145963104df12988ffaeec5042fece64441fce8665545bf9abbed777ca96508d8f13f5223848a95d0761c0c2b2dbdd2474');
/*!40000 ALTER TABLE `compte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emargement`
--

DROP TABLE IF EXISTS `emargement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emargement` (
  `idemargement` int(11) NOT NULL AUTO_INCREMENT,
  `idprofesseurs` int(11) NOT NULL,
  `idfiliere` int(11) NOT NULL,
  `idmatieres` int(11) NOT NULL,
  `heure_eff` varchar(4) NOT NULL,
  `gain` int(11) NOT NULL DEFAULT '0',
  `titre_cours` varchar(100) NOT NULL DEFAULT 'Aucune',
  `date_emar` date NOT NULL,
  `date_ajout` date NOT NULL,
  `idcompte` int(11) NOT NULL,
  `idmodule` int(11) NOT NULL,
  `idann_sco` int(11) NOT NULL,
  PRIMARY KEY (`idemargement`,`idprofesseurs`,`idfiliere`,`idmatieres`),
  KEY `fk_emargement_compte1_idx` (`idcompte`),
  KEY `fk_emargement_module1_idx` (`idmodule`),
  KEY `fk_emargement_ann_sco1_idx` (`idann_sco`),
  KEY `fk_emargement_professeurs1_idx` (`idprofesseurs`),
  KEY `fk_emargement_filiere1_idx` (`idfiliere`),
  KEY `fk_emargement_matieres1_idx` (`idmatieres`),
  CONSTRAINT `fk_emargement_compte1` FOREIGN KEY (`idcompte`) REFERENCES `compte` (`idcompte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_emargement_module1` FOREIGN KEY (`idmodule`) REFERENCES `module` (`idmodule`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_emargement_ann_sco1` FOREIGN KEY (`idann_sco`) REFERENCES `ann_sco` (`idann_sco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_emargement_professeurs1` FOREIGN KEY (`idprofesseurs`) REFERENCES `professeurs` (`idprofesseurs`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_emargement_filiere1` FOREIGN KEY (`idfiliere`) REFERENCES `filiere` (`idfiliere`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_emargement_matieres1` FOREIGN KEY (`idmatieres`) REFERENCES `matieres` (`idmatieres`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emargement`
--

LOCK TABLES `emargement` WRITE;
/*!40000 ALTER TABLE `emargement` DISABLE KEYS */;
/*!40000 ALTER TABLE `emargement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filiere`
--

DROP TABLE IF EXISTS `filiere`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filiere` (
  `idfiliere` int(11) NOT NULL AUTO_INCREMENT,
  `filiere` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idfiliere`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filiere`
--

LOCK TABLES `filiere` WRITE;
/*!40000 ALTER TABLE `filiere` DISABLE KEYS */;
INSERT INTO `filiere` VALUES (1,'GÃ©nie Informatique');
/*!40000 ALTER TABLE `filiere` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `idlogin_attempts` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `time` time DEFAULT NULL,
  PRIMARY KEY (`idlogin_attempts`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matieres`
--

DROP TABLE IF EXISTS `matieres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matieres` (
  `idmatieres` int(11) NOT NULL AUTO_INCREMENT,
  `matieres` varchar(45) NOT NULL,
  PRIMARY KEY (`idmatieres`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matieres`
--

LOCK TABLES `matieres` WRITE;
/*!40000 ALTER TABLE `matieres` DISABLE KEYS */;
INSERT INTO `matieres` VALUES (1,'PHP et MySQL');
/*!40000 ALTER TABLE `matieres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matieres_enseignees`
--

DROP TABLE IF EXISTS `matieres_enseignees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matieres_enseignees` (
  `idmatieres_enseignees` int(11) NOT NULL AUTO_INCREMENT,
  `idprofesseurs` int(11) NOT NULL,
  `idfiliere` int(11) NOT NULL,
  `idmatieres` int(11) NOT NULL,
  `nbr_heure` decimal(10,0) NOT NULL,
  `cout_heure` int(11) NOT NULL,
  `cout_total` int(11) NOT NULL,
  `idmodule` int(11) NOT NULL,
  `idann_sco` int(11) NOT NULL,
  PRIMARY KEY (`idmatieres_enseignees`,`idprofesseurs`,`idfiliere`,`idmatieres`),
  KEY `fk_matieres_enseignees_ann_sco1_idx` (`idann_sco`),
  KEY `fk_matieres_enseignees_professeurs1_idx` (`idprofesseurs`),
  KEY `fk_matieres_enseignees_matieres1_idx` (`idmatieres`),
  KEY `fk_matieres_enseignees_filiere1_idx` (`idfiliere`),
  KEY `fk_matieres_enseignees_module1_idx` (`idmodule`),
  CONSTRAINT `fk_matieres_enseignees_ann_sco1` FOREIGN KEY (`idann_sco`) REFERENCES `ann_sco` (`idann_sco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_matieres_enseignees_professeurs1` FOREIGN KEY (`idprofesseurs`) REFERENCES `professeurs` (`idprofesseurs`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_matieres_enseignees_matieres1` FOREIGN KEY (`idmatieres`) REFERENCES `matieres` (`idmatieres`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_matieres_enseignees_filiere1` FOREIGN KEY (`idfiliere`) REFERENCES `filiere` (`idfiliere`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_matieres_enseignees_module1` FOREIGN KEY (`idmodule`) REFERENCES `module` (`idmodule`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matieres_enseignees`
--

LOCK TABLES `matieres_enseignees` WRITE;
/*!40000 ALTER TABLE `matieres_enseignees` DISABLE KEYS */;
INSERT INTO `matieres_enseignees` VALUES (1,1,1,1,4,50000,200000,1,1);
/*!40000 ALTER TABLE `matieres_enseignees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module` (
  `idmodule` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(45) NOT NULL,
  PRIMARY KEY (`idmodule`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` VALUES (1,'1er Module');
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paiement` (
  `idpaiement` int(11) NOT NULL AUTO_INCREMENT,
  `idprofesseurs` int(11) NOT NULL,
  `idfiliere` int(11) NOT NULL,
  `idmatieres` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `heure_total` decimal(10,0) DEFAULT NULL,
  `cout_heure` int(11) DEFAULT NULL,
  `apayer` int(11) DEFAULT NULL,
  `idmodule` int(11) NOT NULL,
  `idann_sco` int(11) NOT NULL,
  PRIMARY KEY (`idpaiement`,`idprofesseurs`,`idfiliere`,`idmatieres`),
  KEY `fk_paiement_module1_idx` (`idmodule`),
  KEY `fk_paiement_ann_sco1_idx` (`idann_sco`),
  KEY `fk_paiement_professeurs1_idx` (`idprofesseurs`),
  KEY `fk_paiement_filiere1_idx` (`idfiliere`),
  KEY `fk_paiement_matieres1_idx` (`idmatieres`),
  CONSTRAINT `fk_paiement_module1` FOREIGN KEY (`idmodule`) REFERENCES `module` (`idmodule`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_paiement_ann_sco1` FOREIGN KEY (`idann_sco`) REFERENCES `ann_sco` (`idann_sco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_paiement_professeurs1` FOREIGN KEY (`idprofesseurs`) REFERENCES `professeurs` (`idprofesseurs`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_paiement_filiere1` FOREIGN KEY (`idfiliere`) REFERENCES `filiere` (`idfiliere`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_paiement_matieres1` FOREIGN KEY (`idmatieres`) REFERENCES `matieres` (`idmatieres`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paiement`
--

LOCK TABLES `paiement` WRITE;
/*!40000 ALTER TABLE `paiement` DISABLE KEYS */;
/*!40000 ALTER TABLE `paiement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professeurs`
--

DROP TABLE IF EXISTS `professeurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `professeurs` (
  `idprofesseurs` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `prenoms` varchar(45) NOT NULL,
  `sexe` varchar(1) NOT NULL,
  `date_nai` date NOT NULL,
  `contacts` varchar(15) NOT NULL,
  `adresse` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `profession` varchar(45) DEFAULT NULL,
  `diplome` varchar(45) DEFAULT NULL,
  `photo` varchar(45) DEFAULT NULL,
  `actif` int(11) NOT NULL DEFAULT '1' COMMENT 'Si ACTIF =1\nNON ACTIF =0',
  PRIMARY KEY (`idprofesseurs`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professeurs`
--

LOCK TABLES `professeurs` WRITE;
/*!40000 ALTER TABLE `professeurs` DISABLE KEYS */;
INSERT INTO `professeurs` VALUES (1,'Gueu','Pacome','M','1990-12-14','1010101010','Sonfonia Gare','docteurgueu19@gmail.com','DÃ©veloppeur','MASTER 1','',1);
/*!40000 ALTER TABLE `professeurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `idrole` int(11) NOT NULL AUTO_INCREMENT,
  `role` int(11) NOT NULL COMMENT '1=Saisie\n1990=Admin',
  PRIMARY KEY (`idrole`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,1990);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-21 16:41:24
