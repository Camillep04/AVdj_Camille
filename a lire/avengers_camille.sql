-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 21 fév. 2024 à 02:57
-- Version du serveur : 5.7.36
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `avengers_camille`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE IF NOT EXISTS `auteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`id`, `nom`, `prenom`) VALUES
(1, 'Maupassant', 'Guy'),
(2, 'J.K', 'Rowling'),
(3, 'Sarah', 'Maas'),
(4, 'Dabos', 'Christelle');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240214061614', '2024-02-14 06:16:49', 49),
('DoctrineMigrations\\Version20240214062250', '2024-02-14 06:23:11', 43),
('DoctrineMigrations\\Version20240214062541', '2024-02-14 06:25:50', 112),
('DoctrineMigrations\\Version20240214062701', '2024-02-14 06:27:06', 60),
('DoctrineMigrations\\Version20240214062740', '2024-02-14 06:27:44', 80),
('DoctrineMigrations\\Version20240218214717', '2024-02-18 21:48:33', 127),
('DoctrineMigrations\\Version20240218220154', '2024-02-18 22:02:14', 106),
('DoctrineMigrations\\Version20240218222835', '2024-02-18 22:28:46', 147),
('DoctrineMigrations\\Version20240220075750', '2024-02-20 07:58:00', 171),
('DoctrineMigrations\\Version20240220075930', '2024-02-20 07:59:35', 92),
('DoctrineMigrations\\Version20240220213731', '2024-02-20 21:37:45', 468),
('DoctrineMigrations\\Version20240220213858', '2024-02-20 21:39:03', 133),
('DoctrineMigrations\\Version20240220214117', '2024-02-20 21:41:22', 218),
('DoctrineMigrations\\Version20240220222902', '2024-02-20 22:29:10', 214);

-- --------------------------------------------------------

--
-- Structure de la table `faune`
--

DROP TABLE IF EXISTS `faune`;
CREATE TABLE IF NOT EXISTS `faune` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `faune`
--

INSERT INTO `faune` (`id`, `nom`, `img`, `description`) VALUES
(1, 'Corbeau calédonien', 'img/corbeau.jpg', 'Le Corbeau calédonien ou Corbeau de Nouvelle-Calédonie (Corvus moneduloides) est une espèce de passereaux de la famille des Corvidae. Originaire de Nouvelle-Calédonie, c\'est l\'un des animaux (avec la loutre et des primates) connus pour fabriquer et utiliser des outils.'),
(2, 'Loche bleue', 'img/loche.jpg', 'Loche (nom vernaculaire) qui vit dans les eaux douces ou marines. Ce sont plutôt des poissons dont la morphologie est adaptée pour reposer sur le ventre, au fond de l\'eau. Les mères loche peuvent être porteuse du ciguatera.'),
(4, 'Ver de bancoule', 'img/bancoule.jpg', 'Les larves peuvent atteindre 8 cm de long sur 2 cm de diamètre. Elles se nourrissent du bois tendre et humide du bancoulier (Aleurites moluccana), en cours de décomposition. Elles pratiquent de longues galeries sinueuses, rebouchées après le passage de la larve, avec les débris de bois déchiquetés par des mandibules puissantes. Le ver est dégusté lors de la fête du ver de bancoule à Farino.');

-- --------------------------------------------------------

--
-- Structure de la table `flore`
--

DROP TABLE IF EXISTS `flore`;
CREATE TABLE IF NOT EXISTS `flore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `flore`
--

INSERT INTO `flore` (`id`, `nom`, `img`, `description`) VALUES
(1, 'Bois de fer', 'img/bois_fer.jpg', 'Le houppier, régulier, a un aspect particulier dû à ses ramifications fines, denses et à son feuillage très caractéristique aux feuilles réduites à de très petites dents, disposées en verticilles sur des rameaux fins de section cylindrique, de couleur vert sombre (les aiguilles du bois de fer sont souvent prises pour les aiguilles ou feuilles).'),
(2, 'Fougère arborescente', 'img/fougere.jpg', 'Cette fougère arborescente peut mesurer jusqu\'à 35 mètres. Elle est probablement la plus grande du monde. Très commune en lisière des forêts dans le Nord-est de la Grande Terre, on trouve aussi cette espèce en Province Sud, notamment sur le Mont Mou'),
(3, 'Niaoli', 'img/niaoli.jpg', 'Son étrange silhouette est caractéristique de la savane calédonienne: le niaouli recouvre les plaines de l’Ouest de l’archipel. À partir de ses feuilles, est extraite l’essence de niaouli, dont les vertus médicinales sont reconnues. Le niaouli ou Melaleuca quinquenervia appartient à la famille des myrtacées à laquelle se rattachent notamment les eucalyptus.');

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `auteur_id` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AC634F9960BB6FE6` (`auteur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id`, `date`, `auteur_id`, `titre`, `page`) VALUES
(1, '2023-02-01', 1, 'Bel ami', 100),
(2, '2024-02-20', 2, 'Harry Potter et la chambre des secrets', 200),
(3, '2024-02-20', 3, 'Keleana', 300),
(4, '2024-02-20', 4, 'La passe mirroir', 500);

-- --------------------------------------------------------

--
-- Structure de la table `marque_page`
--

DROP TABLE IF EXISTS `marque_page`;
CREATE TABLE IF NOT EXISTS `marque_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` date NOT NULL,
  `commentaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `marque_page`
--

INSERT INTO `marque_page` (`id`, `url`, `date_creation`, `commentaire`) VALUES
(1, 'aaaa', '2024-02-15', 'test1'),
(2, 'bbbbb', '2024-02-21', 'test2'),
(3, 'ccccc', '2024-02-29', 'test3'),
(4, 'https://www.meteo.nc/', '2024-02-14', 'ouioui il pleut'),
(5, 'https://www.meteo.nc/', '2024-02-18', 'ouioui il pleut'),
(6, 'mot cle test 2', '2024-02-19', 'nonnon il pleut pas'),
(7, 'mot cle test 2', '2024-02-19', 'nonnon il pleut pas'),
(8, 'mot cle test 2', '2024-02-19', 'nonnon il pleut pas');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mot_cles`
--

DROP TABLE IF EXISTS `mot_cles`;
CREATE TABLE IF NOT EXISTS `mot_cles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mot_cles` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mot_cles`
--

INSERT INTO `mot_cles` (`id`, `mot_cles`) VALUES
(1, 'test de mot cle'),
(2, 'test de mot cle 2eme essai'),
(3, 'test de mot cle 2eme essai'),
(4, 'test de mot cle 2eme essai'),
(5, 'test de mot cle 2eme essai'),
(6, 'test de mot cle 4eme essai');

-- --------------------------------------------------------

--
-- Structure de la table `mot_cles_marque_page`
--

DROP TABLE IF EXISTS `mot_cles_marque_page`;
CREATE TABLE IF NOT EXISTS `mot_cles_marque_page` (
  `mot_cles_id` int(11) NOT NULL,
  `marque_page_id` int(11) NOT NULL,
  PRIMARY KEY (`mot_cles_id`,`marque_page_id`),
  KEY `IDX_D48592B3855234A9` (`mot_cles_id`),
  KEY `IDX_D48592B3D59CC0F1` (`marque_page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mot_cles_marque_page`
--

INSERT INTO `mot_cles_marque_page` (`mot_cles_id`, `marque_page_id`) VALUES
(2, 6),
(3, 7),
(4, 7),
(5, 8),
(6, 8);

-- --------------------------------------------------------

--
-- Structure de la table `url`
--

DROP TABLE IF EXISTS `url`;
CREATE TABLE IF NOT EXISTS `url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `password`) VALUES
(1, 'user', 'user');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `livre`
--
ALTER TABLE `livre`
  ADD CONSTRAINT `FK_AC634F9960BB6FE6` FOREIGN KEY (`auteur_id`) REFERENCES `auteur` (`id`);

--
-- Contraintes pour la table `mot_cles_marque_page`
--
ALTER TABLE `mot_cles_marque_page`
  ADD CONSTRAINT `FK_D48592B3855234A9` FOREIGN KEY (`mot_cles_id`) REFERENCES `mot_cles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D48592B3D59CC0F1` FOREIGN KEY (`marque_page_id`) REFERENCES `marque_page` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
