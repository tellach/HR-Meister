-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 25 avr. 2018 à 00:16
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `grh`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidat`
--

DROP TABLE IF EXISTS `candidat`;
CREATE TABLE IF NOT EXISTS `candidat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` char(255) NOT NULL,
  `prenom` char(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `post` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `cv` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `salaire` double NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `etat` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `candidat`
--

INSERT INTO `candidat` (`id`, `nom`, `prenom`, `tel`, `post`, `date_naissance`, `cv`, `email`, `salaire`, `comment`, `etat`) VALUES
(15, 'khezzane', 'dallel', '0540343499', '.....', '1995-04-30', 'uploads/absent.txt', 'gd_khezzane@esi.dz', 0, '.....', 'non_contacte'),
(16, 'khezzane2', 'dallel2', '0540343499', '.....', '1995-04-30', 'uploads/absent.txt', 'gd_khezzane2@esi.dz', 0, '.....', 'non_contacte');

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` char(255) CHARACTER SET utf8 NOT NULL,
  `prenom` char(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `passwd` varchar(255) CHARACTER SET utf8 NOT NULL,
  `account_permission` enum('a','g','ag') CHARACTER SET utf8 NOT NULL,
  `theme` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`id`, `nom`, `prenom`, `email`, `username`, `passwd`, `account_permission`, `theme`) VALUES
(11, 'Zaknoun', 'Kamel', 'aminetellache928@gmail.com', 'kamel', 'B2EBMQYz', 'a', 1),
(43, 'Namani', 'Adel', 'adelnamani99@gmail.com', 'Adel', 'BWNaalBl', 'g', 1),
(47, 'khezzane', 'dallel', 'gd_khezzane@esi.dz', 'dallelkh', 'B2lWbFdoBjU=', 'a', 1),
(48, 'khezzane', 'dallel', 'gd_hareb@esi.dz', 'dallelkh5', 'UzVUZAI3', 'g', 1),
(49, 'admin', 'admin', 'admin@esi.dz', 'admin', 'VWNbPQRvCmhRbg==', 'a', 1);

-- --------------------------------------------------------

--
-- Structure de la table `conge`
--

DROP TABLE IF EXISTS `conge`;
CREATE TABLE IF NOT EXISTS `conge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `type_conge` int(11) NOT NULL,
  `demande_conge` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `conge`
--

INSERT INTO `conge` (`id`, `matricule`, `date_debut`, `date_fin`, `type_conge`, `demande_conge`) VALUES
(29, 15, '2018-02-08', '2018-03-02', 1, '../uploads/adel.txt'),
(28, 15, '2018-01-03', '2018-03-02', 1, '../uploads/adel.txt'),
(22, 13, '2018-02-01', '2018-02-23', 1, '5555555555555'),
(24, 15, '2018-02-02', '2018-03-01', 1, '0000000'),
(32, 12, '2018-04-27', '2018-05-12', 1, '../uploads/adel.txt'),
(35, 14, '2018-03-01', '2018-03-31', 3, 'sssssssss'),
(1, 15, '2018-03-01', '2018-03-10', 2, 'XDDD'),
(36, 15, '2019-03-01', '2019-03-31', 2, '../uploads/sioducv.txt'),
(48, 12, '2018-05-15', '2018-05-28', 1, '../uploads/lm.txt'),
(38, 14, '2019-03-01', '2019-03-30', 2, '../uploads/lm.txt'),
(39, 13, '2018-03-23', '2018-03-30', 1, '../uploads/sioducv.txt'),
(40, 14, '2020-03-15', '2020-03-22', 1, '../uploads/lm.txt'),
(41, 13, '2021-03-24', '2021-04-24', 2, '../uploads/lm.txt'),
(42, 20, '2020-03-23', '2020-03-31', 1, '../uploads/lm.txt'),
(44, 16, '2020-03-23', '2020-04-23', 1, '../uploads/lm.txt'),
(45, 16, '2050-03-23', '2050-03-24', 2, '../uploads/lm.txt'),
(46, 16, '2019-03-22', '2019-03-29', 2, '../uploads/lm.txt'),
(49, 13, '2022-03-30', '2022-03-31', 3, '../uploads/lm.txt'),
(50, 15, '2018-07-04', '2018-07-19', 1, '../uploads/pi.txt'),
(51, 15, '2018-06-01', '2018-06-30', 1, '../uploads/Hello.txt'),
(52, 15, '2018-08-17', '2018-10-18', 2, '../uploads/Denas25.txt'),
(53, 14, '2018-12-24', '2018-12-31', 1, '../uploads/lm.txt');

-- --------------------------------------------------------

--
-- Structure de la table `embauche`
--

DROP TABLE IF EXISTS `embauche`;
CREATE TABLE IF NOT EXISTS `embauche` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datee` date NOT NULL,
  `matricule` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `poste` varchar(255) NOT NULL,
  `salaire` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `embauche`
--

INSERT INTO `embauche` (`id`, `datee`, `matricule`, `note`, `poste`, `salaire`) VALUES
(1, '2018-04-24', 2, 8, 'director', 100000),
(8, '2018-04-24', 1, 30, 'comptable', 250000),
(9, '2018-04-24', 4, 5, 'Agent', 50000),
(12, '2018-04-30', 3, 0, '...', 0),
(14, '2018-06-30', 2, 0, 'houissier', 0),
(15, '2018-08-30', 5, 0, 'agent', 0);

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

DROP TABLE IF EXISTS `employe`;
CREATE TABLE IF NOT EXISTS `employe` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `matricule` int(11) UNSIGNED NOT NULL,
  `nom` char(255) NOT NULL,
  `prenom` char(255) NOT NULL,
  `statut` varchar(255) NOT NULL,
  `post` varchar(255) NOT NULL COMMENT 'code postal',
  `assurence` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `lieu_naissance` varchar(255) NOT NULL,
  `date_embauche` date NOT NULL,
  `situation_fam` enum('Marié(e)','Divorcé(e)','Célibataire','veuf(ve)') NOT NULL,
  `respo` int(11) NOT NULL COMMENT 'son matricule',
  `salaire` double(20,3) NOT NULL,
  `projet` varchar(255) NOT NULL,
  `num_social` varchar(255) NOT NULL,
  `contrat` varchar(255) NOT NULL COMMENT 'url',
  `cv` varchar(255) NOT NULL COMMENT 'url',
  `date_demission` date NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `conge` tinyint(1) NOT NULL COMMENT 'etat courant',
  `reste_conge` int(11) NOT NULL,
  `coord_bancaire` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`id`, `matricule`, `nom`, `prenom`, `statut`, `post`, `assurence`, `date_naissance`, `lieu_naissance`, `date_embauche`, `situation_fam`, `respo`, `salaire`, `projet`, `num_social`, `contrat`, `cv`, `date_demission`, `adresse`, `tel`, `email`, `conge`, `reste_conge`, `coord_bancaire`, `comment`) VALUES
(1, 11111, 'Namani', 'adeleeee', 'Actif', 'Directeur', 'a', '2000-02-15', '', '2015-02-01', 'Marié(e)', 15, 10000.000, '1', '07', 'aaaaa', 'aaaaaaa', '2024-02-16', 'aaaaaaaaaaaaaa', '0798526230', 'ga_namani@esi.dz', 1, 989, '14', 'pppppppppppppppp'),
(2, 1, 'Oukacha', 'Fouzi', 'Actif', 'Gardien', 'a', '2000-02-15', 'havana', '2018-04-24', 'Marié(e)', 15, 12000.000, '1', '07', 'uploads/contrat2.jpg', 'aaaaaaa', '2018-04-23', 'aaaaaaaaaaaaaa', '0798526230', 'ga_namani@esi.dz', 1, 995, '14', 'pppppppppppppppp'),
(3, 14, 'Zaknoun', 'Kamel', 'Actif', 'Agent de sécurité', 'a', '5000-02-15', '', '2015-02-01', 'Marié(e)', 15, 12000.000, '1', '07', 'aaaaa', 'aaaaaaa', '2024-02-16', 'aaaaaaaaaaaaaa', '0798526230', 'ga_namani@esi.dz', 1, 986, '14', 'pppppppppppppppp'),
(4, 15, 'Tellache', 'Amine', 'Actif', 'Responsable compatibilité', 'a', '5000-02-15', '', '2015-02-01', 'Marié(e)', 15, 12000.000, '1', '07', 'aaaaa', 'aaaaaaa', '2024-02-16', 'aaaaaaaaaaaaaa', '0798526230', 'ga_namani@esi.dz', 1, 956, '14', 'pppppppppppppppp'),
(5, 16, 'Traikia', 'Sidahmed', 'Actif', 'Secrétaire', '11', '1980-01-01', '', '0001-11-01', 'Marié(e)', 1, 1.000, '1', '1', 'uploads/Liste des roles generales (1).pdf', 'uploads/Liste des roles generales (1).pdf', '2018-03-05', 'a@a.com', '0798526230', 'ga_namani@esi.dz', 1, 969, '1', '1'),
(6, 66, 'Namani', 'Amine', 'Actif', 'Responsable des projets', 'a', '2000-02-15', '', '2015-02-01', 'Marié(e)', 15, 10000.000, '1', '07', 'aaaaa', 'aaaaaaa', '2024-02-16', 'aaaaaaaaaaaaaa', '0798526230', 'ga_namani@esi.dz', 1, 1000, '14', 'pppppppppppppppp'),
(7, 18, 'Oukacha', 'Kamel', 'Actif', 'Responsable de qualité', 'a', '2000-02-15', '', '2015-02-01', 'Marié(e)', 15, 12000.000, '1', '07', 'aaaaa', 'aaaaaaa', '2024-02-16', 'aaaaaaaaaaaaaa', '0798526230', 'ga_namani@esi.dz', 1, 993, '14', 'pppppppppppppppp'),
(8, 19, 'Zaknoun', 'Adel', 'Actif', 'Responsable relations internes', 'a', '1970-02-15', '', '2015-02-01', 'Marié(e)', 15, 12000.000, '1', '07', 'aaaaa', 'aaaaaaa', '2024-02-16', 'aaaaaaaaaaaaaa', '0798526230', 'ga_namani@esi.dz', 1, 993, '14', 'pppppppppppppppp'),
(9, 20, 'Tellache', 'Fouzi', 'Actif', 'Responsable des relations externes', 'a', '1965-02-15', '', '2015-02-01', 'Marié(e)', 15, 12000.000, '1', '07', 'aaaaa', 'aaaaaaa', '2024-02-16', 'aaaaaaaaaaaaaa', '0798526230', 'ga_namani@esi.dz', 1, 987, '14', 'pppppppppppppppp'),
(10, 13, 'Khezzane', 'Dallel', 'Actif', 'Livreur', '11', '1970-01-01', '', '2018-04-18', 'Marié(e)', 1, 1.000, '1', '1', 'uploads/Liste des roles generales (1).pdf', 'uploads/Liste des roles generales (1).pdf', '2018-04-18', 'a@a.com', '0798526230', 'ga_namani@esi.dz', 1, 974, '1', '1'),
(11, 5555, 'Boutouiliiiii', 'Djilali', 'Actif', 'Chauffeur', '5', '1980-05-05', '', '0005-05-05', 'Marié(e)', 5, 555555.000, '5', '55', 'uploads/présentation.txt', 'uploads/présentation.txt', '0005-05-05', '555', '5555', 'kzkzk@zzz', 55, 55, '55', '55'),
(16, 200, 'Khorf', 'Zaki', 'Actif', 'Agent de sécurité', 'a', '1990-03-21', 'a', '2018-03-26', 'Marié(e)', 1, 1.000, '2', 'a', '', 'uploads/lm.txt', '2018-04-03', 'a', 'a', 'a@a.com', 1, 2, 'a', 'a'),
(17, 7, 'Yahi', 'Mouh', 'Inactif', 'Femme de ménage', 'a', '1990-03-06', 'a', '2018-04-18', 'Marié(e)', 7, 7.000, '7', 'a', '', 'uploads/lm.txt', '2018-04-19', 'a', 'a', 'a@a.com', 1, 55, 'a', 'a'),
(18, 90, 'Mitiche', 'Mehdi', 'Actif', 'Responsable media', 'a', '1990-03-29', 'a', '2018-03-27', 'Divorcé(e)', 0, 12.000, 'aaa', 'a', '', 'uploads/lm.txt', '2018-04-03', 'a', 'a', 'aa@a', 1, 0, 'aaa', '/'),
(19, 999, 'Yacine', 'Zidelmane', 'Actif', 'Comité d\'accueil', '555', '1999-03-09', 'zzz', '2018-03-07', 'Divorcé(e)', 55, 5555555.000, '555', '5555', '', 'uploads/lm.txt', '2018-04-03', 'zzzz', '555', 'z@zzzzz', 1, 30, 'zzz', 'zzzz'),
(20, 88, 'z', 'z', 'Actif', 'z', 'z', '1999-04-18', 'z', '2018-03-21', 'Marié(e)', 15, 100.000, 'z', 'z', '', 'uploads/88_z', '2050-04-03', 'z', 'z', 'z@z.com', 1, 30, 'z', '/'),
(21, 996, 'zoubiiir', 'z', 'Actif', 'z', 'z', '1999-04-18', 'z', '2018-03-21', 'Marié(e)', 15, 100.000, 'z', 'z', '', 'uploads/CV996_zoubiiir', '2050-04-03', 'z', 'z', 'z@z.com', 1, 30, 'z', '/'),
(22, 444, 'zoubiiir', 'z', 'Actif', 'z', 'z', '1999-04-18', 'z', '2018-03-21', 'Marié(e)', 15, 100.000, 'z', 'z', '', 'uploads/cv_444_zoubiiir', '2050-04-03', 'z', 'z', 'z@z.com', 1, 30, 'z', '/'),
(23, 443, 'zoubiiir', 'z', 'Actif', 'z', 'z', '1999-04-18', 'z', '2018-03-21', 'Marié(e)', 15, 100.000, 'z', 'z', '', 'uploads/cv_443_zoubiiir', '2050-04-03', 'z', 'z', 'z@z.com', 1, 30, 'z', '/'),
(24, 442, 'zoubiiir', 'z', 'Actif', 'z', 'z', '1999-04-18', 'z', '2018-03-21', 'Marié(e)', 15, 100.000, 'z', 'z', '', 'uploads/cv_442_zoubiiir.pdf', '2050-04-03', 'z', 'z', 'z@z.com', 1, 30, 'z', '/'),
(25, 441, 'zoubiiir', 'z', 'Actif', 'z', 'z', '1999-04-18', 'z', '2018-03-21', 'Marié(e)', 15, 100.000, 'z', 'z', '', 'uploads/cv_441_zoubiiir.docx', '2050-04-03', 'z', 'z', 'z@z.com', 1, 30, 'z', '/'),
(26, 440, 'zoubiiir', 'z', 'Actif', 'z', 'z', '1999-04-18', 'z', '2018-03-21', 'Marié(e)', 15, 100.000, 'z', 'z', 'uploads/contrat26.jpg', 'uploads/cv_440_zoubiiir.docx', '2050-04-03', 'z', 'z', 'z@z.com', 1, 30, 'z', '/');

-- --------------------------------------------------------

--
-- Structure de la table `entretien`
--

DROP TABLE IF EXISTS `entretien`;
CREATE TABLE IF NOT EXISTS `entretien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` int(11) NOT NULL,
  `date` date NOT NULL,
  `Date_prochaine` date NOT NULL,
  `score` double NOT NULL,
  `fichier_excel` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entretien`
--

INSERT INTO `entretien` (`id`, `matricule`, `date`, `Date_prochaine`, `score`, `fichier_excel`) VALUES
(19, 1, '2018-04-24', '2019-04-19', 18, 'generated/entretien2018-04-181'),
(20, 15, '2018-04-24', '2019-04-19', 18, 'generated/entretien2018-04-191');

-- --------------------------------------------------------

--
-- Structure de la table `objectif`
--

DROP TABLE IF EXISTS `objectif`;
CREATE TABLE IF NOT EXISTS `objectif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` int(11) NOT NULL,
  `objectif` varchar(255) NOT NULL,
  `date_debut` date NOT NULL,
  `type` varchar(255) NOT NULL,
  `Evaluation` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `objectif`
--

INSERT INTO `objectif` (`id`, `matricule`, `objectif`, `date_debut`, `type`, `Evaluation`) VALUES
(2, 2121, 'csc', '2018-03-18', 'cs', ''),
(5, 11111, 'rapport2', '2018-03-18', 'long terme', 'A'),
(6, 11111, 'amine', '2018-03-19', 'moyen terme', 'A'),
(17, 11111, 'raappooot', '2020-11-12', 'court terme', 'C'),
(8, 11111, 'rappot11', '2019-03-20', 'moyen terme', 'A'),
(9, 11111, 'rapport16', '2018-03-20', 'moyen terme', 'A'),
(15, 11111, 'ob1', '2018-02-08', 'court terme', 'A'),
(13, 11111, 'amine2', '2019-12-12', 'court terme', 'D'),
(16, 11111, 'ob2', '2018-02-26', 'court terme', 'A'),
(18, 11111, 'excel_ziiit', '2020-02-21', 'court terme', 'A'),
(19, 11111, 'projet ga3 wehdek', '2018-04-20', 'long terme', 'C'),
(20, 11111, 'tawba', '2018-04-26', 'court terme', 'C');

-- --------------------------------------------------------

--
-- Structure de la table `parametres_entreprise`
--

DROP TABLE IF EXISTS `parametres_entreprise`;
CREATE TABLE IF NOT EXISTS `parametres_entreprise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_entreprise` varchar(255) CHARACTER SET utf8 NOT NULL,
  `specialite` varchar(255) NOT NULL,
  `raison_social` varchar(255) CHARACTER SET utf8 NOT NULL,
  `mail` varchar(255) CHARACTER SET utf8 NOT NULL,
  `num` varchar(255) CHARACTER SET utf8 NOT NULL,
  `site_web` varchar(255) CHARACTER SET utf8 NOT NULL,
  `msg_acceuil` text CHARACTER SET utf8 NOT NULL,
  `nom_gerant` varchar(255) CHARACTER SET utf8 NOT NULL,
  `mail_gerant` varchar(255) CHARACTER SET utf8 NOT NULL,
  `num_gerant` varchar(255) CHARACTER SET utf8 NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8 NOT NULL,
  `wilaya` varchar(255) NOT NULL,
  `RC` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `parametres_entreprise`
--

INSERT INTO `parametres_entreprise` (`id`, `nom_entreprise`, `specialite`, `raison_social`, `mail`, `num`, `site_web`, `msg_acceuil`, `nom_gerant`, `mail_gerant`, `num_gerant`, `logo`, `wilaya`, `RC`) VALUES
(1, 'GRH ', 'Developpement', 'SARL', 'yassir@gamil.com', '021986532', 'http://www.', 'Bienvenue à votre gestionnaire ! ', 'Zoubir', 'a@v.com', '0540343793', 'uploads/logo.jpg', 'Alger', '985556/01');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk` int(11) NOT NULL,
  `question` text CHARACTER SET utf8 NOT NULL,
  `reponse` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `fk`, `question`, `reponse`) VALUES
(2, 1, 'what interests you ?', 'NOTHING'),
(3, 8, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque bibendum iaculis magna, vitae lobortis ligula gravida in. In luctus scelerisque mauris, quis facilisis odio tincidunt quis. Maecenas at porta eros. Etiam tellus lectus, pretium quis neque nec, tincidunt venenatis nibh. Ut rutrum in dolor quis vestibulum. Pellentesque fermentum enim et laoreet laoreet. Donec ut nunc aliquet, ullamcorper ante a, ultrices ipsum.', 'Nulla sit amet euismod orci. Curabitur vel gravida quam, at luctus orci. Aenean hendrerit nunc turpis, ac vulputate ex ultrices vel. Duis pellentesque urna massa, in elementum urna accumsan vel. Quisque semper tortor non nisl fringilla, non posuere odio euismod. Aliquam ullamcorper justo sed odio facilisis, nec ultricies mi euismod. In eget lacus eget augue dapibus tristique. Morbi nec nisl sapien.'),
(4, 1, 'diploma?', 'master2'),
(9, 8, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque bibendum iaculis magna, vitae lobortis ligula gravida in. In luctus scelerisque mauris, quis facilisis odio tincidunt quis. Maecenas at porta eros. Etiam tellus lectus, pretium quis neque nec, tincidunt venenatis nibh. Ut rutrum in dolor quis vestibulum. Pellentesque fermentum enim et laoreet laoreet. Donec ut nunc aliquet, ullamcorper ante a, ultrices ipsum.', 'Nulla sit amet euismod orci. Curabitur vel gravida quam, at luctus orci. Aenean hendrerit nunc turpis, ac vulputate ex ultrices vel. Duis pellentesque urna massa, in elementum urna accumsan vel. Quisque semper tortor non nisl fringilla, non posuere odio euismod. Aliquam ullamcorper justo sed odio facilisis, nec ultricies mi euismod. In eget lacus eget augue dapibus tristique. Morbi nec nisl sapien.'),
(11, 1, 'kkkkk', 'ffff'),
(12, 1, 'kkkkk', 'ffff'),
(14, 8, 'QUI EST CE?', 'VOUSs'),
(15, 8, 'ok', 'a'),
(16, 11, 'aa', 'nn'),
(18, 9, 'entretien_name=\'generated/entretien\'.date(\"Y-m-d\").$matricule.\'.xlsx\';         $entretien->insertion_entretient_das_bdd($matricule);         $entretien->modifier_entete($matricule);         $entretien->modifier_tableaux($matricule);         $entretien->supprimer_fichier(\'aa1.xlsx\');         $entretien->modifier_les_ojectif_court_terme(', 'entretien_name=\'generated/entretien\'.date(\"Y-m-d\").$matricule.\'.xlsx\';         $entretien->insertion_entretient_das_bdd($matricule);         $entretien->modifier_entete($matricule);         $entretien->modifier_tableaux($matricule);         $entretien->supprimer_fichier(\'aa1.xlsx\');         $entretien->modifier_les_ojectif_court_terme(');

-- --------------------------------------------------------

--
-- Structure de la table `recuperation`
--

DROP TABLE IF EXISTS `recuperation`;
CREATE TABLE IF NOT EXISTS `recuperation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `code` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recuperation`
--

INSERT INTO `recuperation` (`id`, `email`, `code`) VALUES
(2, 'aminetellache928@gmail.com', 2159196),
(3, 'adelnamani99@gmail.com', 2159196),
(4, 'ga_namani@esi.dz', 35762641);

-- --------------------------------------------------------

--
-- Structure de la table `salaire`
--

DROP TABLE IF EXISTS `salaire`;
CREATE TABLE IF NOT EXISTS `salaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `montant` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `salaire`
--

INSERT INTO `salaire` (`id`, `matricule`, `date`, `montant`) VALUES
(3, '15', '2018-03-12', '1600'),
(4, '13', '2018-03-12', '1500'),
(5, '12', '2018-02-12', '15000'),
(6, '12', '2018-01-12', '20000'),
(7, '12', '2017-03-12', '24000'),
(8, '13', '2018-01-12', '30000'),
(9, '12', '2016-03-12', '10000'),
(10, '5555', '2018-03-20', '555555'),
(11, '12', '2018-03-21', '10000.000'),
(13, '1', '2018-03-25', '10000'),
(14, '1', '2018-03-25', '18000'),
(15, '1', '2018-03-25', '45000'),
(16, '1', '2018-03-25', '99000'),
(17, '1', '2018-03-25', '21000'),
(18, '1', '2018-03-25', '85000'),
(19, '1', '2018-03-25', '36000'),
(20, '1111111111111111111111111', '2018-03-25', '1'),
(21, '55', '2018-03-25', '15000'),
(22, '12', '2018-03-25', '1'),
(23, '155', '2018-03-25', '1'),
(24, '155', '2018-03-25', '1'),
(25, '122', '2018-03-25', '1'),
(26, '77', '2018-03-25', '1'),
(27, '1', '2018-03-25', '11000'),
(28, '1', '2018-03-25', '31000'),
(29, '1', '2018-03-25', '89000'),
(30, '1', '2018-03-25', '77000'),
(31, '1', '2018-03-25', '44000'),
(32, '88', '2018-03-25', '2'),
(33, '40', '2018-03-25', '1'),
(34, '88', '2018-03-25', '2'),
(35, '88', '2018-03-25', '2'),
(36, '200', '2018-03-25', '1'),
(37, '200', '2018-03-25', '1'),
(38, '200', '2018-03-25', '1'),
(39, '200', '2018-03-25', '1'),
(40, '200', '2018-03-25', '1'),
(41, '200', '2018-03-25', '1'),
(42, '200', '2018-03-25', '1'),
(43, '7', '2018-03-25', '7'),
(44, '90', '2018-03-25', '12'),
(45, '999', '2018-03-25', '5555555'),
(46, '66', '2018-04-13', '10000.000'),
(47, '1111', '2018-04-13', '10000.000'),
(48, '200', '2018-04-13', '1.000'),
(49, '111', '2018-04-13', '10000.000'),
(50, '13', '2018-04-13', '1.000'),
(51, '100', '2018-04-13', '1.000'),
(52, '13', '2018-04-13', '1.000'),
(53, '20', '2018-04-13', '10000.000'),
(54, '66', '2018-04-13', '10000.000'),
(55, '16', '2018-04-17', '1.000'),
(56, '5555', '2018-04-17', '555555.000'),
(57, '5555', '2018-04-17', '555555.000'),
(58, '7', '2018-04-18', '7.000'),
(59, '88', '2018-04-18', '90000'),
(60, '88', '2018-04-18', '90000'),
(61, '88', '2018-04-18', '90000'),
(62, '88', '2018-04-18', '90000'),
(63, '88', '2018-04-18', '90000'),
(64, '88', '2018-04-18', '90000'),
(65, '88', '2018-04-18', '90000'),
(66, '88', '2018-04-18', '90000'),
(67, '88', '2018-04-18', '100'),
(68, '88', '2018-04-18', '100'),
(69, '996', '2018-04-18', '100'),
(70, '444', '2018-04-18', '100'),
(71, '443', '2018-04-18', '100'),
(72, '442', '2018-04-18', '100'),
(73, '441', '2018-04-18', '100'),
(74, '440', '2018-04-18', '100');

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `numero` int(11) NOT NULL,
  `background` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `couleur1` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `couleur2` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `font` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
